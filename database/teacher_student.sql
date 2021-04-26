-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2021 at 02:37 PM
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
-- Database: `teacher_student`
--

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

DROP TABLE IF EXISTS `keys`;
CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'webdeveloper1510', 0, 0, 0, NULL, '2020-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `qid` int(11) NOT NULL,
  `user` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `message`, `qid`, `user`, `time`) VALUES
(11, 'question 1', 12, 'teacher2@gmail.com', '2021-04-23 10:19:48'),
(10, 'Something else', 11, 'teacher2@gmail.com', '2021-04-19 22:05:18'),
(26, 'Pranav Private 1', 19, 'pranav1503@gmail.com', '2021-04-25 20:51:14'),
(21, 'Private Question', 18, 'teacher2@gmail.com', '2021-04-24 12:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `public_answers`
--

DROP TABLE IF EXISTS `public_answers`;
CREATE TABLE IF NOT EXISTS `public_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer` longtext NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_answer_relation` (`question_id`),
  KEY `answer_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `public_answers`
--

INSERT INTO `public_answers` (`id`, `question_id`, `user_id`, `answer`, `date_time`) VALUES
(1, 1, 2, 'Some random text', '2021-04-21 00:00:00'),
(2, 1, 3, '<h1> Beautiful Question </h1>', '2021-04-15 00:00:00'),
(3, 1, 2, '<p>Hello <b>World</b> <u>inserting</u> <i>first</i> answer</p>', '2021-04-24 21:19:03'),
(5, 1, 8, '<p>Thank you fo<u>r the ans</u></p>', '2021-04-24 21:29:03'),
(11, 5, 1, '<p><iframe frameborder=\"0\" src=\"//www.youtube.com/embed/g0EHwjzaJ04\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><br></p>', '2021-04-24 22:19:08'),
(17, 5, 1, '<p>This is my new answer</p><p><br></p><table class=\"table table-bordered\"><tbody><tr><td>djsan</td><td>dsfasdf</td><td>fasdfadsf</td></tr><tr><td>sdafdsaf</td><td>dsfaasdfa</td><td>adsfasdfasd</td></tr><tr><td>asdfasdf</td><td>asdfasdf</td><td>dsafdsfs</td></tr></tbody></table><p><br></p>', '2021-04-26 17:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `public_questions`
--

DROP TABLE IF EXISTS `public_questions`;
CREATE TABLE IF NOT EXISTS `public_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `description` longtext NOT NULL,
  `user` int(11) NOT NULL,
  `anonymity` tinyint(1) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `public_questions`
--

INSERT INTO `public_questions` (`id`, `question`, `description`, `user`, `anonymity`, `date_time`) VALUES
(1, 'Public Question 1', '<p>public desc 1</p>', 1, 0, '2021-04-24 11:30:50'),
(5, 'Dipro Public Question', '<p>Help needed</p>', 8, 1, '2021-04-24 22:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `teacher` text NOT NULL,
  `description` longtext NOT NULL,
  `student` text NOT NULL,
  `answer` longtext,
  `answered` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `teacher`, `description`, `student`, `answer`, `answered`) VALUES
(19, 'Pranav Private 1', 'teacher2@gmail.com', '<p>sdafsdafsdfadsfdfASDFASDFADSFDASFASDFASDF</p>', 'pranav1503@gmail.com', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `dept` text NOT NULL,
  `type` text NOT NULL,
  `last_active` int(11) NOT NULL DEFAULT '0',
  `photo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `dept`, `type`, `last_active`, `photo`) VALUES
(1, 'Pranav', 'pranav1503@gmail.com', '9113521458', 'pranav1503', 'ece', 'student', 0, 'default.png'),
(2, 'Teacher1', 'teacher1@gmail.com', '1234567890', 'teacher1', 'ece', 'teacher', 0, 'default.png'),
(3, 'Teacher2', 'teacher2@gmail.com', '1234567891', 'teacher2', 'cse', 'teacher', 0, 'default.png'),
(4, 'teacher3', 'teacher3@gmail.com', '1234567892', 'teacher3', 'ise', 'teacher', 0, 'default.png\r\n'),
(8, 'dipro', 'dipro@gmail.com', '1234567898', 'dipro', 'CSE', 'student', 0, 'default.png'),
(9, 'student1', 'student1@gmail.com', '9876543212', 'student1', 'CSE', 'student', 0, 'default.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `public_answers`
--
ALTER TABLE `public_answers`
  ADD CONSTRAINT `answer_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_answer_relation` FOREIGN KEY (`question_id`) REFERENCES `public_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `public_questions`
--
ALTER TABLE `public_questions`
  ADD CONSTRAINT `question_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
