<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function createUser(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'user_name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            session()->put('token', $user->createToken("API TOKEN")->plainTextToken);

            return redirect('/workplace');

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
