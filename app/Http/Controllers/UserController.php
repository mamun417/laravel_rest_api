<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Hash;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function updateProfile(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'address' => 'required|max:955'
        ]);

        $requested_data = $request->only(['name', 'email', 'address', 'skills']);

        $skills = request('skills');

        $skills = collect($skills)->map(function ($skill) {
            return $skill['code'];
        });

        auth()->user()->update($requested_data);
        auth()->user()->skills()->sync($skills);

        $user_info = auth()->user();
        $user_info['skills'] = request('skills');

        return $this->successResponse(['user' => $user_info]);
    }

    public function checkPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'old_password' => 'required'
        ]);

        $check = Hash::check($request->input('old_password'), auth()->user()->password);

        if ($check) {
            return $this->successMessage('password match');
        }

        return $this->errorMessage('password does not match', 404);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        auth()->user()->update(['password' => Hash::make($request->input('password'))]);

        $this->successMessage('password has been updated successful');
    }

    public function changeImage(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'image' => 'required'
        ]);

        $requested_data = $request->only('image');

        if ($request->input('image')) {

            $image = HelperController::imageUpload('image');
            $requested_data['image'] = $image;

            if (isset(auth()->user()->image)) {
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

        return $this->successResponse(['user' => $userInfo]);
    }
}
