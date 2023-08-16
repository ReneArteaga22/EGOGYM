<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spinning</title>
  

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
     <link rel="stylesheet" href="../../css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">

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
        header("Location:../../index.php");
    }
       
    ?>

    <!-- MENU BAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="index.php#home">EGO GYM</a>

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
    <div class="d-flex justify-content-center">
      <h1 class="text-center"></h1>
    </div>
   
  <br>
  <div class="row">
    <div class="col-12 col-xs-12 col-lg-6 card-text-center">
      <h1 class="text-center">¿Para qué sirve el spinning?</h1>
      <p style="font-size: 20px; text-align: justify;"> 
      El spinning es un ejercicio cardiovascular y aeróbico que se lleva a cabo utilizando una bicicleta estática o, 
      más bien, una bicicleta de spinning.

      A la hora de practicar spinning, el objetivo del deportista suele ser perder peso y tonificar su musculatura. No obstante, entrenando a través de este
      deporte se puede conseguir también una importante mejora tanto de la resistencia como de la fuerza.
      Pensado para personas de todas las edades y estaturas. 
      Para poder practiarlo hace falta una bicicleta estática que cumpla con un requisito fundamental: tener un volante de inercia que se encarga de hacer 
      resistencia y dar realismo al pedaleo.
      </p>
                
      <div class="col-12 col-lg-12 text-center">
        <div class="row">
          <div class="col-6 col-lg-5">
        <a href="citas.php" class="btn bg-color btn-lg">Agenda una cita</a>
        </div>
        <div class="col-6 col-lg-6">
        <a href="index.php#serv" class="btn bg-color btn-lg">Regresar a Servicios</a>
        </div>
        </div>
      </div>
    
    <br>
    </div>
       
    <div class="col-12 col-lg-6 text-center d-none d-md-block">
        <img src="../../images/class/IntructorSpinning.jpg" class="img-fluid" style="margin-top: 30px;">
      </div>
</div>

</body>
</html>



