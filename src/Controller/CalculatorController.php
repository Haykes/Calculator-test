<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route('/', name: 'calculator_index')]
    public function index(): Response
    {
        return $this->render('calculator/index.html.twig');
    }

    #[Route('/api/calculator/add', name: 'api_calculator_add', methods: ['GET'])]
    public function add(Request $request, CalculatorService $calculator): JsonResponse
    {
        $a = (float) $request->query->get('a', '0'); 
        $b = (float) $request->query->get('b', '0'); 

        return $this->json(['result' => $calculator->add($a, $b)]);
    }

    #[Route('/api/calculator/subtract', name: 'api_calculator_subtract', methods: ['GET'])]
    public function subtract(Request $request, CalculatorService $calculator): JsonResponse
    {
        $a = (float) $request->query->get('a', '0'); 
        $b = (float) $request->query->get('b', '0'); 

        return $this->json(['result' => $calculator->subtract($a, $b)]);
    }

    #[Route('/api/calculator/multiply', name: 'api_calculator_multiply', methods: ['GET'])]
    public function multiply(Request $request, CalculatorService $calculator): JsonResponse
    {
        $a = (float) $request->query->get('a', '0'); 
        $b = (float) $request->query->get('b', '0'); 

        return $this->json(['result' => $calculator->multiply($a, $b)]);
    }

    #[Route('/api/calculator/divide', name: 'api_calculator_divide', methods: ['GET'])]
    public function divide(Request $request, CalculatorService $calculator): JsonResponse
    {
        $a = (float) $request->query->get('a', '0'); 
        $b = (float) $request->query->get('b', '0'); 

        if ($b === 0.0) {
            return $this->json(['error' => 'Division by zero'], Response::HTTP_BAD_REQUEST);
        }

        return $this->json(['result' => $calculator->divide($a, $b)]);
    }
}
