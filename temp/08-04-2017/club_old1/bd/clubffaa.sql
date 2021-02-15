-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2017 a las 19:37:31
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clubffaa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avalantes`
--

CREATE TABLE `avalantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `socioavala_id` int(10) UNSIGNED NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcionbreve` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `derechovoto` enum('Si','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Si',
  `importeinscripcion` decimal(11,2) NOT NULL,
  `importecuota` decimal(11,2) NOT NULL,
  `importefamiliar` decimal(11,2) NOT NULL,
  `cantidadfamiliar` int(11) NOT NULL,
  `cantidadavalante` int(11) NOT NULL,
  `tipo` enum('Militar','Civil','Pensionista') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Militar',
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobradores`
--

CREATE TABLE `cobradores` (
  `id` int(10) UNSIGNED NOT NULL,
  `zona_id` int(10) UNSIGNED NOT NULL,
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
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `embarcaciones`
--

CREATE TABLE `embarcaciones` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `inspeccion` datetime NOT NULL,
  `elementos` text COLLATE utf8_unicode_ci NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiares`
--

CREATE TABLE `familiares` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dni` int(11) NOT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `parentesco` enum('Conyuge','Padre','Hijo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Conyuge',
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_10_23_224804_create_provincias_table', 1),
(4, '2016_10_23_224805_create_localidades_table', 1),
(5, '2016_10_23_224806_create_zonas_table', 1),
(6, '2016_10_23_224850_create_cobradores_table', 1),
(7, '2016_10_23_224935_create_categorias_table', 1),
(8, '2016_10_23_224940_create_socios_table', 1),
(9, '2016_10_23_224944_create_solicitudes_table', 1),
(10, '2016_10_24_001339_create_extensiones_table', 1),
(11, '2016_10_24_001401_create_embarcaciones_table', 1),
(12, '2016_10_28_003253_create_pagos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `tipocomprobante` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seriecomprobante` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numerocomprobante` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `impuesto` decimal(11,2) NOT NULL,
  `importetotal` decimal(11,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_detalle`
--

CREATE TABLE `pago_detalle` (
  `id` int(10) UNSIGNED NOT NULL,
  `pago_id` int(10) UNSIGNED NOT NULL,
  `cuota` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `importe` decimal(11,2) NOT NULL,
  `descuento` decimal(11,2) NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `domicilio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nsocio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio_id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('Ingreso','Egreso') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Ingreso',
  `estado` enum('Aprobado','No aprobado','Pendiente') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_detalle`
--

CREATE TABLE `solicitud_detalle` (
  `id` int(10) UNSIGNED NOT NULL,
  `solicitud_id` int(10) UNSIGNED NOT NULL,
  `presidente` int(10) UNSIGNED NOT NULL,
  `voto` enum('Aprobado','No aprobado') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Aprobado',
  `fecha` datetime NOT NULL,
  `observacion` text COLLATE utf8_unicode_ci,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `fechaalta` date DEFAULT NULL,
  `idaltausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaupdate` date DEFAULT NULL,
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `idmodificausuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `avalantes`
--
ALTER TABLE `avalantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avalantes_socio_id_foreign` (`socio_id`),
  ADD KEY `avalantes_socioavala_id_foreign` (`socioavala_id`);

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
  ADD KEY `cobradores_zona_id_foreign` (`zona_id`),
  ADD KEY `cobradores_localidadnacimiento_foreign` (`localidadnacimiento`),
  ADD KEY `cobradores_localidad_id_foreign` (`localidad_id`);

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
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `localidades_provincia_id_foreign` (`provincia_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_socio_id_foreign` (`socio_id`);

--
-- Indices de la tabla `pago_detalle`
--
ALTER TABLE `pago_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pago_detalle_pago_id_foreign` (`pago_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfiles_usuario_id_foreign` (`usuario_id`);

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
  ADD UNIQUE KEY `usuarios_email_unique` (`email`);

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
-- AUTO_INCREMENT de la tabla `avalantes`
--
ALTER TABLE `avalantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cobradores`
--
ALTER TABLE `cobradores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `embarcaciones`
--
ALTER TABLE `embarcaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `familiares`
--
ALTER TABLE `familiares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pago_detalle`
--
ALTER TABLE `pago_detalle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sociosc`
--
ALTER TABLE `sociosc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sociosm`
--
ALTER TABLE `sociosm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sociosp`
--
ALTER TABLE `sociosp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `solicitud_detalle`
--
ALTER TABLE `solicitud_detalle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `avalantes`
--
ALTER TABLE `avalantes`
  ADD CONSTRAINT `avalantes_socio_id_foreign` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avalantes_socioavala_id_foreign` FOREIGN KEY (`socioavala_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cobradores`
--
ALTER TABLE `cobradores`
  ADD CONSTRAINT `cobradores_localidad_id_foreign` FOREIGN KEY (`localidad_id`) REFERENCES `localidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cobradores_localidadnacimiento_foreign` FOREIGN KEY (`localidadnacimiento`) REFERENCES `localidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cobradores_zona_id_foreign` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`) ON DELETE CASCADE;

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
-- Filtros para la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD CONSTRAINT `localidades_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_socio_id_foreign` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pago_detalle`
--
ALTER TABLE `pago_detalle`
  ADD CONSTRAINT `pago_detalle_pago_id_foreign` FOREIGN KEY (`pago_id`) REFERENCES `pagos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD CONSTRAINT `perfiles_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

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
