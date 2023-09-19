-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2023 a las 17:27:35
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdregistrocivil`
--

-- --------------------------------------------------------
create table cargo(
  idCargo int not null auto_increment primary key
  estado tinyint(4) DEFAULT NULL,
)
create table oferta(
  idOferta int not null auto_increment primary key,
  idCargo int not null,
  descripcion string not DEFAULT NULL,
  fecha_inicio date DEFAULT NULL,
  fecha_fin date DEFAULT NULL,
  estado tinyint(4) DEFAULT NULL,
  foreign key(idCargo) references oferta(idCargo)
)
create table entrevista(
  idEntrevista int not null auto_increment primary key,
  DNI char(8) NOT NULL,
  idOferta int not null,
  fecha date DEFAULT NULL,
  observacion string not DEFAULT NULL,
  estado tinyint(4) DEFAULT NULL,
  foreign key(idOferta) references oferta(idOferta),
  foreign key(DNI) references persona(DNI)
  )


--
-- Estructura de tabla para la tabla `acta`
--

CREATE TABLE `acta` (
  `idActa` int(11) NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `observacion` varchar(30) DEFAULT NULL,
  `lugar_ocurrencia` varchar(30) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `nombreRegistradorCivil` varchar(50) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `acta`
--

INSERT INTO `acta` (`idActa`, `fecha_registro`, `observacion`, `lugar_ocurrencia`, `estado`, `nombreRegistradorCivil`, `localidad`) VALUES
(1, '2023-02-27', 'ninguna', 'c', 0, 'Renatos', 'agg'),
(2, '2023-03-06', 'bff', 'bff', 1, 'Renatos', 'bff'),
(3, '2023-02-27', 'egg', 'egg', 1, 'Renatos', 'egg'),
(4, '2023-03-09', 'Ninguna', 'Trujillo', 1, 'Renatos', 'Trujillo'),
(5, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2023-03-10', 'Ninguna', 'Trujillo', 1, 'Renatos', 'Trujillo'),
(7, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '2023-03-22', 'Ninguna', 'Lima', 1, 'Renatos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_defuncion`
--

