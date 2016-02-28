-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2016 at 09:36 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gis`
--

-- --------------------------------------------------------

--
-- Table structure for table `careergroup`
--

CREATE TABLE IF NOT EXISTS `careergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location_lat` varchar(20) NOT NULL,
  `location_lng` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `careergroup`
--

INSERT INTO `careergroup` (`id`, `created_at`, `updated_at`, `name`, `description`, `location_lat`, `location_lng`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'aaaa', 'bbbb', '212', '332');

-- --------------------------------------------------------

--
-- Table structure for table `learningcenter`
--

CREATE TABLE IF NOT EXISTS `learningcenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location_lat` varchar(20) NOT NULL,
  `location_lng` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `learningcenter`
--

INSERT INTO `learningcenter` (`id`, `created_at`, `updated_at`, `name`, `description`, `location_lat`, `location_lng`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ccc1', 'bb1', '1112', '2222');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text NOT NULL,
  `village` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `zipcode` varchar(100) NOT NULL,
  `location_lat` float DEFAULT NULL,
  `location_lng` float DEFAULT NULL,
  `die_date` date DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `is_older` tinyint(1) NOT NULL,
  `cripple_id` int(11) NOT NULL,
  `disa_id` int(11) NOT NULL,
  `scho_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `created_at`, `updated_at`, `first_name`, `last_name`, `birth_date`, `address`, `village`, `district`, `city`, `province`, `zipcode`, `location_lat`, `location_lng`, `die_date`, `reg_date`, `is_older`, `cripple_id`, `disa_id`, `scho_id`) VALUES
(1, '2016-02-28 14:13:44', '2016-02-28 14:13:44', 'ffff', 'llll', '1955-06-21', '50/1 หมู่ 5 ต.อะไร อ.ไม่รู้ จ.โน้ววว', '00', '11', '22', '33', '44', 15.2315, 100.213, '2016-02-11', '2016-02-25', 1, 0, 3, 4),
(2, '2016-02-09 22:13:33', '2016-02-09 22:13:33', 'ffff', 'llll', '1940-02-20', 'sdvsdcvdv', '', '0', '0', '0', '0', 111222, 2222, NULL, NULL, 0, 1, 2, 3),
(9, '2016-02-09 21:55:38', '2016-02-09 21:55:38', 'asca', 'cascasc', '1990-02-20', 'ascascascas', '', '0', '0', '0', '0', 0, 0, '1990-02-20', '1990-02-20', 0, 3, 3, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
