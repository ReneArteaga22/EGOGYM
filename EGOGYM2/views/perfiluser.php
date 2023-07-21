<!DOCTYPE html>
<html lang="en">
<head>

     <title>EGOGYM</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <!-- SCRIPTS -->
      <script src="../js/jquery.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/aos.js"></script>
      <script src="../js/smoothscroll.js"></script>
      <script src="../js/custom.js"></script>

     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="../css/font-awesome.min.css">
     <link rel="stylesheet" href="../css/aos.css">

     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../css/egogym.css">
     <link rel="stylesheet" href="../css/prof.css">

     <style>
      body{
        padding: 70px;
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
    </style>

</head>
<body data-spy="scroll" data-target="#navbarNav" data-offset="50">

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
                        <a href="#home" class="nav-link smoothScroll">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="#about" class="nav-link smoothScroll">Sobre Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a href="#serv" class="nav-link smoothScroll">Servicios</a>
                    </li>

                    <li class="nav-item">
                        <a href="#schedule" class="nav-link smoothScroll">Calendario</a>
                    </li>

                    <li class="nav-item">
                        <a href="#contact" class="nav-link smoothScroll">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <!---->
                        <div class="btn-group-sm"> 
                            <a href="#" class="btn btn-sm custom-btn bg-color "  data-toggle="modal" data-target="#membershipForm">Inicia Sesión</a> 
                    </li>
                </ul>

            </div>

        </div>
    </nav>

    <div class="container">
        <div class="main-body">
            
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                      <img src="../images/class/boxwax.jpg" alt="user" class="rounded-circle" width="250">
                      
                    
                      </div>
                    
                    </div>
                  </div>
                  <div class="card mt-3">
                    <?php
                    include '../class/database.php';
                    $conexion = new Database();
                    $conexion->conectarDB();
                    
                    
                    $idPersona = $_GET['id'];
                    
                    $consulta = "SELECT id_persona as matricula,concat(nombre,' ',apellido_paterno,' ', apellido_materno) as usuario, correo, 
                    telefono, fecha_nacimiento,
                    FLOOR(DATEDIFF(CURDATE(), fecha_nacimiento) / 365) AS edad, 
                    cliente.fecha_ini as inicio_suscripcion, cliente.fecha_fin as final_suscripcion, plan.nom_plan as plan FROM persona 
                    inner join cliente on persona.id_persona=cliente.id_cliente 
                    inner join plan on cliente.codigo_plan = plan.codigo
                    WHERE id_persona = $idPersona";
                    $parametros = array(':id' => $idPersona);
                    $persona = $conexion->seleccionar($consulta, $parametros);

                    if ($persona) 
                    {
                    echo "<ul class='list-group list-group-flush'>";
                    echo"<li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>";
                    echo"<p class='mb-0'>Fecha de fin</p>";  
                    echo"<span class='text-secondary'>". $persona[0]->plan ." </span>";
                    echo"</li>";
  
                      
                    echo "<ul class='list-group list-group-flush'>";
                    echo"<li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>";
                    echo"<p class='mb-0'>Fecha de inicio</p>";  
                    echo"<span class='text-secondary'>". $persona[0]->inicio_suscripcion ." </span>";
                    echo"</li>";
                   
                    echo "<ul class='list-group list-group-flush'>";
                    echo"<li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>";
                    echo"<p class='mb-0'>Fecha de fin</p>";  
                    echo"<span class='text-secondary'>". $persona[0]->final_suscripcion ." </span>";
                    echo"</li>";

                    $fechaFinal = new DateTime($persona[0]->final_suscripcion);
                    $fechaActual = new DateTime();
                    $intervalo = $fechaActual->diff($fechaFinal);
                    $diasRestantes = $intervalo->format('%r%a'); // El modificador %r agrega el signo negativo si la fecha ya ha pasado.

                    echo "<ul class='list-group list-group-flush'>";
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>";
                    echo "<p class='mb-0'>Días restantes de la suscripción:</p>";
                    echo "<span class='text-secondary'>" . $diasRestantes . " días</span>";
                    echo "</li>";

                   
                    }

                    ?>
                    
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    
                    <div class="row">
                        <div class="col-sm-12 btn-group-sm">
                          <a class="btn btn-sm custom-btn bg-color " target="__blank" href="#" data-toggle="modal" data-target="#plan_up">Actualizar plan</a>
                        </div>
                      </div>

                     </li>

                       
                    
              

                  </div>
                </div>
                <div class="col-md-8">
                  <div class="card mb-3">
                  <?php


$conexion = new Database();
$conexion->conectarDB();


$idPersona = $_GET['id'];

$consulta = "SELECT id_persona as matricula,concat(nombre,' ',apellido_paterno,' ', apellido_materno) as usuario, correo, 
telefono, fecha_nacimiento,
FLOOR(DATEDIFF(CURDATE(), fecha_nacimiento) / 365) AS edad, 
cliente.fecha_ini as inicio_suscripcion, cliente.fecha_fin as final_suscripcion FROM persona 
inner join cliente on persona.id_persona=cliente.id_cliente 
WHERE id_persona = $idPersona";
$parametros = array(':id' => $idPersona);
$persona = $conexion->seleccionar($consulta, $parametros);

if ($persona) {
   
   
    echo "<div class='card-body'>";
                      echo "<div class='row'>";
                       echo " <div class='col-sm-3'>";
                          echo "<h6 class='mb-0'>Nombre </h6>";
                        echo "</div>";
                        echo "<div class='col-sm-9 text-secondary'>";
                        echo "<h4> " . $persona[0]->usuario . "</h4>";
                        echo"</div>";
                      echo"</div>";
                      echo "<hr>";
                      echo"<div class='row'>";
                        echo "<div class='col-sm-3'>";
                        echo"  <h6 class='mb-0'>Email</h6>";
                        echo"</div>";
                       echo" <div class='col-sm-9 text-secondary'>";
                       echo "<h4>" . $persona[0]->correo . "</h4>";
                        echo "</div>";
                      echo"</div>";
                      echo"<hr>";
                     echo" <div class='row'>";
                        echo"<div class='col-sm-3'>";
                         echo" <h6 class='mb-0'>Tel</h6>";
                        echo "</div>";
                        echo "<div class='col-sm-9 text-secondary'>";
                        echo "<h4>" . $persona[0]->telefono . "</h4>";
                        echo "</div>";
                      echo "</div>";
                      echo "<hr>";
                      echo"<hr>";
                      echo"<div class='row'>";
                        echo"<div class='col-sm-3'>";
                          echo"<h6 class='mb-0'>Edad</h6>";
                        echo"</div>";
                        echo"<div class='col-sm-9 text-secondary'>";
                        echo "<h4>" . $persona[0]->edad .  " años</h4>";
                        echo"</div>";
                      echo"</div>";
                      echo"<hr>";
                      

    

} else {
    echo "Persona no encontrada";
}

$conexion->desconectarDB();
?>
                        <div class="row">
                        <div class="col-sm-12">
                          <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                        </div>
                      </div>
                    </div>
                    
                  </div>
    
                  <div class="class-info" style="text-align: center; display: flex; ">

                    <?php
                  // Conexión a la base de datos utilizando PDO

$conexion = new Database();
$conexion->conectarDB();

// Consulta SQL para obtener las citas solicitadas por mes
$consulta = "SELECT MONTH(fecha) as mes,
SUM(CASE WHEN servicios.nombre = 'nutricion' THEN 1 ELSE 0 END) as citas_nutricion,
SUM(CASE WHEN servicios.nombre = 'fisioterapia' THEN 1 ELSE 0 END) as citas_fisioterapia
FROM citas inner join servicios_empleados on citas.serv_emp = servicios_empleados.id_empserv
inner join servicios on servicios_empleados.servicio = servicios.codigo
GROUP BY MONTH(fecha)";
$resultado = $conexion->grafica($consulta);

$citasSolicitadas = array(
  'labels' => array(), // Nombres de los meses en el eje X
  'datasets' => array(
    array(
      'label' => 'Nutrición', // Etiqueta del dataset para el servicio de nutrición
      'data' => array(), // Cantidades de citas solicitadas para el servicio de nutrición en el eje Y
      'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
      'borderColor' => 'rgba(75, 192, 192, 1)',
      'borderWidth' => 1
    ),
    array(
      'label' => 'Fisioterapia', // Etiqueta del dataset para el servicio de fisioterapia
      'data' => array(), // Cantidades de citas solicitadas para el servicio de fisioterapia en el eje Y
      'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
      'borderColor' => 'rgba(255, 99, 132, 1)',
      'borderWidth' => 1
    )
  )
);


// Recorrer los resultados de la consulta y almacenar los datos en el array
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
  // Obtener el nombre del mes a partir del número del mes
  $nombreMes = $conexion->obtenerNombreMes($fila['mes']);

  // Agregar el nombre del mes a los labels
  $citasSolicitadas['labels'][] = $nombreMes;

  // Agregar las cantidades de citas para cada servicio al dataset correspondiente
  $citasSolicitadas['datasets'][0]['data'][] = $fila['citas_nutricion'];
  $citasSolicitadas['datasets'][1]['data'][] = $fila['citas_fisioterapia'];
}





