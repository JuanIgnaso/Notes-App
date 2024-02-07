-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: Notes_App_DB
-- ------------------------------------------------------
-- Server version	8.2.0

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
-- Table structure for table `Notas`
--
CREATE DATABASE IF NOT EXISTS Notes_App_DB;
USE Notes_App_DB;
DROP TABLE IF EXISTS `Notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Notas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `descripcion` varchar(450) DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `importante` tinyint(1) DEFAULT '0',
  `usuario` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_estado` (`estado`),
  KEY `fk_usuario` (`usuario`),
  CONSTRAINT `fk_estado` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notas`
--

LOCK TABLES `Notas` WRITE;
/*!40000 ALTER TABLE `Notas` DISABLE KEYS */;
INSERT INTO `Notas` VALUES (3,'nota de paula','mi primera nota como usuario llamado paula, ja ja ja :)',1,0,7),(9,'triangulo equilatero','esto es una nota de un triangulo equilátero, equilatero que quiere decir que tiene los ',1,1,2),(11,'cono de nota','nota de cono, que no es cono porque la nota es cuadrada, o eso parece. si si no',2,1,2),(14,'romboide de verdad','nueva nota romboide con un cuadrado',4,0,2),(15,'piramide','como las piramides que hay en egipto jaja.',1,0,2),(16,'palo es un palo','palo palo palo',3,0,2),(19,'primera nota de eva','esta es mi primera vez creando una nota.',4,0,4),(24,'me he acordado de mas cosas','lorem ipsum dolor, mas texto.',3,0,7);
/*!40000 ALTER TABLE `Notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(30) NOT NULL,
  `clase` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `estado` (`estado`),
  UNIQUE KEY `clase` (`clase`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Sin Empezar','no_started'),(2,'En Progreso','in_progress'),(3,'Pausada','paused'),(4,'Terminado','finished');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'JoseLuis','JoseMail@gmail.com','$2y$10$BBt2FHJfEaMqeEo/aZw1seH0xCW3zHpMdGn3fYP3.q1p/qENxL9um',0,'2024-01-22 16:02:04','2024-01-22 16:02:04'),(2,'usuarioTest','emailTest@mail.com','$2y$10$y4KM7UqW2t8/VhY6KRJJYO9bK27CcNzN4eSwWcfh9jXU7Vs8rv8EG',0,'2024-01-22 16:06:00','2024-01-22 16:06:00'),(3,'Juan','juanEmail@gmail.com','$2y$10$jegOGWgCldB9P7ncKQQ4AedM0ELfEbQBCqFH8xxtB25MCZlPtSTJe',0,'2024-01-22 16:13:19','2024-01-22 16:13:19'),(4,'evaH','evita@gmail.com','$2y$10$sfWc1hQGAPDa7Ukqxvl3EeqBKqKo.16RUfOzu4Y8n26ZCUOUxmzLy',0,'2024-01-23 14:29:35','2024-01-23 14:29:35'),(7,'paula','paula@mail.com','$2y$10$oo4ND3alXMFjlvN8KolxH.FFOeU1mh3ebLKEzkox4.JbsKl42..f2',0,'2024-01-24 14:52:03','2024-01-24 14:52:03');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuariosToken`
--

DROP TABLE IF EXISTS `usuariosToken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuariosToken` (
  `id` int NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `id_usuario` int NOT NULL,
  `caducidad` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`id_usuario`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuariosToken`
--

LOCK TABLES `usuariosToken` WRITE;
/*!40000 ALTER TABLE `usuariosToken` DISABLE KEYS */;
INSERT INTO `usuariosToken` VALUES (10,'3366df246612a67ac64e9b28c84eeda7','$2y$10$cABQmWwNFQBWURITd3P/Ju0Yx582pzAUx/EyuIeqSReJju6MVFXyq',7,'2024-03-05 13:21:18');
/*!40000 ALTER TABLE `usuariosToken` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'Notes_App_DB'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-05 16:19:04
