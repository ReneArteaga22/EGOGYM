<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Inicio</title>
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
          
          const startHour = 8;
          const endHour = 18;
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


    <!--Crea pills para todas las citas, citas canceladas, confirmadas, completadas, en las tres
     filtrar citas por fecha, entrenador, servicio-->
    <div class="container" style="padding-top: 10%;">
        <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#citas">Todas las citas</a></li>
    <li><a data-toggle="tab" href="#clases" style="margin-left: 20px;">Clases agendadas</a></li>
        </ul>
    </div>
   <div class="container" >
    <div class="tab-content">
         <div id="citas" class="tab-pane fade">
         <?php
        include '../../scripts/database.php';
        $conexion = new database();
        $conexion->conectarDB();

        $consulta = "SELECT concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, e.empleado AS
        empleado, e.servicio as servicio, concat(citas.fecha,' ',citas.hora) as horario from citas INNER JOIN cliente ON cliente.id_cliente= citas.cliente
        INNER JOIN persona ON persona.id_persona = cliente.id_cliente
        INNER JOIN
        (
        SELECT id_empserv, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS empleado,
        servicios.nombre as servicio 
        FROM servicios_empleados 
        INNER JOIN servicios ON servicios.codigo=servicios_empleados.servicio
        INNER JOIN empleado ON servicios_empleados.empleado=empleado.id_empleado
        INNER JOIN persona ON empleado.id_empleado = persona.id_persona
        ) AS e ON citas.serv_emp = e.id_empserv;";
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
    

    <div id="clases" class="tab-pane fade">
                        <?php
                        $conexion = new database();
                        $conexion->conectarDB();

                        $consulta = "SELECT concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, e.empleado AS
                        empleado, concat(citas_spinning.fecha,' ',citas_spinning.hora) as horario from citas_spinning INNER JOIN cliente ON cliente.id_cliente= citas_spinning.cliente
                        INNER JOIN persona ON persona.id_persona = cliente.id_cliente
                        INNER JOIN
                        (
                        SELECT id_empserv, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS empleado,
                        servicios.nombre as servicio 
                        FROM servicios_empleados 
                        INNER JOIN servicios ON servicios.codigo=servicios_empleados.servicio
                        INNER JOIN empleado ON servicios_empleados.empleado=empleado.id_empleado
                        INNER JOIN persona ON empleado.id_empleado = persona.id_persona
                        ) AS e ON citas_spinning.entrenador = e.id_empserv;";
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