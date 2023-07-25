<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php
        include 'database.php';
        $db = new Database();
        $db->conectarDB();
        extract($_POST);

    
        $db->verifica("$email","$contraseña");
        $db->desconectarBD();
        ?>

    </div>
    
</body>
</html>