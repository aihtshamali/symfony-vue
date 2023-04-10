<?php
namespace App\Controller;

use App\Service\FruitService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FruitController extends AbstractController
{
    public function all(Request $request, FruitService $fruitService)
    {
        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $response = new JsonResponse(json_decode($fruitService->paginatedFruits($limit, $offset)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }
}