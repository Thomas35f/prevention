<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\LessonInterface;
use App\Models\Lesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{

    private LessonInterface $lessonRepository;

    public function __construct(LessonInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/lesson/{id}",
     *     summary="Met à jour une leçon spécifique",
     *     tags={"Lessons"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Identifiant de la leçon à mettre à jour",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données pour mettre à jour la leçon",
     *         @OA\JsonContent(
     *             required={"gridId"},
     *             @OA\Property(property="gridId", type="integer", description="Identifiant de la grille à associer à la leçon")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Leçon mise à jour avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Leçon mise à jour avec succès")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Leçon non trouvée",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Leçon non trouvée")
     *         )
     *     ),
     * )
     */
    public function update(Request $request, $id): JsonResponse
    {
        $lesson = $this->lessonRepository->findById($id);

        if (!$lesson) {
            return response()->json(['error' => 'Leçon non trouvée'], Response::HTTP_NOT_FOUND);
        }

        $this->lessonRepository->updateGridId($lesson, $request->input('gridId'));

        return response()->json(['message' => 'Leçon mise à jour avec succès'], Response::HTTP_OK);
    }


    public function show($id): JsonResponse
    {
        $lesson = $this->lessonRepository->getFullLessonDetails($id);

        if (!$lesson) {
            return response()->json(['error' => 'Leçon non trouvée'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($lesson);
    }

}
