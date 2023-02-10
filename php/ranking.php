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
    <title>Mi perfil</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css?2.8"/>
    <script src="../app/app.js?1.5" defer></script>
</head>
<body>
<?php
    require('./funciones.php');
    $conexion=conexion();

        /* TODOS LOS USUARIOS TIENEN ACCESO */
    if(isset($_COOKIE['mantener'])){
        session_decode($_COOKIE['mantener']);
    }

            /* DATOS Y VARIABLES DE USUARIO */
            $r1=".";
            $e1="..";
            $e2=".";
            $i="../";
            echo insert_cab($r1,$i);
            echo insert_nav($e1,$e2);

            $sentencia="select usuario.nombre, sum(receta.puntuacion) 
                from usuario, receta 
                where receta.id_user=usuario.id_user 
                GROUP BY usuario.nombre
                ORDER BY sum(receta.puntuacion) desc;";
            $consulta=$conexion->prepare($sentencia);
            $consulta->bind_result($nombre, $puntos_total);
            $consulta->execute();
            $consulta->store_result();
            $contador=1;

            echo"
                <main><table id='ranking'>
                    <thead>
                        <th>Puesto</th>
                        <th>Nombre</th>
                        <th>Puntos totales</th>
                    </thead>
                    <tbody>
            ";

            while($consulta->fetch()){
                if($contador==1){
                    echo"
                    <tr class='primero'>
                        <th>#".$contador."</th>
                        <td>".$nombre."</td>
                        <td>".$puntos_total."</td>
                    </tr>
                ";
                }elseif($contador==2){
                    echo"
                    <tr class='segundo'>
                        <th>#".$contador."</th>
                        <td>".$nombre."</td>
                        <td>".$puntos_total."</td>
                    </tr>
                ";
                }elseif($contador==3){
                    echo"
                    <tr class='tercero'>
                        <th>#".$contador."</th>
                        <td>".$nombre."</td>
                        <td>".$puntos_total."</td>
                    </tr>
                ";
                }else{
                    echo"
                    <tr>
                        <th>#".$contador."</th>
                        <td>".$nombre."</td>
                        <td>".$puntos_total."</td>
                    </tr>
                ";
                }
                $contador++;
            }
            echo"</table></main>";
            echo insert_footer();

?>
</body>
</html>