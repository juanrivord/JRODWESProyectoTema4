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

    try {
       
        //creacion de conexion 
        $miDB = new PDO(HOST, USER, PASSWORD); // Conexión PDO
        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
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