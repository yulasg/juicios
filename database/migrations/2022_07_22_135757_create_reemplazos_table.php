<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReemplazosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reemplazos', function (Blueprint $table) {
            $table->id();

            $table->string('tabla', 50);
            $table->unsignedBigInteger('codigo_juicio');
            $table->unsignedBigInteger('campoAnterior');
            $table->unsignedBigInteger('campoActual');
            $table->string('descripcion', 50);
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
        Schema::dropIfExists('reemplazos');
    }
}
