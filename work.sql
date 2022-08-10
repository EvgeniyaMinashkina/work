-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 08 2022 г., 07:22
-- Версия сервера: 8.0.29
-- Версия PHP: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `4works`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(6,2) UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '0',
  `manufacturer` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `quantity`, `manufacturer`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, '20.02', 10, 'manufacturer 1', '2022-06-06 12:42:24', '2022-06-06 12:42:24'),
(3, 'Product one more', 'description', NULL, '12.00', 26, 'Brand', '2022-06-07 09:18:18', '2022-06-07 09:18:18'),
(6, 'test product jhghj', '', NULL, '0.00', 0, 'some brand', '2022-06-07 11:01:02', '2022-06-07 11:01:02'),
(7, 'test product', '', NULL, '0.00', 0, 'some brand', '2022-06-07 11:03:11', '2022-06-07 11:03:11'),
(8, 'test product', '', NULL, '0.00', 0, 'some brand', '2022-06-07 11:04:11', '2022-06-07 11:04:11'),
(9, 'test product 6', '', NULL, '45.00', 122, 'Cat', '2022-06-07 11:04:48', '2022-06-07 11:04:48'),
(11, 'test product fdgdf', '', NULL, '0.00', 0, 'dfgdfg', '2022-06-07 11:07:23', '2022-06-07 11:07:23'),
(13, 'test product fdgdf', '', NULL, '0.00', 0, 'dfgdfg', '2022-06-07 11:08:47', '2022-06-07 11:08:47'),
(14, 'rrtrtytry', '', NULL, '0.00', 0, 'trytry', '2022-06-07 11:13:06', '2022-06-07 11:13:06'),
(15, 'fgh', '', NULL, '0.00', 0, 'fgh', '2022-06-07 17:19:14', '2022-06-07 17:19:14'),
(16, 'ere', '', NULL, '45.00', 6, 'erherh', '2022-06-07 17:23:56', '2022-06-07 17:23:56'),
(23, 'Some', '', NULL, '0.02', 0, 'svdsv', '2022-06-08 04:16:21', '2022-06-08 04:16:21');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`, `is_admin`) VALUES
(12, 'admin@gmail.com', '$2y$10$WKivvhiTtXpvfxXqc/V3pO6P507p6eZyHIw8I28nYShpEjWcQ81am', '2022-06-08 03:36:05', '2022-06-08 03:36:05', 1),
(13, 'user@gmail.com', '$2y$10$pvCK.4ZA9HVE/A3koUFW8etarOmnbdAw6jf1jw3MB5PN6CW.zf1uO', '2022-06-08 03:36:51', '2022-06-08 03:36:51', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
