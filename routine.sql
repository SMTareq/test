-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2018 at 08:11 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `routine`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `C_id` varchar(255) NOT NULL,
  `C_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`C_id`, `C_type`) VALUES
('AOL101', 0),
('ENG101', 0),
('MAT101', 0),
('MAT102', 0),
('PHY101', 0),
('SE111', 0),
('SE112', 1),
('SE113', 0),
('SE121', 0),
('SE122', 1),
('SE123', 0),
('STA101', 0),
('SWE111', 2),
('SWE131', 1),
('SWE132', 0),
('SWE133', 0),
('SWE134', 1),
('SWE137', 1),
('SWE211', 0),
('SWE212', 1),
('SWE213', 0),
('SWE214', 1),
('SWE222', 0),
('SWE223', 0),
('SWE224', 1),
('SWE225', 0),
('SWE226', 0),
('SWE227', 0),
('SWE228', 0),
('SWE232', 0),
('SWE233', 0),
('SWE234', 1),
('SWE235', 0),
('SWE299', 0),
('SWE301', 0),
('SWE302', 1),
('SWE303', 0),
('SWE304', 1),
('SWE305', 0),
('SWE306', 1),
('SWE307', 0),
('SWE308', 0),
('SWE309', 0),
('SWE310', 2),
('SWE311', 0),
('SWE312', 1),
('SWE313', 0),
('SWE401', 1),
('SWE402', 0),
('SWE403', 1),
('SWE404', 0),
('SWE405', 1),
('SWE406', 0),
('SWE407', 1),
('SWE408', 0),
('SWE409', 2),
('SWE410', 0),
('SWE411', 1),
('SWE412', 2),
('SWE435', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_teacher`
--

CREATE TABLE `course_teacher` (
  `C_id` varchar(255) NOT NULL,
  `T_id` varchar(255) DEFAULT NULL,
  `S_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_teacher`
--

INSERT INTO `course_teacher` (`C_id`, `T_id`, `S_id`) VALUES
('SE111', 'Dr. Md. Asraf Ali', '1B'),
('SE111', 'Dr. Md. Asraf Ali', '1C'),
('SE113', 'Dr. Mostafijur Rahman', '1A'),
('SWE404', 'Dr. Mostafijur Rahman', '5A'),
('SE111', 'Dr. Touhid Bhuiyan', '1A'),
('SWE299', 'Lamisha Rawshan', '4B'),
('SWE412', 'Lamisha Rawshan', '4C'),
('SWE214', 'Md Alamgir Kabir', '4A'),
('SWE224', 'Md Alamgir Kabir', '6C'),
('SWE307', 'Md Alamgir Kabir', '8A'),
('SWE309', 'Mr. Kaushik Sarker', '11A'),
('SWE411', 'Mr. Kaushik Sarker', '6A'),
('SWE407', 'Tapushe Rabaya Toma', '9A'),
('SWE435', 'Tapushe Rabaya Toma', '2B');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `R_code` varchar(255) NOT NULL,
  `R_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`R_code`, `R_type`) VALUES
('304AB', 1),
('305AB', 0),
('404AB', 1),
('405AB', 1),
('406AB', 0),
('501AB', 0),
('502AB', 0),
('504AB', 0),
('601AB', 0),
('604AB', 0),
('605AB', 1),
('607AB', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `S_id` varchar(255) NOT NULL,
  `Lab_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`S_id`, `Lab_no`) VALUES
('10A', 2),
('10B', 2),
('10C', 1),
('11A', 2),
('11B', 2),
('11C', 1),
('12A', 2),
('12B', 2),
('1A', 2),
('1B', 2),
('1C', 2),
('1D', 2),
('2A', 2),
('2B', 2),
('2C', 2),
('2D', 2),
('3A', 2),
('3B', 2),
('3C', 2),
('3D', 2),
('4A', 2),
('4B', 2),
('4C', 2),
('5A', 2),
('5B', 2),
('5C', 2),
('6A', 2),
('6B', 2),
('6C', 2),
('7A', 2),
('7B', 2),
('7C', 2),
('8A', 2),
('8B', 2),
('8C', 1),
('9A', 2),
('9B', 2),
('9C', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `T_id` varchar(255) NOT NULL,
  `T_holiday` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`T_id`, `T_holiday`) VALUES
