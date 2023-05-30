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
    <title>Políticas de Privacidad</title>
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
                <h1>PRIVACIDAD</h1>
                <h3>Responsable</h3>
                <p>
                   Marcos González Naranjo - xxxxx@gmail.com - DunCocina
                </p>
                <h3>Finalidades</h3>
                <p>
                En cumplimiento de lo dispuesto en el Reglamento Europeo 2016/679 General
                de Protección de Datos, te informamos de que trataremos los datos que nos
                facilitas para:
                <ul>
                    <li>Dar cumplimiento a las obligaciones legalmente establecidas, así como verificar el cumplimiento de las obligaciones contractuales, incluía la prevención de fraude.</li>
                    <li>Cesión de datos a organismos y autoridades, siempre y cuando sean requeridos de conformidad con las disposiciones legales y reglamentarias.</li>
                </ul>
                </p>
                <h3>Categorías de datos</h3>
                <p>
                Derivada de las finalidades antes mencionadas, en DunCocina gestionamos
                las siguientes categorías de datos:
                <ul>
                    <li>Datos identificativos</li>
                    <li>Metadatos de comunicaciones electrónicas</li>
                </ul>
                </p>
                <h3>Legitimación</h3>
                <p>
                    Además, la legitimación para el tratamiento de los datos
                    relacionados con ofertas o colaboraciones se basan en el
                    consentimiento del usuario que remite sus datos, que puede retirar en cualquier
                    momento, si bien ello puede afectar a la posible comunicación de forma
                    fluida y obstrucción de procesos que desea realizar.
                    Por último, los datos se podrán utilizar para dar cumplimiento a
                    las obligaciones legales aplicables a Marcos
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
                <h3>Destinatarios</h3>
                <p>
                    También podrán ser cedidos a las Fuerzas y
                    Cuerpos de Seguridad del Estado en los casos que exista
                    una obligación legal.
                </p>

                <h3>Seguridad de la Información</h3>
                <p>
                    Para proteger las diferentes tipologías de datos reflejados en
                    esta política de privacidad llevará a cabo las medidas de
                    seguridad técnicas necesarias para evitar su pérdida, manipulación,
                    difusión o alteración.
                </p>
                <h3>Derechos</h3>
                <p>
                    Tienes derecho a obtener confirmación sobre si Marcos esta tratando
                    datos personales que te conciernan, o no.
                    Asimismo, tienes derecho a acceder a tus datos personales,
                    así como a solicitar la rectificación de los datos inexactos o,
                    en su caso, solicitar su supresión cuando, entre otros motivos, los
                    datos ya no sean necesarios para los fines que fueron recogidos.<br>
                    
                    En determinadas circunstancias, podrás solicitar la limitación del
                    tratamiento de tus datos, en cuyo caso únicamente los conservaremos para
                    el ejercicio o la defensa de reclamaciones.
                    En determinadas circunstancias y por motivos relacionados con tu situación
                    particular, podrás oponerte al tratamiento de tus datos. Marcos dejará de
                    tratar los datos, salvo por motivos legítimos imperiosos, o el ejercicio o
                    la defensa de posibles reclamaciones.<br>

                    Asimismo, puedes ejercer el derecho a la portabilidad de los datos, así como
                    retirar los consentimientos facilitados en cualquier momento, sin que ello
                    afecte a la licitud del tratamiento basado en el consentimiento previo a su
                    retirada.<br>

                    Si deseas hacer uso de cualquiera de tus derechos puede dirigirse a
                    xxxxxx@gmail.com.<br>

                    Por último, te informamos que puedes dirigirte ante la
                    Agencia Española de Protección de Datos y demás organismos
                    públicos competentes para cualquier reclamación derivada del
                    tratamiento de tus datos personales.
                </p>
            </main>
        ";
    echo insert_footer();
?>
</body>
</html>