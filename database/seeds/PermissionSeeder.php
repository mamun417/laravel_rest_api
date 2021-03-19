<?php

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
        $modules = $this->modules();

        foreach ($modules as $module) {
            foreach ($module['permissions'] as $permission) {
                Permission::create([
                    'name' => $permission . ' ' . $module['name'],
                    'module_name' => $module['name'],
                    'guard_name' => 'api',
                ]);
            }
        }
    }

    private function modules(): array
    {
        return [
            [
                'name' => 'home',
                'permissions' => [
                    'view'
                ]
            ],
            [
                'name' => 'product',
                'permissions' => [
                    'list',
                    'create',
                    'update',
                    'delete',
                    'status',
                ]
            ],
            [
                'name' => 'skill',
                'permissions' => [
                    'list',
                    'create',
                    'delete'
                ]
            ],
            [
                'name' => 'ecommerce',
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
                'name' => 'pdf',
                'permissions' => [
                    'preview',
                    'download'
                ]
            ],
        ];

    }
}
