<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
            return HelperController::formattedResponse(false, 500, $e->getMessage());
        }

        // login after successfully registration
        $authController = new AuthController();

        $credentials = $request->only('email', 'password');

        if ($token = $authController->guard()->attempt($credentials)) {
            return $authController->respondWithToken($token);
        }

        return HelperController::formattedResponse(false, 500, 'there is a problem, please try again');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$request->user()->id,
            'address' => 'required|max:955'
        ]);

        $requested_data = $request->only(['name', 'email', 'address']);

        try {
            $request->user()->update($requested_data);
        } catch (Exception $e) {
            return HelperController::formattedResponse(false, 500, $e->getMessage());
        }

        return HelperController::formattedResponse(true, 200, null, $request->user());
    }
}
