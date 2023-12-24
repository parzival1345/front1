<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
class UserController extends Controller
{
    public function create()
    {
        return view('users.addUser');
    }
    public function index()
    {
        $users = User::all();
        return view('users.userData', ['users' => $users]);
    }
    public function edit($id)
    {
        $users = User::find($id);
        return view('users.editUser', ['users' => $users]);
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'user_name'=>$request->user_name,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'age'=>$request->age,
            'gender'=>$request->gender,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'password'=>md5($request->password),
            'address'=>$request->address,
            'post_code'=>$request->postal_code,
            'country'=>$request->country,
            'province'=>$request->province,
            'city'=>$request->city,
        ]);
        return redirect()->route('users.index');
    }
    public function update(UpdateUserRequest $request,$id )
    {
        User::find($id)->update([
            'user_name'=>$request->user_name,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'age'=>$request->age,
            'gender'=>$request->gender,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'post_code'=>$request->postal_code,
            'country'=>$request->country,
        ]);
        return redirect('/users');
    }
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/users');
    }
    public function show() {
        $activeUserCounts = User::all();
        return view('workplace', compact('activeUserCounts'));
    }
}
