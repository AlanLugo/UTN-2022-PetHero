-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: 192.168.0.115    Database: pethero
-- ------------------------------------------------------
-- Server version	5.6.51

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cuentas`
--

DROP TABLE IF EXISTS `cuentas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuentas` (
  `id_cuenta` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_cuenta`),
  UNIQUE KEY `unq_cuentas_email` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuentas`
--

LOCK TABLES `cuentas` WRITE;
/*!40000 ALTER TABLE `cuentas` DISABLE KEYS */;
INSERT INTO `cuentas` VALUES (1,'chris@gmail.com','asd','Guardian'),(2,'alan@gmail.com','asd','Dueño'),(3,'asd@gmail.com','asd','Dueño'),(5,'seba@gmail.com','asd','Dueño'),(6,'adrian@gmail.com','asd','Guardian'),(7,'augusto@gmail.com','asd','Dueño'),(8,'mathias@gmail.com','asd','Guardian'),(11,'nahuel@gmail.com','asd','Guardian'),(15,'marcos@gmail.com','asd','Guardian'),(16,'juan@gmail.com','asd','Guardian'),(17,'chris@gmail.comm','asd','Guardian'),(18,'chris@gmail.comhhh','asd','Guardian'),(19,'chris@gmail.comiuiu','asd','Guardian'),(20,'jose@gmail.com','asd','Guardian');
/*!40000 ALTER TABLE `cuentas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disponibilidades`
--

DROP TABLE IF EXISTS `disponibilidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disponibilidades` (
  `id_disponibilidad` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` datetime NOT NULL,
  `fecha_final` datetime NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `id_guardian` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_disponibilidad`),
  KEY `fk_disponibilidades_id_guardian` (`id_guardian`),
  CONSTRAINT `disponibilidades_ibfk_1` FOREIGN KEY (`id_guardian`) REFERENCES `guardianes` (`id_guardian`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disponibilidades`
--

