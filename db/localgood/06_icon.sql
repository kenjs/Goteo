-- MySQL dump 10.13  Distrib 5.5.39, for Linux (x86_64)
--
-- Host: localhost    Database: goteo
-- ------------------------------------------------------
-- Server version	5.5.39-log

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
-- Table structure for table `icon`
--

DROP TABLE IF EXISTS `icon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `icon` (
  `id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` tinytext,
  `group` varchar(50) DEFAULT NULL COMMENT 'exclusivo para grupo',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Iconos para retorno/recompensa';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `icon`
--

LOCK TABLES `icon` WRITE;
/*!40000 ALTER TABLE `icon` DISABLE KEYS */;
INSERT INTO `icon` VALUES ('code','ソースコード','そのプログラムのソースコードとソフトウェア','social',0),('design','デザイン','平面、パターン、図、フローチャートなどのデザイン','social',0),('file','デジタルファイル','音楽、ビデオ、テキストなどのデジタルファイル','',0),('food','食べ物','','individual',0),('manual','マニュアル','実践的なやり方や、トレーニングの方法、ビジネスプラン、ハウツー、レシピなど。','social',0),('other','その他','私たちをびっくりさせてくれるような新しいお礼の方法！',NULL,0),('product','製品','オリジナルだったり限定で生産されるような製品','individual',0),('service','サービス','トレーニング、技術支援、カウンセリングなどのサービス','',0);
/*!40000 ALTER TABLE `icon` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-30 13:28:24
