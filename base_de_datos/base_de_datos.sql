CREATE DATABASE GIORNO;
USE GIORNO;

CREATE TABLE USUARIO 
    (
      ID_USUARIO int not NULL PRIMARY KEY AUTO_INCREMENT,
      NOMBRE_USUARIO varchar(255),
      CORREO varchar(255),
      CONTRASENIA varchar(255),
      TOKEN varchar(255)
    );

CREATE TABLE VIAJE 
    (
        ID_VIAJE int not NULL PRIMARY KEY AUTO_INCREMENT,
        COSTO_BOLETO float,
        NO_ASIENTOS int,
        DESTINO varchar(255),
        PARTIDA varchar(255)
    );

CREATE TABLE ASIENTO
    (
        ID_ASIENTO int not NULL PRIMARY KEY AUTO_INCREMENT,
        ID_VIAJE int,
        ID_BOLETO int,
        FOREIGN KEY (ID_VIAJE) REFERENCES VIAJE(ID_VIAJE)
    );

CREATE TABLE HOTEL
    (
        ID_HOTEL int not NULL PRIMARY KEY AUTO_INCREMENT,
        NO_HAVITACIONES INT,
        NOMBRE varchar(255),
        UBICACION varchar(255)
    );

CREATE TABLE HABITACIONES
    (
        ID_HABITACION int not NULL PRIMARY KEY AUTO_INCREMENT,
        NO_PERSONAS INT,
        ID_HOTEL INT,
        FOREIGN KEY (ID_HOTEL) REFERENCES HOTEL(ID_HOTEL)
    );

CREATE TABLE TIPO_TRANSPORTE
    (
        ID_TIPO_TRANSPORTE INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        TIPO varchar(255)
    );

CREATE TABLE TRANSPORTE
    (
        ID_TRANSPORTE INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        ID_TIPO_TRANSPORTE INT,
        FOREIGN KEY (ID_TIPO_TRANSPORTE) REFERENCES TIPO_TRANSPORTE(ID_TIPO_TRANSPORTE)
    );

CREATE TABLE BOLETO
    (
        ID_BOLETO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        ID_VIAJE INT,
        ID_USUARIO INT,
        ID_ASIENTO INT,
        ID_HOTEL INT,
        ID_HABITACION INT,
        ID_TRANSPORTE INT,
        ID_TIPO_TRANSPORTE INT,

        FOREIGN KEY (ID_VIAJE) REFERENCES VIAJE(ID_VIAJE),
        FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO(ID_USUARIO),
        FOREIGN KEY (ID_ASIENTO) REFERENCES ASIENTO(ID_ASIENTO),
        FOREIGN KEY (ID_HOTEL) REFERENCES HOTEL(ID_HOTEL),
        FOREIGN KEY (ID_HABITACION) REFERENCES HABITACIONES(ID_HABITACION),
        FOREIGN KEY (ID_TRANSPORTE) REFERENCES TRANSPORTE(ID_TRANSPORTE),
        FOREIGN KEY (ID_TIPO_TRANSPORTE) REFERENCES TIPO_TRANSPORTE(ID_TIPO_TRANSPORTE)
    );

ALTER TABLE ASIENTO ADD FOREIGN KEY (ID_BOLETO) REFERENCES BOLETO(ID_BOLETO);

