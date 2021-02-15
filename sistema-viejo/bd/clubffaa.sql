-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-09-2016 a las 01:11:07
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `clubffaa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadexterna`
--

CREATE TABLE IF NOT EXISTS `actividadexterna` (
  `id` decimal(18,0) NOT NULL,
  `nombre` char(10) CHARACTER SET utf8 DEFAULT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `actividadexterna`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `area`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `armada`
--

CREATE TABLE IF NOT EXISTS `armada` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `armada`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  `id` decimal(18,0) NOT NULL,
  `usr_alta_id` decimal(18,0) DEFAULT NULL,
  `usr_modificacion_id` decimal(18,0) DEFAULT NULL,
  `usr_baja_id` decimal(18,0) DEFAULT NULL,
  `fechaalta` datetime DEFAULT NULL,
  `fechabaja` datetime DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_auditoria_empleado` (`usr_alta_id`),
  KEY `fk_auditoria_empleado1` (`usr_modificacion_id`),
  KEY `fk_auditoria_empleado2` (`usr_baja_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `auditoria`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avalante`
--

CREATE TABLE IF NOT EXISTS `avalante` (
  `soc_titular_id` decimal(18,0) NOT NULL,
  `soc_avalante_id` decimal(18,0) NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`soc_titular_id`,`soc_avalante_id`),
  KEY `fk_avalante_socio1` (`soc_avalante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `avalante`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `cargo`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carnetnautico`
--

CREATE TABLE IF NOT EXISTS `carnetnautico` (
  `id` decimal(18,0) NOT NULL,
  `numero` decimal(18,0) NOT NULL,
  `fecha_vence` date NOT NULL,
  `usuario_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `carnetnautico`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club`
--

CREATE TABLE IF NOT EXISTS `club` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `club`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club_actividad`
--

CREATE TABLE IF NOT EXISTS `club_actividad` (
  `soc_id` decimal(18,0) NOT NULL,
  `clu_id` decimal(18,0) NOT NULL,
  `aex_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`soc_id`,`clu_id`,`aex_id`),
  KEY `fk_club_actividad_actividadexterna` (`aex_id`),
  KEY `fk_club_actividad_club` (`clu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `club_actividad`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE IF NOT EXISTS `domicilio` (
  `id` decimal(18,0) NOT NULL,
  `loc_id` decimal(18,0) NOT NULL,
  `barrio` varchar(50) CHARACTER SET utf8 NOT NULL,
  `calle` varchar(100) CHARACTER SET utf8 NOT NULL,
  `altura` decimal(18,0) NOT NULL,
  `cp` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `piso` decimal(18,0) DEFAULT NULL,
  `departamento` char(10) DEFAULT NULL,
  `torre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_domicilio_localidad` (`loc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `domicilio`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `embarcacion`
--

CREATE TABLE IF NOT EXISTS `embarcacion` (
  `id` decimal(18,0) NOT NULL,
  `usuario_id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_embarcacion_usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `embarcacion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `embarcacionesdetalle`
--

CREATE TABLE IF NOT EXISTS `embarcacionesdetalle` (
  `id` int(11) NOT NULL,
  `material_casco` varchar(50) CHARACTER SET utf8 NOT NULL,
  `arboladura` varchar(50) CHARACTER SET utf8 NOT NULL,
  `eslora` varchar(50) CHARACTER SET utf8 NOT NULL,
  `manga` varchar(50) CHARACTER SET utf8 NOT NULL,
  `puntal` varchar(50) CHARACTER SET utf8 NOT NULL,
  `motor_marca` varchar(50) CHARACTER SET utf8 NOT NULL,
  `numero_marca` varchar(50) CHARACTER SET utf8 NOT NULL,
  `potencia_marcha` varchar(50) CHARACTER SET utf8 NOT NULL,
  `anotacion_marca` varchar(50) CHARACTER SET utf8 NOT NULL,
  `calado` varchar(50) CHARACTER SET utf8 NOT NULL,
  `tonelaje` decimal(9,4) NOT NULL,
  `numero_matricula` int(11) NOT NULL,
  `numero_rey` int(11) NOT NULL,
  `ultima_inspeccion` date NOT NULL,
  `elementos_seguridad` longtext NOT NULL,
  `embarcacion_id` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_embarcacionesdetalle_embarcacion` (`embarcacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `embarcacionesdetalle`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `templeado_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empleado_tipoempleado` (`templeado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `contraseña`, `templeado_id`) VALUES
(1, 'usuario', '12345', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escalafon`
--

CREATE TABLE IF NOT EXISTS `escalafon` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `escalafon`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiar`
--

CREATE TABLE IF NOT EXISTS `familiar` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8 NOT NULL,
  `fechanacimiento` datetime NOT NULL,
  `tdo_id` decimal(18,0) NOT NULL,
  `documento` decimal(18,0) NOT NULL,
  `tse_id` decimal(18,0) NOT NULL,
  `tpa_id` decimal(18,0) NOT NULL,
  `soc_id` decimal(18,0) NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_familiar_socio` (`soc_id`),
  KEY `fk_familiar_tipoparentesco` (`tpa_id`),
  KEY `fk_familiar_tiposexo` (`tse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `familiar`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuerzamilitar`
--

CREATE TABLE IF NOT EXISTS `fuerzamilitar` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `fuerzamilitar`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gradomilitar`
--

CREATE TABLE IF NOT EXISTS `gradomilitar` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `codigo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `gradomilitar`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE IF NOT EXISTS `localidad` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pro_id` decimal(18,0) NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_localidad_provincia` (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `localidad`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE IF NOT EXISTS `localidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_privincia` int(11) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2383 ;

--
-- Volcar la base de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id`, `id_privincia`, `localidad`) VALUES
(1, 1, '25 de Mayo'),
(2, 1, '3 de febrero'),
(3, 1, 'A. Alsina'),
(4, 1, 'A. Gonzáles Cháves'),
(5, 1, 'Aguas Verdes'),
(6, 1, 'Alberti'),
(7, 1, 'Arrecifes'),
(8, 1, 'Ayacucho'),
(9, 1, 'Azul'),
(10, 1, 'Bahía Blanca'),
(11, 1, 'Balcarce'),
(12, 1, 'Baradero'),
(13, 1, 'Benito Juárez'),
(14, 1, 'Berisso'),
(15, 1, 'Bolívar'),
(16, 1, 'Bragado'),
(17, 1, 'Brandsen'),
(18, 1, 'Campana'),
(19, 1, 'Cañuelas'),
(20, 1, 'Capilla del Señor'),
(21, 1, 'Capitán Sarmiento'),
(22, 1, 'Carapachay'),
(23, 1, 'Carhue'),
(24, 1, 'Cariló'),
(25, 1, 'Carlos Casares'),
(26, 1, 'Carlos Tejedor'),
(27, 1, 'Carmen de Areco'),
(28, 1, 'Carmen de Patagones'),
(29, 1, 'Castelli'),
(30, 1, 'Chacabuco'),
(31, 1, 'Chascomús'),
(32, 1, 'Chivilcoy'),
(33, 1, 'Colón'),
(34, 1, 'Coronel Dorrego'),
(35, 1, 'Coronel Pringles'),
(36, 1, 'Coronel Rosales'),
(37, 1, 'Coronel Suarez'),
(38, 1, 'Costa Azul'),
(39, 1, 'Costa Chica'),
(40, 1, 'Costa del Este'),
(41, 1, 'Costa Esmeralda'),
(42, 1, 'Daireaux'),
(43, 1, 'Darregueira'),
(44, 1, 'Del Viso'),
(45, 1, 'Dolores'),
(46, 1, 'Don Torcuato'),
(47, 1, 'Ensenada'),
(48, 1, 'Escobar'),
(49, 1, 'Exaltación de la Cruz'),
(50, 1, 'Florentino Ameghino'),
(51, 1, 'Garín'),
(52, 1, 'Gral. Alvarado'),
(53, 1, 'Gral. Alvear'),
(54, 1, 'Gral. Arenales'),
(55, 1, 'Gral. Belgrano'),
(56, 1, 'Gral. Guido'),
(57, 1, 'Gral. Lamadrid'),
(58, 1, 'Gral. Las Heras'),
(59, 1, 'Gral. Lavalle'),
(60, 1, 'Gral. Madariaga'),
(61, 1, 'Gral. Pacheco'),
(62, 1, 'Gral. Paz'),
(63, 1, 'Gral. Pinto'),
(64, 1, 'Gral. Pueyrredón'),
(65, 1, 'Gral. Rodríguez'),
(66, 1, 'Gral. Viamonte'),
(67, 1, 'Gral. Villegas'),
(68, 1, 'Guaminí'),
(69, 1, 'Guernica'),
(70, 1, 'Hipólito Yrigoyen'),
(71, 1, 'Ing. Maschwitz'),
(72, 1, 'Junín'),
(73, 1, 'La Plata'),
(74, 1, 'Laprida'),
(75, 1, 'Las Flores'),
(76, 1, 'Las Toninas'),
(77, 1, 'Leandro N. Alem'),
(78, 1, 'Lincoln'),
(79, 1, 'Loberia'),
(80, 1, 'Lobos'),
(81, 1, 'Los Cardales'),
(82, 1, 'Los Toldos'),
(83, 1, 'Lucila del Mar'),
(84, 1, 'Luján'),
(85, 1, 'Magdalena'),
(86, 1, 'Maipú'),
(87, 1, 'Mar Chiquita'),
(88, 1, 'Mar de Ajó'),
(89, 1, 'Mar de las Pampas'),
(90, 1, 'Mar del Plata'),
(91, 1, 'Mar del Tuyú'),
(92, 1, 'Marcos Paz'),
(93, 1, 'Mercedes'),
(94, 1, 'Miramar'),
(95, 1, 'Monte'),
(96, 1, 'Monte Hermoso'),
(97, 1, 'Munro'),
(98, 1, 'Navarro'),
(99, 1, 'Necochea'),
(100, 1, 'Olavarría'),
(101, 1, 'Partido de la Costa'),
(102, 1, 'Pehuajó'),
(103, 1, 'Pellegrini'),
(104, 1, 'Pergamino'),
(105, 1, 'Pigüé'),
(106, 1, 'Pila'),
(107, 1, 'Pilar'),
(108, 1, 'Pinamar'),
(109, 1, 'Pinar del Sol'),
(110, 1, 'Polvorines'),
(111, 1, 'Pte. Perón'),
(112, 1, 'Puán'),
(113, 1, 'Punta Indio'),
(114, 1, 'Ramallo'),
(115, 1, 'Rauch'),
(116, 1, 'Rivadavia'),
(117, 1, 'Rojas'),
(118, 1, 'Roque Pérez'),
(119, 1, 'Saavedra'),
(120, 1, 'Saladillo'),
(121, 1, 'Salliqueló'),
(122, 1, 'Salto'),
(123, 1, 'San Andrés de Giles'),
(124, 1, 'San Antonio de Areco'),
(125, 1, 'San Antonio de Padua'),
(126, 1, 'San Bernardo'),
(127, 1, 'San Cayetano'),
(128, 1, 'San Clemente del Tuyú'),
(129, 1, 'San Nicolás'),
(130, 1, 'San Pedro'),
(131, 1, 'San Vicente'),
(132, 1, 'Santa Teresita'),
(133, 1, 'Suipacha'),
(134, 1, 'Tandil'),
(135, 1, 'Tapalqué'),
(136, 1, 'Tordillo'),
(137, 1, 'Tornquist'),
(138, 1, 'Trenque Lauquen'),
(139, 1, 'Tres Lomas'),
(140, 1, 'Villa Gesell'),
(141, 1, 'Villarino'),
(142, 1, 'Zárate'),
(143, 2, '11 de Septiembre'),
(144, 2, '20 de Junio'),
(145, 2, '25 de Mayo'),
(146, 2, 'Acassuso'),
(147, 2, 'Adrogué'),
(148, 2, 'Aldo Bonzi'),
(149, 2, 'Área Reserva Cinturón Ecológico'),
(150, 2, 'Avellaneda'),
(151, 2, 'Banfield'),
(152, 2, 'Barrio Parque'),
(153, 2, 'Barrio Santa Teresita'),
(154, 2, 'Beccar'),
(155, 2, 'Bella Vista'),
(156, 2, 'Berazategui'),
(157, 2, 'Bernal Este'),
(158, 2, 'Bernal Oeste'),
(159, 2, 'Billinghurst'),
(160, 2, 'Boulogne'),
(161, 2, 'Burzaco'),
(162, 2, 'Carapachay'),
(163, 2, 'Caseros'),
(164, 2, 'Castelar'),
(165, 2, 'Churruca'),
(166, 2, 'Ciudad Evita'),
(167, 2, 'Ciudad Madero'),
(168, 2, 'Ciudadela'),
(169, 2, 'Claypole'),
(170, 2, 'Crucecita'),
(171, 2, 'Dock Sud'),
(172, 2, 'Don Bosco'),
(173, 2, 'Don Orione'),
(174, 2, 'El Jagüel'),
(175, 2, 'El Libertador'),
(176, 2, 'El Palomar'),
(177, 2, 'El Tala'),
(178, 2, 'El Trébol'),
(179, 2, 'Ezeiza'),
(180, 2, 'Ezpeleta'),
(181, 2, 'Florencio Varela'),
(182, 2, 'Florida'),
(183, 2, 'Francisco Álvarez'),
(184, 2, 'Gerli'),
(185, 2, 'Glew'),
(186, 2, 'González Catán'),
(187, 2, 'Gral. Lamadrid'),
(188, 2, 'Grand Bourg'),
(189, 2, 'Gregorio de Laferrere'),
(190, 2, 'Guillermo Enrique Hudson'),
(191, 2, 'Haedo'),
(192, 2, 'Hurlingham'),
(193, 2, 'Ing. Sourdeaux'),
(194, 2, 'Isidro Casanova'),
(195, 2, 'Ituzaingó'),
(196, 2, 'José C. Paz'),
(197, 2, 'José Ingenieros'),
(198, 2, 'José Marmol'),
(199, 2, 'La Lucila'),
(200, 2, 'La Reja'),
(201, 2, 'La Tablada'),
(202, 2, 'Lanús'),
(203, 2, 'Llavallol'),
(204, 2, 'Loma Hermosa'),
(205, 2, 'Lomas de Zamora'),
(206, 2, 'Lomas del Millón'),
(207, 2, 'Lomas del Mirador'),
(208, 2, 'Longchamps'),
(209, 2, 'Los Polvorines'),
(210, 2, 'Luis Guillón'),
(211, 2, 'Malvinas Argentinas'),
(212, 2, 'Martín Coronado'),
(213, 2, 'Martínez'),
(214, 2, 'Merlo'),
(215, 2, 'Ministro Rivadavia'),
(216, 2, 'Monte Chingolo'),
(217, 2, 'Monte Grande'),
(218, 2, 'Moreno'),
(219, 2, 'Morón'),
(220, 2, 'Muñiz'),
(221, 2, 'Olivos'),
(222, 2, 'Pablo Nogués'),
(223, 2, 'Pablo Podestá'),
(224, 2, 'Paso del Rey'),
(225, 2, 'Pereyra'),
(226, 2, 'Piñeiro'),
(227, 2, 'Plátanos'),
(228, 2, 'Pontevedra'),
(229, 2, 'Quilmes'),
(230, 2, 'Rafael Calzada'),
(231, 2, 'Rafael Castillo'),
(232, 2, 'Ramos Mejía'),
(233, 2, 'Ranelagh'),
(234, 2, 'Remedios de Escalada'),
(235, 2, 'Sáenz Peña'),
(236, 2, 'San Antonio de Padua'),
(237, 2, 'San Fernando'),
(238, 2, 'San Francisco Solano'),
(239, 2, 'San Isidro'),
(240, 2, 'San José'),
(241, 2, 'San Justo'),
(242, 2, 'San Martín'),
(243, 2, 'San Miguel'),
(244, 2, 'Santos Lugares'),
(245, 2, 'Sarandí'),
(246, 2, 'Sourigues'),
(247, 2, 'Tapiales'),
(248, 2, 'Temperley'),
(249, 2, 'Tigre'),
(250, 2, 'Tortuguitas'),
(251, 2, 'Tristán Suárez'),
(252, 2, 'Trujui'),
(253, 2, 'Turdera'),
(254, 2, 'Valentín Alsina'),
(255, 2, 'Vicente López'),
(256, 2, 'Villa Adelina'),
(257, 2, 'Villa Ballester'),
(258, 2, 'Villa Bosch'),
(259, 2, 'Villa Caraza'),
(260, 2, 'Villa Celina'),
(261, 2, 'Villa Centenario'),
(262, 2, 'Villa de Mayo'),
(263, 2, 'Villa Diamante'),
(264, 2, 'Villa Domínico'),
(265, 2, 'Villa España'),
(266, 2, 'Villa Fiorito'),
(267, 2, 'Villa Guillermina'),
(268, 2, 'Villa Insuperable'),
(269, 2, 'Villa José León Suárez'),
(270, 2, 'Villa La Florida'),
(271, 2, 'Villa Luzuriaga'),
(272, 2, 'Villa Martelli'),
(273, 2, 'Villa Obrera'),
(274, 2, 'Villa Progreso'),
(275, 2, 'Villa Raffo'),
(276, 2, 'Villa Sarmiento'),
(277, 2, 'Villa Tesei'),
(278, 2, 'Villa Udaondo'),
(279, 2, 'Virrey del Pino'),
(280, 2, 'Wilde'),
(281, 2, 'William Morris'),
(282, 3, 'Agronomía'),
(283, 3, 'Almagro'),
(284, 3, 'Balvanera'),
(285, 3, 'Barracas'),
(286, 3, 'Belgrano'),
(287, 3, 'Boca'),
(288, 3, 'Boedo'),
(289, 3, 'Caballito'),
(290, 3, 'Chacarita'),
(291, 3, 'Coghlan'),
(292, 3, 'Colegiales'),
(293, 3, 'Constitución'),
(294, 3, 'Flores'),
(295, 3, 'Floresta'),
(296, 3, 'La Paternal'),
(297, 3, 'Liniers'),
(298, 3, 'Mataderos'),
(299, 3, 'Monserrat'),
(300, 3, 'Monte Castro'),
(301, 3, 'Nueva Pompeya'),
(302, 3, 'Núñez'),
(303, 3, 'Palermo'),
(304, 3, 'Parque Avellaneda'),
(305, 3, 'Parque Chacabuco'),
(306, 3, 'Parque Chas'),
(307, 3, 'Parque Patricios'),
(308, 3, 'Puerto Madero'),
(309, 3, 'Recoleta'),
(310, 3, 'Retiro'),
(311, 3, 'Saavedra'),
(312, 3, 'San Cristóbal'),
(313, 3, 'San Nicolás'),
(314, 3, 'San Telmo'),
(315, 3, 'Vélez Sársfield'),
(316, 3, 'Versalles'),
(317, 3, 'Villa Crespo'),
(318, 3, 'Villa del Parque'),
(319, 3, 'Villa Devoto'),
(320, 3, 'Villa Gral. Mitre'),
(321, 3, 'Villa Lugano'),
(322, 3, 'Villa Luro'),
(323, 3, 'Villa Ortúzar'),
(324, 3, 'Villa Pueyrredón'),
(325, 3, 'Villa Real'),
(326, 3, 'Villa Riachuelo'),
(327, 3, 'Villa Santa Rita'),
(328, 3, 'Villa Soldati'),
(329, 3, 'Villa Urquiza'),
(330, 4, 'Aconquija'),
(331, 4, 'Ancasti'),
(332, 4, 'Andalgalá'),
(333, 4, 'Antofagasta'),
(334, 4, 'Belén'),
(335, 4, 'Capayán'),
(336, 4, 'Capital'),
(337, 4, '4'),
(338, 4, 'Corral Quemado'),
(339, 4, 'El Alto'),
(340, 4, 'El Rodeo'),
(341, 4, 'F.Mamerto Esquiú'),
(342, 4, 'Fiambalá'),
(343, 4, 'Hualfín'),
(344, 4, 'Huillapima'),
(345, 4, 'Icaño'),
(346, 4, 'La Puerta'),
(347, 4, 'Las Juntas'),
(348, 4, 'Londres'),
(349, 4, 'Los Altos'),
(350, 4, 'Los Varela'),
(351, 4, 'Mutquín'),
(352, 4, 'Paclín'),
(353, 4, 'Poman'),
(354, 4, 'Pozo de La Piedra'),
(355, 4, 'Puerta de Corral'),
(356, 4, 'Puerta San José'),
(357, 4, 'Recreo'),
(358, 4, 'S.F.V de 4'),
(359, 4, 'San Fernando'),
(360, 4, 'San Fernando del Valle'),
(361, 4, 'San José'),
(362, 4, 'Santa María'),
(363, 4, 'Santa Rosa'),
(364, 4, 'Saujil'),
(365, 4, 'Tapso'),
(366, 4, 'Tinogasta'),
(367, 4, 'Valle Viejo'),
(368, 4, 'Villa Vil'),
(369, 5, 'Aviá Teraí'),
(370, 5, 'Barranqueras'),
(371, 5, 'Basail'),
(372, 5, 'Campo Largo'),
(373, 5, 'Capital'),
(374, 5, 'Capitán Solari'),
(375, 5, 'Charadai'),
(376, 5, 'Charata'),
(377, 5, 'Chorotis'),
(378, 5, 'Ciervo Petiso'),
(379, 5, 'Cnel. Du Graty'),
(380, 5, 'Col. Benítez'),
(381, 5, 'Col. Elisa'),
(382, 5, 'Col. Popular'),
(383, 5, 'Colonias Unidas'),
(384, 5, 'Concepción'),
(385, 5, 'Corzuela'),
(386, 5, 'Cote Lai'),
(387, 5, 'El Sauzalito'),
(388, 5, 'Enrique Urien'),
(389, 5, 'Fontana'),
(390, 5, 'Fte. Esperanza'),
(391, 5, 'Gancedo'),
(392, 5, 'Gral. Capdevila'),
(393, 5, 'Gral. Pinero'),
(394, 5, 'Gral. San Martín'),
(395, 5, 'Gral. Vedia'),
(396, 5, 'Hermoso Campo'),
(397, 5, 'I. del Cerrito'),
(398, 5, 'J.J. Castelli'),
(399, 5, 'La Clotilde'),
(400, 5, 'La Eduvigis'),
(401, 5, 'La Escondida'),
(402, 5, 'La Leonesa'),
(403, 5, 'La Tigra'),
(404, 5, 'La Verde'),
(405, 5, 'Laguna Blanca'),
(406, 5, 'Laguna Limpia'),
(407, 5, 'Lapachito'),
(408, 5, 'Las Breñas'),
(409, 5, 'Las Garcitas'),
(410, 5, 'Las Palmas'),
(411, 5, 'Los Frentones'),
(412, 5, 'Machagai'),
(413, 5, 'Makallé'),
(414, 5, 'Margarita Belén'),
(415, 5, 'Miraflores'),
(416, 5, 'Misión N. Pompeya'),
(417, 5, 'Napenay'),
(418, 5, 'Pampa Almirón'),
(419, 5, 'Pampa del Indio'),
(420, 5, 'Pampa del Infierno'),
(421, 5, 'Pdcia. de La Plaza'),
(422, 5, 'Pdcia. Roca'),
(423, 5, 'Pdcia. Roque Sáenz Peña'),
(424, 5, 'Pto. Bermejo'),
(425, 5, 'Pto. Eva Perón'),
(426, 5, 'Puero Tirol'),
(427, 5, 'Puerto Vilelas'),
(428, 5, 'Quitilipi'),
(429, 5, 'Resistencia'),
(430, 5, 'Sáenz Peña'),
(431, 5, 'Samuhú'),
(432, 5, 'San Bernardo'),
(433, 5, 'Santa Sylvina'),
(434, 5, 'Taco Pozo'),
(435, 5, 'Tres Isletas'),
(436, 5, 'Villa Ángela'),
(437, 5, 'Villa Berthet'),
(438, 5, 'Villa R. Bermejito'),
(439, 6, 'Aldea Apeleg'),
(440, 6, 'Aldea Beleiro'),
(441, 6, 'Aldea Epulef'),
(442, 6, 'Alto Río Sengerr'),
(443, 6, 'Buen Pasto'),
(444, 6, 'Camarones'),
(445, 6, 'Carrenleufú'),
(446, 6, 'Cholila'),
(447, 6, 'Co. Centinela'),
(448, 6, 'Colan Conhué'),
(449, 6, 'Comodoro Rivadavia'),
(450, 6, 'Corcovado'),
(451, 6, 'Cushamen'),
(452, 6, 'Dique F. Ameghino'),
(453, 6, 'Dolavón'),
(454, 6, 'Dr. R. Rojas'),
(455, 6, 'El Hoyo'),
(456, 6, 'El Maitén'),
(457, 6, 'Epuyén'),
(458, 6, 'Esquel'),
(459, 6, 'Facundo'),
(460, 6, 'Gaimán'),
(461, 6, 'Gan Gan'),
(462, 6, 'Gastre'),
(463, 6, 'Gdor. Costa'),
(464, 6, 'Gualjaina'),
(465, 6, 'J. de San Martín'),
(466, 6, 'Lago Blanco'),
(467, 6, 'Lago Puelo'),
(468, 6, 'Lagunita Salada'),
(469, 6, 'Las Plumas'),
(470, 6, 'Los Altares'),
(471, 6, 'Paso de los Indios'),
(472, 6, 'Paso del Sapo'),
(473, 6, 'Pto. Madryn'),
(474, 6, 'Pto. Pirámides'),
(475, 6, 'Rada Tilly'),
(476, 6, 'Rawson'),
(477, 6, 'Río Mayo'),
(478, 6, 'Río Pico'),
(479, 6, 'Sarmiento'),
(480, 6, 'Tecka'),
(481, 6, 'Telsen'),
(482, 6, 'Trelew'),
(483, 6, 'Trevelin'),
(484, 6, 'Veintiocho de Julio'),
(485, 7, 'Achiras'),
(486, 7, 'Adelia Maria'),
(487, 7, 'Agua de Oro'),
(488, 7, 'Alcira Gigena'),
(489, 7, 'Aldea Santa Maria'),
(490, 7, 'Alejandro Roca'),
(491, 7, 'Alejo Ledesma'),
(492, 7, 'Alicia'),
(493, 7, 'Almafuerte'),
(494, 7, 'Alpa Corral'),
(495, 7, 'Alta Gracia'),
(496, 7, 'Alto Alegre'),
(497, 7, 'Alto de Los Quebrachos'),
(498, 7, 'Altos de Chipion'),
(499, 7, 'Amboy'),
(500, 7, 'Ambul'),
(501, 7, 'Ana Zumaran'),
(502, 7, 'Anisacate'),
(503, 7, 'Arguello'),
(504, 7, 'Arias'),
(505, 7, 'Arroyito'),
(506, 7, 'Arroyo Algodon'),
(507, 7, 'Arroyo Cabral'),
(508, 7, 'Arroyo Los Patos'),
(509, 7, 'Assunta'),
(510, 7, 'Atahona'),
(511, 7, 'Ausonia'),
(512, 7, 'Avellaneda'),
(513, 7, 'Ballesteros'),
(514, 7, 'Ballesteros Sud'),
(515, 7, 'Balnearia'),
(516, 7, 'Bañado de Soto'),
(517, 7, 'Bell Ville'),
(518, 7, 'Bengolea'),
(519, 7, 'Benjamin Gould'),
(520, 7, 'Berrotaran'),
(521, 7, 'Bialet Masse'),
(522, 7, 'Bouwer'),
(523, 7, 'Brinkmann'),
(524, 7, 'Buchardo'),
(525, 7, 'Bulnes'),
(526, 7, 'Cabalango'),
(527, 7, 'Calamuchita'),
(528, 7, 'Calchin'),
(529, 7, 'Calchin Oeste'),
(530, 7, 'Calmayo'),
(531, 7, 'Camilo Aldao'),
(532, 7, 'Caminiaga'),
(533, 7, 'Cañada de Luque'),
(534, 7, 'Cañada de Machado'),
(535, 7, 'Cañada de Rio Pinto'),
(536, 7, 'Cañada del Sauce'),
(537, 7, 'Canals'),
(538, 7, 'Candelaria Sud'),
(539, 7, 'Capilla de Remedios'),
(540, 7, 'Capilla de Siton'),
(541, 7, 'Capilla del Carmen'),
(542, 7, 'Capilla del Monte'),
(543, 7, 'Capital'),
(544, 7, 'Capitan Gral B. O´Higgins'),
(545, 7, 'Carnerillo'),
(546, 7, 'Carrilobo'),
(547, 7, 'Casa Grande'),
(548, 7, 'Cavanagh'),
(549, 7, 'Cerro Colorado'),
(550, 7, 'Chaján'),
(551, 7, 'Chalacea'),
(552, 7, 'Chañar Viejo'),
(553, 7, 'Chancaní'),
(554, 7, 'Charbonier'),
(555, 7, 'Charras'),
(556, 7, 'Chazón'),
(557, 7, 'Chilibroste'),
(558, 7, 'Chucul'),
(559, 7, 'Chuña'),
(560, 7, 'Chuña Huasi'),
(561, 7, 'Churqui Cañada'),
(562, 7, 'Cienaga Del Coro'),
(563, 7, 'Cintra'),
(564, 7, 'Col. Almada'),
(565, 7, 'Col. Anita'),
(566, 7, 'Col. Barge'),
(567, 7, 'Col. Bismark'),
(568, 7, 'Col. Bremen'),
(569, 7, 'Col. Caroya'),
(570, 7, 'Col. Italiana'),
(571, 7, 'Col. Iturraspe'),
(572, 7, 'Col. Las Cuatro Esquinas'),
(573, 7, 'Col. Las Pichanas'),
(574, 7, 'Col. Marina'),
(575, 7, 'Col. Prosperidad'),
(576, 7, 'Col. San Bartolome'),
(577, 7, 'Col. San Pedro'),
(578, 7, 'Col. Tirolesa'),
(579, 7, 'Col. Vicente Aguero'),
(580, 7, 'Col. Videla'),
(581, 7, 'Col. Vignaud'),
(582, 7, 'Col. Waltelina'),
(583, 7, 'Colazo'),
(584, 7, 'Comechingones'),
(585, 7, 'Conlara'),
(586, 7, 'Copacabana'),
(587, 7, '7'),
(588, 7, 'Coronel Baigorria'),
(589, 7, 'Coronel Moldes'),
(590, 7, 'Corral de Bustos'),
(591, 7, 'Corralito'),
(592, 7, 'Cosquín'),
(593, 7, 'Costa Sacate'),
(594, 7, 'Cruz Alta'),
(595, 7, 'Cruz de Caña'),
(596, 7, 'Cruz del Eje'),
(597, 7, 'Cuesta Blanca'),
(598, 7, 'Dean Funes'),
(599, 7, 'Del Campillo'),
(600, 7, 'Despeñaderos'),
(601, 7, 'Devoto'),
(602, 7, 'Diego de Rojas'),
(603, 7, 'Dique Chico'),
(604, 7, 'El Arañado'),
(605, 7, 'El Brete'),
(606, 7, 'El Chacho'),
(607, 7, 'El Crispín'),
(608, 7, 'El Fortín'),
(609, 7, 'El Manzano'),
(610, 7, 'El Rastreador'),
(611, 7, 'El Rodeo'),
(612, 7, 'El Tío'),
(613, 7, 'Elena'),
(614, 7, 'Embalse'),
(615, 7, 'Esquina'),
(616, 7, 'Estación Gral. Paz'),
(617, 7, 'Estación Juárez Celman'),
(618, 7, 'Estancia de Guadalupe'),
(619, 7, 'Estancia Vieja'),
(620, 7, 'Etruria'),
(621, 7, 'Eufrasio Loza'),
(622, 7, 'Falda del Carmen'),
(623, 7, 'Freyre'),
(624, 7, 'Gral. Baldissera'),
(625, 7, 'Gral. Cabrera'),
(626, 7, 'Gral. Deheza'),
(627, 7, 'Gral. Fotheringham'),
(628, 7, 'Gral. Levalle'),
(629, 7, 'Gral. Roca'),
(630, 7, 'Guanaco Muerto'),
(631, 7, 'Guasapampa'),
(632, 7, 'Guatimozin'),
(633, 7, 'Gutenberg'),
(634, 7, 'Hernando'),
(635, 7, 'Huanchillas'),
(636, 7, 'Huerta Grande'),
(637, 7, 'Huinca Renanco'),
(638, 7, 'Idiazabal'),
(639, 7, 'Impira'),
(640, 7, 'Inriville'),
(641, 7, 'Isla Verde'),
(642, 7, 'Italó'),
(643, 7, 'James Craik'),
(644, 7, 'Jesús María'),
(645, 7, 'Jovita'),
(646, 7, 'Justiniano Posse'),
(647, 7, 'Km 658'),
(648, 7, 'L. V. Mansilla'),
(649, 7, 'La Batea'),
(650, 7, 'La Calera'),
(651, 7, 'La Carlota'),
(652, 7, 'La Carolina'),
(653, 7, 'La Cautiva'),
(654, 7, 'La Cesira'),
(655, 7, 'La Cruz'),
(656, 7, 'La Cumbre'),
(657, 7, 'La Cumbrecita'),
(658, 7, 'La Falda'),
(659, 7, 'La Francia'),
(660, 7, 'La Granja'),
(661, 7, 'La Higuera'),
(662, 7, 'La Laguna'),
(663, 7, 'La Paisanita'),
(664, 7, 'La Palestina'),
(665, 7, '12'),
(666, 7, 'La Paquita'),
(667, 7, 'La Para'),
(668, 7, 'La Paz'),
(669, 7, 'La Playa'),
(670, 7, 'La Playosa'),
(671, 7, 'La Población'),
(672, 7, 'La Posta'),
(673, 7, 'La Puerta'),
(674, 7, 'La Quinta'),
(675, 7, 'La Rancherita'),
(676, 7, 'La Rinconada'),
(677, 7, 'La Serranita'),
(678, 7, 'La Tordilla'),
(679, 7, 'Laborde'),
(680, 7, 'Laboulaye'),
(681, 7, 'Laguna Larga'),
(682, 7, 'Las Acequias'),
(683, 7, 'Las Albahacas'),
(684, 7, 'Las Arrias'),
(685, 7, 'Las Bajadas'),
(686, 7, 'Las Caleras'),
(687, 7, 'Las Calles'),
(688, 7, 'Las Cañadas'),
(689, 7, 'Las Gramillas'),
(690, 7, 'Las Higueras'),
(691, 7, 'Las Isletillas'),
(692, 7, 'Las Junturas'),
(693, 7, 'Las Palmas'),
(694, 7, 'Las Peñas'),
(695, 7, 'Las Peñas Sud'),
(696, 7, 'Las Perdices'),
(697, 7, 'Las Playas'),
(698, 7, 'Las Rabonas'),
(699, 7, 'Las Saladas'),
(700, 7, 'Las Tapias'),
(701, 7, 'Las Varas'),
(702, 7, 'Las Varillas'),
(703, 7, 'Las Vertientes'),
(704, 7, 'Leguizamón'),
(705, 7, 'Leones'),
(706, 7, 'Los Cedros'),
(707, 7, 'Los Cerrillos'),
(708, 7, 'Los Chañaritos (C.E)'),
(709, 7, 'Los Chanaritos (R.S)'),
(710, 7, 'Los Cisnes'),
(711, 7, 'Los Cocos'),
(712, 7, 'Los Cóndores'),
(713, 7, 'Los Hornillos'),
(714, 7, 'Los Hoyos'),
(715, 7, 'Los Mistoles'),
(716, 7, 'Los Molinos'),
(717, 7, 'Los Pozos'),
(718, 7, 'Los Reartes'),
(719, 7, 'Los Surgentes'),
(720, 7, 'Los Talares'),
(721, 7, 'Los Zorros'),
(722, 7, 'Lozada'),
(723, 7, 'Luca'),
(724, 7, 'Luque'),
(725, 7, 'Luyaba'),
(726, 7, 'Malagueño'),
(727, 7, 'Malena'),
(728, 7, 'Malvinas Argentinas'),
(729, 7, 'Manfredi'),
(730, 7, 'Maquinista Gallini'),
(731, 7, 'Marcos Juárez'),
(732, 7, 'Marull'),
(733, 7, 'Matorrales'),
(734, 7, 'Mattaldi'),
(735, 7, 'Mayu Sumaj'),
(736, 7, 'Media Naranja'),
(737, 7, 'Melo'),
(738, 7, 'Mendiolaza'),
(739, 7, 'Mi Granja'),
(740, 7, 'Mina Clavero'),
(741, 7, 'Miramar'),
(742, 7, 'Morrison'),
(743, 7, 'Morteros'),
(744, 7, 'Mte. Buey'),
(745, 7, 'Mte. Cristo'),
(746, 7, 'Mte. De Los Gauchos'),
(747, 7, 'Mte. Leña'),
(748, 7, 'Mte. Maíz'),
(749, 7, 'Mte. Ralo'),
(750, 7, 'Nicolás Bruzone'),
(751, 7, 'Noetinger'),
(752, 7, 'Nono'),
(753, 7, 'Nueva 7'),
(754, 7, 'Obispo Trejo'),
(755, 7, 'Olaeta'),
(756, 7, 'Oliva'),
(757, 7, 'Olivares San Nicolás'),
(758, 7, 'Onagolty'),
(759, 7, 'Oncativo'),
(760, 7, 'Ordoñez'),
(761, 7, 'Pacheco De Melo'),
(762, 7, 'Pampayasta N.'),
(763, 7, 'Pampayasta S.'),
(764, 7, 'Panaholma'),
(765, 7, 'Pascanas'),
(766, 7, 'Pasco'),
(767, 7, 'Paso del Durazno'),
(768, 7, 'Paso Viejo'),
(769, 7, 'Pilar'),
(770, 7, 'Pincén'),
(771, 7, 'Piquillín'),
(772, 7, 'Plaza de Mercedes'),
(773, 7, 'Plaza Luxardo'),
(774, 7, 'Porteña'),
(775, 7, 'Potrero de Garay'),
(776, 7, 'Pozo del Molle'),
(777, 7, 'Pozo Nuevo'),
(778, 7, 'Pueblo Italiano'),
(779, 7, 'Puesto de Castro'),
(780, 7, 'Punta del Agua'),
(781, 7, 'Quebracho Herrado'),
(782, 7, 'Quilino'),
(783, 7, 'Rafael García'),
(784, 7, 'Ranqueles'),
(785, 7, 'Rayo Cortado'),
(786, 7, 'Reducción'),
(787, 7, 'Rincón'),
(788, 7, 'Río Bamba'),
(789, 7, 'Río Ceballos'),
(790, 7, 'Río Cuarto'),
(791, 7, 'Río de Los Sauces'),
(792, 7, 'Río Primero'),
(793, 7, 'Río Segundo'),
(794, 7, 'Río Tercero'),
(795, 7, 'Rosales'),
(796, 7, 'Rosario del Saladillo'),
(797, 7, 'Sacanta'),
(798, 7, 'Sagrada Familia'),
(799, 7, 'Saira'),
(800, 7, 'Saladillo'),
(801, 7, 'Saldán'),
(802, 7, 'Salsacate'),
(803, 7, 'Salsipuedes'),
(804, 7, 'Sampacho'),
(805, 7, 'San Agustín'),
(806, 7, 'San Antonio de Arredondo'),
(807, 7, 'San Antonio de Litín'),
(808, 7, 'San Basilio'),
(809, 7, 'San Carlos Minas'),
(810, 7, 'San Clemente'),
(811, 7, 'San Esteban'),
(812, 7, 'San Francisco'),
(813, 7, 'San Ignacio'),
(814, 7, 'San Javier'),
(815, 7, 'San Jerónimo'),
(816, 7, 'San Joaquín'),
(817, 7, 'San José de La Dormida'),
(818, 7, 'San José de Las Salinas'),
(819, 7, 'San Lorenzo'),
(820, 7, 'San Marcos Sierras'),
(821, 7, 'San Marcos Sud'),
(822, 7, 'San Pedro'),
(823, 7, 'San Pedro N.'),
(824, 7, 'San Roque'),
(825, 7, 'San Vicente'),
(826, 7, 'Santa Catalina'),
(827, 7, 'Santa Elena'),
(828, 7, 'Santa Eufemia'),
(829, 7, 'Santa Maria'),
(830, 7, 'Sarmiento'),
(831, 7, 'Saturnino M.Laspiur'),
(832, 7, 'Sauce Arriba'),
(833, 7, 'Sebastián Elcano'),
(834, 7, 'Seeber'),
(835, 7, 'Segunda Usina'),
(836, 7, 'Serrano'),
(837, 7, 'Serrezuela'),
(838, 7, 'Sgo. Temple'),
(839, 7, 'Silvio Pellico'),
(840, 7, 'Simbolar'),
(841, 7, 'Sinsacate'),
(842, 7, 'Sta. Rosa de Calamuchita'),
(843, 7, 'Sta. Rosa de Río Primero'),
(844, 7, 'Suco'),
(845, 7, 'Tala Cañada'),
(846, 7, 'Tala Huasi'),
(847, 7, 'Talaini'),
(848, 7, 'Tancacha'),
(849, 7, 'Tanti'),
(850, 7, 'Ticino'),
(851, 7, 'Tinoco'),
(852, 7, 'Tío Pujio'),
(853, 7, 'Toledo'),
(854, 7, 'Toro Pujio'),
(855, 7, 'Tosno'),
(856, 7, 'Tosquita'),
(857, 7, 'Tránsito'),
(858, 7, 'Tuclame'),
(859, 7, 'Tutti'),
(860, 7, 'Ucacha'),
(861, 7, 'Unquillo'),
(862, 7, 'Valle de Anisacate'),
(863, 7, 'Valle Hermoso'),
(864, 7, 'Vélez Sarfield'),
(865, 7, 'Viamonte'),
(866, 7, 'Vicuña Mackenna'),
(867, 7, 'Villa Allende'),
(868, 7, 'Villa Amancay'),
(869, 7, 'Villa Ascasubi'),
(870, 7, 'Villa Candelaria N.'),
(871, 7, 'Villa Carlos Paz'),
(872, 7, 'Villa Cerro Azul'),
(873, 7, 'Villa Ciudad de América'),
(874, 7, 'Villa Ciudad Pque Los Reartes'),
(875, 7, 'Villa Concepción del Tío'),
(876, 7, 'Villa Cura Brochero'),
(877, 7, 'Villa de Las Rosas'),
(878, 7, 'Villa de María'),
(879, 7, 'Villa de Pocho'),
(880, 7, 'Villa de Soto'),
(881, 7, 'Villa del Dique'),
(882, 7, 'Villa del Prado'),
(883, 7, 'Villa del Rosario'),
(884, 7, 'Villa del Totoral'),
(885, 7, 'Villa Dolores'),
(886, 7, 'Villa El Chancay'),
(887, 7, 'Villa Elisa'),
(888, 7, 'Villa Flor Serrana'),
(889, 7, 'Villa Fontana'),
(890, 7, 'Villa Giardino'),
(891, 7, 'Villa Gral. Belgrano'),
(892, 7, 'Villa Gutierrez'),
(893, 7, 'Villa Huidobro'),
(894, 7, 'Villa La Bolsa'),
(895, 7, 'Villa Los Aromos'),
(896, 7, 'Villa Los Patos'),
(897, 7, 'Villa María'),
(898, 7, 'Villa Nueva'),
(899, 7, 'Villa Pque. Santa Ana'),
(900, 7, 'Villa Pque. Siquiman'),
(901, 7, 'Villa Quillinzo'),
(902, 7, 'Villa Rossi'),
(903, 7, 'Villa Rumipal'),
(904, 7, 'Villa San Esteban'),
(905, 7, 'Villa San Isidro'),
(906, 7, 'Villa 21'),
(907, 7, 'Villa Sarmiento (G.R)'),
(908, 7, 'Villa Sarmiento (S.A)'),
(909, 7, 'Villa Tulumba'),
(910, 7, 'Villa Valeria'),
(911, 7, 'Villa Yacanto'),
(912, 7, 'Washington'),
(913, 7, 'Wenceslao Escalante'),
(914, 7, 'Ycho Cruz Sierras'),
(915, 8, 'Alvear'),
(916, 8, 'Bella Vista'),
(917, 8, 'Berón de Astrada'),
(918, 8, 'Bonpland'),
(919, 8, 'Caá Cati'),
(920, 8, 'Capital'),
(921, 8, 'Chavarría'),
(922, 8, 'Col. C. Pellegrini'),
(923, 8, 'Col. Libertad'),
(924, 8, 'Col. Liebig'),
(925, 8, 'Col. Sta Rosa'),
(926, 8, 'Concepción'),
(927, 8, 'Cruz de Los Milagros'),
(928, 8, 'Curuzú-Cuatiá'),
(929, 8, 'Empedrado'),
(930, 8, 'Esquina'),
(931, 8, 'Estación Torrent'),
(932, 8, 'Felipe Yofré'),
(933, 8, 'Garruchos'),
(934, 8, 'Gdor. Agrónomo'),
(935, 8, 'Gdor. Martínez'),
(936, 8, 'Goya'),
(937, 8, 'Guaviravi'),
(938, 8, 'Herlitzka'),
(939, 8, 'Ita-Ibate'),
(940, 8, 'Itatí'),
(941, 8, 'Ituzaingó'),
(942, 8, 'José Rafael Gómez'),
(943, 8, 'Juan Pujol'),
(944, 8, 'La Cruz'),
(945, 8, 'Lavalle'),
(946, 8, 'Lomas de Vallejos'),
(947, 8, 'Loreto'),
(948, 8, 'Mariano I. Loza'),
(949, 8, 'Mburucuyá'),
(950, 8, 'Mercedes'),
(951, 8, 'Mocoretá'),
(952, 8, 'Mte. Caseros'),
(953, 8, 'Nueve de Julio'),
(954, 8, 'Palmar Grande'),
(955, 8, 'Parada Pucheta'),
(956, 8, 'Paso de La Patria'),
(957, 8, 'Paso de Los Libres'),
(958, 8, 'Pedro R. Fernandez'),
(959, 8, 'Perugorría'),
(960, 8, 'Pueblo Libertador'),
(961, 8, 'Ramada Paso'),
(962, 8, 'Riachuelo'),
(963, 8, 'Saladas'),
(964, 8, 'San Antonio'),
(965, 8, 'San Carlos'),
(966, 8, 'San Cosme'),
(967, 8, 'San Lorenzo'),
(968, 8, '20 del Palmar'),
(969, 8, 'San Miguel'),
(970, 8, 'San Roque'),
(971, 8, 'Santa Ana'),
(972, 8, 'Santa Lucía'),
(973, 8, 'Santo Tomé'),
(974, 8, 'Sauce'),
(975, 8, 'Tabay'),
(976, 8, 'Tapebicuá'),
(977, 8, 'Tatacua'),
(978, 8, 'Virasoro'),
(979, 8, 'Yapeyú'),
(980, 8, 'Yataití Calle'),
(981, 9, 'Alarcón'),
(982, 9, 'Alcaraz'),
(983, 9, 'Alcaraz N.'),
(984, 9, 'Alcaraz S.'),
(985, 9, 'Aldea Asunción'),
(986, 9, 'Aldea Brasilera'),
(987, 9, 'Aldea Elgenfeld'),
(988, 9, 'Aldea Grapschental'),
(989, 9, 'Aldea Ma. Luisa'),
(990, 9, 'Aldea Protestante'),
(991, 9, 'Aldea Salto'),
(992, 9, 'Aldea San Antonio (G)'),
(993, 9, 'Aldea San Antonio (P)'),
(994, 9, 'Aldea 19'),
(995, 9, 'Aldea San Miguel'),
(996, 9, 'Aldea San Rafael'),
(997, 9, 'Aldea Spatzenkutter'),
(998, 9, 'Aldea Sta. María'),
(999, 9, 'Aldea Sta. Rosa'),
(1000, 9, 'Aldea Valle María'),
(1001, 9, 'Altamirano Sur'),
(1002, 9, 'Antelo'),
(1003, 9, 'Antonio Tomás'),
(1004, 9, 'Aranguren'),
(1005, 9, 'Arroyo Barú'),
(1006, 9, 'Arroyo Burgos'),
(1007, 9, 'Arroyo Clé'),
(1008, 9, 'Arroyo Corralito'),
(1009, 9, 'Arroyo del Medio'),
(1010, 9, 'Arroyo Maturrango'),
(1011, 9, 'Arroyo Palo Seco'),
(1012, 9, 'Banderas'),
(1013, 9, 'Basavilbaso'),
(1014, 9, 'Betbeder'),
(1015, 9, 'Bovril'),
(1016, 9, 'Caseros'),
(1017, 9, 'Ceibas'),
(1018, 9, 'Cerrito'),
(1019, 9, 'Chajarí'),
(1020, 9, 'Chilcas'),
(1021, 9, 'Clodomiro Ledesma'),
(1022, 9, 'Col. Alemana'),
(1023, 9, 'Col. Avellaneda'),
(1024, 9, 'Col. Avigdor'),
(1025, 9, 'Col. Ayuí'),
(1026, 9, 'Col. Baylina'),
(1027, 9, 'Col. Carrasco'),
(1028, 9, 'Col. Celina'),
(1029, 9, 'Col. Cerrito'),
(1030, 9, 'Col. Crespo'),
(1031, 9, 'Col. Elia'),
(1032, 9, 'Col. Ensayo'),
(1033, 9, 'Col. Gral. Roca'),
(1034, 9, 'Col. La Argentina'),
(1035, 9, 'Col. Merou'),
(1036, 9, 'Col. Oficial Nª3'),
(1037, 9, 'Col. Oficial Nº13'),
(1038, 9, 'Col. Oficial Nº14'),
(1039, 9, 'Col. Oficial Nº5'),
(1040, 9, 'Col. Reffino'),
(1041, 9, 'Col. Tunas'),
(1042, 9, 'Col. Viraró'),
(1043, 9, 'Colón'),
(1044, 9, 'Concepción del Uruguay'),
(1045, 9, 'Concordia'),
(1046, 9, 'Conscripto Bernardi'),
(1047, 9, 'Costa Grande'),
(1048, 9, 'Costa San Antonio'),
(1049, 9, 'Costa Uruguay N.'),
(1050, 9, 'Costa Uruguay S.'),
(1051, 9, 'Crespo'),
(1052, 9, 'Crucecitas 3ª'),
(1053, 9, 'Crucecitas 7ª'),
(1054, 9, 'Crucecitas 8ª'),
(1055, 9, 'Cuchilla Redonda'),
(1056, 9, 'Curtiembre'),
(1057, 9, 'Diamante'),
(1058, 9, 'Distrito 6º'),
(1059, 9, 'Distrito Chañar'),
(1060, 9, 'Distrito Chiqueros'),
(1061, 9, 'Distrito Cuarto'),
(1062, 9, 'Distrito Diego López'),
(1063, 9, 'Distrito Pajonal'),
(1064, 9, 'Distrito Sauce'),
(1065, 9, 'Distrito Tala'),
(1066, 9, 'Distrito Talitas'),
(1067, 9, 'Don Cristóbal 1ª Sección'),
(1068, 9, 'Don Cristóbal 2ª Sección'),
(1069, 9, 'Durazno'),
(1070, 9, 'El Cimarrón'),
(1071, 9, 'El Gramillal'),
(1072, 9, 'El Palenque'),
(1073, 9, 'El Pingo'),
(1074, 9, 'El Quebracho'),
(1075, 9, 'El Redomón'),
(1076, 9, 'El Solar'),
(1077, 9, 'Enrique Carbo'),
(1078, 9, '9'),
(1079, 9, 'Espinillo N.'),
(1080, 9, 'Estación Campos'),
(1081, 9, 'Estación Escriña'),
(1082, 9, 'Estación Lazo'),
(1083, 9, 'Estación Raíces'),
(1084, 9, 'Estación Yerúa'),
(1085, 9, 'Estancia Grande'),
(1086, 9, 'Estancia Líbaros'),
(1087, 9, 'Estancia Racedo'),
(1088, 9, 'Estancia Solá'),
(1089, 9, 'Estancia Yuquerí'),
(1090, 9, 'Estaquitas'),
(1091, 9, 'Faustino M. Parera'),
(1092, 9, 'Febre'),
(1093, 9, 'Federación'),
(1094, 9, 'Federal'),
(1095, 9, 'Gdor. Echagüe'),
(1096, 9, 'Gdor. Mansilla'),
(1097, 9, 'Gilbert'),
(1098, 9, 'González Calderón'),
(1099, 9, 'Gral. Almada'),
(1100, 9, 'Gral. Alvear'),
(1101, 9, 'Gral. Campos'),
(1102, 9, 'Gral. Galarza'),
(1103, 9, 'Gral. Ramírez'),
(1104, 9, 'Gualeguay'),
(1105, 9, 'Gualeguaychú'),
(1106, 9, 'Gualeguaycito'),
(1107, 9, 'Guardamonte'),
(1108, 9, 'Hambis'),
(1109, 9, 'Hasenkamp'),
(1110, 9, 'Hernandarias'),
(1111, 9, 'Hernández'),
(1112, 9, 'Herrera'),
(1113, 9, 'Hinojal'),
(1114, 9, 'Hocker'),
(1115, 9, 'Ing. Sajaroff'),
(1116, 9, 'Irazusta'),
(1117, 9, 'Isletas'),
(1118, 9, 'J.J De Urquiza'),
(1119, 9, 'Jubileo'),
(1120, 9, 'La Clarita'),
(1121, 9, 'La Criolla'),
(1122, 9, 'La Esmeralda'),
(1123, 9, 'La Florida'),
(1124, 9, 'La Fraternidad'),
(1125, 9, 'La Hierra'),
(1126, 9, 'La Ollita'),
(1127, 9, 'La Paz'),
(1128, 9, 'La Picada'),
(1129, 9, 'La Providencia'),
(1130, 9, 'La Verbena'),
(1131, 9, 'Laguna Benítez'),
(1132, 9, 'Larroque'),
(1133, 9, 'Las Cuevas'),
(1134, 9, 'Las Garzas'),
(1135, 9, 'Las Guachas'),
(1136, 9, 'Las Mercedes'),
(1137, 9, 'Las Moscas'),
(1138, 9, 'Las Mulitas'),
(1139, 9, 'Las Toscas'),
(1140, 9, 'Laurencena'),
(1141, 9, 'Libertador San Martín'),
(1142, 9, 'Loma Limpia'),
(1143, 9, 'Los Ceibos'),
(1144, 9, 'Los Charruas'),
(1145, 9, 'Los Conquistadores'),
(1146, 9, 'Lucas González'),
(1147, 9, 'Lucas N.'),
(1148, 9, 'Lucas S. 1ª'),
(1149, 9, 'Lucas S. 2ª'),
(1150, 9, 'Maciá'),
(1151, 9, 'María Grande'),
(1152, 9, 'María Grande 2ª'),
(1153, 9, 'Médanos'),
(1154, 9, 'Mojones N.'),
(1155, 9, 'Mojones S.'),
(1156, 9, 'Molino Doll'),
(1157, 9, 'Monte Redondo'),
(1158, 9, 'Montoya'),
(1159, 9, 'Mulas Grandes'),
(1160, 9, 'Ñancay'),
(1161, 9, 'Nogoyá'),
(1162, 9, 'Nueva Escocia'),
(1163, 9, 'Nueva Vizcaya'),
(1164, 9, 'Ombú'),
(1165, 9, 'Oro Verde'),
(1166, 9, 'Paraná'),
(1167, 9, 'Pasaje Guayaquil'),
(1168, 9, 'Pasaje Las Tunas'),
(1169, 9, 'Paso de La Arena'),
(1170, 9, 'Paso de La Laguna'),
(1171, 9, 'Paso de Las Piedras'),
(1172, 9, 'Paso Duarte'),
(1173, 9, 'Pastor Britos'),
(1174, 9, 'Pedernal'),
(1175, 9, 'Perdices'),
(1176, 9, 'Picada Berón'),
(1177, 9, 'Piedras Blancas'),
(1178, 9, 'Primer Distrito Cuchilla'),
(1179, 9, 'Primero de Mayo'),
(1180, 9, 'Pronunciamiento'),
(1181, 9, 'Pto. Algarrobo'),
(1182, 9, 'Pto. Ibicuy'),
(1183, 9, 'Pueblo Brugo'),
(1184, 9, 'Pueblo Cazes'),
(1185, 9, 'Pueblo Gral. Belgrano'),
(1186, 9, 'Pueblo Liebig'),
(1187, 9, 'Puerto Yeruá'),
(1188, 9, 'Punta del Monte'),
(1189, 9, 'Quebracho'),
(1190, 9, 'Quinto Distrito'),
(1191, 9, 'Raices Oeste'),
(1192, 9, 'Rincón de Nogoyá'),
(1193, 9, 'Rincón del Cinto'),
(1194, 9, 'Rincón del Doll'),
(1195, 9, 'Rincón del Gato'),
(1196, 9, 'Rocamora'),
(1197, 9, 'Rosario del Tala'),
(1198, 9, 'San Benito'),
(1199, 9, 'San Cipriano'),
(1200, 9, 'San Ernesto'),
(1201, 9, 'San Gustavo'),
(1202, 9, 'San Jaime'),
(1203, 9, 'San José'),
(1204, 9, 'San José de Feliciano'),
(1205, 9, 'San Justo'),
(1206, 9, 'San Marcial'),
(1207, 9, 'San Pedro'),
(1208, 9, 'San Ramírez'),
(1209, 9, 'San Ramón'),
(1210, 9, 'San Roque'),
(1211, 9, 'San Salvador'),
(1212, 9, 'San Víctor'),
(1213, 9, 'Santa Ana'),
(1214, 9, 'Santa Anita'),
(1215, 9, 'Santa Elena'),
(1216, 9, 'Santa Lucía'),
(1217, 9, 'Santa Luisa'),
(1218, 9, 'Sauce de Luna'),
(1219, 9, 'Sauce Montrull'),
(1220, 9, 'Sauce Pinto'),
(1221, 9, 'Sauce Sur'),
(1222, 9, 'Seguí'),
(1223, 9, 'Sir Leonard'),
(1224, 9, 'Sosa'),
(1225, 9, 'Tabossi'),
(1226, 9, 'Tezanos Pinto'),
(1227, 9, 'Ubajay'),
(1228, 9, 'Urdinarrain'),
(1229, 9, 'Veinte de Septiembre'),
(1230, 9, 'Viale'),
(1231, 9, 'Victoria'),
(1232, 9, 'Villa Clara'),
(1233, 9, 'Villa del Rosario'),
(1234, 9, 'Villa Domínguez'),
(1235, 9, 'Villa Elisa'),
(1236, 9, 'Villa Fontana'),
(1237, 9, 'Villa Gdor. Etchevehere'),
(1238, 9, 'Villa Mantero'),
(1239, 9, 'Villa Paranacito'),
(1240, 9, 'Villa Urquiza'),
(1241, 9, 'Villaguay'),
(1242, 9, 'Walter Moss'),
(1243, 9, 'Yacaré'),
(1244, 9, 'Yeso Oeste'),
(1245, 10, 'Buena Vista'),
(1246, 10, 'Clorinda'),
(1247, 10, 'Col. Pastoril'),
(1248, 10, 'Cte. Fontana'),
(1249, 10, 'El Colorado'),
(1250, 10, 'El Espinillo'),
(1251, 10, 'Estanislao Del Campo'),
(1252, 10, '10'),
(1253, 10, 'Fortín Lugones'),
(1254, 10, 'Gral. Lucio V. Mansilla'),
(1255, 10, 'Gral. Manuel Belgrano'),
(1256, 10, 'Gral. Mosconi'),
(1257, 10, 'Gran Guardia'),
(1258, 10, 'Herradura'),
(1259, 10, 'Ibarreta'),
(1260, 10, 'Ing. Juárez'),
(1261, 10, 'Laguna Blanca'),
(1262, 10, 'Laguna Naick Neck'),
(1263, 10, 'Laguna Yema'),
(1264, 10, 'Las Lomitas'),
(1265, 10, 'Los Chiriguanos'),
(1266, 10, 'Mayor V. Villafañe'),
(1267, 10, 'Misión San Fco.'),
(1268, 10, 'Palo Santo'),
(1269, 10, 'Pirané'),
(1270, 10, 'Pozo del Maza'),
(1271, 10, 'Riacho He-He'),
(1272, 10, 'San Hilario'),
(1273, 10, 'San Martín II'),
(1274, 10, 'Siete Palmas'),
(1275, 10, 'Subteniente Perín'),
(1276, 10, 'Tres Lagunas'),
(1277, 10, 'Villa Dos Trece'),
(1278, 10, 'Villa Escolar'),
(1279, 10, 'Villa Gral. Güemes'),
(1280, 11, 'Abdon Castro Tolay'),
(1281, 11, 'Abra Pampa'),
(1282, 11, 'Abralaite'),
(1283, 11, 'Aguas Calientes'),
(1284, 11, 'Arrayanal'),
(1285, 11, 'Barrios'),
(1286, 11, 'Caimancito'),
(1287, 11, 'Calilegua'),
(1288, 11, 'Cangrejillos'),
(1289, 11, 'Caspala'),
(1290, 11, 'Catuá'),
(1291, 11, 'Cieneguillas'),
(1292, 11, 'Coranzulli'),
(1293, 11, 'Cusi-Cusi'),
(1294, 11, 'El Aguilar'),
(1295, 11, 'El Carmen'),
(1296, 11, 'El Cóndor'),
(1297, 11, 'El Fuerte'),
(1298, 11, 'El Piquete'),
(1299, 11, 'El Talar'),
(1300, 11, 'Fraile Pintado'),
(1301, 11, 'Hipólito Yrigoyen'),
(1302, 11, 'Huacalera'),
(1303, 11, 'Humahuaca'),
(1304, 11, 'La Esperanza'),
(1305, 11, 'La Mendieta'),
(1306, 11, 'La Quiaca'),
(1307, 11, 'Ledesma'),
(1308, 11, 'Libertador Gral. San Martin'),
(1309, 11, 'Maimara'),
(1310, 11, 'Mina Pirquitas'),
(1311, 11, 'Monterrico'),
(1312, 11, 'Palma Sola'),
(1313, 11, 'Palpalá'),
(1314, 11, 'Pampa Blanca'),
(1315, 11, 'Pampichuela'),
(1316, 11, 'Perico'),
(1317, 11, 'Puesto del Marqués'),
(1318, 11, 'Puesto Viejo'),
(1319, 11, 'Pumahuasi'),
(1320, 11, 'Purmamarca'),
(1321, 11, 'Rinconada'),
(1322, 11, 'Rodeitos'),
(1323, 11, 'Rosario de Río Grande'),
(1324, 11, 'San Antonio'),
(1325, 11, 'San Francisco'),
(1326, 11, 'San Pedro'),
(1327, 11, 'San Rafael'),
(1328, 11, 'San Salvador'),
(1329, 11, 'Santa Ana'),
(1330, 11, 'Santa Catalina'),
(1331, 11, 'Santa Clara'),
(1332, 11, 'Susques'),
(1333, 11, 'Tilcara'),
(1334, 11, 'Tres Cruces'),
(1335, 11, 'Tumbaya'),
(1336, 11, 'Valle Grande'),
(1337, 11, 'Vinalito'),
(1338, 11, 'Volcán'),
(1339, 11, 'Yala'),
(1340, 11, 'Yaví'),
(1341, 11, 'Yuto'),
(1342, 12, 'Abramo'),
(1343, 12, 'Adolfo Van Praet'),
(1344, 12, 'Agustoni'),
(1345, 12, 'Algarrobo del Aguila'),
(1346, 12, 'Alpachiri'),
(1347, 12, 'Alta Italia'),
(1348, 12, 'Anguil'),
(1349, 12, 'Arata'),
(1350, 12, 'Ataliva Roca'),
(1351, 12, 'Bernardo Larroude'),
(1352, 12, 'Bernasconi'),
(1353, 12, 'Caleufú'),
(1354, 12, 'Carro Quemado'),
(1355, 12, 'Catriló'),
(1356, 12, 'Ceballos'),
(1357, 12, 'Chacharramendi'),
(1358, 12, 'Col. Barón'),
(1359, 12, 'Col. Santa María'),
(1360, 12, 'Conhelo'),
(1361, 12, 'Coronel Hilario Lagos'),
(1362, 12, 'Cuchillo-Có'),
(1363, 12, 'Doblas'),
(1364, 12, 'Dorila'),
(1365, 12, 'Eduardo Castex'),
(1366, 12, 'Embajador Martini'),
(1367, 12, 'Falucho'),
(1368, 12, 'Gral. Acha'),
(1369, 12, 'Gral. Manuel Campos'),
(1370, 12, 'Gral. Pico'),
(1371, 12, 'Guatraché'),
(1372, 12, 'Ing. Luiggi'),
(1373, 12, 'Intendente Alvear'),
(1374, 12, 'Jacinto Arauz'),
(1375, 12, 'La Adela'),
(1376, 12, 'La Humada'),
(1377, 12, 'La Maruja'),
(1378, 12, '12'),
(1379, 12, 'La Reforma'),
(1380, 12, 'Limay Mahuida'),
(1381, 12, 'Lonquimay'),
(1382, 12, 'Loventuel'),
(1383, 12, 'Luan Toro'),
(1384, 12, 'Macachín'),
(1385, 12, 'Maisonnave'),
(1386, 12, 'Mauricio Mayer'),
(1387, 12, 'Metileo'),
(1388, 12, 'Miguel Cané'),
(1389, 12, 'Miguel Riglos'),
(1390, 12, 'Monte Nievas'),
(1391, 12, 'Parera'),
(1392, 12, 'Perú'),
(1393, 12, 'Pichi-Huinca'),
(1394, 12, 'Puelches'),
(1395, 12, 'Puelén'),
(1396, 12, 'Quehue'),
(1397, 12, 'Quemú Quemú'),
(1398, 12, 'Quetrequén'),
(1399, 12, 'Rancul'),
(1400, 12, 'Realicó'),
(1401, 12, 'Relmo'),
(1402, 12, 'Rolón'),
(1403, 12, 'Rucanelo'),
(1404, 12, 'Sarah'),
(1405, 12, 'Speluzzi'),
(1406, 12, 'Sta. Isabel'),
(1407, 12, 'Sta. Rosa'),
(1408, 12, 'Sta. Teresa'),
(1409, 12, 'Telén'),
(1410, 12, 'Toay'),
(1411, 12, 'Tomas M. de Anchorena'),
(1412, 12, 'Trenel'),
(1413, 12, 'Unanue'),
(1414, 12, 'Uriburu'),
(1415, 12, 'Veinticinco de Mayo'),
(1416, 12, 'Vertiz'),
(1417, 12, 'Victorica'),
(1418, 12, 'Villa Mirasol'),
(1419, 12, 'Winifreda'),
(1420, 13, 'Arauco'),
(1421, 13, 'Capital'),
(1422, 13, 'Castro Barros'),
(1423, 13, 'Chamical'),
(1424, 13, 'Chilecito'),
(1425, 13, 'Coronel F. Varela'),
(1426, 13, 'Famatina'),
(1427, 13, 'Gral. A.V.Peñaloza'),
(1428, 13, 'Gral. Belgrano'),
(1429, 13, 'Gral. J.F. Quiroga'),
(1430, 13, 'Gral. Lamadrid'),
(1431, 13, 'Gral. Ocampo'),
(1432, 13, 'Gral. San Martín'),
(1433, 13, 'Independencia'),
(1434, 13, 'Rosario Penaloza'),
(1435, 13, 'San Blas de Los Sauces'),
(1436, 13, 'Sanagasta'),
(1437, 13, 'Vinchina'),
(1438, 14, 'Capital'),
(1439, 14, 'Chacras de Coria'),
(1440, 14, 'Dorrego'),
(1441, 14, 'Gllen'),
(1442, 14, 'Godoy Cruz'),
(1443, 14, 'Gral. Alvear'),
(1444, 14, 'Guaymallén'),
(1445, 14, 'Junín'),
(1446, 14, 'La Paz'),
(1447, 14, 'Las Heras'),
(1448, 14, 'Lavalle'),
(1449, 14, 'Luján'),
(1450, 14, 'Luján De Cuyo'),
(1451, 14, 'Maipú'),
(1452, 14, 'Malargüe'),
(1453, 14, 'Rivadavia'),
(1454, 14, 'San Carlos'),
(1455, 14, 'San Martín'),
(1456, 14, 'San Rafael'),
(1457, 14, 'Sta. Rosa'),
(1458, 14, 'Tunuyán'),
(1459, 14, 'Tupungato'),
(1460, 14, 'Villa Nueva'),
(1461, 15, 'Alba Posse'),
(1462, 15, 'Almafuerte'),
(1463, 15, 'Apóstoles'),
(1464, 15, 'Aristóbulo Del Valle'),
(1465, 15, 'Arroyo Del Medio'),
(1466, 15, 'Azara'),
(1467, 15, 'Bdo. De Irigoyen'),
(1468, 15, 'Bonpland'),
(1469, 15, 'Caá Yari'),
(1470, 15, 'Campo Grande'),
(1471, 15, 'Campo Ramón'),
(1472, 15, 'Campo Viera'),
(1473, 15, 'Candelaria'),
(1474, 15, 'Capioví'),
(1475, 15, 'Caraguatay'),
(1476, 15, 'Cdte. Guacurarí'),
(1477, 15, 'Cerro Azul'),
(1478, 15, 'Cerro Corá'),
(1479, 15, 'Col. Alberdi'),
(1480, 15, 'Col. Aurora'),
(1481, 15, 'Col. Delicia'),
(1482, 15, 'Col. Polana'),
(1483, 15, 'Col. Victoria'),
(1484, 15, 'Col. Wanda'),
(1485, 15, 'Concepción De La Sierra'),
(1486, 15, 'Corpus'),
(1487, 15, 'Dos Arroyos'),
(1488, 15, 'Dos de Mayo'),
(1489, 15, 'El Alcázar'),
(1490, 15, 'El Dorado'),
(1491, 15, 'El Soberbio'),
(1492, 15, 'Esperanza'),
(1493, 15, 'F. Ameghino'),
(1494, 15, 'Fachinal'),
(1495, 15, 'Garuhapé'),
(1496, 15, 'Garupá'),
(1497, 15, 'Gdor. López'),
(1498, 15, 'Gdor. Roca'),
(1499, 15, 'Gral. Alvear'),
(1500, 15, 'Gral. Urquiza'),
(1501, 15, 'Guaraní'),
(1502, 15, 'H. Yrigoyen'),
(1503, 15, 'Iguazú'),
(1504, 15, 'Itacaruaré'),
(1505, 15, 'Jardín América'),
(1506, 15, 'Leandro N. Alem'),
(1507, 15, 'Libertad'),
(1508, 15, 'Loreto'),
(1509, 15, 'Los Helechos'),
(1510, 15, 'Mártires'),
(1511, 15, '15'),
(1512, 15, 'Mojón Grande'),
(1513, 15, 'Montecarlo'),
(1514, 15, 'Nueve de Julio'),
(1515, 15, 'Oberá'),
(1516, 15, 'Olegario V. Andrade'),
(1517, 15, 'Panambí'),
(1518, 15, 'Posadas'),
(1519, 15, 'Profundidad'),
(1520, 15, 'Pto. Iguazú'),
(1521, 15, 'Pto. Leoni'),
(1522, 15, 'Pto. Piray'),
(1523, 15, 'Pto. Rico'),
(1524, 15, 'Ruiz de Montoya'),
(1525, 15, 'San Antonio'),
(1526, 15, 'San Ignacio'),
(1527, 15, 'San Javier'),
(1528, 15, 'San José'),
(1529, 15, 'San Martín'),
(1530, 15, 'San Pedro'),
(1531, 15, 'San Vicente'),
(1532, 15, 'Santiago De Liniers'),
(1533, 15, 'Santo Pipo'),
(1534, 15, 'Sta. Ana'),
(1535, 15, 'Sta. María'),
(1536, 15, 'Tres Capones'),
(1537, 15, 'Veinticinco de Mayo'),
(1538, 15, 'Wanda'),
(1539, 16, 'Aguada San Roque'),
(1540, 16, 'Aluminé'),
(1541, 16, 'Andacollo'),
(1542, 16, 'Añelo'),
(1543, 16, 'Bajada del Agrio'),
(1544, 16, 'Barrancas'),
(1545, 16, 'Buta Ranquil'),
(1546, 16, 'Capital'),
(1547, 16, 'Caviahué'),
(1548, 16, 'Centenario'),
(1549, 16, 'Chorriaca'),
(1550, 16, 'Chos Malal'),
(1551, 16, 'Cipolletti'),
(1552, 16, 'Covunco Abajo'),
(1553, 16, 'Coyuco Cochico'),
(1554, 16, 'Cutral Có'),
(1555, 16, 'El Cholar'),
(1556, 16, 'El Huecú'),
(1557, 16, 'El Sauce'),
(1558, 16, 'Guañacos'),
(1559, 16, 'Huinganco'),
(1560, 16, 'Las Coloradas'),
(1561, 16, 'Las Lajas'),
(1562, 16, 'Las Ovejas'),
(1563, 16, 'Loncopué'),
(1564, 16, 'Los Catutos'),
(1565, 16, 'Los Chihuidos'),
(1566, 16, 'Los Miches'),
(1567, 16, 'Manzano Amargo'),
(1568, 16, '16'),
(1569, 16, 'Octavio Pico'),
(1570, 16, 'Paso Aguerre'),
(1571, 16, 'Picún Leufú'),
(1572, 16, 'Piedra del Aguila'),
(1573, 16, 'Pilo Lil'),
(1574, 16, 'Plaza Huincul'),
(1575, 16, 'Plottier'),
(1576, 16, 'Quili Malal'),
(1577, 16, 'Ramón Castro'),
(1578, 16, 'Rincón de Los Sauces'),
(1579, 16, 'San Martín de Los Andes'),
(1580, 16, 'San Patricio del Chañar'),
(1581, 16, 'Santo Tomás'),
(1582, 16, 'Sauzal Bonito'),
(1583, 16, 'Senillosa'),
(1584, 16, 'Taquimilán'),
(1585, 16, 'Tricao Malal'),
(1586, 16, 'Varvarco'),
(1587, 16, 'Villa Curí Leuvu'),
(1588, 16, 'Villa del Nahueve'),
(1589, 16, 'Villa del Puente Picún Leuvú'),
(1590, 16, 'Villa El Chocón'),
(1591, 16, 'Villa La Angostura'),
(1592, 16, 'Villa Pehuenia'),
(1593, 16, 'Villa Traful'),
(1594, 16, 'Vista Alegre'),
(1595, 16, 'Zapala'),
(1596, 17, 'Aguada Cecilio'),
(1597, 17, 'Aguada de Guerra'),
(1598, 17, 'Allén'),
(1599, 17, 'Arroyo de La Ventana'),
(1600, 17, 'Arroyo Los Berros'),
(1601, 17, 'Bariloche'),
(1602, 17, 'Calte. Cordero'),
(1603, 17, 'Campo Grande'),
(1604, 17, 'Catriel'),
(1605, 17, 'Cerro Policía'),
(1606, 17, 'Cervantes'),
(1607, 17, 'Chelforo'),
(1608, 17, 'Chimpay'),
(1609, 17, 'Chinchinales'),
(1610, 17, 'Chipauquil'),
(1611, 17, 'Choele Choel'),
(1612, 17, 'Cinco Saltos'),
(1613, 17, 'Cipolletti'),
(1614, 17, 'Clemente Onelli'),
(1615, 17, 'Colán Conhue'),
(1616, 17, 'Comallo'),
(1617, 17, 'Comicó'),
(1618, 17, 'Cona Niyeu'),
(1619, 17, 'Coronel Belisle'),
(1620, 17, 'Cubanea'),
(1621, 17, 'Darwin'),
(1622, 17, 'Dina Huapi'),
(1623, 17, 'El Bolsón'),
(1624, 17, 'El Caín'),
(1625, 17, 'El Manso'),
(1626, 17, 'Gral. Conesa'),
(1627, 17, 'Gral. Enrique Godoy'),
(1628, 17, 'Gral. Fernandez Oro'),
(1629, 17, 'Gral. Roca'),
(1630, 17, 'Guardia Mitre'),
(1631, 17, 'Ing. Huergo'),
(1632, 17, 'Ing. Jacobacci'),
(1633, 17, 'Laguna Blanca'),
(1634, 17, 'Lamarque'),
(1635, 17, 'Las Grutas'),
(1636, 17, 'Los Menucos'),
(1637, 17, 'Luis Beltrán'),
(1638, 17, 'Mainqué'),
(1639, 17, 'Mamuel Choique'),
(1640, 17, 'Maquinchao'),
(1641, 17, 'Mencué'),
(1642, 17, 'Mtro. Ramos Mexia'),
(1643, 17, 'Nahuel Niyeu'),
(1644, 17, 'Naupa Huen'),
(1645, 17, 'Ñorquinco'),
(1646, 17, 'Ojos de Agua'),
(1647, 17, 'Paso de Agua'),
(1648, 17, 'Paso Flores'),
(1649, 17, 'Peñas Blancas'),
(1650, 17, 'Pichi Mahuida'),
(1651, 17, 'Pilcaniyeu'),
(1652, 17, 'Pomona'),
(1653, 17, 'Prahuaniyeu'),
(1654, 17, 'Rincón Treneta'),
(1655, 17, 'Río Chico'),
(1656, 17, 'Río Colorado'),
(1657, 17, 'Roca'),
(1658, 17, 'San Antonio Oeste'),
(1659, 17, 'San Javier'),
(1660, 17, 'Sierra Colorada'),
(1661, 17, 'Sierra Grande'),
(1662, 17, 'Sierra Pailemán'),
(1663, 17, 'Valcheta'),
(1664, 17, 'Valle Azul'),
(1665, 17, 'Viedma'),
(1666, 17, 'Villa Llanquín'),
(1667, 17, 'Villa Mascardi'),
(1668, 17, 'Villa Regina'),
(1669, 17, 'Yaminué'),
(1670, 18, 'A. Saravia'),
(1671, 18, 'Aguaray'),
(1672, 18, 'Angastaco'),
(1673, 18, 'Animaná'),
(1674, 18, 'Cachi'),
(1675, 18, 'Cafayate'),
(1676, 18, 'Campo Quijano'),
(1677, 18, 'Campo Santo'),
(1678, 18, 'Capital'),
(1679, 18, 'Cerrillos'),
(1680, 18, 'Chicoana'),
(1681, 18, 'Col. Sta. Rosa'),
(1682, 18, 'Coronel Moldes'),
(1683, 18, 'El Bordo'),
(1684, 18, 'El Carril'),
(1685, 18, 'El Galpón'),
(1686, 18, 'El Jardín'),
(1687, 18, 'El Potrero'),
(1688, 18, 'El Quebrachal'),
(1689, 18, 'El Tala'),
(1690, 18, 'Embarcación'),
(1691, 18, 'Gral. Ballivian'),
(1692, 18, 'Gral. Güemes'),
(1693, 18, 'Gral. Mosconi'),
(1694, 18, 'Gral. Pizarro'),
(1695, 18, 'Guachipas'),
(1696, 18, 'Hipólito Yrigoyen'),
(1697, 18, 'Iruyá'),
(1698, 18, 'Isla De Cañas'),
(1699, 18, 'J. V. Gonzalez'),
(1700, 18, 'La Caldera'),
(1701, 18, 'La Candelaria'),
(1702, 18, 'La Merced'),
(1703, 18, 'La Poma'),
(1704, 18, 'La Viña'),
(1705, 18, 'Las Lajitas'),
(1706, 18, 'Los Toldos'),
(1707, 18, 'Metán'),
(1708, 18, 'Molinos'),
(1709, 18, 'Nazareno'),
(1710, 18, 'Orán'),
(1711, 18, 'Payogasta'),
(1712, 18, 'Pichanal'),
(1713, 18, 'Prof. S. Mazza'),
(1714, 18, 'Río Piedras'),
(1715, 18, 'Rivadavia Banda Norte'),
(1716, 18, 'Rivadavia Banda Sur'),
(1717, 18, 'Rosario de La Frontera'),
(1718, 18, 'Rosario de Lerma'),
(1719, 18, 'Saclantás'),
(1720, 18, '18'),
(1721, 18, 'San Antonio'),
(1722, 18, 'San Carlos'),
(1723, 18, 'San José De Metán'),
(1724, 18, 'San Ramón'),
(1725, 18, 'Santa Victoria E.'),
(1726, 18, 'Santa Victoria O.'),
(1727, 18, 'Tartagal'),
(1728, 18, 'Tolar Grande'),
(1729, 18, 'Urundel'),
(1730, 18, 'Vaqueros'),
(1731, 18, 'Villa San Lorenzo'),
(1732, 19, 'Albardón'),
(1733, 19, 'Angaco'),
(1734, 19, 'Calingasta'),
(1735, 19, 'Capital'),
(1736, 19, 'Caucete'),
(1737, 19, 'Chimbas'),
(1738, 19, 'Iglesia'),
(1739, 19, 'Jachal'),
(1740, 19, 'Nueve de Julio'),
(1741, 19, 'Pocito'),
(1742, 19, 'Rawson'),
(1743, 19, 'Rivadavia'),
(1744, 19, '19'),
(1745, 19, 'San Martín'),
(1746, 19, 'Santa Lucía'),
(1747, 19, 'Sarmiento'),
(1748, 19, 'Ullum'),
(1749, 19, 'Valle Fértil'),
(1750, 19, 'Veinticinco de Mayo'),
(1751, 19, 'Zonda'),
(1752, 20, 'Alto Pelado'),
(1753, 20, 'Alto Pencoso'),
(1754, 20, 'Anchorena'),
(1755, 20, 'Arizona'),
(1756, 20, 'Bagual'),
(1757, 20, 'Balde'),
(1758, 20, 'Batavia'),
(1759, 20, 'Beazley'),
(1760, 20, 'Buena Esperanza'),
(1761, 20, 'Candelaria'),
(1762, 20, 'Capital'),
(1763, 20, 'Carolina'),
(1764, 20, 'Carpintería'),
(1765, 20, 'Concarán'),
(1766, 20, 'Cortaderas'),
(1767, 20, 'El Morro'),
(1768, 20, 'El Trapiche'),
(1769, 20, 'El Volcán'),
(1770, 20, 'Fortín El Patria'),
(1771, 20, 'Fortuna'),
(1772, 20, 'Fraga'),
(1773, 20, 'Juan Jorba'),
(1774, 20, 'Juan Llerena'),
(1775, 20, 'Juana Koslay'),
(1776, 20, 'Justo Daract'),
(1777, 20, 'La Calera'),
(1778, 20, 'La Florida'),
(1779, 20, 'La Punilla'),
(1780, 20, 'La Toma'),
(1781, 20, 'Lafinur'),
(1782, 20, 'Las Aguadas'),
(1783, 20, 'Las Chacras'),
(1784, 20, 'Las Lagunas'),
(1785, 20, 'Las Vertientes'),
(1786, 20, 'Lavaisse'),
(1787, 20, 'Leandro N. Alem'),
(1788, 20, 'Los Molles'),
(1789, 20, 'Luján'),
(1790, 20, 'Mercedes'),
(1791, 20, 'Merlo'),
(1792, 20, 'Naschel'),
(1793, 20, 'Navia'),
(1794, 20, 'Nogolí'),
(1795, 20, 'Nueva Galia'),
(1796, 20, 'Papagayos'),
(1797, 20, 'Paso Grande'),
(1798, 20, 'Potrero de Los Funes'),
(1799, 20, 'Quines'),
(1800, 20, 'Renca'),
(1801, 20, 'Saladillo'),
(1802, 20, 'San Francisco'),
(1803, 20, 'San Gerónimo'),
(1804, 20, 'San Martín'),
(1805, 20, 'San Pablo'),
(1806, 20, 'Santa Rosa de Conlara'),
(1807, 20, 'Talita'),
(1808, 20, 'Tilisarao'),
(1809, 20, 'Unión'),
(1810, 20, 'Villa de La Quebrada'),
(1811, 20, 'Villa de Praga'),
(1812, 20, 'Villa del Carmen'),
(1813, 20, 'Villa Gral. Roca'),
(1814, 20, 'Villa Larca'),
(1815, 20, 'Villa Mercedes'),
(1816, 20, 'Zanjitas'),
(1817, 21, 'Calafate'),
(1818, 21, 'Caleta Olivia'),
(1819, 21, 'Cañadón Seco'),
(1820, 21, 'Comandante Piedrabuena'),
(1821, 21, 'El Calafate'),
(1822, 21, 'El Chaltén'),
(1823, 21, 'Gdor. Gregores'),
(1824, 21, 'Hipólito Yrigoyen'),
(1825, 21, 'Jaramillo'),
(1826, 21, 'Koluel Kaike'),
(1827, 21, 'Las Heras'),
(1828, 21, 'Los Antiguos'),
(1829, 21, 'Perito Moreno'),
(1830, 21, 'Pico Truncado'),
(1831, 21, 'Pto. Deseado'),
(1832, 21, 'Pto. San Julián'),
(1833, 21, 'Pto. 21'),
(1834, 21, 'Río Cuarto'),
(1835, 21, 'Río Gallegos'),
(1836, 21, 'Río Turbio'),
(1837, 21, 'Tres Lagos'),
(1838, 21, 'Veintiocho De Noviembre'),
(1839, 22, 'Aarón Castellanos'),
(1840, 22, 'Acebal'),
(1841, 22, 'Aguará Grande'),
(1842, 22, 'Albarellos'),
(1843, 22, 'Alcorta'),
(1844, 22, 'Aldao'),
(1845, 22, 'Alejandra'),
(1846, 22, 'Álvarez'),
(1847, 22, 'Ambrosetti'),
(1848, 22, 'Amenábar'),
(1849, 22, 'Angélica'),
(1850, 22, 'Angeloni'),
(1851, 22, 'Arequito'),
(1852, 22, 'Arminda'),
(1853, 22, 'Armstrong'),
(1854, 22, 'Arocena'),
(1855, 22, 'Arroyo Aguiar'),
(1856, 22, 'Arroyo Ceibal'),
(1857, 22, 'Arroyo Leyes'),
(1858, 22, 'Arroyo Seco'),
(1859, 22, 'Arrufó'),
(1860, 22, 'Arteaga'),
(1861, 22, 'Ataliva'),
(1862, 22, 'Aurelia'),
(1863, 22, 'Avellaneda'),
(1864, 22, 'Barrancas'),
(1865, 22, 'Bauer Y Sigel'),
(1866, 22, 'Bella Italia'),
(1867, 22, 'Berabevú'),
(1868, 22, 'Berna'),
(1869, 22, 'Bernardo de Irigoyen'),
(1870, 22, 'Bigand'),
(1871, 22, 'Bombal'),
(1872, 22, 'Bouquet'),
(1873, 22, 'Bustinza'),
(1874, 22, 'Cabal'),
(1875, 22, 'Cacique Ariacaiquin'),
(1876, 22, 'Cafferata'),
(1877, 22, 'Calchaquí'),
(1878, 22, 'Campo Andino'),
(1879, 22, 'Campo Piaggio'),
(1880, 22, 'Cañada de Gómez'),
(1881, 22, 'Cañada del Ucle'),
(1882, 22, 'Cañada Rica'),
(1883, 22, 'Cañada Rosquín'),
(1884, 22, 'Candioti'),
(1885, 22, 'Capital'),
(1886, 22, 'Capitán Bermúdez'),
(1887, 22, 'Capivara'),
(1888, 22, 'Carcarañá'),
(1889, 22, 'Carlos Pellegrini'),
(1890, 22, 'Carmen'),
(1891, 22, 'Carmen Del Sauce'),
(1892, 22, 'Carreras'),
(1893, 22, 'Carrizales'),
(1894, 22, 'Casalegno'),
(1895, 22, 'Casas'),
(1896, 22, 'Casilda'),
(1897, 22, 'Castelar'),
(1898, 22, 'Castellanos'),
(1899, 22, 'Cayastá'),
(1900, 22, 'Cayastacito'),
(1901, 22, 'Centeno'),
(1902, 22, 'Cepeda'),
(1903, 22, 'Ceres'),
(1904, 22, 'Chabás'),
(1905, 22, 'Chañar Ladeado'),
(1906, 22, 'Chapuy'),
(1907, 22, 'Chovet'),
(1908, 22, 'Christophersen'),
(1909, 22, 'Classon'),
(1910, 22, 'Cnel. Arnold'),
(1911, 22, 'Cnel. Bogado'),
(1912, 22, 'Cnel. Dominguez'),
(1913, 22, 'Cnel. Fraga'),
(1914, 22, 'Col. Aldao'),
(1915, 22, 'Col. Ana'),
(1916, 22, 'Col. Belgrano'),
(1917, 22, 'Col. Bicha'),
(1918, 22, 'Col. Bigand'),
(1919, 22, 'Col. Bossi'),
(1920, 22, 'Col. Cavour'),
(1921, 22, 'Col. Cello'),
(1922, 22, 'Col. Dolores'),
(1923, 22, 'Col. Dos Rosas'),
(1924, 22, 'Col. Durán'),
(1925, 22, 'Col. Iturraspe'),
(1926, 22, 'Col. Margarita'),
(1927, 22, 'Col. Mascias'),
(1928, 22, 'Col. Raquel'),
(1929, 22, 'Col. Rosa'),
(1930, 22, 'Col. San José'),
(1931, 22, 'Constanza'),
(1932, 22, 'Coronda'),
(1933, 22, 'Correa'),
(1934, 22, 'Crispi'),
(1935, 22, 'Cululú'),
(1936, 22, 'Curupayti'),
(1937, 22, 'Desvio Arijón'),
(1938, 22, 'Diaz'),
(1939, 22, 'Diego de Alvear'),
(1940, 22, 'Egusquiza'),
(1941, 22, 'El Arazá'),
(1942, 22, 'El Rabón'),
(1943, 22, 'El Sombrerito'),
(1944, 22, 'El Trébol'),
(1945, 22, 'Elisa'),
(1946, 22, 'Elortondo'),
(1947, 22, 'Emilia'),
(1948, 22, 'Empalme San Carlos'),
(1949, 22, 'Empalme Villa Constitucion'),
(1950, 22, 'Esmeralda'),
(1951, 22, 'Esperanza'),
(1952, 22, 'Estación Alvear'),
(1953, 22, 'Estacion Clucellas'),
(1954, 22, 'Esteban Rams'),
(1955, 22, 'Esther'),
(1956, 22, 'Esustolia'),
(1957, 22, 'Eusebia'),
(1958, 22, 'Felicia'),
(1959, 22, 'Fidela'),
(1960, 22, 'Fighiera'),
(1961, 22, 'Firmat'),
(1962, 22, 'Florencia'),
(1963, 22, 'Fortín Olmos'),
(1964, 22, 'Franck'),
(1965, 22, 'Fray Luis Beltrán'),
(1966, 22, 'Frontera'),
(1967, 22, 'Fuentes'),
(1968, 22, 'Funes'),
(1969, 22, 'Gaboto'),
(1970, 22, 'Galisteo'),
(1971, 22, 'Gálvez'),
(1972, 22, 'Garabalto'),
(1973, 22, 'Garibaldi'),
(1974, 22, 'Gato Colorado'),
(1975, 22, 'Gdor. Crespo'),
(1976, 22, 'Gessler'),
(1977, 22, 'Godoy'),
(1978, 22, 'Golondrina'),
(1979, 22, 'Gral. Gelly'),
(1980, 22, 'Gral. Lagos'),
(1981, 22, 'Granadero Baigorria'),
(1982, 22, 'Gregoria Perez De Denis'),
(1983, 22, 'Grutly'),
(1984, 22, 'Guadalupe N.'),
(1985, 22, 'Gödeken'),
(1986, 22, 'Helvecia'),
(1987, 22, 'Hersilia'),
(1988, 22, 'Hipatía'),
(1989, 22, 'Huanqueros'),
(1990, 22, 'Hugentobler'),
(1991, 22, 'Hughes'),
(1992, 22, 'Humberto 1º'),
(1993, 22, 'Humboldt'),
(1994, 22, 'Ibarlucea'),
(1995, 22, 'Ing. Chanourdie'),
(1996, 22, 'Intiyaco'),
(1997, 22, 'Ituzaingó'),
(1998, 22, 'Jacinto L. Aráuz'),
(1999, 22, 'Josefina'),
(2000, 22, 'Juan B. Molina'),
(2001, 22, 'Juan de Garay'),
(2002, 22, 'Juncal'),
(2003, 22, 'La Brava'),
(2004, 22, 'La Cabral'),
(2005, 22, 'La Camila'),
(2006, 22, 'La Chispa'),
(2007, 22, 'La Clara'),
(2008, 22, 'La Criolla'),
(2009, 22, 'La Gallareta'),
(2010, 22, 'La Lucila'),
(2011, 22, 'La Pelada'),
(2012, 22, 'La Penca'),
(2013, 22, 'La Rubia'),
(2014, 22, 'La Sarita'),
(2015, 22, 'La Vanguardia'),
(2016, 22, 'Labordeboy'),
(2017, 22, 'Laguna Paiva'),
(2018, 22, 'Landeta'),
(2019, 22, 'Lanteri'),
(2020, 22, 'Larrechea'),
(2021, 22, 'Las Avispas'),
(2022, 22, 'Las Bandurrias'),
(2023, 22, 'Las Garzas'),
(2024, 22, 'Las Palmeras'),
(2025, 22, 'Las Parejas'),
(2026, 22, 'Las Petacas'),
(2027, 22, 'Las Rosas'),
(2028, 22, 'Las Toscas'),
(2029, 22, 'Las Tunas'),
(2030, 22, 'Lazzarino'),
(2031, 22, 'Lehmann'),
(2032, 22, 'Llambi Campbell'),
(2033, 22, 'Logroño'),
(2034, 22, 'Loma Alta'),
(2035, 22, 'López'),
(2036, 22, 'Los Amores'),
(2037, 22, 'Los Cardos'),
(2038, 22, 'Los Laureles'),
(2039, 22, 'Los Molinos'),
(2040, 22, 'Los Quirquinchos'),
(2041, 22, 'Lucio V. Lopez'),
(2042, 22, 'Luis Palacios'),
(2043, 22, 'Ma. Juana'),
(2044, 22, 'Ma. Luisa'),
(2045, 22, 'Ma. Susana'),
(2046, 22, 'Ma. Teresa'),
(2047, 22, 'Maciel'),
(2048, 22, 'Maggiolo'),
(2049, 22, 'Malabrigo'),
(2050, 22, 'Marcelino Escalada'),
(2051, 22, 'Margarita'),
(2052, 22, 'Matilde'),
(2053, 22, 'Mauá'),
(2054, 22, 'Máximo Paz'),
(2055, 22, 'Melincué'),
(2056, 22, 'Miguel Torres'),
(2057, 22, 'Moisés Ville'),
(2058, 22, 'Monigotes'),
(2059, 22, 'Monje'),
(2060, 22, 'Monte Obscuridad'),
(2061, 22, 'Monte Vera'),
(2062, 22, 'Montefiore'),
(2063, 22, 'Montes de Oca'),
(2064, 22, 'Murphy'),
(2065, 22, 'Ñanducita'),
(2066, 22, 'Naré'),
(2067, 22, 'Nelson'),
(2068, 22, 'Nicanor E. Molinas'),
(2069, 22, 'Nuevo Torino'),
(2070, 22, 'Oliveros'),
(2071, 22, 'Palacios'),
(2072, 22, 'Pavón'),
(2073, 22, 'Pavón Arriba');
INSERT INTO `localidades` (`id`, `id_privincia`, `localidad`) VALUES
(2074, 22, 'Pedro Gómez Cello'),
(2075, 22, 'Pérez'),
(2076, 22, 'Peyrano'),
(2077, 22, 'Piamonte'),
(2078, 22, 'Pilar'),
(2079, 22, 'Piñero'),
(2080, 22, 'Plaza Clucellas'),
(2081, 22, 'Portugalete'),
(2082, 22, 'Pozo Borrado'),
(2083, 22, 'Progreso'),
(2084, 22, 'Providencia'),
(2085, 22, 'Pte. Roca'),
(2086, 22, 'Pueblo Andino'),
(2087, 22, 'Pueblo Esther'),
(2088, 22, 'Pueblo Gral. San Martín'),
(2089, 22, 'Pueblo Irigoyen'),
(2090, 22, 'Pueblo Marini'),
(2091, 22, 'Pueblo Muñoz'),
(2092, 22, 'Pueblo Uranga'),
(2093, 22, 'Pujato'),
(2094, 22, 'Pujato N.'),
(2095, 22, 'Rafaela'),
(2096, 22, 'Ramayón'),
(2097, 22, 'Ramona'),
(2098, 22, 'Reconquista'),
(2099, 22, 'Recreo'),
(2100, 22, 'Ricardone'),
(2101, 22, 'Rivadavia'),
(2102, 22, 'Roldán'),
(2103, 22, 'Romang'),
(2104, 22, 'Rosario'),
(2105, 22, 'Rueda'),
(2106, 22, 'Rufino'),
(2107, 22, 'Sa Pereira'),
(2108, 22, 'Saguier'),
(2109, 22, 'Saladero M. Cabal'),
(2110, 22, 'Salto Grande'),
(2111, 22, 'San Agustín'),
(2112, 22, 'San Antonio de Obligado'),
(2113, 22, 'San Bernardo (N.J.)'),
(2114, 22, 'San Bernardo (S.J.)'),
(2115, 22, 'San Carlos Centro'),
(2116, 22, 'San Carlos N.'),
(2117, 22, 'San Carlos S.'),
(2118, 22, 'San Cristóbal'),
(2119, 22, 'San Eduardo'),
(2120, 22, 'San Eugenio'),
(2121, 22, 'San Fabián'),
(2122, 22, 'San Fco. de Santa Fé'),
(2123, 22, 'San Genaro'),
(2124, 22, 'San Genaro N.'),
(2125, 22, 'San Gregorio'),
(2126, 22, 'San Guillermo'),
(2127, 22, 'San Javier'),
(2128, 22, 'San Jerónimo del Sauce'),
(2129, 22, 'San Jerónimo N.'),
(2130, 22, 'San Jerónimo S.'),
(2131, 22, 'San Jorge'),
(2132, 22, 'San José de La Esquina'),
(2133, 22, 'San José del Rincón'),
(2134, 22, 'San Justo'),
(2135, 22, 'San Lorenzo'),
(2136, 22, 'San Mariano'),
(2137, 22, 'San Martín de Las Escobas'),
(2138, 22, 'San Martín N.'),
(2139, 22, 'San Vicente'),
(2140, 22, 'Sancti Spititu'),
(2141, 22, 'Sanford'),
(2142, 22, 'Santo Domingo'),
(2143, 22, 'Santo Tomé'),
(2144, 22, 'Santurce'),
(2145, 22, 'Sargento Cabral'),
(2146, 22, 'Sarmiento'),
(2147, 22, 'Sastre'),
(2148, 22, 'Sauce Viejo'),
(2149, 22, 'Serodino'),
(2150, 22, 'Silva'),
(2151, 22, 'Soldini'),
(2152, 22, 'Soledad'),
(2153, 22, 'Soutomayor'),
(2154, 22, 'Sta. Clara de Buena Vista'),
(2155, 22, 'Sta. Clara de Saguier'),
(2156, 22, 'Sta. Isabel'),
(2157, 22, 'Sta. Margarita'),
(2158, 22, 'Sta. Maria Centro'),
(2159, 22, 'Sta. María N.'),
(2160, 22, 'Sta. Rosa'),
(2161, 22, 'Sta. Teresa'),
(2162, 22, 'Suardi'),
(2163, 22, 'Sunchales'),
(2164, 22, 'Susana'),
(2165, 22, 'Tacuarendí'),
(2166, 22, 'Tacural'),
(2167, 22, 'Tartagal'),
(2168, 22, 'Teodelina'),
(2169, 22, 'Theobald'),
(2170, 22, 'Timbúes'),
(2171, 22, 'Toba'),
(2172, 22, 'Tortugas'),
(2173, 22, 'Tostado'),
(2174, 22, 'Totoras'),
(2175, 22, 'Traill'),
(2176, 22, 'Venado Tuerto'),
(2177, 22, 'Vera'),
(2178, 22, 'Vera y Pintado'),
(2179, 22, 'Videla'),
(2180, 22, 'Vila'),
(2181, 22, 'Villa Amelia'),
(2182, 22, 'Villa Ana'),
(2183, 22, 'Villa Cañas'),
(2184, 22, 'Villa Constitución'),
(2185, 22, 'Villa Eloísa'),
(2186, 22, 'Villa Gdor. Gálvez'),
(2187, 22, 'Villa Guillermina'),
(2188, 22, 'Villa Minetti'),
(2189, 22, 'Villa Mugueta'),
(2190, 22, 'Villa Ocampo'),
(2191, 22, 'Villa San José'),
(2192, 22, 'Villa Saralegui'),
(2193, 22, 'Villa Trinidad'),
(2194, 22, 'Villada'),
(2195, 22, 'Virginia'),
(2196, 22, 'Wheelwright'),
(2197, 22, 'Zavalla'),
(2198, 22, 'Zenón Pereira'),
(2199, 23, 'Añatuya'),
(2200, 23, 'Árraga'),
(2201, 23, 'Bandera'),
(2202, 23, 'Bandera Bajada'),
(2203, 23, 'Beltrán'),
(2204, 23, 'Brea Pozo'),
(2205, 23, 'Campo Gallo'),
(2206, 23, 'Capital'),
(2207, 23, 'Chilca Juliana'),
(2208, 23, 'Choya'),
(2209, 23, 'Clodomira'),
(2210, 23, 'Col. Alpina'),
(2211, 23, 'Col. Dora'),
(2212, 23, 'Col. El Simbolar Robles'),
(2213, 23, 'El Bobadal'),
(2214, 23, 'El Charco'),
(2215, 23, 'El Mojón'),
(2216, 23, 'Estación Atamisqui'),
(2217, 23, 'Estación Simbolar'),
(2218, 23, 'Fernández'),
(2219, 23, 'Fortín Inca'),
(2220, 23, 'Frías'),
(2221, 23, 'Garza'),
(2222, 23, 'Gramilla'),
(2223, 23, 'Guardia Escolta'),
(2224, 23, 'Herrera'),
(2225, 23, 'Icaño'),
(2226, 23, 'Ing. Forres'),
(2227, 23, 'La Banda'),
(2228, 23, 'La Cañada'),
(2229, 23, 'Laprida'),
(2230, 23, 'Lavalle'),
(2231, 23, 'Loreto'),
(2232, 23, 'Los Juríes'),
(2233, 23, 'Los Núñez'),
(2234, 23, 'Los Pirpintos'),
(2235, 23, 'Los Quiroga'),
(2236, 23, 'Los Telares'),
(2237, 23, 'Lugones'),
(2238, 23, 'Malbrán'),
(2239, 23, 'Matara'),
(2240, 23, 'Medellín'),
(2241, 23, 'Monte Quemado'),
(2242, 23, 'Nueva Esperanza'),
(2243, 23, 'Nueva Francia'),
(2244, 23, 'Palo Negro'),
(2245, 23, 'Pampa de Los Guanacos'),
(2246, 23, 'Pinto'),
(2247, 23, 'Pozo Hondo'),
(2248, 23, 'Quimilí'),
(2249, 23, 'Real Sayana'),
(2250, 23, 'Sachayoj'),
(2251, 23, 'San Pedro de Guasayán'),
(2252, 23, 'Selva'),
(2253, 23, 'Sol de Julio'),
(2254, 23, 'Sumampa'),
(2255, 23, 'Suncho Corral'),
(2256, 23, 'Taboada'),
(2257, 23, 'Tapso'),
(2258, 23, 'Termas de Rio Hondo'),
(2259, 23, 'Tintina'),
(2260, 23, 'Tomas Young'),
(2261, 23, 'Vilelas'),
(2262, 23, 'Villa Atamisqui'),
(2263, 23, 'Villa La Punta'),
(2264, 23, 'Villa Ojo de Agua'),
(2265, 23, 'Villa Río Hondo'),
(2266, 23, 'Villa Salavina'),
(2267, 23, 'Villa Unión'),
(2268, 23, 'Vilmer'),
(2269, 23, 'Weisburd'),
(2270, 24, 'Río Grande'),
(2271, 24, 'Tolhuin'),
(2272, 24, 'Ushuaia'),
(2273, 25, 'Acheral'),
(2274, 25, 'Agua Dulce'),
(2275, 25, 'Aguilares'),
(2276, 25, 'Alderetes'),
(2277, 25, 'Alpachiri'),
(2278, 25, 'Alto Verde'),
(2279, 25, 'Amaicha del Valle'),
(2280, 25, 'Amberes'),
(2281, 25, 'Ancajuli'),
(2282, 25, 'Arcadia'),
(2283, 25, 'Atahona'),
(2284, 25, 'Banda del Río Sali'),
(2285, 25, 'Bella Vista'),
(2286, 25, 'Buena Vista'),
(2287, 25, 'Burruyacú'),
(2288, 25, 'Capitán Cáceres'),
(2289, 25, 'Cevil Redondo'),
(2290, 25, 'Choromoro'),
(2291, 25, 'Ciudacita'),
(2292, 25, 'Colalao del Valle'),
(2293, 25, 'Colombres'),
(2294, 25, 'Concepción'),
(2295, 25, 'Delfín Gallo'),
(2296, 25, 'El Bracho'),
(2297, 25, 'El Cadillal'),
(2298, 25, 'El Cercado'),
(2299, 25, 'El Chañar'),
(2300, 25, 'El Manantial'),
(2301, 25, 'El Mojón'),
(2302, 25, 'El Mollar'),
(2303, 25, 'El Naranjito'),
(2304, 25, 'El Naranjo'),
(2305, 25, 'El Polear'),
(2306, 25, 'El Puestito'),
(2307, 25, 'El Sacrificio'),
(2308, 25, 'El Timbó'),
(2309, 25, 'Escaba'),
(2310, 25, 'Esquina'),
(2311, 25, 'Estación Aráoz'),
(2312, 25, 'Famaillá'),
(2313, 25, 'Gastone'),
(2314, 25, 'Gdor. Garmendia'),
(2315, 25, 'Gdor. Piedrabuena'),
(2316, 25, 'Graneros'),
(2317, 25, 'Huasa Pampa'),
(2318, 25, 'J. B. Alberdi'),
(2319, 25, 'La Cocha'),
(2320, 25, 'La Esperanza'),
(2321, 25, 'La Florida'),
(2322, 25, 'La Ramada'),
(2323, 25, 'La Trinidad'),
(2324, 25, 'Lamadrid'),
(2325, 25, 'Las Cejas'),
(2326, 25, 'Las Talas'),
(2327, 25, 'Las Talitas'),
(2328, 25, 'Los Bulacio'),
(2329, 25, 'Los Gómez'),
(2330, 25, 'Los Nogales'),
(2331, 25, 'Los Pereyra'),
(2332, 25, 'Los Pérez'),
(2333, 25, 'Los Puestos'),
(2334, 25, 'Los Ralos'),
(2335, 25, 'Los Sarmientos'),
(2336, 25, 'Los Sosa'),
(2337, 25, 'Lules'),
(2338, 25, 'M. García Fernández'),
(2339, 25, 'Manuela Pedraza'),
(2340, 25, 'Medinas'),
(2341, 25, 'Monte Bello'),
(2342, 25, 'Monteagudo'),
(2343, 25, 'Monteros'),
(2344, 25, 'Padre Monti'),
(2345, 25, 'Pampa Mayo'),
(2346, 25, 'Quilmes'),
(2347, 25, 'Raco'),
(2348, 25, 'Ranchillos'),
(2349, 25, 'Río Chico'),
(2350, 25, 'Río Colorado'),
(2351, 25, 'Río Seco'),
(2352, 25, 'Rumi Punco'),
(2353, 25, 'San Andrés'),
(2354, 25, 'San Felipe'),
(2355, 25, 'San Ignacio'),
(2356, 25, 'San Javier'),
(2357, 25, 'San José'),
(2358, 25, 'San Miguel de 25'),
(2359, 25, 'San Pedro'),
(2360, 25, 'San Pedro de Colalao'),
(2361, 25, 'Santa Rosa de Leales'),
(2362, 25, 'Sgto. Moya'),
(2363, 25, 'Siete de Abril'),
(2364, 25, 'Simoca'),
(2365, 25, 'Soldado Maldonado'),
(2366, 25, 'Sta. Ana'),
(2367, 25, 'Sta. Cruz'),
(2368, 25, 'Sta. Lucía'),
(2369, 25, 'Taco Ralo'),
(2370, 25, 'Tafí del Valle'),
(2371, 25, 'Tafí Viejo'),
(2372, 25, 'Tapia'),
(2373, 25, 'Teniente Berdina'),
(2374, 25, 'Trancas'),
(2375, 25, 'Villa Belgrano'),
(2376, 25, 'Villa Benjamín Araoz'),
(2377, 25, 'Villa Chiligasta'),
(2378, 25, 'Villa de Leales'),
(2379, 25, 'Villa Quinteros'),
(2380, 25, 'Yánima'),
(2381, 25, 'Yerba Buena'),
(2382, 25, 'Yerba Buena (S)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` decimal(18,0) NOT NULL,
  `message` varchar(50) CHARACTER SET utf8 NOT NULL,
  `stacktrace` longtext NOT NULL,
  `log_id` decimal(18,0) DEFAULT NULL,
  `source` varchar(200) CHARACTER SET utf8 NOT NULL,
  `fechaalta` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_log_log` (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `log`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacimiento`
--

CREATE TABLE IF NOT EXISTS `nacimiento` (
  `id` decimal(18,0) NOT NULL,
  `loc_id` decimal(18,0) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nacimiento_localidad` (`loc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `nacimiento`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `pais`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pai_id` decimal(18,0) DEFAULT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_provincia_pais` (`pai_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `provincia`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `provincia` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcar la base de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `provincia`) VALUES
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
-- Estructura de tabla para la tabla `serviciomilitar`
--

CREATE TABLE IF NOT EXISTS `serviciomilitar` (
  `id` decimal(18,0) NOT NULL,
  `soc_id` decimal(18,0) NOT NULL,
  `fmi_id` decimal(18,0) NOT NULL,
  `gmi_id` decimal(18,0) NOT NULL,
  `arm_id` decimal(18,0) NOT NULL,
  `esc_id` decimal(18,0) DEFAULT NULL,
  `car_id` decimal(18,0) DEFAULT NULL,
  `are_id` decimal(18,0) DEFAULT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_serviciomilitar_area` (`are_id`),
  KEY `fk_serviciomilitar_armada` (`arm_id`),
  KEY `fk_serviciomilitar_cargo` (`car_id`),
  KEY `fk_serviciomilitar_escalafon` (`esc_id`),
  KEY `fk_serviciomilitar_fuerzamilitar` (`fmi_id`),
  KEY `fk_serviciomilitar_gradomilitar` (`gmi_id`),
  KEY `fk_serviciomilitar_socio` (`soc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `serviciomilitar`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `smvs`
--

CREATE TABLE IF NOT EXISTS `smvs` (
  `id` decimal(18,0) NOT NULL,
  `codigo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `soc_id` decimal(18,0) NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_smvs_socio` (`soc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `smvs`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio`
--

CREATE TABLE IF NOT EXISTS `socio` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8 NOT NULL,
  `foto` binary(255) DEFAULT NULL,
  `nac_id` decimal(18,0) DEFAULT NULL,
  `tdo_id` decimal(18,0) NOT NULL,
  `documento` decimal(18,0) NOT NULL,
  `tec_id` decimal(18,0) NOT NULL,
  `dom_id` decimal(18,0) DEFAULT NULL,
  `tso_id` decimal(18,0) NOT NULL,
  `tse_id` decimal(18,0) NOT NULL,
  `soc_id` decimal(18,0) DEFAULT NULL,
  `aud_id` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_socio_domicilio` (`dom_id`),
  KEY `fk_socio_nacimiento` (`nac_id`),
  KEY `fk_socio_socio` (`soc_id`),
  KEY `fk_socio_tipodocumento` (`tdo_id`),
  KEY `fk_socio_tipoestadocivil` (`tec_id`),
  KEY `fk_socio_tiposexo` (`tse_id`),
  KEY `fk_socio_tiposocio` (`tso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `socio`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio_contacto`
--

CREATE TABLE IF NOT EXISTS `socio_contacto` (
  `id` decimal(18,0) NOT NULL,
  `tco_id` decimal(18,0) NOT NULL,
  `soc_id` decimal(18,0) NOT NULL,
  `contacto` varchar(50) CHARACTER SET utf8 NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_socio_contacto_socio` (`soc_id`),
  KEY `fk_socio_contacto_tipocontacto` (`tco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `socio_contacto`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE IF NOT EXISTS `solicitud` (
  `id` decimal(18,0) NOT NULL,
  `usuario_id` decimal(18,0) DEFAULT NULL,
  `detalle` longblob,
  `aprobado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_solicitud_usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `solicitud`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudsocio`
--

CREATE TABLE IF NOT EXISTS `solicitudsocio` (
  `soli_id` decimal(18,0) NOT NULL,
  `soc_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`soli_id`,`soc_id`),
  KEY `fk_solicitudsocio_socio` (`soc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `solicitudsocio`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sysdiagrams`
--

CREATE TABLE IF NOT EXISTS `sysdiagrams` (
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `principal_id` int(11) NOT NULL,
  `diagram_id` int(11) NOT NULL AUTO_INCREMENT,
  `version` int(11) DEFAULT NULL,
  `definition` longblob,
  PRIMARY KEY (`diagram_id`),
  UNIQUE KEY `uk_principal_name` (`principal_id`,`name`),
  KEY `ix_tmp_autoinc` (`diagram_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `sysdiagrams`
--

INSERT INTO `sysdiagrams` (`name`, `principal_id`, `diagram_id`, `version`, `definition`) VALUES
('DiagramaCFFAA', 1, 1, 1, 0xd0cf11e0a1b11ae1000000000000000000000000000000003e000300feff0900060000000000000000000000020000000100000000000000001000005a00000001000000feffffff00000000000000005d000000fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffdffffff5c000000030000000400000005000000060000000700000008000000090000000a0000000b0000000c0000000d0000000e0000000f0000001000000011000000120000001300000014000000feffffff160000001700000018000000190000001a0000001b0000001c0000001d0000001e0000001f000000200000002100000022000000230000002400000025000000260000002700000028000000290000002a0000002b0000002c0000002d0000002e0000002f000000300000003100000032000000330000003400000035000000360000003700000038000000390000003a0000003b0000003c0000003d0000003e0000003f000000400000004100000042000000430000004400000045000000460000004700000048000000490000004a0000004b0000004c0000004d0000004e0000004f00000050000000510000005200000053000000540000005500000056000000570000005800000059000000fefffffffeffffff94000000fefffffffdffffff5f000000600000006100000062000000630000006400000065000000660000006700000068000000690000006a0000006b0000006c0000006d0000006e0000006f000000700000007100000072000000730000007400000075000000760000007700000078000000790000007a0000007b0000007c0000007d0000007e0000007f0000008000000052006f006f007400200045006e00740072007900000000000000000000000000000000000000000000000000000000000000000000000000000000000000000016000500ffffffffffffffff0200000000000000000000000000000000000000000000000000000000000000d04226692a24c7015b000000c0090000000000006600000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000004000201ffffffffffffffffffffffff000000000000000000000000000000000000000000000000000000000000000000000000020000000a250000000000006f000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000040002010100000004000000ffffffff000000000000000000000000000000000000000000000000000000000000000000000000150000006988000000000000010043006f006d0070004f0062006a0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000012000201ffffffffffffffffffffffff000000000000000000000000000000000000000000000000000000000000000000000000000000005f00000000000000000434000a1e500c05000080a40000000f00ffff6e000000a4000000007d000025420000d1560000f63b01003b5301000293000067460000de805b10f195d011b0a000aa00bdcb5c000008003000000000020000030000003c006b0000000900000000000000d9e6b0e91c81d011ad5100a0c90f5739f43b7f847f61c74385352986e1d552f8a0327db2d86295428d98273c25a2da2d00002800430000000000000053444dd2011fd1118e63006097d2df4834c9d2777977d811907000065b840d9c00002800430000000000000051444dd2011fd1118e63006097d2df4834c9d2777977d811907000065b840d9c810000001424000000ff01008201000000003800a50900000700008001000000b202000000800000100000805363684772696400f03c0000fc21000041637469766964616445787465726e6100002c00a509000007000080020000009a020000008000000400008053636847726964003c0f0000da6100004172656100003000a509000007000080030000009e02000000800000060000805363684772696400781e0000c24c000041726d616461640000003400a50900000700008004000000a402000000800000090000805363684772696400c8190000d4feffff41756469746f72696145787400003000a50900000700008005000000a2020000008000000800008053636847726964005898000042bd00004176616c616e746500003000a509000007000080060000009c02000000800000050000805363684772696465781e00000a8c0000436172676f69646500002c00a509000007000080070000009a02000000800000040000805363684772696465685b000014370000436c756200003800a50900000700008008000000ae020000008000000e0000805363684772696465f03c000014370000436c75625f4163746976696461646e6100008400a50900000700008009000000520000000180000059000080436f6e74726f6c65e5450000282b000052656c616369f36e2027464b5f436c75625f4163746976696461645f41637469766964616445787465726e612720656e747265202741637469766964616445787465726e612720792027436c75625f4163746976696461642700000000002800b5010000070000800a000000310000007700000002800000436f6e74726f6c65dd3200008232000000006c00a5090000070000800b000000520000000180000041000080436f6e74726f6c65d9500000593b000052656c616369f36e2027464b5f436c75625f4163746976696461645f436c75622720656e7472652027436c75622720792027436c75625f4163746976696461642700000000002800b5010000070000800c000000310000005f00000002800000436f6e74726f6c655b500000e93a000000003400a5090000070000800d000000a4020000008000000900008053636847726964650000000042bd0000446f6d6963696c696f76696400003400a5090000070000800e000000a4020000008000000900008053636847726964653c0f0000f2760000457363616c61666f6e76696400003000a5090000070000800f000000a202000000800000080000805363684772696465e07900007869000046616d696c69617200003800a50900000700008010000000ac020000008000000d0000805363684772696472f03c0000c24c0000467565727a614d696c69746172646e6100003400a50900000700008011000000aa020000008000000c0000805363684772696472f03c00000a8c0000477261646f4d696c6974617200003400a50900000700008012000000a402000000800000090000805363684772696472f03c0000e6dc00004c6f63616c6964616474617200006c00a509000007000080130000005a0000000180000041000080436f6e74726f6c7260090000dbd6000052656c616369f36e2027464b5f446f6d6963696c696f5f4c6f63616c696461642720656e74726520274c6f63616c696461642720792027446f6d6963696c696f2700000000002800b50100000700008014000000310000005f00000002800000436f6e74726f6c72aa2b00004fd6000000002c00a50900000700008015000000980200000080000003000080536368477269647200000000000000004c6f674700005400a509000007000080160000006a0000000180000029000080436f6e74726f6c72ecfaffffecfaffff52656c616369f36e2027464b5f4c6f675f4c6f672720656e74726520274c6f6727207920274c6f672708000000002800b50100000700008017000000310000004700000002800000436f6e74726f6c7280fcffffc7fcffff00003400a50900000700008018000000a6020000008000000a0000805363684772696472685b000036d800004e6163696d69656e746f617200006c00a50900000700008019000000520000000180000043000080436f6e74726f6c72d95000007bdc000052656c616369f36e2027464b5f4e6163696d69656e746f5f4c6f63616c696461642720656e74726520274c6f63616c6964616427207920274e6163696d69656e746f270000002800b5010000070000801a000000310000006100000002800000436f6e74726f6c72f44f0000c1de000000002c00a5090000070000801b0000009a02000000800000040000805363684772696472f03c0000ea0501005061697300003400a5090000070000801c000000a402000000800000090000805363684772696472f03c00007aee000050726f76696e6369616f617200006000a5090000070000801d000000520000000180000037000080436f6e74726f6c72e5450000cdf9000052656c616369f36e2027464b5f50726f76696e6369615f506169732720656e747265202750616973272079202750726f76696e636961270a00002800b5010000070000801e000000310000005500000002800000436f6e74726f6c722b4800004b00010000006c00a5090000070000801f000000520000000180000041000080436f6e74726f6c72e545000039e8000052656c616369f36e2027464b5f4c6f63616c696461645f50726f76696e6369612720656e747265202750726f76696e63696127207920274c6f63616c69646164276f270000002800b50100000700008020000000310000005f00000002800000436f6e74726f6c722b480000cdeb000000003800a50900000700008021000000b0020000008000000f0000805363684772696472b42d0000f4650000536572766963696f4d696c697461726100006c00a50900000700008022000000620000000180000043000080436f6e74726f6c72252300001f66000052656c616369f36e2027464b5f536572766963696f4d696c697461725f417265612720656e7472652027417265612720792027536572766963696f4d696c69746172270000002800b50100000700008023000000310000006100000002800000436f6e74726f6c724c190000c36f000000007000a50900000700008024000000620000000180000047000080436f6e74726f6c726d270000ee55000052656c616369f36e2027464b5f536572766963696f4d696c697461725f41726d6164612720656e747265202741726d6164612720792027536572766963696f4d696c69746172270200002800b50100000700008025000000310000006500000002800000436f6e74726f6c7241260000695b000000007000a50900000700008026000000620000000180000045000080436f6e74726f6c726d270000217c000052656c616369f36e2027464b5f536572766963696f4d696c697461725f436172676f2720656e7472652027436172676f2720792027536572766963696f4d696c697461722772270200002800b50100000700008027000000310000006300000002800000436f6e74726f6c72f3350000c58a000000007800a5090000070000802800000062000000018000004d000080436f6e74726f6c72252300005d71000052656c616369f36e2027464b5f536572766963696f4d696c697461725f457363616c61666f6e2720656e7472652027457363616c61666f6e2720792027536572766963696f4d696c697461722700000000002800b50100000700008029000000310000006b00000002800000436f6e74726f6c72b41600009072000000008000a5090000070000802a000000620000000180000055000080436f6e74726f6c725b370000ee55000052656c616369f36e2027464b5f536572766963696f4d696c697461725f467565727a614d696c697461722720656e7472652027467565727a614d696c697461722720792027536572766963696f4d696c697461722700000000002800b5010000070000802b000000310000007300000002800000436f6e74726f6c7207280000b358000000007c00a5090000070000802c000000620000000180000053000080436f6e74726f6c725b370000217c000052656c616369f36e2027464b5f536572766963696f4d696c697461725f477261646f4d696c697461722720656e7472652027477261646f4d696c697461722720792027536572766963696f4d696c69746172277200002800b5010000070000802d000000310000007100000002800000436f6e74726f6c72c53900000f88000000002c00a5090000070000802e0000009a02000000800000040000805363684772696472f03c00007aa30000534d565300003000a5090000070000802f0000009c02000000800000050000805363684772696472685b0000546f0000536f63696f69647200006400a50900000700008030000000620000000180000039000080436f6e74726f6c72f5080000cc8e000052656c616369f36e2027464b5f536f63696f5f446f6d6963696c696f2720656e7472652027446f6d6963696c696f2720792027536f63696f2700000000002800b50100000700008031000000310000005700000002800000436f6e74726f6c7226490000eeba000000006400a509000007000080320000006a000000018000003b000080436f6e74726f6c72b7620000cc8e000052656c616369f36e2027464b5f536f63696f5f4e6163696d69656e746f2720656e74726520274e6163696d69656e746f2720792027536f63696f270000002800b50100000700008033000000310000005900000002800000436f6e74726f6c72e164000070b8000000005c00a509000007000080340000006a0000000180000031000080436f6e74726f6c7254560000406a000052656c616369f36e2027464b5f536f63696f5f536f63696f2720656e7472652027536f63696f2720792027536f63696f27696e6300002800b50100000700008035000000310000004f00000002800000436f6e74726f6c72005700001b6c000000005800a5090000070000803600000062000000018000002f000080436f6e74726f6c72d9500000517f000052656c616369f36e2027464b5f534d56535f536f63696f2720656e7472652027536f63696f2720792027534d5653270000002800b50100000700008037000000310000004d00000002800000436f6e74726f6c72fb5400004894000000007000a50900000700008038000000620000000180000045000080436f6e74726f6c729d410000c770000052656c616369f36e2027464b5f536572766963696f4d696c697461725f536f63696f2720656e7472652027536f63696f2720792027536572766963696f4d696c697461722772270200002800b50100000700008039000000310000006300000002800000436f6e74726f6c72c64600005576000000006000a5090000070000803a000000520000000180000037000080436f6e74726f6c72516f0000536e000052656c616369f36e2027464b5f46616d696c6961725f536f63696f2720656e7472652027536f63696f272079202746616d696c696172270a00002800b5010000070000803b000000310000005500000002800000436f6e74726f6c7265700000e36d000000006c00a5090000070000803c000000620000000180000043000080436f6e74726f6c72014600003c40000052656c616369f36e2027464b5f436c75625f4163746976696461645f536f63696f2720656e7472652027536f63696f2720792027436c75625f416374697669646164277200002800b5010000070000803d000000310000006100000002800000436f6e74726f6c7277650000ef46000000006000a5090000070000803e000000620000000180000037000080436f6e74726f6c721f660000d08e000052656c616369f36e2027464b5f4176616c616e74655f536f63696f2720656e7472652027536f63696f27207920274176616c616e7465270a00002800b5010000070000803f000000310000005500000002800000436f6e74726f6c72886800003aba000000006000a50900000700008040000000620000000180000038000080436f6e74726f6c72e1670000d08e000052656c616369f36e2027464b5f4176616c616e74655f536f63696f312720656e7472652027536f63696f27207920274176616c616e74652700002800b50100000700008041000000310000005700000002800000436f6e74726f6c72516a000086b9000000003800a50900000700008042000000ae020000008000000e0000805363684772696472e079000088c20000536f63696f5f436f6e746163746f726100006c00a50900000700008043000000620000000180000043000080436f6e74726f6c725d640000d08e000052656c616369f36e2027464b5f536f63696f5f436f6e746163746f5f536f63696f2720656e7472652027536f63696f2720792027536f63696f5f436f6e746163746f277200002800b50100000700008044000000310000006100000002800000436f6e74726f6c724d570000edb9000000003400a50900000700008045000000aa020000008000000c0000805363684772696472685b0000e0c400005469706f436f6e746163746f00007c00a50900000700008046000000520000000180000051000080436f6e74726f6c72516f000025c9000052656c616369f36e2027464b5f536f63696f5f436f6e746163746f5f5469706f436f6e746163746f2720656e74726520275469706f436f6e746163746f2720792027536f63696f5f436f6e746163746f2772277200002800b50100000700008047000000310000006f00000002800000436f6e74726f6c72226c0000b5c8000000003800a50900000700008048000000ac020000008000000d0000805363684772696472e07900006c3900005469706f446f63756d656e746f6f726100006c00a50900000700008049000000620000000180000041000080436f6e74726f6c720f6500006c40000052656c616369f36e2027464b5f536f63696f5f5469706f446f63756d656e746f2720656e74726520275469706f446f63756d656e746f2720792027536f63696f276f277200002800b5010000070000804a000000310000005f00000002800000436f6e74726f6c72015800004748000000003800a5090000070000804b000000b0020000008000000f0000805363684772696472e07900008ca000005469706f45737461646f436976696c6100007000a5090000070000804c000000620000000180000045000080436f6e74726f6c726f6e0000cc8e000052656c616369f36e2027464b5f536f63696f5f5469706f45737461646f436976696c2720656e74726520275469706f45737461646f436976696c2720792027536f63696f2772270200002800b5010000070000804d000000310000006300000002800000436f6e74726f6c722d760000b596000000003800a5090000070000804e000000ae020000008000000e0000805363684772696472e0790000cc8d00005469706f506172656e746573636f6c6100007400a5090000070000804f000000520000000180000049000080436f6e74726f6c72d5820000d181000052656c616369f36e2027464b5f46616d696c6961725f5469706f506172656e746573636f2720656e74726520275469706f506172656e746573636f272079202746616d696c6961722774617200002800b50100000700008050000000310000006700000002800000436f6e74726f6c721b8500008088000000003000a50900000700008051000000a202000000800000080000805363684772696472e0790000225600005469706f5365786f00006000a50900000700008052000000620000000180000037000080436f6e74726f6c6f6f6e0000225d000052656c616369f36e2027464b5f536f63696f5f5469706f5365786f2720656e74726520275469706f5365786f2720792027536f63696f272700002800b50100000700008053000000310000005500000002800000436f6e74726f6c6f076a00008f65000000006800a5090000070000805400000052000000018000003d000080436f6e74726f6c6fd5820000225d000052656c616369f36e2027464b5f46616d696c6961725f5469706f5365786f2720656e74726520275469706f5365786f272079202746616d696c6961722700000000002800b50100000700008055000000310000005b00000002800000436f6e74726f6c6f06780000fc63000000003400a50900000700008056000000a40200000080000009000080536368477269646fd0b6000042bd00005469706f536f63696f74657300006400a50900000700008057000000620000000180000039000080436f6e74726f6c6fbf690000cc8e000052656c616369f36e2027464b5f536f63696f5f5469706f536f63696f2720656e74726520275469706f536f63696f2720792027536f63696f2769617200002800b50100000700008058000000310000005700000002800000436f6e74726f6c6f3c8600001cb6000000003000a50900000700008059000000a00200000080000007000080536368477269646f781e000088c2000054726162616a6f6f00006800a5090000070000805a00000052000000018000003d000080436f6e74726f6c6fe913000025c9000052656c616369f36e2027464b5f54726162616a6f5f446f6d6963696c696f2720656e7472652027446f6d6963696c696f272079202754726162616a6f2700000000002800b5010000070000805b000000310000005b00000002800000436f6e74726f6c6f161400006bcb000000006000a5090000070000805c000000620000000180000035000080436f6e74726f6c6f89270000d08e000052656c616369f36e2027464b5f54726162616a6f5f536f63696f2720656e7472652027536f63696f272079202754726162616a6f276f272700002800b5010000070000805d000000310000005300000002800000436f6e74726f6c6f484c0000ecb8000000003800a5090000070000805e000000b20200000080000010000080536368477269646ff03c0000b4c3000054726162616a6f5f436f6e746163746f00008000a5090000070000805f000000520000000180000055000080436f6e74726f6c6fd950000025c9000052656c616369f36e2027464b5f54726162616a6f5f436f6e746163746f5f5469706f436f6e746163746f2720656e74726520275469706f436f6e746163746f272079202754726162616a6f5f436f6e746163746f2700000000002800b50100000700008060000000310000007300000002800000436f6e74726f6c6fc34d0000b5c8000000007400a5090000070000806100000052000000018000004b000080436f6e74726f6c6f6132000025c9000052656c616369f36e2027464b5f54726162616a6f5f54726162616a6f5f436f6e746163746f2720656e747265202754726162616a6f5f436f6e746163746f272079202754726162616a6f277200002800b50100000700008062000000310000006900000002800000436f6e74726f6c6fcc2f00006bcb000000003000a5090000070000806a000000a00200000080000007000080536368477269646f28b900003e4900005573756172696f6f00003400a5090000070000806c000000a40200000080000009000080536368477269646f0a8c00007c470000536f6c6963697475646f6e7400006800a5090000070000807600000052000000018000003d000080436f6e74726f6c6fd29f0000194e000052656c616369f36e2027464b5f536f6c6963697475645f5573756172696f2720656e74726520275573756172696f2720792027536f6c6963697475642700000000002800b50100000700008077000000310000005b00000002800000436f6e74726f6c6f80a70000a94d000000003400a5090000070000807e000000aa020000008000000c000080536368477269646ff03c000052eaffff5469706f456d706c6561646f00003c00a50900000700008081000000ba0200000080000014000080536368477269646f2c970000685b0000456d626172636163696f6e6573446574616c6c6500003400a50900000700008082000000a8020000008000000b000080536368477269646f80bb000070620000456d626172636163696f6e6f00003800a50900000700008083000000ac020000008000000d000080536368477269646f08e80000a84800004361726e65744e61757469636f63746f00003800a50900000700008088000000ae020000008000000e000080536368477269646fea6f0000d4490000536f6c696369747564536f63696f746f00007400a5090000070000808900000052000000018000004b000080436f6e74726f6c6fdd810000d348000052656c616369f36e2027464b5f536f6c696369747564536f63696f5f536f6c6963697475642720656e7472652027536f6c6963697475642720792027536f6c696369747564536f63696f277200002800b5010000070000808a000000310000006900000002800000436f6e74726f6c6f628000006348000000006c00a5090000070000808b0000006a0000000180000043000080436f6e74726f6c6f396a00002351000052656c616369f36e2027464b5f536f6c696369747564536f63696f5f536f63696f2720656e7472652027536f63696f2720792027536f6c696369747564536f63696f276f00002800b5010000070000808c000000310000006100000002800000436f6e74726f6c6f7c6c0000b85d000000003c00a5090000070000808f000000ba0200000080000014000080536368477269646f1cd400005a3c00005573756172696f4361726e65744e61757469636f00007c00a509000007000080900000005a0000000180000053000080436f6e74726f6c6f97cf0000e741000052656c616369f36e2027464b5f5573756172696f4361726e65744e61757469636f5f5573756172696f2720656e74726520275573756172696f27207920275573756172696f4361726e65744e61757469636f276f00002800b50100000700008091000000310000007100000002800000436f6e74726f6c6f8ecb00001144000000008800a509000007000080920000005a000000018000005f000080436f6e74726f6c6f1be000000443000052656c616369f36e2027464b5f5573756172696f4361726e65744e61757469636f5f4361726e65744e61757469636f2720656e74726520274361726e65744e61757469636f27207920275573756172696f4361726e65744e61757469636f270000002800b50100000700008093000000310000007d00000002800000436f6e74726f6c6f0dda00003747000000006c00a50900000700008094000000520000000180000041000080436f6e74726f6c6fc5bf00000856000052656c616369f36e2027464b5f456d626172636163696f6e5f5573756172696f2720656e74726520275573756172696f2720792027456d626172636163696f6e276f276f00002800b50100000700008095000000310000005f00000002800000436f6e74726f6c6f29b30000eb5c000000003000a5090000070000809a000000a20200000080000008000080536368477269646f32190000a2e5ffff456d706c6561646f00007000a5090000070000809b000000520000000180000045000080436f6e74726f6c6f252b000051e9ffff52656c616369f36e2027464b5f456d706c6561646f5f5469706f456d706c6561646f2720656e74726520275469706f456d706c6561646f2720792027456d706c6561646f2772270200002800b5010000070000809c000000310000006300000002800000436f6e74726f6c6ff82c0000e1e8ffff00006800a5090000070000809d00000052000000018000003f000080436f6e74726f6c6fc718000073f0ffff52656c616369f36e2027464b5f41756469746f7269615f456d706c6561646f2720656e7472652027456d706c6561646f272079202741756469746f726961270000002800b5010000070000809e000000310000005d00000002800000436f6e74726f6c6ff40c000053f8ffff00006800a5090000070000809f000000520000000180000040000080436f6e74726f6c6ff319000073f0ffff52656c616369f36e2027464b5f41756469746f7269615f456d706c6561646f312720656e7472652027456d706c6561646f272079202741756469746f7269612700002800b501000007000080a0000000310000005f00000002800000436f6e74726f6c6f730d000053f8ffff00006800a509000007000080a1000000520000000180000040000080436f6e74726f6c6f5d19000073f0ffff52656c616369f36e2027464b5f41756469746f7269615f456d706c6561646f322720656e7472652027456d706c6561646f272079202741756469746f7269612700002800b501000007000080a2000000310000005f00000002800000436f6e74726f6c6fdd0c000053f8ffff00008400a509000007000080a300000052000000018000005b000080436f6e74726f6c6f69b300006f61000052656c616369f36e2027464b5f456d626172636163696f6e6573446574616c6c655f456d626172636163696f6e2720656e7472652027456d626172636163696f6e2720792027456d626172636163696f6e6573446574616c6c65276900002800b501000007000080a4000000310000007900000002800000436f6e74726f6c6f74ad0000ff600000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000214334120800000015150000e30b0000785634120700000014010000410063007400690076006900640061006400450078007400650072006e006100000072006d0073002c002000430075006c0074007500720065003d006e00650075007400720061006c002c0020005000750062006c00690063004b006500790054006f006b0065006e003d0062003700370061003500630035003600310039003300340065003000380039000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100008d0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006a00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f00000011000000410063007400690076006900640061006400450078007400650072006e0061000000214334120800000015150000e30b0000785634120700000014010000410072006500610000006900640061006400650073000000b00000806e00b000b000b000b000b000b000b000b000b000b000b000b000b000b000b000b000b000b000b00030004000400080006000b00070002000400040006000800040004000400040006000600060006000600060006000600060006000400040008000800080005000a0007000600070007000600060007000700040005000600050008000700080008f4ee34d70000080800070006000a00060006000600040004000400080006000600060006000500060006000400060006000200030005000200080006000600060006000400050004000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100009c0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005200000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000500000041007200650061000000214334120800000015150000e30b0000785634120700000014010000410072006d00610064006100000061006400610044006500000040006000500050006000b000b000b0005000700070007000700070007000a0007000600060006000600040004000400040008000700080008000800080008000800080007000700070007000600060006000ab4ee34d60000080a4006000a000500060006000600060002000200020002000600060006000600060006000600080006000600060006000600060006000600004020006d5412700602a920d60f8900d75006d006e007300200046006b005f0043006c0020006f006e00200046006b005f0043006c002e0063006f006e0073007400000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100009c0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005600000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f00000007000000410072006d00610064006100000021433412080000001515000091140000785634120700000014010000410075006400690074006f007200690061000000730000005f006900640028004e002700640062006f002e004700720061006400f74ee34d27000080c8006f007200200046006b002e007200650066006500720065006e006300650064005f006f0062006a006500630074005f006900640020003d0020006f0062006a006500630074005f006900640028004e002700640062006f002e0047007200610064006f0073002700290020006f007200640065007200200062007900200046006b002e006f00e14ee34d65000080da005f00690064002c00200046006b005f0043006c002e0063006f006e0073007400000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000099180000000000002d010000090000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a0500000000000001000000151500009114000000000000070000000700000002000000020000001c0100009c0900000000000001000000c7110000320c000000000000040000000400000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005c00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000a000000410075006400690074006f007200690061000000214334120800000015150000e30b00007856341207000000140100004100760061006c0061006e007400650000007400730020007700680065007200650020006900640020003d0020006f0062006a006500630074005f006900640028004e002700640062006f002e004100760061006c0061006e0074006500270029000000b4682c0068ee4103e4682c00043f4003eccdec099030ce0344692c00885e400374692c00749e400364672c00d8a44003d4692c00dcb54003046a2c00ccb64003346a2c00b0ba40034caad10940ac4503bccdec096830ce03f46d2c000cce7203b46b2c00a45743039cccec094030ce03946d2c0008fe7203c46d2c0004e572034cb0d10974e080036ccc000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100009c0900000000000001000000c71100001008000000000000020000000200000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005a00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f000000090000004100760061006c0061006e00740065000000214334120800000015150000e30b000078563412070000001401000043006100720067006f000000e46b2c00d8584303e46e2c0094d4420394a7eb09242ace03446f2c00c4fe420334a7eb090cfecd03c4a4eb09e818ce0374a6eb097418ce03c4a7eb092418ce037c5eeb09f893cd03b4aeeb093493cd039c24e6090c5bce036c1be609b892cd03cc24e609d45ace0354712c00acb0440304b0eb099c5ace032cc1e809645ace03ec25e6092c5ace03e4712c0094b2440314722c00a4b24403b46be4098092cd0374722c0088b44403a466e4095c92cd030c42e209f459ce03d463e4099891cd03a463e40950ddcc034463e409d891cd033c42e209bc59ce03ec4ce2097059ce03f461000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100009c0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005400000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000600000043006100720067006f000000214334120800000015150000e30b000078563412070000001401000043006c007500620000007c035cafd10920e97c031cc2e809188bc9038c25e609a43fca03d4afeb09502ec0035cb5d1098c6f82032cb5d10958c487037cb0d1092c8f8003acb0d1093c8f8003dcb0d109848f80030cb1d109f48f80033cb1d109349080036cb1d10900e280039cb1d109c8e18003ccb1d10910e28003fcb1d109009180032c5deb0958a9c7035cb2d109a0e380038cb2d109f0e38003bcb2d109e4e58003ecb2d109a0e680031cb3d10968e780034cb3d10988e780037cb3d10924e98003acb3d10974e98003ccf7e709508fc0036cb4d109fc41c003a4afeb095098c003fcebe70968e2c0030cb4000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100008d0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005200000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000500000043006c00750062000000214334120800000015150000e30b000078563412070000001401000043006c00750062005f004100630074006900760069006400610064000000e409f808c103b4a8eb09fcf6c003bc1fe609a867bb031cced909d0dfc0031cf0e70958e9b703bcefe70998e8b7035cefe70988e1b7032cefe709bce8b7034cced9090c27bb038c1ce60954cfc0039ceee709ace8b7036ceee70988e8b703646ae409e0bec0039c3fe209a0d8ba03346ae409e4acc003fc3fe20990d8ba037cede709d847b5034cede709c834b5031cede7096828b503b4b1eb09101cb503e4b1eb09300eb503c4adeb09b4f3b40304b3eb0954e7b40334b3eb09fcdab40364b3eb091ccdb403aceae7090452b1037cea000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100008d0900000000000001000000c7110000210a000000000000030000000300000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006600000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000f00000043006c00750062005f00410063007400690076006900640061006400000002000b007c470000df2d00007c470000143700000000000002000000f0f0f00000000000000000000000000000000000010000000a00000000000000dd32000082320000f0130000580100003b000000010000020000f013000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61220046004b005f0043006c00750062005f004100630074006900760069006400610064005f00410063007400690076006900640061006400450078007400650072006e00610002000b00685b0000f03c000005520000f03c00000000000002000000f0f0f00000000000000000000000000000000000010000000c000000000000005b500000e93a0000110d00005801000037000000010000020000110d000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61160046004b005f0043006c00750062005f004100630074006900760069006400610064005f0043006c0075006200214334120800000015150000141b000078563412070000001401000044006f006d006900630069006c0069006f0000009c1ee609c01cb603cc1ee6096010b603eccdd9097897b2032c46e2090411b9035465e40948dbb8035ccdd909fcc6b2033c59eb0944e39d032ccdd909c8c5b203fcccd90994c1b203ccccd9096cc1b2039cccd90944c1b2036cccd90934c1b2033cccd909d0c0b2030cccd90994beb2034c41e209f4bdb203246be4091495b203f46ae40964aeb203c46ae409f0adb203946ae409a0adb2038465e409f80eb903e4a8eb09a80eb9034c58eb09ec0cb9031c58eb09cc0cb903ec57eb09c40bb903e468e4098809b9034469e409a4bcb4031469e409b8fdb4039c4e000000000000000000000100000005000000540000002c0000002c0000002c00000034000000000000000000000096240000cd1e0000000000002d0100000c0000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000141b0000000000000a0000000a00000002000000020000001c0100008d0900000000000001000000c71100001008000000000000020000000200000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005c00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000a00000044006f006d006900630069006c0069006f000000214334120800000015150000e30b000078563412070000001401000045007300630061006c00610066006f006e000000b465e4096894b203ecc7d909f0c6b6038ccdd9090cb0b803845ce4094494b2033c27e609b890b5032c28e609d882b5035c28e6097c6eb503bc28e6091c62b5033464e409648ab2030464e409088ab203bccdd909fcafb8030c1ee609ecafb8035c57eb0938a574032c57eb0928a57403fc56eb09c455b503bc46e2098cf1b1039c56eb09f49474036c56eb09e49474033c56eb09c4a37403ec46e209ecedb103dc55eb09b89274031c47e20954eab1034c47e20980e6b1037c47e20994ddb103ac47e209f4d9b103dc47e2095cd6b1030c48e20988d2b1033c48000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100009c0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005c00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000a00000045007300630061006c00610066006f006e000000214334120800000015150000141b0000785634120700000014010000460061006d0069006c00690061007200000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c00000034000000000000000000000096240000cd1e0000000000002d0100000c0000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000141b0000000000000a0000000a00000002000000020000001c0100009c0900000000000001000000c7110000320c000000000000040000000400000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005a00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f00000009000000460061006d0069006c006900610072000000214334120800000015150000e30b000078563412070000001401000046007500650072007a0061004d0069006c0069007400610072000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100008d0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006400000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000e00000046007500650072007a0061004d0069006c00690074006100720000002143341208000000151500000e0e000078563412070000001401000047007200610064006f004d0069006c00690074006100720000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a0500000000000001000000151500000e0e000000000000040000000400000002000000020000001c0100008d0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006200000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000d00000047007200610064006f004d0069006c00690074006100720000002143341208000000151500000e0e00007856341207000000140100004c006f00630061006c00690064006100640000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a0500000000000001000000151500000e0e000000000000040000000400000002000000020000001c0100008d0900000000000001000000c71100001008000000000000020000000200000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005c00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000a0000004c006f00630061006c006900640061006400000003000b007c470000e6dc00007c47000056d800008c0a000056d800000000000002000000f0f0f00000000000000000000000000000000000010000001400000000000000aa2b00004fd600002b0c000058010000320000000100000200002b0c000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61160046004b005f0044006f006d006900630069006c0069006f005f004c006f00630061006c006900640061006400214334120800000015150000661200007856341207000000140100004c006f00670000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000088160000000000002d010000080000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a0500000000000001000000151500006612000000000000060000000600000002000000020000001c0100008d0900000000000001000000c71100001008000000000000020000000200000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005000000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f000000040000004c006f006700000005000b00000000002c01000018fcffff2c01000018fcffff18fcffff2c01000018fcffff2c010000000000000000000002000000f0f0f0000000000000000000000000000000000001000000170000000000000080fcffffc7fcffff8906000058010000350000000100000200008906000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d610a0046004b005f004c006f0067005f004c006f006700214334120800000015150000e30b00007856341207000000140100004e006100630069006d00690065006e0074006f000000630074005f00690064002c00200072006f0062006a002e006e0061006d0065002000610073002000520075006c005f006e0061006d0065002c00200073006300680065006d0061005f006e0061006d006500280072006f0062006a002e0073006300680065006d0061005f006900640029002000610073002000520075006c005f0073006300680065006d0061002c00200063006f006c002e00640065006600610075006c0074005f006f0062006a006500630074005f00690064002c0020004f0042004a00450043005400500052004f00500045005200000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100008d0900000000000001000000c71100001008000000000000020000000200000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005e00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000b0000004e006100630069006d00690065006e0074006f00000002000b000552000012de0000685b000012de00000000000002000000f0f0f00000000000000000000000000000000000010000001a00000000000000f44f0000c1de0000840d00005801000032000000010000020000840d000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61170046004b005f004e006100630069006d00690065006e0074006f005f004c006f00630061006c006900640061006400214334120800000015150000e30b000078563412070000001401000050006100690073000000200064006f0062006a002e006e0061006d00650020006100730020006400650066005f006e0061006d0065002c00200073006300680065006d0061005f006e0061006d006500280064006f0062006a002e0073006300680065006d0061005f0069006400290020006100730020006400650066005f0073006300680065006d0061002c00200043004f004e00560045005200540028006200690074002c002000630061007300650020007700680065006e00200028006600740063002e0063006f006c0075006d006e005f006900640020006900730020006e0075006c006c0029002000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c010000bd0600000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005200000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f00000005000000500061006900730000002143341208000000151500000e0e0000785634120700000014010000500072006f00760069006e0063006900610000006500730020007300740020006f006e002000730074002e0075007300650072005f0074007900700065005f006900640020003d00200063006f006c002e0075007300650072005f0074007900700065005f006900640020006c0065006600740020006f00750074006500720020006a006f0069006e0020007300790073002e007400790070006500730020006200740020006f006e002000620074002e0075007300650072005f0074007900700065005f006900640020003d00200063006f006c002e00730079007300740065006d005f007400790070006500000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a0500000000000001000000151500000e0e000000000000040000000400000002000000020000001c0100008d0900000000000001000000c71100001008000000000000020000000200000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005c00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000a000000500072006f00760069006e00630069006100000002000b007c470000ea0501007c47000088fc00000000000002000000f0f0f00000000000000000000000000000000000010000001e000000000000002b4800004b000100af0900005801000035000000010000020000af09000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61110046004b005f00500072006f00760069006e006300690061005f00500061006900730002000b007c4700007aee00007c470000f4ea00000000000002000000f0f0f000000000000000000000000000000000000100000020000000000000002b480000cdeb0000810c0000580100003d000000010000020000810c000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61160046004b005f004c006f00630061006c0069006400610064005f00500072006f00760069006e00630069006100214334120800000015150000e818000078563412070000001401000053006500720076006900630069006f004d0069006c00690074006100720000006500630074005f0069006400200061006e006400200072006f0062006a002e00740079007000650020003d00200027005200270020006c0065006600740020006f00750074006500720020006a006f0069006e0020007300790073002e006f0062006a006500630074007300200064006f0062006a0020006f006e00200064006f0062006a002e006f0062006a006500630074005f006900640020003d00200063006f006c002e00640065006600610075006c0074005f006f0062006a006500630074005f006900640020006100000000000000000000000100000005000000540000002c0000002c0000002c00000034000000000000000000000096240000bb1c0000000000002d0100000b0000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e818000000000000090000000900000002000000020000001c0100009c0900000000000001000000c71100007714000000000000080000000800000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006800000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000001000000053006500720076006900630069006f004d0069006c006900740061007200000004000b0051240000b667000098260000b66700009826000016710000b42d0000167100000000000002000000f0f0f000000000000000000000000000000000000100000023000000000000004c190000c36f00009d0c000058010000330000000100000200009d0c000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61170046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f00410072006500610004000b0004290000a558000004290000ba5a000014370000ba5a000014370000f46500000000000002000000f0f0f0000000000000000000000000000000000001000000250000000000000041260000695b0000320e00005801000034000000010000020000320e000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61190046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f00410072006d0061006400610004000b00042900000a8c000004290000168a000014370000168a000014370000dc7e00000000000002000000f0f0f00000000000000000000000000000000000010000002700000000000000f3350000c58a00004a0d000058010000340000000100000200004a0d000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61180046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f0043006100720067006f0004000b0051240000ce7c000098260000ce7c000098260000d8720000b42d0000d87200000000000002000000f0f0f00000000000000000000000000000000000010000002900000000000000b416000090720000350f00005801000036000000010000020000350f000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d611c0046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f0045007300630061006c00610066006f006e0004000b007c470000a55800007c470000ba5a0000d6380000ba5a0000d6380000f46500000000000002000000f0f0f00000000000000000000000000000000000010000002b0000000000000007280000b3580000e61000005801000039000000010000020000e610000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61200046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f0046007500650072007a0061004d0069006c00690074006100720004000b007c4700000a8c00007c470000168a0000d6380000168a0000d6380000dc7e00000000000002000000f0f0f00000000000000000000000000000000000010000002d00000000000000c53900000f88000072100000580100003b0000000100000200007210000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d611f0046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f0047007200610064006f004d0069006c0069007400610072002143341208000000151500003a10000078563412070000001401000053004d0056005300000062006a00650063007400730020007700680065007200650020006900640020003d0020006f0062006a006500630074005f006900640028004e002700640062006f002e0053004d00560053002700290000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a0500000000000001000000151500003a10000000000000050000000500000002000000020000001c0100008d0900000000000001000000c71100001008000000000000020000000200000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005200000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000500000053004d005600530000002143341208000000151500003322000078563412070000001401000053006f00630069006f00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000962400002d240000000000002d0100000d0000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a05000000000000010000001515000033220000000000000d0000000c00000002000000020000001c0100008d0900000000000001000000c71100007714000000000000080000000800000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005400000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000600000053006f00630069006f00000004000b008c0a000042bd00008c0a00003fba0000ae6000003fba0000ae600000879100000000000002000000f0f0f0000000000000000000000000000000000001000000310000000000000026490000eeba0000060a00005801000032000000010000020000060a000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61120046004b005f0053006f00630069006f005f0044006f006d006900630069006c0069006f0005000b007d700000ccd8000033750000ccd8000033750000f3ba000032640000f3ba000032640000879100000000000002000000f0f0f00000000000000000000000000000000000010000003300000000000000e164000070b80000600b00005801000038000000010000020000600b000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61130046004b005f0053006f00630069006f005f004e006100630069006d00690065006e0074006f0005000b00685b0000807000008057000080700000805700006c6b0000945c00006c6b0000945c0000546f00000000000002000000f0f0f00000000000000000000000000000000000010000003500000000000000005700001b6c00005608000058010000390000000100000200005608000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d610e0046004b005f0053006f00630069006f005f0053006f00630069006f0004000b00685b0000e88000004c540000e88000004c540000aeab000005520000aeab00000000000002000000f0f0f00000000000000000000000000000000000010000003700000000000000fb540000489400007208000058010000310000000100000200007208000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d610d0046004b005f0053004d00560053005f0053006f00630069006f0004000b00685b0000267f00004c540000267f00004c54000042720000c9420000427200000000000002000000f0f0f00000000000000000000000000000000000010000003900000000000000c646000055760000d70c0000580100002c000000010000020000d70c000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61180046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f0053006f00630069006f0002000b007d700000ea6f0000e0790000ea6f00000000000002000000f0f0f00000000000000000000000000000000000010000003b0000000000000065700000e36d00009309000058010000320000000100000200009309000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61110046004b005f00460061006d0069006c006900610072005f0053006f00630069006f0004000b00c8640000546f0000c86400004c4500007c4700004c4500007c470000f74200000000000002000000f0f0f00000000000000000000000000000000000010000003d0000000000000077650000ef460000840d00005801000034000000010000020000840d000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61170046004b005f0043006c00750062005f004100630074006900760069006400610064005f0053006f00630069006f0004000b00b667000087910000b66700008bb90000b8a100008bb90000b8a1000042bd00000000000002000000f0f0f00000000000000000000000000000000000010000003f00000000000000886800003aba00005d0a000058010000330000000100000200005d0a000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61110046004b005f004100760061006c0061006e00740065005f0053006f00630069006f0004000b00786900008791000078690000d7b800007aa30000d7b800007aa3000042bd00000000000002000000f0f0f00000000000000000000000000000000000010000004100000000000000516a000086b900000a0b000058010000330000000100000200000a0b000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61120046004b005f004100760061006c0061006e00740065005f0053006f00630069006f0031002143341208000000151500003a10000078563412070000001401000053006f00630069006f005f0043006f006e0074006100630074006f00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a0500000000000001000000151500003a10000000000000050000000500000002000000020000001c0100009c0900000000000001000000c7110000210a000000000000030000000300000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006600000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000f00000053006f00630069006f005f0043006f006e0074006100630074006f00000004000b00f465000087910000f46500003fba00006c8400003fba00006c84000088c200000000000002000000f0f0f000000000000000000000000000000000000100000044000000000000004d570000edb90000f80d00005801000032000000010000020000f80d000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61170046004b005f0053006f00630069006f005f0043006f006e0074006100630074006f005f0053006f00630069006f00214334120800000015150000e30b00007856341207000000140100005400690070006f0043006f006e0074006100630074006f0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100008d0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006200000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000d0000005400690070006f0043006f006e0074006100630074006f00000002000b007d700000bcca0000e0790000bcca00000000000002000000f0f0f00000000000000000000000000000000000010000004700000000000000226c0000b5c800005d12000058010000300000000100000200005d12000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d611e0046004b005f0053006f00630069006f005f0043006f006e0074006100630074006f005f005400690070006f0043006f006e0074006100630074006f00214334120800000015150000b70900007856341207000000140100005400690070006f0044006f00630075006d0065006e0074006f00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000460500437fe63400c4002100501a7f0e00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000b709000000000000020000000200000002000000020000001c0100009c0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006400000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000e0000005400690070006f0044006f00630075006d0065006e0074006f00000004000b006c840000234300006c8400004c4500008a6600004c4500008a660000546f00000000000002000000f0f0f00000000000000000000000000000000000010000004a000000000000000158000047480000da0d00005801000032000000010000020000da0d000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61160046004b005f0053006f00630069006f005f005400690070006f0044006f00630075006d0065006e0074006f00214334120800000015150000b70900007856341207000000140100005400690070006f00450073007400610064006f0043006900760069006c0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000b709000000000000020000000200000002000000020000001c0100009c0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006800000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f000000100000005400690070006f00450073007400610064006f0043006900760069006c00000004000b00767a00008ca00000767a0000bc980000ea6f0000bc980000ea6f0000879100000000000002000000f0f0f00000000000000000000000000000000000010000004d000000000000002d760000b5960000a10d00005801000032000000010000020000a10d000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61180046004b005f0053006f00630069006f005f005400690070006f00450073007400610064006f0043006900760069006c00214334120800000015150000b70900007856341207000000140100005400690070006f0050006100720065006e0074006500730063006f00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000b709000000000000020000000200000002000000020000001c0100009c0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006600000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000f0000005400690070006f0050006100720065006e0074006500730063006f00000002000b006c840000cc8d00006c8400008c8400000000000002000000f0f0f000000000000000000000000000000000000100000050000000000000001b85000080880000180f00005801000032000000010000020000180f000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d611a0046004b005f00460061006d0069006c006900610072005f005400690070006f0050006100720065006e0074006500730063006f00214334120800000015150000b70900007856341207000000140100005400690070006f005300650078006f00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000b709000000000000020000000200000002000000020000001c0100009c0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005a00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f000000090000005400690070006f005300650078006f00000004000b00767a0000d95f0000767a000096670000ea6f000096670000ea6f0000546f00000000000002000000f0f0f00000000000000000000000000000000000010000005300000000000000076a00008f6500007a0a000058010000320000000100000200007a0a000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61110046004b005f0053006f00630069006f005f005400690070006f005300650078006f0002000b006c840000d95f00006c840000786900000000000002000000f0f0f0000000000000000000000000000000000001000000550000000000000006780000fc630000b70b00005801000032000000010000020000b70b000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61140046004b005f00460061006d0069006c006900610072005f005400690070006f005300650078006f00214334120800000015150000e30b00007856341207000000140100005400690070006f0053006f00630069006f0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a050000000000000100000015150000e30b000000000000030000000300000002000000020000001c0100008d0900000000000001000000c7110000ff05000000000000010000000100000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005c00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000a0000005400690070006f0053006f00630069006f00000004000b005cc1000042bd00005cc1000023b800003a6b000023b800003a6b0000879100000000000002000000f0f0f000000000000000000000000000000000000100000058000000000000003c8600001cb60000960a00005801000032000000010000020000960a000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61120046004b005f0053006f00630069006f005f005400690070006f0053006f00630069006f002143341208000000151500003a100000785634120700000014010000540072006100620061006a006f000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a0500000000000001000000151500003a10000000000000050000000500000002000000020000001c0100009c0900000000000001000000c7110000320c000000000000040000000400000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000005800000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f00000008000000540072006100620061006a006f00000002000b0015150000bcca0000781e0000bcca00000000000002000000f0f0f00000000000000000000000000000000000010000005b00000000000000161400006bcb0000600b00005801000032000000010000020000600b000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61140046004b005f00540072006100620061006a006f005f0044006f006d006900630069006c0069006f0004000b00706200008791000070620000f3ba000004290000f3ba00000429000088c200000000000002000000f0f0f00000000000000000000000000000000000010000005d00000000000000484c0000ecb80000af0900005801000032000000010000020000af09000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61100046004b005f00540072006100620061006a006f005f0053006f00630069006f002143341208000000151500000e0e0000785634120700000014010000540072006100620061006a006f005f0043006f006e0074006100630074006f000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c0000003400000000000000000000009624000077140000000000002d010000070000000c000000070000001c010000bc070000540600001b030000de030000b202000038040000cd05000075030000cd050000530700000a0500000000000001000000151500000e0e000000000000040000000400000002000000020000001c0100008d0900000000000001000000c71100001008000000000000020000000200000002000000020000001c010000bc0700000100000000000000c7110000ed03000000000000000000000000000002000000020000001c010000bc0700000000000000000000072c0000de20000000000000000000000d00000004000000040000001c010000bc07000024090000a005000078563412040000006a00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f00000011000000540072006100620061006a006f005f0043006f006e0074006100630074006f00000002000b00685b0000bcca000005520000bcca00000000000002000000f0f0f00000000000000000000000000000000000010000006000000000000000c34d0000b5c80000b6130000580100003b000000010000020000b613000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61200046004b005f00540072006100620061006a006f005f0043006f006e0074006100630074006f005f005400690070006f0043006f006e0074006100630074006f0002000b00f03c0000bcca00008d330000bcca00000000000002000000f0f0f00000000000000000000000000000000000010000006200000000000000cc2f00006bcb0000ac1000005801000030000000010000020000ac10000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d611b0046004b005f00540072006100620061006a006f005f00540072006100620061006a006f005f0043006f006e0074006100630074006f002143341208000000ce180000810f00007856341207000000140100005500730075006100720069006f00000069006e0064006f00000000002e0046006f0072006d0073002c002000560065007200730069006f000100000004e4550e14e4550e040000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000006900630000000000790054006f006b0065006e003d00620000000000610035000b0000000000000028ff540e68a8430000200000c91500000000006000000020000000000000000000000000000000007c020000b8e3550e6f1100002c030000c9de0400000000000000000000000000000000000000000000000000000000000000000005000000540000002c0000002c0000002c000000340000000000000000000000ce180000810f0000000000002d0100000d0000000c000000070000001c0100001b030000850200001b030000de030000b2020000b3010000cd05000075030000cd050000530700000a0500000000000001000000eb0f0000770b000000000000030000000300000002000000020000001c0100009f0600000000000001000000210a00002204000000000000000000000000000002000000020000001c0100001b0300000100000000000000210a00002204000000000000000000000000000002000000020000001c0100001b0300000000000000000000fb1400003e23000000000000000000000d00000004000000040000001c0100001b030000a20300003a02000078563412040000005800000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f000000080000005500730075006100720069006f0000002143341208000000f4140000880d000078563412070000001401000053006f006c00690063006900740075006400000064006f00770073002e0046006f0072006d0073002c002000560065007200730069006f006e003d0032002e0030002e0030002e0030002c002000430075006c0074007500720065003d006e00650075007400720061006c002c0020005000750062006c00690063004b006500790054006f006b0065006e003d00620037003700610035006300350036003100390033003400650030003800390000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000ca270000c3200000000000002d0100000d0000000c000000070000001c0100007f080000f90600001b030000de030000b2020000a1040000cd05000075030000cd050000530700000a0500000000000001000000f4140000880d000000000000040000000400000002000000020000001c0100007e09000000000000010000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000001000000000000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000000000000000000000f300000c320000000000000000000000d00000004000000040000001c0100007f080000140a00003606000078563412040000005c00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000a00000053006f006c00690063006900740075006400000002000b0028b90000b04f0000fea00000b04f00000000000002000000f0f0f0000000000000000000000000000000000001000000770000000000000080a70000a94d0000260b00005801000032000000010000020000260b000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61140046004b005f0053006f006c006900630069007400750064005f005500730075006100720069006f002143341208000000780e0000b70900007856341207000000140100005400690070006f0045006d0070006c006500610064006f00000000002e0046006f0072006d0073002c002000560065007200730069006f000100000064e9550e74e9550e040000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000006900630000000000790054006f006b0065006e003d00620000000000610035000b00000000000000700a330e68a8430000200000e12500000000006000000020000000000000000000000000000000007c02000018e9550e4f1e0000ac000000cef90700000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000141b00007d210000000000002d0100000d0000000c000000070000001c01000064050000740400001b030000de030000b2020000ee020000cd05000075030000cd050000530700000a0500000000000001000000780e0000b709000000000000020000000200000002000000020000001c010000dc0500000000000001000000bf0d0000ed03000000000000000000000000000002000000020000001c010000640500000100000000000000bf0d0000ed03000000000000000000000000000002000000020000001c0100006405000000000000000000003f2000007d21000000000000000000000d00000004000000040000001c0100006405000063060000ed03000078563412040000006200000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000d0000005400690070006f0045006d0070006c006500610064006f0000002143341208000000691d00009330000078563412070000001401000045006d0062006100720063006100630069006f006e006500730044006500740061006c006c00650000006f006e003d00310030002e0030002e0030002e0030002c002000430075006c0074007500720065003d006e00650075007400720061006c002c0020005000750062006c00690063004b006500790054006f006b0065006e003d0038003900380034003500640063006400380030003800300063006300390031000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000005000000540000002c0000002c0000002c000000340000000000000000000000691d000093300000000000002d0100000d0000000c000000070000001c01000035070000bf0400001b030000de030000b202000016080000cd05000075030000cd050000530700000a0500000000000001000000371a0000d11e000000000000140000000c00000002000000020000001c0100009a0b00000000000001000000210a00004e06000000000000010000000100000002000000020000001c0100001b0300000100000000000000210a00002204000000000000000000000000000002000000020000001c0100001b0300000000000000000000fb1400003e23000000000000000000000d00000004000000040000001c0100001b030000a20300003a02000078563412040000007200000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000001500000045006d0062006100720063006100630069006f006e006500730044006500740061006c006c00650000002143341208000000e12b0000810f000078563412070000001401000045006d0062006100720063006100630069006f006e000000000000002e0046006f0072006d0073002c002000560065007200730069006f0001000000b484520ec484520e040000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000006900630000000000790054006f006b0065006e003d00620000000000610035000b00000000000000e808550e68a8430000200000e53300000000006000000020000000000000000000000000000000007c0200006884520e852900002c0300002ea40a00000000000000000000000000000000000000000000000000000000000000000005000000540000002c0000002c0000002c000000340000000000000000000000e12b0000810f0000000000002d0100000d0000000c000000070000001c0100007f080000f90600001b030000de030000b2020000a1040000cd05000075030000cd050000530700000a05000000000000010000001f130000770b000000000000030000000300000002000000020000001c0100007008000000000000010000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000001000000000000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000000000000000000000f300000c320000000000000000000000d00000004000000040000001c0100007f080000140a00003606000078563412040000006000000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000c00000045006d0062006100720063006100630069006f006e0000002143341208000000ca270000c32000007856341207000000140100004300610072006e00650074004e00610075007400690063006f0000002e0046006f0072006d0073002c002000560065007200730069006f0001000000148a520e248a520e040000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000006900630000000000790054006f006b0065006e003d00620000000000610035000b000000000000006000550e68a8430000200000893a00000000006000000020000000000000000000000000000000007c020000c889520ed52e00005000000014e70b00000000000000000000000000000000000000000000000000000000000000000005000000540000002c0000002c0000002c000000340000000000000000000000ca270000c3200000000000002d0100000d0000000c000000070000001c0100007f080000f90600001b030000de030000b2020000a1040000cd05000075030000cd050000530700000a05000000000000010000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000000000000010000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000001000000000000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000000000000000000000f300000c320000000000000000000000d00000004000000040000001c0100007f080000140a00003606000078563412040000006400000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000e0000004300610072006e00650074004e00610075007400690063006f00000021433412080000001f1300006509000078563412070000001401000053006f006c0069006300690074007500640053006f00630069006f00000046006f0072006d0073002c002000560065007200730069006f00010000002492520e3492520e040000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000006900630000000000790054006f006b0065006e003d00620000000000610035000b00000000000000b007550e68a8430000200000e53d00000000006000000020000000000000000000000000000000007c020000d891520e85310000c4030000dd8e0c00000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000ca270000700d0000000000002d0100000d0000000c000000070000001c0100007f080000f90600001b030000de030000b2020000a1040000cd05000075030000cd050000530700000a05000000000000010000001f1300006509000000000000020000000200000002000000020000001c0100007f08000000000000010000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000001000000000000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000000000000000000000f300000c320000000000000000000000d00000004000000040000001c0100007f080000140a00003606000078563412040000006600000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000f00000053006f006c0069006300690074007500640053006f00630069006f00000002000b000a8c00006a4a0000098300006a4a00000000000002000000f0f0f00000000000000000000000000000000000010000008a0000000000000062800000634800004e0e000058010000320000000100000200004e0e000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d611b0046004b005f0053006f006c0069006300690074007500640053006f00630069006f005f0053006f006c0069006300690074007500640005000b00d06b0000546f0000d06b00006d600000cd6b00006d600000cd6b00009e520000ea6f00009e5200000000000002000000f0f0f00000000000000000000000000000000000010000008c000000000000007c6c0000b85d0000bb0c00005801000030000000010000020000bb0c000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61170046004b005f0053006f006c0069006300690074007500640053006f00630069006f005f0053006f00630069006f0021433412080000001f130000650900007856341207000000140100005500730075006100720069006f004300610072006e00650074004e00610075007400690063006f0000002000560065007200730069006f00010000008497520e9497520e040000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000006900630000000000790054006f006b0065006e003d00620000000000610035000b000000000000007806550e68a8430000200000f14000000000006000000020000000000000000000000000000000007c0200003897520ef533000070000000da210d00000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000ca270000c3200000000000002d0100000d0000000c000000070000001c0100007f080000f90600001b030000de030000b2020000a1040000cd05000075030000cd050000530700000a05000000000000010000001f1300006509000000000000020000000200000002000000020000001c0100007008000000000000010000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000001000000000000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000000000000000000000f300000c320000000000000000000000d00000004000000040000001c0100007f080000140a00003606000078563412040000007200000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f000000150000005500730075006100720069006f004300610072006e00650074004e00610075007400690063006f00000003000b002ed100003e4900002ed10000624300001cd40000624300000000000002000000f0f0f000000000000000000000000000000000000100000091000000000000008ecb0000114400009612000058010000500000000100000200009612000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d611f0046004b005f005500730075006100720069006f004300610072006e00650074004e00610075007400690063006f005f005500730075006100720069006f0003000b0008e800003e49000096e100003e49000096e10000bf4500000000000002000000f0f0f000000000000000000000000000000000000100000093000000000000000dda0000374700004e16000058010000210000000100000200004e16000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61250046004b005f005500730075006100720069006f004300610072006e00650074004e00610075007400690063006f005f004300610072006e00650074004e00610075007400690063006f0002000b005cc10000bf5800005cc10000706200000000000002000000f0f0f0000000000000000000000000000000000001000000950000000000000029b30000eb5c0000840d00005801000032000000010000020000840d000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61160046004b005f0045006d0062006100720063006100630069006f006e005f005500730075006100720069006f0021433412080000001f130000880d000078563412070000001401000045006d0070006c006500610064006f0000006e0064006f00000000002e0046006f0072006d0073002c002000560065007200730069006f00010000006c8b520e7c8b520e040000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000006900630000000000790054006f006b0065006e003d00620000000000610035000b0000000000000088233b0e68a8430000200000094c00000000006000000020000000000000000000000000000000007c020000208b520ed53c0000cc020000914d0f00000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000ca270000c3200000000000002d0100000d0000000c000000070000001c0100007f080000f90600001b030000de030000b2020000a1040000cd05000075030000cd050000530700000a05000000000000010000001f130000880d000000000000040000000400000002000000020000001c0100007f08000000000000010000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000001000000000000001f130000ed03000000000000000000000000000002000000020000001c0100007f08000000000000000000000f300000c320000000000000000000000d00000004000000040000001c0100007f080000140a00003606000078563412040000005a00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000900000045006d0070006c006500610064006f00000002000b00f03c0000e8eaffff512c0000e8eaffff0000000002000000f0f0f00000000000000000000000000000000000010000009c00000000000000f82c0000e1e8ffff510f00005801000032000000010000020000510f000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61180046004b005f0045006d0070006c006500610064006f005f005400690070006f0045006d0070006c006500610064006f0002000b005e1a00002af3ffff5e1a0000d4feffff0000000002000000f0f0f00000000000000000000000000000000000010000009e00000000000000f40c000053f8ffffbb0c00005801000032000000010000020000bb0c000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61150046004b005f00410075006400690074006f007200690061005f0045006d0070006c006500610064006f0002000b008a1b00002af3ffff8a1b0000d4feffff0000000002000000f0f0f0000000000000000000000000000000000001000000a000000000000000730d000053f8ffff680d00005801000032000000010000020000680d000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61160046004b005f00410075006400690074006f007200690061005f0045006d0070006c006500610064006f00310002000b00f41a00002af3fffff41a0000d4feffff0000000002000000f0f0f0000000000000000000000000000000000001000000a200000000000000dd0c000053f8ffff680d00005801000032000000010000020000680d000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61160046004b005f00410075006400690074006f007200690061005f0045006d0070006c006500610064006f00320002000b0080bb00000663000095b40000066300000000000002000000f0f0f0000000000000000000000000000000000001000000a40000000000000074ad0000ff6000002d15000058010000320000000100000200002d15000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61230046004b005f0045006d0062006100720063006100630069006f006e006500730044006500740061006c006c0065005f0045006d0062006100720063006100630069006f006e00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001000000fefffffffeffffff0400000005000000060000000700000008000000090000000a0000000b0000000c0000000d0000000e0000000f000000100000001100000012000000130000001400000015000000160000001700000018000000190000001a0000001b0000001c0000001d0000001e0000001f000000200000002100000022000000230000002400000025000000fefffffffeffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff0100feff030a0000ffffffff00000000000000000000000000000000170000004d6963726f736f66742044445320466f726d20322e300010000000456d626564646564204f626a6563740000000000f439b271000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010003000000000000000c0000000b0000004e61bc00000000000000000000000000000000000000000000000000000000000000000000000000000000000000dbe6b0e91c81d011ad5100a0c90f573900000200304b22692a24c701020200001048450000000000000000000000000000000000580100004400610074006100200053006f0075007200630065003d006200690062006c0069006f00310033003b0049006e0069007400690061006c00200043006100740061006c006f0067003d006200610063003b0049006e00740065006700720061007400650064002000530065006300750072006900740079003d0054007200750065003b004d0075006c007400690070006c00650041006300740069007600650052006500730075006c00740053006500740073003d00460061006c00730065003b005000610063006b00650074002000530069007a0065003d0034003000390036003b004100700070006c00690063006100740069006f006e0020004e0061006d0065003d0022000300440064007300530074007200650061006d000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000160002000300000006000000ffffffff0000000000000000000000000000000000000000000000000000000000000000000000005e000000ab6b00000000000053006300680065006d00610020005500440056002000440065006600610075006c0074000000000000000000000000000000000000000000000000000000000026000200ffffffffffffffffffffffff000000000000000000000000000000000000000000000000000000000000000000000000020000001600000000000000440053005200450046002d0053004300480045004d0041002d0043004f004e00540045004e0054005300000000000000000000000000000000000000000000002c0002010500000007000000ffffffff00000000000000000000000000000000000000000000000000000000000000000000000003000000920800000000000053006300680065006d00610020005500440056002000440065006600610075006c007400200050006f007300740020005600360000000000000000000000000036000200ffffffffffffffffffffffff0000000000000000000000000000000000000000000000000000000000000000000000002600000012000000000000008100000082000000830000008400000085000000860000008700000088000000890000008a0000008b0000008c0000008d0000008e0000008f00000090000000910000009200000093000000feffffff950000009600000097000000feffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff0c00000002930000674600000100260000007300630068005f006c006100620065006c0073005f00760069007300690062006c0065000000010000000b0000001e000000000000000000000000000000000000006400000000000000000000000000000000000000000000000000010000000100000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000020000000200000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000030000000300000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000040000000400000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000050000000500000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000060000000600000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000070000000700000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000080000000800000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000090000000900000000000000560000000100790001000000640062006f00000046004b005f0043006c00750062005f004100630074006900760069006400610064005f00410063007400690076006900640061006400450078007400650072006e00610000000000000000000000c402000000000a0000000a000000090000000800000001255809602558090000000000000000ad0700000000000b0000000b000000000000003e0000000100635f01000000640062006f00000046004b005f0043006c00750062005f004100630074006900760069006400610064005f0043006c007500620000000000000000000000c402000000000c0000000c0000000b0000000800000001255809202558090000000000000000ad0700000000000d0000000d00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000000e0000000e00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000000f0000000f00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000100000001000000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000110000001100000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000120000001200000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000001300000013000000000000003e0000000100635f01000000640062006f00000046004b005f0044006f006d006900630069006c0069006f005f004c006f00630061006c00690064006100640000000000000000000000c402000000001400000014000000130000000800000001245809e02458090000000000000000ad070000000000150000001500000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000160000001600000000000000260000000101650901000000640062006f00000046004b005f004c006f0067005f004c006f00670000000000000000000000c402000000001700000017000000160000000800000001245809a02458090000000000000000ad070000000000180000001800000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000190000001900000000000000400000000100635f01000000640062006f00000046004b005f004e006100630069006d00690065006e0074006f005f004c006f00630061006c00690064006100640000000000000000000000c402000000001a0000001a000000190000000800000001245809602458090000000000000000ad0700000000001b0000001b00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0031003700320035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000001c0000001c00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000001d0000001d000000000000003400000001015f0901000000640062006f00000046004b005f00500072006f00760069006e006300690061005f00500061006900730000000000000000000000c402000000001e0000001e0000001d0000000800000001245809202458090000000000000000ad0700000000001f0000001f000000000000003e0000000100635f01000000640062006f00000046004b005f004c006f00630061006c0069006400610064005f00500072006f00760069006e0063006900610000000000000000000000c4020000000020000000200000001f0000000800000001235809e02358090000000000000000ad070000000000210000002100000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000220000002200000000000000400000000100635f01000000640062006f00000046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f00410072006500610000000000000000000000c402000000002300000023000000220000000800000001235809a02358090000000000000000ad070000000000240000002400000000000000440000000100c97501000000640062006f00000046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f00410072006d0061006400610000000000000000000000c402000000002500000025000000240000000800000001235809602358090000000000000000ad070000000000260000002600000000000000420000000100c97501000000640062006f00000046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f0043006100720067006f0000000000000000000000c402000000002700000027000000260000000800000001235809202358090000000000000000ad0700000000002800000028000000000000004a0000000100635f01000000640062006f00000046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f0045007300630061006c00610066006f006e0000000000000000000000c402000000002900000029000000280000000800000001225809e02258090000000000000000ad0700000000002a0000002a00000000000000520000000100790001000000640062006f00000046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f0046007500650072007a0061004d0069006c00690074006100720000000000000000000000c402000000002b0000002b0000002a0000000800000001225809a02258090000000000000000ad0700000000002c0000002c00000000000000500000000100635f01000000640062006f00000046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f0047007200610064006f004d0069006c00690074006100720000000000000000000000c402000000002d0000002d0000002c0000000800000001225809602258090000000000000000ad0700000000002e0000002e00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000002f0000002f00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000003000000030000000000000003600000001015f0901000000640062006f00000046004b005f0053006f00630069006f005f0044006f006d006900630069006c0069006f0000000000000000000000c402000000003100000031000000300000000800000001225809202258090000000000000000ad0700000000003200000032000000000000003800000001015f0901000000640062006f00000046004b005f0053006f00630069006f005f004e006100630069006d00690065006e0074006f0000000000000000000000c402000000003300000033000000320000000800000001215809e02158090000000000000000ad0700000000003400000034000000000000002e0000000102000001000000640062006f00000046004b005f0053006f00630069006f005f0053006f00630069006f0000000000000000000000c402000000003500000035000000340000000800000001215809a02158090000000000000000ad0700000000003600000036000000000000002c0000000102000001000000640062006f00000046004b005f0053004d00560053005f0053006f00630069006f0000000000000000000000c402000000003700000037000000360000000800000001215809602158090000000000000000ad070000000000380000003800000000000000420000000100c97501000000640062006f00000046004b005f0053006500720076006900630069006f004d0069006c0069007400610072005f0053006f00630069006f0000000000000000000000c402000000003900000039000000380000000800000001215809202158090000000000000000ad0700000000003a0000003a000000000000003400000001015f0901000000640062006f00000046004b005f00460061006d0069006c006900610072005f0053006f00630069006f0000000000000000000000c402000000003b0000003b0000003a0000000800000001205809e02058090000000000000000ad0700000000003c0000003c00000000000000400000000100635f01000000640062006f00000046004b005f0043006c00750062005f004100630074006900760069006400610064005f0053006f00630069006f0000000000000000000000c402000000003d0000003d0000003c0000000800000001205809a02058090000000000000000ad0700000000003e0000003e000000000000003400000001015f0901000000640062006f00000046004b005f004100760061006c0061006e00740065005f0053006f00630069006f0000000000000000000000c402000000003f0000003f0000003e0000000800000001205809602058090000000000000000ad0700000000004000000040000000000000003600000001015f0901000000640062006f00000046004b005f004100760061006c0061006e00740065005f0053006f00630069006f00310000000000000000000000c402000000004100000041000000400000000800000001205809202058090000000000000000ad070000000000420000004200000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c0031003400340030000000430000004300000000000000400000000100635f01000000640062006f00000046004b005f0053006f00630069006f005f0043006f006e0074006100630074006f005f0053006f00630069006f0000000000000000000000c4020000000044000000440000004300000008000000011f5809e01f58090000000000000000ad070000000000450000004500000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000004600000046000000000000004e0000000100635f01000000640062006f00000046004b005f0053006f00630069006f005f0043006f006e0074006100630074006f005f005400690070006f0043006f006e0074006100630074006f0000000000000000000000c4020000000047000000470000004600000008000000011f5809a01f58090000000000000000ad070000000000480000004800000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000004900000049000000000000003e0000000100635f01000000640062006f00000046004b005f0053006f00630069006f005f005400690070006f0044006f00630075006d0065006e0074006f0000000000000000000000c402000000004a0000004a0000004900000008000000011f5809601f58090000000000000000ad0700000000004b0000004b00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000004c0000004c00000000000000420000000100c97501000000640062006f00000046004b005f0053006f00630069006f005f005400690070006f00450073007400610064006f0043006900760069006c0000000000000000000000c402000000004d0000004d0000004c00000008000000011f5809201f58090000000000000000ad0700000000004e0000004e00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000004f0000004f00000000000000460000000100c97501000000640062006f00000046004b005f00460061006d0069006c006900610072005f005400690070006f0050006100720065006e0074006500730063006f0000000000000000000000c4020000000050000000500000004f00000008000000011e5809e01e58090000000000000000ad070000000000510000005100000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000005200000052000000000000003400000001015f0901000000640062006f00000046004b005f0053006f00630069006f005f005400690070006f005300650078006f0000000000000000000000c4020000000053000000530000005200000008000000011e5809a01e58090000000000000000ad0700000000005400000054000000000000003a0000000100635f01000000640062006f00000046004b005f00460061006d0069006c006900610072005f005400690070006f005300650078006f0000000000000000000000c4020000000055000000550000005400000008000000011e5809601e58090000000000000000ad070000000000560000005600000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000005700000057000000000000003600000001015f0901000000640062006f00000046004b005f0053006f00630069006f005f005400690070006f0053006f00630069006f0000000000000000000000c4020000000058000000580000005700000008000000011e5809201e58090000000000000000ad070000000000590000005900000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000005a0000005a000000000000003a0000000100635f01000000640062006f00000046004b005f00540072006100620061006a006f005f0044006f006d006900630069006c0069006f0000000000000000000000c402000000005b0000005b0000005a00000008000000011d5809e01d58090000000000000000ad0700000000005c0000005c000000000000003200000001015f0901000000640062006f00000046004b005f00540072006100620061006a006f005f0053006f00630069006f0000000000000000000000c402000000005d0000005d0000005c00000008000000011d5809a01d58090000000000000000ad0700000000005e0000005e00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003900380030002c0031002c0031003600320030002c0035002c0031003000380030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400340035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003900380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003900380030002c00310032002c0032003300340030002c00310031002c00310034003400300000005f0000005f00000000000000520000000100790001000000640062006f00000046004b005f00540072006100620061006a006f005f0043006f006e0074006100630074006f005f005400690070006f0043006f006e0074006100630074006f0000000000000000000000c4020000000060000000600000005f00000008000000011d5809601d58090000000000000000ad070000000000610000006100000000000000480000000100c97501000000640062006f00000046004b005f00540072006100620061006a006f005f00540072006100620061006a006f005f0043006f006e0074006100630074006f0000000000000000000000c4020000000062000000620000006100000008000000011d5809201d58090000000000000000ad0700000000006a0000006a00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000030000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003400000034002c0030002c003200380034002c0030002c003700390035002c0031002c003600340035002c0035002c003400330035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0031003600390035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001c00000032002c0030002c003200380034002c0030002c003700390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001c00000032002c0030002c003200380034002c0030002c003700390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003800000034002c0030002c003200380034002c0030002c003700390035002c00310032002c003900330030002c00310031002c0035003700300000006c0000006c00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003100370035002c0031002c0031003700380035002c0035002c0031003100380035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003400330030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003100370035002c00310032002c0032003500380030002c00310031002c00310035003900300000007600000076000000000000003a0000000100635f01000000640062006f00000046004b005f0053006f006c006900630069007400750064005f005500730075006100720069006f0000000000000000000000c4020000000077000000770000007600000008000000011c5809e01c58090000000000000000ad0700000000007e0000007e00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003800000034002c0030002c003200380034002c0030002c0031003300380030002c0031002c0031003100340030002c0035002c003700350030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0031003500300030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0031003300380030000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0031003300380030000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0031003300380030002c00310032002c0031003600330035002c00310031002c0031003000300035000000810000008100000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000030000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0031003800340035002c0031002c0031003200310035002c0035002c0032003000370030000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003900370030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001c00000032002c0030002c003200380034002c0030002c003700390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001c00000032002c0030002c003200380034002c0030002c003700390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003800000034002c0030002c003200380034002c0030002c003700390035002c00310032002c003900330030002c00310031002c003500370030000000820000008200000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000030000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003100370035002c0031002c0031003700380035002c0035002c0031003100380035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003100370035002c00310032002c0032003500380030002c00310031002c0031003500390030000000830000008300000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000030000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003100370035002c0031002c0031003700380035002c0035002c0031003100380035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003100370035002c00310032002c0032003500380030002c00310031002c0031003500390030000000880000008800000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003100370035002c0031002c0031003700380035002c0035002c0031003100380035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003100370035002c00310032002c0032003500380030002c00310031002c0031003500390030000000890000008900000000000000480000000100c97501000000640062006f00000046004b005f0053006f006c0069006300690074007500640053006f00630069006f005f0053006f006c0069006300690074007500640000000000000000000000c402000000008a0000008a0000008900000008000000011c5809a01c58090000000000000000ad0700000000008b0000008b00000000000000400000000100635f01000000640062006f00000046004b005f0053006f006c0069006300690074007500640053006f00630069006f005f0053006f00630069006f0000000000000000000000c402000000008c0000008c0000008b00000008000000011c5809601c58090000000000000000ad0700000000008f0000008f00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003100370035002c0031002c0031003700380035002c0035002c0031003100380035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100360030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003100370035002c00310032002c0032003500380030002c00310031002c0031003500390030000000900000009000000000000000500000000100635f01000000640062006f00000046004b005f005500730075006100720069006f004300610072006e00650074004e00610075007400690063006f005f005500730075006100720069006f0000000000000000000000c4020000000091000000910000009000000008000000011c5809201c58090000000000000000ad0700000000009200000092000000000000005c0000000100635f01000000640062006f00000046004b005f005500730075006100720069006f004300610072006e00650074004e00610075007400690063006f005f004300610072006e00650074004e00610075007400690063006f0000000000000000000000c4020000000093000000930000009200000008000000011b5809e01b58090000000000000000ad0700000000009400000094000000000000003e0000000100635f01000000640062006f00000046004b005f0045006d0062006100720063006100630069006f006e005f005500730075006100720069006f0000000000000000000000c4020000000095000000950000009400000008000000011b5809a01b58090000000000000000ad0700000000009a0000009a00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003100370035002c0031002c0031003700380035002c0035002c0031003100380035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003100370035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003100370035002c00310032002c0032003500380030002c00310031002c00310035003900300000009b0000009b00000000000000420000000100c97501000000640062006f00000046004b005f0045006d0070006c006500610064006f005f005400690070006f0045006d0070006c006500610064006f0000000000000000000000c402000000009c0000009c0000009b00000008000000011b5809201b58090000000000000000ad0700000000009d0000009d000000000000003c0000000100635f01000000640062006f00000046004b005f00410075006400690074006f007200690061005f0045006d0070006c006500610064006f0000000000000000000000c402000000009e0000009e0000009d00000008000000011a5809e01a58090000000000000000ad0700000000009f0000009f000000000000003e0000000100635f01000000640062006f00000046004b005f00410075006400690074006f007200690061005f0045006d0070006c006500610064006f00310000000000000000000000c40200000000a0000000a00000009f00000008000000011a5809a01a58090000000000000000ad070000000000a1000000a1000000000000003e0000000100635f01000000640062006f00000046004b005f00410075006400690074006f007200690061005f0045006d0070006c006500610064006f00320000000000000000000000c40200000000a2000000a2000000a100000008000000011a5809601a58090000000000000000ad070000000000a3000000a300000000000000580000000100790001000000640062006f00000046004b005f0045006d0062006100720063006100630069006f006e006500730044006500740061006c006c0065005f0045006d0062006100720063006100630069006f006e0000000000000000000000c40200000000a4000000a4000000a30000000800000001af5f0900af5f090000000000000000ad0f0000010000e10000000900000001000000080000002300000022000000220000000200000021000000590000006a000000240000000300000021000000230000001e000000260000000600000021000000220000001f0000000b000000070000000800000058000000590000005a0000000d000000590000007300000060000000300000000d0000002f0000002200000011000000280000000e0000002100000059000000700000002a000000100000002100000023000000240000002c00000011000000210000002200000025000000190000001200000018000000490000005800000013000000120000000d0000002200000023000000160000001500000015000000480000000200000032000000180000002f000000470000001d0000001d0000001b0000001c00000022000000230000001f0000001c0000001200000022000000230000005c0000002f000000590000001700000022000000430000002f000000420000002300000022000000400000002f000000050000002f000000240000003e0000002f00000005000000290000001e0000003c0000002f000000080000001e000000230000003a0000002f0000000f000000470000005a000000380000002f000000210000007a0000006f000000360000002f0000002e0000008000000061000000340000002f0000002f00000048000000020000008b0000002f00000088000000360000005a0000005f000000450000005e000000580000005d000000460000004500000042000000590000006000000049000000480000002f00000023000000240000004c0000004b0000002f00000000000000450000004f0000004e0000000f000000220000002300000054000000510000000f000000230000002200000052000000510000002f000000010000004400000057000000560000002f0000002200000035000000610000005e000000590000005c00000061000000760000006a0000006c0000006600000061000000900000006a0000008f0000005000000054000000940000006a000000820000001b00000012000000890000006c000000880000004e0000003f0000009b0000007e0000009a0000002e0000004f000000a30000008200000081000000940000007b00000092000000830000008f000000860000002d0000009d0000009a0000000400000003000000000000009f0000009a000000040000000700000004000000a10000009a000000040000000500000002000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000004d006900630072006f0073006f00660074002000530051004c00200053006500720076006500720020004d0061006e006100670065006d0065006e0074002000530074007500640069006f0022000000008005001c0000004400690061006700720061006d006100430046004600410041000000000226001200000045006d0070006c006500610064006f00000008000000640062006f000000000226002a0000005500730075006100720069006f004300610072006e00650074004e00610075007400690063006f00000008000000640062006f000000000226001e00000053006f006c0069006300690074007500640053006f00630069006f00000008000000640062006f000000000226001c0000004300610072006e00650074004e00610075007400690063006f00000008000000640062006f000000000226001800000045006d0062006100720063006100630069006f006e00000008000000640062006f000000000226002a00000045006d0062006100720063006100630069006f006e006500730044006500740061006c006c006500000008000000640062006f000000000226001a0000005400690070006f0045006d0070006c006500610064006f00000008000000640062006f000000000226001400000053006f006c00690063006900740075006400000008000000640062006f00000000022600100000005500730075006100720069006f00000008000000640062006f0000000002260022000000540072006100620061006a006f005f0043006f006e0074006100630074006f00000008000000640062006f0000000002260010000000540072006100620061006a006f00000008000000640062006f00000000022600140000005400690070006f0053006f00630069006f00000008000000640062006f00000000022600120000005400690070006f005300650078006f00000008000000640062006f000000000226001e0000005400690070006f0050006100720065006e0074006500730063006f00000008000000640062006f00000000022600200000005400690070006f00450073007400610064006f0043006900760069006c00000008000000640062006f000000000226001c0000005400690070006f0044006f00630075006d0065006e0074006f00000008000000640062006f000000000226001a0000005400690070006f0043006f006e0074006100630074006f00000008000000640062006f000000000226001e00000053006f00630069006f005f0043006f006e0074006100630074006f00000008000000640062006f000000000226000c00000053006f00630069006f00000008000000640062006f000000000226000a00000053004d0056005300000008000000640062006f000000000226002000000053006500720076006900630069006f004d0069006c006900740061007200000008000000640062006f0000000002260014000000500072006f00760069006e00630069006100000008000000640062006f000000000226000a0000005000610069007300000008000000640062006f00000000022600160000004e006100630069006d00690065006e0074006f00000008000000640062006f00000000022600080000004c006f006700000008000000640062006f00000000022600140000004c006f00630061006c006900640061006400000008000000640062006f000000000226001a00000047007200610064006f004d0069006c006900740061007200000008000000640062006f000000000226001c00000046007500650072007a0061004d0069006c006900740061007200000008000000640062006f0000000002260012000000460061006d0069006c00690061007200000008000000640062006f000000000226001400000045007300630061006c00610066006f006e00000008000000640062006f000000000226001400000044006f006d006900630069006c0069006f00000008000000640062006f000000000226001e00000043006c00750062005f00410063007400690076006900640061006400000008000000640062006f000000000226000a00000043006c0075006200000008000000640062006f000000000226000c00000043006100720067006f00000008000000640062006f00000000022600120000004100760061006c0061006e0074006500000008000000640062006f0000000002260014000000410075006400690074006f00720069006100000008000000640062006f000000000226000e000000410072006d00610064006100000008000000640062006f000000000226000a0000004100720065006100000008000000640062006f0000000002240022000000410063007400690076006900640061006400450078007400650072006e006100000008000000640062006f00000001000000d68509b3bb6bf2459ab8371664f0327008004e0000007b00310036003300340043004400440037002d0030003800380038002d0034003200450033002d0039004600410032002d004200360044003300320035003600330042003900310044007d00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010003000000000000000c0000000b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000062885214);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontacto`
--

CREATE TABLE IF NOT EXISTS `tipocontacto` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tipocontacto`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE IF NOT EXISTS `tipodocumento` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tipodocumento`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoempleado`
--

CREATE TABLE IF NOT EXISTS `tipoempleado` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tipoempleado`
--

INSERT INTO `tipoempleado` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Tesorero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoestadocivil`
--

CREATE TABLE IF NOT EXISTS `tipoestadocivil` (
  `id` decimal(18,0) NOT NULL,
  `nombre` char(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tipoestadocivil`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoparentesco`
--

CREATE TABLE IF NOT EXISTS `tipoparentesco` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tipoparentesco`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposexo`
--

CREATE TABLE IF NOT EXISTS `tiposexo` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tiposexo`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposocio`
--

CREATE TABLE IF NOT EXISTS `tiposocio` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `aud_id` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tiposocio`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo`
--

CREATE TABLE IF NOT EXISTS `trabajo` (
  `id` decimal(18,0) NOT NULL,
  `soc_id` decimal(18,0) DEFAULT NULL,
  `dom_id` decimal(18,0) DEFAULT NULL,
  `tct_id` decimal(18,0) DEFAULT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trabajo_domicilio` (`dom_id`),
  KEY `fk_trabajo_socio` (`soc_id`),
  KEY `fk_trabajo_trabajo_contacto` (`tct_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `trabajo`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo_contacto`
--

CREATE TABLE IF NOT EXISTS `trabajo_contacto` (
  `id` decimal(18,0) NOT NULL,
  `tco_id` decimal(18,0) NOT NULL,
  `contacto` varchar(50) CHARACTER SET utf8 NOT NULL,
  `aud_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trabajo_contacto_tipocontacto` (`tco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `trabajo_contacto`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `tipo`) VALUES
(1, 'atbezzi', '05b6c563e50dd4ed26bd4ec843d4ec4c33c8a88bbe6f03796a3d3f75e63999f6', '4f64060e3972f8c4', '1'),
(2, 'fabri', '1b5aaa767ece00b79997310423b4167d5061223be524055e7f03705bd8807606', '78c1e5bb7bd49fad', '2'),
(9, 'consul', 'bc437551bf1f4168088979b32d6781db6bf950912a70f5b534355eae87b0ca97', '1d2bb580641e5a14', '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` decimal(18,0) NOT NULL,
  `nombre` char(10) CHARACTER SET utf8 NOT NULL,
  `mail` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `usuario`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariocarnetnautico`
--

CREATE TABLE IF NOT EXISTS `usuariocarnetnautico` (
  `usuario_id` decimal(18,0) NOT NULL,
  `cnau_id` decimal(18,0) NOT NULL,
  PRIMARY KEY (`usuario_id`,`cnau_id`),
  KEY `fk_usuariocarnetnautico_carnetnautico` (`cnau_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `usuariocarnetnautico`
--


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `fk_auditoria_empleado2` FOREIGN KEY (`usr_baja_id`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `fk_auditoria_empleado` FOREIGN KEY (`usr_alta_id`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `fk_auditoria_empleado1` FOREIGN KEY (`usr_modificacion_id`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `avalante`
--
ALTER TABLE `avalante`
  ADD CONSTRAINT `fk_avalante_socio1` FOREIGN KEY (`soc_avalante_id`) REFERENCES `socio` (`id`),
  ADD CONSTRAINT `fk_avalante_socio` FOREIGN KEY (`soc_titular_id`) REFERENCES `socio` (`id`);

--
-- Filtros para la tabla `club_actividad`
--
ALTER TABLE `club_actividad`
  ADD CONSTRAINT `fk_club_actividad_socio` FOREIGN KEY (`soc_id`) REFERENCES `socio` (`id`),
  ADD CONSTRAINT `fk_club_actividad_actividadexterna` FOREIGN KEY (`aex_id`) REFERENCES `actividadexterna` (`id`),
  ADD CONSTRAINT `fk_club_actividad_club` FOREIGN KEY (`clu_id`) REFERENCES `club` (`id`);

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD CONSTRAINT `fk_domicilio_localidad` FOREIGN KEY (`loc_id`) REFERENCES `localidad` (`id`);

--
-- Filtros para la tabla `embarcacion`
--
ALTER TABLE `embarcacion`
  ADD CONSTRAINT `fk_embarcacion_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `embarcacionesdetalle`
--
ALTER TABLE `embarcacionesdetalle`
  ADD CONSTRAINT `fk_embarcacionesdetalle_embarcacion` FOREIGN KEY (`embarcacion_id`) REFERENCES `embarcacion` (`id`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_empleado_tipoempleado` FOREIGN KEY (`templeado_id`) REFERENCES `tipoempleado` (`id`);

--
-- Filtros para la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD CONSTRAINT `fk_familiar_tiposexo` FOREIGN KEY (`tse_id`) REFERENCES `tiposexo` (`id`),
  ADD CONSTRAINT `fk_familiar_socio` FOREIGN KEY (`soc_id`) REFERENCES `socio` (`id`),
  ADD CONSTRAINT `fk_familiar_tipoparentesco` FOREIGN KEY (`tpa_id`) REFERENCES `tipoparentesco` (`id`);

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `fk_localidad_provincia` FOREIGN KEY (`pro_id`) REFERENCES `provincia` (`id`);

--
-- Filtros para la tabla `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_log` FOREIGN KEY (`log_id`) REFERENCES `log` (`id`);

--
-- Filtros para la tabla `nacimiento`
--
ALTER TABLE `nacimiento`
  ADD CONSTRAINT `fk_nacimiento_localidad` FOREIGN KEY (`loc_id`) REFERENCES `localidad` (`id`);

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `fk_provincia_pais` FOREIGN KEY (`pai_id`) REFERENCES `pais` (`id`);

--
-- Filtros para la tabla `serviciomilitar`
--
ALTER TABLE `serviciomilitar`
  ADD CONSTRAINT `fk_serviciomilitar_socio` FOREIGN KEY (`soc_id`) REFERENCES `socio` (`id`),
  ADD CONSTRAINT `fk_serviciomilitar_area` FOREIGN KEY (`are_id`) REFERENCES `area` (`id`),
  ADD CONSTRAINT `fk_serviciomilitar_armada` FOREIGN KEY (`arm_id`) REFERENCES `armada` (`id`),
  ADD CONSTRAINT `fk_serviciomilitar_cargo` FOREIGN KEY (`car_id`) REFERENCES `cargo` (`id`),
  ADD CONSTRAINT `fk_serviciomilitar_escalafon` FOREIGN KEY (`esc_id`) REFERENCES `escalafon` (`id`),
  ADD CONSTRAINT `fk_serviciomilitar_fuerzamilitar` FOREIGN KEY (`fmi_id`) REFERENCES `fuerzamilitar` (`id`),
  ADD CONSTRAINT `fk_serviciomilitar_gradomilitar` FOREIGN KEY (`gmi_id`) REFERENCES `gradomilitar` (`id`);

--
-- Filtros para la tabla `smvs`
--
ALTER TABLE `smvs`
  ADD CONSTRAINT `fk_smvs_socio` FOREIGN KEY (`soc_id`) REFERENCES `socio` (`id`);

--
-- Filtros para la tabla `socio`
--
ALTER TABLE `socio`
  ADD CONSTRAINT `fk_socio_tiposocio` FOREIGN KEY (`tso_id`) REFERENCES `tiposocio` (`id`),
  ADD CONSTRAINT `fk_socio_domicilio` FOREIGN KEY (`dom_id`) REFERENCES `domicilio` (`id`),
  ADD CONSTRAINT `fk_socio_nacimiento` FOREIGN KEY (`nac_id`) REFERENCES `nacimiento` (`id`),
  ADD CONSTRAINT `fk_socio_socio` FOREIGN KEY (`soc_id`) REFERENCES `socio` (`id`),
  ADD CONSTRAINT `fk_socio_tipodocumento` FOREIGN KEY (`tdo_id`) REFERENCES `tipodocumento` (`id`),
  ADD CONSTRAINT `fk_socio_tipoestadocivil` FOREIGN KEY (`tec_id`) REFERENCES `tipoestadocivil` (`id`),
  ADD CONSTRAINT `fk_socio_tiposexo` FOREIGN KEY (`tse_id`) REFERENCES `tiposexo` (`id`);

--
-- Filtros para la tabla `socio_contacto`
--
ALTER TABLE `socio_contacto`
  ADD CONSTRAINT `fk_socio_contacto_tipocontacto` FOREIGN KEY (`tco_id`) REFERENCES `tipocontacto` (`id`),
  ADD CONSTRAINT `fk_socio_contacto_socio` FOREIGN KEY (`soc_id`) REFERENCES `socio` (`id`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `fk_solicitud_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `solicitudsocio`
--
ALTER TABLE `solicitudsocio`
  ADD CONSTRAINT `fk_solicitudsocio_solicitud` FOREIGN KEY (`soli_id`) REFERENCES `solicitud` (`id`),
  ADD CONSTRAINT `fk_solicitudsocio_socio` FOREIGN KEY (`soc_id`) REFERENCES `socio` (`id`);

--
-- Filtros para la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD CONSTRAINT `fk_trabajo_trabajo_contacto` FOREIGN KEY (`tct_id`) REFERENCES `trabajo_contacto` (`id`),
  ADD CONSTRAINT `fk_trabajo_domicilio` FOREIGN KEY (`dom_id`) REFERENCES `domicilio` (`id`),
  ADD CONSTRAINT `fk_trabajo_socio` FOREIGN KEY (`soc_id`) REFERENCES `socio` (`id`);

--
-- Filtros para la tabla `trabajo_contacto`
--
ALTER TABLE `trabajo_contacto`
  ADD CONSTRAINT `fk_trabajo_contacto_tipocontacto` FOREIGN KEY (`tco_id`) REFERENCES `tipocontacto` (`id`);

--
-- Filtros para la tabla `usuariocarnetnautico`
--
ALTER TABLE `usuariocarnetnautico`
  ADD CONSTRAINT `fk_usuariocarnetnautico_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_usuariocarnetnautico_carnetnautico` FOREIGN KEY (`cnau_id`) REFERENCES `carnetnautico` (`id`);
