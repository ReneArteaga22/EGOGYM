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
      <script src="../../js/jquery.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <script src="../../js/aos.js"></script>
      <script src="../../js/smoothscroll.js"></script>
      <script src="../../js/custom.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


     <link rel="stylesheet" href="../../css/bootstrap.min.css">
     <link rel="stylesheet" href="../../css/font-awesome.min.css">
     <link rel="stylesheet" href="../../css/font-awesome.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">
     <link rel="stylesheet" href="../../css/profile.css">
     <style></style>

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
    $consulta = "SELECT tipo_usuario from persona
        where correo ='$email'";
    $datos = $conexion -> seleccionar($consulta);

        foreach ($datos as $dato)
        {
          $tipo = $dato->tipo_usuario;
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


<div class="container">

<div class="card bg-light" style="margin-top: 99px;">
        <div class="card-header bg-dark text-white">
          Informacion Personal
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
            echo "<a href='editarPerfil.php'>Editar Perfil</a>";


        }    
        ?>
      </div>
        </div>
      </form>
    </div>

      <div class="card bg-light" style="margin-top: 40px;">
        <div class="card-header bg-dark text-white">
          Historial de Citas
        </div>
        <div class="row">
        <div class="card-body row justify-content-center">
            <?php 

            
              $consulta = "select citas.id_cita, citas.fecha, citas.hora, ficha_nutri.motivo, servicios.nombre as servicio
              from persona
              inner join cliente on persona.id_persona=cliente.id_cliente
              inner join citas on cliente.id_cliente=citas.cliente
              inner join ficha_nutri on citas.id_cita=ficha_nutri.cita
              inner join servicios_empleados on citas.serv_emp = servicios_empleados.id_empserv
              inner join servicios on servicios_empleados.servicio = servicios.codigo
              where persona.correo = '$email' and citas.estado= 'completada'";
              $cita = $conexion -> seleccionar($consulta);

              foreach($cita as $dato)
              {
                echo "<div class='card w-75' style='margin-top:10px;'>";
                echo "<div class='card-body'>";
                echo "<div class='row'>";
                echo "<div class='col-lg-4 col-5'>";  
                echo "<p>Id Cita: $dato->id_cita</p>";
                echo "</div>";
                echo "<div class='col-lg-4 col-7'>";
                echo "<p>Fecha: $dato->fecha </p>";
                echo "</div>";
                echo "<div class='col-lg-4 col-5'>";
                echo "<p>Hora: $dato->hora</p>";
                echo "</div>";
                echo "<div class='col-lg-4 col-7'>";
                echo "<p>Motivo: $dato->motivo </p>";
                echo "</div>";
                echo "<div class='col-lg-4 col-6'>";
                echo "<p>Servicio: $dato->servicio</p>";
                echo "</div>";
                echo "<div class='col-lg-4 col-6'>
                <a class='btn btn-outline-info btn-sm' data-toggle='collapse' data-target= '#nutri' role='button' aria-expanded='false' aria-controls='nutri'>
                Ver Detalles
              </a>                
              </div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
              }
              ?>
              
              <?php
                $consulta2 = "select citas.id_cita, citas.fecha, citas.hora, ficha_fisio.motivo, servicios.nombre as servicio
                from persona
                inner join cliente on persona.id_persona=cliente.id_cliente
                inner join citas on cliente.id_cliente=citas.cliente
                inner join ficha_fisio on citas.id_cita=ficha_fisio.cita
                inner join servicios_empleados on citas.serv_emp = servicios_empleados.id_empserv
                inner join servicios on servicios_empleados.servicio = servicios.codigo
                where persona.correo = '$email' and citas.estado= 'completada'";
              $cita2 = $conexion -> seleccionar($consulta2);

              foreach($cita2 as $dato2)
              {
                echo "<div class='card w-75' style='margin-top:10px;'>";
                echo "<div class='card-body'>";
                echo "<div class='row'>";
                echo "<div class='col-lg-4 col-5'>";
                $cita = $dato2->id_cita;
                echo "<p>Id Cita:$dato2->id_cita</p>";
                echo "</div>";
                echo "<div class='col-lg-4 col-7'>";
                echo "<p>Fecha: $dato2->fecha </p>";
                echo "</div>";
                echo "<div class='col-lg-4 col-5'>";
                echo "<p>Hora: $dato2->hora</p>";
                echo "</div>";
                echo "<div class='col-lg-4 col-7'>";
                echo "<p>Motivo: $dato2->motivo </p>";
                echo "</div>";
                echo "<div class='col-lg-4 col-6'>";
                echo "<p>Servicio: $dato2->servicio</p>";
                echo "</div>";
                echo "<div class='col-lg-4 col-6'>
                <a class='btn btn-outline-info btn-sm' data-toggle='collapse' data-target= '#fisio' role='button' aria-expanded='false' aria-controls='fisio'>
                Ver Detalles
              </a>      
                </div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                
              }

              ?>
              
            </div>
          </div>


          
          
          </div>
        </div>
      </div>


