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
$clienteId = $_POST['clienteId'];
$nuevoPlanCodigo = $_POST['plan'];

// Consulta para actualizar el código del plan en la tabla cliente
$cadena = "UPDATE cliente SET codigo_plan = $nuevoPlanCodigo, fecha_ini = CURDATE(),
fecha_fin = DATE_ADD(CURDATE(), INTERVAL 30 DAY) WHERE id_cliente = $clienteId";
$parametros = array(':nuevoPlanCodigo' => $nuevoPlanCodigo, ':clienteId' => $clienteId);

$conexion->ejecutarSQL($cadena, $parametros);
$conexion->desconectarBD();

// Redirigir al usuario de vuelta a la página del perfil del cliente
echo"<div class='alert alert-success'>Cliente Registrado</>";
header("refresh:2 ../views/recepcionista/usuarios.php");

?>
    </div>

    
</body>
</html>