<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio fisio</title>
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

    if(isset($email) and $tipo == 'fisio' )
    {
      
    }
    else 
    {
        header("Location:../../index.php");
    }
       
    ?>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="index.php">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                        <a href="index.php" class="nav-link smoothScroll">Inicio</a>
                    </li>
                    <li class="nav-item">
                    <a href="citas_hoy.php" class="nav-link smoothScroll">Citas</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                          <?php echo "Hola".'  '."$name"; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../nutriologo/perfil_fisio.php">Perfil</a></li>
                          <li><a class="dropdown-item" href="../../scripts/cerrarsesion.php">Cerrar Sesion</a></li>
                        </ul>
            </div>
        </div>
    </nav>

<div class="container">
        <div class="card-header" style="color:black; margin-top:100px;">
          Tu información
        </div>

            <?php
        $conexion = new Database();
        $conexion->conectarDB();

        $email = $_SESSION["correo"];

        $consulta = "select persona.foto as foto,concat(persona.nombre,'  ', persona.apellido_paterno,'  ', persona.apellido_materno) as nombre,
        persona.correo, persona.telefono, persona.fecha_nacimiento, persona.sexo, persona.contraseña, plan.nombre as plan,
        concat(cliente.fecha_ini,'  ','de','  ',cliente.fecha_fin) as periodo from persona
        left join cliente on persona.id_persona = cliente.id_cliente
        left join plan on cliente.codigo_plan = plan.codigo
        where persona.correo = '$email'";
        $datos_per = $conexion ->seleccionar($consulta);
        $imagenPorDefecto = "../../images/class/imagenxdefect.webp"; 

        
        foreach($datos_per as $registro)
        {
          echo "<div class='card-body row'>";
          echo "<div class='col-lg-6 col-xs-12  col-sm-12 col-md-7 text-center'>";

    // Operador ternario para determinar qué URL de imagen utilizar
    
    $urlImagenMostrar = $registro->foto ? $registro->foto : $imagenPorDefecto;
   
    echo "<img src='$urlImagenMostrar' class='rounded-circle' alt='...' style='width: 60%'>";
    echo "</div>";
           
            echo "<div class='col-lg-6 col-12 col-sm-12 col-md-12'>";
            echo "<p>Nombre: $registro->nombre </p>";
            echo "<p>Correo: $registro->correo </p>";
            echo "<p>Telefono: $registro->telefono </p>";
            echo "<p>Fecha de nacimiento: $registro->fecha_nacimiento </p>";
            echo "<p>Sexo: $registro->sexo </p>";
            echo "<p>Plan: $registro->plan </p>";
            echo "<p>Periodo: $registro->periodo </p>";
            echo "<a href='editarfisio.php'>Editar Perfil</a>";


        }    
        ?> </div>
        
        
       
        </div>
        <?php
 
 $conexion = new Database();
$conexion->conectarDB();

// Obtener el primer día del mes actual
$primerDiaMesActual = date('Y-m-01');

// Consulta para obtener la cantidad de citas por servicio de nutrición y fisioterapia en los últimos 5 meses
$consulta = "SELECT MONTH(citas.fecha) as mes,
                   SUM(CASE WHEN servicios.nombre = 'nutricion' THEN 1 ELSE 0 END) as citas_nutricion,
                   SUM(CASE WHEN servicios.nombre = 'fisioterapia' THEN 1 ELSE 0 END) as citas_fisioterapia
            FROM citas
            INNER JOIN servicios_empleados ON citas.serv_emp = servicios_empleados.id_empserv
            INNER JOIN servicios ON servicios_empleados.servicio = servicios.codigo
            WHERE citas.fecha >= DATE_SUB(:primerDiaMesActual, INTERVAL 3 MONTH) AND
                  citas.fecha <= LAST_DAY(:primerDiaMesActual) + INTERVAL 1 MONTH
            GROUP BY mes
            ORDER BY mes";

try {
    $stmt = $conexion->obtenerConexion()->prepare($consulta);
    $stmt->bindParam(':primerDiaMesActual', $primerDiaMesActual);
    $stmt->execute();

    $citasNutricion = array_fill(0, 5, 0);
    $citasFisioterapia = array_fill(0, 5, 0);
    $nombresMeses = array();

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $mes = $fila['mes'];
        $citasNutricion[(date('n') - $mes + 5) % 5] = $fila['citas_nutricion'];
        $citasFisioterapia[(date('n') - $mes + 5) % 5] = $fila['citas_fisioterapia'];
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
            <canvas data-aos="fade-right" id="graficaCitas" width="400" height="200"></canvas>

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
                        stepSize: 1 
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