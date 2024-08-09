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
        Schema::create('portfolios', function (Blueprint $table) {    
	    $table->id();
	    $table->string('creationDay');
	    $table->string('effectiveDate');
	    $table->decimal('totalValue_amount',total:12,places:2);
	    $table->string('totalValue_currency');
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
        Schema::dropIfExists('portfolios');
    }
}
