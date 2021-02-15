-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2017 a las 01:00:53
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clubffaa`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CUOTAS_CREATE` (IN `pcantidad` INT, IN `pimporte` DECIMAL(11,2), IN `pinscripcion` DECIMAL(11,2))  NO SQL
BEGIN
DECLARE i int DEFAULT 1;
	INSERT INTO cuotas (plan_socio_id, periodo, importe, vencimiento, cuota)
	VALUES ((SELECT MAX(id) AS idp_s FROM plan_socio), DATE_ADD( NOW(), INTERVAL (i-1) MONTH ), pinscripcion, DATE_ADD( NOW(), INTERVAL (i) MONTH ), 0);
WHILE i <= pcantidad DO
	INSERT INTO cuotas (plan_socio_id, periodo, importe, vencimiento, cuota)
	VALUES ((SELECT MAX(id) AS idp_s FROM plan_socio), DATE_ADD( NOW(), INTERVAL (i-1) MONTH ), pimporte, DATE_ADD( NOW(), INTERVAL (i) MONTH ), i);
    SET i = i +1;
END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CUOTA_SOCIO_BUSCAR` (IN `pid` INT(10))  NO SQL
SELECT s.nsocio, s.nombre, s.apellido, s.dni, s.categoria_id, c.descripcion as categoria, NULLIF( COUNT(f.id) , 0) as cantidad 
from familiares f 
INNER JOIN socios s on s.id = f.socio_id 
INNER JOIN categorias c on c.id = s.categoria_id
where s.nsocio = pid
and f.estado = 'Activo' 
and s.estado = 'Activo'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PLANES_CREATE` (IN `pdescripcion` VARCHAR(255), IN `pcategoria_id` INT(10), IN `pcantidad_familiar` INT(11), IN `pcantidad_cuota` INT(11), IN `pimporte` DECIMAL(11,2))  NO SQL
INSERT INTO planes (descripcion, categoria_id, cantidad_familiar, cantidad_cuota, importe)
VALUES (pdescripcion, pcategoria_id, pcantidad_familiar, pcantidad_cuota, pimporte)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_planes_cuotas_socios_create` (IN `psocio_id` INT(10) UNSIGNED, IN `ptipo` ENUM('Miembro','Familiar','Amarra','') CHARSET utf8, IN `pcantidad` INT(11), IN `pimporte` DECIMAL(11,2), IN `pe` INT(10), IN `pf` INT(10))  NO SQL
    DETERMINISTIC
BEGIN
DECLARE i INT DEFAULT 1;
DECLARE c INT;
INSERT INTO planes (socio_id, tipo, cantidad)
VALUES (psocio_id, ptipo, pcantidad);
IF ptipo ='Miembro' then
WHILE i <= pcantidad DO
	INSERT INTO cuotas (plan_id, periodo, importe, estado)
	VALUES ((SELECT MAX(id) AS idc FROM planes), DATE_ADD( NOW(), INTERVAL (i-1) MONTH ), pimporte, 'Pendiente');
    SET i = i +1;
END WHILE;
ELSEIF ptipo ='Familiar' THEN
WHILE i <= pcantidad DO
	INSERT INTO cuotas (plan_id, familiar_id, periodo, importe, estado)
	VALUES ((SELECT MAX(id) AS idc FROM planes), pf, DATE_ADD( NOW(), INTERVAL (i-1) MONTH ), pimporte, 'Pendiente');
    SET i = i +1;
END WHILE;
ELSEIF ptipo ='Amarra' THEN
WHILE i <= pcantidad DO
	INSERT INTO cuotas (plan_id, embarcacion_id, periodo, importe, estado)
	VALUES ((SELECT MAX(id) AS idc FROM planes), pe, DATE_ADD( NOW(), INTERVAL (i-1) MONTH ), pimporte, 'Pendiente');
    SET i = i +1;
END WHILE;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PLANES_DELETE` (IN `pid` INT(10))  NO SQL
UPDATE planes SET estado = 'No activo' where id = pid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PLANES_INDEX` (IN `pdescripcion` VARCHAR(255))  NO SQL
SELECT p.id as idp, p.descripcion as descripcion, c.descripcion as categoria, p.cantidad_familiar, p.cantidad_cuota, p.importe from planes p inner join categorias c on c.id=p.categoria_id WHERE p.descripcion LIKE CONCAT('%', pdescripcion , '%') and p.estado = 'Activo'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PLAN_SOCIO_CREATE` (IN `pplan_id` INT(10), IN `psocio_id` INT(10))  NO SQL
BEGIN
DECLARE pcantidad FLOAT;
DECLARE pimporte DECIMAL(11,2);
DECLARE pinscripcion DECIMAL(11,2);
SET pcantidad = (SELECT cantidad_cuota from planes where id = pplan_id LIMIT 1);
SET pimporte = (SELECT importe from planes where id = pplan_id LIMIT 1);
SET pinscripcion = (SELECT inscripcion from planes where id = pplan_id LIMIT 1);
INSERT INTO plan_socio (plan_id, socio_id, vencimiento) 
VALUES (pplan_id, psocio_id, DATE_ADD( NOW(), INTERVAL (SELECT cantidad_cuota from planes where id = pplan_id) MONTH ));
CALL SP_CUOTAS_CREATE(pcantidad,pimporte,pinscripcion);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcionbreve` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `importeinscripcion` decimal(11,2) NOT NULL,
  `tipo` enum('Militar','Civil','Pensionista') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Militar',
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `descripcion`, `descripcionbreve`, `importeinscripcion`, `tipo`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 'Militar Activo', 'MA', '5000.00', 'Militar', 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(2, 'Militar Concurrente', 'MC', '6000.00', 'Militar', 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(3, 'Militar Transeunte', 'MT', '8000.00', 'Militar', 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(4, 'Militar Vitalicio', 'MV', '4000.00', 'Militar', 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(5, 'Civil Concurrente', 'CC', '6000.00', 'Civil', 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(6, 'Civil Transeunte', 'CT', '9000.00', 'Civil', 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(7, 'Pensionista', 'P', '4000.00', 'Pensionista', 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(8, 'Pensionista Vitalicio', 'PV', '1000.00', 'Pensionista', 'Activo', '2010-05-17', 'aperez', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobradores`
--

