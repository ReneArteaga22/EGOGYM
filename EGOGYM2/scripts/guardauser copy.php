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
      
        
      
 
         //DATE: YYYY-MM-DD
        
        //2021-10-08
        $cadena= "INSERT INTO persona(id_persona,nombre, apellido_paterno, apellido_materno,telefono, correo,fecha_nacimiento,sexo,contraseña,tipo_usuario,foto)
         values('','$nombre','$ap_paterno','$ap_materno',null,'$correo','$fecha_nacimiento','$sexo','$hash','cliente',default)";
         $conexion->ejecutarSQL($cadena);


         echo"<div class='alert alert-success'>Cliente Registrado</>";
        header("refresh:2 ../First.php");
        $conexion->desconectarBD();


        ?>

    </div>

    
</body>
</html>