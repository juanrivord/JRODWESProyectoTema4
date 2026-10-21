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

        if (date_default_timezone_get()!="Europe/Madrid") date_default_timezone_set("Europe/Madrid");

        echo "<a href='../indexProyectoTema4.php'>⬅ Volver al inicio</a><br><br>";


        

            //Inicializacion de variables
            $entradaOK = true; // Variable que nos indica que todo va bien
            //Array donde recogemos los mensajes de error
            $aError = [
                'codigoDep' => "",
                'descripcionDep' => "",
                'fechaCreacionDep' => "",
                'VolumenNegocioDep' => "",
                'fechaBajaDep' => ""];
            //Array donde recogemos la respuestas correctas
            $aRespuesta = [
                'codigoDep' => "",
                'descripcionDep' => "",
                'fechaCreacionDep' => "",
                'VolumenNegocioDep' => "",
                'fechaBajaDep' => ""];

            // Comprueba si el formulario se a enviado
            if (isset($_REQUEST["enviar"])) {
                // Validar Entrada

                $VolumenNegocioDepProcesado = str_replace(',', '.', $_REQUEST['VolumenNegocioDep']);
    
                $aError["codigoDep"] = validacionFormularios::comprobarAlfabetico($_REQUEST["codigoDep"],1000,1,1);
                $aError["descripcionDep"] = validacionFormularios::comprobarAlfabetico($_REQUEST["descripcionDep"],1000,1,1);                
                // la funcion date devuelve la asignacion de hoy con el formato que le pongamos, con parametro 0 devuelve la fecha mínima aceptada, en este caso
                // no queremos la fecha mínima, sino un año desde el 1900, ya que estamos validando fechas de nacimiento
                $aError["fechaCreacionDep"] = validacionFormularios::validarFecha($_REQUEST["fechaCreacionDep"],date("Y-m-d H:i:s"),"1900-01-01 00:00:00", 1);
                $aError['VolumenNegocioDep'] = validacionFormularios::comprobarFloat($VolumenNegocioDepProcesado, 10000, 0, 1);
                $aError['fechaBajaDep'] = validacionFormularios::validarFecha($_REQUEST["fechaBajaDep"],date("Y-m-d H:i:s"),"1900-01-01 00:00:00", 0);

                foreach ($aError as $value) {
                    if (!empty($value)) $entradaOK = false;
                }
            }

            // El formulario no se ha enviado nunca
            else {
                $entradaOK = false;
            }

            if ($entradaOK) { // La entrada está bien, se conecta a la base de datos

            //Cargar la variable $aRespuestas y tratamiento de datos OK
            $aRespuesta["codigoDep"] = htmlspecialchars($_REQUEST["codigoDep"]);
            $aRespuesta["descripcionDep"] = htmlspecialchars($_REQUEST["descripcionDep"]);
            $aRespuesta["fechaCreacionDep"] = new DateTime($aRespuesta["fechaCreacionDep"]);
            $aRespuesta["VolumenNegocioDep"] = number_format((float)$VolumenNegocioDepProcesado, 2, ',', '') . ' €';
            $aRespuesta["fechaBajaDep"]= new DateTime($aRespuesta["fechaBajaDep"]);
                
        try{
            $miDB = new PDO(HOST,USER,PASSWORD);
            echo "<h2>CONSULTAS DIRECTAS</h2><br>";

            $consulta = $miDB->query("SELECT * FROM T02_Departamento");

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
                    
            } else {

                // Mostrar Formulario
                ?>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="formulario" method="REQUEST" novalidate>
                    <h3>Añadir departamento</h3>
                    <label for="codigoDep" >Código: </label>
                    <input type="text" name="codigoDep" id="codigoDep" value="<?php echo (isset($_REQUEST['codigoDep'])?$_REQUEST['codigoDep']:''); ?>"/>

                    <?php
                    if (!empty($aError["codigoDep"])) echo "<span style='color:red;'>" . $aError['codigoDep'] . "</span>";
                    ?>

                    <br/>
                    <label for="descripcionDep" >Descripcion: </label>
                    <input type="text" name="descripcionDep" id="descripcionDep" value="<?php echo (isset($_REQUEST['descripcionDep'])?$_REQUEST['descripcionDep']:''); ?>"/>

                    <?php
                    if (!empty($aError["descripcionDep"])) echo "<span style='color:red;'>" . $aError['descripcionDep'] . "</span>";
                    ?>

                    <br/>
                    <label for="fechaCreacionDep">Fecha de Alta: </label>
                    <input type="date" name="fechaCreacionDep" id="fechaCreacionDep" value="<?php echo (isset($_REQUEST['fechaCreacionDep'])?$_REQUEST['fechaCreacionDep']:''); ?>"/>

                    <?php
                    if (!empty($aError["fechaCreacionDep"])) echo "<span style='color:red;'>" . $aError['fechaCreacionDep'] . "</span>";
                    ?>

                    <br/>
                    <label for="VolumenNegocioDep">Volumen de Negocio: </label>
                    <input type="text" name="VolumenNegocioDep" id="VolumenNegocioDep" value="<?php echo (isset($_REQUEST['VolumenNegocioDep'])?$_REQUEST['VolumenNegocioDep']:''); ?>"/>

                    <?php
                    if (!empty($aError["VolumenNegocioDep"])) echo "<span style='color:red;'>" . $aError['VolumenNegocioDep'] . "</span>";
                    ?>

                    <br/>
                    <label for="fechaBajaDep">Fecha de baja:</label>
                    <input type="text" name="fechaBajaDep" id="fechaBajaDep" value="<?php echo (isset($_REQUEST['fechaBajaDep'])?$_REQUEST['fechaBajaDep']:''); ?>"/>

                    <?php
                    if (!empty($aError["fechaBajaDep"])) echo "<span style='color:red;'>" . $aError['fechaBajaDep'] . "</span>";
                    ?>

                    <br/>
                    <input type="submit" name="enviar" id="enviar"/>
                </form>  
                <?php
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