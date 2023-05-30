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
    <title>Recetas</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css?4.5"/>
    <script src="../app/app.js?2.5" defer></script>
</head>
<body id='pagina_texto'>
    <?php

    require('./funciones.php');
    $conexion=conexion();

    if(isset($_COOKIE['mantener'])){
        session_decode($_COOKIE['mantener']);
    }

    if(isset($_SESSION['id'])){
            /* DATOS Y VARIABLES DE USUARIO
            E ID DE LA RECETA QUE SE VERÁ EN LA PÁGINA*/
            $id=$_SESSION["id"];

            $id_receta=$_GET["id_receta"];

            $r1=".";
            $e1="..";
            $e2=".";
            $i="../";
            echo insert_cab($r1,$i);
            echo insert_nav($e1,$e2);


            /* SACAR LOS DATOS DE LA RECETA */
            
            $sentencia="select id_user, nombre, imagen, tiempo,
                categoria, ingredientes, alergenos, pasos, puntuacion from receta where id_receta=?";
            $consulta=$conexion->prepare($sentencia);
            $consulta->bind_param("i",$id_receta);
            $consulta->bind_result($id_user, $nombre, $imagen, $tiempo, 
                $categoria, $ingredientes, $alergenos, $pasos, $puntuacion);
            $consulta->execute();
            $consulta->store_result();
            $consulta->fetch();
            $consulta->close();

            $listaIngr=explode(",",$ingredientes);
            $listaPasos=explode(".",$pasos);

            /* LISTADO DE DATOS DE LA RECETA */
            echo'
                <main>
                    <div id="ver_receta">
                        <div id="nombre_receta">
                            <h2>'.$nombre.'</h2>
                        </div>
                        <img id="imagen_receta" src="../'.$imagen.'">
                        <div id="otros_datos">
                            <p>'.$tiempo.' minutos</p>
                            <p>'.$categoria.'</p>
                        </div>
                ';
                if($alergenos!= NULL){
                    echo'<div id="alergeno">
                            <p>Esta receta contiene: '.$alergenos.'</p>
                        </div>';
                }
                echo'
                 <div id="lista_ingre">   
                    <p>Ingredientes<img class="emoji" src="../imagenes/recetas/emoji_ingr.png""></p>     
                    <ul class="ingre">
                ';
            foreach($listaIngr as $valor){
                echo"<li>".$valor."</li>";
            }
            echo"</ul></div>";
            echo"
                <div id='lista_pasos'>
                    <p>Pasos<img class='emoji' src='../imagenes/recetas/emoji_paso.png''></p>
                    <ol class='ps'>";
            
            foreach($listaPasos as $valor){
                echo"<li>".$valor.".</li>";
            }
            echo"</ol></div>";



            /* SI LA RECETA ES PROPIA AÑADIR BOTÓNES
                ELIMINAR EDITAR */
            
            if($id==$id_user || $id==1){
                echo'<div class="opciones"><a href="'.$e2.'/editar_datos_receta.php?id_receta='.$id_receta.'&id_user='.$id_user.'" class="btn btn-warning" role="button">Editar Datos</a>';

                echo"
                    <form method='post' action='#'>
                        <button type='submit' name='borrar' class='btn btn-danger'>Borrar</button>
                    </form>
                    </div>
                ";
                if(isset($_POST["borrar"])){
                    $sentencia="delete from receta where id_receta=".$id_receta."";
                    $consulta=$conexion->prepare($sentencia); 
                    $consulta->execute();
                    $consulta->fetch();
                    $consulta->close();
                    if($_SESSION['id']=='01'){
                        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./recetas.php">';
                    }else{
                        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./mi_perfil.php?'.$id_user.'">';
                    }
                }
            }else{

                /* COMPROBAR QUE HAYA VOTADO ANTES */
                $ComprobarVoto=("select count(*) from votacion where id_user=? and id_receta=?");
                $consulta=$conexion->prepare($ComprobarVoto);
                $consulta->bind_param("ii",$id,$id_receta);
                $consulta->bind_result($haVotado);
                $consulta->execute();
                $consulta->store_result();
                $consulta->fetch();
                $consulta->close();
                /* VALOR NUEVO PARA LA VOTACION */
                $select_id = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'web_cocina' AND   TABLE_NAME = 'votacion';";
                $consulta=$conexion->query($select_id);
                $fila=$consulta->fetch_array(MYSQLI_ASSOC);
                $consulta->close();
                echo"
                    <div class='opciones'>
                        <form method='post' action='#' enctype='multipart/form-data'>
                            <input type='hidden' value=".$fila["AUTO_INCREMENT"]." name='id_votacion' class='form-control' readonly>";
                if($haVotado==0){
                    echo"<button id='meGusta' type='submit' name='gusta'><img id='imagenGusta' src='../imagenes/recetas/corazon_vacio.png'></button>";
                }else{
                    echo"<button id='meGusta' type='submit' name='gusta'><img id='imagenGusta' src='../imagenes/recetas/corazon_like.png'></button>";
                }
                echo"
                        </form>
                    </div>
                    <a href='".$e2."/reportar.php?id_receta=".$id_receta."' class='btn btn-warning' role='button'>Reportar</a>
                    </div>
                ";

                if(isset($_POST["gusta"])){
                    if($haVotado==0){ 
                        $n_puntos=$puntuacion+1;
                        $sentencia="update receta set puntuacion=? where id_receta=? ";
                        $consulta=$conexion->prepare($sentencia); 
                        $consulta->bind_param("ii",$n_puntos , $id_receta);
                        $consulta->execute();
                        $consulta->fetch();
                        $consulta->close();

                        $id_votar=$_POST['id_votacion'];
                        $votacion=$conexion->query("INSERT INTO `votacion` (`id_voto`, `id_user`, `id_receta`) VALUES ('$id_votar', '$id', '$id_receta')");
                        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./ver_receta.php?id_receta='.$id_receta.'">';
                    }else{
                        $n_puntos=$puntuacion-1;
                        $sentencia="update receta set puntuacion=? where id_receta=? ";
                        $consulta=$conexion->prepare($sentencia); 
                        $consulta->bind_param("ii",$n_puntos , $id_receta);
                        $consulta->execute();
                        $consulta->fetch();
                        $consulta->close();

                        $votacion=$conexion->query("DELETE FROM `votacion` WHERE id_user='$id' and id_receta='$id_receta'");
                        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./ver_receta.php?id_receta='.$id_receta.'">';
                    }


                }
                
            }
            echo"</div></main>";

        }else{

            $id_receta=$_GET["id_receta"];
            $r1=".";
            $e1="..";
            $e2=".";
            $i="../";
            echo insert_cab($r1,$i);
            echo insert_nav($e1,$e2);

             /* SACAR LOS DATOS DE LA RECETA */
            
             $sentencia="select id_user, nombre, imagen, tiempo,
             categoria, ingredientes, alergenos, pasos, puntuacion from receta where id_receta=?";
            $consulta=$conexion->prepare($sentencia);
            $consulta->bind_param("i",$id_receta);
            $consulta->bind_result($id_user, $nombre, $imagen, $tiempo, 
                $categoria, $ingredientes, $alergenos, $pasos, $puntuacion);
            $consulta->execute();
            $consulta->store_result();
            $consulta->fetch();
            $consulta->close();

            $listaIngr=explode(",",$ingredientes);
            $listaPasos=explode(".",$pasos);

            /* LISTADO DE DATOS DE LA RECETA */
            echo'
                <main>
                    <div id="ver_receta">
                        <div>
                            <h2>'.$nombre.'</h2>
                        </div>
                        <img id="imagen_receta" src="../'.$imagen.'">
                        <div>
                            <p>'.$tiempo.' minutos</p>
                            <p>'.$categoria.'</p>
                        </div>
                        <ul class="ingre">
                        <p>Ingredientes<img class="emoji" src="../imagenes/recetas/emoji_ingr.png""></p> 
            ';
            foreach($listaIngr as $valor){
                echo"<li>".$valor."</li>";
            }
            echo"</ul>";
            echo"<ol class='ps'>
                <p>Pasos<img class='emoji' src='../imagenes/recetas/emoji_paso.png''></p>";
            
            foreach($listaPasos as $valor){
                echo"<li>".$valor.".</li>";
            }
            echo"</ol></div></main>";
        }
        echo insert_footer();
    ?>
    <script>
        /* MANEJO DE PAGINAS JS */
        var user="<?php echo $id;?>";
        var pagina="<?php echo"ver_receta";?>";
        
    </script>
</body>