<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    
	protected $model = Account::class;
	
	public function definition():array
    {	
		$user = User::factory()->create();
		
		$fake_securities_account_id = (string)fake()->numberBetween(100000000000,9999999999999);
		$fake_pseudonymized_account_id = 'pseudomized_' . $fake_securities_account_id; 
		
		return [
            'pseudonymizedAccountId' => $fake_pseudonymized_account_id,
            'securitiesAccountId' => $fake_securities_account_id,
            'user_id' => $user->id,
        ];		
	}		
}
