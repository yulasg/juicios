<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ],
            [
                'name'        => 'Gerente',
                'slug'        => 'gerente',
                'description' => 'Rol Gerente',
                'level'       => 1,
            ],
            [
                'name'        => 'Abogado',
                'slug'        => 'abogado',
                'description' => 'Rol Abogado',
                'level'       => 1,
            ],
            [
                'name'        => 'Consulta',
                'slug'        => 'consulta',
                'description' => 'Rol Consulta',
                'level'       => 1,
            ],
            [
                'name'        => 'Mantenimiento',
                'slug'        => 'Mantenimiento',
                'description' => 'Rol Mantenimiento',
                'level'       => 1,
            ],
            [
                'name'        => 'Especialidades',
                'slug'        => 'especialidades',
                'description' => 'Rol Especialidades',
                'level'       => 1,
            ],
        ];

        /*
         * Add Role Items 
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $RoleItem['name'],
                    'slug'          => $RoleItem['slug'],
                    'description'   => $RoleItem['description'],
                    'level'         => $RoleItem['level'],
                ]);
            }
        }
    }
}
