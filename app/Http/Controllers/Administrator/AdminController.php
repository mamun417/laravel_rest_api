<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends ApiController
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

        return $this->successResponse(['users' => $users]);
    }

    public function store(AdminRequest $request)
    {
        DB::beginTransaction();

        try {
            $has_pass = Hash::make($request->password);

            $user = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $has_pass,
            ]);

            $user->syncRoles($request->type);

            DB::commit();
            return back()->with('success', 'Admin Successfully Created');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
