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
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(300) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL DEFAULT '0.00',
  `unidad_medida` int(11) NOT NULL,
  `producto_tipo` int(11) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_venta` decimal(10,2) NOT NULL DEFAULT '0.00',
  `incluye_iva` tinyint(1) NOT NULL DEFAULT '0',
  `valor_iva` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fecha_ingreso` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_sis` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `proveedor` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `imagen` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`producto`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'001','Patatas',0.00,1,1,5.00,6.50,1,12.00,'2019-02-01','2019-07-31','2019-06-29 04:48:48',0,1,1,''),(2,'00001','Crema',67.00,1,1,5.00,7.50,1,12.00,'2019-07-01','2020-05-21','2019-07-02 02:22:56',0,1,1,''),(3,'000001','Carne Molida',132.00,1,1,50.00,59.99,1,12.00,'2019-07-01','2019-08-01','2019-07-02 02:24:48',0,1,1,''),(4,'01010','TEST',0.00,1,1,18.50,90.12,1,12.00,'2019-01-01','2019-07-23','2019-07-23 05:21:39',0,5,1,''),(5,'CL3431','Empanada',18.00,3,1,2.50,5.00,1,5.55,'2019-07-23','2019-07-23','2019-07-23 05:22:59',1,8,1,''),(6,'','',0.00,0,0,0.00,0.00,0,0.00,'2019-07-23','2019-07-23','2019-07-24 03:14:23',0,0,1,''),(7,'CCD','Coca cola dietetica',0.00,3,4,3.75,5.00,1,12.00,'2019-08-06','2019-08-06','2019-08-07 03:05:18',0,11,1,''),(8,'CL-2019','Celular PSmart 2019',0.00,3,5,1550.00,1999.00,1,12.00,'2019-08-01','2019-08-13','2019-08-14 03:18:38',0,12,1,''),(9,'ALM','Almohada',45.00,3,3,75.00,125.00,1,12.00,'2019-08-01','2019-08-13','2019-08-14 03:21:40',0,13,1,''),(10,'CAM1','Cama Matrimonial Olimpia',2.00,3,3,1875.00,2550.00,1,12.00,'2019-08-01','2019-08-13','2019-08-14 03:27:17',1,13,1,''),(11,'CAM2','Cama semimatrimonial',2.00,3,3,1475.00,1857.34,1,12.00,'2019-08-01','2019-08-13','2019-08-14 03:28:02',1,13,1,''),(12,'HWP40','Huawei P30 PRO',5.00,3,5,4750.00,6899.00,1,12.00,'2019-08-01','2019-08-13','2019-08-14 03:29:14',1,12,1,''),(13,'HWP20LITE','Huawei P20 Lite',15.00,3,5,1450.00,2000.00,1,12.00,'2019-08-01','2019-08-13','2019-08-14 03:29:54',1,12,1,''),(14,'Tablet14','Tablet de 14\"',5.00,3,6,4575.00,5499.00,1,12.00,'2019-08-01','2019-08-14','2019-08-15 03:11:21',1,12,1,''),(15,'CB1','Cabezera Matrimonial',1.00,3,3,1750.00,1450.00,1,0.12,'2019-08-01','2019-08-17','2019-08-18 02:22:56',1,13,1,''),(16,'','',0.00,0,0,0.00,0.00,0,0.00,'0000-00-00',NULL,'2019-08-21 06:39:22',0,0,2,'');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
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
