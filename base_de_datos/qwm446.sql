-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-11-2016 a las 18:26:08
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.5.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `qwm446`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_atraso`
--

CREATE TABLE `t_atraso` (
  `id` int(11) NOT NULL,
  `id_prestamo` int(11) NOT NULL,
  `observaciones` varchar(60) NOT NULL,
  `fecha` varchar(45) NOT NULL,
  `fecha_proximo_cobro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_caja`
--

CREATE TABLE `t_caja` (
  `id` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `total_caja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_capital`
--

CREATE TABLE `t_capital` (
  `id` int(11) NOT NULL,
  `capital` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cierre`
--

CREATE TABLE `t_cierre` (
  `id` int(11) NOT NULL,
  `monto` varchar(45) NOT NULL,
  `monto_recibido` varchar(45) NOT NULL,
  `total` varchar(45) NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cierre_x_cobrador`
--

CREATE TABLE `t_cierre_x_cobrador` (
  `id` int(11) NOT NULL,
  `id_cobrador` int(11) NOT NULL,
  `monto_cobrado` int(11) NOT NULL,
  `monto_entregado` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cliente`
--

CREATE TABLE `t_cliente` (
  `id` int(11) NOT NULL,
  `id_tipo_estado_cliente` int(11) NOT NULL,
  `id_reputacion` int(11) NOT NULL,
  `id_cobrador` int(11) NOT NULL,
  `id_documentacion` int(11) NOT NULL,
  `dni` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `nombre_negocio` varchar(45) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `direccion_cobro` varchar(200) NOT NULL,
  `telf` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `referencia_1` varchar(45) DEFAULT NULL,
  `referencia_2` varchar(45) DEFAULT NULL,
  `adjunto` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cobrador`
--

CREATE TABLE `t_cobrador` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `dni` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telf` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_cobrador`
--

INSERT INTO `t_cobrador` (`id`, `id_usuario`, `dni`, `nombre`, `direccion`, `telf`, `email`) VALUES
(1, 2, '1234', 'Cobrador', 'Puerto RIco', '1010101', 'cobrador@gmail.com'),
(2, 3, '34565432', 'Carlos Cruz', 'Avenida Alberto Ravell Residencias la rosalera', '123111', 'carloscruz@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_co_deudor`
--

CREATE TABLE `t_co_deudor` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `dni` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `nombre_negocio` varchar(45) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `direccion_cobro` varchar(200) NOT NULL,
  `telf` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_caja`
--

CREATE TABLE `t_det_caja` (
  `id` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `id_tipo_ingreso` int(11) NOT NULL,
  `monto` varchar(45) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_capital`
--

CREATE TABLE `t_det_capital` (
  `id` int(11) NOT NULL,
  `id_capital` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `capital` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_gasto`
--

CREATE TABLE `t_det_gasto` (
  `id` int(11) NOT NULL,
  `id_gasto` int(11) NOT NULL,
  `id_tipo_gasto` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `monto` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_prestamo`
--

CREATE TABLE `t_det_prestamo` (
  `id` int(11) NOT NULL,
  `id_prestamo` int(11) NOT NULL,
  `id_tipo_prestamo_2` int(11) NOT NULL,
  `id_atraso` int(11) DEFAULT NULL,
  `cuota` varchar(45) DEFAULT NULL,
  `descripcion` varchar(60) NOT NULL,
  `monto` varchar(45) NOT NULL,
  `fecha_cobro` date NOT NULL,
  `fecha_prox_cobro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_documentacion_cliente`
--

CREATE TABLE `t_documentacion_cliente` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_documentacion_cliente`
--

INSERT INTO `t_documentacion_cliente` (`id`, `descripcion`) VALUES
(1, 'Correcta'),
(2, 'Incorrecta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_empresa`
--

CREATE TABLE `t_empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `dni` varchar(60) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `telf` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_empresa`
--

INSERT INTO `t_empresa` (`id`, `nombre`, `dni`, `direccion`, `telf`, `email`) VALUES
(1, 'Rapipagos', '232123', 'Centro comercial la Arboleda', '90000', 'empresa@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_estado_prestamo`
--

CREATE TABLE `t_estado_prestamo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_estado_prestamo`
--

INSERT INTO `t_estado_prestamo` (`id`, `descripcion`) VALUES
(1, 'Por aprobar'),
(2, 'Aprobado'),
(3, 'Rechazado'),
(4, 'Incobrable'),
(5, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_estado_usuario`
--

CREATE TABLE `t_estado_usuario` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_estado_usuario`
--

INSERT INTO `t_estado_usuario` (`id`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_gasto`
--

CREATE TABLE `t_gasto` (
  `id` int(11) NOT NULL,
  `id_cobrador` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_metodo_pago`
--

CREATE TABLE `t_metodo_pago` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_metodo_pago`
--

INSERT INTO `t_metodo_pago` (`id`, `descripcion`) VALUES
(1, 'Diario'),
(2, 'Mensual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_nivel`
--

CREATE TABLE `t_nivel` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_nivel`
--

INSERT INTO `t_nivel` (`id`, `descripcion`) VALUES
(1, 'Super Admin'),
(2, 'Socio'),
(3, 'Cobrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_penalidad`
--

CREATE TABLE `t_penalidad` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `numero_dias_atraso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_prestamo`
--

CREATE TABLE `t_prestamo` (
  `id` int(11) NOT NULL,
  `id_estado_prestamo` int(11) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_cobrador` int(11) DEFAULT NULL,
  `id_tipo_prestamo` int(11) NOT NULL,
  `id_metodo_pago` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `porcentaje_aprobado` int(11) DEFAULT NULL,
  `monto_prestado` int(11) NOT NULL,
  `monto_aprobado` varchar(45) DEFAULT NULL,
  `interes` varchar(45) NOT NULL,
  `total_prestado` varchar(60) NOT NULL,
  `numero_cuotas` int(11) NOT NULL,
  `numero_cuotas_aprobadas` int(11) DEFAULT NULL,
  `monto_x_cuotas` varchar(60) NOT NULL,
  `cuotas_amortizadas` int(11) DEFAULT NULL,
  `cuotas_debe` int(11) DEFAULT NULL,
  `atrasos` int(11) DEFAULT NULL,
  `dias_mora` int(11) DEFAULT '0',
  `penalidad` int(11) DEFAULT '0',
  `total_penalidad` varchar(45) DEFAULT NULL,
  `total_debe` varchar(45) DEFAULT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_aprobacion_prestamo` date DEFAULT NULL,
  `fecha_ultimo_cobro` date DEFAULT NULL,
  `fecha_prox_cobro` date DEFAULT NULL,
  `observacion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_reputacion`
--

CREATE TABLE `t_reputacion` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_reputacion`
--

INSERT INTO `t_reputacion` (`id`, `descripcion`) VALUES
(1, 'Normal'),
(2, 'Excelente'),
(3, 'Mala Paga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_socio`
--

CREATE TABLE `t_socio` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `dni` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telf` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_sucursal`
--

CREATE TABLE `t_sucursal` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `direccion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_caja`
--

CREATE TABLE `t_tipo_caja` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_tipo_caja`
--

INSERT INTO `t_tipo_caja` (`id`, `descripcion`) VALUES
(1, 'Capital Inicial'),
(2, 'Ingreso x Abono'),
(3, 'Prestamos Otorgados'),
(4, 'Egresos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_estado_cliente`
--

CREATE TABLE `t_tipo_estado_cliente` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_tipo_estado_cliente`
--

INSERT INTO `t_tipo_estado_cliente` (`id`, `descripcion`) VALUES
(1, 'Nuevo'),
(2, 'Activo'),
(3, 'Pausado'),
(4, 'Inactivo'),
(5, 'Eliminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_gasto`
--

CREATE TABLE `t_tipo_gasto` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_tipo_gasto`
--

INSERT INTO `t_tipo_gasto` (`id`, `descripcion`) VALUES
(3, 'Transporte'),
(4, 'Alimentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_prestamo`
--

CREATE TABLE `t_tipo_prestamo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_tipo_prestamo`
--

INSERT INTO `t_tipo_prestamo` (`id`, `descripcion`) VALUES
(1, 'Nuevo'),
(2, 'Regular'),
(3, 'Refinanciamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_prestamo_2`
--

CREATE TABLE `t_tipo_prestamo_2` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_tipo_prestamo_2`
--

INSERT INTO `t_tipo_prestamo_2` (`id`, `descripcion`) VALUES
(1, 'abono'),
(2, 'atraso'),
(3, 'condena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuario`
--

CREATE TABLE `t_usuario` (
  `id` int(11) NOT NULL,
  `id_estado_usuario` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `login` varchar(60) NOT NULL,
  `clave` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_usuario`
--

INSERT INTO `t_usuario` (`id`, `id_estado_usuario`, `id_nivel`, `nombre`, `login`, `clave`) VALUES
(1, 1, 1, 'Administrador', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(2, 1, 3, 'Cobrador', 'cobrador', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(3, 1, 3, 'carlos', 'carlos', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_zona`
--

CREATE TABLE `t_zona` (
  `id` int(11) NOT NULL,
  `zona` varchar(60) NOT NULL,
  `direccion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_zona_cobrador`
--

CREATE TABLE `t_zona_cobrador` (
  `id` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_zona` int(11) NOT NULL,
  `id_cobrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_atraso`
--
ALTER TABLE `t_atraso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_atraso_t_prestamo1_idx` (`id_prestamo`);

--
-- Indices de la tabla `t_caja`
--
ALTER TABLE `t_caja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_caja_t_sucursal1_idx` (`id_sucursal`);

--
-- Indices de la tabla `t_capital`
--
ALTER TABLE `t_capital`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_cierre`
--
ALTER TABLE `t_cierre`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_cierre_x_cobrador`
--
ALTER TABLE `t_cierre_x_cobrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_cierre_t_cobrador1_idx` (`id_cobrador`);

--
-- Indices de la tabla `t_cliente`
--
ALTER TABLE `t_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_cliente_t_tipo_estado_cliente1_idx` (`id_tipo_estado_cliente`),
  ADD KEY `fk_t_cliente_t_reputacion1_idx` (`id_reputacion`),
  ADD KEY `fk_t_cliente_t_cobrador1_idx` (`id_cobrador`),
  ADD KEY `fk_t_cliente_t_documentacion1_idx` (`id_documentacion`);

--
-- Indices de la tabla `t_cobrador`
--
ALTER TABLE `t_cobrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_cobrador_t_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `t_co_deudor`
--
ALTER TABLE `t_co_deudor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_co_deudor_t_cliente1_idx` (`id_cliente`);

--
-- Indices de la tabla `t_det_caja`
--
ALTER TABLE `t_det_caja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_det_caja_t_caja1_idx` (`id_caja`),
  ADD KEY `fk_t_det_caja_t_tipo_ingreso1_idx` (`id_tipo_ingreso`);

--
-- Indices de la tabla `t_det_capital`
--
ALTER TABLE `t_det_capital`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_det_capital_t_socio1_idx` (`id_socio`),
  ADD KEY `fk_t_det_capital_t_capital1_idx` (`id_capital`);

--
-- Indices de la tabla `t_det_gasto`
--
ALTER TABLE `t_det_gasto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_det_gasto_t_gasto1_idx` (`id_gasto`),
  ADD KEY `fk_t_det_gasto_t_tipo_gasto1_idx` (`id_tipo_gasto`);

--
-- Indices de la tabla `t_det_prestamo`
--
ALTER TABLE `t_det_prestamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_det_prestamo_t_prestamo1_idx` (`id_prestamo`),
  ADD KEY `fk_t_det_prestamo_t_tipo_prestamo_21_idx` (`id_tipo_prestamo_2`),
  ADD KEY `fk_t_det_prestamo_t_atraso1_idx` (`id_atraso`);

--
-- Indices de la tabla `t_documentacion_cliente`
--
ALTER TABLE `t_documentacion_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_empresa`
--
ALTER TABLE `t_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_estado_prestamo`
--
ALTER TABLE `t_estado_prestamo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_estado_usuario`
--
ALTER TABLE `t_estado_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_gasto`
--
ALTER TABLE `t_gasto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_gasto_t_cobrador1_idx` (`id_cobrador`);

--
-- Indices de la tabla `t_metodo_pago`
--
ALTER TABLE `t_metodo_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_nivel`
--
ALTER TABLE `t_nivel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_penalidad`
--
ALTER TABLE `t_penalidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_prestamo`
--
ALTER TABLE `t_prestamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_prestamo_t_cliente1_idx` (`id_cliente`),
  ADD KEY `fk_t_prestamo_t_cobrador1_idx` (`id_cobrador`),
  ADD KEY `fk_t_prestamo_t_tipo_prestamo1_idx` (`id_tipo_prestamo`),
  ADD KEY `fk_t_prestamo_t_estado_prestamo1_idx` (`id_estado_prestamo`),
  ADD KEY `fk_t_prestamo_t_metodo_pago1_idx` (`id_metodo_pago`);

--
-- Indices de la tabla `t_reputacion`
--
ALTER TABLE `t_reputacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_socio`
--
ALTER TABLE `t_socio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_socio_t_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `t_sucursal`
--
ALTER TABLE `t_sucursal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_sucursales_t_empresa1_idx` (`id_empresa`);

--
-- Indices de la tabla `t_tipo_caja`
--
ALTER TABLE `t_tipo_caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_tipo_estado_cliente`
--
ALTER TABLE `t_tipo_estado_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_tipo_gasto`
--
ALTER TABLE `t_tipo_gasto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_tipo_prestamo`
--
ALTER TABLE `t_tipo_prestamo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_tipo_prestamo_2`
--
ALTER TABLE `t_tipo_prestamo_2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_usuario_t_tabla_idx` (`id_nivel`),
  ADD KEY `fk_t_usuario_t_estado_usuario1_idx` (`id_estado_usuario`);

--
-- Indices de la tabla `t_zona`
--
ALTER TABLE `t_zona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_zona_cobrador`
--
ALTER TABLE `t_zona_cobrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_t_det_cobrador_t_cobradores1_idx` (`id_cobrador`),
  ADD KEY `fk_t_det_cobrador_t_zona1_idx` (`id_zona`),
  ADD KEY `fk_t_zona_cobrador_t_sucursal1_idx` (`id_sucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_atraso`
--
ALTER TABLE `t_atraso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_caja`
--
ALTER TABLE `t_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_capital`
--
ALTER TABLE `t_capital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_cierre`
--
ALTER TABLE `t_cierre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_cierre_x_cobrador`
--
ALTER TABLE `t_cierre_x_cobrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_cliente`
--
ALTER TABLE `t_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_cobrador`
--
ALTER TABLE `t_cobrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `t_co_deudor`
--
ALTER TABLE `t_co_deudor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_det_caja`
--
ALTER TABLE `t_det_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_det_capital`
--
ALTER TABLE `t_det_capital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_det_gasto`
--
ALTER TABLE `t_det_gasto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_det_prestamo`
--
ALTER TABLE `t_det_prestamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_documentacion_cliente`
--
ALTER TABLE `t_documentacion_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `t_empresa`
--
ALTER TABLE `t_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `t_estado_prestamo`
--
ALTER TABLE `t_estado_prestamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `t_estado_usuario`
--
ALTER TABLE `t_estado_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `t_gasto`
--
ALTER TABLE `t_gasto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_metodo_pago`
--
ALTER TABLE `t_metodo_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `t_nivel`
--
ALTER TABLE `t_nivel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `t_penalidad`
--
ALTER TABLE `t_penalidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_prestamo`
--
ALTER TABLE `t_prestamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_reputacion`
--
ALTER TABLE `t_reputacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `t_socio`
--
ALTER TABLE `t_socio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_sucursal`
--
ALTER TABLE `t_sucursal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_tipo_caja`
--
ALTER TABLE `t_tipo_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `t_tipo_estado_cliente`
--
ALTER TABLE `t_tipo_estado_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `t_tipo_gasto`
--
ALTER TABLE `t_tipo_gasto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `t_tipo_prestamo`
--
ALTER TABLE `t_tipo_prestamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `t_tipo_prestamo_2`
--
ALTER TABLE `t_tipo_prestamo_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `t_zona`
--
ALTER TABLE `t_zona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_zona_cobrador`
--
ALTER TABLE `t_zona_cobrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_atraso`
--
ALTER TABLE `t_atraso`
  ADD CONSTRAINT `fk_t_atraso_t_prestamo1` FOREIGN KEY (`id_prestamo`) REFERENCES `t_prestamo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_caja`
--
ALTER TABLE `t_caja`
  ADD CONSTRAINT `fk_t_caja_t_sucursal1` FOREIGN KEY (`id_sucursal`) REFERENCES `t_sucursal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_cierre_x_cobrador`
--
ALTER TABLE `t_cierre_x_cobrador`
  ADD CONSTRAINT `fk_t_cierre_t_cobrador1` FOREIGN KEY (`id_cobrador`) REFERENCES `t_cobrador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_cliente`
--
ALTER TABLE `t_cliente`
  ADD CONSTRAINT `fk_t_cliente_t_cobrador1` FOREIGN KEY (`id_cobrador`) REFERENCES `t_cobrador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_cliente_t_documentacion1` FOREIGN KEY (`id_documentacion`) REFERENCES `t_documentacion_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_cliente_t_reputacion1` FOREIGN KEY (`id_reputacion`) REFERENCES `t_reputacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_cliente_t_tipo_estado_cliente1` FOREIGN KEY (`id_tipo_estado_cliente`) REFERENCES `t_tipo_estado_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_cobrador`
--
ALTER TABLE `t_cobrador`
  ADD CONSTRAINT `fk_t_cobrador_t_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_co_deudor`
--
ALTER TABLE `t_co_deudor`
  ADD CONSTRAINT `fk_t_co_deudor_t_cliente1` FOREIGN KEY (`id_cliente`) REFERENCES `t_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_caja`
--
ALTER TABLE `t_det_caja`
  ADD CONSTRAINT `fk_t_det_caja_t_caja1` FOREIGN KEY (`id_caja`) REFERENCES `t_caja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_caja_t_tipo_ingreso1` FOREIGN KEY (`id_tipo_ingreso`) REFERENCES `t_tipo_caja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_capital`
--
ALTER TABLE `t_det_capital`
  ADD CONSTRAINT `fk_t_det_capital_t_capital1` FOREIGN KEY (`id_capital`) REFERENCES `t_capital` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_capital_t_socio1` FOREIGN KEY (`id_socio`) REFERENCES `t_socio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_gasto`
--
ALTER TABLE `t_det_gasto`
  ADD CONSTRAINT `fk_t_det_gasto_t_gasto1` FOREIGN KEY (`id_gasto`) REFERENCES `t_gasto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_gasto_t_tipo_gasto1` FOREIGN KEY (`id_tipo_gasto`) REFERENCES `t_tipo_gasto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_prestamo`
--
ALTER TABLE `t_det_prestamo`
  ADD CONSTRAINT `fk_t_det_prestamo_t_atraso1` FOREIGN KEY (`id_atraso`) REFERENCES `t_atraso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_prestamo_t_prestamo1` FOREIGN KEY (`id_prestamo`) REFERENCES `t_prestamo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_prestamo_t_tipo_prestamo_21` FOREIGN KEY (`id_tipo_prestamo_2`) REFERENCES `t_tipo_prestamo_2` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_gasto`
--
ALTER TABLE `t_gasto`
  ADD CONSTRAINT `fk_t_gasto_t_cobrador1` FOREIGN KEY (`id_cobrador`) REFERENCES `t_cobrador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_prestamo`
--
ALTER TABLE `t_prestamo`
  ADD CONSTRAINT `fk_t_prestamo_t_cliente1` FOREIGN KEY (`id_cliente`) REFERENCES `t_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_prestamo_t_cobrador1` FOREIGN KEY (`id_cobrador`) REFERENCES `t_cobrador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_prestamo_t_estado_prestamo1` FOREIGN KEY (`id_estado_prestamo`) REFERENCES `t_estado_prestamo` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_t_prestamo_t_metodo_pago1` FOREIGN KEY (`id_metodo_pago`) REFERENCES `t_metodo_pago` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_prestamo_t_tipo_prestamo1` FOREIGN KEY (`id_tipo_prestamo`) REFERENCES `t_tipo_prestamo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_socio`
--
ALTER TABLE `t_socio`
  ADD CONSTRAINT `fk_t_socio_t_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_sucursal`
--
ALTER TABLE `t_sucursal`
  ADD CONSTRAINT `fk_t_sucursales_t_empresa1` FOREIGN KEY (`id_empresa`) REFERENCES `t_empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD CONSTRAINT `fk_t_usuario_t_estado_usuario1` FOREIGN KEY (`id_estado_usuario`) REFERENCES `t_estado_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_usuario_t_tabla` FOREIGN KEY (`id_nivel`) REFERENCES `t_nivel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_zona_cobrador`
--
ALTER TABLE `t_zona_cobrador`
  ADD CONSTRAINT `fk_t_det_cobrador_t_cobradores1` FOREIGN KEY (`id_cobrador`) REFERENCES `t_cobrador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_cobrador_t_zona1` FOREIGN KEY (`id_zona`) REFERENCES `t_zona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_zona_cobrador_t_sucursal1` FOREIGN KEY (`id_sucursal`) REFERENCES `t_sucursal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
