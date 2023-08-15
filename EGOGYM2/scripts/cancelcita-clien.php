<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include 'database.php';
    $db = new Database;
    $db ->conectarDB();

    extract($_POST);
    $cita= $_GET['idcita'];
    $cadena= "update citas set estado = 'cancelada' where id_cita = $cita";
    $db->ejecutarSQL($cadena);
    
        header('refresh:2 ../views/clientes/vercitas.php');

    ?>
</body>
</html>