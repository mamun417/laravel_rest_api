<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\ApiController;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleManageController extends ApiController
{
    public function index()
    {
        $per_page = request()->query('per_page') ?? 5;
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

        return $this->successResponse(['roles' => $roles]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'required|array',
            'permissions.*' => 'required',
        ]);

        $role = Role::create(['name' => strtolower($request->input('name'))]);

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

        $role->update(['name' => strtolower($request->input('name'))]);

        $role->syncPermissions($request->input('permissions'));

        return $this->successResponse(['role' => $role]);
    }

    /**
     * @throws Exception
     */
    public function destroy(Role $role): \Illuminate\Http\JsonResponse
    {
        if ($role->name === 'admin') {
            return $this->errorMessage('Admin role could not be delete', 403);
        }

        $role->delete();

        return $this->successResponse(['role' => $role]);
    }

    public function list(): \Illuminate\Http\JsonResponse
    {
        $roles = Role::with('permissions')
            ->latest()
            ->get();

        return $this->successResponse(['roles' => $roles]);
    }
}
