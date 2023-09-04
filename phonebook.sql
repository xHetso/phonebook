-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 03 2023 г., 16:12
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phonebook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `organization`
--

CREATE TABLE `organization` (
  `phone_number` varchar(20) DEFAULT NULL,
  `organization_name` varchar(100) DEFAULT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `house_number` varchar(20) DEFAULT NULL,
  `apartment_number` varchar(20) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `organization`
--

INSERT INTO `organization` (`phone_number`, `organization_name`, `department_name`, `country`, `city`, `street`, `house_number`, `apartment_number`, `id`) VALUES
('+7 702 987 6543', 'Компания 2', 'Отдел B', 'Казахстан', 'Нур-Султан', 'Проспект Абая', '567', '89', 2),
('+7 705 555 4444', 'Компания 3', 'Отдел C', 'Казахстан', 'Шымкент', 'Улица Тимирязева', '789', '12', 3),
('+7 707 777 8888', 'Компания 4', 'Отдел D', 'Казахстан', 'Актобе', 'Площадь Республики', '345', '67', 4),
('+7 700 999 3333', 'Компания 5', 'Отдел E', 'Казахстан', 'Караганда', 'Улица Желтоксана', '234', '56', 5),
('+77777777777', 'INCORE', 'DC', 'sadas', 'sadasdasd', 'sadasd', 'sadasd', 'sdads', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `private_person`
--

CREATE TABLE `private_person` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `patronymic` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `private_person`
--

INSERT INTO `private_person` (`id`, `phone_number`, `last_name`, `first_name`, `patronymic`) VALUES
(7, '+77778901234', 'Лебедев', 'Артем', 'Владимирович'),
(8, '+77779012345', 'Морозов', 'Антон', 'Николаевич'),
(9, '+77770123456', 'Новиков', 'Игорь', 'Сергеевич'),
(10, '+77777777777', 'ывфы', 'фывыф', 'ывыф'),
(14, '+77777777777', 'sdasd', 'sadsada', 'Петрович'),
(15, '+77777777777', 'sdasd', 'фывыф', 'Петрович'),
(16, '+77773464706', 'ывфы', 'фывыф', 'Петровичы'),
(17, '+77773464706', 'ывфы', 'фывыф', 'Петровичы'),
(18, '+77777777777', 'sdasd', 'фывыф', 'Петровичы'),
(19, '8777777777', 'Кубиев', 'фывыф', 'Петрович');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(10) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password_hash`, `is_admin`) VALUES
(1, 'user2', '6cf615d5bcaac778352a8f1f3360d23f02f34ec182e259897fd6ce485d7870d4', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `private_person`
--
ALTER TABLE `private_person`
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
-- AUTO_INCREMENT для таблицы `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `private_person`
--
ALTER TABLE `private_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
