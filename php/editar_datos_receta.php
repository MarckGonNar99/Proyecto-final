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
    <title>Editar Receta</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css?1.1"/>
    <script src="../app/app.js?4.0" defer></script>
</head>
<body>
<?php
    require('./funciones.php');
    $conexion=conexion();

    if(isset($_COOKIE['mantener'])){
        session_decode($_COOKIE['mantener']);
    }

    /* SOLO LOS CREADORES Y ADMINS PUEDEN CAMBIAR RECETAS */
    $id_user=$_GET["id_user"];

    if(isset($_SESSION['id'])){
        if($_SESSION['id']=='01' || $_SESSION['id']==$id_user){
            /* DATOS Y VARIABLES DE USUARIO
            E ID DE LA RECETA QUE SE VERÁ EN LA PÁGINA*/

            $id_receta=$_GET["id_receta"];

            $r1=".";
            $e1="..";
            $e2=".";
            $i="../";
            echo insert_cab($r1,$i);
            echo insert_nav($e1,$e2);


            $sentencia="select nombre, tiempo,
                categoria, ingredientes, alergenos, pasos from receta where id_receta=?";
            $consulta=$conexion->prepare($sentencia);
            $consulta->bind_param("i",$id_receta);
            $consulta->bind_result($nombre, $tiempo,
                $categoria, $ingredientes, $alergenos, $pasos);
            $consulta->execute();
            $consulta->store_result();
            $consulta->fetch();

            /* AÑADIR VALUES CON LOS DATOS SQL */
            echo'
            <main class="formulario" id="editar_receta">
                <form method="POST" action="#" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre_receta" class="form-label">Nombre de la receta</label>
                        <input type="text" name="nombre_receta" value="'.$nombre.'" class="form-control" id="nombre_receta" required>
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="tiempo" class="form-label">Tiempo de preparación</label>
                        <input type="number" name="tiempo" value="'.$tiempo.'" class="form-control" id="tiempo" required>
                        <div id="emailHelp" class="form-text">En minutos</div>
                    </div>
                    <div class="mb-3">
                        <label for="ingredientes" class="form-label">Ingredientes</label>
                        <textarea id="ingredientes" name="ingredientes" class="form-control" placeholder="Ejemplo: 12g de sal, 5 g de harina..." required>'.$ingredientes.'</textarea>
                        <div id="emailHelp" class="form-text">Separar los ingredientes por coma</div>
                    </div>
                    <div class="mb-3">
                        <label for="pasos" class="form-label">Pasos</label>
                        <textarea id="pasos" name="pasos" class="form-control" placeholder="Ejemplo: Picar verduras. Luego sofreir con aceite..." required>'.$pasos.'</textarea>
                        <div id="emailHelp" class="form-text">Separar los pasos por punto</div>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Receta</label>
                        <select name="tipo" id="tipo" value="'.$categoria.'" required>
                            <option value="Carnes y aves">Carnes y aves</option>
                            <option value="Sopas, cremas y cocidos">Sopas, cremas y cocidos</option>
                            <option value="Verduras y legumbres">Verduras y legumbres</option>
                            <option value="Pescado y mariscos">Pescado y mariscos</option>
                            <option value="Arroz">Arroz</option>
                            <option value="Pastas">Pastas</option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="alergeno" class="form-label">Contiene algún alergeno</label>
                        <input type="radio" id="si" name="hay_alergeno" value="Si" checked>
                        <label for="si">Si</label>
                        <input type="radio" id="no" name="hay_alergeno" value="No">
                        <label for="no">No</label><br>
                        <input type="text" name="alergeno" value="'.$alergenos.'" class="form-control" id="alergeno" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label  for="imagen" class="form-label">Imagen (.jpg o .png)</label>
                        <input type="file" name="imagen" id="imagen"><br>
                    </div>
                    <button type="submit" name="modificar" class="btn btn-primary">Modificar</button>

            ';
            if($_SESSION['id']=='01'){
                echo'<a href="'.$e2.'/recetas.php" class="btn btn-danger" role="button">Volver</a>';
            }else{
                echo'<a href="'.$e2.'/mi_perfil.php" class="btn btn-danger" role="button">Volver</a>';
            }
            
            echo'</form></main>';

            if(isset($_POST["modificar"])){
                $n_nombre=$_POST["nombre_receta"];
                $n_tiempo=$_POST["tiempo"];
                $n_ingredientes=$_POST["ingredientes"];
                $n_pasos=$_POST["pasos"];
                $n_categoria=$_POST["tipo"];
                if(isset($_POST['alergeno'])){
                    $n_alergeno=$_POST['alergeno'];
                }else{
                    $n_alergeno=null;  
                }
                $fecha_edicion=date("Y-m-d");

                /* DATOS DE LA IMAGEN */
                $imagen=0;
                $n=$_FILES['imagen']['name'];
                $tipo_foto=$_FILES['imagen']['type'];
                $temp=$_FILES['imagen']['tmp_name'];
                $ruta="imagenes/recetas";
                $existe =$_FILES['imagen']['error'];


                if(!file_exists("../".$ruta)){
                    mkdir($ruta);
                }

                $var=$ruta;
                if(!($existe>0)){
                    /* ELIMINAR LAS FOTOS ANTERIOR */

                    $selecionar = "SELECT imagen FROM receta WHERE id_receta = '$id_receta'";
                    $resultado_seleccionar = mysqli_query($conexion, $selecionar);

                    $foto_db = mysqli_fetch_array($resultado_seleccionar);
                    $ruta_foto_db = "../recetas/" . $foto_db['imagen'];

                    if(file_exists($ruta_foto_db)){
                        unlink($ruta_foto_db);
                    }

                     /* CREAR NOMBRE DE LA IMAGEN SIN ESPACIOS */
                     $nombre_imagen=str_replace(' ','', $n_nombre);


                    if(strrpos($tipo_foto, "jpeg")!==false || strrpos($tipo_foto, "png")!==false
                    || strrpos($tipo_foto, "jpg")!==false){

                        if(strrpos($tipo_foto, "jpeg")!==false || strrpos($tipo_foto, "jpg")!==false){
                            $var=$var."/".$nombre_imagen."_".$id_user.".jpg";
                        }else{
                            $var=$var."/".$nombre_imagen."_".$id_user.".png";
                        }
                        move_uploaded_file($temp,"../".$var);
                        $imagen=1;
                    }else{
                        $imagen=0;
                    }
                }

                /* HAY 2 CASOS DE EDICIÓN 
                    1º TODO
                    2º TODO MENOS FOTO
                   LO DEMAS TIENE REQUIRE*/

                   if($imagen==1){
                    $sentencia2="update receta set nombre=?, imagen=? ,
                        tiempo=?,categoria=?, ingredientes=?, 
                        alergenos=?, pasos=?, fecha=? where id_receta=? && id_user=?";
                    $consulta=$conexion->prepare($sentencia2);
                    $consulta->bind_param("ssisssssii", $n_nombre, $var, $n_tiempo,
                        $n_categoria, $n_ingredientes,
                        $n_alergeno, $n_pasos, $fecha_edicion, $id_receta, $id_user);
                    $consulta->execute();
                    $consulta->fetch();
                    $consulta->close();
                    echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./mi_perfil.php?'.$id_user.'">';

                   }elseif($imagen==0){
                    $sentencia2="update receta set nombre=?,
                    tiempo=?, categoria=?, ingredientes=?, 
                    alergenos=?, pasos=?, fecha=? where id_receta=? && id_user=?";
                    $consulta=$conexion->prepare($sentencia2);
                    $consulta->bind_param("sisssssii", $n_nombre, $n_tiempo,
                    $n_categoria, $n_ingredientes,
                    $n_alergeno, $n_pasos, $fecha_edicion, $id_receta, $id_user);
                    $consulta->execute();
                    $consulta->close();
                    if($_SESSION['id']=='01'){
                        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./recetas.php">';
                    }else{
                        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./mi_perfil.php?'.$id_user.'">';
                    }
                    
                   }
            }
            if(isset($_POST["volver"])){
                echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:./mi_perfil.php?'.$id_user.'">';
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
        var pagina="<?php echo"editar_receta";?>";
    </script>
</body>