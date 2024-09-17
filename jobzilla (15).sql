-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 07:42 AM
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
-- Database: `jobzilla`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` bigint(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `phone`, `email`, `dob`, `gender`, `address`, `image`, `password`) VALUES
(1, 'Navitha', 'ponnaganti', 9154990721, 'navitha@gmail.com', '2000-08-18', 'Female', 'Bangalore', 'uploads/Navitha.jpg', 'Navi@1234');

-- --------------------------------------------------------

--
-- Table structure for table `applied_candidates`
--

CREATE TABLE `applied_candidates` (
  `id` int(11) NOT NULL,
  `jobid` int(11) NOT NULL,
  `candidateid` int(11) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `notice_period` varchar(50) DEFAULT NULL,
  `skill` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `employee_status` enum('Yes','No') DEFAULT 'No',
  `resume` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `job_role` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applied_candidates`
--

INSERT INTO `applied_candidates` (`id`, `jobid`, `candidateid`, `company`, `fullname`, `email`, `location`, `phone`, `source`, `experience`, `notice_period`, `skill`, `remarks`, `employee_status`, `resume`, `created_at`, `image`, `job_role`, `status`) VALUES
(1, 4, 3, 'Accenture', 'Madan Sangani', 'madan@gmail.com', 'Bengaluru', '9347307858', 'Careers', '2 years', '30 days', 'HTML, PHP, CSS', 'No remarks', 'No', 'Documents/Navitha_Resume.pdf', '2024-08-26 12:35:16', 'Documents/Navitha.JPG', 'Software Engineer', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `applied_jobs`
--

CREATE TABLE `applied_jobs` (
  `id` int(11) NOT NULL,
  `jobid` int(11) NOT NULL,
  `candidateid` int(11) NOT NULL,
  `title` varchar(10) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `experience_years` int(11) DEFAULT NULL,
  `experience_months` int(11) DEFAULT NULL,
  `notice_period` int(11) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `is_employee` enum('yes','no') DEFAULT 'no',
  `resume` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) DEFAULT 'pending',
  `country` varchar(255) NOT NULL,
  `job_category` varchar(255) NOT NULL,
  `skill` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applied_jobs`
--

INSERT INTO `applied_jobs` (`id`, `jobid`, `candidateid`, `title`, `first_name`, `last_name`, `email`, `phone`, `source`, `experience_years`, `experience_months`, `notice_period`, `remark`, `is_employee`, `resume`, `picture`, `created_at`, `updated_at`, `status`, `country`, `job_category`, `skill`) VALUES
(9, 33, 17, 'Mr', 'Navitha', 'ponnaganti', 'navitha@gmail.com', '915499072', 'company_career_page', 1, 1, 1, 'no', 'no', 'uploads/Navitha_Resume.pdf', 'uploads/Navitha.jpg', '2024-08-30 05:44:54', '2024-08-30 06:00:27', 'shortlisted', 'India', 'Web Development', 'html,css'),
(10, 14, 18, 'Mr', 'Thimmeswara', 'NAIDU', 'thimmeswarnaidu1@gmail.com', '9704884856', 'linkedin', 1, 2, 5, 'I have worked last six month as a application developer', 'no', 'uploads/RESUME FRESHER.pdf', 'uploads/back-2.jpg', '2024-09-02 08:08:24', '2024-09-02 08:13:41', 'shortlisted', 'India', 'Software Development', 'Html,css,javascript  React.js');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `job_count` int(11) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `current_job_title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `username`, `email_id`, `phone`, `job_count`, `contact_number`, `current_job_title`, `message`, `candidate_id`, `resume`, `status`, `created_at`) VALUES
(1, 'Venakata krishna', 'venkata@gmail.com', '8008284482', 1, '123-456-7890', 'Application devloper', 'hytgvrf', 9, 'Madan Final Resume-3 (1).pdf', 'Job Assigned', '2024-08-20 13:31:45'),
(3, 'ramu', 'Ramesh@gmail.com', '6300711125', 0, '123-456-7890', 'Application devloper', 'please  call me', 10, 'Madan Final Resume (1).pdf', 'Rejected', '2024-08-21 04:39:19'),
(4, 'Navitha', 'Navitha@gmail.com', '9704884856', 0, '123-456-7890', 'Application developer', 'hello', 7, 'Navitha_Resume.pdf', 'Book mark', '2024-08-21 05:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `qualification` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `job_category` varchar(255) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `current_salary` varchar(50) NOT NULL,
  `expected_salary` varchar(50) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `age` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `full_address` varchar(250) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `social_media` varchar(800) NOT NULL,
  `resume_headline` varchar(255) DEFAULT NULL,
  `skills` varchar(500) NOT NULL,
  `it_experience` varchar(1000) NOT NULL,
  `education_details` varchar(1000) NOT NULL,
  `projects` varchar(800) NOT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `functional_area` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `job_type` varchar(50) DEFAULT NULL,
  `employment_type` varchar(50) DEFAULT NULL,
  `desired_shift` varchar(100) DEFAULT NULL,
  `availability_to_join` date DEFAULT NULL,
  `desired_location` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `permanent_address` varchar(500) NOT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `hometown` varchar(255) DEFAULT NULL,
  `passport_number` varchar(20) DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `work_permit_of_other_country` varchar(50) DEFAULT NULL,
  `differently_abled` varchar(250) NOT NULL,
  `attach_resume` varchar(255) DEFAULT NULL,
  `profile_summary` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `candidates`
--
DELIMITER $$
CREATE TRIGGER `increment_candidates_count` AFTER INSERT ON `candidates` FOR EACH ROW BEGIN
    UPDATE companies
    SET candidates_count = candidates_count + 1
    WHERE id = NEW.company_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `candidates_details`
--

CREATE TABLE `candidates_details` (
  `candidate_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `naukari` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `job_type` enum('Full Time','Part Time','Freelance') DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `job_category` enum('IT_Software','Accountant','Bank_Services','Hospital') DEFAULT NULL,
  `experience` enum('Beginner','01 Years','02 Years','03 Years','04 Years','05 Years') DEFAULT NULL,
  `current_salary` enum('10-20 K','20-30 K','30-40 K','40-50 K') DEFAULT NULL,
  `expected_salary` enum('10-20 K','20-30 K','30-40 K','40-50 K') DEFAULT NULL,
  `age` enum('20','25','30','35') DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profileimage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidates_details`
--

INSERT INTO `candidates_details` (`candidate_id`, `username`, `phone`, `email_id`, `password`, `website`, `linkedin`, `github`, `naukari`, `role`, `job_type`, `qualification`, `languages`, `job_category`, `experience`, `current_salary`, `expected_salary`, `age`, `description`, `created_at`, `updated_at`, `profileimage`) VALUES
(3, 'Madan', '6300711126', 'madan123@gmail.com', 'Mahesh20@', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 11:45:34', '2024-08-15 11:45:34', ''),
(4, 'Thimmeswara', '6300711127', 'thimmeswarnaidu@gmail.com', 'Mahesh20@', 'https://thewebmax.com', 'https://www.linkedin.com/in/modupalli-thimmeswarnaidu-b409b1259/', 'https://github.com/ThimmeswarnaiduM/Tutorial_node', 'https://github.com/ThimmeswarnaiduM/Tutorial_node', 'Java Full stack Developer', 'Full Time', 'B.tech', 'English', 'IT_Software', 'Beginner', '10-20 K', '10-20 K', '', 'jkdhsakfhdkasgfuhsgyuew', '2024-08-15 11:50:18', '2024-08-20 07:47:58', 'images/jobs-company/vector-illustration-avatar-dummy-logo-collection-image-icon-stock-isolated-object-set-symbol-web-137160339.jpg'),
(7, 'Navitha', '9704884856', 'Navitha@gmail.com', 'Mahesh20@', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-16 04:35:28', '2024-08-16 04:35:28', 'images/jobs-company/Mahesh.jpeg'),
(8, 'Mounika', '9704884856', 'Mounika@gmail.com', 'mahesh20@', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-16 05:54:59', '2024-08-16 05:54:59', 'images/jobs-company/Avathar.jpeg'),
(9, 'Mohan', '9581082484', 'mohan@gmail.com', 'Mahesh20@', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-16 08:26:07', '2024-08-16 08:26:07', 'images/jobs-company/thimmeswarnaidu.jpg'),
(10, 'Madan Kumar', '6300711126', 'maheshmodupalli@gmail.com', 'Mahesh20@', 'https://thewebmax.com', 'https://www.linkedin.com/in/modupalli-thimmeswarnaidu-b409b1259/', 'https://github.com/ThimmeswarnaiduM/Tutorial_node', 'https://github.com/ThimmeswarnaiduM/Tutorial_node', 'Java Full stack Developer', 'Full Time', 'B.tech', 'English', 'IT_Software', 'Beginner', '10-20 K', '10-20 K', '', 'jksahfjkhsdhfdak', '2024-08-20 07:50:38', '2024-08-20 07:51:11', 'images/jobs-company/PASS_PHOTO.jpg'),
(11, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-23 04:54:30', '2024-08-23 04:54:30', ''),
(12, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-23 04:54:43', '2024-08-23 04:54:43', ''),
(19, 'Navitha', '9154990721', 'navi@gmail.com', 'Navi@123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-23 07:15:12', '2024-08-23 07:15:12', 'images/jobs-company/cheff4.jpg'),
(20, 'Kalpana', '9703025556', 'kalpana@gmail.com', 'Kalpana1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-23 09:29:34', '2024-08-23 09:29:34', 'images/jobs-company/cheff4.jpg'),
(21, 'Anil', '9618478543', 'anil@gmail.com', 'Anil@1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-23 09:44:33', '2024-08-23 09:44:33', 'images/jobs-company/cheff4.jpg'),
(22, 'Ramu', '9618488523', 'ram@gmail.com', 'Ramu@1234', '', '', '', '', '', 'Full Time', '', '', 'IT_Software', 'Beginner', '10-20 K', '40-50 K', '25', '', '2024-08-23 10:29:13', '2024-08-23 10:53:10', 'images/jobs-company/cheff4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `candidates_personaldetails`
--

CREATE TABLE `candidates_personaldetails` (
  `candidate_id` int(11) NOT NULL,
  `resume_headline` varchar(255) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `it_experience` varchar(255) DEFAULT NULL,
  `education_details` text DEFAULT NULL,
  `projects` text DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `functional_area` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `job_type` enum('Full Time','Part Time','Freelance') DEFAULT NULL,
  `employment_type` enum('Permanent','Contractual') DEFAULT NULL,
  `desired_shift` enum('Day','Night','Flexible') DEFAULT NULL,
  `availability_to_join` varchar(50) DEFAULT NULL,
  `desired_location` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `marital_status` enum('Single','Married','Divorced','Widowed') DEFAULT NULL,
  `hometown` varchar(255) DEFAULT NULL,
  `passport_number` varchar(50) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `work_permit_of_other_country` enum('Yes','No') DEFAULT NULL,
  `differently_abled` enum('Yes','No') DEFAULT NULL,
  `attach_resume` varchar(255) DEFAULT NULL,
  `profile_summary` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_profile`
--

CREATE TABLE `candidate_profile` (
  `id` int(11) NOT NULL,
  `prefix` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `countrycode` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `confirmpassword` varchar(30) NOT NULL,
  `experience` varchar(30) NOT NULL,
  `resume` varchar(250) NOT NULL,
  `profile_image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate_profile`
--

INSERT INTO `candidate_profile` (`id`, `prefix`, `firstname`, `lastname`, `email_id`, `phone`, `country`, `countrycode`, `password`, `confirmpassword`, `experience`, `resume`, `profile_image`) VALUES
(3, 'Mr', 'ravichandra', 'raavi', 'raviravichandra790@gmail.com', '6302483715', 'india', '+1', 'Ravicha@80', 'Ravicha@80', '', '', ''),
(4, 'Mr', 'ravichandra', 'raavi', 'raviravichandra890@gmail.com', '9302483719', 'india', '+91', 'Ravicha@80', 'Ravicha@80', '', '', ''),
(6, 'Mr', 'ravichandra', 'raavi', 'raviravichandra899@gmail.com', '9302483739', 'india', '+91', 'Ravicha@80', 'Ravicha@80', '', '', ''),
(8, 'Mr', 'ravichandra', 'raavi', 'raviravichandra869@gmail.com', '9302283739', 'india', '+91', 'Ravicha@80', 'Ravicha@80', '', '', ''),
(9, 'Mrs', 'ravichandra', 'raavi', 'raviravichandra960@gmail.com', '9302453719', 'india', '+91', 'Ravicha@80', 'Ravicha@80', '', '', ''),
(11, 'Mr', 'ravicha', 'raavi', 'raviravichandra360@gmail.com', '9302483715', 'india', '+91', 'Ravicha@123', 'Ravicha@123', '', '', ''),
(12, 'Mr', 'madhan', 'sangani', 'raviravichandra930@gmail.com', '7682453719', 'india', '+91', 'Ravicha@67', 'Ravicha@67', '', '', ''),
(13, 'Mrs', 'navitha', 'ponnaganti', 'raviravichandra199@gmail.com', '9302483782', 'india', '+91', 'Ravicha@90', 'Ravicha@90', '', '', ''),
(14, 'Mrs', 'navitha', 'ponnaganti', 'raviravichandra179@gmail.com', '8302483782', 'india', '+91', 'Navitha@90', 'Navitha@90', '', '', ''),
(15, 'Mr', 'thimmesh', 'thummala', 'raviravichandra109@gmail.com', '6702483715', 'india', '+91', 'Ravicha@81', 'Ravicha@81', '', '', ''),
(16, 'Miss', 'sujatha', 'venkata', 'raviravichandra490@gmail.com', '9302573715', 'india', '+91', 'Sujatha@80', 'Sujatha@80', '', '', ''),
(17, 'Mrs', 'Navitha ponnaganti', 'ponnaganti', 'navitha@gmail.com', '9154990721', 'India', '+91', 'Navitha@123', 'Navitha@123', '', '', '66d056f47afa8_Navitha.jpg'),
(18, 'Mr', 'Thimmeswara', 'NAIDU', 'thimmeswarnaidu1@gmail.com', '9704884856', 'USA', '+1', 'Mahesh20@', 'Mahesh20@', '', 'BSITSS-OFFER-LETTER.pdf', '66d571cc3a456_back-2.jpg'),
(19, 'Miss', 'Kalpana', 'malla', 'kalpana@gmail.com', '9700347778', 'India', '+91', 'Kalpana@123', 'Kalpana@123', '', '', ''),
(20, 'Miss', 'Vinay', 'kumar', 'vinay@gmail.com', '9154990722', 'India', '+91', 'Vinay@123', 'Vinay@123', '', '', ''),
(21, 'Mr', 'RavikumariAni', 'Anijulu', 'ravi@gmail.com', '9704884888', 'UK', '+44', 'Mahesh20@', 'Mahesh20@', '', '', ''),
(22, 'Mrs', 'Kamala ', 'Mallepula', 'kamala1107@gmail.com', '9704884855', 'USA', '+1', 'Mahesh20@', 'Mahesh20@', '', '', ''),
(23, 'Mrs', 'Seena', 'Modupalli', 'seena@gmail.com', '9704884001', 'India', '+91', 'Mahesh20@', 'Mahesh20@', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_details` text DEFAULT NULL,
  `available_jobs` int(11) DEFAULT 0,
  `available_domain` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `candidates_count` int(11) DEFAULT 0,
  `company_profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `username`, `password`, `email`, `phone`, `created_at`) VALUES
(2, 'laxmikanta@gmail.com', 'Mahesh20@', 'thimmeswarnaidu1@gmail.com', '09704884856', '2024-08-09 09:38:50'),
(5, 'Madan', 'Sagani', 'SaganiMadan@gmail.com', '9704884856', '2024-08-09 09:57:23'),
(6, 'Navitha', 'Navitha20@', 'Navitha@gmail.com', '9704884856', '2024-08-09 10:22:14'),
(9, 'Mahi', 'Mahesh20@', 'thimmeswarnaidu@gmail.com', '09704884852', '2024-08-09 10:36:46'),
(19, 'Kamla', '$2y$10$ceJOu20TQmnRN8tSbDj4qOBtqHSIiPwgxOZbgKv87aPBPOKbsTDcO', 'maheshmodupalli@gmail.com', '06300711125', '2024-08-09 14:10:08'),
(20, 'Mahesh', '$2y$10$T.shLTJXUqFs7yTF18Aypugi9crK1wknWMZxiNhOwoXhZ9YU4kR02', 'thimmeswarnaidu1107@gmail.com', '06300711127', '2024-08-10 06:54:37'),
(21, 'Mallepula', '$2y$10$FNxtDQVdUGAFwar/.HAZ/uJc4cQVHuR.FUzb3DUuN/Y2L6YWxZDxO', 'kamalamallepulla@gmail.com', '9704419350', '2024-08-10 07:12:03'),
(26, 'Navitha', '$2y$10$1Xi13ZUrJx9IDUFjW3RMje9uY0mo2c4D9o.or36DM3SEdGHzGFU5C', 'navi@gmail.com', '9154990721', '2024-08-23 09:24:08'),
(27, 'Ramesh', '$2y$10$NlqdqcOeFkQ/0yuEoOfCZOzg676A68ICGmhvdSc9zKQwIWVaQs952', 'ramesh@gmail.com', '9700347777', '2024-08-23 09:26:03'),
(28, 'Kalpana', '$2y$10$PO0aS6WcywCZXrfVHxy9jOFAQvfgwLJu8KJSw/wqMSpsR91Sr/RL2', 'kalpana@gmail.com', '9154990724', '2024-08-23 09:27:36'),
(30, 'Anil', '$2y$10$gOzDQGsTcHlxIc22XyyBGeyU3A.fdHYv8aW5eldbXorzhIR9coXdS', 'anil@gmail.com', '9618345623', '2024-08-23 09:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `job_category` varchar(255) DEFAULT NULL,
  `job_type` varchar(255) DEFAULT NULL,
  `offered_salary` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `est_since` varchar(50) DEFAULT NULL,
  `complete_address` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `applications` int(11) DEFAULT 0,
  `company_profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `company_name`, `job_title`, `job_category`, `job_type`, `offered_salary`, `experience`, `qualification`, `gender`, `country`, `city`, `location`, `latitude`, `longitude`, `email`, `website`, `est_since`, `complete_address`, `description`, `start_date`, `end_date`, `image_url`, `applications`, `company_profile_image`) VALUES
(16, 'Sunset Blvd Los Angeles', 'Senior Web Designer , Developer', 'IT and Computers', 'Full Time', '$2500', '3year', 'B.tech', 'Any', 'USA', 'Bangalore', 'marathalli', 'jdskfhsfh', 'gfdhdghd', 'thimmeswarnaidu@gmail.com', 'https://thewebmax.com', 'sakfnjdfsa', 'hjsjf', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '2023-12-29', '2024-08-20', 'images/jobs-company/pic1.jpg', 4, NULL),
(17, 'Accenture', 'Application , Developer', 'IT and Computers', 'Part Time', '$2000', '3year', 'B.tech', 'Any', 'USA', 'Bangalore', 'marathalli', 'jdskfhsfh', 'gfdhdghd', 'thimmeswarnaidu@gmail.com', 'https://thewebmax.com', 'sakfnjdfsa', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '2023-12-29', '2024-08-20', 'images/jobs-company/pic2.jpg', 2, NULL),
(18, 'Accenture', 'Application , Developer', 'IT and Computers', 'Part Time', '$2000', '3year', 'B.tech', 'Any', 'USA', 'Bangalore', 'marathalli', 'jdskfhsfh', 'gfdhdghd', 'thimmeswarnaidu@gmail.com', 'https://thewebmax.com', 'sakfnjdfsa', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '2024-08-01', '2024-08-07', 'images/jobs-company/pic2.jpg', 4, NULL),
(19, 'Accenture', 'Java BackEnd Developer', 'IT and Computers', 'Freelance', '$1500', '3year', 'B.tech', 'Male', 'USA', 'Bangalore', 'marathalli', 'jdskfhsfh', 'gfdhdghd', 'thimmeswarnaidu@gmail.com', 'https://thewebmax.com', 'sakfnjdfsa', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '2024-07-24', '2024-08-07', 'images/jobs-company/pic3.jpg', 0, NULL),
(20, 'Accenture', 'Front End Developer', 'IT and Computers', 'Full Time', '$1500', '3year', 'B.tech', 'Female', 'USA', 'Bangalore', 'marathalli', 'jdskfhsfh', 'gfdhdghd', 'thimmeswarnaidu@gmail.com', 'https://thewebmax.com', 'sakfnjdfsa', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '2024-07-19', '2024-08-07', 'images/jobs-company/pic3.jpg', 2, NULL),
(21, 'Accenture', 'Application Developer', 'IT and Computers', 'Temporary', '$2000', '3year', 'B.tech', 'Any', 'Canada', 'Hobart', 'Bangalore', 'jdskfhsfh', 'fkldsjskdf', 'maheshmodupalli@gmail.com', 'https://thewebmax.com', 'sakfnjdfsa', 'Bangalore', 'wpdkoijuegwdqjsk;l', '2024-07-18', '2024-08-22', 'images/jobs-company/pic4.jpg', 0, NULL),
(22, 'Accenture', 'Java API Developer', 'IT and Computers', 'Freelance', '$2000', '3year', 'B.tech', 'Male', 'USA', 'Bangalore', 'marathalli', 'jdskfhsfh', 'gfdhdghd', 'thimmeswarnaidu@gmail.com', 'https://thewebmax.com', 'sakfnjdfsa', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '2024-07-20', '2024-08-07', 'images/jobs-company/pic3.jpg', 0, NULL),
(23, 'Accenture', 'React Developer', 'IT and Computers', 'Internship', '$1000', '2month', 'B.tech', 'Male', 'United Kingdom', 'Bangalore', 'marathalli', 'jdskfhsfh', 'gfdhdghd', 'thimmeswarnaidu@gmail.com', 'https://thewebmax.com', 'sakfnjdfsa', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA', '2024-07-20', '2024-08-07', 'images/jobs-company/pic4.jpg', 1, NULL),
(32, 'bsit', 'Application developer', 'Accounting and Finance', 'Freelance', '$1500', '1 Year', 'Bachelor Degree', 'Female', 'India', 'hyderabad', 'gachibowli', 'hi', 'hello', 'navitha@gmail.com', 'www.bsitsoftware.com', '2016', 'hyderabad', 'hi', '2024-08-23', '2024-08-23', 'images/jobs-company/cheff4.jpg', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `status` enum('pending','interview','rejected','get job') DEFAULT 'pending',
  `application_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `candidate_id`, `username`, `email`, `phone`, `message`, `resume`, `status`, `application_date`) VALUES
(6, 18, 8, 'Mounika', 'Mounika@gmail.com', '9704884856', 'Mounika', 'uploads/resumes/Adhar card.pdf', 'pending', '2024-08-16 05:58:04'),
(7, 23, 9, 'Mohan', 'mohan@gmail.com', '9581082484', 'jkhgfhjkl;', 'uploads/resumes/passphoto1.pdf', 'pending', '2024-08-16 08:26:59'),
(8, 17, 4, 'Thimmeswara', 'thimmeswarnaidu@gmail.com', '6300711127', 'kwdjnajkhfsuakdhf', 'uploads/resumes/FresherResume.pdf', 'interview', '2024-08-20 04:51:11'),
(10, 16, 10, 'Madan Kumar', 'maheshmodupalli@gmail.com', '6300711126', 'dfhddrtd', 'uploads/resumes/RESUME FRESHER.pdf', 'pending', '2024-08-20 09:02:04'),
(13, 20, 22, 'Ramu', 'ram@gmail.com', '9618488523', 'Hi', 'uploads/resumes/Navitha_Resume.pdf', 'pending', '2024-08-23 10:59:38'),
(14, 20, 22, 'Ramu', 'ram@gmail.com', '9618488523', '', '', 'pending', '2024-08-23 11:00:44'),
(15, 18, 7, 'Navitha', 'Navitha@gmail.com', '9704884856', 'hi', 'uploads/resumes/Navitha_Resume.pdf', 'pending', '2024-08-24 05:27:42'),
(16, 18, 7, 'Navitha', 'Navitha@gmail.com', '9704884856', 'hi', 'uploads/resumes/Navitha_Resume.pdf', 'pending', '2024-08-24 05:28:24'),
(17, 16, 7, 'Navitha', 'Navitha@gmail.com', '9704884856', 'hi', 'uploads/resumes/Navitha_Resume.pdf', 'pending', '2024-08-24 06:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_category` varchar(255) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `offered_salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(50) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `complete_address` text NOT NULL,
  `description` text NOT NULL,
  `required_skills` text NOT NULL,
  `responsibilities` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `company_profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`id`, `company_name`, `job_title`, `job_category`, `job_type`, `offered_salary`, `experience`, `qualification`, `gender`, `country`, `location`, `email`, `website`, `complete_address`, `description`, `required_skills`, `responsibilities`, `start_date`, `end_date`, `company_profile_image`, `created_at`, `updated_at`) VALUES
(7, 'SMITH MARKETING EXCETUTIVE', 'Java developer', 'Software Development', 'Full Time', '50,000', '3year', 'Bachelor Degree', 'Both', 'India', 'Bangalore', 'SMITHMARKETINGEXCETUTIVE@gmail.com', 'https://smithmarketing.com', '123 Main St, New York, NY 10001', 'We are seeking a skilled and motivated Java Developer to join our dynamic team. The ideal candidate will have experience in designing, developing, and maintaining Java-based applications. As a Java Developer, you will work on cutting-edge projects, contributing to the development of high-performance and scalable solutions.\r\n\r\nKey Responsibilities:\r\n\r\nDesign & Development: Design and develop Java-based applications and systems. Implement features and functionalities according to project requirements.\r\nCode Implementation: Write clean, efficient, and maintainable code. Ensure the application adheres to coding standards and best practices.\r\nTesting & Debugging: Create and execute unit tests. Identify and fix bugs and performance issues in the codebase.\r\nMaintenance & Support: Maintain and enhance existing Java applications. Provide technical support and resolve issues as they arise.\r\nIntegration: Integrate Java applications with external APIs, services, and databases. Work on data integration and synchronization tasks.', 'CORE JAVA, ADVANCE JAVA SPRING ,SPRNG BOOT,SQL,MIRCO-SERVICE, SPRING SECURTIY', 'Java Developer Responsibilities\r\nDesign and Development:\r\n\r\nSoftware Design: Design and develop scalable and high-performance applications using Java.\r\nCode Implementation: Write clean, efficient, and maintainable code following industry best practices.\r\nArchitecture: Participate in the design and implementation of application architecture.\r\nTesting and Debugging:\r\n\r\nUnit Testing: Develop and execute unit tests to ensure code quality and functionality.\r\nDebugging: Identify and fix bugs and performance issues in the codebase.\r\nMaintenance and Support:\r\n\r\nCode Maintenance: Maintain and improve existing Java applications.\r\nSupport: Provide technical support and troubleshooting for Java-based applications.\r\nIntegration:\r\n\r\nAPIs: Integrate Java applications with third-party APIs and services.\r\nData Integration: Work with databases and data integration technologies.\r\nCollaboration:\r\n\r\nTeamwork: Collaborate with other developers, designers, and stakeholders to gather requirements and deliver solutions.\r\n', '2024-08-26', '2024-08-27', 'uploads/pic4.JPG', '2024-08-26 02:33:51', '2024-09-12 05:09:51'),
(11, 'C SMITH MARKETING EXCETUTIVE', 'Java developer', 'Software Development', 'Full Time', '10,000', 'Fresher', 'Bachelor Degree', 'Male', 'USA', 'Bangalore', 'SMITHMARKETINGEXCETUTIVE@gmail.com', 'https://smithmarketing.com', '123 Main St, New York, NY 10001', 'djhsdhjdfs', 'jfdssfdjhfsd', 'jsfjhfsjjfs', '2024-08-14', '2024-08-15', 'uploads/pic1.JPG', '2024-08-26 12:58:00', '2024-09-12 05:10:05'),
(14, 'BSIT Software services', 'Software Engineer', 'Software Development', 'Internship', '10,000', 'Fresher', 'Bachelor Degree', 'Both', 'India', 'Hyderabad', 'bsitsoftware@gmail.com', 'https://bsitsoftware.com', 'Gachibowli,Hyderabad,500034', 'hi', 'Html,css,JS', 'hello', '2024-08-27', '2024-08-31', 'uploads/pic2.jpg', '2024-08-27 08:34:45', '2024-09-12 05:10:19'),
(16, 'Accenture', 'Project Manager', 'IT Project Management', 'Full Time', '50,000', 'More than 3 Years', 'Master Degree', 'Both', 'India', 'Chennai', 'accenture@gmail.com', 'https://accentureindia.com', 'Coimbotore,chennai,560001', 'Project Manager is responsible for overseeing and leading projects from initiation through to completion. This role involves defining project objectives, creating detailed project plans, and coordinating resources to ensure timely and successful delivery. The Project Manager works closely with stakeholders to understand their needs, manages project budgets and schedules, and identifies and mitigates risks. Effective communication, leadership, and problem-solving skills are crucial as the Project Manager must facilitate team collaboration, address any issues that arise, and ensure that project goals align with organizational objectives. They are also tasked with monitoring project progress, preparing status reports, and making strategic decisions to keep the project on track. Their ultimate goal is to deliver projects that meet or exceed stakeholder expectations while adhering to quality standards and maintaining project timelines.', 'Team Leadership: Ability to inspire and motivate team members, fostering collaboration and commitment.\r\nDecision-Making: Making timely and well-considered decisions, especially under pressure.\r\nVerbal and Written Communication: Clearly conveying information to team members, stakeholders, and clients.\r\nActive Listening: Understanding and addressing concerns or feedback from team members and stakeholders.\r\nTime Management: Prioritizing tasks and managing time effectively to meet deadlines.\r\nResource Management: Efficiently allocating and managing resources, including personnel, budget, and materials.', 'Define project scope, objectives, and deliverables in collaboration with senior management and stakeholders.\r\nDevelop detailed project plans, including timelines, milestones, and resource allocation.\r\nIdentify and manage project dependencies and critical path.\r\nAssemble and lead a cross-functional project team.\r\nAssign tasks and responsibilities to team members, ensuring clarity and accountability.\r\nFoster a collaborative and productive team environment.\r\nCreate and manage project budgets, ensuring costs are tracked and controlled.\r\nAllocate resources effectively and manage procurement processes.\r\nIdentify potential budget risks and implement mitigation strategies.', '2024-08-27', '2024-09-20', 'uploads/pic3.jpg', '2024-08-27 11:33:54', '2024-09-12 05:10:34'),
(31, 'Accenture', 'Java developer', 'IT Project Management', 'Full Time', '50,000', 'More than 3 Years', 'Master Degree', 'Both', 'India', 'Chennai', 'mailto:accenture@gmail.com', 'https://accentureindia.com', 'Coimbotore,chennai,560001', 'Project Manager is responsible for overseeing and leading projects from initiation through to completion. This role involves defining project objectives, creating detailed project plans, and coordinating resources to ensure timely and successful delivery. The Project Manager works closely with stakeholders to understand their needs, manages project budgets and schedules, and identifies and mitigates risks. Effective communication, leadership, and problem-solving skills are crucial as the Project Manager must facilitate team collaboration, address any issues that arise, and ensure that project goals align with organizational objectives. They are also tasked with monitoring project progress, preparing status reports, and making strategic decisions to keep the project on track. Their ultimate goal is to deliver projects that meet or exceed stakeholder expectations while adhering to quality standards and maintaining project timelines.', 'Team Leadership: Ability to inspire and motivate team members, fostering collaboration and commitment.\r\nDecision-Making: Making timely and well-considered decisions, especially under pressure.\r\nVerbal and Written Communication: Clearly conveying information to team members, stakeholders, and clients.\r\nActive Listening: Understanding and addressing concerns or feedback from team members and stakeholders.\r\nTime Management: Prioritizing tasks and managing time effectively to meet deadlines.\r\nResource Management: Efficiently allocating and managing resources, including personnel, budget, and materials.', 'Define project scope, objectives, and deliverables in collaboration with senior management and stakeholders.\r\nDevelop detailed project plans, including timelines, milestones, and resource allocation.\r\nIdentify and manage project dependencies and critical path.\r\nAssemble and lead a cross-functional project team.\r\nAssign tasks and responsibilities to team members, ensuring clarity and accountability.\r\nFoster a collaborative and productive team environment.\r\nCreate and manage project budgets, ensuring costs are tracked and controlled.\r\nAllocate resources effectively and manage procurement processes.\r\nIdentify potential budget risks and implement mitigation strategies.', '2024-08-24', '2024-08-25', 'uploads/pic3.jpg', '2024-08-27 00:33:54', '2024-09-12 05:10:53'),
(32, 'C SMITH MARKETING EXCETUTIVE', 'Javadeveloper', 'Software Development', 'Full Time', '10,000', 'Fresher', 'Bachelor Degree', 'Male', 'USA', 'Bangalore', 'mailto:smithmarketingexcetutive@gmail.com', 'https://thewebmax.com', '123 Main St, New York, NY 10001', 'djhsdhjdfs', 'jfdssfdjhfsd', 'jsfjhfsjjfs', '2024-08-14', '2024-08-15', 'uploads/pic1.JPG', '2024-08-25 20:28:00', '2024-09-12 05:11:05'),
(33, 'TCS', 'Front End Developer', 'Web Development', 'Freelance', '20,000', '1 Year', 'Bachelor Degree', 'Both', 'India', 'Banglore', 'mailto:tcsjoin@gmail.com', 'https://www.bsitsoftware.com', 'whitefield,bangalore,560037', 'A Frontend Developer is responsible for creating visually appealing, user-friendly web interfaces that enhance the user experience. This role involves translating design mockups into responsive, functional web pages using HTML, CSS, and JavaScript. Frontend Developers work closely with UI/UX designers to ensure that the design vision is accurately implemented and with backend developers to integrate the frontend with server-side logic. Key responsibilities include optimizing web applications for maximum speed and scalability, ensuring cross-browser compatibility, and maintaining code quality and organization. A strong understanding of web development best practices, modern frameworks like React or Angular, and an eye for detail are essential for success in this role. Frontend Developers must stay updated with the latest trends and technologies in web development to continually improve the performance and aesthetics of their work.', 'HTML5: The foundation of web content, used to structure and present content on the web.\r\nCSS3: For styling web pages, including layout, colors, fonts, and responsive design. Knowledge of preprocessors like SASS or LESS is also valuable.\r\nJavaScript: The primary programming language for creating interactive and dynamic web content. Mastery of ES6+ features is essential.\r\nReact.js: A widely-used JavaScript library for building user interfaces, particularly single-page applications.\r\nAngular: A TypeScript-based framework for building robust web applications.\r\nVue.js: A progressive JavaScript framework for building user interfaces, especially for smaller and simpler projects.\r\nGit: Proficiency in using Git for version control, including branching, merging, and handling pull requests on platforms like GitHub or GitLab.', 'Develop responsive and interactive web pages using HTML, CSS, and JavaScript.\r\nImplement designs provided by UX/UI designers, ensuring pixel-perfect accuracy and cross-browser compatibility.\r\nOptimize web pages for different screen sizes and devices, focusing on mobile-first development.\r\nCollaborate with designers and backend developers to enhance the overall user experience.\r\nImplement accessibility standards to ensure the website is usable by people with disabilities.\r\nImprove page load times, performance, and overall usability by implementing best practices.', '2024-08-27', '2024-08-28', 'uploads/pic1.jpg', '2024-08-26 18:42:33', '2024-09-12 05:12:21'),
(34, 'Accenture', 'Project Manager', 'IT Project Management', 'Full Time', '50,000', 'More than 3 Years', 'Master Degree', 'Both', 'India', 'Chennai', 'mailto:accenture@gmail.com', 'https://accentureindia.com', 'Coimbotore,chennai,560001', 'Project Manager is responsible for overseeing and leading projects from initiation through to completion. This role involves defining project objectives, creating detailed project plans, and coordinating resources to ensure timely and successful delivery. The Project Manager works closely with stakeholders to understand their needs, manages project budgets and schedules, and identifies and mitigates risks. Effective communication, leadership, and problem-solving skills are crucial as the Project Manager must facilitate team collaboration, address any issues that arise, and ensure that project goals align with organizational objectives. They are also tasked with monitoring project progress, preparing status reports, and making strategic decisions to keep the project on track. Their ultimate goal is to deliver projects that meet or exceed stakeholder expectations while adhering to quality standards and maintaining project timelines.', 'Team Leadership: Ability to inspire and motivate team members, fostering collaboration and commitment.\r\nDecision-Making: Making timely and well-considered decisions, especially under pressure.\r\nVerbal and Written Communication: Clearly conveying information to team members, stakeholders, and clients.\r\nActive Listening: Understanding and addressing concerns or feedback from team members and stakeholders.\r\nTime Management: Prioritizing tasks and managing time effectively to meet deadlines.\r\nResource Management: Efficiently allocating and managing resources, including personnel, budget, and materials.', 'Define project scope, objectives, and deliverables in collaboration with senior management and stakeholders.\r\nDevelop detailed project plans, including timelines, milestones, and resource allocation.\r\nIdentify and manage project dependencies and critical path.\r\nAssemble and lead a cross-functional project team.\r\nAssign tasks and responsibilities to team members, ensuring clarity and accountability.\r\nFoster a collaborative and productive team environment.\r\nCreate and manage project budgets, ensuring costs are tracked and controlled.\r\nAllocate resources effectively and manage procurement processes.\r\nIdentify potential budget risks and implement mitigation strategies.', '2024-08-27', '2024-09-20', 'uploads/pic3.jpg', '2024-08-26 19:03:54', '2024-09-12 05:11:20'),
(35, 'C SMITH MARKETING EXCETUTIVE', 'Java API Developer', 'Software Development', 'Full Time', '10,000', 'Fresher', 'Bachelor Degree', 'Male', 'USA', 'Bangalore', 'mailto:smithmarketingexcetutive@gmail.com', 'https://thewebmax.com', '123 Main St, New York, NY 10001', 'djhsdhjdfs', 'jfdssfdjhfsd', 'jsfjhfsjjfs', '2024-08-14', '2024-08-15', 'uploads/pic1.JPG', '2024-08-25 20:28:00', '2024-09-12 05:11:34'),
(41, 'SMITH MARKETING EXCETUTIVE', 'Java developer', 'Software Development', 'Full Time', '50,000', '3year', 'Bachelor Degree', 'Both', 'India', 'Bangalore', 'SMITHMARKETINGEXCETUTIVE@gmail.com', 'https://smithmarketing.com', '123 Main St, New York, NY 10001', 'We are seeking a skilled and motivated Java Developer to join our dynamic team. The ideal candidate will have experience in designing, developing, and maintaining Java-based applications. As a Java Developer, you will work on cutting-edge projects, contributing to the development of high-performance and scalable solutions.\r\n\r\nKey Responsibilities:\r\n\r\nDesign & Development: Design and develop Java-based applications and systems. Implement features and functionalities according to project requirements.\r\nCode Implementation: Write clean, efficient, and maintainable code. Ensure the application adheres to coding standards and best practices.\r\nTesting & Debugging: Create and execute unit tests. Identify and fix bugs and performance issues in the codebase.\r\nMaintenance & Support: Maintain and enhance existing Java applications. Provide technical support and resolve issues as they arise.\r\nIntegration: Integrate Java applications with external APIs, services, and databases. Work on data integration and synchronization tasks.', 'CORE JAVA, ADVANCE JAVA SPRING ,SPRNG BOOT,SQL,MIRCO-SERVICE, SPRING SECURTIY', 'Java Developer Responsibilities\r\nDesign and Development:\r\n\r\nSoftware Design: Design and develop scalable and high-performance applications using Java.\r\nCode Implementation: Write clean, efficient, and maintainable code following industry best practices.\r\nArchitecture: Participate in the design and implementation of application architecture.\r\nTesting and Debugging:\r\n\r\nUnit Testing: Develop and execute unit tests to ensure code quality and functionality.\r\nDebugging: Identify and fix bugs and performance issues in the codebase.\r\nMaintenance and Support:\r\n\r\nCode Maintenance: Maintain and improve existing Java applications.\r\nSupport: Provide technical support and troubleshooting for Java-based applications.\r\nIntegration:\r\n\r\nAPIs: Integrate Java applications with third-party APIs and services.\r\nData Integration: Work with databases and data integration technologies.\r\nCollaboration:\r\n\r\nTeamwork: Collaborate with other developers, designers, and stakeholders to gather requirements and deliver solutions.\r\n', '2024-08-26', '2024-08-27', 'uploads/pic4.JPG', '2024-08-25 21:03:51', '2024-09-12 05:12:09'),
(42, 'C SMITH MARKETING EXCETUTIVE', 'Java developer', 'Software Development', 'Full Time', '10,000', 'Fresher', 'Bachelor Degree', 'Male', 'USA', 'Bangalore', 'SMITHMARKETINGEXCETUTIVE@gmail.com', 'https://smithmarketing.com', '123 Main St, New York, NY 10001', 'djhsdhjdfs', 'jfdssfdjhfsd', 'jsfjhfsjjfs', '2024-08-14', '2024-08-15', 'uploads/pic1.JPG', '2024-08-26 07:28:00', '2024-09-12 05:13:07'),
(43, 'BSIT Software services', 'Software Engineer', 'Software Development', 'Internship', '10,000', 'Fresher', 'Bachelor Degree', 'Both', 'India', 'Hyderabad', 'bsitsoftware@gmail.com', 'https://bsitsoftware.com', 'Gachibowli,Hyderabad,500034', 'hi', 'Html,css,JS', 'hello', '2024-08-27', '2024-08-31', 'uploads/pic2.jpg', '2024-08-27 03:04:45', '2024-09-12 05:11:51'),
(44, 'Accenture', 'Project Manager', 'IT Project Management', 'Full Time', '50,000', 'More than 3 Years', 'Master Degree', 'Both', 'India', 'Chennai', 'accenture@gmail.com', 'https://accentureindia.com', 'Coimbotore,chennai,560001', 'Project Manager is responsible for overseeing and leading projects from initiation through to completion. This role involves defining project objectives, creating detailed project plans, and coordinating resources to ensure timely and successful delivery. The Project Manager works closely with stakeholders to understand their needs, manages project budgets and schedules, and identifies and mitigates risks. Effective communication, leadership, and problem-solving skills are crucial as the Project Manager must facilitate team collaboration, address any issues that arise, and ensure that project goals align with organizational objectives. They are also tasked with monitoring project progress, preparing status reports, and making strategic decisions to keep the project on track. Their ultimate goal is to deliver projects that meet or exceed stakeholder expectations while adhering to quality standards and maintaining project timelines.', 'Team Leadership: Ability to inspire and motivate team members, fostering collaboration and commitment.\r\nDecision-Making: Making timely and well-considered decisions, especially under pressure.\r\nVerbal and Written Communication: Clearly conveying information to team members, stakeholders, and clients.\r\nActive Listening: Understanding and addressing concerns or feedback from team members and stakeholders.\r\nTime Management: Prioritizing tasks and managing time effectively to meet deadlines.\r\nResource Management: Efficiently allocating and managing resources, including personnel, budget, and materials.', 'Define project scope, objectives, and deliverables in collaboration with senior management and stakeholders.\r\nDevelop detailed project plans, including timelines, milestones, and resource allocation.\r\nIdentify and manage project dependencies and critical path.\r\nAssemble and lead a cross-functional project team.\r\nAssign tasks and responsibilities to team members, ensuring clarity and accountability.\r\nFoster a collaborative and productive team environment.\r\nCreate and manage project budgets, ensuring costs are tracked and controlled.\r\nAllocate resources effectively and manage procurement processes.\r\nIdentify potential budget risks and implement mitigation strategies.', '2024-08-27', '2024-09-20', 'uploads/pic3.jpg', '2024-08-27 06:03:54', '2024-09-12 05:13:34'),
(45, 'Accenture', 'Java developer', 'IT Project Management', 'Full Time', '50,000', 'More than 3 Years', 'Master Degree', 'Both', 'India', 'Chennai', 'mailto:accenture@gmail.com', 'https://accentureindia.com', 'Coimbotore,chennai,560001', 'Project Manager is responsible for overseeing and leading projects from initiation through to completion. This role involves defining project objectives, creating detailed project plans, and coordinating resources to ensure timely and successful delivery. The Project Manager works closely with stakeholders to understand their needs, manages project budgets and schedules, and identifies and mitigates risks. Effective communication, leadership, and problem-solving skills are crucial as the Project Manager must facilitate team collaboration, address any issues that arise, and ensure that project goals align with organizational objectives. They are also tasked with monitoring project progress, preparing status reports, and making strategic decisions to keep the project on track. Their ultimate goal is to deliver projects that meet or exceed stakeholder expectations while adhering to quality standards and maintaining project timelines.', 'Team Leadership: Ability to inspire and motivate team members, fostering collaboration and commitment.\r\nDecision-Making: Making timely and well-considered decisions, especially under pressure.\r\nVerbal and Written Communication: Clearly conveying information to team members, stakeholders, and clients.\r\nActive Listening: Understanding and addressing concerns or feedback from team members and stakeholders.\r\nTime Management: Prioritizing tasks and managing time effectively to meet deadlines.\r\nResource Management: Efficiently allocating and managing resources, including personnel, budget, and materials.', 'Define project scope, objectives, and deliverables in collaboration with senior management and stakeholders.\r\nDevelop detailed project plans, including timelines, milestones, and resource allocation.\r\nIdentify and manage project dependencies and critical path.\r\nAssemble and lead a cross-functional project team.\r\nAssign tasks and responsibilities to team members, ensuring clarity and accountability.\r\nFoster a collaborative and productive team environment.\r\nCreate and manage project budgets, ensuring costs are tracked and controlled.\r\nAllocate resources effectively and manage procurement processes.\r\nIdentify potential budget risks and implement mitigation strategies.', '2024-08-24', '2024-08-25', 'uploads/pic3.jpg', '2024-08-26 19:03:54', '2024-09-12 05:13:58'),
(46, 'C SMITH MARKETING EXCETUTIVE', 'Javadeveloper', 'Software Development', 'Full Time', '10,000', 'Fresher', 'Bachelor Degree', 'Male', 'USA', 'Bangalore', 'mailto:smithmarketingexcetutive@gmail.com', 'https://thewebmax.com', '123 Main St, New York, NY 10001', 'djhsdhjdfs', 'jfdssfdjhfsd', 'jsfjhfsjjfs', '2024-08-14', '2024-08-15', 'uploads/pic1.JPG', '2024-08-25 14:58:00', '2024-09-12 05:12:37');

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
-- Indexes for table `applied_candidates`
--
ALTER TABLE `applied_candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `jobid` (`jobid`,`candidateid`);

--
-- Indexes for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jobid` (`jobid`),
  ADD KEY `fk_candidateid` (`candidateid`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates_details`
--
ALTER TABLE `candidates_details`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `candidates_personaldetails`
--
ALTER TABLE `candidates_personaldetails`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `candidate_profile`
--
ALTER TABLE `candidate_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_id` (`email_id`,`phone`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `applied_candidates`
--
ALTER TABLE `applied_candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `candidates_details`
--
ALTER TABLE `candidates_details`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `candidate_profile`
--
ALTER TABLE `candidate_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  ADD CONSTRAINT `fk_candidateid` FOREIGN KEY (`candidateid`) REFERENCES `candidate_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jobid` FOREIGN KEY (`jobid`) REFERENCES `job_postings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `candidates_personaldetails`
--
ALTER TABLE `candidates_personaldetails`
  ADD CONSTRAINT `candidates_personaldetails_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `candidates_details` (`candidate_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidates_details` (`candidate_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
