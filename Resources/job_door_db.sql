-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 04:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_door_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'jobdoor@mail.com', 'ADad<2020>');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` text NOT NULL,
  `mail` text NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fname`, `lname`, `phone`, `mail`, `message`) VALUES
(1, 'Anindra', 'Das', '01954790557', 'bivasdas911@gmail.com', 'Hello'),
(2, 'Anindra', 'Das', '01954790557', 'bivasdas911@gmail.com', 'Hello'),
(3, 'Anindra', 'Das', '01954790557', 'bivasdas911@gmail.com', 'Hello'),
(4, 'Anindra', 'Das', '01954790557', 'bivasdas911@gmail.com', 'Hello'),
(5, 'Anindra', 'Das', '01954790557', 'bivasdas911@gmail.com', 'Hello'),
(6, 'Anindra', 'Das', '01954790557', 'bivasdas911@gmail.com', 'Hello'),
(7, 'Anindra', 'Das', '01954790557', 'sue@gmail.com', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `cv_file_name` text NOT NULL,
  `cv_file_path` text NOT NULL,
  `pr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interviewers_list`
--

CREATE TABLE `interviewers_list` (
  `id` int(11) NOT NULL,
  `uname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interviewers_list`
--

INSERT INTO `interviewers_list` (`id`, `uname`, `email`, `password`) VALUES
(3, 'Joe', 'joe@mail.om', '1234'),
(5, 'Bivas', 'bivasdas911@gmail.com', 'kiA$91171'),
(6, 'Sue', 'sue@mail.com', 'kiA$91171');

-- --------------------------------------------------------

--
-- Table structure for table `interviewproposal`
--

CREATE TABLE `interviewproposal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `stime` varchar(255) NOT NULL,
  `etime` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `notes` multilinestring DEFAULT NULL,
  `jv_id` int(11) NOT NULL,
  `jp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_provider`
--

CREATE TABLE `job_provider` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `work_position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_provider`
--

INSERT INTO `job_provider` (`id`, `fname`, `lname`, `work_position`) VALUES
(2, 'Bivas', 'Das', 'hr'),
(3, 'Jean', 'Storm', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker`
--

CREATE TABLE `job_seeker` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `current_occupation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_seeker`
--

INSERT INTO `job_seeker` (`id`, `fname`, `lname`, `current_occupation`) VALUES
(1, 'Sue', 'Storm', 'Unemployed');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker_feedback`
--

CREATE TABLE `job_seeker_feedback` (
  `id` int(11) NOT NULL,
  `job_seeker_id` int(11) NOT NULL,
  `phase` text NOT NULL,
  `status` text NOT NULL,
  `feedback` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_vacency`
--

CREATE TABLE `job_vacency` (
  `id` int(11) NOT NULL,
  `job_title` text NOT NULL,
  `company_name` text NOT NULL,
  `job_type` text NOT NULL,
  `job_description` longtext NOT NULL,
  `salary` text NOT NULL,
  `address` longtext NOT NULL,
  `job_location_type` text NOT NULL,
  `vacency_count` int(11) NOT NULL,
  `jp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_vacency`
--

INSERT INTO `job_vacency` (`id`, `job_title`, `company_name`, `job_type`, `job_description`, `salary`, `address`, `job_location_type`, `vacency_count`, `jp_id`) VALUES
(3, 'Frontend Engineer', 'Brainstation 23', 'Part-time', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the', '40000-50000', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the', 'remote', 1, 2),
(4, 'Backend Engineer', 'Brainstation 23', 'Part-time', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the', '50000-60000', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the', 'remote', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_vacency_candidate`
--

CREATE TABLE `job_vacency_candidate` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) DEFAULT NULL,
  `job_post_id` int(11) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `status` tinytext NOT NULL DEFAULT 'APPLIED',
  `approval` tinytext NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_vacency_candidate`
--

INSERT INTO `job_vacency_candidate` (`id`, `candidate_id`, `job_post_id`, `provider_id`, `status`, `approval`) VALUES
(23, 1, 3, 2, 'APPLIED', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(39, '2014_10_12_000000_create_users_table', 1),
(40, '2014_10_12_100000_create_password_resets_table', 1),
(41, '2019_08_19_000000_create_failed_jobs_table', 1),
(42, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(43, '2022_11_05_233650_create_interviewproposal_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `heading` text NOT NULL,
  `description` text NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `expires_at`, `last_used_at`, `created_at`, `updated_at`) VALUES
(27, 'App\\Models\\User', 2, 'Bivas', 'e2b66fe44565a56376b872ee517c177b2dd4b1f821047a66d863530eea61918a', '[\"*\"]', NULL, NULL, '2022-12-12 15:01:55', '2022-12-12 15:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `portfolio_title` varchar(100) NOT NULL,
  `js_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `portfolio_title`, `js_id`) VALUES
(1, 'Port 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `report_title` text NOT NULL,
  `report_description` longtext NOT NULL,
  `report_category` text NOT NULL,
  `report_status` tinytext NOT NULL DEFAULT 'PENDING',
  `report_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_title` text NOT NULL,
  `service_description` longtext NOT NULL,
  `pr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `skill_list` longtext NOT NULL,
  `pr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill_list`, `pr_id`) VALUES
(1, 'React,HTML,CSS,JS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `technical_interview`
--

CREATE TABLE `technical_interview` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `date` text NOT NULL,
  `stime` text NOT NULL,
  `etime` text NOT NULL,
  `question` longtext NOT NULL,
  `status` text NOT NULL DEFAULT 'PENDING',
  `query` longtext DEFAULT NULL,
  `jv_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `technical_interview_submission`
--

CREATE TABLE `technical_interview_submission` (
  `id` int(11) NOT NULL,
  `submitter_id` int(11) NOT NULL,
  `interview_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `submission` longtext DEFAULT NULL,
  `submission_time` text DEFAULT NULL,
  `feedback` longtext DEFAULT NULL,
  `status` text NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sue', 'dbivas27@gmail.com', '2022-12-02 00:36:23', '$2y$10$lkQv5/Hut6IdCZFzkFJmy.ZP8cE8Re9M77jjYBCJWYpp5gBOQMLmW', 'vETL9rwRgKliELiUjTkkylDJUD7w7JOWglS0WOfxNt4fCxKUjuJfzGhD1SGk', '2022-12-02 00:36:08', '2022-12-03 11:39:47'),
(2, 'Bivas', 'bivasdas911@gmail.com', '2022-12-02 04:38:33', '$2y$10$hucbUkZBWGM7ekmE25hTM..5bwED8HNZ3q5ClMtF.w3V2pxsPibvW', 'D70uXcBn6uuTfq75sWjc23qT8eAAJSs4aRsUZdiBqxfOSXW36bhIi3kW7syv', '2022-12-02 04:37:53', '2022-12-03 11:51:38'),
(3, 'Jean', 'rewebor357@covbase.com', '2022-12-09 18:18:21', '$2y$10$t/DeWh.RY9F0gH3z0JNSv.MdnBDldpa8m/.oFWMAU7Q2DklgdOFNG', NULL, '2022-12-09 18:17:52', '2022-12-09 18:18:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `id` int(11) NOT NULL,
  `uname` varchar(10) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `role` varchar(20) NOT NULL,
  `profile_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`id`, `uname`, `mail`, `status`, `role`, `profile_id`) VALUES
(1, 'Sue', 'dbivas27@gmail.com', 'ACTIVE', 'JOB SEEKER', 1),
(2, 'Bivas', 'bivasdas911@gmail.com', 'ACTIVE', 'JOB PROVIDER', 2),
(3, 'Jean', 'rewebor357@covbase.com', 'ACTIVE', 'JOB PROVIDER', 3);

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE `work_experience` (
  `id` int(11) NOT NULL,
  `work_title` text NOT NULL,
  `company_name` text NOT NULL,
  `work_description` longtext NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `pr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_experience`
--

INSERT INTO `work_experience` (`id`, `work_title`, `company_name`, `work_description`, `start_date`, `end_date`, `pr_id`) VALUES
(1, 'Frontend Engineer', 'Therap', 'Handled the client side', '10-10-2021', '11-11-2022', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_ibfk_1` (`pr_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interviewers_list`
--
ALTER TABLE `interviewers_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interviewproposal`
--
ALTER TABLE `interviewproposal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_provider`
--
ALTER TABLE `job_provider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_seeker`
--
ALTER TABLE `job_seeker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_seeker_feedback`
--
ALTER TABLE `job_seeker_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_vacency`
--
ALTER TABLE `job_vacency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jp_id` (`jp_id`);

--
-- Indexes for table `job_vacency_candidate`
--
ALTER TABLE `job_vacency_candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidate_id` (`candidate_id`),
  ADD KEY `job_post_id` (`job_post_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_ibfk_1` (`js_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_ibfk_1` (`pr_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skills_ibfk_1` (`pr_id`);

--
-- Indexes for table `technical_interview`
--
ALTER TABLE `technical_interview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jv_id` (`jv_id`);

--
-- Indexes for table `technical_interview_submission`
--
ALTER TABLE `technical_interview_submission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interview_id` (`interview_id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `technical_interview_submission_ibfk_1` (`submitter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_experience_ibfk_1` (`pr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interviewers_list`
--
ALTER TABLE `interviewers_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `interviewproposal`
--
ALTER TABLE `interviewproposal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_provider`
--
ALTER TABLE `job_provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_seeker`
--
ALTER TABLE `job_seeker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_seeker_feedback`
--
ALTER TABLE `job_seeker_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_vacency`
--
ALTER TABLE `job_vacency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_vacency_candidate`
--
ALTER TABLE `job_vacency_candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `technical_interview`
--
ALTER TABLE `technical_interview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `technical_interview_submission`
--
ALTER TABLE `technical_interview_submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `cv_ibfk_1` FOREIGN KEY (`pr_id`) REFERENCES `portfolio` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_vacency`
--
ALTER TABLE `job_vacency`
  ADD CONSTRAINT `job_vacency_ibfk_1` FOREIGN KEY (`jp_id`) REFERENCES `job_provider` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_vacency_candidate`
--
ALTER TABLE `job_vacency_candidate`
  ADD CONSTRAINT `job_vacency_candidate_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `job_seeker` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_vacency_candidate_ibfk_2` FOREIGN KEY (`job_post_id`) REFERENCES `job_vacency` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_vacency_candidate_ibfk_3` FOREIGN KEY (`provider_id`) REFERENCES `job_provider` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `portfolio_ibfk_1` FOREIGN KEY (`js_id`) REFERENCES `job_seeker` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`pr_id`) REFERENCES `portfolio` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`pr_id`) REFERENCES `portfolio` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `technical_interview`
--
ALTER TABLE `technical_interview`
  ADD CONSTRAINT `technical_interview_ibfk_1` FOREIGN KEY (`jv_id`) REFERENCES `job_vacency` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `technical_interview_submission`
--
ALTER TABLE `technical_interview_submission`
  ADD CONSTRAINT `technical_interview_submission_ibfk_1` FOREIGN KEY (`submitter_id`) REFERENCES `job_seeker` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `technical_interview_submission_ibfk_2` FOREIGN KEY (`interview_id`) REFERENCES `technical_interview` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `technical_interview_submission_ibfk_3` FOREIGN KEY (`provider_id`) REFERENCES `job_provider` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD CONSTRAINT `work_experience_ibfk_1` FOREIGN KEY (`pr_id`) REFERENCES `portfolio` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
