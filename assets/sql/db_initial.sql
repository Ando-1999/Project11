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
-- Table structure for table `roles`
--


CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_title` varchar(255) NOT NULL,
  PRIMARY KEY (role_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `users`
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
  PRIMARY KEY (id),
  CONSTRAINT FK_Role FOREIGN KEY (role_id) 
  REFERENCES roles(role_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 
-- Table structure for table `sec_questions`
-- 

CREATE TABLE `sec_questions` (
  `sq_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  PRIMARY KEY (sq_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 
-- Table structure for table `sec_answers`
-- 

CREATE TABLE `sec_answers` (
  `id` int(11) NOT NULL,
  `sq_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_User 
  FOREIGN KEY (id) REFERENCES users(id),
  CONSTRAINT FK_Question    
  FOREIGN KEY (sq_id) REFERENCES sec_questions(sq_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `aq_data`
-- Note: Data for this table will be added by user through the tool's 'Excel' page
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
-- Dumping data for table `roles`
--
INSERT INTO `roles` (`role_title`) VALUES 
('Researcher'),('Administrator');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `password`, `email`, `num`, `role_id`, `available`, `institute`) VALUES
('System', 'Admin', '$2a$12$3K.PbCCluU8.iq0ww5uhzehR/AVRfw1RUeOM4ku0zKif4PJAaqOYi', 'admin@localhost.com', '0400001111', 2, 1, 'UTAS'),
('Default', 'Researcher', '$2a$12$3K.PbCCluU8.iq0ww5uhzehR/AVRfw1RUeOM4ku0zKif4PJAaqOYi', 'researcher@localhost.com', '0400001111', 1, 0, 'UTAS');


--
-- Dumping data for table `sec_questions`
--

INSERT INTO `sec_questions` (`question`) VALUES
('What was the name of your childhood best friend?'),
('What is your favourite book author?'),
('When did you first learn to ride a bike?');


--
-- Dumping data for table `sec_answers`
-- Note: The admin's answer is "Macintosh", and the default user is "Never". Both are encrypted using BCRYPT.
--

INSERT INTO `sec_answers` (`id`, `sq_id`, `answer`) VALUES
(1, 1, '$2a$12$C6V33sAptA71/khsbFP/e.JwwvRQIRm3Jp7GG4vWD7KY2pJznieZy'),
(2, 3, '$2a$12$qYANeasYsJmMrlyUE8OkfeHIUFhKRHsFogPnGgIF7g.mgFq1jOzRe');


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
