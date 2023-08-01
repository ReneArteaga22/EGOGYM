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

$pase = false;
<<<<<<< HEAD
$cadena= "update persona set correo='$correo', telefono='$telefono', contraseña='$contra' where correo= '$email' ";    
=======
$cadena= "update persona set telefono='$telefono', contraseña='$contra' where correo= '$email' ";    
>>>>>>> 1c2f28c2a52b2acf6ef8a159cf4fab6f80ad4eb3
while($conexion->ejecutarSQL($cadena))
{
    $pase=true;
}

if($pase=true)
{
    echo"<div class='alert alert-success text-center'>Actualizacion de datos realizada con exito</div>";
<<<<<<< HEAD
    header("refresh:20 ../views/clientes/perfil.php");
=======
    header("refresh:2 ../../views/clientes/perfil.php");
>>>>>>> 1c2f28c2a52b2acf6ef8a159cf4fab6f80ad4eb3
}
else
{
    echo "<div class='alert alert-warning'>No se pudo actualizar</div>";
<<<<<<< HEAD
    header("refresh:20 ../views/clientes/editarPerfil.php");
}
?>
</body>
</html>
=======
    header("refresh:2 ../views/clientes/editarPerfil.php");
}
?>
</body>
</html>
>>>>>>> 1c2f28c2a52b2acf6ef8a159cf4fab6f80ad4eb3
