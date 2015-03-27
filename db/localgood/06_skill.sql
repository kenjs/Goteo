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
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `description` text,
  `order` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `parent_skill_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COMMENT='Categorias de los proyectos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill`
--

LOCK TABLES `skill` WRITE;
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
INSERT INTO `skill` VALUES (1,'翻訳/通訳','',1,NULL),(5,'経営サポート','',1,NULL),(9,'文章制作、校正','',1,NULL),(10,'写真、動画撮影','',1,NULL),(11,'PC操作','',1,NULL),(12,'インターネット','',1,NULL),(13,'制作、創作','',1,NULL),(14,'法/会計/保険','',1,NULL),(15,'暮らし','',1,NULL),(19,'その他言語翻訳','翻訳/通訳：その他言語翻訳',3,1),(20,'英語通訳','翻訳/通訳：英語通訳',1,1),(21,'英語翻訳','翻訳/通訳：英語翻訳',2,1),(22,'経営企画サポート','経営サポート：経営企画サポート',1,5),(23,'商品企画','経営サポート：商品企画',1,5),(24,'市場、ニーズ調査','経営サポート：市場、ニーズ調査',1,5),(25,'広報','経営サポート：広報',1,5),(26,'営業代行','経営サポート：営業代行',1,5),(27,'助成金申請、書類作成','経営サポート：助成金申請、書類作成',1,5),(28,'取材、執筆','文章制作、校正：取材、執筆',1,9),(29,'文章校正','文章制作、校正：文章校正',1,9),(30,'編集','文章制作、校正：編集',1,9),(31,'ネーミング　キャッチコピー','文章制作、校正：ネーミング　キャッチコピー',1,9),(32,'写真撮影、加工','写真、動画撮影：写真撮影、加工',1,10),(33,'動画撮影、配信','写真、動画撮影：動画撮影、配信',1,10),(34,'動画編集、加工','写真、動画撮影：動画編集、加工',1,10),(35,'音楽作曲、編集','写真、動画撮影：音楽作曲、編集',1,10),(36,'PC操作','PC操作：PC操作',1,11),(37,'ワード','PC操作：ワード',1,11),(38,'エクセル','PC操作：エクセル',1,11),(39,'パワーポイント','PC操作：パワーポイント',1,11),(40,'フォトショップ','PC操作：フォトショップ',1,11),(41,'イラストレーター','PC操作：イラストレーター',1,11),(42,'インターネットでの情報発信、広報','インターネット：インターネットでの情報発信、広報',1,12),(43,'ブログ記事作成','インターネット：ブログ記事作成',1,12),(44,'ソーシャルメディア運用','インターネット：ソーシャルメディア運用',1,12),(45,'その他','インターネット：その他',1,12),(47,'イラスト制作','制作、創作：イラスト制作',1,13),(48,'ロゴ、アイコン制作','制作、創作：ロゴ、アイコン制作',1,13),(49,'ポスター、チラシ制作','制作、創作：ポスター、チラシ制作',1,13),(50,'日曜大工','制作、創作：日曜大工',1,13),(51,'法律','専門知識を提供する：法律',1,14),(52,'会計、財務','専門知識を提供する：会計、財務',1,14),(53,'保険','専門知識を提供する：保険',1,14),(54,'ファイナンシャルプラン','専門知識を提供する：ファイナンシャルプラン',1,14),(56,'その他','専門知識を提供する：その他',1,14),(57,'調理','暮らし：調理',1,15),(58,'買い物代行、付き添い','暮らし：買い物代行、付き添い',2,15),(59,'介護','暮らし：介護',3,15),(60,'剪定','暮らし：剪定',5,15),(61,'ご用聞き','暮らし：ご用聞き',6,15),(63,'その他言語通訳','翻訳/通訳：その他言語通訳',4,1),(64,'その他','翻訳/通訳：その他',5,1),(65,'その他','文章制作、校正：その他',1,9),(66,'その他','写真、動画撮影：その他',1,10),(67,'その他','PC操作：その他',1,11),(68,'手芸、ミシン','制作、創作：手芸、ミシン',1,13),(69,'デジタル工作機械運用','制作、創作：デジタル工作機械運用',1,13),(70,'その他','制作、創作：その他',1,13),(71,'その他','経営サポート：その他',1,5),(72,'イベント企画、運営','',1,NULL),(73,'イベント企画','イベント企画、運営：イベント企画',1,72),(74,'場所を貸す','イベント企画、運営：場所を貸す',1,72),(75,'集客サポート','イベント企画、運営：集客サポート',1,72),(76,'イベント運営','イベント企画、運営：イベント運営',1,72),(77,'ケータリング、備品提供','イベント企画、運営：ケータリング、備品提供',1,72),(78,'ワークショップ設計、ファシリテート','イベント企画、運営：ワークショップ設計、ファシリテート',1,72),(79,'司会','イベント企画、運営：司会',1,72),(80,'その他','イベント企画、運営：その他',1,72),(81,'作業','',1,NULL),(82,'手作業での単純作業','作業：手作業での単純作業',1,81),(83,'パソコンをつかった単純作業','作業：パソコンをつかった単純作業',1,81),(84,'その他作業','作業：その他作業',1,81),(85,'ベビーシッター','暮らし：ベビーシッター',4,15),(86,'その他','暮らし：その他',7,15),(87,'サイト制作、システム開発','',1,NULL),(88,'ウェブサイト制作・デザイン','サイト制作、システム開発：ウェブサイト制作・デザイン\r\n',1,87),(89,'システム開発・運用','サイト制作、システム開発：システム開発・運用\r\n',1,87),(90,'サイト運用・管理・保守','サイト制作、システム開発：サイト運用・管理・保守\r\n',1,87),(91,'スマホアプリ・モバイル開発','サイト制作、システム開発：スマホアプリ・モバイル開発\r\n',1,87),(92,'プログラミング','サイト制作、システム開発：プログラミング\r\n',1,87),(93,'その他','サイト制作、システム開発：その他\r\n',1,87);
/*!40000 ALTER TABLE `skill` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-30 13:28:00