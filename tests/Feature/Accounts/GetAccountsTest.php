<?php

namespace Tests\Feature\Accounts;

use App\Models\User;
use App\Models\Account;

use Illuminate\Foundation\Testing\RefreshDatabase;

class GetAccountsTest
{
    use RefreshDatabase;

    /** @test */
    public function it_should_display_the_security_accounts():void
    {
        $user = User::factory()->create();
        
	$this->actingAs($user);
		
	$account = Account::factory()->create([
            'user_id' => $user->id,
        ]);
		
	$securitiesAccountId = $account->securitiesAccountId;
		
	$response = $this->get('/accounts');
     
        $response->assertSee('Access your portfolio for each of your security acccounts')->assertSee($securityAccountId);
    }
}
