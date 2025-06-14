<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BoardCard;

class BoardCardSeeder extends Seeder
{
    public function run(): void
    {
        BoardCard::firstOrCreate(
            ['id' => 1],
            ['board_category_id' => 1, 'position' => 1, 'name' => 'Card - Ronaldo', 'user_id' => 1]
        );

        BoardCard::firstOrCreate(
            ['id' => 2],
            ['board_category_id' => 1, 'position' => 2, 'name' => 'Card - Maria', 'user_id' => 1]
        );

        BoardCard::firstOrCreate(
            ['id' => 3],
            ['board_category_id' => 2, 'position' => 2, 'name' => 'Card - Zalia', 'user_id' => 2]
        );
    }
}
