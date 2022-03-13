<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfeOutletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afe_outlet', function (Blueprint $table) {
            $table->integer('id_afe_outlet', true);
            $table->integer('outlet_main_id');
            $table->integer('afe_main_id')->index('afe_main_id');
            $table->enum('status', ['Instal', 'Aktif', 'Non-Aktif', 'Ditarik']);
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
        Schema::dropIfExists('afe_outlet');
    }
}
