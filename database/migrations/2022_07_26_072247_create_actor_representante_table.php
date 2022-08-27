<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorRepresentanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_representante', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('actor_id');
            $table->foreign('actor_id')
                ->references('id')->on('actores')->onDelete('cascade');

            $table->unsignedBigInteger('representante_id');
            $table->foreign('representante_id')
                ->references('id')->on('representantes')->onDelete('cascade');

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
        Schema::dropIfExists('actor_representante');
    }
}
