-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2016 at 10:51 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hackdmc`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_id` varchar(16) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(16) NOT NULL,
  `component` varchar(16) NOT NULL,
  `type` varchar(16) NOT NULL,
  `alarm` varchar(16) NOT NULL,
  `sequence` varchar(16) NOT NULL,
  `begin_dt_tm` varchar(16) NOT NULL,
  `subtype` varchar(16) NOT NULL,
  `mt_name` varchar(16) NOT NULL,
  `mt_value` varchar(128) NOT NULL,
  `energy` varchar(16) NOT NULL,
  `instance_id` varchar(16) NOT NULL,
  `virtual_flag` varchar(4) NOT NULL,
  `dataitemid` varchar(16) NOT NULL,
  `alarm_condition` varchar(16) NOT NULL,
  `alarm_type` varchar(16) NOT NULL,
  `alarm_name` varchar(128) NOT NULL,
  `alarm_code` varchar(16) NOT NULL,
  `alarm_nativeCode` varchar(16) NOT NULL,
  `alarm_severity` varchar(16) NOT NULL,
  `reason` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1644694 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
