<?php

namespace App\Services\Commerzbank;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

use App\Models\User;

class AccountService
{
    public function __construct(
		private readonly string $access_token,
		private readonly string $uri,
		private readonly int $timeout
    ){}

	public function securitiesAccountIds(): array|void
    {
        // note: the auth middleware checks that the user is logged in.							
		
		$json_url = $this->uri;		
	    
		$options =  array(
						'http' => array(
									'method' => 'GET',
									'header' => 'Authorization: Bearer ' . $this->access_token,
									'timeout' => $this->timeout
								),
					);	

		$context = stream_context_create($options);
		
		$json = file_get_contents($json_url,false,$context);
		
		$accountDataArray = json_decode($json,TRUE);
		
		$securitiesAccountIds = [];

		$securitiesAccountIds = collect($accountDataArray)->pluck('securitiesAccountIds.securitiesAccountId')->toArray();
		
		$user = Auth::user();	
	
		$userAccountIds = [];
		
		$userAccountIds = (array)$user->accounts; 
		
		if (count(array_diff($securitiesAccountIds,$userAccountIds)) > 0) {
			return redirect()->route('dashboard');
		}	
			
		return $securitiesAccountIds;
	}

}
