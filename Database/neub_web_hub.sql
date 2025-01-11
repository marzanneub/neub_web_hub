-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 07:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neub_web_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `login` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `password`, `login`) VALUES
('admin1', 'neub2024', 0);

-- --------------------------------------------------------

--
-- Table structure for table `apply_waiver`
--

CREATE TABLE `apply_waiver` (
  `s_id` varchar(100) NOT NULL,
  `applcation` varchar(1000) NOT NULL,
  `grant` int(100) NOT NULL,
  `reject` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `completed_session`
--

CREATE TABLE `completed_session` (
  `prog_id` int(100) NOT NULL,
  `session_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(100) NOT NULL,
  `syllabus_id` int(100) NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `course_title` varchar(100) NOT NULL,
  `credit` float NOT NULL,
  `prerequisite` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `syllabus_id`, `course_code`, `course_title`, `credit`, `prerequisite`) VALUES
(4, 1, 'cse-113', 'structured programming language', 3, NULL),
(5, 1, 'cse-114', 'structured programming language lab', 1.5, NULL),
(9, 1, 'mat-101', 'calculus', 3, NULL),
(10, 1, 'ged-101', 'bangladesh studies', 3, NULL),
(11, 1, 'cse-121', 'basic electrical engineering', 3, NULL),
(12, 1, 'cse-122', 'basic electrical engineering lab', 1.5, NULL),
(13, 1, 'cse-123', 'discrete mathemetics', 3, NULL),
(14, 1, 'che-101', 'fundamentals of chemistry', 3, NULL),
(15, 1, 'phy-101', 'mechanics, wave, heat & thermodynamics', 3, NULL),
(16, 1, 'cse-131', 'data structure', 3, 4),
(17, 1, 'cse-132', 'data structure lab', 1.5, NULL),
(18, 1, 'mat-103', 'matrices, vector analysis & geometry', 3, NULL),
(19, 1, 'phy-103', 'electromagnetism & optics', 3, NULL),
(20, 1, 'eng-101', 'english language', 3, NULL),
(21, 1, 'cse-211', 'objcet oriented programming language', 3, 4),
(22, 1, 'cse-212', 'objcet oriented programming language lab', 1.5, NULL),
(27, 10, 'law–101', 'jurisprudence-1', 3, NULL),
(28, 10, 'law–103', 'muslim law-1', 3, NULL),
(29, 10, 'eng–101', 'english language-1', 3, NULL),
(30, 10, 'cse-100', 'computer skill', 3, NULL),
(31, 10, 'law–105', 'jurisprudence-ii', 3, NULL),
(32, 10, 'law–107', 'law of contract-1', 3, NULL),
(33, 10, 'cse-109', 'muslim law-ii', 3, NULL),
(34, 10, 'eng–103 ', 'english language -ii', 3, NULL),
(39, 1, 'cse-213', 'electronic devices & circuits', 3, 11),
(40, 1, 'cse-214', 'electronic devices & circuits lab', 1.5, NULL),
(42, 1, 'sta-201', 'basic statistics & probability', 3, NULL),
(43, 1, 'cse-221', 'digital logic design', 3, 11),
(44, 1, 'cse-222', 'digital logic design lab', 1.5, NULL),
(45, 1, 'cse-223', 'theory of computation', 3, NULL),
(46, 1, 'mat-201', 'numerical methods', 3, NULL),
(47, 1, 'eco-201', 'principles of economics', 3, NULL),
(48, 1, 'cse-200', 'project work 1', 2, NULL),
(49, 1, 'cse-231', 'algorithm design & analysis', 3, 16),
(50, 1, 'cse-232', 'algorithm design & analysis lab', 1.5, NULL),
(51, 1, 'bba-201', 'cost and management accounting', 3, NULL),
(52, 1, 'mat-203', 'complex variables, laplace transform and fourier series', 3, NULL),
(53, 1, 'cse-311', 'computer architecture', 3, NULL),
(54, 1, 'cse-313', 'database system', 3, NULL),
(55, 1, 'cse-314', 'database system lab', 1.5, NULL),
(56, 1, 'cse-315', 'communication engineering', 3, NULL),
(57, 1, 'cse-317', 'simulation and modeling', 3, NULL),
(58, 1, 'cse-321', 'microprocessor & interfacing', 3, 39),
(59, 1, 'cse-322', 'microprocessor & interfacing lab', 1.5, NULL),
(60, 1, 'cse-323', 'management information system', 3, NULL),
(61, 1, 'cse-325', 'computer networking', 3, NULL),
(62, 1, 'cse-326', 'computer networking lab', 1.5, NULL),
(63, 1, 'cse-300', 'project work 2', 2, NULL),
(64, 1, 'cse-331', 'operating system and system', 3, NULL),
(65, 1, 'cse-332', 'operating system and system lab', 1.5, NULL),
(66, 1, 'cse-333', 'software engineering', 3, NULL),
(67, 1, 'cse-334', 'software engineering lab', 1.5, NULL),
(68, 1, 'cse-335', 'technical writing and presentation', 3, NULL),
(69, 1, 'cse-411', 'artificial intelligence', 3, NULL),
(70, 1, 'cse-412', 'artificial intelligence lab', 1.5, NULL),
(71, 1, 'cse-413', 'web engineering', 3, NULL),
(72, 1, 'cse-414', 'web engineering lab', 1.5, NULL),
(73, 1, 'cse-455', 'machine learning', 3, NULL),
(74, 1, 'cse-456', 'machine learning lab', 1.5, NULL),
(75, 1, 'cse-400', 'thesis / project 1', 2, NULL),
(76, 1, 'cse-421', 'compiler construction', 3, 39),
(77, 1, 'cse-422', 'compiler construction lab', 1.5, NULL),
(78, 1, 'cse-425', 'cyber and intellectual property law', 3, NULL),
(79, 1, 'cse-402', 'thesis / project 2', 1.5, NULL),
(80, 1, 'cse-404', 'viva voice', 1.5, NULL),
(81, 1, 'cse-431', 'digital signal processing', 3, 18),
(82, 1, 'cse-432', 'digital signal processing lab', 1.5, NULL),
(83, 1, 'cse-111', 'fundamentals of computers', 3, NULL),
(84, 1, 'cse-216', 'engineering drawings', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_advisor`
--

CREATE TABLE `course_advisor` (
  `t_id` int(100) NOT NULL,
  `prog_id` int(100) NOT NULL,
  `session_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_advisor`
--

INSERT INTO `course_advisor` (`t_id`, `prog_id`, `session_id`) VALUES
(6, 24, 20222),
(3, 24, 20221);

-- --------------------------------------------------------

--
-- Table structure for table `course_on_c_o_l`
--

CREATE TABLE `course_on_c_o_l` (
  `prog_id` int(100) NOT NULL,
  `session_id` int(100) NOT NULL,
  `course_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_on_c_o_l`
--

INSERT INTO `course_on_c_o_l` (`prog_id`, `session_id`, `course_id`) VALUES
(24, 20222, 83),
(24, 20222, 4),
(24, 20222, 5),
(24, 20222, 9),
(24, 20222, 10),
(24, 20221, 11),
(24, 20221, 12),
(24, 20221, 13),
(24, 20221, 14),
(24, 20221, 15);

-- --------------------------------------------------------

--
-- Table structure for table `course_registration`
--

CREATE TABLE `course_registration` (
  `s_id` int(100) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `current_program`
--

CREATE TABLE `current_program` (
  `prog_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_program`
--

INSERT INTO `current_program` (`prog_id`) VALUES
(24);

-- --------------------------------------------------------

--
-- Table structure for table `current_session`
--

CREATE TABLE `current_session` (
  `session_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_session`
--

INSERT INTO `current_session` (`session_id`) VALUES
(20222);

-- --------------------------------------------------------

--
-- Table structure for table `c_o_l`
--

CREATE TABLE `c_o_l` (
  `prog_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_o_l`
--

INSERT INTO `c_o_l` (`prog_id`) VALUES
(24);

-- --------------------------------------------------------

--
-- Table structure for table `c_r_list`
--

CREATE TABLE `c_r_list` (
  `s_id` varchar(100) NOT NULL,
  `course_id` int(100) NOT NULL,
  `session_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_r_list`
--

INSERT INTO `c_r_list` (`s_id`, `course_id`, `session_id`) VALUES
('0562210005101041', 11, 20221),
('0562210005101041', 12, 20221),
('0562210005101041', 13, 20221),
('0562210005101041', 14, 20221),
('0562210005101041', 15, 20221),
('0562210005101042', 11, 20221),
('0562210005101042', 12, 20221),
('0562210005101042', 13, 20221),
('0562210005101042', 14, 20221),
('0562210005101042', 15, 20221);

-- --------------------------------------------------------

--
-- Table structure for table `c_r_reg`
--

CREATE TABLE `c_r_reg` (
  `value` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_r_reg`
--

INSERT INTO `c_r_reg` (`value`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `c_r_status`
--

CREATE TABLE `c_r_status` (
  `s_id` varchar(100) NOT NULL,
  `status` int(100) NOT NULL,
  `session_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_r_status`
--

INSERT INTO `c_r_status` (`s_id`, `status`, `session_id`) VALUES
('0562210005101041', 1, 20221),
('0562210005101042', 1, 20221);

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `dept_id` int(100) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `dept_status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`dept_id`, `dept_name`, `dept_status`) VALUES
(3, 'law', 1),
(8, 'business', 1),
(9, 'cse', 1),
(10, 'english', 1),
(20, 'eee', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dept_head`
--

CREATE TABLE `dept_head` (
  `dept_id` int(100) DEFAULT NULL,
  `t_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dept_head`
--

INSERT INTO `dept_head` (`dept_id`, `t_id`) VALUES
(8, 16),
(9, 3),
(3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `s_id` varchar(100) NOT NULL,
  `course_id` int(100) NOT NULL,
  `session_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `given_list`
--

CREATE TABLE `given_list` (
  `s_id` varchar(100) NOT NULL,
  `given` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `given_list`
--

INSERT INTO `given_list` (`s_id`, `given`) VALUES
('0562210005101041', 1),
('0562210005101042', 1);

-- --------------------------------------------------------

--
-- Table structure for table `make_result_sheet`
--

CREATE TABLE `make_result_sheet` (
  `session_id` int(100) DEFAULT NULL,
  `publish` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `make_result_sheet`
--

INSERT INTO `make_result_sheet` (`session_id`, `publish`) VALUES
(20221, 1),
(20222, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(100) NOT NULL,
  `notice_title` varchar(100) NOT NULL,
  `notice_details` varchar(1000) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `notice_title`, `notice_details`, `date`) VALUES
(2, 'Workshop on Academic Writing', 'A workshop on academic writing will be held on May 25. Register by May 20 to secure your spot.', 'Wednesday, 15 May, 2024'),
(3, 'Career Fair Announcement', 'Save the date for our annual Career Fair on June 15. Companies from various sectors will participate.', 'Wednesday, 15 May, 2024'),
(4, 'Library Closure', 'The library will be closed for maintenance from May 20 to May 25. Please plan your study accordingly.', 'Wednesday, 15 May, 2024'),
(5, 'Call for Research Papers', 'The university invites submissions for research papers for the upcoming conference. Deadline: June 30.', 'Wednesday, 15 May, 2024'),
(6, 'Programming contest', 'You will be happy to know that the contest will be held on 21st  May, 2024 at 2:00 PM. Here is the list of the students who will participate in the contest.  We are delighted to have Dr. Arif Ahmad  Sir who is guiding the programming factors prior to his joining. ', 'Wednesday, 15 May, 2024'),
(8, 'Exam Schedule Update', 'Due to unforeseen circumstances, the exam schedule has been revised. Please check the new schedule.', 'Wednesday, 15 May, 2024'),
(12, 'New departnment head', 'Our new department head Prof.Dr. Arif Ahmed will join from the semester summer 2024.', 'Thursday, 27 June, 2024');

-- --------------------------------------------------------

--
-- Table structure for table `prog`
--

CREATE TABLE `prog` (
  `prog_id` int(100) NOT NULL,
  `dept_id` int(100) NOT NULL,
  `prog_name` varchar(100) NOT NULL,
  `prog_status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prog`
--

INSERT INTO `prog` (`prog_id`, `dept_id`, `prog_name`, `prog_status`) VALUES
(24, 9, 'bsc', 1),
(25, 9, 'msc', 1),
(27, 3, 'llm', 1),
(28, 8, 'bba', 1),
(29, 8, 'mba', 1),
(30, 10, 'ba', 1),
(32, 10, 'ma', 1),
(33, 3, 'llb', 1),
(39, 20, 'bsc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `s_id` varchar(100) NOT NULL,
  `course_id` int(100) NOT NULL,
  `student_session` int(100) NOT NULL,
  `enroll_session` int(100) NOT NULL,
  `course_session` int(100) NOT NULL,
  `mid_term` int(100) DEFAULT NULL,
  `final` int(100) DEFAULT NULL,
  `attendance` int(100) DEFAULT NULL,
  `other` int(100) DEFAULT NULL,
  `publish` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`s_id`, `course_id`, `student_session`, `enroll_session`, `course_session`, `mid_term`, `final`, `attendance`, `other`, `publish`) VALUES
('0562210005101041', 83, 20221, 20221, 20221, 22, 35, 9, 17, 1),
('0562210005101041', 4, 20221, 20221, 20221, 28, 38, 10, 18, 1),
('0562210005101041', 5, 20221, 20221, 20221, 30, 40, 10, 20, 1),
('0562210005101041', 9, 20221, 20221, 20221, 20, 33, 9, 16, 1),
('0562210005101041', 10, 20221, 20221, 20221, 16, 29, 8, 13, 1),
('0562210005101042', 83, 20221, 20221, 20221, 15, 30, 8, 12, 1),
('0562210005101042', 4, 20221, 20221, 20221, 2, 4, 3, 5, 1),
('0562210005101042', 5, 20221, 20221, 20221, 18, 27, 7, 14, 1),
('0562210005101042', 9, 20221, 20221, 20221, 25, 37, 10, 19, 1),
('0562210005101042', 10, 20221, 20221, 20221, 23, 34, 9, 15, 1),
('0562210005101041', 11, 20221, 20222, 20221, 19, 28, 7, 12, 1),
('0562210005101041', 12, 20221, 20222, 20221, 26, 39, 10, 20, 1),
('0562210005101041', 13, 20221, 20222, 20221, 24, 26, 8, 16, 1),
('0562210005101041', 14, 20221, 20222, 20221, 17, 20, 7, 13, 1),
('0562210005101041', 15, 20221, 20222, 20221, 20, 28, 8, 12, 1),
('0562210005101042', 11, 20221, 20222, 20221, 27, 36, 10, 18, 1),
('0562210005101042', 12, 20221, 20222, 20221, 21, 32, 9, 17, 1),
('0562210005101042', 13, 20221, 20222, 20221, 29, 38, 10, 19, 1),
('0562210005101042', 14, 20221, 20222, 20221, 24, 35, 9, 18, 1),
('0562210005101042', 15, 20221, 20222, 20221, 30, 40, 10, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(100) NOT NULL,
  `session_name` varchar(100) NOT NULL,
  `year` int(100) NOT NULL,
  `prog_id` int(100) NOT NULL,
  `completed_credit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `session_name`, `year`, `prog_id`, `completed_credit`) VALUES
(20221, 'spring', 2022, 24, 13.5),
(20221, 'spring', 2022, 25, 0),
(20221, 'spring', 2022, 27, 0),
(20221, 'spring', 2022, 28, 0),
(20221, 'spring', 2022, 29, 0),
(20221, 'spring', 2022, 30, 0),
(20221, 'spring', 2022, 32, 0),
(20221, 'spring', 2022, 33, 0),
(20221, 'spring', 2022, 39, 0),
(20222, 'summer', 2022, 24, 0),
(20222, 'summer', 2022, 25, 0),
(20222, 'summer', 2022, 27, 0),
(20222, 'summer', 2022, 28, 0),
(20222, 'summer', 2022, 29, 0),
(20222, 'summer', 2022, 30, 0),
(20222, 'summer', 2022, 32, 0),
(20222, 'summer', 2022, 33, 0),
(20222, 'summer', 2022, 39, 0);

-- --------------------------------------------------------

--
-- Table structure for table `session_on_c_o_l`
--

CREATE TABLE `session_on_c_o_l` (
  `prog_id` int(100) NOT NULL,
  `session_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_on_c_o_l`
--

INSERT INTO `session_on_c_o_l` (`prog_id`, `session_id`) VALUES
(24, 20221),
(24, 20222);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `s_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `prog_id` int(100) NOT NULL,
  `session_id` int(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `login` int(100) NOT NULL,
  `registration` int(100) NOT NULL,
  `approve` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `name`, `photo`, `prog_id`, `session_id`, `address`, `phone_number`, `email`, `password`, `login`, `registration`, `approve`) VALUES
('0162210005101041', 'kd pathak', 'images.jpg', 33, 20221, 'sylhet', '01844212379', '', '0162210005101041', 1, 1, 1),
('0562210005101041', 'muhammad marzan hussain', 'Marzan.jpg', 24, 20221, 'sylhet', '01304766654', 'marzanhussainde@gmail.com', '0562210005101041', 0, 1, 1),
('0562210005101042', 'gennady korotkevich', 'UUO-IbIy.png', 24, 20221, 'sylhet', '01304766655', '', '0562210005101042', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `syllabus_id` int(100) NOT NULL,
  `prog_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`syllabus_id`, `prog_id`) VALUES
(1, 24),
(2, 25),
(5, 28),
(6, 29),
(7, 30),
(9, 32),
(10, 33),
(12, 39);

-- --------------------------------------------------------

--
-- Table structure for table `taken`
--

CREATE TABLE `taken` (
  `t_id` int(100) NOT NULL,
  `prog_id` int(100) NOT NULL,
  `session_id` int(100) NOT NULL,
  `course_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taken`
--

INSERT INTO `taken` (`t_id`, `prog_id`, `session_id`, `course_id`) VALUES
(7, 24, 20222, 83),
(6, 24, 20222, 4),
(6, 24, 20222, 5),
(5, 24, 20222, 9),
(14, 24, 20222, 10),
(3, 24, 20221, 11),
(3, 24, 20221, 12),
(3, 24, 20221, 13),
(3, 24, 20221, 14),
(3, 24, 20221, 15);

-- --------------------------------------------------------

--
-- Table structure for table `taken_result`
--

CREATE TABLE `taken_result` (
  `t_id` int(100) NOT NULL,
  `prog_id` int(100) NOT NULL,
  `session_id` int(100) NOT NULL,
  `course_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_id` int(100) NOT NULL,
  `t_name` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `dept_id` int(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `login` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `approve` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `t_name`, `photo`, `dept_id`, `designation`, `qualification`, `address`, `phone_number`, `email`, `password`, `login`, `registration`, `approve`) VALUES
(1, 'khadim muhammad asif uz zaman', 'Khadem-Mohammad-Asif-uz-zaman.jpg', 9, 'professor', 'B.Sc.(Engg.) in CSE', 'sylhet', '01304766655', 'asif@cse.neub.bd', '12345678', 0, 1, 1),
(3, 'al mehedi saadat cowdhury', 'AlMehdiSaadatChowdhury.jpg', 9, 'professor', 'M.Sc. (Thesis) in CSE', 'moulovibazar', '01304766656', '', '12345678', 0, 1, 1),
(4, 'dr mohammad shahidur rahman', 'Dr.Mohammad-Shahidur-Rahman.jpg', 9, 'professor', 'Ph.D, Japan', 'jamalpur', '01304766657', '', '12345678', 0, 1, 1),
(5, 'rathindra chandra gope', 'RatindraChandraGope.jpg', 9, 'associate professor', 'B.Sc., M.Sc. & M.Phil. in Mathematics SUST', 'sylhet', '01304766658', '', '12345678', 0, 1, 1),
(6, 'tasnim zahan', 'TasnimZahan.jpg', 9, 'assistant professor', 'B.Sc. (Engg.) in CSE', 'sylhet', '01304766659', '', '12345678', 0, 1, 1),
(7, 'shahadat hussain parvez', 'SHP.jpg', 9, 'assistant professor', 'B.Sc. (Engg.) in EEE', 'brahmanbaria', '01304766660', 'shparvez@neub.edu.bd', '12345678', 0, 1, 1),
(8, 'pranta sarker', 'Pranta_Sarker.jpg', 9, 'lecturer', 'B.Sc. (Engg.) in CSE', 'netrokuna', '01304766661', '', '0', 0, 0, 0),
(11, 'ayon dey', 'Ayon-Dey.jpg', 9, 'lecturer', 'B.Sc.(Engg.) in CSE', 'sylhet', '01304766690', 'ayon@neub.edu.bd', '0', 0, 0, 0),
(12, 'choudhury md faiz ul haque hashmee', 'Chowdhury_Md_Faiz_Ul_Haqie_Hashmee.jpg', 3, 'lecturer', 'LL.M, BPP University, London, U.K', 'sylhet', '01726351846', '', '12345678', 0, 1, 1),
(13, 'md. nasir uddin', 'MdNasirUddin.jpg', 8, 'assistant professor', 'BBA & MBA', 'habiganj', '01304727845', '', '0', 0, 0, 0),
(14, 'razorshi prozzwal talukder', 'Razorshi-Prozzwal-Talukder.jpg', 9, 'lecturer', 'B.Sc. (Engg.) in CSE, SEC', 'sylhet', '01723957264', '', '12345678', 0, 1, 1),
(15, 'professor md. harunur rashid', 'Professor-Md-Harunur-Rashid.jpg', 8, 'professor', 'BA (Hons.) & MA in Engilish', 'sylhet', '01856372951', '', '0', 0, 0, 0),
(16, 'rebeka sultana chowdhury', 'RebekaSultanaChowdhury.jpg', 8, 'associate professor', 'BBA & MBA', 'sylhet', '01304766937', '', '0', 0, 0, 0),
(17, 'md. mizanur rahman', 'Md.MizanurRahman.jpg', 8, 'assistant professor', 'BBA & MBA', 'dhaka', '01757625394', '', '0', 0, 0, 0),
(18, 'md. abdullah al asad', 'Md.-Abdullah-Al-Asad.jpg', 3, 'lecturer', 'LL.B(Hons.) & LL.M (International Law)', 'sylhet', '01974212379', '', '12345678', 0, 1, 1),
(19, 'najia ferdous', 'Najia-Ferdous.jpg', 3, 'lecturer', 'LL.M, University of Asia Pacific', 'sylhet', '01863429571', '', '12345678', 0, 1, 1),
(20, 'dr. arif ahmad', 'Dr._Arif_Ahmad.jpg', 9, 'associate professor', 'Ph.D. in CSE', 'sylhet', '01764538298', '', '0', 0, 0, 0),
(21, 'golam faruque rasel', 'GolamFaruqueRasel.jpg', 3, 'assistant professor', 'LL.B (Hons.) & LL.M University of Chittagong', 'sylhet', '01785637285', '', '12345678', 0, 1, 1),
(22, 'samiha sanjana', 'SamihaSanjana.jpg', 8, 'assistant professor', 'BBA & MBA Leading University', 'moulovibazar', '01785362835', '', '0', 0, 0, 0),
(23, 'dr. abul mukid mohammad mukaddes', 'Dr.Abul-Mukid-Mohammad-Mukaddes.jpg', 9, 'professor', 'Postdoctoral Fellow, Japan', 'dhaka', '01873546284', '', '0', 0, 0, 0),
(24, 's. m. saydur rahman', 'SaydurRahman.png', 9, 'assistant professor', 'B.Sc., M.Sc. & M.Phil. in Mathematics SUST', 'sunamganj', '01873564527', '', '12345678', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tooken_course`
--

CREATE TABLE `tooken_course` (
  `prog_id` int(100) NOT NULL,
  `session_id` int(100) NOT NULL,
  `course_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tooken_course`
--

INSERT INTO `tooken_course` (`prog_id`, `session_id`, `course_id`) VALUES
(24, 20221, 83),
(24, 20221, 4),
(24, 20221, 5),
(24, 20221, 9),
(24, 20221, 10);

-- --------------------------------------------------------

--
-- Table structure for table `waiver`
--

CREATE TABLE `waiver` (
  `s_id` varchar(100) NOT NULL,
  `percent` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waiver`
--

INSERT INTO `waiver` (`s_id`, `percent`) VALUES
('0562210005101041', 0),
('0562210005101042', 0),
('0162210005101041', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `apply_waiver`
--
ALTER TABLE `apply_waiver`
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `syllabus_id` (`syllabus_id`);

--
-- Indexes for table `course_advisor`
--
ALTER TABLE `course_advisor`
  ADD KEY `t_id` (`t_id`);

--
-- Indexes for table `c_o_l`
--
ALTER TABLE `c_o_l`
  ADD KEY `prog_id` (`prog_id`);

--
-- Indexes for table `c_r_list`
--
ALTER TABLE `c_r_list`
  ADD KEY `s_id` (`s_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `dept_head`
--
ALTER TABLE `dept_head`
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `t_id` (`t_id`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD KEY `s_id` (`s_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `given_list`
--
ALTER TABLE `given_list`
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `prog`
--
ALTER TABLE `prog`
  ADD PRIMARY KEY (`prog_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD KEY `prog_id` (`prog_id`);

--
-- Indexes for table `session_on_c_o_l`
--
ALTER TABLE `session_on_c_o_l`
  ADD KEY `prog_id` (`prog_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `fk_prog` (`prog_id`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`syllabus_id`),
  ADD KEY `prog_id` (`prog_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `waiver`
--
ALTER TABLE `waiver`
  ADD KEY `s_id` (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `dept_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prog`
--
ALTER TABLE `prog`
  MODIFY `prog_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `syllabus_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply_waiver`
--
ALTER TABLE `apply_waiver`
  ADD CONSTRAINT `apply_waiver_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`syllabus_id`) REFERENCES `syllabus` (`syllabus_id`);

--
-- Constraints for table `course_advisor`
--
ALTER TABLE `course_advisor`
  ADD CONSTRAINT `course_advisor_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `teacher` (`t_id`);

--
-- Constraints for table `c_o_l`
--
ALTER TABLE `c_o_l`
  ADD CONSTRAINT `c_o_l_ibfk_1` FOREIGN KEY (`prog_id`) REFERENCES `prog` (`prog_id`);

--
-- Constraints for table `c_r_list`
--
ALTER TABLE `c_r_list`
  ADD CONSTRAINT `c_r_list_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`),
  ADD CONSTRAINT `c_r_list_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `dept_head`
--
ALTER TABLE `dept_head`
  ADD CONSTRAINT `dept_head_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `dept` (`dept_id`),
  ADD CONSTRAINT `dept_head_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `teacher` (`t_id`);

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`),
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `given_list`
--
ALTER TABLE `given_list`
  ADD CONSTRAINT `given_list_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`);

--
-- Constraints for table `prog`
--
ALTER TABLE `prog`
  ADD CONSTRAINT `prog_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `dept` (`dept_id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`prog_id`) REFERENCES `prog` (`prog_id`);

--
-- Constraints for table `session_on_c_o_l`
--
ALTER TABLE `session_on_c_o_l`
  ADD CONSTRAINT `session_on_c_o_l_ibfk_1` FOREIGN KEY (`prog_id`) REFERENCES `c_o_l` (`prog_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_prog` FOREIGN KEY (`prog_id`) REFERENCES `prog` (`prog_id`);

--
-- Constraints for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD CONSTRAINT `syllabus_ibfk_1` FOREIGN KEY (`prog_id`) REFERENCES `prog` (`prog_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `dept` (`dept_id`);

--
-- Constraints for table `waiver`
--
ALTER TABLE `waiver`
  ADD CONSTRAINT `waiver_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
