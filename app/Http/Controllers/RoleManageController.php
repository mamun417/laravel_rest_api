<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleManageController extends ApiController
{
    public function index()
    {
        $per_page = request()->query('per_page') ?? 10;
        $search = request()->query('search');

        $roles = Role::with('permissions')
            ->latest();

        if ($search) {
            $search = '%' . $search . '%';
            $roles = $roles->where('name', 'like', $search);
        }

        $roles = $roles->paginate($per_page);

        if (request()->query('page') > $roles->lastPage()) {
            return redirect($roles->url($roles->lastPage()) . "&per_page=$per_page&search=$search");
        }

        return $this->successResponse(['roles' => $roles], 200);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'required|array',
            'permissions.*' => 'required',
        ]);

        $role = Role::create(['name' => strtolower($request->name)]);

        $role->syncPermissions($request->input('permissions'));

        return $this->successResponse(['role' => $role]);
    }

    public function show(Role $role): \Illuminate\Http\JsonResponse
    {
        $role->load('permissions');

        return $this->successResponse(['role' => $role]);
    }

    public function update(Request $request, Role $role): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
            'permissions.*' => 'required',
        ]);

        $role->update(['name' => strtolower($request->name)]);

        $role->syncPermissions($request->input('permissions'));

        return $this->successResponse(['role' => $role]);
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'admin') {
            return $this->errorMessage('Admin role could not be delete', 403);
        }

        $role->delete();

        return $this->successResponse(['role' => $role], 200);
    }
}
