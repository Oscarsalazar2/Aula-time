-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2024 a las 06:12:34
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
(1, '08:00'),
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
(36, 1, 1, '2024-11-28', 'oscar gamaliel', 'bsd', 2, 'examen'),
(37, 1, 1, '2024-12-05', 'oscar gamaliel', 'bsd', 2, 'examen'),
(38, 1, 1, '2024-12-12', 'oscar gamaliel', 'bsd', 2, 'examen'),
(39, 1, 1, '2024-12-19', 'oscar gamaliel', 'bsd', 2, 'examen'),
(40, 1, 1, '2024-12-26', 'oscar gamaliel', 'bsd', 2, 'examen'),
(42, 1, 6, '2024-12-05', 'oscar gamaliel', 'bsd', 2, 'examen'),
(43, 1, 6, '2024-12-12', 'oscar gamaliel', 'bsd', 2, 'examen'),
(44, 1, 6, '2024-12-19', 'oscar gamaliel', 'bsd', 2, 'examen'),
(45, 1, 6, '2024-12-26', 'oscar gamaliel', 'bsd', 2, 'examen'),
(46, 1, 13, '2024-11-28', 'oscar gamaliel', 'bsd', 2, 'prueba'),
(49, 2, 9, '2024-11-28', 'oscar gamaliel', 'km.nbnm', 1, 'prueba'),
(50, 2, 6, '2024-11-28', 'sada', 'sadasd', 2, 'asdasd'),
(51, 2, 2, '2024-11-28', 'sada', 'km.nbnm', 3, 'asdasd'),
(53, 1, 1, '2024-12-03', 'Victor Loredo', 'Topicos', 1, 'Conexion a la base de datos'),
(54, 1, 1, '2024-12-10', 'Victor Loredo', 'Topicos', 1, 'Conexion a la base de datos'),
(55, 1, 1, '2024-12-17', 'Victor Loredo', 'Topicos', 1, 'Conexion a la base de datos'),
(56, 1, 2, '2024-12-02', 'Victor Loredo', 'Topicos', 2, 'prueba'),
(59, 2, 2, '2024-12-02', 'Victor Loredo', 'Uso general', 1, 'prueba'),
(60, 1, 4, '2024-12-03', 'Victor Loredo', 'Topicos', 2, 'Conexion a la base de datos'),
(61, 1, 7, '2024-12-03', 'Luis Gerardo', 'Prueba', 1, 'prueba'),
(63, 2, 9, '2024-12-04', 'Victor Loredo', 'Topicos', 3, 'Conexion a la base de datos');

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
(1, 'S 1'),
(2, 'S 2'),
(3, 'S 3'),
(4, 'S 4'),
(5, 'S 5'),
(6, 'S 6');

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
(4, 'DELETE', 19, '23:00', 'root@localhost', '2024-12-04 15:10:55');

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

--
-- Volcado de datos para la tabla `trigger_usuario`
--

INSERT INTO `trigger_usuario` (`id`, `operacion`, `usuario_id`, `detalles`, `fecha`) VALUES
(1, 'DELETE', 10, 'Nombre: JUDITH, No Control: 22260020, Rol: user', '2024-12-04 00:28:00'),
(2, 'DELETE', 3, 'Nombre: test, No Control: test, Rol: admin', '2024-12-04 00:28:05'),
(3, 'INSERT', 12, 'Nombre: admin, No Control: admin, Rol: admin', '2024-12-04 06:30:41'),
(4, 'INSERT', 13, 'Nombre: user, No Control: user, Rol: user', '2024-12-04 06:30:57'),
(5, 'INSERT', 14, 'Nombre: asdasd, No Control: asdasd, Rol: user', '2024-12-08 03:46:59'),
(6, 'DELETE', 14, 'Nombre: asdasd, No Control: asdasd, Rol: user', '2024-12-08 03:47:10');

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
(5, 'Oscar', '22260053', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(8, 'teste', 'teste', '698dc19d489c4e4db73e28a713eab07b', 'admin'),
(9, 'Fabiola', '12345', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(11, 'Ximena Amador Morante', '22260145', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(12, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(13, 'user', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `trigger_periodo`
--
ALTER TABLE `trigger_periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `trigger_usuario`
--
ALTER TABLE `trigger_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
