-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2015 at 08:57 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wttest`
--

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnicko_ime` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `korisnicko_ime`, `email`, `lozinka`) VALUES
(1, 'Hamdo', 'hhadzic1@etf.unsa.ba', 'hamdo');

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE IF NOT EXISTS `novosti` ( 
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tekst` text COLLATE utf8_unicode_ci NOT NULL,
  `detaljnije` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datum` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `korisnik_id` (`korisnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;
ALTER TABLE `novosti`
  ADD CONSTRAINT `novosti_ibfk_2` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `novosti_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`id`, `naslov`, `korisnik_id`, `slika`, `tekst`, `detaljnije`, `datum`) VALUES
(1, 'Naslov', 1, 'images/2.gif', 'Perfume or parfum is a mixture of fragrant essential\r\n oils or aroma compounds, fixatives and solvents used to give the\r\n human body, animals, food, objects, and living spaces "a pleasant scent."[1]\r\nPerfumes have been known to exist in some of the earliest human civilizations,\r\n either through ancient texts or from archaeological digs. Modern perfumery began\r\n in the late 19th century with the commercial synthesis of aroma compounds such as \r\n vanillin or coumarin, which allowed for the composition of perfumes with smells previously \r\n unattainable solely from natural aromatics alone.', NULL, '2015-05-26 23:29:31'),
(2, 'Nova novost', 1, NULL, 'Nova!', 'Test', '2015-05-28 05:25:26');


--
-- Table structure for table `komentari`
--

CREATE TABLE IF NOT EXISTS `komentari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `novost_id` int(11) NOT NULL,
  `autor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tekst` text COLLATE utf8_unicode_ci NOT NULL,
  `datum` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `novost_id` (`novost_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`novost_id`) REFERENCES `novosti` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
  
INSERT INTO `komentari` (`id`, `novost_id`, `autor`, `email`, `tekst`, `datum`) VALUES
(1, 1, 'Hamdo', 'hhadzic1@etf.unsa.ba', 'Test komentar', '2015-05-28 05:01:37'),
(2, 2, 'H', 'h@etf.unsa.ba', 'komentar', '2015-05-29 05:31:40');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--


--
-- Constraints for table `novosti`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
