-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2016 at 02:27 AM
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
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(20) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `level`, `username`, `password`, `name`) VALUES
(1, 'admin', 'admin', '1234', 'Admin'),
(5, 'staff', 'staff01', '1234', 'ทดสอบ Staff'),
(7, 'user', 'user01', '123456', 'ทดสอบ User');

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
  `contact_firstname` varchar(255) NOT NULL,
  `contact_lastname` varchar(255) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `location_lat` varchar(20) NOT NULL,
  `location_lng` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `careergroup`
--

INSERT INTO `careergroup` (`id`, `created_at`, `updated_at`, `name`, `description`, `contact_firstname`, `contact_lastname`, `contact_phone`, `location_lat`, `location_lng`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'กลุ่มอาชีพไข่ไอโอดีน', 'กลุ่มอาชีพไข่สดเสริมไอโอดีน ได้จัดทำโครงการโภชนาการไอโอดีนเฉลิมพระเกียรติ 72 พรรษา เพื่อถวายเป็นพระราชกุศล เพื่อให้ประชาชนไม่ขาดสารไอโอดีน อันก่อให้เกิดโรคทั้งร่างกายและเกิดความบกพร่องทางสมองโดยเฉพาะหญิงตั้งครรภ์ ควรได้รับสารไอโอดีน เพื่อป้องกันความพิการทั้งร่างกายและสมองของบุต', 'ทดสอบชื่อผู้ติดต่อ', 'ทดสอบนามสกุล', '094-4444444', '16.302034', '99.093023'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'กลุ่มอาชีพไม้กวาดดอกหญ้า', 'ด้วยหมู่ที่ 5 ตำบลบ้านใหญ่ ชาวบ้านส่วนใหญ่ประกอบอาชีพทำนา หลังจากทำนาเสร็จแล้วชาวบ้านก็จะว่างงาน จึงได้คิดกันว่าจะทำอะไรเป็นอาชีพเสริมเพื่อให้เกิดรายได้เพิ่ม จึงตั้งกลุ่มอาชีพผลิตภัณฑ์ไม้กวาดขึ้นเมื่อวันที่ 29 สิงหาคม พ.ศ.2542 มีสมาชิกจำนวน 15 คน ปัจจุบันผลิตไม้กวาดคุณภาพดีขาย มีรายได้เพิ่มพอสมควร', '', '', '', '13.720939', '99.188832'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'กลุ่มไข่เค็มไอโอดีน', ' การผลิตลำไยนอกฤดู ส่งขายต่างประเทศ อย่างประเทศจีน(ตลาดปลายทางรับซื้อไม่อั้น) \r\n\r\nมีขั้นตอนการผลิตที่ซับซ้อน และยังมีเกษตรกรชาวสวนลำไยอีกมาก ที่ยังไม่เข้าใจในการผลิต\r\n\r\nลำไยนอกฤดู', '', '', '', '16.112233', '99.332211');

-- --------------------------------------------------------

--
-- Table structure for table `cripple_type`
--

CREATE TABLE IF NOT EXISTS `cripple_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `cripple_type`
--

INSERT INTO `cripple_type` (`id`, `name`) VALUES
(5, 'ความพิการการมองเห็น'),
(6, 'ความพิการทางการได้ยิน'),
(7, 'ความพิการทางการเคลื่อนไหว'),
(8, 'ความพิการทางจิตใจ'),
(9, 'ความพิการทางสติปัญญา'),
(10, 'ความพิการทางการเรียนรู้'),
(11, 'ความพิการทางออทิสติก');

-- --------------------------------------------------------

--
-- Table structure for table `disavantaged_type`
--

CREATE TABLE IF NOT EXISTS `disavantaged_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `disavantaged_type`
--

INSERT INTO `disavantaged_type` (`id`, `name`) VALUES
(1, 'คนยากจน'),
(2, 'คนเร่ร่อน'),
(3, 'คนไม่มีสถานะทางทะเบียน'),
(4, 'ผู้พ้นโทษ'),
(5, 'ผู้ติดเชื้อHIV');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `learningcenter`
--

