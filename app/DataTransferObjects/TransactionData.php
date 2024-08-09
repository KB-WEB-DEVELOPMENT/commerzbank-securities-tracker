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
			   [ 'taxType'	=> $data['transactions'][0]['taxDetails']['taxes']['taxType'] ],
			   [ 'taxTypeDescription_de' => $data['transactions'][0]['taxDetails']['taxes']['taxTypeDescription']['de'] ],
			   [ 'taxTypeDescription_en' => $data['transactions'][0]['taxDetails']['taxes']['taxTypeDescription']['en'] ],
			   [ 'amount_amount' => (float)$data['transactions'][0]['taxDetails']['taxes']['amount']['amount'] ],
		           [ 'amount_currency' => $data['transactions'][0]['taxDetails']['taxes']['amount']['currency'] ],
			]);	
						
        return new static(
	    $data['transactions'][0]['accruedInterest']['amount'],
	    $data['transactions'][0]['accruedInterest']['currency'],
	    $data['transactions'][0]['blockInfo']['blockText'],
	    $data['transactions'][0]['blockInfo']['blockTo'],
	    $data['transactions'][0]['bookingDate'],
	    $data['transactions'][0]['cancellationInfo']['cancelledTransactionId'],
	    $data['transactions'][0]['cancellationInfo']['isCancelation'],
	    $data['transactions'][0]['costs']['costDescription'],
	    $data['transactions'][0]['costs']['money']['amount'],
	    $data['transactions'][0]['costs']['money']['currency'],
	    $data['transactions'][0]['depository'],
	    $data['transactions'][0]['exchangeRate'],
	    $data['transactions'][0]['positionId'],
	    $data['transactions'][0]['price']['amount'],
            $data['transactions'][0]['price']['unit'],
	    $data['transactions'][0]['masterdata']['isin'],
	    $data['transactions'][0]['masterdata']['wkn'],
	    $data['transactions'][0]['masterdata']['name'],
	    $data['transactions'][0]['masterdata']['notationType'],
	    $data['transactions'][0]['size']['amount'],
	    $data['transactions'][0]['size']['unit'],
	    $data['transactions'][0]['tradingDate'],
	    $data['transactions'][0]['tradingPlatform'],
	    $data['transactions'][0]['tradingTime'],
            $data['transactions'][0]['transactionId'],
	    $data['transactions'][0]['transactionType']['id'],
	    $data['transactions'][0]['transactionType']['name']],
	    $data['transactions'][0]['valutaDate'],
	    $data['transactions'][0]['settlementAccount'],
	    $data['transactions'][0]['marketValue']['amount'],
	    $data['transactions'][0]['marketValue']['currency'],
	    $data['transactions'][0]['actualAmount_amount'],
	    $data['transactions'][0]['actualAmount_currency'],
	    $data['transactions'][0]['externalOrderId'],
	    $data['transactions'][0]['settlementNumber'],
	    $data['transactions'][0]['executionNumber'],
	    $data['transactions'][0]['clientOrderNumber'],
            $data['transactions'][0]['transactionDetailedType'],				
	    $this->taxes
        );
    }
}
