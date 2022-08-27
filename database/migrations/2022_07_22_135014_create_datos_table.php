<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('juicio_id')->unique();
            //$table->unsignedInteger('juicio_id')->unique();
            $table->foreign('juicio_id')
                ->references('id')->on('juicios')
                ->onDelete('cascade');
            $table->unsignedBigInteger('juicio_ente_id')->nullable();
            //Fecha Admimisión de la Demanda
            //$table->date('demanda');
            //Fecha Asignación 
            //$table->date('asignacion');
            //Fecha Ultima Actuación, se actualiza en seguimiento de juicio
            //$table->date('actuacion')->nullable();
            //Fecha Ultima Actividad, se actualiza en seguimiento de actividad
            //$table->date('actividad')->nullable();
            //Fecha Creación
            //$table->date('creacion')->nullable();
            $table->double('capital')->nullable();
            $table->double('monto')->nullable();
            $table->char('tasa', 1, ['F', 'V','N'])->nullable();
            $table->double('mora')->nullable();
            $table->double('interes')->nullable();
            $table->longText('observacion')->nullable();
            $table->string('juez', 50)->nullable();
            $table->string('usuario',20);
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
        Schema::dropIfExists('datos');
    }
}
