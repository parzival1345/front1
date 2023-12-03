<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function create()
    {
        return view('users.addUser');
    }
    public function index()
    {
        $users = DB::table('users')->get();
        return view('users.userData', ['users' => $users]);
    }
    public function edit($id)
    {
        $users =DB::table('users')->where('id',$id)->first();
        return view('users.editUser', ['users' => $users]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'user_name'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'age'=>'required',
            'gender'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
            'postal_code'=>'required',
            'country'=>'required',
            'province'=>'required',
            'city'=>'required',

        ]);


        DB::table('users')->insert([
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
            'created_at'=>date('Y-m-d H:i:s'),
        ]);


        return redirect()->route('users.index');
    }
    public function update(Request $request,$id )
    {
        DB::table('users')->where('id' ,$id)->update([
            'user_name'=>$request->user_name,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'age'=>$request->age,
            'gender'=>$request->gender,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'post_code'=>$request->postal_code,
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        return redirect('/users');
    }
    public function destroy($id)
    {
        DB::table('users')->where('id' , $id)->update(['status' => 'disable']);
        return redirect('/users');
    }
}
