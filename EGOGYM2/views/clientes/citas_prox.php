<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mis citas</title>
  

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">

     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">

     <!--Calendario-->
     <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script>
$(document).ready(function() {

  $('.dropdown-menu a.dropdown-item').click(function(event) {
 
    event.preventDefault();


    var href = $(this).attr('href');

    
    window.location.href = href;
  });
});
</script>
<script>
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
    $consulta = "SELECT tipo_usuario, id_persona from persona
        where correo ='$email'";
    $datos = $conexion -> seleccionar($consulta);

        foreach ($datos as $dato)
        {
          $tipo = $dato->tipo_usuario;
          $id_per = $dato->id_persona;
        }

    if(isset($email) and $tipo == 'cliente' )
    {
      
    }
    else 
    {
        header("Location:../../index.php");
    }
       
    ?>

     <!-- MENU BAR -->
     <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="index.html">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a href="index.php#home" class="nav-link smoothScroll">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php#about" class="nav-link smoothScroll">Sobre Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php#serv" class="nav-link smoothScroll">Servicios</a>
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
                        <a href="staff.php" class="nav-link smoothScroll">Staff</a>
                    </li>
                </ul>


                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                         <?php echo "Hola".'  '.$_SESSION["correo"]; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="../clientes/Perfil.php">Perfil</a></li>
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
        <li><a href="../clientes/citas_hoy.php">Citas del día de hoy</a></li>
        <li><a data-toggle="tab" href="#citas_prox" style="margin-left: 20px;">Citas próximas</a></li>
        <li><a href="../clientes/citas_can.php" style="margin-left: 20px;">Citas canceladas</a></li>
        <li><a href="../clientes/clases_ag.php" style="margin-left: 20px;">Clases agendadas</a></li>
        </ul>

        <?php
        $db= new database();
        $db->conectarDB();
         $email = $_SESSION["correo"];
         $consulta = "SELECT persona.id_persona from persona where correo ='$email'";
         $datos = $db -> seleccionar($consulta);
     
             foreach ($datos as $dato)
             {
               $id_per = $dato->id_persona;
             }
         ?>

        <div class="tab-content container">
       
        <div class="tab-pane active" id="citas_pr">
            
            
            <?php
              $conexion = new database();
              $conexion->conectarDB();    
              $consulta = "SELECT count(citas.id_cita) as cantidad, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, 
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
              where citas.fecha > curdate() and citas.estado = 'confirmada' and citas.cliente = $id_per
              GROUP BY nombre, apellido_paterno, apellido_materno, servicio, empleado, hora, fecha, estado, cita
              ORDER BY concat(citas.fecha,' ',citas.hora) DESC";
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
                    <table class='table' style='border-radius: 5px;width:90%'>
                    <thead class='table-dark' style='text-align:'center;''>
                        <tr>
                        <br>
                            <th style='color: goldenrod;'>
                            Empleado
                            </th>
                            <th style='color: goldenrod;'>
                            Servicio
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
                        echo "<td> $registro->empleado</td> ";
                        echo "<td> $registro->servicio</td> ";
                        echo "<td> $registro->fecha</td> ";
                        echo "<td> $registro->hora</td> ";
                        $estado = $registro->estado;
                        echo "<td>$registro->estado</td>";
                        $cita = $registro->cita;
                        if ($estado == 'confirmada')
                        {
                            echo "<td><a href='../../scripts/cancelcita-clien.php?idcita=" . $cita . "' style='color:red;'>Cancelar</a></td>";
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
               echo "<h2 data-aos='fade-right' style='color: goldenrod'>¡No tienes citas pendientes!</h2>";
            }
            ?>
            </div>
        
        </div>

        </div>

    </section>
  </body>
  </html>
