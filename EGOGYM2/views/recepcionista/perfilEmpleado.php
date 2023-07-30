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

                    <li class="nav-item">
                        <a href="../recepcionista/citas.php" class="nav-link smoothScroll">Citas</a>
                    </li>

                    <li class="nav-item">
                        <a href="../recepcionista/usuarios.php" class="nav-link smoothScroll">Usuarios</a>
                    </li>

                    <li class="nav-item">
                        <a href="../recepcionista/registrarusu.php" class="nav-link smoothScroll">Registrar Nuevo Usuario</a>
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
                FLOOR(DATEDIFF(CURDATE(), fecha_nacimiento) / 365) AS edad FROM persona 
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
</html>