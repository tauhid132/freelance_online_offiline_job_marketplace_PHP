-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2023 at 05:26 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_sad`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `full_name`, `password`, `email`, `role`, `image`, `status`) VALUES
(4, 'tauhid', 'Tauhid Hasan', '$2y$10$Cjr97XOwihf40WP8ntG6quo54pQsAo.YSrRZGUxV4uFfmL62n/NqK', 'tauhid132@gmail.com', 'admin', 'uploads/Picture2.JPG', 1),
(13, 'admin', 'admin', '$2y$10$TvI1zKF2rZ.EiZn/WwB8RuzYHiYF/wMXTqKi5J1P3v.P1RUYJPtXO', 'admin@gmail.com', 'admin', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apply_job`
--

CREATE TABLE `apply_job` (
  `id` int(11) NOT NULL,
  `applicantEmail` varchar(100) NOT NULL,
  `jobPostId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `applicationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `proposalText` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apply_job`
--

INSERT INTO `apply_job` (`id`, `applicantEmail`, `jobPostId`, `serviceId`, `applicationDate`, `proposalText`, `status`) VALUES
(1, 'abir@gmail.com', 2, 4, '2022-04-29 21:00:21', ' I want the job', 1),
(2, 'abir@gmail.com', 2, 8, '2022-04-29 21:11:17', ' hello', 2),
(8, 'shohan@gmail.com', 2, 6, '2022-05-06 16:06:43', ' ', 0),
(9, 'abir@gmail.com', 6, 3, '2022-05-07 03:54:00', ' Bhai I want this work', 1),
(11, 'abir@gmail.com', 2, 3, '2022-05-18 18:46:58', ' I want this job', 0),
(12, 'abir@gmail.com', 8, 8, '2022-05-22 18:56:55', ' Bhai i need this job', 1),
(13, 'abir@gmail.com', 2, 3, '2022-05-23 03:30:16', ' I am a good web developer', 0),
(14, 'abir@gmail.com', 8, 8, '2022-05-23 04:05:02', ' i can do it', 2),
(15, 'abir@gmail.com', 2, 3, '2022-08-30 07:33:37', ' I can do it perfectly', 0),
(16, 'abir@gmail.com', 2, 3, '2022-08-30 08:25:13', ' I want this job', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bkash_otp`
--

CREATE TABLE `bkash_otp` (
  `id` int(11) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mobile` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bkash_otp`
--

INSERT INTO `bkash_otp` (`id`, `otp`, `timestamp`, `mobile`) VALUES
(30, '637682', '2022-05-14 05:36:22', '01751968954'),
(31, '554151', '2022-05-14 05:44:29', '01751968954'),
(32, '104657', '2022-05-22 19:04:06', '01631078465'),
(33, '481180', '2022-05-22 19:04:37', '01631078465'),
(34, '244322', '2022-09-06 06:59:13', '0151968954'),
(35, '829616', '2022-09-06 07:04:07', '01751968954'),
(36, '182983', '2022-09-06 07:08:50', '01751968954'),
(37, '496111', '2022-09-06 07:09:53', '01751968954'),
(38, '987659', '2022-09-06 07:10:52', '01751968954'),
(39, '404059', '2022-09-06 07:40:21', '01751968954'),
(40, '826900', '2022-09-13 08:18:27', '01751968954'),
(41, '125717', '2022-09-13 09:03:59', '01751968954'),
(42, '951357', '2022-09-13 09:04:41', '01719103075');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark_service_portfolio`
--

CREATE TABLE `bookmark_service_portfolio` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `service_portfolio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmark_service_portfolio`
--

INSERT INTO `bookmark_service_portfolio` (`id`, `email`, `service_portfolio`) VALUES
(13, 'atstechnologybd@gmail.com', '16'),
(14, 'atstechnologybd@gmail.com', '4'),
(15, 'atstechnologybd@gmail.com', '3'),
(16, 'atstechnologybd@gmail.com', '8'),
(17, 'atstechnologybd@gmail.com', '6'),
(19, 'tauhid132@gmail.com', '4'),
(21, 'tauhid132@gmail.com', '6'),
(22, 'tauhid132@gmail.com', '3');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `acStatus` int(11) NOT NULL DEFAULT 1,
  `profileStatus` int(11) NOT NULL DEFAULT 0,
  `password` varchar(100) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `organizationName` varchar(100) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `intro` varchar(200) NOT NULL,
  `imageLink` varchar(100) NOT NULL,
  `joinDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `dob` date DEFAULT NULL,
  `gender` varchar(100) NOT NULL,
  `streetNo` varchar(100) DEFAULT NULL,
  `policeStation` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `mobileNo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emailAddress`, `acStatus`, `profileStatus`, `password`, `fullName`, `organizationName`, `profession`, `intro`, `imageLink`, `joinDate`, `dob`, `gender`, `streetNo`, `policeStation`, `district`, `country`, `mobileNo`) VALUES
(1, 'abir@gmail.com', 1, 1, '$2y$10$9DstISvJgzTtDgCkb2vdt.YZCHtlQXak3eAhJCGrCIeMVRZvv.P5i', 'Shadiuzzaman Khan', '', 'Web Developer', 'Professional Web Developer, Wordpress Expert ', 'upload/abir.jpg', '2022-04-20 19:29:04', '2022-04-21', 'Male', '32', 'Rampura', 'Dhaka', 'Bangladesh', '+8801751968956'),
(3, 'shohan@gmail.com', 1, 1, '$2y$10$pNB69KO7Pr8GTaeo4PcKd.IEaMp7sceqbcRWKKwKS1KqWWSC1OE0.', 'Shohan Khan', '', 'SEO Expert', 'I am a SEO Expert', 'upload/DSC_0013 copy.JPG', '2022-04-20 19:29:04', NULL, '', '30', 'Banashree', 'Dhaka', 'Bangladesh', ''),
(5, 'naim@gmail.com', 1, 1, '$2y$10$pNB69KO7Pr8GTaeo4PcKd.IEaMp7sceqbcRWKKwKS1KqWWSC1OE0.', 'Naim Islam', '', 'Civil Engineer', '', 'upload/brac.jpg', '2022-04-20 21:10:51', NULL, '', '31', 'Mohakhali DOHS', 'Dhaka', NULL, ''),
(7, 'john@gmail.com', 1, 1, '$2y$10$pNB69KO7Pr8GTaeo4PcKd.IEaMp7sceqbcRWKKwKS1KqWWSC1OE0.', 'John Doe', '', 'Doctor', 'I am doctor', 'upload/Picture1.JPG', '2022-04-23 05:28:35', '2022-04-23', 'Male', '22', 'Kafrul', 'Dhaka', 'Bangladesh', '017777777777'),
(9, 'aminul@gmail.com', 1, 1, '$2y$10$pNB69KO7Pr8GTaeo4PcKd.IEaMp7sceqbcRWKKwKS1KqWWSC1OE0.', 'Aminul Islam', '', '', '', '', '2022-05-22 20:00:32', NULL, '', NULL, NULL, NULL, NULL, ''),
(10, 'karim@gmail.com', 1, 1, '$2y$10$UXBOYvB80WiW9ielo5S9IOxEtBDPIdKgpJNaU0XHPrkQKuzYmlZm2', 'Rezaul', '', 'Electrician ', 'I am a electrician ', 'upload/employer1.jpeg', '2022-05-23 04:49:17', '1995-02-02', 'Male', '465, Mohakhali', 'Mohakhali', 'Dhaka', 'Bangladesh', '01600000000'),
(11, 'mamun@gmail.com', 1, 1, '$2y$10$1mrdeivfWpSamSWU1mh.HOYMhjEpubqTrPY6Qbx1Dirqms1D/KgQy', 'মামুন ইসলাম', '', 'রাজমিস্ত্রী', 'আমি একজন রাজমিস্ত্রী', 'upload/employer1.jpeg', '2022-05-23 04:58:07', '1991-08-12', 'Male', '176, Badda', 'Badda', 'Dhaka', 'Bangladesh', '01600000000');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `id` int(11) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `acStatus` int(11) NOT NULL DEFAULT 1,
  `profileStatus` int(11) NOT NULL DEFAULT 0,
  `password` varchar(100) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `imageLink` varchar(100) DEFAULT NULL,
  `joinDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `dob` date DEFAULT NULL,
  `gender` varchar(100) NOT NULL,
  `streetNo` varchar(100) DEFAULT NULL,
  `policeStation` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `mobileNo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `emailAddress`, `acStatus`, `profileStatus`, `password`, `fullName`, `imageLink`, `joinDate`, `dob`, `gender`, `streetNo`, `policeStation`, `district`, `country`, `mobileNo`) VALUES
