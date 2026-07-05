CREATE DATABASE IF NOT EXISTS `gbclicker`;
USE `gbclicker`;

-- Limpando tabelas antigas (ordem reversa de dependência)
DROP TABLE IF EXISTS `inventario`;
DROP TABLE IF EXISTS `nivel`;
DROP TABLE IF EXISTS `itens`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `tipos_itens`;
DROP TABLE IF EXISTS `tipos_contas`;

-- ==========================================
-- TABELAS BASE (Domínios)
-- ==========================================

CREATE TABLE `tipos_contas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `tipos_itens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `efeito` varchar(120) NOT NULL, -- Antiga coluna classificacao
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ==========================================
-- TABELA DE USUÁRIOS
-- ==========================================

CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `money` double NOT NULL,
  `image_src` varchar(500) NOT NULL,
  `FK_id_tipos_contas` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `apelido_UNIQUE` (`nickname`),
  CONSTRAINT `fk_usuario_tipo_conta` FOREIGN KEY (`FK_id_tipos_contas`) REFERENCES `tipos_contas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `nivel` (
  `FK_user_email` varchar(255) NOT NULL,
  `level` int NOT NULL,
  `xp_points` int NOT NULL,
  `max_to_up` int NOT NULL,
  KEY `FK_user_email` (`FK_user_email`),
  CONSTRAINT `nivel_ibfk_1` FOREIGN KEY (`FK_user_email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ==========================================
-- TABELA DE ITENS E INVENTÁRIO
-- ==========================================

CREATE TABLE `itens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` int NOT NULL,
  `minimum_level` int NOT NULL,
  `efeito_valor` int NOT NULL DEFAULT 1, -- Antiga coluna quantidade
  `image_src` varchar(500) NOT NULL,
  `FK_id_tipos_itens` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  CONSTRAINT `fk_itens_tipo_item` FOREIGN KEY (`FK_id_tipos_itens`) REFERENCES `tipos_itens` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `inventario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `FK_user_email` varchar(255) NOT NULL,
  `FK_item_id` int NOT NULL,
  `quantidade` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_item_unique` (`FK_user_email`, `FK_item_id`),
  CONSTRAINT `fk_inv_usuario` FOREIGN KEY (`FK_user_email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE,
  CONSTRAINT `fk_inv_item` FOREIGN KEY (`FK_item_id`) REFERENCES `itens` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- ==========================================
-- INSERTS INICIAIS (Dados Padrão e de Teste)
-- ==========================================

LOCK TABLES `tipos_contas` WRITE;
INSERT INTO `tipos_contas` VALUES (2,'ADMIN'),(1,'USER');
UNLOCK TABLES;

LOCK TABLES `tipos_itens` WRITE;
INSERT INTO `tipos_itens` VALUES 
(1,'clickValue'),
(2,'multiplier'),
(3,'minions');
UNLOCK TABLES;

-- ORDEM: id, nome, descricao, preco, minimum_level, efeito_valor, image_src, FK_id_tipos_itens
LOCK TABLES `itens` WRITE;
INSERT INTO `itens` VALUES
(1,'Mouse de Bolinha','Melhor que nada (+ R$ 1 p/clique)',25,2,1,'img\\uploads\\items\\mouse_de_bolinha.png',1),
(2,'Mouse Óptico','Melhor que o mouse de bolinha (+ R$ 10 p/clique)',100,10,10,'img\\uploads\\items\\mouse_optico.png',1),
(3,'Café espresso','Aumenta produtividade (+1 multiplier)',1000, 15, 1,'img\\uploads\\items\\cafe_espresso.png',2),
(4,'Poção energética','Aumenta produtividade (+5 multiplier)',50000, 20, 5,'img\\uploads\\items\\pocao_energetica.png',2),
(5, 'Irmão mais novo', 'Ele clica para você em troca de salgadinho (+1 R$/sec)', 1000, 5, 1, 'img\\uploads\\items\\irmao_mais_novo.png', 3),
(6,'Estagiário','Clica muito mesmo ganhando pouco (+10 R$/sec)',10000, 15, 10,'img\\uploads\\items\\estagiario.png',3);

UNLOCK TABLES;

