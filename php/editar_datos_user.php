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
    <title>Editar Datos de Usuario</title>
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos.css"/>
    <script src="../app/app.js" defer></script>
</head>
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
            echo insert_cab($r1);
            echo insert_nav($e1,$e2);

            /* FORMULARIO DEW CAMBIO DE NOMBRE, FOTO */
                //DATOS DE USUARIO
                $nombre=$_SESSION["nombre"];

            echo '<main class="formulario" id="sesion_inicio">';
            echo
                '
                    <form method="POST" action="#" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de Usuario</label>
                            <input required type="text" name="nombre" class="form-control" id="nombre" value="'.$nombre.'">
                        </div>
                        <div class="mb-3">
                            <label  for="imagen" class="form-label">Imagen (.jpg o .png)</label>
                            <input type="file" name="imagen" id="imagen"><br>
                        </div>
                        <button type="submit" name="modificar" class="btn btn-primary">Modificar Perfil</button>
                        <button type="reset" name="cancelar" class="btn btn-warning">Cancelar</button>
                    </form>
                ';

                if(isset($_POST["modificar"])){
                    $nombre_nuevo=$_POST['nombre'];

                    //Datos de la foto
                    $imagen=0;
                    $n=$_FILES['imagen']['name'];
                    $tipo_foto=$_FILES['imagen']['type'];
                    $temp=$_FILES['imagen']['tmp_name'];
                    $ruta="../imagenes/clientes";
                    $existe =$_FILES['imagen']['error'];

                    if(!file_exists($ruta)){
                    mkdir($ruta);
                    }

                    $var=$ruta;
                    if(!($existe>0)){
                    if(strrpos($tipo_foto, "jpeg")!==false || strrpos($tipo_foto, "png")!==false
                    || strrpos($tipo_foto, "jpg")!==false){
                        
                        if(strrpos($tipo_foto, "jpeg")!==false || strrpos($tipo_foto, "jpg")!==false){
                            $extension="jpeg";
                            $var=$var."/".$nombre."_".$id.".jpg";
                        }else{
                            $extension="png";
                            $var=$var."/".$nombre."_".$id.".png";
                        }
                        move_uploaded_file($_FILES['imagen']['tmp_name'],$var);
                    $imagen=1;
                    }else{
                        $imagen=0;
                    }

                } 

                

            }else{
                /* NI ADMIN |-º-| NI NO REGISTRADOS */
            }
        }
    }
?>
</body>
</html>