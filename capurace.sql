-- phpMyAdmin SQL Dump
-- version 4.3.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2015 at 12:05 AM
-- Server version: 5.6.23
-- PHP Version: 5.5.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `capurace`
--
CREATE DATABASE IF NOT EXISTS `capurace` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `capurace`;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE IF NOT EXISTS `people` (
  `id` int(5) unsigned NOT NULL,
  `order` int(11) NOT NULL,
  `key` text NOT NULL,
  `name` varchar(10) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `id_card` varchar(18) NOT NULL,
  `school_id` smallint(5) unsigned NOT NULL,
  `accommodation` tinyint(1) NOT NULL,
  `meal16` tinyint(1) NOT NULL,
  `meal17` tinyint(4) NOT NULL,
  `race` tinyint(4) NOT NULL DEFAULT '0',
  `shimano16` smallint(6) NOT NULL DEFAULT '0',
  `shimano17` smallint(6) NOT NULL DEFAULT '0',
  `ifrace` tinyint(1) NOT NULL,
  `ifteam` tinyint(1) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `islam` tinyint(1) NOT NULL,
  `fee` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` smallint(5) unsigned NOT NULL,
  `order` int(11) NOT NULL,
  `first` text NOT NULL,
  `second` text NOT NULL,
  `third` text NOT NULL,
  `fourth` text NOT NULL,
  `school_id` smallint(5) unsigned NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) unsigned NOT NULL,
  `school` varchar(30) NOT NULL,
  `leader` varchar(10) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `bill` int(11) NOT NULL DEFAULT '0',
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `association_name` varchar(15) NOT NULL,
  `province` smallint(6) NOT NULL,
  `address` varchar(50) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(32) NOT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`), ADD KEY `school_id` (`school_id`), ADD KEY `name` (`name`), ADD KEY `id_card` (`id_card`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`), ADD KEY `school_id` (`school_id`), ADD KEY `order` (`order`,`school_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `people`
--
ALTER TABLE `people`
ADD CONSTRAINT `people_school` FOREIGN KEY (`school_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
