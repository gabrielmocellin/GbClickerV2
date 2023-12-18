CREATE DATABASE  IF NOT EXISTS `gbclicker`;
USE `gbclicker`;

DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `nivel`;
DROP TABLE IF EXISTS `itens`;
DROP TABLE IF EXISTS `tipos_itens`;
DROP TABLE IF EXISTS `tipos_contas`;

CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `clickValue` double NOT NULL,
  `money` double NOT NULL,
  `multiplier` int NOT NULL,
  `minions` int NOT NULL,
  `image_src` varchar(500) NOT NULL,
  `FK_id_tipos_contas` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `apelido_UNIQUE` (`nickname`)
);

CREATE TABLE `nivel` (
  `FK_user_email` varchar(255) NOT NULL,
  `level` int NOT NULL,
  `xp_points` int NOT NULL,
  `max_to_up` int NOT NULL,
  KEY `FK_user_email` (`FK_user_email`),
  CONSTRAINT `nivel_ibfk_1` FOREIGN KEY (`FK_user_email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE
);

CREATE TABLE `tipos_itens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `classificacao` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `itens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` int NOT NULL,
  `minimum_level` int NOT NULL,
  `quantidade` int NOT NULL,
  `image_src` varchar(500) NOT NULL,
  `FK_id_tipos_itens` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
);

CREATE TABLE `tipos_contas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
);

LOCK TABLES `tipos_contas` WRITE;
INSERT INTO `tipos_contas` VALUES (2,'ADMIN'), (1,'USER');
UNLOCK TABLES;

LOCK TABLES `tipos_itens` WRITE;
INSERT INTO `tipos_itens` VALUES (3, 'Minions'), (2, 'Multiplier'), (1, 'ClickValue');
UNLOCK TABLES;