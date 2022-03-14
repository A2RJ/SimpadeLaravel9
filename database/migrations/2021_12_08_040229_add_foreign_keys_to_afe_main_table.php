<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAfeMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afe_main', function (Blueprint $table) {
            $table->foreign(['produk_afe_id'], 'produk_afe')->references(['id_produk_afe'])->on('produk_afe')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['kategori_afe_id'], 'kategori_afe')->references(['id_kategori_afe'])->on('kategori_afe')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['status_id'], 'status')->references(['id_status'])->on('status')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['afe_status_id'], 'afe_status')->references(['id_afe_status'])->on('afe_status')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('afe_main', function (Blueprint $table) {
            $table->dropForeign('produk_afe');
            $table->dropForeign('kategori_afe');
            $table->dropForeign('status');
            $table->dropForeign('afe_status');
        });
    }
}
