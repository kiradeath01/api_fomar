-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-12-2021 a las 02:34:03
-- Versión del servidor: 8.0.27
-- Versión de PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fomar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_imagenes`
--

CREATE TABLE `cat_imagenes` (
  `id_imagenes` int NOT NULL,
  `id_producto` int NOT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url_imagen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cat_imagenes`
--

INSERT INTO `cat_imagenes` (`id_imagenes`, `id_producto`, `descripcion`, `url_imagen`) VALUES
(1, 1, 'horno hibrido', 'img\\small\\Imagen1.png'),
(2, 1, 'horno convencional', 'img\\small\\Imagen2.png'),
(3, 2, 'estufa hibrida', 'img\\small\\Imagen3.png'),
(4, 2, 'estufa convencional', 'img\\small\\Imagen4.png'),
(6, 4, 'horno h', 'img\\small\\Imagen4.png'),
(7, 2, 'horno', 'img\\small\\Imagen1.png'),
(8, 2, 'horno', 'img\\small\\Imagen2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_producto`
--

CREATE TABLE `cat_producto` (
  `id_producto` int NOT NULL,
  `nombre_producto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stock` int NOT NULL,
  `precio` int NOT NULL,
  `id_promocion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cat_producto`
--

INSERT INTO `cat_producto` (`id_producto`, `nombre_producto`, `stock`, `precio`, `id_promocion`) VALUES
(1, 'horno', 10, 1, 1),
(2, 'estufa', 10, 2, 1),
(4, 'hibrido', 8, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_promocion`
--

CREATE TABLE `cat_promocion` (
  `id_promocion` int NOT NULL,
  `descuento` int NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `nombre_promocion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cat_promocion`
--

INSERT INTO `cat_promocion` (`id_promocion`, `descuento`, `fecha_inicio`, `fecha_vencimiento`, `nombre_promocion`) VALUES
(1, 10, '2021-10-02', '2021-10-20', '10% descuento'),
(2, 0, '2021-10-02', '2500-10-02', 'sin descuento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcion_producto`
--

CREATE TABLE `descripcion_producto` (
  `id_descripcion` int NOT NULL,
  `peso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dimencion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_producto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `descripcion_producto`
--

INSERT INTO `descripcion_producto` (`id_descripcion`, `peso`, `dimencion`, `color`, `tipo`, `descripcion`, `id_producto`) VALUES
(1, '1', '10x10', 'rojo', 'horno', 'horno hibrido', 1),
(3, '1', '1x1', 'verde', 'estufa', 'estufa leña', 2),
(4, '10', '20x20', 'azul', 'hor h', 'horno ', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `id_envio` int NOT NULL,
  `codigo_rastreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `id_compras` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_productos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_productos` (
`descripcionimagen` varchar(500)
,`descripcionproducto` varchar(500)
,`dimencion` varchar(255)
,`id_imagenes` int
,`id_producto` int
,`nombre_producto` varchar(255)
,`peso` varchar(255)
,`precio` int
,`stock` int
,`tipo` varchar(255)
,`totaldescripcion` bigint
,`totalimg` bigint
,`url_imagen` text
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_login` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `token`) VALUES
(1, 'RnorTC9aTG4yMC9jQU93ck9CaHo2UT09', 'RnorTC9aTG4yMC9jQU93ck9CaHo2UT09', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmaXQiOiIyMDIxLTExLTI0IDAwOjExOjE1IiwiZmV0IjoiMjAyMS0xMS0yNSAwMDoxMToxNSIsImRhdGEiOnsia2l1IjoiMSIsInVzZXJuYW1lIjoiUm5vclRDOWFURzR5TUM5alFVOTNjazlDYUhvMlVUMDkifX0.Lc1owhEdShpgWvc8IaKkIUcAAIIqDhBzzJX5Fwc6Osc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_compras`
--

CREATE TABLE `tb_compras` (
  `id_compras` int NOT NULL,
  `token_compra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `monto_compra` float NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_confirmacion` date NOT NULL,
  `tipo_operacion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_cancelado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_datos_cliente`
--

CREATE TABLE `tb_datos_cliente` (
  `id_datos_cliente` int NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ap_paterno` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ap_materno` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cp` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ciudad` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_compras` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiket_compra`
--

CREATE TABLE `tiket_compra` (
  `id_tiket_compra` int NOT NULL,
  `id_compras` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad_producto` int NOT NULL,
  `is_promocion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_total_des`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_total_des` (
`id_producto` int
,`totaldescripcion` bigint
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_total_img_prod`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_total_img_prod` (
`id_producto` int
,`totalimg` bigint
);

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_productos`
--
DROP TABLE IF EXISTS `lista_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_productos`  AS SELECT `cp`.`id_producto` AS `id_producto`, `cp`.`nombre_producto` AS `nombre_producto`, `cp`.`precio` AS `precio`, `cp`.`stock` AS `stock`, `vtd`.`totaldescripcion` AS `totaldescripcion`, `dp`.`peso` AS `peso`, `dp`.`dimencion` AS `dimencion`, `dp`.`tipo` AS `tipo`, `dp`.`descripcion` AS `descripcionproducto`, `ci`.`id_imagenes` AS `id_imagenes`, `vti`.`totalimg` AS `totalimg`, `ci`.`url_imagen` AS `url_imagen`, `ci`.`descripcion` AS `descripcionimagen` FROM ((((`cat_producto` `cp` left join `descripcion_producto` `dp` on((`dp`.`id_producto` = `cp`.`id_producto`))) left join `cat_imagenes` `ci` on((`ci`.`id_producto` = `cp`.`id_producto`))) left join `view_total_img_prod` `vti` on((`vti`.`id_producto` = `cp`.`id_producto`))) left join `view_total_des` `vtd` on((`vtd`.`id_producto` = `cp`.`id_producto`))) GROUP BY `cp`.`id_producto`, `cp`.`nombre_producto`, `cp`.`precio`, `cp`.`stock`, `dp`.`peso`, `dp`.`dimencion`, `dp`.`tipo`, `dp`.`descripcion`, `ci`.`url_imagen`, `ci`.`descripcion`, `ci`.`id_imagenes` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_total_des`
--
DROP TABLE IF EXISTS `view_total_des`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_total_des`  AS SELECT `descripcion_producto`.`id_producto` AS `id_producto`, count(`descripcion_producto`.`id_producto`) AS `totaldescripcion` FROM `descripcion_producto` GROUP BY `descripcion_producto`.`id_producto` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_total_img_prod`
--
DROP TABLE IF EXISTS `view_total_img_prod`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_total_img_prod`  AS SELECT `cat_imagenes`.`id_producto` AS `id_producto`, count(`cat_imagenes`.`id_producto`) AS `totalimg` FROM `cat_imagenes` GROUP BY `cat_imagenes`.`id_producto` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_imagenes`
--
ALTER TABLE `cat_imagenes`
  ADD PRIMARY KEY (`id_imagenes`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `cat_producto`
--
ALTER TABLE `cat_producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_promocion` (`id_promocion`),
  ADD KEY `id_promocion_2` (`id_promocion`);

--
-- Indices de la tabla `cat_promocion`
--
ALTER TABLE `cat_promocion`
  ADD PRIMARY KEY (`id_promocion`);

--
-- Indices de la tabla `descripcion_producto`
--
ALTER TABLE `descripcion_producto`
  ADD PRIMARY KEY (`id_descripcion`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`id_envio`),
  ADD KEY `id_compras` (`id_compras`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indices de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD PRIMARY KEY (`id_compras`);

--
-- Indices de la tabla `tb_datos_cliente`
--
ALTER TABLE `tb_datos_cliente`
  ADD PRIMARY KEY (`id_datos_cliente`),
  ADD KEY `id_compras` (`id_compras`);

--
-- Indices de la tabla `tiket_compra`
--
ALTER TABLE `tiket_compra`
  ADD PRIMARY KEY (`id_tiket_compra`),
  ADD KEY `id_compras` (`id_compras`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_imagenes`
--
ALTER TABLE `cat_imagenes`
  MODIFY `id_imagenes` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cat_producto`
--
ALTER TABLE `cat_producto`
  MODIFY `id_producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cat_promocion`
--
ALTER TABLE `cat_promocion`
  MODIFY `id_promocion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `descripcion_producto`
--
ALTER TABLE `descripcion_producto`
  MODIFY `id_descripcion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `id_envio` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  MODIFY `id_compras` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_datos_cliente`
--
ALTER TABLE `tb_datos_cliente`
  MODIFY `id_datos_cliente` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiket_compra`
--
ALTER TABLE `tiket_compra`
  MODIFY `id_tiket_compra` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cat_imagenes`
--
ALTER TABLE `cat_imagenes`
  ADD CONSTRAINT `cat_imagenes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `cat_producto` (`id_producto`);

--
-- Filtros para la tabla `cat_producto`
--
ALTER TABLE `cat_producto`
  ADD CONSTRAINT `cat_producto_ibfk_1` FOREIGN KEY (`id_promocion`) REFERENCES `cat_promocion` (`id_promocion`);

--
-- Filtros para la tabla `descripcion_producto`
--
ALTER TABLE `descripcion_producto`
  ADD CONSTRAINT `descripcion_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `cat_producto` (`id_producto`);

--
-- Filtros para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `envio_ibfk_1` FOREIGN KEY (`id_compras`) REFERENCES `tb_compras` (`id_compras`);

--
-- Filtros para la tabla `tb_datos_cliente`
--
ALTER TABLE `tb_datos_cliente`
  ADD CONSTRAINT `tb_datos_cliente_ibfk_1` FOREIGN KEY (`id_compras`) REFERENCES `tb_compras` (`id_compras`);

--
-- Filtros para la tabla `tiket_compra`
--
ALTER TABLE `tiket_compra`
  ADD CONSTRAINT `tiket_compra_ibfk_2` FOREIGN KEY (`id_compras`) REFERENCES `tb_compras` (`id_compras`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
