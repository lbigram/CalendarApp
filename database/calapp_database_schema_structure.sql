-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 192.168.224.81    Database: bookingsys
-- ------------------------------------------------------
-- Server version	5.1.51-community

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
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `eventid` int(11) NOT NULL AUTO_INCREMENT,
  `eventname` text NOT NULL,
  `location` text,
  `edate` date DEFAULT NULL,
  `efrom` varchar(45) DEFAULT NULL,
  `eto` varchar(45) DEFAULT NULL,
  `presenter` text,
  `formid` varchar(20) DEFAULT NULL,
  `registration` varchar(45) DEFAULT '0',
  `details` text,
  `uniqueurl` varchar(300) DEFAULT NULL,
  `advisories` text,
  `objectives` text,
  `capacity` varchar(45) DEFAULT NULL,
  `remaining` varchar(45) DEFAULT NULL,
  `cost` varchar(45) DEFAULT NULL,
  `targetaudience` text,
  `status` varchar(45) DEFAULT NULL,
  `contact` text,
  `userid` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `code` varchar(45) NOT NULL,
  PRIMARY KEY (`eventid`),
  UNIQUE KEY `eventcode_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feedbackresponses`
--

DROP TABLE IF EXISTS `feedbackresponses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedbackresponses` (
  `responseid` int(11) NOT NULL AUTO_INCREMENT,
  `formid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `uniquechar` varchar(45) NOT NULL,
  `answer` varchar(505) NOT NULL,
  `fieldid` int(11) NOT NULL,
  PRIMARY KEY (`responseid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fields` (
  `fieldid` int(11) NOT NULL AUTO_INCREMENT,
  `fielddescription` varchar(205) DEFAULT NULL,
  `fieldtype` varchar(45) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `displaytype` varchar(45) DEFAULT NULL,
  `formid` int(11) DEFAULT NULL,
  `optioncount` int(11) DEFAULT NULL,
  PRIMARY KEY (`fieldid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms` (
  `formid` int(11) NOT NULL AUTO_INCREMENT,
  `formname` varchar(45) DEFAULT NULL,
  `datecreated` date DEFAULT NULL,
  `description` varchar(205) DEFAULT NULL,
  PRIMARY KEY (`formid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `optionid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldid` int(11) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `ordering` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`optionid`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registrants`
--

DROP TABLE IF EXISTS `registrants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrants` (
  `registrantid` int(11) NOT NULL AUTO_INCREMENT,
  `ssid` varchar(45) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `eventid` int(11) DEFAULT NULL,
  `faculty` varchar(20) DEFAULT NULL,
  `email` varchar(205) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `attendance` varchar(10) DEFAULT 'No',
  PRIMARY KEY (`registrantid`)
) ENGINE=InnoDB AUTO_INCREMENT=2433 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `ldapusercode` varchar(50) NOT NULL,
  `useractive` bit(1) NOT NULL,
  `isadmin` bit(1) NOT NULL DEFAULT b'0',
  `email` varchar(205) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `officelocation` varchar(205) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `site` int(11) DEFAULT '0',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `ldapusercode_UNIQUE` (`ldapusercode`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'bookingsys'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-16 14:20:22
