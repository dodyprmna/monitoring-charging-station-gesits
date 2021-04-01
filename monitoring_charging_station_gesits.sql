-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: monitoring_charging_station_gesits
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_charging_station`
--

DROP TABLE IF EXISTS `tbl_charging_station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_charging_station` (
  `id_charging_station` int NOT NULL AUTO_INCREMENT,
  `nama_charger` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_charging_station`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_charging_station`
--

LOCK TABLES `tbl_charging_station` WRITE;
/*!40000 ALTER TABLE `tbl_charging_station` DISABLE KEYS */;
INSERT INTO `tbl_charging_station` VALUES (1,'Charging Station 1','2021-03-30 22:11:28');
/*!40000 ALTER TABLE `tbl_charging_station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_monitoring`
--

DROP TABLE IF EXISTS `tbl_monitoring`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_monitoring` (
  `id_monitoring` bigint NOT NULL AUTO_INCREMENT,
  `fk_charging_station` int DEFAULT NULL,
  `arus` double DEFAULT NULL,
  `tegangan` double DEFAULT NULL,
  `daya` double DEFAULT NULL,
  `biaya` int DEFAULT NULL,
  `lifetime` bigint DEFAULT NULL,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_monitoring`),
  KEY `tbl_monitoring_FK` (`fk_charging_station`),
  CONSTRAINT `tbl_monitoring_FK` FOREIGN KEY (`fk_charging_station`) REFERENCES `tbl_charging_station` (`id_charging_station`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_monitoring`
--

LOCK TABLES `tbl_monitoring` WRITE;
/*!40000 ALTER TABLE `tbl_monitoring` DISABLE KEYS */;
INSERT INTO `tbl_monitoring` VALUES (1,1,7,4.2,8,1000,14,'2021-03-30 22:12:41'),(3,1,7,4.2,8,1000,14,'2021-03-30 22:12:44');
/*!40000 ALTER TABLE `tbl_monitoring` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'monitoring_charging_station_gesits'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-30 22:13:25