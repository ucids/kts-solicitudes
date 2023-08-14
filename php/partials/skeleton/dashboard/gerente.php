<?/*<div class="col-xxl-12">
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
*/ ?>

<!-- !! Lista Solicitudes -->
<div class="col-xxl-12">
    <!--begin::List Widget 6-->
    <div class="card card-xl-stretch mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title fw-bolder text-dark">Solicitudes</h3>
            <div class="card-toolbar">
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0">
            <!--begin::Item-->
            <?/*
            <div class="d-flex align-items-center bg-light-primary rounded p-5 mb-7">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-primary me-5">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
                    <a href="lista.php?estatus=0" class="fw-bolder text-gray-800 text-hover-primary fs-6">Mis
                        Solicitudes</a>
                    <span class="text-muted fw-bold d-block"></span>
                </div>
                <!--end::Title-->
                <!--begin::Lable-->
                <span class="fw-bolder text-primary py-1">
                    <? echo $status0; ?>
                </span>
                <!--end::Lable-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center bg-light-info rounded p-5 mb-7">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-info me-5">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
                    <a href="lista.php?estatus=2" class="fw-bolder text-gray-800 text-hover-primary fs-6">En
                        Revisión</a>
                    <span class="text-muted fw-bold d-block"></span>
                </div>
                <!--end::Title-->
                <!--begin::Lable-->
                <span class="fw-bolder text-info py-1">
                    <? echo $status2; ?>
                </span>
                <!--end::Lable-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center bg-light-success rounded p-5 mb-7">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-success me-5">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
                    <a href="lista.php?estatus=4" class="fw-bolder text-gray-800 text-hover-primary fs-6">Aprobadas</a>
                    <span class="text-muted fw-bold d-block"></span>
                </div>
                <!--end::Title-->
                <!--begin::Lable-->
                <span class="fw-bolder text-success py-1">
                    <? echo $status4; ?>
                </span>
                <!--end::Lable-->
            </div>
            <!--end::Item-->
            */?>
            <!--begin::Item-->
            <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-warning me-5">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
                    <a href="lista.php?estatus=2" class="fw-bolder text-gray-800 text-hover-primary fs-6">Por Aprobar</a>
                    <span class="text-muted fw-bold d-block"></span>
                </div>
                <!--end::Title-->
                <!--begin::Lable-->
                <span class="fw-bolder text-success py-1">
                    <? echo $status2; ?>
                </span>
                <!--end::Lable-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center bg-light-success rounded p-5 mb-7">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-success me-5">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
                    <a href="lista.php?estatus=4" class="fw-bolder text-gray-800 text-hover-primary fs-6">Aprobadas Por Gerencia</a>
                    <span class="text-muted fw-bold d-block"></span>
                </div>
                <!--end::Title-->
                <!--begin::Lable-->
                <!-- <span class="fw-bolder text-warning  py-1"></span> -->
                <span class="badge badge-circle badge-danger">
                    <? echo $status4; ?>
                </span>

                <!--end::Lable-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center bg-light-danger rounded p-5">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-danger me-5">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
                    <a href="lista.php?estatus=3" class="fw-bolder text-gray-800 text-hover-primary fs-6">Rechazadas</a>
                    <span class="text-muted fw-bold d-block"></span>
                </div>
                <!--end::Title-->
                <!--begin::Lable-->
                <span class="fw-bolder text-danger py-1">
                    <? echo $status3; ?>
                </span>
                <!--end::Lable-->
            </div>
            <!--end::Item-->


        </div>
        <!--end::Body-->
    </div>
    <!--end::List Widget 6-->
</div>