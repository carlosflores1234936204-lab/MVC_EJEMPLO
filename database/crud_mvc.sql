CREATE DATABASE IF NOT EXISTS crud_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE crud_mvc;

DROP TABLE IF EXISTS estudiantes;

CREATE TABLE estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricula VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(15),
    carrera VARCHAR(100) NOT NULL,
    semestre INT NOT NULL
);

INSERT INTO estudiantes (matricula,nombre,apellidos,correo,telefono,carrera,semestre) VALUES
('2026001','Juan','Pérez García','juan.perez@gmail.com','2221000001','Ingeniería en Sistemas Computacionales',1),
('2026002','María','López Hernández','maria.lopez@gmail.com','2221000002','Ingeniería en Sistemas Computacionales',2),
('2026003','Carlos','Martínez Pérez','carlos.martinez@gmail.com','2221000003','Ingeniería en Tecnologías de la Información',3),
('2026004','Ana','García Sánchez','ana.garcia@gmail.com','2221000004','Ingeniería en Sistemas Computacionales',4),
('2026005','Luis','Ramírez Torres','luis.ramirez@gmail.com','2221000005','Ingeniería en Sistemas Computacionales',5),
('2026006','Sofía','Morales Díaz','sofia.morales@gmail.com','2221000006','Ingeniería en Tecnologías de la Información',6),
('2026007','Diego','Castillo Ruiz','diego.castillo@gmail.com','2221000007','Ingeniería en Sistemas Computacionales',7),
('2026008','Laura','Vázquez Cruz','laura.vazquez@gmail.com','2221000008','Ingeniería en Sistemas Computacionales',8),
('2026009','Miguel','Flores Jiménez','miguel.flores@gmail.com','2221000009','Ingeniería en Tecnologías de la Información',9),
('2026010','Daniela','Ortega Reyes','daniela.ortega@gmail.com','2221000010','Ingeniería en Sistemas Computacionales',10);
