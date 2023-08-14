<?php
// // Configuración de la base de datos
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
$tipo = $_POST['tipo'];
$divisa = $_POST['currency'];
// $urgente = $_POST['urgente'];

// Insertar la solicitud en la tabla "solicitudes"
$query_insertar_solicitud = "INSERT INTO solicitudes (
    proveedor, fk_departamento, proyecto, fk_user, notas, tipo, divisa) VALUES (
        '$proveedor', '$departamento', '$proyecto', '$solicitante', '$notas', '$tipo', '$divisa')
        ";
$resultado_insertar_solicitud = $conexion->query($query_insertar_solicitud);

// Obtener el ID de la solicitud insertada
$solicitud_id = $conexion->insert_id;

// // Insertar los artículos en la tabla "articulos"
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

        $query_insertar_articulo = "INSERT INTO 
            articulos (solicitud_id, numero_parte, cantidad, precio, unidad, descripcion) VALUES ('$solicitud_id', '$numero_parte', '$cantidad', '$precio', '$unidad', '$descripcion')";
        $resultado_insertar_articulo = $conexion->query($query_insertar_articulo);
    }
}
$tipo = $_POST['tipo'];

if ($resultado_insertar_solicitud) {
    // echo 'La solicitud ha sido guardada exitosamente.';
    session_start(); 
    $_SESSION['mensaje'] = 'Solicitud creada correctamente';
    $conexion->close();
    // header('Location: /solicitud.php?tipo='.$tipo.'&id='.$solicitud_id.'');
    header('Location: /invoice.php?id='.$solicitud_id.'');
    // Cerrar la conexión a la base de datos
    exit; // Asegúrate de incluir exit después de la redirección

} else {
    echo 'Error al guardar la solicitud: ' . $conexion->error;
}
?>
