<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ValueObjects\AccountId;

// Data Transfer objects not used in this case: see remarks below
use App\DataTransferObjects\PortfolioData;
use App\DataTransferObjects\PositionData;

use App\Models\Portfolio;
use App\Models\Position;

use App\ViewModels\GetPortfolioViewModel;

use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function index(Request $request): Response
    {		
       $user = Auth::user();
		 
       $accountId1 = $request->accountId;
		
       $accountId2 = AccountId::from($accountId1);
		
       $securitiesAccountId = $accountId2->securitiesAccountId();
		
       // I could use Data Transfer objects here
       $portfolio =  Portfolio::where('securitiesAccountId',$securitiesAccountId)->first();
		
       // I could use Data Transfer objects here and paginate
       $positionsCollection =  (!is_null($portfolio)) ? $portfolio->positions()->get() : null;
				
       return Inertia::render('Portfolio/Index', [
          'viewModel' => new GetPortfolioViewModel($user,$securitiesAccountId,$portfolio,$positionsCollection)
       ]);
    }
	
    public function position(Request $request) :Response
    {
       $user = Auth::user();
		 
       $accountId1 = $request->accountId;
		
       $accountId2 = AccountId::from($accountId1);
		
       $securitiesAccountId = $accountId2->securitiesAccountId();
		
       // I could use Data Transfer objects here
       $portfolio =  Portfolio::where('securitiesAccountId',$securitiesAccountId)->first();
		
       $positionId = (int)$request->positionId;
		
       // I could use Data Transfer objects here	
       $position = Position::where([
			['id',$positionId],
			['portfolio_id',(int)$portfolio->id],
		   ])->first();
		
	return Inertia::render('Portfolio/Position', [
            'viewModel' => new GetPortfolioViewModel($user,$securitiesAccountId,$portfolio,$position)
        ]);
    }
}
