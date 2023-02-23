DROP DATABASE IF EXISTS bdregistrocivil;
CREATE DATABASE bdregistrocivil;

USE bdregistrocivil;
--  TABLAS FUERTES

CREATE TABLE persona (
  DNI CHAR(8) NOT NULL,
  Apellido_Paterno VARCHAR(20)  ,
  Apellido_Materno VARCHAR(20)  ,
  Nombres VARCHAR(30)  ,
  sexo VARCHAR(20)  ,
  estado TINYINT NOT NULL,
  PRIMARY KEY (DNI)
);

create table tipoFicha(
  idtipo int AUTO_INCREMENT not null PRIMARY KEY,
  nombre varchar(50)
);

create table roles(
  idRol int AUTO_INCREMENT not null PRIMARY KEY,
  nombreRol varchar(50)
);

-- TABLAS DEBILES
create table ficha_registro(
idficha int AUTO_INCREMENT primary key,
fecha_registro date,
ruta_certificado longtext,
idtipo int,
foreign key (idtipo) REFERENCES tipoFicha(idtipo)

);
CREATE TABLE acta(
  idActa  INT(11),
  fecha_registro DATE  ,
  observacion VARCHAR(30)  ,
  fecha_Acta DATE  ,
  lugar_Acta VARCHAR(30)  ,
  estado  TINYINT NOT NULL,
  foreign key (idActa) references ficha_registro(idficha),
  PRIMARY KEY (idActa)
);

CREATE TABLE ACTA_PERSONA(
  idActaPersona int(11) AUTO_INCREMENT NOT NULL,
  idActa int(11) NOT NULL,
  DNI  char(8) NOT NULL,
  estado TINYINT NOT NULL,
  funcion varchar(20),
  FOREIGN KEY (idActa) REFERENCES acta(idActa),
  FOREIGN KEY (DNI) REFERENCES persona(DNI),
  PRIMARY KEY(idActaPersona)
);

CREATE TABLE SOLICITUD (
  idSolicitud  int(11) AUTO_INCREMENT NOT NULL,
  DNISolicitante  char(8) NOT NULL,
  fechaSolicitud DATE ,
  horaSolicitud TIME , 
  observacion VARCHAR(30),
  estado TINYINT not null,
  pago longtext,
  PRIMARY KEY (idSolicitud),
  FOREIGN KEY (DNISolicitante) REFERENCES persona(DNI)
);

CREATE TABLE LISTA_SOLICITUD (
  idActaSolicitada  int(11) AUTO_INCREMENT NOT NULL,
  idActa  INT(11) NOT NULL, 
  idSolicitud  int(11) NOT NULL,
  PRIMARY KEY (idActaSolicitada),
  FOREIGN KEY (idActa) REFERENCES Acta(idActa),
  FOREIGN KEY (idSolicitud) REFERENCES SOLICITUD(idSolicitud)
);

INSERT INTO tipoFicha(nombre) 
VALUES ("Nacimiento"),("Matrimonio"),("Defunción");
