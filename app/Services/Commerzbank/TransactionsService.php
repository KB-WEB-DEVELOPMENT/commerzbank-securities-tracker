<?php

namespace App\Services\Commerzbank;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

use App\Enums\TransactionTypeName;

use App\ValueObjects\AccountId;
use App\ValueObjects\FromTradingDate;
use App\ValueObjects\ToTradingDate;

use App\Services\Commerzbank\DataTransferObjects\TransactionsData;
use App\Services\Commerzbank\DataTransferObjects\TaxData;

use App\Models\User;

class TransactionsService
{
    public function __construct(
       private readonly string $access_token,
       private readonly string $uri,
       private readonly int $timeout
    ){}

    public function transactions(string $securitiesAccountId, ?TransactionTypeName $enumType=null,
	                         ?string $fromTradingDate=null, ?string $toTradingDate=null,
				 int $limit=25,?int $cursor=null): TransactionsData|void
    {
        // note: the auth middleware checks that the user is logged in.	
		
        $accountId = AccountId::from($securitiesAccountId);
		
        $securitiesAccountId = $accountId->securitiesAccountId(); 
		
        $user = Auth::user();

	$userAccounts = (array)$user->accounts;
		
	$securitiesAccountIds = [];
		
	foreach ($userAccounts as $userAccount) {
		$securitiesAccountIds[] = $userAccount->securitiesAccountId;	
	}

	if (!in_array($securitiesAccountId,$securitiesAccountIds)) {
		return redirect()->route('dashboard');
	}			
										
	$json_url = $this->uri;	
		
	$json_url .= $securitiesAccountId . '/transactions';
		
	$enumSelected = null;
		
	if (!is_null($enumType)) {
	   $enumSelected = TransactionTypeName::tryFrom($enumType);
	}
	    
	if (!$enumSelected) {
		throw new Exception('the transaction type name is unknown, different from: purchase, sale, delivery, deposit or maturity');
	}	
						
	$json_url .= is_null($enumSelected) ? '' : '?transactionTypeName=' . $enumSelected->value;
		
	$json_url .= is_null($fromTradingDate) ? '' : '&fromTradingDate=' . FromTradingDate::from($fromTradingDate)->format();
		
	$json_url .= is_null($toTradingDate) ? '' : '&toTradingDate=' . ToTradingDate::from($toTradingDate)->format();
		
	$json_url .= '&limit=';		
		
	$range1 = range(1,1000);
		
	$json_url .=  in_array($limit,$range1) ? $limit : 25; 
		
	$json_url .= (is_null($cursor)) ? '' : '&cursor=' . $cursor;
				
	$options =  array(
			'http' => array(
				    'method' => 'GET',
				    'header' => 'Authorization: Bearer ' . $this->access_token,
				    'timeout' => $this->timeout
				   ),
		    );			
    
	$context = stream_context_create($options);
		
	$json = file_get_contents($json_url,false,$context);
		
	$transactionsArray = json_decode($json,TRUE);
		
	$transactionsData = TransactionsData::fromArray($transactionsArray);

	return $transactionsData; 
    }
}
