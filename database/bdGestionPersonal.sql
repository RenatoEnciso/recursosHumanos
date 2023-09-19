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
  estado tinyint(4) DEFAULT NULL,
  foreign key(idCargo) references cargo(idCargo)
);
create table entrevista(
  idEntrevista int not null auto_increment primary key,
  DNI char(8) NOT NULL,
  idOferta int not null,
  fecha date DEFAULT NULL,
  observacion varchar(80) DEFAULT NULL,
  estado tinyint(4) DEFAULT NULL,
  foreign key(idOferta) references oferta(idOferta),
  foreign key(DNI) references persona(DNI)
  );
ALTER TABLE `bdregistrocivil`.`roles` 
ADD COLUMN `estado` TINYINT(4) NULL DEFAULT NULL AFTER `nombreRol`;

INSERT INTO roles (`idRol`, `nombreRol`) VALUES
(5, 'Encargado contrato',1),
(6, 'Encargado de RRHH',1),
(7, 'Administrador',1)