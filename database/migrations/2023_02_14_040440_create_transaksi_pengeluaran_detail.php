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
        Schema::create('transaksi_pengeluaran_detail', function (Blueprint $table) {
            $table->id('TrxOutDPK');
            $table->unsignedBigInteger('TrxOutIDF');
            $table->foreign('TrxOutIDF')->references('TrxOutPK')->on('transaksi_pengeluaran');
            $table->integer('TrxOutDProductIdf');
            $table->integer('TrxOutDQtyDus');
            $table->integer('TrxOutDQtyPcs');
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
