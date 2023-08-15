<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<?php 
include 'database.php';
$conexion = new Database();
$conexion->conectarDB();
extract($_POST);
$hash = password_hash($contra, PASSWORD_DEFAULT);

$id_per= $_GET["id"];

$upcontra = "update persona set contraseña = '$hash' where id_persona= '$id_per'";
$conexion->ejecutarSQL($upcontra);



$consulta = "select tipo_usuario from persona where id_persona = $id_per";
$dato = $conexion->seleccionar($consulta);

foreach($dato as $dat)
{
    $tipo = $dat->tipo_usuario;
}


if($tipo == 'empleado')
{
header('refresh:2 ../views/recepcionista/perfilEmpleado.php?id= '.$id_per.'');
}
elseif($tipo == 'cliente')
{
    header('refresh:2 ../views/recepcionista/perfilCliente.php?id= '.$id_per.'');
}

?>

</body>
</html>


