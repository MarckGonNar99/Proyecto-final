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
    <title>Mi perfil</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css"/>
    <script src="../app/app.js" defer></script>
</head>
<body>
<?php
    require('./funciones.php');
    $conexion=conexion();

    if(isset($_COOKIE['mantener'])){
        session_decode($_COOKIE['mantener']);
    }

    if(isset($_SESSION['id'])){
        if($_SESSION['id']!='01'){
            /* DATOS Y VARIABLES DE USUARIO */
            $r1=".";
            $e1="..";
            $e2=".";
            echo insert_cab($r1);
            echo insert_nav($e1,$e2);

            $id=$_SESSION["id"];
            $nombre=$_SESSION["nombre"];
            $imagen=obtener_foto($id);
            if($imagen==null){
                $imagen="../imagenes/usuarios/defecto.jpg";
            }

            /* DATOS DE USUARIO &&& MODIFICACION DE DATOS */
            //IMAGEN
            echo
                '
                    <header id="datos_user">
                        <img src="'.$imagen.'">
                        <h2>'.$nombre.'</h2>
                        <div>
                        <a href="'.$e2.'/editar_datos_user.php" class="btn btn-warning" role="button">Editar Datos</a>
                        </div>
                    </header>
                ';

            /* MIS RECETAS */
            echo '<main>';
                /* BOTON PARA CREAR RECETA NUEVA */
            echo'<a href="'.$r1.'/crear_receta.php" class="btn btn-success" role="button">Crear Receta</a>';
                
                /* RECETAS PROPIAS DEL USUARIO 
                    BOTON PARA ELIMINAR O EDITAR*/
            
            
            echo'</main>';
        }else{
            /* ADMIN NO TIENE PERFIL */
        }
    }else{
        /* NO PUEDES ENTRAR SI NO TIENES SESION */
    }
?>
</body>
</html>