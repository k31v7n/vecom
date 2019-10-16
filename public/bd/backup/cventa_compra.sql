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
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compra` (
  `compra` int(11) NOT NULL AUTO_INCREMENT,
  `valor_base` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor_iva` decimal(10,2) NOT NULL DEFAULT '0.00',
  `monto` decimal(12,2) NOT NULL DEFAULT '0.00',
  `fecha_factura` date NOT NULL,
  `factura_numero` varchar(80) NOT NULL,
  `serie` varchar(50) NOT NULL,
  `concepto` varchar(500) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proveedor` int(11) NOT NULL,
  `compra_estatus` int(11) NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `moneda` int(11) NOT NULL,
  PRIMARY KEY (`compra`),
  KEY `fk_compra_proveedor1_idx` (`proveedor`),
  KEY `fk_compra_compra_estatus1_idx` (`compra_estatus`),
  KEY `fk_compra_tipo_pago1_idx` (`tipo_pago`),
  KEY `fk_compra_usuario1_idx` (`usuario`),
  KEY `fk_compra_moneda1_idx` (`moneda`),
  CONSTRAINT `fk_compra_compra_estatus1` FOREIGN KEY (`compra_estatus`) REFERENCES `compra_estatus` (`compra_estatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_moneda1` FOREIGN KEY (`moneda`) REFERENCES `moneda` (`moneda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_proveedor1` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_tipo_pago1` FOREIGN KEY (`tipo_pago`) REFERENCES `tipo_pago` (`tipo_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
INSERT INTO `compra` VALUES (1,116.96,14.04,131.00,'2019-07-16','20190715','A','Primer compra del mes','2019-07-20','2019-07-16 05:14:13',4,1,2,1,1),(2,5357.14,642.86,6000.00,'2019-07-16','20190716','A','Segunda compra del mes',NULL,'2019-07-16 05:15:47',5,1,3,1,1),(3,223.21,26.79,250.00,'2019-07-20','123','B','TEST',NULL,'2019-07-21 02:34:12',3,1,1,1,1),(4,8.93,1.07,10.00,'2019-07-20','12221','B','TEST',NULL,'2019-07-21 03:34:00',3,1,1,1,1),(5,85150.67,10218.08,95368.75,'2019-07-20','23112','b-1','test',NULL,'2019-07-21 03:34:55',11,1,1,1,1),(6,0.00,0.00,0.00,'2019-01-01','91888','b1','pruebas',NULL,'2019-07-21 03:35:35',1,1,1,1,1),(7,0.00,0.00,0.00,'2019-07-22','91828','B','TEST',NULL,'2019-07-23 03:19:27',5,1,1,1,1);
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-05 10:06:54
