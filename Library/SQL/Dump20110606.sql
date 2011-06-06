-- MySQL dump 10.13  Distrib 5.5.9, for Win32 (x86)
--
-- Host: localhost    Database: bmsdb
-- ------------------------------------------------------
-- Server version	5.1.44b-MariaDB-log

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
-- Table structure for table `bms_account_mods`
--

DROP TABLE IF EXISTS `bms_account_mods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bms_account_mods` (
  `bms_modid` int(11) NOT NULL,
  `bms_clientid` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_mod_time` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_mod_admin` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_mod` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bms_modid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bms_account_mods`
--

LOCK TABLES `bms_account_mods` WRITE;
/*!40000 ALTER TABLE `bms_account_mods` DISABLE KEYS */;
/*!40000 ALTER TABLE `bms_account_mods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bms_accounts`
--

DROP TABLE IF EXISTS `bms_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bms_accounts` (
  `bmsid` int(11) NOT NULL AUTO_INCREMENT,
  `bms_realname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_uid` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_pwd` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_ircnick` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_email_valid` int(11) DEFAULT NULL,
  `bms_account_creation_time` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_account_status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_package_level` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_shell_activated_admin` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_shell_activated_time` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_custom_trialcompleted_time` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_locked_admin` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_locked_time` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_locked_threshold` int(1) DEFAULT NULL,
  `bms_locked_reason` text COLLATE utf8_unicode_ci,
  `bms_custom_vouched` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_custom_client_shell_reason` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`bmsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bms_accounts`
--

LOCK TABLES `bms_accounts` WRITE;
/*!40000 ALTER TABLE `bms_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bms_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bms_accounts_admin`
--

DROP TABLE IF EXISTS `bms_accounts_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bms_accounts_admin` (
  `bmsid` int(11) NOT NULL,
  `bms_realname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_uid` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_pwd` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_account_creation_time` int(11) DEFAULT NULL,
  `bms_account_status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_account_level` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bmsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bms_accounts_admin`
--

LOCK TABLES `bms_accounts_admin` WRITE;
/*!40000 ALTER TABLE `bms_accounts_admin` DISABLE KEYS */;
INSERT INTO `bms_accounts_admin` VALUES (0,'Root Account','root','63a9f0ea7bb98050796b649e85481845','root@example.com',1307394747,'Active','0');
/*!40000 ALTER TABLE `bms_accounts_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bms_login_times`
--

DROP TABLE IF EXISTS `bms_login_times`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bms_login_times` (
  `bmsid` int(11) NOT NULL,
  `bms_uid` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bms_login_time` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bmsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bms_login_times`
--

LOCK TABLES `bms_login_times` WRITE;
/*!40000 ALTER TABLE `bms_login_times` DISABLE KEYS */;
/*!40000 ALTER TABLE `bms_login_times` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-06-06 17:32:40
