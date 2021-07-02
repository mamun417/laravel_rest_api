<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\ApiController;
use App\PermissionModule;

class PermissionController extends ApiController
{
    public function permissionModules(): \Illuminate\Http\JsonResponse
    {
        $permission_modules = PermissionModule::query()
            ->with('permissions')
            ->get()
            ->sortByDesc(function ($permission_module) {
                return $permission_module->permissions()->count();
            })
            ->values();

        return $this->successResponse(['permission_modules' => $permission_modules]);
    }
}
