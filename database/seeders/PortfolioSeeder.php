<?php

namespace Database\Seeders;

use App\Models\Portfolio;
 
use Illuminate\Database\Seeder;
 
class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Portfolio::factory()->count(3)->create();
    }
}