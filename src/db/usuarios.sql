
CREATE DATABASE pethero;

USE pethero;


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


-- INSERT´S DATOS DEFAULT

INSERT INTO pethero.cuentas
(id_cuenta, usuario, password, rol)
VALUES(1, 'chris@gmail.com', 'asd', 'Guardian');

INSERT INTO pethero.cuentas
(id_cuenta, usuario, password, rol)
VALUES(2, 'alan@gmail.com', 'asd', 'Dueño');

INSERT INTO pethero.guardianes
(id_guardian, nombre, direccion, cuil, disponibilidad, precio, id_cuenta)
VALUES(1, 'Chris', 'Vertiz 2134', '12313123', 1, 100, 1);

INSERT INTO pethero.dueños
(id_dueño, nombre, dni, direccion, telefono, id_cuenta)
VALUES(1, 'Alan', '40523685', 'Vertin 123', 15523156, 2);

