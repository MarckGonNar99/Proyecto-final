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
    <link rel="icon" type="image/x-icon" href="../imagenes/otro/logo_sitio.png">
    <title>Reporte</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css?1.6"/>
    <script src="../app/app_menu.js?1.1" defer></script>
    <script type="text/javascript" src="../app/jquery.min.js"></script>
</head>
<body>
    <?php

    require('./funciones.php');
    $conexion=conexion();

    if(isset($_COOKIE['mantener'])){
        session_decode($_COOKIE['mantener']);
    }

    if(isset($_SESSION['id'])){
        if($_SESSION['id']=='01'){

            $id_user=$_SESSION['id'];
            $r1=".";
            $e1="..";
            $e2=".";
            $i="../";
            echo insert_cab($r1,$i);
            echo insert_nav($e1,$e2);

            $sentencia="select reporte.id_reporte, usuario.nombre, receta.nombre, reporte.fecha, reporte.motivo, reporte.id_receta
            from usuario, receta, reporte
            where usuario.id_user=reporte.id_user and receta.id_receta=reporte.id_receta;";
            $consulta=$conexion->prepare($sentencia);
            $consulta->bind_result($id_reporte,$nombre_user,$nombre_receta,$fecha,$motivo,$id_receta);
            $consulta->execute();
            $consulta->store_result();

            echo"
                <main>
                    <table id='tabla_reporte' class='table table-dark  table-striped-columns'>
                    <thead>
                        <tr>
                            <td>Nombre usuario</td>
                            <td>Nombre de receta</td>
                            <td>Fecha de denuncia</td>
                            <td>Motivo</td>
                            <td>Ver Receta</td>
                            <td>Borrar Reporte</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>"
            ;

            while($consulta->fetch()){
                echo"
                    <td>".$nombre_user."</td>
                    <td>".$nombre_receta."</td>
                    <td>".$fecha."</td>
                    <td>".$motivo."</td>
                    <td><a href=".$e2."/ver_receta.php?id_receta=".$id_receta.">Ver Receta</a></td>
                    <td>
                        <form method='post' action='#'>
                            <input type='hidden' name='id_borrar' value=".$id_reporte." readonly>
                            <input type='submit' name='borrar' class=' btn btn-danger' value='Borrar'>
                        </form>
                    </td>
                    </tr>
                ";
            }
            echo"
            </tbody></table>";
            $consulta->close();

            if(isset($_POST["borrar"])){
                $id_borrar=$_POST["id_borrar"];
                $sentencia="delete from reporte where id_reporte=?";
            $consulta=$conexion->prepare($sentencia); 
                $consulta->bind_param("i",$id_borrar);
                $consulta->execute();
                $consulta->fetch();
                $consulta->close();
            }
        }else{
            echo"
            <div id='error'>
               <img src='../imagenes/otro/error.png'>
                <p>No tiene acceso a esta zona</p>   
            </div>
            ";
            echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:../index.php">';
        }
    }else{
        echo"
            <div id='error'>
               <img src='../imagenes/otro/error.png'>
                <p>No tiene acceso a esta zona</p>   
            </div>
        ";
        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:../index.php">';
    }