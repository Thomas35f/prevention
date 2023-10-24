<?php


namespace App\Http\Controllers\API;

use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\AbilityProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class AuthController extends BaseController
{

    public function __construct()
    {

    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('LaravelSanctumAuth', ['user:get:user'])->plainTextToken;
            $token = $auth->createToken('LaravelSanctumAuth', ['user:get:user']);
            $success['name'] = $auth->lastname;

            return $this->handleResponse($success, 'User logged-in!');
        } else {
            return $this->handleError('Unauthorised.', ['error' => 'Unauthorised'])->setStatusCode(401);
        }
    }

    public function register(RegisterRequest $request)
    {

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] = $user->lastname;


        return $this->handleResponse($success, 'User successfully registered!');
    }

}
