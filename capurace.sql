-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2015 at 02:54 AM
-- Server version: 5.6.22
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `capurace`
--

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `id` smallint(5) unsigned NOT NULL,
  `name` varchar(10) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `id_card` varchar(18) NOT NULL,
  `school_id` smallint(5) unsigned NOT NULL,
  `accommodation` tinyint(1) NOT NULL,
  `meal` tinyint(1) NOT NULL,
  `race` tinyint(4) NOT NULL,
  `team_id` smallint(5) unsigned NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` smallint(5) unsigned NOT NULL,
  `first` smallint(5) unsigned NOT NULL,
  `second` smallint(5) unsigned NOT NULL,
  `third` smallint(5) unsigned NOT NULL,
  `school_id` smallint(5) unsigned NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) unsigned NOT NULL,
  `school` varchar(30) NOT NULL,
  `leader` varchar(10) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `bill` int(11) NOT NULL DEFAULT '0',
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`), ADD KEY `school_id` (`school_id`), ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`), ADD KEY `first` (`first`), ADD KEY `second` (`second`), ADD KEY `third` (`third`), ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `mail` (`mail`), ADD UNIQUE KEY `school` (`school`), ADD UNIQUE KEY `school_2` (`school`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `people`
--
ALTER TABLE `people`
ADD CONSTRAINT `people_school` FOREIGN KEY (`school_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `people_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
ADD CONSTRAINT `first_relay` FOREIGN KEY (`first`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `second_relay` FOREIGN KEY (`second`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `third_relay` FOREIGN KEY (`third`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
