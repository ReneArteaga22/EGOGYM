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
<<<<<<< HEAD
session_start();
include 'database.php';
$conexion = new Database();
$conexion->conectarDB();

$clienteId = $_POST['clienteId'];
$nuevoPlanCodigo = $_POST['plan'];

$cadena = "UPDATE cliente SET codigo_plan = $nuevoPlanCodigo, fecha_ini = CURDATE(),
fecha_fin = DATE_ADD(CURDATE(), INTERVAL 33 DAY) WHERE id_cliente = $clienteId";
=======

include '../scripts/database.php';
$conexion = new Database();
$conexion->conectarDB();

// Obtener el ID del cliente y el código del nuevo plan desde el formulario
$clienteId = $_POST['clienteId'];
$nuevoPlanCodigo = $_POST['plan'];

// Consulta para actualizar el código del plan en la tabla cliente
$cadena = "UPDATE cliente SET codigo_plan = $nuevoPlanCodigo, fecha_ini = CURDATE(),
fecha_fin = DATE_ADD(CURDATE(), INTERVAL 30 DAY) WHERE id_cliente = $clienteId";
>>>>>>> dc4314ec9304396a6cf6fc63e07c02f80e282119
$parametros = array(':nuevoPlanCodigo' => $nuevoPlanCodigo, ':clienteId' => $clienteId);

$conexion->ejecutarSQL($cadena, $parametros);
$conexion->desconectarBD();

<<<<<<< HEAD
$_SESSION['mensaje'] = 'Plan actualizado';

header("Location: ../views/recepcionista/perfilCliente.php?id=$clienteId");
=======
// Redirigir al usuario de vuelta a la página del perfil del cliente
echo"<div class='alert alert-success'>Cliente Registrado</>";
header("refresh:2 ../views/recepcionista/usuarios.php");

>>>>>>> dc4314ec9304396a6cf6fc63e07c02f80e282119
?>
    </div>

    
</body>
</html>