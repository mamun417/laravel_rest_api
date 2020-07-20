<?php

namespace App\Http\Controllers;

use Exception;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'address' => 'required|max:955'
        ]);

        $requested_data = $request->only(['name', 'email', 'address']);

        try {
            auth()->user()->update($requested_data);
        } catch (Exception $e) {
            return HelperController::apiResponse(500, $e->getMessage());
        }

        return HelperController::apiResponse(200, null, 'user', auth()->user());
    }

    public function checkPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required'
        ]);

        $check = Hash::check($request->old_password, auth()->user()->password);

        if ($check){
            return HelperController::apiResponse(200, 'password match');
        }

        return HelperController::apiResponse(404, 'password does not match');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        try {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        } catch (Exception $e) {
            return HelperController::apiResponse(500, $e->getMessage());
        }

        return HelperController::apiResponse(200, 'password has been updated successful');
    }
}
