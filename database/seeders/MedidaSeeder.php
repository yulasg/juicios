<?php

namespace Database\Seeders;

use App\Models\Medida;
use Illuminate\Database\Seeder;

class MedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $medida1 = new Medida();
        $medida1->descripcion = "SIN TIPO DE MEDIDA ASIGNADO";
        $medida1->save();

        $medida2 = new Medida();
        $medida2->descripcion = "VERIFICAR";
        $medida2->save();

        $medida3 = new Medida();
        $medida3->descripcion = "EMBARGO PREV. SOL.";
        $medida3->save();

        $medida4 = new Medida();
        $medida4->descripcion = "EMBARGO PREV. DEC.";
        $medida4->save();

        $medida5 = new Medida();
        $medida5->descripcion = "EMBARGO EJE. SOL.";
        $medida5->save();

        $medida6 = new Medida();
        $medida6->descripcion = "EMBARGO EJE. DEC.";
        $medida6->save();

        $medida7 = new Medida();
        $medida7->descripcion = "VARIAS";
        $medida7->save();

        $medida8 = new Medida();
        $medida8->descripcion = "SECUESTRO SOLICITADO";
        $medida8->save();

        $medida9 = new Medida();
        $medida9->descripcion = "SECUESTRO DECRETADO";
        $medida9->save();

        $medida10 = new Medida();
        $medida10->descripcion = "INNOMINADA SOL.";
        $medida10->save();

        $medida11 = new Medida();
        $medida11->descripcion = "INNOMINADA DEC.";
        $medida11->save();

        $medida12 = new Medida();
        $medida12->descripcion = "OCUPAC. JUDIC. SOL.";
        $medida12->save();

        $medida13 = new Medida();
        $medida13->descripcion = "OCUPAC. JUDIC. DEC.";
        $medida13->save();

        $medida14 = new Medida();
        $medida14->descripcion = "SUSP.EFEC.SENT.SOL.";
        $medida14->save();

        $medida15 = new Medida();
        $medida15->descripcion = "SUSP.EFEC.SENT.DEC.";
        $medida15->save();

        $medida16 = new Medida();
        $medida16->descripcion = "PROH ENAJ Y GRAV SOL";
        $medida16->save();

        $medida17 = new Medida();
        $medida17->descripcion = "PROH ENAJ Y GRAV DEC";
        $medida17->save();

        $medida18 = new Medida();
        $medida18->descripcion = "INCAUTACIÓN";
        $medida18->save();

        $medida19 = new Medida();
        $medida19->descripcion = "OCUPACIÓN JUDICIAL";
        $medida19->save();

        $medida20 = new Medida();
        $medida20->descripcion = "PRIVACIÓN LIBERTAD PREVENTIVA";
        $medida20->save();

        $medida21 = new Medida();
        $medida21->descripcion = "MICROCRÉDITOS";
        $medida21->save();
 
        $medida22 = new Medida();
        $medida22->descripcion = "RESOLUCIÓN DE CONTRATO.";
        $medida22->save();

        $medida23 = new Medida();
        $medida23->descripcion = "PRIVATIVA DE LIBERTAD";
        $medida23->save();
   
        $medida24 = new Medida();
        $medida24->descripcion = "MULTA E INTERESES MORATORIOS";
        $medida24->save();
  
        $medida25 = new Medida();
        $medida25->descripcion = "LEVANTAMIENTO DE MEDIDA";
        $medida25->save();
      
        $medida26 = new Medida();
        $medida26->descripcion = "SUSPENDIDO (LEPDHV)";
        $medida26->save();

        $medida27 = new Medida();
        $medida27->descripcion = "NO SE INTIMO A LOS DEMANDADOS";
        $medida27->save();

        



        $medida28 = new Medida();
        $medida28->descripcion = "JUZ. DUODECIMO DE 1 INST CARAC";
        $medida28->save();

        $medida29 = new Medida();
        $medida29->descripcion = "POR NOTIF ABOC PARA SENTENCIAR";
        $medida29->save();

        $medida30 = new Medida();
        $medida30->descripcion = "LABORAL";
        $medida30->save();

        $medida31 = new Medida();
        $medida31->descripcion = "POR LIBRAR CARTEL DE REMATE";
        $medida31->save();

        $medida32 = new Medida();
        $medida32->descripcion = "POR SENTENCIAR";
        $medida32->save();

        $medida33 = new Medida();
        $medida33->descripcion = "POR DICTAR LAUDO ARBITRAL";
        $medida33->save();

        $medida34 = new Medida();
        $medida34->descripcion = "CENTRO DE ARBITRAJE";
        $medida34->save();

        $medida35 = new Medida();
        $medida35->descripcion = "NEGADA MEDIDA";
        $medida35->save();

        $medida36 = new Medida();
        $medida36->descripcion = "4° DE FALCÓN";
        $medida36->save();
    }
}
