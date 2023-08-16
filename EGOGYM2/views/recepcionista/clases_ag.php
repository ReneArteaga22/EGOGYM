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
      minDate: '+1D',
      maxDate: '+9D',
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

    if(isset($email) and $tipo == 'recepcionista' )
    {
      
    }
    else 
    {
        header("Location:../../index.php");
    }
       
    ?>

<nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="../recepcionista/index.php">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a href="../recepcionista/index.php" class="nav-link smoothScroll">Inicio</a>
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
                        <a href="usuarios.php" class="nav-link smoothScroll">Usuarios</a>
                    </li>

                    <li class="nav-item">
                        <a href="registrarusu.php" class="nav-link smoothScroll">Registrar Nuevo Usuario</a>
                    </li>
                    
                </ul>

                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                         Hola Recepcionista
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="../../scripts/cerrarsesion.php">Cerrar Sesion</a></li>
                        </ul>
                      </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="kiara">

    <div class="container" style="padding-top: 3%;">
    
    <ul class="nav nav-tabs">
        <li><a href="../recepcionista/citas_prox.php" style="margin-right: 20px;">Citas próximas</a></li>
    <li class="active"><a href="../recepcionista/citas_pasadas.php">Citas pasadas</a></li>
    <li><a data-toggle="tab" href="clases" style="margin-left: 20px;">Clases agendadas</a></li>
        </ul>
    </div>

    <div class="tab-content container">
        <div class="tab-pane active" id="clases">
        <?php
                        $conexion = new database();
                        $conexion->conectarDB();

                        $consulta ="SELECT COUNT(citas_spinning.id_cita) as 'Asistentes', citas_spinning.hora,
                        concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS entrenador
                        from citas_spinning
                        inner join servicios_empleados on
                        servicios_empleados.id_empserv= citas_spinning.entrenador
                        inner join empleado on
                        empleado.id_empleado=servicios_empleados.empleado
                        inner join persona on 
                        persona.id_persona=empleado.id_empleado
                        where citas_spinning.fecha= curdate()
                         group by citas_spinning.hora ;";
                        $conexion->seleccionar($consulta);
                        $tabla = $conexion->seleccionar($consulta);
                        foreach($tabla as $registro)
                        {
                            $registro->Asistentes;
               
                            $cant_spin = $registro;
                        }

                        if(isset($cant_spin) != '0')
                        {
                            echo 
                            "
                            <table class='table' style='border-radius: 5px;'>
                            <thead class='table-dark'>
                                <tr>
                                <br>
    
                                    <th style='color: goldenrod;'>
                                    Hora
                                    </th>
                                    <th style='color: goldenrod;'>
                                    Asistentes
                                    </th>
                                    <th style='color: goldenrod;'>
                                    Entrenador
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>";
                            foreach ($tabla as $registro)
                            {
                                echo "<tr>";
                                echo "<td> $registro->hora</td> ";
                                echo "<td> $registro->Asistentes</td> ";
                                echo "<td> $registro->entrenador</td> ";
                            }
                            echo "</tbody>
                            </table>";

                        }
                        else
                        {
                            echo "<h3 data-aos='fade-right' style='color: goldenrod'>No hay clases agendadas el día de hoy </h3>";
                        }
                    ?>

        </div>

    </div>
    </div>
    </section>
</body>
</html>