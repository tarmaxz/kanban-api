<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BoardCategory;

class BoardCategorySeeder extends Seeder
{
    public function run(): void
    {
        BoardCategory::firstOrCreate(
            ['id' => 1],
            ['board_id' => 1, 'position' => 1, 'name' => 'Simulação']
        );

        BoardCategory::firstOrCreate(
            ['id' => 2],
            ['board_id' => 1, 'position' => 2, 'name' => 'Cadastro']
        );

        BoardCategory::firstOrCreate(
            ['id' => 3],
            ['board_id' => 1, 'position' => 3, 'name' => 'Proposta']
        );

        BoardCategory::firstOrCreate(
            ['id' => 4],
            ['board_id' => 1, 'position' => 4, 'name' => 'Crédito']
        );

        BoardCategory::firstOrCreate(
            ['id' => 5],
            ['board_id' => 1, 'position' => 5, 'name' => 'Assinada']
        );
    }
}
