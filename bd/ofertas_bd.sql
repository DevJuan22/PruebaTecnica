-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 04-04-2025 a las 00:04:14
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
-- Base de datos: `ofertas_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `oferta_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `ruta_archivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `objeto` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `moneda` varchar(10) NOT NULL,
  `presupuesto` decimal(15,2) NOT NULL,
  `actividad` varchar(255) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `estado` enum('ACTIVO','PUBLICADO','EVALUACIÓN') DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `objeto`, `descripcion`, `moneda`, `presupuesto`, `actividad`, `fecha_inicio`, `fecha_cierre`, `estado`, `created_at`) VALUES
(1, '', '', '', 0.00, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2025-04-01 19:18:27'),
(3, '', '', '', 0.00, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2025-04-01 19:32:31'),
(4, 'Compra de computadoras', 'Compra de laptops gamer', 'USD', 6000.00, 'Tecnología', '2025-04-02 09:00:00', '2025-04-06 19:00:00', 'PUBLICADO', '2025-04-02 23:33:00'),
(5, 'Compra de carro', 'venta de carro ulitmo modelo', 'USD', 20000.00, 'Vehiculo', '2025-10-20 14:00:00', '2025-11-20 02:00:00', 'ACTIVO', '2025-04-02 23:49:46'),
(6, 'dsds', 'sds', 'EUR', 2211.00, 'dsad', '2000-01-01 14:02:00', '2000-01-01 02:02:00', 'EVALUACIÓN', '2025-04-03 00:14:30'),
(7, 'dsadassdads', 'dsad', 'EUR', 31313123123.00, 'dadsada', '1333-12-13 00:00:00', '3132-02-13 00:00:00', 'ACTIVO', '2025-04-03 21:38:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oferta_id` (`oferta_id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
