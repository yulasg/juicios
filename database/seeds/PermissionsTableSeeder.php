<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $Permissionitems = [
            [
                'name'        => 'Ver Usuarios',
                'slug'        => 'ver.usuarios',
                'description' => 'Ver Usuarios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Usuarios',
                'slug'        => 'crear.usuarios',
                'description' => 'Crear Usuarios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Usuarios',
                'slug'        => 'editar.usuarios',
                'description' => 'Editar Usuarios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Usuarios',
                'slug'        => 'eliminar.usuarios',
                'description' => 'Eliminar Usuarios',
                'model'       => 'Permission',
            ],
        ];

        /*
         * Add Permission Items
         *
         */
        foreach ($Permissionitems as $Permissionitem) {
            $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
            if ($newPermissionitem === null) {
                $newPermissionitem = config('roles.models.permission')::create([
                    'name'          => $Permissionitem['name'],
                    'slug'          => $Permissionitem['slug'],
                    'description'   => $Permissionitem['description'],
                    'model'         => $Permissionitem['model'],
                ]);
            }
        }
    }
}
