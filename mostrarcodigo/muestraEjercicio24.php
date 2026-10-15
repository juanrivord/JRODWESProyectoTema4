<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $archivo = '../codigoPHP/ejercicio24.php';
 
        if ($archivo && file_exists($archivo) ) {
        echo "<a href='../indexProyectoTema3.php'>⬅ Volver al inicio</a><hr>";
        echo "<h2>Viendo el codigo de: " . htmlspecialchars($archivo) . "</h2>";
        highlight_file($archivo);
        // funcion nativa de PHP, lee el archivo y lo imprime con colores.
        
        } else {
        echo "<h2>Error: El archivo no existe.</h2>";
        echo "<a href='../indexProyectoTema3.php'>⬅ Volver al inicio</a>";
        }
        ?>
    </body>
</html>
