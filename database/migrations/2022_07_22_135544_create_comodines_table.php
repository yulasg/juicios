<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComodinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comodines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juicio_id')->constrained()->onDelete('cascade');
            $table->string('comodin1', 40)->nullable();
            $table->string('comodin2', 3)->nullable();
            $table->string('comodin3', 3)->nullable();
            $table->string('comodin4', 3)->nullable();
            $table->string('comodin5', 3)->nullable();
            $table->string('comodin6', 3)->nullable();
            $table->string('comodin7', 3)->nullable();
            $table->string('comodin8', 3)->nullable();
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
        Schema::dropIfExists('comodines');
        
    }
}
