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

    <section class="kiara d-flex flex-column justify-content-center align-items-center" id="home">
    <div class="container" ">
        <h1 data-aos="fade-up" style="text-align: center;"> RECEPCIÓN EGOGYM </h1>
        <hr class="dropdown divider" style="height: 2px;">

        
    </div>
    <div class="container">
        <?php
        $conexion = new database();
        $conexion->conectarDB();

        $consulta = "SELECT count(citas.id_cita) as cantidad, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente, 
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
         where citas.fecha = curdate()
         group by citas.id_cita;
        ";
         $tabla = $conexion->seleccionar($consulta);
         foreach($tabla as $registro)
         {
             $cant = $registro->cantidad;

             $cant = $registro;
         }
         if(isset($cant) != '0')
         {
            echo"<h3 data-aos='fade-right'>Citas del día de hoy</h3>";
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
                 Hora
                 </th>
                 <th style='color: goldenrod;'>
                 Servicio
                 </th>
                 <th style='color: goldenrod;'>
                 Empleado
                 </th>
                 <th>
                 </th>
             </tr>
         </thead>
         <tbody>";
         foreach ($tabla as $registro)
         {
             echo "<tr>";
             echo "<td> $registro->cliente</td> ";
             echo "<td> $registro->hora</td> ";
             echo "<td> $registro->servicio</td> ";
             echo "<td> $registro->empleado</td> ";
         }
         echo "</tbody>
         </table>";
         $conexion->desconectarBD();
         }
         else
         {
            echo "<h2 data-aos='fade-right' style='color: goldenrod'>¡No hay citas pendientes el día de hoy!</h2>";
         }

         
        ?>
    </div>
    </section>
    <?php
 
 $conexion = new Database();
$conexion->conectarDB();
// Obtener el primer día del mes actual
$primerDiaMesActual = date('Y-m-01');

$consulta = "SELECT MONTH(citas.fecha) as mes,
                   SUM(CASE WHEN servicios.nombre = 'nutricion' THEN 1 ELSE 0 END) as citas_nutricion,
                   SUM(CASE WHEN servicios.nombre = 'fisioterapia' THEN 1 ELSE 0 END) as citas_fisioterapia
            FROM citas
            INNER JOIN servicios_empleados ON citas.serv_emp = servicios_empleados.id_empserv
            INNER JOIN servicios ON servicios_empleados.servicio = servicios.codigo
            WHERE citas.fecha >= DATE_SUB(:primerDiaMesActual, INTERVAL 2 MONTH) AND
                  citas.fecha <= LAST_DAY(:primerDiaMesActual) 
            GROUP BY mes
            ORDER BY mes";

try {
    $stmt = $conexion->obtenerConexion()->prepare($consulta);
    $stmt->bindParam(':primerDiaMesActual', $primerDiaMesActual);
    $stmt->execute();

    $citasNutricion = array_fill(0, 3, 0); // Para los últimos 3 meses
    $citasFisioterapia = array_fill(0, 3, 0); // Para los últimos 3 meses
    $nombresMeses = array();

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $mes = $fila['mes'];
        $citasNutricion[(date('n') - $mes + 2) % 3] = $fila['citas_nutricion'];
        $citasFisioterapia[(date('n') - $mes + 2) % 3] = $fila['citas_fisioterapia'];
        $nombresMeses[] = $conexion->obtenerNombreMes($mes);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
 
 $conexion->desconectarBD();
 ?>
 
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 data-aos="fade-right">Gráfica de Citas por Servicio</h3>
            <canvas data-aos="fade-right" id="graficaCitas" width="400" height="300"></canvas>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
               var citasNutricion = <?php echo json_encode($citasNutricion); ?>;
    var citasFisioterapia = <?php echo json_encode($citasFisioterapia); ?>;
    var nombresMeses = <?php echo json_encode($nombresMeses); ?>;

   
    var ctx = document.getElementById('graficaCitas').getContext('2d');

   
    var grafica = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombresMeses,
            datasets: [{
                label: 'Citas de Nutrición',
                data: citasNutricion,
                backgroundColor: 'rgb(218, 165, 32,0.5)',
                borderColor: 'rgb(218, 165, 32,1)',
                borderWidth: 1
            }, {
                label: 'Citas de Fisioterapia',
                data: citasFisioterapia,
                backgroundColor: 'rgb(0, 0, 0,0.4)',
                borderColor: 'rgb(0, 0, 0,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: false, 
            scales: {
                y: {
                    beginAtZero: true, 
                    ticks: {
                        stepSize: 2 ,
                        fontSize: 10
                    }
                }
            }
        }
    });
            </script>
        </div>
        <div class="col-md-6">
            <h3 data-aos="fade-left">Resumen de Citas del mes</h3>
            <?php
           $conexion = new Database();
           $conexion->conectarDB();
       
          
           $consultaTotalCitas = "SELECT COUNT(*) AS total FROM citas
           INNER JOIN servicios_empleados ON citas.serv_emp = servicios_empleados.id_empserv
           INNER JOIN servicios ON servicios_empleados.servicio = servicios.codigo
           WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())";
           $consultaCitasConfirmadas = "SELECT COUNT(*) AS confirmadas FROM citas
           INNER JOIN servicios_empleados ON citas.serv_emp = servicios_empleados.id_empserv
           INNER JOIN servicios ON servicios_empleados.servicio = servicios.codigo
           WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE()) and estado = 'confirmada' ";
           $consultaCitasCanceladas = "SELECT COUNT(*) AS canceladas FROM citas WHERE estado = 'cancelada'";
           $consultaCitasCompletadas = "SELECT COUNT(*) AS completadas FROM citas WHERE estado = 'completada'";
           $consultaCitasPorServicio = "SELECT servicios.nombre AS servicio, COUNT(*) AS cantidad
           FROM citas
           INNER JOIN servicios_empleados ON citas.serv_emp = servicios_empleados.id_empserv
           INNER JOIN servicios ON servicios_empleados.servicio = servicios.codigo
           WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
           GROUP BY servicio";
       
           $totalCitas = $conexion->seleccionar($consultaTotalCitas)[0]->total;
           $citasConfirmadas = $conexion->seleccionar($consultaCitasConfirmadas)[0]->confirmadas;
           $citasCanceladas = $conexion->seleccionar($consultaCitasCanceladas)[0]->canceladas;
           $citasCompletadas = $conexion->seleccionar($consultaCitasCompletadas)[0]->completadas;
           $citasPorServicio = $conexion->seleccionar($consultaCitasPorServicio);
            ?>
            <div class="card" data-aos="fade-left">
                <div class="card-body">
                    <p>Total de Citas: <?php echo $totalCitas; ?></p>
                    <p>Citas Confirmadas: <?php echo $citasConfirmadas; ?></p>
                    <p>Citas Canceladas: <?php echo $citasCanceladas; ?></p>
                    <p>Citas Completadas: <?php echo $citasCompletadas; ?></p>
                    <h5>Citas por Servicio:</h5>
                    <ul>
                        <?php foreach ($citasPorServicio as $cita) : ?>
                            <li><?php echo $cita->servicio; ?>: <?php echo $cita->cantidad; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    </body>
</html>