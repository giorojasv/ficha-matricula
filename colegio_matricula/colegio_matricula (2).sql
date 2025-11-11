-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-11-2025 a las 16:38:22
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
-- Base de datos: `colegio_matricula`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `nombre_social` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `curso` varchar(50) NOT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `poblacion` varchar(100) DEFAULT NULL,
  `comuna` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_apoderados`
--

CREATE TABLE `alumnos_apoderados` (
  `id_alumno_apoderado` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_apoderado` int(11) NOT NULL,
  `tipo` enum('titular','suplente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentes_alumno`
--

CREATE TABLE `antecedentes_alumno` (
  `id_antecedente` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `retira_emergencia_1_nombre` varchar(255) DEFAULT NULL,
  `retira_emergencia_1_telefono` varchar(15) DEFAULT NULL,
  `retira_emergencia_2_nombre` varchar(255) DEFAULT NULL,
  `retira_emergencia_2_telefono` varchar(15) DEFAULT NULL,
  `alumno_vive_con` varchar(255) DEFAULT NULL,
  `n_integrantes_familia` int(11) DEFAULT 0,
  `n_hijos` int(11) DEFAULT 0,
  `rsh_puntaje` varchar(20) DEFAULT NULL,
  `restriccion_judicial` tinyint(1) DEFAULT 0,
  `restriccion_motivo` text DEFAULT NULL,
  `diagnostico` tinyint(1) DEFAULT 0,
  `diagnostico_documento` tinyint(1) DEFAULT 0,
  `tratamiento` tinyint(1) DEFAULT 0,
  `enfermedad` text DEFAULT NULL,
  `alergia_medicamento` text DEFAULT NULL,
  `acepta_reglamento` tinyint(1) DEFAULT 0,
  `acepta_no_pie` tinyint(1) DEFAULT 0,
  `acepta_mensajeria` tinyint(1) DEFAULT 0,
  `acepta_fotos_rrss` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderados`
--

CREATE TABLE `apoderados` (
  `id_apoderado` int(11) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `poblacion` varchar(100) DEFAULT NULL,
  `nivel_escolar` varchar(100) DEFAULT NULL,
  `profesion_actividad` varchar(100) DEFAULT NULL,
  `parentesco` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `apoderados`
--

INSERT INTO `apoderados` (`id_apoderado`, `rut`, `nombre`, `telefono`, `correo`, `direccion`, `poblacion`, `nivel_escolar`, `profesion_actividad`, `parentesco`) VALUES
(1, '17430810-1', 'GIOVANNI ROJAS VALDIVIA', '+596952372071', 'GIOVANNI.ROJASVALDIVIA@GMAIL.COM', 'JOSE MIGUEL CARRERA 1595', 'NO TIENE', 'UNIVERSITARIA', 'PROGRAMDOR', 'PADRE'),
(2, '16866537-7', 'FRANCISCA PEIME', '+596952372071', 'GIOVANNI.ROJASVALDIVIA@GMAIL.COM', 'JOSE MIGUEL CARRERA 1595', 'NO TIENE', 'UNIVERSITARIA', 'PROGRAMDOR', 'PADRE'),
(3, '12345678-9', 'JUENA PEREZ', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password_hash`, `nombre`) VALUES
(1, 'admin@colegio.cl', '$2y$10$gKDFNGkGy39lDt666OJp9e.okDKICLnvoFoWKFFW9WIm961TH8pp.', 'Admin General');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD UNIQUE KEY `uk_rut_alumno` (`rut`);

--
-- Indices de la tabla `alumnos_apoderados`
--
ALTER TABLE `alumnos_apoderados`
  ADD PRIMARY KEY (`id_alumno_apoderado`),
  ADD UNIQUE KEY `idx_tipo_alumno` (`id_alumno`,`tipo`),
  ADD KEY `id_apoderado` (`id_apoderado`);

--
-- Indices de la tabla `antecedentes_alumno`
--
ALTER TABLE `antecedentes_alumno`
  ADD PRIMARY KEY (`id_antecedente`),
  ADD UNIQUE KEY `idx_id_alumno` (`id_alumno`);

--
-- Indices de la tabla `apoderados`
--
ALTER TABLE `apoderados`
  ADD PRIMARY KEY (`id_apoderado`),
  ADD UNIQUE KEY `uk_rut_apoderado` (`rut`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `uk_email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `alumnos_apoderados`
--
ALTER TABLE `alumnos_apoderados`
  MODIFY `id_alumno_apoderado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `antecedentes_alumno`
--
ALTER TABLE `antecedentes_alumno`
  MODIFY `id_antecedente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `apoderados`
--
ALTER TABLE `apoderados`
  MODIFY `id_apoderado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos_apoderados`
--
ALTER TABLE `alumnos_apoderados`
  ADD CONSTRAINT `alumnos_apoderados_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`) ON DELETE CASCADE,
  ADD CONSTRAINT `alumnos_apoderados_ibfk_2` FOREIGN KEY (`id_apoderado`) REFERENCES `apoderados` (`id_apoderado`) ON DELETE CASCADE;

--
-- Filtros para la tabla `antecedentes_alumno`
--
ALTER TABLE `antecedentes_alumno`
  ADD CONSTRAINT `antecedentes_alumno_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
