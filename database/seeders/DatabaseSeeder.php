<?php

namespace Database\Seeders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
         // \App\Models\User::factory(10)->create();
        //$this->call(GarantiaSeeder::class);
        //$this->call(MedidaSeeder::class);
        //$this->call(PretensionSeeder::class);
        //$this->call(ObligacionSeeder::class);
        //$this->call(DemandaSeeder::class);
        //$this->call(JuzgadoSeeder::class);
        //$this->call(InternoSeeder::class);
        //$this->call(ExternoSeeder::class);
        //$this->call(ActividadSeeder::class);
        //$this->call(EstadoSeeder::class);
        //$this->call(TribunalSeeder::class);
        $this->call(EstatuSeeder::class);
        //$this->call(UbicacionSeeder::class);
        //$this->call(ProcedenciaSeeder::class);
        $this->call(EspecialidadSeeder::class);
        $this->call(ConfiguracionSeeder::class);
        //Juicio::factory(40)->create();

        Model::reguard();
       

    }
}
