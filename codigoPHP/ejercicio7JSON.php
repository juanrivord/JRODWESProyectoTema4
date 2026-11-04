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
     * 7. Pagina web que toma datos de un fichero xml y los añade a la tabla Departamento.
     */
    
    require_once '../config/configDBPDO.php';
    require_once '../core/231018libreriaValidacion.php';

    echo "<a href='../indexProyectoTema4.php'>⬅ Volver al inicio</a><br><br>";

            // Calculamos la ruta del archivo XML en la carpeta tmp
            $rutaFicheroXML = $_SERVER["DOCUMENT_ROOT"] . '/JRODWESProyectoTema4/tmp/departamentos.xml';

            // Comprobamos si el archivo existe antes de intentar hacer nada
            if (file_exists($rutaFicheroXML)) {

                require_once '../config/configDBPDO.php';

                try {
                    // Instanciacion del objeto PDO
                    $miDB = new PDO(HOST, USER, PASSWORD);

                    // Instanciamos DOMDocument y cargamos el archivo XML
                    $documentoXML = new DOMDocument();
                    $documentoXML->load($rutaFicheroXML);

                    // Obtenemos una lista con todos los elementos departamento
                    $listaDepartamentosXML = $documentoXML->getElementsByTagName('departamento');

                    // Verificamos que el XML no este vacío
                    if ($listaDepartamentosXML->length > 0) {

                        // Iniciamos la transaccion para asegurar que o se importan todos, o ninguno
                        $miDB->beginTransaction();

                        // Preparamos la consulta de inserción con INSERT IGNORE para saltar duplicados
                        $sqlInsert = <<<sql
                        INSERT IGNORE INTO T02_Departamento (
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

                        $sentenciaPreparada = $miDB->prepare($sqlInsert);

                        $registrosImportados = 0;

                        // Recorremos cada departamento del XML
                        foreach ($listaDepartamentosXML as $departamento) {
                            // Comprobamos y obtenemos cada nodo de forma segura
                            $nodoCod = $departamento->getElementsByTagName('CodDepartamento')->item(0);
                            $nodoDesc = $departamento->getElementsByTagName('DescDepartamento')->item(0);
                            $nodoFechaCreacion = $departamento->getElementsByTagName('FechaCreacionDepartamento')->item(0);
                            $nodoVolumen = $departamento->getElementsByTagName('VolumenDeNegocio')->item(0);
                            $nodoFechaBaja = $departamento->getElementsByTagName('FechaBajaDepartamento')->item(0);

                            $codDepartamento = $nodoCod ? $nodoCod->nodeValue : '';
                            $desDepartamento = $nodoDesc ? $nodoDesc->nodeValue : '';
                            $fechaCreacionDepartamento = $nodoFechaCreacion ? $nodoFechaCreacion->nodeValue : null;
                            $volumenDeNegocio = $nodoVolumen ? $nodoVolumen->nodeValue : 0;
                            
                            $fechaBajaComprobada = ($nodoFechaBaja && trim($nodoFechaBaja->nodeValue) !== '') ? $nodoFechaBaja->nodeValue : null;

                            // Ejecutamos la consulta preparada
                            $sentenciaPreparada->execute([
                                ':CodDepartamento' => $codDepartamento,
                                ':DescDepartamento' => $desDepartamento,
                                ':FechaCreacionDepartamento' => $fechaCreacionDepartamento,
                                ':VolumenDeNegocio' => $volumenDeNegocio,
                                ':FechaBajaDepartamento' => $fechaBajaComprobada
                            ]);

                            // rowCount() devuelve 1 si se insertó, o 0 si se ignoró por clave duplicada
                            if ($sentenciaPreparada->rowCount() > 0) {
                                $registrosImportados++;
                            }
                        }

                        // Si el bucle termina sin errores, confirmamos la transacción
                        $miDB->commit();

                        echo "<div class='mensaje-exito'>";
                        echo "<h3>Importación completada con éxito.</h3>";
                        echo "<p>Se han importado <b>{$registrosImportados}</b> nuevos departamentos desde el archivo XML a la base de datos (los duplicados se han omitido).</p>";
                        echo "</div>";
                    } else {
                        echo "<div class='error'>El archivo XML esta vacio o no tiene el formato correcto.</div>";
                    }
                } catch (PDOException $miExceptionPDO) {
                    // Si ocurre un error diferente, deshacemos todos los cambios
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
            }else{
                echo("No existe el fichero departamento.xml");
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