// Desconectar la base de datos
$conexion->desconectarDB();
?>
<div class="container" style="align-items: center;">
        <h1>Gráfica de Citas Solicitadas</h1>
        <!-- Elemento canvas para dibujar el gráfico -->
        <canvas id="graficaCitas" width="400" height="200"></canvas>
        <!-- Script para crear el gráfico -->
<script>
    // Obtener el contexto del canvas
    var ctx = document.getElementById('graficaCitas').getContext('2d');

    // Datos de ejemplo
    var citasSolicitadas = <?php echo json_encode($citasSolicitadas); ?>;

    // Obtener los nombres de los meses y las cantidades de citas solicitadas
    var meses = Object.keys(citasSolicitadas);
    var cantidades = Object.values(citasSolicitadas);

    // Crear la gráfica
    
    var grafica = new Chart(ctx, {
    type: 'bar', // Tipo de gráfico (barra)
    data: citasSolicitadas,
    options: {
        responsive: false, // Desactivar la respuesta para ajustar el tamaño del gráfico
        scales: {
            y: {
                beginAtZero: true, // Empezar en el valor 0 en el eje Y
                ticks: {
                    stepSize: 1 // Mostrar solo valores enteros en el eje Y
                }
            }
        }
    }
});






</script>

    </div>


                   
                  </div>
    
    
    
                </div>
              </div>
    
            </div>
        </div>

        <div class="modal fade" id="plan_up" tabindex="-1" role="dialog" aria-labelledby="membershipFormLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        <div class="modal-content">
          <div class="modal-header">

            <h4 class="modal-title" id="membershipFormLabel">Dar de alta o actualizar plan</h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form class="membership-form webform" role="form"  action="../scripts/update_plan.php" method="post">
                


                
            <?php
