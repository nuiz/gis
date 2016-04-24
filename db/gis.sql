-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2016 at 03:04 PM
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
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'aaaa', 'bbbb', '50.123', '10.12321');

-- --------------------------------------------------------

--
-- Table structure for table `cripple_type`
--

CREATE TABLE IF NOT EXISTS `cripple_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `allowance` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cripple_type`
--

INSERT INTO `cripple_type` (`id`, `name`, `allowance`) VALUES
(5, 'aa', 100),
(6, 'bb', 210),
(7, 'cc', 55);

-- --------------------------------------------------------

--
-- Table structure for table `disavantaged_type`
--

CREATE TABLE IF NOT EXISTS `disavantaged_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `allowance` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ccc1', 'bb1', '11.12', '2.222');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `created_at`, `updated_at`, `first_name`, `last_name`, `birth_date`, `address`, `village`, `district`, `city`, `province`, `zipcode`, `location_lat`, `location_lng`, `die_date`, `reg_date`, `is_older`) VALUES
(1, '2016-04-24 16:41:06', '2016-04-24 16:41:06', 'ทดสอบ', 'นะนะ', '1955-01-01', '50/1 หมู่ 5 ต.อะไร อ.ไม่รู้ จ.โน้ววว', '00', '11', '22', '33', '44', 15.2315, 100.213, '2014-06-17', '2016-02-25', 1),
(10, '2016-04-24 16:44:19', '2016-04-24 16:44:19', 'aaaa', 'bbbb', '1965-03-17', 'svs', 'vdsvds', 'sdvsdv', 'sdvsvsd', 'vsd', '101010', 13.7115, 100.639, '2015-06-02', '2013-06-13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `person_cripple`
--

CREATE TABLE IF NOT EXISTS `person_cripple` (
  `person_id` int(11) NOT NULL,
  `cripple_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person_cripple`
--

INSERT INTO `person_cripple` (`person_id`, `cripple_id`) VALUES
(10, 5),
(10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `person_disavantaged`
--

CREATE TABLE IF NOT EXISTS `person_disavantaged` (
  `person_id` int(11) NOT NULL,
  `disavantaged_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person_scholar`
--

CREATE TABLE IF NOT EXISTS `person_scholar` (
  `person_id` int(11) NOT NULL,
  `scholar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person_scholar`
--

INSERT INTO `person_scholar` (`person_id`, `scholar_id`) VALUES
(10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `scholar_type`
--

CREATE TABLE IF NOT EXISTS `scholar_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `allowance` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `scholar_type`
--

INSERT INTO `scholar_type` (`id`, `name`, `allowance`) VALUES
(2, 'aaa', 100);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
