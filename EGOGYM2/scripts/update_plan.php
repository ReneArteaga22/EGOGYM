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
include 'database.php';
$conexion = new Database();
$conexion->conectarDB();

$clienteId = $_POST['clienteId'];
$nuevoPlanCodigo = $_POST['plan'];

$cadena = "UPDATE cliente SET codigo_plan = $nuevoPlanCodigo, fecha_ini = CURDATE(),
fecha_fin = DATE_ADD(CURDATE(), INTERVAL 33 DAY) WHERE id_cliente = $clienteId";
$parametros = array(':nuevoPlanCodigo' => $nuevoPlanCodigo, ':clienteId' => $clienteId);

$conexion->ejecutarSQL($cadena, $parametros);
$conexion->desconectarBD();

$_SESSION['mensaje'] = 'Plan actualizado';

header("Location: ../views/recepcionista/perfilCliente.php?id=$clienteId");
?>
    </div>

    
</body>
</html>