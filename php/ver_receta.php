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
    <title>Recetas</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css?1.1"/>
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
            /* DATOS Y VARIABLES DE USUARIO
            E ID DE LA RECETA QUE SE VERÁ EN LA PÁGINA*/
            $id=$_SESSION["id"];
            $nombre=$_SESSION["nombre"];

            $id_receta=$_GET["id_receta"];

            $r1=".";
            $e1="..";
            $e2=".";
            echo insert_cab($r1);
            echo insert_nav($e1,$e2);


            /* SACAR LOS DATOS DE LA RECETA */
            
            $sentencia="select id_user, nombre, imagen, tiempo, num_personas,
                categoria, ingredientes, alergenos, pasos, fecha from receta where id_receta=?";
            $consulta=$conexion->prepare($sentencia);
            $consulta->bind_param("i",$id_receta);
            $consulta->bind_result($id_user, $nombre, $imagen, $tiempo, $n_personas, 
                $categoria, $ingredientes, $alergenos, $pasos, $fecha);
            $consulta->execute();
            $consulta->store_result();
            $consulta->fetch();
            echo $ingredientes;


            /* SI LA RECETA ES PROPIA AÑADIR BOTÓNES
                ELIMINAR EDITAR */
            
            if($id==$id_user){
                echo'<a href="'.$e2.'/editar_datos_receta.php?id_receta='.$id_receta.'&id_user='.$id_user.'" class="btn btn-warning" role="button">Editar Datos</a>';

                echo"
                    <form method='post' action='#'>
                        <input type='hidden' name='id_eliminar' value=".$id_receta.">
                        <button type='submit' name='borrar' class='btn btn-danger'>Borrar</button>
                    </form>
                ";
                if(isset($_POST["borrar"])){
                    $sentencia="delete from receta where id_receta=? ";
                    $consulta=$conexion->prepare($sentencia); 
                    $consulta->bind_param("i",$id_receta);
                    echo"<h2 class='mensaje'>Receta borrada</h2>";
                    $consulta->execute();
                    $consulta->fetch();
                    $consulta->close();
                }
            }

            /* SI LA RECETA NO ES DEL USUARIO-ADMIN SE PUEDE VOTAR Y REPORTAR*/

        }
    }
    ?>
</body>