<!-- Modal Ficha Medica Nutri -->
<div class="collapse text-center" id="nutri">
<div class="container">

    
<?php
  $conexion = new Database();
  $conexion->conectarDB();

  $consulta="SELECT concat(nombre,' ',apellido_paterno,' ',apellido_materno) as nombre, citas.fecha, 
  FLOOR(DATEDIFF(CURDATE(), fecha_nacimiento) / 365) AS edad FROM persona INNER JOIN cliente on cliente.id_cliente=persona.id_persona
  INNER JOIN citas on citas.cliente=cliente.id_cliente INNER JOIN ficha_nutri 
  ON ficha_nutri.cita=citas.id_cita WHERE ficha_nutri.cita=$dato->id_cita";
  $persona =$conexion->seleccionar($consulta);
 
  if($persona)
  {

    foreach($persona as $per)
    {
    echo "<div class='container' style='padding-top:3%'>
    <div class='container text-center'><h3>Ficha médica</<h3></div>
    <div class='card-header' style='color:grey; float: right'><h6> Fecha: ".$per->fecha."</h6></div>
     <div class='card-header'><h6>Cliente: ".$per->nombre."</h6></div>";
    
    echo"<div class='card'>";
  }
  
    $consulta3 = "SELECT ficha_nutri.objetivo, ficha_nutri.motivo, ficha_nutri.peso,
    ficha_nutri.altura, ficha_nutri.med_cintura, ficha_nutri.med_cadera, ficha_nutri.med_cuello,
    ficha_nutri.porc_grasa_corporal, ficha_nutri.masa_corp_magra, ficha_nutri.observaciones
    from ficha_nutri 
    where ficha_nutri.cita= $dato->id_cita";
    $ficha = $conexion->seleccionar($consulta3);

    foreach($ficha as $fila)
    {
    echo "<div class='row'>";

    echo "<div class='col-lg-6 col-6'>";
    echo "<div class='modal-body' style='padding: 3%'>";
    echo "<h6 style='font-weight:bold;color:black; opacity:0.7;'>Datos del paciente</h6><br>"; 
    echo "<p>Edad: ".$per->edad." años</p>";  
    echo "<p>Altura: ".$fila->altura." m</p>";
    echo "<p>Peso: ".$fila->peso." kg</p>";
    echo "<p>Cintura: ".$fila->med_cintura." cm</p>";
    echo "<p>Cadera: ".$fila->med_cadera." cm</p>";
    echo "<p>Cuello: ".$fila->med_cuello." cm</p>";
    echo "</div>";
    echo "</div>";

    echo "<div class='col-lg-6 col-6'>";
    echo "<div class='modal-body' style='padding: 3%'>";
    echo "<h6 style='font-weight:bold;color:black; opacity:0.7;'>Detalles: </h6><br>"; 
    echo "<p>Grasa Corporal: $fila->porc_grasa_corporal</p>";
    echo "<p>Masa Corporal Magra: $fila->masa_corp_magra</p>";
    echo "<p>Objetivo: ". $fila->objetivo." kg</p>";
    echo "<p>Motivo: $fila->motivo</p>";
    echo "<p>Observaciones: $fila->observaciones</p>";
    echo "</div>";
    echo "</div>";

    echo "</div>";
    }
    echo "</div>
    </div>";

    echo "</div>
    </div>";

  }
  else
  {
    echo "¡Esta cita no tiene una ficha médica!";
  }
  
  $conexion->desconectarBD();
  ?>
</div>


<!-- Modal Ficha Medica Fisio -->
<div class="collapse text-center" id="fisio">
<div class="container">

    
<?php
  $conexion = new Database();
  $conexion->conectarDB();

  $consulta4 ="SELECT concat(nombre,' ',apellido_paterno,' ',apellido_materno) as nombre, citas.fecha, 
  FLOOR(DATEDIFF(CURDATE(), fecha_nacimiento) / 365) AS edad FROM persona INNER JOIN cliente on cliente.id_cliente=persona.id_persona
  INNER JOIN citas on citas.cliente=cliente.id_cliente INNER JOIN ficha_fisio
  ON ficha_fisio.cita=citas.id_cita WHERE ficha_fisio.cita=$dato2->id_cita";
  $persona2 =$conexion->seleccionar($consulta4);
 
  if($persona2)
  {

    foreach($persona2 as $per2)
    {
    echo "<div class='container' style='padding-top:3%'>
    <div class='container text-center'><h3>Ficha médica</<h3></div>
    <div class='card-header' style='color:grey; float: right'><h6> Fecha: ".$per2->fecha."</h6></div>
     <div class='card-header'><h6>Cliente: ".$per2->nombre."</h6></div>";
    
    echo"<div class='card'>";
  }
  
    $consulta5 = "SELECT ficha_fisio.motivo, ficha_fisio.peso,
    ficha_fisio.altura, ficha_fisio.observaciones
    from ficha_fisio
    where ficha_fisio.cita= $dato2->id_cita";
    $ficha2 = $conexion->seleccionar($consulta5);

    foreach($ficha2 as $fila2)
    {
    echo "<div class='row'>";

    echo "<div class='col-lg-6 col-6'>";
    echo "<div class='modal-body' style='padding: 3%'>";
    echo "<h6 style='font-weight:bold;color:black; opacity:0.7;'>Datos del paciente</h6><br>"; 
    echo "<p>Edad: ".$per2->edad." años</p>";  
    echo "<p>Altura: ".$fila2->altura." m</p>";
    echo "<p>Peso: ".$fila2->peso." kg</p>";
    echo "</div>";
    echo "</div>";

    echo "<div class='col-lg-6 col-6'>";
    echo "<div class='modal-body' style='padding: 3%'>";
    echo "<h6 style='font-weight:bold;color:black; opacity:0.7;'>Detalles: </h6><br>"; 
    echo "<p>Motivo: $fila2->motivo</p>";
    echo "<p>Observaciones: $fila2->observaciones</p>";
    echo "</div>";
    echo "</div>";

    echo "</div>";
    }
    echo "</div>
    </div>";

    echo "</div>
    </div>";

  }
  else
  {
    echo "¡Esta cita no tiene una ficha médica!";
  }
  
  $conexion->desconectarBD();
  ?>
</div>
      
</div>

</body>
</html>