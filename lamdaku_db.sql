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


-- Dumping database structure for lamdaku_cms
CREATE DATABASE IF NOT EXISTS `lamdaku_cms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lamdaku_cms`;

-- Dumping structure for table lamdaku_cms.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table lamdaku_cms.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table lamdaku_cms.company_info
CREATE TABLE IF NOT EXISTS `company_info` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `social_media` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.company_info: ~4 rows (approximately)
DELETE FROM `company_info`;
INSERT INTO `company_info` (`id`, `company_name`, `address`, `phone`, `mobile`, `email`, `website`, `logo`, `description`, `social_media`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'LAMDAKU', 'Andhika Plaza Ruang VI-B LantaI 1\r\nJl. Simpang Dukuh 38-40 \r\nKota Surabaya - Jawa Timur 60235', '(031) 555-7890', '0812 3456 7890', 'info@lamdaku.com', 'https://www.lamdaku.com', '1749715893_LOGO_LPA_LAMDAKU_FIX.png', 'Perusahaan akreditasi', NULL, 1, '2025-06-10 23:55:05', '2025-06-12 01:11:33'),
	(2, 'PT. LAMDAKU Akreditasi Indonesia', 'Jl. Akreditasi No. 123, Jakarta Pusat 10110, Indonesia', '021 1234 5678', '0812 3456 7890', 'info@lamdaku.co.id', 'https://www.lamdaku.co.id', 'company-logo.png', 'Perusahaan akreditasi terpercaya', NULL, 1, '2025-06-11 06:57:01', '2025-06-11 06:57:01'),
	(3, 'PT. LAMDAKU Akreditasi Indonesia', 'Jl. Akreditasi No. 123, Jakarta Pusat 10110, Indonesia', '021 1234 5678', '0812 3456 7890', 'info@lamdaku.co.id', 'https://www.lamdaku.co.id', 'company-logo.png', 'Perusahaan akreditasi terpercaya', NULL, 1, '2025-06-11 07:09:53', '2025-06-11 07:09:53'),
	(4, 'PT. LAMDAKU Akreditasi Indonesia', 'Jl. Akreditasi No. 123, Jakarta Pusat 10110, Indonesia', '021 1234 5678', '0812 3456 7890', 'info@lamdaku.co.id', 'https://www.lamdaku.co.id', 'company-logo.png', 'Perusahaan akreditasi terpercaya', NULL, 1, '2025-06-11 07:10:29', '2025-06-11 07:10:29');

-- Dumping structure for table lamdaku_cms.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.contacts: ~1 rows (approximately)
DELETE FROM `contacts`;
INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `company`, `subject`, `message`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
	(1, 'Rio Wibowo', 'rioswibowo@gmail.com', '081938527772', 'LMN', 'Konsultasi Akreditasi', 'pesan tes', 1, '2025-06-11 01:22:34', '2025-06-11 01:22:12', '2025-06-11 01:22:34');

-- Dumping structure for table lamdaku_cms.failed_jobs
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

-- Dumping data for table lamdaku_cms.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table lamdaku_cms.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table lamdaku_cms.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table lamdaku_cms.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.migrations: ~9 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_06_11_022454_create_pages_table', 1),
	(5, '2025_06_11_022501_create_services_table', 1),
	(6, '2025_06_11_022507_create_contacts_table', 1),
	(7, '2025_06_11_022512_create_timelines_table', 1),
	(8, '2025_06_11_023853_create_personal_access_tokens_table', 1),
	(9, '2025_06_11_062644_create_company_info_table', 2);

