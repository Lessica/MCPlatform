-- MySQL dump 10.13  Distrib 5.6.22, for OSX 10.10 (x86_64)
--
-- Host: localhost    Database: mcrm
-- ------------------------------------------------------
-- Server version	5.6.22

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
-- Table structure for table `mdevices`
--

DROP TABLE IF EXISTS `mdevices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mdevices` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) NOT NULL,
  `regtime` int(11) NOT NULL,
  `totime` int(11) NOT NULL,
  `role` int(1) NOT NULL,
  `runtimes` int(8) NOT NULL,
  `sid` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mkeys`
--

DROP TABLE IF EXISTS `mkeys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mkeys` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `flag` int(1) NOT NULL,
  `usetime` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `key` varchar(64) NOT NULL,
  `sid` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mscripts`
--

DROP TABLE IF EXISTS `mscripts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mscripts` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `md5` varchar(64) NOT NULL,
  `sha1` varchar(64) NOT NULL,
  `sha256` varchar(64) NOT NULL,
  `size` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `runtimes` int(8) NOT NULL,
  `name` varchar(64) NOT NULL,
  `version` varchar(64) NOT NULL,
  `download_url` varchar(255) NOT NULL,
  `update_logs` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `musers`
--

DROP TABLE IF EXISTS `musers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `musers` (
  `id` int(8) NOT NULL DEFAULT '0',
  `username` varchar(64) NOT NULL,
  `password_hash` varchar(128) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `role` int(8) NOT NULL,
  `status` int(8) NOT NULL,
  `password_reset_token` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `auth_key` varchar(128) NOT NULL,
  `created_at` int(11) NOT NULL,
  `password` varchar(64) NOT NULL,
  `last_login_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musers`
--

LOCK TABLES `musers` WRITE;
/*!40000 ALTER TABLE `musers` DISABLE KEYS */;
INSERT INTO `musers` VALUES (1,'i_82','$2y$13$r..xuu6Sl.3n.glCvH/MkehcuL6BnWuW9WPU2V1NQw7DjPdYc4WVK',1421745352,10,10,'','i.82@me.com','StHoI8ZMtaZJHJyVDDp4hScTd2qETGHh',0,'',1421745352);
/*!40000 ALTER TABLE `musers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-21  9:08:06
