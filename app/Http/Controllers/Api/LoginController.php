<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if(!Auth::attempt($credentials)) {
            return response()->json(['mensagem' => 'Usuário e/ou senha incorreta'], 401);
        }

        $request->user()->tokens()->delete();
        $token = $request->user()->createToken('token');

        return response()->json($token->plainTextToken);
    }
}
