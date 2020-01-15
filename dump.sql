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


-- Dumping database structure for prijava_ispita
DROP DATABASE IF EXISTS `prijava_ispita`;
CREATE DATABASE IF NOT EXISTS `prijava_ispita` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `prijava_ispita`;

-- Dumping structure for table prijava_ispita.ispit
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table prijava_ispita.ispit: ~9 rows (approximately)
DELETE FROM `ispit`;
/*!40000 ALTER TABLE `ispit` DISABLE KEYS */;
INSERT INTO `ispit` (`id`, `predmet_id`, `opis`, `datum`, `rok_prijave`, `aktivan`) VALUES
	(1, 1, 'Test 1 - HTML, CSS, JS (10b)', '2019-11-14 16:00:00', '2019-11-13 23:59:00', 0),
	(2, 3, 'Predrok', '2019-12-25 16:15:00', '2019-12-24 23:59:00', 0),
	(3, 4, 'Završni ispit (50b)', '2020-01-23 16:00:00', '2020-01-22 23:59:00', 1),
	(4, 3, 'Završni ispit (50b)', '2020-01-29 16:59:00', '2020-01-28 23:59:00', 1),
	(5, 1, 'Završni ispit (50b)', '2020-01-23 17:00:00', '2020-01-22 23:59:00', 1),
	(6, 1, 'Test 2 - PHP, MySQL (10b)', '2020-01-16 16:00:00', '2020-01-15 23:59:00', 1),
	(7, 5, 'Završni ispit (50b)', '2020-01-21 16:00:00', '2020-01-20 23:59:00', 1),
	(8, 6, 'Završni ispit (50b)', '2020-01-31 16:00:00', '2020-01-30 23:59:00', 1),
	(9, 1, 'Odbrana projekata (25b)', '2020-01-16 17:00:00', '2020-01-16 12:00:00', 1);
/*!40000 ALTER TABLE `ispit` ENABLE KEYS */;

-- Dumping structure for table prijava_ispita.ispit_korisnik
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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- Dumping data for table prijava_ispita.ispit_korisnik: ~48 rows (approximately)
DELETE FROM `ispit_korisnik`;
/*!40000 ALTER TABLE `ispit_korisnik` DISABLE KEYS */;
INSERT INTO `ispit_korisnik` (`id`, `ispit_id`, `korisnik_id`) VALUES
	(12, 1, 10),
	(13, 3, 12),
	(16, 5, 12),
	(17, 4, 12),
	(18, 6, 12),
	(19, 7, 12),
	(20, 8, 12),
	(21, 8, 12),
	(22, 9, 12),
	(23, 3, 13),
	(24, 4, 13),
	(25, 5, 13),
	(26, 6, 13),
	(27, 7, 13),
	(28, 9, 13),
	(29, 8, 13),
	(30, 3, 14),
	(31, 4, 14),
	(32, 5, 14),
	(33, 6, 14),
	(34, 7, 14),
	(35, 8, 14),
	(36, 9, 14),
	(37, 3, 15),
	(38, 7, 15),
	(39, 5, 15),
	(40, 6, 15),
	(41, 9, 15),
	(42, 3, 16),
	(43, 4, 16),
	(44, 7, 16),
	(45, 8, 16),
	(46, 6, 16),
	(47, 5, 16),
	(48, 3, 17),
	(49, 7, 17),
	(50, 5, 17),
	(51, 6, 18),
	(52, 5, 18),
	(53, 9, 18),
	(56, 8, 19),
	(57, 3, 19),
	(58, 7, 19),
	(59, 4, 20),
	(60, 8, 20),
	(61, 7, 20),
	(62, 6, 21),
	(63, 5, 21);
/*!40000 ALTER TABLE `ispit_korisnik` ENABLE KEYS */;

