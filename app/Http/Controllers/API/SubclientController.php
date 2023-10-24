<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class SubclientController extends Controller
{
    public function getSubclientsForCurrentUser(): JsonResponse
    {
        $user = Auth::user();
        $subclients = $user->client
            ->with('subclients.company')
            ->get()
            ->pluck('subclients')
            ->collapse();

        return response()->json($subclients, Response::HTTP_OK);
    }
}
