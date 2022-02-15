-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.19 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных 964637-yeticave-12
CREATE DATABASE IF NOT EXISTS `964637-yeticave-12` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `964637-yeticave-12`;

-- Дамп структуры для таблица 964637-yeticave-12.bets
CREATE TABLE IF NOT EXISTS `bets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bet_value` int NOT NULL,
  `lot_title` varchar(128) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bets_lots` (`lot_title`),
  KEY `FK_bets_users` (`user_name`),
  CONSTRAINT `FK_bets_lots` FOREIGN KEY (`lot_title`) REFERENCES `lots` (`title`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_bets_users` FOREIGN KEY (`user_name`) REFERENCES `users` (`name`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица 964637-yeticave-12.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `simbolic_code` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  UNIQUE KEY `simbolic_code` (`simbolic_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица 964637-yeticave-12.lots
CREATE TABLE IF NOT EXISTS `lots` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completion_dt` timestamp NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `starting_price` int NOT NULL,
  `bet_step` int NOT NULL,
  `author_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `winner_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lots_categories` (`category_id`),
  KEY `FK_lots_users` (`author_name`) USING BTREE,
  KEY `FK_lots_users_2` (`winner_name`) USING BTREE,
  KEY `title` (`title`),
  KEY `dt_add` (`dt_add`),
  KEY `completion_dt` (`completion_dt`),
  CONSTRAINT `FK_lots_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_lots_users` FOREIGN KEY (`author_name`) REFERENCES `users` (`name`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_lots_users_2` FOREIGN KEY (`winner_name`) REFERENCES `users` (`name`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица 964637-yeticave-12.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `contact` varchar(128) NOT NULL,
  `lot_title` varchar(128) NOT NULL,
  `bet_title` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `name` (`name`),
  KEY `dt_add` (`dt_add`),
  KEY `FK_users_lots` (`lot_title`) USING BTREE,
  KEY `FK_users_bet` (`bet_title`) USING BTREE,
  CONSTRAINT `FK_users_bets` FOREIGN KEY (`bet_title`) REFERENCES `bets` (`user_name`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_users_lots` FOREIGN KEY (`lot_title`) REFERENCES `lots` (`author_name`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
