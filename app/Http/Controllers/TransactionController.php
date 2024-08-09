<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\ValueObjects\AccountId;

// not used in this case - see remarks below
use App\DataTransferObjects\TransactionsData;
use App\DataTransferObjects\TransactionData;

use App\Models\Account;
use App\Models\Transaction;

use App\ViewModels\GetTransactionsViewModel;

use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function transactions(Request $request):Response
    {
        $user = Auth::user();
		 
	$accountId1 = $request->accountId;
		
	$accountId2 = AccountId::from($accountId1);
		
	$securitiesAccountId = $accountId2->securitiesAccountId();
		
	// I could use Data Transfer objects here and paginate
	$unsortedTransactionsCollection = Account::where('securitiesAccountId',$securitiesAccountId)->transactions()->get();
		
	$sortedTransacCollection =  $unsortedTransactionsCollection->sortByDesc(function ($item) {
						return strtotime($item->tradingDate);
				    })->values()->all();

	return Inertia::render('Transactions/Index', [
            'viewModel' => new GetTransactionsViewModel($user,$securitiesAccountId,$sortedTransacCollection)
        ]);
    }
	
    public function sortAccruedInterest(Request $request):Response
    {
       $user = Auth::user();
		 
       $accountId1 = $request->accountId;
		
       $accountId2 = AccountId::from($accountId1);
		
       $securitiesAccountId = $accountId2->securitiesAccountId();
		
       return Inertia::render('Transactions/AccruedInterest', [
            'viewModel' => new GetTransactionsViewModel($user,$securitiesAccountId)
       ]);
     }

    public function sortTypeCount(Request $request):Response
    {
       $user = Auth::user();
		 
       $accountId1 = $request->accountId;
		
       $accountId2 = AccountId::from($accountId1);
		
       $securitiesAccountId = $accountId2->securitiesAccountId();
		
       return Inertia::render('Transactions/Type', [
            'viewModel' => new GetTransactionsViewModel($user,$securitiesAccountId)
       ]);
      }	

    public function sortWeek(Request $request):Response
    {
       $user = Auth::user();
		 
       $accountId1 = $request->accountId;
		
       $accountId2 = AccountId::from($accountId1);
		
       $securitiesAccountId = $accountId2->securitiesAccountId();
		
        return Inertia::render('Transactions/Week', [
           'viewModel' => new GetTransactionsViewModel($user,$securitiesAccountId)
        ]);
     }	

    public function sortMonth(Request $request):Response
    {
        $user = Auth::user();
		 
	$accountId1 = $request->accountId;
		
	$accountId2 = AccountId::from($accountId1);
		
	$securitiesAccountId = $accountId2->securitiesAccountId();
		
	return Inertia::render('Transactions/Month', [
            'viewModel' => new GetTransactionsViewModel($user,$securitiesAccountId)
        ]);
     }	

    public function sortYear(Request $request):Response
    {
       $user = Auth::user();
		 
       $accountId1 = $request->accountId;
		
       $accountId2 = AccountId::from($accountId1);
		
       $securitiesAccountId = $accountId2->securitiesAccountId();
		
       return Inertia::render('Transactions/Year', [
          'viewModel' => new GetTransactionsViewModel($user,$securitiesAccountId)
       ]);	
    }	
	
     public function transaction(Request $request):Response
     {
        $user = Auth::user();
		 
	$accountId1 = $request->accountId;
		
	$accountId2 = AccountId::from($accountId1);
		
	$securitiesAccountId = $accountId2->securitiesAccountId();
		
	$account = Account::where('securitiesAccountId',$securitiesAccountId)->first();
		
	$transactionId = (int)$request->transactionId;
		
	// I could use Data Transfer objects here	
	$transaction = Transaction::where([
			  ['id',$transactionId],
			  ['account_id',$securitiesAccountId],
			])->first();
		
	return Inertia::render('Transactions/Transaction', [
            'viewModel' => new GetTransactionsViewModel($user,$securitiesAccountId,$transaction)
        ]);
      }
}
