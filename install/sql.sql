-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: 10.20.10.105:3306
-- Tiempo de generación: 02-06-2022 a las 18:05:46
-- Versión del servidor: 8.0.19-0ubuntu5
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `sintesieva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instance_status`
--

CREATE TABLE `instance_status` (
  `id` int NOT NULL,
  `id.instance` int NOT NULL,
  `state` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `instance_status`
--

INSERT INTO `instance_status` (`id`, `id.instance`, `state`) VALUES
(224, 224, 1),
(225, 225, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instancia`
--

CREATE TABLE `instancia` (
  `id` int NOT NULL,
  `name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user` int NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `instancia`
--

INSERT INTO `instancia` (`id`, `name`, `user`, `link`) VALUES
(224, 'benja', 1, 'https://github.com/cristinafsanz/github-pages'),
(225, 'bholab', 1, 'https://github.com/cristinafsanz/github-pages');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, '<i class=\"material-symbols-outlined\" style=\"color:green !important\">directions_run</i>'),
(2, '<i class=\"material-symbols-outlined\" style=\"color:red !important\">pan_tool</i>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `passwd`) VALUES
(1, 'vpanal', '$2y$10$EDpNogtgim3mXk1qD6Wpp.6hIe6JjvBDqhXuW9rxToDA.xn6vHfuu'),
(168, 'elpato', '$2y$10$8yYsitlk4U8UnmLjkfEyAeq5L5EzUoZLTpyiyV90FPWdfprrrUXMi'),
(169, 'arnsu', '$2y$10$dIE9jPJHjWP3Mm.WJ8nnQuwmPU8yP/7fZy4xIzoYOf48p.5NlMoma');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `instance_status`
--
ALTER TABLE `instance_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id.instance` (`id.instance`),
  ADD KEY `idinstancestatus` (`id.instance`),
  ADD KEY `idstatustype` (`state`);

--
-- Indices de la tabla `instancia`
--
ALTER TABLE `instancia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `instance_status`
--
ALTER TABLE `instance_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT de la tabla `instancia`
--
ALTER TABLE `instancia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `instance_status`
--
ALTER TABLE `instance_status`
  ADD CONSTRAINT `idinstancestatus` FOREIGN KEY (`id.instance`) REFERENCES `instancia` (`id`),
  ADD CONSTRAINT `idstatustype` FOREIGN KEY (`state`) REFERENCES `status` (`id`);

--
-- Filtros para la tabla `instancia`
--
ALTER TABLE `instancia`
  ADD CONSTRAINT `instancia_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`);
COMMIT;
INSERT INTO `status` (`id`, `status`) VALUES
(1, '<i class=\"material-symbols-outlined\" style=\"color:green !important\">directions_run</i>'),
(2, '<i class=\"material-symbols-outlined\" style=\"color:red !important\">pan_tool</i>');
