-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 15 2023 г., 18:14
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
-- База данных: `test_a25`
--

-- --------------------------------------------------------

--
-- Структура таблицы `a25_products`
--

CREATE TABLE `a25_products` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `PRICE` float NOT NULL,
  `TARIFF` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `a25_products`
--

INSERT INTO `a25_products` (`ID`, `NAME`, `PRICE`, `TARIFF`) VALUES
(1, 'Авто 1', 1000, 'a:4:{i:0;i:1000;i:10;i:900;i:15;i:800;i:30;i:700;}'),
(2, 'Авто 2', 1800, 'a:4:{i:0;i:2000;i:4;i:1800;i:11;i:1700;i:30;i:1500;}'),
(3, 'Авто 3', 2500, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `a25_settings`
--

CREATE TABLE `a25_settings` (
  `ID` int(11) NOT NULL,
  `set_key` varchar(100) NOT NULL,
  `set_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `a25_settings`
--

INSERT INTO `a25_settings` (`ID`, `set_key`, `set_value`) VALUES
(1, 'services', 'a:4:{s:27:\"детское кресло\";i:300;s:19:\"Мойка авто\";i:600;s:32:\"видеорегистратор\";i:100;s:18:\"антирадар\";i:0;}');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `a25_products`
--
ALTER TABLE `a25_products`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `a25_settings`
--
ALTER TABLE `a25_settings`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `a25_products`
--
ALTER TABLE `a25_products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `a25_settings`
--
ALTER TABLE `a25_settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
