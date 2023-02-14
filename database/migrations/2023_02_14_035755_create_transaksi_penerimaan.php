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
        Schema::create('transaksi_penerimaan', function (Blueprint $table) {
            $table->id('TrxInPK');
            $table->string('TrxInNo');
            $table->integer('WhsIdf');
            $table->datetime('TrxInDate');
            $table->integer('TrxInSuppIdf');
            $table->String('TrxInNotes');
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
        Schema::dropIfExists('receiving');
    }
};
