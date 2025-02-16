-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2025 a las 01:42:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tutrasteroenhuelva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `averias`
--

CREATE TABLE `averias` (
  `id_averia` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `trastero_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `averias`
--

INSERT INTO `averias` (`id_averia`, `fecha`, `descripcion`, `estado`, `trastero_id`) VALUES
(1, '2025-02-02', 'Puerta con golpe', 'A la Espera Reparación', 23),
(39, '2025-02-09', 'Averia puerta', 'En Reparación', 4),
(44, '2025-02-10', 'puerta averiada', 'A la Espera Reparación', 3),
(45, '2025-02-10', 'pared desprendida', 'A la Espera Reparación', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE `recibos` (
  `id_recibo` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `concepto` varchar(50) DEFAULT NULL,
  `pagado` tinyint(1) DEFAULT NULL,
  `formaPago` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `trastero_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recibos`
--

INSERT INTO `recibos` (`id_recibo`, `fecha`, `concepto`, `pagado`, `formaPago`, `user_id`, `trastero_id`) VALUES
(222, '2024-04-01', 'Alta cliente', NULL, NULL, 315, 2),
(223, '2024-04-01', 'Mensualidad Abril', 1, 'efectivo', 315, 2),
(224, '2024-05-02', 'Mensualidad Mayo', 1, 'efectivo', 315, 2),
(225, '2024-06-02', 'Mensualidad Junio', 1, 'efectivo', 315, 2),
(226, '2024-07-02', 'Mensualidad julio', 1, 'efectivo', 315, 2),
(227, '2024-08-02', 'Mensualidad Agosto', 1, 'efectivo', 315, 2),
(228, '2024-09-02', 'Mensualidad septiembre', 1, 'efectivo', 315, 2),
(229, '2024-10-02', 'Mensualidad octubre', 1, 'efectivo', 315, 2),
(230, '2024-11-02', 'Mensualidad noviembre', 1, 'efectivo', 315, 2),
(231, '2024-12-02', 'Mensualidad diciembre', 1, 'efectivo', 315, 2),
(232, '2025-01-02', 'Mensualidad Enero', 1, 'efectivo', 315, 2),
(233, '2025-02-02', 'Mensualidad Febrero', 1, 'efectivo', 315, 2),
(234, '2024-05-02', 'Alta cliente', NULL, NULL, 316, 3),
(235, '0000-00-00', 'Mensualidad Mayo', 1, 'banco', 316, 3),
(236, '2024-06-02', 'Mensualidad Junio', 1, 'banco', 316, 3),
(237, '2024-07-02', 'Mensualidad Julio', 1, 'banco', 316, 3),
(238, '2024-08-02', 'Mensualidad Agosto', 1, 'banco', 316, 3),
(239, '2024-09-02', 'Mensualidad septiembre', 1, 'banco', 316, 3),
(240, '2024-10-02', 'Mensualidad octubre', 1, 'banco', 316, 3),
(241, '2024-11-02', 'Mensualidad noviembre', 1, 'banco', 316, 3),
(242, '2024-12-02', 'Mensualidad diciembre', 1, 'banco', 316, 3),
(243, '2025-01-02', 'Mensualidad Enero', 1, 'banco', 316, 3),
(244, '2025-02-02', 'Mensualidad Febrero', 1, 'banco', 316, 3),
(245, '2024-07-02', 'Alta cliente', NULL, NULL, 320, 7),
(246, '2024-07-02', 'Mensualidad julio', 1, 'bizum', 320, 7),
(247, '2024-08-02', 'Mensualidad Agosto', 1, 'bizum', 320, 7),
(248, '2024-09-02', 'Mensualidad septiembre', 1, 'bizum', 320, 7),
(249, '2024-10-02', 'Mensualidad octubre', 1, 'bizum', 320, 7),
(250, '2024-11-02', 'Mensualidad noviembre', 1, 'efectivo', 320, 7),
(251, '2024-12-02', 'Mensualidad diciembre', 1, 'bizum', 320, 7),
(252, '2025-01-02', 'Mensualidad Enero', 1, 'banco', 320, 7),
(253, '2025-02-02', 'Mensualidad Febrero', 1, 'bizum', 320, 7),
(254, '2024-09-02', 'Alta cliente', NULL, NULL, 336, 23),
(255, '2024-10-02', 'Mensualidad septiembre', 1, 'banco', 336, 23),
(256, '2024-10-02', 'Mensualidad octubre', 1, 'bizum', 336, 23),
(257, '2024-11-02', 'Mensualidad noviembre', 1, 'banco', 336, 23),
(258, '2024-12-02', 'Mensualidad diciembre', 1, 'banco', 336, 23),
(259, '2025-01-02', 'Mensualidad Enero', 1, 'bizum', 336, 23),
(260, '2025-02-02', 'Mensualidad Febrero', 1, 'efectivo', 336, 23),
(262, '2024-10-02', 'Alta cliente', NULL, NULL, 323, 10),
(263, '2024-10-02', 'Mensualidad octubre', 1, 'bizum', 323, 10),
(264, '2024-11-02', 'Mensualidad noviembre', 1, 'bizum', 323, 10),
(265, '2024-12-02', 'Mensualidad diciembre', 1, 'bizum', 323, 10),
(266, '2025-01-02', 'Mensualidad Enero', 1, 'bizum', 323, 10),
(267, '2025-01-02', 'Mensualidad Enero', 1, 'bizum', 323, 10),
(268, '2024-10-02', 'Alta cliente', NULL, NULL, 325, 12),
(269, '2024-10-02', 'Mensualidad octubre', 1, 'bizum', 325, 12),
(270, '2024-11-02', 'Mensualidad noviembre', 1, 'efectivo', 325, 12),
(271, '2024-12-02', 'Mensualidad diciembre', 1, 'efectivo', 325, 12),
(272, '2025-01-02', 'Mensualidad Enero', 1, 'efectivo', 325, 12),
(273, '2025-02-02', 'Mensualidad Febrero', 1, 'efectivo', 325, 12),
(274, '2025-01-01', 'Alta cliente', 0, '', 314, 1),
(275, '2025-01-01', 'Alta cliente', NULL, NULL, 317, 4),
(277, '2025-02-02', 'Mensualidad Febrero', 1, 'efectivo', 317, 4),
(278, '2025-01-01', 'Mensualidad Enero', 1, 'efectivo', 317, 4),
(279, '2025-01-07', 'Mensualidad Enero', 1, 'bizum', 314, 1),
(280, '2025-02-02', 'Mensualidad Febrero', 1, 'bizum', 314, 1),
(281, '2025-02-01', 'Alta cliente', NULL, NULL, 321, 8),
(282, '2025-02-01', 'Mensualidad Enero', 1, 'efectivo', 321, 8),
(283, '2025-01-02', 'Mensualidad Febrero', 1, 'efectivo', 321, 8),
(287, '2025-01-01', 'Alta cliente', 0, '', 318, 5),
(288, '2025-01-01', 'Mensualidad Enero', 1, 'efectivo', 318, 5),
(289, '2025-02-07', 'Mensualidad Febrero', 1, 'efectivo', 318, 5),
(290, '2025-03-03', 'Mensualidad Marzo', 1, 'efectivo', 318, 5),
(291, '2025-02-07', 'Mensualidad Febrero', 1, 'bizum', 314, 1),
(292, '2025-02-01', 'Alta cliente', NULL, NULL, 333, 19),
(293, '2025-02-02', 'Mensualidad Febrero', 1, 'banco', 333, 19),
(295, '2025-02-08', 'Alta cliente', NULL, NULL, 322, 9),
(296, '2025-02-08', 'Mensualidad Febrero', 1, 'bizum', 322, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'admin'),
(2, 'cliente'),
(3, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trasteros`
--

CREATE TABLE `trasteros` (
  `id_trastero` int(11) NOT NULL,
  `tamaño` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trasteros`
--

INSERT INTO `trasteros` (`id_trastero`, `tamaño`, `precio`, `descripcion`, `disponible`, `url`) VALUES
(1, '5,5 m2', 60.00, 'Para los que necesitan mucho espacio.', 0, '/trasteros1024/public/multimedia/videos/vt-1.mp4'),
(2, '4 m2', 50.00, 'Los más pequeños.', 0, '/trasteros1024/public/multimedia/videos/vt-2.mp4'),
(3, '5,5 m2', 55.00, 'Medio metro mas se nota.', 0, '/trasteros1024/public/multimedia/videos/vt-3.mp4'),
(4, '4 m2', 50.00, 'Los más pequeños.', 0, '/trasteros1024/public/multimedia/videos/vt-4.mp4'),
(5, '4,5 m2', 55.00, 'Medio metro mas se nota.', 0, '/trasteros1024/public/multimedia/videos/vt-5.mp4'),
(6, '4,5 m2', 55.00, 'Medio metro mas se nota.', 1, '/trasteros1024/public/multimedia/videos/vt-6.mp4'),
(7, '4 m2', 50.00, 'Los más pequeños.', 0, '/trasteros1024/public/multimedia/videos/vt-7.mp4'),
(8, '4,5 m2', 55.00, 'Medio metro mas se nota.', 0, '/trasteros1024/public/multimedia/videos/vt-8.mp4'),
(9, '4 m2', 50.00, 'Los más pequeños.', 0, '/trasteros1024/public/multimedia/videos/vt-9.mp4'),
(10, '6 m2', 65.00, 'Para los que necesitan mucho espacio.', 0, '/trasteros1024/public/multimedia/videos/vt-10.mp4'),
(11, '4 m2', 50.00, 'Los más pequeños.', 1, '/trasteros1024/public/multimedia/videos/vt-11.mp4'),
(12, '9 m2', 75.00, 'Gran tamaño, ideal para empresas.', 0, '/trasteros1024/public/multimedia/videos/vt-12.mp4'),
(13, '6 m2', 65.00, 'Para los que necesitan mucho espacio.', 1, '/trasteros1024/public/multimedia/videos/vt-13.mp4'),
(14, '9 m2', 90.00, 'Gran tamaño, ideal para empresas.', 1, '/trasteros1024/public/multimedia/videos/vt-14.mp4'),
(15, '5,5 m2', 60.00, 'Para los que necesitan mucho espacio.', 1, '/trasteros1024/public/multimedia/videos/vt-15.mp4'),
(16, '6 m2', 65.00, 'Para los que necesitan mucho espacio.', 1, '/trasteros1024/public/multimedia/videos/vt-16.mp4'),
(17, '5,5 m2', 60.00, 'Para los que necesitan mucho espacio.', 1, '/trasteros1024/public/multimedia/videos/vt-17.mp4'),
(18, '4,5 m2', 55.00, 'Medio metro mas se nota.', 1, '/trasteros1024/public/multimedia/videos/vt-18.mp4'),
(19, '6 m2', 65.00, 'Para los que necesitan mucho espacio.', 0, '/trasteros1024/public/multimedia/videos/vt-19.mp4'),
(20, '2 m2', 35.00, 'Cajón de 203 x 320 x 85 cm, ideal para guardar pequeñas cosas o bicicletas.', 1, '/trasteros1024/public/multimedia/videos/vt-20.mp4'),
(21, '4,5 m2', 55.00, 'Medio metro mas se nota.', 0, '/trasteros1024/public/multimedia/videos/vt-21.mp4'),
(22, '25 m2', 50.00, 'Garaje', 1, '/trasteros1024/public/multimedia/videos/vt-22.mp4'),
(23, '4,5 m2', 55.00, 'Medio metro mas se nota.', 0, '/trasteros1024/public/multimedia/videos/vt-23.mp4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_1` varchar(55) DEFAULT NULL,
  `apellido_2` varchar(55) DEFAULT NULL,
  `direccion` varchar(55) DEFAULT NULL,
  `telefono` varchar(55) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `rol_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `nombre`, `apellido_1`, `apellido_2`, `direccion`, `telefono`, `email`, `pass`, `rol_id`) VALUES
(229, 'Berne', 'Desforges', 'Walklett', 'tutrasteroenhuelva', '2717019911', 'bwalklett1i@cnn.com', '$2y$10$sAy5HPDqXvfuLxeQU4Ipk.1EQ/5sVtg3GBVelZW.SrxQhYPqNhhgy', 3),
(239, 'Marion', 'Thalmann', 'Braisted', 'tutrasteroenhuelva', '4088594351', 'mbraisted1s@amazon.com', '$2y$10$ZtT5RDqa8mUZQEB9ms4MjuulZBTQjBDGC/E9umrjkiUdFb/3gbYIK', 3),
(244, 'Megen', 'Symon', 'Goodoune', 'tutrasteroenhuelva', '8456957361', 'mgoodoune1x@geocities.com', '$2y$10$Q3L30sDFclEaJBBotPXpwuZ18fFhlKbJWA35J2MfHngT5fyBnwS6e', 3),
(249, 'Issie', 'Bodell', 'Flatte', 'tutrasteroenhuelva', '6683299541', 'iflatte22@friendfeed.com', '$2y$10$nh0ixjsRnH.HSyIHTmMyK.fBb/KyuzdQqsXUORblH1G7JEgBUKVse', 3),
(252, 'Nicola', 'Josskowitz', 'Semper', 'tutrasteroenhuelva', '9202921453', 'nsemper25@accuweather.com', '$2y$10$Xd64ZrF9hohEeN8EbOO.h.NEstOgfzNBKNj3.SW5JOMNVERgCo9Ea', 3),
(266, 'Christalle', 'Blancowe', 'Dain', 'tutrasteroenhuelva', '1111646243', 'cdain2n@plala.or.jp', '$2y$10$hC1sM8ETCSubM8MDOewBQuoKnIgGk01JlFVeJIyELKMiSx98y1mBW', 3),
(314, 'Maria', 'Garcia', 'Aguilar', 'tutrasteroenhuelva', '654037747', 'trastero1@cliente.com', '$2y$10$qdunbMt6zYqZnbOk0v1zQ./mGwo1S.hWu6wkwSfhFmO9l9j/9ulLy', 2),
(315, 'Alberto', 'Moreno', 'Garcia', 'tutrasteroenhuelva', '601021303', 'trastero2@cliente.com', '$2y$10$efPshJqaV6RUBSyta653zezGsfvTIKYFotcVdBzolguSnD3P04rNm', 2),
(316, 'Maria Jesus', 'Arija', 'Garcia', 'tutrasteroenhuelva', '620623098', 'trastero3@cliente.com', '$2y$10$0ICompa2NzkoAXPrCKSCp.MBUCHrya5cgQKimuGqPrk4NSmbd652W', 2),
(317, 'Maria', 'Cordero ', 'Gil', 'Legión Española 6-4A', '656957250', 'trastero4@cliente.com', '$2y$10$odN2zrFnPkQxs7iVYLbixuKJzHgO8R/Z/X/laNQFwgvNh9/Z7M2oC', 2),
(318, 'Isabel', 'Fernandez', 'Rodriguez', 'Legión Española 16 , piso 2ºA', '685185194', 'trastero5@cliente.com', '$2y$10$j9xCdZz6PGXVDn48LxS6m.i3kRYL1NjcOAZAIUjIxkXKoP6l/ZMZW', 2),
(319, 'Nazario', 'Garcia', 'Garcia', 'tutrasteroenhuelva', '699934033', 'trastero6@cliente.com', '$2y$10$5j9vgztAwPXbGN4zwxi5TOSJ.5CzhiZkFp41oaCXQXpC2hPfNYWjO', 3),
(320, 'Jesus', 'Martinez', 'Velo', 'tutrasteroenhuelva', '635693862', 'trastero7@cliente.com', '$2y$10$W1reQI5YOcKJ5j9c7HG1Mu4Zx21SIsLpz8F.2xPf2yl3C0ejLo79u', 2),
(321, 'Manuel', 'Martin', 'Lievas', 'Rio de la Plata nº1 - 1ºD', '607878631', 'trastero8@cliente.com', '$2y$10$m8g1EZbdHsHH6Y9QOVO2f.cgCK4kP4n1bSm.QOQbsuVsQ3.bBPQxG', 2),
(322, 'Jesus ', 'Garcia', 'De la Rosas', 'tutrasteroenhuelva', '690012532', 'trastero9@cliente.com', '$2y$10$lKWMGxrkEOb66XiYHZbMtOdkzTTxUWj50vcRZfa7T6YyGSv/7iD3W', 2),
(323, 'Maria Angeles', 'Casanova', 'Higuera', 'tutrasteroenhuelva', '656801908', 'trastero10@cliente.com', '$2y$10$mxuG0bcG4LTh5gIONYUMoeA2NXBKSOnPVazSlZAiWJ8dZvcIOVmZy', 2),
(324, 'Cristobal', 'Garcia', 'Mendez', 'tutrasteroenhuelva', '613006441', 'trastero11@cliente.com', '$2y$10$E0SOO5HX0YdPSXYZWQgrje2WJN3r9wqi4n3MWMhwRcMTX6rC1Aeye', 3),
(325, 'Natanael', 'Blanco', 'Feria', 'tutrasteroenhuelva', '607903631', 'trastero12@cliente.com', '$2y$10$P4FJ/cupsK7LWP4p43a/DeDqbxhFQW1M4vS3kQzXpKiHG5To7tLV6', 2),
(333, 'Carmen', 'Ortega', 'Duran', 'tutrasteroenhuelva', '652458057', 'trastero19@cliente.com', '$2y$10$45Asxr6Cqly9ThVrIJ738.EX1Y4pHsRyO1rVqt5zNu7vm.EZ5kXYu', 2),
(335, 'Jacob', 'Luque', 'Entenza', 'tutrasteroenhuelva', '656833095', 'admin@admin.com', '$2y$10$pQAumv4kX4KZnnUVTILcXOZi3GkbQOnhWD7W2XQvDgjpNEHHoTGpO', 1),
(336, 'Maria Jose', 'Gutierrez ', 'Diaz', 'tutrasteroenhuelva', '987756432', 'trastero23@cliente.com', '$2y$10$3f0VoI4Qc7r7vWaQrPEYk.DNLLIZ08mOirb8pbielBzjXNnnS6xMu', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `averias`
--
ALTER TABLE `averias`
  ADD PRIMARY KEY (`id_averia`),
  ADD KEY `trastero_id` (`trastero_id`);

--
-- Indices de la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD PRIMARY KEY (`id_recibo`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `trastero_id` (`trastero_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `rol` (`rol`);

--
-- Indices de la tabla `trasteros`
--
ALTER TABLE `trasteros`
  ADD PRIMARY KEY (`id_trastero`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `averias`
--
ALTER TABLE `averias`
  MODIFY `id_averia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `id_recibo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `trasteros`
--
ALTER TABLE `trasteros`
  MODIFY `id_trastero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `averias`
--
ALTER TABLE `averias`
  ADD CONSTRAINT `averias_ibfk_1` FOREIGN KEY (`trastero_id`) REFERENCES `trasteros` (`id_trastero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD CONSTRAINT `recibos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recibos_ibfk_2` FOREIGN KEY (`trastero_id`) REFERENCES `trasteros` (`id_trastero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
