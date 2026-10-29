<?php
/*
 * Juan Rivera Ordoñez
 * Archivo de configuración de acceso a la base de datos MariaDB.
 * Permite alternar fácilmente entre el entorno de Casa y Clase.
 */

if (date_default_timezone_get()!="Europe/Madrid") date_default_timezone_set("Europe/Madrid");

define('DBNAME', "JROCDWESProyectoTema4");
define('PASSWORD', "paso");


// CONF CLASE

// define('HOST', "mysql:host=10.199.8.97;dbname=DBJRODWESProyectoTema4");
// define('SERVER', "10.199.8.97");
// define('USER', "userJRODWESProyectoTema4");

// CONF CASA

define('HOST', "mysql:host=192.168.1.108;dbname=DBJRODWESProyectoTema4");
define('SERVER', "192.168.1.108");
define('USER', "adminsql");

?>