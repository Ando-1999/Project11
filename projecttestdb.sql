-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2022-05-17 03:56:13
-- 服务器版本： 10.4.17-MariaDB
-- PHP 版本： 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `projecttestdb`
--

-- --------------------------------------------------------

--
-- 表的结构 `piechart`
--

CREATE TABLE `piechart` (
  `Name` varchar(30) NOT NULL,
  `Value` int(30) NOT NULL,
  `ID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `piechart`
--

INSERT INTO `piechart` (`Name`, `Value`, `ID`) VALUES
('0.3-0.4', 13, 1),
('0.4-0.5', 16, 2),
('0.5-0.6', 8, 3),
('0.6-0.7', 6, 4);

-- --------------------------------------------------------

--
-- 表的结构 `piechart2`
--

CREATE TABLE `piechart2` (
  `Name` varchar(30) NOT NULL,
  `Value` int(30) NOT NULL,
  `ID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `piechart2`
--

INSERT INTO `piechart2` (`Name`, `Value`, `ID`) VALUES
('0.1-0.2', 8, 1),
('0.2-0.3', 20, 2),
('0.3-0.4', 21, 3),
('0.4-0.5', 16, 4),
('0.5-0.6', 10, 5);

-- --------------------------------------------------------

--
-- 表的结构 `users`
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
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `no`, `passphrase`) VALUES
(1, 'Dave', 'Davidson', '$2a$12$3K.PbCCluU8.iq0ww5uhzehR/AVRfw1RUeOM4ku0zKif4PJAaqOYi', 'davo@localhost.com', '0428807372', '$2a$12$S1WtsCDeHiYGDpT/rbIiyuLR7UlM58OyABBhiDX3ysIUU9jfB7Z0u');

--
-- 转储表的索引
--

--
-- 表的索引 `piechart`
--
ALTER TABLE `piechart`
  ADD PRIMARY KEY (`ID`);

--
-- 表的索引 `piechart2`
--
ALTER TABLE `piechart2`
  ADD PRIMARY KEY (`ID`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `piechart`
--
ALTER TABLE `piechart`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `piechart2`
--
ALTER TABLE `piechart2`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