CREATE TABLE `cobradores` (
  `id` int(10) UNSIGNED NOT NULL,
  `zona_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `estadocivil` enum('Soltero','Casado','Viudo','Divorciado') COLLATE utf8_unicode_ci DEFAULT 'Soltero',
  `sexo` enum('Masculino','Femenino') COLLATE utf8_unicode_ci DEFAULT 'Masculino',
  `domicilio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cobradores`
--

INSERT INTO `cobradores` (`id`, `zona_id`, `nombre`, `apellido`, `dni`, `estadocivil`, `sexo`, `domicilio`, `telefono`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 1, 'SANCHO', 'MOHAMED SAIZ ', 58933285, 'Soltero', 'Masculino', 'San Luis 466', 2147483647, 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(2, 2, 'JOSE LUIS', 'PERNAS', 3371399, 'Soltero', 'Masculino', 'Padre Lozano 349', 2449735, 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(3, 3, 'CRISTIAN', 'COROMINAS FERRI', 24851803, 'Soltero', 'Masculino', 'Jose Saravia 4249', 8752055, 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(4, 4, 'MIGUEL ANGEL', 'MELGAREJO SEBASTIA', 43598048, 'Soltero', 'Masculino', 'Valencia 1776', 5257836, 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(5, 5, 'ANDRES', 'INFANTES CORDOBA', 63826020, 'Soltero', 'Masculino', 'Dr. Antolin Torres 3674', 6415953, 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(6, 6, 'JOSE MARIA ', 'IZAGUIRRE CHAVEZ', 16825358, 'Soltero', 'Masculino', 'Kansas 1757', 7691954, 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(7, 8, 'EDUARDO ', 'MORA DEL RIO', 60209569, 'Soltero', 'Masculino', 'Av. Gral. Paz 142 7B', 8237121, 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(8, 8, 'ROSARIO', 'ACEVEDO MAYOR', 83863848, 'Soltero', 'Masculino', 'Av. Duarte Quiros 92 5C', 7695601, 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(9, 7, 'ENRIQUE', 'PALMER', 50910698, 'Soltero', 'Masculino', '  Arturo Illia 9699', 3587706, 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(10, 9, 'ISMAEL', 'GAMERO ARNAU', 83283124, 'Soltero', 'Masculino', 'Rosario 130', 7365464, 'Activo', '2010-05-17', 'aperez', '0000-00-00', ''),
(11, 10, 'LUIS MIGUEL', 'PERNAS', 60432824, 'Soltero', 'Masculino', 'Rafael Lozada 202', 7340709, 'Activo', '2010-05-17', 'aperez', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros`
--

CREATE TABLE `cobros` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `recibo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `servicio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `importe` decimal(11,2) NOT NULL,
  `fechapago` date DEFAULT NULL,
  `estado` enum('Pago','Impago','Anulado') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pago',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cobros`
--

INSERT INTO `cobros` (`id`, `socio_id`, `recibo`, `detalle`, `servicio`, `importe`, `fechapago`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rec 001', 'Inscripcion', '', '5000.00', '2014-01-22', 'Pago', '2014-01-22', 'tfrias', NULL, NULL, NULL, NULL),
(2, 2, 'Rec 002', 'Inscripcion', '', '5000.00', '2014-03-23', 'Pago', '2014-03-23', 'tfrias', NULL, NULL, NULL, NULL),
(3, 3, 'Rec 003', 'Inscripcion', '', '6000.00', '2014-05-22', 'Pago', '2014-05-22', 'tfrias', NULL, NULL, NULL, NULL),
(4, 4, 'Rec 004', 'Inscripcion', '', '6000.00', '2014-07-23', 'Pago', '2014-07-23', 'tfrias', NULL, NULL, NULL, NULL),
(5, 5, 'Rec 005', 'Inscripcion', '', '5000.00', '2014-09-22', 'Pago', '2014-09-22', 'tfrias', NULL, NULL, NULL, NULL),
(6, 6, 'Rec 006', 'Inscripcion', '', '6000.00', '2014-11-23', 'Pago', '2014-11-23', 'tfrias', NULL, NULL, NULL, NULL),
(7, 7, 'Rec 007', 'Inscripcion', '', '6000.00', '2014-11-24', 'Pago', '2014-11-24', 'tfrias', NULL, NULL, NULL, NULL),
(8, 8, 'Rec 008', 'Inscripcion', '', '8000.00', '2014-12-25', 'Pago', '2014-12-25', 'tfrias', NULL, NULL, NULL, NULL),
(9, 9, 'Rec 009', 'Inscripcion', '', '1000.00', '2014-12-26', 'Pago', '2014-12-25', 'tfrias', NULL, NULL, NULL, NULL),
(10, 1, 'Rec 111', 'Plan MA anual', 'Restaurante - Eventos - Clases de Tiro', '5000.00', '2014-02-25', 'Pago', '2014-02-25', 'tfrias', '0000-00-00', '', NULL, NULL),
(11, 2, 'Rec 222', 'Plan MA anual', 'Restaurante - Eventos - Clases de Tiro', '5000.00', '2014-04-25', 'Pago', '2014-04-25', 'tfrias', '0000-00-00', '', NULL, NULL),
(12, 3, 'Rec 333', 'Plan MC semestral', 'Restaurante - Eventos', '2500.00', '2014-05-25', 'Pago', '2014-05-25', 'tfrias', '0000-00-00', '', NULL, NULL),
(13, 4, 'Rec 444', 'Plan CC trimestral', 'Restaurante - Eventos - Yoga', '1200.00', '2014-08-25', 'Pago', '2014-08-25', 'tfrias', '0000-00-00', '', NULL, NULL),
(14, 5, 'Rec 555', 'Plan MA anual', 'Restaurante - Eventos - Clases de Tiro', '5000.00', '2014-10-25', 'Pago', '2014-10-25', 'tfrias', '0000-00-00', '', NULL, NULL),
(15, 6, 'Rec 666', 'Plan CC trimestral', 'Restaurante - Eventos - Yoga', '1200.00', '2014-12-25', 'Pago', '2014-12-25', 'tfrias', '0000-00-00', '', NULL, NULL),
(16, 7, 'Rec 777', 'Plan MC semestral', 'Restaurante - Eventos', '2500.00', '2014-12-25', 'Pago', '2014-12-25', 'tfrias', '0000-00-00', '', NULL, NULL),
(17, 8, 'Rec 888', 'Plan MT anual', 'Restaurante - Eventos', '5000.00', '2014-12-26', 'Pago', '2014-12-26', 'tfrias', '0000-00-00', '', NULL, NULL),
(18, 9, 'Rec 999', 'Plan PV anual', 'Restaurante - Eventos', '3000.00', '2014-12-28', 'Pago', '2014-12-28', 'tfrias', '0000-00-00', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas`
--

CREATE TABLE `cuotas` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_socio_id` int(10) UNSIGNED NOT NULL,
  `periodo` date NOT NULL,
  `importe` decimal(11,2) NOT NULL,
  `vencimiento` date NOT NULL,
  `cuota` int(11) NOT NULL DEFAULT '0',
  `estado` enum('Pendiente','Pagado','Cancelado','Anulado') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Pendiente',
  `fechaalta` int(11) DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaupdate` int(11) DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `embarcaciones`
--

CREATE TABLE `embarcaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arboladura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `casco` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eslora` decimal(11,2) NOT NULL,
  `manga` decimal(11,2) NOT NULL,
  `puntal` decimal(11,2) NOT NULL,
  `calado` decimal(11,2) NOT NULL,
  `tonelaje` decimal(11,2) NOT NULL,
  `motormarca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motornumero` int(11) NOT NULL,
  `motorpotencia` decimal(11,2) NOT NULL,
  `matricula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inspeccion` date NOT NULL,
  `elementos` text COLLATE utf8_unicode_ci NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `embarcaciones`
--

INSERT INTO `embarcaciones` (`id`, `nombre`, `arboladura`, `casco`, `eslora`, `manga`, `puntal`, `calado`, `tonelaje`, `motormarca`, `motornumero`, `motorpotencia`, `matricula`, `rey`, `inspeccion`, `elementos`, `socio_id`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 'Velero Angel', 'Velero', '1.2', '7.90', '1.50', '2.00', '2.00', '2000.00', 'Nanni', 20, '15.00', 'A342F999', '613008540', '2017-01-15', 'Garrafa, Lona, TV 32'' Mesa, Cama', 1, 'Activo', '2010-05-19', 'sromano', NULL, NULL),
(2, 'Yate Torralba I', 'Yate', '1.1', '5.00', '2.10', '2.20', '2.50', '1500.00', 'Nanni', 15, '20.00', 'A334F261', '65019774', '2017-02-10', 'Lona, 2 Garrafa', 2, 'Activo', '2010-05-19', 'sromano', NULL, NULL),
(3, 'Yate Torralba II', 'Yate', '1.1', '5.00', '2.10', '2.20', '2.50', '1500.00', 'Nanni', 15, '20.00', 'A419C613', '11963018', '2016-09-15', 'No posee', 2, 'Activo', '2010-05-19', 'sromano', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiares`
--

CREATE TABLE `familiares` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dni` int(11) NOT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `parentesco` enum('Conyuge','Padre','Hijo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Conyuge',
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `familiares`
--

INSERT INTO `familiares` (`id`, `socio_id`, `foto`, `nombre`, `apellido`, `dni`, `fechanacimiento`, `parentesco`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 1, 'default.jpg', 'MARCELO', 'REVUELTA YANES', 90360576, '1990-06-10', 'Hijo', 'Activo', '2010-05-20', 'sromano', NULL, NULL),
(2, 1, 'default.jpg', 'LAURA', 'BARRIOS', 3265442, '1978-12-05', 'Conyuge', 'Activo', '2010-06-26', 'sromano', NULL, NULL),
(3, 3, 'default.jpg', 'MARIA ANGEL', 'GUEDES VILCHES', 354654564, '1985-07-10', 'Hijo', 'Activo', '2010-06-26', 'sromano', NULL, NULL),
(4, 9, 'default.jpg', 'ARTURO', 'VICENS ESPINOSA', 23423424, '1987-11-10', 'Hijo', 'Activo', '2010-06-26', 'sromano', NULL, NULL),
(5, 9, 'default.jpg', 'CLAUDIO', 'VICENS ESPINOSA', 2234234, '1987-11-10', 'Padre', 'Activo', '2010-06-26', 'sromano', NULL, NULL),
(6, 9, 'default.jpg', 'PEDRO', 'VICENS ESPINOSA', 234234, '1987-11-10', 'Conyuge', 'Activo', '2010-06-26', 'sromano', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_embarcacion`
--

CREATE TABLE `foto_embarcacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `embarcacion_id` int(10) UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `id` int(10) UNSIGNED NOT NULL,
  `provincia_id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id`, `provincia_id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 1, '25 de Mayo', NULL, NULL),
(2, 1, '3 de febrero', NULL, NULL),
(3, 1, 'A. Alsina', NULL, NULL),
(4, 1, 'A. Gonzáles Cháves', NULL, NULL),
(5, 1, 'Aguas Verdes', NULL, NULL),
(6, 1, 'Alberti', NULL, NULL),
(7, 1, 'Arrecifes', NULL, NULL),
(8, 1, 'Ayacucho', NULL, NULL),
(9, 1, 'Azul', NULL, NULL),
(10, 1, 'Bahía Blanca', NULL, NULL),
(11, 1, 'Balcarce', NULL, NULL),
(12, 1, 'Baradero', NULL, NULL),
(13, 1, 'Benito Juárez', NULL, NULL),
(14, 1, 'Berisso', NULL, NULL),
(15, 1, 'Bolívar', NULL, NULL),
(16, 1, 'Bragado', NULL, NULL),
(17, 1, 'Brandsen', NULL, NULL),
(18, 1, 'Campana', NULL, NULL),
(19, 1, 'Cañuelas', NULL, NULL),
(20, 1, 'Capilla del Señor', NULL, NULL),
(21, 1, 'Capitán Sarmiento', NULL, NULL),
(22, 1, 'Carapachay', NULL, NULL),
(23, 1, 'Carhue', NULL, NULL),
(24, 1, 'Cariló', NULL, NULL),
(25, 1, 'Carlos Casares', NULL, NULL),
(26, 1, 'Carlos Tejedor', NULL, NULL),
(27, 1, 'Carmen de Areco', NULL, NULL),
(28, 1, 'Carmen de Patagones', NULL, NULL),
(29, 1, 'Castelli', NULL, NULL),
(30, 1, 'Chacabuco', NULL, NULL),
(31, 1, 'Chascomús', NULL, NULL),
(32, 1, 'Chivilcoy', NULL, NULL),
(33, 1, 'Colón', NULL, NULL),
(34, 1, 'Coronel Dorrego', NULL, NULL),
(35, 1, 'Coronel Pringles', NULL, NULL),
(36, 1, 'Coronel Rosales', NULL, NULL),
(37, 1, 'Coronel Suarez', NULL, NULL),
(38, 1, 'Costa Azul', NULL, NULL),
(39, 1, 'Costa Chica', NULL, NULL),
(40, 1, 'Costa del Este', NULL, NULL),
(41, 1, 'Costa Esmeralda', NULL, NULL),
(42, 1, 'Daireaux', NULL, NULL),
(43, 1, 'Darregueira', NULL, NULL),
(44, 1, 'Del Viso', NULL, NULL),
(45, 1, 'Dolores', NULL, NULL),
(46, 1, 'Don Torcuato', NULL, NULL),
(47, 1, 'Ensenada', NULL, NULL),
(48, 1, 'Escobar', NULL, NULL),
(49, 1, 'Exaltación de la Cruz', NULL, NULL),
(50, 1, 'Florentino Ameghino', NULL, NULL),
(51, 1, 'Garín', NULL, NULL),
(52, 1, 'Gral. Alvarado', NULL, NULL),
(53, 1, 'Gral. Alvear', NULL, NULL),
(54, 1, 'Gral. Arenales', NULL, NULL),
(55, 1, 'Gral. Belgrano', NULL, NULL),
(56, 1, 'Gral. Guido', NULL, NULL),
(57, 1, 'Gral. Lamadrid', NULL, NULL),
(58, 1, 'Gral. Las Heras', NULL, NULL),
(59, 1, 'Gral. Lavalle', NULL, NULL),
(60, 1, 'Gral. Madariaga', NULL, NULL),
(61, 1, 'Gral. Pacheco', NULL, NULL),
(62, 1, 'Gral. Paz', NULL, NULL),
(63, 1, 'Gral. Pinto', NULL, NULL),
(64, 1, 'Gral. Pueyrredón', NULL, NULL),
(65, 1, 'Gral. Rodríguez', NULL, NULL),
(66, 1, 'Gral. Viamonte', NULL, NULL),
(67, 1, 'Gral. Villegas', NULL, NULL),
(68, 1, 'Guaminí', NULL, NULL),
(69, 1, 'Guernica', NULL, NULL),
(70, 1, 'Hipólito Yrigoyen', NULL, NULL),
(71, 1, 'Ing. Maschwitz', NULL, NULL),
(72, 1, 'Junín', NULL, NULL),
(73, 1, 'La Plata', NULL, NULL),
(74, 1, 'Laprida', NULL, NULL),
(75, 1, 'Las Flores', NULL, NULL),
(76, 1, 'Las Toninas', NULL, NULL),
(77, 1, 'Leandro N. Alem', NULL, NULL),
(78, 1, 'Lincoln', NULL, NULL),
(79, 1, 'Loberia', NULL, NULL),
(80, 1, 'Lobos', NULL, NULL),
(81, 1, 'Los Cardales', NULL, NULL),
(82, 1, 'Los Toldos', NULL, NULL),
(83, 1, 'Lucila del Mar', NULL, NULL),
(84, 1, 'Luján', NULL, NULL),
(85, 1, 'Magdalena', NULL, NULL),
(86, 1, 'Maipú', NULL, NULL),
(87, 1, 'Mar Chiquita', NULL, NULL),
(88, 1, 'Mar de Ajó', NULL, NULL),
(89, 1, 'Mar de las Pampas', NULL, NULL),
(90, 1, 'Mar del Plata', NULL, NULL),
(91, 1, 'Mar del Tuyú', NULL, NULL),
(92, 1, 'Marcos Paz', NULL, NULL),
(93, 1, 'Mercedes', NULL, NULL),
(94, 1, 'Miramar', NULL, NULL),
(95, 1, 'Monte', NULL, NULL),
(96, 1, 'Monte Hermoso', NULL, NULL),
(97, 1, 'Munro', NULL, NULL),
(98, 1, 'Navarro', NULL, NULL),
(99, 1, 'Necochea', NULL, NULL),
(100, 1, 'Olavarría', NULL, NULL),
(101, 1, 'Partido de la Costa', NULL, NULL),
(102, 1, 'Pehuajó', NULL, NULL),
(103, 1, 'Pellegrini', NULL, NULL),
(104, 1, 'Pergamino', NULL, NULL),
(105, 1, 'Pigüé', NULL, NULL),
(106, 1, 'Pila', NULL, NULL),
(107, 1, 'Pilar', NULL, NULL),
(108, 1, 'Pinamar', NULL, NULL),
(109, 1, 'Pinar del Sol', NULL, NULL),
(110, 1, 'Polvorines', NULL, NULL),
(111, 1, 'Pte. Perón', NULL, NULL),
(112, 1, 'Puán', NULL, NULL),
(113, 1, 'Punta Indio', NULL, NULL),
(114, 1, 'Ramallo', NULL, NULL),
(115, 1, 'Rauch', NULL, NULL),
(116, 1, 'Rivadavia', NULL, NULL),
(117, 1, 'Rojas', NULL, NULL),
(118, 1, 'Roque Pérez', NULL, NULL),
(119, 1, 'Saavedra', NULL, NULL),
(120, 1, 'Saladillo', NULL, NULL),
(121, 1, 'Salliqueló', NULL, NULL),
(122, 1, 'Salto', NULL, NULL),
(123, 1, 'San Andrés de Giles', NULL, NULL),
(124, 1, 'San Antonio de Areco', NULL, NULL),
(125, 1, 'San Antonio de Padua', NULL, NULL),
(126, 1, 'San Bernardo', NULL, NULL),
(127, 1, 'San Cayetano', NULL, NULL),
(128, 1, 'San Clemente del Tuyú', NULL, NULL),
(129, 1, 'San Nicolás', NULL, NULL),
(130, 1, 'San Pedro', NULL, NULL),
(131, 1, 'San Vicente', NULL, NULL),
(132, 1, 'Santa Teresita', NULL, NULL),
(133, 1, 'Suipacha', NULL, NULL),
(134, 1, 'Tandil', NULL, NULL),
(135, 1, 'Tapalqué', NULL, NULL),
(136, 1, 'Tordillo', NULL, NULL),
(137, 1, 'Tornquist', NULL, NULL),
(138, 1, 'Trenque Lauquen', NULL, NULL),
(139, 1, 'Tres Lomas', NULL, NULL),
(140, 1, 'Villa Gesell', NULL, NULL),
(141, 1, 'Villarino', NULL, NULL),
(142, 1, 'Zárate', NULL, NULL),
(143, 2, '11 de Septiembre', NULL, NULL),
(144, 2, '20 de Junio', NULL, NULL),
(145, 2, '25 de Mayo', NULL, NULL),
(146, 2, 'Acassuso', NULL, NULL),
(147, 2, 'Adrogué', NULL, NULL),
(148, 2, 'Aldo Bonzi', NULL, NULL),
(149, 2, 'Área Reserva Cinturón Ecológico', NULL, NULL),
(150, 2, 'Avellaneda', NULL, NULL),
(151, 2, 'Banfield', NULL, NULL),
(152, 2, 'Barrio Parque', NULL, NULL),
(153, 2, 'Barrio Santa Teresita', NULL, NULL),
(154, 2, 'Beccar', NULL, NULL),
(155, 2, 'Bella Vista', NULL, NULL),
(156, 2, 'Berazategui', NULL, NULL),
(157, 2, 'Bernal Este', NULL, NULL),
(158, 2, 'Bernal Oeste', NULL, NULL),
(159, 2, 'Billinghurst', NULL, NULL),
(160, 2, 'Boulogne', NULL, NULL),
(161, 2, 'Burzaco', NULL, NULL),
(162, 2, 'Carapachay', NULL, NULL),
(163, 2, 'Caseros', NULL, NULL),
(164, 2, 'Castelar', NULL, NULL),
(165, 2, 'Churruca', NULL, NULL),
(166, 2, 'Ciudad Evita', NULL, NULL),
(167, 2, 'Ciudad Madero', NULL, NULL),
(168, 2, 'Ciudadela', NULL, NULL),
(169, 2, 'Claypole', NULL, NULL),
(170, 2, 'Crucecita', NULL, NULL),
(171, 2, 'Dock Sud', NULL, NULL),
(172, 2, 'Don Bosco', NULL, NULL),
(173, 2, 'Don Orione', NULL, NULL),
(174, 2, 'El Jagüel', NULL, NULL),
(175, 2, 'El Libertador', NULL, NULL),
(176, 2, 'El Palomar', NULL, NULL),
(177, 2, 'El Tala', NULL, NULL),
(178, 2, 'El Trébol', NULL, NULL),
(179, 2, 'Ezeiza', NULL, NULL),
(180, 2, 'Ezpeleta', NULL, NULL),
(181, 2, 'Florencio Varela', NULL, NULL),
(182, 2, 'Florida', NULL, NULL),
(183, 2, 'Francisco Álvarez', NULL, NULL),
(184, 2, 'Gerli', NULL, NULL),
(185, 2, 'Glew', NULL, NULL),
(186, 2, 'González Catán', NULL, NULL),
(187, 2, 'Gral. Lamadrid', NULL, NULL),
(188, 2, 'Grand Bourg', NULL, NULL),
(189, 2, 'Gregorio de Laferrere', NULL, NULL),
(190, 2, 'Guillermo Enrique Hudson', NULL, NULL),
(191, 2, 'Haedo', NULL, NULL),
(192, 2, 'Hurlingham', NULL, NULL),
(193, 2, 'Ing. Sourdeaux', NULL, NULL),
(194, 2, 'Isidro Casanova', NULL, NULL),
(195, 2, 'Ituzaingó', NULL, NULL),
(196, 2, 'José C. Paz', NULL, NULL),
(197, 2, 'José Ingenieros', NULL, NULL),
(198, 2, 'José Marmol', NULL, NULL),
(199, 2, 'La Lucila', NULL, NULL),
(200, 2, 'La Reja', NULL, NULL),
(201, 2, 'La Tablada', NULL, NULL),
(202, 2, 'Lanús', NULL, NULL),
(203, 2, 'Llavallol', NULL, NULL),
(204, 2, 'Loma Hermosa', NULL, NULL),
(205, 2, 'Lomas de Zamora', NULL, NULL),
(206, 2, 'Lomas del Millón', NULL, NULL),
(207, 2, 'Lomas del Mirador', NULL, NULL),
(208, 2, 'Longchamps', NULL, NULL),
(209, 2, 'Los Polvorines', NULL, NULL),
(210, 2, 'Luis Guillón', NULL, NULL),
(211, 2, 'Malvinas Argentinas', NULL, NULL),
(212, 2, 'Martín Coronado', NULL, NULL),
(213, 2, 'Martínez', NULL, NULL),
(214, 2, 'Merlo', NULL, NULL),
(215, 2, 'Ministro Rivadavia', NULL, NULL),
(216, 2, 'Monte Chingolo', NULL, NULL),
(217, 2, 'Monte Grande', NULL, NULL),
(218, 2, 'Moreno', NULL, NULL),
(219, 2, 'Morón', NULL, NULL),
(220, 2, 'Muñiz', NULL, NULL),
(221, 2, 'Olivos', NULL, NULL),
(222, 2, 'Pablo Nogués', NULL, NULL),
(223, 2, 'Pablo Podestá', NULL, NULL),
(224, 2, 'Paso del Rey', NULL, NULL),
(225, 2, 'Pereyra', NULL, NULL),
(226, 2, 'Piñeiro', NULL, NULL),
(227, 2, 'Plátanos', NULL, NULL),
(228, 2, 'Pontevedra', NULL, NULL),
(229, 2, 'Quilmes', NULL, NULL),
(230, 2, 'Rafael Calzada', NULL, NULL),
(231, 2, 'Rafael Castillo', NULL, NULL),
(232, 2, 'Ramos Mejía', NULL, NULL),
(233, 2, 'Ranelagh', NULL, NULL),
(234, 2, 'Remedios de Escalada', NULL, NULL),
(235, 2, 'Sáenz Peña', NULL, NULL),
(236, 2, 'San Antonio de Padua', NULL, NULL),
(237, 2, 'San Fernando', NULL, NULL),
(238, 2, 'San Francisco Solano', NULL, NULL),
(239, 2, 'San Isidro', NULL, NULL),
(240, 2, 'San José', NULL, NULL),
(241, 2, 'San Justo', NULL, NULL),
(242, 2, 'San Martín', NULL, NULL),
(243, 2, 'San Miguel', NULL, NULL),
(244, 2, 'Santos Lugares', NULL, NULL),
(245, 2, 'Sarandí', NULL, NULL),
(246, 2, 'Sourigues', NULL, NULL),
(247, 2, 'Tapiales', NULL, NULL),
(248, 2, 'Temperley', NULL, NULL),
(249, 2, 'Tigre', NULL, NULL),
(250, 2, 'Tortuguitas', NULL, NULL),
(251, 2, 'Tristán Suárez', NULL, NULL),
(252, 2, 'Trujui', NULL, NULL),
(253, 2, 'Turdera', NULL, NULL),
(254, 2, 'Valentín Alsina', NULL, NULL),
(255, 2, 'Vicente López', NULL, NULL),
(256, 2, 'Villa Adelina', NULL, NULL),
(257, 2, 'Villa Ballester', NULL, NULL),
(258, 2, 'Villa Bosch', NULL, NULL),
(259, 2, 'Villa Caraza', NULL, NULL),
(260, 2, 'Villa Celina', NULL, NULL),
(261, 2, 'Villa Centenario', NULL, NULL),
(262, 2, 'Villa de Mayo', NULL, NULL),
(263, 2, 'Villa Diamante', NULL, NULL),
(264, 2, 'Villa Domínico', NULL, NULL),
(265, 2, 'Villa España', NULL, NULL),
(266, 2, 'Villa Fiorito', NULL, NULL),
(267, 2, 'Villa Guillermina', NULL, NULL),
(268, 2, 'Villa Insuperable', NULL, NULL),
(269, 2, 'Villa José León Suárez', NULL, NULL),
(270, 2, 'Villa La Florida', NULL, NULL),
(271, 2, 'Villa Luzuriaga', NULL, NULL),
(272, 2, 'Villa Martelli', NULL, NULL),
(273, 2, 'Villa Obrera', NULL, NULL),
(274, 2, 'Villa Progreso', NULL, NULL),
(275, 2, 'Villa Raffo', NULL, NULL),
(276, 2, 'Villa Sarmiento', NULL, NULL),
(277, 2, 'Villa Tesei', NULL, NULL),
(278, 2, 'Villa Udaondo', NULL, NULL),
(279, 2, 'Virrey del Pino', NULL, NULL),
(280, 2, 'Wilde', NULL, NULL),
(281, 2, 'William Morris', NULL, NULL),
(282, 3, 'Agronomía', NULL, NULL),
(283, 3, 'Almagro', NULL, NULL),
(284, 3, 'Balvanera', NULL, NULL),
(285, 3, 'Barracas', NULL, NULL),
(286, 3, 'Belgrano', NULL, NULL),
(287, 3, 'Boca', NULL, NULL),
(288, 3, 'Boedo', NULL, NULL),
(289, 3, 'Caballito', NULL, NULL),
(290, 3, 'Chacarita', NULL, NULL),
(291, 3, 'Coghlan', NULL, NULL),
(292, 3, 'Colegiales', NULL, NULL),
(293, 3, 'Constitución', NULL, NULL),
(294, 3, 'Flores', NULL, NULL),
(295, 3, 'Floresta', NULL, NULL),
(296, 3, 'La Paternal', NULL, NULL),
(297, 3, 'Liniers', NULL, NULL),
(298, 3, 'Mataderos', NULL, NULL),
(299, 3, 'Monserrat', NULL, NULL),
(300, 3, 'Monte Castro', NULL, NULL),
(301, 3, 'Nueva Pompeya', NULL, NULL),
(302, 3, 'Núñez', NULL, NULL),
(303, 3, 'Palermo', NULL, NULL),
(304, 3, 'Parque Avellaneda', NULL, NULL),
(305, 3, 'Parque Chacabuco', NULL, NULL),
(306, 3, 'Parque Chas', NULL, NULL),
(307, 3, 'Parque Patricios', NULL, NULL),
(308, 3, 'Puerto Madero', NULL, NULL),
(309, 3, 'Recoleta', NULL, NULL),
(310, 3, 'Retiro', NULL, NULL),
(311, 3, 'Saavedra', NULL, NULL),
(312, 3, 'San Cristóbal', NULL, NULL),
(313, 3, 'San Nicolás', NULL, NULL),
(314, 3, 'San Telmo', NULL, NULL),
(315, 3, 'Vélez Sársfield', NULL, NULL),
(316, 3, 'Versalles', NULL, NULL),
(317, 3, 'Villa Crespo', NULL, NULL),
(318, 3, 'Villa del Parque', NULL, NULL),
(319, 3, 'Villa Devoto', NULL, NULL),
(320, 3, 'Villa Gral. Mitre', NULL, NULL),
(321, 3, 'Villa Lugano', NULL, NULL),
(322, 3, 'Villa Luro', NULL, NULL),
(323, 3, 'Villa Ortúzar', NULL, NULL),
(324, 3, 'Villa Pueyrredón', NULL, NULL),
(325, 3, 'Villa Real', NULL, NULL),
(326, 3, 'Villa Riachuelo', NULL, NULL),
(327, 3, 'Villa Santa Rita', NULL, NULL),
(328, 3, 'Villa Soldati', NULL, NULL),
(329, 3, 'Villa Urquiza', NULL, NULL),
(330, 4, 'Aconquija', NULL, NULL),
(331, 4, 'Ancasti', NULL, NULL),
(332, 4, 'Andalgalá', NULL, NULL),
(333, 4, 'Antofagasta', NULL, NULL),
(334, 4, 'Belén', NULL, NULL),
(335, 4, 'Capayán', NULL, NULL),
(336, 4, 'Capital', NULL, NULL),
(337, 4, '4', NULL, NULL),
(338, 4, 'Corral Quemado', NULL, NULL),
(339, 4, 'El Alto', NULL, NULL),
(340, 4, 'El Rodeo', NULL, NULL),
(341, 4, 'F.Mamerto Esquiú', NULL, NULL),
(342, 4, 'Fiambalá', NULL, NULL),
(343, 4, 'Hualfín', NULL, NULL),
(344, 4, 'Huillapima', NULL, NULL),
(345, 4, 'Icaño', NULL, NULL),
(346, 4, 'La Puerta', NULL, NULL),
(347, 4, 'Las Juntas', NULL, NULL),
(348, 4, 'Londres', NULL, NULL),
(349, 4, 'Los Altos', NULL, NULL),
(350, 4, 'Los Varela', NULL, NULL),
(351, 4, 'Mutquín', NULL, NULL),
(352, 4, 'Paclín', NULL, NULL),
(353, 4, 'Poman', NULL, NULL),
(354, 4, 'Pozo de La Piedra', NULL, NULL),
(355, 4, 'Puerta de Corral', NULL, NULL),
(356, 4, 'Puerta San José', NULL, NULL),
(357, 4, 'Recreo', NULL, NULL),
(358, 4, 'S.F.V de 4', NULL, NULL),
(359, 4, 'San Fernando', NULL, NULL),
(360, 4, 'San Fernando del Valle', NULL, NULL),
(361, 4, 'San José', NULL, NULL),
(362, 4, 'Santa María', NULL, NULL),
(363, 4, 'Santa Rosa', NULL, NULL),
(364, 4, 'Saujil', NULL, NULL),
(365, 4, 'Tapso', NULL, NULL),
(366, 4, 'Tinogasta', NULL, NULL),
(367, 4, 'Valle Viejo', NULL, NULL),
(368, 4, 'Villa Vil', NULL, NULL),
(369, 5, 'Aviá Teraí', NULL, NULL),
(370, 5, 'Barranqueras', NULL, NULL),
(371, 5, 'Basail', NULL, NULL),
(372, 5, 'Campo Largo', NULL, NULL),
(373, 5, 'Capital', NULL, NULL),
(374, 5, 'Capitán Solari', NULL, NULL),
(375, 5, 'Charadai', NULL, NULL),
(376, 5, 'Charata', NULL, NULL),
(377, 5, 'Chorotis', NULL, NULL),
(378, 5, 'Ciervo Petiso', NULL, NULL),
(379, 5, 'Cnel. Du Graty', NULL, NULL),
(380, 5, 'Col. Benítez', NULL, NULL),
(381, 5, 'Col. Elisa', NULL, NULL),
(382, 5, 'Col. Popular', NULL, NULL),
(383, 5, 'Colonias Unidas', NULL, NULL),
(384, 5, 'Concepción', NULL, NULL),
(385, 5, 'Corzuela', NULL, NULL),
(386, 5, 'Cote Lai', NULL, NULL),
(387, 5, 'El Sauzalito', NULL, NULL),
(388, 5, 'Enrique Urien', NULL, NULL),
(389, 5, 'Fontana', NULL, NULL),
(390, 5, 'Fte. Esperanza', NULL, NULL),
(391, 5, 'Gancedo', NULL, NULL),
(392, 5, 'Gral. Capdevila', NULL, NULL),
(393, 5, 'Gral. Pinero', NULL, NULL),
(394, 5, 'Gral. San Martín', NULL, NULL),
(395, 5, 'Gral. Vedia', NULL, NULL),
(396, 5, 'Hermoso Campo', NULL, NULL),
(397, 5, 'I. del Cerrito', NULL, NULL),
(398, 5, 'J.J. Castelli', NULL, NULL),
(399, 5, 'La Clotilde', NULL, NULL),
(400, 5, 'La Eduvigis', NULL, NULL),
(401, 5, 'La Escondida', NULL, NULL),
(402, 5, 'La Leonesa', NULL, NULL),
(403, 5, 'La Tigra', NULL, NULL),
(404, 5, 'La Verde', NULL, NULL),
(405, 5, 'Laguna Blanca', NULL, NULL),
(406, 5, 'Laguna Limpia', NULL, NULL),
(407, 5, 'Lapachito', NULL, NULL),
(408, 5, 'Las Breñas', NULL, NULL),
(409, 5, 'Las Garcitas', NULL, NULL),
(410, 5, 'Las Palmas', NULL, NULL),
(411, 5, 'Los Frentones', NULL, NULL),
(412, 5, 'Machagai', NULL, NULL),
(413, 5, 'Makallé', NULL, NULL),
(414, 5, 'Margarita Belén', NULL, NULL),
(415, 5, 'Miraflores', NULL, NULL),
(416, 5, 'Misión N. Pompeya', NULL, NULL),
(417, 5, 'Napenay', NULL, NULL),
(418, 5, 'Pampa Almirón', NULL, NULL),
(419, 5, 'Pampa del Indio', NULL, NULL),
(420, 5, 'Pampa del Infierno', NULL, NULL),
(421, 5, 'Pdcia. de La Plaza', NULL, NULL),
(422, 5, 'Pdcia. Roca', NULL, NULL),
(423, 5, 'Pdcia. Roque Sáenz Peña', NULL, NULL),
(424, 5, 'Pto. Bermejo', NULL, NULL),
(425, 5, 'Pto. Eva Perón', NULL, NULL),
(426, 5, 'Puero Tirol', NULL, NULL),
(427, 5, 'Puerto Vilelas', NULL, NULL),
(428, 5, 'Quitilipi', NULL, NULL),
(429, 5, 'Resistencia', NULL, NULL),
(430, 5, 'Sáenz Peña', NULL, NULL),
(431, 5, 'Samuhú', NULL, NULL),
(432, 5, 'San Bernardo', NULL, NULL),
(433, 5, 'Santa Sylvina', NULL, NULL),
(434, 5, 'Taco Pozo', NULL, NULL),
(435, 5, 'Tres Isletas', NULL, NULL),
(436, 5, 'Villa Ángela', NULL, NULL),
(437, 5, 'Villa Berthet', NULL, NULL),
(438, 5, 'Villa R. Bermejito', NULL, NULL),
(439, 6, 'Aldea Apeleg', NULL, NULL),
(440, 6, 'Aldea Beleiro', NULL, NULL),
(441, 6, 'Aldea Epulef', NULL, NULL),
(442, 6, 'Alto Río Sengerr', NULL, NULL),
(443, 6, 'Buen Pasto', NULL, NULL),
(444, 6, 'Camarones', NULL, NULL),
(445, 6, 'Carrenleufú', NULL, NULL),
(446, 6, 'Cholila', NULL, NULL),
(447, 6, 'Co. Centinela', NULL, NULL),
(448, 6, 'Colan Conhué', NULL, NULL),
(449, 6, 'Comodoro Rivadavia', NULL, NULL),
(450, 6, 'Corcovado', NULL, NULL),
(451, 6, 'Cushamen', NULL, NULL),
(452, 6, 'Dique F. Ameghino', NULL, NULL),
(453, 6, 'Dolavón', NULL, NULL),
(454, 6, 'Dr. R. Rojas', NULL, NULL),
(455, 6, 'El Hoyo', NULL, NULL),
(456, 6, 'El Maitén', NULL, NULL),
(457, 6, 'Epuyén', NULL, NULL),
(458, 6, 'Esquel', NULL, NULL),
(459, 6, 'Facundo', NULL, NULL),
(460, 6, 'Gaimán', NULL, NULL),
(461, 6, 'Gan Gan', NULL, NULL),
(462, 6, 'Gastre', NULL, NULL),
(463, 6, 'Gdor. Costa', NULL, NULL),
(464, 6, 'Gualjaina', NULL, NULL),
(465, 6, 'J. de San Martín', NULL, NULL),
(466, 6, 'Lago Blanco', NULL, NULL),
(467, 6, 'Lago Puelo', NULL, NULL),
(468, 6, 'Lagunita Salada', NULL, NULL),
(469, 6, 'Las Plumas', NULL, NULL),
(470, 6, 'Los Altares', NULL, NULL),
(471, 6, 'Paso de los Indios', NULL, NULL),
(472, 6, 'Paso del Sapo', NULL, NULL),
(473, 6, 'Pto. Madryn', NULL, NULL),
(474, 6, 'Pto. Pirámides', NULL, NULL),
(475, 6, 'Rada Tilly', NULL, NULL),
(476, 6, 'Rawson', NULL, NULL),
(477, 6, 'Río Mayo', NULL, NULL),
(478, 6, 'Río Pico', NULL, NULL),
(479, 6, 'Sarmiento', NULL, NULL),
(480, 6, 'Tecka', NULL, NULL),
(481, 6, 'Telsen', NULL, NULL),
(482, 6, 'Trelew', NULL, NULL),
(483, 6, 'Trevelin', NULL, NULL),
(484, 6, 'Veintiocho de Julio', NULL, NULL),
(485, 7, 'Achiras', NULL, NULL),
(486, 7, 'Adelia Maria', NULL, NULL),
(487, 7, 'Agua de Oro', NULL, NULL),
(488, 7, 'Alcira Gigena', NULL, NULL),
(489, 7, 'Aldea Santa Maria', NULL, NULL),
(490, 7, 'Alejandro Roca', NULL, NULL),
(491, 7, 'Alejo Ledesma', NULL, NULL),
(492, 7, 'Alicia', NULL, NULL),
(493, 7, 'Almafuerte', NULL, NULL),
(494, 7, 'Alpa Corral', NULL, NULL),
(495, 7, 'Alta Gracia', NULL, NULL),
(496, 7, 'Alto Alegre', NULL, NULL),
(497, 7, 'Alto de Los Quebrachos', NULL, NULL),
(498, 7, 'Altos de Chipion', NULL, NULL),
(499, 7, 'Amboy', NULL, NULL),
(500, 7, 'Ambul', NULL, NULL),
(501, 7, 'Ana Zumaran', NULL, NULL),
(502, 7, 'Anisacate', NULL, NULL),
(503, 7, 'Arguello', NULL, NULL),
(504, 7, 'Arias', NULL, NULL),
(505, 7, 'Arroyito', NULL, NULL),
(506, 7, 'Arroyo Algodon', NULL, NULL),
(507, 7, 'Arroyo Cabral', NULL, NULL),
(508, 7, 'Arroyo Los Patos', NULL, NULL),
(509, 7, 'Assunta', NULL, NULL),
(510, 7, 'Atahona', NULL, NULL),
(511, 7, 'Ausonia', NULL, NULL),
(512, 7, 'Avellaneda', NULL, NULL),
(513, 7, 'Ballesteros', NULL, NULL),
(514, 7, 'Ballesteros Sud', NULL, NULL),
(515, 7, 'Balnearia', NULL, NULL),
(516, 7, 'Bañado de Soto', NULL, NULL),
(517, 7, 'Bell Ville', NULL, NULL),
(518, 7, 'Bengolea', NULL, NULL),
(519, 7, 'Benjamin Gould', NULL, NULL),
(520, 7, 'Berrotaran', NULL, NULL),
(521, 7, 'Bialet Masse', NULL, NULL),
(522, 7, 'Bouwer', NULL, NULL),
(523, 7, 'Brinkmann', NULL, NULL),
(524, 7, 'Buchardo', NULL, NULL),
(525, 7, 'Bulnes', NULL, NULL),
(526, 7, 'Cabalango', NULL, NULL),
(527, 7, 'Calamuchita', NULL, NULL),
(528, 7, 'Calchin', NULL, NULL),
(529, 7, 'Calchin Oeste', NULL, NULL),
(530, 7, 'Calmayo', NULL, NULL),
(531, 7, 'Camilo Aldao', NULL, NULL),
(532, 7, 'Caminiaga', NULL, NULL),
(533, 7, 'Cañada de Luque', NULL, NULL),
(534, 7, 'Cañada de Machado', NULL, NULL),
(535, 7, 'Cañada de Rio Pinto', NULL, NULL),
(536, 7, 'Cañada del Sauce', NULL, NULL),
(537, 7, 'Canals', NULL, NULL),
(538, 7, 'Candelaria Sud', NULL, NULL),
(539, 7, 'Capilla de Remedios', NULL, NULL),
(540, 7, 'Capilla de Siton', NULL, NULL),
(541, 7, 'Capilla del Carmen', NULL, NULL),
(542, 7, 'Capilla del Monte', NULL, NULL),
(543, 7, 'Capital', NULL, NULL),
(544, 7, 'Capitan Gral B. O´Higgins', NULL, NULL),
(545, 7, 'Carnerillo', NULL, NULL),
(546, 7, 'Carrilobo', NULL, NULL),
(547, 7, 'Casa Grande', NULL, NULL),
(548, 7, 'Cavanagh', NULL, NULL),
(549, 7, 'Cerro Colorado', NULL, NULL),
(550, 7, 'Chaján', NULL, NULL),
(551, 7, 'Chalacea', NULL, NULL),
(552, 7, 'Chañar Viejo', NULL, NULL),
(553, 7, 'Chancaní', NULL, NULL),
(554, 7, 'Charbonier', NULL, NULL),
(555, 7, 'Charras', NULL, NULL),
(556, 7, 'Chazón', NULL, NULL),
(557, 7, 'Chilibroste', NULL, NULL),
(558, 7, 'Chucul', NULL, NULL),
(559, 7, 'Chuña', NULL, NULL),
(560, 7, 'Chuña Huasi', NULL, NULL),
(561, 7, 'Churqui Cañada', NULL, NULL),
(562, 7, 'Cienaga Del Coro', NULL, NULL),
(563, 7, 'Cintra', NULL, NULL),
(564, 7, 'Col. Almada', NULL, NULL),
(565, 7, 'Col. Anita', NULL, NULL),
(566, 7, 'Col. Barge', NULL, NULL),
(567, 7, 'Col. Bismark', NULL, NULL),
(568, 7, 'Col. Bremen', NULL, NULL),
(569, 7, 'Col. Caroya', NULL, NULL),
(570, 7, 'Col. Italiana', NULL, NULL),
(571, 7, 'Col. Iturraspe', NULL, NULL),
(572, 7, 'Col. Las Cuatro Esquinas', NULL, NULL),
(573, 7, 'Col. Las Pichanas', NULL, NULL),
(574, 7, 'Col. Marina', NULL, NULL),
(575, 7, 'Col. Prosperidad', NULL, NULL),
(576, 7, 'Col. San Bartolome', NULL, NULL),
(577, 7, 'Col. San Pedro', NULL, NULL),
(578, 7, 'Col. Tirolesa', NULL, NULL),
(579, 7, 'Col. Vicente Aguero', NULL, NULL),
(580, 7, 'Col. Videla', NULL, NULL),
(581, 7, 'Col. Vignaud', NULL, NULL),
(582, 7, 'Col. Waltelina', NULL, NULL),
(583, 7, 'Colazo', NULL, NULL),
(584, 7, 'Comechingones', NULL, NULL),
(585, 7, 'Conlara', NULL, NULL),
(586, 7, 'Copacabana', NULL, NULL),
(587, 7, '7', NULL, NULL),
(588, 7, 'Coronel Baigorria', NULL, NULL),
(589, 7, 'Coronel Moldes', NULL, NULL),
(590, 7, 'Corral de Bustos', NULL, NULL),
(591, 7, 'Corralito', NULL, NULL),
(592, 7, 'Cosquín', NULL, NULL),
(593, 7, 'Costa Sacate', NULL, NULL),
(594, 7, 'Cruz Alta', NULL, NULL),
(595, 7, 'Cruz de Caña', NULL, NULL),
(596, 7, 'Cruz del Eje', NULL, NULL),
(597, 7, 'Cuesta Blanca', NULL, NULL),
(598, 7, 'Dean Funes', NULL, NULL),
(599, 7, 'Del Campillo', NULL, NULL),
(600, 7, 'Despeñaderos', NULL, NULL),
(601, 7, 'Devoto', NULL, NULL),
(602, 7, 'Diego de Rojas', NULL, NULL),
(603, 7, 'Dique Chico', NULL, NULL),
(604, 7, 'El Arañado', NULL, NULL),
(605, 7, 'El Brete', NULL, NULL),
(606, 7, 'El Chacho', NULL, NULL),
(607, 7, 'El Crispín', NULL, NULL),
(608, 7, 'El Fortín', NULL, NULL),
(609, 7, 'El Manzano', NULL, NULL),
(610, 7, 'El Rastreador', NULL, NULL),
(611, 7, 'El Rodeo', NULL, NULL),
(612, 7, 'El Tío', NULL, NULL),
(613, 7, 'Elena', NULL, NULL),
(614, 7, 'Embalse', NULL, NULL),
(615, 7, 'Esquina', NULL, NULL),
(616, 7, 'Estación Gral. Paz', NULL, NULL),
(617, 7, 'Estación Juárez Celman', NULL, NULL),
(618, 7, 'Estancia de Guadalupe', NULL, NULL),
(619, 7, 'Estancia Vieja', NULL, NULL),
(620, 7, 'Etruria', NULL, NULL),
(621, 7, 'Eufrasio Loza', NULL, NULL),
(622, 7, 'Falda del Carmen', NULL, NULL),
(623, 7, 'Freyre', NULL, NULL),
(624, 7, 'Gral. Baldissera', NULL, NULL),
(625, 7, 'Gral. Cabrera', NULL, NULL),
(626, 7, 'Gral. Deheza', NULL, NULL),
(627, 7, 'Gral. Fotheringham', NULL, NULL),
(628, 7, 'Gral. Levalle', NULL, NULL),
(629, 7, 'Gral. Roca', NULL, NULL),
(630, 7, 'Guanaco Muerto', NULL, NULL),
(631, 7, 'Guasapampa', NULL, NULL),
(632, 7, 'Guatimozin', NULL, NULL),
(633, 7, 'Gutenberg', NULL, NULL),
(634, 7, 'Hernando', NULL, NULL),
(635, 7, 'Huanchillas', NULL, NULL),
(636, 7, 'Huerta Grande', NULL, NULL),
(637, 7, 'Huinca Renanco', NULL, NULL),
(638, 7, 'Idiazabal', NULL, NULL),
(639, 7, 'Impira', NULL, NULL),
(640, 7, 'Inriville', NULL, NULL),
(641, 7, 'Isla Verde', NULL, NULL),
(642, 7, 'Italó', NULL, NULL),
(643, 7, 'James Craik', NULL, NULL),
(644, 7, 'Jesús María', NULL, NULL),
(645, 7, 'Jovita', NULL, NULL),
(646, 7, 'Justiniano Posse', NULL, NULL),
(647, 7, 'Km 658', NULL, NULL),
(648, 7, 'L. V. Mansilla', NULL, NULL),
(649, 7, 'La Batea', NULL, NULL),
(650, 7, 'La Calera', NULL, NULL),
(651, 7, 'La Carlota', NULL, NULL),
(652, 7, 'La Carolina', NULL, NULL),
(653, 7, 'La Cautiva', NULL, NULL),
(654, 7, 'La Cesira', NULL, NULL),
(655, 7, 'La Cruz', NULL, NULL),
(656, 7, 'La Cumbre', NULL, NULL),
(657, 7, 'La Cumbrecita', NULL, NULL),
(658, 7, 'La Falda', NULL, NULL),
(659, 7, 'La Francia', NULL, NULL),
(660, 7, 'La Granja', NULL, NULL),
(661, 7, 'La Higuera', NULL, NULL),
(662, 7, 'La Laguna', NULL, NULL),
(663, 7, 'La Paisanita', NULL, NULL),
(664, 7, 'La Palestina', NULL, NULL),
(665, 7, '12', NULL, NULL),
(666, 7, 'La Paquita', NULL, NULL),
(667, 7, 'La Para', NULL, NULL),
(668, 7, 'La Paz', NULL, NULL),
(669, 7, 'La Playa', NULL, NULL),
(670, 7, 'La Playosa', NULL, NULL),
(671, 7, 'La Población', NULL, NULL),
(672, 7, 'La Posta', NULL, NULL),
(673, 7, 'La Puerta', NULL, NULL),
(674, 7, 'La Quinta', NULL, NULL),
(675, 7, 'La Rancherita', NULL, NULL),
(676, 7, 'La Rinconada', NULL, NULL),
(677, 7, 'La Serranita', NULL, NULL),
(678, 7, 'La Tordilla', NULL, NULL),
(679, 7, 'Laborde', NULL, NULL),
(680, 7, 'Laboulaye', NULL, NULL),
(681, 7, 'Laguna Larga', NULL, NULL),
(682, 7, 'Las Acequias', NULL, NULL),
(683, 7, 'Las Albahacas', NULL, NULL),
(684, 7, 'Las Arrias', NULL, NULL),
(685, 7, 'Las Bajadas', NULL, NULL),
(686, 7, 'Las Caleras', NULL, NULL),
(687, 7, 'Las Calles', NULL, NULL),
(688, 7, 'Las Cañadas', NULL, NULL),
(689, 7, 'Las Gramillas', NULL, NULL),
(690, 7, 'Las Higueras', NULL, NULL),
(691, 7, 'Las Isletillas', NULL, NULL),
(692, 7, 'Las Junturas', NULL, NULL),
(693, 7, 'Las Palmas', NULL, NULL),
(694, 7, 'Las Peñas', NULL, NULL),
(695, 7, 'Las Peñas Sud', NULL, NULL),
(696, 7, 'Las Perdices', NULL, NULL),
(697, 7, 'Las Playas', NULL, NULL),
(698, 7, 'Las Rabonas', NULL, NULL),
(699, 7, 'Las Saladas', NULL, NULL),
(700, 7, 'Las Tapias', NULL, NULL),
(701, 7, 'Las Varas', NULL, NULL),
(702, 7, 'Las Varillas', NULL, NULL),
(703, 7, 'Las Vertientes', NULL, NULL),
(704, 7, 'Leguizamón', NULL, NULL),
(705, 7, 'Leones', NULL, NULL),
(706, 7, 'Los Cedros', NULL, NULL),
(707, 7, 'Los Cerrillos', NULL, NULL),
(708, 7, 'Los Chañaritos (C.E)', NULL, NULL),
(709, 7, 'Los Chanaritos (R.S)', NULL, NULL),
(710, 7, 'Los Cisnes', NULL, NULL),
(711, 7, 'Los Cocos', NULL, NULL),
(712, 7, 'Los Cóndores', NULL, NULL),
(713, 7, 'Los Hornillos', NULL, NULL),
(714, 7, 'Los Hoyos', NULL, NULL),
(715, 7, 'Los Mistoles', NULL, NULL),
(716, 7, 'Los Molinos', NULL, NULL),
(717, 7, 'Los Pozos', NULL, NULL),
(718, 7, 'Los Reartes', NULL, NULL),
(719, 7, 'Los Surgentes', NULL, NULL),
(720, 7, 'Los Talares', NULL, NULL),
(721, 7, 'Los Zorros', NULL, NULL),
(722, 7, 'Lozada', NULL, NULL),
(723, 7, 'Luca', NULL, NULL),
(724, 7, 'Luque', NULL, NULL),
(725, 7, 'Luyaba', NULL, NULL),
(726, 7, 'Malagueño', NULL, NULL),
(727, 7, 'Malena', NULL, NULL),
(728, 7, 'Malvinas Argentinas', NULL, NULL),
(729, 7, 'Manfredi', NULL, NULL),
(730, 7, 'Maquinista Gallini', NULL, NULL),
(731, 7, 'Marcos Juárez', NULL, NULL),
(732, 7, 'Marull', NULL, NULL),
(733, 7, 'Matorrales', NULL, NULL),
(734, 7, 'Mattaldi', NULL, NULL),
(735, 7, 'Mayu Sumaj', NULL, NULL),
(736, 7, 'Media Naranja', NULL, NULL),
(737, 7, 'Melo', NULL, NULL),
(738, 7, 'Mendiolaza', NULL, NULL),
(739, 7, 'Mi Granja', NULL, NULL),
(740, 7, 'Mina Clavero', NULL, NULL),
(741, 7, 'Miramar', NULL, NULL),
(742, 7, 'Morrison', NULL, NULL),
(743, 7, 'Morteros', NULL, NULL),
(744, 7, 'Mte. Buey', NULL, NULL),
(745, 7, 'Mte. Cristo', NULL, NULL),
(746, 7, 'Mte. De Los Gauchos', NULL, NULL),
(747, 7, 'Mte. Leña', NULL, NULL),
(748, 7, 'Mte. Maíz', NULL, NULL),
(749, 7, 'Mte. Ralo', NULL, NULL),
(750, 7, 'Nicolás Bruzone', NULL, NULL),
(751, 7, 'Noetinger', NULL, NULL),
(752, 7, 'Nono', NULL, NULL),
(753, 7, 'Nueva 7', NULL, NULL),
(754, 7, 'Obispo Trejo', NULL, NULL),
(755, 7, 'Olaeta', NULL, NULL),
(756, 7, 'Oliva', NULL, NULL),
(757, 7, 'Olivares San Nicolás', NULL, NULL),
(758, 7, 'Onagolty', NULL, NULL),
(759, 7, 'Oncativo', NULL, NULL),
(760, 7, 'Ordoñez', NULL, NULL),
(761, 7, 'Pacheco De Melo', NULL, NULL),
(762, 7, 'Pampayasta N.', NULL, NULL),
(763, 7, 'Pampayasta S.', NULL, NULL),
(764, 7, 'Panaholma', NULL, NULL),
(765, 7, 'Pascanas', NULL, NULL),
(766, 7, 'Pasco', NULL, NULL),
(767, 7, 'Paso del Durazno', NULL, NULL),
(768, 7, 'Paso Viejo', NULL, NULL),
(769, 7, 'Pilar', NULL, NULL),
(770, 7, 'Pincén', NULL, NULL),
(771, 7, 'Piquillín', NULL, NULL),
(772, 7, 'Plaza de Mercedes', NULL, NULL),
(773, 7, 'Plaza Luxardo', NULL, NULL),
(774, 7, 'Porteña', NULL, NULL),
(775, 7, 'Potrero de Garay', NULL, NULL),
(776, 7, 'Pozo del Molle', NULL, NULL),
(777, 7, 'Pozo Nuevo', NULL, NULL),
(778, 7, 'Pueblo Italiano', NULL, NULL),
(779, 7, 'Puesto de Castro', NULL, NULL),
(780, 7, 'Punta del Agua', NULL, NULL),
(781, 7, 'Quebracho Herrado', NULL, NULL),
(782, 7, 'Quilino', NULL, NULL),
(783, 7, 'Rafael García', NULL, NULL),
(784, 7, 'Ranqueles', NULL, NULL),
(785, 7, 'Rayo Cortado', NULL, NULL),
(786, 7, 'Reducción', NULL, NULL),
(787, 7, 'Rincón', NULL, NULL),
(788, 7, 'Río Bamba', NULL, NULL),
(789, 7, 'Río Ceballos', NULL, NULL),
(790, 7, 'Río Cuarto', NULL, NULL),
(791, 7, 'Río de Los Sauces', NULL, NULL),
(792, 7, 'Río Primero', NULL, NULL),
(793, 7, 'Río Segundo', NULL, NULL),
(794, 7, 'Río Tercero', NULL, NULL),
(795, 7, 'Rosales', NULL, NULL),
(796, 7, 'Rosario del Saladillo', NULL, NULL),
(797, 7, 'Sacanta', NULL, NULL),
(798, 7, 'Sagrada Familia', NULL, NULL),
(799, 7, 'Saira', NULL, NULL),
(800, 7, 'Saladillo', NULL, NULL),
(801, 7, 'Saldán', NULL, NULL),
(802, 7, 'Salsacate', NULL, NULL),
(803, 7, 'Salsipuedes', NULL, NULL),
(804, 7, 'Sampacho', NULL, NULL),
(805, 7, 'San Agustín', NULL, NULL),
(806, 7, 'San Antonio de Arredondo', NULL, NULL),
(807, 7, 'San Antonio de Litín', NULL, NULL),
(808, 7, 'San Basilio', NULL, NULL),
(809, 7, 'San Carlos Minas', NULL, NULL),
(810, 7, 'San Clemente', NULL, NULL),
(811, 7, 'San Esteban', NULL, NULL),
(812, 7, 'San Francisco', NULL, NULL),
(813, 7, 'San Ignacio', NULL, NULL),
(814, 7, 'San Javier', NULL, NULL),
(815, 7, 'San Jerónimo', NULL, NULL),
(816, 7, 'San Joaquín', NULL, NULL),
(817, 7, 'San José de La Dormida', NULL, NULL),
(818, 7, 'San José de Las Salinas', NULL, NULL),
(819, 7, 'San Lorenzo', NULL, NULL),
(820, 7, 'San Marcos Sierras', NULL, NULL),
(821, 7, 'San Marcos Sud', NULL, NULL),
(822, 7, 'San Pedro', NULL, NULL),
(823, 7, 'San Pedro N.', NULL, NULL),
(824, 7, 'San Roque', NULL, NULL),
(825, 7, 'San Vicente', NULL, NULL),
(826, 7, 'Santa Catalina', NULL, NULL),
(827, 7, 'Santa Elena', NULL, NULL),
(828, 7, 'Santa Eufemia', NULL, NULL),
(829, 7, 'Santa Maria', NULL, NULL),
(830, 7, 'Sarmiento', NULL, NULL),
(831, 7, 'Saturnino M.Laspiur', NULL, NULL),
(832, 7, 'Sauce Arriba', NULL, NULL),
(833, 7, 'Sebastián Elcano', NULL, NULL),
(834, 7, 'Seeber', NULL, NULL),
(835, 7, 'Segunda Usina', NULL, NULL),
(836, 7, 'Serrano', NULL, NULL),
(837, 7, 'Serrezuela', NULL, NULL),
(838, 7, 'Sgo. Temple', NULL, NULL),
(839, 7, 'Silvio Pellico', NULL, NULL),
(840, 7, 'Simbolar', NULL, NULL),
(841, 7, 'Sinsacate', NULL, NULL),
(842, 7, 'Sta. Rosa de Calamuchita', NULL, NULL),
(843, 7, 'Sta. Rosa de Río Primero', NULL, NULL),
(844, 7, 'Suco', NULL, NULL),
(845, 7, 'Tala Cañada', NULL, NULL),
(846, 7, 'Tala Huasi', NULL, NULL),
(847, 7, 'Talaini', NULL, NULL),
(848, 7, 'Tancacha', NULL, NULL),
(849, 7, 'Tanti', NULL, NULL),
(850, 7, 'Ticino', NULL, NULL),
(851, 7, 'Tinoco', NULL, NULL),
(852, 7, 'Tío Pujio', NULL, NULL),
(853, 7, 'Toledo', NULL, NULL),
(854, 7, 'Toro Pujio', NULL, NULL),
(855, 7, 'Tosno', NULL, NULL),
(856, 7, 'Tosquita', NULL, NULL),
(857, 7, 'Tránsito', NULL, NULL),
(858, 7, 'Tuclame', NULL, NULL),
(859, 7, 'Tutti', NULL, NULL),
(860, 7, 'Ucacha', NULL, NULL),
(861, 7, 'Unquillo', NULL, NULL),
(862, 7, 'Valle de Anisacate', NULL, NULL),
(863, 7, 'Valle Hermoso', NULL, NULL),
(864, 7, 'Vélez Sarfield', NULL, NULL),
(865, 7, 'Viamonte', NULL, NULL),
(866, 7, 'Vicuña Mackenna', NULL, NULL),
(867, 7, 'Villa Allende', NULL, NULL),
(868, 7, 'Villa Amancay', NULL, NULL),
(869, 7, 'Villa Ascasubi', NULL, NULL),
(870, 7, 'Villa Candelaria N.', NULL, NULL),
(871, 7, 'Villa Carlos Paz', NULL, NULL),
(872, 7, 'Villa Cerro Azul', NULL, NULL),
(873, 7, 'Villa Ciudad de América', NULL, NULL),
(874, 7, 'Villa Ciudad Pque Los Reartes', NULL, NULL),
(875, 7, 'Villa Concepción del Tío', NULL, NULL),
(876, 7, 'Villa Cura Brochero', NULL, NULL),
(877, 7, 'Villa de Las Rosas', NULL, NULL),
(878, 7, 'Villa de María', NULL, NULL),
(879, 7, 'Villa de Pocho', NULL, NULL),
(880, 7, 'Villa de Soto', NULL, NULL),
(881, 7, 'Villa del Dique', NULL, NULL),
(882, 7, 'Villa del Prado', NULL, NULL),
(883, 7, 'Villa del Rosario', NULL, NULL),
(884, 7, 'Villa del Totoral', NULL, NULL),
(885, 7, 'Villa Dolores', NULL, NULL),
(886, 7, 'Villa El Chancay', NULL, NULL),
(887, 7, 'Villa Elisa', NULL, NULL),
(888, 7, 'Villa Flor Serrana', NULL, NULL),
(889, 7, 'Villa Fontana', NULL, NULL),
(890, 7, 'Villa Giardino', NULL, NULL),
(891, 7, 'Villa Gral. Belgrano', NULL, NULL),
(892, 7, 'Villa Gutierrez', NULL, NULL),
(893, 7, 'Villa Huidobro', NULL, NULL),
(894, 7, 'Villa La Bolsa', NULL, NULL),
(895, 7, 'Villa Los Aromos', NULL, NULL),
(896, 7, 'Villa Los Patos', NULL, NULL),
(897, 7, 'Villa María', NULL, NULL),
(898, 7, 'Villa Nueva', NULL, NULL),
(899, 7, 'Villa Pque. Santa Ana', NULL, NULL),
(900, 7, 'Villa Pque. Siquiman', NULL, NULL),
(901, 7, 'Villa Quillinzo', NULL, NULL),
(902, 7, 'Villa Rossi', NULL, NULL),
(903, 7, 'Villa Rumipal', NULL, NULL),
(904, 7, 'Villa San Esteban', NULL, NULL),
(905, 7, 'Villa San Isidro', NULL, NULL),
(906, 7, 'Villa 21', NULL, NULL),
(907, 7, 'Villa Sarmiento (G.R)', NULL, NULL),
(908, 7, 'Villa Sarmiento (S.A)', NULL, NULL),
(909, 7, 'Villa Tulumba', NULL, NULL),
(910, 7, 'Villa Valeria', NULL, NULL),
(911, 7, 'Villa Yacanto', NULL, NULL),
(912, 7, 'Washington', NULL, NULL),
(913, 7, 'Wenceslao Escalante', NULL, NULL),
(914, 7, 'Ycho Cruz Sierras', NULL, NULL),
(915, 8, 'Alvear', NULL, NULL),
(916, 8, 'Bella Vista', NULL, NULL),
(917, 8, 'Berón de Astrada', NULL, NULL),
(918, 8, 'Bonpland', NULL, NULL),
(919, 8, 'Caá Cati', NULL, NULL),
(920, 8, 'Capital', NULL, NULL),
(921, 8, 'Chavarría', NULL, NULL),
(922, 8, 'Col. C. Pellegrini', NULL, NULL),
(923, 8, 'Col. Libertad', NULL, NULL),
(924, 8, 'Col. Liebig', NULL, NULL),
(925, 8, 'Col. Sta Rosa', NULL, NULL),
(926, 8, 'Concepción', NULL, NULL),
(927, 8, 'Cruz de Los Milagros', NULL, NULL),
(928, 8, 'Curuzú-Cuatiá', NULL, NULL),
(929, 8, 'Empedrado', NULL, NULL),
(930, 8, 'Esquina', NULL, NULL),
(931, 8, 'Estación Torrent', NULL, NULL),
(932, 8, 'Felipe Yofré', NULL, NULL),
(933, 8, 'Garruchos', NULL, NULL),
(934, 8, 'Gdor. Agrónomo', NULL, NULL),
(935, 8, 'Gdor. Martínez', NULL, NULL),
(936, 8, 'Goya', NULL, NULL),
(937, 8, 'Guaviravi', NULL, NULL),
(938, 8, 'Herlitzka', NULL, NULL),
(939, 8, 'Ita-Ibate', NULL, NULL),
(940, 8, 'Itatí', NULL, NULL),
(941, 8, 'Ituzaingó', NULL, NULL),
(942, 8, 'José Rafael Gómez', NULL, NULL),
(943, 8, 'Juan Pujol', NULL, NULL),
(944, 8, 'La Cruz', NULL, NULL),
(945, 8, 'Lavalle', NULL, NULL),
(946, 8, 'Lomas de Vallejos', NULL, NULL),
(947, 8, 'Loreto', NULL, NULL),
(948, 8, 'Mariano I. Loza', NULL, NULL),
(949, 8, 'Mburucuyá', NULL, NULL),
(950, 8, 'Mercedes', NULL, NULL),
(951, 8, 'Mocoretá', NULL, NULL),
(952, 8, 'Mte. Caseros', NULL, NULL),
(953, 8, 'Nueve de Julio', NULL, NULL),
(954, 8, 'Palmar Grande', NULL, NULL),
(955, 8, 'Parada Pucheta', NULL, NULL),
(956, 8, 'Paso de La Patria', NULL, NULL),
(957, 8, 'Paso de Los Libres', NULL, NULL),
(958, 8, 'Pedro R. Fernandez', NULL, NULL),
(959, 8, 'Perugorría', NULL, NULL),
(960, 8, 'Pueblo Libertador', NULL, NULL),
(961, 8, 'Ramada Paso', NULL, NULL),
(962, 8, 'Riachuelo', NULL, NULL),
(963, 8, 'Saladas', NULL, NULL),
(964, 8, 'San Antonio', NULL, NULL),
(965, 8, 'San Carlos', NULL, NULL),
(966, 8, 'San Cosme', NULL, NULL),
(967, 8, 'San Lorenzo', NULL, NULL),
(968, 8, '20 del Palmar', NULL, NULL),
(969, 8, 'San Miguel', NULL, NULL),
(970, 8, 'San Roque', NULL, NULL),
(971, 8, 'Santa Ana', NULL, NULL),
(972, 8, 'Santa Lucía', NULL, NULL),
(973, 8, 'Santo Tomé', NULL, NULL),
(974, 8, 'Sauce', NULL, NULL),
(975, 8, 'Tabay', NULL, NULL),
(976, 8, 'Tapebicuá', NULL, NULL),
(977, 8, 'Tatacua', NULL, NULL),
(978, 8, 'Virasoro', NULL, NULL),
(979, 8, 'Yapeyú', NULL, NULL),
(980, 8, 'Yataití Calle', NULL, NULL),
(981, 9, 'Alarcón', NULL, NULL),
(982, 9, 'Alcaraz', NULL, NULL),
(983, 9, 'Alcaraz N.', NULL, NULL),
(984, 9, 'Alcaraz S.', NULL, NULL),
(985, 9, 'Aldea Asunción', NULL, NULL),
(986, 9, 'Aldea Brasilera', NULL, NULL),
(987, 9, 'Aldea Elgenfeld', NULL, NULL),
(988, 9, 'Aldea Grapschental', NULL, NULL),
(989, 9, 'Aldea Ma. Luisa', NULL, NULL),
(990, 9, 'Aldea Protestante', NULL, NULL),
(991, 9, 'Aldea Salto', NULL, NULL),
(992, 9, 'Aldea San Antonio (G)', NULL, NULL),
(993, 9, 'Aldea San Antonio (P)', NULL, NULL),
(994, 9, 'Aldea 19', NULL, NULL),
(995, 9, 'Aldea San Miguel', NULL, NULL),
(996, 9, 'Aldea San Rafael', NULL, NULL),
(997, 9, 'Aldea Spatzenkutter', NULL, NULL),
(998, 9, 'Aldea Sta. María', NULL, NULL),
(999, 9, 'Aldea Sta. Rosa', NULL, NULL),
(1000, 9, 'Aldea Valle María', NULL, NULL),
(1001, 9, 'Altamirano Sur', NULL, NULL),
(1002, 9, 'Antelo', NULL, NULL),
(1003, 9, 'Antonio Tomás', NULL, NULL),
(1004, 9, 'Aranguren', NULL, NULL),
(1005, 9, 'Arroyo Barú', NULL, NULL),
(1006, 9, 'Arroyo Burgos', NULL, NULL),
(1007, 9, 'Arroyo Clé', NULL, NULL),
(1008, 9, 'Arroyo Corralito', NULL, NULL),
(1009, 9, 'Arroyo del Medio', NULL, NULL),
(1010, 9, 'Arroyo Maturrango', NULL, NULL),
(1011, 9, 'Arroyo Palo Seco', NULL, NULL),
(1012, 9, 'Banderas', NULL, NULL),
(1013, 9, 'Basavilbaso', NULL, NULL),
(1014, 9, 'Betbeder', NULL, NULL),
(1015, 9, 'Bovril', NULL, NULL),
(1016, 9, 'Caseros', NULL, NULL),
(1017, 9, 'Ceibas', NULL, NULL),
(1018, 9, 'Cerrito', NULL, NULL),
(1019, 9, 'Chajarí', NULL, NULL),
(1020, 9, 'Chilcas', NULL, NULL),
(1021, 9, 'Clodomiro Ledesma', NULL, NULL),
(1022, 9, 'Col. Alemana', NULL, NULL),
(1023, 9, 'Col. Avellaneda', NULL, NULL),
(1024, 9, 'Col. Avigdor', NULL, NULL),
(1025, 9, 'Col. Ayuí', NULL, NULL),
(1026, 9, 'Col. Baylina', NULL, NULL),
(1027, 9, 'Col. Carrasco', NULL, NULL),
(1028, 9, 'Col. Celina', NULL, NULL),
(1029, 9, 'Col. Cerrito', NULL, NULL),
(1030, 9, 'Col. Crespo', NULL, NULL),
(1031, 9, 'Col. Elia', NULL, NULL),
(1032, 9, 'Col. Ensayo', NULL, NULL),
(1033, 9, 'Col. Gral. Roca', NULL, NULL),
(1034, 9, 'Col. La Argentina', NULL, NULL),
(1035, 9, 'Col. Merou', NULL, NULL),
(1036, 9, 'Col. Oficial Nª3', NULL, NULL),
(1037, 9, 'Col. Oficial Nº13', NULL, NULL),
(1038, 9, 'Col. Oficial Nº14', NULL, NULL),
(1039, 9, 'Col. Oficial Nº5', NULL, NULL),
(1040, 9, 'Col. Reffino', NULL, NULL),
(1041, 9, 'Col. Tunas', NULL, NULL),
(1042, 9, 'Col. Viraró', NULL, NULL),
(1043, 9, 'Colón', NULL, NULL),
(1044, 9, 'Concepción del Uruguay', NULL, NULL),
(1045, 9, 'Concordia', NULL, NULL),
(1046, 9, 'Conscripto Bernardi', NULL, NULL),
(1047, 9, 'Costa Grande', NULL, NULL),
(1048, 9, 'Costa San Antonio', NULL, NULL),
(1049, 9, 'Costa Uruguay N.', NULL, NULL),
(1050, 9, 'Costa Uruguay S.', NULL, NULL),
(1051, 9, 'Crespo', NULL, NULL),
(1052, 9, 'Crucecitas 3ª', NULL, NULL),
(1053, 9, 'Crucecitas 7ª', NULL, NULL),
(1054, 9, 'Crucecitas 8ª', NULL, NULL),
(1055, 9, 'Cuchilla Redonda', NULL, NULL),
(1056, 9, 'Curtiembre', NULL, NULL),
(1057, 9, 'Diamante', NULL, NULL),
(1058, 9, 'Distrito 6º', NULL, NULL),
(1059, 9, 'Distrito Chañar', NULL, NULL),
(1060, 9, 'Distrito Chiqueros', NULL, NULL),
(1061, 9, 'Distrito Cuarto', NULL, NULL),
(1062, 9, 'Distrito Diego López', NULL, NULL),
(1063, 9, 'Distrito Pajonal', NULL, NULL),
(1064, 9, 'Distrito Sauce', NULL, NULL),
(1065, 9, 'Distrito Tala', NULL, NULL),
(1066, 9, 'Distrito Talitas', NULL, NULL),
(1067, 9, 'Don Cristóbal 1ª Sección', NULL, NULL),
(1068, 9, 'Don Cristóbal 2ª Sección', NULL, NULL),
(1069, 9, 'Durazno', NULL, NULL),
(1070, 9, 'El Cimarrón', NULL, NULL),
(1071, 9, 'El Gramillal', NULL, NULL),
(1072, 9, 'El Palenque', NULL, NULL),
(1073, 9, 'El Pingo', NULL, NULL),
(1074, 9, 'El Quebracho', NULL, NULL),
(1075, 9, 'El Redomón', NULL, NULL),
(1076, 9, 'El Solar', NULL, NULL),
(1077, 9, 'Enrique Carbo', NULL, NULL),
(1078, 9, '9', NULL, NULL),
(1079, 9, 'Espinillo N.', NULL, NULL),
(1080, 9, 'Estación Campos', NULL, NULL),
(1081, 9, 'Estación Escriña', NULL, NULL),
(1082, 9, 'Estación Lazo', NULL, NULL),
(1083, 9, 'Estación Raíces', NULL, NULL),
(1084, 9, 'Estación Yerúa', NULL, NULL),
(1085, 9, 'Estancia Grande', NULL, NULL),
(1086, 9, 'Estancia Líbaros', NULL, NULL),
(1087, 9, 'Estancia Racedo', NULL, NULL),
(1088, 9, 'Estancia Solá', NULL, NULL),
(1089, 9, 'Estancia Yuquerí', NULL, NULL),
(1090, 9, 'Estaquitas', NULL, NULL),
(1091, 9, 'Faustino M. Parera', NULL, NULL),
(1092, 9, 'Febre', NULL, NULL),
(1093, 9, 'Federación', NULL, NULL),
(1094, 9, 'Federal', NULL, NULL),
(1095, 9, 'Gdor. Echagüe', NULL, NULL),
(1096, 9, 'Gdor. Mansilla', NULL, NULL),
(1097, 9, 'Gilbert', NULL, NULL),
(1098, 9, 'González Calderón', NULL, NULL),
(1099, 9, 'Gral. Almada', NULL, NULL),
(1100, 9, 'Gral. Alvear', NULL, NULL),
(1101, 9, 'Gral. Campos', NULL, NULL),
(1102, 9, 'Gral. Galarza', NULL, NULL),
(1103, 9, 'Gral. Ramírez', NULL, NULL),
(1104, 9, 'Gualeguay', NULL, NULL),
(1105, 9, 'Gualeguaychú', NULL, NULL),
(1106, 9, 'Gualeguaycito', NULL, NULL),
(1107, 9, 'Guardamonte', NULL, NULL),
(1108, 9, 'Hambis', NULL, NULL),
(1109, 9, 'Hasenkamp', NULL, NULL),
(1110, 9, 'Hernandarias', NULL, NULL),
(1111, 9, 'Hernández', NULL, NULL),
(1112, 9, 'Herrera', NULL, NULL),
(1113, 9, 'Hinojal', NULL, NULL),
(1114, 9, 'Hocker', NULL, NULL),
(1115, 9, 'Ing. Sajaroff', NULL, NULL),
(1116, 9, 'Irazusta', NULL, NULL),
(1117, 9, 'Isletas', NULL, NULL),
(1118, 9, 'J.J De Urquiza', NULL, NULL),
(1119, 9, 'Jubileo', NULL, NULL),
(1120, 9, 'La Clarita', NULL, NULL),
(1121, 9, 'La Criolla', NULL, NULL),
(1122, 9, 'La Esmeralda', NULL, NULL),
(1123, 9, 'La Florida', NULL, NULL),
(1124, 9, 'La Fraternidad', NULL, NULL),
(1125, 9, 'La Hierra', NULL, NULL),
(1126, 9, 'La Ollita', NULL, NULL),
(1127, 9, 'La Paz', NULL, NULL),
(1128, 9, 'La Picada', NULL, NULL),
(1129, 9, 'La Providencia', NULL, NULL),
(1130, 9, 'La Verbena', NULL, NULL),
(1131, 9, 'Laguna Benítez', NULL, NULL),
(1132, 9, 'Larroque', NULL, NULL),
(1133, 9, 'Las Cuevas', NULL, NULL),
(1134, 9, 'Las Garzas', NULL, NULL),
(1135, 9, 'Las Guachas', NULL, NULL),
(1136, 9, 'Las Mercedes', NULL, NULL),
(1137, 9, 'Las Moscas', NULL, NULL),
(1138, 9, 'Las Mulitas', NULL, NULL),
(1139, 9, 'Las Toscas', NULL, NULL),
(1140, 9, 'Laurencena', NULL, NULL),
(1141, 9, 'Libertador San Martín', NULL, NULL),
(1142, 9, 'Loma Limpia', NULL, NULL),
(1143, 9, 'Los Ceibos', NULL, NULL),
(1144, 9, 'Los Charruas', NULL, NULL),
(1145, 9, 'Los Conquistadores', NULL, NULL),
(1146, 9, 'Lucas González', NULL, NULL),
(1147, 9, 'Lucas N.', NULL, NULL),
(1148, 9, 'Lucas S. 1ª', NULL, NULL),
(1149, 9, 'Lucas S. 2ª', NULL, NULL),
(1150, 9, 'Maciá', NULL, NULL),
(1151, 9, 'María Grande', NULL, NULL),
(1152, 9, 'María Grande 2ª', NULL, NULL),
(1153, 9, 'Médanos', NULL, NULL),
(1154, 9, 'Mojones N.', NULL, NULL),
(1155, 9, 'Mojones S.', NULL, NULL),
(1156, 9, 'Molino Doll', NULL, NULL),
(1157, 9, 'Monte Redondo', NULL, NULL),
(1158, 9, 'Montoya', NULL, NULL),
(1159, 9, 'Mulas Grandes', NULL, NULL),
(1160, 9, 'Ñancay', NULL, NULL),
(1161, 9, 'Nogoyá', NULL, NULL),
(1162, 9, 'Nueva Escocia', NULL, NULL),
(1163, 9, 'Nueva Vizcaya', NULL, NULL),
(1164, 9, 'Ombú', NULL, NULL),
(1165, 9, 'Oro Verde', NULL, NULL),
(1166, 9, 'Paraná', NULL, NULL),
(1167, 9, 'Pasaje Guayaquil', NULL, NULL),
(1168, 9, 'Pasaje Las Tunas', NULL, NULL),
(1169, 9, 'Paso de La Arena', NULL, NULL),
(1170, 9, 'Paso de La Laguna', NULL, NULL),
(1171, 9, 'Paso de Las Piedras', NULL, NULL),
(1172, 9, 'Paso Duarte', NULL, NULL),
(1173, 9, 'Pastor Britos', NULL, NULL),
(1174, 9, 'Pedernal', NULL, NULL),
(1175, 9, 'Perdices', NULL, NULL),
(1176, 9, 'Picada Berón', NULL, NULL),
(1177, 9, 'Piedras Blancas', NULL, NULL),
(1178, 9, 'Primer Distrito Cuchilla', NULL, NULL),
(1179, 9, 'Primero de Mayo', NULL, NULL),
(1180, 9, 'Pronunciamiento', NULL, NULL),
(1181, 9, 'Pto. Algarrobo', NULL, NULL),
(1182, 9, 'Pto. Ibicuy', NULL, NULL),
(1183, 9, 'Pueblo Brugo', NULL, NULL),
(1184, 9, 'Pueblo Cazes', NULL, NULL),
(1185, 9, 'Pueblo Gral. Belgrano', NULL, NULL),
(1186, 9, 'Pueblo Liebig', NULL, NULL),
(1187, 9, 'Puerto Yeruá', NULL, NULL),
(1188, 9, 'Punta del Monte', NULL, NULL),
(1189, 9, 'Quebracho', NULL, NULL),
(1190, 9, 'Quinto Distrito', NULL, NULL),
(1191, 9, 'Raices Oeste', NULL, NULL),
(1192, 9, 'Rincón de Nogoyá', NULL, NULL),
(1193, 9, 'Rincón del Cinto', NULL, NULL),
(1194, 9, 'Rincón del Doll', NULL, NULL),
(1195, 9, 'Rincón del Gato', NULL, NULL),
(1196, 9, 'Rocamora', NULL, NULL),
(1197, 9, 'Rosario del Tala', NULL, NULL),
(1198, 9, 'San Benito', NULL, NULL),
(1199, 9, 'San Cipriano', NULL, NULL),
(1200, 9, 'San Ernesto', NULL, NULL),
(1201, 9, 'San Gustavo', NULL, NULL),
(1202, 9, 'San Jaime', NULL, NULL),
(1203, 9, 'San José', NULL, NULL),
(1204, 9, 'San José de Feliciano', NULL, NULL),
(1205, 9, 'San Justo', NULL, NULL),
(1206, 9, 'San Marcial', NULL, NULL),
(1207, 9, 'San Pedro', NULL, NULL),
(1208, 9, 'San Ramírez', NULL, NULL),
(1209, 9, 'San Ramón', NULL, NULL),
(1210, 9, 'San Roque', NULL, NULL),
(1211, 9, 'San Salvador', NULL, NULL),
(1212, 9, 'San Víctor', NULL, NULL),
(1213, 9, 'Santa Ana', NULL, NULL),
(1214, 9, 'Santa Anita', NULL, NULL),
(1215, 9, 'Santa Elena', NULL, NULL),
(1216, 9, 'Santa Lucía', NULL, NULL),
(1217, 9, 'Santa Luisa', NULL, NULL),
(1218, 9, 'Sauce de Luna', NULL, NULL),
(1219, 9, 'Sauce Montrull', NULL, NULL),
(1220, 9, 'Sauce Pinto', NULL, NULL),
(1221, 9, 'Sauce Sur', NULL, NULL),
(1222, 9, 'Seguí', NULL, NULL),
(1223, 9, 'Sir Leonard', NULL, NULL),
(1224, 9, 'Sosa', NULL, NULL),
(1225, 9, 'Tabossi', NULL, NULL),
(1226, 9, 'Tezanos Pinto', NULL, NULL),
(1227, 9, 'Ubajay', NULL, NULL),
(1228, 9, 'Urdinarrain', NULL, NULL),
(1229, 9, 'Veinte de Septiembre', NULL, NULL),
(1230, 9, 'Viale', NULL, NULL),
(1231, 9, 'Victoria', NULL, NULL),
(1232, 9, 'Villa Clara', NULL, NULL),
(1233, 9, 'Villa del Rosario', NULL, NULL),
(1234, 9, 'Villa Domínguez', NULL, NULL),
(1235, 9, 'Villa Elisa', NULL, NULL),
(1236, 9, 'Villa Fontana', NULL, NULL),
(1237, 9, 'Villa Gdor. Etchevehere', NULL, NULL),
(1238, 9, 'Villa Mantero', NULL, NULL),
(1239, 9, 'Villa Paranacito', NULL, NULL),
(1240, 9, 'Villa Urquiza', NULL, NULL),
(1241, 9, 'Villaguay', NULL, NULL),
(1242, 9, 'Walter Moss', NULL, NULL),
(1243, 9, 'Yacaré', NULL, NULL),
(1244, 9, 'Yeso Oeste', NULL, NULL),
(1245, 10, 'Buena Vista', NULL, NULL),
(1246, 10, 'Clorinda', NULL, NULL),
(1247, 10, 'Col. Pastoril', NULL, NULL),
(1248, 10, 'Cte. Fontana', NULL, NULL),
(1249, 10, 'El Colorado', NULL, NULL),
(1250, 10, 'El Espinillo', NULL, NULL),
(1251, 10, 'Estanislao Del Campo', NULL, NULL),
(1252, 10, '10', NULL, NULL),
(1253, 10, 'Fortín Lugones', NULL, NULL),
(1254, 10, 'Gral. Lucio V. Mansilla', NULL, NULL),
(1255, 10, 'Gral. Manuel Belgrano', NULL, NULL),
(1256, 10, 'Gral. Mosconi', NULL, NULL),
(1257, 10, 'Gran Guardia', NULL, NULL),
(1258, 10, 'Herradura', NULL, NULL),
(1259, 10, 'Ibarreta', NULL, NULL),
(1260, 10, 'Ing. Juárez', NULL, NULL),
(1261, 10, 'Laguna Blanca', NULL, NULL),
(1262, 10, 'Laguna Naick Neck', NULL, NULL),
(1263, 10, 'Laguna Yema', NULL, NULL),
(1264, 10, 'Las Lomitas', NULL, NULL),
(1265, 10, 'Los Chiriguanos', NULL, NULL),
(1266, 10, 'Mayor V. Villafañe', NULL, NULL),
(1267, 10, 'Misión San Fco.', NULL, NULL),
(1268, 10, 'Palo Santo', NULL, NULL),
(1269, 10, 'Pirané', NULL, NULL),
(1270, 10, 'Pozo del Maza', NULL, NULL),
(1271, 10, 'Riacho He-He', NULL, NULL),
(1272, 10, 'San Hilario', NULL, NULL),
(1273, 10, 'San Martín II', NULL, NULL),
(1274, 10, 'Siete Palmas', NULL, NULL),
(1275, 10, 'Subteniente Perín', NULL, NULL),
(1276, 10, 'Tres Lagunas', NULL, NULL),
(1277, 10, 'Villa Dos Trece', NULL, NULL),
(1278, 10, 'Villa Escolar', NULL, NULL),
(1279, 10, 'Villa Gral. Güemes', NULL, NULL),
(1280, 11, 'Abdon Castro Tolay', NULL, NULL),
(1281, 11, 'Abra Pampa', NULL, NULL),
(1282, 11, 'Abralaite', NULL, NULL),
(1283, 11, 'Aguas Calientes', NULL, NULL),
(1284, 11, 'Arrayanal', NULL, NULL),
(1285, 11, 'Barrios', NULL, NULL),
(1286, 11, 'Caimancito', NULL, NULL),
(1287, 11, 'Calilegua', NULL, NULL),
(1288, 11, 'Cangrejillos', NULL, NULL),
(1289, 11, 'Caspala', NULL, NULL),
(1290, 11, 'Catuá', NULL, NULL),
(1291, 11, 'Cieneguillas', NULL, NULL),
(1292, 11, 'Coranzulli', NULL, NULL),
(1293, 11, 'Cusi-Cusi', NULL, NULL),
(1294, 11, 'El Aguilar', NULL, NULL),
(1295, 11, 'El Carmen', NULL, NULL),
(1296, 11, 'El Cóndor', NULL, NULL),
(1297, 11, 'El Fuerte', NULL, NULL),
(1298, 11, 'El Piquete', NULL, NULL),
(1299, 11, 'El Talar', NULL, NULL),
(1300, 11, 'Fraile Pintado', NULL, NULL),
(1301, 11, 'Hipólito Yrigoyen', NULL, NULL),
(1302, 11, 'Huacalera', NULL, NULL),
(1303, 11, 'Humahuaca', NULL, NULL),
(1304, 11, 'La Esperanza', NULL, NULL),
(1305, 11, 'La Mendieta', NULL, NULL),
(1306, 11, 'La Quiaca', NULL, NULL),
(1307, 11, 'Ledesma', NULL, NULL),
(1308, 11, 'Libertador Gral. San Martin', NULL, NULL),
(1309, 11, 'Maimara', NULL, NULL),
(1310, 11, 'Mina Pirquitas', NULL, NULL),
(1311, 11, 'Monterrico', NULL, NULL),
(1312, 11, 'Palma Sola', NULL, NULL),
(1313, 11, 'Palpalá', NULL, NULL),
(1314, 11, 'Pampa Blanca', NULL, NULL),
(1315, 11, 'Pampichuela', NULL, NULL),
(1316, 11, 'Perico', NULL, NULL),
(1317, 11, 'Puesto del Marqués', NULL, NULL),
(1318, 11, 'Puesto Viejo', NULL, NULL),
(1319, 11, 'Pumahuasi', NULL, NULL),
(1320, 11, 'Purmamarca', NULL, NULL),
(1321, 11, 'Rinconada', NULL, NULL),
(1322, 11, 'Rodeitos', NULL, NULL),
(1323, 11, 'Rosario de Río Grande', NULL, NULL),
(1324, 11, 'San Antonio', NULL, NULL),
(1325, 11, 'San Francisco', NULL, NULL),
(1326, 11, 'San Pedro', NULL, NULL),
(1327, 11, 'San Rafael', NULL, NULL),
(1328, 11, 'San Salvador', NULL, NULL),
(1329, 11, 'Santa Ana', NULL, NULL),
(1330, 11, 'Santa Catalina', NULL, NULL),
(1331, 11, 'Santa Clara', NULL, NULL),
(1332, 11, 'Susques', NULL, NULL),
(1333, 11, 'Tilcara', NULL, NULL),
(1334, 11, 'Tres Cruces', NULL, NULL),
(1335, 11, 'Tumbaya', NULL, NULL),
(1336, 11, 'Valle Grande', NULL, NULL),
(1337, 11, 'Vinalito', NULL, NULL),
(1338, 11, 'Volcán', NULL, NULL),
(1339, 11, 'Yala', NULL, NULL),
(1340, 11, 'Yaví', NULL, NULL),
(1341, 11, 'Yuto', NULL, NULL),
(1342, 12, 'Abramo', NULL, NULL),
(1343, 12, 'Adolfo Van Praet', NULL, NULL),
(1344, 12, 'Agustoni', NULL, NULL),
(1345, 12, 'Algarrobo del Aguila', NULL, NULL),
(1346, 12, 'Alpachiri', NULL, NULL),
(1347, 12, 'Alta Italia', NULL, NULL),
(1348, 12, 'Anguil', NULL, NULL),
(1349, 12, 'Arata', NULL, NULL),
(1350, 12, 'Ataliva Roca', NULL, NULL),
(1351, 12, 'Bernardo Larroude', NULL, NULL),
(1352, 12, 'Bernasconi', NULL, NULL),
(1353, 12, 'Caleufú', NULL, NULL),
(1354, 12, 'Carro Quemado', NULL, NULL),
(1355, 12, 'Catriló', NULL, NULL),
(1356, 12, 'Ceballos', NULL, NULL),
(1357, 12, 'Chacharramendi', NULL, NULL),
(1358, 12, 'Col. Barón', NULL, NULL),
(1359, 12, 'Col. Santa María', NULL, NULL),
(1360, 12, 'Conhelo', NULL, NULL),
(1361, 12, 'Coronel Hilario Lagos', NULL, NULL),
(1362, 12, 'Cuchillo-Có', NULL, NULL),
(1363, 12, 'Doblas', NULL, NULL),
(1364, 12, 'Dorila', NULL, NULL),
(1365, 12, 'Eduardo Castex', NULL, NULL),
(1366, 12, 'Embajador Martini', NULL, NULL),
(1367, 12, 'Falucho', NULL, NULL),
(1368, 12, 'Gral. Acha', NULL, NULL),
(1369, 12, 'Gral. Manuel Campos', NULL, NULL),
(1370, 12, 'Gral. Pico', NULL, NULL),
(1371, 12, 'Guatraché', NULL, NULL),
(1372, 12, 'Ing. Luiggi', NULL, NULL),
(1373, 12, 'Intendente Alvear', NULL, NULL),
(1374, 12, 'Jacinto Arauz', NULL, NULL),
(1375, 12, 'La Adela', NULL, NULL),
(1376, 12, 'La Humada', NULL, NULL),
(1377, 12, 'La Maruja', NULL, NULL),
(1378, 12, '12', NULL, NULL),
(1379, 12, 'La Reforma', NULL, NULL),
(1380, 12, 'Limay Mahuida', NULL, NULL),
(1381, 12, 'Lonquimay', NULL, NULL),
(1382, 12, 'Loventuel', NULL, NULL),
(1383, 12, 'Luan Toro', NULL, NULL),
(1384, 12, 'Macachín', NULL, NULL),
(1385, 12, 'Maisonnave', NULL, NULL),
(1386, 12, 'Mauricio Mayer', NULL, NULL),
(1387, 12, 'Metileo', NULL, NULL),
(1388, 12, 'Miguel Cané', NULL, NULL),
(1389, 12, 'Miguel Riglos', NULL, NULL),
(1390, 12, 'Monte Nievas', NULL, NULL),
(1391, 12, 'Parera', NULL, NULL),
(1392, 12, 'Perú', NULL, NULL),
(1393, 12, 'Pichi-Huinca', NULL, NULL),
(1394, 12, 'Puelches', NULL, NULL),
(1395, 12, 'Puelén', NULL, NULL),
(1396, 12, 'Quehue', NULL, NULL),
(1397, 12, 'Quemú Quemú', NULL, NULL),
(1398, 12, 'Quetrequén', NULL, NULL),
(1399, 12, 'Rancul', NULL, NULL),
(1400, 12, 'Realicó', NULL, NULL),
(1401, 12, 'Relmo', NULL, NULL),
(1402, 12, 'Rolón', NULL, NULL);
INSERT INTO `localidades` (`id`, `provincia_id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1403, 12, 'Rucanelo', NULL, NULL),
(1404, 12, 'Sarah', NULL, NULL),
(1405, 12, 'Speluzzi', NULL, NULL),
(1406, 12, 'Sta. Isabel', NULL, NULL),
(1407, 12, 'Sta. Rosa', NULL, NULL),
(1408, 12, 'Sta. Teresa', NULL, NULL),
(1409, 12, 'Telén', NULL, NULL),
(1410, 12, 'Toay', NULL, NULL),
(1411, 12, 'Tomas M. de Anchorena', NULL, NULL),
(1412, 12, 'Trenel', NULL, NULL),
(1413, 12, 'Unanue', NULL, NULL),
(1414, 12, 'Uriburu', NULL, NULL),
(1415, 12, 'Veinticinco de Mayo', NULL, NULL),
(1416, 12, 'Vertiz', NULL, NULL),
(1417, 12, 'Victorica', NULL, NULL),
(1418, 12, 'Villa Mirasol', NULL, NULL),
(1419, 12, 'Winifreda', NULL, NULL),
(1420, 13, 'Arauco', NULL, NULL),
(1421, 13, 'Capital', NULL, NULL),
(1422, 13, 'Castro Barros', NULL, NULL),
(1423, 13, 'Chamical', NULL, NULL),
(1424, 13, 'Chilecito', NULL, NULL),
(1425, 13, 'Coronel F. Varela', NULL, NULL),
(1426, 13, 'Famatina', NULL, NULL),
(1427, 13, 'Gral. A.V.Peñaloza', NULL, NULL),
(1428, 13, 'Gral. Belgrano', NULL, NULL),
(1429, 13, 'Gral. J.F. Quiroga', NULL, NULL),
(1430, 13, 'Gral. Lamadrid', NULL, NULL),
(1431, 13, 'Gral. Ocampo', NULL, NULL),
(1432, 13, 'Gral. San Martín', NULL, NULL),
(1433, 13, 'Independencia', NULL, NULL),
(1434, 13, 'Rosario Penaloza', NULL, NULL),
(1435, 13, 'San Blas de Los Sauces', NULL, NULL),
(1436, 13, 'Sanagasta', NULL, NULL),
(1437, 13, 'Vinchina', NULL, NULL),
(1438, 14, 'Capital', NULL, NULL),
(1439, 14, 'Chacras de Coria', NULL, NULL),
(1440, 14, 'Dorrego', NULL, NULL),
(1441, 14, 'Gllen', NULL, NULL),
(1442, 14, 'Godoy Cruz', NULL, NULL),
(1443, 14, 'Gral. Alvear', NULL, NULL),
(1444, 14, 'Guaymallén', NULL, NULL),
(1445, 14, 'Junín', NULL, NULL),
(1446, 14, 'La Paz', NULL, NULL),
(1447, 14, 'Las Heras', NULL, NULL),
(1448, 14, 'Lavalle', NULL, NULL),
(1449, 14, 'Luján', NULL, NULL),
(1450, 14, 'Luján De Cuyo', NULL, NULL),
(1451, 14, 'Maipú', NULL, NULL),
(1452, 14, 'Malargüe', NULL, NULL),
(1453, 14, 'Rivadavia', NULL, NULL),
(1454, 14, 'San Carlos', NULL, NULL),
(1455, 14, 'San Martín', NULL, NULL),
(1456, 14, 'San Rafael', NULL, NULL),
(1457, 14, 'Sta. Rosa', NULL, NULL),
(1458, 14, 'Tunuyán', NULL, NULL),
(1459, 14, 'Tupungato', NULL, NULL),
(1460, 14, 'Villa Nueva', NULL, NULL),
(1461, 15, 'Alba Posse', NULL, NULL),
(1462, 15, 'Almafuerte', NULL, NULL),
(1463, 15, 'Apóstoles', NULL, NULL),
(1464, 15, 'Aristóbulo Del Valle', NULL, NULL),
(1465, 15, 'Arroyo Del Medio', NULL, NULL),
(1466, 15, 'Azara', NULL, NULL),
(1467, 15, 'Bdo. De Irigoyen', NULL, NULL),
(1468, 15, 'Bonpland', NULL, NULL),
(1469, 15, 'Caá Yari', NULL, NULL),
(1470, 15, 'Campo Grande', NULL, NULL),
(1471, 15, 'Campo Ramón', NULL, NULL),
(1472, 15, 'Campo Viera', NULL, NULL),
(1473, 15, 'Candelaria', NULL, NULL),
(1474, 15, 'Capioví', NULL, NULL),
(1475, 15, 'Caraguatay', NULL, NULL),
(1476, 15, 'Cdte. Guacurarí', NULL, NULL),
(1477, 15, 'Cerro Azul', NULL, NULL),
(1478, 15, 'Cerro Corá', NULL, NULL),
(1479, 15, 'Col. Alberdi', NULL, NULL),
(1480, 15, 'Col. Aurora', NULL, NULL),
(1481, 15, 'Col. Delicia', NULL, NULL),
(1482, 15, 'Col. Polana', NULL, NULL),
(1483, 15, 'Col. Victoria', NULL, NULL),
(1484, 15, 'Col. Wanda', NULL, NULL),
(1485, 15, 'Concepción De La Sierra', NULL, NULL),
(1486, 15, 'Corpus', NULL, NULL),
(1487, 15, 'Dos Arroyos', NULL, NULL),
(1488, 15, 'Dos de Mayo', NULL, NULL),
(1489, 15, 'El Alcázar', NULL, NULL),
(1490, 15, 'El Dorado', NULL, NULL),
(1491, 15, 'El Soberbio', NULL, NULL),
(1492, 15, 'Esperanza', NULL, NULL),
(1493, 15, 'F. Ameghino', NULL, NULL),
(1494, 15, 'Fachinal', NULL, NULL),
(1495, 15, 'Garuhapé', NULL, NULL),
(1496, 15, 'Garupá', NULL, NULL),
(1497, 15, 'Gdor. López', NULL, NULL),
(1498, 15, 'Gdor. Roca', NULL, NULL),
(1499, 15, 'Gral. Alvear', NULL, NULL),
(1500, 15, 'Gral. Urquiza', NULL, NULL),
(1501, 15, 'Guaraní', NULL, NULL),
(1502, 15, 'H. Yrigoyen', NULL, NULL),
(1503, 15, 'Iguazú', NULL, NULL),
(1504, 15, 'Itacaruaré', NULL, NULL),
(1505, 15, 'Jardín América', NULL, NULL),
(1506, 15, 'Leandro N. Alem', NULL, NULL),
(1507, 15, 'Libertad', NULL, NULL),
(1508, 15, 'Loreto', NULL, NULL),
(1509, 15, 'Los Helechos', NULL, NULL),
(1510, 15, 'Mártires', NULL, NULL),
(1511, 15, '15', NULL, NULL),
(1512, 15, 'Mojón Grande', NULL, NULL),
(1513, 15, 'Montecarlo', NULL, NULL),
(1514, 15, 'Nueve de Julio', NULL, NULL),
(1515, 15, 'Oberá', NULL, NULL),
(1516, 15, 'Olegario V. Andrade', NULL, NULL),
(1517, 15, 'Panambí', NULL, NULL),
(1518, 15, 'Posadas', NULL, NULL),
(1519, 15, 'Profundidad', NULL, NULL),
(1520, 15, 'Pto. Iguazú', NULL, NULL),
(1521, 15, 'Pto. Leoni', NULL, NULL),
(1522, 15, 'Pto. Piray', NULL, NULL),
(1523, 15, 'Pto. Rico', NULL, NULL),
(1524, 15, 'Ruiz de Montoya', NULL, NULL),
(1525, 15, 'San Antonio', NULL, NULL),
(1526, 15, 'San Ignacio', NULL, NULL),
(1527, 15, 'San Javier', NULL, NULL),
(1528, 15, 'San José', NULL, NULL),
(1529, 15, 'San Martín', NULL, NULL),
(1530, 15, 'San Pedro', NULL, NULL),
(1531, 15, 'San Vicente', NULL, NULL),
(1532, 15, 'Santiago De Liniers', NULL, NULL),
(1533, 15, 'Santo Pipo', NULL, NULL),
(1534, 15, 'Sta. Ana', NULL, NULL),
(1535, 15, 'Sta. María', NULL, NULL),
(1536, 15, 'Tres Capones', NULL, NULL),
(1537, 15, 'Veinticinco de Mayo', NULL, NULL),
(1538, 15, 'Wanda', NULL, NULL),
(1539, 16, 'Aguada San Roque', NULL, NULL),
(1540, 16, 'Aluminé', NULL, NULL),
(1541, 16, 'Andacollo', NULL, NULL),
(1542, 16, 'Añelo', NULL, NULL),
(1543, 16, 'Bajada del Agrio', NULL, NULL),
(1544, 16, 'Barrancas', NULL, NULL),
(1545, 16, 'Buta Ranquil', NULL, NULL),
(1546, 16, 'Capital', NULL, NULL),
(1547, 16, 'Caviahué', NULL, NULL),
(1548, 16, 'Centenario', NULL, NULL),
(1549, 16, 'Chorriaca', NULL, NULL),
(1550, 16, 'Chos Malal', NULL, NULL),
(1551, 16, 'Cipolletti', NULL, NULL),
(1552, 16, 'Covunco Abajo', NULL, NULL),
(1553, 16, 'Coyuco Cochico', NULL, NULL),
(1554, 16, 'Cutral Có', NULL, NULL),
(1555, 16, 'El Cholar', NULL, NULL),
(1556, 16, 'El Huecú', NULL, NULL),
(1557, 16, 'El Sauce', NULL, NULL),
(1558, 16, 'Guañacos', NULL, NULL),
(1559, 16, 'Huinganco', NULL, NULL),
(1560, 16, 'Las Coloradas', NULL, NULL),
(1561, 16, 'Las Lajas', NULL, NULL),
(1562, 16, 'Las Ovejas', NULL, NULL),
(1563, 16, 'Loncopué', NULL, NULL),
(1564, 16, 'Los Catutos', NULL, NULL),
(1565, 16, 'Los Chihuidos', NULL, NULL),
(1566, 16, 'Los Miches', NULL, NULL),
(1567, 16, 'Manzano Amargo', NULL, NULL),
(1568, 16, '16', NULL, NULL),
(1569, 16, 'Octavio Pico', NULL, NULL),
(1570, 16, 'Paso Aguerre', NULL, NULL),
(1571, 16, 'Picún Leufú', NULL, NULL),
(1572, 16, 'Piedra del Aguila', NULL, NULL),
(1573, 16, 'Pilo Lil', NULL, NULL),
(1574, 16, 'Plaza Huincul', NULL, NULL),
(1575, 16, 'Plottier', NULL, NULL),
(1576, 16, 'Quili Malal', NULL, NULL),
(1577, 16, 'Ramón Castro', NULL, NULL),
(1578, 16, 'Rincón de Los Sauces', NULL, NULL),
(1579, 16, 'San Martín de Los Andes', NULL, NULL),
(1580, 16, 'San Patricio del Chañar', NULL, NULL),
(1581, 16, 'Santo Tomás', NULL, NULL),
(1582, 16, 'Sauzal Bonito', NULL, NULL),
(1583, 16, 'Senillosa', NULL, NULL),
(1584, 16, 'Taquimilán', NULL, NULL),
(1585, 16, 'Tricao Malal', NULL, NULL),
(1586, 16, 'Varvarco', NULL, NULL),
(1587, 16, 'Villa Curí Leuvu', NULL, NULL),
(1588, 16, 'Villa del Nahueve', NULL, NULL),
(1589, 16, 'Villa del Puente Picún Leuvú', NULL, NULL),
(1590, 16, 'Villa El Chocón', NULL, NULL),
(1591, 16, 'Villa La Angostura', NULL, NULL),
(1592, 16, 'Villa Pehuenia', NULL, NULL),
(1593, 16, 'Villa Traful', NULL, NULL),
(1594, 16, 'Vista Alegre', NULL, NULL),
(1595, 16, 'Zapala', NULL, NULL),
(1596, 17, 'Aguada Cecilio', NULL, NULL),
(1597, 17, 'Aguada de Guerra', NULL, NULL),
(1598, 17, 'Allén', NULL, NULL),
(1599, 17, 'Arroyo de La Ventana', NULL, NULL),
(1600, 17, 'Arroyo Los Berros', NULL, NULL),
(1601, 17, 'Bariloche', NULL, NULL),
(1602, 17, 'Calte. Cordero', NULL, NULL),
(1603, 17, 'Campo Grande', NULL, NULL),
(1604, 17, 'Catriel', NULL, NULL),
(1605, 17, 'Cerro Policía', NULL, NULL),
(1606, 17, 'Cervantes', NULL, NULL),
(1607, 17, 'Chelforo', NULL, NULL),
(1608, 17, 'Chimpay', NULL, NULL),
(1609, 17, 'Chinchinales', NULL, NULL),
(1610, 17, 'Chipauquil', NULL, NULL),
(1611, 17, 'Choele Choel', NULL, NULL),
(1612, 17, 'Cinco Saltos', NULL, NULL),
(1613, 17, 'Cipolletti', NULL, NULL),
(1614, 17, 'Clemente Onelli', NULL, NULL),
(1615, 17, 'Colán Conhue', NULL, NULL),
(1616, 17, 'Comallo', NULL, NULL),
(1617, 17, 'Comicó', NULL, NULL),
(1618, 17, 'Cona Niyeu', NULL, NULL),
(1619, 17, 'Coronel Belisle', NULL, NULL),
(1620, 17, 'Cubanea', NULL, NULL),
(1621, 17, 'Darwin', NULL, NULL),
(1622, 17, 'Dina Huapi', NULL, NULL),
(1623, 17, 'El Bolsón', NULL, NULL),
(1624, 17, 'El Caín', NULL, NULL),
(1625, 17, 'El Manso', NULL, NULL),
(1626, 17, 'Gral. Conesa', NULL, NULL),
(1627, 17, 'Gral. Enrique Godoy', NULL, NULL),
(1628, 17, 'Gral. Fernandez Oro', NULL, NULL),
(1629, 17, 'Gral. Roca', NULL, NULL),
(1630, 17, 'Guardia Mitre', NULL, NULL),
(1631, 17, 'Ing. Huergo', NULL, NULL),
(1632, 17, 'Ing. Jacobacci', NULL, NULL),
(1633, 17, 'Laguna Blanca', NULL, NULL),
(1634, 17, 'Lamarque', NULL, NULL),
(1635, 17, 'Las Grutas', NULL, NULL),
(1636, 17, 'Los Menucos', NULL, NULL),
(1637, 17, 'Luis Beltrán', NULL, NULL),
(1638, 17, 'Mainqué', NULL, NULL),
(1639, 17, 'Mamuel Choique', NULL, NULL),
(1640, 17, 'Maquinchao', NULL, NULL),
(1641, 17, 'Mencué', NULL, NULL),
(1642, 17, 'Mtro. Ramos Mexia', NULL, NULL),
(1643, 17, 'Nahuel Niyeu', NULL, NULL),
(1644, 17, 'Naupa Huen', NULL, NULL),
(1645, 17, 'Ñorquinco', NULL, NULL),
(1646, 17, 'Ojos de Agua', NULL, NULL),
(1647, 17, 'Paso de Agua', NULL, NULL),
(1648, 17, 'Paso Flores', NULL, NULL),
(1649, 17, 'Peñas Blancas', NULL, NULL),
(1650, 17, 'Pichi Mahuida', NULL, NULL),
(1651, 17, 'Pilcaniyeu', NULL, NULL),
(1652, 17, 'Pomona', NULL, NULL),
(1653, 17, 'Prahuaniyeu', NULL, NULL),
(1654, 17, 'Rincón Treneta', NULL, NULL),
(1655, 17, 'Río Chico', NULL, NULL),
(1656, 17, 'Río Colorado', NULL, NULL),
(1657, 17, 'Roca', NULL, NULL),
(1658, 17, 'San Antonio Oeste', NULL, NULL),
(1659, 17, 'San Javier', NULL, NULL),
(1660, 17, 'Sierra Colorada', NULL, NULL),
(1661, 17, 'Sierra Grande', NULL, NULL),
(1662, 17, 'Sierra Pailemán', NULL, NULL),
(1663, 17, 'Valcheta', NULL, NULL),
(1664, 17, 'Valle Azul', NULL, NULL),
(1665, 17, 'Viedma', NULL, NULL),
(1666, 17, 'Villa Llanquín', NULL, NULL),
(1667, 17, 'Villa Mascardi', NULL, NULL),
(1668, 17, 'Villa Regina', NULL, NULL),
(1669, 17, 'Yaminué', NULL, NULL),
(1670, 18, 'A. Saravia', NULL, NULL),
(1671, 18, 'Aguaray', NULL, NULL),
(1672, 18, 'Angastaco', NULL, NULL),
(1673, 18, 'Animaná', NULL, NULL),
(1674, 18, 'Cachi', NULL, NULL),
(1675, 18, 'Cafayate', NULL, NULL),
(1676, 18, 'Campo Quijano', NULL, NULL),
(1677, 18, 'Campo Santo', NULL, NULL),
(1678, 18, 'Capital', NULL, NULL),
(1679, 18, 'Cerrillos', NULL, NULL),
(1680, 18, 'Chicoana', NULL, NULL),
(1681, 18, 'Col. Sta. Rosa', NULL, NULL),
(1682, 18, 'Coronel Moldes', NULL, NULL),
(1683, 18, 'El Bordo', NULL, NULL),
(1684, 18, 'El Carril', NULL, NULL),
(1685, 18, 'El Galpón', NULL, NULL),
(1686, 18, 'El Jardín', NULL, NULL),
(1687, 18, 'El Potrero', NULL, NULL),
(1688, 18, 'El Quebrachal', NULL, NULL),
(1689, 18, 'El Tala', NULL, NULL),
(1690, 18, 'Embarcación', NULL, NULL),
(1691, 18, 'Gral. Ballivian', NULL, NULL),
(1692, 18, 'Gral. Güemes', NULL, NULL),
(1693, 18, 'Gral. Mosconi', NULL, NULL),
(1694, 18, 'Gral. Pizarro', NULL, NULL),
(1695, 18, 'Guachipas', NULL, NULL),
(1696, 18, 'Hipólito Yrigoyen', NULL, NULL),
(1697, 18, 'Iruyá', NULL, NULL),
(1698, 18, 'Isla De Cañas', NULL, NULL),
(1699, 18, 'J. V. Gonzalez', NULL, NULL),
(1700, 18, 'La Caldera', NULL, NULL),
(1701, 18, 'La Candelaria', NULL, NULL),
(1702, 18, 'La Merced', NULL, NULL),
(1703, 18, 'La Poma', NULL, NULL),
(1704, 18, 'La Viña', NULL, NULL),
(1705, 18, 'Las Lajitas', NULL, NULL),
(1706, 18, 'Los Toldos', NULL, NULL),
(1707, 18, 'Metán', NULL, NULL),
(1708, 18, 'Molinos', NULL, NULL),
(1709, 18, 'Nazareno', NULL, NULL),
(1710, 18, 'Orán', NULL, NULL),
(1711, 18, 'Payogasta', NULL, NULL),
(1712, 18, 'Pichanal', NULL, NULL),
(1713, 18, 'Prof. S. Mazza', NULL, NULL),
(1714, 18, 'Río Piedras', NULL, NULL),
(1715, 18, 'Rivadavia Banda Norte', NULL, NULL),
(1716, 18, 'Rivadavia Banda Sur', NULL, NULL),
(1717, 18, 'Rosario de La Frontera', NULL, NULL),
(1718, 18, 'Rosario de Lerma', NULL, NULL),
(1719, 18, 'Saclantás', NULL, NULL),
(1720, 18, '18', NULL, NULL),
(1721, 18, 'San Antonio', NULL, NULL),
(1722, 18, 'San Carlos', NULL, NULL),
(1723, 18, 'San José De Metán', NULL, NULL),
(1724, 18, 'San Ramón', NULL, NULL),
(1725, 18, 'Santa Victoria E.', NULL, NULL),
(1726, 18, 'Santa Victoria O.', NULL, NULL),
(1727, 18, 'Tartagal', NULL, NULL),
(1728, 18, 'Tolar Grande', NULL, NULL),
(1729, 18, 'Urundel', NULL, NULL),
(1730, 18, 'Vaqueros', NULL, NULL),
(1731, 18, 'Villa San Lorenzo', NULL, NULL),
(1732, 19, 'Albardón', NULL, NULL),
(1733, 19, 'Angaco', NULL, NULL),
(1734, 19, 'Calingasta', NULL, NULL),
(1735, 19, 'Capital', NULL, NULL),
(1736, 19, 'Caucete', NULL, NULL),
(1737, 19, 'Chimbas', NULL, NULL),
(1738, 19, 'Iglesia', NULL, NULL),
(1739, 19, 'Jachal', NULL, NULL),
(1740, 19, 'Nueve de Julio', NULL, NULL),
(1741, 19, 'Pocito', NULL, NULL),
(1742, 19, 'Rawson', NULL, NULL),
(1743, 19, 'Rivadavia', NULL, NULL),
(1744, 19, '19', NULL, NULL),
(1745, 19, 'San Martín', NULL, NULL),
(1746, 19, 'Santa Lucía', NULL, NULL),
(1747, 19, 'Sarmiento', NULL, NULL),
(1748, 19, 'Ullum', NULL, NULL),
(1749, 19, 'Valle Fértil', NULL, NULL),
(1750, 19, 'Veinticinco de Mayo', NULL, NULL),
(1751, 19, 'Zonda', NULL, NULL),
(1752, 20, 'Alto Pelado', NULL, NULL),
(1753, 20, 'Alto Pencoso', NULL, NULL),
(1754, 20, 'Anchorena', NULL, NULL),
(1755, 20, 'Arizona', NULL, NULL),
(1756, 20, 'Bagual', NULL, NULL),
(1757, 20, 'Balde', NULL, NULL),
(1758, 20, 'Batavia', NULL, NULL),
(1759, 20, 'Beazley', NULL, NULL),
(1760, 20, 'Buena Esperanza', NULL, NULL),
(1761, 20, 'Candelaria', NULL, NULL),
(1762, 20, 'Capital', NULL, NULL),
(1763, 20, 'Carolina', NULL, NULL),
(1764, 20, 'Carpintería', NULL, NULL),
(1765, 20, 'Concarán', NULL, NULL),
(1766, 20, 'Cortaderas', NULL, NULL),
(1767, 20, 'El Morro', NULL, NULL),
(1768, 20, 'El Trapiche', NULL, NULL),
(1769, 20, 'El Volcán', NULL, NULL),
(1770, 20, 'Fortín El Patria', NULL, NULL),
(1771, 20, 'Fortuna', NULL, NULL),
(1772, 20, 'Fraga', NULL, NULL),
(1773, 20, 'Juan Jorba', NULL, NULL),
(1774, 20, 'Juan Llerena', NULL, NULL),
(1775, 20, 'Juana Koslay', NULL, NULL),
(1776, 20, 'Justo Daract', NULL, NULL),
(1777, 20, 'La Calera', NULL, NULL),
(1778, 20, 'La Florida', NULL, NULL),
(1779, 20, 'La Punilla', NULL, NULL),
(1780, 20, 'La Toma', NULL, NULL),
(1781, 20, 'Lafinur', NULL, NULL),
(1782, 20, 'Las Aguadas', NULL, NULL),
(1783, 20, 'Las Chacras', NULL, NULL),
(1784, 20, 'Las Lagunas', NULL, NULL),
(1785, 20, 'Las Vertientes', NULL, NULL),
(1786, 20, 'Lavaisse', NULL, NULL),
(1787, 20, 'Leandro N. Alem', NULL, NULL),
(1788, 20, 'Los Molles', NULL, NULL),
(1789, 20, 'Luján', NULL, NULL),
(1790, 20, 'Mercedes', NULL, NULL),
(1791, 20, 'Merlo', NULL, NULL),
(1792, 20, 'Naschel', NULL, NULL),
(1793, 20, 'Navia', NULL, NULL),
(1794, 20, 'Nogolí', NULL, NULL),
(1795, 20, 'Nueva Galia', NULL, NULL),
(1796, 20, 'Papagayos', NULL, NULL),
(1797, 20, 'Paso Grande', NULL, NULL),
(1798, 20, 'Potrero de Los Funes', NULL, NULL),
(1799, 20, 'Quines', NULL, NULL),
(1800, 20, 'Renca', NULL, NULL),
(1801, 20, 'Saladillo', NULL, NULL),
(1802, 20, 'San Francisco', NULL, NULL),
(1803, 20, 'San Gerónimo', NULL, NULL),
(1804, 20, 'San Martín', NULL, NULL),
(1805, 20, 'San Pablo', NULL, NULL),
(1806, 20, 'Santa Rosa de Conlara', NULL, NULL),
(1807, 20, 'Talita', NULL, NULL),
(1808, 20, 'Tilisarao', NULL, NULL),
(1809, 20, 'Unión', NULL, NULL),
(1810, 20, 'Villa de La Quebrada', NULL, NULL),
(1811, 20, 'Villa de Praga', NULL, NULL),
(1812, 20, 'Villa del Carmen', NULL, NULL),
(1813, 20, 'Villa Gral. Roca', NULL, NULL),
(1814, 20, 'Villa Larca', NULL, NULL),
(1815, 20, 'Villa Mercedes', NULL, NULL),
(1816, 20, 'Zanjitas', NULL, NULL),
(1817, 21, 'Calafate', NULL, NULL),
(1818, 21, 'Caleta Olivia', NULL, NULL),
(1819, 21, 'Cañadón Seco', NULL, NULL),
(1820, 21, 'Comandante Piedrabuena', NULL, NULL),
(1821, 21, 'El Calafate', NULL, NULL),
(1822, 21, 'El Chaltén', NULL, NULL),
(1823, 21, 'Gdor. Gregores', NULL, NULL),
(1824, 21, 'Hipólito Yrigoyen', NULL, NULL),
(1825, 21, 'Jaramillo', NULL, NULL),
(1826, 21, 'Koluel Kaike', NULL, NULL),
(1827, 21, 'Las Heras', NULL, NULL),
(1828, 21, 'Los Antiguos', NULL, NULL),
(1829, 21, 'Perito Moreno', NULL, NULL),
(1830, 21, 'Pico Truncado', NULL, NULL),
(1831, 21, 'Pto. Deseado', NULL, NULL),
(1832, 21, 'Pto. San Julián', NULL, NULL),
(1833, 21, 'Pto. 21', NULL, NULL),
(1834, 21, 'Río Cuarto', NULL, NULL),
(1835, 21, 'Río Gallegos', NULL, NULL),
(1836, 21, 'Río Turbio', NULL, NULL),
(1837, 21, 'Tres Lagos', NULL, NULL),
(1838, 21, 'Veintiocho De Noviembre', NULL, NULL),
(1839, 22, 'Aarón Castellanos', NULL, NULL),
(1840, 22, 'Acebal', NULL, NULL),
(1841, 22, 'Aguará Grande', NULL, NULL),
(1842, 22, 'Albarellos', NULL, NULL),
(1843, 22, 'Alcorta', NULL, NULL),
(1844, 22, 'Aldao', NULL, NULL),
(1845, 22, 'Alejandra', NULL, NULL),
(1846, 22, 'Álvarez', NULL, NULL),
(1847, 22, 'Ambrosetti', NULL, NULL),
(1848, 22, 'Amenábar', NULL, NULL),
(1849, 22, 'Angélica', NULL, NULL),
(1850, 22, 'Angeloni', NULL, NULL),
(1851, 22, 'Arequito', NULL, NULL),
(1852, 22, 'Arminda', NULL, NULL),
(1853, 22, 'Armstrong', NULL, NULL),
(1854, 22, 'Arocena', NULL, NULL),
(1855, 22, 'Arroyo Aguiar', NULL, NULL),
(1856, 22, 'Arroyo Ceibal', NULL, NULL),
(1857, 22, 'Arroyo Leyes', NULL, NULL),
(1858, 22, 'Arroyo Seco', NULL, NULL),
(1859, 22, 'Arrufó', NULL, NULL),
(1860, 22, 'Arteaga', NULL, NULL),
(1861, 22, 'Ataliva', NULL, NULL),
(1862, 22, 'Aurelia', NULL, NULL),
(1863, 22, 'Avellaneda', NULL, NULL),
(1864, 22, 'Barrancas', NULL, NULL),
(1865, 22, 'Bauer Y Sigel', NULL, NULL),
(1866, 22, 'Bella Italia', NULL, NULL),
(1867, 22, 'Berabevú', NULL, NULL),
(1868, 22, 'Berna', NULL, NULL),
(1869, 22, 'Bernardo de Irigoyen', NULL, NULL),
(1870, 22, 'Bigand', NULL, NULL),
(1871, 22, 'Bombal', NULL, NULL),
(1872, 22, 'Bouquet', NULL, NULL),
(1873, 22, 'Bustinza', NULL, NULL),
(1874, 22, 'Cabal', NULL, NULL),
(1875, 22, 'Cacique Ariacaiquin', NULL, NULL),
(1876, 22, 'Cafferata', NULL, NULL),
(1877, 22, 'Calchaquí', NULL, NULL),
(1878, 22, 'Campo Andino', NULL, NULL),
(1879, 22, 'Campo Piaggio', NULL, NULL),
(1880, 22, 'Cañada de Gómez', NULL, NULL),
(1881, 22, 'Cañada del Ucle', NULL, NULL),
(1882, 22, 'Cañada Rica', NULL, NULL),
(1883, 22, 'Cañada Rosquín', NULL, NULL),
(1884, 22, 'Candioti', NULL, NULL),
(1885, 22, 'Capital', NULL, NULL),
(1886, 22, 'Capitán Bermúdez', NULL, NULL),
(1887, 22, 'Capivara', NULL, NULL),
(1888, 22, 'Carcarañá', NULL, NULL),
(1889, 22, 'Carlos Pellegrini', NULL, NULL),
(1890, 22, 'Carmen', NULL, NULL),
(1891, 22, 'Carmen Del Sauce', NULL, NULL),
(1892, 22, 'Carreras', NULL, NULL),
(1893, 22, 'Carrizales', NULL, NULL),
(1894, 22, 'Casalegno', NULL, NULL),
(1895, 22, 'Casas', NULL, NULL),
(1896, 22, 'Casilda', NULL, NULL),
(1897, 22, 'Castelar', NULL, NULL),
(1898, 22, 'Castellanos', NULL, NULL),
(1899, 22, 'Cayastá', NULL, NULL),
(1900, 22, 'Cayastacito', NULL, NULL),
(1901, 22, 'Centeno', NULL, NULL),
(1902, 22, 'Cepeda', NULL, NULL),
(1903, 22, 'Ceres', NULL, NULL),
(1904, 22, 'Chabás', NULL, NULL),
(1905, 22, 'Chañar Ladeado', NULL, NULL),
(1906, 22, 'Chapuy', NULL, NULL),
(1907, 22, 'Chovet', NULL, NULL),
(1908, 22, 'Christophersen', NULL, NULL),
(1909, 22, 'Classon', NULL, NULL),
(1910, 22, 'Cnel. Arnold', NULL, NULL),
(1911, 22, 'Cnel. Bogado', NULL, NULL),
(1912, 22, 'Cnel. Dominguez', NULL, NULL),
(1913, 22, 'Cnel. Fraga', NULL, NULL),
(1914, 22, 'Col. Aldao', NULL, NULL),
(1915, 22, 'Col. Ana', NULL, NULL),
(1916, 22, 'Col. Belgrano', NULL, NULL),
(1917, 22, 'Col. Bicha', NULL, NULL),
(1918, 22, 'Col. Bigand', NULL, NULL),
(1919, 22, 'Col. Bossi', NULL, NULL),
(1920, 22, 'Col. Cavour', NULL, NULL),
(1921, 22, 'Col. Cello', NULL, NULL),
(1922, 22, 'Col. Dolores', NULL, NULL),
(1923, 22, 'Col. Dos Rosas', NULL, NULL),
(1924, 22, 'Col. Durán', NULL, NULL),
(1925, 22, 'Col. Iturraspe', NULL, NULL),
(1926, 22, 'Col. Margarita', NULL, NULL),
(1927, 22, 'Col. Mascias', NULL, NULL),
(1928, 22, 'Col. Raquel', NULL, NULL),
(1929, 22, 'Col. Rosa', NULL, NULL),
(1930, 22, 'Col. San José', NULL, NULL),
(1931, 22, 'Constanza', NULL, NULL),
(1932, 22, 'Coronda', NULL, NULL),
(1933, 22, 'Correa', NULL, NULL),
(1934, 22, 'Crispi', NULL, NULL),
(1935, 22, 'Cululú', NULL, NULL),
(1936, 22, 'Curupayti', NULL, NULL),
(1937, 22, 'Desvio Arijón', NULL, NULL),
(1938, 22, 'Diaz', NULL, NULL),
(1939, 22, 'Diego de Alvear', NULL, NULL),
(1940, 22, 'Egusquiza', NULL, NULL),
(1941, 22, 'El Arazá', NULL, NULL),
(1942, 22, 'El Rabón', NULL, NULL),
(1943, 22, 'El Sombrerito', NULL, NULL),
(1944, 22, 'El Trébol', NULL, NULL),
(1945, 22, 'Elisa', NULL, NULL),
(1946, 22, 'Elortondo', NULL, NULL),
(1947, 22, 'Emilia', NULL, NULL),
(1948, 22, 'Empalme San Carlos', NULL, NULL),
(1949, 22, 'Empalme Villa Constitucion', NULL, NULL),
(1950, 22, 'Esmeralda', NULL, NULL),
(1951, 22, 'Esperanza', NULL, NULL),
(1952, 22, 'Estación Alvear', NULL, NULL),
(1953, 22, 'Estacion Clucellas', NULL, NULL),
(1954, 22, 'Esteban Rams', NULL, NULL),
(1955, 22, 'Esther', NULL, NULL),
(1956, 22, 'Esustolia', NULL, NULL),
(1957, 22, 'Eusebia', NULL, NULL),
(1958, 22, 'Felicia', NULL, NULL),
(1959, 22, 'Fidela', NULL, NULL),
(1960, 22, 'Fighiera', NULL, NULL),
(1961, 22, 'Firmat', NULL, NULL),
(1962, 22, 'Florencia', NULL, NULL),
(1963, 22, 'Fortín Olmos', NULL, NULL),
(1964, 22, 'Franck', NULL, NULL),
(1965, 22, 'Fray Luis Beltrán', NULL, NULL),
(1966, 22, 'Frontera', NULL, NULL),
(1967, 22, 'Fuentes', NULL, NULL),
(1968, 22, 'Funes', NULL, NULL),
(1969, 22, 'Gaboto', NULL, NULL),
(1970, 22, 'Galisteo', NULL, NULL),
(1971, 22, 'Gálvez', NULL, NULL),
(1972, 22, 'Garabalto', NULL, NULL),
(1973, 22, 'Garibaldi', NULL, NULL),
(1974, 22, 'Gato Colorado', NULL, NULL),
(1975, 22, 'Gdor. Crespo', NULL, NULL),
(1976, 22, 'Gessler', NULL, NULL),
(1977, 22, 'Godoy', NULL, NULL),
(1978, 22, 'Golondrina', NULL, NULL),
(1979, 22, 'Gral. Gelly', NULL, NULL),
(1980, 22, 'Gral. Lagos', NULL, NULL),
(1981, 22, 'Granadero Baigorria', NULL, NULL),
(1982, 22, 'Gregoria Perez De Denis', NULL, NULL),
(1983, 22, 'Grutly', NULL, NULL),
(1984, 22, 'Guadalupe N.', NULL, NULL),
(1985, 22, 'Gödeken', NULL, NULL),
(1986, 22, 'Helvecia', NULL, NULL),
(1987, 22, 'Hersilia', NULL, NULL),
(1988, 22, 'Hipatía', NULL, NULL),
(1989, 22, 'Huanqueros', NULL, NULL),
(1990, 22, 'Hugentobler', NULL, NULL),
(1991, 22, 'Hughes', NULL, NULL),
(1992, 22, 'Humberto 1º', NULL, NULL),
(1993, 22, 'Humboldt', NULL, NULL),
(1994, 22, 'Ibarlucea', NULL, NULL),
(1995, 22, 'Ing. Chanourdie', NULL, NULL),
(1996, 22, 'Intiyaco', NULL, NULL),
(1997, 22, 'Ituzaingó', NULL, NULL),
(1998, 22, 'Jacinto L. Aráuz', NULL, NULL),
(1999, 22, 'Josefina', NULL, NULL),
(2000, 22, 'Juan B. Molina', NULL, NULL),
(2001, 22, 'Juan de Garay', NULL, NULL),
(2002, 22, 'Juncal', NULL, NULL),
(2003, 22, 'La Brava', NULL, NULL),
(2004, 22, 'La Cabral', NULL, NULL),
(2005, 22, 'La Camila', NULL, NULL),
(2006, 22, 'La Chispa', NULL, NULL),
(2007, 22, 'La Clara', NULL, NULL),
(2008, 22, 'La Criolla', NULL, NULL),
(2009, 22, 'La Gallareta', NULL, NULL),
(2010, 22, 'La Lucila', NULL, NULL),
(2011, 22, 'La Pelada', NULL, NULL),
(2012, 22, 'La Penca', NULL, NULL),
(2013, 22, 'La Rubia', NULL, NULL),
(2014, 22, 'La Sarita', NULL, NULL),
(2015, 22, 'La Vanguardia', NULL, NULL),
(2016, 22, 'Labordeboy', NULL, NULL),
(2017, 22, 'Laguna Paiva', NULL, NULL),
(2018, 22, 'Landeta', NULL, NULL),
(2019, 22, 'Lanteri', NULL, NULL),
(2020, 22, 'Larrechea', NULL, NULL),
(2021, 22, 'Las Avispas', NULL, NULL),
(2022, 22, 'Las Bandurrias', NULL, NULL),
(2023, 22, 'Las Garzas', NULL, NULL),
(2024, 22, 'Las Palmeras', NULL, NULL),
(2025, 22, 'Las Parejas', NULL, NULL),
(2026, 22, 'Las Petacas', NULL, NULL),
(2027, 22, 'Las Rosas', NULL, NULL),
(2028, 22, 'Las Toscas', NULL, NULL),
(2029, 22, 'Las Tunas', NULL, NULL),
(2030, 22, 'Lazzarino', NULL, NULL),
(2031, 22, 'Lehmann', NULL, NULL),
(2032, 22, 'Llambi Campbell', NULL, NULL),
(2033, 22, 'Logroño', NULL, NULL),
(2034, 22, 'Loma Alta', NULL, NULL),
(2035, 22, 'López', NULL, NULL),
(2036, 22, 'Los Amores', NULL, NULL),
(2037, 22, 'Los Cardos', NULL, NULL),
(2038, 22, 'Los Laureles', NULL, NULL),
(2039, 22, 'Los Molinos', NULL, NULL),
(2040, 22, 'Los Quirquinchos', NULL, NULL),
(2041, 22, 'Lucio V. Lopez', NULL, NULL),
(2042, 22, 'Luis Palacios', NULL, NULL),
(2043, 22, 'Ma. Juana', NULL, NULL),
(2044, 22, 'Ma. Luisa', NULL, NULL),
(2045, 22, 'Ma. Susana', NULL, NULL),
(2046, 22, 'Ma. Teresa', NULL, NULL),
(2047, 22, 'Maciel', NULL, NULL),
(2048, 22, 'Maggiolo', NULL, NULL),
(2049, 22, 'Malabrigo', NULL, NULL),
(2050, 22, 'Marcelino Escalada', NULL, NULL),
(2051, 22, 'Margarita', NULL, NULL),
(2052, 22, 'Matilde', NULL, NULL),
(2053, 22, 'Mauá', NULL, NULL),
(2054, 22, 'Máximo Paz', NULL, NULL),
(2055, 22, 'Melincué', NULL, NULL),
(2056, 22, 'Miguel Torres', NULL, NULL),
(2057, 22, 'Moisés Ville', NULL, NULL),
(2058, 22, 'Monigotes', NULL, NULL),
(2059, 22, 'Monje', NULL, NULL),
(2060, 22, 'Monte Obscuridad', NULL, NULL),
(2061, 22, 'Monte Vera', NULL, NULL),
(2062, 22, 'Montefiore', NULL, NULL),
(2063, 22, 'Montes de Oca', NULL, NULL),
(2064, 22, 'Murphy', NULL, NULL),
(2065, 22, 'Ñanducita', NULL, NULL),
(2066, 22, 'Naré', NULL, NULL),
(2067, 22, 'Nelson', NULL, NULL),
(2068, 22, 'Nicanor E. Molinas', NULL, NULL),
(2069, 22, 'Nuevo Torino', NULL, NULL),
(2070, 22, 'Oliveros', NULL, NULL),
(2071, 22, 'Palacios', NULL, NULL),
(2072, 22, 'Pavón', NULL, NULL),
(2073, 22, 'Pavón Arriba', NULL, NULL),
(2074, 22, 'Pedro Gómez Cello', NULL, NULL),
(2075, 22, 'Pérez', NULL, NULL),
(2076, 22, 'Peyrano', NULL, NULL),
(2077, 22, 'Piamonte', NULL, NULL),
(2078, 22, 'Pilar', NULL, NULL),
(2079, 22, 'Piñero', NULL, NULL),
(2080, 22, 'Plaza Clucellas', NULL, NULL),
(2081, 22, 'Portugalete', NULL, NULL),
(2082, 22, 'Pozo Borrado', NULL, NULL),
(2083, 22, 'Progreso', NULL, NULL),
(2084, 22, 'Providencia', NULL, NULL),
(2085, 22, 'Pte. Roca', NULL, NULL),
(2086, 22, 'Pueblo Andino', NULL, NULL),
(2087, 22, 'Pueblo Esther', NULL, NULL),
(2088, 22, 'Pueblo Gral. San Martín', NULL, NULL),
(2089, 22, 'Pueblo Irigoyen', NULL, NULL),
(2090, 22, 'Pueblo Marini', NULL, NULL),
(2091, 22, 'Pueblo Muñoz', NULL, NULL),
(2092, 22, 'Pueblo Uranga', NULL, NULL),
(2093, 22, 'Pujato', NULL, NULL),
(2094, 22, 'Pujato N.', NULL, NULL),
(2095, 22, 'Rafaela', NULL, NULL),
(2096, 22, 'Ramayón', NULL, NULL),
(2097, 22, 'Ramona', NULL, NULL),
(2098, 22, 'Reconquista', NULL, NULL),
(2099, 22, 'Recreo', NULL, NULL),
(2100, 22, 'Ricardone', NULL, NULL),
(2101, 22, 'Rivadavia', NULL, NULL),
(2102, 22, 'Roldán', NULL, NULL),
(2103, 22, 'Romang', NULL, NULL),
(2104, 22, 'Rosario', NULL, NULL),
(2105, 22, 'Rueda', NULL, NULL),
(2106, 22, 'Rufino', NULL, NULL),
(2107, 22, 'Sa Pereira', NULL, NULL),
(2108, 22, 'Saguier', NULL, NULL),
(2109, 22, 'Saladero M. Cabal', NULL, NULL),
(2110, 22, 'Salto Grande', NULL, NULL),
(2111, 22, 'San Agustín', NULL, NULL),
(2112, 22, 'San Antonio de Obligado', NULL, NULL),
(2113, 22, 'San Bernardo (N.J.)', NULL, NULL),
(2114, 22, 'San Bernardo (S.J.)', NULL, NULL),
(2115, 22, 'San Carlos Centro', NULL, NULL),
(2116, 22, 'San Carlos N.', NULL, NULL),
(2117, 22, 'San Carlos S.', NULL, NULL),
(2118, 22, 'San Cristóbal', NULL, NULL),
(2119, 22, 'San Eduardo', NULL, NULL),
(2120, 22, 'San Eugenio', NULL, NULL),
(2121, 22, 'San Fabián', NULL, NULL),
(2122, 22, 'San Fco. de Santa Fé', NULL, NULL),
(2123, 22, 'San Genaro', NULL, NULL),
(2124, 22, 'San Genaro N.', NULL, NULL),
(2125, 22, 'San Gregorio', NULL, NULL),
(2126, 22, 'San Guillermo', NULL, NULL),
(2127, 22, 'San Javier', NULL, NULL),
(2128, 22, 'San Jerónimo del Sauce', NULL, NULL),
(2129, 22, 'San Jerónimo N.', NULL, NULL),
(2130, 22, 'San Jerónimo S.', NULL, NULL),
(2131, 22, 'San Jorge', NULL, NULL),
(2132, 22, 'San José de La Esquina', NULL, NULL),
(2133, 22, 'San José del Rincón', NULL, NULL),
(2134, 22, 'San Justo', NULL, NULL),
(2135, 22, 'San Lorenzo', NULL, NULL),
(2136, 22, 'San Mariano', NULL, NULL),
(2137, 22, 'San Martín de Las Escobas', NULL, NULL),
(2138, 22, 'San Martín N.', NULL, NULL),
(2139, 22, 'San Vicente', NULL, NULL),
(2140, 22, 'Sancti Spititu', NULL, NULL),
(2141, 22, 'Sanford', NULL, NULL),
(2142, 22, 'Santo Domingo', NULL, NULL),
(2143, 22, 'Santo Tomé', NULL, NULL),
(2144, 22, 'Santurce', NULL, NULL),
(2145, 22, 'Sargento Cabral', NULL, NULL),
(2146, 22, 'Sarmiento', NULL, NULL),
(2147, 22, 'Sastre', NULL, NULL),
(2148, 22, 'Sauce Viejo', NULL, NULL),
(2149, 22, 'Serodino', NULL, NULL),
(2150, 22, 'Silva', NULL, NULL),
(2151, 22, 'Soldini', NULL, NULL),
(2152, 22, 'Soledad', NULL, NULL),
(2153, 22, 'Soutomayor', NULL, NULL),
(2154, 22, 'Sta. Clara de Buena Vista', NULL, NULL),
(2155, 22, 'Sta. Clara de Saguier', NULL, NULL),
(2156, 22, 'Sta. Isabel', NULL, NULL),
(2157, 22, 'Sta. Margarita', NULL, NULL),
(2158, 22, 'Sta. Maria Centro', NULL, NULL),
(2159, 22, 'Sta. María N.', NULL, NULL),
(2160, 22, 'Sta. Rosa', NULL, NULL),
(2161, 22, 'Sta. Teresa', NULL, NULL),
(2162, 22, 'Suardi', NULL, NULL),
(2163, 22, 'Sunchales', NULL, NULL),
(2164, 22, 'Susana', NULL, NULL),
(2165, 22, 'Tacuarendí', NULL, NULL),
(2166, 22, 'Tacural', NULL, NULL),
(2167, 22, 'Tartagal', NULL, NULL),
(2168, 22, 'Teodelina', NULL, NULL),
(2169, 22, 'Theobald', NULL, NULL),
(2170, 22, 'Timbúes', NULL, NULL),
(2171, 22, 'Toba', NULL, NULL),
(2172, 22, 'Tortugas', NULL, NULL),
(2173, 22, 'Tostado', NULL, NULL),
(2174, 22, 'Totoras', NULL, NULL),
(2175, 22, 'Traill', NULL, NULL),
(2176, 22, 'Venado Tuerto', NULL, NULL),
(2177, 22, 'Vera', NULL, NULL),
(2178, 22, 'Vera y Pintado', NULL, NULL),
(2179, 22, 'Videla', NULL, NULL),
(2180, 22, 'Vila', NULL, NULL),
(2181, 22, 'Villa Amelia', NULL, NULL),
(2182, 22, 'Villa Ana', NULL, NULL),
(2183, 22, 'Villa Cañas', NULL, NULL),
(2184, 22, 'Villa Constitución', NULL, NULL),
(2185, 22, 'Villa Eloísa', NULL, NULL),
(2186, 22, 'Villa Gdor. Gálvez', NULL, NULL),
(2187, 22, 'Villa Guillermina', NULL, NULL),
(2188, 22, 'Villa Minetti', NULL, NULL),
(2189, 22, 'Villa Mugueta', NULL, NULL),
(2190, 22, 'Villa Ocampo', NULL, NULL),
(2191, 22, 'Villa San José', NULL, NULL),
(2192, 22, 'Villa Saralegui', NULL, NULL),
(2193, 22, 'Villa Trinidad', NULL, NULL),
(2194, 22, 'Villada', NULL, NULL),
(2195, 22, 'Virginia', NULL, NULL),
(2196, 22, 'Wheelwright', NULL, NULL),
(2197, 22, 'Zavalla', NULL, NULL),
(2198, 22, 'Zenón Pereira', NULL, NULL),
(2199, 23, 'Añatuya', NULL, NULL),
(2200, 23, 'Árraga', NULL, NULL),
(2201, 23, 'Bandera', NULL, NULL),
(2202, 23, 'Bandera Bajada', NULL, NULL),
(2203, 23, 'Beltrán', NULL, NULL),
(2204, 23, 'Brea Pozo', NULL, NULL),
(2205, 23, 'Campo Gallo', NULL, NULL),
(2206, 23, 'Capital', NULL, NULL),
(2207, 23, 'Chilca Juliana', NULL, NULL),
(2208, 23, 'Choya', NULL, NULL),
(2209, 23, 'Clodomira', NULL, NULL),
(2210, 23, 'Col. Alpina', NULL, NULL),
(2211, 23, 'Col. Dora', NULL, NULL),
(2212, 23, 'Col. El Simbolar Robles', NULL, NULL),
(2213, 23, 'El Bobadal', NULL, NULL),
(2214, 23, 'El Charco', NULL, NULL),
(2215, 23, 'El Mojón', NULL, NULL),
(2216, 23, 'Estación Atamisqui', NULL, NULL),
(2217, 23, 'Estación Simbolar', NULL, NULL),
(2218, 23, 'Fernández', NULL, NULL),
(2219, 23, 'Fortín Inca', NULL, NULL),
(2220, 23, 'Frías', NULL, NULL),
(2221, 23, 'Garza', NULL, NULL),
(2222, 23, 'Gramilla', NULL, NULL),
(2223, 23, 'Guardia Escolta', NULL, NULL),
(2224, 23, 'Herrera', NULL, NULL),
(2225, 23, 'Icaño', NULL, NULL),
(2226, 23, 'Ing. Forres', NULL, NULL),
(2227, 23, 'La Banda', NULL, NULL),
(2228, 23, 'La Cañada', NULL, NULL),
(2229, 23, 'Laprida', NULL, NULL),
(2230, 23, 'Lavalle', NULL, NULL),
(2231, 23, 'Loreto', NULL, NULL),
(2232, 23, 'Los Juríes', NULL, NULL),
(2233, 23, 'Los Núñez', NULL, NULL),
(2234, 23, 'Los Pirpintos', NULL, NULL),
(2235, 23, 'Los Quiroga', NULL, NULL),
(2236, 23, 'Los Telares', NULL, NULL),
(2237, 23, 'Lugones', NULL, NULL),
(2238, 23, 'Malbrán', NULL, NULL),
(2239, 23, 'Matara', NULL, NULL),
(2240, 23, 'Medellín', NULL, NULL),
(2241, 23, 'Monte Quemado', NULL, NULL),
(2242, 23, 'Nueva Esperanza', NULL, NULL),
(2243, 23, 'Nueva Francia', NULL, NULL),
(2244, 23, 'Palo Negro', NULL, NULL),
(2245, 23, 'Pampa de Los Guanacos', NULL, NULL),
(2246, 23, 'Pinto', NULL, NULL),
(2247, 23, 'Pozo Hondo', NULL, NULL),
(2248, 23, 'Quimilí', NULL, NULL),
(2249, 23, 'Real Sayana', NULL, NULL),
(2250, 23, 'Sachayoj', NULL, NULL),
(2251, 23, 'San Pedro de Guasayán', NULL, NULL),
(2252, 23, 'Selva', NULL, NULL),
(2253, 23, 'Sol de Julio', NULL, NULL),
(2254, 23, 'Sumampa', NULL, NULL),
(2255, 23, 'Suncho Corral', NULL, NULL),
(2256, 23, 'Taboada', NULL, NULL),
(2257, 23, 'Tapso', NULL, NULL),
(2258, 23, 'Termas de Rio Hondo', NULL, NULL),
(2259, 23, 'Tintina', NULL, NULL),
(2260, 23, 'Tomas Young', NULL, NULL),
(2261, 23, 'Vilelas', NULL, NULL),
(2262, 23, 'Villa Atamisqui', NULL, NULL),
(2263, 23, 'Villa La Punta', NULL, NULL),
(2264, 23, 'Villa Ojo de Agua', NULL, NULL),
(2265, 23, 'Villa Río Hondo', NULL, NULL),
(2266, 23, 'Villa Salavina', NULL, NULL),
(2267, 23, 'Villa Unión', NULL, NULL),
(2268, 23, 'Vilmer', NULL, NULL),
(2269, 23, 'Weisburd', NULL, NULL),
(2270, 24, 'Río Grande', NULL, NULL),
(2271, 24, 'Tolhuin', NULL, NULL),
(2272, 24, 'Ushuaia', NULL, NULL),
(2273, 25, 'Acheral', NULL, NULL),
(2274, 25, 'Agua Dulce', NULL, NULL),
(2275, 25, 'Aguilares', NULL, NULL),
(2276, 25, 'Alderetes', NULL, NULL),
(2277, 25, 'Alpachiri', NULL, NULL),
(2278, 25, 'Alto Verde', NULL, NULL),
(2279, 25, 'Amaicha del Valle', NULL, NULL),
(2280, 25, 'Amberes', NULL, NULL),
(2281, 25, 'Ancajuli', NULL, NULL),
(2282, 25, 'Arcadia', NULL, NULL),
(2283, 25, 'Atahona', NULL, NULL),
(2284, 25, 'Banda del Río Sali', NULL, NULL),
(2285, 25, 'Bella Vista', NULL, NULL),
(2286, 25, 'Buena Vista', NULL, NULL),
(2287, 25, 'Burruyacú', NULL, NULL),
(2288, 25, 'Capitán Cáceres', NULL, NULL),
(2289, 25, 'Cevil Redondo', NULL, NULL),
(2290, 25, 'Choromoro', NULL, NULL),
(2291, 25, 'Ciudacita', NULL, NULL),
(2292, 25, 'Colalao del Valle', NULL, NULL),
(2293, 25, 'Colombres', NULL, NULL),
(2294, 25, 'Concepción', NULL, NULL),
(2295, 25, 'Delfín Gallo', NULL, NULL),
(2296, 25, 'El Bracho', NULL, NULL),
(2297, 25, 'El Cadillal', NULL, NULL),
(2298, 25, 'El Cercado', NULL, NULL),
(2299, 25, 'El Chañar', NULL, NULL),
(2300, 25, 'El Manantial', NULL, NULL),
(2301, 25, 'El Mojón', NULL, NULL),
(2302, 25, 'El Mollar', NULL, NULL),
(2303, 25, 'El Naranjito', NULL, NULL),
(2304, 25, 'El Naranjo', NULL, NULL),
(2305, 25, 'El Polear', NULL, NULL),
(2306, 25, 'El Puestito', NULL, NULL),
(2307, 25, 'El Sacrificio', NULL, NULL),
(2308, 25, 'El Timbó', NULL, NULL),
(2309, 25, 'Escaba', NULL, NULL),
(2310, 25, 'Esquina', NULL, NULL),
(2311, 25, 'Estación Aráoz', NULL, NULL),
(2312, 25, 'Famaillá', NULL, NULL),
(2313, 25, 'Gastone', NULL, NULL),
(2314, 25, 'Gdor. Garmendia', NULL, NULL),
(2315, 25, 'Gdor. Piedrabuena', NULL, NULL),
(2316, 25, 'Graneros', NULL, NULL),
(2317, 25, 'Huasa Pampa', NULL, NULL),
(2318, 25, 'J. B. Alberdi', NULL, NULL),
(2319, 25, 'La Cocha', NULL, NULL),
(2320, 25, 'La Esperanza', NULL, NULL),
(2321, 25, 'La Florida', NULL, NULL),
(2322, 25, 'La Ramada', NULL, NULL),
(2323, 25, 'La Trinidad', NULL, NULL),
(2324, 25, 'Lamadrid', NULL, NULL),
(2325, 25, 'Las Cejas', NULL, NULL),
(2326, 25, 'Las Talas', NULL, NULL),
(2327, 25, 'Las Talitas', NULL, NULL),
(2328, 25, 'Los Bulacio', NULL, NULL),
(2329, 25, 'Los Gómez', NULL, NULL),
(2330, 25, 'Los Nogales', NULL, NULL),
(2331, 25, 'Los Pereyra', NULL, NULL),
(2332, 25, 'Los Pérez', NULL, NULL),
(2333, 25, 'Los Puestos', NULL, NULL),
(2334, 25, 'Los Ralos', NULL, NULL),
(2335, 25, 'Los Sarmientos', NULL, NULL),
(2336, 25, 'Los Sosa', NULL, NULL),
(2337, 25, 'Lules', NULL, NULL),
(2338, 25, 'M. García Fernández', NULL, NULL),
(2339, 25, 'Manuela Pedraza', NULL, NULL),
(2340, 25, 'Medinas', NULL, NULL),
(2341, 25, 'Monte Bello', NULL, NULL),
(2342, 25, 'Monteagudo', NULL, NULL),
(2343, 25, 'Monteros', NULL, NULL),
(2344, 25, 'Padre Monti', NULL, NULL),
(2345, 25, 'Pampa Mayo', NULL, NULL),
(2346, 25, 'Quilmes', NULL, NULL),
(2347, 25, 'Raco', NULL, NULL),
(2348, 25, 'Ranchillos', NULL, NULL),
(2349, 25, 'Río Chico', NULL, NULL),
(2350, 25, 'Río Colorado', NULL, NULL),
(2351, 25, 'Río Seco', NULL, NULL),
(2352, 25, 'Rumi Punco', NULL, NULL),
(2353, 25, 'San Andrés', NULL, NULL),
(2354, 25, 'San Felipe', NULL, NULL),
(2355, 25, 'San Ignacio', NULL, NULL),
(2356, 25, 'San Javier', NULL, NULL),
(2357, 25, 'San José', NULL, NULL),
(2358, 25, 'San Miguel de 25', NULL, NULL),
(2359, 25, 'San Pedro', NULL, NULL),
(2360, 25, 'San Pedro de Colalao', NULL, NULL),
(2361, 25, 'Santa Rosa de Leales', NULL, NULL),
(2362, 25, 'Sgto. Moya', NULL, NULL),
(2363, 25, 'Siete de Abril', NULL, NULL),
(2364, 25, 'Simoca', NULL, NULL),
(2365, 25, 'Soldado Maldonado', NULL, NULL),
(2366, 25, 'Sta. Ana', NULL, NULL),
(2367, 25, 'Sta. Cruz', NULL, NULL),
(2368, 25, 'Sta. Lucía', NULL, NULL),
(2369, 25, 'Taco Ralo', NULL, NULL),
(2370, 25, 'Tafí del Valle', NULL, NULL),
(2371, 25, 'Tafí Viejo', NULL, NULL),
(2372, 25, 'Tapia', NULL, NULL),
(2373, 25, 'Teniente Berdina', NULL, NULL),
(2374, 25, 'Trancas', NULL, NULL),
(2375, 25, 'Villa Belgrano', NULL, NULL),
(2376, 25, 'Villa Benjamín Araoz', NULL, NULL),
(2377, 25, 'Villa Chiligasta', NULL, NULL),
(2378, 25, 'Villa de Leales', NULL, NULL),
(2379, 25, 'Villa Quinteros', NULL, NULL),
(2380, 25, 'Yánima', NULL, NULL),
(2381, 25, 'Yerba Buena', NULL, NULL),
(2382, 25, 'Yerba Buena (S)', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_accesos`
--

CREATE TABLE `log_accesos` (
  `codigo` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `log_accesos`
--

INSERT INTO `log_accesos` (`codigo`, `usuario`, `fecha`) VALUES
(1, 'administrador', '2017-08-18 17:11:24'),
(2, 'aperez', '2017-08-18 17:33:31'),
(3, 'sromano', '2017-08-18 17:38:16'),
(4, 'tfrias', '2017-08-18 17:41:39'),
(5, 'pocampo', '2017-08-18 17:43:14'),
(6, 'augarte', '2017-08-18 17:44:48'),
(7, 'aperez', '2017-08-18 17:46:39'),
(8, 'aperez', '2017-08-18 18:43:05'),
(9, 'sromano', '2017-08-18 18:44:13'),
(10, 'pocampo', '2017-08-18 18:57:09'),
(11, 'sromano', '2017-08-18 19:00:19'),
(12, 'tfrias', '2017-08-18 19:10:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(10) UNSIGNED NOT NULL,
  `recibo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `detalle` text COLLATE utf8_spanish2_ci NOT NULL,
  `importe` decimal(11,2) NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('Activo','No activo') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `recibo`, `detalle`, `importe`, `fecha`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 'Rec 123', 'Pago servicios', '2500.00', '2014-02-18', 'Activo', '2014-02-18', 'tfrias', NULL, NULL),
(2, 'Rec 456', 'Pago alquiler', '5000.00', '2014-04-18', 'Activo', '2014-04-18', 'tfrias', NULL, NULL),
(3, 'Rec 789', 'Pago imuestos', '1800.00', '2014-08-18', 'Activo', '2014-08-18', 'tfrias', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `fechanac` date DEFAULT NULL,
  `domicilio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `usuario_id`, `nombre`, `apellido`, `dni`, `fechanac`, `domicilio`, `telefono`, `celular`, `email`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 1, 'Agustin', 'Perez', 19543127, '1975-06-10', 'Duarte Quiroz 395', 2147483647, 2147483647, 'aperez@gmail.com.ar', 'Activo', '2017-08-18', 'administrador', '2017-08-18', 'aperez'),
(2, 2, 'Sergio', 'Romano', 20432178, '1976-10-12', 'Laprida 1048', 3514782, 2147483647, 'sromano@hotmail.com.ar', 'Activo', '2017-08-18', 'administrador', '2017-08-18', 'sromano'),
(3, 3, 'Tomas', 'Frias', 15345965, '1970-02-17', 'Fructuoso Rivera 387', 351420789, 2147483647, 'tfrias@yahoo.com.ar', 'Activo', '2017-08-18', 'administrador', '2017-08-18', 'tfrias'),
(4, 4, 'Pablo', 'Ocampo', 10789234, '1965-06-16', 'General Alvear 259', 351420578, 2147483647, 'pocampo@outlook.com.ar', 'Activo', '2017-08-18', 'administrador', '2017-08-18', 'pocampo'),
(5, 5, 'Adrian', 'Ugarte', 18273653, '1978-07-20', 'Bernardino Rivadavia 55', 351429874, 2147483647, 'augarte@live.com.ar', 'Activo', '2017-08-18', 'administrador', '2017-08-18', 'augarte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `detalle` text COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `cantidad_familiar` int(11) NOT NULL,
  `importe` decimal(11,2) NOT NULL,
  `meses` int(11) NOT NULL,
  `estado` enum('Activo','No activo') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `descripcion`, `detalle`, `categoria_id`, `cantidad_familiar`, `importe`, `meses`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(4, 'Plan MA anual', 'Restaurante - Eventos - Clases de Tiro', 1, 2, '5000.00', 12, 'Activo', '2010-05-18', 'tfrias', NULL, NULL),
(5, 'Plan MC semestral', 'Restaurante - Eventos', 2, 2, '2500.00', 6, 'Activo', '2010-05-18', 'tfrias', NULL, NULL),
(6, 'Plan CC anual', 'Restaurante - Eventos - Yoga', 5, 1, '4000.00', 12, 'Activo', '2010-05-18', 'tfrias', NULL, NULL),
(7, 'Plan CT anual', 'Restaurante - Eventos', 6, 0, '4500.00', 12, 'Activo', '2010-05-18', 'tfrias', NULL, NULL),
(8, 'Plan P anual', 'Restaurante - Eventos - Varios', 7, 2, '3000.00', 12, 'Activo', '2010-05-18', 'tfrias', NULL, NULL),
(9, 'Plan MA mensual', 'Restaurante - Eventos - Clases de Tiro', 1, 2, '500.00', 1, 'Activo', '2010-05-18', 'tfrias', NULL, NULL),
(10, 'Plan CC trimestral', 'Restaurante - Eventos - Yoga', 5, 1, '1200.00', 3, 'Activo', '2010-05-18', 'tfrias', NULL, NULL),
(11, 'Plan P semestral', 'Restaurante - Eventos - Varios', 7, 2, '1500.00', 6, 'Activo', '2010-05-18', 'tfrias', NULL, NULL),
(12, 'Plan MT anual', 'Restaurante - Eventos', 3, 1, '5000.00', 12, 'Activo', '2010-05-18', 'tfrias', NULL, NULL),
(13, 'Plan PV anual', 'Restaurante - Eventos', 8, 2, '3000.00', 12, 'Activo', '2010-05-18', 'tfrias', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_socio`
--

CREATE TABLE `plan_socio` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `vencimiento` date NOT NULL,
  `estado` enum('Activo','Vencido') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `plan_socio`
--

INSERT INTO `plan_socio` (`id`, `plan_id`, `socio_id`, `vencimiento`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(9, 4, 1, '2015-01-19', 'Activo', '2014-01-19', 'tfrias', '0000-00-00', ''),
(10, 4, 2, '2015-03-19', 'Activo', '2014-03-19', 'tfrias', '0000-00-00', ''),
(11, 5, 3, '2014-11-19', 'Activo', '2014-05-19', 'tfrias', '0000-00-00', ''),
(12, 10, 4, '2014-10-19', 'Activo', '2014-07-19', 'tfrias', '0000-00-00', ''),
(13, 4, 5, '2015-09-19', 'Activo', '2014-09-19', 'tfrias', '0000-00-00', ''),
(14, 10, 6, '2015-02-19', 'Activo', '2014-11-19', 'tfrias', '0000-00-00', ''),
(15, 5, 7, '2015-05-19', 'Activo', '2014-11-19', 'tfrias', '0000-00-00', ''),
(16, 12, 8, '2015-12-19', 'Activo', '2014-12-19', 'tfrias', '0000-00-00', ''),
(17, 13, 9, '2015-12-19', 'Activo', '2014-12-19', 'tfrias', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_socio_familiar`
--

CREATE TABLE `plan_socio_familiar` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_socio_id` int(10) UNSIGNED NOT NULL,
  `familiar_id` int(10) UNSIGNED NOT NULL,
  `estado` enum('Activo','No activo') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `descripcion`) VALUES
(1, 'Buenos Aires'),
(2, 'Buenos Aires-GBA'),
(3, 'Capital Federal'),
(4, 'Catamarca'),
(5, 'Chaco'),
(6, 'Chubut'),
(7, 'Córdoba'),
(8, 'Corrientes'),
(9, 'Entre Ríos'),
(10, 'Formosa'),
(11, 'Jujuy'),
(12, 'La Pampa'),
(13, 'La Rioja'),
(14, 'Mendoza'),
(15, 'Misiones'),
(16, 'Neuquén'),
(17, 'Río Negro'),
(18, 'Salta'),
(19, 'San Juan'),
(20, 'San Luis'),
(21, 'Santa Cruz'),
(22, 'Santa Fe'),
(23, 'Santiago del Estero'),
(24, 'Tierra del Fuego'),
(25, 'Tucumán');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nsocio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidadnacimiento` int(10) UNSIGNED DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `estadocivil` enum('Soltero','Casado','Viudo','Divorciado') COLLATE utf8_unicode_ci DEFAULT 'Soltero',
  `sexo` enum('Masculino','Femenino') COLLATE utf8_unicode_ci DEFAULT 'Masculino',
  `domicilio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidad_id` int(10) UNSIGNED DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formadepago` enum('Club','Cobrador','SMSV') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Club',
  `domiciliocobrador` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barriocobrador` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidad_idcobrador` int(10) UNSIGNED DEFAULT NULL,
  `zona_id` int(10) UNSIGNED DEFAULT NULL,
  `libro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` enum('Militar','Civil','Pensionista') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Militar',
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `estadoembarcadero` enum('Si','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `estado` enum('Pendiente','Aprobado','No aprobado','Anulado','Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `altapres` date DEFAULT NULL,
  `bajapres` date DEFAULT NULL,
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id`, `nsocio`, `foto`, `nombre`, `apellido`, `localidadnacimiento`, `fechanacimiento`, `dni`, `estadocivil`, `sexo`, `domicilio`, `barrio`, `localidad_id`, `cp`, `telefono`, `celular`, `email`, `formadepago`, `domiciliocobrador`, `barriocobrador`, `localidad_idcobrador`, `zona_id`, `libro`, `acta`, `tipo`, `categoria_id`, `estadoembarcadero`, `estado`, `altapres`, `bajapres`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, '101', 'default.jpg', 'ANGEL', 'REVUELTA YANES', 295, '1850-03-06', 58504888, 'Casado', 'Masculino', 'Justo Jose 135', 'Alta Cordoba', 543, 5000, '680 575 312', '4539 7619', 'RAngel@email.com', 'Club', 'Justo Jose 135', 'Alta Cordoba', 543, 2, 'M1', '100', 'Militar', 1, 'Si', 'Activo', '2017-08-18', '0000-00-00', '2014-01-17', 'secretario', '2017-08-18', 'pocampo'),
(2, '102', 'default.jpg', 'IGNACIO', 'ALIAGA TORRALBA', 790, '1956-01-20', 43365748, 'Viudo', 'Masculino', '  Esteban Bonorino 4638', 'Villa Rivadavia', 543, 5000, ' 666 952 668', ' 4556 7543', 'ATIgnacio@email.com', 'Club', '  Esteban Bonorino 4638', 'Villa Rivadavia', 543, 6, 'M1', '100', 'Militar', 1, 'Si', 'Activo', '2017-08-18', '0000-00-00', '2014-03-17', 'secretario', '2017-08-18', 'pocampo'),
(3, '103', 'default.jpg', 'MIGUEL ANGEL', 'GUEDES VILCHES', 303, '1955-02-25', 18915434, 'Casado', 'Masculino', 'Ri­o de Cajon 1252', 'Los Olmos', 543, 5000, '609 267 187', '4485 2598', 'GVMAngel@email.com', 'Club', 'Rio de Cajon 1252', 'Los Olmos', 543, 4, 'M1', '103', 'Militar', 2, 'Si', 'Activo', '2017-08-18', '0000-00-00', '2014-05-17', 'secretario', '2017-08-18', 'pocampo'),
(4, '104', 'default.jpg', 'OSCAR', 'PUJOL SAUCEDO', 790, '1949-12-12', 49197666, 'Casado', 'Masculino', 'Buenos Aires 971 2B', 'Nueva Cordoba', 543, 5000, '760 813 890', '4485 7413', 'PSOscar@email.com', 'Club', 'Buenos Aires 971 2B', 'Nueva Cordoba', 543, 8, 'C1', '100', 'Civil', 5, 'Si', 'Activo', '2017-08-18', '0000-00-00', '2014-07-17', 'secretario', '2017-08-18', 'pocampo'),
(5, '105', 'default.jpg', 'FELIX', 'VELARDE MELERO', 1306, '1961-05-06', 18128819, 'Viudo', 'Masculino', 'Av. Pueyrredon 216 5D', 'Nueva Cordoba', 543, 5000, ' 788 410 356', '4532 1757', 'VMFelix@email.com', 'Club', 'Av. Pueyrredon 216 5D', 'Nueva Cordoba', 543, 8, 'M1', '101', 'Militar', 1, 'Si', 'Activo', '2017-08-18', '0000-00-00', '2014-09-17', 'secretario', '2017-08-18', 'pocampo'),
(6, '106', 'default.jpg', 'DAVID BLANCO', 'FONTAN', 543, '1959-10-08', 46832056, 'Casado', 'Masculino', 'Mariano Fragueiro 4454', 'Juan B. Justo', 543, 5000, '771 234 706', '4539 5076', 'FDBlanco@email.com', 'Cobrador', 'Mariano Fragueiro 4454', 'Juan B. Justo', 543, 2, 'C1', '101', 'Civil', 5, 'No', 'Activo', '2017-08-18', '0000-00-00', '2014-11-17', 'secretario', '2017-08-18', 'pocampo'),
(7, '107', 'default.jpg', 'JOSE', 'RIBEIRO IGLESIAS', 473, '1958-09-12', 9307937, 'Viudo', 'Masculino', 'Cno C. de los Remedios 6800', 'Almirante Brown', 543, 5000, '621 576 563', '5188 7878', 'RIJose@email.com', 'Club', 'Cno C. de los Remedios 6800', 'Almirante Brown', 543, 6, 'M1', '101', 'Militar', 2, 'Si', 'Activo', '2017-08-18', '0000-00-00', '2014-11-17', 'secretario', '2017-08-18', 'pocampo'),
(8, '108', 'default.jpg', 'ADRIAN', 'PICON IZAGUIRRE', 288, '1955-11-01', 50597168, 'Casado', 'Masculino', 'Pellegrini 50', 'Centro', 495, 5000, '734 549 092', '5408 0305', 'PIAdrian@email.com', 'Cobrador', 'Pellegrini 50', 'Centro', 495, 10, 'M1', '105', 'Militar', 3, 'Si', 'Activo', '2017-08-18', '0000-00-00', '2014-12-17', 'secretario', '2017-08-18', 'pocampo'),
(9, '109', 'default.jpg', 'LAURA', 'VICENS ESPINOSA', 48, '1967-03-13', 81669527, 'Viudo', 'Femenino', 'Bv. Chacabuco 757 1A', 'Nueva Cordoba', 543, 5000, '712 171 042', '5421 3454', 'VELaura@email.com', 'Club', 'Bv. Chacabuco 757 1A', 'Centro', 543, 8, 'PV1', '101', 'Pensionista', 8, 'No', 'Activo', '2017-08-18', '0000-00-00', '2014-12-17', 'secretario', '2017-08-18', 'pocampo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sociosc`
--

CREATE TABLE `sociosc` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `ocupacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domicilio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidad_id` int(10) UNSIGNED DEFAULT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sociosc`
--

INSERT INTO `sociosc` (`id`, `socio_id`, `ocupacion`, `domicilio`, `barrio`, `localidad_id`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 4, 'Contador Publico', 'Buenos Aires 971 Local 2', 'Nueva Cordoba', 543, 'Activo', '2014-07-17', 'sromano', NULL, NULL),
(2, 6, 'Mecanico', 'Av. Roque Saenz Pena 1509', 'Alta Cordoba', 543, 'Activo', '2014-11-17', 'sromano', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sociosm`
--

CREATE TABLE `sociosm` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `situacionmilitar` enum('Activo','No activo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `grado_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fuerza_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `escalafon_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `promovidopor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidad_id` int(10) UNSIGNED DEFAULT NULL,
  `serviciodesde` date DEFAULT NULL,
  `serviciohasta` date DEFAULT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sociosm`
--

INSERT INTO `sociosm` (`id`, `socio_id`, `situacionmilitar`, `grado_id`, `fuerza_id`, `escalafon_id`, `promovidopor`, `localidad_id`, `serviciodesde`, `serviciohasta`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 1, 'No activo', 'Cabo Segundo', 'Armada', 'Ingeniero Mecanico', 'LUIS COMINO BELLES', 485, '1979-02-10', '2005-01-15', 'Activo', '2014-01-17', 'sromano', NULL, NULL),
(2, 2, 'No activo', 'Cabo Primero', 'Armada', 'Electronicos', 'CESAR ILLESCAS LAGUNA', 485, '1975-09-14', '2006-02-11', 'Activo', '2014-03-17', 'sromano', NULL, NULL),
(3, 3, 'No activo', 'Suboficial mayor', 'Armada', 'Armas', 'FRANCISCO JOSE MERCHAN', 90, '1980-01-20', '2011-02-09', 'Activo', '2014-05-17', 'sromano', NULL, NULL),
(4, 5, 'No activo', 'Marinero de Primera', 'Armada', 'Electronicos', 'ALBERTO DE LA VEGA DUARTE', 449, '1979-05-20', '2010-12-11', 'Activo', '2014-09-17', 'sromano', NULL, NULL),
(5, 7, 'No activo', 'Cabo segundo', 'Armada', 'Electronica', 'RUBEN SOARES MILAN', 473, '1981-05-14', '2012-11-02', 'Activo', '2014-11-17', 'sromano', NULL, NULL),
(6, 8, 'No activo', 'Suboficial segundo', 'Armada', 'Operaciones', 'MOHAMED HERNAN TORREGROSA', 10, '1978-06-05', '2008-07-08', 'Activo', '2014-12-17', 'sromano', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sociosp`
--

CREATE TABLE `sociosp` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `grado_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fuerza_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `escalafon_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `promovidopor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidad_id` int(10) UNSIGNED DEFAULT NULL,
  `serviciodesde` date DEFAULT NULL,
  `serviciohasta` date DEFAULT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sociosp`
--

INSERT INTO `sociosp` (`id`, `socio_id`, `grado_id`, `fuerza_id`, `escalafon_id`, `promovidopor`, `localidad_id`, `serviciodesde`, `serviciohasta`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 9, 'Cabo Primero', 'Armada', 'Armas', 'LEANDRO VICENS ESPINOSA', 10, '1974-03-11', '2002-06-09', 'Activo', '2014-12-17', 'sromano', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('Ingreso','Egreso') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Ingreso',
  `observacion` text COLLATE utf8_unicode_ci,
  `estado` enum('Aprobado','No aprobado','Pendiente') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `socio_id`, `tipo`, `observacion`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 1, 'Ingreso', NULL, 'Aprobado', '2014-01-17', 'sromano', '2014-01-19', 'pocampo'),
(2, 2, 'Ingreso', NULL, 'Aprobado', '2014-03-17', 'sromano', '2014-03-19', 'pocampo'),
(3, 3, 'Ingreso', NULL, 'Aprobado', '2014-05-17', 'sromano', '2014-05-19', 'pocampo'),
(4, 4, 'Ingreso', NULL, 'Aprobado', '2014-07-17', 'sromano', '2014-07-19', 'pocampo'),
(5, 5, 'Ingreso', NULL, 'Aprobado', '2014-09-17', 'sromano', '2014-09-19', 'pocampo'),
(6, 6, 'Ingreso', NULL, 'Aprobado', '2014-11-17', 'sromano', '2014-11-19', 'pocampo'),
(7, 7, 'Ingreso', NULL, 'Aprobado', '2014-11-17', 'sromano', '2014-11-19', 'pocampo'),
(8, 8, 'Ingreso', NULL, 'Aprobado', '2014-12-17', 'sromano', '2014-12-19', 'pocampo'),
(9, 9, 'Ingreso', NULL, 'Aprobado', '2014-12-17', 'sromano', '2014-12-19', 'pocampo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_detalle`
--

CREATE TABLE `solicitud_detalle` (
  `id` int(10) UNSIGNED NOT NULL,
  `solicitud_id` int(10) UNSIGNED NOT NULL,
  `presidente` int(10) UNSIGNED NOT NULL,
  `voto` enum('Aprobado','No aprobado') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Aprobado',
  `fecha` date NOT NULL,
  `observacion` text COLLATE utf8_unicode_ci,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `solicitud_detalle`
--

INSERT INTO `solicitud_detalle` (`id`, `solicitud_id`, `presidente`, `voto`, `fecha`, `observacion`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Aprobado', '2014-01-19', 'Aprobado', 'Activo', '2014-01-19', 'pocampo', NULL, NULL, NULL, NULL),
(2, 2, 4, 'Aprobado', '2014-03-19', 'Aprobado', 'Activo', '2014-03-19', 'pocampo', NULL, NULL, NULL, NULL),
(3, 3, 4, 'Aprobado', '2014-05-19', 'Aprobado', 'Activo', '2014-05-19', 'pocampo', NULL, NULL, NULL, NULL),
(4, 4, 4, 'Aprobado', '2014-07-19', 'Aprobado', 'Activo', '2014-07-19', 'pocampo', NULL, NULL, NULL, NULL),
(5, 5, 4, 'Aprobado', '2014-09-19', 'Aprobado', 'Activo', '2014-09-19', 'pocampo', NULL, NULL, NULL, NULL),
(6, 6, 4, 'Aprobado', '2014-11-19', 'Aprobado', 'Activo', '2014-11-19', 'pocampo', NULL, NULL, NULL, NULL),
(7, 7, 4, 'Aprobado', '2014-11-19', 'Aprobado', 'Activo', '2014-11-19', 'pocampo', NULL, NULL, NULL, NULL),
(8, 8, 4, 'Aprobado', '2014-12-19', 'Aprobado', 'Activo', '2014-12-19', 'pocampo', NULL, NULL, NULL, NULL),
(9, 9, 4, 'Aprobado', '2014-12-19', 'Aprobado', 'Activo', '2014-12-19', 'pocampo', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `tipo` enum('Administrador','Secretario','Presidente','Tesorero','Auditor') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Administrador',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `email`, `estado`, `tipo`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 'aperez', '202cb962ac59075b964b07152d234b70', 'aperez@cffaacba.com.ar', 'Activo', 'Administrador', '2017-08-18', 'administrador', '0000-00-00', ''),
(2, 'sromano', '202cb962ac59075b964b07152d234b70', 'sromano@cffaacba.com.ar', 'Activo', 'Secretario', '2017-08-18', 'administrador', '0000-00-00', ''),
(3, 'tfrias', '202cb962ac59075b964b07152d234b70', 'tfrias@cffaacba.com.ar', 'Activo', 'Tesorero', '2017-08-18', 'administrador', '0000-00-00', ''),
(4, 'pocampo', '202cb962ac59075b964b07152d234b70', 'pocampo@cffaacba.com.ar', 'Activo', 'Presidente', '2017-08-18', 'administrador', '0000-00-00', ''),
(5, 'augarte', '202cb962ac59075b964b07152d234b70', 'augarte@cffaacba.com.ar', 'Activo', 'Auditor', '2017-08-18', 'administrador', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observacion` text COLLATE utf8_unicode_ci,
  `barrio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `localidad_id` int(10) UNSIGNED NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id`, `descripcion`, `observacion`, `barrio`, `localidad_id`, `estado`, `fechaalta`, `idaltausuario`, `fechaupdate`, `idmodificausuario`) VALUES
(1, 'Norte 1', NULL, 'Zona Pericentral Norte', 543, 'Activo', '2010-05-17', 'aperez', NULL, NULL),
(2, 'Norte 2', NULL, 'Zona Intermedia Norte', 543, 'Activo', '2010-05-17', 'aperez', NULL, NULL),
(3, 'Norte 3', NULL, 'Zona Periferica Norte', 543, 'Activo', '2010-05-17', 'aperez', NULL, NULL),
(4, 'Sur 1', NULL, 'Zona Pericentral Sur', 543, 'Activo', '2010-05-17', 'aperez', NULL, NULL),
(5, 'Sur 2', NULL, 'Zona Intermedia Sur', 543, 'Activo', '2010-05-17', 'aperez', NULL, NULL),
(6, 'Sur 3', NULL, 'Zona Periferica Sur', 543, 'Activo', '2010-05-17', 'aperez', NULL, NULL),
(7, 'Arguello', NULL, 'Arguello', 503, 'Activo', '2010-05-17', 'aperez', NULL, NULL),
(8, 'Central', NULL, 'Zona Central', 543, 'Activo', '2010-05-17', 'aperez', NULL, NULL),
(9, 'Unquillo', NULL, 'Unquillo', 861, 'Activo', '2010-05-17', 'aperez', NULL, NULL),
(10, 'Alta Gracia', NULL, 'Alta Gracia', 495, 'Activo', '2010-05-17', 'aperez', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cobradores`
--
ALTER TABLE `cobradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cobradores_zona_id_foreign` (`zona_id`);

--
-- Indices de la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_socio_id_foreign` (`socio_id`);

--
-- Indices de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_socio_id` (`plan_socio_id`);

--
-- Indices de la tabla `embarcaciones`
--
ALTER TABLE `embarcaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `embarcaciones_socio_id_foreign` (`socio_id`);

--
-- Indices de la tabla `familiares`
--
ALTER TABLE `familiares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `familiares_socio_id_foreign` (`socio_id`);

--
-- Indices de la tabla `foto_embarcacion`
--
ALTER TABLE `foto_embarcacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `embarcacion_id` (`embarcacion_id`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `localidades_provincia_id_foreign` (`provincia_id`);

--
-- Indices de la tabla `log_accesos`
--
ALTER TABLE `log_accesos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfiles_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `plan_socio`
--
ALTER TABLE `plan_socio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `socio_id` (`socio_id`);

--
-- Indices de la tabla `plan_socio_familiar`
--
ALTER TABLE `plan_socio_familiar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_socio_id`),
  ADD KEY `familiar_id` (`familiar_id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nsocio` (`nsocio`),
  ADD KEY `socios_categoria_id_foreign` (`categoria_id`),
  ADD KEY `socios_localidadnacimiento_foreign` (`localidadnacimiento`),
  ADD KEY `socios_localidad_id_foreign` (`localidad_id`),
  ADD KEY `socios_localidad_idcobrador_foreign` (`localidad_idcobrador`),
  ADD KEY `socios_zona_id_foreign` (`zona_id`);

--
-- Indices de la tabla `sociosc`
--
ALTER TABLE `sociosc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sociosc_socio_id_foreign` (`socio_id`),
  ADD KEY `sociosc_localidad_id_foreign` (`localidad_id`);

--
-- Indices de la tabla `sociosm`
--
ALTER TABLE `sociosm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sociosm_socio_id_foreign` (`socio_id`),
  ADD KEY `sociosm_localidad_id_foreign` (`localidad_id`);

--
-- Indices de la tabla `sociosp`
--
ALTER TABLE `sociosp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sociosp_socio_id_foreign` (`socio_id`),
  ADD KEY `sociosp_localidad_id_foreign` (`localidad_id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitudes_socio_id_foreign` (`socio_id`);

--
-- Indices de la tabla `solicitud_detalle`
--
ALTER TABLE `solicitud_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_detalle_solicitud_id_foreign` (`solicitud_id`),
  ADD KEY `solicitud_detalle_presidente_foreign` (`presidente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_email_unique` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zonas_localidad_id_foreign` (`localidad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `cobradores`
--
ALTER TABLE `cobradores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `cobros`
--
ALTER TABLE `cobros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `embarcaciones`
--
ALTER TABLE `embarcaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `familiares`
--
ALTER TABLE `familiares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `foto_embarcacion`
--
ALTER TABLE `foto_embarcacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2383;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `plan_socio`
--
ALTER TABLE `plan_socio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `plan_socio_familiar`
--
ALTER TABLE `plan_socio_familiar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `sociosc`
--
ALTER TABLE `sociosc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sociosm`
--
ALTER TABLE `sociosm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `sociosp`
--
ALTER TABLE `sociosp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `solicitud_detalle`
--
ALTER TABLE `solicitud_detalle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cobradores`
--
ALTER TABLE `cobradores`
  ADD CONSTRAINT `cobradores_zona_id_foreign` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD CONSTRAINT `pagos_socio_id_foreign` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD CONSTRAINT `cuotas_plan_socio_id_foreign` FOREIGN KEY (`plan_socio_id`) REFERENCES `plan_socio` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `embarcaciones`
--
ALTER TABLE `embarcaciones`
  ADD CONSTRAINT `embarcaciones_socio_id_foreign` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `familiares`
--
ALTER TABLE `familiares`
  ADD CONSTRAINT `familiares_socio_id_foreign` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `foto_embarcacion`
--
ALTER TABLE `foto_embarcacion`
  ADD CONSTRAINT `foto_embarcacion_embarcacion_id_foreign ` FOREIGN KEY (`embarcacion_id`) REFERENCES `embarcaciones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD CONSTRAINT `localidades_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD CONSTRAINT `perfiles_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `planes`
--
ALTER TABLE `planes`
  ADD CONSTRAINT `planes_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `plan_socio`
--
ALTER TABLE `plan_socio`
  ADD CONSTRAINT `plan_socio_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `planes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plan_socio_socio_id_foreign` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `plan_socio_familiar`
--
ALTER TABLE `plan_socio_familiar`
  ADD CONSTRAINT `plan_familiar_familiar_id_foreign` FOREIGN KEY (`familiar_id`) REFERENCES `familiares` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plan_familiar_plan_socio_id_foreign` FOREIGN KEY (`plan_socio_id`) REFERENCES `plan_socio` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socios_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `socios_localidad_id_foreign` FOREIGN KEY (`localidad_id`) REFERENCES `localidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `socios_localidad_idcobrador_foreign` FOREIGN KEY (`localidad_idcobrador`) REFERENCES `localidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `socios_localidadnacimiento_foreign` FOREIGN KEY (`localidadnacimiento`) REFERENCES `localidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `socios_zona_id_foreign` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sociosc`
--
ALTER TABLE `sociosc`
  ADD CONSTRAINT `sociosc_localidad_id_foreign` FOREIGN KEY (`localidad_id`) REFERENCES `localidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sociosc_socio_id_foreign` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sociosm`
--
ALTER TABLE `sociosm`
  ADD CONSTRAINT `sociosm_localidad_id_foreign` FOREIGN KEY (`localidad_id`) REFERENCES `localidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sociosm_socio_id_foreign` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sociosp`
--
ALTER TABLE `sociosp`
  ADD CONSTRAINT `sociosp_localidad_id_foreign` FOREIGN KEY (`localidad_id`) REFERENCES `localidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sociosp_socio_id_foreign` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_socio_id_foreign` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_detalle`
--
ALTER TABLE `solicitud_detalle`
  ADD CONSTRAINT `solicitud_detalle_presidente_foreign` FOREIGN KEY (`presidente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitud_detalle_solicitud_id_foreign` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD CONSTRAINT `zonas_localidad_id_foreign` FOREIGN KEY (`localidad_id`) REFERENCES `localidades` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
