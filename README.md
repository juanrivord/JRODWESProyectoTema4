# JRODWESProyectoTema4

**Desarrollo Web en Entorno Servidor (DWES) — Tema 4: Técnicas de acceso a datos en PHP**

Autor: Juan Rivera Ordoñez — I.E.S. Los Sauces (curso 2025-2026)

## Descripción

Proyecto de prácticas del Tema 4 en el que se trabaja el acceso a bases de datos MariaDB/MySQL desde PHP mediante **PDO**: conexión y tratamiento de errores, consultas, formularios con validación, transacciones, consultas preparadas e importación/exportación de datos en **XML** y **JSON**.

Todas las prácticas se acceden desde la página principal [`indexProyectoTema4.php`](indexProyectoTema4.php), que permite ejecutar cada ejercicio y ver su código fuente.

## Ejercicios

| # | Descripción |
|---|-------------|
| 1 | Conexión a la base de datos con la cuenta de usuario y tratamiento de errores. |
| 2 | Mostrar el contenido de la tabla `Departamento` y el número de registros. |
| 3 | Formulario para añadir un departamento con validación de entrada y control de errores. |
| 4 | Búsqueda de departamentos por (parte de) su descripción; sin filtro se muestran todos. |
| 5 | Inserción de tres registros mediante una transacción (se insertan todos o ninguno). |
| 6 | Carga de departamentos desde un array usando una consulta preparada. |
| 7 | Importación de departamentos desde un fichero **XML** / **JSON** ubicado en `tmp/`. |
| 8 | Exportación (copia de seguridad) de la tabla `Departamento` a **XML** / **JSON** en `tmp/`. |

## Estructura del proyecto

```
├── indexProyectoTema4.php   # Página principal con el índice de prácticas
├── codigoPHP/               # Ejercicios (ejercicio1.php … ejercicio8XML/JSON.php)
├── mostrarcodigo/           # Páginas que muestran el código fuente de cada ejercicio y script
├── config/configDBPDO.php   # Constantes de conexión a la BD (entornos clase / casa)
├── core/                    # Librería de validación de formularios
├── scriptDB/                # Scripts SQL de creación, carga inicial y borrado de la BD
└── webroot/                 # Recursos estáticos (CSS e imágenes)
```

## Base de datos

- **Base de datos:** `DBJRODWESProyectoTema4`
- **Usuario de aplicación:** `userJRODWESProyectoTema4`
- **Tabla:** `T02_Departamento` (`T02_CodDepartamento`, `T02_DescDepartamento`, `T02_FechaCreacionDepartamento`, `T02_VolumenDeNegocio`, `T02_FechaBajaDepartamento`)

Scripts en [`scriptDB/`](scriptDB/):

1. `CreaDBJRODWESProyectoTema4.sql` — crea la base de datos, la tabla y el usuario.
2. `CargaInicialDBJRODWESProyectoTema4.sql` — inserta los departamentos iniciales.
3. `BorraDBJRODWESProyectoTema4.sql` — elimina la base de datos y el usuario.

## Puesta en marcha

1. Ejecutar los scripts de `scriptDB/` en el servidor MariaDB/MySQL (creación y carga inicial).
2. Ajustar las constantes de [`config/configDBPDO.php`](config/configDBPDO.php) según el entorno (clase o casa).
3. Desplegar el proyecto en un servidor web con PHP y la extensión PDO MySQL habilitada.
4. Acceder a `indexProyectoTema4.php` desde el navegador.

## Tecnologías

PHP 8 · PDO · MariaDB/MySQL · HTML5 · CSS3 · XML · JSON
