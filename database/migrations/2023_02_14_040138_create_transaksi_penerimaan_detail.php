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
        Schema::create('transaksi_penerimaan_detail', function (Blueprint $table) {
            $table->id('TrxInDPK');
            $table->unsignedBigInteger('TrxInIDF');
            $table->foreign('TrxInIDF')->references('TrxInPK')->on('transaksi_penerimaan');
            $table->integer('TrxInDProductIdf');
            $table->integer('TrxInDQtyDus');
            $table->integer('TrxInDQtyPcs');
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
        Schema::dropIfExists('receiving_details');
    }
};
