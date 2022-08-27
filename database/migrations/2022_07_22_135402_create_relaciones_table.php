<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juicio_id')->constrained();
            //$table->foreignId('juicio1_id')->constrained();

            $table->unsignedBigInteger('juicio1_id');
            $table->foreign('juicio1_id')
                ->references('id')->on('juicios');
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
        Schema::dropIfExists('relaciones');
    }
}
