<?php

namespace App\Models;

use App\Builders\Transaction\TransactionBuilder;

use App\Collections\TransactionsCollection;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
	use HasFactory;

	protected $table = 'transactions';
	 
	protected $guarded = [];
	
	protected $fillable = [
		'links_next_href',
		'links_previous_href',
		'accruedInterest_amount',
		'accruedInterest_currency',
		'blockInfo_blockText',
		'blockInfo_blockTo',
		'bookingDate',
		'cancellationInfo_cancelledTransactionId',
		'cancellationInfo_isCancelation',
		'costs_costDescription',
		'costs_money_amount',
		'costs_money_currency',
		'depository',
		'exchangeRate',
		'price_amount',
		'price_unit',
		'masterdata_isin',
		'masterdata_wkn',
		'masterdata_name',
		'masterdata_notationType',
		'size_amount',
		'size_unit',
		'tradingDate',
        'tradingPlatform',
        'tradingTimestamp',	
        'transactionId',
		'transactionType_id',
		'transactionType_name',	
		'valutaDate',
        'settlementAccount', 
		'settlementAccountRef_description',
		'settlementAccountRef_iban',
		'settlementAccountRef_currency',
        'marketValue_amount',
        'marketValue_currency',
		'actualAmount_amount',
		'actualAmount_currency',
		'externalOrderNumer',
        'settlementNumber',
        'executionNumber',
		'clientOrderId',
		'transactionDetailedType',
		'taxes_taxType',
        'taxTypeDescription',
        'taxes_amount_amount',
        'taxes_amount_currency',
		'account_id'
	];	

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

	public function newEloquentBuilder($query): TransactionBuilder
	{
		return new TransactionBuilder($query);
	}
	
	public function newCollection(array $models = []): TransactionsCollection
    {
        return new TransactionsCollection($models);
    }	
}	