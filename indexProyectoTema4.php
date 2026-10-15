<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWES. Juan Rivera Ordoñez</title>
    <link rel="stylesheet" href="./webroot/css/style.css">
    <script src="./webroot/script/script.js"></script>
</head>

<body>
    <header id="inicio">
            <img src="./webroot/images/logo.png" alt="Logo de I.E.S. Los Sauces" class="logo">
        <h1>TEMA 4: Técnicas de acceso a datos en PHP</h1>
    </header>
    <main>

        <table>
            <thead>
                <tr>
                    <th>Script</th>
                    <th>Código</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Creación</td>
                    <td><a class="btn btn-ejecutar" href="mostrarcodigo/muestraCreaSQL.php">Código</a></td>
                </tr>
                <tr>
                    <td>Carga</td>
                    <td><a class="btn btn-ejecutar" href="mostrarcodigo/muestraCargaSQL.php">Código</a></td>
                </tr>
                <tr>
                    <td>Borrado</td>
                    <td><a class="btn btn-ejecutar" href="mostrarcodigo/muestraBorraSQL.php">Código</a></td>
                </tr>
            </tbody>
        </table>
        
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre de la práctica</th>
                    <th>Ejecutar PDO</th>
                    <th>Código PDO</th>
                    <th>Ejecutar MySQLi</th>
                    <th>Código MySQLi</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Conexión a la base de datos con la cuenta usuario y tratamiento de errores.</td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mostrar el contenido de la tabla Departamento y el número de registros.</td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.</td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento,
                         si el usuario no pone nada deben aparecer todos los departamentos).</td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones
                        insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.</td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos
                        utilizando una consulta preparada.</td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla
                        Departamento de nuestra base de datos. (IMPORTAR). El fichero importado se encuentra en el
                        directorio .../tmp/ del servidor.
                    </td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un
                        fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR). El fichero exportado se
                        encuentra en el directorio .../tmp/ del servidor.</td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Aplicación resumen MtoDeDepartamentosTema4. (Incluir PHPDoc y versionado en el repositorio GIT)</td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Aplicación resumen MtoDeDepartamentos POO y multicapa.</td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                    <td><a class="bloqueado">Bloqueado</a></td>
                </tr>
                
            </tbody>
            
        </table>
        
    </main>
    <footer>
        <address>
            <p>&copy; 2025-2026 <span><a href="../index.html">Juan Rivera Ordoñez</a></span>- I.E.S. Los Sauces</p>
            <p><a href="https://github.com/juanrivord/JRODWESProyectoTema4"><img src="./webroot/images/github.png" alt="Imagen de github"></a></p>
        </address>
    </footer>
</body>
</html>
