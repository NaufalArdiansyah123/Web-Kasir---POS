<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kasir.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Manajer',
            'email' => 'manajer@kasir.com',
            'password' => Hash::make('password'),
            'role' => 'manajer',
        ]);

        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@kasir.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);
    }
}
