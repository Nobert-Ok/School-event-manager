-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 14, 2020 at 09:54 AM
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
-- Database: `alusm`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'ALC Mauritius'),
(2, 'ALU Rwanda'),
(3, 'ALU Bukina Faso'),
(4, 'ALU Nigeria');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

DROP TABLE IF EXISTS `clubs`;
CREATE TABLE IF NOT EXISTS `clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` text NOT NULL,
  `cat` varchar(4) NOT NULL,
  `admin_email` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `photo` text NOT NULL,
  `bio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `names`, `cat`, `admin_email`, `created_date`, `photo`, `bio`) VALUES
(1, 'Google Developers Club', '2', 'o.chukwuebu@alustudent.com', '2020-05-10 14:34:28', '', ''),
(2, 'Poetry Club', '1', 'e.okoye@alustudent.com', '2019-12-04 14:40:36', '1574117732_19112019015532.jpg', 'Maelezo hapa'),
(41, 'Chess Club ', '1', 'cwanziguya@alueducation.com', '2020-05-04 22:41:26', '1575470890_04122019174810.jpeg', 'alnaldnalda'),
(42, 'Notary Club', '3', 'brugambwa@alueducation.com', '2020-05-04 22:41:26', '', 'sasdasdas');

-- --------------------------------------------------------

--
-- Table structure for table `club_subscriptions`
--

DROP TABLE IF EXISTS `club_subscriptions`;
CREATE TABLE IF NOT EXISTS `club_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `club_subscriptions`
--

INSERT INTO `club_subscriptions` (`id`, `student_id`, `club_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`) VALUES
(1, 'Computer Science'),
(2, 'Entrepreneurship'),
(3, 'IBT'),
(4, 'Global Challenge'),
(5, 'Leadership Core');

-- --------------------------------------------------------

--
-- Table structure for table `course_subscriptions`
--

DROP TABLE IF EXISTS `course_subscriptions`;
CREATE TABLE IF NOT EXISTS `course_subscriptions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` text NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `club_id` int(11) NOT NULL,
  `location` text NOT NULL,
  `event_date` text,
  `event_title` text NOT NULL,
  `cat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `date`, `admin_id`, `description`, `status`, `rating`, `club_id`, `location`, `event_date`, `event_title`, `cat`) VALUES
(7, '2020-05-05 01:25:44', 17, '', 'Past', NULL, 0, 'Nigeria', '05/08/2020 2:19 PM', 'Eulogy', 1),
(8, '2020-05-05 02:23:59', 17, 'Here', 'Active', NULL, 0, 'Morocco', '05/20/2020 10:14 PM', 'Coachella ALU', 1),
(9, '2020-05-05 11:31:08', 17, 'Lead by Emmanuel, there would be a praise and worship session', 'Active', NULL, 0, 'Tanzania', '05/19/2020 1:31 PM', 'Worships', 1),
(10, '2020-05-05 11:32:54', 17, 'Students gave fun over the completion of their summatives', 'Active', NULL, 0, 'Open Space', '05/21/2020 1:32 PM', 'Movie Night', 1),
(11, '2020-05-05 11:37:05', 17, 'Singing for all students', 'Past', NULL, 0, 'Open Space', '05/05/2020 1:38 PM', 'Coachella ALU', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password_hash` varchar(256) NOT NULL,
  `salt` varchar(256) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `course_id` text NOT NULL,
  `year` int(11) NOT NULL,
  `cohort` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`user_id`, `email`, `full_name`, `password_hash`, `salt`, `created_date`, `course_id`, `year`, `cohort`) VALUES
