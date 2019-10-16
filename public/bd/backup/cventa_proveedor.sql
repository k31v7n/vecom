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
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `nit` varchar(45) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `telefono` int(12) NOT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `credito_contado` tinyint(1) NOT NULL DEFAULT '0',
  `dias_credito` int(11) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `proveedor_tipo` int(11) NOT NULL,
  `proveedor_clasificacion` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha_sis` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `empresa` int(11) NOT NULL,
  PRIMARY KEY (`proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'Envasadora nacional','19287780','6ta calle 6-60 Zona 12','Test',19284756,'Manuel',1,15,0,1,1,1,'2019-06-29 04:48:32',1),(2,'Proveedor 1','1882777','5ta calle 3-80 Zona 1 patzun','Test',49806871,'Bryam',1,10,0,1,1,1,'2019-07-07 03:37:24',1),(3,'Envasadora nacional','19287780','6ta calle 6-60 Zona 12','Test',19284756,'Manuel',1,15,1,1,1,1,'2019-07-07 19:03:09',1),(4,'Bryam Doneli','19281888','5ta calle','Familia Magzul Boch',78399508,'Bryam Magzul',3,15,0,1,1,1,'2019-07-09 02:56:55',1),(5,'Test','1413128-1','Admin','TEST',17728881,'Prueba',1,12,0,1,5,1,'2019-07-10 02:34:30',1),(6,'TEST','191919','TEST','TEST',187277,'ADMIN',1,19,0,1,6,1,'2019-07-10 02:40:10',1),(7,'Bryam Magzul','105079480','5ta calle 3-80 Zona 1 Patzun','Bryam Doneli Magzul Boch',58517578,'Bryam',3,18,0,4,5,1,'2019-07-23 03:15:48',1),(8,'kakakak','91918','prueba','test',81872377,'test',2,15,0,1,1,1,'2019-07-23 03:18:29',1),(9,'Rubik\'s','9182828','Alemania','Rubik international',192828777,'Ryan Reynolds',1,21,1,1,2,1,'2019-07-24 03:13:25',1),(10,'Proveedor de productos x','91919','1lsi','Test',18277676,'Admin',3,9,1,1,1,1,'2019-07-24 03:18:19',1),(11,'Coca Cola','19298888','Test','Coca Cola Guatemala',182737778,'Admin',1,0,1,4,6,1,'2019-08-07 03:04:44',1),(12,'Huawei','CF','Ciudad','Huawei Guatemala',172666355,'Admin',1,0,1,5,1,1,'2019-08-14 03:17:37',1),(13,'Olimpia','asdas','Test','Olimpia Guatemala',192838890,'TEST',1,0,1,4,1,1,'2019-08-14 03:19:36',1);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-05 10:06:52
