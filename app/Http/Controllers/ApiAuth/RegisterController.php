<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\User;
use Illuminate\Http\Request;
use Exception;

class RegisterController extends Controller
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

        try {
            $requested_data['password'] = Hash::make($request->password);
            User::create($requested_data);
        } catch (Exception $e) {
            return HelperController::apiResponse(500, $e->getMessage());
        }

        //login after successfully registration
        $authController = new AuthController();

        $credentials = $request->only('email', 'password');

        if ($token = $authController->guard()->attempt($credentials)) {
            return $authController->respondWithToken($token);
        }

        return HelperController::apiResponse(500, 'there is a problem, please try again');
    }
}
