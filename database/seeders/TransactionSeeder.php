<?php

namespace Database\Seeders;

use App\Models\Transaction;
 
use Illuminate\Database\Seeder;
 
class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Transaction::factory()->count(3)->create();
    }
}