<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Ver Clientes</title>
</head>
<body>
    <div class="container">
        <h1 align="center">Clientes</h1>


        <?php

        include '../class/database.php';
            $conexion = new Database();
        $conexion->conectarDB();

        $consulta = "SELECT id_persona, nombre from persona where tipo_usuario=1";
        $tabla= $conexion-> seleccionar($consulta);
  
        echo "<table class='table table-hover'>
        <thead class='table-dark'>
        <tr>
      
        <th>Usuario</th>
        </tr>
        </thead>
        <tbody>";
        foreach($tabla as $registro)
        {
          echo "<tr>";
          echo "<td><a href='perfiluser.php?id=" . $registro->id_persona . "'>" . $registro->nombre . "</a></td>";
        
         
          echo "</tr>";
        }
        echo "</tbody>";
        "</table>";

        $conexion->desconectarDB();

        ?>


    </div>
</body>
</html>