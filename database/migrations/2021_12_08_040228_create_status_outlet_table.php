<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusOutletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_outlet', function (Blueprint $table) {
            $table->integer('id_status_outlet', true);
            $table->enum('status', ['Persiapan Online', 'Proses Instal', 'Stabilisasi', 'Aktif', 'Non-aktif', 'Disegel']);
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
        Schema::dropIfExists('status_outlet');
    }
}