$conexion = new Database();
$conexion->conectarDB();

$cadena = "SELECT codigo, nom_plan, precio FROM plan";
$reg = $conexion->seleccionar($cadena);
?>

<input type="hidden" name="clienteId" value="<?php echo $idPersona; ?>">

    <label style="position: relative; display: block;">
        <select required name="plan" id="planSelect" style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 20px;">
            <option value="Seleccione una" selected disabled hidden></option>
            
    <?php
    foreach ($reg as $value) {
      echo "<option value='" . $value->codigo . "' data-precio='" . $value->precio . "'>" . $value->nom_plan . "</option>";

    }
    ?>
  </select>
  <span style="position: absolute; top: -10px; left: 10px; background-color: #fff; padding: 0 5px; font-size: 14px; color: #999;">Tipo de plan</span>
</label>

<!-- Agrega un div para mostrar el precio -->
<div id="precioPlan" style="display: none; margin-top: 10px; font-weight: bold;"></div>

<?php
$conexion->desconectarDB();
?>


                <button type="submit" class="form-control" id="submit-button" name="submit">Ingresar el plan</button>
                
                
            </form>
          </div>

          <div class="modal-footer"></div>

         <script>
  // Función para mostrar el precio del plan seleccionado
  $(document).ready(function() {
    $("#planSelect").change(function() {
      const selectedPlan = $(this).find("option:selected");
      const precio = selectedPlan.data("precio");

      if (precio) {
        $("#precioPlan").text("Precio: $" + precio).show();
      } else {
        $("#precioPlan").hide();
      }
    });
  });
</script>


        
</body>
</html>