-- Dumping structure for table lamdaku_cms.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.pages: ~4 rows (approximately)
DELETE FROM `pages`;
INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `meta_description`, `meta_keywords`, `is_published`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'About LAMDAKU', 'about-lamdaku', 'LAMDAKU (Lembaga Akreditasi Mandiri Daerah Khusus) adalah lembaga akreditasi independen yang berkomitmen untuk memberikan layanan akreditasi berkualitas tinggi untuk berbagai sektor industri dan pendidikan.\n\nVisi kami adalah menjadi lembaga akreditasi terpercaya yang berkontribusi dalam peningkatan kualitas dan standar di Indonesia. Kami memiliki tim ahli yang berpengalaman dan berkomitmen untuk memberikan pelayanan terbaik.\n\nTim LAMDAKU terdiri dari para profesional yang memiliki keahlian di berbagai bidang, termasuk:\n- Akreditasi Pendidikan\n- Akreditasi Rumah Sakit\n- Akreditasi Laboratorium\n- Sertifikasi ISO\n- Audit Mutu\n\nDengan pengalaman lebih dari 10 tahun, LAMDAKU telah membantu ratusan organisasi mencapai standar kualitas internasional.', 'LAMDAKU adalah lembaga akreditasi independen terpercaya dengan pengalaman lebih dari 10 tahun melayani berbagai sektor industri dan pendidikan di Indonesia.', 'LAMDAKU, akreditasi, lembaga akreditasi, sertifikasi, ISO, pendidikan, rumah sakit, laboratorium', 1, 1, '2025-06-10 20:34:29', '2025-06-10 20:34:29'),
	(2, 'Privacy Policy', 'privacy-policy', 'Kebijakan Privasi LAMDAKU\n\nLAMDAKU menghormati privasi Anda dan berkomitmen untuk melindungi informasi pribadi yang Anda berikan kepada kami. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.\n\nInformasi yang Kami Kumpulkan:\n- Informasi kontak (nama, email, nomor telepon)\n- Informasi perusahaan/organisasi\n- Data yang diperlukan untuk proses akreditasi\n- Informasi teknis dari website (cookies, IP address)\n\nPenggunaan Informasi:\nInformasi yang kami kumpulkan digunakan untuk:\n- Memberikan layanan akreditasi\n- Komunikasi terkait layanan\n- Peningkatan kualitas layanan\n- Kepatuhan terhadap regulasi\n\nKeamanan Data:\nKami menggunakan teknologi keamanan terkini untuk melindungi data Anda, termasuk enkripsi SSL dan sistem keamanan berlapis.\n\nHak Anda:\nAnda memiliki hak untuk mengakses, mengubah, atau menghapus informasi pribadi Anda. Hubungi kami jika Anda memiliki pertanyaan tentang kebijakan privasi ini.', 'Kebijakan privasi LAMDAKU menjelaskan bagaimana kami melindungi dan menggunakan informasi pribadi Anda dengan aman dan bertanggung jawab.', 'kebijakan privasi, privasi, perlindungan data, LAMDAKU, keamanan informasi', 1, 10, '2025-06-10 20:34:30', '2025-06-10 20:34:30'),
	(3, 'Terms of Service', 'terms-of-service', 'Syarat dan Ketentuan Layanan LAMDAKU\n\nDengan menggunakan layanan LAMDAKU, Anda menyetujui syarat dan ketentuan berikut:\n\n1. Definisi\nLAMDAKU adalah lembaga akreditasi yang memberikan layanan penilaian dan sertifikasi sesuai dengan standar yang berlaku.\n\n2. Lingkup Layanan\n- Akreditasi institusi pendidikan\n- Akreditasi fasilitas kesehatan\n- Sertifikasi laboratorium\n- Audit dan konsultasi mutu\n- Pelatihan dan pengembangan kapasitas\n\n3. Kewajiban Klien\n- Memberikan informasi yang akurat dan lengkap\n- Memenuhi persyaratan dokumentasi\n- Membayar biaya layanan sesuai kesepakatan\n- Mengikuti proses akreditasi sesuai prosedur\n\n4. Kewajiban LAMDAKU\n- Melakukan penilaian secara objektif dan profesional\n- Menjaga kerahasiaan informasi klien\n- Memberikan laporan hasil akreditasi\n- Menyediakan layanan purna jual\n\n5. Pembayaran\n- Biaya layanan harus dibayar sesuai kesepakatan\n- Pembayaran dapat dilakukan secara bertahap\n- Keterlambatan pembayaran dapat menghentikan proses akreditasi\n\n6. Pembatalan dan Pengembalian\n- Pembatalan layanan harus dilakukan secara tertulis\n- Pengembalian biaya mengikuti kebijakan yang berlaku\n\n7. Tanggung Jawab\nLAMDAKU tidak bertanggung jawab atas kerugian yang timbul akibat kelalaian klien dalam mengikuti prosedur akreditasi.', 'Syarat dan ketentuan layanan LAMDAKU yang mengatur hak dan kewajiban dalam penggunaan layanan akreditasi kami.', 'syarat ketentuan, terms of service, LAMDAKU, layanan akreditasi, kewajiban', 1, 11, '2025-06-10 20:34:30', '2025-06-10 20:34:30'),
	(4, 'Contact Information', 'contact-information', 'Informasi Kontak LAMDAKU\n\nKantor Pusat:\nJl. Sudirman No. 123\nJakarta Pusat 10220\nIndonesia\n\nTelepon: +62 21 1234 5678\nFax: +62 21 1234 5679\nEmail: info@lamdaku.org\nWebsite: www.lamdaku.org\n\nJam Operasional:\nSenin - Jumat: 08:00 - 17:00 WIB\nSabtu: 08:00 - 12:00 WIB\nMinggu: Tutup\n\nKantor Cabang:\n\nSurabaya:\nJl. Pemuda No. 456\nSurabaya 60271\nTelepon: +62 31 2345 6789\n\nMedan:\nJl. Gatot Subroto No. 789\nMedan 20123\nTelepon: +62 61 3456 7890\n\nMakassar:\nJl. AP Pettarani No. 321\nMakassar 90234\nTelepon: +62 411 4567 8901\n\nUntuk informasi lebih lanjut atau konsultasi, silakan hubungi kami melalui kontak di atas atau gunakan formulir kontak online yang tersedia di website ini.', 'Informasi kontak lengkap LAMDAKU termasuk alamat kantor pusat dan cabang, nomor telepon, email, dan jam operasional.', 'kontak LAMDAKU, alamat kantor, telepon, email, jam operasional, cabang', 1, 12, '2025-06-10 20:34:30', '2025-06-10 20:34:30');

