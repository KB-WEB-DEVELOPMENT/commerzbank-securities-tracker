<?php
 
namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

class PositionData extends Data 
{
    public function __construct(
		#[Min(0)]
		private readonly float  $accruedInterest_amount,
		private readonly string $accruedInterest_currency,
		#[Min(0)]
		private readonly float  $currentPrice_amount,
		private readonly string $currentPrice_unit,
		private readonly float  $exchangeRate,
		#[DateFormat('Y-m-d')]
		private readonly string $exchangeRateDate,
		#[DateFormat('Y-m-d')]
		private readonly string $quoteDate,
		#[Min(0)]
		private readonly float  $initialPrice_amount,
		private readonly string $initialPrice_unit,
		private readonly float  $initialExchangeRate,
		#[DateFormat('Y-m-d')]
		private readonly string $lastTradeDate,
		#[Min(0)]
		private readonly float  $payedAccruedInterest_amount,
		private readonly string $payedAccruedInterest_currency,		
		#[Min(0)]
		private readonly float  $payout_amount,
		private readonly string $payout_currency,
		private readonly string $payoutId,
		#[Min(0)]
		private readonly float  $quantity_amount,
		private readonly string $quantity_unit,
		#[Regex('/^[0-9]{12,13}$/')]
		private readonly string $masterdata_position_isin,
		#[Regex('/^[A-Z0-9][^IO]{6}$/')]
		private readonly string $masterdata_position_wkn,
		private readonly string $masterdata_position_name,
		private readonly string $masterdata_position_notationType,
		private readonly string $masterdata_currency,
		#[DateFormat('Y-m-d')]
		private readonly string $masterdata_maturityDate,
		private readonly string $masterdata_vote,
		[Min(1)]
		private readonly int $portfolio_id,
    ) {}

}