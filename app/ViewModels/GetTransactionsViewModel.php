<?php

namespace App\ViewModels;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Account;

use App\Builders\Transaction\TransactionBuilder;

use App\Collections\TransactionsCollection;

use Illuminate\Database\Eloquent\Collection;

class GetTransactionsViewModel extends ViewModel
{
    public function __construct(
		private User $user,
		private string $securitiesAccountId,
		private ?Collection $transactionsCollection = null,
		private ?Transaction $transaction = null,		
	){}
	
	public function sortTransactionsByAccruedInterestAmountDesc(): ?Collection
    {				
		$transactionsCollection = new TransactionsCollection();
	  
		return $transactionsCollection->sortTransactionsByAccruedInterestAmountDesc($this->securitiesAccountId);	  
	}
		
	public function sortTransactionsByTypeCountDesc(): ?Collection
    {				
		$transactionsCollection = new TransactionsCollection();
		
		return $transactionsCollection->sortTransactionsByTypeCountDesc($this->securitiesAccountId);
	}

	public function thisWeek(): ?Collection
    {				
		$transactionBuilder = new TransactionBuilder();

		return $transactionBuilder->thisWeek($this->securitiesAccountId);
	}

	public function thisMonth(): ?Collection
    {				
		$transactionBuilder = new TransactionBuilder();

		return $transactionBuilder->thisMonth($this->securitiesAccountId);
	}

	public function thisYear(): ?Collection
    {				
		$transactionBuilder = new TransactionBuilder();

		return $transactionBuilder->thisYear($this->securitiesAccountId);
	}
	
	public function transaction(): ?Transaction
    {				
		return $this->transaction;
	}	
}