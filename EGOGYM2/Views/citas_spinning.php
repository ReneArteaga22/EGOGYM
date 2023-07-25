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

  <script>
  $(function(){
    var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0! (codigo javascript)
      var yyyy = today.getFullYear();

      today = yyyy + '/' + mm + '/' + dd;
  })
  $( function() {
    $( "#datepicker" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: 'yy-mm-dd',
      minDate: new Date(),
      maxDate: '+7D'
    });
  } )
  ;
  </script>
  <script>
     $ (function updateAvailableHours() {
          // Aquí puedes obtener las horas disponibles según la fecha seleccionada.
          // Por ejemplo, en este caso, se generarán opciones de horas para cada hora de 8 AM a 6 PM.
          const hoursSelect = $('#timeSelect');
          hoursSelect.empty();
          hoursSelect.append('<option value="">Seleccione una hora</option>');
          
          const startHour = 19;
          const endHour = 22;
          for (let hour = startHour; hour <= endHour; hour++) {
            const formattedHour = hour.toString().padStart(2, '0') + ':00';
            hoursSelect.append(`<option value="${formattedHour}">${formattedHour}</option>`);
          }
      
          // Actualizar el selector de horas después de cambiar las opciones
          hoursSelect.selectpicker('refresh');
        })
      
        // Inicializar el selector de hora
        $('#timeSelect').selectpicker();
  </script>


     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../css/egogym.css">
    

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






     <!--Crea pills para todas las citas, citas canceladas, confirmadas, completadas, en las tres
     filtrar citas por fecha, entrenador, servicio-->
     <div class="container" style="padding-top: 10%;">
        
    </div>  


   <div class="container" >
    <div class="tab-content">
         <div id="citas" class="tab-pane fade">
         <?php
        include '../recepcionista/database_gym.php';
        ?>  
    </div> 

    <div id="agendar">
        <br>
        <div class="container">

        <?php
        //php para consultar disponibilidad de citas en la base de datos cuando seleccionas agendar
        if($_SERVER["REQUEST_METHOD"]=== "POST") {
            $db= new database();
            $db->conectarDB();
    
            extract($_POST);
            $disponibilidad = "Select count(*) as count from citas_spin where fecha='".$fecha_cita."' and hora='".$hora."' and estado='confirmada'";
            $resultDispo = $db->seleccionar($disponibilidad);
            $citasAgendadas = $resultDispo[0]->count;

            //Revisar si el usuario ya tiene una cita registrada en esa fecha y a esa hora y si es asi, pedirle que lo haga en otra fecha
            $citasCliente = "Select count(*) as count from citas_spin where fecha='".$fecha_cita."' and hora='".$hora."' and estado='confirmada' and cliente=$cliente_op";
            $resultCitasCliente = $db->seleccionar($citasCliente);
            $totalCitasCliente = $resultCitasCliente[0]->count;
            if($totalCitasCliente>0) {
                echo '<script type="text/javascript">';
                echo ' alert("Ya tienes una cita agendada en ese horario, por favor elige otra fecha y hora")';  //not showing an alert box.
                echo '</script>';
            }
            else if($citasAgendadas<7){
                $queryEntrenador= "select id_empserv from servicios_empleados where servicio=1 limit 1;";
                $resultadoEntrenador= $db->seleccionar($queryEntrenador);
                $numEmpleado= $resultadoEntrenador[0]->id_empserv;
                $insertCita = "INSERT INTO citas_spin(fecha, hora, estado, cliente, serv_emp) VALUES ('" . $fecha_cita . "', '" . $hora . "', 'confirmada', '" . $cliente_op . "', $numEmpleado)";
    
                $db->ejecutarSQL($insertCita);
                $db->desconectarBD();
               echo '<script type="text/javascript">';
                echo ' alert("Tu cita ha sido agendada")';  //not showing an alert box.
                echo '</script>';
       
            } else {
                echo '<script type="text/javascript">';
                echo ' alert("Todas las citas han sido reservadas, seleccione otra fecha y horario")';  //not showing an alert box.
                echo '</script>';
            }
           // $cadena = "call restriccion_citas($servicio,$cliente_op,'$fecha_cita','$hora')";
           // $db->ejecutarSQL($cadena);
            $db->desconectarBD();
            //header("refresh:3; ../Views/citas_spinning.php");
        }

        ?>
            <form method="post" style="background-color:black; opacity:0.8; border-radius:5px; width:80%; padding:5%">
            <div class="row">            
                    <legend class="form-label" style="color: goldenrod;">Agendar cita Spinning</legend>
                              
                  <hr class="dropdown-divider" style="height: 2px; background-color: slategray;">
                  <div class="col-12 col-lg-6">
                  <label style='color: white;'>Bienvenido</label><br>
                    <?php
                     $db=new database();
                     $db->conectarDB();
                     $cadena="SELECT concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente,
                     cliente.id_cliente from persona inner join cliente on cliente.id_cliente=persona.id_persona;";
                     $reg = $db->seleccionar($cadena);
                     echo 
                     "
                     <div class='mb-3' style='width: 30%;'>
                    <select name='cliente_op' class='form-select'>
                     ";
                     foreach($reg as $value)
                    {
                        echo "<option value='".$value->id_cliente."'>".$value->cliente."</option>";
                    }

                    echo "</select>
                    </div>";
                    ?>                  

                  </div>

                 <div class="col-12 col-lg-6">
                    
                 <label style="color:white">Fecha</label>
            <div class="input-group date">
            <input type="text" id="datepicker" required name="fecha_cita">
            </div>
            <label style="color: white;">Seleccionar hora</label><br>
            <select class="form-select" id="timeSelect" required name="hora">
              <option value="">Seleccione una hora</option>
            </select>

                 </div>
                </div>
            <hr class="dropdown-divider" style="height: 2px; background-color: slategray;">
            <button type="reset" value="Limpiar" class="btn btn-secondary">Borrar cambios</button>
            <button type="submit" name="Registrar" class="btn btn-warning">Agendar</button>   
            <button type="button" name="MisCitas" class="btn btn-warning" onclick="redirectToPage()">Ver y editar mis citas</button>         
            </form>
            <script>
                function redirectToPage() {
                    window.location.href = "../Views/miscitas.php";
                    }
          </script>
        </div>
    </div>

    <div id="clases" class="tab-pane fade">
                        <?php
                        $conexion = new database();
                        $conexion->conectarDB();

                        $consulta = "SELECT concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, e.empleado AS
                        empleado, e.servicio as servicio, concat(clases.dia,' ',clases.hora) as horario from citas_spin INNER JOIN cliente ON cliente.id_cliente= citas_spin.cliente
                        INNER JOIN persona ON persona.id_persona = cliente.id_cliente INNER JOIN clases on clases.id_clase=citas_spin.clase
                        INNER JOIN
                        (
                        SELECT id_empserv, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS empleado,
                        servicios.nombre as servicio 
                        FROM servicios_empleados 
                        INNER JOIN servicios ON servicios.codigo=servicios_empleados.servicio
                        INNER JOIN empleado ON servicios_empleados.empleado=empleado.id_empleado
                        INNER JOIN persona ON empleado.id_empleado = persona.id_persona
                        ) AS e ON citas_spin.serv_emp = e.id_empserv;";
                        $conexion->seleccionar($consulta);
                        $tabla = $conexion->seleccionar($consulta);

                        echo 
                        "
                        <table class='table' style='border-radius: 5px;'>
                        <thead class='table-dark'>
                            <tr>
                            <br>
                                <th style='color: goldenrod;'>
                                Cliente
                                </th>
                                <th style='color: goldenrod;'>
                                Fecha
                                </th>
                                <th style='color: goldenrod;'>
                                Servicio
                                </th>
                                <th style='color: goldenrod;'>
                                Empleado
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>";
                        foreach ($tabla as $registro)
                        {
                            echo "<tr>";
                            echo "<td> $registro->cliente</td> ";
                            echo "<td> $registro->horario</td> ";
                            echo "<td> $registro->servicio</td> ";
                            echo "<td> $registro->empleado</td> ";
                        }
                        echo "</tbody>
                        </table>";
                        ?> 
        
    </div>
    </div>
   </div>

    </body>
</html>

