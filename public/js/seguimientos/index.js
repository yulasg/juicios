"use strict";
const juicio_id = $('#juicio_id').val();
// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;
 
 
    // Private functions
    var initDatatable = function () {
        dt = $("#tabla_seguimientos").DataTable({
            //searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [0, 'desc'],
            //order: [[1, 'desc']],
         
            ajax: '/seguimientos/'+juicio_id,
         
            columns: [
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'botones',
                    orderable: false,
                },
                {
                    data: 'fecha',
                    name: 'fecha',
                },
                {
                    data: 'usuario',
                    name: 'usuario',
                    defaultContent: ''
                },
                {
                    data: 'actividad.descripcion',
                    name: 'actividad.descripcion',
                },
                {
                    data: 'seguimiento',
                    name: 'seguimiento',
                },
       
            ],


            responsive: true,
            //select: true,
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
            "B"+
            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">",
            buttons: [

                {
                    extend: 'print',
                    text:'<i class="fa fa-print"></i>',
                    title: 'Seguimientos al Juicio N° '+juicio_id,
                    titleAttr:'Imprimir',
                    exportOptions: {
                        columns: [ 0, 2, 3, 4, 5 ]
                    }
                    //className:'btn btn-info'
   
                },
                {
                    extend: 'excel',
                    text:'<i class="fas fa-file-excel"></i>',
                    title: 'Seguimientos al Juicio N°'+juicio_id,
                    titleAttr:'Exportar a Excel',
                    exportOptions: {
                        columns: [ 0, 2, 3 , 4, 5]
                    }
                    //className:'btn btn-success'
                },
            ]
      
           
        });

        table = dt.$;

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