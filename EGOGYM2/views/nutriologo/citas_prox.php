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

            <a class="navbar-brand" href="../nutriologo/index.php">EGO GYM</a>

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
            <li class="active"><a data-toggle="tab" href="#citas_pr" style="margin-left: 20px;">Citas próximas</a></li>
            <li><a href="../nutriologo/citas_pasadas.php" style="margin-left: 20px;">Citas pasadas</a></li>
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
        
         <div class="tab-pane active" id="citas_pr">
            <form method="post" action="">
            <div class="row" style="margin-top: 5px;">

                <div class="col-lg-2">
                <label style="color:grey">Fecha</label>
                <div class="input-group date">
                <input type="text" id="datepicker" required name="fecha_cita">
                </div>
                </div>

                <div class="col-lg-2" style="margin-left: 30px;">
                    <label style="color: grey;">Estado</label><br>
                    <select style="border:none;" name="estado">
                    <option value="1">Confirmada</option>
                    <option value="2">Cancelada</option>
                    </select>
                </div>
                <input class="btn" type="submit" name="boton_prox" value="Buscar" style="margin-top: 20px; margin-left:30px">
            </div>
            
            </form>
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['boton_prox']))
            {
            extract($_POST);
             $conexion = new database();
             $conexion->conectarDB();
     
             $consulta = "SELECT count(citas.id_cita) as cantidad,concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, 
             e.servicio as servicio,e.empleado AS empleado, citas.hora as hora,citas.fecha, citas.estado, citas.id_cita
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
             where citas.fecha = '$fecha_cita' AND e.servicio='nutricion'  AND citas.estado=$estado
             AND citas.serv_emp=$ID
             GROUP BY nombre,apellido_paterno,apellido_materno, servicio,empleado,hora,fecha,estado,id_cita
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
                        echo "<td>$registro->estado</td>";
			            echo "<td><a href='../../scripts/cancelcita-nutri.php?idcita=" . $registro->id_cita . "' style='color:red;'>Cancelar</a></td>";
                        echo "</tr>";
                    }
                    echo "</tbody>
                    </table>";
                    $conexion->desconectarBD();
             }
             else
            {
               echo "<h5 data-aos='fade-right' style='color: goldenrod'>¡No existen citas agendadas para ese día!</h5>";
            }
         }
            ?>
        </div>

         </div>

    </div>
    </section>

    </body>

</html>