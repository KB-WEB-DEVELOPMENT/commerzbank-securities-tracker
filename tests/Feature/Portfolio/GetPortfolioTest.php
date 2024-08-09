<?php

namespace Tests\Feature\Porfolio;

use App\Models\User;
use App\Models\Account;
use App\Models\Portfolio;
use App\Models\Position;

use Illuminate\Foundation\Testing\RefreshDatabase;

class GetPortfolioTest
{
    use RefreshDatabase;

    /** @test */
    public function it_should_display_the_portfolio():void
    {
        $user = User::factory()->create();
				
	$account = Account::factory()->create([
            'user_id' => $user->id,
        ]);
		
	$portfolio =  Portfolio::factory()->create([
            'securitiesAccountId' => $account->securitiesAccountId,
        ]);
		
	$position1 = Position::factory()->create([
            'portfolio_id' => $portfolio->id,
        ]);
		
	$position2 = Position::factory()->create([
            'portfolio_id' => $portfolio->id,
        ]);
		
	$position3 = Position::factory()->create([
            'portfolio_id' => $portfolio->id,
        ]);
				
	$portfolio_amount = $portfolio->totalValue_amount; 
		
	$portfolio_url = '/accounts/' . $account->securitiesAccountId . '/portfolio';

	$this->actingAs($user);
		
	$response = $this->get($portfolio_url);
		
	$response->assertSee('Portfolio Details')->assertSee($portfolio_amount);	
    }

    public function it_should_display_the_portfolio_position():void
    {
       $user = User::factory()->create();
				
       $account = Account::factory()->create([
            'user_id' => $user->id,
        ]);
		
	$portfolio =  Portfolio::factory()->create([
            'securitiesAccountId' => $account->securitiesAccountId,
        ]);
		
	$position = Position::factory()->create([
            'portfolio_id' => $portfolio->id,
        ]);
		
	$isin_position_string = 'Position ISIN: ' . $position->masterdata_position_isin;
				
	$position_url = '/accounts/' . $account->securitiesAccountId . '/portfolio/positions/' . $position->id;
				
	$response = $this->get($position_url);		
		
	$response->assertSee('Portfolio Position Details')->assertSee($isin_position_string);	
    }
}
