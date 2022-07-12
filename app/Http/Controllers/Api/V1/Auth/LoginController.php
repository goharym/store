<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::whereEmail($request['email'])->first();

        if (!JWTAuth::attempt($credentials)) {

            return Response::clientError(['Invalid Credentials']);

        }

        return Response::success([
            'user' => $user->toArray(),
            'token' => $user->generateToken()
        ]);
    }


}
