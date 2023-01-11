<?
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
</head>
<body>
    <?php
     require('funciones.php');
     if(isset($_COOKIE['mantener'])){
        session_decode($_COOKIE['mantener']);
    }
        /* Formulario de Contacto. El usuario escribirá su parrafo donde pondra su blablabla
        SOLO PUEDEN ACCEDER REGISTRADOS, NO ADMIN*/
        if(isset($_SESSION["dni"])){
            $r1=".";
            $e1="../";
            $e2=".";
            echo insert_cab($r1);
            echo insert_nav($e1,$e2);
            
         }else{
            /* ERROR */
            echo "ERROR";
         }
    ?>
</body>
</html>