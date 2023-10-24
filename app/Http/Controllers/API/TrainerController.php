<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\TrainerInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TrainerController extends Controller
{
    private TrainerInterface $trainerRepository;

    public function __construct(TrainerInterface $trainerRepository)
    {
        $this->trainerRepository = $trainerRepository;
    }
    public function index(): JsonResponse
    {
        $trainers = $this->trainerRepository->getTrainers();

        return response()->json([
            'trainers' => $trainers
        ], Response::HTTP_CREATED);
    }

}
