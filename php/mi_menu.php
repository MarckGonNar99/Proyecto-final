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
    <title>Menú Semanal</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css?1.5"/>
    <script src="../app/app_menu.js?1.6" defer></script>
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


            /* PARA FUNCIONALIDAD DE LOS BOTONES */
            $id_user=$_SESSION['id'];

            $r1=".";
            $e1="..";
            $e2=".";
            $i="../";
            echo insert_cab($r1,$i);
            echo insert_nav($e1,$e2);

            $comprobar="select count(id_user) from menu where id_user=?";
            $consulta=$conexion->prepare($comprobar);
            $consulta->bind_param("i",$id_user);
            $consulta->bind_result($hallar);
            $consulta->execute();
            $consulta->fetch();
            $consulta->close();

            if($hallar==1){

                $sentencia="select lunes, martes, miercoles, jueves, viernes, sabado
                ,domingo, fecha from menu where id_user=?";
                $consulta=$conexion->prepare($sentencia);
                $consulta->bind_param("i",$id_user);
                $consulta->bind_result($lunes,$martes, $miercoles, 
                    $jueves, $viernes, $sabado, $domingo, $fecha);
                $consulta->execute();
                $consulta->store_result();
                $consulta->fetch();

                $fecha_caduca=date("Y-m-d",strtotime($fecha."+ 1 week"));
                $fecha_hoy=date("Y-m-d");

                if($fecha_hoy==$fecha_caduca || $fecha_hoy>$fecha_caduca){
                    $sentencia="delete from menu where id_user=?";
                    $consulta=$conexion->prepare($sentencia); 
                    $consulta->bind_param("i",$id_user);
                    $consulta->execute();
                    $consulta->fetch();
                    $consulta->close();
                    echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./mi_menu.php">';
                }


                $array_dias=array($lunes,$martes, $miercoles, 
                $jueves, $viernes, $sabado, $domingo);

                $dias_semana=array("Lunes","Martes","Miércoles","Jueves","Viernes"
                ,"Sábado","Domingo");

                echo"<main><div class='contenedor'>";

                for($i=0;$i<count($array_dias);$i++){

                    $sentencia="select id_receta, nombre, imagen, tiempo,
                        categoria, ingredientes, alergenos, pasos, fecha from receta where id_receta=?";
                    $consulta=$conexion->prepare($sentencia);
                    $consulta->bind_param("i",$array_dias[$i]);
                    $consulta->bind_result($id_receta ,$nombre, $imagen, $tiempo, 
                        $categoria, $ingredientes, $alergenos, $pasos, $fecha_subida);
                    $consulta->execute();
                    $consulta->store_result();
                    
                    /* PREPARAMOS LA VISTA DEL MENU */
                    while($consulta->fetch()){
                            echo'
                            <div class="tarjeta_receta">
                                <h2>'.$dias_semana[$i].'</h2>
                                <h6>'.$categoria.'</h6>
                                <img src="../'.$imagen.'" class="card-img-top" alt="...">
                                <div class="cuerpo_t">
                                    <h5>'.$nombre.'</h5>
                                </div>
                                <div class="data_t">
                                        <p>'.$fecha_subida.'</p>
                                </div>
                                <a href='.$e2.'/ver_receta.php?id_receta='.$id_receta.'>Ver más</a>
                            </div>
                        ';
                    }
                    
                    
                }
                echo'</div></main>';


                /* PASADA LA SEMANA BORRAR EL MENU */

            }else{
                    echo'
                    <main>
                        <form id="elegir_menu">
                            <legend>PLATOS PARA EL MENÚ</legend>
                            <input type="button" class="btn btn-dark" id="receta_alea" name="receta_alea" value="Platos aleatorios">
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

                        <form id="guardar" method="post" action="#">
                            <input type="submit" class="btn btn-warning" id="guardar_boton" name="guardar" value="Empezar semana">
                        </form>
                        </main>
                        
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
                    echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./mi_menu.php">';
                }
            }
        }else{
            echo"
                <div id='error'>
                <img src='../imagenes/otro/error.png'>
                    <p>Este no es tu menú</p>   
                </div>
            ";
            echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:../index.php">';
        }
        

    }else{
        echo"
            <div id='error'>
            <img src='../imagenes/otro/error.png'>
                <p>No tiene acceso a esta zona</p>   
            </div>
        ";
        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:../index.php">';
    }
    echo insert_footer();
    ?>
    <script>
        /* CREAR VAR USUARIO PARA PODER AÑADIRLO A BASE DE DATOS */
        var usuario="<?php echo $_SESSION['id'];?>";
    </script>
</body>