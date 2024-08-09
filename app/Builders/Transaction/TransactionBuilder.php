<?php

namespace App\Builders\Transaction;

use App\ValueObjects\AccountId;
use App\Enums\TransactionTypeName;

use App\Filters\TransactionsDateFilter;

use App\DataTransferObjects\TransactionsData;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

// note: all class methods below could be built to return the $this return type or static return type 
class TransactionBuilder extends Builder
{
    
	public function transactions(string $securitiesAccountId): Collection
	{
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		return DB::table('transactions')
					->where('account_id',$securitiesAccountId)
					->latest()
					->get()
					->map(fn (object $data) => TransactionsData::fromArray((array) $data));					
	}
	
	public function whereBetween(string $securitiesAccountId,TransactionsDateFilter $dateFilter): Collection
	{
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
							
		$fromTradingDateString = $dateFilter->fromTradingDateString;
		
		$toTradingDateString   = $dateFilter->toTradingDateString;
			
			return DB::table('transactions')
					->where('account_id',$securitiesAccountId)
					->whereBetween('valutaDate', [$fromTradingDateString,$toTradingDateString])
					->latest()
					->get()
					->map(fn (object $data) => TransactionsData::fromArray((array) $data));				
	}
	
	public function thisWeek(string $securitiesAccountId): Collection
	{
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		$firstWeekdayFormatted = date('Y-m-d', strtotime("this week"));
		
		$todayFormatted = date('Y-m-d', strtotime("today"));
		
		return DB::table('transactions')
					->where('account_id',$securitiesAccountId)
					->whereBetween('valutaDate', [$firstWeekdayFormatted,$todayFormatted])
					->latest()
					->get()
					->map(fn (object $data) => TransactionsData::fromArray((array) $data));							
	}

	public function thisMonth(string $securitiesAccountId): Collection
	{
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		$monthFirstDayFormatted = date('Y-m-01');
		
		$todayFormatted = date('Y-m-d', strtotime("today"));
		
		return DB::table('transactions')
					->where('account_id',$securitiesAccountId)
					->whereBetween('valutaDate', [$monthFirstDayFormatted,$todayFormatted])
					->latest()
					->get()
					->map(fn (object $data) => TransactionsData::fromArray((array) $data));				
	}
	
	public function thisYear(string $securitiesAccountId): Collection
	{
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		$yearFirstDayFormatted = date('Y-01-01');
		
		$todayFormatted = date('Y-m-d', strtotime("today"));
		
		return DB::table('transactions')
					->where('account_id',$securitiesAccountId)
					->whereBetween('valutaDate', [$yearFirstDayFormatted,$todayFormatted])
					->latest()
					->get()
					->map(fn (object $data) => TransactionsData::fromArray((array) $data));				
	}

	public function byTransactionType(string $securitiesAccountId,TransactionTypeName $enumType): Collection
	{
		
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		$enumSelected = TransactionTypeName::tryFrom($enumType);
			
		if (!$enumSelected) {
			throw new Exception('the transaction type name is unknown, it does not match: purchase, sale,
 			                     delivery, deposit or maturity');
		}

		return DB::table('transactions')
					->where('account_id',$securitiesAccountId)
					->where('transactionType_name',$enumSelected->value)
					->latest()
					->get()
					->map(fn (object $data) => TransactionsData::fromArray((array) $data));					
	}
}
	
