-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for proyecto_visitas
CREATE DATABASE IF NOT EXISTS `proyecto_visitas` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `proyecto_visitas`;

-- Dumping structure for table proyecto_visitas.administrador
CREATE TABLE IF NOT EXISTS `administrador` (
  `id_admin` varchar(255) DEFAULT NULL COMMENT 'uuid',
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'encriptada con hash',
  `nombre` varchar(50) DEFAULT NULL,
  `e-mail` varchar(50) NOT NULL,
  `creado_el` date DEFAULT NULL,
  `actualizado_el` date DEFAULT NULL,
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `e-mail` (`e-mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping structure for table proyecto_visitas.portal
CREATE TABLE IF NOT EXISTS `portal` (
  `id_portal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `esPortal` tinyint(1) NOT NULL DEFAULT 0,
  `urlFondo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_portal`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table proyecto_visitas.portal: ~29 rows (approximately)
/*!40000 ALTER TABLE `portal` DISABLE KEYS */;
REPLACE INTO `portal` (`id_portal`, `nombre`, `esPortal`, `urlFondo`) VALUES
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
	(12, 'Portal Americas', 1, 'img/portalAmericas.jpg'),
	(13, 'Portal Suba', 1, 'img/portalSuba.jpg'),
	(14, 'Portal del Sur', 1, 'img/portalSur.jpg'),
	(15, 'Portal de la 80', 1, 'img/portal80.jpg'),
	(16, 'Portal Tunal', 1, 'img/portalTunal.jpg'),
	(17, 'Portal De Suba', 1, 'img/portalSuba.jpg'),
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
/*!40000 ALTER TABLE `portal` ENABLE KEYS */;

-- Dumping structure for table proyecto_visitas.ruta
CREATE TABLE IF NOT EXISTS `ruta` (
  `id_ruta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `fk_origen` int(11) NOT NULL,
  `fk_destino` int(11) NOT NULL,
  `fk_transito` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ruta`),
  KEY `fk_ruta_or` (`fk_origen`),
  KEY `fk_ruta_des` (`fk_destino`),
  KEY `fk_ruta_por_tran` (`fk_transito`),
  CONSTRAINT `fk_ruta_des` FOREIGN KEY (`fk_destino`) REFERENCES `portal` (`id_portal`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ruta_or` FOREIGN KEY (`fk_origen`) REFERENCES `portal` (`id_portal`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ruta_por_tran` FOREIGN KEY (`fk_transito`) REFERENCES `portal` (`id_portal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table proyecto_visitas.ruta: ~67 rows (approximately)
/*!40000 ALTER TABLE `ruta` DISABLE KEYS */;
REPLACE INTO `ruta` (`id_ruta`, `nombre`, `fk_origen`, `fk_destino`, `fk_transito`) VALUES
	(1, '1', 1, 8, NULL),
	(2, 'M86', 1, 6, NULL),
	(3, 'L10', 1, 4, NULL),
	(4, 'H54', 1, 5, NULL),
	(5, 'B23', 1, 3, NULL),
	(6, 'B16', 1, 2, NULL),
	(7, 'B75', 5, 9, NULL),
	(8, 'K86', 1, 10, NULL),
	(9, '3', 5, 11, NULL),
	(10, 'K10', 4, 1, NULL),
	(11, 'K54', 5, 1, NULL),
	(12, 'D20', 5, 15, NULL),
	(13, 'C17', 5, 13, NULL),
	(14, 'D51', 5, 15, NULL),
	(15, 'B72', 5, 18, NULL),
	(16, 'M82', 4, 19, NULL),
	(17, 'B18', 4, 2, NULL),
	(18, '2', 4, 6, NULL),
	(19, 'D21', 16, 15, NULL),
	(20, 'C15', 16, 13, NULL),
	(21, 'B27', 16, 9, NULL),
	(22, 'B13', 16, 9, NULL),
	(23, 'B71', 16, 18, NULL),
	(24, 'J24', 15, 8, NULL),
	(25, 'B10', 15, 9, NULL),
	(26, 'H21', 15, 16, NULL),
	(27, 'H20', 15, 5, NULL),
	(28, '6', 15, 8, NULL),
	(29, 'B55', 15, 20, NULL),
	(30, 'G22', 15, 14, NULL),
	(31, 'A52', 14, 21, NULL),
	(32, 'M47', 14, 6, NULL),
	(33, 'B11', 14, 2, NULL),
	(34, 'G45', 14, 7, NULL),
	(35, 'D22', 14, 15, NULL),
	(36, 'B12', 14, 9, NULL),
	(37, '4', 14, 20, NULL),
	(38, 'C30', 14, 13, NULL),
	(39, 'D50', 12, 15, NULL),
	(40, '5', 12, 23, NULL),
	(41, 'C29', 12, 17, NULL),
	(42, 'M51', 12, 6, NULL),
	(43, 'J23', 12, 24, NULL),
	(44, 'B52', 12, 3, NULL),
	(45, 'B14', 12, 9, NULL),
	(46, 'E32', 12, 25, NULL),
	(47, 'B28', 12, 9, NULL),
	(48, 'F29', 17, 12, NULL),
	(49, 'F19', 17, 26, NULL),
	(50, 'J73', 17, 8, NULL),
	(51, 'B50', 17, 27, NULL),
	(52, 'B56', 17, 20, NULL),
	(53, 'H17', 17, 5, NULL),
	(54, 'H15', 17, 16, NULL),
	(55, '7', 17, 28, NULL),
	(56, 'G30', 17, 14, NULL),
	(57, 'F14', 9, 12, NULL),
	(58, '8', 2, 29, 9),
	(59, 'D10', 9, 15, NULL),
	(60, 'F28', 9, 12, NULL),
	(61, 'J70', 9, 24, NULL),
	(62, 'J74', 9, 24, NULL),
	(63, 'G12', 9, 14, NULL),
	(64, 'G44', 9, 7, NULL),
	(65, 'H75', 9, 5, NULL),
	(66, 'H27', 9, 16, NULL),
	(67, 'H13', 9, 16, NULL),
	(68, '8', 29, 2, 9);
/*!40000 ALTER TABLE `ruta` ENABLE KEYS */;


-- Dumping data for table proyecto_visitas.administrador: ~0 rows (approximately)
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;

-- Dumping structure for table proyecto_visitas.contador_diario
CREATE TABLE IF NOT EXISTS `contador_diario` (
  `id_contadord` int(11) NOT NULL AUTO_INCREMENT,
  `fk_ruta` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `numeroVisitas` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_contadord`),
  KEY `fk_ruta_rel` (`fk_ruta`),
  CONSTRAINT `fk_ruta_rel` FOREIGN KEY (`fk_ruta`) REFERENCES `ruta` (`id_ruta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table proyecto_visitas.contador_diario: ~7 rows (approximately)
/*!40000 ALTER TABLE `contador_diario` DISABLE KEYS */;
REPLACE INTO `contador_diario` (`id_contadord`, `fk_ruta`, `fecha`, `numeroVisitas`) VALUES
	(1, 4, '2020-04-25 16:27:00', 85),
	(2, 4, '2020-04-25 16:29:17', 15),
	(3, 6, '2020-04-25 18:21:47', 2),
	(4, 2, '2020-04-25 18:26:11', 200),
	(5, 2, '2020-04-25 18:28:31', 150),
	(6, 7, '2020-05-22 19:38:39', 3),
	(7, 9, '2020-05-22 19:39:09', 1);
/*!40000 ALTER TABLE `contador_diario` ENABLE KEYS */;

-- Dumping structure for view proyecto_visitas.nombrerutas
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `nombrerutas` (
	`id_ruta` INT(11) NOT NULL,
	`nombre` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`rutaDesde` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`rutaHasta` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`rutaPasa` VARCHAR(60) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;


-- Dumping structure for view proyecto_visitas.rutascontador
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `rutascontador` (
	`id_contadord` INT(11) NOT NULL,
	`fecha` TIMESTAMP NOT NULL,
	`numeroVisitas` INT(11) NOT NULL,
	`nombre` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view proyecto_visitas.nombrerutas
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `nombrerutas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `nombrerutas` AS SELECT 
`ruta`.`id_ruta` AS `id_ruta`,
`ruta`.`nombre` AS `nombre`,
`desde`.`nombre` AS `rutaDesde`,
`hasta`.`nombre` AS `rutaHasta`, 
`pasa`.`nombre` AS `rutaPasa`
FROM `ruta`
INNER JOIN `portal` AS `desde` ON(`ruta`.`fk_origen`   = `desde`.`id_portal`)
INNER JOIN `portal` AS `hasta` ON(`ruta`.`fk_destino`  = `hasta`.`id_portal`)
LEFT JOIN `portal` AS `pasa`  ON(`ruta`.`fk_transito` = `pasa`.`id_portal` ) ;

-- Dumping structure for view proyecto_visitas.rutascontador
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `rutascontador`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `rutascontador` AS select `contador_diario`.`id_contadord` AS `id_contadord`,`contador_diario`.`fecha` AS `fecha`,`contador_diario`.`numeroVisitas` AS `numeroVisitas`,`ruta`.`nombre` AS `nombre` from (`contador_diario` join `ruta` on(`contador_diario`.`fk_ruta` = `ruta`.`id_ruta`)) ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
