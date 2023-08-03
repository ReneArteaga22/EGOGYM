<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Inicio</title>
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
    <body data-spy="scroll" data-target="#navbarNav" data-offset="50">
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="../recepcionista/principal.php">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a href="../recepcionista/principal.php" class="nav-link smoothScroll">Inicio</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" > Citas</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="citas.php">Agendar Cita</a></li>
                          <li><a class="dropdown-item" href="vercitas.php">Ver Citas</a></li>
                        </ul>
                      </li>

                    <li class="nav-item">
                        <a href="usuarios.php" class="nav-link smoothScroll">Usuarios</a>
                    </li>

                    <li class="nav-item">
                        <a href="registrarusu.php" class="nav-link smoothScroll">Registrar Nuevo Usuario</a>
                    </li>
                    
                </ul>

                <ul class="navbar-nav ml-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false" >
                         Hola Recepcionista
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="../../scripts/cerrarsesion.php">Cerrar Sesion</a></li>
                        </ul>
                      </li>
                </ul>
            </div>
        </div>
    </nav>


    <!--Pills para buscar por clientes, empleados, nuevos usuarios-->
    <!--Pills para todos los usuarios-->
  <div class="container" style="padding-top: 15%;">
  <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#clientes">Clientes</a></li>
  <li><a data-toggle="tab" href="#empleados" style="margin-left: 10px;">Empleados</a></li>
  <li><a data-toggle="tab" href="#usuarios" style="margin-left: 10px;">Nuevos usuarios</a></li>
</ul>
     <div class="container">
     <div class="tab-content">
  <div id="clientes" class="tab-pane fade in active">
  <?php
        include '../../scripts/database.php';
        $conexion = new database();
        $conexion->conectarDB();

        $consulta = "SELECT concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) as nombre,
        persona.tipo_usuario as tipo,persona.telefono as contacto, persona.id_persona 
        from persona 
        inner join cliente on
        cliente.id_cliente=persona.id_persona;";
         $conexion->seleccionar($consulta);
         $tabla = $conexion->seleccionar($consulta);

         echo 
         "
         <table class='table' style='border-radius: 5px;'>
         <thead class='table-dark'>
             <tr>
             <br>
                 <th style='color: goldenrod;'>
                Nombre
                 </th>
                 <th style='color: goldenrod;'>
                 Tipo de usuario
                 </th>
                 <th style='color: goldenrod;'>
                 Contacto
                 </th>
                 <th style='color: goldenrod;'>
                 Estatus de membresía
                 </th>
                 <th>
                    </th>
                 
             </tr>
         </thead>
         <tbody>";
         foreach ($tabla as $registro)
         {
             echo "<tr>";
             echo "<td><a href='perfilCliente.php?id=" . $registro->id_persona . "'>" . $registro->nombre . "</a></td>";
             echo "<td> $registro->tipo</td> ";
             echo "<td> $registro->contacto</td> ";
         }
         echo "</tbody>
         </table>";

        ?> 
  </div>
  <div id="empleados" class="tab-pane fade">
  <?php
            $conexion = new database();
            $conexion->conectarDB();
        
            $consulta = "SELECT concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) as nombre_emp, 
            persona.tipo_usuario as tipo_us, persona.telefono as contacto_emp, persona.id_persona
            from persona 
            inner join empleado on
            empleado.id_empleado=persona.id_persona";
            $conexion->seleccionar($consulta);
            $tabla = $conexion->seleccionar($consulta);
        
            echo 
            "
            <table class='table' style='border-radius: 5px;'>
            <thead class='table-dark'>
                <tr>
                <br>
                    <th style='color: goldenrod;'>
                    Nombre del usuario
                    </th>
                    <th style='color: goldenrod;'>
                    Tipo de usuario
                    </th>
                    <th style='color: goldenrod;'>
                    Contacto
                    </th>
                    <th>
                    </th>
                    
                </tr>
            </thead>
            <tbody>";
            foreach ($tabla as $registro)
            {
                echo "<tr>";
                echo "<td><a href='perfilEmpleado.php?id=" . $registro->id_persona . "'>" . $registro->nombre_emp . "</a></td>";
                echo "<td> $registro->tipo_us</td> ";
                echo "<td> $registro->contacto_emp</td> ";
            }
            echo "</tbody>
            </table>";
            ?> 
        </div>

        <div id="usuarios" class="tab-pane fade">
        <?php
            $conexion = new database();
            $conexion->conectarDB();
        
            $consulta = "SELECT concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) as nombre, persona.telefono as contacto, persona.tipo_usuario as tipo, persona.id_persona 
            from persona where persona.tipo_usuario IS NULL;";
            $conexion->seleccionar($consulta);
            $tabla = $conexion->seleccionar($consulta);
        
            echo 
            "
            <table class='table' style='border-radius: 5px;'>
            <thead class='table-dark'>
                <tr>
                <br>
                    <th style='color: goldenrod;'>
                    Nombre
                    </th>
                    <th style='color: goldenrod;'>
                    Contacto
                    </th>
                    <th style='color: goldenrod;'>
                    Tipo de usuario
                    </th>
                    <th>
                    </th>
                    
                </tr>
            </thead>
            <tbody>";
            foreach ($tabla as $registro)
            {
                
                echo "<tr>";
                echo "<td><a href='perfilNuevo.php?id=" . $registro->id_persona . "'>" . $registro->nombre . "</a></td>";
                echo "<td>$registro->contacto</td> ";
                echo "<td> $registro->tipo</td> ";
            }
            echo "</tbody>
            </table>";
            $conexion->desconectarBD();
            ?> 
        </div>
     </div>
  </div>

    </body>
</html>