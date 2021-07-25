<?php

namespace Database\Seeders;

use App\User;
use DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
        DB::statement("SET foreign_key_checks=0");
        DB::table('roles')->truncate(); // first delete old data
        DB::statement("SET foreign_key_checks=1");

        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);

        $admin = User::find(1)->first();

        if ($admin) {
            $admin->assignRole($role);
        }

        // manger role create and assign permission
        $permission_ids = Permission::inRandomOrder()->limit(10)->pluck('id');

        $role_manager = Role::create([
            'name' => 'manager',
            'guard_name' => 'api'
        ]);

        $role_manager->syncPermissions($permission_ids);

        $manager = User::where('email', 'manager@test.com')->first();

        if ($manager) {
            $manager->assignRole($role_manager);
        }
    }
}
