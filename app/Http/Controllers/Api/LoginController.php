<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\HTTP\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function loginUser(LoginRequest $request)
    {
        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user_role = auth()->user()->role;
            $user = auth()->user();
            switch ($user_role) {
                case 'admin' :
                    session()->put('token', $user->createToken("API TOKEN")->plainTextToken);
                    return redirect()->route('admin.workplace');
                    break;
                case 'customer' :
                    session()->put('token', $user->createToken("API TOKEN")->plainTextToken);
                    return redirect()->route('customer.workplace');
                    break;
                case 'seller' :
                    session()->put('token', $user->createToken("API TOKEN")->plainTextToken);
                    return redirect()->route('seller.workplace');
                    break;
                default :
                    echo "your role was not invalid";
            }
        }
    }
}
