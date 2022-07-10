<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 401);

        }


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

//        if ($this->token) {
//            return $this->login($request);
//        }

        return Response::created([
            'user' => $user->toArray(),
            'token' => $user->generateToken()
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::whereEmail($request['email'])->first();

        if (!JWTAuth::attempt($credentials)) {

            return Response::clientError(['Invalid credentials']);

        }

        return Response::success([
            'user' => $user->toArray(),
            'token' => $user->generateToken()
        ]);
    }


}
