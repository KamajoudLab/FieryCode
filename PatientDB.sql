-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2018 at 01:27 PM
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
CREATE DATABASE IF NOT EXISTS `fierypatientdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fierypatientdb`;

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
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `UserName`, `Password`) VALUES
(6, 'ozan', 'palali', 'ozziy', 'test123');
--
-- Database: `maxdekri_secure_cms`
--
CREATE DATABASE IF NOT EXISTS `maxdekri_secure_cms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `maxdekri_secure_cms`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(64) NOT NULL AUTO_INCREMENT,
  `post_id` int(64) NOT NULL,
  `nickname` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `cr_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `nickname`, `content`, `cr_dt`) VALUES
(1, 7, 'Kevin', 'First !!!', '2016-12-23 15:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(64) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `cr_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cr_user_id` int(8) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `cr_dt`, `edit_dt`, `cr_user_id`) VALUES
(7, 'First post', 'This is the first post, feel free to add more by logging in!', '2016-12-23 15:14:54', '2018-11-15 12:42:01', 7);

-- --------------------------------------------------------

--
-- Table structure for table `post_log`
--

DROP TABLE IF EXISTS `post_log`;
CREATE TABLE IF NOT EXISTS `post_log` (
  `post_id` int(64) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `cr_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cr_user_id` int(8) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_log`
--

INSERT INTO `post_log` (`post_id`, `title`, `content`, `cr_dt`, `cr_user_id`) VALUES
(16, 'undefined', 'undefined', '0000-00-00 00:00:00', 0),
(17, 'test2', 'test2', '0000-00-00 00:00:00', 2017),
(18, 'test ', 'test', '2017-01-18 13:50:10', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `nickname` varchar(256) DEFAULT NULL,
  `role` int(8) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cr_dt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nickname`, `role`, `last_login`, `cr_dt`) VALUES
(1, 'f8b9b3327584fa388e74b77559f85afb9285cd0c84d4c4117e5649514dc236bb8c5490ebee04cc90c7d270db640410aaf9a494258b37505ebe170b23f05e9a13', '2fee11ce204201437d6834f43b7f66926a94e8cf313bc19b3dcd40926bd5b69093be5bb4e1625f39de227d47a47e4dbd0c3614203497be5b2923f8ffb0417ce2', '', 1, '2017-01-18 10:44:25', '2016-11-28 17:40:48'),
(4, 'df53b795c35b49b4de276638df716253094a404d5f51e73d11f3ff9a64cc51a64363168d4621fea3356267e91f5a1ab2615efcd73d1ab5f948be7ca6b0149016', 'f691fa08cd874517051c9cf5ce1042795e02b4db46a6bd1084b445092193d3de2c642a296aa1ebe68d4b5b05cc6970a83231e3d07f38a55a30afdbb86bba1514', '', 1, '2017-01-18 10:45:04', '2016-12-23 14:16:37'),
(5, 'e76271c91f903148a8fb264d8547bba9c48d120095eb248d0be9d961f09ebe5318fb83136ec0a50186a1d6c30ceb44ef2fdeecb91622521f29ff97df4b32b388', 'd144d6c972d015d67eb22e21612ae0388fc8c1e2204366b431ac5ee2110b87c41ecc2d82f925770defcd7926fad0a7ab854d9b921279a6ed5599df4a51daddbb', 'Thoc', 1, '2017-01-17 12:47:10', '2017-01-02 23:42:00'),
(6, '38374D5894F5005FB85261F12072E932A2767FAEAD41F8AFB1B2B6AB25300108C023C8AB8561838C6F12069C4F37757CBD3B874864B706DE494ADDC3AADA1686', '38374D5894F5005FB85261F12072E932A2767FAEAD41F8AFB1B2B6AB25300108C023C8AB8561838C6F12069C4F37757CBD3B874864B706DE494ADDC3AADA1686', NULL, 1, '2018-11-15 12:40:32', '2018-11-22 03:15:07'),
(7, '38374D5894F5005FB85261F12072E932A2767FAEAD41F8AFB1B2B6AB25300108C023C8AB8561838C6F12069C4F37757CBD3B874864B706DE494ADDC3AADA1686', '38374D5894F5005FB85261F12072E932A2767FAEAD41F8AFB1B2B6AB25300108C023C8AB8561838C6F12069C4F37757CBD3B874864B706DE494ADDC3AADA1686', NULL, 1, '2018-11-15 12:41:00', '2018-11-22 03:15:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
