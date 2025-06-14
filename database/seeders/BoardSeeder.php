<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Board;

class BoardSeeder extends Seeder
{
    public function run(): void
    {
        Board::firstOrCreate(
            ['id' => 1],
            ['name' => 'Esteira de Vendas']
        );
    }
}
