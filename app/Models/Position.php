<?php

namespace App\Models;

use App\Builders\Position\PositionBuilder;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
	use HasFactory;

	protected $table = 'positions';
	 
	protected $guarded = [];
	
	protected $fillable = [
		'accruedInterest_amount',
		'accruedInterest_currency',
		'currentPrice_amount',
		'currentPrice_unit',
		'exchangeRate',
		'exchangeRateDate',
		'quoteDate',
		'initialPrice_amount',
		'initialPrice_unit',
		'initialExchangeRate',
		'lastTradeDate',
		'payedAccruedInterest_amount',
		'payedAccruedInterest_currency',		
		'payout_amount',
		'payout_currency',
		'payoutId',
		'quantity_amount',
		'quantity_unit',
		'masterdata_position_isin',
		'masterdata_position_wkn',
		'masterdata_position_name',
		'masterdata_position_notationType',
		'masterdata_currency',
		'masterdata_maturityDate',
		'masterdata_vote',
		'portfolio_id'
	];	
	
	public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
	
	public function newEloquentBuilder($query): PositionBuilder
	{
		return new PositionBuilder($query);
	}
}	