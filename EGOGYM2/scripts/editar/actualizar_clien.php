<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <title>Registro</title>


    
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
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






$consulta= "select contraseña, foto, telefono from persona where correo = '$email'";
$datos = $conexion->seleccionar($consulta);
foreach($datos as $dato)
{
    $contra2 = $dato->contraseña;
    $tel = $dato->telefono;
    $pic = $dato->foto;
}

$pass1 = false;
$pass2 = false;
$pass3 = false;
if($contra2 != $contra)
{
$hash = password_hash($contra, PASSWORD_DEFAULT);
$upcontra = "update persona set contraseña = '$hash' where correo= '$email'";
$conexion->ejecutarSQL($upcontra);
$pass1 = true;
}

if ($_FILES['foto']['size'] > 0) {
  $nombreFoto = $_FILES['foto']['name'];
  $rutaTemporal = $_FILES['foto']['tmp_name'];
  $rutaDestino = '../../images/upload/' . $nombreFoto;

  // Mueve la foto de la ruta temporal a la ruta de destino
  move_uploaded_file($rutaTemporal, $rutaDestino);

  // Actualiza la URL de la foto en la base de datos
  $consultaFoto = "UPDATE persona SET foto = '$rutaDestino' WHERE correo = '$email'";
  $conexion->ejecutarSQL($consultaFoto);
  $pass2 =true;
}
   
      // Procesar la foto de perfil

   
  

        if($tel != $telefono )
        {
        $cadena= "update persona set telefono='$telefono' where correo= '$email' ";  
        $conexion->ejecutarSQL($cadena);
        $pass3 =true;
        }






if($pass1 or $pass2 or $pass3)
{
  echo"<div class='alert alert-success d-flex justify-content-center' role='alert' style='margin-top:3px';>
  <svg class='bi flex-shrink-0 me-2' width='30' height='30' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
  <div>
    <p style='margin-left:13px; font-size: 20px;'>Actualizacion de datos realizada con exito 
  </div>
</div>
";    header("refresh:2 ../../views/clientes/Perfil.php");
}
else
{
  echo"<div class='alert alert-danger d-flex align-items-center' role='alert'>
  <svg class='bi flex-shrink-0 me-2' width='30' height='30' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
  <div>
  <p style='margin-left:13px; font-size: 20px;'> No se ha podido realizar la actualizacion de datos </p>
  </div>
</div>
";           header("refresh:2 ../../views/clientes/editarPerfil.php");
}

?>

    
</body>
</html>