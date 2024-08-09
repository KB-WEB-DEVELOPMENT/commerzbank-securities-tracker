<?php
namespace App\Actions\Transactions;

use App\ValueObjects\AccountId;

use App\Models\Transaction;

use App\Services\Commerzbank\TransactionsService;

use Illuminate\Support\Collection;

class UpsertTransactions
{
    public function __construct(
		private TransactionsService $transactionsService)
    {}

    public function execute(string $securitiesAccountId): void
    {
        $accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		$transactionsData = $this->transactionsService->transactions($securitiesAccountId);

		if ($transactionsData->transactions() instanceof Collection) {
			
			foreach ($transactionsData->transactions() as $transaction) {
				Transaction::updateOrCreate(
					[					
						'links_next_href' => $transactionsData->linksNextHref(),
						'links_previous_href' => $transactionsData->linksPreviousHref(),
						'accruedInterest_amount' => (float)$transaction->accruedInterest_amount,
						'accruedInterest_currency' => $transaction->accruedInterest_currency,
						'blockInfo_blockText' => $transaction->blockInfo_blockText,
						'blockInfo_blockTo' => $transaction->blockInfo_blockTo,
						'bookingDate' => $transaction->bookingDate,
						'cancellationInfo_cancelledTransactionId' => $transaction->cancellationInfo_cancelledTransactionId, 
						'cancellationInfo_isCancelation' => $transaction->cancellationInfo_isCancelation,
						'costs_costDescription' => $transaction->costs_costDescription,
						'costs_money_amount' => (float)$transaction->costs_money_amount,
						'costs_money_currency' => $transaction->costs_money_currency,
						'depository' => $transaction->depository,
						'exchangeRate' => (float)$transaction->exchangeRate,
						'price_amount' => (float)$transaction->price_amount,
						'price_unit' => $transaction->price_unit,
						'masterdata_isin' => $transaction->masterdata_isin,
						'masterdata_wkn' => $transaction->masterdata_wkn,
						'masterdata_name' => $transaction->masterdata_name,
						'masterdata_notationType' => $transaction->masterdata_notationType,
						'size_amount' => (float)$transaction->size_amount,
						'size_unit' => $transaction->size_unit,
						'tradingDate' => $transaction->tradingDate,
						'tradingPlatform' => $transaction->tradingPlatform,
						'tradingTimestamp' => $transaction->tradingTimestamp,
						'transactionId' => $transaction->transactionId,
						'transactionType_id' => $transaction->transactionType_id,
						'transactionType_name' => $transaction->transactionType_name,
						'valutaDate' => $transaction->valutaDate,
						'settlementAccount' => $transaction->settlementAccount,
						'settlementAccountRef_description' => $transaction->settlementAccountRef_description,
						'settlementAccountRef_iban' => $transaction->settlementAccountRef_iban,
						'settlementAccountRef_currency' => $transaction->settlementAccountRef_currency,
						'marketValue_amount' => (float)$transaction->marketValue_amount,
						'marketValue_currency' => $transaction->marketValue_currency,
						'actualAmount_amount' => (float)$transaction->actualAmount_amount,
						'actualAmount_currency' => $transaction->actualAmount_currency,
						'externalOrderNumber' => $transaction->externalOrderNumer,
						'settlementNumber' => $transaction->settlementNumber,
						'executionNumber' => $transaction->executionNumber,
						'clientOrderId' => $transaction->clientOrderId,
						'transactionDetailedType' => $transaction->transactionDetailedType,
						'taxes_taxType' => $transaction->taxes_taxType,
						'taxTypeDescription' => $transaction->taxTypeDescription,
						'taxes_amount_amount' => (float)$transaction->taxes_amount_amount,
						'taxes_amount_currency' => $transaction->taxes_amount_currency,
						'account_id' => $transactionsData->securitiesAccountId()
					]				
				);		
			}		
		}
    }
}