-- Dumping structure for table lamdaku_cms.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table lamdaku_cms.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table lamdaku_cms.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.services: ~6 rows (approximately)
DELETE FROM `services`;
INSERT INTO `services` (`id`, `title`, `slug`, `description`, `content`, `icon`, `image`, `price`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'Akreditasi Klinik', 'akreditasi-klinik', 'Layanan akreditasi profesional untuk klinik kesehatan dengan standar nasional dan internasional.', 'Kami menyediakan layanan akreditasi komprehensif untuk klinik kesehatan yang mencakup evaluasi sistem manajemen mutu, keselamatan pasien, dan pelayanan klinis. Tim ahli kami akan mendampingi klinik Anda dalam proses persiapan hingga sertifikasi akreditasi.', 'Hospital', NULL, 0.00, 1, 1, '2025-06-10 21:59:07', '2025-06-11 02:08:20'),
	(2, 'Akreditasi Laboratorium', 'akreditasi-laboratorium', 'Sertifikasi akreditasi untuk laboratorium medis sesuai standar ISO 15189 dan regulasi terkini.', 'Layanan akreditasi laboratorium medis yang komprehensif meliputi sistem manajemen mutu, kompetensi teknis, dan keamanan laboratorium. Kami membantu laboratorium mencapai standar ISO 15189 dan persyaratan regulasi kesehatan.', 'FlaskConical', NULL, 0.00, 1, 2, '2025-06-10 21:59:08', '2025-06-10 21:59:08'),
	(3, 'Akreditasi Puskesmas', 'akreditasi-puskesmas', 'Program akreditasi khusus untuk Pusat Kesehatan Masyarakat (Puskesmas) tingkat nasional.', 'Program akreditasi Puskesmas yang dirancang khusus untuk fasilitas kesehatan tingkat pertama. Meliputi evaluasi pelayanan UKM, UKP, manajemen mutu, dan kepemimpinan sesuai standar Kemenkes RI.', 'Building2', NULL, 0.00, 1, 3, '2025-06-10 21:59:08', '2025-06-10 21:59:08'),
	(4, 'Konsultasi Mutu', 'konsultasi-mutu', 'Layanan konsultasi profesional untuk pengembangan sistem manajemen mutu kesehatan.', 'Konsultasi ahli untuk pengembangan dan implementasi sistem manajemen mutu di fasilitas kesehatan. Tim konsultan berpengalaman akan membantu organisasi Anda mencapai standar mutu tertinggi.', 'Users', NULL, 0.00, 1, 4, '2025-06-10 21:59:08', '2025-06-10 21:59:08'),
	(5, 'Pelatihan Akreditasi', 'pelatihan-akreditasi', 'Program pelatihan komprehensif untuk tim akreditasi dan manajemen mutu fasilitas kesehatan.', 'Program pelatihan yang dirancang untuk meningkatkan kompetensi tim dalam mempersiapkan akreditasi. Meliputi workshop, simulasi, dan pendampingan praktis dengan metode pembelajaran yang interaktif.', 'GraduationCap', NULL, 0.00, 1, 5, '2025-06-10 21:59:08', '2025-06-10 21:59:08'),
	(6, 'Audit Internal', 'audit-internal', 'Layanan audit internal untuk evaluasi sistem mutu dan persiapan akreditasi eksternal.', 'Layanan audit internal profesional untuk evaluasi kesiapan akreditasi fasilitas kesehatan. Tim auditor bersertifikat akan melakukan assessment menyeluruh dan memberikan rekomendasi perbaikan.', 'Search', NULL, 0.00, 1, 6, '2025-06-10 21:59:08', '2025-06-10 21:59:08');

