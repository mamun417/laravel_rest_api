<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\ApiController;
use App\User;
use Hash;
use Illuminate\Http\Request;

class RegisterController extends ApiController
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|max:955',
            'password' => 'required|min:6|confirmed'
        ]);

        $requested_data = $request->only(['name', 'email', 'address', 'password']);

        $requested_data['password'] = Hash::make($request->password);
        User::create($requested_data);

        //login after successfully registration
        $authController = new AuthController();
        $credentials = $request->only('email', 'password');

        if ($token = $authController->guard()->attempt($credentials)) {
            return $authController->respondWithToken($token);
        }
    }
}
