-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 27 Ağu 2020, 15:13:27
-- Sunucu sürümü: 10.4.13-MariaDB
-- PHP Sürümü: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `larablog`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$57cAY8Dpcs6TwCsZSZNeSu1idJgAFCwFa1p1IYbeEXZAo.XKep5pu');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `hit` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0:pasif 1:aktif',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `title`, `image`, `content`, `hit`, `status`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 'Vel magni earum culpa harum ea.', 'http://placehold.it/800x400', 'Non commodi et eligendi impedit libero odit quaerat. Neque et suscipit voluptates autem officiis dolore. Sed distinctio a vel rerum molestiae. Itaque dolorem cumque corporis odit odio.', 4, 1, 'vel-magni-earum-culpa-harum-ea', NULL, '1986-07-30 10:27:01', '2020-08-27 13:11:49'),
(2, 2, 'Vel est voluptatem porro nihil aperiam et vitae.', 'http://placehold.it/800x400', 'Voluptas tenetur esse laborum. Necessitatibus sunt nihil ut sunt qui alias. Quaerat id soluta eum explicabo eum ut. Voluptate voluptatem consequatur cupiditate deserunt rerum corporis. Aut repellendus et suscipit qui neque est. Ipsum commodi officia aut voluptates deserunt molestiae ea.', 0, 1, 'vel-est-voluptatem-porro-nihil-aperiam-et-vitae', NULL, '1986-02-25 07:13:44', '2020-06-27 20:20:09'),
(3, 7, 'Voluptas maiores velit aspernatur.', 'http://placehold.it/800x400', 'Autem et rem debitis optio qui. Doloremque dolores velit autem aspernatur animi. Porro debitis corporis consequatur suscipit corporis. Nihil qui cum placeat omnis doloribus ipsum corporis. Dignissimos vel est officia omnis. Provident incidunt esse necessitatibus et.', 0, 1, 'voluptas-maiores-velit-aspernatur', NULL, '1972-07-02 20:59:40', '2020-06-27 20:20:11'),
(4, 5, 'Autem minima unde aut ratione rerum.', 'http://placehold.it/800x400', 'Deserunt dolore temporibus totam dolores molestias dicta fugit. Officiis fuga harum quod. Dolores magni voluptas necessitatibus in. Voluptatem corrupti id dolorem vero quas amet quod. Eum ut quia voluptas optio sit repellendus qui aspernatur. Vero quo quo dolor veritatis aut. At voluptas veritatis reiciendis dolor perspiciatis consectetur.', 2, 1, 'autem-minima-unde-aut-ratione-rerum', NULL, '1983-11-29 15:40:54', '2020-06-27 20:20:10');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Genel', 'genel', 1, '2020-06-27 14:39:24', '2020-06-27 20:19:42'),
(2, 'Eğlence', 'eglence', 1, '2020-06-27 14:39:24', '2020-08-27 13:05:13'),
(3, 'Bilişim', 'bilisim', 1, '2020-06-27 14:39:24', '2020-06-27 20:19:42'),
(4, 'Gezi', 'gezi', 1, '2020-06-27 14:39:24', '2020-06-27 20:19:43'),
(5, 'Teknoloji', 'teknoloji', 1, '2020-06-27 14:39:24', '2020-06-27 20:19:47'),
(6, 'Sağlık', 'saglik', 1, '2020-06-27 14:39:24', '2020-06-27 20:19:45'),
(7, 'Spor', 'spor', 1, '2020-06-27 14:39:24', '2020-06-27 20:19:46'),
(8, 'Günlük Yaşam', 'gunluk-yasam', 1, '2020-06-27 14:39:24', '2020-06-27 20:19:44');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `configs`
--

INSERT INTO `configs` (`id`, `title`, `logo`, `favicon`, `active`, `facebook`, `twitter`, `github`, `linkedin`, `youtube`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 'Laravel Blog Projesi', '', 'uploads/laravel-blog-projesi-guncel-favicon.png', 1, 'http://www.facebook.com', 'http://www.twitter.çom', 'http://www.github.com', 'http://www.linkedin.com', 'http://www.youtube.çom', 'http://www.instagram.com', '2020-06-27 14:39:24', '2020-08-27 13:05:47');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_03_15_115455_categories', 1),
(4, '2020_03_15_215119_articles', 1),
(5, '2020_03_20_143337_pages', 1),
(6, '2020_03_23_185851_contact', 1),
(7, '2020_03_29_205047_admin', 1),
(8, '2020_06_27_172612_config', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `pages`
--

INSERT INTO `pages` (`id`, `title`, `image`, `content`, `slug`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hakkımızda', 'http://placehold.it/800x400', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\n                              Suspendisse eget turpis in orci rutrum volutpat ut vitae eros.\n                              Maecenas condimentum mattis leo sit amet tempus.\n                              Nulla molestie elit ipsum, in eleifend est efficitur nec.\n                              Suspendisse at viverra nisi, sed mattis metus.\n                              Aliquam efficitur, nulla sit amet lacinia fermentum, turpis justo tincidunt turpis,\n                              nec iaculis magna est ac magna. Etiam ante eros, volutpat a mollis sed, pellentesque ac diam. Aenean nec libero eros.', 'hakkimizda', 1, 1, '2020-06-27 14:39:24', '2020-06-27 14:39:24'),
(2, 'Kariyer', 'http://placehold.it/800x400', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\n                              Suspendisse eget turpis in orci rutrum volutpat ut vitae eros.\n                              Maecenas condimentum mattis leo sit amet tempus.\n                              Nulla molestie elit ipsum, in eleifend est efficitur nec.\n                              Suspendisse at viverra nisi, sed mattis metus.\n                              Aliquam efficitur, nulla sit amet lacinia fermentum, turpis justo tincidunt turpis,\n                              nec iaculis magna est ac magna. Etiam ante eros, volutpat a mollis sed, pellentesque ac diam. Aenean nec libero eros.', 'kariyer', 2, 1, '2020-06-27 14:39:24', '2020-06-27 14:39:24'),
(3, 'Vizyonumuz', 'http://placehold.it/800x400', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\n                              Suspendisse eget turpis in orci rutrum volutpat ut vitae eros.\n                              Maecenas condimentum mattis leo sit amet tempus.\n                              Nulla molestie elit ipsum, in eleifend est efficitur nec.\n                              Suspendisse at viverra nisi, sed mattis metus.\n                              Aliquam efficitur, nulla sit amet lacinia fermentum, turpis justo tincidunt turpis,\n                              nec iaculis magna est ac magna. Etiam ante eros, volutpat a mollis sed, pellentesque ac diam. Aenean nec libero eros.', 'vizyonumuz', 3, 1, '2020-06-27 14:39:24', '2020-06-27 14:39:24'),
(4, 'Misyonumuz', 'http://placehold.it/800x400', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\n                              Suspendisse eget turpis in orci rutrum volutpat ut vitae eros.\n                              Maecenas condimentum mattis leo sit amet tempus.\n                              Nulla molestie elit ipsum, in eleifend est efficitur nec.\n                              Suspendisse at viverra nisi, sed mattis metus.\n                              Aliquam efficitur, nulla sit amet lacinia fermentum, turpis justo tincidunt turpis,\n                              nec iaculis magna est ac magna. Etiam ante eros, volutpat a mollis sed, pellentesque ac diam. Aenean nec libero eros.', 'misyonumuz', 4, 1, '2020-06-27 14:39:24', '2020-06-27 14:39:24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
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

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_category_id_foreign` (`category_id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
