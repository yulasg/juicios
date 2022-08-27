$(document).ready(function () {
    const table = $('.tabla_agendas').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        searching: false,
        select: false,
        autowidth: false,
        order: [[1, 'desc']],
        ajax: {
            url: '/agenda/buscar',
            data: function (d) {
                d.inicio = $('.inicio').val()
            }
        },
        dataType: 'json',
        type: "POST",
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'inicio',
                name: 'inicio'
            },
            {
                data: 'destino',
                name: 'destino',
            },
            {
                data: 'asunto',
                name: 'asunto',
            },
            {
                data: 'referencia1',
                name: 'referencia1',
            },
            {
                data: 'referencia2',
                name: 'referencia2',
            },
            {
                data: 'botones',
                orderable: false
            },
        ],
 
      

       
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
        "> " ,
       

        buttons: [
            {
                extend: 'print',
                text:'<i class="fa fa-print"></i>',
                title: 'Listado de Agenda',
                titleAttr:'Imprimir',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5]
                }
                //className:'btn btn-info'

            },
            {
                extend: 'excel',
                text:'<i class="fas fa-file-excel"></i>',
                title: 'Listado de Agenda',
                titleAttr:'Exportar a Excel',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5]
                }
                //className:'btn btn-success'
            },
        ]
            

    })

    $('#buscar').click(function(){
        table.draw()
    })
})
