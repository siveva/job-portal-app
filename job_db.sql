-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table job_db.applications
CREATE TABLE IF NOT EXISTS `applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_seeker_id` int NOT NULL,
  `job_listing_id` int NOT NULL,
  `cover_letter` text COLLATE utf8mb4_unicode_ci,
  `resume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','accepted','rejected','canceled','scheduled_for_interview') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `education` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `yrOfexp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortlisted` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.applications: ~7 rows (approximately)
INSERT INTO `applications` (`id`, `job_seeker_id`, `job_listing_id`, `cover_letter`, `resume`, `status`, `message`, `education`, `yrOfexp`, `shortlisted`, `created_at`, `updated_at`) VALUES
	(1, 3, 1, 'dfsdf fsdfsdf fsdfsdfsd fsdfdsfs', 'resumes/7RGhJ5SBXuhc6nCexJMxXbr6q2G43cyoq8jiqLo2.pdf', 'pending', NULL, '0', '0', 'no', '2024-02-27 19:21:00', '2024-02-27 19:21:00'),
	(2, 4, 1, 'hfhfhgfhg', 'resumes/SyNj1wBWKgGCGRlLo56cXZ0zbXpGRWKdm7YkchUn.docx', 'pending', NULL, '4', '4', 'yes', '2024-02-28 01:53:47', '2024-02-28 01:53:47'),
	(3, 3, 2, 'dfsdfsd', 'resumes/64TAyttUQpZSx4nZ9tyD1XPT5np9Fz4orBVONiWn.pdf', 'pending', NULL, '0', '0', 'yes', '2024-02-28 17:34:36', '2024-02-28 17:34:36'),
	(4, 3, 3, 'sfsfasfa', 'resumes/2ViNBOO5TjTmk8LCXnp7Iq9o5NvihqfDUCuiLx0m.pdf', 'pending', NULL, '0', '0', 'no', '2024-02-28 17:36:12', '2024-02-28 17:36:12'),
	(5, 3, 4, 'dsadasda', 'resumes/7nl54PgOfw2xLfMnNZFVpVvnrHhO8oHiYPMA9pGD.pdf', 'pending', NULL, '6', '0', 'no', '2024-02-28 17:40:23', '2024-02-28 17:40:23'),
	(6, 4, 4, 'dsadsadasd', 'resumes/3qgTavLHZ3LMesVBDkcYZifyoH1HrbcGMqrg3hs1.pdf', 'pending', NULL, '5', '2', 'yes', '2024-02-28 17:42:25', '2024-02-28 17:42:25'),
	(7, 5, 2, 'fdss', 'resumes/VAJlfAGSGYxp4IsFKkaJa5Sr1p8nbhD94rHhn82k.docx', 'pending', NULL, '4', '1', 'yes', '2024-03-12 00:36:24', '2024-03-12 00:36:24');

-- Dumping structure for table job_db.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.categories: ~4 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Web Development', '2024-02-27 18:11:15', '2024-02-27 18:11:15'),
	(2, 'Graphic Designer', '2024-02-27 18:11:22', '2024-02-27 18:11:22'),
	(3, 'Customer Service', '2024-02-27 18:11:33', '2024-02-27 18:11:33'),
	(4, 'Software Development', '2024-02-27 18:11:58', '2024-02-27 18:11:58');

-- Dumping structure for table job_db.category_job_listings
CREATE TABLE IF NOT EXISTS `category_job_listings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `job_listing_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.category_job_listings: ~4 rows (approximately)
INSERT INTO `category_job_listings` (`id`, `category_id`, `job_listing_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2024-02-27 18:13:50', '2024-02-27 18:13:50'),
	(2, 3, 2, '2024-02-28 17:31:40', '2024-02-28 17:31:40'),
	(3, 3, 3, '2024-02-28 17:32:20', '2024-02-28 17:32:20'),
	(4, 3, 4, '2024-02-28 17:39:07', '2024-02-28 17:39:07');

