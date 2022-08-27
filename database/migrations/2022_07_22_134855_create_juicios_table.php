<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //DB_CONNECTION=mysql
    //DB_HOST=127.0.0.1
    //DB_PORT=8889
    //DB_DATABASE=juicio
    //DB_USERNAME=root
    //DB_PASSWORD=root
    //10.100.10.2 desarrollo
    //10.100.10.3 basededatos


    //DB_CONNECTION=pgsql
    //DB_HOST=127.0.0.1
    //DB_PORT=5432
    //DB_DATABASE=juicio
    //DB_USERNAME=postgres
    //DB_PASSWORD=root

    //DB_CONNECTION=mysql
    //DB_HOST=127.0.0.1
    //DB_PORT=3306
    //DB_DATABASE=juicio
    //DB_USERNAME=root
    //DB_PASSWORD=123456

    public function up()
    {
        Schema::create('juicios', function (Blueprint $table) {
            $table->id();
            //$table->boolean('internacional')->default(0);
            //$table->enum('origen', ['F','B','A','C']);


            $table->char('internacional', 1, ['N', 'I']);
            
            $table->unsignedBigInteger('especialidad_id');
            $table->foreign('especialidad_id')
                ->references('id')->on('especialidades');
            

            $table->char('origen', 1, ['F', 'B', 'A', 'C']);

            $table->foreignId('procedencia_id')->constrained();

            
            $table->unsignedBigInteger('ubicacion_id');
            $table->foreign('ubicacion_id')
                ->references('id')->on('ubicaciones');
            

            
            $table->unsignedBigInteger('estatu_id');
            $table->foreign('estatu_id')
                ->references('id')->on('estatus');
            

            $table->string('expediente', 30);

            
            $table->unsignedBigInteger('tribunal_id');
            $table->foreign('tribunal_id')
                ->references('id')->on('tribunales');
                

            $table->foreignId('interno_id')->constrained();
            $table->foreignId('externo_id')->constrained();

            
            $table->unsignedBigInteger('obligacion_id');
            $table->foreign('obligacion_id')
                ->references('id')->on('obligaciones');
            $table->foreignId('estado_id')->constrained();
            

            $table->foreignId('demanda_id')->constrained();

            
            $table->unsignedBigInteger('pretension_id');
            $table->foreign('pretension_id')
                ->references('id')->on('pretensiones');
            

            $table->foreignId('garantia_id')->constrained();
            $table->char('llevado', 2, ['CJ', 'AE','NA']);
            $table->foreignId('medida_id')->constrained();
            $table->char('practicada', 1, ['S', 'N']);
            $table->char('moneda', 2, ['BS', 'US','NA']);

            //Fecha Admimisión de la Demanda
            $table->date('admision');
            //Fecha Asignación 
            $table->date('asignacion');

            //Fecha Ultima Actuación, se actualiza en seguimiento de juicio
            $table->date('actuacion')->nullable();
            //Fecha Ultima Actividad, se actualiza en seguimiento de actividad
            $table->date('movimiento')->nullable();
            //Fecha Creación
            $table->date('creacion')->nullable();

            $table->char('representante', 1, ['U', 'V', 'N'])->default('N');
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
        Schema::dropIfExists('juicios');
    }
}
