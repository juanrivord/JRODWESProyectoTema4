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
     * 6. Pagina web que carga registros en la tabla departamento desde un array
     */
    require_once '../config/configDBPDO.php';
    require_once '../core/231018libreriaValidacion.php';

    echo "<a href='../indexProyectoTema4.php'>⬅ Volver al inicio</a><br><br>";

    try {
        //declaracion de variables de cuando se muestra la tabla
        $fechaCreacionDepartamento;
        $fechaBajaDepartamento;
        $fechaActual = new DateTime();
        //creacion de conexion 
        $miDB = new PDO(HOST, USER, PASSWORD); // Conexión PDO

        //array de datos de departamentos
        //codigo, descripcion, fecha alta, volumen
        $aDepartamentosnuevos = [
            [
                ":codDepartamento" => "DDD",
                ":desDepartamento" => "descripcion a",
                ":fechaAltaDepartamento" => "2025-05-07",
                ":volumenNegocioDepartamento" => 33456.36,
                ":fechaBajaDepartamento" => null,
            ],
            [
                ":codDepartamento" => "EEE",
                ":desDepartamento" => "descripcion b",
                ":fechaAltaDepartamento" => "2020-05-07",
                ":volumenNegocioDepartamento" => 10.43,
                ":fechaBajaDepartamento" => $fechaActual->format("Y-m-d"),
            ],
            [
                ":codDepartamento" => "FFF",
                ":desDepartamento" => "descripcion c",
                ":fechaAltaDepartamento" => $fechaActual->format("Y-m-d"),
                ":volumenNegocioDepartamento" => 480000.01,
                ":fechaBajaDepartamento" => null,
            ]
        ];

        //insercion con consulta preparada
        //iniciamos consulta dentro de un heredoc
        
        $sqlInsert = <<<sql
                    INSERT INTO T02_Departamento VALUES (
                    :codDepartamento,
                    :desDepartamento,
                    :fechaAltaDepartamento,
                    :volumenNegocioDepartamento,
                    :fechaBajaDepartamento)
                    sql;

        //preparamos la insercion
        $insercionDepartamento = $miDB->prepare($sqlInsert);

        foreach ($aDepartamentosnuevos as $aDatosCadaDepartamento) {
            //ejecutar la insercion
            $insercionDepartamento->execute($aDatosCadaDepartamento);
        }

        echo "<h4>Insercion Completa</h4> <br/>";

        //hacer query de la tabla
        $consulta1 = $miDB->query('select * from T02_Departamento');
        echo '<table>';
        // mostrar la tabla
        echo '<tr class="titulo"> <td>Codigo</td> <td>Descripcion</td><td>FechaCreacion</td><td>VolumenNegocio</td><td>FechaBaja</td></tr>';
        while ($oDepartamento = $consulta1->fetchObject()) {
            echo '<tr>';
            echo '<td>' . $oDepartamento->T02_CodDepartamento . '</td>';
            echo '<td>' . $oDepartamento->T02_DescDepartamento . '</td>';
            $fechaCreacionDepartamento = new DateTime($oDepartamento->T02_FechaCreacionDepartamento);
            echo '<td>' . $fechaCreacionDepartamento->format('d/m/Y') . '</td>';
            echo '<td>' . number_format($oDepartamento->T02_VolumenDeNegocio, 2, ',', '.') . ' €</td>';
            if (is_null($oDepartamento->T02_FechaBajaDepartamento)) {
                echo '<td></td>';
            } else {
                $fechaBajaDepartamento = new DateTime($oDepartamento->T02_FechaBajaDepartamento);
                echo '<td>' . $fechaBajaDepartamento->format('d/m/Y') . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
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