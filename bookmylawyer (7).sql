-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2025 at 04:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookmylawyer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  `section` varchar(50) DEFAULT NULL,
  `case_details` text DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending',
  `lawyer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `date`, `time`, `section`, `case_details`, `pdf_file`, `created_at`, `status`, `lawyer_id`, `user_id`) VALUES
(1, 'Hari', '2025-07-09', '12:30:00', 'IPC 302', 'Murder case', 'uploads/686deb755a7bc_kehb115.pdf', '2025-07-08 22:39:25', 'Accepted', 5, 0),
(2, 'Hari', '2025-07-09', '12:30:00', 'IPC 302', 'Murder case', 'uploads/686debfaf3ab4_kehb115.pdf', '2025-07-08 22:41:38', 'Rejected', 5, 0),
(3, 'Harish Hari', '2025-07-10', '15:01:00', 'Sec677', 'posco', 'uploads/686f88c8ca61a_case_document.pdf', '2025-07-10 04:02:56', 'Accepted', 5, 0),
(4, 'John Doe', '2025-07-15', '10:30 AM', 'IPC 498A', 'Dowry harassment case with documents attached.', 'uploads/6870ca5cc50c1_kehb115.pdf', '2025-07-11 02:55:00', 'Rejected', 5, 1),
(5, 'Harish Hari', '2025-07-14', '08:47', 'ipc30', 'child Marry ', 'uploads/687476c64c266_case_document.pdf', '2025-07-13 21:47:26', 'Accepted', 5, 0),
(6, 'John Doe', '2025-07-15', '10:30 AM', 'IPC 498A', 'Dowry harassment case with documents attached.', 'uploads/6874c42b719c8_kehb115.pdf', '2025-07-14 03:17:39', 'Accepted', 5, 1),
(7, 'stgaysg', '2025-07-14', '14:32', 'gshs', 'hhwk', 'uploads/6874c79c1bcd3_case_document.pdf', '2025-07-14 03:32:20', 'Accepted', 5, 0),
(8, 'vedha', '2025-07-14', '14:50', 'sec 77 ', 'race drive ', 'uploads/6874cbb89c5aa_case_document.pdf', '2025-07-14 03:49:52', 'Rejected', 5, 0),
(9, 'Harish Hari', '2025-07-14', '15:48', 'section ', 'bns', 'uploads/6874d97f183db_case_document.pdf', '2025-07-14 04:48:39', 'Pending', 0, 0),
(10, 'Hari', '2025-07-09', '12:30', 'IPC 302', 'Murder case', '', '2025-07-17 07:46:01', 'Pending', 5, 0),
(11, 'Hari', '2025-07-09', '12:30', 'IPC 302', 'Murder case', '', '2025-07-18 08:17:35', 'Accepted', 6, 0),
(12, 'Harish Hari', '2025-07-18', '13:52', 'section 67e ', 'harassment.', 'uploads/687a0434aedbd_case_document.pdf', '2025-07-18 08:22:12', 'Accepted', 6, 1),
(13, 'Harish Hari', '2025-07-18', '14:02', 'sceb6', 'fun', 'uploads/687a069c6156f_case_document.pdf', '2025-07-18 08:32:28', 'Accepted', 1, 1),
(14, 'Harish Hari', '2025-07-21', '09:59', 'section 67e ', 'murder case ', '', '2025-07-21 04:30:50', 'Pending', 19, 6),
(15, 'Harish Hari', '2025-07-21', '11:29', 'section 77', 'no 45 govidhaa street ', 'uploads/687dd7519fe1d_case_document.pdf', '2025-07-21 05:59:45', 'Pending', -1, 6),
(16, 'Harish Hari', '2025-07-21', '11:29', 'section 77', 'no 45 govidhaa street ', 'uploads/687dd760c3502_case_document.pdf', '2025-07-21 06:00:00', 'Pending', -1, 6),
(17, 'Harish Hari', '2025-07-21', '11:43', 'Sec 76', 'murder ', 'uploads/687ddaa8c52bd_case_document.pdf', '2025-07-21 06:14:00', 'Pending', -1, 1),
(18, 'Harish Hari', '2025-07-21', '11:54', 'sec 77', 'murder ', 'uploads/687ddd1fd8e25_case_document.pdf', '2025-07-21 06:24:31', 'Pending', -1, 1),
(19, 'Harish Hari', '2025-07-26', '10:22', 'section 67e ', 'murder ', 'uploads/68845f0718f42_case_document.pdf', '2025-07-26 04:52:23', 'Pending', 1, 1),
(20, 'Harish Hari', '2025-07-26', '10:22', 'section 67e ', 'murder ', 'uploads/68845f103824f_case_document.pdf', '2025-07-26 04:52:32', 'Pending', 1, 1),
(21, 'Harish Hari', '2025-07-26', '11:07', 'section 67e ', 'race druve6', 'uploads/6884698c18c8d_case_document.pdf', '2025-07-26 05:37:16', 'Accepted', 9, 1),
(22, 'Harish Hari', '2025-07-26', '11:38', 'section 65', 'race drive ', 'uploads/688470d6bec94_case_document.pdf', '2025-07-26 06:08:22', 'Accepted', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `case_responses`
--

CREATE TABLE `case_responses` (
  `id` int(11) NOT NULL,
  `applicant` varchar(255) DEFAULT NULL,
  `response_text` text DEFAULT NULL,
  `posted_by` varchar(255) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `lawyer_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `submitted_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case_responses`
