-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2016 at 03:01 AM
-- Server version: 5.7.11
-- PHP Version: 5.5.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capurace`
--

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(5) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL,
  `team_key` text NOT NULL,
  `name` varchar(10) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `id_card` varchar(18) NOT NULL,
  `school_id` smallint(5) UNSIGNED NOT NULL,
  `accommodation` tinyint(1) NOT NULL,
  `dinner` tinyint(1) NOT NULL,
  `lunch` tinyint(4) NOT NULL,
  `race` tinyint(4) NOT NULL DEFAULT '0',
  `ifrace` tinyint(1) NOT NULL,
  `ifteam` tinyint(1) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `islam` tinyint(1) NOT NULL,
  `fee` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL,
  `first` text NOT NULL,
  `second` text NOT NULL,
  `third` text NOT NULL,
  `fourth` text NOT NULL,
  `school_id` smallint(5) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `name` (`name`),
  ADD KEY `id_card` (`id_card`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `order` (`order`,`school_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=843;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
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
