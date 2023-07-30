<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

     <!-- SCRIPTS -->
     <script src="../../js/jquery.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <script src="../../js/aos.js"></script>
      <script src="../../js/smoothscroll.js"></script>
      <script src="../../js/custom.js"></script>

     <link rel="stylesheet" href="../../css/bootstrap.min.css">
     <link rel="stylesheet" href="../../css/font-awesome.min.css">
     <link rel="stylesheet" href="../../css/aos.css">

     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">

     <!--Calendario-->
     <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
  function initializeDatepicker(id) {
    $( "#" + id ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: 'yy-mm-dd',
      minDate: new Date(),
      maxDate: '+9D',
      beforeShowDay: $.datepicker.noWeekends,
      // Evento onchange para actualizar el selector de hora cuando se cambia la fecha
      onSelect: function(selectedDate) {
        updateAvailableHours(id.replace("datepicker", "timeSelect"));
      }
    });
  }

  function updateAvailableHours(id) {
    const hoursSelect = $('#' + id);
    hoursSelect.empty();
    hoursSelect.append('<option value="">Seleccione una hora</option>');
          
    // Definir las opciones específicas para cada selector de hora
    let startHour, endHour;
    if (id === 'timeSelect1') {
      startHour = 8; // Hora de inicio para el selector 1
      endHour = 18;  // Hora de fin para el selector 1
    } else if (id === 'timeSelect2') {
      startHour = 8; // Hora de inicio para el selector 2
      endHour = 18;   // Hora de fin para el selector 2
    } else if (id === 'timeSelect3') {
      startHour = 7; // Hora de inicio para el selector 3
      endHour = 10;   // Hora de fin para el selector 3
    } 

    for (let hour = startHour; hour <= endHour; hour++) {
      const formattedHour = hour.toString().padStart(2, '0') + ':00';
      hoursSelect.append(`<option value="${formattedHour}">${formattedHour}</option>`);
    }

    // Actualizar el selector de horas después de cambiar las opciones
    hoursSelect.selectpicker('refresh');
  
  }

  $(function() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    today = yyyy + '/' + mm + '/' + dd;

    // Inicializar los calendarios
    initializeDatepicker('datepicker1');
    initializeDatepicker('datepicker2');
    initializeDatepicker('datepicker3');

    // Inicializar los selectores de hora (opcionalmente, puedes mover esta parte al evento onchange de cada calendario)
    updateAvailableHours('timeSelect1');
    updateAvailableHours('timeSelect2');
    updateAvailableHours('timeSelect3');
  });
</script>


  
     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">

