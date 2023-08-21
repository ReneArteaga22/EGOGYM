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
    <body>
    <div class="container">
    <?php
        include 'database.php';
        $conexion= new database();
        $conexion->conectarDB();


        extract($_POST);
        $id= $_POST['cliente'];
        $parametros = array('::cliente' => $id);
        $cadena = "call restriccion_citas_3($servicio, $cliente,'$fecha_cita','$hora')";
     
        $conexion->exec($cadena, $parametros);
        if ($conexion->exec($cadena, $parametros)) {
            echo "<div class='alert alert-success'>Cliente Registrado</div>";
        header("refresh:2 '../views/recepcionista/citas.php?id=$id'");
        }
        else
        echo "<div class='alert alert-danger'>Cita mala</div>";
        header("refresh:20'../views/recepcionista/citas.php?id=$id'");
       

        $conexion->desconectarBD();
      
        
        
        ?>
    </div>
</body>
    </body>
</html>