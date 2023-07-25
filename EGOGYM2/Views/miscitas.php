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

     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">

     <!--Calendario-->
     <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

</head>
  

<body>

  <body data-spy="scroll" data-target="#navbarNav" data-offset="50">

    <!-- MENU BAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="../index.html">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-lg-auto">
                  <li class="nav-item">
                      <a href="../index.html#Home" class="nav-link smoothScroll">Home</a>
                  </li>

                  <li class="nav-item">
                      <a href="../index.html#about" class="nav-link smoothScroll">Sobre Nosotros</a>
                  </li>

                  <li class="nav-item">
                      <a href="../index.html#serv" class="nav-link smoothScroll">Servicios</a>
                  </li>

                  <li class="nav-item">
                      <a href="../index.html#schedule" class="nav-link smoothScroll">Calendario</a>
                  </li>

                  <li class="nav-item">
                      <a href="../index.html#contact" class="nav-link smoothScroll">Contacto</a>
                  </li>
                  <li class="nav-item">
                      <!---->
                      <div class="btn-group-sm"> 
                          <a href="#" class="btn btn-sm custom-btn bg-color "  data-toggle="modal" data-target="#membershipForm">Inicia Sesión</a> 
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
        include '../recepcionista/database_gym.php';
        $conexion = new database();
        $conexion->conectarDB();

        $db= new database();
        $db->conectarDB();

        $queryCitas = "SELECT c.id_citaspin, c.fecha, c.hora, concat (pc.nombre, ' ' , pc.apellido_paterno) as cliente, concat (p.nombre, ' ' , p.apellido_paterno) as entrenador, c.estado from citas_spin c join servicios_empleados se on
        c.serv_emp=se.id_empserv join persona p on se.empleado=p.id_persona
        JOIN persona pc on c.cliente=pc.id_persona
        where c.cliente =100 and c.fecha>=CURRENT_DATE;";

        $resultCitas = $db->seleccionar($queryCitas);

        foreach($resultCitas as $cita) {
            echo '<tr>';
            echo '<td>' . $cita->id_citaspin . '</td>';
            echo '<td>' . $cita->fecha . '</td>';
            echo '<td>' . $cita->hora . '</td>';
            echo '<td>' . $cita->entrenador . '</td>';
            echo '<td>' . $cita->cliente . '</td>'; 
            echo '<td>' . $cita->estado . '</td>';
            echo '<td>';
            echo '<a href="?accion=ejecutar&id_cita=' . $cita->id_citaspin . '" style="color: blue; text-decoration: underline;">Cancelar Cita</a>';
            /*
            echo '<form action="" method="post">';
            echo '<input type="hidden" name="id_cita" value="' . $cita->id_citaspin . '">';
            echo '<button type="submit" name="accion" value="ejecutar">Cancelar cita</button>'; 
            echo '</form>'; */

            echo '</td>';
            echo '</tr>';

        }

        
        if (isset($_GET['accion']) && $_GET['accion'] === 'ejecutar' && isset($_GET['id_cita'])) {
            $id_cita = $_GET['id_cita'];
            $cancelarCita = "UPDATE citas_spin set estado = 'cancelada' where id_citaspin=$id_cita";
            $db->ejecutarSQL($cancelarCita);
           // Refresh the page after a short delay CON JAVA SCRIPT 1 SECOND AFTER
           echo '<script>setTimeout(function() { window.location.href = "../Views/miscitas.php"; }, 1000);</script>';

        }
        /*
        if($_SERVER["REQUEST_METHOD"]=== "POST") {
            $id_cita = $_POST['id_cita'];
            extract($_POST);
            $cancelarCita = "UPDATE citas_spin set estado = 'cancelada' where id_citaspin=$id_cita";
            $db->ejecutarSQL($cancelarCita);
            echo '<script>setTimeout(function() { window.location.href = "../Views/miscitas.php"; }, 1000);</script>';
        } */

        $db->desconectarBD();
        
        ?>
    </table>

    </div>  

  </body>
</body>
</html>

