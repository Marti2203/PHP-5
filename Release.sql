-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(200) DEFAULT NULL,
  `visitor_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_user_id` int(11) NOT NULL,
  `upvote` int(11) DEFAULT '0',
  `downvote` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`visitor_id`,`post_id`,`post_user_id`),
  KEY `fk_Comment_Visitor1_idx` (`visitor_id`),
  KEY `fk_Comment_Post1_idx` (`post_id`,`post_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'Test',3,17,7,0,0),(2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vulputate dignissim sapien. Pellentesque luctus tortor purus, eu semper ipsum imperdiet vel. Aenean ex sem, faucibus id vehicula a, cur',4,17,7,0,0),(4,'This is a useless Post.',3,19,7,0,0),(5,'Test',5,24,7,0,0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `address_UNIQUE` (`address`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (4,'kiro@abv.bg'),(3,'marti_2203@abv.bg'),(5,'pesho@abv.bg');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genders`
--

DROP TABLE IF EXISTS `genders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genders`
--

LOCK TABLES `genders` WRITE;
/*!40000 ALTER TABLE `genders` DISABLE KEYS */;
INSERT INTO `genders` VALUES (1,'Male'),(2,'Female'),(3,'Unicorn'),(4,'Apache Helicopter'),(5,'Unknown'),(6,'Liquid'),(7,'Trigendercisfluid');
/*!40000 ALTER TABLE `genders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(500) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `title` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_Post_User_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (2,'Test Second',67,'2017-05-29 22:30:52',7,'Test'),(3,'This is the first test post. Hope it works ',65,'2017-05-30 22:44:34',7,'I fucked up'),(4,'*Test*\r\n__Test__\r\n_Test_\r\n**Test**',62,'2017-05-31 22:01:21',7,'Testing Markdown'),(13,'An [example](http://google.com)',63,'2017-06-01 10:55:47',7,'Tag Tester'),(15,'#Blyat#',68,'2017-06-01 22:41:30',7,'Search Test'),(16,'TEST',69,'2017-06-01 22:56:06',7,'Trimmer'),(17,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vulputate dignissim sapien. Pellentesque luctus tortor purus, eu semper ipsum imperdiet vel. Aenean ex sem, faucibus id vehicula a, cursus quis arcu. Mauris vestibulum arcu felis, ac ullamcorper nunc maximus at. In hac habitasse platea dictumst. Cras pellentesque, ante vel posuere varius, velit nibh luctus dui, at pretium risus tellus vitae turpis. Donec eros ex, mollis id gravida sit amet, scelerisque vitae odio. Nullam quis velit',168,'2017-06-02 20:18:28',7,'The Best Text __Eva__'),(22,'Because ye',3,'2017-04-03 22:59:15',7,'Extra tags'),(23,'![alt text][id]\r\n\r\n  [id]: http://i.imgur.com/qjdmiWy.jpg \"Title\"',0,'2017-06-06 15:42:51',7,'Image Test'),(24,'# test\r\n    ```test```\r\n- [ ] test',2,'2017-06-06 15:44:14',7,'Markdown Test');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `references`
--

DROP TABLE IF EXISTS `references`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `references` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `post_user_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`post_id`,`post_user_id`,`tag_id`),
  KEY `fk_Post_has_Tag_Tag1_idx` (`tag_id`),
  KEY `fk_Post_has_Tag_Post1_idx` (`post_id`,`post_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `references`
--

LOCK TABLES `references` WRITE;
/*!40000 ALTER TABLE `references` DISABLE KEYS */;
INSERT INTO `references` VALUES (18,23,7,21),(15,22,7,22),(16,22,7,23),(17,22,7,24),(19,24,7,30);
/*!40000 ALTER TABLE `references` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secret_questions`
--

DROP TABLE IF EXISTS `secret_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secret_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Text_UNIQUE` (`text`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secret_questions`
--

LOCK TABLES `secret_questions` WRITE;
/*!40000 ALTER TABLE `secret_questions` DISABLE KEYS */;
INSERT INTO `secret_questions` VALUES (2,'What colour was your first car?'),(3,'What type of tree do you like?'),(4,'Who dat?'),(1,'Who is your favourite author?');
/*!40000 ALTER TABLE `secret_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `reference_count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (21,'Image',1),(22,'Tenth',1),(23,'Doctor',1),(24,'Who',1),(28,'Tag',1),(29,'test',1),(30,'Markdown',1);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(60) NOT NULL,
  `secret_answer` varchar(60) NOT NULL,
  `date_of_birth` date NOT NULL,
  `administration_level` int(1) DEFAULT '0',
  `picture_name` varchar(45) DEFAULT NULL,
  `emails_id` int(11) NOT NULL,
  `secret_question_id` int(11) NOT NULL,
  `genders_id` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`,`emails_id`,`secret_question_id`,`genders_id`),
  UNIQUE KEY `Username_UNIQUE` (`username`),
  KEY `fk_User_Email1_idx` (`emails_id`),
  KEY `fk_users_secretQuestions1_idx` (`secret_question_id`),
  KEY `fk_users_genders1_idx` (`genders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'MartinMirchev','$2y$10$N/KoU0Z803DwqplS1bP9hOZ/HDBw9NYS6v02/ZzpXi.f7kGIXCU6a','$2y$10$.iUM6NeTMBDdnEFEbvrL4uKzHMA2aLkMhxPpq2xXieSlxI.6r/P3e','2000-03-22',1,'phpaufKeo',3,1,4,'3fhfRyS0HDImWtAbBvdSF3wx0ETECwYi63lv64Qw1DcYaeC8sXoCZpciJfZx'),(8,'KiroToshev','$2y$10$hvyLNURHVSe7J6CqD/.65.GZh7kVb5AW/VkMCnb5zo.nqX3AQOIEG','$2y$10$8v.IGc23AN1z9cN.FpRWaeTe7KAk9Vuo6qZS19UdejmQ/HJjZreS.','2222-03-21',0,'default',4,1,1,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitors`
--

LOCK TABLES `visitors` WRITE;
/*!40000 ALTER TABLE `visitors` DISABLE KEYS */;
INSERT INTO `visitors` VALUES (2,'People',NULL),(3,'Martin','marti_2203@abv.bg'),(4,'HUGE',NULL),(5,'Pesho',NULL);
/*!40000 ALTER TABLE `visitors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-06 15:58:33
