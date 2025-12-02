-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2025 at 01:48 PM
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
-- Database: `kasandigan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangay_i_d_s`
--

CREATE TABLE `barangay_i_d_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barangay_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangay_i_d_s`
--

INSERT INTO `barangay_i_d_s` (`id`, `barangay_id`, `created_at`, `updated_at`) VALUES
(1, '00000123', '2025-04-10 04:06:06', '2025-05-10 09:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `complaintCategory_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `complaintLocation_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `complaintCategory_id`, `description`, `complaintLocation_id`, `status`, `attachment`, `created_at`, `updated_at`) VALUES
(28, 5, 3, 'Sige\'g saba ang karaoke hangtod kadlawon', 2, 'closed', NULL, '2025-04-09 06:28:50', '2025-05-09 06:51:54'),
(29, 5, 4, 'Sige\'g away ang magtiayon, madungog sa silingan.', 3, 'closed', 'attachments/1746772165_captured_image.png', '2025-04-09 06:29:25', '2025-05-09 06:51:01'),
(30, 5, 5, 'Barangay Ordinance Violations', 2, 'solved', 'attachments/1746772213_Screenshot 2025-04-14 152619.png', '2025-04-09 06:30:13', '2025-05-09 06:50:43'),
(31, 5, 6, 'Gipasanginlan ko sa akong silingan nga nangawat ko.', 2, 'solved', NULL, '2025-04-09 06:30:49', '2025-05-09 06:50:21'),
(32, 5, 7, 'Property-related Issues', 2, 'processing', NULL, '2025-05-09 06:31:22', '2025-05-09 06:52:15'),
(33, 5, 8, 'Magtambay ang mga batan-on, magsaba ug magbasol.', 2, 'processing', NULL, '2025-05-09 06:31:47', '2025-05-09 06:51:36'),
(34, 5, 9, 'Sige\'g pangasaba ang iro sa silingan, tibuok gabii.', 2, 'processing', NULL, '2025-05-09 06:32:03', '2025-05-09 06:52:45'),
(35, 5, 10, 'Saba ang sounds sa tindahan bisan kadlawon.', 2, 'pending', NULL, '2025-05-09 06:32:22', '2025-05-09 06:32:22'),
(36, 5, 11, 'Gisunog ang basura bisan bawal sa lugar.', 2, 'pending', NULL, '2025-05-09 06:32:37', '2025-05-09 06:32:37'),
(37, 1, 3, 'Daghang magmotor nga walay silencer, samok kaayo.', 8, 'pending', NULL, '2025-05-09 06:39:53', '2025-05-09 06:39:53'),
(48, 8, 3, 'Kusog kaayo ang videoke', 2, 'solved', 'attachments/1746864449_Screenshot 2025-02-12 180204.png', '2025-04-10 08:07:29', '2025-05-10 08:07:29'),
(49, 8, 3, 'Sige\'g paningug og pito ang guard bisan walay rason.', 2, 'solved', NULL, '2025-04-10 08:16:01', '2025-05-10 08:16:01'),
(50, 8, 4, 'Bunalon kaayo ang ginikanan sa ilang anak.', 2, 'closed', NULL, '2025-04-10 08:16:21', '2025-05-10 08:16:21'),
(51, 8, 5, 'Naglabay og basura sa dili angay nga lugar.', 2, 'solved', NULL, '2025-05-10 08:16:53', '2025-05-10 08:16:53'),
(52, 8, 6, 'Gikataw-an og gina-insulto ko pirmi sa pikas balay.', 2, 'solved', NULL, '2025-05-10 08:17:25', '2025-05-10 08:17:25'),
(53, 8, 7, 'Gipatindogan og tindahan akong lote walay permiso.', 2, 'processing', NULL, '2025-05-10 08:17:53', '2025-05-10 08:17:53'),
(54, 8, 8, 'Sige\'g bisyo ang mga minor, walay ginikanan magbantay.', 2, 'processing', NULL, '2025-05-10 08:18:17', '2025-05-10 08:18:17'),
(55, 8, 9, 'Gipasagdan lang ang mga manok nga magsuroy-suroy.', 2, 'processing', NULL, '2025-05-10 08:18:58', '2025-05-10 08:18:58'),
(56, 8, 10, 'Dili limpyo ang karenderia, daghan lamok.', 2, 'pending', NULL, '2025-05-10 08:19:26', '2025-05-10 08:19:26'),
(58, 8, 4, 'Himantayon janice', 13, 'solved', 'attachments/1747207701_captured_image.png', '2025-05-14 07:27:42', '2025-05-14 07:51:27'),
(59, 9, 8, 'Nagdaig og foil ilaha Janice', 9, 'solved', 'attachments/1747208450_arduino.png', '2025-05-14 07:40:50', '2025-05-14 07:50:57'),
(60, 8, 11, 'dfdfdsd', 5, 'solved', 'attachments/1747363983_first.png', '2025-05-16 02:53:04', '2025-05-16 02:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_categories`
--

CREATE TABLE `complaint_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `complaintCategory_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaint_categories`
--

INSERT INTO `complaint_categories` (`id`, `complaintCategory_name`, `created_at`, `updated_at`) VALUES
(3, 'Public Disturbance', '2025-05-09 05:48:17', '2025-05-09 05:48:17'),
(4, 'Domestic Issues', '2025-05-09 05:48:39', '2025-05-09 05:48:39'),
(5, 'Barangay Ordinance Violations', '2025-05-09 05:49:07', '2025-05-09 05:49:07'),
(6, 'Neighborhood Disputes', '2025-05-09 05:49:41', '2025-05-09 05:49:41'),
(7, 'Property-related Issues', '2025-05-09 05:50:04', '2025-05-09 05:50:04'),
(8, 'Dili na Youth-related Concerns', '2025-05-09 05:50:18', '2025-05-14 07:52:28'),
(9, 'Animal Complaints', '2025-05-09 05:50:49', '2025-05-09 05:50:49'),
(10, 'Business-related Complaints', '2025-05-09 05:51:16', '2025-05-09 05:51:16'),
(11, 'Environmental Issues', '2025-05-09 05:51:34', '2025-05-09 05:51:34'),
(14, 'Biga', '2025-05-14 07:23:00', '2025-05-14 07:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_locations`
--

CREATE TABLE `complaint_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `complaintLocation_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaint_locations`
--

INSERT INTO `complaint_locations` (`id`, `complaintLocation_name`, `created_at`, `updated_at`) VALUES
(2, 'Purok 1, Camagong II', '2025-05-09 05:52:55', '2025-05-09 05:52:55'),
(3, 'Purok 2, Camagong II', '2025-05-09 05:53:03', '2025-05-09 05:53:03'),
(4, 'Purok 3, Camagong II', '2025-05-09 05:53:12', '2025-05-09 05:53:12'),
(5, 'Purok 1, Bantig', '2025-05-09 05:53:25', '2025-05-09 05:53:25'),
(6, 'Purok 2, Bantig', '2025-05-09 05:53:36', '2025-05-09 05:53:36'),
(7, 'Purok 3, Bantig', '2025-05-09 05:53:43', '2025-05-09 05:53:43'),
(8, 'Purok 1, Upper Central', '2025-05-09 05:54:01', '2025-05-09 05:54:01'),
(9, 'Purok 2, Upper Central', '2025-05-09 05:54:07', '2025-05-09 05:54:07'),
(10, 'Purok 3, Upper Central', '2025-05-09 05:54:14', '2025-05-09 05:54:14'),
(13, 'Purok 7', '2025-05-14 07:22:44', '2025-05-14 07:22:44');

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` varchar(255) NOT NULL,
  `service_feedback` text DEFAULT NULL,
  `improvement_suggestions` text DEFAULT NULL,
  `anonymous` tinyint(1) NOT NULL DEFAULT 1,
  `isQuest` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `rating`, `service_feedback`, `improvement_suggestions`, `anonymous`, `isQuest`, `created_at`, `updated_at`) VALUES
(1, 1, 'good', 'fdsfsa', 'sdfef', 1, 0, '2025-04-10 04:07:40', '2025-04-10 04:07:40'),
(2, 1, 'excellent', 'dgdegr', 'ewtq', 0, 0, '2025-04-10 04:09:27', '2025-04-10 04:09:27'),
(3, NULL, 'excellent', 'czxc', 'dfasf', 1, 1, '2025-04-10 05:26:00', '2025-04-10 05:26:00'),
(4, NULL, 'excellent', 'dfasfas', 'dsfafwae', 1, 1, '2025-05-09 05:43:08', '2025-05-09 05:43:08'),
(5, NULL, 'excellent', 'thank you', 'thank you', 1, 1, '2025-05-09 07:45:06', '2025-05-09 07:45:06'),
(6, NULL, 'excellent', 'Well done', NULL, 1, 1, '2025-05-09 07:46:59', '2025-05-09 07:46:59'),
(7, NULL, 'excellent', 'Well Done', NULL, 1, 1, '2025-05-09 07:47:24', '2025-05-09 07:47:24'),
(8, NULL, 'excellent', 'well done', NULL, 1, 1, '2025-05-10 07:19:36', '2025-05-10 07:19:36'),
(9, NULL, 'excellent', 'Well done', NULL, 1, 1, '2025-05-10 07:23:14', '2025-05-10 07:23:14'),
(10, 8, 'excellent', 'Sample Feedback', 'Sample Feedback', 0, 0, '2025-05-10 09:07:18', '2025-05-10 09:07:18'),
(12, 1, 'excellent', 'Kapoy', 'Improve it', 1, 0, '2025-05-14 07:24:35', '2025-05-14 07:24:35'),
(13, NULL, 'good', 'Very nice!', NULL, 1, 1, '2025-05-14 07:35:18', '2025-05-14 07:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0000-2025_02_27_052408_create_barangay_i_d_s_table', 1),
(2, '0000-2025_03_25_193700_create_complaint_locations_table', 1),
(3, '0001_01_01_000000_create_users_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2025_03_04_085615_create_feedback_table', 1),
(6, '2025_03_24_030108_create_complaint_categories_table', 1),
(7, '2025_12_01_050922_create_complaints_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('99myfOGMZJ9emqEUuxGeUVLg59gnW9ZI8oKjYDse', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVU5tT3VwZ0lNeUVKWkRyM2tFb1I2dDdidzdtcG1FSndvdjVGcnNTbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747363298),
('cf9rHctZkVij6NSuZrlXCIYiJOkTsEQ3kV2DjUOL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTZNa2hNZ3dqdU9DOFVBdGVKSVEwM3NJOFdJN3Z0QzZIU1BnVkJYRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1764679709),
('p9WnatcllW8dDDFS99KQrIEGxchHT4e8ZMnYGvLm', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZE5GQmh5NHE1VUs4MFAwUDk2WVp3cG5JZ211YUhVZlNnUFZ6OVZuTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mZWVkYmFja3MiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747209286),
('XHs4L8Ue78cTMmlY17tylgFmaVhg4DgTg92P9Pwz', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYkpSYTVEOHJ3anVvRmdNdW1MRzdnOFgwV1hTUDhCYUl2RmhFdnBqWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747364411),
('Xjluj1EnhqmRnNKCuctMluY88UJwtQSYDRdrdWmv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiclY0cU1sdGw1WmhiOUgxaktrQUliN05jVEd6aEVGWlZJVGJBRVdvTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747209305);

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
  `username` varchar(255) NOT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('resident','official','admin','guest') NOT NULL DEFAULT 'resident',
  `barangay_id` bigint(20) UNSIGNED NOT NULL,
  `profilePic` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `username`, `contact_number`, `address_id`, `role`, `barangay_id`, `profilePic`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jerald Cahulogan', 'jeraldcahulogan5@gmail.com', '2025-04-10 04:07:14', '$2y$12$haEexiZMU/GRD/PfJMYbueQif87vhDVvVaARRBsuMX1eEmmLyMe7a', 'JMC', NULL, 2, 'admin', 1, 'profile_pics/DOcLrGNKPioKybvoIQp9j9blk1DzYlHyNxu5GGnz.png', 'hdawLHexy8r5a5uGxfKDuxul4PEIqW0iQ69y131mHQyD1xgvt84SLTZzhwBq', '2025-04-10 04:06:33', '2025-05-14 07:23:47'),
(5, 'James Carl', 'jeraldcahulogan@gmail.com', '2025-05-09 06:13:21', '$2y$12$0p27VS6jQZN.9KOfHojj1.C1IbE5gdBNT1sokbjkTTUeMSbxdfBE2', 'Carl', NULL, 2, 'resident', 1, NULL, NULL, '2025-05-09 06:12:44', '2025-05-09 06:13:21'),
(8, 'Jerald Cahulogan_UPDATE_THIS', 'jeraldcahulogan2@gmail.com', '2025-05-10 07:55:26', '$2y$12$HdWB6xyePQNlLfiemHELgOJngmXeeGZ5mTWztpOoNRj0aEKxHIVHy', 'JeraldMC', NULL, 2, 'resident', 1, NULL, NULL, '2025-05-10 07:42:55', '2025-05-10 08:56:48'),
(9, 'Rennan Amoguis', 'rennanamoguis@yahoo.com', '2025-05-14 07:38:21', '$2y$12$1ZpgVe6l1O1i1QtyzD2k/.PqrmBmoTSQgb2QCBzoIBAmgFltEClUW', 'rennan', NULL, 6, 'resident', 1, NULL, NULL, '2025-05-14 07:37:31', '2025-05-14 07:38:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay_i_d_s`
--
ALTER TABLE `barangay_i_d_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaints_user_id_foreign` (`user_id`),
  ADD KEY `complaints_complaintcategory_id_foreign` (`complaintCategory_id`),
  ADD KEY `complaints_complaintlocation_id_foreign` (`complaintLocation_id`);

--
-- Indexes for table `complaint_categories`
--
ALTER TABLE `complaint_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint_locations`
--
ALTER TABLE `complaint_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_address_id_foreign` (`address_id`),
  ADD KEY `users_barangay_id_foreign` (`barangay_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangay_i_d_s`
--
ALTER TABLE `barangay_i_d_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `complaint_categories`
--
ALTER TABLE `complaint_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `complaint_locations`
--
ALTER TABLE `complaint_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_complaintcategory_id_foreign` FOREIGN KEY (`complaintCategory_id`) REFERENCES `complaint_categories` (`id`),
  ADD CONSTRAINT `complaints_complaintlocation_id_foreign` FOREIGN KEY (`complaintLocation_id`) REFERENCES `complaint_locations` (`id`),
  ADD CONSTRAINT `complaints_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `complaint_locations` (`id`),
  ADD CONSTRAINT `users_barangay_id_foreign` FOREIGN KEY (`barangay_id`) REFERENCES `barangay_i_d_s` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
