<?php

use App\PermissionModule;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('permissions')->truncate(); // first delete old data
        DB::statement("SET foreign_key_checks=1");

        $modules = $this->modules();

        foreach ($modules as $module) {
            $permission_module = PermissionModule::create([
                'name' => $module['name']
            ]);

            foreach ($module['permissions'] as $permission) {
                Permission::create([
                    'permission_module_id' => $permission_module->id,
                    'name' => Str::slug($permission . ' ' . $permission_module->slug),
                    'guard_name' => 'api',
                ]);
            }
        }
    }

    private function modules(): array
    {
        return [
            [
                'name' => 'Home',
                'permissions' => [
                    'view'
                ]
            ],
            [
                'name' => 'Product',
                'permissions' => [
                    'list',
                    'create',
                    'update',
                    'delete',
                    'status',
                ]
            ],
            [
                'name' => 'Skill',
                'permissions' => [
                    'list',
                    'create',
                    'delete'
                ]
            ],
            [
                'name' => 'Ecommerce',
                'permissions' => [
                    'list',
                    'add to cart',
                    'remove from cart',
                    'update cart',
                    'checkout',
                    'coupon apply',
                    'empty cart'
                ]
            ],
            [
                'name' => 'PDF',
                'permissions' => [
                    'preview',
                    'download'
                ]
            ],
        ];

    }
}
