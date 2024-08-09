<?php

namespace Tests\Feature\Transactions;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;

use Illuminate\Foundation\Testing\RefreshDatabase;

class GetTransactionsTest
{
    use RefreshDatabase;

    /** @test */
    public function it_should_display_the_transactions():void
    {
        $user = User::factory()->create();
		
		$this->actingAs($user);
		
		$account = Account::factory()->create([
            'user_id' => $user->id,
        ]);
		
		$transaction1 = Transaction::factory()->create([
            'account_id' => $account->securitiesAccountId,
        ]);
		
		$transaction2 = Transaction::factory()->create([
            'account_id' => $account->securitiesAccountId,
        ]);
		
		$transaction3 = Transaction::factory()->create([
            'account_id' => $account->securitiesAccountId,
        ]);
		
		$booking_date3 = $transaction3->bookingDate;
		
		$transactions_url = '/accounts/' . $account->securitiesAccountId . '/transactions';
				
		$response = $this->get($transactions_url);	

		$response->assertSee('Transactions Summary')->assertSee($booking_date3);
		
    }
	
	public function it_should_display_the_transaction_details():void
    {
        $user = User::factory()->create();
		
		$this->actingAs($user);
		
		$account = Account::factory()->create([
            'user_id' => $user->id,
        ]);
		
		$transaction = Transaction::factory()->create([
            'account_id' => $account->securitiesAccountId,
        ]);
		
		$isin_string = 'ISIN: ' . $transaction->masterdata_isin;
		
		$transaction_url = '/accounts/' . $account->securitiesAccountId . '/transactions/' . $transaction->id;
				
		$response = $this->get($transaction_url);		
		
		$response->assertSee('Transaction Details')->assertSee($isin_string);
		
    }
}