--

INSERT INTO `case_responses` (`id`, `applicant`, `response_text`, `posted_by`, `document_path`, `lawyer_id`, `user_id`, `submitted_at`, `created_at`) VALUES
(1, 'John Doe', 'This is the response to the case.', 'Lawyer Raj', '', '', '1', '2025-07-09 00:02:27', '2025-07-09 01:07:44'),
(2, 'John Doe', 'This is the response to the case.', 'Lawyer Raj', '', '', '', '2025-07-09 00:29:17', '2025-07-09 01:07:44'),
(3, 'John Doe', 'This is the response to the case.', 'Lawyer Raj', '', '', '1', '2025-07-10 04:16:45', '2025-07-10 04:16:45'),
(4, 'John Doe', 'This is the response to the case.', 'Lawyer Raj', '', '', '', '2025-07-10 04:19:03', '2025-07-10 04:19:03'),
(5, 'John Doe', 'This is the response to the case.', 'Lawyer Raj', 'uploads/1752141600_image 2.png', '', '', '2025-07-10 04:30:00', '2025-07-10 04:30:00'),
(6, 'John Doe', 'This is the response to the case.', 'Lawyer Raj', 'uploads/1752141985_image 2.png', '', '', '2025-07-10 04:36:25', '2025-07-10 04:36:25'),
(7, 'harish', 'ghe', 'Harish Hari', 'uploads/1752142193_IMG-20250710-WA0000.jpg', '', '', '2025-07-10 04:39:53', '2025-07-10 04:39:53'),
(8, 'satys', 'gh', 'hhw', 'uploads/1752468708_Screenshot_20250714_080045.jpg', '', '', '2025-07-13 23:21:48', '2025-07-13 23:21:48'),
(9, 'satys', 'gh', 'hhw', 'uploads/1752468712_Screenshot_20250714_080045.jpg', '', '', '2025-07-13 23:21:52', '2025-07-13 23:21:52'),
(10, 'John Doe', 'This is the response to the case.', 'Lawyer Raj', '', '', '9', '2025-07-18 05:52:47', '2025-07-18 05:52:47'),
(11, 'John Doe', 'Your case will be reviewed.', 'Advocate Sharma', '', 'LAW123', 'USR456', '2025-07-21 04:43:20', '2025-07-21 04:43:20'),
(12, 'Chitra', 'your mental health issue child', 'Harish Hari', 'uploads/1753509609_IMG-20250726-WA0000.jpg', '9', '1', '2025-07-26 06:00:09', '2025-07-26 06:00:09'),
(13, 'Chitra', 'good morning', 'happy.', 'uploads/1753510216_IMG-20250726-WA0000.jpg', '2', '3', '2025-07-26 06:10:16', '2025-07-26 06:10:16'),
(14, 'Chitra', 'good morning', 'happy.', 'uploads/1753510219_IMG-20250726-WA0000.jpg', '2', '3', '2025-07-26 06:10:19', '2025-07-26 06:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `case_sections`
--

CREATE TABLE `case_sections` (
  `id` int(11) NOT NULL,
  `case_section` varchar(255) NOT NULL,
  `punishment_details` text NOT NULL,
  `suggested_lawyers` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case_sections`
--

INSERT INTO `case_sections` (`id`, `case_section`, `punishment_details`, `suggested_lawyers`, `created_at`) VALUES
(1, '	Section 498A', '	3 years imprisonment', 'tax lawyer', '2025-07-07 01:22:35'),
(2, 'Section 498A', '3 years imprisonment', 'tax laywer', '2025-07-07 03:13:22'),
(3, 'Section 498A', '3 years imprisonment', 'tax laywer', '2025-07-07 03:13:49'),
(11, 'Section 498759', '3 years imprisonment', 'tax laywer', '2025-07-09 00:58:01'),
(12, 'Section 498', '3 years imprisonment', 'civillaywer', '2025-07-09 00:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `lawyers`
--

CREATE TABLE `lawyers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `case_types` text DEFAULT NULL,
  `casefile` varchar(255) DEFAULT NULL,
  `university` varchar(150) DEFAULT NULL,
  `degree` varchar(50) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `case_type` varchar(100) DEFAULT NULL,
  `fee` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lawyers`
--

INSERT INTO `lawyers` (`id`, `first_name`, `last_name`, `contact`, `email`, `case_types`, `casefile`, `university`, `degree`, `year`, `address`, `city`, `zip`, `case_type`, `fee`, `created_at`) VALUES
(1, 'John', 'Doe', '9876543210', 'john@example.com', ' Civil lawyer', '', 'XYZ Law College', 'LLB', '2022', '123 Street, Court Lane', 'Chennai', '600001', 'Criminal', '3500', '2025-07-07 22:49:10'),
(2, 'Harish', 'Hari', '9362867846', 'harishselvakumar2004@gmail.com', 'Criminal matter, Civil matter', 'uploads/1751953035_Screenshot_20250707_204820.jpg', 'saveetha law ', 'BABL', '2022', 'no 45 govidhaa street.', 'Chennai ', '60077', '', '1000', '2025-07-08 00:07:15'),
(3, 'Harish', 'Hari', '9360286414', 'harishselvakumar2004@gmail.com', 'Criminal matter, null', 'uploads/1751953694_Screenshot_20250707_204820.jpg', 'saveetha law ', 'BABL', '2004', 'benn', 'j', 'v', '', '66', '2025-07-08 00:18:14'),
(4, 'Harish', 'Hari', '96328741251', 'harishselvakumar2004@gmail.com', 'Criminal matter, null', 'uploads/1751966086_Screenshot_20250707_204808.jpg', 'saveetha law ', 'LLB', '2004', 'hjj', 'che', '600077', '', '800', '2025-07-08 03:44:46'),
(5, 'John', 'Doe', '9876543211', 'john.doe1@example.com', 'Criminal, Civil', '', 'Harvard University', 'LLB', '2015', '123 Main Street', 'Chennai', '600001', 'Divorce', '2000', '2025-07-09 00:53:57'),
(6, 'John', 'don', '9876543251', 'john2@example.com', 'Criminal lawyer, Civil lawyer', '', 'XYZ Law College', 'LLB', '2022', '123 Street, Court Lane', 'Chennai', '600001', 'civil lawyer', '3500', '2025-07-09 01:25:28'),
(7, 'harish', 'Hari', '9632587101', 'g@gmail.com', 'Criminal lawyer, null, null, null', 'uploads/1752044347_Screenshot_20250708_213546.jpg', 'savere', 'BABL', '2008', 'hj', 'gh', '600077', 'Criminal lawyer', '500', '2025-07-09 01:29:07'),
(8, 'harish', 'don', '9876543256', 'john2f@example.com', 'Criminal lawyer, Civil lawyer', '', 'XYZ Law College', 'LLB', '2022', '123 Street, Court Lane', 'Chennai', '600001', 'civil lawyer', '3500', '2025-07-09 02:50:47'),
(9, 'Test', 'CivilLawyer', '9999999999', 'civil@example.com', 'Civil Case', 'uploads/sample.pdf', 'ABC Law College', 'LLB', '2020', 'Street 123', 'Chennai', '600001', 'Civil', '1000', '2025-07-09 03:08:02'),
(10, 'Priya', 'Mehta', '9998887770', 'familylaw@example.com', 'Family Matters', 'uploads/sample.pdf', 'Law University', 'LLB', '2018', 'MG Road', 'Mumbai', '400001', 'Family', '1200', '2025-07-09 03:11:55'),
(11, 'Anjali', 'Patel', '9876501234', 'divorce.law@example.com', 'Divorce, Family', 'uploads/sample.pdf', 'Delhi Law College', 'LLB', '2017', 'Ring Road', 'Delhi', '110002', 'Divorce', '1800', '2025-07-09 03:15:37'),
(26, 'sathya', 'Priya', '8521479630', 'sathaya@gmail.com', 'Criminal lawyer, Civil lawyer, null, divroce lawyer', 'uploads/1752052900_Snapchat-1260774086.jpg', 'srm', 'BABL', '2002', 'ghsjshoojgi', 'city', '777779', 'Criminal lawyer', '800', '2025-07-09 03:51:40'),
(27, 'Sathish', 'app', '9658741230', 'sat@gmail.com', 'Criminal lawyer, null, null, null', 'uploads/1752137900_IMG_20250710_100919.jpg', 'saveetha law', 'BALB', '2004', '45 b Nagar', 'Chennai', '600770', 'Criminal lawyer', '500', '2025-07-10 03:28:20'),
(28, 'Harish', 'Hari', '9632587410', 'harish@gmail.com', 'null, null, null, divroce lawyer', 'uploads/1752824341_IMG_20250715_213108.jpg', 'saveetha law.', 'BALB', '2004', 'no 45 b tech Street sundharacholapuram', 'Chennai', '600077', 'null', '2000', '2025-07-18 07:39:01'),
(29, 'John', 'don', '9876000211', 'priya@gmail.com', 'Criminal matter, Civil matter', '', 'XYZ Law College', 'LLB', '2022', '123 Street, Court Lane', 'Chennai', '600001', 'Criminal', '3500', '2025-07-21 05:56:01'),
(30, 'Dhanush', 's', '7200495322', 'harini@gmail.com', 'Criminal lawyer, null, null, null', 'uploads/1753077445_IMG-20250721-WA0001.jpg', 'saveetha law', 'BALB', '2002', 'ni 57', 'Chennai.', '600077', 'Criminal lawyer', '200', '2025-07-21 05:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `lawyer_signup`
--

CREATE TABLE `lawyer_signup` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `plain_password` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lawyer_signup`
--

INSERT INTO `lawyer_signup` (`id`, `name`, `email`, `password`, `plain_password`, `created_at`) VALUES
(1, 'Hari', 'haffrissfs@mgmail.com', '$2y$10$ZOhsuvN3cPwdnTcCAxI3suh1Tmyw2BmcLW4Mo2JtD8K1te0ytd6fG', '123456', '2025-07-08 03:03:12'),
(2, 'Harish Hari', 'hel@gmail.com', '$2y$10$pbYA12NB6tyQ7R2ToizWw.98dXf/h8k7t7JKP3l7QdMW.7y2V0qUW', 'harish', '2025-07-08 22:44:20'),
(3, 'Harish Hari.', 'ishal@gmail.com', '$2y$10$Utdl7f2IzlLmIxCjVIgfeepHg2L4JxHWZwDH3xCQdciCQlXGbpX/O', '123456', '2025-07-08 23:44:45'),
(4, 'Advocate Priya', 'priya@example.com', '$2y$10$esTIT3r9em.SvykBzCEw3OVhO7zssqPLfEx1Fov3jEOeuvlqEhZNm', '123456', '2025-07-09 00:45:58'),
(5, 'sathya', 'sathya@gmail.com', '$2y$10$Q6R3qzck51UIotpvJfzUm.Yd9cIjjL8X0LlLVeED3WZrM9ejVNfRO', 'sathya', '2025-07-09 03:52:21'),
(6, 'Sathish', 'sat@gmail.com', '$2y$10$V/BNHjqOnouBtDSyHjGbt.Wp14SteUI0uUkEAnsdNn75.ZL3dzywS', 'sat', '2025-07-10 03:29:05'),
(7, 'Harish Hari', 'harish@gmail.com', '$2y$10$4umweoik9TdsHMxwyYjxj.c35R5BZW40KTxgS9Pq.DFbWTSwyMV6O', 'h', '2025-07-18 07:39:14'),
(8, 'dhanush', 'd2@gmail.com', '$2y$10$MNEyPv/9Xjbj6SKb6D0zy..R0IyqqWAxOwu81oSxixFDExEbz.vcq', 'd2', '2025-07-21 05:57:59'),
(9, 'Hari Haran', 'hari@example.com', '$2y$10$xa1ShwUt0HJMlEF1UcjRoOljxhG2XWC6vKWcKdHFaLoSl62jRZa8.', '123456', '2025-07-26 05:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `agreed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `city`, `zip`, `profile_image`, `agreed`, `created_at`, `user_id`) VALUES
(1, 'John', 'Doe', 'johndoe@example.com', '9876543210', '123 Main Street', 'Chennai', '600001', '', 1, '2025-07-09 03:28:37', 0),
(2, 'John', 'Doe', 'johndoe@example.com', '9876543210', '123 Main Street', 'Chennai', '600001', '', 1, '2025-07-09 03:28:51', 0),
(3, 'John', 'Doe', 'john.doe@example.com', '9876543210', '123 Street Name', 'Chennai', '600001', '', 1, '2025-07-23 06:00:26', 0),
(4, 'John', 'Doe', 'john.doe@example.com', '9876543210', '123 Street Name', 'Chennai', '600001', '', 1, '2025-07-23 06:02:32', 0),
(5, 'Harish', 'Hari', 'harishselvakumar2004@gmail.com', '9360286743', '45 bha', 'Chennai ', '600077', 'uploads/1753263364_IMG-20250712-WA0006.jpg', 1, '2025-07-23 09:36:04', 0),
(6, 'Harish', 'Hari', 'harishselvakumar2004@gmail.com', '9360286743', '45 bha', 'Chennai ', '600077', 'uploads/1753263372_IMG-20250712-WA0006.jpg', 1, '2025-07-23 09:36:12', 0),
(7, 'Harish', 'Hari', 'harishselvakumar2004@gmail.com', '9360286743', '45 bha', 'Chennai ', '600077', 'uploads/1753263374_IMG-20250712-WA0006.jpg', 1, '2025-07-23 09:36:14', 0),
(8, 'Harish', 'Hari', 'harishselvakumar2004@gmail.com', '9360286743', '45 bha', 'Chennai ', '600077', 'uploads/1753263374_IMG-20250712-WA0006.jpg', 1, '2025-07-23 09:36:14', 0),
(9, 'Harish', 'Hari', 'harishselvakumar2004@gmail.com', '9360286743', '45 bha', 'Chennai ', '600077', 'uploads/1753263402_IMG-20250712-WA0006.jpg', 1, '2025-07-23 09:36:42', 0),
(10, 'Harish', 'Hari', 'harishselvakumar2004@gmail.com', '9360286743', '45 bha', 'Chennai ', '600077', 'uploads/1753263507_IMG-20250712-WA0006.jpg', 1, '2025-07-23 09:38:27', 1),
(11, 'Harish', 'Hari', 'harishselvakumar2004@gmail.com', '9360286743', 'no 6 bajani Nagar.', 'Chennai ', '600077', '', 1, '2025-07-24 03:37:50', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_signup`
--

CREATE TABLE `user_signup` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `plain_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_signup`
--

INSERT INTO `user_signup` (`id`, `name`, `email`, `password`, `plain_password`, `created_at`) VALUES
(1, 'Advocate Priya', 'priya@example.com', '$2y$10$sQuQpeBid3f9F/.Lbg2dO.2EDTlHoblvrQuA21KCHfIYndR67aAXy', '123456', '2025-07-09 00:51:32'),
(2, 'sathya', 'sathyapriya@example.com', '$2y$10$4X4/.p9rJY6BvAQld0UOjOfcbUsnP9MW5nBObQmh.lZ3KHJbi3q.2', '123456', '2025-07-10 03:24:38'),
(3, 'dhanush', 'd@gmail.com', '$2y$10$vs4XNFaD05lxvjDmC2n9LuCyu7IrtsvhvlYK1UMvN.uVV02Iicy..', 'd', '2025-07-10 03:55:43'),
(4, 'Harish Hari', 'harishselvakumr2004@gmail.com', '$2y$10$Oh6xoivbjRSBkKGwHcusDuPBRf8Lh6wvyBX.0gmCEANrqC8XM9WW2', '123', '2025-07-13 21:59:28'),
(5, 'Sathish', 'sat@gmail.com', '$2y$10$DdlYZ3/FFxbtqfRRqles0ePwNf6IgY2mHHN2Q2.XWzaOy88c6m/SO', 'sat', '2025-07-14 03:37:33'),
(6, 'harini', 'harini@gmail.com', '$2y$10$xMeQzmLW8R9pMnYUKjFVD.H2Bc2l5b36wUFlLDZLS3QhzBtGBWlwa', '123', '2025-07-21 04:25:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case_responses`
--
ALTER TABLE `case_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case_sections`
--
ALTER TABLE `case_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lawyers`
--
ALTER TABLE `lawyers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lawyer_signup`
--
ALTER TABLE `lawyer_signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_signup`
--
ALTER TABLE `user_signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `case_responses`
--
ALTER TABLE `case_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `case_sections`
--
ALTER TABLE `case_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lawyers`
--
ALTER TABLE `lawyers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `lawyer_signup`
--
ALTER TABLE `lawyer_signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_signup`
--
ALTER TABLE `user_signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
