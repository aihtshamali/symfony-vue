<?php

namespace App\Command;

use App\Entity\Fruit;
use App\Entity\Nutrition;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'fruits:fetch',
    description: 'This command will allow us to fetch all the fruits from Fruity Vice 🍓',
)]
class FruitsFetchCommand extends Command
{
    const FRUITY_VICE_URL = "https://fruityvice.com/api/fruit/all";

    public function __construct(private HttpClientInterface $client, private EntityManagerInterface $entityManager, private MailerInterface $mailer)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $response = $this->client->request('GET', self::FRUITY_VICE_URL);
            $fruits = $response->toArray();

            foreach ($fruits as $fruit) {
                $existingFruit = $this->entityManager->getRepository(Fruit::class)->findOneBy(['web_id' => $fruit['id']]);
                
                if (!$existingFruit) {
                    $newFruit = new Fruit();
                    $newFruit->setName($fruit['name']);
                    $newFruit->setGenus($fruit['genus']);
                    $newFruit->setFamily($fruit['family']);
                    $newFruit->setFruitOrder($fruit['order']);
                    $newFruit->setWebId($fruit['id']);
                    $this->entityManager->persist($newFruit);

                    $fruitNutrition = new Nutrition();
                    $fruitNutrition->setFruit($newFruit);
                    $fruitNutrition->setCarbohydrates($fruit['nutritions']['carbohydrates']);
                    $fruitNutrition->setProtein($fruit['nutritions']['protein']);
                    $fruitNutrition->setFat($fruit['nutritions']['fat']);
                    $fruitNutrition->setCalories($fruit['nutritions']['calories']);
                    $fruitNutrition->setSugar($fruit['nutritions']['sugar']);
                    $this->entityManager->persist($fruitNutrition);
                    $this->entityManager->flush();
                    
                } else {
                    $nutritions = $this->entityManager->getRepository(Nutrition::class)->findOneBy(['fruit' => $existingFruit->getId()]);
                    if (!$nutritions) {
                        $fruitNutrition = new Nutrition();
                        $fruitNutrition->setFruit($existingFruit);
                        $fruitNutrition->setCarbohydrates($fruit['nutritions']['carbohydrates']);
                        $fruitNutrition->setProtein($fruit['nutritions']['protein']);
                        $fruitNutrition->setFat($fruit['nutritions']['fat']);
                        $fruitNutrition->setCalories($fruit['nutritions']['calories']);
                        $fruitNutrition->setSugar($fruit['nutritions']['sugar']);
                        $this->entityManager->persist($fruitNutrition);
                        $this->entityManager->flush();
                    }
                }
            }
            $this->sendMail();

            return Command::SUCCESS;
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return Command::FAILURE;
        }
    }

    protected function sendMail() 
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('test@gmail.com')
            ->subject('Success! Fruits fetching')
            ->text('All fruits have been successfully fetched');

        $this->mailer->send($email);
    }
}
