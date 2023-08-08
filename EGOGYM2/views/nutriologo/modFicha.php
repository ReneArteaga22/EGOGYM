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
    <?php
    include '../../scripts/database.php';
    $conexion = new Database();
    $conexion->conectarDB();

    session_start();
    $email = $_SESSION["correo"];
    $consulta = "SELECT tipo_empleado from persona inner join empleado on persona.id_persona = empleado.id_empleado
        where correo ='$email'";
    $datos = $conexion -> seleccionar($consulta);

        foreach ($datos as $dato)
        {
          $tipo = $dato->tipo_empleado;
        }

    if(isset($email) and $tipo == 'nutri' )
    {
      
    }
    else 
    {
        header("Location:../../index.php");
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

                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                         <?php echo "Hola".'  '.$_SESSION["correo"]; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="../../scripts/cerrarsesion.php">Cerrar Sesion</a></li>
                        </ul>
                      </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="padding-top: 5%;">

    
    <?php
      $conexion = new Database();
      $conexion->conectarDB();

      $idFicha = $_GET['id'];
      $consulta="SELECT concat(nombre,' ',apellido_paterno,' ',apellido_materno) as nombre, citas.fecha, 
      FLOOR(DATEDIFF(CURDATE(), fecha_nacimiento) / 365) AS edad FROM persona INNER JOIN cliente on cliente.id_cliente=persona.id_persona
      INNER JOIN citas on citas.cliente=cliente.id_cliente INNER JOIN ficha_nutri 
      ON ficha_nutri.cita=citas.id_cita WHERE ficha_nutri.id_ficha=$idFicha";
      $parametros = array(':id'=> $idFicha);
      $persona =$conexion->seleccionar($consulta, $parametros);

      if($persona)
      {

        echo "<div class='container' style='padding-top:5%;padding-bottom:5%'>
        <div class='container text-center'><h3>Ficha médica</<h3></div>
        <div class='card-header' style='color:grey; float: right'><h5> Fecha: ".$persona[0]->fecha."</h5></div>
         <div class='card-header'><h5>Cliente: ".$persona[0]->nombre."</h5></div>";
        
        echo"<div class='card' style='padding-bottom:2%'>";
      
        $consulta = "SELECT ficha_nutri.objetivo, ficha_nutri.motivo, ficha_nutri.peso,
        ficha_nutri.altura, ficha_nutri.med_cintura, ficha_nutri.med_cadera, ficha_nutri.med_cuello,
        ficha_nutri.porc_grasa_corporal, ficha_nutri.masa_corp_magra, ficha_nutri.observaciones, ficha_nutri.id_ficha
        from ficha_nutri 
        where ficha_nutri.id_ficha= $idFicha";
        $ficha = $conexion->seleccionar($consulta);

        foreach($ficha as $fila)
        {
        echo "<form action='../../scripts/guardaFichaNutri.php' method='post'>";
        echo "<div class='row'>";
        
        echo "<div class='col-lg-6 col-6'>";
        echo "<div class='modal-body' style='padding: 3%'>";
        echo "<input type='hidden' name='idFicha' value='$idFicha'>";
        echo "<h6 style='font-weight:bold;color:black; opacity:0.7;'>Datos del paciente</h6><br>"; 
        echo "<p>Edad: ".$persona[0]->edad." años</p>";  
        echo "<p>Altura:</p>"." <input type='text' name='altura' style='border-radius:4%;padding:3px; border: none; width:20%;background-color:lightgrey' value='$fila->altura'></input>";
        echo "<p>Peso: </p>"." <input type='text' name='peso' style='border-radius:4%;padding:3px; border: none; width:20%;background-color:lightgrey' value='$fila->peso'></input>";
        echo "<p>Cintura: </p>"." <input type='text' name='cintura' style='border-radius:4%;padding:3px; border: none; width:20%;background-color:lightgrey' value='$fila->med_cintura'></input>";
        echo "<p>Cadera: </p>"." <input type='text' name='cadera' style='border-radius:4%;padding:3px; border: none; width:20%;background-color:lightgrey' value='$fila->med_cadera'></input>";
        echo "<p>Cuello: </p>"." <input type='text' name='cuello' style='border-radius:4%;padding:3px; border: none; width:20%;background-color:lightgrey' value='$fila->med_cuello'></input>";
        echo "</div>";
        echo "</div>";

        echo "<div class='col-lg-6 col-6'>";
        echo "<div class='modal-body' style='padding: 3%'>";
        echo "<h6 style='font-weight:bold;color:black; opacity:0.7;'>Detalles de la cita: </h6><br>"; 
        echo "<p>Grasa Corporal: </p>"." <input type='text' name='grasa' style='border-radius:4%;padding:3px; border: none; width:20%;background-color:lightgrey' value='$fila->porc_grasa_corporal'></input>";
        echo "<p>Masa Corporal Magra: </p>"." <input type='text' name='masa' style='border-radius:4%;padding:3px; border: none; width:20%;background-color:lightgrey' value='$fila->masa_corp_magra'></input>";
        echo "<p>Objetivo:</p>"." <input type='text' name='objetivo' style='border-radius:4%;padding:3px; border: none; width:20%;background-color:lightgrey' value='$fila->objetivo'> kg</input>";
        echo "<p>Motivo: </p>"." <textarea name='motivo' style='border-radius:4%;padding:3px; width:50%; border: none;background-color:lightgrey' value='$fila->motivo' placeholder='$fila->motivo'></textarea>";
        echo "<p>Observaciones: </p>"." <textarea name='observaciones' style='border-radius:4%;padding:3px; width:50%; border: none;background-color:lightgrey' value='$fila->observaciones' placeholder='$fila->observaciones'></textarea>";
        echo "</div>";
        echo "</div>";

        echo "</div>";
        }
        echo "
        <div class='container text-center'>
        <button type='reset' value='Limpiar' class='btn btn-secondary'>Borrar cambios</button>
        <button type='submit'name='guardar' class='btn btn-warning' style='margin-left:50px'>Guardar cambios</button>
        </div>

        </div>
        </div>";

        echo "
        </div>
        </div>
        </form>";

      }
      else
      {
        echo "¡Esta cita no tiene una ficha médica!";
      }
      
      $conexion->desconectarBD();
      ?>
        
    
   
    </div>
     
    </body>
</html>