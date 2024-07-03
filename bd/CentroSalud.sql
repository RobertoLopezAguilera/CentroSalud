DROP DATABASE IF EXISTS CentroSalud;
CREATE DATABASE IF NOT EXISTS CentroSalud;
USE CentroSalud;

-- Areas del hospital
CREATE TABLE Areas (
    id_area INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)
);

INSERT INTO Areas(id_area, nombre)
VALUES (default, 'Anestesiologia'),
       (default, 'Cuidados intensivos'),
       (default, 'Pediatria'),
       (default, 'Medicina Interna'),
       (default, 'Cardiologia'),
       (default, 'Rehabilitacion'),
       (default, 'Laboratorista'),
       (default, 'General');

SELECT * FROM Areas;
-- Habitaciones del hospital
CREATE TABLE Habitaciones (
    id_habitacion INT AUTO_INCREMENT PRIMARY KEY,
    numero INT,
    tipo VARCHAR(50),
    estado VARCHAR(50),
    costo DECIMAL(10, 2),
    id_area INT,
    FOREIGN KEY (id_area) REFERENCES Areas(id_area)
);

INSERT INTO Habitaciones (numero, tipo, estado, costo, id_area)
VALUES (101, 'Individual', 'Disponible', 150.00, 1),
       (102, 'Doble', 'Ocupado', 200.00, 2),
       (103, 'Individual', 'Disponible', 150.00, 3),
       (104, 'Suite', 'Disponible', 300.00, 4),
       (105, 'Doble', 'Mantenimiento', 200.00, 5);
SELECT Habitaciones.numero AS Numero_Habitacion, 
       Habitaciones.tipo AS Tipo_Habitacion, 
       Habitaciones.estado AS Estado_Habitacion, 
       Habitaciones.costo AS Costo_Habitacion, 
       Areas.nombre AS Nombre_Area
	FROM Habitaciones
	INNER JOIN Areas ON Habitaciones.id_area = Areas.id_area;

-- Camas dentro de cada habitación
CREATE TABLE Camas (
    id_cama INT AUTO_INCREMENT PRIMARY KEY,
    id_habitacion INT,
    numero_cama INT,
    estado VARCHAR(50),
    FOREIGN KEY (id_habitacion) REFERENCES Habitaciones(id_habitacion)
);

INSERT INTO Camas (id_habitacion, numero_cama, estado)
VALUES 
    (1, 1, 'Disponible'),
    (1, 2, 'Ocupada'),
    (2, 1, 'Disponible'),
    (2, 2, 'Disponible'),
    (3, 1, 'Ocupada'),
    (3, 2, 'Disponible'),
    (4, 1, 'Disponible'),
    (4, 2, 'Disponible'),
    (5, 1, 'Ocupada'),
    (5, 2, 'Disponible');

SELECT * FROM camas;

-- Pacientes
CREATE TABLE Pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    fecha_nacimiento DATE,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    id_cama INT,
    FOREIGN KEY (id_cama) REFERENCES Camas(id_cama)
);

INSERT INTO Pacientes (nombre, apellido, fecha_nacimiento, direccion, telefono, id_cama)
VALUES 
    ('Juan', 'Perez', '1980-05-15', 'Calle Falsa 123', '555-1234', 1),
    ('Maria', 'Gonzalez', '1990-08-22', 'Avenida Siempre Viva 456', '555-5678', 3),
    ('Carlos', 'Ramirez', '1975-11-30', 'Boulevard de los Sueños 789', '555-9876', 5),
    ('Ana', 'Martinez', '1985-03-10', 'Plaza de la Libertad 101', '555-4321', 7),
    ('Luis', 'Hernandez', '2000-12-25', 'Vasco de Quiroga 6', '555-2468', 9);
    
SELECT * FROM Pacientes;
SELECT 
    P.nombre AS NombrePaciente,
    P.apellido AS ApellidoPaciente,
    C.numero_cama AS NumeroCama,
    H.numero AS NumeroHabitacion,
    H.tipo AS TipoHabitacion,
    H.estado AS EstadoHabitacion,
    A.nombre AS NombreArea
