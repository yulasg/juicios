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
                    <h3 class="fw-bolder my-2">Crear Parte Procesal</h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <!--begin::Form-->
                        <form action="{{ route('referencias.store') }}" class="form mb-15 " method="POST"
                            id="registrar_referencia" name="registrar_referencia">
                            @csrf
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Naturaleza</label>
                                        <select class="form-select  form-select-sm form-select-solid" data-control="select2"
                                            data-allow-clear="true" data-placeholder="Seleccionar..." name="tipo"
                                            id="tipo">
                                            <option></option>
                                            <option value="V">V - Venezolano</option>
                                            <option value="E">E - Extranjero</option>
                                            <option value="J">J - Jurídico</option>
                                            <option value="G">G - Gobierno</option>
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
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Identificación" id="numero" name="numero" />
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
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Rif" id="rifx" name="rifx" />
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
                                        <label class="required fs-5 fw-bold mb-2">Nombre de la Parte</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="Nombre de la parte" id="nombre" name="nombre" />
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
                                            data-placeholder="Seleccionar..." name="cod_cel_1" id="cod_cel_1">
                                            <option></option>
                                            <option value="0412">0412</option>
                                            <option value="0414">0414</option>
                                            <option value="0424">0424</option>
                                            <option value="0416">0416</option>
                                            <option value="0424">0426</option>
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
                                            placeholder="N° Celular Principal" id="celular_1" name="celular_1" />
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
                                            name="email_principal" />
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
                                            data-placeholder="Seleccionar..." name="cod_cel_2" id="cod_cel_2">
                                            <option></option>
                                            <option value="0412">0412</option>
                                            <option value="0414">0414</option>
                                            <option value="0424">0424</option>
                                            <option value="0416">0416</option>
                                            <option value="0424">0426</option>
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
                                            placeholder="N° Celular Secundario" id="celular_2" name="celular_2" />
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
                                            name="email_secundario" />
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
                                        <select class="form-select  form-select-sm form-select-solid"
                                            data-control="select2" data-placeholder="Seleccionar..." name="codigo"
                                            id="codigo">
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
                                            placeholder="N° Habitación" id="habitacion" name="habitacion" />
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
                                            placeholder="Dirección" id="direccion" name="direccion" />
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
                        <button type="submit" class="btn btn-primary" id="crear" name="crear">
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
    <script src="{{ asset('js/referencias/store.js') }}"></script>
    <script src="{{ asset('js/general/regresarReferencia.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
