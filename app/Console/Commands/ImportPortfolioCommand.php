<?php

namespace App\Console\Commands;

use App\Services\PortfolioService;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportPortfolioCommand extends Command
{
    protected $signature = 'portfolio:import';
    protected $description = 'Oversimplified command example: calls local version of user Commerzbank portfolio API from local 
	                      array file \storage\imports\portfolio.php (does not call Commerzbank API)';

    public function handle():int
    {
        DB::transaction(function () use (PortfolioService $portfolioService) {

	       $portfolio = $portfolioService->portfolio();
						
	        if (!$portfolio) {
			return self::FAILURE;
		}
			
		 /*
		    Next step: store the uploaded $portfolio data with an associated, supplied portfolio id as foreign key
		    in the database
		 */
		
		return self::SUCCESS;	
        });
    }
}
