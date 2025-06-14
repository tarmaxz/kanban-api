<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Colaborador',
            'email' => 'colaborador@example.com',
            'password' => Hash::make('123456'),
            'type_id' => 1
        ]);

        User::create([
            'name' => 'Gerente',
            'email' => 'gerente@example.com',
            'password' => Hash::make('123456'),
            'type_id' => 2
        ]);
    }
}
