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
    <title>Menú Semanal</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css?1.1"/>
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

            /* COMPROBAR QUE NO TENGA YA UN MENU ACTIVO */

            /* PARA FUNCIONALIDAD DE LOS BOTONES */
            $id_user=$_SESSION['id'];

            $r1=".";
            $e1="..";
            $e2=".";
            echo insert_cab($r1);
            echo insert_nav($e1,$e2);

            $comprobar="select count(id_user) from menu where id_user=?";
            $consulta=$conexion->prepare($comprobar);
            $consulta->bind_param("i",$id_user);
            $consulta->bind_result($hallar);
            $consulta->execute();
            $consulta->fetch();

            if($hallar==1){
                echo"hola";
            }else{
                    /* EN PRINCIPIO HABRA 3 BOTONES PARA CREAR MENU
                    1º MENÚ ALEATORIO
                    2º MENÚ DE MIS RECETAS
                    3º MENÚ DE ME GUSTA */

                    echo'
                    <main>
                        <form>
                            <legend>PLATOS PARA EL MENÚ</legend>
                            <input type="button" class="btn btn-dark" id="receta_alea" name="receta_alea" value="Platos aleatorios">
                            <input type="button" class="btn btn-dark" id="receta_mias" name="receta_mias" value="Platos de Mi Perfil">
                            <input type="button" class="btn btn-dark" id="recetas_like" name="recetas_like" value="Recetas que me gustan">
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                    <th class="text-center">Lunes</th>
                                    <th class="text-center">Martes</th>
                                    <th class="text-center">Miércoles</th>
                                    <th class="text-center">Jueves</th>
                                    <th class="text-center">Viernes</th>
                                    <th class="text-center">Sábado</th>
                                    <th class="text-center">Domingo</th>
                                </tr>
                                <thead>
                                <tbody id="lista_platos">

                                </tbody>
                            </table>
                        </div>

                        <form id="menu_form" method="post" action="#">

                        <input type="submit" class="btn btn-warning" id="guardar" name="guardar" value="Empezar semana">
                        </form>
                        
                ';

                if(isset($_POST["guardar"])){
                    $user=$_POST["user"];
                    $lunes=$_POST["lunes"];
                    $martes=$_POST["martes"];
                    $miercoles=$_POST["miercoles"];
                    $jueves=$_POST["jueves"];
                    $viernes=$_POST["viernes"];
                    $sabado=$_POST["sabado"];
                    $domingo=$_POST["domingo"];
                    $fecha=date("Y-m-d");

                    $sentencia="insert into menu values(?,?,?,?,?,?,?,?,?)";
                    $consulta=$conexion->prepare($sentencia);
                    $consulta->bind_param("iiiiiiiis",$user, $lunes, $martes, $miercoles
                    , $jueves, $viernes, $sabado, $domingo, $fecha);
                    $consulta->execute();
                    $consulta->fetch();
                    $consulta->close();
                    $conexion->close();
                }
            }
            




        }
    }
    ?>
    <script>
        /* CREAR VAR USUARIO PARA PODER AÑADIRLO A BASE DE DATOS */
        var usuario="<?php echo $_SESSION['id'];?>";
    </script>
</body>