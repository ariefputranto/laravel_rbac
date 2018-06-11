-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2018 at 12:39 PM
-- Server version: 5.7.22
-- PHP Version: 7.0.30-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 2, '1', '2018-06-09 09:40:44', '2018-06-09 09:40:44'),
(3, 3, '2', '2018-06-09 09:52:30', '2018-06-09 09:52:30'),
(4, 4, '3', '2018-06-09 09:52:40', '2018-06-09 09:52:40'),
(5, 5, '4', '2018-06-09 09:52:52', '2018-06-09 09:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `parent`, `created_at`, `updated_at`) VALUES
(1, 'Transaction', NULL, NULL, '2018-06-08 23:48:20', '2018-06-08 23:48:20'),
(2, 'Entry Data', 'transaction/create', 1, '2018-06-08 23:48:53', '2018-06-09 20:02:49'),
(3, 'Report Transaction', 'transaction/dashboard', 1, '2018-06-08 23:50:55', '2018-06-09 21:57:58'),
(5, 'Admin', NULL, NULL, '2018-06-08 23:51:34', '2018-06-08 23:51:34'),
(6, 'Assignment', 'assignment', 5, '2018-06-08 23:51:50', '2018-06-08 23:51:50'),
(7, 'Role', 'role', 5, '2018-06-08 23:52:14', '2018-06-08 23:52:14'),
(8, 'Permission', 'permission', 5, '2018-06-08 23:52:29', '2018-06-08 23:52:29'),
(9, 'Menu', 'menu', 5, '2018-06-08 23:52:45', '2018-06-08 23:52:45'),
(10, 'User', 'user', 5, '2018-06-08 23:52:59', '2018-06-08 23:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `menu_permission`
--

CREATE TABLE `menu_permission` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_permission`
--

INSERT INTO `menu_permission` (`menu_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(2, 2, '2018-06-09 07:54:10', '2018-06-09 07:54:10'),
(3, 3, '2018-06-09 07:55:47', '2018-06-09 07:55:47'),
(6, 1, '2018-06-09 08:08:21', '2018-06-09 08:08:21'),
(7, 1, '2018-06-09 08:08:21', '2018-06-09 08:08:21'),
(8, 1, '2018-06-09 08:08:21', '2018-06-09 08:08:21'),
(9, 1, '2018-06-09 08:08:21', '2018-06-09 08:08:21'),
(10, 1, '2018-06-09 08:08:21', '2018-06-09 08:08:21');

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
(16, '2018_06_07_134800_create_menus_table', 2),
(17, '2018_06_07_165706_create_permissions_table', 2),
(18, '2018_06_08_070758_create_assignments_table', 2),
(19, '2018_06_08_071855_create_roles_table', 2),
(20, '2018_06_08_180658_create_transactions_table', 2),
(21, '2018_06_09_050548_create_transaction_details_table', 2),
(25, '2018_06_09_085140_create_menu_permissions_table', 3),
(26, '2018_06_09_161444_create_permission_roles_table', 4),
(27, '2018_06_10_030813_create_permission_details_table', 5);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Management Pengguna', 'management pengguna', '2018-06-09 07:53:53', '2018-06-09 07:53:53'),
(2, 'Entry data transaksi harian', 'Entry data transaksi harian', '2018-06-09 07:54:10', '2018-06-09 07:54:10'),
(3, 'Melihat summary transaksi harian', 'Melihat summary transaksi harian', '2018-06-09 07:55:47', '2018-06-09 07:55:47'),
(7, 'Manage Transaction', 'permission manage transaction', '2018-06-10 00:19:22', '2018-06-10 00:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `permission_details`
--

CREATE TABLE `permission_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_details`
--

INSERT INTO `permission_details` (`id`, `permission_id`, `slug`, `created_at`, `updated_at`) VALUES
(30, 1, 'menu', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(31, 1, 'menu/create', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(32, 1, 'menu/{menu}', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(33, 1, 'menu/{menu}/edit', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(34, 1, 'permission', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(35, 1, 'permission/create', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(36, 1, 'permission/{permission}', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(37, 1, 'permission/{permission}/edit', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(38, 1, 'role', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(39, 1, 'role/create', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(40, 1, 'role/{role}', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(41, 1, 'role/{role}/edit', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(42, 1, 'assignment', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(43, 1, 'assignment/create', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(44, 1, 'assignment/{assignment}', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(45, 1, 'assignment/{assignment}/edit', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(46, 1, 'user', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(47, 1, 'user/create', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(48, 1, 'user/{user}', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(49, 1, 'user/{user}/edit', '2018-06-09 20:34:58', '2018-06-09 20:34:58'),
(61, 3, 'transaction/dashboard', '2018-06-09 21:57:21', '2018-06-09 21:57:21'),
(68, 2, 'transaction', '2018-06-10 00:16:24', '2018-06-10 00:16:24'),
(69, 2, 'transaction/create', '2018-06-10 00:16:24', '2018-06-10 00:16:24'),
(70, 7, 'transaction', '2018-06-10 00:19:22', '2018-06-10 00:19:22'),
(71, 7, 'transaction/create', '2018-06-10 00:19:22', '2018-06-10 00:19:22'),
(72, 7, 'transaction/dashboard', '2018-06-10 00:19:22', '2018-06-10 00:19:22'),
(73, 7, 'transaction/{transaction}', '2018-06-10 00:19:22', '2018-06-10 00:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 2, '2018-06-09 09:24:33', '2018-06-09 09:24:33'),
(1, 3, '2018-06-09 09:24:57', '2018-06-09 09:24:57'),
(2, 1, '2018-06-09 09:30:44', '2018-06-09 09:30:44'),
(1, 4, '2018-06-10 00:19:34', '2018-06-10 00:19:34'),
(2, 4, '2018-06-10 00:19:34', '2018-06-10 00:19:34'),
(3, 4, '2018-06-10 00:19:34', '2018-06-10 00:19:34'),
(7, 4, '2018-06-10 00:19:34', '2018-06-10 00:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin Bengkel', 'role admin bengkel', '2018-06-09 09:22:36', '2018-06-09 09:22:36'),
(2, 'Direksi', 'role direksi', '2018-06-09 09:24:33', '2018-06-09 09:24:33'),
(3, 'Administrator', 'role administrator', '2018-06-09 09:24:57', '2018-06-09 09:24:57'),
(4, 'Superadmin', 'role superadmin', '2018-06-09 09:25:18', '2018-06-09 09:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 5, 18000, '2018-06-09 11:32:56', '2018-06-09 11:32:56'),
(2, 5, 14000, '2018-06-09 11:59:29', '2018-06-09 11:59:29'),
(3, 5, 13000, '2018-06-09 21:25:30', '2018-06-09 21:25:30'),
(5, 5, 79500, '2018-06-10 00:11:42', '2018-06-10 00:11:42'),
(6, 5, 46000, '2018-06-10 00:12:51', '2018-06-10 00:12:51'),
(7, 5, 5000, '2018-06-10 00:17:34', '2018-06-10 00:17:34'),
(8, 5, 16000, '2018-06-10 00:18:12', '2018-06-10 00:18:12'),
(9, 5, 5000, '2018-06-10 20:57:31', '2018-06-10 20:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `quantity`, `price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 5000, 10000, '2018-06-09 11:32:56', '2018-06-09 11:32:56'),
(2, 1, 2, 1, 8000, 8000, '2018-06-09 11:32:56', '2018-06-09 11:32:56'),
(3, 2, 4, 2, 4500, 9000, '2018-06-09 11:59:29', '2018-06-09 11:59:29'),
(4, 2, 1, 1, 5000, 5000, '2018-06-09 11:59:29', '2018-06-09 11:59:29'),
(5, 3, 1, 1, 5000, 5000, '2018-06-09 21:25:30', '2018-06-09 21:25:30'),
(6, 3, 2, 1, 8000, 8000, '2018-06-09 21:25:30', '2018-06-09 21:25:30'),
(8, 5, 1, 1, 5000, 5000, '2018-06-10 00:11:42', '2018-06-10 00:11:42'),
(9, 5, 2, 2, 8000, 16000, '2018-06-10 00:11:42', '2018-06-10 00:11:42'),
(10, 5, 3, 4, 9000, 36000, '2018-06-10 00:11:42', '2018-06-10 00:11:42'),
(11, 5, 4, 5, 4500, 22500, '2018-06-10 00:11:42', '2018-06-10 00:11:42'),
(12, 6, 1, 2, 5000, 10000, '2018-06-10 00:12:51', '2018-06-10 00:12:51'),
(13, 6, 3, 4, 9000, 36000, '2018-06-10 00:12:51', '2018-06-10 00:12:51'),
(14, 7, 1, 1, 5000, 5000, '2018-06-10 00:17:34', '2018-06-10 00:17:34'),
(15, 8, 2, 2, 8000, 16000, '2018-06-10 00:18:12', '2018-06-10 00:18:12'),
(16, 9, 1, 1, 5000, 5000, '2018-06-10 20:57:31', '2018-06-10 20:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$2tifTms1SJDtXg7HQ5246OFXQSL/IHhzm0RtUCsOXE/dn2rSjsvwq', 'Du2tyAlozifIcalm6EbHn7SxqNL3zq1pD0YoxIA5PuaIIlbq0udd4LVRj5Kt', '2018-06-07 06:19:22', '2018-06-07 06:19:22'),
(2, 'admin bengkel', 'adminbengkel@admin.com', '$2y$10$vMUCtvgMvDl8mdG8mhk7Qut3EQJrdlQszsiWl/R9SfrLADk8nFnsC', 'WFIXKVwZFcgqBuLeIgUZhH4X6EuESd8zxeMZdbAV4wfNBSebXXMkCRUzKgXm', '2018-06-08 02:16:15', '2018-06-08 02:16:15'),
(3, 'direksi', 'direksi@admin.com', '$2y$10$gKTR27ph3tVayPl1I3T67.raOaZ9GRp69e9VHxxHaohy81S5vpm7S', '2Ms4p8zE7A0wjgNWX1Zhc1zCGQeF0Mpf4rmbox7KBSZbOoqEPvnzVZvKwsnM', '2018-06-08 02:36:18', '2018-06-08 02:36:18'),
(4, 'administrator', 'administrator@admin.com', '$2y$10$Qlh.nJh98/jwQRQR2tbk0.CtX4SlOoVkFHEWHdiacAz6dGOUhtafK', 'krFDVdHqnml1d23m934pc7ScHaWvFQqDbo8WjYC713TS3TyRaCmQiVV6pVfl', '2018-06-08 02:36:47', '2018-06-08 02:36:47'),
(5, 'superadmin', 'superadmin@admin.com', '$2y$10$oFF9H/lUu9jdQeEt6A2zO.QLTljzOErqSkr0idrEr2rFtEN9ar7nW', 'Jr9OOQ9Lr2YwpD2pf06Qzut46KgfJ0R213ACyTkQ0lE0jQfDxWksivNIxnDc', '2018-06-08 02:37:09', '2018-06-08 02:37:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_permission`
--
ALTER TABLE `menu_permission`
  ADD KEY `menu_permission_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_permission_permission_id_foreign` (`permission_id`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_details`
--
ALTER TABLE `permission_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `permission_details`
--
ALTER TABLE `permission_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_permission`
--
ALTER TABLE `menu_permission`
  ADD CONSTRAINT `menu_permission_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
