<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../imagenes/otro/logo.png">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="../estilos/estilos.css?6.5">
    <script text="text/JavaScript" src="../app/app.js?6.0" defer></script>
</head>
<body>
<?php
     require('funciones.php');
     if(isset($_COOKIE['mantener'])){
        session_decode($_COOKIE['mantener']);
    }
     /* Comprobar sesion abierta */
     if(isset($_SESSION["id"])){
        echo"
            <div id='error'>
               <img src='../imagenes/otro/error.png'>
                <p>Usted ya está registrado</p>   
            </div>
            ";
            echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:../index.php">';
     }else{
        $conexion=conexion();
        $r1=".";
        $e1="..";
        $e2=".";
        $i="../";
        echo insert_cab($r1,$i);
        echo insert_nav($e1,$e2);
        $error=0;
        /* FORMULARIO DE SESION */
        echo '
            <main class="formulario" id="registro">
                <form method="post" action="#">
                    <div class="mb-3">
                    <label for="nombre"  class="form-label">Nombre de Usuario</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                    <label for="contraseña"  class="form-label">Contraseña</label>
                    <input type="password" name="pass" class="form-control" id="pass">
                    </div>
                    <button type="submit" name="registro" class="btn btn-primary">Crear</button>
                    <a href="'.$e2.'/iniciar_sesion.php" class="btn btn-danger" role="button">Volver</a>
                </form>
            </main>
            ';


        /* PROCESO */
        if(isset($_POST['registro'])){
            $nombre=$_POST['nombre'];
            $pass=$_POST['pass'];
            $pass=md5($pass);

            $verificar=registro($nombre);
            if($verificar==0){
                $sentencia="insert into usuario (nombre,contraseña) values (?,?) ";
                $consulta=$conexion->prepare($sentencia);
                $consulta->bind_param("ss",$nombre,$pass);
                $consulta->execute();
                $consulta->fetch();
                $consulta->close();

                echo"<h3 class='mensaje'>USUARIO REGISTRADO</h3>";
                echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:iniciar_sesion.php">';
            }else{
                $error=1;
            }
        }
    }
    ?>
    <script>
        /* MANEJO DE PAGINAS JS */
        var pagina="<?php echo"registro";?>";
        var error="<?php echo $error;?>";
    </script>
</body>
</html>