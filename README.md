# DemoProject
#My first project

Project's purpose is to be used as online catalog. Project is divided into two parts. One part 
is for administration of the website and the other one is for visitor(user of the catalog).

##Database constants:

| Name          | Default value      | Description                          |
| ------------- | ------------------ |--------------------------------------|
| DB_DRIVER     | mysql              | setting driver for database          |
| DB_HOST       | localhost          | setting where the site is hosted     |
| DB_NAME       | database name      | setting how is the database called   |                                  |
| DB_USER       | user's name        | setting username for database access |                                    |
| DB_PASS       | user's password    | setting password for database access |                                    |
| DB_PORT       | 80                 | setting listening port for mysql     |    

When setting database on local machine, set constant's values to your database settings.

##Routes

LOAD_ROUTES_FROM constant contains path to file where routes are defined.

##Database script

use demoproject;

-- MySQL dump 10.16  Distrib 10.1.44-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: demoproject
-- ------------------------------------------------------
-- Server version	10.1.44-MariaDB-0ubuntu0.18.04.1

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'petar','6ca418f5a18c4dae615b3f92c91ce531064144c42c0319ca8fdfbef96a146845'),(2,'vlada','5bd975026d35e8a7450ddb6a62f990242b00284d3530b8386c984e6fb54dd691');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ParentId` int(11) DEFAULT NULL,
  `Code` varchar(45) NOT NULL,
  `Title` varchar(45) NOT NULL,
  `Description` tinytext,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`),
  UNIQUE KEY `Code_UNIQUE` (`Code`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,-1,'1','Laptops','All kinds of laptops'),(5,-1,'2','Processors','All kinds of processors.'),(6,-1,'3','Motherboards','Motherboards for desktop and lap-top computers.'),(7,1,'r324dasd','Office','For office purposes...'),(8,5,'hthw3q41','AMD','Processors made from AMD producer.'),(10,1,'ddd123sd1','Gaming','Gaming laptops with stronger graphic cards and better cooling systems.'),(13,6,'099981qQc','Gigabyte','  Motherboards designed for gaming.  '),(14,5,'09321odQD','Intel','Intel processors.'),(15,14,'intel1','Intel 1 Test','This is testing.');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryId` int(11) NOT NULL,
  `SKU` varchar(45) NOT NULL,
  `Title` varchar(45) NOT NULL,
  `Brand` varchar(45) NOT NULL,
  `Price` float NOT NULL,
  `ShortDescription` varchar(120) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Image` varchar(400) DEFAULT NULL,
  `Enabled` int(11) DEFAULT NULL,
  `Featured` int(11) DEFAULT NULL,
  `ViewCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`),
  KEY `Id_idx` (`CategoryId`),
  CONSTRAINT `Id` FOREIGN KEY (`CategoryId`) REFERENCES `category` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (24,7,'PQ1236pq','k50In','Asus',50000,'Best laptop ever.','This laptop configuration is perfect for gaming. Cooling system and...','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/asusk50in.jpg',1,1,8),(25,5,'I12RCq','INTEL Pentium Gold G5600','Intel ',30000,'Latest intel cpu.','Very strong intel cpu for gaming and other purposes.','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/premgold.jpeg',0,1,3),(30,8,'amd1','Athlon','AMD',20000,'Gaming cpu.','Gaming CPU. 3.4GHz and 4MB of cache memory.','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/amd1.jpeg',1,1,5),(31,7,'acer1','Acer A315','Acer',34900,'Laptop for office purposes.','Intel® Pentium® Silver N5000 Quad Core Processor, Brzina: 1.1GHz (Burst do 2.7GHz) Keš memorija: 4MB','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/Acer1.jpeg',1,1,2),(32,7,'hp1',' HP 15-da0146nm','HP',34900,'Laptop for office purposes and gaming.','Intel Pentium Gold 4417U Dual Core Processor, Brzina: 2.3 GHz, Keš memorija: 2MB','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/hp1.jpg',0,0,21),(33,10,'acer2','Acer Nitro AN515-54-55NZ','Acer',100000,'Gaming laptop.','Intel® Core™ i5-9300H Quad Core Procesor, Brzina: 2.4GHz (Burst do 4.1GHz) Keš memorija: 8MB','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/acer2.jpg',1,1,16),(34,13,'motherboard1','ASRock AM4 B450M-HDV','ASRock',7290,'AMD AM4 Socket, Supports CPU up to 105W, 6 Power Phase design','For non gaming purposes.','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/asrock1.jpg',0,1,5),(35,13,'gigabyte1','Gigabyte AM4 B450M','Gigabyte',9490,'Podržani procesori: 1. & 2. generacija Ryzen-a, sve A serije, Athlon AM4.','Powerful motherboard','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/gigabyte1.jpeg',0,1,7),(36,8,'amd2','AMD AM4 Ryzen 3 3200G','AMD',9490,'Integrisana grafika : Radeon™ Vega 8 Graphics','Very strong processors.','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/amd2.jpg',0,1,3),(37,10,'hp2','HP Pavilion 14-ce2042nm','HP',54990,'For gaming.','Intel® Core™ i3-8145U Dual Core Processor, Brzina: 2.1GHz (Burst do 3.9Ghz), Keš memorija: 4MB. Integrisana Intel UHD Graphics 620 sa deljenom sistemskom memorijom.','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/hp2.png',1,1,3),(38,10,'acer3','Acer Swift3 SF315-41-R3FH','Acer',60500,'For gaming.','AMD Quad Core R5-2500U Processor, Radna brzina: 2.0 GHz (Burst do 3.6GHz), Keš memorija: 6MB','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/acer3.jpg',0,0,2),(41,1,'test','test','test',333333,'This is testing','This is testing.','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/test.jpeg',1,1,1),(60,1,'test3','test3','test3',32323,'test edit','test edit','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/test3.png',1,1,1),(61,14,'test2','test2','test2',32212,'Testing intel subcategory','Testing intel subcategory','/home/vladimir/Code/demo-project/src/Controllers/../../public/assets/Images/test21.png',1,1,0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `relevanceview`
--

DROP TABLE IF EXISTS `relevanceview`;
/*!50001 DROP VIEW IF EXISTS `relevanceview`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `relevanceview` (
  `Id` tinyint NOT NULL,
  `CategoryId` tinyint NOT NULL,
  `SKU` tinyint NOT NULL,
  `Title` tinyint NOT NULL,
  `Brand` tinyint NOT NULL,
  `Price` tinyint NOT NULL,
  `ShortDescription` tinyint NOT NULL,
  `Description` tinyint NOT NULL,
  `Image` tinyint NOT NULL,
  `Enabled` tinyint NOT NULL,
  `Featured` tinyint NOT NULL,
  `ViewCount` tinyint NOT NULL,
  `CategoryTitle` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statistics` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `HomeViewCount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` VALUES (1,2386);
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `relevanceview`
--

/*!50001 DROP TABLE IF EXISTS `relevanceview`*/;
/*!50001 DROP VIEW IF EXISTS `relevanceview`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER= CURRENT_USER SQL SECURITY DEFINER */
/*!50001 VIEW `relevanceview` AS select `p`.`Id` AS `Id`,`p`.`CategoryId` AS `CategoryId`,`p`.`SKU` AS `SKU`,`p`.`Title` AS `Title`,`p`.`Brand` AS `Brand`,`p`.`Price` AS `Price`,`p`.`ShortDescription` AS `ShortDescription`,`p`.`Description` AS `Description`,`p`.`Image` AS `Image`,`p`.`Enabled` AS `Enabled`,`p`.`Featured` AS `Featured`,`p`.`ViewCount` AS `ViewCount`,`c`.`Title` AS `CategoryTitle` from (`product` `p` left join `category` `c` on((`p`.`CategoryId` = `c`.`Id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-10  7:48:56   