<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Check the 'admin' role exists
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Use firstOrCreate to prevent errors on re-run
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                // Use env() for a secure password
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
                'email_verified_at' => now(),
            ]
        );


        $adminUser->assignRole($adminRole);
    }
}
