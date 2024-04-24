-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.36 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para base_passave
CREATE DATABASE IF NOT EXISTS `base_passave` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `base_passave`;

-- Volcando estructura para tabla base_passave.sesiones
CREATE TABLE IF NOT EXISTS `sesiones` (
  `id_sesion` int(11) NOT NULL AUTO_INCREMENT,
  `sen_idUsuario` int(100) NOT NULL COMMENT 'clave forranea referencia a la tabla usuario',
  `sen_alias` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `sen_correo` varchar(100) COLLATE utf8_bin NOT NULL,
  `sen_clave` varchar(100) COLLATE utf8_bin NOT NULL,
  `sen_pagina` varchar(100) COLLATE utf8_bin NOT NULL,
  `sen_enlace` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `sen_fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_sesion`),
  KEY `FK_sesion_usuario` (`sen_idUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='tabla donde estaran las sesiones del usuario';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla base_passave.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usos_alias` varchar(100) COLLATE utf8_bin NOT NULL,
  `usos_clave` varchar(100) COLLATE utf8_bin NOT NULL,
  `usos_nivel` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'hay dos niveles -admin y -usuario',
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='tabla donde estaran los usuario registrados los cuales tienen acceso a las sesiones guardadas';

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
