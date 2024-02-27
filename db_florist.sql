-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 02 2023 г., 13:04
-- Версия сервера: 5.7.35-38
-- Версия PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cn37856_florist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `img_path` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(7) NOT NULL,
  `reduction` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `price` int(10) UNSIGNED NOT NULL,
  `info` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `img_path`, `name`, `type`, `reduction`, `price`, `info`) VALUES
(1, 'products/0c7412f3943ce1404d714b30afd7f552.jpg', 'Голландские тюльпаны', 'flowers', 10, 7920, 'Информацию может настроить админ в админ панели'),
(2, 'products/1b71e7dcbc65513911e1d057d0e25f7d.jpg', 'Мондиаль', 'flowers', 15, 5500, 'Информацию может настроить админ в админ панели'),
(4, 'products/726752ae3c43c65f4e6e9601701436ea.jpg', 'Голландские розы', 'flowers', 0, 15000, 'Информацию может настроить админ в админ панели'),
(5, 'products/45bdc39cf457b4218dc1a58f42863311.jpg', 'Пионы', 'flowers', 0, 15000, 'Информацию может настроить админ в админ панели'),
(6, 'products/beed7f5febb8daa2bd7ff2d9658a7673.jpg', 'Букет из ромашек', 'flowers', 0, 13000, 'Информацию может настроить админ в админ панели'),
(8, 'products/bc405f5518d677e6687ff3e3b5e15994.jpg', 'Гипсофилы', 'flowers', 0, 9700, 'Информацию может настроить админ в админ панели'),
(9, 'products/e7340b485ed5b1cc07ae729dd376c6f5.jpg', 'Букет из роз', 'flowers', 0, 9000, 'Информацию может настроить админ в админ панели'),
(10, 'products/bf6d67b85b7fa84369c5c62bc51e38e8.jpg', 'Открытки и записки', 'gifts', 0, 490, 'Информацию может настроить админ в админ панели'),
(11, 'products/b83b3237135369ce09b9a032ea8d7c51.jpg', 'Игрушки', 'gifts', 5, 3990, 'Информацию может настроить админ в админ панели'),
(12, 'products/0e10a11b67aa1ee6f9fe88cd91dfc88c.jpg', 'Бенто-торт с вашим дизайном', '', 5, 3590, 'бенто торт молочная девочка'),
(13, 'products/674a272922646b0e4e7477f32b5b3cc0.jpg', 'Ремонтантные розы', 'flowers', 5, 15000, 'Информацию может настроить админ в админ панели'),
(14, 'products/7dfab0ca7d9333dbb8dd6e2aebdb02ae.jpg', 'Фиолетовые тюльпаны', 'flowers', 20, 13000, 'Информацию может настроить админ в админ панели'),
(21, 'products/4baa47b6bbe51ae1962f73376545ebf2.jpg', 'бенто-торт', 'gifts', 0, 3590, 'бенто-торт');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(256) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `favourites` text,
  `cart` text,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `name`, `email`, `pass`, `admin`, `favourites`, `cart`) VALUES
(2, 'admin', 'Admin', 'admin@email.com', '2bf0ab730d32b91fe47d2f20a574e9ad', 1, ',8', ',3,2,8'),
(3, 'Qwerty', 'Акселеу', 'maksatakseleu@gmail.com', 'c01e58f821bda14a34294e2e0f6e9691', 0, '', ',2'),
(4, 'Alina', 'Alina', 'tashmuhanh@gmail.com', 'eee49ec108c9b3f86e70a7f2cb4c4579', 0, ',14', ',14,2'),
(5, 'Kudrat', 'Alina', 'alina20041312@gmail.com', '57f773027ffca6a70c27bfbaa49027f9', 0, ',14', ',14,21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
