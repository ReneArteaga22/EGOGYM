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
        header("Location:../../First.php");
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

    <section class="kiara">
    <div class="container" style="padding-top: 3%;">
        <div class="main-body">

        <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                      <?php
        $conexion = new Database();
        $conexion->conectarDB();

        $email = $_SESSION["correo"];
        $idPersona = $_GET['id'];

        $consulta = "select persona.foto as foto,concat(persona.nombre,'  ', persona.apellido_paterno,'  ', persona.apellido_materno) as nombre,
        persona.correo, persona.telefono, persona.fecha_nacimiento, persona.sexo, persona.contraseña, plan.nombre as plan,
        concat(cliente.fecha_ini,'  ','de','  ',cliente.fecha_fin) as periodo from persona
        left join cliente on persona.id_persona = cliente.id_cliente
        left join plan on cliente.codigo_plan = plan.codigo
        where persona.id_persona = $idPersona";
        $datos_per = $conexion ->seleccionar($consulta);
        $imagenPorDefecto = "../../images/class/imagenxdefect.webp"; 

        
        foreach($datos_per as $registro)
        {

    // Operador ternario para determinar qué URL de imagen utilizar
    
    $urlImagenMostrar = $registro->foto ? $registro->foto : $imagenPorDefecto;
   
    echo "<img src='$urlImagenMostrar' class='rounded-circle' alt='user' style='width: 250px'>";
        }
        ?>
                    
                      </div>
                    
                    </div>
                  </div>
                  <div class="card mt-3">
                    <?php
                    $conexion = new Database();
                    $conexion->conectarDB();
                    
                    
                    $idPersona = $_GET['id'];
                    
                    $consulta = "SELECT id_persona as matricula,concat(persona.nombre,' ',persona.apellido_paterno,' ', persona.apellido_materno) as usuario, correo, 
                    telefono, fecha_nacimiento, persona.tipo_usuario, empleado.tipo_empleado,
                    FLOOR(DATEDIFF(CURDATE(), fecha_nacimiento) / 365) AS edad FROM persona
                    inner join empleado on empleado.id_empleado=persona.id_persona
                    WHERE id_persona = $idPersona";
                    $parametros = array(':id' => $idPersona);
                    $persona = $conexion->seleccionar($consulta, $parametros);

                    if ($persona) 
                    {
                        echo "<ul class='list-group list-group-flush'>";
                                    echo"<li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>";
                                    echo"<p class='mb-0'>Tipo de usuario: </p>";  
                                    echo"<span class='text-secondary'>". $persona[0]->tipo_usuario ." </span>";
                                    echo"</li>";

                                    echo"<li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>";
                                    echo"<p class='mb-0'>Tipo de empleado: </p>";  
                                    echo"<span class='text-secondary'>". $persona[0]->tipo_empleado ." </span>";
                                    echo"</li>";
                    }

                    ?>
                    
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    
                    <div class="row">
                        <div class="col-sm-12 btn-group-sm">
                          <a class="btn btn-sm custom-btn bg-color " target="__blank" href="#" data-toggle="modal" data-target="#tipo_up">Editar datos</a>
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

                $consulta = "SELECT id_persona as matricula,concat(persona.nombre,' ',persona.apellido_paterno,' ', persona.apellido_materno) as usuario, correo, 
                telefono, fecha_nacimiento, empleado.tipo_empleado as tipo,
                FLOOR(DATEDIFF(CURDATE(), fecha_nacimiento) / 365) AS edad, persona.contraseña FROM persona 
                inner join empleado on empleado.id_empleado=persona.id_persona
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
                    echo"<div class='row justify-content-center'>";
                    echo"<div class='text-center'>";
                    echo "<a class='btn btn-sm btn-success' data-toggle='collapse' data-target= '#contra' role='button' aria-expanded='false' aria-controls='contra' style='color:white;'>
                    Editar Contraseña </a>";
                    echo"</div>";
                    echo"</div>";
                  echo "<div class='collapse' id='contra'>
                  <div class='row justify-content-center'>
                  <form action='../../scripts/updatecontra.php?id=".$idPersona."' method='post' style=' width: 80%; margin-top:25px;'>
                  <label>Nueva Contraseña</label><br>
                  <input type='password' placeholder='' name='contra'>
                  <button type='submit' class='btn btn-success btn-sm' style='margin-left: 15px;'>Guardar</button>
                  </form>
                  </div>
                  </div>";
                    
    

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

    <!--Inicio del modal-->

    <div class="modal fade" id="tipo_up" tabindex="-1" role="dialog" aria-labelledby="membershipFormLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        <div class="modal-content">
          <div class="modal-header">

            <h4 class="modal-title" id="membershipFormLabel">Asignar tipo de empleado</h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form class="membership-form webform" role="form"  action="../../scripts/update_tipo.php" method="post">
              
            <input type="hidden" name="empleadoId" value="<?php echo $idPersona; ?>">

                <label style="position: relative; display: block;">
                    <select required name="tipo" id="planSelect" style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 20px;">
                        <option value="Seleccione una" selected disabled hidden></option>
                        <option value="3">Nutriólogo</option>
                        <option value="4">Fisioterapeuta</option>
                        <option value="5">Entrenador</option>
              </select>
              <span style="position: absolute; top: -10px; left: 10px; background-color: #fff; padding: 0 5px; font-size: 14px; color: #999;">Tipo de empleado</span>
            </label>

            <!-- Agrega un div para mostrar el precio -->
            <div id="precioPlan" style="display: none; margin-top: 10px; font-weight: bold;"></div>

            <?php
            $conexion->desconectarBD();
            ?>


                <button type="submit" class="form-control" id="submit-button" name="submit">Actualizar</button>
                
                
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

<!--Fin del modal-->
      
      
    </body>
</section>
</html>