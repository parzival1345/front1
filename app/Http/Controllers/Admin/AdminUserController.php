<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function filter(Request $request) {
        $users = User::all();
        if ($request->filterEmail)
            $users = $users->where('email', $request->filterEmail);
        if ($request->filterFirstName)
            $users = $users->where('first_name', $request->filterFirstName);
        if ($request->filterLastName)
            $users = $users->where('last_name', $request->filterLastName);
        if ($request->filterUserName)
            $users = $users->where('user_name', $request->filterUserName);
        if ($request->filterAgeMin && $request->filterAgeMax)
            $users = $users->whereBetween('age', [$request->filterAgeMin,$request->filterAgeMax]);
        if ($request->filterPhoneNumber)
            $users = $users->where('phone_number', $request->filterPhoneNumber);
        if ($request->filterPostalCode)
            $users = $users->where('post_code', $request->filterPostalCode);
        if ($request->filterGender)
            $users = $users->where('gender', $request->filterGender);
        if ($request->filterStatus)
            $users = $users->where('status', $request->filterStatus);
        if ($request->filterRoles)
            $users = $users->where('role', $request->filterRoles);

        return view('Admin.MainUsers.userData', compact('users'));
    }
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
        $users = User::where ('id' , $id)->first();
        return view('Admin.MainUsers.editUser',['users' => $users]);
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
        return redirect('/admin/users');
    }

    public function destroy($id) {
        User::find($id)->update([
            'email' => null,
        ]);
        User::where('id' , $id)->delete();
        return redirect('/admin/users');
    }
}