FROM 
    Pacientes P
JOIN 
    Camas C ON P.id_cama = C.id_cama
JOIN 
    Habitaciones H ON C.id_habitacion = H.id_habitacion
JOIN 
    Areas A ON H.id_area = A.id_area;

-- Historial médico de los pacientes
CREATE TABLE Expedientes_Medicos (
    id_expediente INT AUTO_INCREMENT PRIMARY KEY,
    id_paciente INT,
    historial_medico TEXT,
    alergias TEXT,
    medicamentos_actuales TEXT,
    antecedentes_familiares TEXT,
    otras_notas TEXT,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente)
);

INSERT INTO Expedientes_Medicos (id_paciente, historial_medico, alergias, medicamentos_actuales, antecedentes_familiares, otras_notas)
VALUES 
    (1, 'Historial médico del paciente 1', 'Alergia a la penicilina', 'Ibuprofeno', 'Diabetes en la familia', 'Nota adicional 1'),
    (2, 'Historial médico del paciente 2', 'Alergia al polen', 'Loratadina', 'Hipertensión en la familia', 'Nota adicional 2'),
    (3, 'Historial médico del paciente 3', 'Alergia a los mariscos', 'Paracetamol', 'Cáncer en la familia', 'Nota adicional 3'),
    (4, 'Historial médico del paciente 4', 'No tiene alergias conocidas', 'Ninguno', 'Enfermedad cardíaca en la familia', 'Nota adicional 4'),
    (5, 'Historial médico del paciente 5', 'Alergia al gluten', 'Metformina', 'Obesidad en la familia', 'Nota adicional 5');
    
SELECT 
    Pacientes.nombre,
    Pacientes.apellido,
    Expedientes_Medicos.historial_medico,
    Expedientes_Medicos.alergias,
    Expedientes_Medicos.medicamentos_actuales,
    Expedientes_Medicos.antecedentes_familiares,
    Expedientes_Medicos.otras_notas
FROM 
    Expedientes_Medicos
INNER JOIN 
    Pacientes ON Expedientes_Medicos.id_paciente = Pacientes.id_paciente;


-- Personal médico y administrativo
CREATE TABLE Personal (
    id_personal INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    tipo_personal VARCHAR(50),
    especialidad VARCHAR(100),
    Correo VARCHAR(50),
    Contraseña VARCHAR(64),
    telefono VARCHAR(20)
);

INSERT INTO Personal (nombre, apellido, tipo_personal, especialidad, Correo, Contraseña, telefono)
VALUES
    ('DR. Roberto', 'Lopez', 'Médico', 'Cardiología', 'betos70700@gmail.com', SHA2('Betos123', 256), '123-456-7890'),
    ('Claria', 'Garcia', 'Enfermera', 'Cuidados Intensivos', 'Clarisa@example.com', SHA2('123456789', 256), '987-654-3210'),
    ('Brayan', 'Lopez', 'Médico', 'Pediatría', 'Brayan@example.com', SHA2('123456789', 256), '555-123-4567'),
    ('Sofi', 'Hernández', 'Enfermera', 'Medicina Interna', 'Sofi@example.com', SHA2('123456789', 256), '333-987-6543'),
    ('Carlos', 'Rodríguez', 'Médico', 'Anestesiología', 'Carlos@example.com', SHA2('123456789', 256), '777-222-1111');


SELECT * FROM Personal;

-- Equipos médicos
CREATE TABLE Equipos_Medicos (
    id_equipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_equipo VARCHAR(100),
    estado BOOLEAN,
    id_habitacion INT,
    img LONGBLOB,
    FOREIGN KEY (id_habitacion) REFERENCES Habitaciones(id_habitacion)
);

INSERT INTO Equipos_Medicos (nombre_equipo, estado, id_habitacion)
VALUES
    ('Monitor de Signos Vitales', true, 1),
    ('Desfibrilador', true, 2),
    ('Ventilador', false, 3),
    ('Lámpara Quirúrgica', true, 4),
    ('Ecógrafo', true, 5);

