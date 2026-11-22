<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'name'           => 'Rizal Pratama',
                'email'          => 'rizal@kayuhan.com',
                'password'       => Hash::make('password123'),
                'role'           => 'employee',
                'monthly_salary' => 1000000,
                'is_active'      => 1,
            ],
            [
                'name'           => 'Faozan Hakim',
                'email'          => 'faozan@kayuhan.com',
                'password'       => Hash::make('password123'),
                'role'           => 'employee',
                'monthly_salary' => 900000,
                'is_active'      => 1,
            ],
            [
                'name'           => 'Dimas Saputra',
                'email'          => 'dimas@kayuhan.com',
                'password'       => Hash::make('password123'),
                'role'           => 'employee',
                'monthly_salary' => 900000,
                'is_active'      => 1,
            ],
        ];

        foreach ($employees as $emp) {
            User::updateOrCreate(['email' => $emp['email']], $emp);
        }
    }
}