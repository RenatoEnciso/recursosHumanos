-- COLOCAR EN USUARIO LA   firma longtext para firma del registrador, 
DROP DATABASE IF EXISTS bdregistrocivil;
CREATE DATABASE bdregistrocivil;
USE bdregistrocivil;

--  TABLAS FUERTES
CREATE TABLE persona (
  DNI CHAR(8) primary key not null,
  Apellido_Paterno VARCHAR(30)  ,
  Apellido_Materno VARCHAR(30)  ,
  Nombres VARCHAR(50)  ,
  sexo VARCHAR(20)  ,
  estadocivil varchar(20),
  departamento varchar(50),
  provincia    varchar(50),
  distrito      varchar(50),
  estado TINYINT NOT NULL,
  direccion varchar(50),
  fecha_nacimiento date
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
nombres varchar(50),
domicilio varchar(30),
sexo varchar(30),
foreign key(idacta) references acta(idacta)
);

create table acta_defuncion(
idActa int primary key,
fecha_fallecido date,
edad int,
dniFallecido char(8),
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
VALUES ("MesaPartes"),("Registrador"),("Administrador"),("Administrador de Sistemas");

Insert Into Persona
(DNI, Apellido_Paterno , Apellido_Materno ,Nombres ,sexo ,estadocivil ,departamento,provincia,distrito,estado , direccion,fecha_nacimiento)
values
('11111111',"Baltodano","Sanchez","Maria Fernanda","F","Soltera","Lima","lima","Miraflores",1,"Hermanos Angulos 123",'1970-03-02'),
('22222222','Villacorta','Sacristan','Rosario','F','Soltera',"La libertad","Trujillo","El porvenir",1,'Jose Olaya 123','1966-03-02'),
('33333333','Montes','Geronimo','Jorge','F','Soltera',"Lima","lima","San isidro",1,'Garcilazo de la Vega 123','1980-03-02'),
('44444444','Monzon','Zavaleta','Alfonso','M','Soltero',"Lima","lima","Surco",1,'Los Incas 123','1975-03-02'),
('55555555','Rodriguez','Barrigas','Jose','M','Soltero',"Lima","lima","Santa Anita",1,'Los Incas 254','1971-03-02'),
('66666666','Fernandez','Jurado','Pedro','M','Soltero',"Lima","lima","Chorrillos",1,'Los Incas 654','1972-03-02'),
('77777777','Marco','Garcia','Miguel','M','Soltero',"La libertad","Trujillo","Florencia de Mora",1,'Jose Olaya 594','1973-03-02'),
('88888888','Diaz','Festivo','Domingo','M','Soltero',"La libertad","Trujillo","Trujillo",1,'Jose Olata 789','1968-03-02');

-- Nuevas tablas
create table TIPO_DNI(
  idTipoDni   int AUTO_INCREMENT PRIMARY KEY,
  tipoDNI varchar(50)
);

INSERT INTO TIPO_DNI(tipoDNI) VALUES ("Original"),("Duplicado");


CREATE TABLE TIPO_SOLICITUD_DNI(
  idTipoSolicitud int AUTO_INCREMENT PRIMARY KEY,
  tipoSolicitud  varchar(50)
);

INSERT INTO TIPO_SOLICITUD_DNI(tipoSolicitud) VALUES ("Primera Vez"),("Duplicado"),("Renovacion");


CREATE TABLE SOLICITUD_DNI(
  idSolicitud    int AUTO_INCREMENT PRIMARY KEY,
  idTipoSolicitud   int NOT NULL,
  DNI             char(8) NOT NULL,
  file_foto       varchar(255),
  file_voucher    varchar(255),
  cod_servicio_agua   varchar(20),
  cod_servicio_luz   varchar(20),
  solComentario      varchar(250),
  solEstado          TINYINT,
  solFecha            datetime
);

alter table SOLICITUD_DNI
  ADD FOREIGN KEY (idTipoSolicitud) REFERENCES TIPO_SOLICITUD_DNI(idTipoSolicitud),
  ADD FOREIGN KEY (DNI) REFERENCES Persona(DNI);

ALTER TABLE SOLICITUD_DNI
  MODIFY COLUMN solEstado ENUM('Pendiente', 'En Proceso', 'Aceptado', 'Rechazado', 'Entregado') NOT NULL DEFAULT 'Pendiente';


CREATE TABLE DNI(
  DNI                   char(8) PRIMARY KEY,
  idTipoDni             int NOT NULL,
  dniFechaInscripcion   datetime,
  dniFechaEmision       datetime,
  dniFechaCaducidad     datetime,
  dniEstado             TINYINT(1)
);

alter table DNI
  ADD FOREIGN KEY (DNI) REFERENCES Persona(DNI),
  ADD FOREIGN KEY (idTipoDni) REFERENCES TIPO_DNI(idTipoDni);



