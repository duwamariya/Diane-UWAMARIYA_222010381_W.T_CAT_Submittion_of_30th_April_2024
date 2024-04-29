-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 07:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urhuye`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_code` int(25) NOT NULL,
  `course_title` varchar(23) NOT NULL,
  `description` varchar(20) NOT NULL,
  `credit_hours` int(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_title`, `description`, `credit_hours`) VALUES
(1, 'kio', 'lop', 4),
(2, 'roi', 'jhv', 6),
(2, 'roi', 'jhv', 6),
(3, 'eretry', '5etry', 6);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_code` int(20) NOT NULL,
  `department_name` varchar(23) NOT NULL,
  `department_chair` int(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_code`, `department_name`, `department_chair`) VALUES
(2, 'lo', 0),
(3, 'GFGHG', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_name` varchar(20) NOT NULL,
  `dateandtime` date NOT NULL,
  `location` varchar(23) NOT NULL,
  `organisers` varchar(18) NOT NULL,
  `participation` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(20) NOT NULL,
  `name` varchar(23) NOT NULL,
  `contact_information` varchar(20) NOT NULL,
  `course_taught` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `firstname` int(11) NOT NULL,
  `lastname` int(11) NOT NULL,
  `password` varchar(17) NOT NULL,
  `telephone` int(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`firstname`, `lastname`, `password`, `telephone`, `email`) VALUES
(0, 0, '', 0, ''),
(0, 0, '1234', 7824566, 'dianeumwamariya@gmai'),
(0, 0, '', 0, ''),
(0, 0, '1234', 78456366, 'dianeumwamariya@gmai'),
(0, 0, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(17) NOT NULL,
  `name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `program` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `dob`, `program`) VALUES
(4, 'hjhh', '2000-04-30', 'yygh'),
(1, 'dd', '0000-00-00', 'eve');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'Diane', 'UWAMARIYA', 'duwamariya', 'duwamariya4@gmail.com', '0781001277', '$2y$10$ZQ1YyeHF17YWKKK2ZCh/zOn6XMqQsu5RHagVOq/mUYiJIRmomn.NO', '2024-04-20 13:10:33', '6623bec9768e0', 0),
(2, 'benitha', 'umutoni', 'benitha', 'benithau@gmail.com', '0791134293', '$2y$10$qe2buIz7eLeW.yIC98GqB.eiiJYXKOKvpAWlVgvZz3qM1n0sisXJK', '2024-04-20 13:13:08', '6623bf64c6b96', 0),
(3, 'Aline', 'Keza', 'Aline', 'keza@gmail.com', '0789000345', '$2y$10$Ao32BfnItkp/niX/2ZJmNutEiO66ckJ5RlUvTvxy4lqjMRpIURXz.', '2024-04-29 21:38:14', '66301346d822d', 0),
(7, 'Diane', 'UWAMARIYA', 'ttt', 'cle4@gmail.com', '0781001277', '$2y$10$anDvdYbKxy5oMYgJrCk9z.JEHqs1qypvmtmm8nuCYZoSHFd.NNFti', '2024-04-30 00:55:42', '6630418eccb0f', 0),
(9, 'vbhnjm,', ' ghjkl;', 'nn', 'nn@gamil.com', '0781001277', '$2y$10$6jXYhZb7kEoZapVLo691N.sT30TjotxTsCrUzDkqhVDJx6ZmFfWvW', '2024-04-30 00:56:47', '663041cf222b5', 0),
(11, 'vbhnjm,', ' ghjkl;', 'nnn', 'nnn@gamil.com', '0781001277', '$2y$10$Dr9BO7peJ6R9PECWDA0BUu8mo878J0x1Pfq7qgPHxTWiTvP8hMYBm', '2024-04-30 00:57:45', '6630420959e59', 0),
(12, 'Diane', 'UWAMARIYA', 'didi', 'dianeuwamariya22@gmail.com', '0781001277', '$2y$10$6LtuRJKcBeSTvNJpqOvo5uGN0L3QhLM6GF4CwVGkRI2y3/WoXoQuC', '2024-04-30 05:03:56', '66307bbcbfb90', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `username` varchar(23) NOT NULL,
  `password` varchar(17) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
