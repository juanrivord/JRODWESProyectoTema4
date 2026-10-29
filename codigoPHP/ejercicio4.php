<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 4</title>
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
        /* 
            * Juan Rivera Ordoñez
            * 29/10/2026
            * 4. Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos)
        */
        require_once '../core/231018libreriaValidacion.php'; // Libreria de validación utilizada
        require_once '../config/configDBPDO.php'; // Constantes mas utilizadas (conexion BD) y algunos parametros siempre utilizados

        echo "<a href='../indexProyectoTema4.php'>⬅ Volver al inicio</a><br><br>";

            //Inicializacion de variables

            $entradaOK = true; // Variable que nos indica que todo va bien

            //Array donde recogemos los mensajes de error
            $aError = [
                'departamentoABuscar' => ""];

            //Array donde recogemos la respuestas correctas
            $aRespuesta = [
                'departamentoABuscar' => ""];

            // Comprueba si el formulario se a enviado
            if (isset($_REQUEST["enviar"])) {
                // Validar Entrada
    
                $aError["departamentoABuscar"] = validacionFormularios::comprobarAlfabetico($_REQUEST["departamentoABuscar"],50,1,0);

                foreach ($aError as $value) {
                    if (!empty($value)) $entradaOK = false;
                }
            }

            // El formulario no se ha enviado nunca
            else {
                $entradaOK = false;
            }

            ?>

            <div class="buscador">
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <label for="departamentoABuscar" class="titulo-busqueda">Mantenimiento de Departamentos</label><br>

                        <input type="text" name="departamentoABuscar" id="departamentoABuscar" placeholder="Descripción (vacío busca todos)" value="<?php echo isset($_REQUEST['departamentoABuscar']) ? htmlspecialchars($_REQUEST['departamentoABuscar']) : ''; ?>">
                        <span class="error"><?php echo $aError['departamentoABuscar']; ?></span>

                        <button type="submit" name="enviar">Buscar</button>
                    </form>  
                </div>

            <?php

            if ($entradaOK) { // La entrada está bien, se conecta a la base de datos

            //Cargar la variable $aRespuestas y tratamiento de datos OK
            $aRespuesta["departamentoABuscar"] = htmlspecialchars($_REQUEST["departamentoABuscar"]);
             
        // Comienza la conexión de base de datos con gestion de extensiones
        try{ 
            $miDB = new PDO(HOST,USER,PASSWORD); // Conexión PDO
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            // Construccion de la sentencia SQL concatenando  
            $listaDepartamentos = $miDB->query("select * from T02_Departamento where T02_DescDepartamento like '%" . $aRespuesta['departamentoABuscar'] . "%'");

            
             if ($listaDepartamentos->rowCount() > 0) {
                            
                            echo '<table class="tabla-departamentos" style="margin: 15px auto;">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="texto-centro">Código</th>';
                            echo '<th>Descripción</th>';
                            echo '<th class="texto-centro">Fecha de Alta</th>';
                            echo '<th class="texto-derecha">Volumen de Negocio</th>';
                            echo '<th class="texto-centro">Fecha de Baja</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            
                            while ($oDepartamento = $listaDepartamentos->fetchObject()) {
                                echo '<tr>';
                                echo '<td class="texto-centro"><b>' . $oDepartamento->T02_CodDepartamento . '</b></td>';
                                echo '<td>' . $oDepartamento->T02_DescDepartamento . '</td>';

                                // Formateo de la fecha de alta a formato español (d/m/Y)
                                $fechaCreacionDepartamento = new DateTime($oDepartamento->T02_FechaCreacionDepartamento);
                                echo '<td class="texto-centro">' . $fechaCreacionDepartamento->format('d/m/Y') . '</td>';

                                // Formateo del numero a moneda española
                                echo '<td class="texto-derecha">' . number_format($oDepartamento->T02_VolumenDeNegocio, 2, ',', '.') . ' €</td>';

                                // Comprobacion en la fecha de baja
                                if (is_null($oDepartamento->T02_FechaBajaDepartamento)) {
                                    echo '<td class="texto-centro">-</td>';
                                } else {
                                    $fechaBajaDepartamento = new DateTime($oDepartamento->T02_FechaBajaDepartamento);
                                    echo '<td class="texto-centro">' . $fechaBajaDepartamento->format('d/m/Y') . '</td>';
                                }
                                echo '</tr>';
                            }
                            
                            echo '</tbody>';
                            echo '</table>';                                                  
                        } 
            
            } catch (PDOException $e) {
                echo "ERROR: ".$e->getMessage()."<br/>";
            } finally{
                unset($miDB);
            }

            echo ("<h3><a href='./ejercicio4.php'>Volver a buscar</a></h3>");
                    
            }  
            ?>
        
    </body>
    <footer>
        <address>
            <p>&copy; 2025-2026 <span><a href="../../index.html">Juan Rivera Ordoñez</a></span>- I.E.S. Los Sauces</p>
            <a href="https://github.com/juanrivord/JRODWESProyectoTema4"><img src="../webroot/images/github.png" alt="Imagen de github"></a>
            <a href="../indexProyectoTema4.php"><img src="../webroot/images/casita.png" alt="Imagen de una casita"></a>
        </address>
    </footer>
</html>