<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLearnerForTrainingRequest;
use App\Http\Requests\StoreLearnerRequest;
use App\Models\Learner;
use App\Models\Lesson;
use App\Models\Subclient;
use App\Models\Training;
use App\Models\User;
use App\Repositories\LearnerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class LearnerController extends Controller
{
    protected LearnerRepository $learnerRepository;

    public function __construct(LearnerRepository $learnerRepository)
    {
        $this->learnerRepository = $learnerRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/learners",
     *     summary="Ajoute un nouveau stagiaire",
     *     tags={"Learners"},
     *     @OA\RequestBody(
     *         required=true,
     *          description="Données pour ajouter un nouveau stagiaire",
     *          @OA\JsonContent(ref="#/components/schemas/StoreLearner")
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Stagiaire ajouté avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="learner", ref="#/components/schemas/Learner")
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
    public function store(StoreLearnerRequest $request):JsonResponse
    {
        $data = $request->validated();
        $learner = $this->learnerRepository->createLearner($data);

        return response()->json([
            'message' => "Le stagiaire " . $learner->user->lastname . ' ' . $learner->user->firstname . " a été ajouté avec succès.",
            'learner' => $learner
        ], Response::HTTP_CREATED);
    }

    public function getLearnersBySubclient($subclientId): JsonResponse
    {
        $learners = $this->learnerRepository->getLearnersBySubclient($subclientId);
        return response()->json($learners, 200);
    }

    public function storeForTraining(StoreLearnerForTrainingRequest $request): JsonResponse
    {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $trainingId = $request->input('training_id');
        $subclientId = $request->input('subclient_id');

        $learner = Learner::whereHas('user', function ($query) use ($firstname, $lastname) {
            $query->where('firstname', $firstname)->where('lastname', $lastname);
        })->first();

        if (!$learner) {
            $user = new User([
                'lastname' => $lastname,
                'firstname' => $firstname,
                'email' => $lastname.$firstname.'@lery.cc',
                'password' => bcrypt(Str::random(10)),
            ]);
            $user->save();

            $learner = new Learner();
            $learner->user()->associate($user);
            $subClient = Subclient::findOrFail($subclientId);
            $learner->subclient()->associate($subClient);
            $learner->save();
        }

        $training = Training::find($trainingId);

        if (!$training) {
            return response()->json(['message' => "La formation n'a pas été trouvée"], Response::HTTP_NOT_FOUND);
        }

        // Vérification si le stagiaire est déjà associé à la formation via une leçon
        $existingLesson = Lesson::where('training_id', $trainingId)
            ->where('learner_id', $learner->id)
            ->first();

        if($existingLesson){
            return response()->json([
                'message' => "Le stagiaire " . $learner->user->lastname . ' ' . $learner->user->firstname . " est déjà attaché à cette formation.",
            ], Response::HTTP_CONFLICT);
        }

        // Création d'une nouvelle leçon et association avec le stagiaire
        $lesson = new Lesson();
        $lesson->training_id = $training->id;
        $lesson->learner()->associate($learner);
        $lesson->save();

        return response()->json([
            'message' => "Le stagiaire " . $learner->user->lastname . ' ' . $learner->user->firstname . " a été ajouté avec succès à la formation.",
        ], Response::HTTP_CREATED);
    }

}
