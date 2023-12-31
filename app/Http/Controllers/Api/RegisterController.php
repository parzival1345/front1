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
        if ($request->role == 'seller') {
            User::create([
                'user_name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'status' => 'در انتظار تایید',
            ]);
            return view('authorize/register')->with('message' , 'لطفا منتظر تایید ادمین باشید');
        }else {
        try {
            $user = User::create([
                'user_name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
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

    public function accept($id) {
        $user = User::find($id);
        $user->update(['status' => 'تایید شده']);
        session()->put('token', $user->createToken("API TOKEN")->plainTextToken);
        return back();
    }

    public function reject($id) {
        User::find($id)->update(['status' => 'رد شده'])->delete();
        return back();
    }
}
