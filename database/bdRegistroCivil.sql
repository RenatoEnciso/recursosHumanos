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
INSERT INTO tipoFicha(nombre) 
VALUES ("Nacimiento"),("Matrimonio"),("Defunción");

INSERT INTO roles(nombreRol) 
VALUES ("MesaPartes"),("Registrador"),("Administrador"),("Administrador de Sistemas"),("Invitado");


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


CREATE TABLE acta_persona(
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

Insert Into Persona
(DNI, Apellido_Paterno , Apellido_Materno ,Nombres ,sexo ,estadocivil ,departamento,provincia,distrito,estado , direccion,fecha_nacimiento)
values
('12345678',"Gonzalez","Perez","Maria Fernanda","F","Soltera","Lima","Lima","Miraflores",1,"Av. Pardo 123",'1990-01-01'),
('23456789',"Lopez","Gomez","Rosario Jazmin","F","Soltera","La Libertad","Trujillo","El Porvenir",1,"Calle Bolivar 456",'1991-02-02'),
('34567890',"Martinez","Rodriguez","Jorge Piter","M","Soltero","Lima","Lima","San Isidro",1,"Av. Petit Thouars 789",'1993-03-03'),
('45678901',"Fernandez","Sanchez","Alfonso Luis","M","Soltero","Lima","Lima","Surco",1,"Calle Los Alamos 159",'1994-04-04'),
('32109876',"Vargas","Rojas","Juan Jose","M","Soltero","La Libertad","Trujillo","Florencia de Mora",1,"Av. Mansiche 852",'1998-07-07'),
('21098765',"Mendoza","Paredes","Juan Diego","M","Soltero","La Libertad","Trujillo","Trujillo",1,"Calle San Martin 963",'1999-08-08'),
('10987654',"Castillo","Cordova","Maria Teresa","F","Soltera","Lima","Lima","Miraflores",1,"Av. Larco 741",'2000-09-09'),
('09876543',"Gutierrez","Vega","Maria Pia","F","Soltera","Lima","Lima","Miraflores",1,"Calle Shell 852",'2001-10-10'),
('56789012',"Garcia","Ramirez","Sandra Anais","F","Soltera","Lima","Lima","Santa Anita",1,"Av. Los Heroes 654",'2002-05-05'),
('67890123',"Morales","Torres","Pedro Beto","M","Soltero","Lima","Lima","Chorrillos",1,"Calle Los Pinos 321",'2003-06-06'),
('78901234',"Rojas","Vargas","Jose Miguel","M","Soltero","La Libertad","Trujillo","Florencia de Mora",1,"Av. Mansiche 987",'2004-07-07'),
('89012345',"Paredes","Mendoza","Diego Eduardo","M","Soltero","La Libertad","Trujillo","Trujillo",1,"Calle San Martin 654",'2005-08-08'),
('90123456',"Cordova","Castillo","Maria Isabel","F","Soltera","La Libertad","Trujillo","La esperanza",1,"Av. Larco 321",'2006-09-09'),
('01234567',"Vega","Gutierrez","Maria Paula","F","Soltera","La Libertad","Trujillo","Huanchaco",1,"Calle Shell 147",'2000-10-10'),
('98765432',"Perez","Gonzalez","Juan Carlos","M","Soltero","La Libertad","Trujillo","Salaverry",1,"Av. Benavides 852",'2001-01-01'),
('87654321',"Gomez","Lopez","Juan Manuel","M","Soltero","La Libertad","Trujillo","Florencia de mora",1,"Calle Bolivar 963",'2002-02-02'),
('76543210',"Rodriguez","Martinez","Juan Pedro","M","Soltero","Lima","Lima","San Isidro",1,"Av. Petit Thouars 741",'2003-03-03'),
('65432109',"Sanchez","Fernandez","Juan Luis","M","Soltero","Lima","Lima","Surco",1,"Calle Los Alamos 852",'2004-04-04'),
('54321098',"Ramirez","Garcia","Juanita Rosa","F","Soltera","Lima","Lima","Santa Anita",1,"Av. Los Heroes 963",'2005-05-05'),
('43210987',"Torres","Morales","Juanita Carmen","F","Soltera","Lima","Lima","Chorrillos",1,"Calle Los Pinos 741",'2006-06-06');


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
  idSolicitud         int AUTO_INCREMENT PRIMARY KEY,
  idTipoSolicitud     int NOT NULL,
  DNI_Titular         char(8) NOT NULL,
  nombre_solicitante  varchar(50),
  valida_foto         TINYINT(1),
  valida_firma        TINYINT(1),
  codigo_voucher      varchar(15),
  codigo_recibo       varchar(15),
  solMotivo           varchar(250),
  fechaEnvioReg       datetime,
  fechaRespuestaReg   datetime,
  solEstado           TINYINT,
  solFecha            datetime
);

alter table SOLICITUD_DNI
  ADD FOREIGN KEY (idTipoSolicitud) REFERENCES TIPO_SOLICITUD_DNI(idTipoSolicitud),
  ADD FOREIGN KEY (DNI_Titular) REFERENCES Persona(DNI);

ALTER TABLE SOLICITUD_DNI
  MODIFY COLUMN solEstado ENUM('Pendiente', 'En Proceso', 'Aceptado', 'Rechazado', 'Entregado') NOT NULL DEFAULT 'Pendiente';


CREATE TABLE Registro_DNI(
  idRegistro            int AUTO_INCREMENT PRIMARY KEY,
  idSolicitudDNI        INT NOT NULL,
  DNI                   char(8) NOT NULL,
  idTipoDni             int NOT NULL,
  file_foto             varchar(255),
  file_firma            varchar(255),
  direccion             varchar(100),
  dniFechaEmision       datetime,
  dniFechaCaducidad     datetime,
  regFecha              datetime,
  regEstado             TINYINT(1)
);

alter table Registro_DNI
  ADD FOREIGN KEY (DNI) REFERENCES Persona(DNI),
  ADD FOREIGN KEY(idSolicitudDNI) REFERENCES SOLICITUD_DNI(idSolicitud),
  ADD FOREIGN KEY (idTipoDni) REFERENCES TIPO_DNI(idTipoDni);
