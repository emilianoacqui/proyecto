-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-09-2025 a las 21:37:08
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
-- Base de datos: `sigie`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendarios`
--

CREATE TABLE `calendarios` (
  `id_calendario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` enum('entrega','examen') NOT NULL,
  `id_clase` int(11) NOT NULL,
  `creado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id_clase` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `año` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id_clase`, `nombre`, `año`) VALUES
(16, 'artistico', 2),
(15, 'bt', 1),
(10, 'Bt', 3),
(17, 'informatica', 2),
(13, 'linguistco', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` enum('general','clase') NOT NULL,
  `id_clase` int(11) DEFAULT NULL,
  `creado_por` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `titulo`, `fecha`, `tipo`, `id_clase`, `creado_por`, `imagen`) VALUES
(2, 'footbal', '2025-10-11', 'general', NULL, 9, '1755693142_paris-2024-olympics-soccer.jpg'),
(3, 'the flash', '2025-01-02', 'general', NULL, 9, '1755694096_aleksandra-svyripa-sWRzvuCFp8E-unsplash.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('alumno','profesor','coordinador','admin','gestor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password`, `rol`) VALUES
(9, 'Coordinador General', 'coordinador@scuolaitaliana.edu.uy', '$2y$10$31JSKkBqNAlchkzBwRUSK.uJBkcODYpIDOUY/MOrTBGZJhrvTdM5G', 'coordinador'),
(10, 'Marcos Méndez', 'mmendez@scuolaitaliana.edu.uy', '$2y$10$F4fFmhVnFpG7D6GniY8iJeMnWc8vy9L4V4Qj4rpTtRHAMuRTzfpHy', 'profesor'),
(14, '', 'mapache@scuolaitaliana.edu.uy', '$2y$10$o8vNKbzFyt8U9kK1DMPdIOVKZXTo4D.TE2FoiZZ0mYZhh1oT78Fau', 'alumno'),
(15, '', 'pelado@scuolaitaliana.edu.uy', '$2y$10$ZgJt882l5ArOC./JgugCveWqATQg5iSCuJylQuAoknh7Crqltj0Ja', 'profesor'),
(16, 'emilio', 'emilio@scuolaitaliana.edu.uy', '$2y$10$ZcQ/LGpoHO3/H8LnSHGkxeiC237HgMxYBWEFGAnom7o7I/R1CDUl2', 'alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_clases`
--

CREATE TABLE `usuarios_clases` (
  `id_usuario` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `rol_en_clase` enum('profesor','alumno') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_clases`
--

INSERT INTO `usuarios_clases` (`id_usuario`, `id_clase`, `rol_en_clase`) VALUES
(10, 15, 'profesor'),
(14, 10, 'alumno'),
(16, 13, 'alumno');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendarios`
--
ALTER TABLE `calendarios`
  ADD PRIMARY KEY (`id_calendario`),
  ADD KEY `id_clase` (`id_clase`),
  ADD KEY `creado_por` (`creado_por`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id_clase`),
  ADD UNIQUE KEY `uniq_clase_nombre_anio` (`nombre`,`año`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_clase` (`id_clase`),
  ADD KEY `creado_por` (`creado_por`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios_clases`
--
ALTER TABLE `usuarios_clases`
  ADD PRIMARY KEY (`id_usuario`,`id_clase`),
  ADD UNIQUE KEY `uniq_usuario_clase` (`id_usuario`,`id_clase`),
  ADD KEY `id_clase` (`id_clase`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendarios`
--
ALTER TABLE `calendarios`
  MODIFY `id_calendario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendarios`
--
ALTER TABLE `calendarios`
  ADD CONSTRAINT `calendarios_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`) ON DELETE CASCADE,
  ADD CONSTRAINT `calendarios_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`) ON DELETE SET NULL,
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios_clases`
--
ALTER TABLE `usuarios_clases`
  ADD CONSTRAINT `usuarios_clases_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarios_clases_ibfk_2` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
