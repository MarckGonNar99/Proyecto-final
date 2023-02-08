<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" type="text/css" href="../estilos/estilos.css?3.5">
    <script text="text/JavaScript" src="../app/app.js?3.0" defer></script>
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
                <p>No tiene acceso a esta zona</p>   
            </div>
        ";
        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:../index.php">';
     }else{
        $conexion=conexion();
        $r1=".";
        $e1="..";
        $e2=".";
        echo insert_cab($r1);
        echo insert_nav($e1,$e2);
        $error=0;
        /* FORMULARIO DE SESION */
        echo '
            <main class="formulario" id="sesion_inicio">
                <form method="post" action="#">
                    <div class="mb-3">
                    <label for="exampleInputEmail1"  class="form-label">Nombre de Usuario</label>
                    <input type="text" name="nombre" class="form-control">
                    </div>
                    <div class="mb-3">
                    <label for="pass"  class="form-label">Contraseña</label>
                    <input type="password" name="pass" class="form-control" id="pass">
                    </div>
                    <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Recordar</label>
                    </div>
                    <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
                </form>
            ';
        /* ENLACE A REGISTRO */
        echo'<p>Si no tiene cuenta<br>
                <a href="registro_user.php">Registrarse</a>
            </p>';

        echo"</main>";
        /* PROCESO */
        if(isset($_POST['enviar'])){
            $nombre=$_POST['nombre'];
            $pass=$_POST['pass'];
            $pass=md5($pass);
            
            $verificar=iniciar_sesion($nombre,$pass);
            if($verificar>=1){
                $sentencia="select id_user, nombre from usuario where nombre=? and contraseña=?";
                $consulta=$conexion->prepare($sentencia);
                $consulta->bind_param("ss",$nombre,$pass);
                $consulta->bind_result($id,$nombre);
                $consulta->execute();
                $consulta->store_result();
                $consulta->fetch();
                $consulta->close();

                $_SESSION['id']=$id;
                $_SESSION['nombre']=$nombre;

                if(isset($_POST['sesion']) && $_POST['sesion']=='1'){
                      $datos=session_encode();
                      setcookie('mantener',$datos,time()+365*60*60*2,'/');
                }
                
                echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:../index.php">';
            }else{
                $error=1;
            }
        }
     }
    ?>
    <script>
        /* MANEJO DE PAGINAS JS */
        var pagina="<?php echo"iniciar_sesion";?>";
        var error="<?php echo $error;?>";
    </script>
</body>
</html>