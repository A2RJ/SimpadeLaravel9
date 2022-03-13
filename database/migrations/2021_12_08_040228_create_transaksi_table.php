<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->integer('id_transaksi', true);
            $table->string('nomor');
            $table->integer('wp_main_id')->index('wp_main_id');
            $table->integer('outlet_main_id')->index('outlet_main_id');
            $table->integer('produk_afe_id')->index('produk_afe_id');
            $table->integer('kategori_afe_id')->index('kategori_afe_id');
            $table->integer('jenis_amount_id')->index('jenis_amount_id');
            $table->string('serial_number')->nullable();
            $table->date('tanggal_transaksi');
            $table->string('nomor_faktur');
            $table->string('amount');
            $table->string('pajak_daerah');
            $table->date('timestamp_app');
            $table->date('timestamp_afe');
            $table->date('inspection_code');
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
        Schema::dropIfExists('transaksi');
    }
}
