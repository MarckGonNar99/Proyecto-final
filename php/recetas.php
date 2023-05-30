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
    <script src="../app/app.js?3.5" defer></script>
</head>
<body>
<?php
    require('./funciones.php');
    $conexion=conexion();

        /* TODOS LOS USUARIOS TIENEN ACCESO */
    if(isset($_COOKIE['mantener'])){
        session_decode($_COOKIE['mantener']);
    }

            /* DATOS */
            $r1=".";
            $e1="..";
            $e2=".";
            $i="../";
            echo insert_cab($r1,$i);
            echo insert_nav($e1,$e2);

            /* MENU DE BUSQUEDA */
            echo
                '
                <section class="buscar">
                    <form method="post" action="#">
                        <div>
                            <select name="que_busca" required>
                                <option value="nombre">Nombre</option>
                                <option value="categoria">Categoria</option>
                            </select>
                        </div>
                        <div>
                            <input type="text" id="buscar_receta" name="dato" class="form-control me-2"  placeholder="Buscar" aria-label="Search" required>
                            <a href="'.$e2.'/recetas.php?" class="btn btn-warning" role="button">Volver</a>
                        </div>
                        <input type="submit" class="btn btn-dark" name="buscar" value="Buscar">
                    </form>
                </section>
                ';
            /* MOSTRAR LAS RECETAS BUSCADAS-GENERAL */
            if(isset($_POST["buscar"])){
                $que_buscar=$_POST["que_busca"];
                $busqueda=$_POST["dato"];
                $busqueda='%'.$busqueda.'%';

                if($que_buscar=="nombre"){
                    $sentencia="select id_receta, nombre, imagen, categoria,
                    fecha, puntuacion from receta where nombre like ?";
                    $consulta=$conexion->prepare($sentencia);
                    $consulta->bind_param("s",$busqueda);
                    $consulta->bind_result($id_receta ,$nombre_receta, $imagen, $categoria,
                    $fecha, $puntuacion);
                    $consulta->execute();
                    $consulta->store_result();
                }elseif($que_buscar=="categoria"){
                    $sentencia="select id_receta, nombre, imagen, categoria,
                    fecha, puntuacion from receta where categoria like ?";
                    $consulta=$conexion->prepare($sentencia);
                    $consulta->bind_param("s",$busqueda);
                    $consulta->bind_result($id_receta ,$nombre_receta, $imagen, $categoria,
                    $fecha, $puntuacion);
                    $consulta->execute();
                    $consulta->store_result();
                }else{
                    /* ERROR AL BUSCAR */
                }
                echo"<main><div class='contenedor'>";
                while($consulta->fetch()){
                    $timestamp = strtotime($fecha);
                    $fecha_bien = date('d/m/Y', $timestamp);
                    echo"
                    <div class='tarjeta_receta'>
                        <h6>$categoria</h6>
                        <img src='../".$imagen."' class='card-img-top' alt='...'>
                        <div class='cuerpo_t'>
                            <h5>$nombre_receta</h5>
                        </div>
                        <div class='data_t'>
                                <p>$fecha_bien</p>
                                <small>$puntuacion ptos</small></p>
                        </div>
                        <a href='$e2/ver_receta.php?id_receta=".$id_receta."'>Ver más</a>
                    </div>
                    
                    ";

                }
                echo "</div></main>";
            }else{
            echo"<main><div class='contenedor'>";
                /* CREANDO PAGINACIÓN DE TODOS LOS DATOS */
            $result = $conexion->query('SELECT COUNT(*) as total_products FROM receta');
            $row = $result->fetch_assoc();
            $num_total_rows = $row['total_products'];
            $n_item_pagina=6;

            if($num_total_rows>0){
                $page = false;
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                }

                if (!$page) {
                    $start = 0;
                    $page = 1;
                } else {
                    $start = ($page - 1) * $n_item_pagina;
                }

                $total_pages = ceil($num_total_rows / $n_item_pagina);

                
                $result = $conexion->query(
                    'SELECT * FROM receta 
                    ORDER BY fecha DESC LIMIT '.$start.', '.$n_item_pagina
                );

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $timestamp = strtotime($row["fecha"]);
                        $fecha_bien = date('d/m/Y', $timestamp);
                        echo'
                    
                        <div class="tarjeta_receta">
                            <h6>'.$row["categoria"].'</h6>
                            <img src="../'.$row["imagen"].'" class="card-img-top" alt="...">
                            <div class="cuerpo_t">
                                <h5>'.$row["nombre"].'</h5>
                            </div>
                            <div class="data_t">
                                    <p>'.$fecha_bien.'</p>
                                    <small>'.$row["puntuacion"].' ptos</small></p>
                            </div>
                            <a href='.$e2.'/ver_receta.php?id_receta='.$row["id_receta"].'>Ver más</a>
                        </div>
                    ';
                    }
                }
                echo"</div>";

                echo '<nav>';
                echo '<ul class="pagination">';
             
                if ($total_pages > 1) {
                    if ($page != 1) {
                        echo '<li class="page-item"><a class="page-link" href="recetas.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
                    }
             
                    for ($i=1;$i<=$total_pages;$i++) {
                        if ($page == $i) {
                            echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="recetas.php?page='.$i.'">'.$i.'</a></li>';
                        }
                    }
             
                    if ($page != $total_pages) {
                        echo '<li class="page-item"><a class="page-link" href="recetas.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
                    }
                }
                echo '</ul>';
                echo '</nav></main>';
            }

            }

            
            echo insert_footer();
?>
    <script>
        /* MANEJO DE PAGINAS JS */
        var pagina="<?php echo"recetas";?>";
    </script>
</body>
</html>