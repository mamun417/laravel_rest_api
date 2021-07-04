<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\ApiController;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends ApiController
{
    public function index()
    {
        $per_page = request()->query('per_page') ?? 10;
        $search = request()->query('search');

        $admins = User::with(['roles', 'permissions'])->whereNotIn('id', [1])->latest();

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
            'permissions' => "nullable|array",
            'permissions.*' => "required|distinct|exists:permissions,id",
        ], [
                //extra messages
            ] + $this->getRoleValidationMessages($request));

        $admin = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $admin->syncRoles($request->input('roles'));
        $admin->syncPermissions($request->input('permissions'));

        return $this->successResponse(['admin' => $admin]);
    }

    public function getRoleValidationMessages($request): array
    {
        $role_ids = implode(",", Role::all()->pluck('id')->toArray());
        $permission_ids = implode(",", Permission::all()->pluck('id')->toArray());

        $roles_validation_messages = [];

        if ($roles = $request->input('roles')) {
            foreach ($roles as $key => $val) {
                $roles_validation_messages['roles.' . $key . '.exists'] = "The selected role $val is invalid. valid ids ($role_ids)";
                $roles_validation_messages['roles.' . $key . '.distinct'] = "The roles $val field has a duplicate value.";
            }
        }

        if ($permissions = $request->input('permissions')) {
            foreach ($permissions as $key => $val) {
                $roles_validation_messages['permissions.' . $key . '.exists'] = "The selected permission $val is invalid. valid ids ($permission_ids)";
                $roles_validation_messages['permissions.' . $key . '.distinct'] = "The permission $val field has a duplicate value.";
            }
        }

        return $roles_validation_messages;
    }

    public function show(User $admin): \Illuminate\Http\JsonResponse
    {
        $admin->load(['roles', 'permissions']);

        return $this->successResponse(['admin' => $admin]);
    }


    public function update(Request $request, User $admin): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => "required|string|max:50",
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'address' => 'nullable',
            'password' => 'required|min:8',
            'roles' => "required|array",
            'roles.*' => "required|distinct|exists:roles,id",
            'permissions' => "nullable|array",
            'permissions.*' => "required|distinct|exists:permissions,id",
        ], [
                //extra messages
            ] + $this->getRoleValidationMessages($request));

        $admin->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $admin->syncRoles($request->input('roles'));
        $admin->syncPermissions($request->input('permissions'));

        return $this->successResponse(['admin' => $admin]);
    }

    /**
     * @throws Exception
     */
    public function destroy(User $admin): \Illuminate\Http\JsonResponse
    {
        $admin->delete();

        return $this->successResponse(['admin' => $admin]);
    }
}