-- Dumping structure for table prijava_ispita.korisnik
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Dumping data for table prijava_ispita.korisnik: ~13 rows (approximately)
DELETE FROM `korisnik`;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` (`id`, `korisnicko_ime`, `ime`, `prezime`, `email`, `rank`, `sifra`) VALUES
	(1, 'admin', 'Admin', 'Admin', 'admin@mail.com', 'admin', '$2y$10$uDkiKd1lbdcGzrgeY1iwmOfxRoutyvhPhJu59sUZcH2LAVKWvmgQO'),
	(10, 'test', 'Test', 'Test', 'test@test.test', 'student', '$2y$10$jCHTSsatZNTVIxq4oEoz8O2FE37gwISFbPC3gwAAxuZQ/mwl8Qw56'),
	(11, 'korisnik', 'Korisnik', 'Korisnikčić', 'korisnik@mail.com', 'student', '$2y$10$4ofg91KYOzHT1VRxVlXFPuACcZ47OXRoISV3fwTXj3f4yUgonlo7u'),
	(12, 'marko', 'Marko', 'Marić', 'marko@mail.com', 'student', '$2y$10$KC9/pezXDo78Az44eXcIR.HQ8mlun.nBvIyza6gTrINqR4muHEu/W'),
	(13, 'damir', 'Damir', 'Damirić', 'damir@mail.com', 'student', '$2y$10$VpRplKCImAxS7ZfOicCmO..GwKy/2QByi9LaPqLpDwYdjiVMItLY.'),
	(14, 'amir', 'Amir', 'Amirić', 'amir@mail.com', 'student', '$2y$10$BlCrDQNGzyw8y/c5F8J/NOLTa/3u7xlUE1hyX6T9bLA.9MXb7qoPa'),
	(15, 'kenan', 'Kenan', 'Kenanić', 'kenan@mail.com', 'student', '$2y$10$PDBnFvCVS7gGMMUF0fF1M.w8qmiHEnDsscH160yS0lQoEH4WykwW.'),
	(16, 'mirza', 'Mirza', 'Mirzić', 'mirza@mail.com', 'student', '$2y$10$nQajHE3.ZWdBKMMZ5Mw60.wgDFGCUy0B2n6Gds4yYS9Y8y.CCiitK'),
	(17, 'darko', 'Darko', 'Darić', 'darko@mail.com', 'student', '$2y$10$NpjS2EkJVObOzmaKB2dHJOXskmdfHOAgTeStBjkNE6kUMdao/Vmoq'),
	(18, 'selma', 'Selma', 'Selmić', 'selma@mail.com', 'student', '$2y$10$bHVcvk.GhOhnGoYbtU6mhOTcBx.fF4AefDiHYIuitATWZhChTVlcW'),
	(19, 'igor', 'Igor', 'Igorić', 'igor@mail.com', 'student', '$2y$10$TBcIYT.wbz/QgfnPGSo/6uM5HKsOtdbonvbaeawzSIRUU70CDCKFq'),
	(20, 'emina', 'Emina', 'Eminić', 'emina@mail.com', 'student', '$2y$10$LAx.JAN9tQA0UMHG3laT3eb479FLYbgzFID2UuW8IKlQQmp3n3lim'),
	(21, 'dino', 'Dino', 'Dinić', 'dino@mail.com', 'student', '$2y$10$37jP/ifN/hdwxCCv3CMTi.yEK1u0a0zHSrlEnvcuZSlbG.O7RtC0K');
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;

-- Dumping structure for table prijava_ispita.predmet
DROP TABLE IF EXISTS `predmet`;
CREATE TABLE IF NOT EXISTS `predmet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(128) NOT NULL,
  `godina` tinyint(4) NOT NULL,
  `semestar` tinyint(4) NOT NULL,
  `profesor` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table prijava_ispita.predmet: ~6 rows (approximately)
DELETE FROM `predmet`;
/*!40000 ALTER TABLE `predmet` DISABLE KEYS */;
INSERT INTO `predmet` (`id`, `naziv`, `godina`, `semestar`, `profesor`) VALUES
	(1, 'Web Programiranje', 3, 5, 'Profesor 1'),
	(3, 'Elektronsko bankarstvo i platni promet', 3, 5, 'Profesor 2'),
	(4, 'Elektronska trgovina', 3, 5, 'Profesor 3'),
	(5, 'Publicitet i sponzorstvo', 3, 5, 'Profesor 4'),
	(6, 'Projektni menadžment', 3, 5, 'Profesor 5'),
	(7, 'Web dizajn', 3, 6, 'Profesor 1');
/*!40000 ALTER TABLE `predmet` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
