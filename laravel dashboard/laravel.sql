-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 03:04 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nti_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'default.png',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>active,0=>notactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name_en`, `name_ar`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'samsung', 'سامسونج', 'default.png', 1, '2021-07-30 16:37:05', '2021-07-30 16:37:05'),
(2, 'apple', 'ابل', 'default.png', 1, '2021-07-30 16:37:05', '2021-07-30 16:37:05'),
(3, 'HP', 'اتش بي', 'default.png', 1, '2021-07-30 16:38:26', '2021-07-30 16:38:26'),
(4, 'Dell', 'ديل', 'default.png', 1, '2021-07-30 16:38:26', '2021-07-30 16:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL DEFAULT 'default.png',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>active,0=>notactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'اليكرونيات', 'electronics', 'default.png', 1, '2021-07-30 16:40:59', '2021-07-30 16:40:59'),
(2, 'مطبخ', 'kitchen', 'default.png', 1, '2021-07-30 16:40:59', '2021-07-30 16:40:59'),
(3, 'سوبر ماركت', 'supermarket', 'default.png', 1, '2021-07-30 16:42:06', '2021-07-30 16:42:06'),
(4, 'بيبي', 'baby', 'default.png', 1, '2021-07-30 16:42:06', '2021-07-30 16:42:06');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('eng.afroniayoussef@gmail.com', '$2y$10$9c1.Wn3RndK12/xdxtz6ruvBhjemFoa1kGRixop6ZOIs14V1ZJ6jy', '2021-08-04 16:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(5) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>active,0=>not active',
  `image` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `details_en` text DEFAULT NULL,
  `details_ar` text DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `subcategory_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_ar`, `name_en`, `price`, `quantity`, `status`, `image`, `details_en`, `details_ar`, `code`, `brand_id`, `subcategory_id`, `created_at`, `updated_at`) VALUES
(1, 'ايفون', 'iphone 12', '25000.00', 2, 1, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي', '1234', 2, 1, '2021-07-30 17:01:51', '2021-07-30 17:29:07'),
(2, 'اس 20', 's20', '10000.00', 1, 1, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي', '4567', 1, 1, '2021-07-30 17:01:51', '2021-07-30 17:29:07'),
(3, 'شاومي', 'x-omi', '8000.00', 5, 1, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي', '7894', 3, 1, '2021-07-30 17:04:44', '2021-07-30 17:29:07'),
(4, 'اوبو 19', 'oppo 19', '9000.00', 2, 1, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي', '2548', 4, 1, '2021-07-30 17:04:44', '2021-07-30 17:29:07'),
(5, 'ماك بوك', 'mac book', '270000.00', 10, 1, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي', '1593', 2, 2, '2021-07-30 17:16:05', '2021-07-30 17:29:07'),
(6, 'اتش بي لاب توب', 'hp laptop', '30000.00', 10, 1, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي', '9510', 3, 2, '2021-07-30 17:16:05', '2021-07-30 17:29:07'),
(7, 'ديل لاب توب', 'dell laptop', '35000.00', 5, 1, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي', '7536', 4, 2, '2021-07-30 17:17:04', '2021-07-30 17:29:07'),
(8, 'تليفزيون سامسونج 50 بوصه', 'samsung tv 50 inch', '50000.00', 10, 1, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي', '456221', 1, 3, '2021-07-30 17:19:49', '2021-07-30 17:29:07'),
(9, 'تليفزيون سامسونج 70 بوصه', 'samsung tv 70 inch', '80000.00', 5, 1, 'default.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي', '75568', 1, 3, '2021-07-30 17:19:49', '2021-07-30 17:29:07'),
(20, 'شكو', 'choco', '20.00', 7, 1, '1628168449.jpg', 'jsahas', 'ksahda', '25457', 3, 3, '2021-08-03 05:26:39', '2021-08-05 13:00:49'),
(21, 'شكو', 'choco', '10.00', 5, 1, '1628031234.jpg', 'jsahas', 'ksahda', '52146', 3, 3, '2021-08-03 20:53:54', '2021-08-03 20:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL DEFAULT 'default.png',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>active,0=>notactive',
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name_ar`, `name_en`, `photo`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'موبايل', 'mobiles', 'default.png', 1, 1, '2021-07-30 16:44:11', '2021-07-30 16:44:11'),
(2, 'لاب توب', 'laptop', 'default.png', 1, 1, '2021-07-30 16:45:56', '2021-07-30 16:45:56'),
(3, 'تليفزيون', 'TV', 'default.png', 1, 1, '2021-07-30 16:45:56', '2021-07-30 16:45:56'),
(6, 'ادوات مطبخ', 'kitchen tools', 'default.png', 1, 2, '2021-07-30 16:47:52', '2021-07-30 16:47:52'),
(7, 'شيبسي', 'chepsi', 'default.png', 1, 3, '2021-07-30 16:47:52', '2021-07-30 16:47:52'),
(8, 'شكولاته', 'chocolate', 'default.png', 1, 3, '2021-07-30 16:48:18', '2021-07-30 16:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int(5) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `code`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'omnia', 'omnia@gmail.com', '', NULL, '$2y$10$IJWJr5bFQt9v811.rDNx1eBSKog655kmRpAPRQpJky8mIdS794Rv6', NULL, NULL, '2021-08-04 15:24:33', '2021-08-04 15:24:33'),
(4, 'afronia', 'eng.afroniayoussef@gmail.com', '01222279184', NULL, '$2y$10$TkoAd2eFzWH/U8dS6p95Y.NmLVzJh4FWvcJhLAK.S1iXxq6Gt3Hbu', 54797, NULL, '2021-08-04 16:31:32', '2021-08-05 12:49:42'),
(6, 'api', 'api@api.com', '12358964789', '2021-08-05 01:04:51', '$2y$10$dMaqLAi40oDnOD5tClbl8OgREIJOFTpgBj2izDo5eiw37fAxca1by', 11279, NULL, '2021-08-05 00:10:06', '2021-08-05 01:04:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `products_subcatagries_fk` (`subcategory_id`),
  ADD KEY `brands_products_fk` (`brand_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_subcategories_fkl` (`category_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `brands_products_fk` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_subcatagries_fk` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `category_subcategories_fkl` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
