DROP database academica2;
drop database workflowsegundoparcial;
create DATABASE workflowsegundoparcial;
use workflowsegundoparcial;

create table flujo
(
    flujo varchar(3),
    proceso varchar(3),
    procesosiguiente varchar(3),
    tipo varchar(1),
    rol varchar(15),
    pantalla varchar(30)
);

insert into flujo 
	values('F1','P1','P2','I','estudiante','iniproceso');
insert into flujo 
	values('F1','P2','P3','P','estudiante','catalogo_mat_doc');
insert into flujo 
	values('F1','P3','P4','P','estudiante','form_inscripcion');
insert into flujo 
    values('F1','P4','P5','P','kardex','recibe_form');
insert into flujo 
    values('F1','P5',NULL,'C','kardex','verificar_requisitos');
insert into flujo 
    values('F1','P6','P3','P','estudiante','informe_problema');
insert into flujo 
    values('F1','P7',NULL,'C','kardex','verificar_cupos');
insert into flujo 
    values('F1','P8','P9','P','kardex','inscripcion_registro');
insert into flujo
    values('F1','P9','P10','P','estudiante','mostrar_horario');
insert into flujo
    values('F1','P10','P11','P','estudiante','finaliza_inscripcion');
insert into flujo
    values('F1','P11','P12','P','docente','notificacion');
insert into flujo
    values('F1','P12',NULL,'F','docente','actualiza_lista');


create table flujocondicional
(
    codFlujo varchar(3),
    codProceso varchar(3),
    codProcesoSi varchar(3),
    codProcesoNo varchar(3)
);
insert into flujocondicional
    values('F1','P5','P7','P6');
insert into flujocondicional
    values('F1','P7','P8','P6');


/*creamos base de datos academica2*/

create database academica2;
use academica2;
create table usuario
(
    id varchar(3) PRIMARY KEY,
    nombre varchar(20),
    paterno varchar(20),
    materno varchar(20),
    password varchar(255),
    ci varchar(8),
    matricula varchar(7),
    rol varchar(30)
);


insert into usuario values ('01','Juan','Lopez','Lopez', md5('password123'),'12345741','1787100','estudiante');
INSERT INTO usuario (id, nombre, paterno, materno, password, ci, matricula, rol) 
VALUES ('02', 'Pedro', 'García', 'González', md5('password123'), '87654321', '1787101', 'estudiante');

INSERT INTO usuario (id, nombre, paterno, materno, password, ci, matricula, rol) 
VALUES ('03', 'María', 'Rodríguez', 'Martínez', md5('password123'), '56789012', '1787102', 'kardex');

INSERT INTO usuario (id, nombre, paterno, materno, password, ci, matricula, rol) 
VALUES ('04', 'Carlos', 'Pérez', 'Hernández', md5('password123'), '34567890', '1787103', 'docente');

INSERT INTO usuario (id, nombre, paterno, materno, password, ci, matricula, rol) 
VALUES ('05', 'Ana', 'González', 'Fernández', md5('password123'), '23456789', '1787104', 'estudiante');

INSERT INTO usuario (id, nombre, paterno, materno, password, ci, matricula, rol) 
VALUES ('06', 'Luis', 'Hernández', 'Sánchez', md5('password123'), '45678901', '1787105', 'kardex');

INSERT INTO usuario (id, nombre, paterno, materno, password, ci, matricula, rol) 
VALUES ('07', 'Laura', 'Martínez', 'Gómez', md5('password123'), '67890123', '1787106', 'estudiante');

INSERT INTO usuario (id, nombre, paterno, materno, password, ci, matricula, rol) 
VALUES ('08', 'Roberto', 'López', 'Sánchez', md5('password123'), '89012345', '1787107', 'docente');

INSERT INTO usuario (id, nombre, paterno, materno, password, ci, matricula, rol) 
VALUES ('09', 'Sofía', 'Hernández', 'Ramírez', md5('password123'), '01234567', '1787108', 'estudiante');

INSERT INTO usuario (id, nombre, paterno, materno, password, ci, matricula, rol) 
VALUES ('10', 'Alejandro', 'Gómez', 'Pérez', md5('password123'), '98765432', '1787109', 'kardex');



/*---------------------------------------------------------*/

use workflowsegundoparcial;

create table flujousuario
(
    numerotramite int,
    flujo varchar(3),
    proceso varchar(3),
    fechainicio datetime,
    fechafin datetime,
    usuario varchar(20)
);

