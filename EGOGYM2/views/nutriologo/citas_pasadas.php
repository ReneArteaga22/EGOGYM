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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">

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
    <body data-spy="scroll" data-target="#navbarNav" data-offset="50">
    <?php
    include '../../scripts/database.php';
    $conexion = new Database();
    $conexion->conectarDB();

    session_start();
    $email = $_SESSION["correo"];
    $consulta = "SELECT tipo_empleado, nombre from persona inner join empleado on persona.id_persona = empleado.id_empleado
        where correo ='$email'";
    $datos = $conexion -> seleccionar($consulta);

        foreach ($datos as $dato)
        {
          $tipo = $dato->tipo_empleado;
          $name = $dato->nombre;
        }

    if(isset($email) and $tipo == 'nutri' )
    {
      
    }
    else 
    {
        header("Location:../../index.php");
    }
       
    ?>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-nutri nutri" href="../nutriologo/index.php">EGO NUTRITION</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                        <a href="../nutriologo/index.php" class="nav-link smoothScroll">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="../nutriologo/citas_nutri.php" class="nav-link smoothScroll">Citas</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                          <?php echo "Hola".'  '."$name"; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../nutriologo/perfil_nutri.php">Perfil</a></li>
                          <li><a class="dropdown-item" href="../../scripts/cerrarsesion.php">Cerrar Sesion</a></li>
                        </ul>
                      </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="kiara">
    <div class="container" style="padding-top: 3%;">
        <h3 data-aos="fade-right">Citas agendadas</h3>
        <ul class="nav nav-tabs">
            <li class="active"><a href="../nutriologo/citas_hoy.php">Citas del día de hoy</a></li>
            <li class="active"><a href="../nutriologo/citas_prox.php" style="margin-left: 20px;">Citas próximas</a></li>
            <li><a data-toggle="tab" href="#citas" style="margin-left: 20px;">Citas pasadas</a></li>
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

         <div class="tab-content container">
        
        <div class="tab-pane active" id="citas">
        <form method="post" action="">
            <div class="row" style="margin-top: 5px;">


                <input type="text" name="cliente" placeholder="Nombre del cliente" class="form-control w-25" style="height: 35px;" required>

                <div class="col-lg-6">
                <label style="color:grey">Rango</label>
                <div class="input-group date">
                <input type="text" id="datepicker2" required name="fecha_1" placeholder="Selecciona una fecha" 
                style="border:none; background-color:lightgrey;color:grey">
                <input type="text" id="datepicker3" required name="fecha_2" style="margin-left: 10px;border:none;background-color:lightgrey;color:grey" 
                placeholder="Selecciona una fecha">
                </div>
                </div>
                <div class="col-lg-2">
                    <label style="color: grey;">Estado</label><br>
                    <select style="border:none;" name="estado">
                    <option value="3">Completada</option>
                    <option value="2">Cancelada</option>
                    <option value="4">No asisitió</option>
                    </select>
                </div>
                <input class="btn" type="submit" name="boton_past" value="Buscar" style="margin-top: 20px;">
            </div>
            
            </form>

            <?php
                if($_POST)
                {
                extract($_POST);
                $conexion = new database();
                $conexion->conectarDB();
                $consulta = "SELECT count(citas.id_cita) as cantidad,concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, 
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
                where e.servicio='nutricion' AND citas.fecha between '$fecha_1' and '$fecha_2' AND citas.estado=$estado
                AND citas.serv_emp=$ID AND concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) like '%$cliente%'
                GROUP BY nombre,apellido_paterno,apellido_materno, servicio,empleado,hora,fecha,estado,num
                ";
                $conexion->seleccionar($consulta);
                $tabla = $conexion->seleccionar($consulta);
                foreach($tabla as $registro)
                {
                    $registro->cantidad;
       
                    $cant_3= $registro;
                }
                if(isset($cant_3) != '0')
                {
                $conexion->seleccionar($consulta);
                $tabla = $conexion->seleccionar($consulta);
                echo 
                "
                <table class='table' style='border-radius: 5px;width:70%'>
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
                        Ficha medica
                        </th>
                    </tr>
                </thead>
                <tbody>";

                foreach ($tabla as $registro)
                {
                    echo "<tr>";
                    echo "<td> $registro->cliente</td> ";
                    echo "<td> $registro->fecha </td> ";
                    echo "<td> $registro->hora</td> ";
                    echo "<td><a href='verFicha.php?id=" . $registro->id_ficha . "'>Ver ficha médica</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>
                </table>";
            }
            else
            {
                echo "<h3 data-aos='fade-right' style='color: rgb(255, 165, 0,1)'>No existen citas con esas características</h3>";
            }
        }
            ?>
        </div>

        </div>

    </div>
    </section>

    </body>

</html>