<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
	    $table->string('links_next_href');
	    $table->string('links_previous_href');
	    $table->decimal('accruedInterest_amount',total:12,places:2);
            $table->string('accruedInterest_currency');
	    $table->string('blockInfo_blockText');
	    $table->string('blockInfo_blockTo');
	    $table->string('bookingDate');
	    $table->string('cancellationInfo_cancelledTransactionId');
	    $table->string('cancellationInfo_isCancelation');
	    $table->string('costs_costDescription');
	    $table->decimal('costs_money_amount',total:12,places:2);
	    $table->string('costs_money_currency');
	    $table->string('depository');
	    $table->decimal('exchangeRate',total:2,places:1)->default(1.0);
	    $table->decimal('price_amount',total:12,places:2);
	    $table->string('price_unit');
	    $table->string('masterdata_isin');
	    $table->string('masterdata_wkn');
	    $table->string('masterdata_name');
	    $table->string('masterdata_notationType');
	    $table->decimal('size_amount',total:12,places:2);
	    $table->string('size_unit');
	    $table->string('tradingDate');
	    $table->string('tradingPlatform');
	    $table->timestamp('tradingTimestamp');			
	    $table->string('transactionId');
	    $table->string('transactionType_id');			
	    $table->string('transactionType_name');			
	    $table->string('valutaDate');
	    $table->string('settlementAccount');			
	    $table->string('settlementAccountRef_description');
	    $table->string('settlementAccountRef_iban');
	    $table->string('settlementAccountRef_currency');
	    $table->decimal('marketValue_amount',total:12,places:2);
	    $table->string('marketValue_currency');
	    $table->decimal('actualAmount_amount',total:12,places:2);
	    $table->string('actualAmount_currency');
	    $table->string('externalOrderNumber');
	    $table->string('settlementNumber');
	    $table->integer('executionNumber');
	    $table->string('clientOrderId');
	    $table->string('transactionDetailedType');
	    $table->string('taxes_taxType');
	    $table->string('taxTypeDescription');
	    $table->decimal('taxes_amount_amount',total:12,places:2);
	    $table->string('taxes_amount_currency');
	   $table->foreign('account_id')->references('securitiesAccountId')->on('accounts');		
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
