CREATE DATABASE IF NOT EXISTS `gbclicker`;
USE `gbclicker`;

DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `nivel`;
DROP TABLE IF EXISTS `itens`;
DROP TABLE IF EXISTS `tipos_itens`;
DROP TABLE IF EXISTS `tipos_contas`;

CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `nivel` (
  `FK_user_email` varchar(255) NOT NULL,
  `level` int NOT NULL,
  `xp_points` int NOT NULL,
  `max_to_up` int NOT NULL,
  KEY `FK_user_email` (`FK_user_email`),
  CONSTRAINT `nivel_ibfk_1` FOREIGN KEY (`FK_user_email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `tipos_itens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `classificacao` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `tipos_contas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



-- << Inserindo os valores na tabela [usuario] !! >> --
LOCK TABLES `usuario` WRITE;
INSERT INTO `usuario` VALUES 
(1,'admin@admin.com', '$argon2id$v=19$m=65536,t=4,p=1$aFVJa2RYakVYczJFcUZtTg$0Z+Gfk3cZ6YgQrVjM2/M8w4UFQ8xyF9xmnHIsRcM+us','GM | Gbex',49475,36757583448,6154,7595,'img\\uploads\\profile\\avatarAdm.png',2),
(2,'chad@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','ChadBolado',1500,15000,10,0,'img\\uploads\\profile\\65a16609d4867cutechad.jpg',1),
(3,'gb@gb.com', '$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','Gabex',10000,100000,20000,30000,'img\\uploads\\profile\\65b6899329ceccabelo_coracao.jpg',1),
(5,'gb2@gb.com', '$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','JobsonGame',1,6000,1,0,'img\\uploads\\profile\\65b689be407dadrakeSonic.png',1),
(6,'jobson@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','JobsonGames',1,1000,2,1,'img\\uploads\\profile\\65b689e8e2cfezuckerberg_bowl.jpg',1),
(7,'gb5@gb.com', '$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','Gabriel207',1,66,2,3,'img\\uploads\\profile\\65b6990c257c8imagemlinda.jpg',1),
(8,'gb9@gb.com', '$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','Gabriel209',1,150,1,0,'img\\uploads\\profile\\65b6991b67877cat_nerd.jpg',1),
(9,'gb10@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','Jobson_PVP_conta',6,1600,9,12,'img\\uploads\\profile\\65b6993b9c2c0my_dad.jpg',1),
(10,'gb101@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','Gabriel210',3,12,3,3,'img\\uploads\\profile\\65b69f2ba19addrakeWtf3.png',1),
(11,'gb102@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','Gabriel06',16,38999,15,30,'img\\uploads\\profile\\65b69f40563e2GbAI.jfif',1),
(12,'gb103@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','Gbex52',1,1627,1,0,'img\\uploads\\profile\\65b69fce8ca01dennis_pfp.png',1),
(13,'gb104@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','GabrielM6',5,613,3,2,'img\\uploads\\profile\\65b6a0095892ahomem_do_frio.png',1),
(14,'gb105@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','TesteGbex2',1,2100,1,0,'img\\uploads\\profile\\65c7cbe852f7fTremBala.jpg',1),
(15,'joel@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','Joelson_Hacker',2405,31052,1,0,'img\\uploads\\profile\\65d008674d5f3Captura de tela 2024-02-11 175730.png',1),
(16,'admin2@admin.com','$argon2id$v=19$m=65536,t=4,p=1$UWVNYnd2enlaeGJ4L3UzNw$IpSKA4JKWIB7fVW5X8+DlneHFDAB/ZXpOj1awjv91uI','Admin2',1126,10510384,167,570,'img\\uploads\\profile\\65d00f3bb47a1GbClicker4.jfif',1);
UNLOCK TABLES;


-- << Inserindo os valores na tabela [nivel] !! >> --
LOCK TABLES `nivel` WRITE;
INSERT INTO `nivel` VALUES
('admin@admin.com',14,21,48),
('chad@gmail.com',5,8,14),
('gb@gb.com',2,7,11),
('gb2@gb.com',5,1,17),
('jobson@gmail.com',3,2,13),
('gb5@gb.com',1,0,10),
('gb9@gb.com',1,0,10),
('gb10@gmail.com',1,0,10),
('gb101@gmail.com',1,0,10),
('gb102@gmail.com',1,0,10),
('gb103@gmail.com',10,2,32),
('gb104@gmail.com',1,0,10),
('gb105@gmail.com',1,0,10),
('joel@gmail.com',1,0,10),
('admin2@admin.com',1,0,10);
UNLOCK TABLES;


-- << Inserindo os valores na tabela [itens] !! >> --
LOCK TABLES `itens` WRITE;
INSERT INTO `itens` VALUES
(1,'Picareta','Adiciona R$ 1 no seu valor de clique!',25,1,1,'img\\uploads\\items\\picareta.png',1),
(2,'Multiplicador','Adiciona 1 no seu multiplicador!',1000,1,1,'img\\uploads\\items\\multiplier.png',2),
(3,'Minion','Adiciona 1 minion para sua equipe!',2500,0,1,'img\\uploads\\items\\minion.png',3),
(4,'Item G','Carao',1,1,1,'img\\uploads\\items\\nerd_dog.jpg',1);
UNLOCK TABLES;


-- << Inserindo os valores na tabela [tipos_itens] !! >> --
LOCK TABLES `tipos_itens` WRITE;
INSERT INTO `tipos_itens` VALUES
(1,'clickValue'),
(2,'multiplier'),
(3,'minions');
UNLOCK TABLES;


-- << Inserindo os valores na tabela [tipos_contas] !! >> --
LOCK TABLES `tipos_contas` WRITE;
INSERT INTO `tipos_contas` VALUES (2,'ADMIN'),(1,'USER');
UNLOCK TABLES;