</head>
 <body data-spy="scroll" data-target="#navbarNav" data-offset="50">
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="../recepcionista/principal.php">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                        <a href="../recepcionista/principal.php" class="nav-link smoothScroll">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a href="../recepcionista/citas.php" class="nav-link smoothScroll">Citas</a>
                    </li>

                    <li class="nav-item">
                        <a href="../recepcionista/usuarios.php" class="nav-link smoothScroll">Usuarios</a>
                    </li>

                    <li class="nav-item">
                        <a href="../recepcionista/registrarusu.php" class="nav-link smoothScroll">Registrar Nuevo Usuario</a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>

    <div class="container" style="padding-top: 10%;">
        <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#nutri">Nutricion</a></li>
    <li><a data-toggle="tab" href="#fisio" style="margin-left: 20px;">Fisioterapia</a></li>
    <li><a data-toggle="tab" href="#spin" style="margin-left: 20px;">Spinning</a></li>
        </ul>
    </div>
   <div class="container" >
    <div class="tab-content">
        <div id="nutri" class="tab-pane fade">
        <br>
        <div class="container">
            <form action="../../scripts/guardaCitas.php" method="post" style="background-color:black; opacity:0.8; border-radius:5px; width:80%; padding:5%">
            <div class="row">
                  <legend class="form-label" style="color: goldenrod;">Agendar Cita</legend>
                  <hr class="dropdown-divider" style="height: 2px; background-color: slategray;">
                  <div class="col-12 col-lg-6">
                  <label style='color: white;'>Cliente</label><br>
                    <?php
                    include '../../scripts/database.php';
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

                    <?php
                    $db=new database();
                    $db->conectarDB();
                    $cadena="SELECT servicios_empleados.id_empserv as empleado, servicios.nombre 
                    from servicios_empleados
                     inner join servicios on servicios.codigo=servicios_empleados.servicio
                     where servicios.nombre not in(select servicios.nombre from servicios where servicios.nombre='spinning');";
                    $reg =$db->seleccionar($cadena);
                  

                    foreach($reg as $value)
                    {
                        $servicio = $value->empleado;
                        $value->nombre;
                    }
                    $db->desconectarBD();
                    ?>

                  </div>

                 <div class="col-12 col-lg-6">
                 <label style="color:white">Fecha</label>
            <div class="input-group date">
            <input type="text" id="datepicker1" required name="fecha_cita">
            </div>
            <h5 style="color: white;">Seleccionar hora</h5>
            <select class="form-select" id="timeSelect1" name="hora">
              <option value="">Seleccione una hora</option>
            </select>

                 </div>
                </div>
            <hr class="dropdown-divider" style="height: 2px; background-color: slategray;">
            <button type="reset" value="Limpiar" class="btn btn-secondary">Borrar cambios</button>
            <button type="submit"name="Registrar" class="btn btn-warning">Agendar</button>            
            


            </form>
        </div>
    </div>



    <div id="fisio" class="tab-pane fade">
        <br>
        <div class="container">
            <form action="../../scripts/guardaCitas.php" method="post" style="background-color:black; opacity:0.8; border-radius:5px; width:80%; padding:5%">
            <div class="row">
                  <legend class="form-label" style="color: goldenrod;">Agendar Cita</legend>
                  <hr class="dropdown-divider" style="height: 2px; background-color: slategray;">
                  <div class="col-12 col-lg-6">
                  <label style='color: white;'>Cliente</label><br>
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

                    <?php
                    $db=new database();
                    $db->conectarDB();
                    $cadena="SELECT servicios_empleados.id_empserv as empleado, servicios.nombre 
                    from servicios_empleados
                     inner join servicios on servicios.codigo=servicios_empleados.servicio
                     where servicios.nombre not in(select servicios.nombre from servicios where servicios.nombre='spinning')";
                    $reg =$db->seleccionar($cadena);

                    foreach($reg as $value)
                    {
                        $value->empleado;
                        $value->nombre;
                    }

                    $db->desconectarBD();
                    ?>

                  </div>

                 <div class="col-12 col-lg-6">
                 <label style="color:white">Fecha</label>
            <div class="input-group date">
            <input type="text" id="datepicker2" required name="fecha_cita">
            </div>
            <h5 style="color: white;">Seleccionar hora</h5>
            <select class="form-select" id="timeSelect2" name="hora">
              <option value="">Seleccione una hora</option>
            </select>

                 </div>
                </div>
            <hr class="dropdown-divider" style="height: 2px; background-color: slategray;">
            <button type="reset" value="Limpiar" class="btn btn-secondary">Borrar cambios</button>
            <button type="submit"name="Registrar" class="btn btn-warning">Agendar</button>            
            


            </form>
        </div>
    </div>

    <div id="spin" class="tab-pane fade">
        <br>
        <div class="container">
        <form method="post" style="background-color:black; opacity:0.8; border-radius:5px; width:80%; padding:5%">
            <div class="row">
                  <legend class="form-label" style="color: goldenrod;">Agendar Cita Spinning</legend>
                  <hr class="dropdown-divider" style="height: 2px; background-color: slategray;">
                  <div class="col-12 col-lg-6">
                    <?php
                    $db = new database();
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
                 <input type="text" id="datepicker3" required name="fecha_cita2">
                </div>
                <label style="color: white;">Seleccionar hora</label><br>
                <select class="form-select" id="timeSelect3" required name="hora2">
                 <option value="">Seleccione una hora</option>
                </select>
                 </div>
                </div>
            <hr class="dropdown-divider" style="height: 2px; background-color: slategray;">
            <button type="reset" value="Limpiar" class="btn btn-secondary">Borrar cambios</button>
            <button type="submit"name="Registrar" class="btn btn-warning">Agendar</button>  
        </form>

        <?php
        if($_SERVER["REQUEST_METHOD"]=== "POST") {
            extract($_POST);
            $db = new Database();
            $db->conectarDB();
            $disponibilidad = "SELECT count(citas_spinning.id_cita) as count, cliente.id_cliente as id, citas_spinning.fecha as fecha from citas_spinning 
            inner join cliente on citas_spinning.cliente = cliente.id_cliente 
            where (citas_spinning.fecha='".$fecha_cita2."' and citas_spinning.hora='".$hora2."' and citas_spinning.estado='confirmada')
            or (citas_spinning.fecha='".$fecha_cita2."' and citas_spinning.estado= 'confirmada') ";
            $resultDispo = $db->seleccionar($disponibilidad);
            foreach($resultDispo as $datos)
            {
            $id_cli = $datos->id;
            $citasAgendadas = $datos->count;
            }


            if($citasAgendadas < 7){
                $mail= $_SESSION["correo"];
                $consulta = "SELECT * from persona where correo= '$mail'";
                $tabla = $db->seleccionar($consulta);
                foreach($tabla as $registro)
                {
                    $cliente=$registro->id_persona;
                }
                if($cliente == $id_cli)
                {
                    echo '<script type="text/javascript">';
                    echo ' alert("Ya tiene una cita agendada para este dia")';  //not showing an alert box.
                    echo '</script>';
                }
                else
                {
                    $insertCita = "INSERT INTO citas_spinning 
                    VALUES ('','$fecha_cita','$hora','confirmada',$cliente ,$entrenador)";
                    $db->ejecutarSQL($insertCita);
                    // header("refresh:3; ../recepcionista/citas.php");
                    echo '<script type="text/javascript">';
                     echo ' alert("Tu cita ha sido agendada")'; //not showing an alert box.
                     echo '</script>';
                }
       
            } 
            else {
                echo '<script type="text/javascript">';
                echo ' alert("Todas las citas han sido reservadas, seleccione otra fecha y horario")';  //not showing an alert box.
                echo '</script>';
            }
            $db->desconectarBD();
        }
        else{}

        ?>



        </div>
    </div>
</body>
</html>