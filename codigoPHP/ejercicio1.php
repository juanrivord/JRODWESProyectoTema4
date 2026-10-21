<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 1</title>
        <link rel="stylesheet" href="../webroot/css/style.css">
        <style>
            .azul{
                color:blue;
            }
            .rojo{
                color:red;
            }
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

        $aAtributosConexion = [
            'AUTOCOMMIT', 'ERRMODE' , 'CASE' , 'CLIENT_VERSION', 'CONNECTION_STATUS',
            'ORACLE_NULLS', 'PERSISTENT', 'PREFETCH', 'SERVER_INFO', 'SERVER_VERSION', 'TIMEOUT'
        ];


        // CONEXION ACERTADA
        try{
            $miDB = new PDO(HOST,USER,PASSWORD);
            echo "Conectado a MariaDB con exito!<br/><br>";
            echo $miDB->getAttribute(PDO::ATTR_CONNECTION_STATUS)."<br/>";
            echo $miDB->getAttribute(PDO::ATTR_FETCH_TABLE_NAMES)."<br/>";
            echo $miDB->getAttribute(PDO::ATTR_SERVER_VERSION)."<br/>";

            foreach ($aAtributosConexion as $atributo) {
                echo "PDO: ATTR: ".$atributo.": ";
                try {
                    echo '<span class="azul">'.$miDB->getAttribute( constant( "PDO::ATTR_$atributo" ) ) . "</span><br>";
                } catch ( PDOException $miExceptionPDO ) {
                    echo '<span class="rojo"> <b>Error: </b>'.$miExceptionPDO->getMessage().' <b>con código de error:</b> '.$miExceptionPDO->getCode()."</span><br>";
                }
            }

            
        } catch (PDOException $e) {
            echo "ERROR: ".$e->getMessage()."<br/>";
        } finally{
            unset($miDB);
        }


        echo "<hr>";


        // PRUEBA DE MALA CONEXION
        try{
            $miDB = new PDO(HOST,USER,"incorecto");
            echo "Conectado a MariaDB <br/><br>";

        } catch (PDOException $e) {
            echo "ERROR: No se pudo conectar a MariaDB!<br/><br>";
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