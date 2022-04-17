-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para welldex_operaciones
CREATE DATABASE IF NOT EXISTS `welldex_operaciones` /*!40100 DEFAULT CHARACTER SET armscii8 */;
USE `welldex_operaciones`;

-- Volcando estructura para tabla welldex_operaciones.cargas_sueltas
CREATE TABLE IF NOT EXISTS `cargas_sueltas` (
  `id_carga_suelta` int(11) NOT NULL AUTO_INCREMENT,
  `id_operacion` int(11) NOT NULL,
  `descripcion` longtext COLLATE latin1_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_carga_suelta`),
  KEY `fk_id_operacion_cargas_sueltas` (`id_operacion`),
  CONSTRAINT `fk_id_operacion_cargas_sueltas` FOREIGN KEY (`id_operacion`) REFERENCES `operaciones` (`id_operacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla welldex_operaciones.contenedores
CREATE TABLE IF NOT EXISTS `contenedores` (
  `id_contenedor` int(11) NOT NULL AUTO_INCREMENT,
  `id_operacion` int(11) NOT NULL,
  `numero_contenedor` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `tipo_contenedor` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `dimensiones` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_descargo` datetime DEFAULT NULL,
  PRIMARY KEY (`id_contenedor`),
  KEY `fk_id_operacion_contenedores` (`id_operacion`),
  CONSTRAINT `fk_id_operacion_contenedores` FOREIGN KEY (`id_operacion`) REFERENCES `operaciones` (`id_operacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla welldex_operaciones.exportaciones
CREATE TABLE IF NOT EXISTS `exportaciones` (
  `id_exportacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_operacion` int(11) NOT NULL,
  `fecha_zarpe` datetime NOT NULL,
  `pais_destino` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_exportacion`),
  KEY `fk_id_operacion_exportaciones` (`id_operacion`),
  CONSTRAINT `fk_id_operacion_exportaciones` FOREIGN KEY (`id_operacion`) REFERENCES `operaciones` (`id_operacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla welldex_operaciones.importaciones
CREATE TABLE IF NOT EXISTS `importaciones` (
  `id_importacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_operacion` int(11) NOT NULL,
  `fecha_arribo` datetime NOT NULL,
  `pais_origen` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_importacion`),
  KEY `fk_id_operacion_importaciones` (`id_operacion`),
  CONSTRAINT `fk_id_operacion_importaciones` FOREIGN KEY (`id_operacion`) REFERENCES `operaciones` (`id_operacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla welldex_operaciones.operaciones
CREATE TABLE IF NOT EXISTS `operaciones` (
  `id_operacion` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `pedimento` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `cliente` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `aduana` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `patente` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `tipo_mercancia` enum('CONTENEDOR','CARGA_SUELTA') COLLATE latin1_spanish_ci NOT NULL,
  `tipo_operacion` enum('IMPORTACION','EXPORTACION') COLLATE latin1_spanish_ci NOT NULL,
  `estatus` enum('ALTA','ETA','ETD','DESCARGO') COLLATE latin1_spanish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_operacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
