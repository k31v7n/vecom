-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: cventa
-- ------------------------------------------------------
-- Server version	5.7.21-1

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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `nit` varchar(45) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` int(12) DEFAULT NULL,
  `correo` varchar(40) DEFAULT NULL,
  `cliente_tipo` int(11) NOT NULL,
  `aplica_descuento` tinyint(1) NOT NULL DEFAULT '0',
  `monto_descuento` decimal(10,2) NOT NULL DEFAULT '0.00',
  `aplica_iva` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_sis` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `empresa` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Bryam Magzul','C/F','5ta calle 3-80 Zona 1',49806871,'bryam.magzul.12@gmail.com',1,1,10.00,1,1,'2019-06-16 03:19:54',1,1),(2,'Test 1','cf','4ta calle',18273646,'test1@gmail.com',1,1,1.00,1,1,'2019-06-20 23:40:05',1,1),(3,'Test 2','cf','4ta calle',18273646,'test2@gmail.com',1,1,1.00,1,1,'2019-06-20 23:40:20',1,1),(4,'Test 3','cf','6ta avenida',54729200,'text3@gmail.com',1,1,20.00,1,1,'2019-06-21 03:43:27',1,1),(5,'Mynor Lopez','149562-8','1ra calle',19283847,'mlopez@yahoo.com',0,0,0.00,1,1,'2019-06-23 05:27:56',1,1),(6,'Mynor Lopez','149562-8','1ra calle',19283847,'mlopez@yahoo.com',0,0,0.00,1,1,'2019-06-23 05:28:26',1,1),(7,'Mynor Lopez','149562-8','1ra calle',19283847,'mlopez@yahoo.com',0,0,0.00,1,1,'2019-06-23 05:31:08',1,1),(8,'Mynor Lopez','149562-5','1ra calle',19283847,'mlopez@yahoo.com',0,0,0.00,1,1,'2019-06-23 05:32:01',1,1),(9,'Test','19282','ADAS',91828376,'asd@gmail.com',0,0,0.00,1,1,'2019-06-27 04:16:24',1,1),(10,'dsa','928187','test2',28371667,'soporte@vips.com',0,0,0.00,1,1,'2019-06-27 04:17:03',1,1),(11,'Bryam Doneli','3109','5ta calle 3-80 Zona 1 patzun',58517578,'bryam.magzul.12@gmail.com',0,1,2.00,1,1,'2019-06-28 03:05:08',1,1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-05 10:06:55
