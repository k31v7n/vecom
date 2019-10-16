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
-- Table structure for table `compra_detalle`
--

DROP TABLE IF EXISTS `compra_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compra_detalle` (
  `compra_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `anulado` tinyint(1) NOT NULL DEFAULT '0',
  `compra` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  PRIMARY KEY (`compra_detalle`),
  KEY `fk_compra_detalle_compra1_idx` (`compra`),
  KEY `fk_compra_detalle_producto1_idx` (`producto`),
  CONSTRAINT `compra` FOREIGN KEY (`compra`) REFERENCES `compra` (`compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `producto` FOREIGN KEY (`producto`) REFERENCES `producto` (`producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra_detalle`
--

LOCK TABLES `compra_detalle` WRITE;
/*!40000 ALTER TABLE `compra_detalle` DISABLE KEYS */;
INSERT INTO `compra_detalle` VALUES (1,15.00,2,30.00,0,1,2),(2,1.00,12,12.00,0,1,2),(3,10.00,2,20.00,0,1,1),(4,2.00,12,24.00,0,1,3),(5,5.00,50,250.00,0,3,2),(6,50.00,45,2250.00,0,2,3),(7,50.00,75,3750.00,0,2,3),(8,5.00,3,10.00,0,4,2),(9,3.75,25,93.75,0,5,7),(10,75.00,45,3375.00,0,5,9),(11,1550.00,4,6200.00,0,5,8),(12,1875.00,3,5625.00,0,5,10),(13,1475.00,2,2950.00,0,5,11),(14,4750.00,5,23750.00,0,5,12),(15,1450.00,15,21750.00,0,5,13),(16,4575.00,5,22875.00,0,5,14),(17,2.50,18,45.00,0,1,5),(18,1750.00,5,8750.00,0,5,15);
/*!40000 ALTER TABLE `compra_detalle` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-05 10:06:53
