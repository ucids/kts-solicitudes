<?php
// Obtener el ID de la solicitud a actualizar
$solicitud_id = $_GET['id'];
$tipo = $_GET['tipo'];


// Configuración de la base de datos
$host = '192.168.0.194:5100';
$usuario = 'ucid';
$contraseña = '1974';
$base_de_datos = 'ktz';


// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Obtener los valores del formulario
$proveedor = $_POST['proveedor'];
$departamento = $_POST['departamento'];
$proyecto = $_POST['proyecto'];
$solicitante = $_POST['solicitante'];
$notas = $_POST['notas'];

// Actualizar la solicitud en la tabla "solicitudes"
$query_actualizar_solicitud = "UPDATE solicitudes SET proveedor = '$proveedor', fk_departamento = '$departamento', proyecto = '$proyecto', solicitante = '$solicitante', notas = '$notas' WHERE id = '$solicitud_id'";
$resultado_actualizar_solicitud = $conexion->query($query_actualizar_solicitud);

// Eliminar los artículos existentes relacionados con la solicitud
$query_eliminar_articulos = "DELETE FROM articulos WHERE solicitud_id = '$solicitud_id'";
$resultado_eliminar_articulos = $conexion->query($query_eliminar_articulos);

// Insertar los nuevos artículos en la tabla "articulos"
if (isset($_POST['articulo_numero_parte'])) {
    $articulo_numero_parte = $_POST['articulo_numero_parte'];
    $articulo_cantidad = $_POST['articulo_cantidad'];
    $articulo_precio = $_POST['articulo_precio'];
    $articulo_unidad = $_POST['articulo_unidad'];
    $articulo_descripcion = $_POST['articulo_descripcion'];

    for ($i = 0; $i < count($articulo_numero_parte); $i++) {
        $numero_parte = $articulo_numero_parte[$i];
        $cantidad = $articulo_cantidad[$i];
        $precio = $articulo_precio[$i];
        $unidad = $articulo_unidad[$i];
        $descripcion = $articulo_descripcion[$i];

        $query_insertar_articulo =
            "INSERT INTO articulos (solicitud_id, numero_parte,  cantidad, precio, unidad, descripcion) VALUES ('$solicitud_id', '$numero_parte', '$cantidad', '$precio', '$unidad', '$descripcion')";
        $resultado_insertar_articulo = $conexion->query($query_insertar_articulo);
    }
}

if ($resultado_actualizar_solicitud) {
    // echo 'La solicitud ha sido actualizada exitosamente.';
    session_start();
    $_SESSION['message'] = 'Solicitud Enviada Correctamente';
    $_SESSION['message_type'] = 'success';
} else {
    echo 'Error al actualizar la solicitud: ' . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
// echo '<script type="text/javascript">window.location = "/index.php";</script>';
header('Location: /invoice.php?id='.$solicitud_id.'');

?>
