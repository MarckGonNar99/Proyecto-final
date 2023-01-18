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

            /* DATOS */
            $r1=".";
            $e1="..";
            $e2=".";
            echo insert_cab($r1);
            echo insert_nav($e1,$e2);

            /* MENU DE BUSQUEDA */
            echo
                '
                <section class="buscar">
                    <form method="post" action="#" class="d-flex">
                    <input type="text" name="dato" class="form-control me-2"  placeholder="Buscar por nombre" aria-label="Search" required>
                    <input type="submit" class="btn btn-dark" name="buscar" value="Buscar" >
                    </form>
                </section>
                ';
            /* MOSTRAR LAS RECETAS BUSCADAS-GENERAL */


            /* CREANDO PAGINACIÓN DE TODOS LOS DATOS */
            $result = $conexion->query('SELECT COUNT(*) as total_products FROM receta');
            $row = $result->fetch_assoc();
            $num_total_rows = $row['total_products'];
            $n_item_pagina=2;

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
 
                //pongo el numero de registros total, el tamano de pagina y la pagina que se muestra
                echo '<h3>Numero de articulos: '.$num_total_rows.'</h3>';
                echo '<h3>En cada pagina se muestra '.$n_item_pagina.' articulos ordenados por fecha en formato descendente.</h3>';
                echo '<h3>Mostrando la pagina '.$page.' de ' .$total_pages.' paginas.</h3>';


                
                $result = $conexion->query(
                    'SELECT * FROM receta 
                    ORDER BY fecha DESC LIMIT '.$start.', '.$n_item_pagina
                );

                if ($result->num_rows > 0) {
                    echo '<div>';
                    while ($row = $result->fetch_assoc()) {
                        echo"<img src=".$row['imagen'].">";
                    }
                }

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
                echo '</nav>';
            }

?>
</body>
</html>