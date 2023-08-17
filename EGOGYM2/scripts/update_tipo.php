<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
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
    session_start();

include '../scripts/database.php';
$conexion = new Database();
$conexion->conectarDB();


$empleadoId = $_POST['empleadoId'];
$nuevoTipo = $_POST['tipo'];


$cadena = "UPDATE empleado SET empleado.tipo_empleado=$nuevoTipo WHERE id_empleado = $empleadoId";
$parametros = array(':nuevoTipo' => $nuevoTipo, ':empleadoId' => $empleadoId);

$pass =false;
if($conexion->ejecutarSQL($cadena, $parametros))
{
    $pass =true;
}

if($pass)
{
    echo"<div class='alert alert-success d-flex justify-content-center' role='alert' style='margin-top:3px';>
    <svg class='bi flex-shrink-0 me-2' width='30' height='30' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
    <div>
      <p style='margin-left:13px; font-size: 20px;'>Se ha actualizado el tipo de empleado correctamente
    </div>
  </div>
  ";  
  header("refresh:3 ../views/recepcionista/perfilEmpleado.php?id=".$empleadoId."");
}
else
{
    echo"<div class='alert alert-danger d-flex align-items-center' role='alert'>
    <svg class='bi flex-shrink-0 me-2' width='30' height='30' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
    <div>
    <p style='margin-left:13px; font-size: 20px;'> No se ha podido actualizar el tipo de empleado </p>
    </div>
  </div>
  ";     
  header("refresh:3 ../views/recepcionista/perfilEmpleado.php?id=".$empleadoId."");
}
$conexion->desconectarBD();

<<<<<<< HEAD
$_SESSION['mensaj'] = 'Se cambió el tipo de empleado';
header("Location:../views/recepcionista/perfilEmpleado.php?id=".$empleadoId."");
=======
// Redirigir al usuario de vuelta a la página del perfil del cliente

>>>>>>> 97b5250a405dd98f75555d07242f1e9fcbf8bca1

?>

    
</body>
</html>