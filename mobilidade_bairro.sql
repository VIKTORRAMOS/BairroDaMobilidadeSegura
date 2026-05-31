-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 31/05/2026 às 22:58
-- Versão do servidor: 8.4.7
-- Versão do PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mobilidade_bairro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencias`
--

DROP TABLE IF EXISTS `ocorrencias`;
CREATE TABLE IF NOT EXISTS `ocorrencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `local_ref` varchar(255) DEFAULT NULL,
  `tipo` enum('transito','estacionamento') DEFAULT NULL,
  `descricao` text,
  `data_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pendente','resolvido','nao_resolvido') DEFAULT 'pendente',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `problemas_relatados`
--

DROP TABLE IF EXISTS `problemas_relatados`;
CREATE TABLE IF NOT EXISTS `problemas_relatados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ocorrencia_id` int DEFAULT NULL,
  `problema` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ocorrencia_id` (`ocorrencia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `problemas_relatados`
--
ALTER TABLE `problemas_relatados`
  ADD CONSTRAINT `problemas_relatados_ibfk_1` FOREIGN KEY (`ocorrencia_id`) REFERENCES `ocorrencias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
