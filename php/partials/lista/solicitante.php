<?php
    require_once  'class/lista/perpage.php';
    require_once  'class/lista/list.php';
    require_once  'class/sqli.php';
    setlocale(LC_TIME, 'es_ES.UTF-8');
    $database = new DataSource();
    $name = "";
    $code = "";
    $date = "";
    $inicio = "";
    $status = "";
    $fin = "";
    $queryCondition = "";
    if (isset($_GET['estatus'])) {
        $estatus = $_GET['estatus'];
        if ($estatus ==0) {
            $status_value = "Nuevas";
        $status_class = "primary";
        }elseif ($estatus ==2) {
            $status_value = "En Revision";
            $status_class = "info";
        }elseif ($estatus ==4) {
            $status_value = "Aprobadas";
            $status_class = "success";
        }elseif ($estatus ==3) {
            $status_value = "Rechazadas";
            $status_class = "danger";
        }
    }
    if (! empty($_POST["search"])) {
        foreach ($_POST["search"] as $k => $v) {
            if (! empty($v)) {

                $queryCases = array(
                    "name",
                    "code",
                    "date",
                    "status"
                );
                if (in_array($k, $queryCases)) {
                    if (! empty($queryCondition)) {
                        $queryCondition .= " AND ";
                    } 
                    else {
                        $queryCondition .= " AND ";
                    }
                }
                switch ($k) {
                    case "name":
                        $name = $v;
                        $queryCondition .= "solicitudes.proyecto LIKE '" . $v . "%'";
                        break;
                    case "code":
                        $code = $v;
                        $queryCondition .= "solicitudes.fk_departamento = '$v' ";
                        break;
                    case "status":
                        $status = $v;
                        if($status=='nuevo'){
                            $queryCondition .= "solicitudes.status = 0";
                        }elseif($status=='todos'){
                            $queryCondition .= "solicitudes.status IN (0, 1, 2, 3, 4)";
                        }elseif($status=='revision'){
                            $queryCondition .= "solicitudes.status = 1";
                        }elseif($status=='aprobado'){
                            $queryCondition .= "solicitudes.status = 2";
                        }elseif($status='rechazado'){
                            $queryCondition .= "solicitudes.status = 3";
                        }   
                        
                        break;
                    case "date":
                        $date = $v;
                        $fechaActual = date("Y-m-d");
                        if($v == 1){
                            $inicio = date("Y-m-d");
                        }elseif($v == 2){
                            $inicio =  date("Y-m-d", strtotime("-7 days", strtotime($fechaActual)));
                        }elseif($v == 3){
                            $inicio = date("Y-m-d", strtotime("-1 month", strtotime($fechaActual)));
                        }elseif($v == 4){
                            $inicio = date("Y-m-d", strtotime("-1 year", strtotime($fechaActual))); 
                        }
                        $fin = $fechaActual;
                        $queryCondition .= "DATE(solicitudes.creacion) BETWEEN  '". $inicio ."' AND '". $fin . "'";
                        break;

                }
            }
        }
    }
    $orderby = " ORDER BY status asc";

    $sql = "SELECT solicitudes.*, users.nombre, users.apellidos, users.email, departamento.departamento AS nombre_departamento
    FROM solicitudes
    INNER JOIN users ON solicitudes.fk_user = users.id_user
    INNER JOIN departamento ON users.fk_departamento = departamento.id_departamento
    WHERE solicitudes.fk_departamento IN ($scope) AND users.id_user = '$user_id' AND solicitudes.status = " . $estatus . $queryCondition;

    $href = 'lista.php';

    $perPage = 8;
    $page = 1;
    if (isset($_POST['page'])) {
        $page = $_POST['page'];
    }
    $start = ($page - 1) * $perPage;
    if ($start < 0)
        $start = 0;

    $query = $sql . $orderby . " limit " . $start . "," . $perPage;
    $result = $database->select($query);


    if (! empty($result)) {
        $result["perpage"] = showperpage($sql, $perPage, $href);
    }

    // Consulta para el estado 0
    $query_status0 = "SELECT COUNT(*) AS total_status0 FROM solicitudes WHERE DATE(creacion) = CURDATE() AND status = 0";
    $result_status0 = mysqli_query($conexion, $query_status0);
    $row_status0 = mysqli_fetch_assoc($result_status0);
    $solicitudes_nuevas = $row_status0['total_status0'];

    // Consulta para el estado 1
    $query_status1 = "SELECT COUNT(*) AS total_status1 FROM solicitudes WHERE status = 1";
    $result_status1 = mysqli_query($conexion, $query_status1);
    $row_status1 = mysqli_fetch_assoc($result_status1);
    $solicitudes_revision = $row_status1['total_status1'];

    // Consulta para el estado 2
    $query_status2 = "SELECT COUNT(*) AS total_status2 FROM solicitudes WHERE DATE(creacion) = CURDATE() AND status = 2";
    $result_status2 = mysqli_query($conexion, $query_status2);
    $row_status2 = mysqli_fetch_assoc($result_status2);
    $solicitudes_aprobadas = $row_status2['total_status2'];

    // Consulta para el estado 3
    $query_status3 = "SELECT COUNT(*) AS total_status3 FROM solicitudes WHERE DATE(creacion) = CURDATE() AND status = 3";
    $result_status3 = mysqli_query($conexion, $query_status3);
    $row_status3 = mysqli_fetch_assoc($result_status3);
    $solicitudes_rechazadas = $row_status3['total_status3'];

    $query_gasto_mensual = "SELECT SUM(a.cantidad * a.precio) AS total_sum
        FROM articulos a
        JOIN solicitudes s ON a.solicitud_id = s.id
        WHERE s.status = 2  
        AND YEAR(s.creacion) = YEAR(CURDATE())
        AND MONTH(s.creacion) = MONTH(CURDATE());";
    $result_gasto_mensaual = mysqli_query($conexion, $query_gasto_mensual);
    if($result_gasto_mensaual){
        $row_gasto_mensual = mysqli_fetch_assoc($result_gasto_mensaual);
        $gasto_mensual = $row_gasto_mensual['total_sum'];
    }

