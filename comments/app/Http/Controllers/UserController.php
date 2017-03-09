<?php
namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{



    /**
     * @api {post} /oauth/token Login
     * @apiName Get a token
     * @apiGroup User
     *
     * @apiParam {String} grant_type password
     * @apiParam {String} client_id Client id
     * @apiParam {String} client_secret client secret
     * @apiParam {String} username The user's email
     * @apiParam {String} password The user's password

     * @apiSuccess {String} token_type Type of the token, Bearer
     * @apiSuccess {String} access_token The JWT token used for authentication
     * @apiSuccess {Number} expires_in Seconds in which the token will expire
     * @apiSuccess {String} refresh_token The refresh token
     */

    /**
     * @api {post} /api/users Create a new user
     * @apiName CreateUser
     * @apiGroup User
     *
     * @apiParam {String} email The email (username) must be unique and a valid email
     * @apiParam {String} name Common name of the user
     * @apiParam {String} password Password must be a minimum of 6 characters

     * @apiSuccess {String} name name of the User.
     * @apiSuccess {Number} id id of the User.
     */

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