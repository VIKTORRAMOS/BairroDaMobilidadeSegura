-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: localhost    Database: mobilidade_bairro
-- ------------------------------------------------------
-- Server version	8.4.7

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ocorrencias`
--

DROP TABLE IF EXISTS `ocorrencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ocorrencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `local_ref` varchar(255) DEFAULT NULL,
  `tipo` enum('transito','estacionamento') DEFAULT NULL,
  `descricao` text,
  `data_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pendente','resolvido','nao_resolvido') DEFAULT 'pendente',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocorrencias`
--

LOCK TABLES `ocorrencias` WRITE;
/*!40000 ALTER TABLE `ocorrencias` DISABLE KEYS */;
INSERT INTO `ocorrencias` VALUES (12,'Usuário de Teste','(11) 99999-8888','Av. Central, em frente ao mercado','estacionamento','Tem um carro parado na rampa de acessibilidade o dia todo.','2026-05-07 17:55:33','pendente'),(13,'Usuário de Teste','(11) 99999-8888','Av. Central, em frente ao mercado','estacionamento','Tem um carro parado na rampa de acessibilidade o dia todo.','2026-05-07 17:55:45','pendente');
/*!40000 ALTER TABLE `ocorrencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problemas_relatados`
--

DROP TABLE IF EXISTS `problemas_relatados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `problemas_relatados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ocorrencia_id` int DEFAULT NULL,
  `problema` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ocorrencia_id` (`ocorrencia_id`),
  CONSTRAINT `problemas_relatados_ibfk_1` FOREIGN KEY (`ocorrencia_id`) REFERENCES `ocorrencias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problemas_relatados`
--

LOCK TABLES `problemas_relatados` WRITE;
/*!40000 ALTER TABLE `problemas_relatados` DISABLE KEYS */;
INSERT INTO `problemas_relatados` VALUES (11,12,'Vaga Obstruída'),(13,13,'Vaga Obstruída'),(14,13,'Estacionamento Irregular');
/*!40000 ALTER TABLE `problemas_relatados` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-07 15:20:59
