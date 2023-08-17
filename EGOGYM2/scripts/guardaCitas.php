<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Registrar</title>
      <!-- SCRIPTS -->
      <script src="../js/jquery.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/aos.js"></script>
      <script src="../js/smoothscroll.js"></script>
      <script src="../js/custom.js"></script>

     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="../css/font-awesome.min.css">
     <link rel="stylesheet" href="../css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../css/egogym.css">
    </head>
    <body>
    <body>
    <div class="container">
    <?php
        include 'database.php';
        $db= new database();
        $db->conectarDB();


        extract($_POST);
        $consulta= " SELECT persona.id_persona as cliente_id
        from persona 
        inner join cliente on
        cliente.id_cliente=persona.id_persona where 
        concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) like '%$cliente%'
        AND persona.id_persona IN(select cliente.id_cliente from cliente )";
        $db->seleccionar($consulta);
        $tabla = $db->seleccionar($consulta);
        
        $tabla = $db->seleccionar($consulta);
        foreach($tabla as $registro)
        {
            $cliente_id = $registro->cliente_id;
        }

        

        $cadena = "call restriccion_citas_3($servicio, $cliente_id,'$fecha_cita','$hora')";

        $resultado = $db->ejecutarSQL($cadena);
        echo "$resultado";

        $db->desconectarBD();
        header("refresh:10; ../views/recepcionista/citas.php");
        
        
        ?>
    </div>
</body>
    </body>
</html>