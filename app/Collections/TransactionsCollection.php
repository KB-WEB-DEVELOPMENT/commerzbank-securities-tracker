<?php

namespace App\Collections;

use App\Models\Transaction;

use Illuminate\Database\Eloquent\Collection;

class TransactionsCollection extends Collection
{
    // for demonstration purposes, we assume all amounts are expressed in the same currency
	public function sortTransactionsByAccruedInterestAmountDesc(string $securitiesAccountId) : ?Collection
    {		
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		$transactionsCollection = Transaction::where('account_id',$securitiesAccountId)->get();
		
		if ($transactionsCollection->isEmpty()) {
				return null;
		}
		
		if ($transactionsCollection->count() == 1) {
				return $transactionsCollection;
		}	

		$sorted = 	$transactionsCollection->sortByDesc([
						fn (array $transacArray1, array $transacArray2) 
							=> $transacArray1['accruedInterest_amount'] <=> $transacArray2['accruedInterest_amount']
					]);		
		
		return $sorted->values()->all();
	}

	public function sortTransactionsByTypeCountDesc(string $securitiesAccountId) : ?Collection
    {		
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();

		$unsortedTransactionsCollection = DB::table('transactions')
												->where('account_id','=',$securitiesAccountId)	
												->select(DB::raw('count(transactionType_name) as transactionType_count'))	
												->groupBy('transactionType_name')		
												->get();
												
		if ($unsortedTransactionsCollection->isEmpty()) {
			return null;
		}
		
		if ($unsortedTransactionsCollection->count() == 1) {
			return $unsortedTransactionsCollection;
		}
		
		$sorted = $unsortedTransactionsCollection->sortByDesc([
			fn (array $a, array $b) => $a['transactionType_count'] <=> $b['transactionType_count'],
		]);

		return $sorted->values()->all();	
	}
}
