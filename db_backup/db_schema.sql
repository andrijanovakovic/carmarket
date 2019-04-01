-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.25-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for sp_n1_v3
DROP DATABASE IF EXISTS `sp_n1_v3`;
CREATE DATABASE IF NOT EXISTS `sp_n1_v3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `sp_n1_v3`;

-- Dumping structure for table sp_n1_v3.advert
DROP TABLE IF EXISTS `advert`;
CREATE TABLE IF NOT EXISTS `advert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `car_manufacturer` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_make_year_and_month` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_first_registration_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_mileage` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_price` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_transmission` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_power` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_displacement` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_fuel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_door_count` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sp_n1_v3.advert: ~0 rows (approximately)
DELETE FROM `advert`;
/*!40000 ALTER TABLE `advert` DISABLE KEYS */;
/*!40000 ALTER TABLE `advert` ENABLE KEYS */;

-- Dumping structure for table sp_n1_v3.advert_comment
DROP TABLE IF EXISTS `advert_comment`;
CREATE TABLE IF NOT EXISTS `advert_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advert_id` int(11) NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nickname` text COLLATE utf8mb4_unicode_ci,
  `email` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(48) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_country_of_origin` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sp_n1_v3.advert_comment: ~0 rows (approximately)
DELETE FROM `advert_comment`;
/*!40000 ALTER TABLE `advert_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `advert_comment` ENABLE KEYS */;

-- Dumping structure for table sp_n1_v3.advert_image
DROP TABLE IF EXISTS `advert_image`;
CREATE TABLE IF NOT EXISTS `advert_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advert_id` int(11) DEFAULT NULL,
  `image` longblob,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sp_n1_v3.advert_image: ~0 rows (approximately)
DELETE FROM `advert_image`;
/*!40000 ALTER TABLE `advert_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `advert_image` ENABLE KEYS */;

-- Dumping structure for table sp_n1_v3.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recover_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_record` tinyint(1) DEFAULT '0',
  `remember_identifier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sp_n1_v3.user: ~0 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table sp_n1_v3.user_info
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type_id` int(11) NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gsm_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gsm_number_1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gsm_number_2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stationary_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stationary_number_1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stationary_number_2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_login` tinyint(1) NOT NULL DEFAULT '1',
  `zip` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sp_n1_v3.user_info: ~0 rows (approximately)
DELETE FROM `user_info`;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;

-- Dumping structure for table sp_n1_v3.user_type
DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sp_n1_v3.user_type: ~3 rows (approximately)
DELETE FROM `user_type`;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` (`id`, `type`) VALUES
	(1, 'regular'),
	(2, 'admin'),
	(3, 'developer');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
