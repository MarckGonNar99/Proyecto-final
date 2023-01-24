<?php
require('./funciones.php');
    $conexion=conexion();

    sleep(1);
    
    $datos=[];
    $sentencia=$conexion->prepare("SELECT nombre FROM receta ORDER BY rand() LIMIT 7");        
    $sentencia->execute();
    $resultado=$sentencia->get_result();
       
    while($fila=$resultado->fetch_assoc()){ 
      	$datos[]=$fila;
    }
    
    echo json_encode($datos);
?>