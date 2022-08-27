@extends('layouts.app')

@section('contenido')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <!--begin::Heading-->
                    <h3 class="fw-bolder my-2">Representante N° {{ $representante->id }} 
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Editar</span>
                    </h3>
                    <!--end::Heading-->
                </div>
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body pt-5">
                        <!--begin::Form-->
                        <form action="" class="form mb-15 " method="POST" id="actualizar_representante"
                            name="actualizar_representante">
                            @csrf
                            <input type="hidden" name="representante_id" id="representante_id"
                                value="{{ $representante->id }}">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Naturaleza</label>
                                        <select disabled class="form-select  form-select-sm form-select-solid"
                                            data-control="select2" data-allow-clear="true" data-placeholder="Seleccionar..."
                                            name="tipo" id="tipo">
                                            <option></option>
                                            <option {{ $representante->tipo == 'V' ? 'selected' : '' }} value="V">V -
                                                Venezolano</option>
                                            <option {{ $representante->tipo == 'E' ? 'selected' : '' }} value="E">E -
                                                Extranjero</option>
                                            <option {{ $representante->tipo == 'J' ? 'selected' : '' }} value="J">J -
                                                Jurídico</option>
                                            <option {{ $representante->tipo == 'G' ? 'selected' : '' }} value="G">G -
                                                Gobierno</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-5 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="required fs-5 fw-bold mb-2">N° Identificación</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" disabled
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Identificación" id="numero" name="numero"
                                            value="{{ old('numero', $representante->identificador) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="required fs-5 fw-bold mb-2">N° Rif</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" disabled
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Rif" id="rifx" name="rifx"
                                            value="{{ old('rifx', $representante->rif) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <div class="row  mb-5">
                                <div class="col-sm-12 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="required fs-5 fw-bold mb-2">Nombre del Representante</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="Nombre del representante" id="nombre" name="nombre"
                                            value="{{ old('nombre', $representante->nombre) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                            </div>

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-2 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="fs-5 fw-bold mb-2">Código</label>
                                        <select class="form-select  form-select-sm form-select-solid" data-control="select2"
                                            data-allow-clear="true" data-placeholder="Seleccionar..." name="cod_cel_1"
                                            id="cod_cel_1">
                                            <option></option>
                                            <option {{ $representante->codigo_uno == '0412' ? 'selected' : '' }}
                                                value="0412">0412</option>
                                            <option {{ $representante->codigo_uno == '0414' ? 'selected' : '' }}
                                                value="0414">0414</option>
                                            <option {{ $representante->codigo_uno == '0424' ? 'selected' : '' }}
                                                value="0424">0424</option>
                                            <option {{ $representante->codigo_uno == '0426' ? 'selected' : '' }}
                                                value="0426">0426</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="fs-5 fw-bold mb-2">N° Celular Principal</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Celular Principal" id="celular_1" name="celular_1"
                                            value="{{ old('celular_1', $representante->celular_numuno) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <div class="col-sm-7 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="fs-5 fw-bold mb-2">Correo Electrónico Principal</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="Correo Electrónico Principal" id="email_principal"
                                            name="email_principal"
                                            value="{{ old('email_principal', $representante->email_principal) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-2 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="fs-5 fw-bold mb-2">Código</label>
                                        <select class="form-select  form-select-sm form-select-solid" data-control="select2"
                                            data-allow-clear="true" data-placeholder="Seleccionar..." name="cod_cel_2"
                                            id="cod_cel_2">
                                            <option></option>
                                            <option {{ $representante->codigo_dos == '0412' ? 'selected' : '' }}
                                                value="0412">0412</option>
                                            <option {{ $representante->codigo_dos == '0414' ? 'selected' : '' }}
                                                value="0414">0414</option>
                                            <option {{ $representante->codigo_dos == '0424' ? 'selected' : '' }}
                                                value="0424">0424</option>
                                            <option {{ $representante->codigo_dos == '0426' ? 'selected' : '' }}
                                                value="0426">0426</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="fs-5 fw-bold mb-2">N° Celular Secundario</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Celular Secundario" id="celular_2" name="celular_2"
                                            value="{{ old('celular_2', $representante->celular_numdos) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <div class="col-sm-7 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="fs-5 fw-bold mb-2">Correo Electrónico Secundario</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="Correo Electrónico Secundario" id="email_secundario"
                                            name="email_secundario"
                                            value="{{ old('email_secundario', $representante->email_secundario) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <div class="col-sm-2 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="fs-5 fw-bold mb-2">Código</label>
                                        <select class="form-select  form-select-sm form-select-solid"
                                            data-control="select2" data-allow-clear="true"
                                            data-placeholder="Seleccionar..." name="codigo" id="codigo">
                                            <option></option>
                                            <option {{ $representante->codigo_casa == '0248' ? 'selected' : '' }}
                                                value="0248">0248</option>
                                            <option {{ $representante->codigo_casa == '0281' ? 'selected' : '' }}
                                                value="0281">0281</option>
                                            <option {{ $representante->codigo_casa == '0282' ? 'selected' : '' }}
                                                value="0282">0282</option>
                                            <option {{ $representante->codigo_casa == '0283' ? 'selected' : '' }}
                                                value="0283">0283</option>
                                            <option {{ $representante->codigo_casa == '0285' ? 'selected' : '' }}
                                                value="0285">0285</option>
                                            <option {{ $representante->codigo_casa == '0292' ? 'selected' : '' }}
                                                value="0292">0292</option>
                                            <option {{ $representante->codigo_casa == '0240' ? 'selected' : '' }}
                                                value="0240">0240</option>
                                            <option {{ $representante->codigo_casa == '0247' ? 'selected' : '' }}
                                                value="0247">0247</option>
                                            <option {{ $representante->codigo_casa == '0278' ? 'selected' : '' }}
                                                value="0278">0278</option>
                                            <option {{ $representante->codigo_casa == '0243' ? 'selected' : '' }}
                                                value="0243">0243</option>
                                            <option {{ $representante->codigo_casa == '0244' ? 'selected' : '' }}
                                                value="0244">0244</option>
                                            <option {{ $representante->codigo_casa == '0246' ? 'selected' : '' }}
                                                value="0246">0246</option>
                                            <option {{ $representante->codigo_casa == '0273' ? 'selected' : '' }}
                                                value="0273">0273</option>
                                            <option {{ $representante->codigo_casa == '0284' ? 'selected' : '' }}
                                                value="0284">0284</option>
                                            <option {{ $representante->codigo_casa == '0286' ? 'selected' : '' }}
                                                value="0286">0286</option>
                                            <option {{ $representante->codigo_casa == '0288' ? 'selected' : '' }}
                                                value="0288">0288</option>
                                            <option {{ $representante->codigo_casa == '0289' ? 'selected' : '' }}
                                                value="0289">0289</option>
                                            <option {{ $representante->codigo_casa == '0241' ? 'selected' : '' }}
                                                value="0241">0241</option>
                                            <option {{ $representante->codigo_casa == '0242' ? 'selected' : '' }}
                                                value="0242">0242</option>
                                            <option {{ $representante->codigo_casa == '0245' ? 'selected' : '' }}
                                                value="0245">0245</option>
                                            <option {{ $representante->codigo_casa == '0249' ? 'selected' : '' }}
                                                value="0249">0249</option>
                                            <option {{ $representante->codigo_casa == '0258' ? 'selected' : '' }}
                                                value="0258">0258</option>
                                            <option {{ $representante->codigo_casa == '0287' ? 'selected' : '' }}
                                                value="0287">0287</option>
                                            <option {{ $representante->codigo_casa == '0212' ? 'selected' : '' }}
                                                value="0212">0212</option>
                                            <option {{ $representante->codigo_casa == '0259' ? 'selected' : '' }}
                                                value="0259">0259</option>
                                            <option {{ $representante->codigo_casa == '0268' ? 'selected' : '' }}
                                                value="0268">0268</option>
                                            <option {{ $representante->codigo_casa == '0269' ? 'selected' : '' }}
                                                value="0269">0269</option>
                                            <option {{ $representante->codigo_casa == '0279' ? 'selected' : '' }}
                                                value="0279">0279</option>
                                            <option {{ $representante->codigo_casa == '0235' ? 'selected' : '' }}
                                                value="0235">0235</option>
                                            <option {{ $representante->codigo_casa == '0238' ? 'selected' : '' }}
                                                value="0238">0238</option>
                                            <option {{ $representante->codigo_casa == '0251' ? 'selected' : '' }}
                                                value="0251">0251</option>
                                            <option {{ $representante->codigo_casa == '0252' ? 'selected' : '' }}
                                                value="0252">0252</option>
                                            <option {{ $representante->codigo_casa == '0253' ? 'selected' : '' }}
                                                value="0253">0253</option>
                                            <option {{ $representante->codigo_casa == '0271' ? 'selected' : '' }}
                                                value="0271">0271</option>
                                            <option {{ $representante->codigo_casa == '0274' ? 'selected' : '' }}
                                                value="0274">0274</option>
                                            <option {{ $representante->codigo_casa == '0275' ? 'selected' : '' }}
                                                value="0275">0275</option>
                                            <option {{ $representante->codigo_casa == '0234' ? 'selected' : '' }}
                                                value="0234">0234</option>
                                            <option {{ $representante->codigo_casa == '0239' ? 'selected' : '' }}
                                                value="0239">0239</option>
                                            <option {{ $representante->codigo_casa == '0295' ? 'selected' : '' }}
                                                value="0295">0295</option>
                                            <option {{ $representante->codigo_casa == '0255' ? 'selected' : '' }}
                                                value="0255">0255</option>
                                            <option {{ $representante->codigo_casa == '0256' ? 'selected' : '' }}
                                                value="0256">0256</option>
                                            <option {{ $representante->codigo_casa == '0257' ? 'selected' : '' }}
                                                value="0257">0257</option>
                                            <option {{ $representante->codigo_casa == '0272' ? 'selected' : '' }}
                                                value="0272">0272</option>
                                            <option {{ $representante->codigo_casa == '0293' ? 'selected' : '' }}
                                                value="0293">0293</option>
                                            <option {{ $representante->codigo_casa == '0294' ? 'selected' : '' }}
                                                value="0294">0294</option>
                                            <option {{ $representante->codigo_casa == '0276' ? 'selected' : '' }}
                                                value="0276">0276</option>
                                            <option {{ $representante->codigo_casa == '0277' ? 'selected' : '' }}
                                                value="0277">0277</option>
                                            <option {{ $representante->codigo_casa == '0254' ? 'selected' : '' }}
                                                value="0254">0254</option>
                                            <option {{ $representante->codigo_casa == '0261' ? 'selected' : '' }}
                                                value="0261">0261</option>
                                            <option {{ $representante->codigo_casa == '0262' ? 'selected' : '' }}
                                                value="0262">0262</option>
                                            <option {{ $representante->codigo_casa == '0263' ? 'selected' : '' }}
                                                value="0263">0263</option>
                                            <option {{ $representante->codigo_casa == '0264' ? 'selected' : '' }}
                                                value="0264">0264</option>
                                            <option {{ $representante->codigo_casa == '0265' ? 'selected' : '' }}
                                                value="0265">0265</option>
                                            <option {{ $representante->codigo_casa == '0266' ? 'selected' : '' }}
                                                value="0266">0266</option>
                                            <option {{ $representante->codigo_casa == '0267' ? 'selected' : '' }}
                                                value="0267">0267</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="fs-5 fw-bold mb-2">N° Habitación</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Habitación" id="habitacion" name="habitacion"
                                            value="{{ old('habitacion', $representante->numero_casa) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <div class="col-sm-7 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="fs-5 fw-bold mb-2">Dirección</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="Dirección" id="direccion" name="direccion"
                                            value="{{ old('direccion', $representante->direccion) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->


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
                        <button type="submit" class="btn btn-primary" id="editar" name="editar">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Actualizar</span>
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
    <script src="{{ asset('js/representantes/update.js') }}"></script>
    <script src="{{ asset('js/general/regresarRepresentante.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
