-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2019 at 03:24 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mytask_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

DROP TABLE IF EXISTS `student_details`;
CREATE TABLE IF NOT EXISTS `student_details` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `parent_name` varchar(50) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `standard` varchar(5) NOT NULL,
  `course` varchar(50) NOT NULL,
  `stud_email` varchar(50) NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `inserted_date_time` datetime NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`student_id`, `first_name`, `last_name`, `parent_name`, `mobile_number`, `standard`, `course`, `stud_email`, `birth_certificate`, `inserted_date_time`) VALUES
(1, 'Pankaj', 'Dhote', 'Prabhakar', '9423946081', '5th', 'English', 'ppdhote@gmail.com', 'swapnil.jpeg', '2019-12-20 17:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `student_document`
--

DROP TABLE IF EXISTS `student_document`;
CREATE TABLE IF NOT EXISTS `student_document` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `inserted_date_time` datetime NOT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_document`
--

INSERT INTO `student_document` (`document_id`, `stud_id`, `document`, `inserted_date_time`) VALUES
(1, 1, 'boat.jpg', '2019-12-20 17:51:10'),
(2, 1, 'swapnil.jpeg', '2019-12-20 17:51:10');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
