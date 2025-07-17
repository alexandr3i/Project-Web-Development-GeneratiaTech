-- AdminNeo 4.17.2 MySQL 8.0.35 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `film_id` bigint unsigned NOT NULL,
  `nume` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `mesaj` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `reviews` (`id`, `film_id`, `nume`, `email`, `mesaj`) VALUES
(38,	6,	'Angheluță',	'andudesign01@gmail.com',	'eeee'),
(39,	5,	'Andrei',	'andudesign01@gmail.com',	'Cel mai bun film');

-- 2025-07-10 17:06:07 UTC
