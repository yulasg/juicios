<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representantes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 1);
            $table->string('numero', 8);
            $table->string('rif', 1)->nullable();
            $table->string('nombre', 50);
            $table->string('direccion', 100)->nullable();
            $table->string('habitacion', 11)->nullable();
            $table->string('celular_principal', 11)->nullable();
            $table->string('celular_secundario', 11)->nullable();
            $table->string('email_principal',20)->unique()->nullable();
            $table->string('email_secundario',20)->unique()->nullable();
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
        Schema::dropIfExists('representantes');
    }
}
