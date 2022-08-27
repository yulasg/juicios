<?php

namespace Database\Seeders;

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
            
            [
                'name'        => 'Ver Juicios',
                'slug'        => 'ver.juicios',
                'description' => 'Ver Juicios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Juicios',
                'slug'        => 'crear.juicios',
                'description' => 'Crear Juicios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Juicios',
                'slug'        => 'editar.juicios',
                'description' => 'Editar Juicios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Juicios',
                'slug'        => 'eliminar.juicios',
                'description' => 'Eliminar Juicios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Juicios',
                'slug'        => 'imprimir.juicios',
                'description' => 'Imprimir Juicios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Juicios',
                'slug'        => 'exportar.juicios',
                'description' => 'Exportar Juicios',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Actores',
                'slug'        => 'ver.actores',
                'description' => 'Ver Actores',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Actores',
                'slug'        => 'crear.actores',
                'description' => 'Crear Actores',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Actores',
                'slug'        => 'editar.actores',
                'description' => 'Editar Actores',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Actores',
                'slug'        => 'eliminar.actores',
                'description' => 'Eliminar Actores',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Actores',
                'slug'        => 'imprimir.actores',
                'description' => 'Imprimir Actores',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Actores',
                'slug'        => 'exportar.actores',
                'description' => 'Exportar Actores',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Representates',
                'slug'        => 'ver.representates',
                'description' => 'Ver Representates',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Representates',
                'slug'        => 'crear.representates',
                'description' => 'Crear Representates',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Representates',
                'slug'        => 'editar.representates',
                'description' => 'Editar Representates',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Representates',
                'slug'        => 'eliminar.representates',
                'description' => 'Eliminar Representates',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Representates',
                'slug'        => 'imprimir.representates',
                'description' => 'Imprimir Representates',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Representates',
                'slug'        => 'exportar.representates',
                'description' => 'Exportar Representates',
                'model'       => 'Permission',
            ],


            [
                'name'        => 'Ver Actuaciones',
                'slug'        => 'ver.actuaciones',
                'description' => 'Ver Actuaciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Actuaciones',
                'slug'        => 'crear.actuaciones',
                'description' => 'Crear Actuaciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Actuaciones',
                'slug'        => 'editar.actuaciones',
                'description' => 'Editar Actuaciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Actuaciones',
                'slug'        => 'eliminar.actuaciones',
                'description' => 'Eliminar Actuaciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Actuaciones',
                'slug'        => 'imprimir.actuaciones',
                'description' => 'Imprimir Actuaciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Actuaciones',
                'slug'        => 'exportar.actuaciones',
                'description' => 'Exportar Actuaciones',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Actividades',
                'slug'        => 'ver.actividades',
                'description' => 'Ver Actividades',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Actividades',
                'slug'        => 'crear.actividades',
                'description' => 'Crear Actividades',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Actividades',
                'slug'        => 'editar.actividades',
                'description' => 'Editar Actividades',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Actividades',
                'slug'        => 'eliminar.actividades',
                'description' => 'Eliminar Actividades',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Actividades',
                'slug'        => 'imprimir.actividades',
                'description' => 'Imprimir Actividades',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Actividades',
                'slug'        => 'exportar.actividades',
                'description' => 'Exportar Actividades',
                'model'       => 'Permission',
            ],


            [
                'name'        => 'Ver Personas',
                'slug'        => 'ver.personas',
                'description' => 'Ver Personas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Personas',
                'slug'        => 'crear.personas',
                'description' => 'Crear Personas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Personas',
                'slug'        => 'editar.personas',
                'description' => 'Editar Personas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Personas',
                'slug'        => 'eliminar.personas',
                'description' => 'Eliminar Personas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Personas',
                'slug'        => 'imprimir.personas',
                'description' => 'Imprimir Personas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Personas',
                'slug'        => 'exportar.personas',
                'description' => 'Exportar Personas',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Partes',
                'slug'        => 'ver.partes',
                'description' => 'Ver Partes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Partes',
                'slug'        => 'crear.partes',
                'description' => 'Crear Partes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Partes',
                'slug'        => 'editar.partes',
                'description' => 'Editar Partes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Partes',
                'slug'        => 'eliminar.partes',
                'description' => 'Eliminar Partes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Partes',
                'slug'        => 'imprimir.partes',
                'description' => 'Imprimir Partes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Partes',
                'slug'        => 'exportar.partes',
                'description' => 'Exportar Partes',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Pagares',
                'slug'        => 'ver.Pagares',
                'description' => 'Ver Pagares',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Pagares',
                'slug'        => 'crear.Pagares',
                'description' => 'Crear Pagares',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Pagares',
                'slug'        => 'editar.Pagares',
                'description' => 'Editar Pagares',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Pagares',
                'slug'        => 'eliminar.Pagares',
                'description' => 'Eliminar Pagares',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Pagares',
                'slug'        => 'imprimir.Pagares',
                'description' => 'Imprimir Pagares',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Pagares',
                'slug'        => 'exportar.Pagares',
                'description' => 'Exportar Pagares',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Agendas',
                'slug'        => 'ver.agendas',
                'description' => 'Ver Agendas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Agendas',
                'slug'        => 'crear.agendas',
                'description' => 'Crear Agendas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Agendas',
                'slug'        => 'editar.agendas',
                'description' => 'Editar Agendas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Agendas',
                'slug'        => 'eliminar.agendas',
                'description' => 'Eliminar Agendas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Agendas',
                'slug'        => 'imprimir.Agendas',
                'description' => 'Imprimir Agendas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Agendas',
                'slug'        => 'exportar.agendas',
                'description' => 'Exportar Agendas',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Abogados',
                'slug'        => 'ver.abogados',
                'description' => 'Ver Abogados Asignados',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Abogados',
                'slug'        => 'crear.abogados',
                'description' => 'Crear Abogados Asignados',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Abogados',
                'slug'        => 'eliminar.abogados',
                'description' => 'Eliminar Abogados Asignados',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Abogados',
                'slug'        => 'imprimir.abogados',
                'description' => 'Imprimir Abogados Asignados',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Abogados',
                'slug'        => 'exportar.abogados',
                'description' => 'Exportar Abogados Asignados',
                'model'       => 'Permission',
            ],


            [
                'name'        => 'Ver Relacionar',
                'slug'        => 'ver.relacionar',
                'description' => 'Ver Relacionar Juicios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Relacionar',
                'slug'        => 'crear.relacionar',
                'description' => 'Crear Relacionar Juicios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Relacionar',
                'slug'        => 'editar.relacionar',
                'description' => 'Editar Relacionar Juicios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Relacionar',
                'slug'        => 'eliminar.relacionar',
                'description' => 'Eliminar Relacionar Juicios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Relacionar',
                'slug'        => 'imprimir.relacionar',
                'description' => 'Imprimir Relacionar Juicios',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Relacionar',
                'slug'        => 'exportar.relacionar',
                'description' => 'Exportar Relacionar Juicios',
                'model'       => 'Permission',
            ],


            [
                'name'        => 'Ver Especialidades',
                'slug'        => 'ver.especialidades',
                'description' => 'Ver Especialidades',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Especialidades',
                'slug'        => 'crear.especialidades',
                'description' => 'Crear Especialidades',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Especialidades',
                'slug'        => 'editar.especialidades',
                'description' => 'Editar Especialidades',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Especialidades',
                'slug'        => 'eliminar.especialidades',
                'description' => 'Eliminar Especialidades',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Especialidades',
                'slug'        => 'imprimir.especialidades',
                'description' => 'Imprimir Especialidades',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Especialidades',
                'slug'        => 'exportar.especialidades',
                'description' => 'Exportar Especialidades',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Configuraciones',
                'slug'        => 'ver.configuraciones',
                'description' => 'Ver Configuraciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Configuraciones',
                'slug'        => 'crear.configuraciones',
                'description' => 'Crear Configuraciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Configuraciones',
                'slug'        => 'editar.configuraciones',
                'description' => 'Editar Configuraciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Configuraciones',
                'slug'        => 'eliminar.configuraciones',
                'description' => 'Eliminar Configuraciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Configuraciones',
                'slug'        => 'imprimir.configuraciones',
                'description' => 'Imprimir Configuraciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Configuraciones',
                'slug'        => 'exportar.configuraciones',
                'description' => 'Exportar Configuraciones',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Procesos',
                'slug'        => 'ver.procesos',
                'description' => 'Ver Procesos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Procesos',
                'slug'        => 'crear.procesos',
                'description' => 'Crear Procesos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Procesos',
                'slug'        => 'editar.procesos',
                'description' => 'Editar Procesos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Procesos',
                'slug'        => 'eliminar.procesos',
                'description' => 'Eliminar Procesos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Procesos',
                'slug'        => 'imprimir.procesos',
                'description' => 'Imprimir Procesos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Procesos',
                'slug'        => 'exportar.procesos',
                'description' => 'Exportar Procesos',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Medidas',
                'slug'        => 'ver.medidas',
                'description' => 'Ver Medidas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Medidas',
                'slug'        => 'crear.medidas',
                'description' => 'Crear Medidas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Medidas',
                'slug'        => 'editar.medidas',
                'description' => 'Editar Medidas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Medidas',
                'slug'        => 'eliminar.medidas',
                'description' => 'Eliminar Medidas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Medidas',
                'slug'        => 'imprimir.medidas',
                'description' => 'Imprimir Medidas',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Medidas',
                'slug'        => 'exportar.medidas',
                'description' => 'Exportar Medidas',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Obligaciones',
                'slug'        => 'ver.obligaciones',
                'description' => 'Ver Obligaciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Obligaciones',
                'slug'        => 'crear.obligaciones',
                'description' => 'Crear Obligaciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Obligaciones',
                'slug'        => 'editar.obligaciones',
                'description' => 'Editar Obligaciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Obligaciones',
                'slug'        => 'eliminar.obligaciones',
                'description' => 'Eliminar Obligaciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Obligaciones',
                'slug'        => 'imprimir.obligaciones',
                'description' => 'Imprimir Obligaciones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Obligaciones',
                'slug'        => 'exportar.obligaciones',
                'description' => 'Exportar Obligaciones',
                'model'       => 'Permission',
            ],
            
            [
                'name'        => 'Ver Pretensiones',
                'slug'        => 'ver.pretensiones',
                'description' => 'Ver Pretensiones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Pretensiones',
                'slug'        => 'crear.pretensiones',
                'description' => 'Crear Pretensiones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Pretensiones',
                'slug'        => 'editar.pretensiones',
                'description' => 'Editar Pretensiones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Pretensiones',
                'slug'        => 'eliminar.pretensiones',
                'description' => 'Eliminar Pretensiones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Pretensiones',
                'slug'        => 'imprimir.pretensiones',
                'description' => 'Imprimir Pretensiones',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Pretensiones',
                'slug'        => 'exportar.pretensiones',
                'description' => 'Exportar Pretensiones',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Garantías',
                'slug'        => 'ver.garantías',
                'description' => 'Ver Garantías',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Garantías',
                'slug'        => 'crear.garantías',
                'description' => 'Crear Garantías',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Garantías',
                'slug'        => 'editar.garantías',
                'description' => 'Editar Garantías',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Garantías',
                'slug'        => 'eliminar.garantías',
                'description' => 'Eliminar Garantías',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Garantías',
                'slug'        => 'imprimir.garantías',
                'description' => 'Imprimir Garantías',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Garantías',
                'slug'        => 'exportar.garantías',
                'description' => 'Exportar Garantías',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Juzgados',
                'slug'        => 'ver.juzgados',
                'description' => 'Ver Juzgados',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Juzgados',
                'slug'        => 'crear.juzgados',
                'description' => 'Crear Juzgados',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Juzgados',
                'slug'        => 'editar.juzgados',
                'description' => 'Editar Juzgados',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Juzgados',
                'slug'        => 'eliminar.juzgados',
                'description' => 'Eliminar Juzgados',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Juzgados',
                'slug'        => 'imprimir.juzgados',
                'description' => 'Imprimir Juzgados',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Juzgados',
                'slug'        => 'exportar.juzgados',
                'description' => 'Exportar Juzgados',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Tribunales',
                'slug'        => 'ver.tribunales',
                'description' => 'Ver Tribunales',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Tribunales',
                'slug'        => 'crear.tribunales',
                'description' => 'Crear Tribunales',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Tribunales',
                'slug'        => 'editar.tribunales',
                'description' => 'Editar Tribunales',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Tribunales',
                'slug'        => 'eliminar.tribunales',
                'description' => 'Eliminar Tribunales',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Tribunales',
                'slug'        => 'imprimir.tribunales',
                'description' => 'Imprimir Tribunales',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Tribunales',
                'slug'        => 'exportar.tribunales',
                'description' => 'Exportar Tribunales',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Internos',
                'slug'        => 'ver.internos',
                'description' => 'Ver Abogados Internos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Internos',
                'slug'        => 'crear.internos',
                'description' => 'Crear Abogados Internos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Internos',
                'slug'        => 'editar.internos',
                'description' => 'Editar Abogados Internos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Internos',
                'slug'        => 'eliminar.internos',
                'description' => 'Eliminar Abogados Internos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Internos',
                'slug'        => 'imprimir.internos',
                'description' => 'Imprimir Abogados Internos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Internos',
                'slug'        => 'exportar.internos',
                'description' => 'Exportar Abogados Internos',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Externos',
                'slug'        => 'ver.externos',
                'description' => 'Ver Abogados Externos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Externos',
                'slug'        => 'crear.externos',
                'description' => 'Crear Abogados Externos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Externos',
                'slug'        => 'editar.externos',
                'description' => 'Editar Abogados Externos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Externos',
                'slug'        => 'eliminar.externos',
                'description' => 'Eliminar Abogados Externos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Externos',
                'slug'        => 'imprimir.externos',
                'description' => 'Imprimir Abogados Externos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Externos',
                'slug'        => 'exportar.externos',
                'description' => 'Exportar Abogados Externos',
                'model'       => 'Permission',
            ],
            

            [
                'name'        => 'Ver Actividad',
                'slug'        => 'ver.actividad',
                'description' => 'Ver Actividad Procesal',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Actividad',
                'slug'        => 'crear.actividad',
                'description' => 'Crear Actividad Procesal',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Actividad',
                'slug'        => 'editar.actividad',
                'description' => 'Editar Actividad Procesal',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Actividad',
                'slug'        => 'eliminar.actividad',
                'description' => 'Eliminar Actividad Procesal',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Actividad',
                'slug'        => 'imprimir.actividad',
                'description' => 'Imprimir Actividad Procesal',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Actividad',
                'slug'        => 'exportar.actividad',
                'description' => 'Exportar Actividad Procesal',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Procesal',
                'slug'        => 'ver.procesal',
                'description' => 'Ver Estado Procesal',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Procesal',
                'slug'        => 'crear.procesal',
                'description' => 'Crear Estado Procesal',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Procesal',
                'slug'        => 'editar.procesal',
                'description' => 'Editar Estado Procesal',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Procesal',
                'slug'        => 'eliminar.procesal',
                'description' => 'Eliminar Estado Procesal',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Procesal',
                'slug'        => 'imprimir.procesal',
                'description' => 'Imprimir Estado Procesal',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Procesal',
                'slug'        => 'exportar.procesal',
                'description' => 'Exportar Estado Procesal',
                'model'       => 'Permission',
            ],


            [
                'name'        => 'Ver Tipos',
                'slug'        => 'ver.tipos',
                'description' => 'Ver Tipos de Documentos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Tipos',
                'slug'        => 'crear.tipos',
                'description' => 'Crear Tipos de Documentos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Tipos',
                'slug'        => 'editar.tipos',
                'description' => 'Editar Tipos de Documentos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Tipos',
                'slug'        => 'eliminar.tipos',
                'description' => 'Eliminar Tipos de Documentos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Tipos',
                'slug'        => 'imprimir.tipos',
                'description' => 'Imprimir Tipos de Documentos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Tipos',
                'slug'        => 'exportar.tipos',
                'description' => 'Exportar Tipos de Documentos',
                'model'       => 'Permission',
            ],


            [
                'name'        => 'Ver Estatus',
                'slug'        => 'ver.estatus',
                'description' => 'Ver Estatus',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Estatus',
                'slug'        => 'crear.estatus',
                'description' => 'Crear Estatus',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Estatus',
                'slug'        => 'editar.estatus',
                'description' => 'Editar Estatus',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Estatus',
                'slug'        => 'eliminar.estatus',
                'description' => 'Eliminar Estatus',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Estatus',
                'slug'        => 'imprimir.estatus',
                'description' => 'Imprimir Estatus',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Estatus',
                'slug'        => 'exportar.estatus',
                'description' => 'Exportar Estatus',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Archivos',
                'slug'        => 'ver.archivos',
                'description' => 'Ver Archivos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Archivos',
                'slug'        => 'crear.archivos',
                'description' => 'Crear Archivos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Archivos',
                'slug'        => 'editar.archivos',
                'description' => 'Editar Archivos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Archivos',
                'slug'        => 'eliminar.archivos',
                'description' => 'Eliminar Archivos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Archivos',
                'slug'        => 'imprimir.archivos',
                'description' => 'Imprimir Archivos',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Archivos',
                'slug'        => 'exportar.archivos',
                'description' => 'Exportar Archivos',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Personas Representantes',
                'slug'        => 'ver.personas.representantes',
                'description' => 'Ver Personas Representantes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Personas Representantes',
                'slug'        => 'crear.personas.representantes',
                'description' => 'Crear Personas Representantes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Personas Representantes',
                'slug'        => 'editar.personas.representantes',
                'description' => 'Editar Personas Representantes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Personas Representantes',
                'slug'        => 'eliminar.personas.representantes',
                'description' => 'Eliminar Personas Representantes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Personas Representantes',
                'slug'        => 'imprimir.personas.representantes',
                'description' => 'Imprimir Personas Representantes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Personas Representantes',
                'slug'        => 'exportar.personas.representantes',
                'description' => 'Exportar Personas Representantes',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Ver Actores Representantes',
                'slug'        => 'ver.actores.representantes',
                'description' => 'Ver Actores Representantes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Crear Actores Representantes',
                'slug'        => 'crear.actores.representantes',
                'description' => 'Crear Actores Representantes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Editar Actores Representantes',
                'slug'        => 'editar.actores.representantes',
                'description' => 'Editar Actores Representantes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Eliminar Actores Representantes',
                'slug'        => 'eliminar.actores.representantes',
                'description' => 'Eliminar Actores Representantes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Imprimir Actores Representantes',
                'slug'        => 'imprimir.actores.representantes',
                'description' => 'Imprimir Actores Representantes',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Exportar Actores Representantes',
                'slug'        => 'exportar.actores.representantes',
                'description' => 'Exportar Actores Representantes',
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
