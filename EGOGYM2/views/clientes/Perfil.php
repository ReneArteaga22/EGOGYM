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
      minDate: '-1M',
      maxDate: '-1D',
      beforeShowDay: $.datepicker.noWeekends
    });} 
    );
    </script>

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
        <form method="post" action="">
            <div class="row justify-content-center" style="padding: 3%;">

                <div class="col-lg-4">
                    <label style="color: grey;">Servicio</label><br>
                    <select style="border:none;" name="servicio">
                    <option value="nutricion">Nutrición</option>
                    <option value="fisioterapia">Fisioterapia</option>
                    </select>
                </div>

                <div class="col-lg-4">
                <label style="color:grey">Fecha</label>
                <div class="input-group date">
                <input type="text" id="datepicker" required name="fecha_cita">
                </div>
                </div>
                <input class="btn" type="submit" name="boton_past" value="Buscar" style="margin-top: 20px;">
            </div>
            </form>

            <?php
            if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['boton_past']))
            {
              extract($_POST);
              $conexion= new Database();
              $conexion->conectarDB();
              $consulta = "SELECT count(citas.id_cita) as cantidad, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS cliente,
              e.servicio as servicio,e.empleado AS empleado, citas.hora as hora, citas.fecha, citas.estado, citas.id_cita
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
              where citas.fecha = '$fecha_cita' AND e.servicio='$servicio'
              group by persona.nombre, persona.apellido_paterno, persona.apellido_materno, servicio, empleado, hora, fecha, estado, id_cita
              ORDER BY concat(citas.fecha,' ',citas.hora) DESC";
              $conexion->seleccionar($consulta);
              $tabla = $conexion->seleccionar($consulta);
              foreach($tabla as $registro)
              {
                  $cant = $registro->cantidad;


                  $cant = $registro;
              }
              if (isset($cant) != '0')
              {
               echo "<div class='row'>
                <div class='card-body row justify-content-center'>";
        
                    
                      $consulta = "SELECT citas.id_cita, citas.fecha, citas.hora, ficha_nutri.motivo, servicios.nombre as servicio,
                      e.empleado
                      from persona
                      inner join cliente on persona.id_persona=cliente.id_cliente
                      inner join citas on cliente.id_cliente=citas.cliente
                      inner join ficha_nutri on citas.id_cita=ficha_nutri.cita
                      inner join servicios_empleados on citas.serv_emp = servicios_empleados.id_empserv
                      inner join servicios on servicios_empleados.servicio = servicios.codigo
                      INNER JOIN
                       (
                       SELECT id_empserv, concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS empleado,
                       servicios.nombre as servicio
                       FROM servicios_empleados
                       INNER JOIN servicios ON servicios.codigo=servicios_empleados.servicio
                       INNER JOIN empleado ON servicios_empleados.empleado=empleado.id_empleado
                       INNER JOIN persona ON empleado.id_empleado = persona.id_persona
                       ) AS e ON citas.serv_emp = e.id_empserv
                      where persona.correo = '$email' and citas.estado= 'completada'
                      and servicios.nombre='$servicio' and citas.fecha = '$fecha_cita' ";
                      $cita = $conexion -> seleccionar($consulta);
        
                      foreach($cita as $dato)
                      {
                        echo "<div class='card w-75' style='margin-top:10px;'>";
                        echo "<div class='card-body'>";
                        echo "<div class='row'>";
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
                        $empleado =$dato->empleado;
                        echo "<div class='col-lg-4 col-6'>
                        <a class='btn btn-outline-warning btn-sm' data-toggle='collapse' data-target= '#nutri' role='button' aria-expanded='false' aria-controls='nutri'>
                        Ver Detalles
                      </a>                
                      </div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                      }
                     
                      
                   
                        $consulta2 = "SELECT citas.id_cita, citas.fecha, citas.hora, ficha_fisio.motivo, servicios.nombre as servicio
                        from persona
                        inner join cliente on persona.id_persona=cliente.id_cliente
                        inner join citas on cliente.id_cliente=citas.cliente
                        inner join ficha_fisio on citas.id_cita=ficha_fisio.cita
                        inner join servicios_empleados on citas.serv_emp = servicios_empleados.id_empserv
                        inner join servicios on servicios_empleados.servicio = servicios.codigo
                        where persona.correo = '$email' and citas.estado= 'completada'
                        and servicios.nombre='$servicio' and citas.fecha = '$fecha_cita'";
                      $cita2 = $conexion -> seleccionar($consulta2);
        
                      foreach($cita2 as $dato2)
                      {
                        echo "<div class='card w-75' style='margin-top:10px;'>";
                        echo "<div class='card-body'>";
                        echo "<div class='row'>";
                        $cita = $dato2->id_cita;
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
                        <a class='btn btn-outline-warning btn-sm' data-toggle='collapse' data-target= '#fisio' role='button' aria-expanded='false' aria-controls='fisio'>
                        Ver Detalles
                      </a>      
                        </div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        
                  }
                  ?>
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
                      <div class='container text-center'><h5'>Ficha médica</h5></div>
                      <div class='card-header' style='color:grey; float: right'><p style='font-size: 15px;'> Fecha: ".$per->fecha."</p></div>
                       <div class='card-header'><p style='font-size: 15px;'>Empleado: ".$empleado."</p></div>";
                      
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
                   
                      echo "</div>";
                     }
                    
            }
          
            ?>
            
         
        
      
</div>

</body>
</html>