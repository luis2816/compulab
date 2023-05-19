-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2023 a las 19:10:02
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `compulab`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `portada` varchar(100) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `portada`, `datecreated`, `status`) VALUES
(9, 'Reactivos', 'Reactivos', 'portada_categoria.png', '2023-04-08 11:02:26', 1),
(10, 'Insumos', 'Insumos Medicos', 'portada_categoria.png', '2023-04-08 11:05:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleentrega`
--

CREATE TABLE `detalleentrega` (
  `id` int(11) NOT NULL,
  `idtipoProducto` int(11) NOT NULL,
  `cantidad_salida` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_sede` int(11) NOT NULL,
  `codigoFactura` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalleentrega`
--

INSERT INTO `detalleentrega` (`id`, `idtipoProducto`, `cantidad_salida`, `fecha`, `id_sede`, `codigoFactura`) VALUES
(68, 2, 10, '2023-05-15 19:19:14', 2, '20230515-866105'),
(69, 1, 20, '2023-05-15 19:19:14', 2, '20230515-866105'),
(70, 2, 2, '2023-05-16 09:32:48', 2, '20230516-789598'),
(71, 1, 4, '2023-05-16 09:32:48', 2, '20230516-789598');

--
-- Disparadores `detalleentrega`
--
DELIMITER $$
CREATE TRIGGER `actualizar_stock` AFTER INSERT ON `detalleentrega` FOR EACH ROW BEGIN
    UPDATE stock SET cantidad = cantidad - NEW.cantidad_salida
    WHERE id_Tipoproducto = NEW.idtipoProducto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `idTipoproducto` int(11) NOT NULL,
  `fabricante` varchar(50) NOT NULL,
  `lote` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `presentacionComercial` varchar(30) NOT NULL,
  `registroSanitario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `idTipoproducto`, `fabricante`, `lote`, `fecha_entrada`, `fecha_vencimiento`, `cantidad`, `presentacionComercial`, `registroSanitario`) VALUES
(7, 2, 'Fabricante_2', 1, '2023-05-15', '2025-03-01', 300, '', ''),
(8, 1, 'Fabricante_2', 2, '2023-05-15', '2023-06-30', 200, '', ''),
(9, 2, 'Fabricante_2', 3, '2023-05-15', '2026-08-01', 200, '', ''),
(10, 4, 'Fabricannte 1', 3, '2023-05-16', '2023-09-15', 10, '', ''),
(11, 4, 'Fabricante_2', 2, '2023-05-16', '2023-05-26', 500, 'prueba presentacion', 'prueba registro');

--
-- Disparadores `insumos`
--
DELIMITER $$
CREATE TRIGGER `disparador_insertar_actualizar` AFTER INSERT ON `insumos` FOR EACH ROW INSERT INTO stock (id_Tipoproducto, cantidad)
    VALUES (NEW.idTipoproducto, NEW.cantidad)
    ON DUPLICATE KEY UPDATE cantidad = cantidad + NEW.cantidad
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del sistema', 1),
(3, 'sede', 'Sedes de compulab', 1),
(4, 'Caterogías', 'Caterogías Productos', 1),
(5, 'Tipo producto', '', 1),
(6, 'insumos', '', 1),
(7, 'Entregas', '', 1),
(8, 'Stock', 'Inventario general', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(602, 1, 1, 1, 1, 1, 1),
(603, 1, 2, 1, 1, 1, 1),
(604, 1, 3, 1, 1, 1, 1),
(607, 1, 4, 1, 1, 1, 1),
(608, 1, 5, 1, 1, 1, 1),
(609, 1, 6, 1, 1, 1, 1),
(610, 1, 7, 1, 1, 1, 1),
(613, 1, 8, 1, 1, 1, 1),
(630, 11, 1, 0, 0, 0, 0),
(631, 11, 2, 0, 0, 0, 0),
(632, 11, 3, 0, 0, 0, 0),
(633, 11, 4, 0, 0, 0, 0),
(634, 11, 5, 0, 0, 0, 0),
(635, 11, 6, 1, 0, 0, 0),
(636, 11, 7, 1, 1, 1, 1),
(637, 11, 8, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` bigint(20) NOT NULL,
  `identificacion` varchar(30) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `password` varchar(75) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `nombrefiscal` varchar(80) NOT NULL,
  `direccionfiscal` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `identificacion`, `nombres`, `apellidos`, `telefono`, `email_user`, `password`, `nit`, `nombrefiscal`, `direccionfiscal`, `token`, `rolid`, `datecreated`, `status`) VALUES
(1, '1003102569', 'Felipe', 'Ordoñez diaz', 3246338246, 'ordonezfelipe2816@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '24252622', 'Felipe diaz', 'Timbio - Cauca', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2020-08-13 00:51:44', 1),
(20, '1003102564', 'Brayan', 'Pacheco', 3267456789, 'brayan@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', '', '', '', 11, '2023-05-16 22:44:18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `nombrerol` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Acceso a todo el sistema', 1),
(11, 'Vendedor', 'Entrega insumos a las sedes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id`, `nombre`, `direccion`, `telefono`, `email`, `estado`) VALUES
(1, 'Sedes Popayán', 'sede principal', 2147483647, 'popayan@gmail.com', 1),
(2, 'Sede el tambo', 'sede segundaria', 2147483647, 'elTambo@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `id_Tipoproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id`, `id_Tipoproducto`, `cantidad`) VALUES
(6, 2, 30),
(7, 1, 176),
(9, 4, 510);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproducto`
--

CREATE TABLE `tipoproducto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `categoria` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipoproducto`
--

INSERT INTO `tipoproducto` (`id`, `nombre`, `categoria`, `estado`) VALUES
(1, 'Reactivo_1', 9, 1),
(2, 'Reactivos_2', 9, 1),
(3, 'insumo 1', 10, 1),
(4, 'insumo_prueba', 10, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalleentrega`
--
ALTER TABLE `detalleentrega`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipoProducto_idTipoproducto` (`idtipoProducto`),
  ADD KEY `fk_sede_id_sede` (`id_sede`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_insumos_idTipoproducto` (`idTipoproducto`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `rolid` (`rolid`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id_Tipoproducto` (`id_Tipoproducto`);

--
-- Indices de la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria_idCategoria` (`categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalleentrega`
--
ALTER TABLE `detalleentrega`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=638;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleentrega`
--
ALTER TABLE `detalleentrega`
  ADD CONSTRAINT `fk_sede_id_sede` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id`),
  ADD CONSTRAINT `fk_tipoProducto_idTipoproducto` FOREIGN KEY (`idtipoProducto`) REFERENCES `tipoproducto` (`id`);

--
-- Filtros para la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD CONSTRAINT `fk_insumos_idTipoproducto` FOREIGN KEY (`idTipoproducto`) REFERENCES `tipoproducto` (`id`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_Tipoproducto`) REFERENCES `tipoproducto` (`id`);

--
-- Filtros para la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  ADD CONSTRAINT `fk_categoria_idCategoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idcategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
