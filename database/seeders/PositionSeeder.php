<?php

namespace Database\Seeders;

use App\Models\Position;
 
use Illuminate\Database\Seeder;
 
class PositionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Position::factory()->count(3)->create();
    }
}