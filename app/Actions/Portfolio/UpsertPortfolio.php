<?php
namespace App\Actions\Portfolio;

use App\ValueObjects\AccountId;

use App\Models\Portfolio;
use App\Models\Position;

use App\DataTransferObjects\PortfolioData;

use App\Services\Commerzbank\PortfolioService;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class UpsertPortfolio
{
    public function __construct(
		private PortfolioService $portfolioService)
    {}

    public function execute(string $securitiesAccountId): void
    {
        
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		$current_date_time = Carbon::now()->toDateTimeString();

		$effectiveDate = Carbon::createFromFormat('Y-m-d',$current_date_time)->toDateTimeString();
				
		$portfolioData = $this->portfolioService->portfolioAssetsOverview($securitiesAccountId,$effectiveDate);

		if ($portfolioData instanceof PortfolioData) {
		
			Portfolio::updateOrCreate(
				['account_id' => $portfolioData->securitiesAccountId()],
				[
					'creationDay' => $portfolioData->creationDay,
					'effectiveDate' => $effectiveDate,
					'totalValue_amount' => (float)$portfolioData->totalValue_amount,
					'totalValue_currency' => $portfolioData->totalValue_currency
				]
			);

		}

		if ($portfolioData->positions() instanceof Collection) {
				
			foreach ($portfolioData->positions() as $position) {
				Position::updateOrCreate(
					[
						'accruedInterest_amount' => (float)$position->accruedInterest_amount,
						'accruedInterest_currency' => $position->accruedInterest_currency,
						'currentPrice_amount' => (float)$position->currentPrice_amount,
						'currentPrice_unit' => $position->currentPrice_unit,
						'exchangeRate' => (float)$position->exchangeRate,
						'exchangeRateDate' => $position->exchangeRateDate,
						'quoteDate' => $position->quoteDate,
						'initialPrice_amount' => (float)$position->initialPrice_amount,
						'initialExchangeRate' => (float)$position->initialExchangeRate,
						'lastTradeDate' => $position->lastTradeDate,
						'payedAccruedInterest_amount' => (float)$position->payedAccruedInterest_amount,
						'payedAccruedInterest_currency' => $position->payedAccruedInterest_currency,
						'payout_amount' => (float)$position->payout_amount,
						'payout_currency' => $position->payout_currency,
						'payoutId' => $position->payoutId,
						'quantity_amount' => (float)$position->quantity_amount,
						'quantity_unit' => $position->quantity_unit,
						'masterdata_position_isin' => $position->masterdata_position_isin,
						'masterdata_position_wkn' => $position->masterdata_position_wkn,
						'masterdata_position_name' => $position->masterdata_position_name,
						'masterdata_position_notationType' => $position->masterdata_position_notationType,
						'masterdata_currency' => $position->masterdata_currency,
						'masterdata_maturityDate' => $position->masterdata_maturityDate,
						'masterdata_vote' => $position->masterdata_vote,
						'portfolio_id' => $portfolioData->id 
					]
				);		
			}		
		}
    }
}
