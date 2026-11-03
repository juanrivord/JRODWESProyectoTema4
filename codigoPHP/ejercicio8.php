<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4</title>
    <link rel="stylesheet" href="../webroot/css/style.css">
    <style>
        h3 {
            text-align: center;
        }
    </style>
</head>
<header id="inicio">
    <img src="../webroot/images/logo.png" alt="Logo de I.E.S. Los Sauces" class="logo">
    <h1>TEMA 4: Técnicas de acceso a datos en PHP</h1>
</header>

<body>

    <?php
    /* 
     * Juan Rivera Ordoñez
     * 03/11/2026
     * 8. Pagina web que toma datos de una BD y los pasa a un archivo XML
     */
    require_once '../config/configDBPDO.php';
    require_once '../core/231018libreriaValidacion.php';

    echo "<a href='../indexProyectoTema4.php'>⬅ Volver al inicio</a><br><br>";

    try {
       
        //creacion de conexion 
        $miDB = new PDO(HOST, USER, PASSWORD); // Conexión PDO
        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT T02_CodDepartamento, T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenDeNegocio,T02_FechaBajaDepartamento FROM T02_Departamento';
        $consultaPreparada = $miDB->prepare($sql);
        $consultaPreparada->execute();

        if ($consultaPreparada->rowCount() > 0) {

            // Instanciamos el objeto DOMDocument (versión 1.0, codificación UTF-8)
            $documentoXML = new DOMDocument('1.0', 'UTF-8');
            // Formatear la salida para que el XML tenga saltos de línea (sea legible)
            $documentoXML->formatOutput = true;

            // Creamos el elemento raiz departamentos y lo añadimos al documento
            // Crea un nuevo nodo elemento: https://www.php.net/manual/es/domdocument.createelement.php
            $raiz = $documentoXML->createElement('departamentos');
            
            // Añade un nuevo hijo al final de los hijos: https://www.php.net/manual/es/domnode.appendchild.php
            $documentoXML->appendChild($raiz);

            // Recorremos los registros de la base de datos
            while ($oDepartamento = $consultaPreparada->fetchObject()) {

                // Creamos el departamento para cada registro
                // Uso de createElement: https://www.php.net/manual/es/domdocument.createelement.php
                $sDepartamento = $documentoXML->createElement('departamento');

                // Creamos el codigo, añadimos el texto y lo colgamos de departamento
                $sCodigo = $documentoXML->createElement('CodDepartamento');
                $sCodigo->appendChild($documentoXML->createTextNode($oDepartamento->T02_CodDepartamento));
                $sDepartamento->appendChild($sCodigo);

                // Creamos la descripcion, añadimos el texto y lo colgamos de departamento
                $sDescripcion = $documentoXML->createElement('DescDepartamento');
                $sDescripcion->appendChild($documentoXML->createTextNode($oDepartamento->T02_DescDepartamento));
                $sDepartamento->appendChild($sDescripcion);

                // Creamos la fecha de creacion, añadimos la fecha y lo colgamos de departamento
                $sFechaCreacion = $documentoXML->createElement('FechaCreacionDepartamento');
                $sFechaCreacion->appendChild($documentoXML->createTextNode($oDepartamento->T02_FechaCreacionDepartamento));
                $sDepartamento->appendChild($sFechaCreacion);
                
                // Creamos el volumen, añadimos el texto y lo colgamos de departamento
                $sVolumen = $documentoXML->createElement('VolumenDeNegocio');
                $sVolumen->appendChild($documentoXML->createTextNode($oDepartamento->T02_VolumenDeNegocio));
                $sDepartamento->appendChild($sVolumen); 

                // Creamos la fecha de creacion, añadimos la fecha y lo colgamos de departamento
                $sFechaBaja = $documentoXML->createElement('FechaBajaDepartamento');
                $sFechaBaja->appendChild($documentoXML->createTextNode($oDepartamento->T02_FechaBajaDepartamento));
                $sDepartamento->appendChild($sFechaBaja);

                // Colgamos el departamento completo de la raiz departamentos
                $raiz->appendChild($sDepartamento);
            }

            // Preparamos el directorio /tmp/
            $directorioTMP = dirname($_SERVER['DOCUMENT_ROOT']) . 'JRODWESProyectoTema4/tmp/';

            // Ruta completa absoluta para que el servidor guarde el archivo
            $rutaFicheroGuardar = $directorioTMP . 'departamentos.xml';

            // Guardamos el archivo XML generado en el servidor
            // Guarda el documento XML en un fichero: https://www.php.net/manual/es/domdocument.save.php
            $documentoXML->save($rutaFicheroGuardar);

            // Ruta relativa que el navegador necesita para encontrar el archivo desde 'codigoPHP'
            $rutaEnlaceWeb = '../tmp/departamentos.xml';

            // Mostramos el mensaje y el enlace web
            echo "<div class='mensaje-exito'>";
            echo "<h3>Exportacion completada con exito.</h3>";
            echo "<p>El archivo se ha guardado en: <b>{$rutaFicheroGuardar}</b></p>";
            echo "<a href='{$rutaEnlaceWeb}' target='_blank' style='color: #155724; font-weight: bold; text-decoration: underline;'>Ver archivo XML</a>";
            echo "</div>";                              
        }

        
    } catch (PDOException $e) {
        echo "<span style='color:red;'> Codigo de error: " . $e->getCode() . " <span><br/>";
        echo "<span style='color:red;'> Mensaje de error: " . $e->getMessage() . " <span><br/>";
    } finally {
        unset($miDB);
    }
    ?>

</body>
<footer>
    <address>
        <p>&copy; 2025-2026 <span><a href="../../index.html">Juan Rivera Ordoñez</a></span>- I.E.S. Los Sauces</p>
        <a href="https://github.com/juanrivord/JRODWESProyectoTema4"><img src="../webroot/images/github.png"
                alt="Imagen de github"></a>
        <a href="../indexProyectoTema4.php"><img src="../webroot/images/casita.png" alt="Imagen de una casita"></a>
    </address>
</footer>

</html>