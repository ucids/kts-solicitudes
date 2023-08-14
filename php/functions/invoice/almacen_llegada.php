<?php
include '../../class/sqli.php';
if (isset($_POST['solicitud'])) {
    $solicitud  = $_POST['id_solicitud'];
    $canitdad_solicitada = $_POST['cantidad_solicitada'];
    $cantidad_recibida = $_POST['cantidad_recibida'];
    $articulo = $_POST['id_articulo'];
    $notas = $_POST['notes'];
    $usuario = $_POST['usuario'];
    $cantidad_entregada = $_POST['cantidad_entregada'] ?? 0;
    $new_status = $_POST['status'];
    $notas_almacen = $_POST['notes'];
    for($i = 0; $i < count($articulo); $i++){
        if($cantidad_recibida[$i] == $canitdad_solicitada[$i]){
            $query_articulo = "UPDATE articulos SET 
            cerrado = TRUE ,cantidad_entregada = '$cantidad_entregada[$i]', cantidad_recibida = '$cantidad_recibida[$i]', 
            fk_almacen = '$usuario', fecha_entrega = now()
            WHERE id = '$articulo[$i]'";
        }elseif($cantidad_recibida[$i] < $canitdad_solicitada[$i]){
            $query_articulo = "UPDATE articulos SET 
            cerrado = FALSE , cantidad_entregada = '$cantidad_entregada[$i]',cantidad_recibida = '$cantidad_recibida[$i]', 
            fk_almacen = '$usuario', fecha_entrega = now()
            WHERE id = '$articulo[$i]'";
        }else{
            $error_message = 'La cantidad entregada no puede ser mayor que la cantidad solicitada.';
            header('Location: /invoice.php?id='.$solicitud.'&almacen='.$new_status.'&error='.urlencode($error_message));
            exit;
        }
        $resultado_actualizar_articulo = $conexion->query($query_articulo);

        if($canitdad_solicitada[$i] == $cantidad_entregada[$i]){
            $query_entrega = "UPDATE articulos SET entregada = TRUE WHERE id = '$articulo[$i]'";
            $resultado_entrega = $conexion->query($query_entrega);
        }elseif($canitdad_solicitada[$i] > $cantidad_entregada[$i]){
            $query_entrega = "UPDATE articulos SET entregada = FALSE WHERE id = '$articulo[$i]'";
            $resultado_entrega = $conexion->query($query_entrega);
        }else{
            // $conexion->close();
            $error_message = 'La cantidad entregada no puede ser mayor que la cantidad solicitada.';
            header('Location: /invoice.php?id='.$solicitud.'&almacen='.$new_status.'&error='.urlencode($error_message));
            exit;
        }

    }
    $query_articulos = "SELECT * FROM articulos WHERE solicitud_id = '$solicitud' AND entregada = FALSE";
    $resultado_articulos = $conexion->query($query_articulos);

    if ($resultado_articulos->num_rows > 0) {
        // !! IF esta listo para Entregar STATUS = 6
        $query_recibidos = "SELECT * FROM articulos WHERE solicitud_id = '$solicitud' AND cerrado = TRUE";
        $resultado_recibidos = $conexion->query($query_recibidos);
        if ($resultado_recibidos->num_rows > 0) {
		    $query_parcial = "UPDATE solicitudes SET status = 6, notas_almacen = '$notas_almacen' WHERE id = '$solicitud'";
            $actualizar_solicitud = $conexion->query($query_parcial);
            $new_status = '&almacen=6';
        }else{
            $query_parcial = "UPDATE solicitudes SET status = 9, notas_almacen = '$notas_almacen' WHERE id = '$solicitud'";
            $actualizar_solicitud = $conexion->query($query_parcial);
            $new_status = '&almacen=9';
        }
	}else{
        $query_parcial = "UPDATE solicitudes SET status = 7, notas_almacen = '$notas_almacen' WHERE id = '$solicitud'";
        $actualizar_solicitud = $conexion->query($query_parcial);
		$fill = True;
        $new_status = '&almacen=7';
	}

    // for ($i =0; $i < count($articulo); $i++){
    //     if (isset($parcial[$i])) {
    //         $query_articulo = "UPDATE articulos SET 
    //         cerrado = 'TRUE' , cantidad_entregada = '$cantidad[$i]', fk_almacen = '$usuario', fecha_entrega = now()
    //         WHERE id = '$articulo[$i]'";
    //     }else{

    //         $query_articulo = "UPDATE articulos SET 
    //         cerrado = 'FALSE' , cantidad_entregada = '$cantidad[$i]', fk_almacen = '$usuario', fecha_entrega = now()
    //         WHERE id = '$articulo[$i]'";

    //         $query_parcial = "UPDATE solicitudes SET status = 9 WHERE id = '$solicitud'";
    //         $actualizar_solicitud = $conexion->query($query_parcial);
    //     }
    //     $resultado_actualizar_articulo = $conexion->query($query_articulo);

    // }

    // // Realizar la consulta SQL
    // $query = "SELECT * FROM articulos WHERE solicitud_id = $solicitud AND cerrado = 'FALSE'";
    // $resultado = $conexion->query($query);

    // if ($resultado) {
    //     session_start();
    //     $_SESSION['message'] = 'Solicitud Actualizada Correctamente';
    //     $_SESSION['message_type'] = 'success';
    //     // Verificar si todos los artículos tienen cerrado = FALSE
    //     if ($resultado->num_rows > 0) {
    //         // No todos los artículos tienen cerrado = FALSE
    //         // echo "Algunos artículos están marcados como cerrados.";
    //     } else {
    //         // Todos los artículos tienen cerrado = FALSE
    //         $query_parcial = "UPDATE solicitudes SET status = 7 WHERE id = '$solicitud'";
    //         $actualizar_solicitud = $conexion->query($query_parcial);
    //         // echo "Todos los artículos están Cerrados.";
    //     }
    // } else {
    //     // Ocurrió un error en la consulta SQL
    //     echo "Error en la consulta: " . $mysqli->error;
    // }

}
$conexion->close();
$mensaje = 'EL usuario ahora podrá ver su solicitud con el estatus actualizado.';
// header('Location: /invoice.php?id='.$solicitud.'&almacen='.$new_status.'&error='.urlencode($mensaje));
header('Location: /index.php?mensaje='.urlencode($mensaje));
?>