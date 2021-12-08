<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreign(['wp_main_id'], 'wp_main_id')->references(['id_wp_main'])->on('wp_main')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['kategori_afe_id'], 'kategori_afe_id')->references(['id_kategori_afe'])->on('kategori_afe')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['produk_afe_id'], 'produk_afe_id')->references(['id_produk_afe'])->on('produk_afe')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['jenis_amount_id'], 'jenis_amount_id')->references(['id_jenis_amount'])->on('jenis_amount')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['outlet_main_id'], 'outlet_main_id')->references(['id_outlet_main'])->on('outlet_main')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign('wp_main_id');
            $table->dropForeign('kategori_afe_id');
            $table->dropForeign('produk_afe_id');
            $table->dropForeign('jenis_amount_id');
            $table->dropForeign('outlet_main_id');
        });
    }
}
