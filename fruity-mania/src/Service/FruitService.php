<?php 
namespace App\Service;

use App\Repository\FruitRepository;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class FruitService
{
    public function __construct(private FruitRepository $fruitRepository)
    {}

    public function paginatedFruits($limit, $offset): string
    {
        $fruits['fruits'] = $this->fruitRepository->paginatedFruits($limit, $offset);
        $fruits['totalRecords'] = $this->fruitRepository->count([]);
        $serializer = $this->handleCircularReferences();
        
        return $serializer->serialize($fruits, 'json');
    }

    /**
     * return \Symfony\Component\Serializer\Serializer
     */
    private function handleCircularReferences()
    {
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getName();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
        
        return new Serializer([$normalizer], [$encoder]);
    }

}