<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesion</title>
</head>
<body>
    <?php
         require('./funciones.php');
         if(isset($_COOKIE['mantener'])){
          session_decode($_COOKIE['mantener']);
         }
         cerrar_sesion();
         echo"<h3 class='mensaje'>SESION CERRADA</h3>";
        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:../index.php">';
    ?>
</body>
</html>