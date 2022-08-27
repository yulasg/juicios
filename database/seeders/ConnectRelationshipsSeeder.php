<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Get Available Permissions.
         */
        $permissions = config('roles.models.permission')::all();

        /**
         * Attach Permissions to Roles.
         */
        $roleAdmin = config('roles.models.role')::where('name', '=', 'Admin')->first();
        foreach ($permissions as $permission) {
            if ($permission->id == '1'  || $permission->id == '2'   ||  $permission->id == '3'   ||  $permission->id == '4') {
                $roleAdmin->attachPermission($permission);
            }
        }

        $roleE = config('roles.models.role')::where('name', '=', 'Especialidades')->first();
        foreach ($permissions as $permission) {
            if (
                $permission->id == '70'  ||  $permission->id == '71'      ||  $permission->id == '72'
                || $permission->id == '73'  ||  $permission->id == '74'  ||  $permission->id == '75'   ||  $permission->id == '76'  || $permission->id == '77'
                ||  $permission->id == '78'   ||  $permission->id == '79'   ||  $permission->id == '80'  || $permission->id == '81'
            ) {
                $roleE->attachPermission($permission);
            }
        }

        $roleA = config('roles.models.role')::where('name', '=', 'Abogado')->first();
        foreach ($permissions as $permission) {
            if (
                $permission->id == '5'        ||  $permission->id == '6'   ||  $permission->id == '7'  ||  $permission->id == '9'  ||  $permission->id == '10'
                ||  $permission->id == '11'   ||  $permission->id == '12'  ||  $permission->id == '13' ||  $permission->id == '15' ||  $permission->id == '16'
                ||  $permission->id == '17'   ||  $permission->id == '18'  ||  $permission->id == '19' ||  $permission->id == '21' ||  $permission->id == '22'
                ||  $permission->id == '23'   ||  $permission->id == '24'  ||  $permission->id == '27' ||  $permission->id == '28'
                ||  $permission->id == '29'   ||  $permission->id == '30'  ||  $permission->id == '33' ||  $permission->id == '34'
                ||  $permission->id == '35'   ||  $permission->id == '36'  ||  $permission->id == '37' ||  $permission->id == '39'  || $permission->id == '40'
                ||  $permission->id == '41'   ||  $permission->id == '42'  ||  $permission->id == '43' ||  $permission->id == '45'  || $permission->id == '46'
                ||  $permission->id == '47'   ||  $permission->id == '48'  ||  $permission->id == '49' ||  $permission->id == '51'  || $permission->id == '52'
                ||  $permission->id == '53'   ||  $permission->id == '54'  ||  $permission->id == '55' ||  $permission->id == '57'  || $permission->id == '58'
                ||  $permission->id == '59'   ||  $permission->id == '64'
                ||  $permission->id == '70'   ||  $permission->id == '74'  ||  $permission->id == '75'
                ||  $permission->id == '76'   ||  $permission->id == '80'  ||  $permission->id == '81' 
                ||  $permission->id == '82'   ||  $permission->id == '86'  ||  $permission->id == '87' 
                ||  $permission->id == '88'   ||  $permission->id == '92'  ||  $permission->id == '93' 
                ||  $permission->id == '94'   ||  $permission->id == '98'  ||  $permission->id == '99' 
                ||  $permission->id == '100'  ||  $permission->id == '104' ||  $permission->id == '105' 
                ||  $permission->id == '106'  ||  $permission->id == '110' ||  $permission->id == '111' 
                ||  $permission->id == '112'  ||  $permission->id == '116' ||  $permission->id == '117' 
                ||  $permission->id == '118'  ||  $permission->id == '122' ||  $permission->id == '123' 
                ||  $permission->id == '124'  ||  $permission->id == '128' ||  $permission->id == '129' 
                ||  $permission->id == '130'  ||  $permission->id == '134' ||  $permission->id == '135' 
                ||  $permission->id == '136'  ||  $permission->id == '140' ||  $permission->id == '141' 
                ||  $permission->id == '142'  ||  $permission->id == '146' ||  $permission->id == '147' 
                ||  $permission->id == '148'  ||  $permission->id == '152' ||  $permission->id == '153' 
                ||  $permission->id == '154'  ||  $permission->id == '158' ||  $permission->id == '159'
                ||  $permission->id == '160'  ||  $permission->id == '161' ||  $permission->id == '164' ||  $permission->id == '165'
                ||  $permission->id == '166'  ||  $permission->id == '167' ||  $permission->id == '170' ||  $permission->id == '171'
                ||  $permission->id == '172'  ||  $permission->id == '173' ||  $permission->id == '176' ||  $permission->id == '177'
            ) {
                $roleA->attachPermission($permission);
            }
        }

        $roleGerente = config('roles.models.role')::where('name', '=', 'Gerente')->first();
        foreach ($permissions as $permission) {
            if (
                
                $permission->id == '5'      || $permission->id == '8'     ||  $permission->id == '9'  || $permission->id == '10'  
                || $permission->id == '11'  || $permission->id == '14'    ||  $permission->id == '15' || $permission->id == '16' 
                || $permission->id == '17'  ||  $permission->id == '20'   ||  $permission->id == '21' || $permission->id == '22' 
                || $permission->id == '23'  ||  $permission->id == '26'   ||  $permission->id == '27' || $permission->id == '28' 
                || $permission->id == '29'  ||  $permission->id == '32'   ||  $permission->id == '33' || $permission->id == '34' 
                || $permission->id == '35'  ||  $permission->id == '38'   ||  $permission->id == '39' || $permission->id == '40' 
                || $permission->id == '41'  ||  $permission->id == '44'   ||  $permission->id == '45' || $permission->id == '46' 
                || $permission->id == '47'  ||  $permission->id == '50'   ||  $permission->id == '51' || $permission->id == '52' 
                || $permission->id == '53'  ||  $permission->id == '56'   ||  $permission->id == '57' || $permission->id == '58' 
                || $permission->id == '59'  ||  $permission->id == '60'   ||  $permission->id == '61' || $permission->id == '62' ||  $permission->id == '63'
                || $permission->id == '64'  ||  $permission->id == '65'   ||  $permission->id == '66' || $permission->id == '67' ||  $permission->id == '68' || $permission->id == '69' 
                || $permission->id == '70'  ||  $permission->id == '74'   ||  $permission->id == '75' 
                || $permission->id == '76'  ||  $permission->id == '80'   ||  $permission->id == '81' 
                || $permission->id == '82'  ||  $permission->id == '85'   ||  $permission->id == '86'  || $permission->id == '87'  
                || $permission->id == '88'  ||  $permission->id == '91'   ||  $permission->id == '92'  || $permission->id == '93'  
                || $permission->id == '94'  ||  $permission->id == '97'   ||  $permission->id == '98'  || $permission->id == '99'  
                || $permission->id == '100' ||  $permission->id == '103'  ||  $permission->id == '104' || $permission->id == '105'  
                || $permission->id == '106' ||  $permission->id == '109'  ||  $permission->id == '110' || $permission->id == '111'  
                || $permission->id == '112' ||  $permission->id == '115'  ||  $permission->id == '116' || $permission->id == '117'  
                || $permission->id == '118' ||  $permission->id == '121'  ||  $permission->id == '122' || $permission->id == '123'  
                || $permission->id == '124' ||  $permission->id == '127'  ||  $permission->id == '128' || $permission->id == '129'  
                || $permission->id == '130' ||  $permission->id == '133'  ||  $permission->id == '134' || $permission->id == '135'  
                || $permission->id == '136' ||  $permission->id == '139'  ||  $permission->id == '140' || $permission->id == '141'  
                || $permission->id == '142' ||  $permission->id == '145'  ||  $permission->id == '146' || $permission->id == '147'  
                || $permission->id == '148' ||  $permission->id == '151'  ||  $permission->id == '152' || $permission->id == '153'  
                || $permission->id == '154' ||  $permission->id == '157'  ||  $permission->id == '158' || $permission->id == '159'
                || $permission->id == '160'  ||  $permission->id == '163' ||  $permission->id == '164' || $permission->id == '165'
                || $permission->id == '166'  ||  $permission->id == '169' ||  $permission->id == '170' || $permission->id == '171'      
                || $permission->id == '172'  ||  $permission->id == '175' ||  $permission->id == '176' || $permission->id == '177'          

            ) {
                $roleGerente->attachPermission($permission);
            }
        }

        $roleConsulta = config('roles.models.role')::where('name', '=', 'Consulta')->first();
        foreach ($permissions as $permission) {
            if (
                
                $permission->id == '5'      ||  $permission->id == '9'  || $permission->id == '10'  
                ||  $permission->id == '11' ||  $permission->id == '15' || $permission->id == '16' 
                || $permission->id == '17'  ||  $permission->id == '21' || $permission->id == '22' 
                || $permission->id == '23'  ||  $permission->id == '27' || $permission->id == '28' 
                || $permission->id == '29'  ||  $permission->id == '33' || $permission->id == '34' 
                || $permission->id == '35'  ||  $permission->id == '39' || $permission->id == '40' 
                || $permission->id == '41'  ||  $permission->id == '45' || $permission->id == '46' 
                || $permission->id == '47'  ||  $permission->id == '51' || $permission->id == '52' 
                || $permission->id == '53'  ||  $permission->id == '57' || $permission->id == '58' 
                || $permission->id == '59'  ||  $permission->id == '62' || $permission->id == '63' 
                || $permission->id == '64'  ||  $permission->id == '68' || $permission->id == '69'
                || $permission->id == '160'  || $permission->id == '164'|| $permission->id == '165'
                || $permission->id == '166'  || $permission->id == '170'|| $permission->id == '171'
                || $permission->id == '172'  || $permission->id == '176'|| $permission->id == '177'
            ) {
                $roleConsulta->attachPermission($permission);
            }
        }


        $roleTabla = config('roles.models.role')::where('name', '=', 'Mantenimiento')->first();
        foreach ($permissions as $permission) {
            if (
                
                $permission->id == '70'      || $permission->id == '74'  || $permission->id == '75'  
                ||  $permission->id == '76'  || $permission->id == '80'  || $permission->id == '81'
                ||  $permission->id == '82'  || $permission->id == '83'  || $permission->id == '84'  ||  $permission->id == '86'   || $permission->id == '87' 
                ||  $permission->id == '88'  || $permission->id == '89'  || $permission->id == '90'  ||  $permission->id == '92'   || $permission->id == '93' 
                ||  $permission->id == '94'  || $permission->id == '95'  || $permission->id == '96'  ||  $permission->id == '98'   || $permission->id == '99' 
                ||  $permission->id == '100' || $permission->id == '101' || $permission->id == '102' ||  $permission->id == '104'  || $permission->id == '105' 
                ||  $permission->id == '106' || $permission->id == '107' || $permission->id == '108' ||  $permission->id == '110'  || $permission->id == '111'  
                ||  $permission->id == '112' || $permission->id == '113' || $permission->id == '114' ||  $permission->id == '116'  || $permission->id == '117'  
                ||  $permission->id == '118' || $permission->id == '119' || $permission->id == '120' ||  $permission->id == '122'  || $permission->id == '123'  
                ||  $permission->id == '124' || $permission->id == '125' || $permission->id == '126' ||  $permission->id == '128'  || $permission->id == '129'  
                ||  $permission->id == '130' || $permission->id == '131' || $permission->id == '132' ||  $permission->id == '134'  || $permission->id == '135'  
                ||  $permission->id == '136' || $permission->id == '137' || $permission->id == '138' ||  $permission->id == '140'  || $permission->id == '141'  
                ||  $permission->id == '142' || $permission->id == '143' || $permission->id == '144' ||  $permission->id == '146'  || $permission->id == '147'  
                ||  $permission->id == '148' || $permission->id == '149' || $permission->id == '150' ||  $permission->id == '152'  || $permission->id == '153'  
                ||  $permission->id == '154' || $permission->id == '155' || $permission->id == '156' ||  $permission->id == '158'  ||  $permission->id == '159' 
            ) {
                $roleTabla->attachPermission($permission);
            }
        }
    }
}
