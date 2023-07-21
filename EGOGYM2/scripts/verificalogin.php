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
        include '../class/database.php';
        $db = new Database();
        $db->conectarDB();
        extract($_POST);

        $db->verifica("$correo","$contraseña");
        $db->desconectarDB();
        ?>

    </div>
    
</body>
</html>