CREATE TABLE IF NOT EXISTS T02_Departamento (
  T02_CodDepartamento  CHAR(3) PRIMARY KEY,
  T02_DescDepartamento VARCHAR(255),
  T02_FechaCreacionDepartamento DATETIME DEFAULT CURRENT_TIMESTAMP,
  T02_VolumenDeNegocio DOUBLE,
  T02_FechaBajaDepartamento DATETIME DEFAULT NULL) ENGINE=InnoDB;

CREATE USER 'userJRODWESProyectoTema4'@'%' 
  IDENTIFIED BY 'paso';

GRANT ALL ON DBJRODWESProyectoTema4.* to 'userJRODWESProyectoTema4'@'%';

FLUSH PRIVILEGES;

INSERT INTO T02_Departamento
  (T02_CodDepartamento,
   T02_DescDepartamento,
   T02_FechaCreacionDepartamento,
   T02_VolumenDeNegocio,
   T02_FechaBajaDepartamento)
VALUES
  ('ADM', 'Administración', '2024-01-15 09:00:00', 125000.00, NULL),
  ('COM', 'Comercial',      '2024-01-15 09:00:00', 240000.00, NULL),
  ('FIN', 'Finanzas',       '2024-01-15 09:00:00', 180000.00, '2024-07-28 10:00:00'),
  ('TEC', 'Tecnología',     '2024-01-15 09:00:00', 310000.00, NULL),
  ('VEN', 'Ventas',         '2024-01-15 09:00:00', 275000.00, NULL);
