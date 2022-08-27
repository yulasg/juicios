"use strict";

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    //var table;
    var dt;


    // Private functions
    var initDatatable = function () {
        dt = $("#tabla_juicios").DataTable({
            //searchDelay: 500,
            processing: true,
            serverSide: true,
            dataType: 'json',
            type: 'POST',
            ajax: {
              

                ajax: '/juicio/consultajuicioespecialidad',
                /*
                data: function(d){
                    //d.interno_id = $('#interno_id').val()
                }
                */
            },
            

            columns: [
                {
                    data: 'juicio_id',
                    name: 'juicio_id'
                },
                {
                    data: 'j_internacional',
                    name: 'j_internacional'
                },
            
                {
                    data: 'j_origen',
                    name: 'j_origen'
                },
                {
                    data: 'e_especialidad',
                    name: 'e_especialidad'
                },
                {
                    data: 'demandantes',
                    name: 'demandantes',
                   
                },
                {
                    data: 'demandados',
                    name: 'demandados',
                   
                },
                {
                    data: 'terceros',
                    name: 'terceros',
                   
                },
                {
                    data: 'procedencia',
                    name: 'procedencia'
                },
                {
                    data: 'ubicacion',
                    name: 'ubicacion'
                },
                {
                    data: 'expediente',
                    name: 'expediente'
                },
                {
                    data: 'e_terminado',
                    name: 'e_terminado'
                },
                {
                    data: 'estatu',
                    name: 'estatu'
                },

                {
                    data: 'juzgado',
                    name: 'juzgado'
                },
                {
                    data: 'tribunal',
                    name: 'tribunal'
                },

                {
                    data: 'interno',
                    name: 'interno'
                },
                {
                    data: 'externo',
                    name: 'externo'
                },
                {
                    data: 'obligacion',
                    name: 'obligacion'
                },
                {
                    data: 'estado_procesal',
                    name: 'estado_procesal'
                },
                {
                    data: 'demanda',
                    name: 'demanda'
                },
                {
                    data: 'pretension',
                    name: 'pretension'
                },
                {
                    data: 'garantia',
                    name: 'garantia'
                },
                {
                    data: 'j_llevado',
                    name: 'j_llevado'
                },
                {
                    data: 'medida',
                    name: 'medida'
                },
                {
                    data: 'j_practicada',
                    name: 'j_practicada'
                },
                {
                    data: 'j_moneda',
                    name: 'j_moneda'
                },
                {
                    data: 'admision',
                    name: 'admision'
                },
                {
                    data: 'asignacion',
                    name: 'asignacion'
                },
                {
                    data: 'actuacion',
                    name: 'actuacion',
                },

                {
                    data: 'creacion',
                    name: 'creacion',

                },
                {
                    data: 'movimiento',
                    name: 'movimiento',

                },
                {
                    data: 'juez',
                    name: 'juez',

                },
                {
                    data: 'observacion',
                    name: 'observacion',

                },
                {
                    data: 'capital',
                    name: 'capital',

                },
                {
                    data: 'monto',
                    name: 'monto',

                },
                {
                    data: 'tasa',
                    name: 'tasa',

                },

            ],
          




            order: [[0, 'desc']],
            select: true,
            autowidth: false,
            language: {
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "lengthMenu": "Mostrar " +
                    `<select > 
                    <option value='10'>10</option>
                    <option value='25'>25</option>
                    <option value='50'>50</option>
                    <option value='100'>100</option>
                    <option value='-1'>Todos</option>
                </select>` +
                    " registros por página",
                "zeroRecords": "No se encontró registro",

                "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                //"info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No se encontró registro",
                "thousands": ".",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                'search': 'Buscar:',
                'paginate': {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
                ,
                /*
                select: {
                    rows: "%d fila(s) seleccionada(s)"
                }
                */
                
            },
            "dom":



                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "B" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",

            buttons: [
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    title: 'Listado de Juicios Especialidades',
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28,29,30,31,32,33,34]
                    }
                    //className:'btn btn-info'

                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    title: 'Listado de Juicios Especialidades',
                    titleAttr: 'Exportar a Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28,29,30,31,32,33,34]
                    }

                    //className:'btn btn-success'
                },



            ]


        });
        //table = dt.$;

        //Creamos una fila en el head de la tabla y lo clonamos para cada columna
        $('#tabla_juicios thead tr').clone(true).appendTo('#tabla_juicios thead');
        $('#tabla_juicios thead tr:eq(1) th').each(function (i) {
            var title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar...' + title + '" />');
            $('input', this).on('keyup change', function () {
                if (dt.column(i).search() !== this.value) {
                    dt
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });



        //const filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');
        /*
        interno_id = $('#interno_id').val();
        const submitButton = document.getElementById('filtrar');
       
   

        // Filter datatable on submit
        submitButton.addEventListener('click', function () {
            console.log('entre');
            console.log( interno_id );
            // Get filter values
            let paymentValue = '';
            paymentValue =   interno_id ;



            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search(paymentValue).draw();
        });
        */


        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            KTMenu.createInstances();
        });
    }





    // Public methods
    return {
        init: function () {
            initDatatable();

        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});