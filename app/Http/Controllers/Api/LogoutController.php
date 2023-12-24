<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens->each(function ($token, $key) {
            $token->delete();
            Auth::logout();
        });
        //        auth()->logout();
//        auth()->user()->tokens()->where('token', session()->get('token'))->update([
//            'token' => null,
//        ]);

    return redirect('/login');
    }
}