?>  

<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">
        <!--begin::Navbar-->
        <div class="card mb-8">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                    <!--begin::Image-->
                    <div
                        class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                        <img class="mw-50px mw-lg-125px" src="view/assets/media/logos/katzkin.png" alt="image" />
                    </div>
                    <!--end::Image-->
                    <!--begin::Wrapper-->
                    <div class="flex-grow-1">
                        <!--begin::Head-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::Details-->
                            <div class="d-flex flex-column">
                                <!--begin::Status-->
                                <div class="d-flex align-items-center mb-1">
                                    <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">
                                        Resumen de las solicitudes de compra </a>
                                    <span class="badge badge-light-success me-auto">Nuevas</span>
                                </div>
                                <!--end::Status-->
                                <!--begin::Description-->
                                <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">
                                    Revisa el status de tus Solicitudes
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Head-->
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap justify-content-start">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder"><?php echo date("d-M-Y")?></div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">Hoy</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-3 svg-icon-info me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                                                    transform="rotate(90 13 6)" fill="black" />
                                                <path
                                                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <div class="fs-4 fw-bolder" data-kt-countup="true"
                                            data-kt-countup-value="<?php echo $solicitudes_revision ?>">0</div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">Solicitudes en Revision </div>
                                </div>

                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                                                    transform="rotate(90 13 6)" fill="black" />
                                                <path
                                                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <div class="fs-4 fw-bolder" data-kt-countup="true"
                                            data-kt-countup-value="<?php echo $solicitudes_aprobadas ?>">0</div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">Solicitudes Aprobadas (Hoy)</div>
                                </div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Details-->
                <div class="separator"></div>
            </div>
        </div>
        <!--end::Navbar-->
        <!-- * LISTA -->
        <div id="kt_content_container" cclass="d-flex flex-column-fluid align-items-start container-xxl">
            <!--begin::Post-->
            <div class="content flex-row-fluid" id="kt_content">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <form name="frmSearch" method="post" action="">
                        <div class="card-header border-0 pt-6">
                            <!--begin::Card title-->
                            <div class="card-title">
                                    <div class="d-flex align-items-center mb-1">
                                        <a class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">
                                            Filtrar Solicitudes</a>
                                    </div>
                            </div>
                            <!-- begin::Filtro -->
                            <div class="card-header border-0 pt-6" data-select2-id="select2-data-80-12qf">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                                <path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!-- begin:: filter by Proyecto -->
                                        <input type="text" class="form-control form-control-solid w-250px ps-15"
                                            placeholder="Proyecto" name="search[name]" value="<?php echo $name; ?>">
                                        <!-- end:: filter by Proyecto -->
                                    </div>
                                    
                                    <!--end::Search-->
                                </div>
                                <!--begin::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base"
                                        data-select2-id="select2-data-79-wodi">
                                        <!--begin::Filter-->
                                        <button type="button" class="btn btn-light-primary me-3"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                        fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Filtro
                                        </button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                                            id="kt-toolbar-filter" style=""
                                            data-select2-id="select2-data-kt-toolbar-filter">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-4 text-dark fw-bolder">Opciones de Filtrado</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Separator-->
                                            <!--begin::Content-->
                                            <div class="px-7 py-5" data-select2-id="select2-data-78-blws">
                                                <!--begin::Input group-->
                                                <div class="mb-10" data-select2-id="select2-data-77-zi66">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-5 fw-bold mb-3">Fecha:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select name="search[date]" class="form-select"
                                                        aria-label="Select example">
                                                        <option value="<?php echo $date; ?>">Fecha</option>
                                                        <option value="1">Hoy</option>
                                                        <option value="2">Ulitma Semana</option>
                                                        <option value="3">Ultimo Mes</option>
                                                        <option value="4">Ultimo Año</option>
                                                        <option value="5">Todos</option>
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10">
                                                    <!--begin::Options-->
                                                    <div class="mb-10" data-select2-id="select2-data-77-zi66">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-5 fw-bold mb-3">Departamento:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select name="search[code]" class="form-select"
                                                        aria-label="Select example">
                                                        <option value="<?php echo $code; ?>">Departamento</option>
                                                        <option value="14">Almacen</option>
                                                        <option value="7">Calidad</option>
                                                        <option value="12">Compras</option>
                                                        <option value="11">Enfermeria</option>
                                                        <option value="10">Entrenamiento</option>
                                                        <option value="1">Envios</option>
                                                        <option value="8">Ingenieria</option>
                                                        <option value="6">Mantenimiento</option>
                                                        <option value="2">Materiales</option>
                                                        <option value="4">Mejora Continua</option>
                                                        <option value="3">RH</option>
                                                        <option value="5">Seguridad e higiene</option>
                                                        <option value="9">Tool Crib</option>

                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Actions-->
                                                <div class="d-flex justify-content-end">
                                                    <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                                        data-kt-menu-dismiss="true"
                                                        data-kt-customer-table-filter="reset">Reset</button>
                                                    <button type="submit" name="go" class="btn btn-primary"
                                                        value="Filtrar">Apply</button>
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Menu 1-->
                                        <!--end::Filter-->
                                        <!--begin::Export-->
                                        <button type="reset" class="btn btn-light-danger me-3" data-bs-toggle="modal"
                                            value="Reset" onclick="window.location='lista.php'">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1"
                                                        transform="rotate(90 12.75 4.25)" fill="black"></rect>
                                                    <path
                                                        d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z"
                                                        fill="black"></path>
                                                    <path
                                                        d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z"
                                                        fill="#C4C4C4"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Limpiar Filtro
                                        </button>
                                        <!--end::Export-->
                                        <!--begin::Add customer-->
                                        <button type="submit" name="go" class="btn btn-primary" data-bs-toggle="modal"
                                            value="Filtrar" data-bs-target="#kt_modal_add_customer">Filtrar
                                            Contenido</button>
                                        <!--end::Add customer-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Group actions-->
                                    <div class="d-flex justify-content-end align-items-center d-none"
                                        data-kt-customer-table-toolbar="selected">
                                        <div class="fw-bolder me-5">
                                            <span class="me-2"
                                                data-kt-customer-table-select="selected_count"></span>Selected
                                        </div>
                                        <button type="button" class="btn btn-danger"
                                            data-kt-customer-table-select="delete_selected">Delete Selected</button>
                                    </div>
                                    <!--end::Group actions-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!-- End::Filtro -->
                        </div>
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                        id="kt_table_users">
                                        <!--begin::Table head-->
                                        <thead>
                                            <!--begin::Table row-->
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1"
                                                    style="width: 27px;" aria-label="">
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                            data-kt-check-target="#kt_table_users .form-check-input"
                                                            value="1">
                                                    </div>
                                                </th>
                                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                                    rowspan="1" colspan="1" style="width: 210.233px;"
                                                    aria-label="User: activate to sort column ascending">Usuario</th>
                                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                                    rowspan="1" colspan="1" style="width: 125px;"
                                                    aria-label="Role: activate to sort column ascending">Proyecto</th>
                                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                                    rowspan="1" colspan="1" style="width: 125px;"
                                                    aria-label="Last login: activate to sort column ascending">Departamento
                                                </th>
                                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                                    rowspan="1" colspan="1" style="width: 125px;"
                                                    aria-label="Two-step: activate to sort column ascending">Aprobado Por:
                                                </th>
                                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                                    rowspan="1" colspan="1" style="width: 125px;"
                                                    aria-label="Joined Date: activate to sort column ascending">Fecha de
                                                    Creación
                                                </th>
                                                <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                                    style="width: 100px;" aria-label="Actions">Acciones</th>
                                            </tr>
                                            <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-bold">
                                            <!--begin::Table row-->
                                            <?php
                                                if (! empty($result)) {
                                                    foreach ($result as $key => $value) {
                                                        if (is_numeric($key)) {

                                                            $claseCSS = '';
                                                            $primeraLetra = $result[$key]['nombre'][0];
                                                            if (preg_match('/^[A-I]/', $primeraLetra)) {
                                                                $claseCSS = 'primary';
                                                            } elseif (preg_match('/^[J-P]/', $primeraLetra)) {
                                                                $claseCSS = 'warning';
                                                            } elseif (preg_match('/^[Q-Z]/', $primeraLetra)) {
                                                                $claseCSS = 'success';
                                                            }
                                                            $departamento = $result[$key]['nombre_departamento'];
                                                            $primera_letra_departamento = strtoupper(substr($departamento, 0, 1));;
                                                            if (preg_match('/^[A-I]/', $primera_letra_departamento)) {
                                                                $class_departamento = 'info';
                                                            } elseif (preg_match('/^[J-P]/', $primera_letra_departamento)) {
                                                                $class_departamento = 'success';
                                                            } elseif (preg_match('/^[Q-Z]/', $primera_letra_departamento)) {
                                                                $class_departamento = 'primary';
                                                            }
                                                            $status = $result[$key]['status'];
                                                            if ($status == 0) {
                                                                $class_status = 'success';
                                                                $status_value = 'Nueva';
                                                            } elseif ($status == 1) {
                                                                $class_status = 'info';
                                                                $status_value = 'En Revisión';
                                                            } elseif ($status == 2) {
                                                                $class_status = 'primary';
                                                                $status_value = 'Aprobada';
                                                            } elseif ($status == 3) {
                                                                $class_status = 'danger';
                                                                $status_value = 'Rechazada';
                                                            } elseif ($status == 4) {
                                                                $class_status = 'success';
                                                                $status_value = 'Aprobada';
                                                            }
                                                            $id_supervisor = $result[$key]['fk_supervisor'];
                                                            $query_supervisor = "SELECT nombre, apellidos FROM users WHERE id_user ='$id_supervisor'";
                                                            $resultado_supervisor = $conexion->query($query_supervisor);
                                                            // Verificar si se encontró un resultado
                                                            if ($resultado_supervisor->num_rows > 0) {
                                                                $_supervisor = $resultado_supervisor->fetch_assoc();
                                                                $supervisor = $_supervisor['nombre'] . ' ' . $_supervisor['apellidos'];
                                                            } else {
                                                                // Asignar un valor predeterminado si no se encontró nada
                                                                $supervisor = "En Revisión";
                                                            }
                                                            
                                                ?>
                                            <tr class="odd">
                                                <!--begin::Checkbox-->
                                                <td>
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="1">
                                                    </div>
                                                </td>
                                                <!--end::Checkbox-->
                                                <!--begin::User=-->
                                                <td class="d-flex align-items-center">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <a href="../../demo2/dist/apps/user-management/users/view.html">
                                                            <div
                                                                class="symbol-label fs-3 bg-light-<?php echo $claseCSS; ?> text-<?php echo $claseCSS; ?>">
                                                                <?php echo $result[$key]['nombre'][0]; ?></div>
                                                        </a>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::User details-->
                                                    <div class="d-flex flex-column">
                                                        <a href="../../demo2/dist/apps/user-management/users/view.html"
                                                            class="text-gray-800 text-hover-primary mb-1">
                                                            <? echo  $result[$key]['nombre'].' '.$result[$key]['apellidos']; ?>
                                                        </a>
                                                        <span><?php echo $result[$key]['email'] ?></span>
                                                    </div>
                                                    <!--begin::User details-->
                                                </td>
                                                <!--end::User=-->
                                                <!--begin::Role=-->
                                                <td>
                                                    <? echo $result[$key]['proyecto']?>
                                                </td>
                                                <!--end::Role=-->
                                                <!--begin::Last login=-->
                                                <td data-order="2023-05-23T11:10:48-07:00">
                                                    <div
                                                        class="badge badge-light-<? echo $class_departamento; ?> fw-bolder">
                                                        <? echo $departamento ?>
                                                    </div>
                                                </td>
                                                <!--end::Last login=-->
                                                <!--begin::Two step=-->
                                                <td>
                                                    <div class="badge badge-light-<?echo $class_status; ?> fw-bolder">
                                                        <? echo $supervisor; ?>
                                                    </div>
                                                </td>
                                                <!--end::Two step=-->
                                                <!--begin::Joined-->
                                                <td data-order="2021-06-20T18:05:00-07:00"><?php
                                                                    $fechaHora = $result[$key]['creacion'];
                                                                    $fecha = new DateTime($fechaHora);
                                                                    $fechaFormateada = $fecha->format("M - d - Y");
                                                                    echo $fechaFormateada; // Imprime: May - 24 - 2023
                                                                ?></td>
                                                <!--begin::Joined-->
                                                <!--begin::Action=-->
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                        data-kt-menu-trigger="click"
                                                        data-kt-menu-placement="bottom-end">Actions
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                        <span class="svg-icon svg-icon-5 m-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                    fill="black"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <? if($status==7 || $status == 9){ ?>
                                                            <div class="menu-item px-3">
                                                                <a href="invoice.php?id=<? echo $result[$key]['id']; ?>" class="menu-link px-3">Revisar</a>
                                                            </div>
                                                        <? }else{ ?>
                                                        <div class="menu-item px-3">
                                                            <a href="solicitud.php?tipo=<?echo $result[$key]['tipo']?>&id=<?echo $result[$key]['id']?>" class="menu-link px-3">Editar</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-users-table-filter="delete_row">Delete</a>
                                                        </div>
                                                        <? } ?>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                                <!--end::Action=-->
                                            </tr>
                                            <?php
                                                        }
                                                    }
                                                } ?>
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>
                                <!-- !!* PAGIANDOR  -->
                                <div class="row">
                                    <?php if (isset($result["perpage"])) {?>
                                        <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                        </div>
                                        <div
                                            class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                id="kt_subscriptions_table_paginate">
                                                <ul class="pagination">
                                                    <?php echo $result["perpage"]; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!--end::Table-->
                        </div>
                    <!--end::Card body-->
                    </form>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Post-->
        </div>
    </div>
    <!--end::Post-->

</div>
<!-- ** LISTA ** -->

<!--end::Container-->
<script>
// EVITAR REENVIO DE DATOS.
if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}
</script>