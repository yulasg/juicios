$(document).ready(function () {
    $('#tabla_juicios').DataTable({
        ajax: '/juicios',
        dataType: 'json',
        serverSide: true,
        procesing: true,
        type: 'POST',
        columns: [
            {
                data: 'id',
                name: 'id'
                //ordertable:false
            },
            {
                data: 'internacional',
                name: 'internacional'
            },
            {
                data: 'origen',
                name: 'origen'
                /*
                render: function (data) {
                    let tipoOrigen = '';
                    switch (data) {
                        case 'F':
                            tipoOrigen = 'Fogade';
                            break;
                        case 'B':
                            tipoOrigen = 'Banca en Liquidación';
                            break;
                        case 'A':
                            tipoOrigen = 'Fogade / Banca en Liquidación';
                            break;
                        case 'C':
                            tipoOrigen = 'Crédito Cedido a Fogade';
                            break;
                    }
                    return tipoOrigen;
                }
                */
            },
            {
                data: 'procedencia.descripcion',
                name: 'procedencia.descripcion'
            },
            {
                data: 'ubicacion.descripcion',
                name: 'ubicacion.descripcion'
            },
            {
                data: 'expediente',
                name: 'expediente'
            },
            {
                data: 'estatu.terminado',
                name: 'estatu.terminado'
                /*
                render: function (data) {
                    let tipoTerminado = '';
                    switch (data) {
                        case 'S':
                            tipoTerminado = 'Si';
                            break;
                        case 'N':
                            tipoTerminado = 'No';
                            break;

                    }
                    return tipoTerminado;
                }*/
            },
            {
                data: 'estatu.descripcion',
                name: 'estatu.descripcion'
            },
            {
                data: 'tribunal.juzgado.descripcion',
                name: 'tribunal.juzgado.descripcion'
            },
            {
                data: 'tribunal.descripcion',
                name: 'tribunal.descripcion'
            },
            {
                data: 'interno.nombre',
                name: 'interno.nombre'
            },
            {
                data: 'externo.nombre',
                name: 'externo.nombre'
            },
            {
                data: 'obligacion.descripcion',
                name: 'obligacion.descripcion'
            },
            {
                data: 'estado.descripcion',
                name: 'estado.descripcion'
            },
            {
                data: 'demanda.descripcion',
                name: 'demanda.descripcion'
            },
            {
                data: 'pretension.descripcion',
                name: 'pretension.descripcion'
            },
            {
                data: 'garantia.descripcion',
                name: 'garantia.descripcion'
            },
            {
                data: 'llevado',
                name: 'llevado'
            },
            {
                data: 'medida.descripcion',
                name: 'medida.descripcion'
            },
            {
                data: 'practicada',
                name: 'practicada'
            },
            {
                data: 'moneda',
                name: 'moneda'
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
                data: 'movimiento',
                name: 'movimiento',

            },
            {
                data: 'creacion',
                name: 'creacion',
                //defaultContent: ''

            },
            {
                data: 'botones',
                orderable: false
            },
         
        ],
        columnDefs: [
            {
                targets: [], visible: true, searchable: true, orderable: true,
                render: function (data, type, row) {
                    let tipoJuicio = '';
                    if (type === 'display' || type === 'filter') {
                        switch (data) {
                            case 'I':
                                tipoJuicio = 'Internacional';
                                //return $.fn.DataTable.render.tStext('Internacional').display();
                                break;
                            case 'N':
                                tipoJuicio = 'Nacional';
                                //return $.fn.DataTable.render.text('Nacional').display();
                                break;
                        }
                        return tipoJuicio;
                    }
                    return data;
                },
            },
            {
                targets: [],
                render: function (data) {
                    if (typeof data === "undefined") {
                        return data = '';
                    } else {
                        return moment(data).format('DD-MM-YYYY');
                    }

                }
            },
        ],

        responsive: true,
        select: true,
        autowidth: false,
        order: [0, 'desc'],
        //<option value='-1'>Todos</option>
        language: {
            "lengthMenu": "Mostrar " +
                `<select > 
                <option value='10'>10</option>
                <option value='25'>25</option>
                <option value='50'>50</option>
                <option value='100'>100</option>
            </select>` +
                " registros por página",
            "zeroRecords": "No se encontró registro",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontró registro",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            'search': 'Buscar:',
            'paginate': {
                'next': 'Siguiente',
                'previous': 'Anterior'
            },
            select: {
                rows: "%d fila(s) seleccionada(s)"
            }
        },
        "dom":
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +
            "<'table-responsive'tr>" +
            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
    });
});