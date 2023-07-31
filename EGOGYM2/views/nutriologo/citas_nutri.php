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

    if(isset($email) and $tipo == 'nutri' )
    {
      
    }
    else 
    {
        header("Location:../../First.php");
    }
       
    ?>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="../nutriologo/principal.php">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                        <a href="../nutriologo/principal.php" class="nav-link smoothScroll">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="../nutriologo/citas_nutri.php" class="nav-link smoothScroll">Citas</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                         <?php echo "Hola".'  '.$_SESSION["correo"]; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="../../scripts/cerrarsesion.php">Cerrar Sesion</a></li>
                        </ul>
                      </li>
                </ul>
            </div>
        </div>
    </nav>


    <!--Crea pills para todas las citas, citas canceladas, confirmadas, completadas, en las tres
     filtrar citas por fecha, entrenador, servicio-->
   <div class="container" style="padding-top: 15%;"> 
        <h3 data-aos="fade-right">Citas agendadas</h3>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#citas_hoy">Citas del día de hoy</a></li>
            <li class="active"><a data-toggle="tab" href="#citas_pr" style="margin-left: 20px;">Citas próximas</a></li>
            <li><a data-toggle="tab" href="#citas" style="margin-left: 20px;">Citas pasadas</a></li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane fade" id="citas">
        <?php
                $conexion = new database();
                $conexion->conectarDB();
                $consulta = "SELECT concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, 
                e.servicio as servicio,e.empleado AS empleado, citas.hora as hora, citas.fecha as fecha, citas.estado as estado, citas.id_cita as num,
                ficha_nutri.id_ficha from citas INNER JOIN cliente ON cliente.id_cliente= citas.cliente
                INNER JOIN persona ON persona.id_persona = cliente.id_cliente
                INNER JOIN ficha_nutri on ficha_nutri.cita=citas.id_cita
                INNER JOIN
                (
                SELECT id_empserv, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS empleado,
                servicios.nombre as servicio 
                FROM servicios_empleados 
                INNER JOIN servicios ON servicios.codigo=servicios_empleados.servicio
                INNER JOIN empleado ON servicios_empleados.empleado=empleado.id_empleado
                INNER JOIN persona ON empleado.id_empleado = persona.id_persona
                ) AS e ON citas.serv_emp = e.id_empserv 
                where e.servicio='nutricion' AND concat(citas.fecha,' ',citas.hora) < now()
                ";
                $conexion->seleccionar($consulta);
                $tabla = $conexion->seleccionar($consulta);
                echo 
                "
                <table class='table' style='border-radius: 5px;width:60%'>
                <thead class='table-dark' style='text-align:'center;''>
                    <tr>
                    <br>
                        <th style='color: goldenrod'>
                        No.Cita
                        </th>
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
                        Ficha medica
                        </th>
                    </tr>
                </thead>
                <tbody>";

                foreach ($tabla as $registro)
                {
                    echo "<tr>";
                    echo "<td>$registro->num</td>";
                    echo "<td> $registro->cliente</td> ";
                    echo "<td> $registro->fecha </td> ";
                    echo "<td> $registro->hora</td> ";
                    echo "<td><a href='verFicha.php?id=" . $registro->id_ficha . "'>Ver ficha médica</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>
                </table>";
                ?>
            </div>
        <div class="tab-pane fade" id="citas_hoy">
            <?php
             $conexion = new database();
             $conexion->conectarDB();
     
             $consulta = "SELECT count(citas.id_cita) cantidad, servicios.nombre from citas
             inner join servicios_empleados on 
             servicios_empleados.id_empserv=citas.serv_emp
             inner join servicios on
             servicios.codigo=servicios_empleados.servicio
             where citas.fecha= curdate() AND servicios.nombre='nutricion'
              group by servicio;
             ";
              $conexion->seleccionar($consulta);
              $tabla = $conexion->seleccionar($consulta);
              foreach($tabla as $registro)
              {
                  $registro->cantidad;
     
                  $cant = $registro;
              }
            if(isset($cant) != '0')
             {
                $conexion = new database();
                    $conexion->conectarDB();    
                    $consulta = "SELECT concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, 
                    e.servicio as servicio,e.empleado AS empleado, citas.hora as hora
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
                    where citas.fecha = curdate() AND e.servicio='nutricion'
                    ";
                    echo 
                    "
                    <table class='table' style='border-radius: 5px;width:60%'>
                    <thead class='table-dark' style='text-align:'center;''>
                        <tr>
                        <br>
                            <th style='color: goldenrod;'>
                            Cliente
                            </th>
                            <th style='color: goldenrod;'>
                            Hora
                            </th>
                            <th style='color: goldenrod;'>
                            Ficha medica
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
                        echo "<td> $registro->hora</td> ";
                        echo "<td><a href='modFicha.php?id=" . $registro->id_ficha . "'>Generar ficha médica</a></td>";
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

            <div class="tab-pane fade" id="citas_pr">
            <?php
             $conexion = new database();
             $conexion->conectarDB();
     
             $consulta = "SELECT count(citas.id_cita) cantidad, servicios.nombre from citas
             inner join servicios_empleados on 
             servicios_empleados.id_empserv=citas.serv_emp
             inner join servicios on
             servicios.codigo=servicios_empleados.servicio
             where citas.fecha > curdate() AND servicios.nombre='nutricion'
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
                    e.servicio as servicio,e.empleado AS empleado, citas.hora as hora,citas.fecha, citas.estado
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
                    where citas.fecha > curdate() AND e.servicio='nutricion'
                    ";
                    echo 
                    "
                    <table class='table' style='border-radius: 5px;width:60%'>
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
                        echo "<td>$registro->estado</td>";
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

   
    </body>
</html>