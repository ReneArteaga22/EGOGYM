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

session_start();
isset($_SESSION["correo"]);

$email = $_SESSION["correo"];

$pase = false;
$cadena= "update persona set correo='$correo', telefono='$telefono', contraseña='$contra' where correo= '$email' ";    
while($conexion->ejecutarSQL($cadena))
{
    $pase=true;
}

if($pase=true)
{
    echo"<div class='alert alert-success text-center'>Actualizacion de datos realizada con exito</div>";
    header("refresh:3 ../views/clientes/perfil.php");
}
else
{
    echo "<div class='alert alert-warning'>No se pudo actualizar</div>";
    header("refresh:3 ../views/clientes/editarPerfil.php");
}
?>
</body>
</html>
