@extends('layouts.app')

@section('contenido')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <!--begin::Heading-->
                    <h3 class="fw-bolder my-2">Tribunales</h3>
                    <!--end::Heading-->
                    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                        title="Click para incluir tribunal">
                        <a href="{{ route('tribunales.create') }}" class="btn btn-sm btn-light btn-primary"
                            data-bs-target="#kt_modal_invite_friends">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                        rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Nuevo Tribunal
                        </a>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <!--begin::Alert-->
                    <div
                        class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row p-5 mb-10">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0"></span>
                        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <!--begin::Title-->
                            <h5 class="mb-1">Esta es una alerta</h5>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <span>{!! session('success') !!}</span>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Close-->
                        <button type="button"
                            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                            data-bs-dismiss="alert">
                            <i class="bi bi-x fs-1 text-danger"></i>
                        </button>
                        <!--end::Close-->
                    </div>
                    <!--end::Alert-->
                @endif
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <input type="hidden" name="role" id="role" value="{{ $role }}">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!-- <table id="kt_datatable_example_4" class="table table-striped table-row-bordered gy-5 gs-7">-->
                            <!--<table id="tabla_juicios" class="table align-middle table-row-dashed gs-7 gy-5">-->
                            <table id="tabla" class="table  table-striped table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th class="min-w-25px">Id</th>
                                        <th class="min-w-140px">Juzgado</th>
                                        <th class="min-w-140px">Tribunal</th>
                                        <th class="min-w-100px text-end">Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Tables Widget 9-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection

@push('pageScripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/tribunales/index.js') }}"></script>
    <script src="{{ asset('js/tribunales/eliminar.js') }}"></script>
@endpush
