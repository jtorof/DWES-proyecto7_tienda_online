-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-11-2021 a las 18:43:35
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydbtest4`
--
CREATE DATABASE IF NOT EXISTS `mydbtest4` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mydbtest4`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orderlines`
--

DROP TABLE IF EXISTS `orderlines`;
CREATE TABLE `orderlines` (
  `id` int(6) NOT NULL,
  `orderid` int(6) DEFAULT NULL,
  `productid` int(6) NOT NULL,
  `quantity` int(6) NOT NULL,
  `userid` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orderlines`
--

INSERT INTO `orderlines` (`id`, `orderid`, `productid`, `quantity`, `userid`) VALUES
(56, 33, 3, 11, 2),
(57, 34, 3, 11, 2),
(58, 35, 3, 12, 2),
(59, 36, 3, 12, 2),
(60, 37, 3, 12, 2),
(61, 38, 3, 11, 2),
(62, 39, 3, 11, 2),
(63, 40, 3, 1, 2),
(64, 40, 4, 1, 2),
(65, 40, 5, 1, 2),
(66, 40, 6, 1, 2),
(67, 41, 3, 11, 2),
(68, 42, 3, 10, 2),
(69, 43, 3, 10, 2),
(70, 44, 3, 10, 2),
(72, 47, 3, 12, 2),
(73, NULL, 3, 13, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(6) NOT NULL,
  `customerid` int(6) NOT NULL,
  `totalcost` int(6) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `customerid`, `totalcost`, `date`, `status`) VALUES
(40, 2, 10, '2021-11-22', 'confirmado'),
(41, 2, NULL, '2021-11-22', 'stock insuficiente'),
(42, 2, NULL, '2021-11-22', 'stock insuficiente'),
(43, 2, NULL, '2021-11-22', 'stock insuficiente'),
(44, 2, NULL, '2021-11-22', 'stock insuficiente'),
(45, 2, NULL, '2021-11-22', 'stock insuficiente'),
(46, 2, NULL, '2021-11-22', 'stock insuficiente'),
(47, 2, NULL, '2021-11-22', 'stock insuficiente'),
(48, 2, NULL, '2021-11-22', 'stock insuficiente'),
(49, 2, NULL, '2021-11-22', 'stock insuficiente'),
(50, 2, NULL, '2021-11-22', 'stock insuficiente'),
(51, 2, NULL, '2021-11-22', 'stock insuficiente'),
(52, 2, NULL, '2021-11-22', 'stock insuficiente'),
(53, 2, NULL, '2021-11-22', 'stock insuficiente'),
(54, 2, NULL, '2021-11-22', 'stock insuficiente'),
(55, 2, NULL, '2021-11-22', 'stock insuficiente'),
(56, 2, NULL, '2021-11-22', 'stock insuficiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` int(6) NOT NULL,
  `stock` int(6) NOT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `hidden`) VALUES
(3, 'Producto 1', 'p1', 1, 9, 0),
(4, 'Producto 2', 'p2', 2, 19, 0),
(5, 'Producto 3', 'p3', 3, 29, 0),
(6, 'Producto 4', 'p4', 4, 39, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `email` varchar(50) NOT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `role`, `email`, `hidden`) VALUES
(1, 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', 2, 'admin@admin', 0),
(2, 'Qwe Qwe', 'qwe', '76d80224611fc919a5d54f0ff9fba446', 1, 'qwe@qwe', 0),
(3, 'Asd Asd', 'asd', '7815696ecbf1c96e6894b779456d330e', 1, 'asd@asd', 0),
(4, 'Zxc Zxc', 'zxc', '5fa72358f0b4fb4f2c5d7de8c9a41846', 1, 'zxc@zxc', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orderlines`
--
ALTER TABLE `orderlines`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orderlines`
--
ALTER TABLE `orderlines`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