-- Dumping structure for table job_db.employers
CREATE TABLE IF NOT EXISTS `employers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_description` text COLLATE utf8mb4_unicode_ci,
  `company_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.employers: ~1 rows (approximately)
INSERT INTO `employers` (`id`, `user_id`, `company_name`, `company_description`, `company_logo`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Company 1', 'sdas', NULL, '2024-02-27 18:12:29', '2024-02-27 18:12:29');

-- Dumping structure for table job_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table job_db.job_listings
CREATE TABLE IF NOT EXISTS `job_listings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employer_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` decimal(8,2) NOT NULL,
  `job_type` enum('part-time','full-time','freelance','internship','temporary') COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` datetime NOT NULL,
  `education` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `yrOfexp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.job_listings: ~4 rows (approximately)
INSERT INTO `job_listings` (`id`, `employer_id`, `title`, `description`, `location`, `salary`, `job_type`, `requirements`, `deadline`, `education`, `yrOfexp`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Junior Frontend Developer', 'Description here', 'Lianga', 30000.00, 'full-time', 'requirements here', '2024-04-24 00:00:00', '4', '0', '2024-02-27 18:13:50', '2024-02-27 18:13:50'),
	(2, 2, 'Elem Sample with 0 exp', 'dasda', 'Lianga', 10000.00, 'full-time', 'sadsad', '2024-04-24 00:00:00', '0', '0', '2024-02-28 17:31:40', '2024-02-28 17:31:40'),
	(3, 2, 'Elem Sample with 2 exp', 'dsada', 'Lianga', 10000.00, 'part-time', 'dasdasda', '2024-03-04 00:00:00', '0', '2', '2024-02-28 17:32:20', '2024-02-28 17:32:20'),
	(4, 2, 'Arts sample with 0 exp', 'dasd', 'dasda', 21000.00, 'part-time', 'fdsfsdf', '2024-03-04 00:00:00', '5', '0', '2024-02-28 17:39:07', '2024-02-28 17:39:07');

-- Dumping structure for table job_db.job_seekers
CREATE TABLE IF NOT EXISTS `job_seekers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.job_seekers: ~3 rows (approximately)
INSERT INTO `job_seekers` (`id`, `user_id`, `first_name`, `last_name`, `phone_number`, `address`, `resume`, `created_at`, `updated_at`) VALUES
	(1, 3, 'Applicant 1', 'One', '09308090834', 'Diatagon, Lianga, Surigao del Sur', 'uploads/resumes/resume_1709086666.pdf', '2024-02-27 18:17:46', '2024-02-27 18:17:46'),
	(2, 4, 'Aplicant 2', 'Two', '09308090834', 'Diatagon, Lianga, Surigao del Sur', 'uploads/resumes/resume_1709113982.docx', '2024-02-28 01:53:02', '2024-02-28 01:53:02'),
	(3, 5, 'Applicant 4', 'Four', '09308090834', 'Surigao del Sur', 'uploads/resumes/resume_1710232346.pdf', '2024-03-12 00:32:26', '2024-03-12 00:32:26');

-- Dumping structure for table job_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.migrations: ~10 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2023_04_29_152011_create_employers_table', 1),
	(5, '2023_04_29_152103_create_job_seekers_table', 1),
	(6, '2023_04_29_152146_create_categories_table', 1),
	(7, '2023_04_29_152222_create_job_listings_table', 1),
	(8, '2023_04_29_152229_create_applications_table', 1),
	(9, '2023_04_29_152239_create_notifications_table', 1),
	(10, '2023_05_02_013130_create_category_job_listings_table', 1);

-- Dumping structure for table job_db.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `application_id` int NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.notifications: ~0 rows (approximately)

-- Dumping structure for table job_db.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.password_resets: ~0 rows (approximately)

-- Dumping structure for table job_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` enum('admin','employer','jobseeker') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_db.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `account_type`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@admin.com', NULL, '$2y$10$ZCi2xbOtq8f320VHZuGKze86wZ27RXtCa5NqKFn96Ulil7cVjSMxO', 'admin', NULL, '2024-02-27 18:10:20', '2024-02-27 18:10:20'),
	(2, 'Employer 1', 'emp1@emp.com', NULL, '$2y$10$.7Tbkt1yqR9MJy.yrkTf5uyCg26YnIihewBylhFwcRsKDlnD5Yeo.', 'employer', NULL, '2024-02-27 18:12:21', '2024-02-27 18:12:21'),
	(3, 'Applicant 1', 'jobseeker1@gmail.com', NULL, '$2y$10$ssigeFnFJArxhSBy9NUvFu2CDgvQctzfgcotLsaHPcNgMZL9u0pf6', 'jobseeker', NULL, '2024-02-27 18:16:45', '2024-02-27 18:16:45'),
	(4, 'Applicant 2', 'jobseeker2@gmail.com', NULL, '$2y$10$DAovAeRWVTDWyiPM.JVnJe0C7J7JBbjwjYFRd0g/qU9Rc14L3PG62', 'jobseeker', NULL, '2024-02-28 01:52:16', '2024-02-28 01:52:16'),
	(5, 'Aplicant 4', 'jobseeker4@gmail.com', NULL, '$2y$10$hA1GK45MqWdg7lFJiBALcOo3WiqecL6RsSKg4Ovg56YJu/0N5WcmC', 'jobseeker', NULL, '2024-03-12 00:30:51', '2024-03-12 00:30:51');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
