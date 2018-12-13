-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2018 at 02:53 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fierypatientdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Funtion` varchar(50) NOT NULL,
  `UserId` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UserId` (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`ID`, `Firstname`, `Lastname`, `Funtion`, `UserId`) VALUES
(1, 'doc1', 'a', 'arts', 8),
(2, 'doc2', 'b', 'chirurg', 9);

-- --------------------------------------------------------

--
-- Table structure for table `patientfile`
--

DROP TABLE IF EXISTS `patientfile`;
CREATE TABLE IF NOT EXISTS `patientfile` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Topic` varchar(60) DEFAULT NULL,
  `Diagnose` text,
  `Medicine` text,
  `PatientId` int(11) NOT NULL,
  `DoctorId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientfile`
--

INSERT INTO `patientfile` (`Id`, `Date`, `Topic`, `Diagnose`, `Medicine`, `PatientId`, `DoctorId`) VALUES
(1, '2018-12-10', 'griep', 'verkouden\r\nhoge temparatuur', 'paracetamol', 1, 1),
(2, '2018-12-10', 'blesure', 'pijn aan been\r\ngezwollen kwijt\r\nwaarschijnlijk overbelasting', 'pijnstiller\r\nzalf smeren 2x per dag', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Birth` date NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `UserId` int(11) NOT NULL,
  `DoctorId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UserId` (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`Id`, `Firstname`, `Lastname`, `Birth`, `Gender`, `UserId`, `DoctorId`) VALUES
(1, 'kawtar', 'b', '1995-12-02', '0', 10, NULL),
(2, 'mari', 'c', '2000-12-09', '0', 11, NULL),
(3, 'rahiem', 'c', '2000-12-09', '0', 7, 8),
(4, 'ozan', 'p', '2000-12-09', '0', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `LastName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `UserName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Password` text CHARACTER SET utf8 NOT NULL,
  `IsDoctor` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `UserName`, `Password`, `IsDoctor`) VALUES
(6, 'ozan', 'palali', 'ozziy', 'CA978112CA1BBDCAFAC231B39A23DC4DA786EFF8147C4E72B9807785AFEE48BB', 0),
(7, 'Rahiem', 'a', 'r', 'CA978112CA1BBDCAFAC231B39A23DC4DA786EFF8147C4E72B9807785AFEE48BB', 0),
(8, 'doc1', 'a', 'd', 'CA978112CA1BBDCAFAC231B39A23DC4DA786EFF8147C4E72B9807785AFEE48BB', 1),
(9, 'doc2', 'b', 'doc2', 'CA978112CA1BBDCAFAC231B39A23DC4DA786EFF8147C4E72B9807785AFEE48BB', 1),
(10, 'pat1', 'A', 'pat1', 'CA978112CA1BBDCAFAC231B39A23DC4DA786EFF8147C4E72B9807785AFEE48BB', 0),
(11, 'pat2', 'B', 'pat2', 'CA978112CA1BBDCAFAC231B39A23DC4DA786EFF8147C4E72B9807785AFEE48BB', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
