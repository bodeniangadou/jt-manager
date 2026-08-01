<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin JT',
            'email' => 'admin@jt.com',
            'password' => Hash::make('Admin123!'),
            'role' => 'admin',
        ]);

        // Journalistes
        $journalistes = [
            ['name' => 'Marie Dupont', 'email' => 'marie@jt.com'],
            ['name' => 'Jean Martin', 'email' => 'jean@jt.com'],
            ['name' => 'Sophie Dubois', 'email' => 'sophie@jt.com'],
        ];

        foreach ($journalistes as $j) {
            User::create([
                'name' => $j['name'],
                'email' => $j['email'],
                'password' => Hash::make('Journaliste123!'),
                'role' => 'journaliste',
            ]);
        }

        // Visiteur
        User::create([
            'name' => 'Visiteur Test',
            'email' => 'visiteur@test.com',
            'password' => Hash::make('Visiteur123!'),
            'role' => 'visiteur',
        ]);
    }
}