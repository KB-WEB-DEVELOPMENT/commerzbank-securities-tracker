<?php

namespace Database\Factories;

use App\Models\Account;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array 
    {	
       $account = Account::factory()->create();
		
	return [		
	   'links_next_href' => 'links next_href string text',
	   'links_previous_href' => 'links previous href string text',
	   'accruedInterest_amount' => fake()->randomFloat(2,200,2000) ,
	   'accruedInterest_currency' => 'EUR',
	   'blockInfo_blockText' => 'block Info block Text string text',
	   'blockInfo_blockTo' => 'block Info block To string text',
	   'bookingDate' => fake()->date('Y-m-d'),
	   'cancellationInfo_cancelledTransactionId' => 'cancellation Info cancelled Transaction Id string text',
	   'cancellationInfo_isCancelation' => fake()->boolean(),
	   'costs_costDescription' => 'costs cost Description string text',
	   'costs_money_amount' => fake()->randomFloat(2,200,2000),
	   'costs_money_currency' => 'EUR',
	   'depository' => 'depository string text',
	   'exchangeRate' => 1,
	   'price_amount' => fake()->randomFloat(2,200,2000),
	   'price_unit' => 'EUR',
	   'masterdata_isin' => fake()->regexify('[0-9]{12,13}'),
	   'masterdata_wkn' => fake()->regexify('[A-Z0-9][^IO]{6}'),
	   'masterdata_name' => 'Commerzbank AG',
	   'masterdata_notationType' => 'Piece',
	   'size_amount' => fake()->randomFloat(2,200,2000),
	   'size_unit' => 'EUR',
	   'tradingDate' => fake()->date('Y-m-d'),
	   'tradingPlatform' => 'trading Platform string text',
	   'tradingTimestamp' => '2021-10-04T10:32:08', 	
	   'transactionId' => 'transaction Id string text',
	   'transactionType_id' => 'transaction Type id string text',
	   'transactionType_name' => fake()->randomElements(['purchase','sale','delivery','deposit','maturity']),	
	   'valutaDate' => '2024-01-01',
	   'settlementAccount' => '100000000000EUR', 
	   'settlementAccountRef_description' => 'settlement Account Ref description string text',
	   'settlementAccountRef_iban' => fake()->regexify('[DE]{2}([0-9a-zA-Z]{20}'),
	   'settlementAccountRef_currency' => 'EUR',
	   'marketValue_amount' => fake()->randomFloat(2,200,2000),
	   'marketValue_currency' => 'EUR',
	   'actualAmount_amount' => fake()->randomFloat(2,200,2000),
	   'actualAmount_currency' => 'EUR',
	   'externalOrderNumber' => 'external OrderNumber string text',
	   'settlementNumber' => 'settlement Number string text',
	   'executionNumber' => 'execution Number string text',
	   'clientOrderId' => 'client Order Id string text',
	   'transactionDetailedType' => 'transaction Detailed Type string text',
	   'taxes_taxType' => 'taxes taxType string text',
	   'taxTypeDescription' => 'tax Type Description string text',
	   'taxes_amount_amount' => fake()->randomFloat(2,200,2000),
	   'taxes_amount_currency' => 'EUR',
	   'account_id' =>  $account->securitiesAccountId,
	 ];	
     }
}	
