<?php
 
namespace App\Services\Commerzbank\DataTransferObjects;

use Spatie\LaravelData\Data;

class TransactionData extends Data 
{		    
  /**
  * @param Collection<int, TaxData> $taxes
  */
	
  public function __construct(
	
     #[Min(0)]
     private readonly  float $accruedInterest_amount,
     private readonly string $accruedInterest_currency,
     private readonly string $blockInfo_blockText,
     #[DateFormat('Y-m-d')]
     private readonly string $blockInfo_blockTo,
     #[DateFormat('Y-m-d')]
     private readonly string $bookingDate,
     private readonly string $cancellationInfo_cancelledTransactionId,
     #[BooleanType]
     private readonly bool $cancellationInfo_isCancellation,
     private readonly string $costs_costDescription,
     #[Min(0)]
     private readonly  float $costs_money_amount,
     private readonly string $costs_money_currencvy,
     private readonly string $depository,
     private readonly  float $exchangeRate,
     private readonly string $positionId,
     #[Min(0)]
     private readonly  float $price_amount,
     private readonly string $price_unit,
     #[Regex('/^[A-Z]{2}[-]{0,1}[A-Z0-9]{9}[-]{0,1}[0-9]{1}$/')]
     private readonly string $masterdata_isin,
     #[Regex('/^[A-Z0-9][^IO]{6}$/')]
     private readonly string $masterdata_wkn,
     private readonly string $masterdata_name,
     private readonly string $masterdata_notationType,
     #[Min(0)]
     private readonly  float $size_amount,
     private readonly string $size_unit,
     #[DateFormat('Y-m-d')]
     private readonly string $tradingDate,
     private readonly string $tradingPlatform,
     private readonly string $tradingTime,
     private readonly string $transactionId,
     private readonly string $transactionType_id,
     #[In(['purchase','sale','delivery','deposit','maturity'])]
     private readonly string $transactionType_name,
     #[DateFormat('Y-m-d')]
     private readonly string $valutaDate,
     private readonly string $settlementAccount,
     #[Min(0)]
     private readonly  float $marketValue_amount,
     private readonly string $marketValue_currency,
     #[Min(0)]
     private readonly  float $actualAmount_amount,
     private readonly string $actualAmount_currency,
     private readonly string $externalOrderId,
     private readonly string $settlementNumber,
     private readonly string $executionNumber,
     private readonly string $clientOrderNumber,
     private readonly string $transactionDetailedType,
     private readonly Collection $taxes;
    
   ) {}

    public static function fromArray(array $data): self
    {			
       $this->taxes =  TaxData::collect([
			   ['taxType' => $data['taxDetails']['taxes']['taxType'] ],
			   ['taxTypeDescription_de' => $data['taxDetails']['taxes']['taxTypeDescription']['de'] ],
			   ['taxTypeDescription_en' => $data['taxDetails']['taxes']['taxTypeDescription']['en'] ],
			   ['amount_amount' => (float)$data['taxDetails']['taxes']['amount']['amount'] ],
			   ['amount_currency' => $data['taxDetails']['taxes']['amount']['currency'] ],
		       ]);	
						
       return new static(
            $data['accruedInterest']['amount'],
	    $data['accruedInterest']['currency'],
	    $data['blockInfo']['blockText'],
	    $data['blockInfo']['blockTo'],
	    $data['bookingDate'],
	    $data['cancellationInfo']['cancelledTransactionId'],
	    $data['cancellationInfo']['isCancelation'],
	    $data['costs']['costDescription'],
	    $data['costs']['money']['amount'],
	    $data['costs']['money']['currency'],
	    $data['depository'],
	    $data['exchangeRate'],
	    $data['positionId'],
            $data['price']['amount'],
	    $data['price']['unit'],
	    $data['masterdata']['isin'],
	    $data['masterdata']['wkn'],
	    $data['masterdata']['name'],
	    $data['masterdata']['notationType'],
	    $data['size']['amount'],
	    $data['size']['unit'],
	    $data['tradingDate'],
	    $data['tradingPlatform'],
	    $data['tradingTime'],
	    $data['transactionId'],
	    $data['transactionType']['id'],
	    $data['transactionType']['name']],
            $data['valutaDate'],
            $data['settlementAccount'],
	    $data['marketValue']['amount'],
	    $data['marketValue']['currency'],
	    $data['actualAmount']['amount'],
	    $data['actualAmount']['currency'],
	    $data['externalOrderId'],
	    $data['settlementNumber'],
	    $data['executionNumber'],
	    $data['clientOrderNumber'],
	    $data['transactionDetailedType'],				
	    $this->taxes
       );
    }
}
