DROP DATABASE IF EXISTS bdregistrocivil;
CREATE DATABASE bdregistrocivil;

USE bdregistrocivil;
--  TABLAS FUERTES
CREATE TABLE TipoActa(
  idTipoActa INT(11) AUTO_INCREMENT NOT NULL,
  nombre varchar(40) NOT NULL,
  PRIMARY KEY (idTipoActa)
);

CREATE TABLE LIBRO(
  idLibro INT AUTO_INCREMENT NOT NULL,
  nroLibro INT(2),
  PRIMARY KEY(idLibro)
);

CREATE TABLE FOLIO(
  idFolio INT AUTO_INCREMENT NOT NULL,
  nroFolio INT(2),
  PRIMARY KEY(idFolio)
);

CREATE TABLE persona (
  DNI CHAR(8) NOT NULL,
  Apellido_Paterno VARCHAR(20)  ,
  Apellido_Materno VARCHAR(20)  ,
  Nombres VARCHAR(30)  ,
  sexo VARCHAR(20)  ,
  estado TINYINT NOT NULL,
  PRIMARY KEY (DNI)
);

-- TABLAS DEBILES
CREATE TABLE acta(
  idActa  INT(11) AUTO_INCREMENT,
  fecha_registro DATE  ,
  hora_registro TIME  ,
  observacion VARCHAR(30)  ,
  archivo VARCHAR(1000)  ,
  fecha_Acta DATE  ,
  lugar_Acta VARCHAR(30)  ,
  idTipoActa INT(11),
  idFolio INT(2),
  idLibro INT(2),
  estado  TINYINT NOT NULL,
  FOREIGN KEY (idTipoActa) REFERENCES TipoActa (idTipoActa),
  FOREIGN KEY (idFolio) REFERENCES FOLIO(idFolio),
  FOREIGN KEY (idLibro) REFERENCES LIBRO(idLibro),
  PRIMARY KEY (idActa)
);

CREATE TABLE ACTA_PERSONA(
  idActaPersona int(11) AUTO_INCREMENT NOT NULL,
  idActa int(11) NOT NULL,
  DNI  char(8) NOT NULL,
  estado TINYINT NOT NULL,
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
  pago TINYINT,
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


INSERT INTO TipoActa(nombre) 
VALUES ("Nacimiento"),("Matrimonio"),("Defunción");


INSERT INTO LIBRO(nroLibro) 
VALUES ('1'),('2'),('3'),('4'),('5'),('6'),('7'),('8'),('9'),('10');
INSERT INTO FOLIO(nroFolio) 
VALUES ('1'),('2'),('3'),('4'),('5'),('6'),('7'),('8'),('9'),('10');
