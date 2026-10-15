-- Creación de la base de datos, tabla y usuario de aplicación

CREATE DATABASE IF NOT EXISTS DB2JRDWESProyectoTema4;

USE DB2JRDWESProyectoTema4;

CREATE TABLE IF NOT EXISTS T02_Departamento (
  T02_CodDepartamento  CHAR(3) PRIMARY KEY,
  T02_DescDepartamento VARCHAR(255),
  T02_FechaCreacionDepartamento DATETIME DEFAULT CURRENT_TIMESTAMP,
  T02_VolumenDeNegocio DOUBLE,
  T02_FechaBajaDepartamento DATETIME DEFAULT NULL) ENGINE=InnoDB;

DROP USER 'user2JRDWESProyectoTema4'@'localhost';

CREATE USER 'user2JRDWESProyectoTema4'@'localhost' 
  IDENTIFIED BY 'paso';

GRANT SELECT, INSERT, UPDATE, DELETE
  ON DB2JRDWESProyectoTema4.*
  TO 'user2JRDWESProyectoTema4'@'localhost';

FLUSH PRIVILEGES;