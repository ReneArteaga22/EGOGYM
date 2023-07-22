<?php
class Database 
{
    private $PDOLocal;
    private $user = "root";
    private $password = "";
    private $server = "mysql:host=127.0.0.1:3307; dbname=egogym2";

    function conectarDB()
    {
        try
        {
            $this->PDOLocal = new PDO($this->server, $this->user, $this->password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage(); 
        }
    }

    function desconectarBD()
    {
        try
        {
            $this->PDOLocal = null;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage(); 
        }
    }

    function seleccionar($consulta)
    {
        try
        {
            $resultado = $this->PDOLocal->query($consulta);
            $fila = $resultado->fetchAll(PDO::FETCH_OBJ);
            return $fila;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    function ejecutarSQL($cadena)
    {
        try
        {
            $this->PDOLocal->query($cadena);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


    function verifica($email,$contraseña)
    {
        try 
        {
        $pase = false;
        $query = "SELECT * from persona where correo ='$email'";
        $consulta=$this->PDOLocal->query($query);
       

        while($renglon=$consulta->fetch(PDO::FETCH_ASSOC))
        {
            if(password_verify($contraseña,$renglon['contraseña']))
            {
                $pase=true;
                $tipo = $renglon['tipo_usuario'];
            }
        }
        if($pase)
        {
            session_start();
            $_SESSION["correo"]=$email;

            if  ($tipo == 'cliente')
            {
                header("location: ../views/clientes/Primera.php");
            }
            else
            {
                $consulta1 = "select tipo_empleado from empleado
                inner join persona on empleado.id_empleado = persona.id_persona
                where persona.correo = '$email'";
                $resu = $this->PDOLocal->query($consulta1);
                    $fila = $resu->fetch(PDO::FETCH_ASSOC);

                if($fila['tipo_empleado'] == 'recepcionista')
                {
                    header("Location: ../views/recepcionista/principal.php");
                }
                else
                {
                    echo "NO SE PUDO ACCEDER";  
                }
            }
            
        
        }
        else
        {
            echo "<div class='alert alert-danger'>";
            echo "<h2 align='center'>Usuario o password incorrecto ...</h2>";
            echo"</div";
           
        
           
            header("refresh:2 ../First.php#membershipForm");
        }
        
        } 
       
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
           
    }
    function cerrarSesion()
    {
        session_start();
        session_destroy();
        header("Location: ../First.php");
    }


}
?>