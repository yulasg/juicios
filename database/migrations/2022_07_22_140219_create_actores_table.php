<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juicio_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('configuracion_id');
            $table->foreign('configuracion_id')
                ->references('id')->on('configuraciones');
            $table->unsignedBigInteger('referencia_id');
            $table->foreign('referencia_id')
                ->references('id')->on('referencias');
            $table->char('tipo', 1, ['E', 'I', 'A','C','X'])->default('X');
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
        Schema::dropIfExists('actores');
    }
}
