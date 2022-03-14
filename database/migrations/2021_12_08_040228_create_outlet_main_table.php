<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_main', function (Blueprint $table) {
            $table->integer('id_outlet_main', true);
            $table->string('outlet_id');
            $table->integer('wp_main_id')->index('wp_main_id');
            $table->integer('jenis_pajak_id')->index('jenis_pajak_id');
            $table->integer('status_outlet_id')->index('status_outlet_id');
            $table->string('nama_wp');
            $table->string('nopd');
            $table->text('alamat_outlet');
            $table->string('kel_desa');
            $table->string('rt');
            $table->string('rw');
            $table->string('kode_pos');
            $table->string('lat');
            $table->string('lon');
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
        Schema::dropIfExists('outlet_main');
    }
}
