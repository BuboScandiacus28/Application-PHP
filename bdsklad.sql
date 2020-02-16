-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 16 2020 г., 19:30
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bdsklad`
--

-- --------------------------------------------------------

--
-- Структура таблицы `component`
--

CREATE TABLE `component` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Первичный ключ',
  `description` text NOT NULL COMMENT 'Описание',
  `cod` bigint(20) UNSIGNED NOT NULL COMMENT 'Номер по порядку',
  `lvl` tinyint(3) UNSIGNED NOT NULL COMMENT 'Углубленность'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `component`
--

INSERT INTO `component` (`id`, `description`, `cod`, `lvl`) VALUES
(1, 'Корень', 1, 0),
(2, 'Процессоры', 2, 1),
(3, 'Ryzen 3 1200', 3, 2),
(4, 'Ryzen 3 1200 BOX', 4, 2),
(5, 'Видеокарты', 5, 1),
(6, 'Nvidia GeForce GTX 1050 Ti', 6, 2),
(7, 'Заглушка', 7, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `component`
--
ALTER TABLE `component`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ', AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
