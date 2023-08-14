<?php
    require 'class/sqli.php';

    // Verificar la conexión
    if ($conexion->connect_error) {
        die('Error de conexión: ' . $conexion->connect_error);
    }
    if (isset($_GET['id'])) {
        $solicitud_id = $_GET['id'];
        $estatus = $_GET['almacen'];
        // Obtener los datos existentes de la solicitud de la tabla "solicitudes"
        $query_solicitud = "SELECT solicitudes.*, users.*, roles.*, departamento.departamento
        FROM solicitudes
        INNER JOIN users ON solicitudes.fk_user = users.id_user
        INNER JOIN roles ON users.fk_rol = roles.id_rol
        INNER JOIN departamento ON users.fk_departamento = departamento.id_departamento
        WHERE solicitudes.id = '$solicitud_id'";


        $resultado_solicitud = $conexion->query($query_solicitud);

        if ($resultado_solicitud->num_rows > 0) {
            $solicitud = $resultado_solicitud->fetch_assoc();
            // Obtener los datos existentes de los artículos relacionados con la solicitud
            $query_articulos = "SELECT * FROM articulos WHERE solicitud_id = '$solicitud_id' AND entregada = FALSE";
            $resultado_articulos = $conexion->query($query_articulos);
            // QUERY Supervisor
            $id_supervisor = $solicitud['fk_supervisor'];
            $query_supervisor = "SELECT nombre, apellidos FROM users WHERE id_user ='$id_supervisor'";
            $resultado_supervisor = $conexion->query($query_supervisor);
            $supervisor = $resultado_supervisor->fetch_assoc();

        } else {
            echo 'Solicitud no encontrada.';
            exit;
        }
    } else {
        $solicitud_id = ''; // Dejar el ID vacío para la inserción de nuevos datos
        $solicitud = array(
            'proveedor' => '',
            'departamento' => '',
            'proyecto' => '',
            'solicitante' => '',
            'notas' => '',
            'tipo' => '',
            'divisa' => '',
            'urgente' => ''
        );
        $resultado_articulos = 0; // No hay artículos existentes
    }

    $query_gasto_mensual = "SELECT SUM(a.cantidad * a.precio) AS total_sum
            FROM articulos a
            JOIN solicitudes s ON a.solicitud_id = s.id
            WHERE s.id = $solicitud_id;";
    $result_gasto_mensaual = mysqli_query($conexion, $query_gasto_mensual);
    if($result_gasto_mensaual){
            $row_gasto_mensual = mysqli_fetch_assoc($result_gasto_mensaual);
            $gasto_mensual = $row_gasto_mensual['total_sum'];
    }
    $status = $solicitud['status'];
    if ($status == 0){
        $class_status = 'success';
        $status_value = 'Nueva';
		// $query_status = "UPDATE solicitudes SET status = 1 WHERE id = $solicitud_id";
    	// $conn->query($query_status);
    }elseif ($status == 1){
        $class_status = 'info';
        $status_value = 'En Revisión';
    }elseif ($status == 2){
        $class_status = 'success';
        $status_value = 'Aprobado';
    }elseif ($status == 3){
        $status_value = 'Rechazado';
        $class_status = 'danger';
    }elseif ($status == 4){
        $status_value = 'Aprobado por Gerencia';
        $class_status = 'success';
	}elseif ($status == 5){
        $status_value = 'Registrado por Compras';
        $class_status = 'primary';
	}elseif ($status == 6){
        $status_value = 'Llegada en Almacén';
        $class_status = 'warning';
	}elseif ($status == 7){
        $status_value = 'Entregado por Almacén';
        $class_status = 'primary';
	}elseif ($status == 8){
        $status_value = 'Finalizada';
        $class_status = 'success';
	}elseif ($status == 9){
        $status_value = 'Pendiente de Entrega';
        $class_status = 'warning';
    }

	if ($resultado_articulos->num_rows > 0) {
		$fill = False;
	}else{
		$fill = True;
	}
?>