/*
insert into flujousuario values ('100','F1','P1','2023/05/03 11:00','2023/05/03 11:15','Juan');
insert into flujousuario values ('100','F1','P2','2023/05/03 11:15',NULL,'Juan');
insert into flujousuario values ('101','F1','P1','2023/05/03 11:00','2023/05/03 11:15','Carlos');
insert into flujousuario values ('101','F1','P2','2023-05-03 11:15','2023-05-03 11:30','Carlos');
insert into flujousuario values ('101','F1','P3','2023-05-03 11:30',NULL,'Carlos');
insert into flujousuario values ('102','F1','P1','2023/05/03 11:00',NULL,'Luis');
insert into flujousuario values ('103','F4','P1','2023/05/03 11:00',NULL,'Luis');

    -- Flujos para el usuario 'Laura'
INSERT INTO flujousuario VALUES ('104', 'F1', 'P1', '2023/06/03 09:00', '2023/06/03 09:30', 'Laura');
INSERT INTO flujousuario VALUES ('104', 'F1', 'P2', '2023/06/03 09:30', '2023/06/03 10:00', 'Laura');

-- Flujos para el usuario 'Roberto'
INSERT INTO flujousuario VALUES ('105', 'F1', 'P1', '2023/06/03 08:00', '2023/06/03 08:30', 'Roberto');
INSERT INTO flujousuario VALUES ('105', 'F1', 'P2', '2023/06/03 08:30', '2023/06/03 09:00', 'Roberto');
INSERT INTO flujousuario VALUES ('105', 'F1', 'P3', '2023/06/03 09:00', NULL, 'Roberto');

-- Flujos para el usuario 'Sofía'
INSERT INTO flujousuario VALUES ('106', 'F1', 'P1', '2023/06/03 10:00', '2023/06/03 10:30', 'Sofía');
INSERT INTO flujousuario VALUES ('106', 'F1', 'P2', '2023/06/03 10:30', '2023/06/03 11:00', 'Sofía');
INSERT INTO flujousuario VALUES ('106', 'F2', 'P3', '2023/06/03 11:00', '2023/06/03 11:30', 'Sofía');
INSERT INTO flujousuario VALUES ('106', 'F1', 'P4', '2023/06/03 11:30', NULL, 'Sofía');

-- Flujos para el usuario 'Alejandro'
INSERT INTO flujousuario VALUES ('107', 'F1', 'P5', '2023/06/03 09:30', '2023/06/03 10:00', 'Alejandro');
INSERT INTO flujousuario VALUES ('107', 'F1', 'P6', '2023/06/03 10:00', '2023/06/03 10:30', 'Alejandro');
INSERT INTO flujousuario VALUES ('107', 'F1', 'P7', '2023/06/03 10:30', NULL, 'Alejandro');

*/
use academica2;

/*base de datos de inscripcion*/
create table Materia
(
    codMateria varchar(7) PRIMARY KEY,
    nombre varchar(50),
    semestre varchar(20)
);

insert into Materia values ('INF-111','Programacion 1','Primero');
INSERT INTO Materia VALUES ('INF-131', 'Estructuras de Datos', 'Tercero');
INSERT INTO Materia VALUES ('INF-121', 'Programación Orientada a Objetos', 'Segundo');
INSERT INTO Materia VALUES ('INF-161', 'Bases de Datos', 'Sexto');
INSERT INTO Materia VALUES ('INF-273', 'Telematica', 'Septimo');
INSERT INTO Materia VALUES ('INF-354', 'Inteligencia Artificial', 'Optativa');

create table paralelo
(
    codMateria varchar(7),
    Paralelo varchar(3),
    idDocente varchar(50),
    horario varchar(20)
);

INSERT INTO paralelo VALUES ('INF-354', 'A', '04', '10:00 - 12:00');
INSERT INTO paralelo VALUES ('INF-111', 'A', '08', '08:00 - 10:00');
INSERT INTO paralelo VALUES ('INF-111', 'B', '08', '14:00 - 16:00');
INSERT INTO paralelo VALUES ('INF-131', 'A', '06', '10:00 - 12:00');
INSERT INTO paralelo VALUES ('INF-131', 'B', '04', '16:00 - 18:00');
INSERT INTO paralelo VALUES ('INF-121', 'A', '08', '08:00 - 10:00');
INSERT INTO paralelo VALUES ('INF-121', 'B', '08', '10:00 - 12:00');
INSERT INTO paralelo VALUES ('INF-161', 'A', '04', '14:00 - 16:00');
INSERT INTO paralelo VALUES ('INF-161', 'B', '04', '16:00 - 18:00');
INSERT INTO paralelo VALUES ('INF-273', 'A', '04', '08:00 - 10:00');
INSERT INTO paralelo VALUES ('INF-273', 'B', '04', '10:00 - 12:00');
INSERT INTO paralelo VALUES ('INF-354', 'A', '04', '10:00 - 12:00');


create table inscripcion
(
    codMateria varchar(7),
    Paralelo varchar(3),
    idEstudiante varchar(3)
);


/*********************************************/
/*Aqui guardamos los datos que el estudiante manda a kardex temporalmente*/

use workflowsegundoparcial;

create table estudiantekardex
(
    codTramite int,
    usuario varchar(50),
    codMateria varchar(7),
    paralelo varchar(2)
);


create table kardexestudiante1
(
    codTramite int,
    usuario varchar(50),
    mensaje TEXT
);


/*
alter table academico.alumno add column rol varchar(20);
*/
update academico.alumno set rol='alumno' where id in(2,3,4);
    update academico.alumno set rol='docente' where id in(5);
update academico.alumno set rol='alumno' where id=1;