SELECT * FROM Equipos_Medicos;

-- Citas médicas programadas
CREATE TABLE Citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    id_paciente INT,
    id_personal INT,
    fecha_hora DATETIME,
    tipo VARCHAR(100),
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente),
    FOREIGN KEY (id_personal) REFERENCES Personal(id_personal)
);

INSERT INTO Citas (id_paciente, id_personal, fecha_hora, tipo)
VALUES
    (1, 1, '2024-07-01 09:00:00', 'Consulta de rutina'),
    (2, 2, '2024-07-02 10:30:00', 'Control postoperatorio'),
    (3, 3, '2024-07-03 14:00:00', 'Chequeo anual'),
    (4, 4, '2024-07-04 11:15:00', 'Evaluación cardiológica'),
    (5, 5, '2024-07-05 08:45:00', 'Consulta pediátrica');
    
SELECT p.nombre AS nombre_paciente, p.apellido AS apellido_paciente,
       per.nombre AS nombre_personal, per.apellido AS apellido_personal
FROM Citas c
JOIN Pacientes p ON c.id_paciente = p.id_paciente
JOIN Personal per ON c.id_personal = per.id_personal;

-- Tabla Recetas_Medicas para gestionar las recetas médicas emitidas
CREATE TABLE Recetas_Medicas (
    id_receta INT AUTO_INCREMENT PRIMARY KEY,
    id_paciente INT,
    id_personal INT,
    fecha_emision DATETIME,
    observaciones TEXT,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente),
    FOREIGN KEY (id_personal) REFERENCES Personal(id_personal)
);

INSERT INTO Recetas_Medicas (id_paciente, id_personal, fecha_emision, observaciones)
VALUES (1, 3, '2024-07-01 10:00:00', 'Tomar medicamento X cada 8 horas por 5 días');


-- Medicamentos
CREATE TABLE Medicamentos (
    id_medicamento INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT,
    stock INT,
    precio DECIMAL(10, 2),
    fecha_caducidad DATE
);

INSERT INTO Medicamentos (nombre, descripcion, stock, precio, fecha_caducidad)
VALUES 
    ('Paracetamol', 'Analgesico y antifebril', 100, 10.50, '2025-12-31'),
    ('Amoxicilina', 'Antibiótico de amplio espectro', 50, 15.75, '2024-10-15'),
    ('Omeprazol', 'Inhibidor de la bomba de protones', 80, 8.20, '2023-08-28'),
    ('Loratadina', 'Antihistamínico para alergias', 120, 5.30, '2024-05-10'),
    ('Ibuprofeno', 'Antiinflamatorio no esteroideo', 90, 7.80, '2023-11-30'),
    ('Metformina', 'Antidiabético oral', 60, 12.00, '2024-09-20'),
    ('Simvastatina', 'Reductor de colesterol', 70, 14.60, '2023-07-15'),
    ('Amlodipino', 'Antagonista del calcio para la presión arterial', 40, 9.90, '2024-03-12');

SELECT * FROM Medicamentos;

-- Medicamentos recetados en cada receta médica
CREATE TABLE Receta_Medicamento (
    id_receta_medicamento INT AUTO_INCREMENT PRIMARY KEY,
    id_receta INT,
    id_medicamento INT,
    dosis VARCHAR(50),
    FOREIGN KEY (id_receta) REFERENCES Recetas_Medicas(id_receta),
    FOREIGN KEY (id_medicamento) REFERENCES Medicamentos(id_medicamento)
);

INSERT INTO Recetas_Medicas (id_paciente, id_personal, fecha_emision, observaciones)
VALUES 
    (1, 1, '2024-06-30 10:00:00', 'Tomar medicamento cada 8 horas durante 7 días.'),
    (2, 3, '2024-06-30 11:15:00', 'Aplicar crema en la zona afectada dos veces al día.'),
    (3, 2, '2024-06-30 12:30:00', 'Tomar una pastilla después de cada comida principal.'),
    (4, 4, '2024-06-30 14:00:00', 'Ingerir una cápsula diaria en la mañana.'),
    (5, 5, '2024-06-30 15:45:00', 'Aplicar gotas en el ojo afectado cada 4 horas.');

