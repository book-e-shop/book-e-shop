-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 17 2020 г., 16:32
-- Версия сервера: 10.4.14-MariaDB
-- Версия PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `book_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `addresses`
--

CREATE DATABASE book_shop;

CREATE TABLE `addresses` (
  `id` int(11) UNSIGNED NOT NULL,
  `zip_code` int(11) UNSIGNED DEFAULT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_main_address` tinyint(1) UNSIGNED DEFAULT NULL,
  `users_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `zip_code`, `region`, `district`, `city`, `street`, `house`, `is_main_address`, `users_id`) VALUES
(1, 11111, 'Волгоградская область', 'Волгоград', 'г. Волгоград', '-', '-', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `genre` enum('Детектив','Любовный роман','Учебная и образовательная литература','Классическая литература','Биографии и мемуары') DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `cover_type` enum('Твердый переплет','Мягкий переплет') DEFAULT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `size_in_pages` decimal(10,0) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `cover` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `description`, `author`, `genre`, `release_date`, `cover_type`, `ISBN`, `publisher`, `language`, `size_in_pages`, `price`, `cover`) VALUES
(1, 'Десять негритят', 'Роман \"Десять негритят\" – одно из величайших детективных произведений в истории. Выпущенный общим тиражом более 100 000 000 экземпляров, он занимает пятое место в списке бестселлеров художественной литературы всех времен и безусловное первое место среди романов самой Агаты Кристи. Десять никак не связанных между собой людей в особняке на уединенном острове... Кто вызвал их сюда таинственным приглашением? Зачем кто-то убивает их, одного за другим, самыми невероятными способами? Почему все происходящее так тесно переплетено с веселым детским стишком?', 'Агата Кристи', 'Детектив', '1988-01-31', 'Твердый переплет', ' 978-5-04-107', ' Эксмо', 'Русский', '256', '328', 'www/media/5fa260ef03abe.jpeg'),
(2, 'Капитанская дочка', 'История любви Петра Гринева и Марии Мироновой, главных героев \"Капитанской дочки\", вплетена в ход действий восстания Емельяна Пугачева. \"Не приведи бог видеть русский бунт, бессмысленный и беспощадный!\" - писал А. Пушкин, потрясенный жестокостью крестьянского мятежа, произошедшего летом 1831 года, в одной из глав \"Капитанской дочки\". Изучение материалов дела Ем. Пугачева, поездки по местам событий помогли сформироваться замыслу исторического романа.\r\nИменно в \"Капитанской дочке\" автор провозгласил основной жизненный принцип, который поможет выстоять всегда, а сформулирован этот принцип был в русской поговорке \"Береги честь смолоду\", и ставшей эпиграфом к книге.', 'Александр Пушкин', 'Классическая литература', '2020-02-08', 'Твердый переплет', ' 978-5-04-112', ' Эксмо', 'Русский', '320', '225', 'www/media/5fa261c51bf6d.jpg'),
(3, 'Шерлок Холмс', 'В это подарочное издание вошли самые лучшие и интересные произведения Артура Конан Дойла о Шерлоке Холмсе и докторе Ватсоне — повести «Этюд в багровых тонах» и «Собака Баскервилей», а также рассказы из сборников разных лет. В послесловии «Труды и дни сэра Артура Конан Дойла» приведены факты жизненного пути, а также библиография одного из самых популярных писателей прошлого века.', 'Артур Конан Дойл', 'Детектив', '2019-08-08', 'Твердый переплет', ' 978-5-604149', 'Лениздат', 'Русский', '512', '2028', 'www/media/5fa2918079e4d.jpg'),
(4, 'Три товарища', 'Самый красивый в двадцатом столетии роман о любви... Самый увлекательный в двадцатом столетии роман о дружбе... Самый трагический и пронзительный роман о человеческих отношениях за всю историю двадцатого столетия.', 'Эрих Мария Ремарк', 'Классическая литература', '2018-09-09', 'Мягкий переплет', '978-5-17-1085', 'АСТ', 'Русский', '480', '356', 'www/media/5fa292b9533bb.jpg'),
(6, 'Убийство в \"Восточном экспрессе\"', 'Самый знаменитый роман Агаты Кристи!\r\nНаходившийся в Стамбуле великий сыщик Эркюль Пуаро возвращается в Англию на знаменитом \"Восточном экспрессе\", в котором вместе с ним едут, кажется, представители всех возможных национальностей. Один из пассажиров, неприятный американец по фамилии Рэтчетт, предлагает Пуаро стать своим телохранителем, поскольку считает, что его должны убить. Знаменитый бельгиец отмахивается от этой абсурдной просьбы. А на следующий день американца находят мертвым в своем купе, причем двери закрыты, а окно открыто. Пуаро немедленно берется за расследование - и выясняет, что купе полно всевозможных улик, указывающих… практически на всех пассажиров \"Восточного экспресса\". Вдобавок поезд наглухо застревает в снежных заносах в безлюдном месте. Пуаро необходимо найти убийцу до того, как экспресс продолжит свой путь…', 'Агата Кристи', 'Детектив', '2017-07-08', 'Твердый переплет', '978-5-04-0889', ' Издательство Э', 'Русский', '320', '480', 'www/media/5fa29c50372d6.jpg'),
(20, 'Тарас Бульба', 'Повесть Н. В. Гоголя «Тарас Бульба» уже современники сопоставляли с гомеровским эпосом.\r\nКак и автор «Илиады», Гоголь отталкивается от исторических событий и придает им эпические масштабы. \r\nМужество, непреклонная воля, недюжинная сила и любовь к отечеству — черты истинных героев в «Тарасе Бульбе». \r\nМожет быть, поэтому яркие образы, созданные Гоголем в этой повести, оказываются столь привлекательными для читателей.', 'Гоголь Николай', 'Классическая литература', '2020-01-01', 'Мягкий переплет', '978-5-389-03075-6', 'Азбука', 'Русский', '320', '150', 'www/media/5fa43797ca5f3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `publish_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `book_id`, `user_id`, `title`, `review`, `author`, `publish_date`) VALUES
(1, 1, 2, 'qfq', 'fqfq', 'Денис Медведев', '2020-11-16'),
(3, 1, 2, 'dw', 'dw', 'Денис Медведев', '2020-11-16'),
(4, 1, 2, '1', '1', 'Денис Медведев', '2020-11-16'),
(5, 6, 2, 'vvr', 'brb', 'Денис Медведев', '2020-11-16'),
(6, 6, 2, '111', '111', 'Денис Медведев', '2020-11-16'),
(7, 4, 2, 'Рецензия', '# Описание\r\n## 1\r\n\r\n# 124', 'Денис Медведев', '2020-11-17');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `name`, `surname`, `password`) VALUES
(1, 'medvedev', 'test@test.test', 'Денис', 'Медведев', '$2y$10$VhQy4k9LxYv21ayhJ5roru.MY55.cFJs/JrYUodzekgfJ1BZIawRC'),
(2, 'login', 'tea@tea.com', 'Денис', 'Медведев', '$2y$10$72pf63RjFA4HwUFU0PpEqObIfol5MTEsJMovprcJpQ2/V6uq4KI/G');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_addresses_users` (`users_id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `c_fk_addresses_users_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
