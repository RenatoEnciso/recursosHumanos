-- COLOCAR EN USUARIO LA   firma longtext para firma del registrador, 
DROP DATABASE IF EXISTS bdregistrocivil;
CREATE DATABASE bdregistrocivil;

USE bdregistrocivil;
--  TABLAS FUERTES

CREATE TABLE persona (
  DNI CHAR(8) primary key not null,
  Apellido_Paterno VARCHAR(20)  ,
  Apellido_Materno VARCHAR(20)  ,
  Nombres VARCHAR(30)  ,
  sexo VARCHAR(20)  ,
  estadocivil varchar(20),
  nacionalidad varchar(30),
  estado TINYINT NOT NULL,
  direccion varchar(50)
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
estado VARCHAR(30),
idtipo int,
foreign key (idtipo) REFERENCES tipoFicha(idtipo)
);
CREATE TABLE acta(
  idActa  INT,
  fecha_registro DATE  ,
  observacion VARCHAR(30) ,
  lugar_ocurrencia VARCHAR(30)  ,
  estado  TINYINT ,
  nombreRegistradorCivil varchar(50),
  localidad varchar(50),
  foreign key (idActa) references ficha_registro(idficha),
  PRIMARY KEY (idActa)
);

create table acta_matrimonio(
  idActa int primary key,
  fecha_matrimonio date,
  DNIEsposo char(08),
  DNIEsposa char(08),
  foreign key(idacta) references acta(idacta)
);

create table acta_nacimiento(
idActa int primary key,
fecha_nacimiento date,
DNIPadre char(08),
DNIMadre char(08),
nombres varchar(30),
domicilio varchar(30),
sexo varchar(30),
foreign key(idacta) references acta(idacta)
);

create table acta_defuncion(
idActa int primary key,
fecha_fallecido date,
edad int,
lugarNacimiento varchar(50),
dniFallecido char(8),
sexo varchar(30),
nombreDeclarante varchar(50),
 firma_declarante longtext,
  foreign key(idacta) references acta(idacta)
);


CREATE TABLE ACTA_PERSONA(
  idActaPersona int AUTO_INCREMENT NOT NULL,
  idActa int NOT NULL,
  DNI  char(8) NOT NULL,
  estado TINYINT NOT NULL,
  funcion varchar(20),
  FOREIGN KEY (idActa) REFERENCES acta(idActa),
  FOREIGN KEY (DNI) REFERENCES persona(DNI),
  PRIMARY KEY(idActaPersona)
);

CREATE TABLE SOLICITUD (
  idSolicitud  int AUTO_INCREMENT NOT NULL,
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
  idActaSolicitada  int AUTO_INCREMENT NOT NULL,
  idActa  INT NOT NULL, 
  idSolicitud  int NOT NULL,
  PRIMARY KEY (idActaSolicitada),
  FOREIGN KEY (idActa) REFERENCES Acta(idActa),
  FOREIGN KEY (idSolicitud) REFERENCES SOLICITUD(idSolicitud)
);

INSERT INTO tipoFicha(nombre) 
VALUES ("Nacimiento"),("Matrimonio"),("Defunción");

INSERT INTO roles(nombreRol) 
VALUES ("MesaPartes"),("Registrador"),("Administrador");