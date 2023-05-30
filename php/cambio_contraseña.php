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
    <title>Cambio de Contraseña</title>
    <link rel="stylesheet" type="text/css" href="../estilos/estilos.css?3.0">
    <script text="text/JavaScript" src="../app/app.js?2.5" defer></script>
</head>
<body>
<?php
     require('funciones.php');
     if(isset($_COOKIE['mantener'])){
        session_decode($_COOKIE['mantener']);
    }
     /* Comprobar sesion abierta */
     if(isset($_SESSION["id"])){
        $conexion=conexion();
        $r1=".";
        $e1="..";
        $e2=".";
        $id_user=$_SESSION["id"];
        $i="../";
        echo insert_cab($r1,$i);
        echo insert_nav($e1,$e2);
        /* FORMULARIO DE SESION */
        echo '
            <main class="formulario" id="sesion_inicio">
                <form method="post" action="#" >
                    <div class="mb-3">
                        <label for="contraseña"  class="form-label">Nueva contraseña</label>
                        <input type="password" name="pass" class="form-control" id="contraseña">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="ver">
                        <label class="form-check-label" for="ver">Ver Contraseña</label>
                    </div>
                    <button type="submit" name="cambiar" class="btn btn-primary">Cambiar</button>
                    <a href="'.$e2.'/mi_perfil.php" class="btn btn-danger" role="button">Volver</a>
                </form>
            </main>
            ';


        /* PROCESO */
        if(isset($_POST['cambiar'])){
            $pass=$_POST['pass'];
            $pass=md5($pass);

            $sentencia="update usuario set contraseña=? where id_user=?";
            $consulta=$conexion->prepare($sentencia);
            $consulta->bind_param("si",$pass,$id_user);
            $consulta->execute();
            $consulta->fetch();
            $consulta->close();
            echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:mi_perfil.php">';
        }
     }else{
        /* ERROR */
     }
    ?>
    <script>
        /* MANEJO DE PAGINAS JS */
        var pagina="<?php echo"contraseña";?>";
    </script>
</body>
</html>