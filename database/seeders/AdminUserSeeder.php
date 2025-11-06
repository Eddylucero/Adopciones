<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // o tu modelo de usuarios
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'anthony.morales4452@utc.edu.ec'],
            [
                'name' => 'Anthony M.',
                'password' => Hash::make('anthoo123'),
                'role' => 'admin', // solo si tu tabla tiene columna 'role'
            ]
        );
    }
}
