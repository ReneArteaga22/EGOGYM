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

     <link rel="stylesheet" href="../../css/bootstrap.min.css">
     <link rel="stylesheet" href="../../css/font-awesome.min.css">
     <link rel="stylesheet" href="../../css/font-awesome.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">
     <style></style>

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
                        <a href="../clientes/Primera.html" class="nav-link smoothScroll">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="#about" class="nav-link smoothScroll">Sobre Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a href="#serv" class="nav-link smoothScroll">Servicios</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          Agendar Cita
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="#">Spinning</a></li>
                          <li><a class="dropdown-item" href="#">Fisioterapeuta</a></li>
                          <li><a class="dropdown-item" href="#">Nutriologia</a></li>
                        </ul>
                      </li>
                
                    <li class="nav-item">
                        <a href="#serv" class="nav-link smoothScroll">Buscar</a>
                    </li>
                </ul>

                <ul class="social-icon ml-lg-3 d-none d-lg-flex">
                    <li><a href="https://fb.com/tooplate" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                </ul>

                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                          Hola Usuario
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="#">Perfil</a></li>
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
        <div class="card-body row">
            <div class="col-lg-6 col-xs-12  col-sm-12 col-md-6 text-center">
            <img src="../../images/class/boxwax.jpg" class="rounded-circle" alt="..." style="width: 60%;">
          </div>

        <?php
        include '../../scripts/database.php';
        $conexion = new Database();
        $conexion->conectarDB();

        $consulta = "select concat(persona.nombre,'  ', persona.apellido_paterno,'  ', persona.apellido_materno) as nombre,
        persona.correo, persona.telefono, persona.fecha_nacimiento, persona.sexo, persona.contraseña, plan.nombre as plan,
        concat(cliente.fecha_ini,'  ','de','  ',cliente.fecha_fin) as periodo from persona
        inner join cliente on persona.id_persona = cliente.id_cliente
        inner join plan on cliente.codigo_plan = plan.codigo
        where id_persona = 106";
        $datos_per = $conexion ->seleccionar($consulta);



        foreach($datos_per as $registro)
        {
            echo "<div class='col-lg-6 col-xs-12 col-sm-12 col-md-6'>";
            echo "<p>Nombre: $registro->nombre </p>";
            echo "<p>Correo: $registro->correo </p>";
            echo "<p>Telefono: $registro->telefono </p>";
            echo "<p>Fecha de nacimiento: $registro->fecha_nacimiento </p>";
            echo "<p>Sexo: $registro->sexo </p>";
            echo "<p>Contraseña: $registro->contraseña </p>";
            echo "<p>Plan: $registro->plan </p>";
            echo "<p>Periodo: $registro->periodo </p>";
            echo "</div>";

        }    
        ?>
        </div>
    </div>


      <div class="card bg-light" style="margin-top: 40px;">
        <div class="card-header bg-dark text-white">
          Historial de Citas
        </div>
        <div class="row">
        <div class="card-body row justify-content-center">
          <div class="card border-ligth col-lg-9 col-11">
            <div class="card-body row">

            <?php 
            $consulta = "select citas.id_cita, citas.fecha, citas.hora, ficha_nutri.motivo, servicios.nombre as servicio
            from ficha_nutri
            inner join citas on ficha_nutri.cita = citas.id_cita
            inner join servicios_empleados on citas.serv_emp = servicios_empleados.id_empserv
            inner join servicios on servicios_empleados.servicio = servicios.codigo
            where citas.cliente = 106";
            $cita = $conexion -> seleccionar($consulta);

            foreach($cita as $dato)
            {
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
              
            }
            ?>
              
              <div class="col-lg-4 col-6">
                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#membershipForm">Ver Detalles</button>
              </div>
            </div>
          </div>


          
          
          </div>
        </div>
      </div>


<!-- Modal -->
<div class="modal fade" id="membershipForm" tabindex="-1" role="dialog" aria-labelledby="membershipFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="membershipFormLabel">Ficha Medica</h2>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php 
      $consulta = "select ficha_nutri.edad, ficha_nutri.objetivo, ficha_nutri.motivo, ficha_nutri.peso,
      ficha_nutri.altura, ficha_nutri.med_cintura, ficha_nutri.med_cadera, ficha_nutri.med_cuello,
      ficha_nutri.porc_grasa_corporal, ficha_nutri.masa_corp_magra, ficha_nutri.observaciones
      from ficha_nutri 
      where ficha_nutri.cita= 501";
      $ficha = $conexion->seleccionar($consulta);

      foreach($ficha as $fila)
      {
      echo "<div class='modal-body' style='margin-top:15px;'>";
      echo "<p>Edad: $fila->edad</p>";
      echo "<p>Objetivo: $fila->objetivo</p>";
      echo "<p>Motivo: $fila->motivo</p>";
      echo "<p>Peso: $fila->peso</p>";
      echo "<p>Altura: $fila->altura</p>";
      echo "<p>Cintura: $fila->med_cintura</p>";
      echo "<p>Cadera: $fila->med_cadera</p>";
      echo "<p>Cuello: $fila->med_cuello</p>";
      echo "<p>Grasa Corporal: $fila->porc_grasa_corporal</p>";
      echo "<p>Masa Corporal Magra: $fila->masa_corp_magra</p>";
      echo "<p>Observaciones: $fila->observaciones</p>";
      echo "</div>";
      }
      ?>
      

      <div class="modal-footer"></div>
      
</div>

</body>
</html>
