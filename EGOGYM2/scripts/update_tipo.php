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

include '../scripts/database.php';
$conexion = new Database();
$conexion->conectarDB();

// Obtener el ID del cliente y el código del nuevo plan desde el formulario
$empleadoId = $_POST['empleadoId'];
$nuevoTipo = $_POST['tipo'];

// Consulta para actualizar el código del plan en la tabla cliente
$cadena = "UPDATE empleado SET empleado.tipo_empleado=$nuevoTipo WHERE id_empleado = $empleadoId";
$parametros = array(':nuevoTipo' => $nuevoTipo, ':empleadoId' => $empleadoId);

$conexion->ejecutarSQL($cadena, $parametros);
$conexion->desconectarBD();

// Redirigir al usuario de vuelta a la página del perfil del cliente
echo"<div class='alert alert-success'>Cambios guardados</>";
header("refresh:3 ../views/recepcionista/usuarios.php");

?>
    </div>

    
</body>
</html>