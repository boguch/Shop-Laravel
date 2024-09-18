-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Сен 18 2024 г., 06:37
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laravel_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_16_114708_create_products_table', 2),
(5, '2024_09_16_145518_create_orders_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `products` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `products`, `created_at`, `updated_at`) VALUES
(1, 'andry', 'qw@weweewewwe.we', '[{\"name\":\"aspernatur\",\"quantity\":1},{\"name\":\"voluptas\",\"quantity\":3}]', '2024-09-16 10:12:56', '2024-09-16 10:12:56'),
(2, 'andry', 'qw@weweewewwe.we', '[]', '2024-09-16 11:40:35', '2024-09-16 11:40:35'),
(3, 'andry', 'qw@weweewewwe.we', '[]', '2024-09-16 11:46:35', '2024-09-16 11:46:35'),
(4, 'andry', 'qw@weweewewwe.we', '[]', '2024-09-16 11:52:36', '2024-09-16 11:52:36'),
(5, 'andry', 'bo6uch@gmail.com', '[{\"name\":\"hic\",\"quantity\":3}]', '2024-09-16 16:08:46', '2024-09-16 16:08:46'),
(6, 'andry', 'bo6uch@gmail.com', '[{\"id\":2,\"name\":\"quasi\",\"quantity\":1}]', '2024-09-16 16:18:53', '2024-09-16 16:18:53'),
(7, 'andry', 'bo6uch@gmail.com', '[{\"id\":2,\"name\":\"quasi\",\"quantity\":1}]', '2024-09-16 16:20:39', '2024-09-16 16:20:39'),
(8, 'andry', 'bo6uch@gmail.com', '[{\"id\":2,\"name\":\"quasi\",\"quantity\":7}]', '2024-09-16 16:46:45', '2024-09-16 16:46:45'),
(9, 'andry', 'bo6uch@gmail.com', '[{\"id\":4,\"name\":\"culpa\",\"quantity\":\"4\"}]', '2024-09-16 19:38:45', '2024-09-16 19:38:45'),
(10, 'andry', 'qw@weweewewwe.we', '[{\"id\":6,\"name\":\"nemo\",\"quantity\":\"10\"}]', '2024-09-16 19:39:25', '2024-09-16 19:39:25'),
(11, 'andry', 'bo6uch@gmail.com', '[{\"id\":3,\"name\":\"similique\",\"quantity\":\"4\"},{\"id\":8,\"name\":\"quis\",\"quantity\":\"6\"}]', '2024-09-16 19:41:11', '2024-09-16 19:41:11'),
(12, 'stepa', 'stepa@mail.ru', '[{\"id\":10,\"name\":\"et\",\"quantity\":\"6\"},{\"id\":7,\"name\":\"ex\",\"quantity\":\"3\"}]', '2024-09-16 19:42:37', '2024-09-16 19:42:37'),
(13, 'stepa', 'bo6uch@gmail.com', '[{\"id\":11,\"name\":\"amet\",\"quantity\":\"12\"}]', '2024-09-17 03:54:17', '2024-09-17 03:54:17'),
(14, 'stepa', 'bo6uch@gmail.com', '[{\"id\":2,\"name\":\"quasi\",\"quantity\":\"1\"},{\"id\":3,\"name\":\"similique\",\"quantity\":1}]', '2024-09-17 16:48:39', '2024-09-17 16:48:39'),
(15, 'andry', 'qw@weweewewwe.we', '[{\"id\":1,\"name\":\"hic\",\"quantity\":1}]', '2024-09-17 16:56:27', '2024-09-17 16:56:27'),
(16, 'andry', 'qw@weweewewwe.we', '[{\"id\":21,\"name\":\"dignissimos\",\"quantity\":\"4\"},{\"id\":9,\"name\":\"voluptas\",\"quantity\":\"3\"}]', '2024-09-17 17:00:49', '2024-09-17 17:00:49');

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'hic', 54.71, 2, '2024-09-16 06:59:47', '2024-09-17 16:56:27'),
(2, 'quasi', 36.30, 1, '2024-09-16 06:59:47', '2024-09-17 16:48:39'),
(3, 'similique', 16.13, 0, '2024-09-16 06:59:47', '2024-09-17 16:48:39'),
(4, 'culpa', 85.86, 3, '2024-09-16 06:59:47', '2024-09-16 19:38:45'),
(5, 'aspernatur', 54.36, 1, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(6, 'nemo', 41.06, 2, '2024-09-16 06:59:47', '2024-09-16 19:39:25'),
(7, 'ex', 43.93, 1, '2024-09-16 06:59:47', '2024-09-16 19:42:37'),
(8, 'quis', 85.54, 1, '2024-09-16 06:59:47', '2024-09-16 19:41:11'),
(9, 'voluptas', 7.08, 0, '2024-09-16 06:59:47', '2024-09-17 17:00:49'),
(10, 'et', 85.58, 3, '2024-09-16 06:59:47', '2024-09-16 19:42:37'),
(11, 'amet', 89.46, 3, '2024-09-16 06:59:47', '2024-09-17 03:54:17'),
(12, 'ipsum', 56.33, 20, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(13, 'tenetur', 87.48, 8, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(14, 'veritatis', 51.26, 6, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(15, 'qui', 82.67, 16, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(16, 'rerum', 97.01, 20, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(17, 'suscipit', 72.79, 10, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(18, 'harum', 48.89, 19, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(19, 'ut', 51.47, 6, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(20, 'non', 72.83, 10, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(21, 'dignissimos', 80.05, 5, '2024-09-16 06:59:47', '2024-09-17 17:00:49'),
(22, 'dolore', 85.55, 18, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(23, 'nihil', 96.57, 4, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(24, 'nesciunt', 42.61, 16, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(25, 'quos', 14.06, 7, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(26, 'maiores', 30.06, 10, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(27, 'aut', 74.30, 3, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(28, 'aut', 31.90, 14, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(29, 'aliquid', 52.41, 1, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(30, 'doloribus', 26.13, 13, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(31, 'quibusdam', 5.08, 6, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(32, 'magnam', 35.28, 10, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(33, 'nostrum', 6.72, 16, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(34, 'commodi', 42.51, 7, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(35, 'esse', 85.27, 17, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(36, 'facere', 59.35, 16, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(37, 'porro', 95.79, 12, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(38, 'qui', 27.49, 16, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(39, 'suscipit', 64.62, 13, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(40, 'iusto', 4.81, 6, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(41, 'deleniti', 16.19, 18, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(42, 'deleniti', 46.65, 19, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(43, 'et', 92.27, 14, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(44, 'animi', 1.54, 16, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(45, 'aut', 87.99, 20, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(46, 'laboriosam', 19.57, 17, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(47, 'unde', 81.54, 0, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(48, 'porro', 36.29, 4, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(49, 'voluptatem', 5.34, 17, '2024-09-16 06:59:47', '2024-09-16 06:59:47'),
(50, 'sit', 92.14, 19, '2024-09-16 06:59:47', '2024-09-16 06:59:47');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kXSCZxeBvNYFz7QEyQRx6HIFeHHR7PMMsGCZnbWF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYjUwOXV1NURpaWIzeTNsVFhhNUZzYjJFWXJ0T3JvR1l2cXh1Qlc1ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy8xMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToib3JkZXIiO2E6NDp7czoyOiJpZCI7aToxNjtzOjQ6Im5hbWUiO3M6NToiYW5kcnkiO3M6NToiZW1haWwiO3M6MTY6InF3QHdld2Vld2V3d2Uud2UiO3M6ODoicHJvZHVjdHMiO2E6Mjp7aTowO2E6Mzp7czoyOiJpZCI7aToyMTtzOjQ6Im5hbWUiO3M6MTE6ImRpZ25pc3NpbW9zIjtzOjg6InF1YW50aXR5IjtzOjE6IjQiO31pOjE7YTozOntzOjI6ImlkIjtpOjk7czo0OiJuYW1lIjtzOjg6InZvbHVwdGFzIjtzOjg6InF1YW50aXR5IjtzOjE6IjMiO319fX0=', 1726611095);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Индексы таблицы `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
