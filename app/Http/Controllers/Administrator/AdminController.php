<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends ApiController
{
    public function index()
    {
        $per_page = request()->query('per_page') ?? 10;
        $search = request()->query('search');

        $admins = User::whereNotIn('id', [1])->latest();

        if ($search) {
            $search = '%' . $search . '%';
            $admins = $admins->where('name', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orWhere('address', 'like', $search);
        }

        $admins = $admins->paginate($per_page);

        if (request()->query('page') > $admins->lastPage()) {
            return redirect($admins->url($admins->lastPage()) . "&per_page=$per_page&search=$search");
        }

        return $this->successResponse(['admins' => $admins]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => "required|string|max:50",
            'email' => 'required|email|unique:users',
            'address' => 'nullable',
            'password' => 'required|min:8',
            'roles' => "required|array",
            'roles.*' => "required|distinct|exists:roles,id",
        ], [
                //extra messages
            ] + $this->getRoleValidationMessages($request));

        $admin = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $admin->assignRole('admin');

        return $this->successResponse(['admin' => $admin]);
    }

    public function getRoleValidationMessages($request): array
    {
        $role_ids = implode(",", Role::all()->pluck('id')->toArray());

        $roles_validation_messages = [];

        foreach ($request->input('roles') as $key => $val) {
            $roles_validation_messages['roles.' . $key . '.exists'] = "The selected role $val is invalid. valid ids ($role_ids)";
            $roles_validation_messages['roles.' . $key . '.distinct'] = "The roles $val field has a duplicate value.";
        }

        return $roles_validation_messages;
    }

    public function update(Request $request, User $admin): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => "required|string|max:50",
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:8',
            'roles' => "required|array",
            'roles.*' => "required",
        ]);

        $admin->update($request->all());

        return $this->successResponse(['user' => $admin]);
    }
}
