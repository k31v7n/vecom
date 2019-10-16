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
-- Table structure for table `usuario_menu`
--

DROP TABLE IF EXISTS `usuario_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_menu` (
  `usuario_menu` int(11) NOT NULL AUTO_INCREMENT,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_sis` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  PRIMARY KEY (`usuario_menu`),
  KEY `fk_usuario_menu_usuario1_idx` (`usuario`),
  KEY `fk_usuario_menu_menu1_idx` (`menu`),
  CONSTRAINT `fk_usuario_menu_menu1` FOREIGN KEY (`menu`) REFERENCES `menu` (`menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_menu_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_menu`
--

LOCK TABLES `usuario_menu` WRITE;
/*!40000 ALTER TABLE `usuario_menu` DISABLE KEYS */;
INSERT INTO `usuario_menu` VALUES (1,1,'2019-06-09 19:28:20',1,1),(2,1,'2019-06-30 20:23:59',1,2),(3,1,'2019-06-30 20:25:33',1,3),(4,1,'2019-07-06 20:06:53',1,4),(5,1,'2019-08-24 20:24:32',2,1),(6,1,'2019-08-24 20:24:32',2,2),(7,1,'2019-08-24 20:24:32',2,3),(8,1,'2019-08-24 20:24:32',2,4);
/*!40000 ALTER TABLE `usuario_menu` ENABLE KEYS */;
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
