<?/*?>
<div class="col-xxl-12">
    <!--begin::List Widget 6-->
    <div class="card card-xl-stretch mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title fw-bolder text-dark">Nueva Solicitud</h3>
            <div class="card-toolbar">  
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0">
            <!--begin::Item-->
            <a href="solicitud.php?tipo=op" class="fw-bolder text-gray-800 text-hover-primary fs-6">
                <div class="d-flex align-items-center bg-light-primary rounded p-5 mb-7">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-primary me-5">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                    fill="black" />
                                <path
                                    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <div class="flex-grow-1 me-2">
                    Solicitud Nacional (OP)
                        <span class="text-muted fw-bold d-block"></span>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="solicitud.php?tipo=tj" class="fw-bolder text-gray-800 text-hover-primary fs-6">

                <div class="d-flex align-items-center bg-light-info rounded p-5 mb-7">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-info me-5">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                    fill="black" />
                                <path
                                    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->  
                        <div class="flex-grow-1 me-2">
                        Solicitud Internacional (TJ)
                            <span class="text-muted fw-bold d-block"></span>
                        </div>
                    <!--end::Title-->
                </div>
            </a>
            <!--end::Item-->
        </div>
        <!--end::Body-->
    </div>
    
    <!--end::List Widget 6-->
</div>
<?*/?>
<!-- !! Lista Solicitudes -->
<div class="col-xxl-12">
    <?if (isset($_GET['mensaje'])) {
        $mensaje = urldecode($_GET['mensaje']);
        echo '
        <div class="alert alert-dismissible bg-light-success border border-success border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
            <!--begin::Icon-->
            <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
            <span class="svg-icon svg-icon-2hx svg-icon-success me-4 mb-5 mb-sm-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"></path>
                    <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"></path>
                </svg>
            </span>
            <!--end::Svg Icon-->
            <!--end::Icon-->
            <!--begin::Content-->
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <h5 class="mb-1">Solicitud Actualizada con éxito</h5>
                <span>'.$mensaje.'</span>
            </div>
            <!--end::Content-->
            <!--begin::Close-->
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <i class="bi bi-x fs-1 text-success"></i>
            </button>
            <!--end::Close-->
        </div>
        ';
    }?>
    <!--begin::List Widget 6-->
    <div class="card card-xl-stretch mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title fw-bolder text-dark">Material en Transito</h3>
            <div class="card-toolbar">  
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0">
            <!--begin::Item-->
            <a href="lista.php?estatus=5">
                <div class="d-flex align-items-center bg-light-primary rounded p-5 mb-7">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-primary me-5">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path opacity="0.3"
                                d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                fill="black" />
                            <path
                                d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </span>
                <!--end::Icon-->
                <!--begin::Title-->
                <div class="flex-grow-1 me-2">
                    <span class="fw-bolder text-gray-800 text-hover-primary fs-6">Solicitudes Compradas</span>
                    <span class="text-muted fw-bold d-block"></span>
                </div>
                <!--end::Title-->
                <!--begin::Lable-->
                <span class="fw-bolder text-primary py-1"><? echo $status5; ?></span>
                <!--end::Lable-->
                </div>  
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="lista.php?estatus=9">
                <div class="d-flex align-items-center bg-light-info rounded p-5 mb-7">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-info me-5">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                    fill="black" />
                                <path
                                    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="flex-grow-1 me-2">
                        <span class="fw-bolder text-gray-800 text-hover-primary fs-6">Parciales</span>
                        <span class="text-muted fw-bold d-block"></span>
                    </div>
                    <!--end::Title-->
                    <!--begin::Lable-->
                    <span class="fw-bolder text-info py-1"><? echo $status9; ?></span>
                    <!--end::Lable-->
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="lista.php?estatus=6">
                <div class="d-flex align-items-center bg-light-success rounded p-5 mb-7">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-success me-5">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                    fill="black" />
                                <path
                                    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="flex-grow-1 me-2">
                        <span class="fw-bolder text-gray-800 text-hover-primary fs-6">Listas Para Entregar</span>
                        <span class="text-muted fw-bold d-block"></span>
                    </div>
                    <!--end::Title-->
                    <!--begin::Lable-->
                    <span class="fw-bolder text-success py-1"><? echo $status6; ?></span>
                    <!--end::Lable-->
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="lista.php?estatus=7">
                <div class="d-flex align-items-center bg-light-danger rounded p-5">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-danger me-5">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                    fill="black" />
                                <path
                                    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="flex-grow-1 me-2">
                        <span class="fw-bolder text-gray-800 text-hover-primary fs-6">Entregadas</span>
                        <span class="text-muted fw-bold d-block"></span>
                    </div>
                    <!--end::Title-->
                    <!--begin::Lable-->
                    <span class="fw-bolder text-danger py-1"><? echo $status7; ?></span>
                    <!--end::Lable-->
                </div>
            </a>
            <!--end::Item-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::List Widget 6-->
</div>
