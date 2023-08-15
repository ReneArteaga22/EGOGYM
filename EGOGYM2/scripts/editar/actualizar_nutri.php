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
$hash = password_hash($contra, PASSWORD_DEFAULT);

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

$pase = false;
$consulta= "select contraseña from persona where correo = '$email'";
$datos = $conexion->seleccionar($consulta);
foreach($datos as $dato)
{
    $contra = $dato->contraseña;
}

if($contra != $hash)
{
    $upcontra = "update persona set constraseña = '$hash' where correo= '$email'";
    $conexion->ejecutarSQL($upcontra);
}
else
{
    echo "<div class='alert alert-warning'>No se pudo actualizar la constraseña</div>";
    header("refresh:2 ../views/nutriologo/editarNutri.php");

}


$cadena= "update persona set telefono='$telefono' where correo= '$email' ";  
 
while($conexion->ejecutarSQL($cadena))
{
    $pase=true;
}

if($pase=true)
{
    echo"<div class='alert alert-success text-center'>Actualizacion de datos realizada con exito</div>";
    header("refresh:2 ../../views/nutriologo/perfil_nutri.php");
}
else
{
    echo "<div class='alert alert-warning'>No se pudo actualizar</div>";
    header("refresh:2 ../views/nutriologo/editarNutri.php");
}
?>
</body>
</html>