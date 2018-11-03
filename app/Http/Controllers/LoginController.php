<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use function response;

class LoginController extends Controller {

    public function login(Request $request) {
        $credentials = $request->only(['email', 'password']);

        $token = JWTAuth::attempt($credentials);

        if ($token) {
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'invalid credentials'], 401);
        }
    }

}
