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
    <title>Políticas de Cookies</title>
    <link href="../estilos/estilos.css" rel="stylesheet">
    <script type="text/Javascript" src="../app/app.js?1.1" defer></script>
</head>
<body id='pagina_texto'>
    <?php
        require('funciones.php');

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
                $i="../";
                echo insert_cab($r1,$i);
                echo insert_nav($e1,$e2);
            }else{
                $r1=".";
                $e1="..";
                $e2=".";
                $i="../";
                echo insert_cab($r1,$i);
                echo insert_nav($e1,$e2);
            }
        }else{
            $r1=".";
            $e1="..";
            $e2=".";
            $i="../";
            echo insert_cab($r1,$i);
            echo insert_nav($e1,$e2);
        }

        /* COMO ES UN TEXTO DE AVISO,
        ES LEGIBLE PARA TODOS LOS USUARIOS */

        echo"
            <main id='texto'>
                <h1>Política de cookies</h1>
                <p>
                    En esta web se utilizan cookies propias para
                    conseguir que tengas una mejor experiencia de navegación,
                    puedas compartir contenido en redes sociales y para que podamos obtener
                    estadísticas de los usuarios.<br>
                    Puedes evitar la descarga de cookies a través de la
                    configuración de tu navegador, evitando que las cookies se
                    almacenen en su dispositivo.<br>
                    Como propietario de este sitio web, te comunico que no
                    utilizamos ninguna información personal procedente de cookies,
                    tan sólo realizamos estadísticas generales de visitas que no
                    suponen ninguna información personal.
                    Es muy importante que leas la presente política de cookies y
                    comprendas que, si continúas navegando, consideraremos que aceptas
                    su uso.

                    Según los términos incluidos en el artículo 22.2 de la Ley 34/2002
                    de Servicios de la Sociedad de la Información y Comercio
                    Electrónico, si continúas navegando, estarás prestando tu
                    consentimiento para el empleo de los referidos mecanismos.
                </p>
                <h3>Entidad Responsable</h3>
                <p>
                    La entidad responsable de la recogida, procesamiento y
                    utilización de tus datos personales, en el sentido establecido
                    por la Ley de Protección de Datos Personales es la página
                    DunCocina, propiedad de Marcos.
                </p>
                <h3>¿Qué son las cookies?</h3>
                <p>
                    Las cookies son un conjunto de datos que un
                    servidor deposita en el navegador del usuario para recoger
                    la información de registro estándar de Internet y la
                    información del comportamiento de los visitantes en un sitio
                    web. Es decir, se trata de pequeños archivos de texto que
                    quedan almacenados en el disco duro del ordenador y que sirven
                    para identificar al usuario cuando se conecta nuevamente al
                    sitio web. Su objetivo es registrar la visita del usuario y
                    guardar cierta información. Su uso es común y frecuente en la
                    web ya que permite a las páginas funcionar de manera más
                    eficiente y conseguir una mayor personalización y análisis
                    sobre el comportamiento del usuario.
                </p>
                <h3>Cookies de registro</h3>
                <p>
                    Las cookies de registro se generan una vez que el usuario
                    se ha registrado o posteriormente ha abierto su sesión, y
                    se utilizan para identificarle en los servicios con los siguientes
                    objetivos:
                    
                    Mantener al usuario identificado de forma que,
                    si cierra un servicio, el navegador o el ordenador y en otro
                    momento u otro día vuelve a entrar en dicho servicio, seguirá identificado,
                    facilitando así su navegación sin tener que volver a identificarse.
                    Esta funcionalidad se puede suprimir si el usuario pulsa la funcionalidad
                    [cerrar sesión], de forma que esta cookie se elimina y la próxima vez que
                    entre en el servicio el usuario tendrá que iniciar sesión para estar
                    identificado.
                    
                    Comprobar si el usuario está autorizado para acceder a ciertos servicios,
                    por ejemplo, para participar en un concurso.
                    
                    Adicionalmente, algunos servicios pueden utilizar conectores con redes
                    sociales tales como Facebook o Twitter. Cuando el usuario se registra en
                    un servicio con credenciales de una red social, autoriza a la red social
                    a guardar una Cookie persistente que recuerda su identidad y le garantiza
                    acceso a los servicios hasta que expira. El usuario puede borrar esta Cookie
                    y revocar el acceso a los servicios mediante redes sociales
                    actualizando sus preferencias en la red social que específica.
                </p>
                <h3>Plazo de Conservación de los Datos</h3>
                <p>
                    Marcos conservará los datos personales de los usuarios
                    únicamente durante el tiempo necesario para la realización de
                    las finalidades para las que fueron recogidos, mientras no revoque
                    los consentimientos otorgados. Posteriormente, en caso de ser necesario,
                    mantendrá la información bloqueada durante los plazos legalmente
                    establecidos.
                </p>
                <h3>Actualizaciones y cambios en la política de
                privacidad/cookies</h3>
                <p>
                    Las webs de DunCocina pueden modificar esta
                    Política de Cookies en función de exigencias legislativas,
                    reglamentarias, o con la finalidad de adaptar dicha política a las instrucciones dictadas por la Agencia Española de Protección de Datos, por ello se aconseja a los usuarios que la visiten periódicamente.

                    Cuando se produzcan cambios significativos en esta Política
                    de Cookies, estos se comunicarán a los usuarios bien mediante 
                    a web o a través de correo electrónico a los usuarios registrados.
                </p>

                
            </main>
        ";
    echo insert_footer();
?>
</body>
</html>