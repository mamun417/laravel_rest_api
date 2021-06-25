<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('id', 1)->first();

        if (!$admin) {
            User::create([
                'name' => 'Admin Name',
                'email' => 'admin@test.com',
                'address' => 'Dhaka',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);
        }

        // create manager
        $manager_email = 'manager@test.com';
        $manager = User::where('email', $manager_email)->first();

        if (!$manager) {
            User::create([
                'name' => 'Manager Name',
                'email' => $manager_email,
                'address' => 'Dhaka',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);
        }


        factory(User::class, 5)->create();
    }
}
