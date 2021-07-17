<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBtcPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('btc_prices', function (Blueprint $table) {
            $table->id();
            $table->string('crypto');
            $table->string('currency');
            $table->decimal('priceDay', 10, 2);
            $table->decimal('volumeDay', 10, 2);
            $table->decimal('lastTradePrice', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('btc_prices');
    }
}
