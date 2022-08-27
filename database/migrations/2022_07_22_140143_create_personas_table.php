<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juicio_id')->constrained()->onDelete('cascade');
            $table->foreign('configuracion_id')->references('id')->on('configuraciones');
            $table->string('nombre', 100);
            $table->string('persona', 1)->nullable();
            $table->string('numero', 8)->nullable();
            $table->string('rif', 1)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('habitacion', 11)->nullable();
            $table->string('celular', 11)->nullable();
            $table->string('email')->unique()->nullable();
            $table->unsignedBigInteger('configuracion_id');
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
        Schema::dropIfExists('personas');
    }
}
