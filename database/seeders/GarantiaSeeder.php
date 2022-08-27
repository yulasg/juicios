<?php

namespace Database\Seeders;

use App\Models\Garantia;
use Illuminate\Database\Seeder;

class GarantiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $garantia1 = new Garantia();
        $garantia1->descripcion = "SIN TIPO DE GARANTIA";
        $garantia1->save();

        $garantia2 = new Garantia();
        $garantia2->descripcion = "HIPOTECARIA";
        $garantia2->save();

        $garantia3 = new Garantia();
        $garantia3->descripcion = "PRENDARIA";
        $garantia3->save();

        $garantia4 = new Garantia();
        $garantia4->descripcion = "PRENDA S/DESPLAZAMI.";
        $garantia4->save();

        $garantia5 = new Garantia();
        $garantia5->descripcion = "FIANZA";
        $garantia5->save();

        $garantia6 = new Garantia();
        $garantia6->descripcion = "AVAL";
        $garantia6->save();

        $garantia7 = new Garantia();
        $garantia7->descripcion = "CESION CONTRATO";
        $garantia7->save();

        $garantia8 = new Garantia();
        $garantia8->descripcion = "CPARTICIPACION FAL";
        $garantia8->save();

        $garantia9 = new Garantia();
        $garantia9->descripcion = "PLAZO FIJO";
        $garantia9->save();

        $garantia10 = new Garantia();
        $garantia10->descripcion = "BONOS DEUDA PUBL.";
        $garantia10->save();

        $garantia11 = new Garantia();
        $garantia11->descripcion = "LIBRE";
        $garantia11->save();

        $garantia12 = new Garantia();
        $garantia12->descripcion = "FIANZA Y AVAL";
        $garantia12->save();

        $garantia13 = new Garantia();
        $garantia13->descripcion = "FIANZA E HIPOTECA";
        $garantia13->save();

        $garantia14 = new Garantia();
        $garantia14->descripcion = "RESERVA DE DOMINIO";
        $garantia14->save();

        $garantia15 = new Garantia();
        $garantia15->descripcion = "VERIFICAR";
        $garantia15->save();

        $garantia16 = new Garantia();
        $garantia16->descripcion = "PRENDA";
        $garantia16->save();

        $garantia17 = new Garantia();
        $garantia17->descripcion = "DESCONOCIDA";
        $garantia17->save();

        $garantia18 = new Garantia();
        $garantia18->descripcion = "PRENDA Y FIANZA";
        $garantia18->save();

        $garantia19 = new Garantia();
        $garantia19->descripcion = "HIPOTECA MOBILIARIA";
        $garantia19->save();
    }
}
