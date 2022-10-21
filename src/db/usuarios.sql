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
    disponibilidad boolean DEFAULT TRUE,
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