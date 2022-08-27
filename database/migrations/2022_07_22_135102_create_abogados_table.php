<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbogadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abogados', function (Blueprint $table) {
            $table->id();



            $table->unsignedBigInteger('juicio_id');
            //$table->unsignedInteger('juicio_id');
            $table->foreign('juicio_id')
                ->references('id')->on('juicios')->onDelete('cascade');

            $table->unsignedBigInteger('interno_id');
            //$table->unsignedInteger('interno_id');
            $table->foreign('interno_id')
                ->references('id')->on('internos');

            /*
            $table->unsignedBigInteger('jefe_id');
            //$table->unsignedInteger('interno_id');
            $table->foreign('jefe_id')
                ->references('id')->on('internos');
            */

            $table->date('fecha');
            $table->string('usuario', 20);

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
        Schema::dropIfExists('abogados');
    }
}
