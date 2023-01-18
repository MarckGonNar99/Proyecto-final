<?php

    /* Funcion de insertar cabecera Y navegador*/
    function insert_cab($r1){
         if(isset($_SESSION["id"])){
            $header='
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                    <img src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    CON SESION
                    </a>
                    <a href="'.$r1.'/cerrar_sesion.php" class="btn btn-secondary" role="button">Cerrar Sesión</a>
                </div>
            </nav>
            '; 
        }else{
        $header='
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                    <img src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    NO SESION
                    </a>
                    <a href="'.$r1.'/iniciar_sesion.php" class="btn btn-secondary" role="button">Iniciar Sesión</a>
                </div>
            </nav>';
        }
        return $header;
    }

    function insert_nav($e1,$e2){
        if(isset($_SESSION["id"])){/* SESION */
            if($_SESSION["id"]===1){/* ADMIN */
                $nav='
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="'.$e1.'/index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$e2.'/recetas.php">Recetas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$e2.'/ranking.php">Ranking</a>
                    </li>
                </ul>
                ';
            }else{/* USER */
                $nav='
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="'.$e1.'/index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$e2.'/recetas.php">Recetas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$e2.'/ranking.php">Ranking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$e2.'/mi_perfil.php">Mi Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$e2.'/mi_menu.php">Mi Menú</a>
                    </li>
                </ul>
                ';
            }
        }else{/* NO SESION */
            $nav='
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="'.$e1.'/index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="'.$e2.'/recetas.php">Recetas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="'.$e2.'/ranking.php">Ranking</a>
                </li>
            </ul>
            ';
        }
        return $nav;
    }

    /* Pie de página Invariable */
    //<a href="'.$e2.'/editar_datos_user.php" class="btn btn-warning" role="button">Editar Datos</a>
    function insert_footer(){
        $foot='
        <footer>
            <div>
                <p>Redes Sociales</p>
                <div id="social">
                    <a><img></a>//TWITTER
                    <a><img></a>//INSTAGRAM
                    <a><img></a>//FACEBOOK
                </div>
            </div>
            <div>
                <a>Políticas de privacidad</a>
            </div>
            <div><a>Contacto</a></div>
        </footer>
        ';
        return $foot;
    }

    function conexion(){
        $conexion=new mysqli('localhost','root','','web_cocina');
        $conexion->set_charset('utf8');
        return $conexion;
    }

    /* INICIO DE SESION */ 
    function iniciar_sesion($nick,$pass){
        $conexion=conexion();
        $num_filas=0;
        $sentencia="select count(id_user) from usuario where nombre=? and contraseña=?";
        $consulta=$conexion->prepare($sentencia);
        $consulta->bind_param("ss",$nick,$pass);
        $consulta->bind_result($num_filas);
        $consulta->execute();
        $consulta->store_result();
        $consulta->fetch();
        $consulta->close();
        $conexion->close();
        return $num_filas;
    }

    /* CERRAR SESION */
    function cerrar_sesion(){
        $_SESSION=array();
        session_destroy();
        if(isset($_COOKIE['mantener'])){
            setcookie('mantener', null, -5, '/');
        }
    }
    /* REGISTRO */
    function registro($nick){
        $conexion=conexion();
        $num_filas=0;
        $sentencia="select count(id_user) from usuario where nombre=?";
        $consulta=$conexion->prepare($sentencia);
        $consulta->bind_param("s",$nick);
        $consulta->bind_result($num_filas);
        $consulta->execute();
        $consulta->store_result();
        $consulta->fetch();
        $consulta->close();
        $conexion->close();
        return $num_filas;
    }

    /* FUNCIONES DE MI PERFIL */
        // OBTENER FOTO DE PERFIL

        function obtener_foto($id){
            $conexion=conexion();
        $foto=null;
        $sentencia="select foto from usuario where id_user=?";
        $consulta=$conexion->prepare($sentencia);
        $consulta->bind_param("i",$id);
        $consulta->bind_result($foto);
        $consulta->execute();
        $consulta->store_result();
        $consulta->fetch();
        $consulta->close();
        $conexion->close();
        return $foto;
        }


    /* FUNCION FORMULARIO MODIFICAR USUARIO */
    function comprobar_nombre_user($nombre){
        $error=0;
        if(strlen($nombre)==0){
            $error=1;    
        }
        return $error;
        
    }

        
?>