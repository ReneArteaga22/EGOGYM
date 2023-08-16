<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Citas spin</title>
      <!-- SCRIPTS -->
      <script src="../../js/jquery.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <script src="../../js/aos.js"></script>
      <script src="../../js/smoothscroll.js"></script>
      <script src="../../js/custom.js"></script>

     <link rel="stylesheet" href="../../css/bootstrap.min.css">
     <link rel="stylesheet" href="../..7css/font-awesome.min.css">
     <link rel="stylesheet" href="../../css/aos.css">

     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">

     <!--Calendario-->
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     <script type="text/javascript">
         $(function(){
    var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      today = yyyy + '/' + mm + '/' + dd;
  })
  $( function() {
    $( "#datepicker" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: 'yy-mm-dd',
      minDate: '-1M',
      maxDate: '-1D',
      beforeShowDay: $.datepicker.noWeekends
    });} 
    );
    </script>
    </head>
    <body data-spy="scroll" data-target="#navbarNav" data-offset="50">
    <?php
    include '../../scripts/database.php';
    $conexion = new Database();
    $conexion->conectarDB();

    session_start();
    $email = $_SESSION["correo"];
    $consulta = "SELECT tipo_empleado from persona inner join empleado on persona.id_persona = empleado.id_empleado
        where correo ='$email'";
    $datos = $conexion -> seleccionar($consulta);

        foreach ($datos as $dato)
        {
          $tipo = $dato->tipo_empleado;
        }

    if(isset($email) and $tipo == 'entrenador' )
    {
      
    }
    else 
    {
        header("Location:../../index.php");
    }
       
    ?>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                        <a href="" class="nav-link smoothScroll">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link smoothScroll">Clases</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                         <?php echo "Hola".'  '.$_SESSION["correo"]; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../entrenador/perfil_entre.php">Perfil</a></li>
                          <li><a class="dropdown-item" href="../../scripts/cerrarsesion.php">Cerrar Sesion</a></li>
                        </ul>
            </div>
        </div>
    </nav>


    <section class="kiara">
    <!--Crea pills para todas las citas, citas canceladas, confirmadas, completadas, en las tres
     filtrar citas por fecha, entrenador, servicio-->
    <div class="container" style="padding-top: 3%;"> 
        <h3 data-aos="fade-right">Clases agendadas</h3>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#clases_hoy">Clases del día de hoy</a></li>
            <li><a href="../entrenador/clases_pasadas.php" style="margin-left: 20px;">Clases pasadas</a></li>
        </ul>
        <?php
        $db= new database();
        $db->conectarDB();
         $email = $_SESSION["correo"];
         $consulta = "SELECT servicios_empleados.id_empserv from servicios_empleados
         inner join empleado on empleado.id_empleado= servicios_empleados.empleado
         inner join persona on persona.id_persona=empleado.id_empleado
         where correo ='$email'";
         $datos = $db -> seleccionar($consulta);
     
             foreach ($datos as $dato)
             {
               $ID = $dato->id_empserv;
             }
     
            
         ?>



        <div class="tab-content">
            <div class="tab-pane active" id="clases_hoy">
            <?php
            $conexion = new database();
            $conexion->conectarDB();
            $consulta = "SELECT COUNT(citas_spinning.id_cita) as 'Asistentes', citas_spinning.hora
            from citas_spinning
            inner join servicios_empleados on
            servicios_empleados.id_empserv= citas_spinning.entrenador
            inner join empleado on
            empleado.id_empleado=servicios_empleados.empleado
            inner join persona on 
            persona.id_persona=empleado.id_empleado
            where citas_spinning.fecha = curdate()
            and citas_spinning.entrenador= $ID
             group by citas_spinning.hora";

            $conexion->seleccionar($consulta);
            $tabla = $conexion->seleccionar($consulta);

            foreach ($tabla as $registro)
            {
                $registro->Asistentes;
                $cant = $registro;
            }

            if (isset($cant) != '0') {
            
                echo "<table class='table' style='border-radius: 5px;width:60%'>";
                    echo "<thead class='table-dark' style='text-align:'center;''>";
                    echo "<tr><br>
                    <th style='color: goldenrod;'>Hora</th>
                    <th style='color: goldenrod;'>Asistentes</th>
                    </tr>";
                    echo "</thead><tbody>";
                

                foreach ($tabla as $registro) {
                    echo "<tr>";
                        echo "<td>$registro->fecha</td>";
                        echo "<td>$registro->hora</td>";
                        echo "<td>$registro->Asistentes</td>";
                        echo "</tr>";
                }

                echo "</tbody></table>";
            } 
            else 
            {
                echo "<h2 data-aos='fade-right' style='color: goldenrod'>¡No hay clases agendadas el día de hoy!</h2>";
            }
            ?>
            </div>





            <div class="tab-pane fade" id="clases">

                <form method="post" action="">
                    <br>
                <label style="color: gray;">Introduce la fecha</label><br>
                <input type="datepicker" id="datepicker" name="fecha" required>
                <button type="submit" class="btn btn-warning btn-sm " style="margin-bottom: 7px;">Buscar</button>
                </form>
                
                <?php
                if($_POST)
                {
                extract($_POST);
                $conexion = new database();
                $conexion->conectarDB();

                $consulta = "SELECT COUNT(citas_spinning.id_cita) as 'Asistentes', citas_spinning.hora, 
                citas_spinning.fecha
                from citas_spinning
                inner join servicios_empleados on
                servicios_empleados.id_empserv= citas_spinning.entrenador
                inner join empleado on
                empleado.id_empleado=servicios_empleados.empleado
                inner join persona on 
                persona.id_persona=empleado.id_empleado
                where citas_spinning.fecha = '$fecha'
                 group by citas_spinning.hora";

                $conexion->seleccionar($consulta);
                $tabla = $conexion->seleccionar($consulta);

                foreach($tabla as $registro)
                {
                    $cant = $registro->Asistentes;
       
                    $cant = $registro;
                }

                if (isset($cant) != '0') {
                    echo "<table class='table' style='border-radius: 5px;width:60%'>";
                    echo "<thead class='table-dark' style='text-align:'center;''>";
                    echo "<tr><br>
                    <th style='color: goldenrod;'>Fecha</th>
                    <th style='color: goldenrod;'>Hora</th>
                    <th style='color: goldenrod;'>Asistentes</th>
                    </tr>";
                    echo "</thead><tbody>";

                    foreach ($tabla as $registro) {
                        echo "<tr>";
                        echo "<td>$registro->fecha</td>";
                        echo "<td>$registro->hora</td>";
                        echo "<td>$registro->Asistentes</td>";
                        echo "</tr>";
                    }

                    echo "</tbody></table>";
                } else {
                    echo "<h3 data-aos='fade-right' style='color: goldenrod'>No hubo clases agendadas ese día</h3>";
                }
            }
                ?>
            </div>
        </div>

    </div>
    </section>
    </body>
</html>
