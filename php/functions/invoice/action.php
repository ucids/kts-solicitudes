<?php
include('../../class/sqli.php');



if (isset($_GET['submit']) && isset($_GET['id'])) {
    $submitValue = $_GET['submit'];
    $solicitud_id = $_GET['id'];
    $id_user = $_GET['user'];
    $puesto = $_GET['puesto'];

    // Obtener el nuevo valor de status
    $newStatus = 0;
    if($puesto == "supervisor" && $submitValue == "deny"){
        $class = 'danger';
        $mensaje = 'Solicitud Rechazada';
        $query = "UPDATE solicitudes SET status = 3, fk_supervisor = '$id_user'WHERE id = '$solicitud_id'";
    }
    if($puesto == "supervisor" && $submitValue == "aprove"){
        $class = 'success';
        $mensaje = 'Solicitud Aprobada';
        $query = "UPDATE solicitudes SET status = 2, fk_supervisor = '$id_user' WHERE id = '$solicitud_id'";
    }
    if($puesto == "gerente" && $submitValue == "aprove"){
        $class = 'success';
        $mensaje = 'Solicitud Aprobada correctamente';
        $query = "UPDATE solicitudes SET status = 4 WHERE id = '$solicitud_id'";

    }
    if($puesto == "gerente" && $submitValue == "deny"){
        $class = 'danger';
        $mensaje = 'Solicitud Rechazada';
        $query = "UPDATE solicitudes SET status = 3 WHERE id = '$solicitud_id'";
    }

    if ($puesto == 'compras') {
            $ipos =  $_GET['ipos'];
            $rate =  $_GET['rate'];
            $class = 'success';
            $mensaje = 'Codigo IPOS Asignado correctamente';
            $query = "UPDATE solicitudes SET ipos = '$ipos', rate = '$rate', status = 5 WHERE id = '$solicitud_id'";
    }
    // if ($submitValue === 'aprove') {
    //     $newStatus = 2;
    //     $class = 'success';
    //     $mensaje = 'Solicitud Aprobada correctamente';
    //     $query = "UPDATE solicitudes SET status = '$newStatus', fk_supervisor = '$supervisor', fecha_aprobacion = NOW() WHERE id = '$solicitud_id'";

    // } elseif ($submitValue === 'deny') {
    //     $newStatus = 3;
    //     $class = 'danger';
    //     $mensaje = 'Solicitud Rechazada';
    //     $query = "UPDATE solicitudes SET status = '$newStatus' WHERE id = '$solicitud_id'";
    // } elseif ($submitValue == 'ipos') {
    //     $newStatus = 4;
    //     $ipos =  $_GET['ipos'];
    //     $class = 'success';
    //     $mensaje = 'Codigo IPOS Asignado correctamente';
    //     $query = "UPDATE solicitudes SET ipos = '$ipos', status = 4 WHERE id = '$solicitud_id'";

    // } else {
    //     // Valor desconocido en el parámetro "submit"
    //     echo "Valor inválido para el parámetro submit.";
    //     exit; // Termina la ejecución del script si el valor no es válido
    // }

    if (mysqli_query($conexion, $query)) {
        
        session_start(); 
        $_SESSION['message'] = $mensaje;
        $_SESSION['message_type'] = $class;
        header('Location: /invoice.php?id='.$solicitud_id);
        // Realiza aquí cualquier otra acción necesaria
    } else {
        echo "Error al actualizar el valor de status: " . mysqli_error($connection);
    }
} else {
    if (isset($_GET['submit']) && isset($_GET['solicitud'])) {
        $solicitud = $_GET['solicitud'];
        $action = $_GET['submit'];
        if ($action == 'aprove'){
            $query_solicitud = "UPDATE solicitudes SET status = 8 WHERE id = '$solicitud'";

        }elseif($action == 'deny'){

        }
        if (mysqli_query($conexion, $query_solicitud)){
            header('Location: /invoice.php?id='.$solicitud);
        }

    }else{
        // El parámetro "submit" o "id" no están presentes en la URL
        echo "Los parámetros submit e id no se proporcionaron en la URL.";
    }
}


?>