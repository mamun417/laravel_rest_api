<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Hash;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function index()
    {
        $per_page = request()->query('per_page') ?? 10;
        $search = request()->query('search');

        $users = User::latest();

        if ($search) {
            $search = '%' . $search . '%';
            $users = $users->where('name', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orWhere('address', 'like', $search);
        }

        $users = $users->paginate($per_page);

        if (request()->query('page') > $users->lastPage()) {
            return redirect($users->url($users->lastPage()) . "&per_page=$per_page&search=$search");
        }

        return $this->successResponse(['users' => $users], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:50",
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'roles' => "required|array",
            'roles.*' => "required",
        ]);

        $user = User::create($request->all());

        return $this->successResponse(['user' => $user], 200);
    }

    public function show(User $user): \Illuminate\Http\JsonResponse
    {
        return $this->successResponse(['user' => $user], 200);
    }

    public function update(Request $request, User $user): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => "required|string|max:50",
            'email' => 'required|email|unique:users,email,'. $user->id,
            'password' => 'nullable|min:8',
            'roles' => "required|array",
            'roles.*' => "required",
        ]);

        $user->update($request->all());

        return $this->successResponse(['user' => $user], 200);
    }

    public function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        $user->delete();

        return $this->successResponse(['user' => $user], 200);
    }

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

        return $this->successResponse(['user' => $user_info], 200);
    }

    public function checkPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required'
        ]);

        $check = Hash::check($request->old_password, auth()->user()->password);

        if ($check) {
            return $this->successMessage('password match', 200);
        }

        return $this->errorMessage('password does not match', 404);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        auth()->user()->update(['password' => Hash::make($request->password)]);

        $this->successMessage('password has been updated successful', 200);
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

        return $this->successResponse(['user' => $userInfo], 200);
    }
}
