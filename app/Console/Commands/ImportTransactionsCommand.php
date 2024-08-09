<?php

namespace App\Console\Commands;

use App\Services\TransactionsService;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTransactionsCommand extends Command
{
    protected $signature = 'transactions:import';
    protected $description = 'Oversimplified command example: calls all newly recorded Commerzbank API transactions from local 
			      array file \storage\imports\transactions.php  (does not call Commerzbank API)';

    public function handle():int
    {
        DB::transaction(function () use (TransactionsService $transactionsService) {

	   $transactions = $transactionsService->transactions();
						
	   if (!$transactions) {
		return self::FAILURE;
	   }	
	
	   /*
	     Next step: store uploaded  $transactions data in the database with an associated, supplied account
	     securities id as foreign key in the database.
	   */
			
	   return self::SUCCESS;	
        });
    }
}
