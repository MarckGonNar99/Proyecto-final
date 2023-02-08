<?php

    /* Funcion de insertar cabecera Y navegador*/
    function insert_cab($r1){
         if(isset($_SESSION["id"])){
            $header='
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <a id="logoEnlace" class="navbar-brand" href="#">
                    <img src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    <p id="logo">DunCocina</p>
                    </a>
                    <a id="sesionBoton" href="'.$r1.'/cerrar_sesion.php" class="btn btn-danger" role="button">Cerrar Sesión</a>
                </div>
            </nav>
            '; 
        }else{
        $header='
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <a id="logoEnlace" class="navbar-brand" href="#">
                    <img src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    <p id="logo">DunCocina</p>
                    </a>
                    <a id="sesionBoton" href="'.$r1.'/iniciar_sesion.php" class="btn btn-success" role="button">Iniciar Sesión</a>
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
                        <li>
                            <a class="nav-link" href="'.$e1.'/index.php">Inicio</a>
                        </li>
                        <li>
                            <a class="nav-link" href="'.$e2.'/recetas.php">Recetas</a>
                        </li>
                        <li>
                            <a class="nav-link" href="'.$e2.'/ranking.php">Ranking</a>
                        </li>
                        <li>
                            <a class="nav-link" href="'.$e2.'/lista_reporte.php">Reportes</a>
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
    function insert_footer_index(){
        $foot='
        <footer id="footer_index">
            <div>
                <div class="social">
                <p>Redes Sociales</p>
                    <a href="https://twitter.com/?lang=es"><img class="red" src="imagenes/otro/twitter.png">Twitter</a>
                    <a href="https://www.instagram.com/"><img class="red" src="imagenes/otro/insta.png">Instagram</a>
                    <a href="https://es-la.facebook.com/"><img class="red" src="imagenes/otro/face.png">Facebook</a>
                </div>
            </div>
            <div class="social">
                <a href="php/politicas.php">Políticas de privacidad</a>
                <a href="php/cookies.php">Política de Cookies</a>
                <a href="php/aviso.php">Aviso legal y términos de uso</a>
            </div>
            <div class="social">
                <p>Contacto con el creador</p>
                <a href="https://twitter.com/?lang=es"><img class="red" src="imagenes/otro/twitter.png">Twitter</a>
                <a href="https://www.instagram.com/"><img class="red" src="imagenes/otro/insta.png">Instagram</a>
                <a href="https://github.com/"><img class="red" src="imagenes/otro/git.png">Git</a>
            </div>
        </footer>
        ';
        return $foot;
    }
    function insert_footer(){
        $foot='
        <footer id="pie_pagina">
            <div>
                <div class="social">
                <p>Redes Sociales</p>
                    <a href="https://twitter.com/?lang=es"><img class="red" src="../imagenes/otro/twitter.png">Twitter</a>
                    <a href="https://www.instagram.com/"><img class="red" src="../imagenes/otro/insta.png">Instagram</a>
                    <a href="https://es-la.facebook.com/"><img class="red" src="../imagenes/otro/face.png">Facebook</a>
                </div>
            </div>
            <div class="social">
                <a href="politicas.php">Políticas de privacidad</a>
                <a href="cookies.php">Política de Cookies</a>
                <a href="aviso.php">Aviso legal y términos de uso</a>
            </div>
            <div class="social">
                <p>Contacto con el creador</p>
                <a href="https://twitter.com/?lang=es"><img class="red" src="../imagenes/otro/twitter.png">Twitter</a>
                <a href="https://www.instagram.com/"><img class="red" src="../imagenes/otro/insta.png">Instagram</a>
                <a href="https://github.com/"><img class="red" src="../imagenes/otro/git.png">Git</a>
            </div>
        </footer>
        ';
        return $foot;
    }

    function insert_cookies(){
        echo"
        <div class='cookie-container'>
            <div class='cookie-content'>
                Para mejorar al máximo tu experiencia, esta web utiliza cookies. Si utilizas la web significa que estás de acuerdo con que usemos cookies. Hemos publicado una nueva política de cookies,
                que deberás leer para entender mejor cuáles son las cookies que utilizamos.
                <div class='buttons'>
                    <button class='boton_acepto'>Acepto las galletas</button>
                    <a class='item' href='php/cookies.php' target='_blank'>Leer más</a>
                </div> 
            </div> 
        </div>
        ";
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