<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->

    <div class="content flex-row-fluid" id="kt_content">

        <!--begin::Invoice 2 main-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body p-lg-20">
                <!--begin::Layout-->
                <!-- Mensaje -->
                <?php if(isset($_SESSION['message'])){?>
                <div
                    class="alert alert-dismissible bg-light-<?= $_SESSION['message_type']?> d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">
                    <!--begin::Close-->
                    <button type="button"
                        class="position-absolute top-0 end-0 m-2 btn btn-icon btn-icon-<?= $_SESSION['message_type']?>"
                        data-bs-dismiss="alert">
                        <i class="las la-times-circle fs-3x text-danger"></i>
                    </button>
                    <!--end::Close-->

                    <!--begin::Icon-->
                    <a href="#" data-bs-dismiss="alert">
                        <i class="las la-check-circle fs-5x py-5 text-<?= 
													$_SESSION['message_type']?>"></i>
                    </a>

                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="text-center">
                        <!--begin::Title-->
                        <h1 class="fw-bolder mb-5"><?= $_SESSION['message']?></h1>
                        <!--end::Title-->

                        <!--begin::Separator-->
                        <div class="separator separator-dashed border-<?= $_SESSION['message_type']?> opacity-25 mb-5">
                        </div>
                        <!--end::Separator-->

                        <!--begin::Content-->
                        <div class="mb-9 text-dark">
                            La solicitud se procesó. <strong>
                                <? echo $solicitud['email'] ?>
                            </strong>.<br />
                            Podrá ver la solicitud con el nuevo Status.
                        </div>
                        <!--end::Content-->

                        <!--begin::Buttons-->
                        <div class="d-flex flex-center flex-wrap">
                            <a href="index.php"
                                class="btn btn-outline btn-outline-<?= $_SESSION['message_type']?> btn-active-<?= $_SESSION['message_type']?> m-2">Continuar</a>
                            <!-- <a href="index" data-bs-dismiss="alert" class="btn btn-<?= $_SESSION['message_type']?> m-2">Continuar</a> -->
                        </div>
                        <!--end::Buttons-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <?php unset($_SESSION['message'],$_SESSION['message_type']); }?>
                <!-- Contenedor -->
                <div class="d-flex flex-column flex-xl-row">

                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">

                        <!--begin::Invoice 2 content-->
                        <div class="mt-n1">
                            <!--begin::Top-->
                            <div class="d-flex flex-stack pb-10">
                                <!--begin::Logo-->
                                <!-- <a href="#"> -->
                                <img alt="Logo" src="view/assets/media/logos/logo-ktz.png" class="pb-10" />
                                <!-- </a> -->
                                <!--end::Logo-->
                            </div>
                            <!--end::Top-->
                            <!--begin::Wrapper-->
                            <form action="functions/invoice/almacen_llegada.php" method="POST">

                                <div class="m-0">
                                    <!--begin::Label-->
                                    <div class="fw-bolder fs-3 text-gray-800 mb-8">Solicitud #
                                        <? echo $solicitud['id'] ?>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Row-->
                                    <div class="row g-5 mb-12">
                                        <!--end::Col-->
                                        <div class="col-sm-6">
                                            <!--end::Label-->
                                            <div class="fw-bold fs-7 text-gray-600 mb-1">Solicitado por:</div>
                                            <!--end::Label-->
                                            <!--end::Text-->
                                            <div class="fw-bolder fs-6 text-gray-800">
                                                <?php echo $solicitud['nombre'].' '.$solicitud['apellidos']; ?></div>
                                            <!--end::Text-->
                                            <!--end::Description-->
                                            <br>
                                            <div class="fw-bold fs-7 text-gray-600 mb-1">Departamento:</div>
                                            <!--end::Label-->
                                            <!--end::Text-->
                                            <div class="fw-bolder fs-6 text-gray-800">
                                                <?php echo $solicitud['departamento']; ?></div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Col-->
                                        <div class="col-sm-6">
                                            <!--end::Label-->
                                            <div class="fw-bold fs-7 text-gray-600 mb-1">Proveedor:</div>
                                            <!--end::Label-->
                                            <!--end::Text-->
                                            <div class="fw-bolder fs-6 text-gray-800">
                                                <?php echo $solicitud['proveedor']; ?></div>
                                            <!--end::Text-->
                                            <!--end::Description-->
                                            <br>
                                            <div class="fw-bold fs-7 text-gray-600">Recepción de Mercancia
                                                <br />
                                            </div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Content-->
                                    <div class="flex-grow-1">
                                        <!--begin::Table-->
                                        <div class="flex-grow-1 pt-8 mb-13">
                                            <!--begin::Table-->
                                            <div class="table-responsive border-bottom mb-14">
                                                <input type="hidden" name="solicitud" value="02">
                                                <? if($fill){ ?>
                                                <div
                                                    class="alert alert-dismissible bg-light-success border border-success border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                                    <!--begin::Icon-->
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
                                                    <span class="svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"
                                                                d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z"
                                                                fill="black"></path>
                                                            <path
                                                                d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z"
                                                                fill="black"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <!--end::Icon-->
                                                    <!--begin::Content-->
                                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                                        <h5 class="mb-1">Esta Orden Se ha Registrado con éxito</h5>
                                                        <!-- <span>The alert component can be used to highlight certain parts of your page for higher content visibility.</span> -->
                                                    </div>
                                                    <!--end::Content-->
                                                    <!--begin::Close-->
                                                    <button type="button"
                                                        class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                                        data-bs-dismiss="alert">
                                                        <i class="bi bi-x fs-1 text-info"></i>
                                                    </button>
                                                    <!--end::Close-->
                                                </div>
                                                <?}else{?>
                                                <?if (isset($_GET['error'])) {
                                                    $error_message = urldecode($_GET['error']);
                                                    echo '
                                                    <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                                        <!--begin::Icon-->
                                                        <i class="ki-duotone ki-message-text-2 fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                    <!--end::Icon-->

                                                        <!--begin::Content-->
                                                        <div class="d-flex flex-column pe-0 pe-sm-10">
                                                            <h4 class="fw-semibold">'.$error_message.'</h4>
                                                            <span>Si han llegado más productos favor de ponerlo en las Notas.</span>
                                                        </div>
                                                        <!--end::Content-->

                                                        <!--begin::Close-->
                                                        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                                            <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i>                    </button>
                                                        <!--end::Close-->
                                                    </div>
                                                    ';
                                                }?>
                                                <table class="table">
                                                    <thead>
                                                        <tr
                                                            class="border-bottom fs-6 fw-bolder text-muted text-uppercase">
                                                            <th class="min-w-110px pb-9">Articulo</th>
                                                            <th class="min-w-70px pb-9 text-end">Unidad</th>
                                                            <th class="min-w-100px pb-9 text-center">Descripción</th>
                                                            <th class="min-w-100px w-110px pb-9 text-end">Cantidad
                                                                Solicitada</th>
                                                            <th class="min-w-100px w-100px text-center">Cantidad
                                                                Recibida</th>
                                                            <? if($estatus==6 || $estatus==9 || $estatus==7){ ?>
                                                            <th class="min-w-100px w-100px text-center">Cantidad
                                                                Entregada</th>
                                                            <?}?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?
																		$i = 0; 
																		if($resultado_articulos){
																				while ($articulo = $resultado_articulos->fetch_assoc()) {
																		?>
                                                        <input type="hidden" name="id_articulo[<? echo $i; ?>]"
                                                            value="<? echo $articulo['id'];?>">
                                                        <input type="hidden" name="cantidad_solicitada[<? echo $i; ?>]"
                                                            value="<? echo $articulo['cantidad'];?>">
                                                        <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                                            <td class="d-flex align-items-center pt-11">
                                                                <i class="fa fa-genderless text-danger fs-1 me-2"></i>
                                                                <? echo $articulo['numero_parte']?>
                                                            </td>
                                                            <td class="pt-11">
                                                                <? echo $articulo['descripcion']?>
                                                            </td>
                                                            <td class="pt-11">
                                                                <? echo $articulo['unidad']?>
                                                            </td>
                                                            <td class="pt-11">
                                                                <? echo $articulo['cantidad']?>
                                                            </td>
                                                            <?/*
                                                            <td class="pt-11">
                                                            <div class="form-check form-switch form-check-custom flex-center form-check-solid">
                                                            <input class="form-check-input" name="parcial[<?echo $i; ?>]"
                                                            type="checkbox" value="1"
                                                            <? if($articulo['cerrado']=='TRUE'){?>
                                                            checked="checked"
                                                            <? } ?>
                                                            />
                                            </div>
                                            </td> */?>
                                            <td class="pt-5	">
                                                <input class="form-control form-control-solid" type="number" min="1"
                                                    name="cantidad_recibida[<?echo $i ?>]"
                                                    placeholder="<? echo $articulo['cantidad_recibida'] ?>"
                                                    value="<? echo $articulo['cantidad_recibida']?>"
                                                    data-kt-element="quantity">
                                            </td>
                                            <? if($estatus==6 || $estatus==9 || $estatus==7){ ?>
                                            <td class="pt-5	">
                                                <input class="form-control form-control-solid" type="number"
                                                    name="cantidad_entregada[<?echo $i ?>]"
                                                    placeholder="<? echo $articulo['cantidad_entregada'] ?>"
                                                    value="<? echo $articulo['cantidad_entregada']?>"
                                                    data-kt-element="quantity">
                                            </td>
                                            <?}else{?>
                                            <input type="hidden" name="cantidad_entregada[<? echo $i; ?>]" value="0">
                                            <?}?>
                                            </tr>
                                            <? 
																			  $i++;
																			}
																				}
																			?>
                                            </tbody>
                                            </table>
                                            <?} ?>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Invoice 2 content-->
                </div>
                <!--end::Content-->
                <!--begin::Sidebar-->
                <div class="m-0">
                    <!--begin::Invoice 2 sidebar-->
                    <div
                        class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
                        <!--begin::Labels-->
                        <div class="mb-8">
                            <span class="badge badge-light-<?echo $class_status; ?> me-2">
                                <?echo $status_value; ?>
                            </span>
                            <!-- <span class="badge badge-light-warning">Pending Payment</span> -->
                        </div>
                        <!--end::Labels-->
                        <!--begin::Title-->
                        <h6 class="mb-8 fw-boldest text-gray-600 text-hover-primary">Detalles de la Solicitud</h6>
                        <!--end::Title-->
                        <!--begin::Item-->
                        <div class="mb-6">
                            <div class="fw-bold text-gray-600 fs-7">Entregar a:</div>
                            <div class="fw-bolder text-gray-800 fs-6">
                                <? echo $solicitud['nombre'] . ' ' .$solicitud['apellidos']; ?>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="fw-bold text-gray-600 fs-7">email:</div>
                            <div class="fw-bolder text-gray-800 fs-6">
                                <? echo $solicitud['email'] ?>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="mb-6">
                            <div class="fw-bolder text-gray-800 fs-6">Notas:</div>
                            <div class="fw-bold text-gray-600 fs-7">
                                <? echo $solicitud['notas']; ?>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Title-->
                        <h6 class="mb-8 fw-boldest text-gray-600 text-hover-primary">Revision del Proyecto</h6>
                        <!--end::Title-->
                        <!--begin::Item-->
                        <div class="mb-6">
                            <div class="fw-bold text-gray-600 fs-7">Nombre del Proyecto</div>
                            <div class="fw-bolder fs-6 text-gray-800">
                                <? echo $solicitud['proyecto'] ?>
                                <!-- <a href="#" class="link-primary ps-1">View Project</a> -->
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="mb-6">
                            <!-- <div class="fw-bold text-gray-600 fs-7">Autorizado por:</div> -->
                            <div class="fw-bolder text-gray-800 fs-6"></div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="m-0">
                            <div class="fw-bold text-gray-600 fs-7">Acción:</div>
                            <br>
                            <div class="mb-0">
                                <label class="form-label fs-6 fw-bolder text-gray-700">Notes</label>
                                <textarea name="notes" class="form-control opacity-100" rows="3"
                                    placeholder="Notas Importantes" value="" ><?php echo $solicitud['notas_almacen']?></textarea>
                                    <!-- <input type="text" class="form-control" id="kt_docs_maxlength_basic" maxlength="10" /> -->

                            </div>
                            <br>
                            <input type="hidden" value="<? echo $user['id_user']?>" name="usuario">
                            <input type="hidden" value="<? echo $solicitud_id?>" name="id_solicitud">
                            <input type="hidden" name="status" value="<? echo $estatus;?>">
                            <? if($fill){ ?>
                            <a href="index.php" class="btn btn-primary"><i
                                    class="fas fa-envelope-open-text fs-4 me-2"></i> Inicio</a>
                            <?}else{?>
                            <button type="submit" class="btn btn-primary"><i
                                    class="fas fa-envelope-open-text fs-4 me-2"></i> Registrar</button>
                            <? }?>
                            <div class="fw-bolder fs-6 text-gray-800 d-flex align-items-center">


                                <? if ($user['fk_rol'] == 3 || $user['fk_rol'] == 1) { ?>
                                <a href="functions/invoice/action.php?submit=aprove&id=
																		<?echo $solicitud_id?>&user=<? echo $user_id ?>&puesto=gerente"
                                    class="btn btn-sm btn-success">Aprobar</a>
                                <span class="bullet bullet-dot bg-success mx-2"></span></span>
                                <a href="functions/invoice/action.php?submit=deny&id=
																		<?echo $solicitud_id?>&user=<? echo $user_id ?>&puesto=gerente"
                                    class="btn btn-sm btn-danger">Rechazar</a>
                                <span class="fs-7 text-danger d-flex align-items-center">
                                    <span class="bullet bullet-dot bg-danger mx-2"></span></span>
                                <a href="solicitud.php?tipo=<?echo $solicitud['tipo']?>&id=<?echo $solicitud_id?>"
                                    class="btn btn-sm btn-primary">Editar</a>
                                <span class="bullet bullet-dot bg-primary mx-2"></span></span>
                                <? }else{ ?>
                                <? if ($rol == 4 && $status == 0){ ?>
                                <a href="functions/invoice/action.php?submit=aprove&id=
																		<?echo $solicitud_id?>&sup=<? echo $user_id ?>&puesto=supervisor"
                                    class="btn btn-sm btn-success">Aprobar</a>
                                <span class="bullet bullet-dot bg-success mx-2"></span></span>
                                <a href="functions/invoice/action.php?submit=deny&id=<?echo $solicitud_id ?>"
                                    class="btn btn-sm btn-danger">Rechazar</a>
                                <span class="fs-7 text-danger d-flex align-items-center">
                                    <span class="bullet bullet-dot bg-danger mx-2"></span></span>
                                <a href="solicitud.php?tipo=<?echo $solicitud['tipo']?>&id=<?echo $solicitud_id?>"
                                    class="btn btn-sm btn-primary">Editar</a>
                                <span class="bullet bullet-dot bg-primary mx-2"></span></span>
                                <? }else{ ?>
                                <!-- <h6 class="mb-8 fw-boldest text-gray-600 text-hover-primary">La Solicitud esta 
																		<span class="badge badge-light-<?echo $class_status; ?> me-2"><?echo $status_value; ?></span>
																		</h6> -->
                                <? } ?>
                                <? } ?>
                            </div>
                        </div>
                        <? if ($user['fk_rol'] == 2 || $user['fk_rol'] == 1) { ?>
                        <div class="mb-6">
                            <div class="fw-bold text-gray-600 fs-7 required">Código IPOS</div>

                            <div class="fw-bolder fs-6 text-gray-800">
                                <? if ($solicitud['status'] == 4 || $solicitud['status'] == 5){ ?>
                                <input type="text" class="form-control form-control-solid" placeholder="ipos"
                                    name="ipos" id="ipos" value="<?php echo $solicitud['ipos']; ?>" />
                                <br>
                                <? if($solicitud['divisa']=='USD'){?>
                                <div class="fw-bold text-gray-600 fs-7 required">Tipo de cambio</div>
                                <input type="text" class="form-control form-control-solid" placeholder="rate"
                                    name="rate" id="rate" value="<?php echo $solicitud['rate']; ?>" />
                                <? }else{ ?>
                                <input type="hidden" name="rate" id="rate" value=0 />
                                <? } ?>
                                <br>
                                <a href="functions/invoice/action.php?submit=compras&id=<?php echo $solicitud_id; ?>&user=<?php echo $user_id; ?>&puesto=compras"
                                    id="guardarIposLink" class="btn btn-sm btn-primary">Guardar</a>
                                </a>
                                <? } else { ?>
                                <input type="text" class="form-control form-control-solid" placeholder="ipos"
                                    name="ipos" id="ipos" value="<?php echo $solicitud['ipos']; ?>" />
                                <br>
                                <? if($solicitud['divisa']=='USD'){?>
                                <div class="fw-bold text-gray-600 fs-7 required">Tipo de cambio</div>
                                <input type="text" class="form-control form-control-solid" placeholder="rate"
                                    name="rate" id="rate" value="<?php echo $solicitud['rate']; ?>" />
                                <? } ?>
                                <br>
                                <h6 class="mb-8 fw-boldest text-gray-600 text-hover-primary">La Solicitud se encuentra
                                    <span class="badge badge-light-<?echo $class_status; ?> me-2">
                                        <?echo $status_value; ?>
                                    </span>
                                </h6>
                                <? } ?>

                            </div>

                        </div>
                        <? } ?>
                        <!--end::Item-->
                    </div>
                    <!--end::Invoice 2 sidebar-->
                </div>

                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
            </form>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Invoice 2 main-->
</div>
<!--end::Post-->
</div>

<script>
// Obtener los elementos de los inputs
var iposInput = document.getElementById('ipos');
var rateInput = document.getElementById('rate');

// Obtener el enlace del botón
var guardarIposLink = document.getElementById('guardarIposLink');

// Escuchar el evento click en el enlace
guardarIposLink.addEventListener('click', function() {
    // Obtener los valores actuales de los campos ipos y rate
    var iposValue = iposInput.value;
    var rateValue = rateInput.value;

    // Modificar el href del enlace para incluir los valores de ipos y rate
    guardarIposLink.href += '&ipos=' + encodeURIComponent(iposValue) + '&rate=' + encodeURIComponent(rateValue);
});
</script>