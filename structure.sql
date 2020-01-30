-- phpMyAdmin SQL Dump
-- version 5.1.0-dev
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2020 at 01:10 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsr`
--

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `id` int(11) NOT NULL,
  `column_1` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `column_2` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `column_3` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `column_4` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `column_5` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `column_6` varchar(128) CHARACTER SET utf8mb4 DEFAULT NULL,
  `column_7` text CHARACTER SET utf8mb4,
  `column_8` int(11) NOT NULL,
  `column_9` tinyint(1) NOT NULL,
  `column_10` tinyint(1) NOT NULL,
  `column_11` tinyint(1) NOT NULL DEFAULT '0',
  `column_12` tinyint(1) NOT NULL DEFAULT '0',
  `column_13` tinyint(1) NOT NULL,
  `column_14` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `column_15` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `column_16` timestamp NULL DEFAULT NULL,
  `column_17` varchar(16) CHARACTER SET utf8mb4 DEFAULT NULL,
  `column_18` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table`
--
ALTER TABLE `table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
