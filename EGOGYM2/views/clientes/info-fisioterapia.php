<!DOCTYPE html>
<html lang="en">
<head>
  <title>Fisioterapia</title>
  

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
     <link rel="stylesheet" href="../../css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">

</head>
  

<body>

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
        header("Location:../../First.php");
    }
       
    ?>

    <!-- MENU BAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="Primera.php#home">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a href="Primera.php#home" class="nav-link smoothScroll">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="Primera.php#about" class="nav-link smoothScroll">Sobre Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a href="Primera.php#serv" class="nav-link smoothScroll">Servicios</a>
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
    <div class="d-flex justify-content-center">
      <h2 class="text-center"></h2>
    </div>
   
  <br>
  <br>
  <br>
  <div class="row">
    <div class="col-12 col-xs-12 col-lg-6 card-text-center">
      <h2 class="text-center">¿QUÉ HACE UN FISIOTERAPEUTA?</h2>
      <p style="font-size: 20px; text-align: justify;"> 
        Un buen fisioterapeuta deportivo no sólo cura sobre la lesión, sino gran parte de su trabajo es asesorar
         a los deportistas para que, gracias a una correcta ejecución de los ejercicios y movimientos, puedan evitar lesiones.

      </p>
      <p style="font-size: 20px; text-align: justify;">
        Muchas lesiones se producen por una mala postura repetida continuamente en el tiempo. Corregir y explicar estos errores antes de que
         se produzcan es parte de esta tarea de divulgación y prevención propia del fisioterapeuta deportivo.

        Conocer y anticiparse a las lesiones es parte del compromiso de trabajo de estos profesionales de la salud.</p>

        <div class="col-12 col-lg-12 text-center">
          <div class="row">
            <div class="col-6 col-lg-5">
          <a href="citas.php" class="btn bg-color btn-lg">Agenda una cita</a>
          </div>
          <div class="col-6 col-lg-6">
          <a href="Primera.php#serv" class="btn bg-color btn-lg">Regresar a Servicios</a>
          </div>
          </div>
        </div>
    <br>
    </div>
       
    <div class="col-12 col-lg-6 text-center d-none d-md-block">
      <img src="../../images/class/Fisioterapia.jpg" class="img-fluid">
    </div>
  </div>

  <br>
  <br>      
</div>

</body>
</html>

