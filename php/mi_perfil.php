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
    <link rel="icon" type="image/x-icon" href="../imagenes/otro/logo.png">
    <title>Mi perfil</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css?3.9"/>
    <script src="../app/app.js?1.1" defer></script>
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
            /* DATOS Y VARIABLES DE USUARIO */
            $r1=".";
            $e1="..";
            $e2=".";
            $i="../";
            echo insert_cab($r1,$i);
            echo insert_nav($e1,$e2);

            $id=$_SESSION["id"];
            $nombre=$_SESSION["nombre"];
            $imagen=obtener_foto($id);
            if($imagen==null){
                $imagen="../imagenes/usuarios/defecto.jpg";
            }
            /* DATOS DE USUARIO &&& MODIFICACION DE DATOS */
            //IMAGEN
            echo
                '
                    <header id="datos_user">
                        <img src="'.$imagen.'">     
                        <div>
                        <h2>'.$nombre.'</h2>
                        </div>
                        <a href="'.$e2.'/editar_datos_user.php" class="btn btn-warning" role="button">Modificar datos</a>
                    </header>
                ';

            /* MIS RECETAS */
            echo '<main><div class="contenedor">';
                /* BOTON PARA CREAR RECETA NUEVA */
            echo' 
                <a id="crear_receta" href="'.$r1.'/crear_receta.php">
                    <div class="boton_crear_receta">
                        <p>+</p><p>Crear Receta</p>
                    </div>
                </a>';
                
            /* RECETAS PROPIAS DEL USUARIO */
            $sentencia="select id_receta, nombre, imagen, categoria,
                fecha, puntuacion from receta where id_user=?";
            $consulta=$conexion->prepare($sentencia);
            $consulta->bind_param("i",$id);
            $consulta->bind_result($id_receta ,$nombre_receta, $imagen, $categoria,
                                $fecha, $puntuacion);
            $consulta->execute();
            $consulta->store_result();
            

            while($consulta->fetch()){
                $timestamp = strtotime($fecha);
                $fecha_bien = date('d/m/Y', $timestamp);
                echo'
                
                    <div class="tarjeta_receta">
                        <h6>'.$categoria.'</h6>
                        <img src="../'.$imagen.'" class="card-img-top" alt="...">
                        <div class="cuerpo_t">
                            <h5>'.$nombre_receta.'</h5>
                        </div>
                        <div class="data_t">
                                <p>'.$fecha_bien.'</p>
                                <small>'.$puntuacion.' ptos</small></p>
                        </div>
                        <a href='.$e2.'/ver_receta.php?id_receta='.$id_receta.'>Ver más</a>
                    </div>
                ';
                }
            $consulta->close();
            echo'</div>
            <section id="recetas_like">
                <p id="titulo_like">Recetas que me han gustado</p>
            <div class="contenedor">';

            /*AÑADIR RECETAS QUE ME GUSTAN */
            $sentencia="select r.id_receta, r.nombre, r.imagen, r.categoria,
            r.fecha, r.puntuacion from receta r, votacion v where v.id_user=? and r.id_receta=v.id_receta";
            $consulta=$conexion->prepare($sentencia);
            $consulta->bind_param("i",$id);
            $consulta->bind_result($id_receta ,$nombre_receta, $imagen, $categoria,
                                $fecha, $puntuacion);
            $consulta->execute();
            $consulta->store_result();
           
            

            while($consulta->fetch()){
                $timestamp = strtotime($fecha);
                $fecha_bien = date('d/m/Y', $timestamp);
                echo'
                
                    <div class="tarjeta_receta">
                        <h6>'.$categoria.'</h6>
                        <img src="../'.$imagen.'" class="card-img-top" alt="...">
                        <div class="cuerpo_t">
                            <h5>'.$nombre_receta.'</h5>
                        </div>
                        <div class="data_t">
                                <p>'.$fecha_bien.'</p>
                                <small>'.$puntuacion.' ptos</small></p>
                        </div>
                        <a href='.$e2.'/ver_receta.php?id_receta='.$id_receta.'>Ver más</a>
                    </div>
                ';
                }
            $consulta->close();
        echo'</div></main>';
            
            echo insert_footer();
        }else{
            echo"
                <div id='error'>
                <img src='../imagenes/otro/error.png'>
                    <p>Admin tu noo</p>   
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
?>
    <script>
        /* MANEJO DE PAGINAS JS */
        var pagina="<?php echo"mi_perfil";?>";
    </script>
</body>
</html>


