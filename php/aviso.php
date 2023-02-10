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
    <title>Aviso legal y términos de uso</title>
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
                <div class='bloque_texto'>
                <h1>Aviso legal y términos de uso</h1>
                <p>
                    En este espacio, el USUARIO, podrá encontrar toda la información relativa a
                    los términos y condiciones legales que definen las relaciones entre los
                    usuarios y nosotros como responsables de esta web. Como usuario, es importante
                    que conozcas estos términos antes de continuar tu navegación.
                    DunCocina .Como responsable de esta web, asume el compromiso de procesar la
                    información de nuestros usuarios y clientes con plenas garantías y cumplir con
                    los requisitos nacionales y europeos que regulan la recopilación y uso de
                    los datos personales de nuestros usuarios. Esta web, por tanto, cumple
                    rigurosamente con el RGPD (REGLAMENTO (UE) 2016/679 de protección de datos)
                    y la LSSI-CE la Ley 34/2002, de 11 de julio, de servicios de la sociedad de
                    la información y de comercio electrónico.
                </p>
                <h3>CONDICIONES GENERALES DE USO</h3>
                <p>
                    Las presentes Condiciones Generales regulan el uso
                    (incluyendo el mero acceso) de las páginas de la web,
                    integrantes del sitio web de DunCocina incluidos los contenidos y
                    servicios puestos a disposición en ellas. Toda persona que acceda a
                    la web, DunCocina (“Usuario”) acepta someterse a las Condiciones
                    Generales vigentes en cada momento del portal DunCocina.
                </p>
                <h3>DATOS PERSONALES QUE RECABAMOS Y CÓMO LO HACEMOS</h3>
                <p>
                    Leer <a href='politicas.php'>Política de Privacidad</a>
                </p>
                <h3>COMPROMISOS Y OBLIGACIONES DE LOS USUARIOS</h3>
                <p>
                    El Usuario queda informado, y acepta, que el acceso a la presente web
                    no supone, en modo alguno, el inicio de una relación comercial conDunCocina.
                    De esta forma, el usuario se compromete a utilizar el sitio Web,
                    sus servicios y contenidos sin contravenir la legislación vigente, la buena
                    fe y el orden público.
                    Queda prohibido el uso de la web, con fines ilícitos o lesivos, o que, de
                    cualquier forma, puedan causar perjuicio o impedir el normal funcionamiento
                    del sitio web. Respecto de los contenidos de esta web, se prohíbe: 
                    Su reproducción, distribución o modificación, total o parcial, a menos que
                    se cuente con la autorización de sus legítimos titulares; Cualquier vulneración
                     de los derechos del prestador o de los legítimos titulares; Su utilización
                     para fines comerciales o publicitarios.
                    
                    En la utilización de la web, DunCocina, el Usuario se compromete a no
                    llevar a cabo ninguna conducta que pudiera dañar la imagen, los intereses y
                    los derechos de DunCocina o de terceros o que pudiera dañar, inutilizar o
                    sobrecargar el portal (indicar dominio) o que impidiera, de cualquier forma,
                    la normal utilización de la web. No obstante, el Usuario debe ser consciente
                    de que las medidas de seguridad de los sistemas informáticos en Internet no
                    son enteramente fiables y que, por tanto DunCocina no puede garantizar la
                    inexistencia de virus u otros elementos que puedan producir alteraciones en
                    los sistemas informáticos (software y hardware) del Usuario o en sus
                    documentos electrónicos y ficheros contenidos en los mismos.
                </p>
                <h3>MEDIDAS DE SEGURIDAD</h3>
                <p>
                    Los datos personales comunicados por el usuario a DunCocina
                    pueden ser almacenados en bases de datos automatizadas o no, cuya
                    titularidad corresponde en exclusiva a DunCocina, asumiendo ésta
                    todas las medidas de índole técnica, organizativa y de seguridad que garantizan
                    la confidencialidad, integridad y calidad de la información contenida en las
                    mismas de acuerdo con lo establecido en la normativa vigente en protección de
                    datos.
                    La comunicación entre los usuarios y DunCocina utiliza un canal seguro,
                    y los datos transmitidos son cifrados gracias a protocolos a https, por tanto,
                    garantizamos las mejores condiciones de seguridad para que la confidencialidad
                    de los usuarios esté garantizada.
                </p>
                <h3>ENLACES EXTERNOS</h3>
                <p>
                    Las páginas de la web DunCocina, podría proporcionar enlaces a
                    otros sitios web propios y contenidos que son propiedad de terceros.
                    El único objeto de los enlaces es proporcionar al Usuario la
                    posibilidad de acceder a dichos enlaces. DunCocina no se
                    responsabiliza en ningún caso de los resultados que puedan derivarse
                    al Usuario por acceso a dichos enlaces.
                    Asimismo, el usuario encontrará dentro de este sitio, páginas,
                    promociones, programas de afiliados que acceden a los hábitos de
                    navegación de los usuarios para establecer perfiles. Esta información siempre es anónima y no se identifica al usuario.

                    La Información que se proporcione en estos Sitios patrocinado o
                    enlaces de afiliados está sujeta a las políticas de privacidad que
                    se utilicen en dichos Sitios y no estará sujeta a esta política de
                    privacidad. Por lo que recomendamos ampliamente a los Usuarios a
                    revisar detalladamente las políticas de privacidad de los enlaces de
                    afiliado.
                    El Usuario que se proponga establecer cualquier dispositivo técnico
                    de enlace desde su sitio web al portal DunCocina deberá obtener la
                    autorización previa y escrita de DunCocina El establecimiento del
                    enlace no implica en ningún caso la existencia de relaciones entre
                    DunCocina y el propietario del sitio en el que se establezca el enlace,
                    ni la aceptación o aprobación por parte de DunCocina de sus contenidos
                    o servicios.
                </p>

                <h3>CONTACTO</h3>
                <p>
                En caso de que cualquier Usuario tuviese alguna duda acerca de
                estas Condiciones legales o cualquier comentario sobre el portal
                DunCocina, por favor diríjase a xxxxxx@gmail.com

                De parte del equipo que formamos DunCocina te agradecemos el
                tiempo dedicado en leer este Aviso Legal
                </p>
            </main>
        ";
    echo insert_footer();
?>
</body>
</html>