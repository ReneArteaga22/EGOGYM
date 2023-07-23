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
        include '../recepcionista/database_gym.php';
        $db= new database();
        $db->conectarDB();

        extract($_POST);
        $disponibilidad = "Select count(*) as count from citas_spin where fecha='".$fecha_cita."' and hora='".$hora."' and estado='confirmada'";
        $resultDispo = $db->seleccionar($disponibilidad);
        $citasAgendadas = $resultDispo[0]->count;
        if($citasAgendadas<7){
            $insertCita = "INSERT INTO citas_spin(fecha, hora, estado, cliente, serv_emp) VALUES ('" . $fecha_cita . "', '" . $hora . "', 'confirmada', '" . $cliente_op . "', 2203)";

            $db->ejecutarSQL($insertCita);
            $db->desconectarBD();
           // header("refresh:3; ../recepcionista/citas.php");
   
        } else {
            echo '<script type="text/javascript">';
            echo ' alert("Todas las citas han sido reservadas, seleccione otra fecha y horario")';  //not showing an alert box.
            echo '</script>';
        }
       // $cadena = "call restriccion_citas($servicio,$cliente_op,'$fecha_cita','$hora')";
       // $db->ejecutarSQL($cadena);
        $db->desconectarBD();
        header("refresh:3; ../Views/citas_spinning.php");
   

        ?>
    </div>
</body>
    </body>
</html>