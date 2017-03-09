<?php
namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'name' => 'required',
            'email' => 'required|email|unique:users'
        ]);


        $user = new User();
        $user->password = bcrypt($request->input('password'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return $user;


    }
}