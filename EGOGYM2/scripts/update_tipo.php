<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Registro</title>
</head>
<body>
    <div class="container">
    <?php
    session_start();

include '../scripts/database.php';
$conexion = new Database();
$conexion->conectarDB();


$empleadoId = $_POST['empleadoId'];
$nuevoTipo = $_POST['tipo'];


$cadena = "UPDATE empleado SET empleado.tipo_empleado=$nuevoTipo WHERE id_empleado = $empleadoId";
$parametros = array(':nuevoTipo' => $nuevoTipo, ':empleadoId' => $empleadoId);

$conexion->ejecutarSQL($cadena, $parametros);
$conexion->desconectarBD();

$_SESSION['mensaj'] = 'Se cambió el tipo de empleado';
header("Location:../views/recepcionista/perfilEmpleado.php?id=".$empleadoId."");

?>
    </div>

    
</body>
</html>