INSERT INTO `learningcenter` (`id`, `created_at`, `updated_at`, `name`, `description`, `location_lat`, `location_lng`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'การปลูกลำไยนอกฤดู', '	\r\nคำอธิบายรายวิชา\r\n\r\nพฤกษศาสตร์ การปลูก การปฏิบัติรักษา การผลิตพืชอาหารสัตว์เขตร้อน คุณภาพและการเก็บรักษาพืชอาหารสัตว์ ระบบการจัดการทุ่งหญ้าเลี้ยงสัตว์ ปัจจัยควบคุมสมดุลของผลผลิตพืชอาหารสัตว์ ระบบการเก็บเกี่ยวผลผลิตและการจัดการสัตว์เข้าแทะเล็ม และวิธีการวิจัย', '16.562151', '99.974331'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ศูนย์การเรียนรู้เกษตรพอเพียง', 'เศรษฐกิจพอเพียง เป็นปรัชญาที่พระบาทสมเด็จพระปรมินทรมหาภูมิพลอดุลยเดชมีพระราชดำรัสแก่ชาวไทยนับตั้งแต่ พ.ศ. 2517 เป็นต้นมา[1][2] และถูกพูดถึงอย่างชัดเจนในวันที่ 4 ธันวาคม พ.ศ. 2540 เพื่อเป็นแนวทางการแก้ไขวิกฤตการณ์ทางการเงินในเอเชีย พ.ศ. 2540 ให้สามารถดำรงอยู่ได้อย่างมั่นคงและยั่งยืนในกระแสโลกาภิวัตน์และความเปลี่ยนแปลงต่าง ๆ ', '16.334501', '99.901347'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ศูนย์การเรียนรู้พืชอาหารสัตว์', '	\r\nคำอธิบายรายวิชา\r\n\r\nพฤกษศาสตร์ การปลูก การปฏิบัติรักษา การผลิตพืชอาหารสัตว์เขตร้อน คุณภาพและการเก็บรักษาพืชอาหารสัตว์ ระบบการจัดการทุ่งหญ้าเลี้ยงสัตว์ ปัจจัยควบคุมสมดุลของผลผลิตพืชอาหารสัตว์ ระบบการเก็บเกี่ยวผลผลิตและการจัดการสัตว์เข้าแทะเล็ม และวิธีการวิจัย', '19.947821', '99.321656');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `card_id` char(13) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `created_at`, `updated_at`, `card_id`, `first_name`, `last_name`, `birth_date`, `address`, `village`, `district`, `city`, `province`, `zipcode`, `location_lat`, `location_lng`, `die_date`, `reg_date`, `is_older`) VALUES
(1, '2016-05-01 10:57:30', '2016-05-01 10:57:30', '3601200340841', 'นายทองคำ', 'ลาภา', '1941-03-04', '3/1', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7128, 99.1572, NULL, NULL, 1),
(10, '2016-04-30 19:45:42', '2016-04-30 19:45:42', '3601200340589', 'นางฉ้างเล่ง', 'ลาภา', '1929-03-07', '3/1', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7128, 99.1572, NULL, NULL, 1),
(11, '2016-04-30 19:54:16', '2016-04-30 19:54:16', '3630100408876', 'นางสาวลัดดา', 'พรหมมา', '1945-12-01', '10', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7069, 99.1836, NULL, NULL, 1),
(12, '2016-04-30 19:49:18', '2016-04-30 19:49:18', '3630100408761', 'นางจันทร์', 'ก้อนคำ', '1934-01-01', '5/1', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', 'ุ63000', 16.7102, 99.183, NULL, NULL, 1),
(13, '2016-04-30 19:56:54', '2016-04-30 19:56:54', '3630100408922', 'นายสง่า', 'ศิริชาติ', '1950-06-04', '10/1', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.704, 99.1824, NULL, NULL, 1),
(14, '2016-04-30 21:37:42', '2016-04-30 21:37:42', '3630100413101', 'นายปรุง', 'พรหมมา', '1939-07-21', '10/5', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7069, 99.1836, NULL, NULL, 1),
(15, '2016-04-30 20:05:43', '2016-04-30 20:05:43', '3630100409139', 'นายแสวง', 'แน่งน้อย', '1947-01-01', '12/1', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.6954, 99.1798, NULL, NULL, 1),
(16, '2016-04-30 20:57:45', '2016-04-30 20:57:45', '3640600634123', 'นางทองปอนด์', 'ยอดทองดี', '1945-02-02', '12/5', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7024, 99.1773, NULL, NULL, 1),
(17, '2016-05-06 23:24:57', '2016-05-06 23:24:57', '3170600066421', 'นางอารีย์', 'ใจกล้า', '1945-01-01', '13/7', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7035, 99.1813, NULL, NULL, 1),
(18, '2016-04-30 21:05:02', '2016-04-30 21:05:02', '3600500569273', 'นายสำเนียง', 'กงศูนย์', '1943-01-01', '1', '6', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.74, 99.0915, NULL, NULL, 1),
(19, '2016-04-30 21:08:10', '2016-04-30 21:08:10', '3660600613941', 'นายพร', 'บุญมาพาด', '1948-01-01', '3', '6', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7408, 99.0911, NULL, NULL, 1),
(20, '2016-05-01 10:35:47', '2016-05-01 10:35:47', '3630100416933', 'นายพรม', 'พลเดชา', '1943-01-01', '3/2', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7069, 99.1107, NULL, NULL, 1),
(21, '2016-04-30 21:41:13', '2016-04-30 21:41:13', '3620500027373', 'นายเทียม', 'สร้อยศรี', '1937-01-01', '2/4', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.6993, 99.1146, NULL, NULL, 1),
(22, '2016-04-30 21:19:16', '2016-04-30 21:19:16', '3630100417085', 'นางหลวย', 'บุตรพรหม', '1940-01-01', '5', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7131, 99.109, NULL, NULL, 1),
(23, '2016-04-30 21:22:13', '2016-04-30 21:22:13', '3630100417239', 'นางหลาย', 'สุขนวน', '1945-01-01', '6', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7091, 99.1101, NULL, NULL, 1),
(24, '2016-04-30 21:24:10', '2016-04-30 21:24:10', '3630100417298', 'นางทิม', 'สีไพร', '1943-03-01', '7', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.714, 99.1114, NULL, NULL, 1),
(25, '2016-04-30 21:26:49', '2016-04-30 21:26:49', '3630100417280', 'นายมี', 'สีไพร', '1939-01-01', '7', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.714, 99.1114, NULL, NULL, 1),
(26, '2016-04-30 21:29:01', '2016-04-30 21:29:01', '3620100700801', 'นางคูณ', 'จำปาวงษ์', '1936-01-01', '7/5', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7012, 99.1146, NULL, NULL, 1),
(27, '2016-04-30 21:31:48', '2016-04-30 21:31:48', '3620100700798', 'นายบุญเพ็ง', 'จำปาวษ์', '1931-01-01', '7/5', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7012, 99.1146, NULL, NULL, 1),
(28, '2016-04-30 21:40:55', '2016-04-30 21:40:55', '3620100822435', 'นางสมนึก', 'ออกช่อ', '1946-01-01', '8/2', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7234, 99.1061, NULL, NULL, 1),
(29, '2016-04-30 21:44:14', '2016-04-30 21:44:14', '3630100417867', 'นางจำปา', 'จันทโคต', '1941-01-01', '11', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7029, 99.1127, NULL, NULL, 1),
(30, '2016-04-30 21:46:29', '2016-04-30 21:46:29', '3630100418197', 'นางเพ็ญศรี', 'ยิ้มประเสริฐ', '1947-01-01', '13', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7091, 99.1094, NULL, NULL, 1),
(31, '2016-05-06 21:07:47', '2016-05-06 21:07:47', '3421100039041', 'นายมี', 'วังคีรี', '1948-10-03', '15', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7144, 99.1081, NULL, NULL, 1),
(32, '2016-04-30 21:50:37', '2016-04-30 21:50:37', '3620100421821', 'นางโหละ', 'กล่ำแก้ว', '1939-01-01', '16/1', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7156, 99.1163, NULL, NULL, 1),
(33, '2016-04-30 21:52:41', '2016-04-30 21:52:41', '3620100421813', 'นายวัน', 'กล่ำแก้ว', '1940-01-01', '16/1', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7156, 99.1163, NULL, NULL, 1),
(34, '2016-04-30 21:54:31', '2016-04-30 21:54:31', '3630100418448', 'นายพวง', 'พรมสุวรรณ', '1944-01-01', '17', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7033, 99.1128, NULL, NULL, 1),
(35, '2016-04-30 21:56:47', '2016-04-30 21:56:47', '3630100418596', 'นางมา', 'ดวงอุประ', '1945-07-16', '19', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.6997, 99.1154, NULL, NULL, 1),
(36, '2016-04-30 21:58:54', '2016-04-30 21:58:54', '3630100419118', 'นายเลด', 'สุขนวน', '1936-01-01', '26', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7045, 99.1115, NULL, NULL, 1),
(37, '2016-04-30 22:02:22', '2016-04-30 22:02:22', '3630100419193', 'นายกวย', 'ขวัญลอย', '1926-01-01', '27', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7124, 99.1114, NULL, NULL, 1),
(38, '2016-04-30 22:15:08', '2016-04-30 22:15:08', '3630100740242', 'นายสิน', 'กรงทอง', '1949-01-01', '29/1', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7045, 99.1127, NULL, NULL, 1),
(39, '2016-04-30 22:14:47', '2016-04-30 22:14:47', '3660100167836', 'นายบุญชู', 'คำเอม', '1947-01-01', '29/4', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.712, 99.112, NULL, NULL, 1),
(40, '2016-04-30 22:16:54', '2016-04-30 22:16:54', '3630100419525', 'นายแก่น', 'พรมภาพ', '1935-01-01', '31', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7142, 99.112, NULL, NULL, 1),
(41, '2016-04-30 22:21:44', '2016-04-30 22:21:44', '3630100419533', 'นางพวง', 'พรมภาพ', '1934-01-08', '31', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7142, 99.112, NULL, NULL, 1),
(42, '2016-04-30 22:23:34', '2016-04-30 22:23:34', '3630100419657', 'นางดม', 'นาสมชัย', '1942-08-20', '34/1', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7044, 99.1128, NULL, NULL, 1),
(43, '2016-04-30 22:25:23', '2016-04-30 22:25:23', '3630100419649', 'นายเคน', 'นาสมชัย', '1938-03-01', '34/1', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7044, 99.1128, NULL, NULL, 1),
(44, '2016-04-30 22:27:35', '2016-04-30 22:27:35', '3630100662675', 'นางเล็ก', 'คำนวณ', '1931-01-01', '35', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.9699, 99.1164, NULL, NULL, 1),
(45, '2016-04-30 22:30:47', '2016-04-30 22:30:47', '3630100662667', 'นายอยู่', 'คำนวณ', '1930-01-01', '35', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.9699, 99.1164, NULL, NULL, 1),
(46, '2016-04-30 22:32:34', '2016-04-30 22:32:34', '3601101042612', 'นางบุญธรรม', 'ปั้นทอง', '1928-01-01', '36/3', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7133, 99.115, NULL, NULL, 1),
(47, '2016-04-30 22:35:24', '2016-04-30 22:35:24', '5630190007562', 'นายสวอง', 'บุญสายยัง', '1947-12-13', '40/2', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7096, 99.1082, NULL, NULL, 1),
(48, '2016-04-30 22:37:12', '2016-04-30 22:37:12', '3721000116491', 'นายเชิง', 'ฉ่ำสดใส', '1934-01-01', '40/5', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7178, 99.1231, NULL, NULL, 1),
(49, '2016-04-30 22:38:48', '2016-04-30 22:38:48', '3720100116504', 'นางชื้น', 'ฉ่ำสดใส', '1934-01-01', '40/5', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7178, 99.1231, NULL, NULL, 1),
(50, '2016-04-30 22:42:04', '2016-04-30 22:42:04', '3630100420370', 'นายคอย', 'สุขกุล', '1937-01-01', '41', '2', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7016, 99.1135, NULL, NULL, 1),
(51, '2016-04-30 22:52:51', '2016-04-30 22:52:51', '3630100409961', 'นายหิน', 'อินตาไซ้', '1939-01-01', '18', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7031, 99.1814, NULL, NULL, 1),
(52, '2016-04-30 22:57:34', '2016-04-30 22:57:34', '3630100409970', 'นางวรรณดี', 'อินตาไซ้', '1939-01-01', '18', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7031, 99.1814, NULL, NULL, 1),
(53, '2016-05-01 10:41:39', '2016-05-01 10:41:39', '3630100410005', 'นายเสียน', 'หมื่นดารา', '1947-01-01', '18/1', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7016, 99.1769, NULL, '2015-10-01', 1),
(54, '2016-04-30 23:01:54', '2016-04-30 23:01:54', '3630100409732', 'นายเที่ยง', 'ใจกล้า', '1949-04-02', '13/7', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7035, 99.1813, NULL, NULL, 1),
(55, '2016-04-30 23:03:39', '2016-04-30 23:03:39', '3630100410072', 'นางปลูก', 'โพรพัตร์', '1939-08-24', '18/2', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7041, 99.1824, NULL, NULL, 1),
(56, '2016-04-30 23:05:37', '2016-04-30 23:05:37', '3630100401153', 'นายเพียร', 'เกษวิทย์', '1938-01-01', '21', '1', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7028, 99.1808, NULL, NULL, 1),
(57, '2016-04-30 23:10:37', '2016-04-30 23:10:37', '3600500569281', 'นางสมใจ', 'กงศูนย์', '1946-01-01', '1', '6', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.74, 99.0915, NULL, NULL, 1),
(58, '2016-04-30 23:23:43', '2016-04-30 23:23:43', '3660600830097', 'นางจำรัส', 'กงศูนย์', '1944-01-01', '4', '6', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7412, 99.0912, NULL, NULL, 1),
(59, '2016-04-30 23:35:54', '2016-04-30 23:35:54', '3660600830089', 'นายใบ', 'กงศูนย์', '1944-01-01', '4', '6', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7412, 99.0912, NULL, NULL, 1),
(60, '2016-04-30 23:38:19', '2016-04-30 23:38:19', '3650800951831', 'นายหล่อ', 'ขำพันธ์', '1940-01-01', '8', '6', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7352, 99.092, NULL, NULL, 1),
(61, '2016-04-30 23:40:26', '2016-04-30 23:40:26', '3650800951840', 'นางเล็ก', 'ขำพันธ์', '1944-01-01', '8', '6', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7352, 99.092, NULL, NULL, 1),
(62, '2016-04-30 23:54:12', '2016-04-30 23:54:12', '3650800948571', 'นายโต', 'ขำพันธ์', '1933-06-15', '11', '6', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.735, 99.0931, NULL, NULL, 1),
(63, '2016-04-30 23:54:22', '2016-04-30 23:54:22', '3620400212144', 'นายบุญมี', 'สัมโย', '1939-01-01', '16', '6', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7373, 99.0921, NULL, NULL, 1),
(64, '2016-04-30 23:56:41', '2016-04-30 23:56:41', '3660800275283', 'นายบรรจบ', 'ศรีนาแพง', '1945-01-01', '19', '6', 'นาโบสถ์', 'วังเจ้า', 'ตาก', '63000', 16.7395, 99.092, NULL, NULL, 1),
(65, '2016-05-06 22:17:53', '2016-05-06 22:17:53', '1231231231293', 'sfsd', 'sdfsdfsd', '1970-06-09', 'asdasdsa', 'dasdsa', 'asdasd', 'asdsa', 'dasdsa', 'dsadsa', 20.1012, 20.1012, '2016-05-03', '2016-05-10', 1);

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
(38, 7),
(43, 6),
(20, 5),
(65, 8),
(65, 9),
(17, 8);

-- --------------------------------------------------------

--
-- Table structure for table `person_disavantaged`
--

CREATE TABLE IF NOT EXISTS `person_disavantaged` (
  `person_id` int(11) NOT NULL,
  `disavantaged_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person_disavantaged`
--

INSERT INTO `person_disavantaged` (`person_id`, `disavantaged_id`) VALUES
(65, 2),
(65, 3);

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
(27, 6),
(14, 5),
(37, 3),
(54, 4),
(20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `scholar`
--

CREATE TABLE IF NOT EXISTS `scholar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `scholar_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `contact_firstname` varchar(255) NOT NULL,
  `contact_lastname` varchar(255) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `location_lat` varchar(20) NOT NULL,
  `location_lng` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `scholar`
--

INSERT INTO `scholar` (`id`, `created_at`, `updated_at`, `name`, `scholar_type`, `description`, `contact_firstname`, `contact_lastname`, `contact_phone`, `location_lat`, `location_lng`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ชื่อนะจะ', 'ประเภททดสอบ', 'หกดหกดหกด', 'ชทดสอบ', 'นทดสอบ', '03024324023', '20.123102', '120.12312');

-- --------------------------------------------------------

--
-- Table structure for table `scholar_type`
--

CREATE TABLE IF NOT EXISTS `scholar_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `scholar_type`
--

INSERT INTO `scholar_type` (`id`, `name`) VALUES
(2, 'สาขาคติความเชื่อหลักปฏิบัติ'),
(3, 'สาขาประเพณีพิธีกรรม'),
(4, 'สาขาการดำรงชีพและโภชนาการพื้นบ้าน'),
(5, 'สาขาการดูแลสุขภาพพื้นบ้าน'),
(6, 'สาขาเทคโนโลยีพื้นบ้าน'),
(7, 'สาขาบริหารจัดการความหลากหลายทางชีวภาพ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
