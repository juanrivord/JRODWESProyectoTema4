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
     * 8. Pagina web que toma datos de una BD y los pasa a un archivo JSON
     */
    require_once '../config/configDBPDO.php';
    require_once '../core/231018libreriaValidacion.php';

    echo "<a href='../indexProyectoTema4.php'>⬅ Volver al inicio</a><br><br>";

    try {
       
        //creacion de conexion 
        $miDB = new PDO(HOST, USER, PASSWORD); // Conexión PDO

        $sql = 'SELECT T02_CodDepartamento, T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenDeNegocio,T02_FechaBajaDepartamento FROM T02_Departamento';
        $consultaPreparada = $miDB->prepare($sql);
        $consultaPreparada->execute();

        if ($consultaPreparada->rowCount() > 0) {

        $aDepartamentos = [];

        // Recorremos los registros de la base de datos
        while ($oDepartamento = $consultaPreparada->fetchObject()) {
            // Añadimos cada departamento como un array asociativo dentro del array principal
            $aDepartamentos[] = [
                'CodDepartamento' => $oDepartamento->T02_CodDepartamento,
                'DescDepartamento' => $oDepartamento->T02_DescDepartamento,
                'FechaCreacionDepartamento' => $oDepartamento->T02_FechaCreacionDepartamento,
                'VolumenDeNegocio' => $oDepartamento->T02_VolumenDeNegocio,
                'FechaBajaDepartamento' => $oDepartamento->T02_FechaBajaDepartamento
            ];
        }
        // Convertimos el array a formato texto JSON
        // https://www.php.net/manual/es/function.json-encode.php
        $textoJSON = json_encode($aDepartamentos, JSON_PRETTY_PRINT);

        // Ruta completa absoluta para que el servidor guarde el archivo
        $rutaFicheroGuardar = $_SERVER["DOCUMENT_ROOT"] . '/JRODWESProyectoTema4/tmp/' . 'departamentos.json';

        // Guardamos el texto JSON en el archivo
        // https://www.php.net/manual/es/function.file-put-contents.php
        $jsonGenerado = file_put_contents($rutaFicheroGuardar, $textoJSON);

        if ($jsonGenerado !== false) {
            // Ruta absoluta web que el navegador necesita para encontrar el archivo
            $rutaEnlaceWeb = '/JRODWESProyectoTema4/tmp/departamentos.json';

            // Mostramos el mensaje y el enlace web
            echo "<div class='mensaje-exito'>";
            echo "<h3>Exportacion completada con exito.</h3>";
            echo "<p>El archivo se ha guardado en: <b>{$rutaFicheroGuardar}</b></p>";
            echo "<a href='../tmp/departamentos.json' target='_blank' style='color: #155724; font-weight: bold; text-decoration: underline;'>Ver archivo JSON</a>";
            echo "</div>";
        } else {
            echo "<div class='error'>Error: No se pudo escribir el archivo JSON. Verifica los permisos de la carpeta.</div>";
        }
                    
        }else{
            echo "<div class='error'>Error: No se pudo escribir el archivo JSON. Verifica los permisos de la carpeta.</div>";
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