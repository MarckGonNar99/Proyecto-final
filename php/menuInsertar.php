<?php
require('./funciones.php');
    $conexion=conexion();

    /* DATOS DEL FORMULARIO */

    $user= $_REQUEST['user'];  
    $lunes= $_REQUEST['lunes'];
    $martes= $_REQUEST['martes'];
    $miercoles= $_REQUEST['miercoles'];
    $jueves= $_REQUEST['jueves'];
    $viernes= $_REQUEST['viernes'];
    $sabado= $_REQUEST['sabado'];
    $domingo= $_REQUEST['domingo'];
    $fecha= $_REQUEST['fecha'];


    
    $sentencia=$conexion->prepare("INSERT INTO menu values ?,?,?,?,?,?,?,?,?");
    $consulta=$conexion->prepare($sentencia);
    $consulta->bind_param("iiiiiiiis",$user,$lunes,$martes,$miercoles,$jueves
        ,$viernes,$sabado,$domingo,$fecha);
    $consulta->execute();
    $consulta->fetch();
    $consulta->close();
    $conexion->close();

?>