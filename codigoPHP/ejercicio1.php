<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .azul{
                color:blue;
            }
            .rojo{
                color:red;
            }
        </style>
    </head>
    <body>

        <?php
        require_once '../core/231018libreriaValidacion.php'; 

        echo "<a href='../indexProyectoTema4.php'>⬅ Volver al inicio</a><br><br>";

        define("HOST","mysql:host=10.199.8.97;dbname=DBJRODWESProyectoTema4");
        define("USER","adminsql");
        define("PASSWORD","paso");

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
</html>