SELECT p.nombre AS nombre_paciente, p.apellido AS apellido_paciente,
       pe.nombre AS nombre_personal, pe.apellido AS apellido_personal
FROM Citas c
JOIN Pacientes p ON c.id_paciente = p.id_paciente
JOIN Personal pe ON c.id_personal = pe.id_personal;

-- Facturas médicas
CREATE TABLE Facturas (
    id_factura INT AUTO_INCREMENT PRIMARY KEY,
    id_paciente INT,
    fecha_emision DATETIME,
    total DECIMAL(10, 2) DEFAULT 0.00,
    pagada BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente)
);

INSERT INTO Facturas (id_paciente, fecha_emision, total, pagada)
VALUES
    (1, '2024-07-01 10:00:00', 150.00, TRUE),
    (2, '2024-07-02 11:30:00', 200.50, FALSE),
    (3, '2024-07-03 09:45:00', 320.75, TRUE),
    (4, '2024-07-04 14:15:00', 180.25, FALSE),
    (5, '2024-07-05 08:00:00', 500.00, FALSE);

SELECT* FROM Facturas;

-- Detalles de cada factura
CREATE TABLE Detalle_Factura (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_factura INT,
    descripcion VARCHAR(255),
    cantidad INT,
    precio_unitario DECIMAL(10, 2),
    subtotal DECIMAL(10, 2),
    FOREIGN KEY (id_factura) REFERENCES Facturas(id_factura)
);

-- Factura 1
INSERT INTO Detalle_Factura (id_factura, descripcion, cantidad, precio_unitario, subtotal)
VALUES
    (1, 'Consulta médica', 1, 50.00, 50.00),
    (1, 'Análisis clínicos', 2, 25.00, 50.00),
    (1, 'Medicamentos recetados', 3, 10.00, 30.00);

-- Factura 2
INSERT INTO Detalle_Factura (id_factura, descripcion, cantidad, precio_unitario, subtotal)
VALUES
    (2, 'Consulta especializada', 1, 80.00, 80.00),
    (2, 'Estudios radiológicos', 1, 70.50, 70.50),
    (2, 'Medicamentos recetados', 2, 25.00, 50.00);

-- Factura 3
INSERT INTO Detalle_Factura (id_factura, descripcion, cantidad, precio_unitario, subtotal)
VALUES
    (3, 'Cirugía menor', 1, 250.00, 250.00),
    (3, 'Consulta de seguimiento', 1, 70.75, 70.75);

-- Factura 4
INSERT INTO Detalle_Factura (id_factura, descripcion, cantidad, precio_unitario, subtotal)
VALUES
    (4, 'Consulta inicial', 1, 80.25, 80.25),
    (4, 'Pruebas de laboratorio', 1, 100.00, 100.00);

-- Factura 5
INSERT INTO Detalle_Factura (id_factura, descripcion, cantidad, precio_unitario, subtotal)
VALUES
    (5, 'Consulta urgente', 1, 200.00, 200.00),
    (5, 'Medicamentos de emergencia', 1, 300.00, 300.00);

-- Trigger para actualizar el total de la factura automáticamente
DELIMITER //
CREATE TRIGGER actualizar_total_factura
AFTER INSERT ON Detalle_Factura
FOR EACH ROW
BEGIN
    DECLARE total_factura DECIMAL(10, 2);
    SELECT SUM(subtotal) INTO total_factura FROM Detalle_Factura WHERE id_factura = NEW.id_factura;
    UPDATE Facturas SET total = total_factura WHERE id_factura = NEW.id_factura;
END //
DELIMITER ;

ALTER TABLE `pacientes` ADD `CURP` VARCHAR(18) NOT NULL AFTER `id_cama`;
ALTER TABLE `pacientes` ADD `contraseña` VARCHAR(64) NOT NULL AFTER `CURP`;