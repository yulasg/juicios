<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juicio_id')->constrained()->onDelete('cascade');
            $table->dateTime('fecha');
            //$table->unsignedInteger('actividad_id');
            $table->unsignedBigInteger('actividad_id');
            $table->foreign('actividad_id')
                ->references('id')->on('actividades');
            $table->longText('seguimiento');
            $table->string('usuario',20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguimientos');
    }
}

