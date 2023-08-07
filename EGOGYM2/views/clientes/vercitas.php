<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spinning</title>
  

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <!-- SCRIPTS -->
      <script src="../../js/jquery.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <script src="../../js/aos.js"></script>
      <script src="../../js/smoothscroll.js"></script>
      <script src="../../js/custom.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


     <link rel="stylesheet" href="../../css/bootstrap.min.css">
     <link rel="stylesheet" href="../../css/font-awesome.min.css">
     <link rel="stylesheet" href="../../css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">

     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">

     <!--Calendario-->
     <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script>
$(document).ready(function() {

  $('.dropdown-menu a.dropdown-item').click(function(event) {
 
    event.preventDefault();


    var href = $(this).attr('href');

    
    window.location.href = href;
  });
});
</script>

</head>
  

<body>
<?php
    include '../../scripts/database.php';
    $conexion = new Database();
    $conexion->conectarDB();

    session_start();
    $email = $_SESSION["correo"];
    $consulta = "SELECT tipo_usuario from persona
        where correo ='$email'";
    $datos = $conexion -> seleccionar($consulta);

        foreach ($datos as $dato)
        {
          $tipo = $dato->tipo_usuario;
        }

    if(isset($email) and $tipo == 'cliente' )
    {
      
    }
    else 
    {
        header("Location:../../First.php");
    }
       
    ?>

  <body data-spy="scroll" data-target="#navbarNav" data-offset="50">

    <!-- MENU BAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="index.html">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a href="Primera.php#home" class="nav-link smoothScroll">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="Primera.php#about" class="nav-link smoothScroll">Sobre Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a href="Primera.php#serv" class="nav-link smoothScroll">Servicios</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" > Citas</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="citas.php">Agendar Cita</a></li>
                          <li><a class="dropdown-item" href="vercitas.php">Ver Citas</a></li>
                        </ul>
                      </li>
                    <li class="nav-item">
                        <a href="staff.php" class="nav-link smoothScroll">Staff</a>
                    </li>
                </ul>


                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                         <?php echo "Hola".'  '.$_SESSION["correo"]; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="../clientes/Perfil.php">Perfil</a></li>
                          <li><a class="dropdown-item" href="../../scripts/cerrarsesion.php">Cerrar Sesion</a></li>
                        </ul>
                      </li>
                </ul>
            </div>

        </div>
    </nav>

    <body>

    <div class="container" style="padding-top: 7%;">
        <h2>Mis Citas Agendadas</h2>
        <table class="table table-hover">
            <thead class="table-dark">
        <tr>
            <th>Id Cita</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Entrenador</th>
            <th>Cliente</th>
            <th>Estado</th>
            <th></th>
        </tr>
            </thead>

        <?php

        $db= new database();
        $db->conectarDB();

        $correo=$_SESSION["correo"];
        $querycliente="SELECT id_persona from persona where correo= '$correo'";
        $resulcliente=$db->seleccionar($querycliente);
        $id_cliente=$resulcliente[0]->id_persona;

        $queryCitas = "SELECT c.id_cita, c.fecha, c.hora, concat (pc.nombre, ' ' , pc.apellido_paterno) as cliente, concat (p.nombre, ' ' , p.apellido_paterno) as entrenador, c.estado from citas_spinning c join servicios_empleados se on
        c.entrenador =se.id_empserv join persona p on se.empleado=p.id_persona
        JOIN persona pc on c.cliente=pc.id_persona
        where c.cliente =$id_cliente and c.fecha >= CURRENT_DATE";

        $resultCitas = $db->seleccionar($queryCitas);

        foreach($resultCitas as $cita) {
            echo '<tr>';
            echo '<td>' . $cita->id_cita . '</td>';
            echo '<td>' . $cita->fecha . '</td>';
            echo '<td>' . $cita->hora . '</td>';
            echo '<td>' . $cita->entrenador . '</td>';
            echo '<td>' . $cita->cliente . '</td>'; 
            echo '<td>' . $cita->estado . '</td>';
            echo '<td>';
            
            echo '<form action="" method="post">';
            echo '<input type="hidden" name="id_cita" value="' . $cita->id_cita . '">';
            echo '<button type="submit" name="accion" value="ejecutar">Cancelar cita</button>'; 
            echo '</form>'; 

            echo '</td>';
            echo '</tr>';

        }

        
        if (isset($_GET['accion']) && $_GET['accion'] === 'ejecutar' && isset($_GET['id_cita'])) {
            $id_cita = $_GET['id_cita'];
            $cancelarCita = "UPDATE citas_spinning set estado = 'cancelada' where id_cita = $id_cita";
            $db->ejecutarSQL($cancelarCita);
           // Refresh the page after a short delay CON JAVA SCRIPT 1 SECOND AFTER
           echo '<script>setTimeout(function() { window.location.href = "../Views/miscitas.php"; }, 1000);</script>';

        }
        
        if($_SERVER["REQUEST_METHOD"]=== "POST") {
            $id_cita = $_POST['id_cita'];
            extract($_POST);
            $cancelarCita = "UPDATE citas_spinning set estado = 'cancelada' where id_cita = $id_cita";
            $db->ejecutarSQL($cancelarCita);
            echo '<script>setTimeout(function() { window.location.href = "citas.php"; }, 1000);</script>';
        } 

        $db->desconectarBD();
        
        ?>
    </table>

    </div>  

  </body>
</body>
</html>