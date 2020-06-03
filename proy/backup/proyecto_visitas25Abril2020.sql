-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2020 a las 03:00:59
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_visitas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contador_diario`
--

CREATE TABLE `contador_diario` (
  `id_contadord` int(11) NOT NULL,
  `fk_ruta` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `numeroVisitas` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contador_diario`
--

INSERT INTO `contador_diario` (`id_contadord`, `fk_ruta`, `fecha`, `numeroVisitas`) VALUES
(1, 4, '2020-04-25 21:27:00', 85),
(2, 4, '2020-04-25 21:29:17', 15),
(3, 6, '2020-04-25 23:21:47', 2),
(4, 2, '2020-04-25 23:26:11', 200),
(5, 2, '2020-04-25 23:28:31', 150);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `nombrerutas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `nombrerutas` (
`id_ruta` int(11)
,`nombre` varchar(60)
,`rutaDesde` varchar(60)
,`rutaHasta` varchar(60)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portal`
--

CREATE TABLE `portal` (
  `id_portal` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `esPortal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `portal`
--

INSERT INTO `portal` (`id_portal`, `nombre`, `esPortal`) VALUES
(1, 'Portal Eldorado', 1),
(2, 'Terminal', 0),
(3, 'Alcalá', 0),
(4, 'Portal 20 de Julio', 1),
(5, 'Portal Usme', 1),
(6, 'Museo Nacional', 0),
(7, 'San Mateo', 0),
(8, 'Universidades', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `id_ruta` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `fk_origen` int(11) NOT NULL,
  `fk_destino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`id_ruta`, `nombre`, `fk_origen`, `fk_destino`) VALUES
(1, '1', 1, 8),
(2, 'M86', 1, 6),
(3, 'L10', 1, 4),
(4, 'H54', 1, 5),
(5, 'B23', 1, 3),
(6, 'B16', 1, 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `rutascontador`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `rutascontador` (
`id_contadord` int(11)
,`fecha` timestamp
,`numeroVisitas` int(11)
,`nombre` varchar(60)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `nombrerutas`
--
DROP TABLE IF EXISTS `nombrerutas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nombrerutas`  AS  select `ruta`.`id_ruta` AS `id_ruta`,`ruta`.`nombre` AS `nombre`,`desde`.`nombre` AS `rutaDesde`,`hasta`.`nombre` AS `rutaHasta` from ((`ruta` join `portal` `desde` on(`ruta`.`fk_origen` = `desde`.`id_portal`)) join `portal` `hasta` on(`ruta`.`fk_destino` = `hasta`.`id_portal`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `rutascontador`
--
DROP TABLE IF EXISTS `rutascontador`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rutascontador`  AS  select `contador_diario`.`id_contadord` AS `id_contadord`,`contador_diario`.`fecha` AS `fecha`,`contador_diario`.`numeroVisitas` AS `numeroVisitas`,`ruta`.`nombre` AS `nombre` from (`contador_diario` join `ruta` on(`contador_diario`.`fk_ruta` = `ruta`.`id_ruta`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contador_diario`
--
ALTER TABLE `contador_diario`
  ADD PRIMARY KEY (`id_contadord`),
  ADD KEY `fk_ruta_rel` (`fk_ruta`);

--
-- Indices de la tabla `portal`
--
ALTER TABLE `portal`
  ADD PRIMARY KEY (`id_portal`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `fk_ruta_or` (`fk_origen`),
  ADD KEY `fk_ruta_des` (`fk_destino`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contador_diario`
--
ALTER TABLE `contador_diario`
  MODIFY `id_contadord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `portal`
--
ALTER TABLE `portal`
  MODIFY `id_portal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contador_diario`
--
ALTER TABLE `contador_diario`
  ADD CONSTRAINT `fk_ruta_rel` FOREIGN KEY (`fk_ruta`) REFERENCES `ruta` (`id_ruta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `fk_ruta_des` FOREIGN KEY (`fk_destino`) REFERENCES `portal` (`id_portal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ruta_or` FOREIGN KEY (`fk_origen`) REFERENCES `portal` (`id_portal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
