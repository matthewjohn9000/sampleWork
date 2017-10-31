-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2017 at 01:10 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamhub`
--
CREATE DATABASE IF NOT EXISTS `teamhub` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `teamhub`;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `reviewer_id` int(11) DEFAULT NULL,
  `reviewee_id` int(11) DEFAULT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `answer` varchar(1000) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `status` enum('published','draft','flagged') DEFAULT NULL,
  `comment` varchar(450) DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `reviewer_id`, `reviewee_id`, `survey_id`, `answer`, `grade`, `question_id`, `status`, `comment`, `timestamp`) VALUES
(1, 2, 3, 5, 'ff', 80, 0, 'published', NULL, '2017-05-21 16:41:13'),
(2, 2, 3, 3, 'ff', 80, 1, 'published', NULL, '2017-05-22 15:35:52'),
(3, 1, 4, 2, 'ff', 80, NULL, 'flagged', NULL, '2017-05-24 13:39:13'),
(10, 2, 4, 5, 'ff', 80, 5, 'published', NULL, '2017-05-27 11:51:10'),
(20, 2, 3, 6, 'Hello', 100, 7, 'published', NULL, '2017-05-27 22:51:35'),
(21, 2, 3, 6, 'Changeee', 20, 8, 'published', NULL, '2017-05-27 22:51:35'),
(22, 2, 4, 6, 'So,', 100, 7, 'published', NULL, '2017-05-27 22:56:01'),
(23, 2, 4, 6, 'Yff', 60, 8, 'flagged', NULL, '2017-05-27 22:56:01'),
(24, 1, 3, 2, 'Some answer', 100, 2, 'published', NULL, '2017-05-28 09:06:53'),
(25, 1, 4, 1, 'whoopd', 0, 1, 'published', NULL, '2017-05-28 09:10:14'),
(26, 3, 4, 14, 'Some Weird Answer', 50, 1, 'flagged', NULL, '2017-05-31 02:46:13'),
(27, 3, 4, 14, 'Who', 0, 2, 'published', NULL, '2017-05-31 02:46:13'),
(28, 3, 4, 14, 'Answe', 75, 3, 'published', NULL, '2017-05-31 02:46:13'),
(31, 3, 4, 16, 'Yaay', 25, 5, 'published', 'ay', '2017-06-10 12:42:15'),
(32, 3, 4, 16, 'Cool', 50, 6, 'published', NULL, '2017-06-10 12:42:15'),
(33, 4, 3, 16, 'd', 0, 5, 'published', NULL, '2017-06-10 19:36:46'),
(34, 4, 3, 16, 'f', 0, 6, 'published', NULL, '2017-06-10 19:36:46'),
(35, 2, 3, 17, 'Yaay', 75, 7, 'published', 'You suck', '2017-06-10 19:37:16'),
(36, 3, 2, 17, 'Yay', 25, 7, 'published', NULL, '2017-06-10 19:47:26'),
(37, 2, 3, 18, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus optio, ad eligendi quaerat, inventore doloremque ipsam facilis odit praesentium, temporibus exercitationem! Molestiae nam, voluptates reprehenderit aspernatur corporis id architecto distinctio.', 100, 8, 'published', 'You suckk', '2017-06-11 15:59:56'),
(38, 2, 3, 18, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus optio, ad eligendi quaerat, inventore doloremque ipsam facilis odit praesentium, temporibus exercitationem! Molestiae nam, voluptates reprehenderit aspernatur corporis id architecto distinctio.', 50, 9, 'published', 'I don''t like this one', '2017-06-11 15:59:56'),
(39, 2, 3, 18, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus optio, ad eligendi quaerat, inventore doloremque ipsam facilis odit praesentium, temporibus exercitationem! Molestiae nam, voluptates reprehenderit aspernatur corporis id architecto distinctio.', 50, 10, 'published', 'akjsldh', '2017-06-11 15:59:56'),
(40, 2, 3, 18, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus optio, ad eligendi quaerat, inventore doloremque ipsam facilis odit praesentium, temporibus exercitationem! Molestiae nam, voluptates reprehenderit aspernatur corporis id architecto distinctio.', 25, 11, 'published', NULL, '2017-06-11 15:59:56'),
(41, 2, 3, 18, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus optio, ad eligendi quaerat, inventore doloremque ipsam facilis odit praesentium, temporibus exercitationem! Molestiae nam, voluptates reprehenderit aspernatur corporis id architecto distinctio.', 75, 12, 'published', 'Still', '2017-06-11 15:59:56'),
(42, 2, 3, 18, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus optio, ad eligendi quaerat, inventore doloremque ipsam facilis odit praesentium, temporibus exercitationem! Molestiae nam, voluptates reprehenderit aspernatur corporis id architecto distinctio.', 0, 13, 'published', NULL, '2017-06-11 15:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `grading_systems`
--

CREATE TABLE `grading_systems` (
  `id` int(11) NOT NULL,
  `options` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grading_systems`
