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
                    <h3 class="fw-bolder my-2">Juicio N° {{ $dataJuicio }} 
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Crear Parte Procesal</span>
                    </h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <!--begin::Form-->
                        <form action="{{ route('personas.store') }}" class="form mb-15 " method="POST"
                            id="registrar_demandado" name="registrar_demandado">
                            @csrf
                            <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}">
                            <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dataJuicio }}">
                            <input type="hidden" name="especialidad_id" id="especialidad_id"
                                value="{{ $dataespecialidad }}">
                            <input type="hidden" name="representante" id="representante" value="{{ $datarepresentante }}">
                            <div class="row  mb-5">
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Parte Procesal</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="configuracion_id"
                                                name="configuracion_id">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->

                                <div class="col-sm-8 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Nombre</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="Nombre de la parte procesal" id="nombre" name="nombre" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Naturaleza</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="persona" name="persona">
                                                <option></option>
                                                <option value="V">V - Venezolano</option>
                                                <option value="E">E - Extranjero</option>
                                                <option value="J">J - Jurídico</option>
                                                <option value="G">G - Gobierno</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-5 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">N° Identificación</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="Cédula o Rif" id="numero" name="numero" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">N°</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="Rif" id="rif" name="rif" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Cod.</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="codigo" name="codigo">
                                                <option></option>
                                                <option value="0412">0412</option>
                                                <option value="0414">0414</option>
                                                <option value="0424">0424</option>
                                                <option value="0416">0416</option>
                                                <option value="0424">0426</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Celular</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="N° Celular Principal" id="celular" name="celular" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Cod.</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select  form-select-sm rounded-start-0"
                                                data-control="select2" data-placeholder="Seleccionar..."
                                                data-allow-clear="true" name="codigoHab" id="codigoHab">
                                                <option></option>
                                                <option value="0281">0281</option>
                                                <option value="0282">0282</option>
                                                <option value="0283">0283</option>
                                                <option value="0285">0285</option>
                                                <option value="0292">0292</option>
                                                <option value="0240">0240</option>
                                                <option value="0247">0247</option>
                                                <option value="0278">0278</option>
                                                <option value="0243">0243</option>
                                                <option value="0244">0244</option>
                                                <option value="0246">0246</option>
                                                <option value="0273">0273</option>
                                                <option value="0284">0284</option>
                                                <option value="0286">0286</option>
                                                <option value="0288">0288</option>
                                                <option value="0289">0289</option>
                                                <option value="0241">0241</option>
                                                <option value="0242">0242</option>
                                                <option value="0245">0245</option>
                                                <option value="0249">0249</option>
                                                <option value="0258">0258</option>
                                                <option value="0287">0287</option>
                                                <option value="0212">0212</option>
                                                <option value="0259">0259</option>
                                                <option value="0268">0268</option>
                                                <option value="0269">0269</option>
                                                <option value="0279">0279</option>
                                                <option value="0235">0235</option>
                                                <option value="0238">0238</option>
                                                <option value="0251">0251</option>
                                                <option value="0252">0252</option>
                                                <option value="0253">0253</option>
                                                <option value="0271">0271</option>
                                                <option value="0274">0274</option>
                                                <option value="0275">0275</option>
                                                <option value="0234">0234</option>
                                                <option value="0239">0239</option>
                                                <option value="0295">0295</option>
                                                <option value="0255">0255</option>
                                                <option value="0256">0256</option>
                                                <option value="0257">0257</option>
                                                <option value="0272">0272</option>
                                                <option value="0293">0293</option>
                                                <option value="0294">0294</option>
                                                <option value="0276">0276</option>
                                                <option value="0277">0277</option>
                                                <option value="0254">0254</option>
                                                <option value="0261">0261</option>
                                                <option value="0262">0262</option>
                                                <option value="0263">0263</option>
                                                <option value="0264">0264</option>
                                                <option value="0265">0265</option>
                                                <option value="0266">0266</option>
                                                <option value="0267">0267</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Hab.</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="N° Habitación" id="habitacion" name="habitacion" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->

                            </div>
                            <!--end::Input group-->


                            <div class="row  mb-5">
                                <div class="col-sm-12 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Dirección</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="Dirección" id="direccion" name="direccion" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row  mb-5">
                                <div class="col-sm-12 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Correo Electrónico</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="Correo Electrónico" id="email" name="email" />
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <!--begin::Submit-->
                        <button type="submit" class="btn btn-primary" id="regresar" name="regresar">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Regresar</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator-->
                        </button>
                        <!--end::Submit-->
                    </div>
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-2">
                        <!--begin::Submit-->
                        <button type="submit" class="btn btn-primary" id="crearDemandado" name="crearDemandado">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Guardar</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator-->
                        </button>
                        <!--end::Submit-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/personas/cargarSelects.js') }}"></script>
    <script src="{{ asset('js/personas/select2.js') }}"></script>
    <script src="{{ asset('js/personas/store.js') }}"></script>
    <script src="{{ asset('js/general/regresarPersona.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
