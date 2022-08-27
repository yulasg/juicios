<div class="d-flex justify-content-end flex-shrink-0">
    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
        Acciones
        <span class="svg-icon svg-icon-5 m-0">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                    <path
                        d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                        fill="#000000" fill-rule="nonzero"
                        transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)">
                    </path>
                </g>
            </svg>
        </span>
    </a>

    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
        data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="{{ route('juicios.edit', $id) }}" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                Editar
            </a>
        </div>
        <!--end::Menu item--> 
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="{{ route('juicios.show', $id) }}" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                Ver Ficha
            </a>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="#" class="delete_juicio  menu-link px-3" data-kt-docs-table-filter="delete_row"
                name="delete_juicio" id="{{ $id }}">
                Eliminar
            </a>
        </div>
        <!--end::Menu item-->
        <div class="separator border-gray-300"></div>
        <!--begin::Menu item-->
        @if ($especialidad_id == 1 || $especialidad_id == 2)
            <div class="menu-item px-3">
                <a href="{{ route('personas.index', [$id, $especialidad_id]) }}" class="menu-link px-3"
                    data-kt-docs-table-filter="edit_row">
                    Parte Procesal
                </a>
            </div>
        @else
            <div class="menu-item px-3">
                <a href="{{ route('actores.index', [$id, $especialidad_id]) }}" class="menu-link px-3"
                    data-kt-docs-table-filter="edit_row">
                    Parte Procesal
                </a>
            </div>
        @endif
        <!--end::Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="{{ route('datos.index', $id) }}" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                Datos
            </a>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="{{ route('documentos.index', $id) }}" class="menu-link px-3"
                data-kt-docs-table-filter="edit_row">
                Pagares
            </a>
        </div>

        <div class="separator border-gray-300"></div>
        <!--end::Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="{{ route('seguimientos.index', $id) }}" class="menu-link px-3"
                data-kt-docs-table-filter="edit_row">
                Actuaciones
            </a>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="{{ route('movimientos.index', $id) }}" class="menu-link px-3"
                data-kt-docs-table-filter="edit_row">
                Actividades
            </a>
        </div>

        <!--end::Menu item-->
      
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="{{ route('abogados.index', $id) }}" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                Asignar
            </a>
        </div>
        <!--end::Menu item-->

        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="{{ route('relaciones.index', $id) }}" class="menu-link px-3"
                data-kt-docs-table-filter="edit_row">
                Relacionar
            </a>
        </div>
        <!--end::Menu item-->


    </div>
    <!--end::Menu-->
</div>
