<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 2</title>
        <link rel="stylesheet" href="../webroot/css/style.css">
        <style>
            h3{text-align: center;}
        </style>
    </head>
    <header id="inicio">
            <img src="../webroot/images/logo.png" alt="Logo de I.E.S. Los Sauces" class="logo">
        <h1>TEMA 4: Técnicas de acceso a datos en PHP</h1>
    </header>
    <body>

        <?php
        require_once '../core/231018libreriaValidacion.php';
        require_once '../config/configDBPDO.php';

        echo "<a href='../indexProyectoTema4.php'>⬅ Volver al inicio</a><br><br>";


        // CONEXION ACERTADA
        try{
            $miDB = new PDO(HOST,USER,PASSWORD);
            echo "<h2>CONSULTAS DIRECTAS</h2><br>";

            $consulta = $miDB->query("SELECT * FROM T02_Departamento");
            // $numRegistros = 0; ES MEJOR USAR rowCount()

            echo "<h3>DEPARTAMENTOS</h3>";
            echo '<table>';
            echo '<thead>';
            echo '<th>Código</th>';
            echo '<th>Descripción</th>';
            echo '<th>Fecha de creación</th>';
            echo '<th>Volumen de negocio</th>';
            echo '<th>Fecha de baja</th>';                       
            echo '</thead>';
            while ($registro = $consulta->fetchObject()) {
                echo("<tr>");
                echo("<td>".$registro->T02_CodDepartamento."</td>");
                echo("<td>".$registro->T02_DescDepartamento."</td>");
                // Construimos la fecha a partir de la que hay en la base de datos, una nueva por cada vez que sacamos una fecha
                $oFechaAlta = new DateTime($registro->T02_FechaCreacionDepartamento);
                // La mostramos formateada
                echo("<td>".$oFechaAlta->format('d/m/Y')."</td>");
                // Formateamos el numero para que se vea en euros €
                echo("<td>".number_format($registro->T02_VolumenDeNegocio,2,',','.')."€</td>");
                // Si la fecha esta vacia no la creamos, en cambio si exite, creamos el objeto de fecha
                if (is_null($registro->T02_FechaBajaDepartamento)) {
                    echo '<td>No definida</td>';
                } else {
                    $oFechaBaja = new DateTime($registro->T02_FechaBajaDepartamento);
                    echo '<td>'.$oFechaBaja->format('d/m/Y').'</td>';
                }
                echo("</tr>");
            }

            echo("</table>");

            echo("<strong>Numero de filas: </strong>".$consulta->rowCount());


           
            
        } catch (PDOException $e) {
            echo "ERROR: ".$e->getMessage()."<br/>";
        } finally{
            unset($miDB);
        }

        ?>
        
    </body>
    <footer>
        <address>
            <p>&copy; 2025-2026 <span><a href="../indexProyectoTema4.php">Juan Rivera Ordoñez</a></span>- I.E.S. Los Sauces</p>
            <p><a href="https://github.com/juanrivord/JRODWESProyectoTema4"><img src="../webroot/images/github.png" alt="Imagen de github"></a></p>
        </address>
    </footer>
</html>