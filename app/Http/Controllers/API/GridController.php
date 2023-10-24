<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\GridInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class GridController extends Controller
{
    protected GridInterface $gridRepository;

    public function __construct(GridInterface $gridRepository)
    {
        $this->gridRepository = $gridRepository;
    }

    public function getGridsForCurrentUser(): JsonResponse
    {
        $user = Auth::user();
        $clientId = $user->client_id;
        $grids = $this->gridRepository->getGridsByClientId($clientId);

        return response()->json([
            'grids' => $grids
        ]);
    }
}
