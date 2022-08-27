<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaRepresentanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_representante', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')
                ->references('id')->on('personas')->onDelete('cascade');

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
        Schema::dropIfExists('persona_representante');
    }
}
