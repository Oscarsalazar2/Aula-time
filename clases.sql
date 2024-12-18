-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2024 a las 03:56:19
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
-- Base de datos: `clases`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id`, `nombre`) VALUES
(2, '09:00'),
(4, '10:00'),
(6, '11:00'),
(7, '12:00'),
(8, '13:00'),
(9, '14:00'),
(10, '15:00'),
(11, '16:00'),
(12, '17:00'),
(13, '18:00');

--
-- Disparadores `periodo`
--
DELIMITER $$
CREATE TRIGGER `trigger_delete_periodo` AFTER DELETE ON `periodo` FOR EACH ROW BEGIN
    INSERT INTO trigger_periodo (accion, id_periodo, nombre_periodo, usuario)
    VALUES ('DELETE', OLD.id, OLD.nombre, USER());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_insert_periodo` AFTER INSERT ON `periodo` FOR EACH ROW BEGIN
    INSERT INTO trigger_periodo (accion, id_periodo, nombre_periodo, usuario)
    VALUES ('INSERT', NEW.id, NEW.nombre, USER());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `dia` date NOT NULL,
  `Profesor_alumno` varchar(255) DEFAULT NULL,
  `materia` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 reservada, 2 confirmada, 3 cancelada ',
  `observacion` text DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `sala_id`, `periodo_id`, `dia`, `Profesor_alumno`, `materia`, `status`, `observacion`) VALUES
(27, 1, 4, '2021-09-23', 'teste1', 'teste2', 1, 'teste3'),
(28, 1, 4, '2021-09-30', 'teste1', 'teste2', 3, 'teste3'),
(42, 1, 6, '2024-12-05', 'oscar gamaliel', 'bsd', 2, 'examen'),
(43, 1, 6, '2024-12-12', 'oscar gamaliel', 'bsd', 2, 'examen'),
(44, 1, 6, '2024-12-19', 'oscar gamaliel', 'bsd', 2, 'examen'),
(45, 1, 6, '2024-12-26', 'oscar gamaliel', 'bsd', 2, 'examen'),
(46, 1, 13, '2024-11-28', 'oscar gamaliel', 'bsd', 2, 'prueba'),
(49, 2, 9, '2024-11-28', 'oscar gamaliel', 'km.nbnm', 1, 'prueba'),
(50, 2, 6, '2024-11-28', 'sada', 'sadasd', 2, 'asdasd'),
(51, 2, 2, '2024-11-28', 'sada', 'km.nbnm', 3, 'asdasd'),
(56, 1, 2, '2024-12-02', 'Victor Loredo', 'Topicos', 2, 'prueba'),
(59, 2, 2, '2024-12-02', 'Victor Loredo', 'Uso general', 1, 'prueba'),
(60, 1, 4, '2024-12-03', 'Victor Loredo', 'Topicos', 2, 'Conexion a la base de datos'),
(61, 1, 7, '2024-12-03', 'Luis Gerardo', 'Prueba', 1, 'prueba'),
(63, 2, 9, '2024-12-04', 'Victor Loredo', 'Topicos', 3, 'Conexion a la base de datos'),
(66, 2, 9, '2024-12-17', 'asd', 'Uso general', 2, 'Conexion a la base de datos'),
(67, 2, 9, '2024-12-24', 'asd', 'Uso general', 2, 'Conexion a la base de datos'),
(70, 2, 9, '2024-12-20', 'asd', 'Uso general', 2, 'Conexion a la base de datos'),
(71, 2, 9, '2024-12-27', 'asd', 'Uso general', 2, 'Conexion a la base de datos'),
(74, 1, 4, '2024-12-12', 'Victor Loredo', 'Uso general', 2, 'prueba'),
(76, 1, 8, '2024-12-12', 'Victor Loredo', 'Uso general', 2, 'Conexion a la base de datos'),
(78, 2, 11, '2024-12-12', 'Luis Gerardo', 'Uso general', 1, 'prueba');

