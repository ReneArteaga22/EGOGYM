<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Registrar</title>
      <!-- SCRIPTS -->
      <script src="../js/jquery.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/aos.js"></script>
      <script src="../js/smoothscroll.js"></script>
      <script src="../js/custom.js"></script>

     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="../css/font-awesome.min.css">
     <link rel="stylesheet" href="../css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../css/egogym.css">
    </head>
    <body>
      <?php
      include '../scripts/database_gym.php';
      $conexion = new Database();
      $conexion->conectarDB();

      $idPersona = $_GET['id'];
      $consulta="SELECT nombre FROM persona WHERE persona.id_persona = $idPersona";
      $parametros = array(':id'=> $idPersona);
      $persona =$conexion->seleccionar($consulta, $parametros);

      if($persona)
      {
        echo "<h1>Perfil de ".$persona[0]->nombre."</h1>";
        $conexion = new Database();
        $conexion->conectarDB();
        $consulta = "SELECT ";
      }
      else
      {
        echo "Persona no encontrada";
      }
      
      $conexion->desconectarBD();
      ?>
    </body>
</html>