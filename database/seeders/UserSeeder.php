<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Colaborador',
                'email' => 'colaborador@example.com',
                'password' => Hash::make('123456'),
                'type_id' => 1
            ]
        );

        User::firstOrCreate(
            ['id' => 2],
            [
            'name' => 'Gerente',
            'email' => 'gerente@example.com',
            'password' => Hash::make('123456'),
            'type_id' => 2
        ]
    );
    }
}
