<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTindakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tindakan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('diagnosa');
            $table->text('terapi');
            $table->string('foto_sebelum', 255);
            $table->string('foto_sesudah', 255);
            $table->bigInteger('pasien_id')->unsigned();
            $table->foreign('pasien_id')->references('id')->on('pasien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tindakan');
    }
}