-- Dumping structure for table lamdaku_cms.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.sessions: ~19 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('0lZxE1wWQmSB9xiuukW26tFu6gwv7sATgMWcAQS0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnZtUUVGeXczb1RlWXlwMFlxSmpWVm40U3pheWM1ZUtLdTBkdFhESiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4/aWQ9Njc3NTUxYTYtM2Q2YS00NzdiLThjZjYtMjNlOGE3OTJlNmIxJnZzY29kZUJyb3dzZXJSZXFJZD0xNzQ5NjM0ODU4NTc5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749634859),
	('2VHqOcOM95XZuP8gMlKzWNofGFJ7XOfZdQvReT0S', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic05teVdnMTdNTzF1bGl2ZGY0aHlpQ0JQWWtheEl6d1JSYVNJcFlqcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749635576),
	('7pYIb7zEL2lmuRNfzHPFwZJG0aeYxmikOcKenUCl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTA0dFFCT3MyNzdYZEo5NHVvYlVLTGpROWRuQTJqY05HcXpXRlZXNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAwOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4/aWQ9Njc3NTUxYTYtM2Q2YS00NzdiLThjZjYtMjNlOGE3OTJlNmIxJnZzY29kZUJyb3dzZXJSZXFJZD0xNzQ5NjM1OTUwNzYzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749635951),
	('9L14kv8Ne3eEmMcr3Fyp7fUtCYtQ9ar2Yo8DR4PQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2RJSm16R3l1YXo3czZlenRneVhZRlNJSFFsUDRSblg5NHdjVXJLTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4/aWQ9Njc3NTUxYTYtM2Q2YS00NzdiLThjZjYtMjNlOGE3OTJlNmIxJnZzY29kZUJyb3dzZXJSZXFJZD0xNzQ5NjM1MDIyNTczIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749635026),
	('9LJyj98nQ6aCwG5od61Vb4bRRVQ8GPNBLcRGZvGZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHpHUGxXNEQ4eldTUXJYSTZKaEpmMGU5RDhDSVpCdEluZ0pKUHpNcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4/aWQ9Njc3NTUxYTYtM2Q2YS00NzdiLThjZjYtMjNlOGE3OTJlNmIxJnZzY29kZUJyb3dzZXJSZXFJZD0xNzQ5NjM0NzIzMzEzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749634725),
	('bnU2g8sjnFz3XfqFEXdWYgAaedBJ9kJkyVJDbuff', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiS0YyMEE4dzlDQzd6S3pzZ1J2Y0NCems0TXY5QTFCUU9GODJTZDRScCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749635061),
	('dB4srljEyAGVebxdFleSc1JUlPc6uw9SNpmCFbuH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNTlpalA2YmIxR2JNWlIxZHh6RUk4UFJHNFp4RFlPb1VOMTJrYkMxOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTk6ImFkbWluX2F1dGhlbnRpY2F0ZWQiO2I6MTtzOjEwOiJhZG1pbl91c2VyIjtzOjEzOiJBZG1pbmlzdHJhdG9yIjt9', 1749635907),
	('ImdImkLMYZdnrktdd4pgANplkFfOha7eRB0kVbbQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiSnA3QXNlYnpsMDRUTExDRGRHN1E0Z3BpTk9xdVdEbktrNHBtdm4zTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749636022),
	('k8D0GBwp8kCD90UVUfdod4irCRpPnpFmeLAd8XoR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiblZncXFGazRBcXRGV1RmejUxdHdHcWNIRHNCMWdxWmthR1FGVVh0eSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jb21wYW55LzEvZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTk6ImFkbWluX2F1dGhlbnRpY2F0ZWQiO2I6MTtzOjEwOiJhZG1pbl91c2VyIjtzOjEzOiJBZG1pbmlzdHJhdG9yIjt9', 1749627814),
	('leZI1zGew2eI0snk0oRdIGOsYqpVOQ86FjuuDE4L', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSW9ET0tpSkt6Rjl3bzh0eG12d0xsTmk0Y1lNa0ZLT2RrRG1ldnBLOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4/aWQ9Njc3NTUxYTYtM2Q2YS00NzdiLThjZjYtMjNlOGE3OTJlNmIxJnZzY29kZUJyb3dzZXJSZXFJZD0xNzQ5NjM2MDExNjMyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749636012),
	('LN6MdBsOEi0fJGQ1zWrNiLY3pzSxcpUsjkq0uoWg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDh6Z2FBMThpbHVFcHl2MWdUR1lIekIwWVBoY1pCeGo1dHE3ZnV4YiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4/aWQ9Njc3NTUxYTYtM2Q2YS00NzdiLThjZjYtMjNlOGE3OTJlNmIxJnZzY29kZUJyb3dzZXJSZXFJZD0xNzQ5NjM1OTQ2NDI1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749635947),
	('LyDpq2Tdkwng2Hp01YNaKgQ1R2zJ1DR8DcVD1UpB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiN0NacTJ5bTJ5M1Y3dTVXVWhxWXNUNDlqS0dERExXMERQdHdMNEdCRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749635823),
	('NcOTQnmksydrmn2QIKMYKGZdJEWzjJbOQcfKAWbP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMnoycm9xR2F2aWk3UmhNSTNHVDE2djJwVEpQbjZJYWtqY054dVVIcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749635684),
	('o4xRzsfKIeJMBpkUB5TBiELJ2OE3OAUvXQguv2x2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMmszTmxPdHBBMWQzNFZWSXJBS1p4UHN3NzZHd211ZTBXY2JvOEpadSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTk6ImFkbWluX2F1dGhlbnRpY2F0ZWQiO2I6MTtzOjEwOiJhZG1pbl91c2VyIjtzOjEzOiJBZG1pbmlzdHJhdG9yIjt9', 1749635461),
	('PizLcwMAAWZ97hAzRMzoKfHxrVrfSOtaUcZCJZLc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFdvTHVOako2ZWhOTDgxWXl4U0dBVEFjTzRSWWh6VHlXcDZBcTJqSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4/aWQ9Njc3NTUxYTYtM2Q2YS00NzdiLThjZjYtMjNlOGE3OTJlNmIxJnZzY29kZUJyb3dzZXJSZXFJZD0xNzQ5NjM0Nzk3MjM4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749634798),
	('QWMBwRlxrYjOZvZDyx7GnXULsxcv1pIbdDUuFyVJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmhFZk4wY2VwWXlDRjdDVXJqVG9XUWg4dE9DeHhHa3JmWGVjbFpSdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4/aWQ9Njc3NTUxYTYtM2Q2YS00NzdiLThjZjYtMjNlOGE3OTJlNmIxJnZzY29kZUJyb3dzZXJSZXFJZD0xNzQ5NjM1ODA3NjE5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749635809),
	('tab0peLYDX6w7lQAEKezuDvHg4q02yf2Vb9cp9OX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNEdkTHVTcjZvUkhEUU9BZnlyU2ZCZlJPV1NDUGFIZjJDQmxCdUV4UiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749635591),
	('yb0ZGq5G2fXDuyv07vEhZcNWA9RDHKZvNmD4EW8O', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieFdqa01mMjhnelhMVGJwN2RiaDBhdUhsMldaSE5tcUg4ZmRhU3M4TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAwOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4/aWQ9Njc3NTUxYTYtM2Q2YS00NzdiLThjZjYtMjNlOGE3OTJlNmIxJnZzY29kZUJyb3dzZXJSZXFJZD0xNzQ5NjM1NTczMzI1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749635575),
	('zUtsEXnUXvcd9mf8KarMhNzYnEa7gbzbXujb4er6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.100.2 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid0R4NmhKMkxHNk1Jblh2bXRyN1c2TVVBcnBScFZwSWJFTjl1Rk1WSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749635951);

-- Dumping structure for table lamdaku_cms.timelines
CREATE TABLE IF NOT EXISTS `timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `year` year NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.timelines: ~8 rows (approximately)
DELETE FROM `timelines`;
INSERT INTO `timelines` (`id`, `year`, `title`, `description`, `icon`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, '2008', 'Pendirian LAMDAKU', 'LAMDAKU didirikan sebagai lembaga akreditasi kesehatan pertama di Indonesia dengan fokus pada peningkatan mutu pelayanan kesehatan.', 'fas fa-building', 1, 1, '2025-06-10 21:37:16', '2025-06-10 21:37:16'),
	(2, '2010', 'Sertifikasi ISO 9001', 'Memperoleh sertifikasi ISO 9001:2008 untuk sistem manajemen mutu, menunjukkan komitmen terhadap standar internasional.', 'fas fa-award', 1, 2, '2025-06-10 21:37:16', '2025-06-10 21:37:16'),
	(3, '2012', 'Ekspansi Layanan', 'Memperluas layanan akreditasi untuk mencakup klinik, dan laboratorium kesehatan.', 'fas fa-chart-line', 1, 3, '2025-06-10 21:37:16', '2025-06-10 23:11:02'),
	(4, '2015', 'Kemitraan Internasional', 'Menjalin kemitraan strategis dengan organisasi akreditasi internasional untuk transfer knowledge dan best practices.', 'fas fa-globe', 1, 4, '2025-06-10 21:37:16', '2025-06-10 21:37:16'),
	(5, '2018', 'Digitalisasi Proses', 'Implementasi sistem manajemen akreditasi digital untuk meningkatkan efisiensi dan transparansi proses.', 'fas fa-rocket', 1, 5, '2025-06-10 21:37:16', '2025-06-10 21:37:16'),
	(6, '2020', 'Respons Pandemi', 'Mengembangkan protokol akreditasi khusus untuk fasilitas kesehatan dalam menghadapi pandemi COVID-19.', 'fas fa-shield', 1, 6, '2025-06-10 21:37:16', '2025-06-10 21:37:16'),
	(7, '2022', 'Pencapaian 1000+ Fasyankes', 'Berhasil mengakreditasi lebih dari 1000 fasilitas kesehatan di seluruh Indonesia dengan tingkat kepuasan 95%.', 'fas fa-trophy', 1, 7, '2025-06-10 21:37:16', '2025-06-10 21:37:16'),
	(8, '2025', 'Visi 2025', 'Melanjutkan komitmen untuk menjadi lembaga akreditasi kesehatan terdepan dengan standar dunia dan inovasi berkelanjutan.', 'fas fa-flag', 1, 8, '2025-06-10 21:37:16', '2025-06-10 21:37:16');

-- Dumping structure for table lamdaku_cms.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lamdaku_cms.users: ~1 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Test User', 'test@example.com', '2025-06-10 19:46:17', '$2y$12$IuGJvsMXNFzck9Uv9Oceietu4t1mRvLSidtPU234FtcxHJnD6T1H6', 'K8wlFuNywW', '2025-06-10 19:46:17', '2025-06-10 19:46:17');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
