-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Creato il: Ott 09, 2019 alle 11:33
-- Versione del server: 5.7.26
-- Versione PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_books_library`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lastname` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `unique_index_authors` (`firstname`,`lastname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `year` int(11) NOT NULL DEFAULT '1970',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `unique_index_books` (`id`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `books_by_authors`
--

DROP TABLE IF EXISTS `books_by_authors`;
CREATE TABLE IF NOT EXISTS `books_by_authors` (
  `id_book` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  PRIMARY KEY (`id_book`, `id_author`),
  KEY `FK_D979F48D40C5BF33` (`id_book`),
  KEY `FK_D979F48D9B986D25` (`id_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `books_by_categories`
--

DROP TABLE IF EXISTS `books_by_categories`;
CREATE TABLE IF NOT EXISTS `books_by_categories` (
  `id_book` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id_book`, `id_category`),
  KEY `FK_81B4E74940C5BF33` (`id_book`),
  KEY `FK_81B4E7495697F554` (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `books_by_user`
--

DROP TABLE IF EXISTS `books_by_user`;
CREATE TABLE IF NOT EXISTS `books_by_user` (
  `id_book` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_book`, `id_user`),
  KEY `id_book` (`id_book`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `unique_index_categories` (`id`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `unique_index_user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `books_by_authorsbooks_by_authors`
--
ALTER TABLE `books_by_authors`
  ADD CONSTRAINT `FK_D979F48D40C5BF33` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `FK_D979F48D9B986D25` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id`);

--
-- Limiti per la tabella `books_by_categories`
--
ALTER TABLE `books_by_categories`
  ADD CONSTRAINT `FK_81B4E74940C5BF33` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `FK_81B4E7495697F554` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);

--
-- Limiti per la tabella `books_by_user`
--
ALTER TABLE `books_by_user`
  ADD CONSTRAINT `books_by_user_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_by_user_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

-- --------------------------------------------------------

--
-- Insert
--
INSERT INTO `books` (`id`, `title`, `year`) VALUES (1, 'Matilda', '1988');
INSERT INTO `books` (`id`, `title`, `year`) VALUES (2, 'The Magic Finger', '1966');
INSERT INTO `books` (`id`, `title`, `year`) VALUES (3, 'Someone Like You', '1953');
INSERT INTO `books` (`id`, `title`, `year`) VALUES (4, 'Programming Web Services with Perl', '2009');
INSERT INTO `books` (`id`, `title`, `year`) VALUES (5, 'Programming Web Services with SOAP', '2009');
INSERT INTO `books` (`id`, `title`, `year`) VALUES (6, 'Creepshow', '1982');

INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES (1, 'Roald', 'Dahl');
INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES (2, 'James', 'Snell');
INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES (3, 'Doug', 'Tidwell');
INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES (4, 'Pavel', 'Kulchenko');
INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES (5, 'Stephen', 'King');

INSERT INTO `books_by_authors` (`id_book`, `id_author`) VALUES ('1', '1');
INSERT INTO `books_by_authors` (`id_book`, `id_author`) VALUES ('2', '1');
INSERT INTO `books_by_authors` (`id_book`, `id_author`) VALUES ('3', '1');

INSERT INTO `books_by_authors` (`id_book`, `id_author`) VALUES ('4', '2');
INSERT INTO `books_by_authors` (`id_book`, `id_author`) VALUES ('4', '3');
INSERT INTO `books_by_authors` (`id_book`, `id_author`) VALUES ('4', '4');

INSERT INTO `books_by_authors` (`id_book`, `id_author`) VALUES ('6', '5');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
