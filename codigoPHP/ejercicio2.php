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
            echo "<h2>CONSULTAS DIRECTAS</h2><br/><br>";

            // FETCH OBJECT

            $consulta = $miDB->query("SELECT * FROM T02_Departamento");
            // $numRegistros = 0; ES MEJOR USAR rowCount()

            while ($registro = $consulta->fetchObject()) {
                echo("<strong>Codigo: </strong>".$registro->T02_CodDepartamento."<br>");
            }




           
            
        } catch (PDOException $e) {
            echo "ERROR: ".$e->getMessage()."<br/>";
        } finally{
            unset($miDB);
        }


        echo "<hr>";


        // PRUEBA DE CONSULTA PREPARADA
        try{
            $miDB = new PDO(HOST,USER,PASSWORD);
            echo "<h2>CONSULTAS PREPARADAS</h2><br/><br>";

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