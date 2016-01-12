-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3330
-- Generation Time: Jan 12, 2016 at 03:11 PM
-- Server version: 5.5.45
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `graph`
--

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE IF NOT EXISTS `work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work` varchar(255) NOT NULL,
  `worktime` int(11) NOT NULL,
  `workdate` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `work`, `worktime`, `workdate`, `status`, `comment`) VALUES
(1, 'Graph', 180, '2016-01-11', 0, NULL),
(2, 'AARBI', 60, '2016-01-11', 0, NULL),
(3, 'Jokes control', 160, '2016-01-11', 0, NULL),
(4, 'Relaxation', 30, '2016-01-11', 0, NULL),
(5, 'Graph', 180, '2016-01-11', 0, NULL),
(7, 'PHP', 200, '2016-01-12', 0, NULL),
(8, 'PHP', 200, '2016-01-12', 0, NULL),
(9, 'PHP', 200, '2016-01-12', 0, NULL),
(10, 'PHP', 200, '2016-01-12', 0, NULL),
(11, 'PHP', 200, '2016-01-12', 0, NULL),
(12, 'PHP', 200, '2016-01-12', 0, NULL),
(13, 'PHP', 200, '2016-01-12', 0, NULL),
(14, 'PHP', 200, '2016-01-12', 0, NULL),
(15, 'PHP', 200, '2016-01-12', 0, NULL),
(16, 'PHP', 200, '2016-01-12', 0, NULL),
(17, 'PHP', 200, '2016-01-12', 0, NULL),
(18, 'PHP', 200, '2016-01-12', 0, NULL),
(19, 'PHP', 200, '2016-01-12', 0, NULL),
(20, 'PHP', 200, '2016-01-12', 0, NULL),
(21, 'Ianc', 180, '2016-01-12', 0, NULL),
(22, 'Ianc', 180, '2016-01-12', 0, NULL),
(23, 'Graph', 90, '2016-01-12', 2, 'Need to work man!'),
(24, 'Memoris', 15, '2016-01-12', 1, 'Need to work man!'),
(25, 'Memoris', 15, '2016-01-12', 1, 'Need to work man! Because it depends on it your future'),
(27, 'English', 15, '2016-01-12', 4, 'It depends on it your future!'),
(28, 'English', 15, '2016-01-12', 5, 'Iit depends on it your future!');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
