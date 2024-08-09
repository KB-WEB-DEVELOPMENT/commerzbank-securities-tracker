<?php
 
namespace App\Services\Commerzbank\DataTransferObjects;

use Spatie\LaravelData\Data;

use Illuminate\Support\Collection;

class TransactionsData extends Data
{
    /**
    * @param Collection<int, TransactionData> $transactions
    */
    public function __construct(
       private readonly string $links_next_href,
       private readonly string $links_previous_href,
       #[Regex('/^[0-9]{12,13}$/')]
       private readonly string $securitiesAccountId,
       private readonly Collection $transactions
    ) {}

    public static function fromArray(array $data): self
    {
       $taxesCollection = collect();
       $transactionsCollection = collect();
		
       foreach ($data['transactions'] as $transaction) {
					
	  $taxes = TaxData::collect([
		    ['taxType' => $transaction['taxDetails']['taxes']['taxType'] ],
		    ['taxTypeDescription_de' => $transaction['taxDetails']['taxes']['taxTypeDescription']['de'] ],
		    ['taxTypeDescription_en' => $transaction['taxDetails']['taxes']['taxTypeDescription']['en'] ],
		    ['amount_amount' => (float)$transaction['taxDetails']['taxes']['amount']['amount'] ],
		    ['amount_currency' => $transaction['taxDetails']['taxes']['amount']['currency'] ],
	           ]);
			
	  $taxesCollection->push($taxes);
			
	  $transaction =  TransactionData::collect([
				 ['accruedInterest_amount' => (float)$transaction['accruedInterest']['amount'] ],
				 ['accruedInterest_currency' => $transaction['accruedInterest']['currency'] ],
				 ['blockInfo_blockText' => $transaction['blockInfo']['blockText'] ],
				 ['blockInfo_blockTo' => $transaction['blockInfo']['blockTo'] ],
				 ['bookingDate' => $transaction['bookingDate'] ],
				 ['cancellationInfo_cancelledTransactionId' => $transaction['cancellationInfo']['cancelledTransactionId'] ],
				 ['cancellationInfo_isCancellation' => $transaction['cancellationInfo']['isCancelation'] ],
				 ['costs_costDescription' => $transaction['costs']['costDescription'] ],
				 ['costs_money_amount' => (float)$transaction['costs']['money']['amount'] ],
				 ['costs_money_currency' => $transaction['costs']['money']['currency'] ],
				 ['depository' => $transaction['depository'] ],
				 ['exchangeRate' => (float)$transaction['exchangeRate'] ],
				 ['positionId' => $transaction['positionId'] ],
				 ['price_amount' => (float)$transaction['price']['amount'] ],
				 ['price_unit' => $transaction['price']['unit'] ],
				 ['masterdata_isin' => $transaction['masterdata']['isin'] ],
				 ['masterdata_wkn' => $transaction['masterdata']['wkn'] ],
				 ['masterdata_name' => $transaction['masterdata']['name'] ],
				 ['masterdata_notationType' => $transaction['masterdata']['notationType'] ],
				 ['size_amount' => (float)$transaction['size']['amount'] ],
				 ['size_unit' => $transaction['size']['unit'] ],
				 ['tradingDate' => $transaction['tradingDate'] ],
				 ['tradingPlatform' => $transaction['tradingPlatform'] ],
				 ['tradingTime' => $transaction['tradingTime'] ],
				 ['transactionId' => $transaction['transactionId'] ],
				 ['transactionType_id' => $transaction['transactionType']['id'] ],
				 ['transactionType_name' => $transaction['transactionType']['name'] ],
				 ['valutaDate' => $transaction['valutaDate'] ],
				 ['settlementAccount' => (float)$transaction['settlemenAccount'] ],
				 ['marketValue_amount' => $transaction['marketValue']['amount'] ],
				 ['marketValue_currency' => $transaction['marketValue']['currency'] ],
				 ['actualAmount_amount' => (float)$transaction['actualAmount']['amount'] ],
				 ['actualAmount_currency' => $transaction['actualAmount']['currency'] ],
				 ['externalOrderId' => $transaction['externalOrderId'] ],
				 ['settlementNumber' => $transaction['settlementNumber'] ],
				 ['executionNumber' => $transaction['executionNumber'] ],
				 ['clientOrderNumber' => $transaction['clientOrderNumber'] ],
				 ['transactionDetailedType' => $transaction['transactionDetailedType'] ],       				
				 ['taxes' => $taxesCollection ],
			    ]);	
							
		$transactionsCollection->push($transaction);			

	   }
		 	
	   return new static(
	      links_next_href:$data['_links']['next']['href'],
	      links_prev_href:$data['_links']['prev']['href'],
	      securitiesAccountId:$data['securitiesAccountId'],
	      transactions:$transactionsCollection
	   );				
     }	
    
    public function securitiesAccountId(): string 
    {
       return $this->securitiesAccountId;
    }
	
    public function transactions(): Collection
    { 
       return $this->transactions;
    }

    public function transactionsCount(): int
    {
        return count($this->transactions);
    }

    public function linksNextHref(): string
    {
       return $this->links_next_href; 
    }
	
    public function linksPreviousHref(): string
    {
       return $this->links_previous_href; 
    }
		
}
