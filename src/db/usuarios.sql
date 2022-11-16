
CREATE DATABASE pethero;

USE pethero;

DROP TABLE cuentas;
DROP TABLE guardianes;
DROP TABLE dueños;
DROP TABLE mascotas;

-- CREACION DE TABLAS

CREATE TABLE cuentas (
	id_cuenta int(11) NOT NULL AUTO_INCREMENT,
	usuario varchar(50) DEFAULT NULL,
	password varchar(16) DEFAULT NULL,
	rol varchar(20) DEFAULT NULL,
	PRIMARY KEY (id_cuenta),
	UNIQUE KEY unq_cuentas_email (usuario)
);

CREATE TABLE guardianes (
	id_guardian int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(50) DEFAULT NULL,
    direccion varchar(50) DEFAULT NULL,
    cuil varchar(32) DEFAULT NULL,
    disponibilidad boolean DEFAULT true,
    precio decimal(50) DEFAULT NULL,
    tamaño_maximo varchar(45) DEFAULT NULL,
    raza_dia varchar(45) DEFAULT NULL,
    id_cuenta int,
    PRIMARY KEY (id_guardian),
	UNIQUE KEY unq_guardianes_cuil (cuil),
    FOREIGN KEY fk_guardianes_id_cuenta (id_cuenta) REFERENCES cuentas(id_cuenta)
);

CREATE TABLE dueños (
	id_dueño int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(50) NOT NULL,
    dni varchar(50) NOT NULL,
    direccion varchar(50) NOT NULL,
    telefono int(50) NOT NULL,
    id_cuenta int,
    PRIMARY KEY (id_dueño),
	UNIQUE KEY unq_dueños_dni (dni),
    FOREIGN KEY fk_dueños_id_cuenta (id_cuenta) REFERENCES cuentas(id_cuenta)
);

CREATE TABLE mascotas (
	id_mascota int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(50) NOT NULL,
    raza varchar(50) NOT NULL,
    tamaño varchar(100) NOT NULL,
    observaciones varchar(50) NOT NULL,
    imagen varchar(512) NOT NULL,
    id_dueño int,
	PRIMARY KEY (id_mascota),
    FOREIGN KEY fk_mascotas_id_dueño (id_dueño) REFERENCES dueños(id_dueño)
);

CREATE TABLE disponibilidades (
	id_disponibilidad int(11) NOT NULL AUTO_INCREMENT,
    fecha_inicio datetime NOT NULL,
    fecha_final datetime NOT NULL,
    disponible boolean NOT NULL,
    id_guardian int,
    PRIMARY KEY (id_disponibilidad),
    FOREIGN KEY fk_disponibilidades_id_guardian (id_guardian) REFERENCES guardianes(id_guardian)
);

CREATE TABLE reservas (
	id_reserva int(11) NOT NULL AUTO_INCREMENT,
    fecha_inicio datetime NOT NULL,
    fecha_final datetime NOT NULL,
    horario datetime NOT NULL,
    estado boolean NOT NULL,
    id_mascota int,
    id_dueño int,
    id_guardian int,
    PRIMARY KEY (id_reserva),
    FOREIGN KEY fk_reserva_id_mascota (id_mascota) REFERENCES mascotas(id_mascota),
    FOREIGN KEY fk_reserva_id_dueño (id_dueño) REFERENCES dueños(id_dueño),
    FOREIGN KEY fk_reserva_id_guardian (id_guardian) REFERENCES guardianes(id_guardian)
);

-- INSERT´S DATOS DEFAULT

INSERT INTO pethero.cuentas
(id_cuenta, usuario, password, rol)
VALUES(1, 'chris@gmail.com', 'asd', 'Guardian');

INSERT INTO pethero.cuentas
(id_cuenta, usuario, password, rol)
VALUES(2, 'alan@gmail.com', 'asd', 'Dueño');

INSERT INTO pethero.guardianes
(id_guardian, nombre, direccion, cuil, disponibilidad, tamaño_maximo, raza_dia, precio, id_cuenta)
VALUES(1, 'Chris', 'Vertiz 2134', '12313123', 1, Chico, Caniche, 100, 1);

INSERT INTO pethero.dueños
(id_dueño, nombre, dni, direccion, telefono, id_cuenta)
VALUES(1, 'Alan', '40523685', 'Vertin 123', 15523156, 2);

INSERT INTO pethero.mascotas
(id_mascota, nombre, raza, tamaño, observaciones, imagen, id_dueño)
VALUES(1, 'Mona', 'Caniche', 'Chico', 'Un poco molesto', 'https://imagenes.20minutos.es/files/og_thumbnail/uploads/imagenes/2019/03/07/684425.jpg',1);

INSERT INTO pethero.mascotas
(id_mascota, nombre, raza, tamaño, observaciones, imagen, id_dueño)
VALUES(2, 'Sally', 'Perro', 'Chico', 'Duerme todo el dia', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTn8qccOYwswN-ClkaJvGDGFPITS3COMOPJY6vvRY0mCWyx_6hO2miEIMCLPYK-aKTfepQ&usqp=CAU',1);

INSERT INTO pethero.disponibilidades
(id_disponibilidad, fecha_inicio, fecha_final, disponible, id_guardian)
VALUES(1, '2022-10-24 00:00:00', '2022-10-25 23:59:59', true, 1);