CREATE TABLE `acta_defuncion` (
  `idActa` int(11) NOT NULL,
  `fecha_fallecido` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `dniFallecido` char(8) DEFAULT NULL,
  `nombreDeclarante` varchar(50) DEFAULT NULL,
  `firma_declarante` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `acta_defuncion`
--

INSERT INTO `acta_defuncion` (`idActa`, `fecha_fallecido`, `edad`, `dniFallecido`, `nombreDeclarante`, `firma_declarante`) VALUES
(1, '2023-01-30', 0, '11111111', 'Dolores Pecho Barba', '/storage/ArchivosDefunsion/AKhsGKx6FVRFTvuDTZHNg9RfHSYeiX6l4hjUCfzr.jpg'),
(2, '2023-02-15', 0, '22222222', 'Dolores Pecho Barba', '/storage/ArchivosDefunsion/a3Eot4zimGAKO5j3jznBEQ0YkISuPQYYjvehFojL.jpg'),
(3, '2023-02-08', 0, '44444444', 'Pedro Amor Jurado', '/storage/ArchivosDefunsion/MofRgqtaMWrv82xdm3cg0DcwdRyCdlyJoq77t7Kc.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_matrimonio`
--

CREATE TABLE `acta_matrimonio` (
  `idActa` int(11) NOT NULL,
  `fecha_matrimonio` date DEFAULT NULL,
  `DNIEsposo` char(8) DEFAULT NULL,
  `DNIEsposa` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `acta_matrimonio`
--

INSERT INTO `acta_matrimonio` (`idActa`, `fecha_matrimonio`, `DNIEsposo`, `DNIEsposa`) VALUES
(8, '2023-03-21', '40000000', '33333333');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_nacimiento`
--

CREATE TABLE `acta_nacimiento` (
  `idActa` int(11) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `DNIPadre` char(8) DEFAULT NULL,
  `DNIMadre` char(8) DEFAULT NULL,
  `nombres` varchar(30) DEFAULT NULL,
  `domicilio` varchar(30) DEFAULT NULL,
  `sexo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `acta_nacimiento`
--

INSERT INTO `acta_nacimiento` (`idActa`, `fecha_nacimiento`, `DNIPadre`, `DNIMadre`, `nombres`, `domicilio`, `sexo`) VALUES
(4, '2023-03-06', '55555555', '33333333', 'Crsithian aldair Fuertes Pecho', 'Garcilazo de la Vega 123', 'M'),
(6, '2023-02-27', '40000000', '33333333', 'Percy Fuertes Pecho', 'Garcilazo de la Vega 123', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_persona`
--

CREATE TABLE `acta_persona` (
  `idActaPersona` int(11) NOT NULL,
  `idActa` int(11) NOT NULL,
  `DNI` char(8) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `funcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `acta_persona`
--

INSERT INTO `acta_persona` (`idActaPersona`, `idActa`, `DNI`, `estado`, `funcion`) VALUES
(1, 1, '11111111', 0, NULL),
(2, 1, '33333333', 0, NULL),
(3, 2, '22222222', 1, NULL),
(4, 2, '33333333', 1, NULL),
(5, 3, '44444444', 1, NULL),
(6, 3, '66666666', 1, NULL),
(7, 4, '55555555', 1, NULL),
(8, 4, '33333333', 1, NULL),
(9, 4, '40000000', 1, NULL),
(10, 6, '40000000', 1, NULL),
(11, 6, '33333333', 1, NULL),
(12, 6, '60000000', 1, NULL),
(13, 8, '33333333', 1, 'Esposa'),
(14, 8, '40000000', 1, 'Esposo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_registro`
--

CREATE TABLE `ficha_registro` (
  `idficha` int(11) NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `ruta_certificado` longtext DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `idtipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ficha_registro`
--

INSERT INTO `ficha_registro` (`idficha`, `fecha_registro`, `ruta_certificado`, `estado`, `idtipo`) VALUES
(1, '2023-02-27', '/storage/ArchivosCertificados/mfos1lcAF16We2vVL35IAMngPQ2jDBQzlfI0SG0u.jpg', 'Aprobado', 3),
(2, '2023-02-27', '/storage/ArchivosCertificados/H1TqSI6IgBlCoyfyp3mpoHFKRvCSLSehuF1iQIqE.jpg', 'Aprobado', 3),
(3, '2023-02-27', '/storage/ArchivosCertificados/qzlLs57hYZHwiJR6ZMrFGEHzYsVzKcJC7lZeHF3N.jpg', 'Aprobado', 3),
(4, '2023-02-28', '/storage/ArchivosCertificados/yYvxj5qLOyLCjgmNXWytL8ctCs2J23XNjcwmAOq6.jpg', 'Aprobado', 1),
(5, '2023-02-28', '/storage/ArchivosCertificados/wqqU1paIdn6JULJLrRUxG2bS9PuDPNFGxyYQwTlY.jpg', 'Pendiente', 3),
(6, '2023-03-09', '/storage/ArchivosCertificados/KD0eHelB5jwItRXXJvRVktycCh6mH8mGPZQQnIJy.jpg', 'Aprobado', 1),
(7, '2023-03-22', '/storage/ArchivosCertificados/pSiA9LfltnI4hlSfP3QDkt33PsR0uNneiDybc1T2.jpg', 'Pendiente', 1),
(8, '2023-03-22', '/storage/ArchivosCertificados/NMuL8vKjgOtwX4jP1PCZyobD7OnATMS7MVSXcat3.jpg', 'Aprobado', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_solicitud`
--

CREATE TABLE `lista_solicitud` (
  `idActaSolicitada` int(11) NOT NULL,
  `idActa` int(11) NOT NULL,
  `idSolicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lista_solicitud`
--

INSERT INTO `lista_solicitud` (`idActaSolicitada`, `idActa`, `idSolicitud`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `DNI` char(8) NOT NULL,
  `Apellido_Paterno` varchar(20) DEFAULT NULL,
  `Apellido_Materno` varchar(20) DEFAULT NULL,
  `Nombres` varchar(30) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `estadocivil` varchar(20) DEFAULT NULL,
  `nacionalidad` varchar(30) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`DNI`, `Apellido_Paterno`, `Apellido_Materno`, `Nombres`, `sexo`, `estadocivil`, `nacionalidad`, `estado`, `direccion`, `fecha_nacimiento`) VALUES
('11111111', 'Fina', 'Segura', 'Eva', 'F', 'Soltera', 'Peruana', 0, 'Hermanos Angulos 123', '2010-03-06'),
('22222222', 'Cura', 'Sacristan', 'Rosario', 'F', 'Soltera', 'Peruana', 0, 'Jose Olaya 123', '2010-03-06'),
('33333333', 'Pecho', 'Barba', 'Dolores', 'F', 'Soltera', 'Venezolana', 1, 'Garcilazo de la Vega 123', '2000-03-06'),
('40000000', 'Fuertes', 'Pecho', 'Crsithian aldair', 'M', NULL, NULL, 1, 'Garcilazo de la Vega 123', '2000-03-06'),
('44444444', 'Seisdedos', 'Pies Planos', 'Alfonso', 'M', 'Soltero', 'Peruano', 0, 'Los Incas 123', '1999-12-31'),
('55555555', 'Fuertes', 'Barrigas', 'Jose', 'M', 'Soltero', 'Ruso', 1, 'Los Incas 254', '1999-12-31'),
('60000000', 'Fuertes', 'Pecho', 'Percy', 'M', NULL, NULL, 1, 'Garcilazo de la Vega 123', '2000-02-27'),
('66666666', 'Amor', 'Jurado', 'Pedro', 'M', 'Soltero', 'Peruano', 0, 'Los Incas 654', NULL),
('77777777', 'Marco', 'Gol', 'Miguel', 'M', 'Soltero', 'Peruano', 1, 'Jose Olaya 594', NULL),
('88888888', 'Diaz', 'Festivo', 'Domingo', 'M', 'Soltero', 'Peruano', 1, 'Jose Olata 789', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombreRol`) VALUES
(1, 'MesaPartes'),
(2, 'Registrador'),
(3, 'Administrador'),
(4, 'Administrador de Sistemas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idSolicitud` int(11) NOT NULL,
  `DNISolicitante` char(8) NOT NULL,
  `fechaSolicitud` date DEFAULT NULL,
  `horaSolicitud` time DEFAULT NULL,
  `observacion` varchar(30) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `pago` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`idSolicitud`, `DNISolicitante`, `fechaSolicitud`, `horaSolicitud`, `observacion`, `estado`, `pago`) VALUES
(1, '11111111', '2023-03-09', NULL, 'ninguna', 1, '0'),
(2, '11111111', '2023-03-22', NULL, 'Ninguna', 1, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoficha`
--

CREATE TABLE `tipoficha` (
  `idtipo` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoficha`
--

INSERT INTO `tipoficha` (`idtipo`, `nombre`) VALUES
(1, 'Nacimiento'),
(2, 'Matrimonio'),
(3, 'Defunción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotoPerfil` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idRol` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `fotoPerfil`, `email_verified_at`, `password`, `idRol`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Renato', 'renaenciso@gmail.com', NULL, NULL, '$2y$10$d42YNmxFM14NuLTZAfLtFeefUy.WgXvWTzC3WSt2WSsU5adE2basi', 1, NULL, '2023-02-27 23:24:05', '2023-02-27 23:24:05'),
(2, 'Renatos', 't053300320@unitru.edu.pe', NULL, NULL, '$2y$10$tDTJyzErW6os6GjjNHySC.R/iSzBdTgAQplDNZFRTrVIWLQIi559m', 2, NULL, '2023-02-27 23:24:54', '2023-02-27 23:24:54'),
(3, 'Renato', 'demo@gmail.com', NULL, NULL, '$2y$10$SOvkzeHwjyW2xokqi4eMi.W4kzspgH2stQ.aoj5Ni3O3NHjllfPdC', 1, NULL, '2023-09-19 13:21:24', '2023-09-19 13:21:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acta`
--
ALTER TABLE `acta`
  ADD PRIMARY KEY (`idActa`);

--
-- Indices de la tabla `acta_defuncion`
--
ALTER TABLE `acta_defuncion`
  ADD PRIMARY KEY (`idActa`);

--
-- Indices de la tabla `acta_matrimonio`
--
ALTER TABLE `acta_matrimonio`
  ADD PRIMARY KEY (`idActa`);

--
-- Indices de la tabla `acta_nacimiento`
--
ALTER TABLE `acta_nacimiento`
  ADD PRIMARY KEY (`idActa`);

--
-- Indices de la tabla `acta_persona`
--
ALTER TABLE `acta_persona`
  ADD PRIMARY KEY (`idActaPersona`),
  ADD KEY `idActa` (`idActa`),
  ADD KEY `DNI` (`DNI`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `ficha_registro`
--
ALTER TABLE `ficha_registro`
  ADD PRIMARY KEY (`idficha`),
  ADD KEY `idtipo` (`idtipo`);

--
-- Indices de la tabla `lista_solicitud`
--
ALTER TABLE `lista_solicitud`
  ADD PRIMARY KEY (`idActaSolicitada`),
  ADD KEY `idActa` (`idActa`),
  ADD KEY `idSolicitud` (`idSolicitud`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idSolicitud`),
  ADD KEY `DNISolicitante` (`DNISolicitante`);

--
-- Indices de la tabla `tipoficha`
--
ALTER TABLE `tipoficha`
  ADD PRIMARY KEY (`idtipo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_idrol_foreign` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acta_persona`
--
ALTER TABLE `acta_persona`
  MODIFY `idActaPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ficha_registro`
--
ALTER TABLE `ficha_registro`
  MODIFY `idficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `lista_solicitud`
--
ALTER TABLE `lista_solicitud`
  MODIFY `idActaSolicitada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoficha`
--
ALTER TABLE `tipoficha`
  MODIFY `idtipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acta`
--
ALTER TABLE `acta`
  ADD CONSTRAINT `acta_ibfk_1` FOREIGN KEY (`idActa`) REFERENCES `ficha_registro` (`idficha`);

--
-- Filtros para la tabla `acta_defuncion`
--
ALTER TABLE `acta_defuncion`
  ADD CONSTRAINT `acta_defuncion_ibfk_1` FOREIGN KEY (`idActa`) REFERENCES `acta` (`idActa`);

--
-- Filtros para la tabla `acta_matrimonio`
--
ALTER TABLE `acta_matrimonio`
  ADD CONSTRAINT `acta_matrimonio_ibfk_1` FOREIGN KEY (`idActa`) REFERENCES `acta` (`idActa`);

--
-- Filtros para la tabla `acta_nacimiento`
--
ALTER TABLE `acta_nacimiento`
  ADD CONSTRAINT `acta_nacimiento_ibfk_1` FOREIGN KEY (`idActa`) REFERENCES `acta` (`idActa`);

--
-- Filtros para la tabla `acta_persona`
--
ALTER TABLE `acta_persona`
  ADD CONSTRAINT `acta_persona_ibfk_1` FOREIGN KEY (`idActa`) REFERENCES `acta` (`idActa`),
  ADD CONSTRAINT `acta_persona_ibfk_2` FOREIGN KEY (`DNI`) REFERENCES `persona` (`DNI`);

--
-- Filtros para la tabla `ficha_registro`
--
ALTER TABLE `ficha_registro`
  ADD CONSTRAINT `ficha_registro_ibfk_1` FOREIGN KEY (`idtipo`) REFERENCES `tipoficha` (`idtipo`);

--
-- Filtros para la tabla `lista_solicitud`
--
ALTER TABLE `lista_solicitud`
  ADD CONSTRAINT `lista_solicitud_ibfk_1` FOREIGN KEY (`idActa`) REFERENCES `acta` (`idActa`),
  ADD CONSTRAINT `lista_solicitud_ibfk_2` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitud` (`idSolicitud`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`DNISolicitante`) REFERENCES `persona` (`DNI`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
