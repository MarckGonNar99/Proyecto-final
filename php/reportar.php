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
    <link rel="icon" type="image/x-icon" href="../imagenes/otro/logo.png">
    <title>Reporte</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css?1.5"/>
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
        if($_SESSION['id']!='01'){
            $r1=".";
            $e1="..";
            $e2=".";
            $i="../";
            echo insert_cab($r1,$i);
            echo insert_nav($e1,$e2);

            $select_id = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'web_cocina' AND   TABLE_NAME = 'reporte';";
            $consulta=$conexion->query($select_id);
            $fila=$consulta->fetch_array(MYSQLI_ASSOC);

            echo"
            <main>
                <form method='post' action='#' id='reporte' class='formulario'>
                    <input type='hidden' value=".$fila['AUTO_INCREMENT']." name='id_reporte' readonly>
                    <label for='motivo'>Motivo de Reporte</label>
                    <textarea id='motivo' name='reporte' class='form-control'  required></textarea>
                    <input type='submit' name='enviar' value='Reportar'>
                    <a href='".$e2."/mi_perfil.php' class='btn btn-danger' role='button'>Cancelar</a>
                </form>
                
            </main>
            ";

            if(isset($_POST["enviar"])){
                $id_user=$_SESSION["id"];
                $id_receta=$_GET["id_receta"];
                $id_reporte=$_POST["id_reporte"];
                $motivo=$_POST["reporte"];
                $fecha=date("Y-m-d");

                $sentencia="insert into reporte values(?,?,?,?,?)";
                $consulta=$conexion->prepare($sentencia);
                $consulta->bind_param("iiiss",$id_reporte,$id_user,$id_receta,$fecha
                    ,$motivo);
                $consulta->execute();
                $consulta->fetch();
                $consulta->close();
                echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./recetas.php">';
            }
            if(isset($_POST["cancelar"])){
                echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./recetas.php">';
            }
        }else{
            echo"
                <div id='error'>
                <img src='../imagenes/otro/error.png'>
                    <p>Admin no reporta</p>   
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
    ?>
</body>