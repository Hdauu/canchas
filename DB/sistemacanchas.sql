-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2024 a las 19:32:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemacanchas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_tel` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_tel`) VALUES
(1, 'fran', 1253651);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `field`
--

CREATE TABLE `field` (
  `field_id` int(11) NOT NULL,
  `FieldType_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `field`
--

INSERT INTO `field` (`field_id`, `FieldType_id`) VALUES
(5, 1),
(6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fieldtype`
--

CREATE TABLE `fieldtype` (
  `FieldType_id` int(11) NOT NULL,
  `FieldType_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `fieldtype`
--

INSERT INTO `fieldtype` (`FieldType_id`, `FieldType_name`) VALUES
(1, 'Fútbol 5'),
(4, 'Fútbol 11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_for_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `field_id` int(11) NOT NULL,
  `reservation_duration` int(11) NOT NULL,
  `reservation_paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `customer_id`, `reservation_date`, `reservation_for_date`, `reservation_time`, `field_id`, `reservation_duration`, `reservation_paid`) VALUES
(29, 1, '2024-11-19', '2024-11-19', '16:00:00', 5, 1, 1),
(30, 1, '2024-11-19', '2024-11-20', '16:00:00', 6, 1, 1),
(31, 1, '2024-11-19', '2024-11-20', '16:00:00', 5, 1, 1),
(32, 1, '2024-11-22', '2024-11-23', '16:00:00', 5, 1, 1),
(33, 1, '2024-11-26', '2024-11-26', '16:00:00', 5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`) VALUES
(1, 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indices de la tabla `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`field_id`),
  ADD KEY `FieldType_id` (`FieldType_id`);

--
-- Indices de la tabla `fieldtype`
--
ALTER TABLE `fieldtype`
  ADD PRIMARY KEY (`FieldType_id`);

--
-- Indices de la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `field_id` (`field_id`),
  ADD KEY `field_id_2` (`field_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `field`
--
ALTER TABLE `field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `fieldtype`
--
ALTER TABLE `fieldtype`
  MODIFY `FieldType_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `field_ibfk_1` FOREIGN KEY (`FieldType_id`) REFERENCES `fieldtype` (`FieldType_id`);

--
-- Filtros para la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `field` (`field_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
