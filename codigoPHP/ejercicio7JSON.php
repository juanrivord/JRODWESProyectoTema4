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
     * 7. Pagina web que toma datos de un fichero json y los añade a la tabla Departamento.
     */
    
    require_once '../config/configDBPDO.php';
    require_once '../core/231018libreriaValidacion.php';

    echo "<a href='../indexProyectoTema4.php'>⬅ Volver al inicio</a><br><br>";
    // Calculamos la ruta del archivo JSON en la carpeta tmp
    $rutaFicheroJSON = $_SERVER["DOCUMENT_ROOT"] . '/JRODWESProyectoTema4/tmp/departamentos.json';

    // Comprobamos si el archivo existe
    if (file_exists($rutaFicheroJSON)) {

        // Leetodo el contenido del archivo JSON como una unica cadena de texto
        // https://www.php.net/manual/es/function.file-get-contents.php
        $textoJSON = file_get_contents($rutaFicheroJSON);

        // Convierte el texto JSON a un array asociativo de PHP
        // https://www.php.net/manual/es/function.json-decode.php
        $aDepartamentos = json_decode($textoJSON, true);

        // Verificamos que el JSON no este vacio y sea un array valido
        if (is_array($aDepartamentos) && count($aDepartamentos) > 0) {

            require_once '../config/configDBPDO.php';

            try {
                // Instanciacion del objeto PDO
                $miDB = new PDO(HOST, USER, PASSWORD);

                // Iniciamos la transaccion para asegurar que o se importan todos, o ninguno
                $miDB->beginTransaction();

                // Preparamos la consulta de insercion
                $sqlInsert = <<<sql
                        INSERT INTO T02_Departamento (
                        T02_CodDepartamento,
                        T02_DescDepartamento,
                        T02_FechaCreacionDepartamento,
                        T02_VolumenDeNegocio,
                        T02_FechaBajaDepartamento)
                        VALUES (
                        :CodDepartamento,
                        :DescDepartamento,
                        :FechaCreacionDepartamento,
                        :VolumenDeNegocio,
                        :FechaBajaDepartamento);
                        sql;

                $registrosImportados = 0;

                // Recorremos cada departamento del array 
                foreach ($aDepartamentos as $departamento) {

                    // Extraemos los valores.
                    $codigo = $departamento['CodDepartamento'];
                    $descripcion = $departamento['DescDepartamento'];
                    $fechaAlta = $departamento['FechaCreacionDepartamento'];
                    $volumen = $departamento['VolumenDeNegocio'];
                    // Si FechaBaja esta vacia, le asignamos null.
                    $fechaBaja = (!empty($departamento['FechaBajaDepartamento'])) ? $departamento['FechaBajaDepartamento'] : null;

                    // Ejecutamos la consulta preparada pasando un array asociativo con los nombres de los campos
                    $sentenciaPreparada->execute([
                        ':CodDepartamento' => $codigo,
                        ':DescDepartamento' => $descripcion,
                        ':FechaCreacionDepartamento' => $fechaAlta,
                        ':VolumenDeNegocio' => $volumen,
                        ':FechaBajaDepartamento' => $fechaBaja
                    ]);

                    $registrosImportados++;
                }

                // Si el bucle termina sin errores, confirmamos la transacción
                $miDB->commit();

                echo "<div class='mensaje-exito'>";
                echo "<h3>Importación completada con éxito.</h3>";
                echo "<p>Se han importado <b>{$registrosImportados}</b> departamentos desde el archivo JSON a la base de datos.</p>";
                echo "</div>";
            } catch (PDOException $miExceptionPDO) {
                // Si ocurre un error, deshacemos todos los cambios
                $miDB->rollBack();

                echo "<div class='error'>";
                echo "<h3 style='margin-top:0;'>Error al importar en la base de datos.</h3>";
                echo "<p>La transaccion ha sido cancelada. Ningun registro ha sido importado.</p>";
                echo "<p><b>Mensaje:</b> " . $miExceptionPDO->getMessage() . "</p>";
                echo "<p><b>Código:</b> " . $miExceptionPDO->getCode() . "</p>";
                echo "</div>";
            } finally {
                unset($miDB);
            }
        }
    }
        ?>

</body>
<footer>
    <address>
        <p>&copy; 2025-2026 <span><a href="../../index.html">Juan Rivera Ordoñez</a></span>I.E.S. Los Sauces
</p>
        <a href="https://github.com/juanrivord/JRODWESProyectoTema4"><img src="../webroot/images/github.png"
                alt="Imagen de github"></a>
        <a href="../indexProyectoTema4.php"><img src="../webroot/images/casita.png" alt="Imagen de una casita"></a>
    </address>
</footer>

</html>