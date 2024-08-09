<?php
 
namespace App\Services\Commerzbank\DataTransferObjects;

use Spatie\LaravelData\Data;

use Illuminate\Support\Collection;

class PortfolioData extends Data 
{
    
	/**
	* @param Collection<int, PositionData> $positions
	*/
	public function __construct(
		#[DateFormat('Y-m-d')]
		private readonly string $creationDay,
		#[DateFormat('Y-m-d')]
		private readonly string $effectiveDate,
		private readonly Collection $positions,
		#[Regex('/^[0-9]{12,13}$/')]
		private readonly string $securitiesAccountId,
		#[Min(0)]
		private readonly float  $totalValue_amount,
		private readonly string $totalValue_currency
    ) {}

    public static function fromArray(array $data): self
    {       
		$positionsCollection = collect();
		
		foreach ($data['positions'] as $position) {
					
			$position = PositionData::collect([
				['accruedInterest_amount' => (float)$position['accruedInterest']['amount'] ],
				['accruedInterest_currency' => $position['accruedInterest']['amount'] ],
				['currentPrice_amount' => (float)$position['accruedInterest']['amount'] ],
				['currentPrice_unit' => $position['accruedInterest']['unit'] ],
				['exchangeRate' => (float)$position['exchangeRate'] ],
				['quoteDate' => $position['quoteDate'] ],
				['initialPrice_amount' => (float)$position['initialPrice']['price']['amount'] ],
				['initialPrice_unit' => $position['initialPrice']['price']['unit'] ],
				['initialExchangeRate' => (float)$position['initialPrice']['initialExchangeRate'] ],
				['lastTradeDate' => $position['lastTradeDate'] ],
				['payedAccruedInterest_amount' => (float)$position['payedAccruedInterest']['amount'] ],
				['payedAccruedInterest_currency' => $position['payedAccruedInterest']['currency'] ],
				['payout_amount' => (float)$position['payout']['amount'] ],
				['payout_currency' => $position['payout']['currency'] ],
				['positionId' => $position['positionId'] ],
				['quantity_amount' => (float)$position['quantity']['amount'] ],
				['masterdata_position_isin' => $position['masterdata']['securitiesMasterdata']['isin'] ],
				['masterdata_position_wkn' => $position['masterdata']['securitiesMasterdata']['wkn'] ],
				['masterdata_position_name' => $position['masterdata']['securitiesMasterdata']['name'] ],
				['masterdata_position_notationType' => $position['masterdata']['securitiesMasterdata']['notationType'] ],
				['masterdata_currency' => $position['currency'] ],
				['masterdata_maturityDate' => $position['maturityDate'] ],
				['masterdata_vote' => $position['vote'] ],
			]);
			
			$positionsCollection->push($position);
		}	
		
		return new static(
			$data['creationDay'],
			$data['effectiveDate'],
			$positionsCollection,
			$data['securitiesAccountId'],
			(float)$data['totalValue']['amount'],
			$data['totalValue']['currency']
		);
    }
	
	public function securitiesAccountId(): string
    {
		return $this->securitiesAccountId;
    }

	public function positions(): Collection
    {
		return $this->positions;
    }

}
