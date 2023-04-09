<?php
namespace App\Controller;

use App\Service\FruitService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class FruitController extends AbstractController
{
    public function all(FruitService $fruitService, SerializerInterface $serializer)
    {
        $response = new JsonResponse(json_decode($fruitService->findAll()));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }
}