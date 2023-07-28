<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Registrar</title>
      <!-- SCRIPTS -->
      <script src="../../js/jquery.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <script src="../../js/aos.js"></script>
      <script src="../../js/smoothscroll.js"></script>
      <script src="../../js/custom.js"></script>

     <link rel="stylesheet" href="../../css/bootstrap.min.css">
     <link rel="stylesheet" href="../../css/font-awesome.min.css">
     <link rel="stylesheet" href="../../css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">
    </head>
    <body>
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


      
    <div class="container" style="padding-top: 14%;">
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
                    include '../../scripts/database.php';
                    $conexion = new Database();
                    $conexion->conectarDB();
                    
                    
                    $idPersona = $_GET['id'];
                    
                    $consulta = "SELECT id_persona as matricula,concat(persona.nombre,' ',apellido_paterno,' ', apellido_materno) as usuario, correo, 
                    telefono, fecha_nacimiento,
                    FLOOR(DATEDIFF(CURDATE(), fecha_nacimiento) / 365) AS edad, 
                    cliente.fecha_ini as inicio_suscripcion, cliente.fecha_fin as final_suscripcion, plan.nombre as plan FROM persona 
                    inner join cliente on persona.id_persona=cliente.id_cliente 
                    inner join plan on cliente.codigo_plan = plan.codigo
                    WHERE id_persona = $idPersona";
                    $parametros = array(':id' => $idPersona);
                    $persona = $conexion->seleccionar($consulta, $parametros);

                    if ($persona) 
                    {
                      echo "<ul class='list-group list-group-flush'>";
                      echo"<li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>";
                      echo"<p class='mb-0'>Plan</p>";  
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
                      echo "<li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>";
                      echo "<p class='mb-0'>Estatus del plan:</p>";
                      if($diasRestantes > 0)
                      {
                        echo "<span class='text-success'>Activo</span>";
                      }
                      else
                      {
                        echo "<span class='text-danger'>Inactivo</span>";
                      }
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

                $consulta = "SELECT id_persona as matricula,concat(persona.nombre,' ',apellido_paterno,' ', apellido_materno) as usuario, correo, 
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
                          echo "<h6 class='mb-0'>Nombre: </h6>";
                        echo "</div>";
                        echo "<div class='col-sm-9 text-secondary'>";
                        echo "<h4> " . $persona[0]->usuario . "</h4>";
                        echo"</div>";
                      echo"</div>";
                      echo "<hr>";
                      echo"<div class='row'>";
                        echo "<div class='col-sm-3'>";
                        echo"  <h6 class='mb-0'>Email:</h6>";
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
                
                $conexion->desconectarBD();
                ?>
                        <div class="row">
                      </div>
                    </div>
                    
                  </div>
    
                  <div class="class-info" style="text-align: center; display: flex; ">


        </div>
    </div>
      
    </body>
</html>