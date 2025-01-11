-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 04:15 PM
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
-- Database: `web_based_voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `login` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `password`, `login`) VALUES
('admin1', 'neub2024', 0);

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `nid` varchar(100) NOT NULL,
  `p_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE `committee` (
  `nid` varchar(100) DEFAULT NULL,
  `p_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`nid`, `p_id`) VALUES
('4663949545', 22),
('4663949548', 29);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `p_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`p_id`, `title`, `rank`) VALUES
(22, 'PRESIDENT', 1),
(29, 'VICE PRESIDENT', 2);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `nid` varchar(100) DEFAULT NULL,
  `p_id` int(100) DEFAULT NULL,
  `votes` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`nid`, `p_id`, `votes`) VALUES
('4663949545', 22, 2),
('4663949547', 22, 1),
('4663949546', 29, 1),
('4663949548', 29, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `nid` varchar(100) NOT NULL,
  `nid_c` varchar(100) NOT NULL,
  `p_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `nid` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `login` varchar(100) NOT NULL,
  `registration` varchar(100) NOT NULL,
  `approve` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`nid`, `name`, `f_name`, `m_name`, `phone_number`, `dob`, `photo`, `address`, `password`, `login`, `registration`, `approve`) VALUES
('4663949545', 'GENNADY KOROTKEVICH', 'VLADIMIR KOROTKEVICH', 'LYUDMILA KOROTKEVICH', '01304766655', '1994-09-25', 'UUO-IbIy.png', 'sylhet', '12345678', '1', '1', '1'),
('4663949546', 'BILL GATES', 'BILL GATES SR', 'MARY MAXWELL', '01304766655', '1955-10-28', 'Bill_Gates_-_2023_-_P062021-967902_(cropped).jpg', 'sylhet', '12345678', '0', '1', '0'),
('4663949547', 'ELON MUSK', 'ERROL MUSK', 'MAYE MUSK', '01304766657', '1971-06-28', 'Elon Musk.jpg', 'dhaka', '12345678', '0', '1', '0'),
('4663949548', 'MARK ZUCKERBERG', 'EDWARD ZUCKERBERG', 'KAREN KEMPNER', '01304766658', '1984-03-14', 'Mark_Zuckerberg_F8_2019_Keynote_(32830578717)_(cropped).jpg', 'sylhet', '12345678', '0', '1', '1'),
('4663949549', 'DENNIS RITCHIE', 'JEAN MCGEE RITCHIE', 'ALISTAIR E. RITCHIE', '01304766659', '1941-09-09', 'Dennis Richte.jpg', 'chittagong', '12345678', '0', '1', '1'),
('4663949550', 'STEVE JOBS', 'ABDULFATTAH JOHN JANDALI', 'JOANNE SCHIEBLE SIMPSON', '01304766660', '1955-02-24', 'Steve Jobs.jpg', 'moulovibazar', '12345678', '0', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `vote_on` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
