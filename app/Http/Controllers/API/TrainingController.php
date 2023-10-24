<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingRequest;
use App\Interfaces\TrainingInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TrainingController extends Controller
{
    private TrainingInterface $trainingRepository;

    public function __construct(TrainingInterface $trainingRepository)
    {
        $this->trainingRepository = $trainingRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/trainings",
     *     summary="Récupère la liste des formations du client connécté",
     *     tags={"Trainings"},
     *     @OA\Response(
     *         response=201,
     *         description="Opération réussie",
     *         @OA\JsonContent(
     *             @OA\Property(property="trainings", type="array", @OA\Items(ref="#/components/schemas/Training"))
     *         ),
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur serveur",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object")
     *         ),
     *     ),
     * )
     */
    public function getTrainingsForCurrentUser(): JsonResponse
    {
        $clientId = Auth::user()->client_id;
        $trainings = $this->trainingRepository->getTrainingsByTrainerClientId($clientId);

        return response()->json([
            'trainings' => $trainings
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/trainings",
     *     summary="Crée une nouvelle formation",
     *     tags={"Trainings"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données pour ajouter une nouvelle formation",
     *         @OA\JsonContent(ref="#/components/schemas/TrainingRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Formation créée avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="training", ref="#/components/schemas/Training")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erreur de validation",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object")
     *         ),
     *     ),
     * )
     */
    public function create(TrainingRequest $request): JsonResponse
    {
        $training = $this->trainingRepository->createTraining($request->all());

        return response()->json([
            'message' => "La Formation " . $training->name . " a été crée avec succès.",
        ], Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/getTraining/{id}",
     *     summary="Récupère une formation spécifique par ID",
     *     tags={"Trainings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la formation",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Opération réussie",
     *         @OA\JsonContent(
     *             @OA\Property(property="training", type="object", ref="#/components/schemas/Training")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Formation non trouvée",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur serveur",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object")
     *         ),
     *     ),
     * )
     */
    public function getTrainingById($id): JsonResponse
    {
        $training = $this->trainingRepository->getTrainingById($id);

        if (!$training) {
            Log::warning("Training with ID: $id not found");
            return response()->json(['message' => 'Formation non trouvée'], 404);
        }

        return response()->json([
            'training' => $training
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/trainings/edit/{id}",
     *     summary="Mettre à jour une formation existante",
     *     tags={"Trainings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la formation",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données pour la mise à jour de la formation",
     *         @OA\JsonContent(ref="#/components/schemas/TrainingRequest") // Adaptez ceci selon votre schéma de mise à jour.
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Formation mise à jour avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erreur de validation",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object")
     *         ),
     *     ),
     * )
     */
    public function update($id, TrainingRequest $request): JsonResponse
    {
        $training = $this->trainingRepository->updateTraining($id, $request->all());

        if (!$training) {
            Log::warning("Erreur lors de la mise à jour de la formation avec l'ID: $id");
            return response()->json(['message' => 'Erreur lors de la mise à jour de la formation'], 500);
        }

        return response()->json([
            'message' => "La Formation " . $training->name . " a été mise à jour avec succès.",
        ], 200);
    }

}
