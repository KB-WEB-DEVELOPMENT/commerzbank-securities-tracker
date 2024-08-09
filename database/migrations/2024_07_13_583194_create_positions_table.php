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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
			$table->decimal('accruedInterest_amount',total:12,places:2);
			$table->string('accruedInterest_currency');
			$table->decimal('currentPrice_amount',total:12,places:2);
			$table->string('currentPrice_unit');
			$table->decimal('exchangeRate',total:2,places:1)->default(1.0);
			$table->string('exchangeRateDate');	
			$table->string('quoteDate');
			$table->decimal('initialPrice_amount',total:12,places:2);			
			$table->string('initialPrice_unit');
			$table->decimal('initialExchangeRate',total:2,places:1)->default(1.0);			
			$table->string('lastTradeDate');
			$table->decimal('payedAccruedInterest_amount',total:12,places:2);	
			$table->string('payedAccruedInterest_currency');
			$table->decimal('payout_amount',total:12,places:2);	
			$table->string('payout_currency');			
			$table->string('positionId');			
			$table->decimal('quantity_amount',total:12,places:2);	
			$table->string('quantity_unit');
			$table->string('masterdata_position_isin');
			$table->string('masterdata_position_wkn');
			$table->string('masterdata_position_name');
			$table->string('masterdata_position_notationType');
			$table->string('masterdata_currency');
			$table->string('masterdata_maturityDate');
			$table->string('masterdata_vote');
			$table->foreignId('portfolio_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
