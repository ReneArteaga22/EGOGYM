<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Ficha médica</title>
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

            <a class="navbar-brand" href="../fisioterapeuta/principal.php">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                        <a href="../fisioterapeuta/principal.php" class="nav-link smoothScroll">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="../fisioterapeuta/citas_fisio.php" class="nav-link smoothScroll">Citas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
      <?php
      include '../../scripts/database.php';
      $conexion = new Database();
      $conexion->conectarDB();

      $idFicha = $_GET['id'];
      $consulta="SELECT concat(nombre,' ',apellido_paterno,' ',apellido_materno) as nombre, citas.fecha FROM persona INNER JOIN cliente on cliente.id_cliente=persona.id_persona
      INNER JOIN citas on citas.cliente=cliente.id_cliente INNER JOIN ficha_fisio
      ON ficha_fisio.cita=citas.id_cita WHERE ficha_fisio.id_ficha=$idFicha";
      $parametros = array(':id'=> $idFicha);
      $persona =$conexion->seleccionar($consulta, $parametros);

      if($persona)
      {
        echo "<div class='container'>
        <div class='card-body row justify-content-center'>";
        echo "<h5>Cliente: ".$persona[0]->nombre."</h5>";
        echo "<h6>Fecha de la cita: ".$persona[0]->fecha."</h6>";

        $consulta = "SELECT ficha_fisio.altura, ficha_fisio.peso, ficha_fisio.observaciones, ficha_fisio.motivo
        from ficha_fisio 
        where ficha_fisio.id_ficha= $idFicha";
        $ficha = $conexion->seleccionar($consulta);

        foreach($ficha as $fila)
        {
        echo "<div class='modal-body' style='margin-top:15px;'>";
           echo "<p>Altura: $fila->altura</p>";
        echo "<p>Peso: $fila->peso</p>";
      echo "<p>Motivo: $fila->motivo</p>";
        echo "<p>Observaciones: $fila->observaciones</p>";
        echo "</div>";
        }
        echo "</div>
        </div>";


      }
      else
      {
        echo "¡Esta cita no tiene una ficha médica!";
      }
      
      $conexion->desconectarBD();
      ?>
    </body>
</html>