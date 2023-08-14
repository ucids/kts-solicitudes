<?
session_start();
// require $_SERVER['DOCUMENT_ROOT'] . '/class/data.php';
require 'class/data.php';
// ? ROLES: 
// ?    1.- Admin
// ?    2.- Compras
// ?    3.- Gerente
// ?    4.- Supervisor
// ?    5.- Solicitante
// ?    6.- Almacen
 
// !! DEPARTAMENTOS: 
// ?    1.-	Envios
// ?    2.-	Materiales
// ?    3.-	RH
// ?    4.-	Mejora Continua
// ?    5.-	Seguridad e IT
// ?    6.-	Mantenimiento
// ?    7.-	Calidad
// ?    8.-	Ingenieria
// ?    9.-	Tool Crib
// ?    10.- Entrenamiento
// ?    11.- Enfermeria
// ?    12.- Compras
// ?    13.- Gerencia

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT users.*, roles.*, departamento.* FROM users
        INNER JOIN roles ON users.fk_rol = roles.id_rol
        INNER JOIN departamento ON users.fk_departamento = departamento.id_departamento
        WHERE id_user = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;

if (count($results) > 0) {
    $user = $results;
    $user_id = $user['id_user'];
    $rol = $user['id_rol'];
    $rol_desc = $user['descripcion'];
    $_scope = $user['scope'];
    $scope = trim($_scope, "[]");
    $departamento = $user['departamento'];
    $id_departamento = $user['fk_departamento'];

}

}else{
    header("Location: /view/sign-in.php");
}

?>