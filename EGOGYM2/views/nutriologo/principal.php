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

     <link rel="stylesheet" href="../../css/bootstrap.min.css">
     <link rel="stylesheet" href="../../css/font-awesome.min.css">
     <link rel="stylesheet" href="../../css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">
    </head>
    <body data-spy="scroll" data-target="#navbarNav" data-offset="50">
    <?php
    session_start();
    
    if(isset($_SESSION["correo"]) )
    {
        $email = $_SESSION["correo"];
    }
    else 
    {
        header("Location:../../First.php");
    }

    ?>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="../nutriologo/principal.php">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                        <a href="../nutriologo/principal.php" class="nav-link smoothScroll">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="../nutriologo/citas_nutri.php" class="nav-link smoothScroll">Citas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--Inicio de recepcionista-->
    <div class="container" style="padding-top: 10%;">
        <h1 style="text-align: center;" data-aos="fade-right">¡Hola!</h1>
        <!--Tablas de citas registradas para el día actual-->
    </div>
    <div class="container">
        <div class="card-header" style="color:black;">
          Tu información
        </div>

        <div class="card-body row">
            <div class="col-lg-6 col-xs-12  col-sm-12 col-md-6 text-center">
            <img src="../../images/class/boxwax.jpg" class="rounded-circle" alt="..." style="width: 60%;">
          </div>
        <?php
        include '../../scripts/database.php';
        $conexion = new Database();
        $conexion->conectarDB();

        $consulta = "SELECT concat(persona.nombre,'  ', persona.apellido_paterno,'  ', persona.apellido_materno) as nombre, persona.id_persona,
        persona.correo, persona.telefono, persona.fecha_nacimiento, persona.sexo, persona.contraseña,FLOOR(DATEDIFF(CURDATE(), fecha_nacimiento) / 365) AS edad from persona
        where persona.id_persona in (select nutricionista.id_nutri from nutricionista) AND persona.correo='$email'";
        $datos_per = $conexion ->seleccionar($consulta);

        foreach($datos_per as $registro)
        {
            echo "<div class='col-lg-6 col-xs-12 col-sm-12 col-md-6'>";
            echo "<p>Nombre: $registro->nombre </p>";
            echo "<p>Correo: $registro->correo </p>";
            echo "<p>Telefono: $registro->telefono </p>";
            echo "<p>Edad: ".$registro->edad." años </p>";
            echo "<p>Sexo: $registro->sexo </p>";
            echo "</div>";

            echo "<a href='editarNutri.php?id=".$registro->id_persona."' style='margin:auto; font-size:15px; color:goldenrod ; font-style:oblique;'>
            Editar perfil
          </a>";

        } 
        
        ?>

        </div>
    </div>
    <br>
    <br>
    </body>
</html>