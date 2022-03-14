<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOutletMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outlet_main', function (Blueprint $table) {
            $table->foreign(['wp_main_id'], 'wp_id')->references(['id_wp_main'])->on('wp_main')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['status_outlet_id'], 'status_outlet')->references(['id_status_outlet'])->on('status_outlet')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['jenis_pajak_id'], 'jenis_pajak')->references(['id_jenis_pajak'])->on('jenis_pajak')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outlet_main', function (Blueprint $table) {
            $table->dropForeign('wp_id');
            $table->dropForeign('status_outlet');
            $table->dropForeign('jenis_pajak');
        });
    }
}
