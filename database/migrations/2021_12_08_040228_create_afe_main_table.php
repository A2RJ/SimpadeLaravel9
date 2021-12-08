<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfeMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afe_main', function (Blueprint $table) {
            $table->integer('id_afe_main', true);
            $table->string('afe_id');
            $table->integer('produk_afe_id')->index('produk_afe_id');
            $table->integer('kategori_afe_id')->index('kategori_afe_id');
            $table->integer('status_id')->index('status_id');
            $table->integer('afe_status_id')->index('afe_status_id');
            $table->date('tanggal_install');
            $table->date('tanggal_aktif');
            $table->enum('wp_view', ['Y', 'N']);
            $table->string('serial_number')->unique('serial_number');
            $table->date('tanggal_produksi');
            $table->date('tanggal_deliver');
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
        Schema::dropIfExists('afe_main');
    }
}
