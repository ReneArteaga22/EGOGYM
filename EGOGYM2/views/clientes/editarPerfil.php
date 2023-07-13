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
            <div class="col-lg-7 col-xs-12  col-sm-12 col-md-7 text-center">
            <img src="../../images/class/boxwax.jpg" class="rounded-circle" alt="..." style="width: 60%;">
            <input class="form-control form-control-sm" id="formFileSm" type="file" form="../../scripts/actualizarPerfil.php" method="post">
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
            echo "<form action='../../scripts/actualizarPerfil.php' method='POST'>";
            echo "<div class='col-lg-12 col-xs-12 col-sm-12 col-md-12'>";
            echo "<p>Nombre: $registro->nombre </p>";
            echo "<input type='mail' value='$registro->correo' class='form-control w-75' name='correo'>";
            echo "<input type='text' value='$registro->telefono' class='form-control w-50' name='telefono'>";
            echo "<p>Fecha de nacimiento: $registro->fecha_nacimiento </p>";
            echo "<p>Sexo: $registro->sexo </p>";
            echo "<input type='password' value='$registro->contraseña' class='form-control w-50' name='contra'>";
            echo "<p>Plan: $registro->plan </p>";
            echo "<p>Periodo: $registro->periodo </p>";

        }    
        ?>
        <div class="text-center"> 
        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
        </div>
      </div>
        </div>
      </form>
    </div>
    </div>

</body>
</html>