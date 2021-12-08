<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wp_main', function (Blueprint $table) {
            $table->integer('id_wp_main', true);
            $table->string('wp_id');
            $table->integer('kategori_wp_id')->index('kategori_wp_id');
            $table->string('nama_wp');
            $table->string('email');
            $table->string('password');
            $table->string('npwpd');
            $table->text('alamat_wp');
            $table->string('kode_pemda_tk2');
            $table->string('kode_desa_lurah');
            $table->string('kode_pos');
            $table->date('tanggal_aktif_wp');
            $table->enum('role', ['superadmin', 'admin', 'wp', 'teknisi']);
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
        Schema::dropIfExists('wp_main');
    }
}
