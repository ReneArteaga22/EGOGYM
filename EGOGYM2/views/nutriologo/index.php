<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Inicio nutri</title>
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
    <section class="hero-nutri d-flex flex-column justify-content-center align-items-center" id="home">

<div class="bg-overlay"></div>

   <div class="container">
        <div class="row">

             <div class="col-lg-8 col-md-10 mx-auto col-12">
                  <div class="hero-text mt-5 text-center">
                    <?php
                    
                    ?>
                      <h1 class="text-white" data-aos="fade-up" data-aos-delay="500"> ¡Bienvenido!</h1>

                        <h6 data-aos="fade-up" data-aos-delay="300"><?php echo "Nutriologo:".'  '."$name"; ?></h6>

                  </div>
             </div>

        </div>
   </div>
</section>

    
    <?php
    
 
 $conexion = new Database();
$conexion->conectarDB();
// Obtener el primer día del mes actual
$primerDiaMesActual = date('Y-m-01');

$consulta = "SELECT MONTH(citas.fecha) as mes,
                   SUM(CASE WHEN servicios.nombre = 'nutricion' THEN 1 ELSE 0 END) as citas_nutricion
                   
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
   
    $nombresMeses = array();

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $mes = $fila['mes'];
        $citasNutricion[(date('n') - $mes + 2) % 3] = $fila['citas_nutricion'];
        
        $nombresMeses[] = $conexion->obtenerNombreMes($mes);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
 
 $conexion->desconectarBD();
 ?>
 <section class="kiara">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 data-aos="fade-right">Gráfica de Citas por Servicio</h3>
            <canvas data-aos="fade-right" id="graficaCitas" width="400" height="400"></canvas>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
               var citasNutricion = <?php echo json_encode($citasNutricion); ?>;

    var nombresMeses = <?php echo json_encode($nombresMeses); ?>;

   
    var ctx = document.getElementById('graficaCitas').getContext('2d');

   
    var grafica = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombresMeses,
            datasets: [{
                label: 'Citas de Nutrición',
                data: citasNutricion,
                backgroundColor: 'rgb(255, 165, 0,0.5)',
                borderColor: 'rgb(255, 165, 0,1)',
                borderWidth: 1
            }, ]
        },
        options: {
            responsive: false, 
            scales: {
                y: {
                    beginAtZero: true, 
                    ticks: {
                        stepSize: 5
                        ,fontSize: 10
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
           WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
           AND servicios.codigo = 3"; 

$consultaCitasConfirmadas = "SELECT COUNT(*) AS confirmadas FROM citas
                 INNER JOIN servicios_empleados ON citas.serv_emp = servicios_empleados.id_empserv
                 INNER JOIN servicios ON servicios_empleados.servicio = servicios.codigo
                 WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
                 AND estado = 'confirmada' AND servicios.codigo = 3";

$consultaCitasCanceladas = "SELECT COUNT(*) AS canceladas FROM citas
                             INNER JOIN servicios_empleados ON citas.serv_emp = servicios_empleados.id_empserv
                 INNER JOIN servicios ON servicios_empleados.servicio = servicios.codigo
                 WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
                 AND estado = 'confirmada' AND servicios.codigo = 3";

$consultaCitasCompletadas = "SELECT COUNT(*) AS completadas FROM citas
                             INNER JOIN servicios_empleados ON citas.serv_emp = servicios_empleados.id_empserv
                 INNER JOIN servicios ON servicios_empleados.servicio = servicios.codigo
                 WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
                 AND estado = 'confirmada' AND servicios.codigo = 3";

$consultaCitasPorServicio = "SELECT servicios.nombre AS servicio, COUNT(*) AS cantidad
                 FROM citas
                 INNER JOIN servicios_empleados ON citas.serv_emp = servicios_empleados.id_empserv
                 INNER JOIN servicios ON servicios_empleados.servicio = servicios.codigo
                 WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE()) 
                 AND servicios.codigo = 3
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
                    
                </div>
            </div>
        </div>
    </div>
</div>
</section>
    </body>
</html>