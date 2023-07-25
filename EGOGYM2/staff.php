<!DOCTYPE html>
<html lang="en">
<head> 

     <title>Staff</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <!-- SCRIPTS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/aos.js"></script>
      <script src="js/smoothscroll.js"></script>
      <script src="js/custom.js"></script>

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/egogym.css">
 
</head>

<style>
    body
    {
        align-content: center;
        background-color: #424949 ;
    }
    /* pequeñas */
@media (max-width: 567px) {
  .card {
    width: 53%;
    margin: 10px;
    text-align: center;
  }
  .row
  {
    margin-top: 120px;
  }
   #cards
  {
    margin-left: 100px;
  }
}
@media (min-width: 568px) and (max-width: 766px) {
  .card {
    width: 43%;
    margin: 10px;
    text-align: center;
  }
  .row
  {
    margin-top: 110px;
    margin-bottom: 40px;
  }
   #cards
  {
    margin-left: 70px;
  }
}

/* medianas */
@media (min-width: 767px) and (max-width: 991px) {
  .card {
    width: 28%;
    margin: 10px;
    text-align: center;
  }
  .row
    {
      margin-top: 120px;
      margin-bottom: 30px;
    }
    #cards
  {
    margin-left: 100px;
  }
}

/* grandes */
@media (min-width: 992px) {
  .card {
    width: 22%;
    margin: 10px;
    text-align: center;
  }
  .row
  {
    margin-top: 115px;
    margin-bottom: 40px;
  }
  #cards
  {
    margin-left: 130px;
  }
} 

</style>
<body  data-spy="scroll" data-target="#navbarNav" data-offset="50">

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
                        <a href="#home" class="nav-link smoothScroll">Home</a>
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

<div class="container" id="cards">
    <div class="row" style="align-self: center;">

    <?php
include 'conexion/database.php';
$conexion = new Database();
$conexion->conectarDB();

try {
    $consulta = "SELECT persona.id_persona, persona.nombre, persona.apellido_paterno, persona.apellido_materno, empleado.tipo_empleado, persona.telefono, persona.correo FROM persona INNER JOIN empleado ON persona.id_persona = empleado.id_empleado WHERE persona.tipo_usuario = 'empleado'";
    $resultado = $conexion->seleccionar($consulta);

      if (!empty($resultado)) {

        foreach ($resultado as $row) {
          echo '<div class="card">';
          echo '<img src="images/fp.jpg" style="width: 90%; align-self: center; margin: 10px;" class="card-img-top" alt="...">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title" style="align-content: center;">'. $row->nombre . " " . $row->apellido_paterno .'</h5>';

          if ($row->tipo_empleado  == 'nutri') {
            echo '<p class="card-text">Nutricionista</p>';
        } elseif ($row->tipo_empleado == 'entrenador') {
            echo '<p class="card-text">Entrenador</p>';
        } elseif ($row->tipo_empleado == 'fisio') {
          echo '<p class="card-text">Fisiologo</p>';
        } elseif ($row->tipo_empleado == 'recepcionista') {
          echo '<p class="card-text">Recepcionista</p>';
        }
        
          echo '<button style="background-color:#D4AC0D ;" type="button" class="btn" data-toggle="modal" data-target="#ctc-' . $row->id_persona . '">Contacto</button> <br>';
          echo '</div>';
          echo '</div>'; 
      
          echo '<div class="modal fade" id="ctc-' . $row->id_persona . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
          echo '<div class="modal-dialog">';
          echo '<div class="modal-content">';
          echo '<div class="modal-header">';
          echo '<h4 class="modal-title fs-5" id="exampleModalLabel">'. $row->nombre . " " . $row->apellido_paterno . " " . $row->apellido_materno .'</h4>';
          echo '</div>';
          echo '<div class="modal-body">';
          echo '<hr><h5>Contacto:</h5>';
          echo '<hr>';
          echo '<p>'. "Telefono: " . $row->telefono . '</p> <p>'. "Correo: " . $row->correo . '</p>';
          echo '</div>';
          echo '<div class="modal-footer">';
          echo '<button type="button" class="btn bg-color" data-bs-dismiss="modal">Cerrar</button>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        
        }
      }

  else {
    echo "No se encontraron resultados.";
  }

} catch (PDOException $e) {
    echo $e->getMessage();
}

$conexion->desconectarDB();
?>
    </div>

  </div>
</body>
</html>