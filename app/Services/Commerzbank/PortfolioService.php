<?php

namespace App\Services\Commerzbank;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

use App\ValueObjects\AccountId;
use App\ValueObjects\FromTradingDate;

use App\Services\Commerzbank\DataTransferObjects\PortfolioData;

use App\Models\User;

class PortfolioService
{
    public function __construct(
		private readonly string $access_token,
		private readonly string $uri,
		private readonly int $timeout
    ){}

	public function portfolioAssetsOverview(string $securitiesAccountId,FromTradingDate $effectiveTradingDate): PortfolioData|void
    {
		// note: the auth middleware checks that the user is logged in.	

		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		$user = Auth::user();

		$userAccounts = [];
		
		$userAccounts = (array)$user->accounts;
		
		$securitiesAccountIds = [];
		
		foreach ($userAccounts as $userAccount) {
			$securitiesAccountIds[] = $userAccount->securitiesAccountId;	
		}

		if (!in_array($securitiesAccountId,$securitiesAccountIds)) {
			return redirect()->route('dashboard');
		}		
												
		$json_url = $this->uri;	
		
		$json_url .= $securitiesAccountId . '/portfolio?effectiveDate=' . $effectiveTradingDate->format();
	    
		$options =  array(
						'http' => array(
									'method' => 'GET',
									'header' => 'Authorization: Bearer ' . $this->access_token,
									'timeout' => $this->timeout
								),
					);		
    
		$context = stream_context_create($options);
		
		$json = file_get_contents($json_url,false,$context);
		
		$portfolioAssetsOverviewArray = json_decode($json,TRUE);
		
		$portfolioData = PortfolioData::fromArray($portfolioAssetsOverviewArray);
		
		return $portfolioData; 
	}

}
