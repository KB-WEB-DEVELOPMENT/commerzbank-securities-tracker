<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\Portfolio;

use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    
	protected $model = Position::class;
	
	public function definition(): array 
    {
		$portfolio = Portfolio::factory()->create();
		
		return [
			'accruedInterest_amount' => fake()->randomFloat(2,200,2000),
			'accruedInterest_currency' => 'EUR',
			'currentPrice_amount' => fake()->randomFloat(2,200,2000),
			'currentPrice_unit' => 'EUR',
			'exchangeRate' => 1,
			'exchangeRateDate' => '1999-01-01',
			'quoteDate' => '1999-01-01',
			'initialPrice_amount' => fake()->randomFloat(2,200,2000),
			'initialPrice_unit' => 'EUR',
			'initialExchangeRate' => 1,
			'lastTradeDate' => '2024-01-01',
			'payedAccruedInterest_amount' => fake()->randomFloat(2,200,2000),
			'payedAccruedInterest_currency' => 'EUR',		
			'payout_amount' => fake()->randomFloat(2,200,2000),
			'payout_currency' => 'EUR',
			'payoutId' => (string)fake()->numberBetween(1001,1999),
			'quantity_amount' => fake()->randomFloat(2,200,2000),
			'quantity_unit' => 'EUR',
			'masterdata_position_isin' => fake()->regexify('[0-9]{12,13}'),
			'masterdata_position_wkn' =>  fake()->regexify('[A-Z0-9][^IO]{6}'),
			'portfolio_id' => $portfolio->id,
        ];	
    }
}