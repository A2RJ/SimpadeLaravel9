<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPajakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_pajak', function (Blueprint $table) {
            $table->integer('id_jenis_pajak', true);
            $table->enum('jenis_pajak', ['Restoran', 'Hotel', 'Hiburan', 'Parkir']);
            $table->string('tarif');
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
        Schema::dropIfExists('jenis_pajak');
    }
}
