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
<!--Calendario fecha_1-->
<script type="text/javascript">
         $(function(){
    var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      today = yyyy + '/' + mm + '/' + dd;
  })
  $( function() {
    $( "#datepicker2" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: 'yy-mm-dd',
      minDate: '-1M',
      maxDate: '-1D',
      beforeShowDay: $.datepicker.noWeekends
    });} 
    );
    </script>
<!--Calendario fecha_2-->
    <script type="text/javascript">
           $(function(){
    var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      today = yyyy + '/' + mm + '/' + dd;
  })
  $( function() {
    $( "#datepicker3" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: 'yy-mm-dd',
      minDate: '-1M',
      maxDate: '-1D',
      beforeShowDay: $.datepicker.noWeekends
    });} 
    );
    </script>

    <link rel="stylesheet" href="../../css/egogym.css">

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

	<!--Menú de tabs-->  


     <div class="container" style="padding-top: 3%;">
        <ul class="nav nav-tabs">
        <li><a data-toggle="tab" href="#citas_pr" style="margin-right: 20px;">Citas próximas</a></li>
    <li class="active"><a data-toggle="tab" href="#citas">Citas pasadas</a></li>
    <li><a data-toggle="tab" href="#citas_can" style="margin-left: 20px;">Citas canceladas</a></li>
    <li><a data-toggle="tab" href="#clases" style="margin-left: 20px;">Clases agendadas</a></li>
    
        </ul>
    </div>

	<!--Inicio tab-content-->
  <div class="container">
        <div class="tab-content">

            <div class="tab-pane active" id="citas_pr">
             <form method="post" action="">
            <div class="row" style="margin-top: 5px;">

                <div class="col-lg-4">
                    <label style="color: grey;">Servicio</label><br>
                    <select style="border:none;" name="servicio">
                    <option value="nutricion">Nutrición</option>
                    <option value="fisioterapia">Fisioterapia</option>
                    </select>
                </div>

                <div class="col-lg-4">
                <label style="color:grey">Fecha</label>
                <div class="input-group date">
                <input type="text" id="datepicker" required name="fecha_cita">
                </div>
                </div>
                <input class="btn" type="submit" name="boton_prox" value="Buscar" style="margin-top: 20px;">
            </div>
            
            </form>
            
            <?php
	     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['boton_prox']))
             {
                extract($_POST);
                $conexion = new database();
                $conexion->conectarDB();
        
                $consulta = "SELECT count(citas.id_cita) cantidad, servicios.nombre from citas
                inner join servicios_empleados on
                servicios_empleados.id_empserv=citas.serv_emp
                inner join servicios on
                servicios.codigo=servicios_empleados.servicio
                where citas.fecha > curdate()
                group by servicio;
                ";
                 $conexion->seleccionar($consulta);
                 $tabla = $conexion->seleccionar($consulta);
                   $conexion = new database();
                       $conexion->conectarDB();    
                       $consulta = "SELECT count(citas.id_cita) as cantidad, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente,
                       e.servicio as servicio,e.empleado AS empleado, citas.hora as hora, citas.fecha, citas.estado, citas.id_cita
                       from citas INNER JOIN cliente ON cliente.id_cliente= citas.cliente
                       INNER JOIN persona ON persona.id_persona = cliente.id_cliente
                       INNER JOIN
                       (
                       SELECT id_empserv, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS empleado,
                       servicios.nombre as servicio
                       FROM servicios_empleados
                       INNER JOIN servicios ON servicios.codigo=servicios_empleados.servicio
                       INNER JOIN empleado ON servicios_empleados.empleado=empleado.id_empleado
                       INNER JOIN persona ON empleado.id_empleado = persona.id_persona
                       ) AS e ON citas.serv_emp = e.id_empserv
                       where citas.fecha = '$fecha_cita' AND e.servicio='$servicio'
                       group by persona.nombre, persona.apellido_paterno, persona.apellido_materno
                       ORDER BY concat(citas.fecha,' ',citas.hora) DESC";
                       $conexion->seleccionar($consulta);
                       $tabla = $conexion->seleccionar($consulta);
                       foreach($tabla as $registro)
                       {
                           $cant = $registro->cantidad;
   
   
                           $cant = $registro;
                       }
   
   
                       if (isset($cant) != '0')
                       {
                       echo
                       "
                       <table class='table' style='border-radius: 10px;width:70%'>
                       <thead class='table-dark' style='text-align:'center;''>
                           <tr>
                           <br>
                               <th style='color: goldenrod;'>
                               Cliente
                               </th>
                               <th style='color: goldenrod;'>
                               Fecha
                               </th>
                               <th style='color: goldenrod;'>
                               Hora
                               </th>
                               <th style='color: goldenrod;'>
                               Empleado
                               </th>
                               <th>
                               
                               </th>
                           </tr>
                       </thead>
                       <tbody>";
   
   
                       $conexion->seleccionar($consulta);
                       $tabla = $conexion->seleccionar($consulta);
   
   
                       foreach ($tabla as $registro)
                       {
                           echo "<tr>";
                           echo "<td> $registro->cliente</td> ";
                           echo "<td> $registro->fecha</td> ";
                           echo "<td> $registro->hora</td> ";
                           echo "<td> $registro->empleado</td> ";
                           if ($registro->estado == 'confirmada')
                           {
                               echo "<td><a href='../../scripts/cancelcita.php?idcita=" . $registro->id_cita . "' style='color:red;'>Cancelar</a></td>";
                           }
                           else if($registro->estado == 'cancelada')
                           {
                               echo "<td><a href='citas.php' style='color: goldenrod;'>Reagendar</a></td>";
   
                           }
                           echo "</tr>";
                       }
                       echo "</tbody>
                       </table>";
                       $conexion->desconectarBD();
                   }
                
                 else
                 {
                  echo "<h2 data-aos='fade-right' style='color: goldenrod'>No existen citas con esas características</h2>";
                 }    
           }
   
            ?>



            </div>

    <!--Citas-->
        <div id="citas" class="tab-pane fade">

        <form method="post" action="">
            <div class="row" style="margin-top: 5px;">

                <div class="col-lg-2">
                    <label style="color: grey;">Servicio</label><br>
                    <select style="border:none;" name="servicio">
                    <option value="nutricion">Nutrición</option>
                    <option value="fisioterapia">Fisioterapia</option>
                    </select>
                </div>

                <div class="col-lg-6">
                <label style="color:grey">Rango</label>
                <div class="input-group date">
                <input type="text" id="datepicker2" required name="fecha_1" placeholder="Selecciona una fecha" 
                style="border:none; background-color:lightgrey;color:grey">
                <input type="text" id="datepicker3" required name="fecha_2" style="margin-left: 10px;border:none;background-color:lightgrey;color:grey" 
                placeholder="Selecciona una fecha">
                </div>
                </div>
                <input class="btn" type="submit" name="boton_past" value="Buscar" style="margin-top: 20px;">
            </div>
            
            </form>

         <?php
         if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['boton_past']))
         {
	    extract($_POST);
        $conexion = new database();
        $conexion->conectarDB();
        $consulta = "SELECT count(citas.id_cita) as cantidad, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, e.empleado AS
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
                ) AS e ON citas.serv_emp = e.id_empserv
                where citas.fecha between '$fecha_1' AND '$fecha_2'
                GROUP BY nombre,apellido_paterno,apellido_materno;";
         $conexion->seleccionar($consulta);
         $tabla = $conexion->seleccionar($consulta);

         foreach($tabla as $registro)
            {
             $cant = $registro->cantidad;
             $cant = $registro;
            }

         if (isset($cant) != '0')
         {
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
        }
        else
        {
            echo "<h2 data-aos='fade-right' style='color: goldenrod'>No existen citas con esas características</h2>";
        }
        }
         ?> 
        </div>

     <!--Clases spinning-->
                <div id="clases" class="tab-pane fade">
                    
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


            <div class="tab-pane fade" id="citas_can">
            
            <form>
            <div class="row" style="margin-top: 5px;">

                <div class="col-lg-4">
                    <label style="color: grey;">Servicio</label><br>
                    <select style="border:none;"></select>
                </div>

                <div class="col-lg-4">
                <label style="color: grey;">Periodo</label><br>
                    <select style="border:none;"></select>
                </div>

            </div>
            
            </form>
            
            <?php
             $conexion = new database();
             $conexion->conectarDB();
     
             $consulta = "SELECT count(citas.id_cita) cantidad, servicios.nombre from citas
             inner join servicios_empleados on 
             servicios_empleados.id_empserv=citas.serv_emp
             inner join servicios on
             servicios.codigo=servicios_empleados.servicio
             where citas.fecha > curdate()  and citas.estado= 'cancelada';
             group by servicio;
             ";
              $conexion->seleccionar($consulta);
              $tabla = $conexion->seleccionar($consulta);
              foreach($tabla as $registro)
              {
                  $registro->cantidad;
     
                  $cant_2 = $registro;
              }
              
            if(isset($cant_2) != '0')
             {
                $conexion = new database();
                    $conexion->conectarDB();    
                    $consulta = "SELECT concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, 
                    e.servicio as servicio,e.empleado AS empleado, citas.hora as hora, citas.fecha, citas.estado,
                    citas.id_cita as cita
                    from citas INNER JOIN cliente ON cliente.id_cliente= citas.cliente
                    INNER JOIN persona ON persona.id_persona = cliente.id_cliente
                    INNER JOIN
                    (
                    SELECT id_empserv, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS empleado,
                    servicios.nombre as servicio 
                    FROM servicios_empleados 
                    INNER JOIN servicios ON servicios.codigo=servicios_empleados.servicio
                    INNER JOIN empleado ON servicios_empleados.empleado=empleado.id_empleado
                    INNER JOIN persona ON empleado.id_empleado = persona.id_persona
                    ) AS e ON citas.serv_emp = e.id_empserv 
                    where citas.fecha > curdate() and citas.estado = 'cancelada';
                    ORDER BY concat(citas.fecha,' ',citas.hora) DESC";
                    echo 
                    "
                    <table class='table' style='border-radius: 5px;width:80%'>
                    <thead class='table-dark' style='text-align:'center;''>
                        <tr>
                        <br>
                            <th style='color: goldenrod;'>
                            Cliente
                            </th>
                            <th style='color: goldenrod;'>
                            Fecha
                            </th>
                            <th style='color: goldenrod;'>
                            Hora
                            </th>
                            <th style='color: goldenrod;'>
                            Estatus
                            </th>
                            <th>
                            </th>
                         
                        </tr>
                    </thead>
                    <tbody>";

                    $conexion->seleccionar($consulta);
                    $tabla = $conexion->seleccionar($consulta);

                    foreach ($tabla as $registro)
                    {
                        echo "<tr>";
                        echo "<td> $registro->cliente</td> ";
                        echo "<td> $registro->fecha</td> ";
                        echo "<td> $registro->hora</td> ";
                        $estado = $registro->estado;
                        echo "<td>$registro->estado</td>";
                        $cita = $registro->cita;
                        if ($estado == 'confirmada')
                        {
                            echo "<td><a href='../../scripts/cancelcita.php?idcita=" . $cita . "' style='color:red;'>Cancelar</a></td>";
                        }
                        else if($estado == 'cancelada')
                        {
                            echo "<td><a href='citas.php' style='color: goldenrod;'>Reagendar</a></td>";

                        }
                        echo "</tr>";
                    }
                    echo "</tbody>
                    </table>";
                    $conexion->desconectarBD();
             }
             else
            {
               echo "<h2 data-aos='fade-right' style='color: goldenrod'>¡No hay citas pendientes!</h2>";
            }
            ?>
            </div>
        </div>

            
        
    </div>

    </div>

 </section>
    </body>
</html>