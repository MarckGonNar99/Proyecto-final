<?php
    session_start();
?>
<!-- CONTROL DE SESIONES -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css?3.0" rel="stylesheet">
    <script text="text/JavaScript" src="app/app.js?1.9"defer></script>
    
    <!-- CONEXION CON LA APP -->
</head>
<body>
    <?php
     require('./php/funciones.php');
     $conexion=conexion();
     if(isset($_COOKIE['mantener'])){
          session_decode($_COOKIE['mantener']);
     }
    /* POLITICA DE COOKIES IMPORTANTE */
    /* TITULO DE LA PAGINA E INICIO DE SESION */
    $e1="#";
    $e2="./php";
    $r1="./php";
    echo insert_cab($r1);
    /* NAVEGADOR DEL SITIO */
    echo insert_nav($e1,$e2);
    /* Seccion de informacion del sitio web */
    echo'<main>';
    echo insert_cookies();

        /* ULTIMAS 3 RECETAS */
        $ultiRecetas="SELECT u.nombre, r.id_receta, r.nombre, r.imagen, r.categoria,
        r.fecha, r.puntuacion FROM receta r, usuario u
        where r.id_user=u.id_user
        ORDER BY fecha DESC LIMIT 0,3;";
        $consulta=$conexion->prepare($ultiRecetas);
        $consulta->bind_result($nombre_user,$id_receta,$nombre_receta, $imagen, $categoria,
        $fecha, $puntuacion);
        $consulta->execute();
        $consulta->store_result();

    /* Seccion de los ultimos platos subidos a la plataforma */
    echo '<div class="recetas_index">
        <h3>Últimas recetas</h3>
            <div class="contenedor">
            ';
        
    while($consulta->fetch()){
        echo'
        
            <div class="tarjeta_receta">
                <h6>'.$categoria.'</h6>
                <img src="'.$imagen.'" class="card-img-top" alt="...">
                <div class="cuerpo_t">
                    <h5>'.$nombre_receta.'</h5>
                </div>
                <div class="data_t">
                        <p>'.$fecha.'</p>
                        <small>'.$puntuacion.' ptos</small></p>
                </div>
                <a href=php/ver_receta.php?id_receta='.$id_receta.'>Ver más</a>
                <h6>Subido por: '.$nombre_user.'</h6>
            </div>
        ';
       }
       $consulta->close();

       echo' </div> </div>';
       /* SOBRE EL CREADOR */
       echo'
        <div id="informacion">
            <h6>Porque usar DunCocina</h6>
            <p>
                Este sitio web ha sido creado con el proposito de ayudar a las 
                personas más desorganizadas a crearse menus semanales para 
                mejorar la dieta y sobretodo, abrirse al mundo culinario.<br>
            
                Es también us sitio donde hay una pequeña competencia por ver
                quien se queda en el podio de recetas más puntuadas, las cuales
                también sirven para hacer un menu. Todo esto es solo una pequeña
                ayuda para que se suba más contenido y nuestro equipo de administradores
                siempre está atento a los reportes y avisos de los usuarios para tomar
                cartas en caso de que halla algo que no sea correcto</p>
        </div>
       ';


       
        /* 3 RECETAS MAS PUNTUADAS*/
        $recetasTop="SELECT u.nombre, r.id_receta, r.nombre, r.imagen, r.categoria, r.fecha, r.puntuacion
        FROM receta r, usuario u where r.id_user=u.id_user
        ORDER BY r.puntuacion DESC LIMIT 0,3;";
        $consulta=$conexion->prepare($recetasTop);
        $consulta->bind_result($nombre_user,$id_receta,$nombre_receta, $imagen, $categoria,
        $fecha, $puntuacion);
        $consulta->execute();
        $consulta->store_result();

        echo '<div class="recetas_index">
        <h3>Recetas Top</h3>
            <div class="contenedor">
            ';
        
    while($consulta->fetch()){
        echo'
        
            <div class="tarjeta_receta">
                <h6>'.$categoria.'</h6>
                <img src="'.$imagen.'" class="card-img-top" alt="...">
                <div class="cuerpo_t">
                    <h5>'.$nombre_receta.'</h5>
                </div>
                <div class="data_t">
                        <p>'.$fecha.'</p>
                        <small>'.$puntuacion.' ptos</small></p>
                </div>
                <a href=php/ver_receta.php?id_receta='.$id_receta.'>Ver más</a>
                <h6>Subido por: '.$nombre_user.'</h6>
            </div>
        ';
       }
       $consulta->close();

       echo' </div> </div>';


    /* PIE DE PAGINA */
    echo"</main>";
    echo insert_footer_index();
    ?>
    <script>
        /* MANEJO DE PAGINAS JS */
        var pagina="<?php echo"index";?>";
    </script>
    
</body>
</html>