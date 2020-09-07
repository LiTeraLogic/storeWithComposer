-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Авг 05 2020 г., 14:29
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `name_good` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name_good`, `price`, `info`) VALUES
(1, 'black dress', 1258, 'info 1'),
(2, 'blue dress', 5614, 'info 2'),
(3, 'T-shirt', 8156, 'info 3'),
(4, 'green slacks', 9523, 'onfo about green slacks'),
(81, 'good3', 500, 'info about good3'),
(83, 'New good3', 500, 'info about good3'),
(84, 'jacket2', 500, 'info about jacket2'),
(85, 'jacket3', 500, 'info about jacket3'),
(86, 'New jacket3', 500, 'info about jacket3'),
(88, 'New jacket3', 500, 'info about jacket3'),
(89, 'XDXC', 123, 'SDGSDG'),
(90, 'туц ', 123456, 'туц'),
(91, 'туц ', 123456, 'туц'),
(92, 'туц 2', 123456, 'туц2'),
(93, 'туц ', 11111, 'туц');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `price` varchar(250) NOT NULL,
  `tel` varchar(250) DEFAULT NULL,
  `order_data` json DEFAULT NULL,
  `status` varchar(64) DEFAULT '1' COMMENT 'Статус заказа 1-в рассмотрении, 2-доставк, 3-оплачен, 4-получен'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_name`, `address`, `price`, `tel`, `order_data`, `status`) VALUES
(16, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(17, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(18, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(19, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(20, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(21, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(22, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(23, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(24, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(25, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(26, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(27, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(28, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(29, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(30, 'ADMIN', 'CITY', '24468', '+79354965215', '{\"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(31, 'ADMIN', 'CITY', '15028', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 1}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 1}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(32, 'ADMIN', 'CITY', '15028', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 1}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 1}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(33, 'ADMIN', 'CITY', '15028', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 1}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 1}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(34, 'ADMIN', 'CITY', '15028', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 1}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 1}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(35, 'ADMIN', 'CITY', '15028', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 1}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 1}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(36, 'ADMIN', 'CITY', '15028', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 1}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 1}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(37, '123456', 'CITY', '23158', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 3}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 2}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(38, 'mefo', 'CITY', '23158', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 3}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 2}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(39, 'mefo2', 'CITY', '23158', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 3}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 2}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(40, 'ADMIN', 'CITY', '23158', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 3}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 2}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(41, 'ADMIN', 'CITY', '23158', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 3}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 2}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}}', '1'),
(42, 'ADMIN', 'CITY', '2516', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 2}}', '1'),
(43, 'qwerty', 'CITY', '2516', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 2}}', '1'),
(44, 'asdfg', 'CITY', '2516', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 2}}', '1'),
(45, 'zzzzzzzz', 'CITY', '2516', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 2}}', '1'),
(46, 'ADMIN', 'CITY', '11228', '+79354965215', '{\"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 2}}', '1'),
(47, 'ADMIN', 'CITY', '32598', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 2}, \"2\": {\"good\": {\"id\": \"2\", \"info\": \"info 2\", \"price\": \"5614\", \"nameGood\": \"blue dress\"}, \"count\": 1}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 3}}', '1'),
(48, 'ADMIN', 'CITY', '20195', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 2}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}, \"4\": {\"good\": {\"id\": \"4\", \"info\": \"onfo about green slacks\", \"price\": \"9523\", \"nameGood\": \"green slacks\"}, \"count\": 1}}', '1'),
(49, 'ADMIN123', 'CITY', '21453', '+79354965215', '{\"1\": {\"good\": {\"id\": \"1\", \"info\": \"info 1\", \"price\": \"1258\", \"nameGood\": \"black dress\"}, \"count\": 3}, \"3\": {\"good\": {\"id\": \"3\", \"info\": \"info 3\", \"price\": \"8156\", \"nameGood\": \"T-shirt\"}, \"count\": 1}, \"4\": {\"good\": {\"id\": \"4\", \"info\": \"onfo about green slacks\", \"price\": \"9523\", \"nameGood\": \"green slacks\"}, \"count\": 1}}', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL COMMENT 'Проверка на админа. 0-обычный пользователь, 1-админ',
  `address` varchar(250) DEFAULT NULL,
  `tel` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `is_admin`, `address`, `tel`) VALUES
(1, 'admin', '$2y$10$F8o694B6u.dkLMFybcwOKeoSAgqKol5P9DkwQQEcSlV37IWMA2.ia', 1, NULL, NULL),
(3, 'lili', '$2y$10$F8o694B6u.dkLMFybcwOKeoSAgqKol5P9DkwQQEcSlV37IWMA2.ia', 0, '', ''),
(4, 'cat', '$2y$10$h/H8paXz8./dSsnyC4d6NOABjIoQacudFkFR44O.P2p2uG5P/IOTe', 0, 'london', '+765412358'),
(5, 'admi', '123', 1, NULL, NULL),
(6, 'qwerty', '$2y$10$9/yk6uFWIUZ6k9rgzUSapuVIyeF3Eqd8PEpyVOzz0jjUyjNfHlsDe', 0, 'Orel', '+765412358'),
(7, 'qwer', '$2y$10$QKkYcR.OsecWrXgutj8wnOqNoEfq3Wy0yoRm7tVIquAcYMlJLNp66', 0, 'qwerty', '+765412358'),
(8, 'test', '123', 0, 'test', '+70000000000');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
