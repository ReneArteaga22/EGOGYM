<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <?php
       
            include 'database.php';
            $conexion = new Database();
            $conexion->conectarDB();
            
            extract($_POST);
            $hash = password_hash($contraseña, PASSWORD_DEFAULT);
            
            $cadena = "INSERT INTO persona(nombre, apellido_paterno, apellido_materno, correo, sexo, contraseña, telefono, fecha_nacimiento, tipo_usuario, foto)
                     values('$nombre','$ap_paterno','$ap_materno','$correo','$sexo', '$hash', null, '$fecha_nacimiento','cliente',default)";
            
           
                if ($conexion->ejecutar($cadena)) {
                    echo "<div class='alert alert-success'>Cliente Registrado</div>";
                header("refresh:2 ../index.php");
                }
              
                    
            $conexion->desconectarBD();
        
        ?>
    </div>

    
</body>
</html>