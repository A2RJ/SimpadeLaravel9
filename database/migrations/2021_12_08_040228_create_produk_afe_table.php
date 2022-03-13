<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukAfeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_afe', function (Blueprint $table) {
            $table->integer('id_produk_afe', true);
            $table->string('jenis_afe');
            $table->enum('produk_afe', ['TS-107', 'TS-108', 'TS-200', 'Neira-TS', 'Mobile POS']);
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
        Schema::dropIfExists('produk_afe');
    }
}
