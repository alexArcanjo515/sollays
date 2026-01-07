/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: loja
-- ------------------------------------------------------
-- Server version	10.11.13-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `data_criacao` timestamp NULL DEFAULT current_timestamp(),
  `ativo` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES
(1,'Alexio','alex@gmail.com','$2y$10$cb7s3Mce3FFdr7TfPDPv4.GOZrWh7H1TvLq97nbj9e5D968iK/rKS','2026-01-07 09:36:33',1),
(2,'teste_user','teste@exemplo.com','*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9','2026-01-07 11:08:32',1),
(3,'Zandinha','zandinha@gmail.com','$2y$10$ng67N7Rw20aogNC41GYGveMN0WJKdhpjRZ2XJYaWjvennL2QHVBai','2026-01-07 12:03:00',1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensagens_contato`
--

DROP TABLE IF EXISTS `mensagens_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `mensagens_contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `assunto` varchar(200) NOT NULL,
  `mensagem` longtext NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `data_envio` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'não lido',
  `resposta` longtext DEFAULT NULL,
  `data_resposta` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`),
  KEY `idx_status` (`status`),
  KEY `idx_data_envio` (`data_envio`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensagens_contato`
--

LOCK TABLES `mensagens_contato` WRITE;
/*!40000 ALTER TABLE `mensagens_contato` DISABLE KEYS */;
INSERT INTO `mensagens_contato` VALUES
(7,'Teste Web Funcionando','webfunc@teste.com','Teste de Funcionamento','Esta mensagem foi enviada através do formulário web e deve aparecer com sucesso!','::1','curl/8.5.0','2026-01-07 10:53:20','não lido',NULL,NULL),
(8,'alex','alex@gmail.com','Parceria','bom dia para o news','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','2026-01-07 10:54:05','não lido',NULL,NULL),
(9,'Cliente 1','cliente1@exemplo.com','Teste 1','Esta é uma mensagem de teste número 1 para verificar se o sistema está funcionando corretamente.','::1','curl/8.5.0','2026-01-07 11:01:58','não lido',NULL,NULL),
(10,'Cliente 2','cliente2@exemplo.com','Teste 2','Esta é uma mensagem de teste número 2 para verificar se o sistema está funcionando corretamente.','::1','curl/8.5.0','2026-01-07 11:01:58','não lido',NULL,NULL),
(11,'Cliente 3','cliente3@exemplo.com','Teste 3','Esta é uma mensagem de teste número 3 para verificar se o sistema está funcionando corretamente.','::1','curl/8.5.0','2026-01-07 11:01:58','não lido',NULL,NULL),
(12,'teste_user','teste@exemplo.com','Dúvida sobre produtos','Qual é a garantia dos produtos?',NULL,NULL,'2026-01-07 11:08:32','respondido','Todos os nossos produtos têm 5 anos de garantia.',NULL),
(13,'Zandinh','alexio.mango@gmail.com','Reclamação','jshdbjsdzjsdvz','219.0.0.90','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2026-01-07 11:39:27','não lido',NULL,NULL);
/*!40000 ALTER TABLE `mensagens_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitacoes_cotacao`
--

DROP TABLE IF EXISTS `solicitacoes_cotacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitacoes_cotacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `produtos_json` longtext NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `data_solicitacao` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pendente',
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`),
  KEY `idx_data_solicitacao` (`data_solicitacao`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitacoes_cotacao`
--

LOCK TABLES `solicitacoes_cotacao` WRITE;
/*!40000 ALTER TABLE `solicitacoes_cotacao` DISABLE KEYS */;
INSERT INTO `solicitacoes_cotacao` VALUES
(1,'Alex','alex@gmail.com','948996080','testes','[{\"id\":\"1\",\"categoria\":\"bateria\",\"nome\":\"SS-V-48-200\\/250\\/300\",\"img\":\"..\\/assets\\/images\\/bateria.png\",\"capacidade\":\"10240 Wh 12800 Wh 15360 Wh\"},{\"id\":\"2\",\"categoria\":\"bateria\",\"nome\":\"SS-V-48-200\\/250\\/300\",\"img\":\"..\\/assets\\/images\\/bateria1.png\",\"capacidade\":\"5120 Wh 6400 Wh 7680 Wh\"}]','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','2026-01-07 10:27:19','pendente'),
(2,'teste_user','teste@exemplo.com','244948996080','Gostaria de uma cotação para os produtos listados','{\"id\":1,\"nome\":\"Painel Solar\"}',NULL,NULL,'2026-01-07 11:08:32','pendente'),
(3,'teste_user','teste@exemplo.com','244948996080','','{\"id\":2,\"nome\":\"Bateria\"}',NULL,NULL,'2026-01-07 11:08:32','respondido'),
(4,'Alex','alex@gmail.com','937269654','queros a todos','[{\"id\":\"2\",\"categoria\":\"painel\",\"nome\":\"Módulo bifacial monocristalino TOPCon465~485W SSM10NHB-120\",\"img\":\"..\\/assets\\/images\\/painel6.png\",\"capacidade\":\"Painel robusto, ideal para grandes projetos residenciais e comerciais.\"},{\"id\":\"3\",\"categoria\":\"inversor\",\"nome\":\"Sistema integrado de aplicação de armazenamento solar\",\"img\":\"..\\/assets\\/images\\/inversor2.png\",\"capacidade\":\"1kWh\"}]','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','2026-01-07 11:24:01','pendente');
/*!40000 ALTER TABLE `solicitacoes_cotacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitacoes_preco`
--

DROP TABLE IF EXISTS `solicitacoes_preco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitacoes_preco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `mensagem` text DEFAULT NULL,
  `data_solicitacao` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pendente',
  PRIMARY KEY (`id`),
  KEY `idx_usuario_id` (`usuario_id`),
  KEY `idx_produto_id` (`produto_id`),
  KEY `idx_data_solicitacao` (`data_solicitacao`),
  CONSTRAINT `solicitacoes_preco_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitacoes_preco`
--

LOCK TABLES `solicitacoes_preco` WRITE;
/*!40000 ALTER TABLE `solicitacoes_preco` DISABLE KEYS */;
INSERT INTO `solicitacoes_preco` VALUES
(1,1,2,'painel','e23e23','2026-01-07 10:06:39','pendente'),
(2,1,6,'painel','mnnnn','2026-01-07 10:07:35','pendente'),
(3,2,1,'painel','Gostaria de saber o preço deste painel solar','2026-01-07 11:08:32','pendente'),
(4,2,2,'painel','Preciso de um orçamento para este produto','2026-01-07 11:08:32','respondido');
/*!40000 ALTER TABLE `solicitacoes_preco` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-07 13:05:16
