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
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css" rel="stylesheet">
    <script text="text/JavaScript" src="app/app.js"defer></script>
    
    <!-- CONEXION CON LA APP -->
</head>
<body>
    <?php
     require('./php/funciones.php');
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
    /* Seccion de los ultimos platos subidos a la plataforma */


    /* PIE DE PAGINA */

    echo insert_footer();
    ?>
</body>
</html>