(6, 'tauhid132@gmail.com', 1, 1, '$2y$10$Myvt67ZPOyj/A3D3il2ZnOXzcPqtxPwqDH7HCCaVRJFqPH3jWL42O', 'Tauhid Hasan', 'upload/NID One Page.jpg', '2022-04-21 13:26:09', '2022-04-21', 'Male', 'H-465, R-31', 'Mohakhali DOHS', 'Dhaka', 'Bangladesh', '01304779899'),
(9, 'rashedhossain@gmail.com', 1, 1, '$2y$10$o7yG89cLAsE4WzunfzLk/OHJ4/kyPLZ/fAW55NiPEsUp.bA5KiUEG', 'Rashed Hossain', 'upload/271621920_1557429111281610_189284329719889660_n.jpg', '2022-05-22 18:11:43', '1999-06-07', 'Male', '176 rampura', 'Rampura', 'Dhaka', 'Bangladesh', '0170000000'),
(10, 'khan@gmail.com', 1, 1, '$2y$10$tz28kRX3ZuOZLZRsBYjO2uINms8DYjLHG7.ooNCfd94SwabujenwK', 'Khan', 'upload/employer1.jpeg', '2022-05-23 04:39:10', NULL, '', NULL, NULL, NULL, NULL, NULL),
(11, 'anthonypurification16@gmail.com', 1, 0, '$2y$10$wFjsME/sEFmaQfRfr.5yg.Arl/WoI/gNqeVJq8Xapa/l70jMq/eCS', 'James Anthony Purification', NULL, '2022-08-23 08:18:55', NULL, '', NULL, NULL, NULL, NULL, NULL),
(12, 'atstechnologybd@gmail.com', 1, 0, '$2y$10$EwPJhxFNydjR1KD7jhJfVeOxxcZ3BZfuLC8RomrnkbHs/tMwyzHNG', 'tauhid h', 'upload/coding.png', '2022-08-23 08:25:36', '0000-00-00', '', '', '', '', '', ''),
(13, 'tauhidhasan1999@gmail.com', 1, 0, '$2y$10$up4QW8i4HCJG3gdBcRbdneWgH/IhStwS8KBpwIx7qMy7VHutim086', 'Tauhid', NULL, '2022-09-12 18:38:07', NULL, '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hire_employee`
--

CREATE TABLE `hire_employee` (
  `id` int(11) NOT NULL,
  `employeeEmail` varchar(100) NOT NULL,
  `employerEmail` varchar(100) NOT NULL,
  `servicePortfolioId` int(11) NOT NULL,
  `hireTime` timestamp NULL DEFAULT current_timestamp(),
  `jobStartTime` timestamp NULL DEFAULT NULL,
  `jobFinishTime` timestamp NULL DEFAULT NULL,
  `jobStatus` int(100) NOT NULL DEFAULT 0,
  `jobSalary` int(100) NOT NULL,
  `jobRating` int(11) NOT NULL,
  `jobComment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hire_employee`
--

INSERT INTO `hire_employee` (`id`, `employeeEmail`, `employerEmail`, `servicePortfolioId`, `hireTime`, `jobStartTime`, `jobFinishTime`, `jobStatus`, `jobSalary`, `jobRating`, `jobComment`) VALUES
(8, 'tauhid132@gmail.com', 'abir@gmail.com', 4, '2022-05-04 13:59:27', '2022-04-22 16:22:26', NULL, 1, 0, 0, '0'),
(9, 'abir@gmail.com', 'tauhid132@gmail.com', 4, '2022-05-01 13:59:53', '2022-05-04 15:20:00', '2022-05-20 12:59:00', 2, 0, 5, 'Very Good Job'),
(10, 'abir@gmail.com', 'tauhid132@gmail.com', 4, NULL, '2022-04-22 16:23:59', '2022-05-20 12:59:00', 2, 0, 4, 'Very Impressive'),
(31, 'abir@gmail.com', 'tauhid132@gmail.com', 8, NULL, '2022-05-22 17:11:00', '2022-05-22 17:11:00', 2, 0, 5, 'He has done a very good job. '),
(32, 'shohan@gmail.com', 'tauhid132@gmail.com', 6, '2022-05-01 15:25:49', '2022-05-06 15:24:00', NULL, 2, 0, 0, ''),
(33, 'abir@gmail.com', 'abir@gmail.com', 3, NULL, '2022-04-23 05:34:34', NULL, 0, 0, 0, ''),
(35, 'abir@gmail.com', 'tauhid132@gmail.com', 4, '2022-05-04 16:15:03', NULL, NULL, 0, 0, 0, ''),
(36, 'abir@gmail.com', 'tauhid132@gmail.com', 4, '2022-05-04 16:15:30', NULL, NULL, 0, 0, 0, ''),
(40, 'shohan@gmail.com', 'tauhid132@gmail.com', 6, '2022-05-05 09:23:02', '2022-05-05 15:26:00', '2022-05-06 15:27:00', 1, 0, 4, 'He has Done a good job. I am impressed.\r\n'),
(42, 'shohan@gmail.com', 'tauhid132@gmail.com', 6, '2022-05-06 15:53:14', NULL, NULL, 0, 0, 0, ''),
(43, 'abir@gmail.com', 'tauhid132@gmail.com', 4, '2022-05-07 03:44:48', '2022-06-06 02:00:00', '2022-08-06 16:00:00', 2, 0, 5, 'Very good'),
(44, 'abir@gmail.com', 'tauhid132@gmail.com', 3, '2022-05-07 05:18:29', NULL, NULL, 0, 0, 4, 'Very Good job'),
(45, 'abir@gmail.com', 'tauhid132@gmail.com', 3, '2022-05-20 12:24:16', NULL, NULL, 0, 0, 0, ''),
(46, 'abir@gmail.com', 'tauhid132@gmail.com', 3, '2022-05-20 12:25:11', NULL, NULL, 0, 0, 0, ''),
(47, 'abir@gmail.com', 'rashedhossain@gmail.com', 8, '2022-05-22 18:58:08', NULL, NULL, 0, 0, 0, ''),
(48, 'abir@gmail.com', 'rashedhossain@gmail.com', 8, '2022-05-22 18:58:20', NULL, NULL, 0, 0, 0, ''),
(49, 'abir@gmail.com', 'rashedhossain@gmail.com', 8, '2022-05-22 18:58:45', NULL, NULL, 0, 0, 0, ''),
(50, 'abir@gmail.com', 'rashedhossain@gmail.com', 8, '2022-05-22 19:00:59', NULL, NULL, 0, 0, 0, ''),
(51, 'abir@gmail.com', 'rashedhossain@gmail.com', 8, '2022-05-22 19:01:05', NULL, NULL, 0, 0, 0, ''),
(52, 'abir@gmail.com', 'rashedhossain@gmail.com', 8, '2022-05-22 19:01:37', NULL, NULL, 0, 0, 0, ''),
(53, 'abir@gmail.com', 'rashedhossain@gmail.com', 8, '2022-05-22 19:02:13', NULL, NULL, 0, 0, 0, ''),
(54, 'shohan@gmail.com', 'rashedhossain@gmail.com', 6, '2022-05-22 19:10:03', '2022-05-21 19:21:00', '2022-05-23 19:22:00', 2, 0, 4, 'good'),
(55, 'shohan@gmail.com', 'rashedhossain@gmail.com', 6, '2022-05-22 19:15:42', NULL, NULL, 0, 0, 0, ''),
(56, 'abir@gmail.com', 'tauhid132@gmail.com', 4, '2022-05-23 03:13:24', NULL, NULL, 0, 0, 0, ''),
(57, 'abir@gmail.com', 'tauhid132@gmail.com', 4, '2022-05-23 03:13:26', NULL, NULL, 0, 0, 0, ''),
(58, 'abir@gmail.com', 'tauhid132@gmail.com', 4, '2022-05-23 03:13:32', NULL, NULL, 0, 0, 0, ''),
(59, 'abir@gmail.com', 'tauhid132@gmail.com', 4, '2022-05-23 03:16:37', NULL, NULL, 0, 0, 5, 'Very Good job'),
(60, 'abir@gmail.com', 'tauhid132@gmail.com', 4, '2022-05-23 03:19:51', NULL, NULL, 0, 0, 5, ''),
(61, 'mamun@gmail.com', 'tauhid132@gmail.com', 22, '2022-05-23 05:10:18', NULL, '2022-05-23 06:28:00', 2, 0, 3, 'Test Rating'),
(62, 'abir@gmail.com', 'tauhid132@gmail.com', 3, '2022-08-30 08:31:12', NULL, NULL, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `job_offers`
--

CREATE TABLE `job_offers` (
  `id` int(11) NOT NULL,
  `offeredBy` varchar(100) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `jobId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_offers`
--

INSERT INTO `job_offers` (`id`, `offeredBy`, `serviceId`, `timestamp`, `status`, `jobId`) VALUES
(2, 'tauhid132@gmail.com', 6, '2022-05-05 09:00:52', 1, 40),
(4, 'tauhid132@gmail.com', 6, '2022-05-06 15:46:29', 0, NULL),
(5, 'tauhid132@gmail.com', 4, '2022-05-07 03:43:55', 1, 59),
(7, 'rashedhossain@gmail.com', 6, '2022-05-22 19:07:49', 1, 55),
(8, 'tauhid132@gmail.com', 4, '2022-05-23 03:19:34', 1, 60),
(9, 'tauhid132@gmail.com', 4, '2022-05-23 03:20:03', 2, NULL),
(10, 'tauhid132@gmail.com', 22, '2022-05-23 05:10:12', 1, 61),
(11, 'tauhid132@gmail.com', 8, '2022-08-23 08:15:11', 0, NULL),
(12, 'atstechnologybd@gmail.com', 16, '2022-08-23 08:29:20', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_payments`
--

CREATE TABLE `job_payments` (
  `id` int(11) NOT NULL,
  `jobId` int(11) NOT NULL,
  `payAmount` int(11) NOT NULL,
  `payTimestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `payMethod` varchar(100) NOT NULL,
  `trxId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_payments`
--

INSERT INTO `job_payments` (`id`, `jobId`, `payAmount`, `payTimestamp`, `payMethod`, `trxId`) VALUES
(17, 44, 1000, '2022-05-14 05:36:43', 'bkash', ''),
(18, 46, 1000, '2022-05-20 16:25:27', 'Nagad', ''),
(20, 46, 1000, '2022-05-20 16:51:03', 'Nagad', ''),
(21, 46, 1000, '2022-05-20 16:52:42', 'Nagad', ''),
(22, 43, 200, '2022-05-21 05:01:10', 'Nagad', ''),
(23, 46, 1000, '2022-05-21 05:46:30', 'Nagad', ''),
(24, 43, 200, '2022-05-21 05:47:10', 'Nagad', ''),
(25, 53, 500, '2022-05-22 19:04:57', 'bkash', ''),
(26, 54, 500, '2022-05-22 19:12:46', 'Nagad', ''),
(27, 61, 700, '2022-05-23 05:11:00', 'Nagad', ''),
(28, 61, 700, '2022-09-06 07:10:18', 'bkash', ''),
(29, 60, 200, '2022-09-06 07:40:39', 'bkash', ''),
(30, 59, 200, '2022-09-13 08:18:47', 'bkash', ''),
(31, 58, 200, '2022-09-13 09:05:19', 'bkash', '');

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

CREATE TABLE `job_posts` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `jobStatus` int(11) NOT NULL DEFAULT 0,
  `email` varchar(100) NOT NULL,
  `jobTitle` varchar(100) NOT NULL,
  `serviceCategory` varchar(100) NOT NULL,
  `jobDescription` varchar(1000) NOT NULL,
  `jobWorkingType` varchar(100) NOT NULL,
  `jobExperience` varchar(100) NOT NULL,
  `jobDeadline` varchar(100) NOT NULL,
  `jobSalary` varchar(100) NOT NULL,
  `jobSalaryMethod` varchar(100) NOT NULL,
  `postedOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`id`, `status`, `jobStatus`, `email`, `jobTitle`, `serviceCategory`, `jobDescription`, `jobWorkingType`, `jobExperience`, `jobDeadline`, `jobSalary`, `jobSalaryMethod`, `postedOn`) VALUES
(2, 1, 1, 'tauhid132@gmail.com', 'Web Developer', 'Electrician', 'I need a web developer, Who can design a webpage in HTML AND PHP.', 'Online', '0-1 Years', '2022-04-16', '1000', 'Per Service', '2022-05-13 14:33:25'),
(6, 1, 1, 'tauhid132@gmail.com', 'Logo Designer', 'Graphics Designer', 'I need a worker to design my logo', 'Online', '0-1 Years', '2022-05-08', '100', 'Per Service', '2022-05-13 14:33:25'),
(8, 1, 1, 'rashedhossain@gmail.com', 'Graphics Designer', 'Graphics Designer', 'I want a designer.', 'Online', '0-1 Years', '2022-05-26', '110', 'Per Hour', '2022-05-22 18:18:36'),
(9, 1, 0, 'khan@gmail.com', 'iOS app developer', 'iOS apps developer', 'I need a iOS app developer.', 'Online', '0-1 Years', '2022-06-01', '25000', 'Per Service', '2022-05-23 04:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `senderEmail` varchar(100) NOT NULL,
  `receiverEmail` varchar(100) NOT NULL,
  `text` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `seen` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `senderEmail`, `receiverEmail`, `text`, `timestamp`, `seen`) VALUES
(107, 'tauhid132@gmail.com', 'abir@gmail.com', 'hi', '2022-08-30 08:25:44', 0),
(108, 'abir@gmail.com', 'tauhid132@gmail.com', 'hello', '2022-08-30 08:25:59', 0),
(109, 'tauhid132@gmail.com', 'abir@gmail.com', 'hi', '2022-09-13 08:13:20', 0),
(110, 'tauhid132@gmail.com', 'abir@gmail.com', '', '2022-09-13 08:13:23', 0),
(111, 'tauhid132@gmail.com', 'abir@gmail.com', 'hi . i want to hire you', '2022-09-13 08:13:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notification` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `seen` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `email`, `notification`, `timestamp`, `seen`) VALUES
(1, 'abir@gmail.com', 'Your Profile Created Successfully.', '2022-05-06 07:03:12', 0),
(2, 'shohan@gmail.com', 'You Have Got New Job Proposal', '2022-05-06 15:46:29', 0),
(4, 'shohan@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-06 15:53:14', 0),
(7, 'tauhid132@gmail.com', 'A new aplicant apply for your Job Post.', '2022-05-06 16:06:43', 0),
(8, 'abir@gmail.com', 'You Have Got New Job Proposal', '2022-05-07 03:43:55', 0),
(9, 'tauhid132@gmail.com', 'A new aplicant apply for your Job Post.', '2022-05-07 03:54:00', 0),
(10, 'tauhid132@gmail.com', 'A new aplicant apply for your Job Post.', '2022-05-07 05:17:25', 0),
(11, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-07 05:18:29', 0),
(12, 'tauhid132@gmail.com', 'A new aplicant apply for your Job Post.', '2022-05-18 18:46:58', 0),
(13, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-20 12:24:16', 0),
(14, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-20 12:25:11', 0),
(15, '', 'Payment Received Successfully for JOB-ID: 46', '2022-05-20 16:51:03', 0),
(16, 'abir@gmail.com', 'Payment Received Successfully for JOB-ID: 46', '2022-05-20 16:52:42', 0),
(17, 'abir@gmail.com', 'Payment Received Successfully for JOB-ID: 43', '2022-05-21 05:01:10', 0),
(18, 'abir@gmail.com', 'Payment Received Successfully for JOB-ID: 46', '2022-05-21 05:46:30', 0),
(19, 'abir@gmail.com', 'Payment Received Successfully for JOB-ID: 43', '2022-05-21 05:47:10', 0),
(20, 'rashedhossain@gmail.com', 'A new aplicant apply for your Job Post.', '2022-05-22 18:56:55', 0),
(21, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-22 18:58:08', 0),
(22, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-22 18:58:20', 0),
(23, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-22 18:58:45', 0),
(24, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-22 19:00:59', 0),
(25, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-22 19:01:05', 0),
(26, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-22 19:01:37', 0),
(27, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-05-22 19:02:13', 0),
(28, 'shohan@gmail.com', 'You Have Got New Job Proposal', '2022-05-22 19:07:44', 0),
(29, 'shohan@gmail.com', 'You Have Got New Job Proposal', '2022-05-22 19:07:49', 0),
(30, 'shohan@gmail.com', 'Payment Received Successfully for JOB-ID: 54', '2022-05-22 19:12:46', 0),
(31, 'rashedhossain@gmail.com', 'shohan@gmail.com accepted Your Job Proposal!!', '2022-05-22 19:15:42', 0),
(32, 'tauhid132@gmail.com', 'abir@gmail.com accepted Your Job Proposal!!', '2022-05-23 03:13:25', 0),
(33, 'tauhid132@gmail.com', 'abir@gmail.com accepted Your Job Proposal!!', '2022-05-23 03:13:26', 0),
(34, 'tauhid132@gmail.com', 'abir@gmail.com accepted Your Job Proposal!!', '2022-05-23 03:13:32', 0),
(35, 'tauhid132@gmail.com', 'abir@gmail.com accepted Your Job Proposal!!', '2022-05-23 03:16:37', 0),
(36, 'abir@gmail.com', 'You Have Got New Job Proposal', '2022-05-23 03:19:34', 0),
(37, 'tauhid132@gmail.com', 'abir@gmail.com accepted Your Job Proposal!!', '2022-05-23 03:19:51', 0),
(38, 'abir@gmail.com', 'You Have Got New Job Proposal', '2022-05-23 03:20:03', 0),
(39, 'tauhid132@gmail.com', 'A new aplicant apply for your Job Post.', '2022-05-23 03:30:16', 0),
(40, 'rashedhossain@gmail.com', 'A new aplicant apply for your Job Post.', '2022-05-23 04:05:02', 0),
(41, 'mamun@gmail.com', 'You Have Got New Job Proposal', '2022-05-23 05:10:12', 0),
(42, 'tauhid132@gmail.com', 'mamun@gmail.com accepted Your Job Proposal!!', '2022-05-23 05:10:19', 0),
(43, 'mamun@gmail.com', 'Payment Received Successfully for JOB-ID: 61', '2022-05-23 05:11:00', 0),
(44, 'abir@gmail.com', 'You Have Got New Job Proposal', '2022-08-23 08:15:11', 0),
(45, 'abir@gmail.com', 'You Have Got New Job Proposal', '2022-08-23 08:29:20', 0),
(46, 'tauhid132@gmail.com', 'A new aplicant apply for your Job Post.', '2022-08-30 07:33:37', 0),
(47, 'tauhid132@gmail.com', 'A new aplicant apply for your Job Post.', '2022-08-30 08:25:13', 0),
(48, 'abir@gmail.com', 'Congratulations!! You application accepted and you are hired!!', '2022-08-30 08:31:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `operation_area`
--

CREATE TABLE `operation_area` (
  `id` int(11) NOT NULL,
  `policeStation` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `division` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operation_area`
--

INSERT INTO `operation_area` (`id`, `policeStation`, `city`, `division`, `country`) VALUES
(1, 'All Over World', 'Dhaka', 'Dhaka', 'Bangladesh'),
(2, 'Rampura', 'Dhaka', 'Dhaka', 'Bangladesh'),
(4, 'Banani', 'Dhaka', '', ''),
(6, 'Uttara', 'Dhaka', '', ''),
(8, 'Gulshan-1', 'Dhaka', '', ''),
(10, 'Dhanmondi', 'Dhaka', '', ''),
(11, 'Mirpur', 'Dhaka', '', ''),
(12, 'Khilgaon', 'Dhaka', '', ''),
(13, 'Badda', 'Dhaka', '', ''),
(14, 'Gazipur', 'Dhaka', '', ''),
(15, 'Mogbazar', 'Dhaka', '', ''),
(16, 'Azimpur', 'Dhaka', '', ''),
(17, 'Banglamotor', 'Dhaka', '', ''),
(18, 'Basundhara R/A', 'Dhaka', '', ''),
(19, 'Kalabagan', 'Dhaka', '', ''),
(20, 'Mohakhali', 'Dhaka', '', ''),
(21, 'Savar', 'Dhaka', '', ''),
(22, 'Kuril', 'Dhaka', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_image`
--

CREATE TABLE `portfolio_image` (
  `id` int(11) NOT NULL,
  `portfolioId` int(11) NOT NULL,
  `imageLink` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfolio_image`
--

INSERT INTO `portfolio_image` (`id`, `portfolioId`, `imageLink`) VALUES
(17, 3, 'ac.png'),
(18, 3, 'car.png'),
(19, 8, 'Capture.PNG'),
(20, 8, 'pda.PNG'),
(21, 8, 'pda2.PNG'),
(22, 17, 'sample1_back.jpg'),
(23, 17, 'sample1_front.jpg'),
(27, 21, 'sample1_back.jpg'),
(28, 21, 'sample1_front.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` int(11) NOT NULL,
  `catName` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `imageLink` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `catName`, `description`, `status`, `imageLink`) VALUES
(1, 'Electrician', '', 1, 'upload/cat-image/electrician.png'),
(2, 'Graphics Designer', '', 1, 'upload/cat-image/graphic-designer.png'),
(7, 'Web Developer', '', 1, 'upload/cat-image/coding.png'),
(8, 'AC Servicing', '', 1, 'upload/cat-image/ac.png'),
(9, 'Plumber', '', 1, 'upload/cat-image/plumbering.png'),
(10, 'Car Servicing', '', 1, 'upload/cat-image/car.png'),
(11, 'Interior Design', '', 1, 'upload/cat-image/interior-design.png'),
(13, 'Android apps developer', '', 1, 'upload/cat-image/android.png'),
(14, 'iOS apps developer', '', 1, 'upload/cat-image/app-store.png'),
(15, 'Software Developer', '', 1, 'upload/cat-image/web-development.png'),
(16, 'Construction Worker', '', 1, 'upload/cat-image/construction.png');

-- --------------------------------------------------------

--
-- Table structure for table `service_portfolio`
--

CREATE TABLE `service_portfolio` (
  `id` int(11) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `service_name` varchar(100) NOT NULL,
  `service_description` varchar(1000) NOT NULL,
  `service_working_type` varchar(100) NOT NULL,
  `service_salary` varchar(100) NOT NULL,
  `service_salary_method` varchar(100) NOT NULL,
  `service_experience` varchar(100) NOT NULL,
  `service_category` varchar(100) NOT NULL,
  `service_area` varchar(100) NOT NULL,
  `create_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_portfolio`
--

INSERT INTO `service_portfolio` (`id`, `employee_email`, `status`, `service_name`, `service_description`, `service_working_type`, `service_salary`, `service_salary_method`, `service_experience`, `service_category`, `service_area`, `create_timestamp`) VALUES
(3, 'abir@gmail.com', 1, 'Web Development', 'I am a professional Web Developer, I can design HTML, CSS & PHP pages and projects', 'Online', '1000', 'Per Hour', 'level7', 'Web Developer', 'Rampura', '2022-04-19 16:29:32'),
(4, 'abir@gmail.com', 1, 'AC Servicing', 'AC Servicing, Gas Refilling, Colling Problem Solution', 'Offline', '200', 'Per Service', 'level2', 'Job2', '', '2022-04-19 16:29:32'),
(6, 'shohan@gmail.com', 1, 'Search Engine Optimization', 'SEO, Outreach, Onpage Off page SEO Service Expert', 'Online', '500', 'Per Hour', 'level2', 'Graphics Designer', 'All Over World', '2022-04-20 19:05:04'),
(8, 'abir@gmail.com', 1, 'Graphics Design', 'I can design images, banners, logo, brochures, vectors using Illustrator and photoshop', 'Online', '500', 'Per Service', '0-1 Years', 'Graphics Designer', 'Mohakhali DOHS,Rampura,Banani', '2022-04-22 18:41:15'),
(16, 'abir@gmail.com', 1, 'Wordpress Template Design', 'I can design any type of wordpress templates using Divi and Elementor Pro.', 'Online', '500', 'Per Service', '0-1 Years', 'Web Developer', 'All Over World', '2022-05-04 19:42:05'),
(17, 'shohan@gmail.com', 1, 'SEO Outreach', 'I will do SEO outreach', 'Online', '100', 'Per Service', '0-1 Years', 'Web Developer', '', '2022-05-22 03:19:10'),
(21, 'shohan@gmail.com', 0, 'test', 'eed', 'Online', '100', 'Per Hour', '0-1 Years', 'AC Servicing', 'Rampura', '2022-05-22 15:07:11'),
(22, 'mamun@gmail.com', 1, 'রাজমিস্ত্রী', 'সকল ধরনের বিল্ডিং কন্সট্রাকশনের কাজ', 'Offline', '700', 'Per Day', '0-1 Years', 'Construction Worker', 'Gulshan-1,Dhanmondi,Mirpur,Khilgaon,Badda,Gazipur,Mogbazar,Azimpur,Banglamotor', '2022-05-23 05:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `siteName` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `enableApi` int(11) NOT NULL,
  `enableAutoUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `siteName`, `link`, `enableApi`, `enableAutoUser`) VALUES
(1, 'Work For All', 'http://localhost/project', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `tokenNo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`tokenNo`, `email`, `status`) VALUES
('09d8f334d2035e2ae01dadb0336f53c183b87a5e', 'abir@gmail.com', 1),
('13afec2b0a893aea2ca23265185a364f14ae784d', 'tauhid132@gmail.com', 0),
('22ad5a64189835deffca1f45ee79a6dcd80ac2d1', 'tauhid132@gmail.com', 0),
('7f083c9d10657980b4a3bcb1c8e52a5f6c691140', 'tauhid132@gmail.com', 0),
('80d867449fc592f894b7019b243d08f75dde96d0', 'tauhid132@gmail.com', 0),
('8504f60f1b02828671dd152569c6643377f83e01', 'tauhid132@gmail.com', 1),
('893a387cfc1bf4b75ab9c1ba8f9e893d13bdd9e0', 'tauhid132@gmail.com', 0),
('9e73f539f45fa98d28daca5af11c487ccd6e1c73', 'tauhid132@gmail.com', 0),
('9f816c9cedafb9dae286a31b94c38d576cc1f650', 'tauhid132@gmail.com', 1),
('a11c6e01241c49d1ffa0e61a7f2fbe99d77b3a45', 'tauhid132@gmail.com', 1),
('a86785611ca67e9a36a11d796e02857372018b35', 'tauhid132@gmail.com', 1),
('b3139ede89ddd032635676992480adea4fc595d3', 'tauhid132@gmail.com', 0),
('b845da0f76a272fea5627c88d447a42faecd6f8c', 'tauhid132@gmail.com', 0),
('b90453c73b533e3968de159417cedefa1aab4d4b', 'tauhid132@gmail.com', 0),
('c19c63d1ddf80b105f50dffe10db3d5306a7eb48', 'tauhid132@gmail.com', 1),
('c7addd9b1d230f4b44598bcc27f23be4648dfda1', 'tauhid132@gmail.com', 1),
('c90d8e1325ba5b3df41bff5ca252b92f77a1f95b', 'tauhid132@gmail.com', 0),
('da59ca345f01838c3a048d7a701d5d4a3044eadf', 'tauhid132@gmail.com', 1),
('f849078b0cf34c569a70cb2d6504e0b44aeab4fe', 'abir@gmail.com', 1),
('fad5c4006f82f63f97fe144374b8287825992004', 'tauhid132@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_balance`
--

CREATE TABLE `transfer_balance` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `transferAmount` int(100) NOT NULL,
  `transferMethod` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer_balance`
--

INSERT INTO `transfer_balance` (`id`, `email`, `transferAmount`, `transferMethod`, `status`, `timestamp`) VALUES
(1, 'abir@gmail.com', 100, 'bkash', 1, '2022-05-20 17:21:55'),
(2, 'abir@gmail.com', 1000, 'bkash', 1, '2022-05-21 05:02:45'),
(3, 'abir@gmail.com', 1000, 'Nagad', 1, '2022-05-21 05:48:26'),
(4, 'abir@gmail.com', 100, 'bkash', 1, '2022-05-23 04:12:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apply_job`
--
ALTER TABLE `apply_job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_id` (`jobPostId`),
  ADD KEY `fk_email_post` (`applicantEmail`),
  ADD KEY `fk_servicePort` (`serviceId`);

--
-- Indexes for table `bkash_otp`
--
ALTER TABLE `bkash_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookmark_service_portfolio`
--
ALTER TABLE `bookmark_service_portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`emailAddress`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`emailAddress`);

--
-- Indexes for table `hire_employee`
--
ALTER TABLE `hire_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`employeeEmail`),
  ADD KEY `fk2` (`employerEmail`);

--
-- Indexes for table `job_offers`
--
ALTER TABLE `job_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_of_by` (`offeredBy`),
  ADD KEY `fk_se_id` (`serviceId`),
  ADD KEY `job_id_fk` (`jobId`);

--
-- Indexes for table `job_payments`
--
ALTER TABLE `job_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job` (`jobId`);

--
-- Indexes for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_fk` (`email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sender2` (`senderEmail`),
  ADD KEY `fk_rec2` (`receiverEmail`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operation_area`
--
ALTER TABLE `operation_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_image`
--
ALTER TABLE `portfolio_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_port` (`portfolioId`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `catName` (`catName`);

--
-- Indexes for table `service_portfolio`
--
ALTER TABLE `service_portfolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pm_email` (`employee_email`),
  ADD KEY `fk_cat_port` (`service_category`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`tokenNo`);

--
-- Indexes for table `transfer_balance`
--
ALTER TABLE `transfer_balance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `apply_job`
--
ALTER TABLE `apply_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bkash_otp`
--
ALTER TABLE `bkash_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `bookmark_service_portfolio`
--
ALTER TABLE `bookmark_service_portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hire_employee`
--
ALTER TABLE `hire_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `job_offers`
--
ALTER TABLE `job_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `job_payments`
--
ALTER TABLE `job_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `job_posts`
--
ALTER TABLE `job_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `operation_area`
--
ALTER TABLE `operation_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `portfolio_image`
--
ALTER TABLE `portfolio_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `service_portfolio`
--
ALTER TABLE `service_portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfer_balance`
--
ALTER TABLE `transfer_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply_job`
--
ALTER TABLE `apply_job`
  ADD CONSTRAINT `fk_email_post` FOREIGN KEY (`applicantEmail`) REFERENCES `employee` (`emailAddress`),
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`jobPostId`) REFERENCES `job_posts` (`id`),
  ADD CONSTRAINT `fk_servicePort` FOREIGN KEY (`serviceId`) REFERENCES `service_portfolio` (`id`);

--
-- Constraints for table `job_offers`
--
ALTER TABLE `job_offers`
  ADD CONSTRAINT `fk_of_by` FOREIGN KEY (`offeredBy`) REFERENCES `employer` (`emailAddress`),
  ADD CONSTRAINT `fk_se_id` FOREIGN KEY (`serviceId`) REFERENCES `service_portfolio` (`id`),
  ADD CONSTRAINT `job_id_fk` FOREIGN KEY (`jobId`) REFERENCES `hire_employee` (`id`);

--
-- Constraints for table `job_payments`
--
ALTER TABLE `job_payments`
  ADD CONSTRAINT `fk_job` FOREIGN KEY (`jobId`) REFERENCES `hire_employee` (`id`);

--
-- Constraints for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD CONSTRAINT `email_fk` FOREIGN KEY (`email`) REFERENCES `employer` (`emailAddress`);

--
-- Constraints for table `portfolio_image`
--
ALTER TABLE `portfolio_image`
  ADD CONSTRAINT `fk_id_port` FOREIGN KEY (`portfolioId`) REFERENCES `service_portfolio` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
