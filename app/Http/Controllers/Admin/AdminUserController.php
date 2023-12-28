<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Admin.MainUsers.userData',['users' => $users]);
    }

    public function create() {
        return view('Admin.MainUsers.addUser');

    }

    public function store(Request $request) {
        User::create([
            'role' => $request->role,
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
        ]);

        return redirect('/admin');
    }

    public function edit($id) {
        $user = User::where ('id' , $id)->get->first();
        return view('Admin.MainUsers.editUser',['user' => $user]);
    }

    public function update(Request $request,$id) {
        User::where('id', $id)->update([
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'post_code' => $request->postal_code,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
        ]);
        return redirect('/admin');
    }

    public function destroy($id) {
        User::where('id' , $id)->delete();
        return redirect('/admin');
    }
}
