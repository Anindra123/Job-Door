-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 05:11 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `cv_file_name` text NOT NULL,
  `cv_file_path` text NOT NULL,
  `pr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interviewproposal`
--

CREATE TABLE `interviewproposal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_provider`
--

INSERT INTO `job_provider` (`id`, `fname`, `lname`, `work_position`) VALUES
(1, 'John', 'Doe', 'manager'),
(2, 'Joe', 'Smith', 'hr'),
(3, 'Supriya', 'Osman', 'hr');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker`
--

CREATE TABLE `job_seeker` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `current_occupation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_seeker`
--

INSERT INTO `job_seeker` (`id`, `fname`, `lname`, `current_occupation`) VALUES
(6, 'Anindra', 'Das', 'Part-time'),
(7, 'Sue', 'Storm', 'Unemployed'),
(8, 'Bob', 'Smith', 'Unemployed'),
(9, 'Robin', 'Smith', 'Student');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_seeker_feedback`
--

INSERT INTO `job_seeker_feedback` (`id`, `job_seeker_id`, `phase`, `status`, `feedback`) VALUES
(1, 6, 'Technical Interview', 'ACCEPTED', NULL),
(2, 8, 'Technical Interview', 'REJECTED', 'Need to improve technical skills'),
(3, 7, 'Screening Phase', 'ACCEPTED', NULL),
(4, 9, 'Technical Interview', 'REJECTED', 'Need to improve technical skills');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_vacency`
--

INSERT INTO `job_vacency` (`id`, `job_title`, `company_name`, `job_type`, `job_description`, `salary`, `address`, `job_location_type`, `vacency_count`, `jp_id`) VALUES
(3, 'Frontend Engineer', 'BrainStation 23', 'Part-time', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '30000-40000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'remote', 3, 1),
(4, 'Backend Engineer', 'Brain Station 23', 'Part-time', 'hello world', 'Negotiable', 'hello world', 'remote', 3, 1),
(5, 'Bussiness Analyst', 'Brainstation 23', 'Full-time', 'The css() method sets or returns one or more style properties for the selected elements.', '80000-90000', 'The css() method sets or returns one or more style properties for the selected elements.', 'onspot', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_vacency_candidate`
--

CREATE TABLE `job_vacency_candidate` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) DEFAULT NULL,
  `job_post_id` int(11) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `status` tinytext NOT NULL DEFAULT 'APPLIED'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_vacency_candidate`
--

INSERT INTO `job_vacency_candidate` (`id`, `candidate_id`, `job_post_id`, `provider_id`, `status`) VALUES
(3, 6, 3, 1, 'ACCEPTED'),
(5, 8, 3, 1, 'ACCEPTED'),
(6, 7, 3, 1, 'REJECTED'),
(7, 7, 5, 1, 'ACCEPTED'),
(8, 9, 3, 1, 'REJECTED'),
(9, 6, 4, 1, 'APPLIED');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(24, '2014_10_12_000000_create_users_table', 1),
(25, '2014_10_12_100000_create_password_resets_table', 1),
(26, '2019_08_19_000000_create_failed_jobs_table', 1),
(27, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(28, '2022_11_05_233650_create_interviewproposal_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `portfolio_title` varchar(100) NOT NULL,
  `js_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `portfolio_title`, `js_id`) VALUES
(11, 'Bivas Portfolio', 6),
(12, 'BOB Portfolio', 8),
(13, 'Sue portfolio', 7),
(14, 'robin-port', 9);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_title` text NOT NULL,
  `service_description` longtext NOT NULL,
  `pr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `skill_list` longtext NOT NULL,
  `pr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill_list`, `pr_id`) VALUES
(10, 'JS,CSS,PHP,HTML,FIGMA', 11),
(11, 'AdobeXD, Figma', 12);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technical_interview`
--

INSERT INTO `technical_interview` (`id`, `title`, `description`, `date`, `stime`, `etime`, `question`, `status`, `query`, `jv_id`) VALUES
(5, 'TI - 1', 'Please answer the question properly', '2022-11-07', '04:20', '04:40', 'How to center a div element', 'Open', NULL, 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technical_interview_submission`
--

INSERT INTO `technical_interview_submission` (`id`, `submitter_id`, `interview_id`, `provider_id`, `submission`, `submission_time`, `feedback`, `status`) VALUES
(4, 6, 5, 1, 'fasfasfasf', '04:30:42', NULL, 'HIRED'),
(5, 8, 5, 1, 'ljfaslfjaklsjflaskjf', '04:34:19', NULL, 'REJECTED');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` varchar(10) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `role` varchar(20) NOT NULL,
  `profile_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `pass`, `mail`, `status`, `role`, `profile_id`) VALUES
(5, 'Admin', 'ADad<2020>', 'jobdoor@mail.com', 'ACTIVE', 'ADMIN', NULL),
(6, 'Bivas', 'kiA$91171', 'bivasdas911@gmail.com', 'ACTIVE', 'JOB SEEKER', 6),
(7, 'JD', 'JDjd<2020>', 'john@mail.com', 'ACTIVE', 'JOB PROVIDER', 1),
(8, 'Sue', 'kiA$91171', 'dbivas27@gmail.com', 'ACTIVE', 'JOB SEEKER', 7),
(9, 'Bob', 'kiA$91171', 'bob@mail.com', 'ACTIVE', 'JOB SEEKER', 8),
(10, 'Robin', 'kiA$91171', 'robin@mail.com', 'ACTIVE', 'JOB SEEKER', 9),
(11, 'Joe', 'kiA$91171', 'joe@mail.com', 'ACTIVE', 'JOB PROVIDER', 2),
(12, 'Supriya', 'supriya12', 'supriya@gmail.com', 'ACTIVE', 'JOB PROVIDER', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_experience`
--

INSERT INTO `work_experience` (`id`, `work_title`, `company_name`, `work_description`, `start_date`, `end_date`, `pr_id`) VALUES
(5, 'Forentend Developer', 'Therap', 'I just wanted to note, for anyone getting a null reference exception using JQuery\'s event.target.id', '10-09-2020', '11-08-2021', 11);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
-- AUTO_INCREMENT for table `interviewproposal`
--
ALTER TABLE `interviewproposal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_provider`
--
ALTER TABLE `job_provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_seeker`
--
ALTER TABLE `job_seeker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `job_seeker_feedback`
--
ALTER TABLE `job_seeker_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_vacency`
--
ALTER TABLE `job_vacency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_vacency_candidate`
--
ALTER TABLE `job_vacency_candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `technical_interview`
--
ALTER TABLE `technical_interview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `technical_interview_submission`
--
ALTER TABLE `technical_interview_submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