(1, 'o.chukwuebu@alustudent.com', 'Okoye-Nobert Chukwuebuka', '$2y$10$6/A9PzFEy00RDXABTaznX.kbsAxGtfxJqrR.xLrIIDTMal5E3vijG', '96ddc9239fcc323c177018457a78cf6030d04675864457578fc34791331da1d2', '2020-10-05 19:50:48', '1', 1, 2),
(2, 'brugambwa@alustudent.com', 'Bobson Rugambwa', 'arshjtyutejyrkryrj64y7uuhrte567yuikjb', 'ertyuikjhgfrtyujkbvdftgyhujkmnbvcftgyh', '2020-05-05 00:14:14', '2', 2, 2),
(6, 'cwanziguya@alueducation.com', 'Clovis Wanziguya', 'dsfghjfgddbrynyrsnpbfbaihvnwavrusvijaiawrv', 'urghatp9eubtnb9bjrthabjtobvg9h4tjgbv0r0t0e', '2020-05-08 00:31:55', '3', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Permits'),
(2, 'Politics'),
(3, 'Customary'),
(4, 'Reports'),
(5, 'Business Registration'),
(6, 'Incompetence'),
(7, 'Bureaucracy'),
(8, 'Customer Service'),
(9, 'Payments'),
(10, 'Administrative Conflicts'),
(11, 'Backlogs'),
(12, 'Local Government');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `uUsername` varchar(128) NOT NULL,
  `uPassword` varchar(255) NOT NULL,
  `uActivity` datetime NOT NULL,
  `uCreated` datetime NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `uUsername` (`uUsername`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `uUsername`, `uPassword`, `uActivity`, `uCreated`) VALUES
(37, '440', '$2y$10$MWLNNyu3LkswnOX.b0S2SuNuE/ejXxhbp202J9DnozXKiPjbNEAcm', '2020-05-12 00:18:50', '2020-05-12 00:18:50'),
(17, 'Nobert', '$2y$10$8nA3xD1mKDi0CraxLFPyzelAqAH2V/8hhr1Yb.bnbaQVsSn1.HQSm', '2020-05-13 15:10:04', '2020-05-04 23:00:36'),
(36, 'COkoy271', '$2y$10$AuEyqtAJWIhgFR4ViG7w4uZQ8OZX/lYt2WQ2HXMSQnDRnWe9sMzxu', '2020-05-07 19:55:20', '2020-05-07 19:48:26'),
(35, 'COkoy564', '$2y$10$Q77kVk1kOFrk5TpHR8aDFuCD3pKHEQ3mx7aQGJmN0MonD0s8zC1IS', '2020-05-07 19:44:03', '2020-05-07 19:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `users_information`
--

DROP TABLE IF EXISTS `users_information`;
CREATE TABLE IF NOT EXISTS `users_information` (
  `userId` int(11) NOT NULL,
  `infoKey` varchar(128) NOT NULL,
  `InfoValue` text NOT NULL,
  KEY `userId` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_information`
--

INSERT INTO `users_information` (`userId`, `infoKey`, `InfoValue`) VALUES
(1, 'firstname', 'Given'),
(6, 'email', 'giftedward41@gmail.com'),
(6, 'firstname', 'Gift'),
(6, 'lastname', 'Edward'),
(6, 'role', 'teacher'),
(7, 'email', 'giftedward41@gmail.com'),
(7, 'firstname', 'Gift'),
(7, 'lastname', 'Edward'),
(7, 'role', 'teacher'),
(8, 'email', 'giftedward41@gmail.com'),
(8, 'firstname', 'Gift'),
(8, 'lastname', 'Edward'),
(8, 'role', 'teacher'),
(9, 'email', 'giftedward41@gmail.com'),
(9, 'firstname', 'Gift'),
(9, 'lastname', 'Edward'),
(9, 'role', 'teacher'),
(10, 'email', 'vgiven@yahoo.com'),
(10, 'firstname', 'Given'),
(10, 'lastname', 'Edward'),
(10, 'role', 'teacher'),
(10, 'kisomo', '200'),
(11, 'email', 'edo@edo.com'),
(11, 'firstname', 'Edo'),
(11, 'lastname', 'Robert'),
(11, 'role', 'teacher'),
(12, 'email', 'given@mtabeapp.com'),
(12, 'firstname', 'Given'),
(12, 'lastname', 'Edward'),
(12, 'role', 'teacher'),
(12, 'kisomo', '300'),
(13, 'email', 'abukakar@mtabeapp.com'),
(13, 'firstname', 'Abubakar'),
(13, 'lastname', 'Kitalula'),
(13, 'role', 'teacher'),
(13, 'kisomo', '300'),
(14, 'email', 'gedward15@alustudent.com'),
(14, 'firstname', 'Given'),
(14, 'lastname', 'Edward'),
(14, 'role', 'clubmanager'),
(14, 'club', '1'),
(14, 'kisomo', '1'),
(15, 'email', 'e.okoye@alustudent.com'),
(15, 'firstname', 'Edward'),
(15, 'lastname', 'Okoye'),
(15, 'role', 'clubmanager'),
(15, 'club', '2'),
(1, 'club', '1'),
(16, 'email', 'ndsvsv'),
(16, 'firstname', 'Nancy'),
(16, 'lastname', 'Umutoni'),
(16, 'role', 'clubmanager'),
(16, 'club', '41'),
(17, 'email', 'nobertokoye15@gmail.com'),
(17, 'firstname', 'Chukwuebuka'),
(17, 'lastname', 'Okoye-Nobert'),
(17, 'role', 'admin'),
(18, 'email', ''),
(18, 'firstname', ''),
(18, 'lastname', ''),
(18, 'role', 'null'),
(19, 'email', ''),
(19, 'firstname', ''),
(19, 'lastname', ''),
(19, 'role', 'null'),
(20, 'email', ''),
(20, 'firstname', ''),
(20, 'lastname', ''),
(20, 'role', 'null'),
(21, 'email', ''),
(21, 'firstname', ''),
(21, 'lastname', ''),
(21, 'role', 'null'),
(22, 'email', ''),
(22, 'firstname', ''),
(22, 'lastname', ''),
(22, 'role', 'null'),
(23, 'email', ''),
(23, 'firstname', ''),
(23, 'lastname', ''),
(23, 'role', 'null'),
(24, 'email', ''),
(24, 'firstname', ''),
(24, 'lastname', ''),
(24, 'role', 'null'),
(25, 'email', ''),
(25, 'firstname', ''),
(25, 'lastname', ''),
(25, 'role', 'null'),
(26, 'email', ''),
(26, 'firstname', ''),
(26, 'lastname', ''),
(26, 'role', 'null'),
(27, 'email', ''),
(27, 'firstname', ''),
(27, 'lastname', ''),
(27, 'role', 'null'),
(28, 'email', 'nobertokoye15@gmail.com'),
(28, 'firstname', 'Chukwuebuka'),
(28, 'lastname', 'Okoye-Nobert'),
(28, 'role', ''),
(29, 'email', 'nobertokoye15@gmail.com'),
(29, 'firstname', 'Chukwuebuka'),
(29, 'lastname', 'Okoye-Nobert'),
(29, 'role', 'admin'),
(30, 'email', ''),
(30, 'firstname', ''),
(30, 'lastname', ''),
(30, 'role', ''),
(31, 'email', ''),
(31, 'firstname', ''),
(31, 'lastname', ''),
(31, 'role', ''),
(32, 'email', ''),
(32, 'firstname', ''),
(32, 'lastname', ''),
(32, 'role', 'null'),
(33, 'email', ''),
(33, 'firstname', ''),
(33, 'lastname', ''),
(33, 'role', 'null'),
(34, 'email', ''),
(34, 'firstname', ''),
(34, 'lastname', ''),
(34, 'role', 'null'),
(35, 'email', 'nobertokoye15@gmail.com'),
(35, 'firstname', 'Chukwuebuka'),
(35, 'lastname', 'Okoye-Nobert'),
(35, 'role', 'admin'),
(36, 'email', 'nobertokoye15@gmail.com'),
(36, 'firstname', 'Chukwuebuka'),
(36, 'lastname', 'Okoye-Nobert'),
(36, 'role', 'admin'),
(37, 'email', ''),
(37, 'firstname', ''),
(37, 'lastname', ''),
(37, 'role', 'null');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
