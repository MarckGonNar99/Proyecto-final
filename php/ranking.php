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
    <title>Mi perfil</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css"/>
    <script src="../app/app.js" defer></script>
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
            echo insert_cab($r1);
            echo insert_nav($e1,$e2);

?>
</body>
</html>