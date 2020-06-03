-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2020 a las 04:21:38
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

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
(5, 2, '2020-04-25 23:28:31', 150),
(6, 7, '2020-05-23 00:38:39', 3),
(7, 9, '2020-05-23 00:39:09', 1);

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
  `esPortal` tinyint(1) NOT NULL DEFAULT 0,
  `urlFondo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `portal`
--

INSERT INTO `portal` (`id_portal`, `nombre`, `esPortal`, `urlFondo`) VALUES
(1, 'Portal Eldorado', 1, 'img/portalDorado.jpg'),
(2, 'Terminal', 0, ''),
(3, 'Alcalá', 0, ''),
(4, 'Portal 20 de Julio', 1, 'img/portal20Dejulio.jpg'),
(5, 'Portal Usme', 1, 'img/portalUsme.jpg'),
(6, 'Museo Nacional', 0, ''),
(7, 'San Mateo', 0, ''),
(8, 'Universidades', 0, ''),
(9, 'Portal Norte', 1, 'img/portalNorte.jpg'),
(10, 'Aeropuerto', 0, ''),
(11, 'Concejo de Bogota', 0, ''),
(12, 'Portal Americas', 0, 'img/portalAmericas.jpg'),
(13, 'Portal Suba', 0, 'img/portalSuba.jpg'),
(14, 'Portal del Sur', 0, 'img/portalSur.jpg'),
(15, 'Portal de la 80', 0, 'img/portal80.jpg'),
(16, 'Portal Tunal', 0, 'img/portalTunal.jpg'),
(17, 'Portal De Suba', 1, 'Subaportal'),
(18, 'Toberin', 0, 'Toberin'),
(19, 'Clínica El Bosque', 0, 'Clínica El Bosque'),
(20, 'Heroes', 0, 'Heroes'),
(21, 'Flores', 0, 'Flores'),
(22, 'Granja - Carrera 77', 0, 'Granja - Carrera 77'),
(23, 'Calle 22', 0, ' Calle 22'),
(24, 'Las Aguas', 0, ' Las Aguas'),
(25, 'NQS - Calle 75', 0, 'NQS - Calle 75'),
(26, 'Banderas', 0, 'Banderas'),
(27, ' Calle 161', 0, ' Calle 161'),
(28, 'Santa Isabel', 0, 'Santa Isabel'),
(29, 'Guatoque - Veraguas', 0, 'Guatoque - Veraguas');

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
(6, 'B16', 1, 2),
(7, 'B75', 5, 9),
(8, 'K86', 1, 10),
(9, '3', 5, 11),
(10, 'K10', 4, 1),
(11, 'K54', 5, 1),
(12, 'D20', 5, 15),
(13, 'C17', 5, 13),
(14, 'D51', 5, 15),
(15, 'B72', 5, 18),
(16, 'M82', 4, 19),
(17, 'B18', 4, 2),
(18, '2', 4, 6),
(19, 'D21', 16, 15),
(20, 'C15', 16, 13),
(21, 'B27', 16, 9),
(22, 'B13', 16, 9),
(23, 'B71', 16, 18),
(24, 'J24', 15, 8),
(25, 'B10', 15, 9),
(26, 'H21', 15, 16),
(27, 'H20', 15, 5),
(28, '6', 15, 8),
(29, 'B55', 15, 20),
(30, 'G22', 15, 14),
(31, 'A52', 14, 21),
(32, 'M47', 14, 6),
(33, 'B11', 14, 2),
(34, 'G45', 14, 7),
(35, 'D22', 14, 15),
(36, 'B12', 14, 9),
(37, '4', 14, 20),
(38, 'C30', 14, 13),
(39, 'D50', 12, 15),
(40, '5', 12, 23),
(41, 'C29', 12, 17),
(42, 'M51', 12, 6),
(43, 'J23', 12, 24),
(44, 'B52', 12, 3),
(45, 'B14', 12, 9),
(46, 'E32', 12, 25),
(47, 'B28', 12, 9),
(48, 'F29', 17, 12),
(49, 'F19', 17, 26),
(50, 'J73', 17, 8),
(51, 'B50', 17, 27),
(52, 'B56', 17, 20),
(53, 'H17', 17, 5),
(54, 'H15', 17, 16),
(55, '7', 17, 28),
(56, 'G30', 17, 14),
(57, 'F14', 9, 12),
(58, '8', 9, 29),
(59, 'D10', 9, 15),
(60, 'F28', 9, 12),
(61, 'J70', 9, 24),
(62, 'J74', 9, 24),
(63, 'G12', 9, 14),
(64, 'G44', 9, 7),
(65, 'H75', 9, 5),
(66, 'H27', 9, 16),
(67, 'H13', 9, 16);

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
  MODIFY `id_contadord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `portal`
--
ALTER TABLE `portal`
  MODIFY `id_portal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

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