--
-- Disparadores `reserva`
--
DELIMITER $$
CREATE TRIGGER `trigger_default_proposito` BEFORE INSERT ON `reserva` FOR EACH ROW BEGIN
    -- Verifica si el propósito no fue especificado
    IF NEW.materia IS NULL OR NEW.materia = '' THEN
        SET NEW.materia = 'Uso general'; -- Valor por defecto
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2048 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`id`, `nombre`) VALUES
(1, 'S 11'),
(2, 'S 2'),
(3, 'S 3'),
(4, 'S 4'),
(5, 'S 5'),
(12, 'S 6'),
(13, 's 21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trigger_periodo`
--

CREATE TABLE `trigger_periodo` (
  `id` int(11) NOT NULL,
  `accion` enum('INSERT','DELETE') NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `nombre_periodo` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `trigger_periodo`
--

INSERT INTO `trigger_periodo` (`id`, `accion`, `id_periodo`, `nombre_periodo`, `usuario`, `fecha`) VALUES
(1, 'DELETE', 14, '19:00', 'root@localhost', '2024-12-02 15:26:13'),
(2, 'DELETE', 18, '', 'root@localhost', '2024-12-02 15:27:00'),
(3, 'INSERT', 19, '23:00', 'root@localhost', '2024-12-02 17:12:18'),
(4, 'DELETE', 19, '23:00', 'root@localhost', '2024-12-04 15:10:55'),
(5, 'DELETE', 1, '08:00', 'admin@localhost', '2024-12-12 14:21:34'),
(6, 'INSERT', 20, '8:00', 'admin@localhost', '2024-12-12 14:21:54'),
(7, 'DELETE', 20, '8:00', 'admin@localhost', '2024-12-12 14:35:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trigger_usuario`
--

CREATE TABLE `trigger_usuario` (
  `id` int(11) NOT NULL,
  `operacion` varchar(50) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `detalles` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `n_control` varchar(50) DEFAULT NULL,
  `contraseña` varchar(32) DEFAULT NULL,
  `rol` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `n_control`, `contraseña`, `rol`) VALUES
(1, 'teste', 'teste', '698dc19d489c4e4db73e28a713eab07b', 'admin'),
(2, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(3, 'user', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user');

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `after_delete_usuario` AFTER DELETE ON `usuario` FOR EACH ROW BEGIN
    INSERT INTO trigger_usuario (operacion, usuario_id, detalles, fecha)
    VALUES (
        'DELETE',
        OLD.id,
        CONCAT('Nombre: ', OLD.nombre, ', No Control: ', OLD.n_control, ', Rol: ', OLD.rol),
        NOW()
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_usuario` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
    INSERT INTO trigger_usuario (operacion, usuario_id, detalles, fecha)
    VALUES (
        'INSERT',
        NEW.id,
        CONCAT('Nombre: ', NEW.nombre, ', No Control: ', NEW.n_control, ', Rol: ', NEW.rol),
        NOW()
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_reservas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_reservas` (
`reserva_id` int(11)
,`dia` date
,`Profesor_alumno` varchar(255)
,`materia` varchar(255)
,`status` int(11)
,`observacion` text
,`sala_nombre` varchar(255)
,`periodo_hora` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_reservas`
--
DROP TABLE IF EXISTS `vista_reservas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_reservas`  AS SELECT `r`.`id` AS `reserva_id`, `r`.`dia` AS `dia`, `r`.`Profesor_alumno` AS `Profesor_alumno`, `r`.`materia` AS `materia`, `r`.`status` AS `status`, `r`.`observacion` AS `observacion`, `s`.`nombre` AS `sala_nombre`, `p`.`nombre` AS `periodo_hora` FROM ((`reserva` `r` join `sala` `s` on(`r`.`sala_id` = `s`.`id`)) join `periodo` `p` on(`r`.`periodo_id` = `p`.`id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_periodo_id` (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_reserva_id` (`id`),
  ADD UNIQUE KEY `UK_reserva` (`sala_id`,`periodo_id`,`dia`),
  ADD KEY `IDX_reserva_dia` (`dia`),
  ADD KEY `IDX_reserva_status` (`status`),
  ADD KEY `FK_reserva_periodo_id` (`periodo_id`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_sala_id` (`id`);

--
-- Indices de la tabla `trigger_periodo`
--
ALTER TABLE `trigger_periodo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trigger_usuario`
--
ALTER TABLE `trigger_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_usuario_id` (`id`),
  ADD UNIQUE KEY `UK_usuario_email` (`n_control`(15));

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `trigger_periodo`
--
ALTER TABLE `trigger_periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `trigger_usuario`
--
ALTER TABLE `trigger_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FK_reserva_periodo_id` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_reserva_sala_id` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
