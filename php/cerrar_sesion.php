<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagenes/otro/logo_sitio.png">
    <title>Cerrar Sesion</title>
</head>
<body>
    <?php
         require('./funciones.php');
         if(isset($_COOKIE['mantener'])){
          session_decode($_COOKIE['mantener']);
         }
         cerrar_sesion();
         echo'
            <div class="d-flex justify-content-center text-center m-5">
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                </div>
            </div>
         ';
        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:../index.php">';
    ?>
</body>
</html>