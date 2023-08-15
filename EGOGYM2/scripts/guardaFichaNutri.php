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
    <div class="container">
        <?php
         include '../scripts/database.php';
         $conexion = new Database();
         $conexion->conectarDB();
        
         
         extract($_POST);
         $idFicha = $_POST['idFicha'];

         $cadena ="UPDATE ficha_nutri set peso=$peso, altura=$altura, med_cintura=$cintura,
          med_cadera=$cadera, med_cuello=$cuello, porc_grasa_corporal=$grasa, masa_corp_magra=$masa,
          objetivo='$objetivo', observaciones='$observaciones', motivo='$motivo'
           WHERE ficha_nutri.id_ficha=$idFicha";
        $parametros = array(':idFicha' => $idFicha);


        $conexion->ejecutarSQL($cadena, $parametros);
        header("refresh:2  ../views/nutriologo/citas_nutri.php");

        $conexion->desconectarBD();

 
        ?>
    </div>
    </body>
</html>