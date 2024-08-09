<?php

namespace App\Collections;

use App\ValueObjects\AccountId;

use App\Models\Portfolio;
use App\Models\Position;

use Illuminate\Database\Eloquent\Collection;

class PortfolioCollection extends Collection
{
  public function averagePayoutPerPosition(string $securitiesAccountId) : float
  {		
     $accountId = AccountId::from($securitiesAccountId);
		
     $securitiesAccountId = $accountId->securitiesAccountId();
	
     $portfolio = Portfolio::where('securitiesAccountId',$securitiesAccountId)->first();
  
     if (!$portfolio) {
        return 0;
     }

     $positions = $portfolio->positions;

     if (!$positions) {
        return 0;
     }		
  
     $positionsCollection = ($positions instanceof Collection) ? $positions : collect($positions);
  
     //for demonstration purposes, we assume all payouts are in the same currency
     $totalPayoutsAmount = (float)$positionsCollection->sum('payout_amount'); 
  
     $payoutsCount = (int)$positionsCollection->count();
  
     $averagePayoutPerPosition = (float)round($totalPayoutsAmount / $payoutsCount,2);
		
     return $averagePayoutPerPosition;
  }
}
