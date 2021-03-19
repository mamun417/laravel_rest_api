<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);

        $admin = User::where('email', 'admin@test.com')->first();

        if ($admin) {
            $admin->assignRole($role);
        }
    }
}
