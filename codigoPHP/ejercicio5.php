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
            * 03/11/2026
            * 5. Formulario para añadir un departamento con 3 insert y una transacción.
        */
            require_once '../config/configDBPDO.php';
            require_once '../core/231018libreriaValidacion.php';

            echo "<a href='../indexProyectoTema4.php'>⬅ Volver al inicio</a><br><br>";

            try {
                //declaracion de variables de cuando se muestra la tabla
                $fechaCreacionDepartamento;
                $fechaBajaDepartamento;
                
                //creacion de conexion 
                $miDB = new PDO(HOST,USER,PASSWORD); // Conexión PDO
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //array de datos de departamentos
                //codigo, descripcion, volumen
                $aDatosDepartamentos=[
                    [":codDepartamento" => "AAA",
                    ":desDepartamento" => "descripcion a",
                    ":volumenNegocioDepartamento" => 400100.11
                    ],
                    [":codDepartamento" => "BBB",
                    ":desDepartamento" => "descripcion b",
                    ":volumenNegocioDepartamento" => 70100.51
                    ],
                    [":codDepartamento" => "CCC",
                    ":desDepartamento" => "descripcion c",
                    ":volumenNegocioDepartamento" => 40.61
                    ]
                ];
                
                //iniciamos la transaccion
                $miDB->beginTransaction();
                
                foreach ($aDatosDepartamentos as $aDatosCadaDepartamento){
                    //insercion sin consulta preparada
//                    $insercion= 'insert into T02_Departamento values ("'.$aDatosCadaDepartamento[":codDepartamento"].'","'.$aDatosCadaDepartamento[":desDepartamento"].'",now(),"'.$aDatosCadaDepartamento[":volumenNegocioDepartamento"].'",null)';
//                    echo "<span> $insercion </span><br>";
//                    $miDB->exec($insercion);
                    //insercion con consulta preparada
                    //iniciamos consulta dentro de un heredoc
                    $sqlInsert = <<<sql
                    INSERT INTO T02_Departamento VALUES (
                    :codDepartamento,
                    :desDepartamento,
                    now(),
                    :volumenNegocioDepartamento,
                    null)
                    sql;
                    //preparamos la insercion
                    $insercionDepartamento=$miDB->prepare($sqlInsert);
                    //ejecutar la insercion
                    $insercionDepartamento->execute($aDatosCadaDepartamento);
                }
                //aplicamos los cambio
                $miDB->commit();
                echo "<h4>Transaccion correcta</h4> <br/>";
                
                //hacer query de la tabla
                $consulta1 = $miDB->query('select * from T02_Departamento');
                echo '<table>';
                // mostrar la tabla
                echo '<tr class="titulo"> <td>Codigo</td> <td>Descripcion</td><td>FechaCreacion</td><td>VolumenNegocio</td><td>FechaBaja</td></tr>';
                while ($oDepartamento = $consulta1->fetchObject()) {
                    echo '<tr>';
                    echo '<td>' . $oDepartamento->T02_CodDepartamento . '</td>';
                    echo '<td>' . $oDepartamento->T02_DescDepartamento . '</td>';
                    $fechaCreacionDepartamento= new DateTime($oDepartamento->T02_FechaCreacionDepartamento);
                    echo '<td>' . $fechaCreacionDepartamento->format('d/m/Y') . '</td>';
                    echo '<td>' . number_format($oDepartamento->T02_VolumenDeNegocio,2,',','.') . ' €</td>';
                    if (is_null($oDepartamento->T02_FechaBajaDepartamento)){
                        echo '<td></td>';
                    }else{
                        $fechaBajaDepartamento=new DateTime($oDepartamento->T02_FechaBajaDepartamento);
                        echo '<td>'.$fechaBajaDepartamento->format('d/m/Y').'</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            } catch (PDOException $e) {
                $miDB->rollBack();               
                echo "<span style='color:red;'>Transacción fallida. Cambios deshechos (ROLLBACK).</span>";
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
            <a href="https://github.com/juanrivord/JRODWESProyectoTema4"><img src="../webroot/images/github.png" alt="Imagen de github"></a>
            <a href="../indexProyectoTema4.php"><img src="../webroot/images/casita.png" alt="Imagen de una casita"></a>
        </address>
    </footer>
</html>