<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        info(request('skills'));

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'address' => 'required|max:955'
        ]);

        $requested_data = $request->only(['name', 'email', 'address', 'skills']);

        $skills = request('skills');

        $skills = collect($skills)->map(function ($skill) {
           return $skill['code'];
        });

        try {
            auth()->user()->update($requested_data);
            auth()->user()->skills()->sync($skills);
        } catch (Exception $e) {
            return HelperController::apiResponse(500, $e->getMessage());
        }

        $user_info = auth()->user();
        $user_info['skills'] = request('skills');

        return HelperController::apiResponse(200, null, 'user', $user_info);
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

    public function changeImage(Request $request)
    {
        $request->validate([
            'image' => 'required'
        ]);

        $requested_data = $request->only('image');

        if ($request->image) {

            $image = HelperController::imageUpload('image');
            $requested_data['image'] = $image;

            if (isset(auth()->user()->image)){
                HelperController::imageDelete(auth()->user()->image);
            }
        }

        auth()->user()->update($requested_data);

        $userInfo = auth()->user();

        $userSkills = User::find(auth()->id())->first()->skills;

        $userSkills = $userSkills->map(function ($item, $key) {
            return ['label' => $item->name, 'code' => $item->id];
        });

        $userInfo['skills'] = $userSkills;

        return HelperController::apiResponse(200, null, 'user', $userInfo);
    }
}
