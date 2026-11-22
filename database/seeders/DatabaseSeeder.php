<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@kayuhan.com'],
            [
                'name'           => 'Admin',
                'password'       => Hash::make('password123'),
                'role'           => 'admin',
                'monthly_salary' => 1200000,
                'is_active'      => 1,
            ]
        );

        if (class_exists(MenuSeeder::class)) {
            $this->call(MenuSeeder::class);
        }
    }
}