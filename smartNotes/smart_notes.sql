-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 12 2020 г., 15:16
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `smart_notes`
--

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `_date` date NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id`, `userid`, `_date`, `name`, `content`) VALUES
(1, 7, '2020-01-02', 'Laundry', 'Do the laundry at 6 pm'),
(2, 8, '2019-12-31', 'New year', 'Have a good time with family in the new year eve!'),
(5, 8, '2020-01-15', 'Lyceum', 'Oh, no I need to go to goddamn\' lyceum :('),
(6, 12, '2020-01-11', 'Поезд', 'Возвращение в Киев'),
(8, 7, '2020-01-07', 'foo', 'laurem ipsum'),
(11, 7, '2020-01-11', 'Go to play game', 'financial game, actually'),
(12, 7, '2020-01-08', 'EZ note', 'can it trim perfectly?'),
(17, 7, '2020-01-09', 'laurem', 'Laoreet magnis orci morbi cursus convallis metus aenean arcu nascetur platea euismod nec sociosqu, ornare class curabitur nibh risus nullam sem per cras condimentum pellentesque. Aptent volutpat ad egestas cum vel dictumst auctor varius, nullam faucibus platea tellus metus praesent sagittis, vehicula est cubilia neque sem primis facilisi. Proin lacinia mi hendrerit fringilla leo hac ridiculus nostra dapibus tempor, pretium facilisis diam velit varius sodales sollicitudin nascetur penatibus dictum rutrum, quisque luctus congue eu donec platea habitant cras nibh.'),
(19, 7, '2020-01-08', 'new Laurem', 'Lorem ipsum dolor sit amet consectetur adipiscing, elit a hendrerit neque mus aliquam, mi pellentesque consequat non dapibus. Risus suscipit odio sagittis curae tincidunt ullamcorper suspendisse, class imperdiet ad purus quisque faucibus. Ad vivamus sociis ligula bibendum justo suscipit class fringilla vehicula, neque rhoncus torquent ridiculus donec ut vestibulum vitae sed, arcu leo per morbi luctus ac et dictum. Elementum scelerisque libero primis nisi ut porta vulputate quam tellus fermentum, tempor non placerat urna fusce platea dui aliquam etiam.'),
(23, 7, '2020-01-11', 'Интерсити+', 'поезд в киев');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pw` varchar(65) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `pw`, `comment`) VALUES
(1, 'Crunchy Crunch', 'BAMF@mail.ru', 'lelkek', ''),
(7, 'SteaMPunK', 'nikitaisikov90@gmail.com', 'eatthefrog', ''),
(8, 'ReelNiceGuy', 'vlad@ukr.net', 'qwerty', ''),
(9, 'foobar', 'foo@mail.ru', '123456', ''),
(12, 'elenka', 'elenka.isik@gmail.com', '22061911', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
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
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
