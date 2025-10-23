<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Usuário Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@teste.com',
            'password' => Hash::make('Admin123!'), // senha segura
            'role' => 'admin',
        ]);

        // Usuário comum 1
        User::create([
            'name' => 'Usuário 1',
            'email' => 'user1@teste.com',
            'password' => Hash::make('User123!'),
            'role' => 'user',
        ]);

        // Usuário comum 2
        User::create([
            'name' => 'Usuário 2',
            'email' => 'user2@teste.com',
            'password' => Hash::make('User123!'),
            'role' => 'user',
        ]);
    }
}