('Afsana Begum', 0),
('Asif Khan Shakir', 5),
('Dr. Imran Mahmud', 5),
('Dr. Md. Asraf Ali', 5),
('Dr. Mostafijur Rahman', 5),
('Dr. Touhid Bhuiyan', 1),
('Farzana Sadia Borna', 0),
('Fatama Binta Rafiq', 2),
('Iftekher Alam', 0),
('K M Imtiaz Uddin', 0),
('Khalid Been Badruzzaman Biplob', 1),
('Khandker M Qaiduzzaman', 2),
('Lamisha Rawshan', 0),
('M. Khaled Sohel', 0),
('Md Alamgir Kabir', 5),
('Md. Anwar Hossen', 5),
('Md. Fahad Bin Zamal', 0),
('Md. Habibur Rahman', 0),
('Md. Maruf Hassan', 5),
('Md. Mushfiqur Rahman', 0),
('Md. Shohel Arman', 0),
('Mobashir Sadat', 2),
('Monon Binte Taj Noor', 5),
('Mr. Kaushik Sarker', 0),
('Nazia Nishat ', 5),
('Nusrat Jahan', 5),
('Priyanka Mandal', 0),
('Rayhanul Islam', 0),
('Samia Nasrin', 0),
('Shayla Parvin', 5),
('Sheikh Shah Mohammad Motiur Rahman', 0),
('Syeda Sumbul Hossain', 2),
('Tapushe Rabaya Toma', 0);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `C_id` varchar(255) DEFAULT NULL,
  `T_id` varchar(255) DEFAULT NULL,
  `S_id` varchar(255) DEFAULT NULL,
  `Grp_no` int(11) DEFAULT NULL,
  `R_code` varchar(255) NOT NULL,
  `Timeslot` int(11) NOT NULL,
  `Dayslot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`C_id`, `T_id`, `S_id`, `Grp_no`, `R_code`, `Timeslot`, `Dayslot`) VALUES
('SWE299', 'Lamisha Rawshan', '4B', 0, '305AB', 0, 4),
('SWE309', 'Mr. Kaushik Sarker', '11A', 0, '305AB', 1, 3),
('SE111', 'Dr. Md. Asraf Ali', '1B', 0, '305AB', 1, 5),
('SWE407', 'Tapushe Rabaya Toma', '9A', 0, '305AB', 2, 2),
('SWE309', 'Mr. Kaushik Sarker', '11A', 0, '305AB', 3, 5),
('SWE214', 'Md Alamgir Kabir', '4A', 0, '405AB', 1, 3),
('SWE407', 'Tapushe Rabaya Toma', '9A', 0, '405AB', 2, 1),
('SE111', 'Dr. Md. Asraf Ali', '1B', 0, '405AB', 3, 2),
('SWE299', 'Lamisha Rawshan', '4B', 0, '501AB', 0, 0),
('SWE435', 'Tapushe Rabaya Toma', '2B', 0, '501AB', 0, 4),
('SE111', 'Dr. Touhid Bhuiyan', '1A', 0, '501AB', 3, 3),
('SWE412', 'Lamisha Rawshan', '4C', 0, '502AB', 0, 5),
('SWE307', 'Md Alamgir Kabir', '8A', 0, '502AB', 1, 1),
('SWE214', 'Md Alamgir Kabir', '4A', 0, '502AB', 1, 2),
('SWE411', 'Mr. Kaushik Sarker', '6A', 0, '604AB', 0, 0),
('SE111', 'Dr. Touhid Bhuiyan', '1A', 0, '604AB', 0, 1),
('SE111', 'Dr. Md. Asraf Ali', '1B', 0, '604AB', 0, 2),
('SE111', 'Dr. Md. Asraf Ali', '1C', 0, '607AB', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`) VALUES
('dibasdebnath@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
('faruk35-1280@diu.edu.bd', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`C_id`);

--
-- Indexes for table `course_teacher`
--
ALTER TABLE `course_teacher`
  ADD PRIMARY KEY (`C_id`,`S_id`),
  ADD KEY `T_id` (`T_id`),
  ADD KEY `S_id` (`S_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`R_code`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`S_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`T_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`R_code`,`Timeslot`,`Dayslot`),
  ADD UNIQUE KEY `TTD` (`T_id`,`Timeslot`,`Dayslot`),
  ADD UNIQUE KEY `STD` (`S_id`,`Grp_no`,`Timeslot`,`Dayslot`),
  ADD KEY `C_id` (`C_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_teacher`
--
ALTER TABLE `course_teacher`
  ADD CONSTRAINT `course_teacher_ibfk_1` FOREIGN KEY (`C_id`) REFERENCES `courses` (`C_id`),
  ADD CONSTRAINT `course_teacher_ibfk_2` FOREIGN KEY (`T_id`) REFERENCES `teachers` (`T_id`),
  ADD CONSTRAINT `course_teacher_ibfk_3` FOREIGN KEY (`S_id`) REFERENCES `sections` (`S_id`);

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`C_id`) REFERENCES `courses` (`C_id`),
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`T_id`) REFERENCES `teachers` (`T_id`),
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`S_id`) REFERENCES `sections` (`S_id`),
  ADD CONSTRAINT `timetable_ibfk_4` FOREIGN KEY (`R_code`) REFERENCES `rooms` (`R_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
