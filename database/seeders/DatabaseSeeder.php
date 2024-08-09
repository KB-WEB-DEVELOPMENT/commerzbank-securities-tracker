<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use App\Models\Portfolio;
use App\Models\Position;
use App\Models\Transaction;
 
use Illuminate\Database\Seeder;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
		$this->call([
			  
			$user = User::factory()->make([
				'email' => 'demo@commerzbank.com',
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
			]),
			$account = Account::factory()->make([
				'user_id' => $user->id,
			]),
			$portfolio = Portfolio::factory()->make([
				'account_id' => $account->securitiesAccountId,
			]),
			$position = Position::factory()->make([
				'portfolio_id' => $portfolio->id,
			])->count(5),
			$transaction = Transaction::factory()->make([
				'portfolio_id' => $account->securitiesAccountId,
			])->count(5),

			// optionally: UserSeeder::class, AccountSeeder::class, PortfolioSeeder::class, PositionSeeder::class, TransactionSeeder::class,
		]);

    }
}