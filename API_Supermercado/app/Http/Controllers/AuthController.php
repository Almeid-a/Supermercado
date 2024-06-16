<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//  7|cBhVoT9vSWwaTLiiJjcSfNqIbAJ6FtNsJvQNGnVV290078cf

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))){
            return $this->response('Acesso Autorizado', 200,[
                'token' => $request->user()->createToken('produtos')->plainTextToken
            ]);
        }

        return $this->response('Acesso não Autorizado', 403);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->response('Logout Concluido', 200);
    }
}
