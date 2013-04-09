# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: 127.0.0.1 (MySQL 5.1.51)
# Database: mensline
# Generation Time: 2011-02-03 08:36:26 -0600
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Caracteristicas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Caracteristicas`;

CREATE TABLE `Caracteristicas` (
  `idCaracteristicas` int(11) NOT NULL AUTO_INCREMENT,
  `piezas` varchar(45) DEFAULT NULL,
  `peso` varchar(45) DEFAULT NULL,
  `medidas` varchar(45) DEFAULT NULL,
  `valorAgregado` varchar(45) DEFAULT NULL,
  `otro` varchar(45) DEFAULT NULL,
  `idGuia` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCaracteristicas`),
  KEY `idGuia` (`idGuia`),
  CONSTRAINT `idGuia` FOREIGN KEY (`idGuia`) REFERENCES `guia` (`idGuia`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

LOCK TABLES `Caracteristicas` WRITE;
/*!40000 ALTER TABLE `Caracteristicas` DISABLE KEYS */;
INSERT INTO `Caracteristicas` (`idCaracteristicas`,`piezas`,`peso`,`medidas`,`valorAgregado`,`otro`,`idGuia`)
VALUES
	(6,'1000','15KG','15X3X10','$22,000.00','NULL',8);

/*!40000 ALTER TABLE `Caracteristicas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Clasificacion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Clasificacion`;

CREATE TABLE `Clasificacion` (
  `idClasificacion` int(11) NOT NULL AUTO_INCREMENT,
  `clasificacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idClasificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

LOCK TABLES `Clasificacion` WRITE;
/*!40000 ALTER TABLE `Clasificacion` DISABLE KEYS */;
INSERT INTO `Clasificacion` (`idClasificacion`,`clasificacion`)
VALUES
	(1,'medicamento'),
	(2,'insumos'),
	(3,'documentos'),
	(4,'ambient'),
	(5,'frozen');

/*!40000 ALTER TABLE `Clasificacion` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ClasificacionGuia
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ClasificacionGuia`;

CREATE TABLE `ClasificacionGuia` (
  `idClasificacion` int(11) NOT NULL,
  `idGuia` int(11) NOT NULL,
  KEY `fk_Clasificacion_has_Guia_Guia1` (`idGuia`),
  KEY `fk_Clasificacion_has_Guia_Clasificacion1` (`idClasificacion`),
  CONSTRAINT `fk_Clasificacion_has_Guia_Clasificacion1` FOREIGN KEY (`idClasificacion`) REFERENCES `clasificacion` (`idClasificacion`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Clasificacion_has_Guia_Guia1` FOREIGN KEY (`idGuia`) REFERENCES `guia` (`idGuia`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ClasificacionGuia` WRITE;
/*!40000 ALTER TABLE `ClasificacionGuia` DISABLE KEYS */;
INSERT INTO `ClasificacionGuia` (`idClasificacion`,`idGuia`)
VALUES
	(2,8),
	(4,8);

/*!40000 ALTER TABLE `ClasificacionGuia` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table EntidadFederativa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `EntidadFederativa`;

CREATE TABLE `EntidadFederativa` (
  `idEntidadFederativa` int(11) NOT NULL AUTO_INCREMENT,
  `entidadFederativa` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEntidadFederativa`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

LOCK TABLES `EntidadFederativa` WRITE;
/*!40000 ALTER TABLE `EntidadFederativa` DISABLE KEYS */;
INSERT INTO `EntidadFederativa` (`idEntidadFederativa`,`entidadFederativa`,`status`,`codigo`)
VALUES
	(1,'Aguascalientes','ACTIVO','AGS'),
	(2,'Baja California','ACTIVO','BC'),
	(3,'Baja California Sur','ACTIVO','BCS'),
	(4,'Campeche','ACTIVO','CAM'),
	(5,'Coahuila de Zaragoza','ACTIVO','COAH'),
	(6,'Colima','ACTIVO','COL'),
	(7,'Chiapas','ACTIVO','CHIS'),
	(8,'Chihuahua','ACTIVO','CHIH'),
	(9,'Distrito Federal','ACTIVO','DF'),
	(10,'Durango','ACTIVO','DGO'),
	(11,'Guanajuato','ACTIVO','GTO'),
	(12,'Guerrero','ACTIVO','GRO'),
	(13,'Hidalgo','ACTIVO','HGO'),
	(14,'Jalisco','ACTIVO','JAL'),
	(15,'México','ACTIVO','MX'),
	(16,'Michoacán de Ocampo','ACTIVO','MICH'),
	(17,'Morelos','ACTIVO','MOR'),
	(18,'Nayarit','ACTIVO','NAY'),
	(19,'Nuevo León','ACTIVO','NL'),
	(20,'Oaxaca','ACTIVO','OAX'),
	(21,'Puebla','ACTIVO','PUE'),
	(22,'Querétaro','ACTIVO','QRO'),
	(23,'Quintana Roo','ACTIVO','QROO'),
	(24,'San Luis Potosí','ACTIVO','SLP'),
	(25,'Sinaloa','ACTIVO','SIN'),
	(26,'Sonora','ACTIVO','SON'),
	(27,'Tabasco','ACTIVO','TAB'),
	(28,'Tamaulipas','ACTIVO','TAMPS'),
	(29,'Tlaxcala','ACTIVO','TLX'),
	(30,'Veracruz de Ignacio de la Llave','ACTIVO','VER'),
	(31,'Yucatán','ACTIVO','YUC'),
	(32,'Zacatecas','ACTIVO','ZAC');

/*!40000 ALTER TABLE `EntidadFederativa` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Entrega
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Entrega`;

CREATE TABLE `Entrega` (
  `idEntrega` int(11) NOT NULL,
  `idGuia` int(11) NOT NULL,
  `nombreEntrega` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEntrega`,`idGuia`),
  KEY `fk_Entrega_Guia1` (`idGuia`),
  CONSTRAINT `fk_Entrega_Guia1` FOREIGN KEY (`idGuia`) REFERENCES `guia` (`idGuia`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table EstatusProceso
# ------------------------------------------------------------

DROP TABLE IF EXISTS `EstatusProceso`;

CREATE TABLE `EstatusProceso` (
  `idEstatusProceso` int(11) NOT NULL,
  `estatusProceso` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEstatusProceso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `EstatusProceso` WRITE;
/*!40000 ALTER TABLE `EstatusProceso` DISABLE KEYS */;
INSERT INTO `EstatusProceso` (`idEstatusProceso`,`estatusProceso`)
VALUES
	(1,'ALTA'),
	(2,'RECEPCION'),
	(3,'ENTREGA');

/*!40000 ALTER TABLE `EstatusProceso` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Guia
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Guia`;

CREATE TABLE `Guia` (
  `idGuia` int(11) NOT NULL AUTO_INCREMENT,
  `numeroDeGuia` varchar(45) NOT NULL,
  `fecha` varchar(45) NOT NULL,
  `instruccionAdicional` varchar(45) DEFAULT NULL,
  `remitente` varchar(45) NOT NULL,
  `referencias` text,
  `consignatario` varchar(45) NOT NULL,
  `contactos` text,
  `observaciones` varchar(45) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEstatusProceso` int(11) NOT NULL,
  `origen` int(11) NOT NULL,
  `destino` int(11) NOT NULL,
  PRIMARY KEY (`idGuia`),
  UNIQUE KEY `numeroDeGuia_UNIQUE` (`numeroDeGuia`),
  KEY `fk_Guia_Usuario1` (`idUsuario`),
  KEY `fk_Guia_EstatusProceso1` (`idEstatusProceso`),
  KEY `fk_Guia_EntidadFederativa1` (`origen`),
  KEY `fk_Guia_EntidadFederativa2` (`destino`),
  CONSTRAINT `fk_Guia_EntidadFederativa1` FOREIGN KEY (`origen`) REFERENCES `entidadfederativa` (`idEntidadFederativa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Guia_EntidadFederativa2` FOREIGN KEY (`destino`) REFERENCES `entidadfederativa` (`idEntidadFederativa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Guia_EstatusProceso1` FOREIGN KEY (`idEstatusProceso`) REFERENCES `estatusproceso` (`idEstatusProceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Guia_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

LOCK TABLES `Guia` WRITE;
/*!40000 ALTER TABLE `Guia` DISABLE KEYS */;
INSERT INTO `Guia` (`idGuia`,`numeroDeGuia`,`fecha`,`instruccionAdicional`,`remitente`,`referencias`,`consignatario`,`contactos`,`observaciones`,`idUsuario`,`idEstatusProceso`,`origen`,`destino`)
VALUES
	(8,'MLP-001','2011-02-02 05:04 PM','SIN INSTRUCCIONES ADICIONALES','GABRIEL RAMIREZ MELGAREJO','JAVIER ROJAS SOLIS','Javier Rojas Solis','LA SECRETARIA ','zdsfasdfasdf',1,1,4,8);

/*!40000 ALTER TABLE `Guia` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Instruccion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Instruccion`;

CREATE TABLE `Instruccion` (
  `idInstruccion` int(11) NOT NULL AUTO_INCREMENT,
  `instruccion` varchar(45) NOT NULL,
  PRIMARY KEY (`idInstruccion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

LOCK TABLES `Instruccion` WRITE;
/*!40000 ALTER TABLE `Instruccion` DISABLE KEYS */;
INSERT INTO `Instruccion` (`idInstruccion`,`instruccion`)
VALUES
	(1,'ENTREGAR OFICINA DE CORREOS'),
	(2,'TENER CUIDADO CON EL PAQUETE'),
	(3,'CUIDADO CON EL PERRO'),
	(6,'nueva instruccion');

/*!40000 ALTER TABLE `Instruccion` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table InstruccionGuia
# ------------------------------------------------------------

DROP TABLE IF EXISTS `InstruccionGuia`;

CREATE TABLE `InstruccionGuia` (
  `idGuia` int(11) NOT NULL,
  `idInstruccion` int(11) NOT NULL,
  KEY `fk_Guia_has_Instruccion_Instruccion1` (`idInstruccion`),
  KEY `fk_Guia_has_Instruccion_Guia1` (`idGuia`),
  CONSTRAINT `fk_Guia_has_Instruccion_Guia1` FOREIGN KEY (`idGuia`) REFERENCES `guia` (`idGuia`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Guia_has_Instruccion_Instruccion1` FOREIGN KEY (`idInstruccion`) REFERENCES `instruccion` (`idInstruccion`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `InstruccionGuia` WRITE;
/*!40000 ALTER TABLE `InstruccionGuia` DISABLE KEYS */;
INSERT INTO `InstruccionGuia` (`idGuia`,`idInstruccion`)
VALUES
	(8,1),
	(8,6);

/*!40000 ALTER TABLE `InstruccionGuia` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Recepcion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Recepcion`;

CREATE TABLE `Recepcion` (
  `idRecepcion` int(11) NOT NULL AUTO_INCREMENT,
  `idGuia` int(11) NOT NULL,
  `nombreRecibe` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(45) NOT NULL,
  PRIMARY KEY (`idRecepcion`,`idGuia`),
  KEY `fk_Recepcion_Guia1` (`idGuia`),
  CONSTRAINT `fk_Recepcion_Guia1` FOREIGN KEY (`idGuia`) REFERENCES `guia` (`idGuia`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;



# Dump of table Usuario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Usuario`;

CREATE TABLE `Usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `correoElectronico` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` (`idUsuario`,`nombreUsuario`,`nombre`,`password`,`correoElectronico`)
VALUES
	(1,'admin','Operador','admin','a@a.com');

/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;





/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
