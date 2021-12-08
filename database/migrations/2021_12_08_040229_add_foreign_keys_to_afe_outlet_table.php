<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAfeOutletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afe_outlet', function (Blueprint $table) {
            $table->foreign(['afe_main_id'], 'afe_main')->references(['id_afe_main'])->on('afe_main')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('afe_outlet', function (Blueprint $table) {
            $table->dropForeign('afe_main');
        });
    }
}
