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
  `pause` date DEFAULT NULL,
  `lastPayement` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'actif',
  `remarque` text DEFAULT NULL,
  `avtivityPerWeek` decimal(10,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_client` (`id_client`),
  CONSTRAINT `abonnement_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=369 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonnement`
--

LOCK TABLES `abonnement` WRITE;
/*!40000 ALTER TABLE `abonnement` DISABLE KEYS */;
INSERT INTO `abonnement` VALUES (365,263,'AEROBIC',200,165,35,'2022-06-27 14:41:34',NULL,'2022-06-27','2022-06-30','2022-06-27','2022-06-27','actif','',0),(366,263,'JUDO',150,150,0,'2022-06-27 14:46:33',NULL,'2022-06-27','2022-06-27',NULL,'2022-06-27','inactif','Sans musique',0),(367,263,'YOGA',150,150,0,'2022-06-27 14:46:51',NULL,'2022-06-27','2022-06-30','2022-06-27','2022-06-27','actif','',0),(368,263,'KARATE',100,70,30,'2022-06-27 14:47:12',NULL,'2022-06-27','2022-07-01',NULL,'2022-06-27','actif','',0);
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
  `nbrActivity` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (228,'KARATE',100,3),(229,'JUDO',150,3),(230,'AEROBIC',200,4),(232,'YOGA',150,4);
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
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (263,'102030','flata','najib','1982-11-09','Homme','','0617648975','106 impasse de la cerisaie 74930 Reignier-Esery','2022-06-27','263.jpg','najib flata');
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
) ENGINE=InnoDB AUTO_INCREMENT=639 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controlle`
--

LOCK TABLES `controlle` WRITE;
/*!40000 ALTER TABLE `controlle` DISABLE KEYS */;
INSERT INTO `controlle` VALUES (627,'2022-06-27 14:55:35',368,'chakib'),(628,'2022-06-27 14:55:40',368,'chakib'),(629,'2022-06-27 14:55:43',368,'chakib'),(630,'2022-06-27 14:55:51',367,'chakib'),(631,'2022-06-27 14:55:53',366,'chakib'),(632,'2022-06-27 14:55:54',365,'chakib'),(633,'2022-06-27 17:52:39',367,'najib flata'),(634,'2022-06-27 17:52:41',367,'najib flata'),(635,'2022-06-27 17:54:02',365,'najib flata'),(636,'2022-06-27 17:54:03',365,'najib flata'),(637,'2022-06-27 18:07:36',368,'najib flata'),(638,'2022-06-27 22:48:54',368,'najib flata');
/*!40000 ALTER TABLE `controlle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nbrsave`
--

DROP TABLE IF EXISTS `nbrsave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nbrsave` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `nbr` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nbrsave`
--

LOCK TABLES `nbrsave` WRITE;
/*!40000 ALTER TABLE `nbrsave` DISABLE KEYS */;
INSERT INTO `nbrsave` VALUES (1,'2022-06-28 13:10:42',1);
/*!40000 ALTER TABLE `nbrsave` ENABLE KEYS */;
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
-- Table structure for table `save`
--

DROP TABLE IF EXISTS `save`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `save` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `folderName` varchar(255) COLLATE utf8mb3_unicode_520_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `save`
--

LOCK TABLES `save` WRITE;
/*!40000 ALTER TABLE `save` DISABLE KEYS */;
INSERT INTO `save` VALUES (1,'2206281110','2022-06-28 13:10:42');
/*!40000 ALTER TABLE `save` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suivi`
--

DROP TABLE IF EXISTS `suivi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suivi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `action` text NOT NULL,
  `id_user` int(10) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `suivi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suivi`
--

LOCK TABLES `suivi` WRITE;
/*!40000 ALTER TABLE `suivi` DISABLE KEYS */;
INSERT INTO `suivi` VALUES (1,'a surpimÃ© le profil de flata najib',2,'2022-06-27 00:09:25'),(2,'a inscrit un nouveau client flata najib',2,'2022-06-27 14:40:24'),(3,'a ajoutÃ© une abonnement  AEROBIC pour le client flata najib',2,'2022-06-27 14:41:34'),(4,'a ajoutÃ© une nouvelle activitÃ© breakdance',2,'2022-06-27 14:44:48'),(5,'a ajoutÃ© une nouvelle activitÃ© YOGA',2,'2022-06-27 14:45:59'),(6,'a ajoutÃ© une abonnement  JUDO pour le client flata najib',2,'2022-06-27 14:46:33'),(7,'a ajoutÃ© une abonnement  YOGA pour le client flata najib',2,'2022-06-27 14:46:51'),(8,'a ajoutÃ© une abonnement  KARATE pour le client flata najib',2,'2022-06-27 14:47:12'),(9,'a mis Ã  jour la photo profil de flata najib',2,'2022-06-27 14:49:53'),(10,'a modifiÃ© le profil de l\'utilisateur chakib',2,'2022-06-27 14:52:32'),(11,'a modifiÃ© le profil de l\'utilisateur chakib',2,'2022-06-27 14:53:07'),(12,'a modifiÃ© le profil de l\'utilisateur chakib',2,'2022-06-27 14:54:43'),(13,'a validÃ© le controle de l\'activitÃ© KARATE du client flata najib',31,'2022-06-27 14:55:35'),(14,'a validÃ© le controle de l\'activitÃ© KARATE du client flata najib',31,'2022-06-27 14:55:40'),(15,'a validÃ© le controle de l\'activitÃ© KARATE du client flata najib',31,'2022-06-27 14:55:43'),(16,'a validÃ© le controle de l\'activitÃ© YOGA du client flata najib',31,'2022-06-27 14:55:51'),(17,'a validÃ© le controle de l\'activitÃ© JUDO du client flata najib',31,'2022-06-27 14:55:53'),(18,'a validÃ© le controle de l\'activitÃ© AEROBIC du client flata najib',31,'2022-06-27 14:55:54'),(19,'a mis en pause l\'activitÃ© YOGA dlu client flata najib',2,'2022-06-27 14:57:22'),(20,'a reactivÃ©l\'activitÃ© YOGA dlu client flata najib',2,'2022-06-27 14:58:22'),(21,'a mis en pause l\'activitÃ© AEROBIC dlu client flata najib',2,'2022-06-27 14:59:24'),(22,'a reactivÃ© l\'activitÃ© AEROBIC dlu client flata najib',2,'2022-06-27 14:59:25'),(23,'a modifiÃ© le profil du client flata najib',2,'2022-06-27 14:59:56'),(24,'a modifiÃ© le profil du client flata najib',2,'2022-06-27 15:00:27'),(25,'a validÃ© le controle de l\'activitÃ© YOGA du client flata najib',2,'2022-06-27 17:52:39'),(26,'a validÃ© le controle de l\'activitÃ© YOGA du client flata najib',2,'2022-06-27 17:52:41'),(27,'a validÃ© le controle de l\'activitÃ© AEROBIC du client flata najib',2,'2022-06-27 17:54:02'),(28,'a validÃ© le controle de l\'activitÃ© AEROBIC du client flata najib',2,'2022-06-27 17:54:03'),(29,'a validÃ© le controle de l\'activitÃ© KARATE du client flata najib',2,'2022-06-27 18:07:36'),(30,'a validÃ© le controle de l\'activitÃ© KARATE du client flata najib',2,'2022-06-27 22:48:54'),(31,'a suprimÃ© l\'activitÃ© BREAKDANCE',2,'2022-06-28 00:55:24'),(32,'a mis Ã  jour la photo profil de flata najib',2,'2022-06-28 01:09:37'),(33,'a mis Ã  jour la photo profil de flata najib',2,'2022-06-28 11:58:03'),(34,'a effectuÃ© une restauration de la base de donnÃ©e',2,'2022-06-28 13:16:00');
/*!40000 ALTER TABLE `suivi` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'najib flata','10203040','2022-05-28','super_admin',1),(30,'najib','10203040','2022-06-26','havikoro',2),(31,'chakib','10203040','2022-06-26','lilchak',3);
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

-- Dump completed on 2022-06-28 13:23:29
