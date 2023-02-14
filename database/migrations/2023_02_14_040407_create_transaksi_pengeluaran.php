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
        Schema::create('transaksi_pengeluaran', function (Blueprint $table) {
            $table->id('TrxOutPK');
            $table->string('TrxOutNo');
            $table->integer('WhsIdf');
            $table->datetime('TrxOutDate');
            $table->integer('TrxOutCustIdf');
            $table->string('TrxOutNotes');
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
        Schema::dropIfExists('shipping');
    }
};
