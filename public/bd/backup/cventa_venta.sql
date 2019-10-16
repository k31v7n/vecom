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
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `venta` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` int(11) NOT NULL,
  `concepto` varchar(500) NOT NULL,
  `valor_base` decimal(10,2) NOT NULL DEFAULT '0.00',
  `iva` decimal(10,2) NOT NULL DEFAULT '0.00',
  `monto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `saldo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_estatus` int(11) NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha_sis` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `moneda` int(11) NOT NULL,
  PRIMARY KEY (`venta`),
  KEY `fk_venta_cliente1_idx` (`cliente`),
  KEY `fk_venta_venta_estatus1_idx` (`venta_estatus`),
  KEY `fk_venta_tipo_pago1_idx` (`tipo_pago`),
  KEY `fk_venta_usuario1_idx` (`usuario`),
  KEY `fk_venta_moneda1_idx` (`moneda`),
  CONSTRAINT `fk_venta_cliente1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_moneda1` FOREIGN KEY (`moneda`) REFERENCES `moneda` (`moneda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_tipo_pago1` FOREIGN KEY (`tipo_pago`) REFERENCES `tipo_pago` (`tipo_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_venta_estatus1` FOREIGN KEY (`venta_estatus`) REFERENCES `venta_estatus` (`venta_estatus`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (1,0,'',14758.48,1771.02,16529.50,16529.50,3,1,2,'2019-08-22 05:01:51',1),(2,0,'',5.80,0.70,6.50,6.50,1,1,1,'2019-08-22 05:38:36',1),(3,0,'',0.00,0.00,0.00,0.00,3,0,2,'2019-08-23 06:20:19',1),(4,0,'',0.00,0.00,0.00,0.00,3,0,2,'2019-08-23 06:27:21',1),(5,0,'',5.80,0.70,6.50,6.50,3,0,2,'2019-08-23 06:29:33',1),(6,0,'',5.80,0.70,6.50,6.50,3,0,2,'2019-08-23 06:30:31',1),(7,0,'',1784.82,214.18,1999.00,1999.00,3,0,2,'2019-08-24 20:36:36',1),(8,0,'',5.80,0.70,6.50,6.50,3,0,2,'2019-08-27 04:19:36',1),(9,0,'',10.27,1.23,11.50,11.50,3,0,2,'2019-08-27 04:23:12',1),(10,0,'',10.27,1.23,11.50,11.50,3,0,2,'2019-08-27 04:25:29',1),(11,0,'',0.00,0.00,0.00,0.00,3,0,2,'2019-09-01 20:13:16',1),(12,0,'',0.00,0.00,0.00,0.00,1,0,2,'2019-09-01 20:13:37',1),(13,0,'',7455.36,894.64,8350.00,8350.00,1,0,2,'2019-09-01 20:13:45',1);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
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
