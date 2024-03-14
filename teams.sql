-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 08 2024 г., 14:20
-- Версия сервера: 5.7.22-0ubuntu18.04.1
-- Версия PHP: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `quiz18`
--

-- --------------------------------------------------------

--
-- Структура таблицы `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `login` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `teamname` tinytext NOT NULL,
  `teamscore` float NOT NULL,
  `teampic` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teams`
--

INSERT INTO `teams` (`id`, `login`, `password`, `teamname`, `teamscore`, `teampic`) VALUES
(1, 'poni', '561aa32d2d907eadfc620b61e18121a0', 'Гарцующий пони', 0, '1'),
(2, 'legenda', 'c682f06c760f4476d19579348edfafbb', 'Легенда N17', 0, '2'),
(3, 'kadry', 'fa513b3dfb19f6dda3cddd421e756499', 'ВИА Еще те кадры', 0, '3'),
(4, 'ki2ch', 'b7538796cddd92004a9e0a969c6194df', 'Красавицы и 2 чудовища', 0, '4'),
(5, 'elementarno', '2cfb79fae6664eeba754d6a3f52e74cf', 'Элементарно', 0, '5'),
(6, 'karty', '8ee3250d576f5960ffa5325502b4206a', 'Карты, деньги, 2 скрипта', 0, '6'),
(7, 'credit', '8e5d7b97537bdbb3828fe051c2804fc9', 'Кредитная история', 0, '7'),
(8, 'pssn', '413b17e4e58e5cb756401419bba06ccf', 'ПССН', 0, '8'),
(9, 'oper', '37f0c05b03e5e16acf0491562a3bf5d0', 'Операционная', 0, '9'),
(10, 'kosmos', '260f49aa78c65129f80ad880a990db2c', 'КосМос', 0, '10'),
(11, 'glaz1', 'bc1d42b6ec36945d94fe493d39e7b3fc', 'Четкий глаз', 0, '11'),
(12, 'glaz2', '1b13bc100e1b5f2900f92bda88b6eca7', 'Мутный глаз', 0, '12'),
(13, 'amber', 'f213b8ba228bea1aef43d39b74353ab9', 'рок-группа Горцы из Амбера', 0, '13'),
(14, 'spasateli', '4cf7832ef8456ef604179f92cb285ec3', 'Спасатели', 0, '14'),
(15, 'krik', 'ab868b4aaccc97679c4186c4466ca353', 'КриК', 0, '15'),
(16, 'titany', '6681fc84c94cbc90ce5581662583fab2', 'Тактовые Титаны', 0, '16'),
(17, 'manager', 'e1b16e08d903399f2afcd5be6989bafc', 'Тыжменеджеры', 0, '17'),
(18, 'prosto', '28a318ca82c5c39a194335a6abac0347', 'Мы просто посмотреть', 0, '18'),
(0, 'admin', '3119c9d29692b8f7282d107ace91302e', 'Администратор', 0, 'admin'),
(20, 'assistant', '3119c9d29692b8f7282d107ace91302e', 'Ассистент', 0, 'assistant'),
(777, 'colvir', '3119c9d29692b8f7282d107ace91302e', 'Колвир', 0, '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


рок-группа Горцы из Амбера	amber	9IzuBjcP	f213b8ba228bea1aef43d39b74353ab9
Спасатели	spasateli	A094eKe3	4cf7832ef8456ef604179f92cb285ec3
КриК	krik	EXbql841	ab868b4aaccc97679c4186c4466ca353
Тактовые Титаны	titany	iRIFk882	6681fc84c94cbc90ce5581662583fab2
Тыжменеджеры	manager	fck7Cxyy	e1b16e08d903399f2afcd5be6989bafc
Мы просто посмотреть	prosto	dE79zTEn	28a318ca82c5c39a194335a6abac0347