--

INSERT INTO `grading_systems` (`id`, `options`, `title`) VALUES
(1, 'A,B,C,D,F', 'letter');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `text` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`) VALUES
(1, 'How was the performance of the teammate?'),
(2, 'What did you learn from them?'),
(3, 'What would you say to them?'),
(4, 'One Question'),
(5, 'How were the sausages?'),
(6, 'Does Chris Martin wear platform shoes?'),
(7, 'Is the sky blue?'),
(8, 'Question one?'),
(9, 'Question two?'),
(10, 'Question three?'),
(11, 'Question four?'),
(12, 'Question five?'),
(13, 'Question six?');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `grading_system` int(11) DEFAULT NULL,
  `status` enum('published','draft','approved') NOT NULL DEFAULT 'published',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `name`, `author`, `grading_system`, `status`, `timestamp`) VALUES
(16, 'Sausage Fest', 1, 1, 'published', '2017-05-31 13:29:10'),
(17, 'CTEC 227 Milestone 3', 1, 0, 'published', '2017-05-31 13:36:11'),
(18, 'Long Survey', 1, 1, 'published', '2017-06-11 15:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `survey_participants`
--

CREATE TABLE `survey_participants` (
  `survey_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_participants`
--

INSERT INTO `survey_participants` (`survey_id`, `user_id`) VALUES
(14, 3),
(14, 4),
(15, 3),
(15, 2),
(15, 4),
(16, 3),
(16, 4),
(17, 2),
(17, 3),
(18, 3),
(18, 2),
(18, 4);

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `question_id` int(11) DEFAULT NULL,
  `survey_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`question_id`, `survey_id`) VALUES
(1, 14),
(2, 14),
(3, 14),
(4, 15),
(5, 16),
(6, 16),
(7, 17),
(8, 18),
(9, 18),
(10, 18),
(11, 18),
(12, 18),
(13, 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Bruce', 'Elgort', 'belgort@email.com', '12345678'),
(2, 'John', 'Smith', 'john@email.com', '12345678'),
(3, 'Matt', 'Lehr', 'matt@email.com', '12345678'),
(4, 'Chris', 'Mcguire', 'chris@email.com', '12345678'),
(7, 'bruce', 'elgort', 'bruce@email.com', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_idx` (`question_id`),
  ADD KEY `id_idx1` (`survey_id`),
  ADD KEY `id_idx2` (`reviewer_id`),
  ADD KEY `id_idx3` (`reviewee_id`);

--
-- Indexes for table `grading_systems`
--
ALTER TABLE `grading_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_idx` (`author`),
  ADD KEY `id_idx1` (`grading_system`);

--
-- Indexes for table `survey_participants`
--
ALTER TABLE `survey_participants`
  ADD KEY `id_idx` (`survey_id`),
  ADD KEY `id_idx1` (`user_id`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD KEY `id_idx` (`question_id`),
  ADD KEY `id_idx1` (`survey_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `grading_systems`
--
ALTER TABLE `grading_systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