LOCK TABLES `disponibilidades` WRITE;
/*!40000 ALTER TABLE `disponibilidades` DISABLE KEYS */;
INSERT INTO `disponibilidades` VALUES (1,'2022-11-19 12:00:00','2022-11-20 12:00:00',1,1);
/*!40000 ALTER TABLE `disponibilidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dueños`
--

DROP TABLE IF EXISTS `dueños`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dueños` (
  `id_dueño` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `dni` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` int(50) NOT NULL,
  `id_cuenta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_dueño`),
  UNIQUE KEY `unq_dueños_dni` (`dni`),
  KEY `fk_dueños_id_cuenta` (`id_cuenta`),
  CONSTRAINT `dueños_ibfk_1` FOREIGN KEY (`id_cuenta`) REFERENCES `cuentas` (`id_cuenta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dueños`
--

LOCK TABLES `dueños` WRITE;
/*!40000 ALTER TABLE `dueños` DISABLE KEYS */;
INSERT INTO `dueños` VALUES (1,'Alan','40523685','Vertin 123',15523156,2),(2,'asd','12123123','asd 123',1231231223,3),(4,'Augusto','32123321','asd 123',2147483647,7);
/*!40000 ALTER TABLE `dueños` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guardianes`
--

DROP TABLE IF EXISTS `guardianes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guardianes` (
  `id_guardian` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `cuil` varchar(32) DEFAULT NULL,
  `disponibilidad` tinyint(1) DEFAULT '1',
  `precio` decimal(50,0) DEFAULT NULL,
  `id_tipo_mascota` int(11) DEFAULT NULL,
  `id_tamaño_mascota` int(11) DEFAULT NULL,
  `id_cuenta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_guardian`),
  UNIQUE KEY `unq_guardianes_cuil` (`cuil`),
  KEY `fk_guardianes_id_tipo_mascota` (`id_tipo_mascota`),
  KEY `fk_guardianes_id_tamaño_mascota` (`id_tamaño_mascota`),
  KEY `fk_guardianes_id_cuenta` (`id_cuenta`),
  CONSTRAINT `guardianes_ibfk_1` FOREIGN KEY (`id_tipo_mascota`) REFERENCES `tipos_mascota` (`id_tipo_mascota`),
  CONSTRAINT `guardianes_ibfk_2` FOREIGN KEY (`id_tamaño_mascota`) REFERENCES `tamaños_mascota` (`id_tamaño_mascota`),
  CONSTRAINT `guardianes_ibfk_3` FOREIGN KEY (`id_cuenta`) REFERENCES `cuentas` (`id_cuenta`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guardianes`
--

LOCK TABLES `guardianes` WRITE;
/*!40000 ALTER TABLE `guardianes` DISABLE KEYS */;
INSERT INTO `guardianes` VALUES (1,'Chris','Vertiz 2134','12313123',1,2500,2,3,1);
/*!40000 ALTER TABLE `guardianes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mascotas`
--

DROP TABLE IF EXISTS `mascotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mascotas` (
  `id_mascota` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `observaciones` varchar(50) NOT NULL,
  `imagen` varchar(512) NOT NULL,
  `id_tipo_mascota` int(11) DEFAULT NULL,
  `id_raza_mascota` int(11) DEFAULT NULL,
  `id_tamaño_mascota` int(11) DEFAULT NULL,
  `id_dueño` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mascota`),
  KEY `fk_mascotas_id_tipo_mascota` (`id_tipo_mascota`),
  KEY `fk_mascotas_id_raza_mascota` (`id_raza_mascota`),
  KEY `fk_mascotas_id_tamaño_mascota` (`id_tamaño_mascota`),
  KEY `fk_mascotas_id_dueño` (`id_dueño`),
  CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`id_tipo_mascota`) REFERENCES `tipos_mascota` (`id_tipo_mascota`),
  CONSTRAINT `mascotas_ibfk_2` FOREIGN KEY (`id_raza_mascota`) REFERENCES `razas_mascota` (`id_raza_mascota`),
  CONSTRAINT `mascotas_ibfk_3` FOREIGN KEY (`id_tamaño_mascota`) REFERENCES `tamaños_mascota` (`id_tamaño_mascota`),
  CONSTRAINT `mascotas_ibfk_4` FOREIGN KEY (`id_dueño`) REFERENCES `dueños` (`id_dueño`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mascotas`
--

LOCK TABLES `mascotas` WRITE;
/*!40000 ALTER TABLE `mascotas` DISABLE KEYS */;
INSERT INTO `mascotas` VALUES (1,'Mona','Un poco molesto','https://imagenes.20minutos.es/files/og_thumbnail/uploads/imagenes/2019/03/07/684425.jpg',2,4,1,1),(2,'Sally','Duerme todo el dia','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTn8qccOYwswN-ClkaJvGDGFPITS3COMOPJY6vvRY0mCWyx_6hO2miEIMCLPYK-aKTfepQ&usqp=CAU',2,1,1,1),(5,'Alan','eeaa','../uploads/imagenes/mascota/5.png',2,2,1,1),(6,'Robertinho','eeeeeeeee','../uploads/imagenes/mascota/6.png',1,2,2,2),(7,'Nanana','ragdoll','../uploads/imagenes/mascota/7.png',2,6,1,2),(10,'Perro Prueba Borrar','Hola me van a borrar','../uploads/imagenes/mascota/10.png',1,2,3,1);
/*!40000 ALTER TABLE `mascotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `razas_mascota`
--

DROP TABLE IF EXISTS `razas_mascota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `razas_mascota` (
  `id_raza_mascota` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  `id_tipo_mascota` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_raza_mascota`),
  KEY `fk_raza_id_tipo_mascota` (`id_tipo_mascota`),
  CONSTRAINT `razas_mascota_ibfk_1` FOREIGN KEY (`id_tipo_mascota`) REFERENCES `tipos_mascota` (`id_tipo_mascota`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `razas_mascota`
--

LOCK TABLES `razas_mascota` WRITE;
/*!40000 ALTER TABLE `razas_mascota` DISABLE KEYS */;
INSERT INTO `razas_mascota` VALUES (1,'Caniche',1),(2,'Labrador',1),(3,'Pitbull',1),(4,'Siamés',2),(5,'Gato persa',2),(6,'Gato ragdoll',2);
/*!40000 ALTER TABLE `razas_mascota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` datetime NOT NULL,
  `fecha_final` datetime NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `id_dueño` int(11) DEFAULT NULL,
  `id_guardian` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `fk_reserva_id_mascota` (`id_mascota`),
  KEY `fk_reserva_id_dueño` (`id_dueño`),
  KEY `fk_reserva_id_guardian` (`id_guardian`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas` (`id_mascota`),
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_dueño`) REFERENCES `dueños` (`id_dueño`),
  CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`id_guardian`) REFERENCES `guardianes` (`id_guardian`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (1,'2022-11-19 12:00:00','2022-11-20 12:00:00',0,2,1,1),(4,'2022-11-19 12:00:00','2022-11-20 12:00:00',2,2,1,1);
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tamaños_mascota`
--

DROP TABLE IF EXISTS `tamaños_mascota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tamaños_mascota` (
  `id_tamaño_mascota` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  PRIMARY KEY (`id_tamaño_mascota`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tamaños_mascota`
--

LOCK TABLES `tamaños_mascota` WRITE;
/*!40000 ALTER TABLE `tamaños_mascota` DISABLE KEYS */;
INSERT INTO `tamaños_mascota` VALUES (1,'Chico'),(2,'Mediano'),(3,'Grande');
/*!40000 ALTER TABLE `tamaños_mascota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_mascota`
--

DROP TABLE IF EXISTS `tipos_mascota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_mascota` (
  `id_tipo_mascota` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  PRIMARY KEY (`id_tipo_mascota`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_mascota`
--

LOCK TABLES `tipos_mascota` WRITE;
/*!40000 ALTER TABLE `tipos_mascota` DISABLE KEYS */;
INSERT INTO `tipos_mascota` VALUES (1,'Perro'),(2,'Gato');
/*!40000 ALTER TABLE `tipos_mascota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'pethero'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-19  4:37:53
