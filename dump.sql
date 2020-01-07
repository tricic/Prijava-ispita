-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for webapp_0173-17
DROP DATABASE IF EXISTS `webapp_0173-17`;
CREATE DATABASE IF NOT EXISTS `webapp_0173-17` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `webapp_0173-17`;

-- Dumping structure for table webapp_0173-17.ispit
DROP TABLE IF EXISTS `ispit`;
CREATE TABLE IF NOT EXISTS `ispit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `predmet_id` int(11) NOT NULL,
  `opis` varchar(32) DEFAULT '',
  `datum` datetime NOT NULL,
  `rok_prijave` datetime NOT NULL,
  `aktivan` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_ispit_predmet` (`predmet_id`),
  CONSTRAINT `FK_ispit_predmet` FOREIGN KEY (`predmet_id`) REFERENCES `predmet` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table webapp_0173-17.ispit: ~6 rows (approximately)
DELETE FROM `ispit`;
/*!40000 ALTER TABLE `ispit` DISABLE KEYS */;
INSERT INTO `ispit` (`id`, `predmet_id`, `opis`, `datum`, `rok_prijave`, `aktivan`) VALUES
	(1, 1, 'Test 2', '2020-01-05 12:00:00', '2020-01-04 23:59:00', 1),
	(2, 3, 'Test 2', '2020-01-07 12:00:00', '2020-01-10 23:59:00', 1),
	(3, 4, 'Završni', '2020-01-14 12:00:00', '2020-01-13 23:59:00', 1),
	(4, 3, 'Završni', '2020-01-05 12:00:00', '2020-01-04 23:59:00', 1),
	(5, 1, 'Završni', '2020-01-05 12:00:00', '2020-01-04 23:59:00', 1);
/*!40000 ALTER TABLE `ispit` ENABLE KEYS */;

-- Dumping structure for table webapp_0173-17.ispit_korisnik
DROP TABLE IF EXISTS `ispit_korisnik`;
CREATE TABLE IF NOT EXISTS `ispit_korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ispit_id` int(11) DEFAULT NULL,
  `korisnik_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ispit_korisnik_ispit` (`ispit_id`),
  KEY `FK_ispit_korisnik_korisnik` (`korisnik_id`),
  CONSTRAINT `FK_ispit_korisnik_ispit` FOREIGN KEY (`ispit_id`) REFERENCES `ispit` (`id`),
  CONSTRAINT `FK_ispit_korisnik_korisnik` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table webapp_0173-17.ispit_korisnik: ~4 rows (approximately)
DELETE FROM `ispit_korisnik`;
/*!40000 ALTER TABLE `ispit_korisnik` DISABLE KEYS */;
INSERT INTO `ispit_korisnik` (`id`, `ispit_id`, `korisnik_id`) VALUES
	(2, 1, 2),
	(7, 5, 1),
	(8, 3, 1),
	(12, 1, 10);
/*!40000 ALTER TABLE `ispit_korisnik` ENABLE KEYS */;

-- Dumping structure for table webapp_0173-17.korisnik
DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnicko_ime` varchar(16) NOT NULL,
  `ime` varchar(32) NOT NULL DEFAULT '',
  `prezime` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL,
  `rank` varchar(32) NOT NULL DEFAULT 'student',
  `sifra` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table webapp_0173-17.korisnik: ~6 rows (approximately)
DELETE FROM `korisnik`;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` (`id`, `korisnicko_ime`, `ime`, `prezime`, `email`, `rank`, `sifra`) VALUES
	(1, 'admin', 'Admin', 'Adminčić', 'admin@mail.com', 'admin', '$2y$10$uDkiKd1lbdcGzrgeY1iwmOfxRoutyvhPhJu59sUZcH2LAVKWvmgQO'),
	(2, 'user1', 'User', '1', 'user1@mail.com', 'student', '$2y$10$UV.tggpJ.wWWinKMMZlNT.RoPTico2cJq4rz7ZreMNWKzDySUTZMy'),
	(3, 'user2', 'User', '2', 'user2@mail.com', 'student', '$2y$10$UV.tggpJ.wWWinKMMZlNT.RoPTico2cJq4rz7ZreMNWKzDySUTZMy'),
	(4, 'user3', 'User', '3', 'user5@mail.com', 'student', '$2y$10$UV.tggpJ.wWWinKMMZlNT.RoPTico2cJq4rz7ZreMNWKzDySUTZMy'),
	(6, 'user4', 'User', '4', 'user4@mail.com', 'student', '$2y$10$UV.tggpJ.wWWinKMMZlNT.RoPTico2cJq4rz7ZreMNWKzDySUTZMy'),
	(7, 'user121', 'User', '121', 'user121@mail.com', 'student', '$2y$10$UV.tggpJ.wWWinKMMZlNT.RoPTico2cJq4rz7ZreMNWKzDySUTZMy'),
	(10, 'test', 'Test', 'Test', 'test@test.test', 'student', '$2y$10$jCHTSsatZNTVIxq4oEoz8O2FE37gwISFbPC3gwAAxuZQ/mwl8Qw56');
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;

-- Dumping structure for table webapp_0173-17.predmet
DROP TABLE IF EXISTS `predmet`;
CREATE TABLE IF NOT EXISTS `predmet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(128) NOT NULL,
  `godina` tinyint(4) NOT NULL,
  `semestar` tinyint(4) NOT NULL,
  `profesor` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table webapp_0173-17.predmet: ~3 rows (approximately)
DELETE FROM `predmet`;
/*!40000 ALTER TABLE `predmet` DISABLE KEYS */;
INSERT INTO `predmet` (`id`, `naziv`, `godina`, `semestar`, `profesor`) VALUES
	(1, 'Web Programiranje', 3, 5, 'Neki Profesor'),
	(3, 'Elektronsko bankarstvo', 3, 5, 'Neki Profesor 2'),
	(4, 'Elektronska trgovina', 3, 5, 'Neki Profesor 3');
/*!40000 ALTER TABLE `predmet` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
