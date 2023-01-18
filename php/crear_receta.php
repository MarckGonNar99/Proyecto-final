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
    <title>Crear Receta</title>
    <link href="../estilos/estilos.css" rel="stylesheet">
    <script type="text/Javascript" src="../app/app.js" defer></script>
</head>
<body>
    <?php
        require('funciones.php');
        $conexion=conexion();

        if(isset($_COOKIE['mantener'])){
            session_decode($_COOKIE['mantener']);
        }
        /* COMRPOBAR SESION DE USUARIO */
        if(isset($_SESSION["id"])){
            if($_SESSION['id']!='01'){
                //DATOS DE CABECERA Y CONEXION
                $r1=".";
                $e1="..";
                $e2=".";
                echo insert_cab($r1);
                echo insert_nav($e1,$e2);

                /* CREACION DE LA RECETA */
                    // ID DE USUARIO QUE LA CREA
                $id_user=$_SESSION["id"];
                    //FORMULARIO DATOS DE LA RECETA
                $select_id = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'web_cocina' AND   TABLE_NAME = 'receta';";
                $consulta=$conexion->query($select_id);
                $fila=$consulta->fetch_array(MYSQLI_ASSOC);

                echo'
                    <main class="formulario" id="sesion_inicio">
                        <form method="POST" action="#" enctype="multipart/form-data">
                        <input type="hidden" value='.$fila["AUTO_INCREMENT"].' name="id" class="form-control" id="id" readonly>
                            <div class="mb-3">
                                <label for="nombre_receta" class="form-label">Nombre de la receta</label>
                                <input type="text" name="nombre_receta" class="form-control" id="nombre_receta" required>
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="tiempo" class="form-label">Tiempo de preparación</label>
                                <input type="number" name="tiempo" class="form-control" id="tiempo" required>
                                <div id="emailHelp" class="form-text">En minutos</div>
                            </div>
                            <div class="mb-3">
                                <label for="n_personas" class="form-label">Número de personas</label>
                                <input type="number" name="n_personas" class="form-control" id="n_personas" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="ingredientes" class="form-label">Ingredientes</label>
                                <textarea id="ingredientes" name="ingredientes" class="form-control" placeholder="Ejemplo: 12g de sal, 5 g de harina..." required></textarea>
                                <div id="emailHelp" class="form-text">Separar los ingredientes por coma</div>
                            </div>
                            <div class="mb-3">
                                <label for="pasos" class="form-label">Pasos</label>
                                <textarea id="pasos" name="pasos" class="form-control" placeholder="Ejemplo: Picar verduras. Luego sofreir con aceite..." required></textarea>
                                <div id="emailHelp" class="form-text">Separar los pasos por punto</div>
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo de Receta</label>
                                <select name="tipo" id="tipo" required>
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
                                <input type="radio" id="si" name="fav_language" value="Si" checked>
                                <label for="si">Si</label>
                                <input type="radio" id="no" name="fav_language" value="No">
                                <label for="no">No</label><br>
                                <input type="text" name="alergeno" class="form-control" id="alergeno" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label  for="imagen" class="form-label">Imagen (.jpg o .png)</label>
                                <input type="file" name="imagen" id="imagen" required><br>
                            </div>
                            <button type="submit" name="crear" class="btn btn-primary">Crear</button>
                        </form>
                </main>
            ';
                //PROCESAMIENTO DE DATOS
                if(isset($_POST['crear'])){
                    $id=$_POST["id"];
                    $user=$_SESSION["id"];
                    $nombre=$_POST['nombre_receta'];
                    $tiempo=$_POST['tiempo'];
                    $n_personas=$_POST['n_personas'];
                    $tipo=$_POST['tipo'];
                    $ingredientes=$_POST['ingredientes'];
                    $pasos=$_POST['pasos'];
                    $fecha=date("Y-m-d");
                    $puntuacion=0;
                    if(isset($_POST['alergeno'])){
                        $alergeno=$_POST['alergeno'];
                    }else{
                        $alergeno=null;  
                    }

                    //DATOS DE LA IMAGEN

                    $imagen=0;
                    $n=$_FILES['imagen']['name'];
                    $tipo_foto=$_FILES['imagen']['type'];
                    $temp=$_FILES['imagen']['tmp_name'];
                    $ruta="../imagenes/recetas";
                    $existe =$_FILES['imagen']['error'];


                    if(!file_exists($ruta)){
                        mkdir($ruta);
                    }

                    $var=$ruta;
                    if(!($existe>0)){
                        if(strrpos($tipo_foto, "jpeg")!==false || strrpos($tipo_foto, "png")!==false
                        || strrpos($tipo_foto, "jpg")!==false){

                                //FORMATO JPG
                            if(strrpos($tipo_foto, "jepg")!==false || strrpos($tipo_foto, "jpg")!==false){

                                $extension="jepg";
                                $var=$var."/".$nombre."_".$id.".jpg";

                            }else{

                                //FORMATO PNG
                                $extension="png";
                                $var=$var."/".$nombre."_".$id.".png";
                            }

                            move_uploaded_file($_FILES['imagen']['tmp_name'],$var);
                            $imagen=1;
                        }else{
                            $imagen=0;      
                        }
                    }
                    echo $imagen;

                            //INSERTAR DATOS EN SQL
                    if($imagen==1){
                        echo"HOLA";
                        $insertar_receta="insert into receta values(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $consulta=$conexion->prepare($insertar_receta);
                        $consulta->bind_param("iissiisssssi",
                        $id,$user,$nombre,$var,$tiempo,$n_personas,$tipo,$ingredientes, $alergeno
                        , $pasos,$fecha, $puntuacion);
                        $consulta->execute();
                        $consulta->fetch();
                        $consulta->close();
                        $conexion->close();
                    }
                }
            }else{
                /* ADMIN NO PUEDE CREAR RECETAS */
            }
        }else{
            /* NO REGISTRADOS NO PUEDEN PASAR */
        }
    ?>
</body>
</html>