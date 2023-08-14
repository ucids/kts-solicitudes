<?php
include '../../class/sqli.php';
if (isset($_POST['solicitud'])) {
    $solicitud  = $_POST['id_solicitud'];
    $canitdad_solicitada = $_POST['cantidad_solicitada'];
    $cantidad_recibida = $_POST['cantidad_recibida'];
    $cantidad_entregada = $_POST['cantidad_entregada'];

    $articulo = $_POST['id_articulo'];
    $notas = $_POST['notes'];
    $usuario = $_POST['usuario'];
    $parcial = isset($_POST['parcial']) ? $_POST['parcial'] : array();

    for($i = 0; $i < count($articulo); $i++){
        if($cantidad_entregada[$i] >= $cantidad_recibida[$i]){
            $query_articulo = "UPDATE articulos SET 
            cerrado = 'TRUE' , cantidad_entregada = '$cantidad_entregada[$i]', fk_almacen = '$usuario', entregada = 'TRUE', fecha_entrega = now()
            WHERE id = '$articulo[$i]'";
        }else{
            $query_articulo = "UPDATE articulos SET 
            cerrado = 'FALSE' , cantidad_entregada = '$cantidad_entregada[$i]', fk_almacen = '$usuario', entregada = 'FALSE', fecha_entrega = now()
            WHERE id = '$articulo[$i]'";
        }
        $resultado_actualizar_articulo = $conexion->query($query_articulo);
    }
    $query_articulos = "SELECT * FROM articulos WHERE solicitud_id = '$solicitud' AND cerrado = 'FALSE'";
    $resultado_articulos = $conexion->query($query_articulos);
    if ($resultado_articulos->num_rows > 0) {
		$query_parcial = "UPDATE solicitudes SET status = 9 WHERE id = '$solicitud'";
        $actualizar_solicitud = $conexion->query($query_parcial);
	}else{
        $query_parcial = "UPDATE solicitudes SET status = 6 WHERE id = '$solicitud'";
        $actualizar_solicitud = $conexion->query($query_parcial);
		$fill = True;
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
header('Location: /invoice.php?id='.$solicitud.'&almacen=6');
?>