-- MariaDB dump 10.19  Distrib 10.6.5-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: club
-- ------------------------------------------------------
-- Server version	10.6.5-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abonnement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_client` int(10) NOT NULL,
  `type_sport` varchar(255) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `payer` decimal(10,0) NOT NULL,
  `reste` decimal(10,0) NOT NULL,
  `date_abonnement` datetime DEFAULT NULL,
  `date_renew` date DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'actif',
  `lastPayement` date NOT NULL,
  `pause` date DEFAULT NULL,
  `remarque` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_client` (`id_client`),
  CONSTRAINT `abonnement_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=332 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonnement`
--

LOCK TABLES `abonnement` WRITE;
/*!40000 ALTER TABLE `abonnement` DISABLE KEYS */;
INSERT INTO `abonnement` VALUES (331,246,'BOX',200,100,100,'2022-06-17 17:20:22',NULL,'2022-06-17','2022-06-19','actif','2022-06-17','2022-06-17','je ne suis pas content');
/*!40000 ALTER TABLE `abonnement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `prix` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (214,'BOX',60),(215,'MUSCULATION',100),(216,'BREAKDANCE',200);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `badge` varchar(20) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `genre` varchar(255) NOT NULL,
  `cin` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `date` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL DEFAULT 'najib',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (246,'102030','flata','najib','1982-11-09','Homme','ee102030','0674176588','106 impasse de la cerisaie','2022-06-06','246.jpg','najib flata');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controlle`
--

DROP TABLE IF EXISTS `controlle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controlle` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_abonnement` int(10) DEFAULT NULL,
  `id_user` varchar(255) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `id_abonnement` (`id_abonnement`),
  CONSTRAINT `controlle_ibfk_1` FOREIGN KEY (`id_abonnement`) REFERENCES `abonnement` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=336 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controlle`
--

LOCK TABLES `controlle` WRITE;
/*!40000 ALTER TABLE `controlle` DISABLE KEYS */;
INSERT INTO `controlle` VALUES (252,'2022-06-05 17:19:55',NULL,'2'),(253,'2022-06-05 17:19:57',NULL,'2'),(254,'2022-06-05 17:20:12',NULL,'2'),(255,'2022-06-05 17:20:30',NULL,'2'),(256,'2022-06-05 17:20:42',NULL,'2'),(257,'2022-06-05 17:21:04',NULL,'2'),(258,'2022-06-05 17:27:48',NULL,'2'),(259,'2022-06-05 17:29:20',NULL,'2'),(260,'2022-06-05 17:30:48',NULL,'2'),(261,'2022-06-05 17:34:28',NULL,'2'),(262,'2022-06-05 17:37:46',NULL,'2'),(263,'2022-06-05 17:37:55',NULL,'2'),(264,'2022-06-05 17:38:57',NULL,'2'),(265,'2022-06-05 18:05:46',NULL,'2'),(266,'2022-06-05 18:06:36',NULL,'2'),(267,'2022-06-05 18:06:41',NULL,'2'),(268,'2022-06-05 18:11:24',NULL,'2'),(269,'2022-06-05 18:13:33',NULL,'2'),(270,'2022-06-05 18:18:21',NULL,'2'),(271,'2022-06-05 18:18:25',NULL,'2'),(272,'2022-06-05 18:18:46',NULL,'2'),(273,'2022-06-05 18:18:51',NULL,'2'),(274,'2022-06-05 18:20:58',NULL,'2'),(275,'2022-06-05 18:21:03',NULL,'2'),(276,'2022-06-05 18:21:53',NULL,'2'),(277,'2022-06-05 18:22:07',NULL,'2'),(278,'2022-06-05 18:22:11',NULL,'2'),(279,'2022-06-05 18:22:16',NULL,'2'),(280,'2022-06-05 18:22:20',NULL,'2'),(281,'2022-06-05 18:24:00',NULL,'2'),(282,'2022-06-05 18:24:02',NULL,'2'),(285,'2022-06-05 18:30:23',NULL,'2'),(286,'2022-06-05 18:30:26',NULL,'2'),(333,'2022-06-17 17:27:39',331,'najib flata'),(334,'2022-06-17 17:39:47',331,'najib flata'),(335,'2022-06-17 17:42:48',331,'najib flata');
/*!40000 ALTER TABLE `controlle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(2,'Editeur'),(3,'Controlleur');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `date_inscription` date NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `id_type` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'najib flata','123sat','2022-05-28','super_admin',1),(26,'yassine flata','10203040','2022-05-28','ssine_rock10',2),(27,'chakib flata','10203040','2022-05-28','lilchak',3);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-17 17:47:52
