-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 11, 2016 at 09:06 PM
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `work`, `worktime`, `workdate`, `status`) VALUES
(1, 'Graph', 180, '2016-01-11', 0),
(2, 'AARBI', 60, '2016-01-11', 0),
(3, 'Jokes control', 160, '2016-01-11', 0),
(4, 'Relaxation', 30, '2016-01-11', 0),
(5, 'Graph', 180, '2016-01-11', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
