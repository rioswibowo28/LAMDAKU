<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@lamdaku.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Penulis user
        User::create([
            'name' => 'Content Writer',
            'username' => 'penulis',
            'email' => 'penulis@lamdaku.com',
            'password' => Hash::make('penulis123'),
            'role' => 'penulis',
            'is_active' => true,
        ]);

        // Sample additional users
        User::create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john@lamdaku.com',
            'password' => Hash::make('password123'),
            'role' => 'penulis',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@lamdaku.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'admin',
            'is_active' => true,
        ]);
    }
}
