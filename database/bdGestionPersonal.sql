use bdregistrocivil;
create table cargo(
  idCargo int not null auto_increment primary key,
  descripcion varchar(80) DEFAULT NULL,
  estado tinyint(4) DEFAULT NULL
);
create table oferta(
  idOferta int not null auto_increment primary key,
  idCargo int not null,
  descripcion varchar(80) DEFAULT NULL,
  fecha_inicio date DEFAULT NULL,
  fecha_fin date DEFAULT NULL,
  monto float default NULL,
  -- s

  requisitos varchar(80) DEFAULT NULL,
  manualPostulante varchar(80) DEFAULT NULL,
  resultados varchar(80) DEFAULT NULL,
  -- s
  estado tinyint(4) DEFAULT NULL,
  convocatoria boolean DEFAULT null,
  foreign key(idCargo) references cargo(idCargo)
);

create table postulacion(
  idPostulacion int not null auto_increment primary key,
  DNI char(8) NOT NULL,
  idOferta int not null,
  fecha date DEFAULT NULL,
  curriculum varchar(80) DEFAULT NULL,
  -- s
  email varchar(80) DEFAULT NULL,
  telefono char(9) NOT NULL,
  -- s
  titulo varchar(30) DEFAULT NULL,
  pais varchar(20) DEFAULT NULL,
  institucion varchar(30) DEFAULT NULL,
  areaEstudio varchar(30) DEFAULT NULL,
  nivelEstudio varchar(30) DEFAULT NULL,
  estadoEstudio varchar(30) DEFAULT NULL, 
  foto varchar(50) DEFAULT NULL,
  estado tinyint(4) DEFAULT NULL,
  foreign key(idOferta) references oferta(idOferta),
  foreign key(DNI) references persona(DNI)
  );

create table entrevista(
  idEntrevista int not null auto_increment primary key,
  idPostulacion int NOT NULL,
  fecha date DEFAULT NULL,
  observacion varchar(80) DEFAULT NULL,
  estado tinyint(4) DEFAULT NULL,
  foreign key(idPostulacion) references Postulacion(idPostulacion)

  );
ALTER TABLE `bdregistrocivil`.`roles` 
ADD COLUMN `estado` TINYINT(4) NULL DEFAULT NULL AFTER `nombreRol`;

INSERT INTO roles (`idRol`, `nombreRol`,`estado`) VALUES
(5, 'Encargado contrato',1),
(6, 'Encargado de RRHH',1),
(7, 'Administrador',1);

INSERT INTO cargo (descripcion,estado) VALUES
('Encargado contrato',1),
('Encargado de mantenimiento',1),
('Administrador',1)

--2 Sprint
create table horario(
  idHorario int not null auto_increment primary key,
  hora_inicio time not null,
  hora_fin time not null,
  dia int not null,
  estado tinyint(4) DEFAULT NULL
);

create table trabajador(
  idTrabajador int not null auto_increment primary key,
  seguro varchar(30) not null,
  ONP boolean not null,
  DNI char(8) NOT NULL,
  correoPersonal varchar(30) DEFAULT NULL,
  telefono char(9) NOT NULL,
  direccion varchar(30) DEFAULT NULL,
  estado tinyint(4) DEFAULT NULL,
  foreign key(DNI) references persona(DNI)
  );

ALTER TABLE users
ADD idTrabajador int DEFAULT 0;

create table contrato(
  idContrato int not null auto_increment primary key,
  descripcion varchar(80) DEFAULT NULL,
  fecha_inicio date DEFAULT NULL,
  fecha_fin date DEFAULT NULL,
  diasVacaciones int not null,
  idEntrevista int NOT NULL,
  idTrabajador int NOT NULL,
  archivoContrato varchar(150) DEFAULT NULL,
  estado tinyint(4) DEFAULT NULL,
  foreign key(idTrabajador) references trabajador(idTrabajador),
  foreign key(idEntrevista) references entrevista(idEntrevista)
  );

create table contrato_horario(
  idContratoHorario int not null auto_increment primary key,
  lugar varchar(30) DEFAULT NULL,
  idContrato int NOT NULL,
  idHorario int NOT NULL,
  estado tinyint(4) DEFAULT NULL,
  foreign key(idContrato) references contrato(idContrato),
  foreign key(idHorario) references horario(idHorario)
  );


create table vacacion(
  idVacacion int not null auto_increment primary key,
  descripcion varchar(80) DEFAULT NULL,
  fecha_inicio date DEFAULT NULL,
  fecha_fin date DEFAULT NULL,
  idTrabajador int NOT NULL,
  estado tinyint(4) DEFAULT NULL,
  foreign key(idTrabajador) references trabajador(idTrabajador)
  );


--3 Sprint
create table Cese(
  idCese int not null auto_increment primary key,
  fechaRegistro date DEFAULT NULL,
  idContrato int not null,
  archivoCese varchar(150) DEFAULT NULL,
  foreign key(idContrato) references contrato (idContrato)
);
create table Permiso(
  idPermiso int not null auto_increment primary key,
  fechaRegistro date DEFAULT NULL,
  idContratoHorario int not null,
  descripcion varchar(80) DEFAULT NULL,
  archivoPermiso varchar(150) DEFAULT NULL,
  foreign key(idContratoHorario) references contrato_horario(idContratoHorario)
);
-- DUDA
create table asistencia(
  idAsistencia int not null auto_increment primary key,
  horaRegistroEntrada varchar(80) DEFAULT NULL,
  horaRegistroSalida date DEFAULT NULL,
  fechaRegistro date DEFAULT NULL,
  idContratoHorario int not null,
  foreign key(idContratoHorario) references contrato_horario(idContratoHorario)
  );

-- VER COMO HACER QUE SI ESTA INCPACITADO UNA PERSONA , AL PONER SU NOMBRE PONER COMO REMPLAZO
  CREATE TABLE HoraExtra(
  idHoraExtra INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idTrabajador INT NOT NULL,
  fecha DATE DEFAULT NULL,
  hora_inicio TIME DEFAULT NULL,
  hora_fin TIME DEFAULT NULL,
  estado TINYINT(4) DEFAULT NULL,
  descripcion varchar(80) DEFAULT NULL,
  FOREIGN KEY(idTrabajador) REFERENCES trabajador(idTrabajador)
);

  create table Sueldo(
  idSuedo int not null auto_increment primary key,
  fechaRegistro date DEFAULT NULL,
  idContrato int not null,
  monto flot not null,
  foreign key(idContrato) references contrato (idContrato)
  );





