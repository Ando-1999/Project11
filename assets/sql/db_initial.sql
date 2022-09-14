SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aq_data_db`
--

DROP DATABASE IF EXISTS `aq_data_db`;

CREATE DATABASE `aq_data_db`;

USE `aq_data_db`;

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_title` varchar(255) NOT NULL,
  PRIMARY KEY (role_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `Users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `num` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `available` BOOLEAN NOT NULL DEFAULT 1,
  `institute` varchar(255) NOT NULL,
  `passphrase` varchar(100) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_Role FOREIGN KEY (role_id) 
  REFERENCES Roles(role_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `Users`
-- Note: Data will be added by user through tool
--

CREATE TABLE `aq_data`(
    `FID` VARCHAR(255) DEFAULT NULL,
    `TRIP_ID` VARCHAR(255) DEFAULT NULL,
    `DATE_TRIP` VARCHAR(255) DEFAULT NULL,
    `YEAR` VARCHAR(255) DEFAULT NULL,
    `MONTH` VARCHAR(255) DEFAULT NULL,
    `SITE_CODE` VARCHAR(255) DEFAULT NULL,
    `LATITUDE` VARCHAR(255) DEFAULT NULL,
    `LONGITUDE` VARCHAR(255) DEFAULT NULL,
    `GEOM` VARCHAR(255) DEFAULT NULL,
    `LICOR_AV` VARCHAR(255) DEFAULT NULL,
    `DEPTH_SECCHI` VARCHAR(255) DEFAULT NULL,
    `DEPTH` VARCHAR(255) DEFAULT NULL,
    `REPLICATE` VARCHAR(255) DEFAULT NULL,
    `VOLUME_FILTERED` VARCHAR(255) DEFAULT NULL,
    `GC_CHLOROPHYLL_A` VARCHAR(255) DEFAULT NULL,
    `GC_CHLOROPHYLL_A_STDDEV` VARCHAR(255) DEFAULT NULL,
    `PT_CHLOROPHYLL_A` VARCHAR(255) DEFAULT NULL,
    `PT_CHLOROPHYLL_A_STDDEV` VARCHAR(255) DEFAULT NULL,
    `PP_CHLOROPHYLL_A` VARCHAR(255) DEFAULT NULL,
    `PP_CHLOROPHYLL_A_STDDEV` VARCHAR(255) DEFAULT NULL,
    `PT_CHLOROPHYLL_B` VARCHAR(255) DEFAULT NULL,
    `PT_CHLOROPHYLL_B_STDDEV` VARCHAR(255) DEFAULT NULL,
    `PT_CHLOROPHYLL_C` VARCHAR(255) DEFAULT NULL,
    `PT_CHLOROPHYLL_C_STDDEV` VARCHAR(255) DEFAULT NULL,
    `PHAEOPHYTIN` VARCHAR(255) DEFAULT NULL,
    `PHAEOPHYTIN_STDDEV` VARCHAR(255) DEFAULT NULL
) ENGINE = INNODB;



--
-- Dumping data for table `Roles`
--

INSERT INTO `roles` (`role_title`) VALUES 
('Researcher'),('Administrator');

--
-- Dumping data for table `Users`
--

INSERT INTO `users` (`first_name`, `last_name`, `password`, `email`, `num`, `role_id`, `available`, `institute`, `passphrase`) VALUES
('Nigel', 'Nofriends', '$2a$12$3K.PbCCluU8.iq0ww5uhzehR/AVRfw1RUeOM4ku0zKif4PJAaqOYi', 'admin@localhost.com', '0422339312', 2, 1, 'UTAS', '$2a$12$S1WtsCDeHiYGDpT/rbIiyuLR7UlM58OyABBhiDX3ysIUU9jfB7Z0u'),
('Dave', 'Davidson', '$2a$12$3K.PbCCluU8.iq0ww5uhzehR/AVRfw1RUeOM4ku0zKif4PJAaqOYi', 'davo@localhost.com', '0428807372', 1, 0, 'UTAS', '$2a$12$S1WtsCDeHiYGDpT/rbIiyuLR7UlM58OyABBhiDX3ysIUU9jfB7Z0u');


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
