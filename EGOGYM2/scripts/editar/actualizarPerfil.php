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
include '../database.php';
$conexion = new Database();
$conexion->conectarDB();
extract($_POST);

session_start();
isset($_SESSION["correo"]);

$email = $_SESSION["correo"];
// Procesar la foto de perfil
if ($_FILES['foto']['size'] > 0) {
    $nombreFoto = $_FILES['foto']['name'];
    $rutaTemporal = $_FILES['foto']['tmp_name'];
    $rutaDestino = '../../images/upload/' . $nombreFoto;

    // Mueve la foto de la ruta temporal a la ruta de destino
    move_uploaded_file($rutaTemporal, $rutaDestino);

    // Actualiza la URL de la foto en la base de datos
    $consultaFoto = "UPDATE persona SET foto = '$rutaDestino' WHERE correo = '$email'";
    $conexion->ejecutarSQL($consultaFoto);
}
$hash = password_hash($contra,PASSWORD_DEFAULT);

$pase = false;
$cadena= "update persona set telefono='$telefono', contraseña='$hash' where correo= '$email' ";    
while($conexion->ejecutarSQL($cadena))
{
    $pase=true;
}

if($pase=true)
{
    echo"<div class='alert alert-success text-center'>Actualizacion de datos realizada con exito</div>";
    header("refresh:2 ../../views/clientes/perfil.php");
}
else
{
    echo "<div class='alert alert-warning'>No se pudo actualizar</div>";
    header("refresh:2 ../views/clientes/editarPerfil.php");
}
?>
</body>
</html>
