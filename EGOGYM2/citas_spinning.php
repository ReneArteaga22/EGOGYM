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
      <script src="../Integradora/js/jquery.min.js"></script>
      <script src="../Integradora/js/bootstrap.min.js"></script>
      <script src="../Integradora/js/aos.js"></script>
      <script src="../Integradora/js/smoothscroll.js"></script>
      <script src="../Integradora/js/custom.js"></script>

     <link rel="stylesheet" href="../Integradora/css/bootstrap.min.css">
     <link rel="stylesheet" href="../Integradora/css/font-awesome.min.css">
     <link rel="stylesheet" href="../Integradora/css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../Integradora/css/egogym.css">





     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">

     <!--Calendario-->
     <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

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
      minDate: new Date(),
      maxDate: '+9D',
      beforeShowDay: $.datepicker.noWeekends
    });} 
    );
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
     <link rel="stylesheet" href="../Integradora/css/egogym.css">
    









</head>
  
  <body data-spy="scroll" data-target="#navbarNav" data-offset="50">

    <!-- MENU BAR -->
    <?php
    session_start();
    if(isset($_SESSION["correo"]))
    {
      
    }
    else 
    {
        header("Location:../../First.php");
    }

    ?>
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


        
    </div>
    <div id="agendar" class="container" style="padding-top: 15%;">
        <br>
        <div class="container" style="padding: 5%;">
        <form method="post" style="background-color:black; opacity:0.8; border-radius:5px; width:80%; padding:5%">
            <div class="row">
                  <legend class="form-label" style="color: goldenrod;">Agendar Cita Spinning</legend>
                  <hr class="dropdown-divider" style="height: 2px; background-color: slategray;">
                  <div class="col-12 col-lg-6">
                    <?php
                    include '../Integradora/recepcionista/database_gym.php';
                    $db=new database();
                    $db->conectarDB();
                    $cadena="SELECT servicios_empleados.id_empserv as empleado, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) as nombre
                    from servicios_empleados
                     inner join empleado on
                     empleado.id_empleado=servicios_empleados.empleado
                     inner join persona on
                     persona.id_persona=empleado.id_empleado
                     where empleado.id_empleado in(select entrenador.id_ent from entrenador)";
                    $reg =$db->seleccionar($cadena);
                    
                    echo 
                    "<div class='mb-3' style='width: 30%;'>
                    <label class='control-label' style='color:white;'>
                    Entrenador
                    </label>
                    <select name='entrenador' class='form-select'>
                    ";

                    foreach($reg as $value)
                    {
                        echo "<option value='".$value->empleado."'>".$value->nombre."</option>";
                    }

                    echo "</select>
                    </div>";
                    $db->desconectarBD();
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
            <button type="submit"name="Registrar" class="btn btn-warning">Agendar</button>  
                </div>          
        </form>

        <?php
        if($_SERVER["REQUEST_METHOD"]=== "POST") {
            $db= new database();
            $db->conectarDB();
            extract($_POST);
            $disponibilidad = "SELECT count(*) as count from citas_spin where fecha='".$fecha_cita."' and hora='".$hora."' and estado='confirmada'";
            $resultDispo = $db->seleccionar($disponibilidad);
            $citasAgendadas = $resultDispo[0]->count;
            if($citasAgendadas < 7){
                $mail= [$_SESSION["correo"]];
                $consulta = "SELECT * from persona where persona.correo=$mail";
                $conexion->seleccionar($consulta);
                $tabla = $conexion->seleccionar($consulta);
                foreach($tabla as $registro)
                {
                    $cliente=$registro->id_persona;
                }
                        $insertCita = "INSERT INTO citas_spinning VALUES ('','$fecha_cita', '$hora','',$cliente,$entrenador)";
                $db->ejecutarSQL($insertCita);
                $db->desconectarBD();
               // header("refresh:3; ../recepcionista/citas.php");
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
        </div>
    </div>

    </body>
</html>

