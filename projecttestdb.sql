-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 01:51 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projecttestdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `abalone`
--

CREATE TABLE `abalone` (
  `Name` varchar(30) NOT NULL,
  `Value` int(30) NOT NULL,
  `ID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `abalone`
--

INSERT INTO `abalone` (`Name`, `Value`, `ID`) VALUES
('0.3-0.4', 13, 1),
('0.4-0.5', 16, 2),
('0.5-0.6', 8, 3),
('0.6-0.7', 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `abalone2`
--

CREATE TABLE `abalone2` (
  `Name` varchar(30) NOT NULL,
  `Value` int(30) NOT NULL,
  `ID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `abalone2`
--

INSERT INTO `abalone2` (`Name`, `Value`, `ID`) VALUES
('0.1-0.2', 8, 1),
('0.2-0.3', 20, 2),
('0.3-0.4', 21, 3),
('0.4-0.5', 16, 4),
('0.5-0.6', 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no` varchar(100) NOT NULL,
  `passphrase` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `no`, `passphrase`) VALUES
(1, 'Dave', 'Davidson', '$2a$12$3K.PbCCluU8.iq0ww5uhzehR/AVRfw1RUeOM4ku0zKif4PJAaqOYi', 'davo@localhost.com', '0428807372', '$2a$12$S1WtsCDeHiYGDpT/rbIiyuLR7UlM58OyABBhiDX3ysIUU9jfB7Z0u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abalone`
--
ALTER TABLE `abalone`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `abalone2`
--
ALTER TABLE `abalone2`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abalone`
--
ALTER TABLE `abalone`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `abalone2`
--
ALTER TABLE `abalone2`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
