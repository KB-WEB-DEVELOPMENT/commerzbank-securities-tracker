<?php

namespace Database\Seeders;

use App\Models\Account;
 
use Illuminate\Database\Seeder;
 
class AccountSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Account::factory()->count(3)->create();
    }
}
