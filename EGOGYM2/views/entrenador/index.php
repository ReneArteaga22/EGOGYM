<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Inicio spin</title>
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

    <body data-spy="scroll" data-target="#navbarNav" data-offset="50">
    <?php
    include '../../scripts/database.php';
    $conexion = new Database();
    $conexion->conectarDB();

    session_start();
    $email = $_SESSION["correo"];
    $consulta = "SELECT tipo_empleado, nombre from persona inner join empleado on persona.id_persona = empleado.id_empleado
        where correo ='$email'";
    $datos = $conexion -> seleccionar($consulta);

        foreach ($datos as $dato)
        {
          $tipo = $dato->tipo_empleado;
          $name = $dato->nombre;
        }

    if(isset($email) and $tipo == 'entrenador' )
    {
      
    }
    else 
    {
        header("Location:../../index.php");
    }
       
    ?>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="../nutriologo/index.php">EGO SPINNING</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                        <a href="index.php" class="nav-link smoothScroll">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="clases.php" class="nav-link smoothScroll">Clases</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                          <?php echo "Hola".'  '."$name"; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../entrenador/perfil_entre.php">Perfil</a></li>
                          <li><a class="dropdown-item" href="../../scripts/cerrarsesion.php">Cerrar Sesion</a></li>
                        </ul>
            </div>
        </div>
    </nav>
    <section class="hero-train d-flex flex-column justify-content-center align-items-center" id="home">

            <div class="bg-overlay"></div>

               <div class="container">
                    <div class="row">

                         <div class="col-lg-8 col-md-10 mx-auto col-12">
                              <div class="hero-text mt-5 text-center">
                                <?php
                                
                                ?>
                                  <h1 class="text-white" data-aos="fade-up" data-aos-delay="500"> ¡Bienvenido!</h1>

                                    <h6 data-aos="fade-up" data-aos-delay="300"><?php echo "Entrenador:".'  '."$name"; ?></h6>

                              </div>
                         </div>

                    </div>
               </div>
     </section>
     <section class="kiara">
    
    <div class="row">
    <div class="col-md-6">
        <div class="card" data-aos="fade-right">
            <div class="card-body">
                <h5>Clases de Spinning por Semana Confirmadas:</h5>
                <?php
    $conexion = new Database();
    $conexion->conectarDB();

    $consultaClasesSpinning = "SELECT WEEK(fecha) as semana, COUNT(*) as cantidad
                               FROM citas_spinning
                               WHERE estado = 'confirmada'
                               GROUP BY WEEK(fecha)
                               ORDER BY WEEK(fecha)";

    $clasesSpinningPorSemana = $conexion->seleccionar($consultaClasesSpinning);

    $conexion->desconectarBD();
    ?>
                <ul>
                    <?php foreach ($clasesSpinningPorSemana as $clase) : ?>
                        <li>Semana: <?php echo $clase->cantidad; ?> clases</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
    <div class="card" data-aos="fade-left">
    <div class="card-body">
        <h3 data-aos="fade-left">Clases de Spinning para Hoy</h3>
        <?php
        $conexion = new Database();
        $conexion->conectarDB();

        $consultaClasesSpinningHoy = "SELECT hora, COUNT(*) AS cantidad
                                      FROM citas_spinning
                                      WHERE estado = 'confirmada' AND DATE(fecha) = CURDATE()
                                      GROUP BY hora";

        $clasesSpinningHoy = $conexion->seleccionar($consultaClasesSpinningHoy);

        $conexion->desconectarBD();
        ?>
        
        
                <?php if (!empty($clasesSpinningHoy)) : ?>
                    <h5>Clases de Spinning para Hoy:</h5>
                    <ul>
                        <?php foreach ($clasesSpinningHoy as $clase) : ?>
                            <li><?php echo $clase->hora; ?> - Cantidad: <?php echo $clase->cantidad; ?> clases</li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>No hay clases de Spinning confirmadas para hoy.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    

    
</section>

    
    </body>
</html>