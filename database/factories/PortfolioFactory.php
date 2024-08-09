<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\Account;

use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioFactory extends Factory
{
    protected $model = Portfolio::class;
	
	public function definition():array
    {       
		$account = Account::factory()->create();
		
		return [
		
			'creationDay' =>  '2024-01-01',
			'effectiveDate' => '2024-01-01',
			'totalValue_amount' => fake()->randomFloat(2,200,2000),
			'totalValue_currency' => 'EUR',
			'account_id' => $account->securitiesAccountId,
		];
    }
}
