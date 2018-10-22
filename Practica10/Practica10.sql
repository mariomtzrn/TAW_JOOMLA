-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-10-2018 a las 11:00:38
-- Versión del servidor: 5.7.23-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Practica10`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `matricula` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `carrera` int(11) NOT NULL,
  `tutor` int(11) NOT NULL,
  `sa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`matricula`, `nombre`, `apellido`, `imagen`, `carrera`, `tutor`, `sa`) VALUES
(1430088, 'Mario', 'Martinez', 'views/ImagenesA/2210201891545avatar04.png', 1, 98765, 'Regular'),
(1430302, 'Georgina', 'Fonseca', 'views/ImagenesA/2210201893143avatar3.png', 1, 98765, 'Regular'),
(1530031, 'Daniela', 'Gonzalez', 'views/ImagenesA/no-imagen.jpg', 1, 1234567, 'Regular'),
(1530088, 'Francisco ', 'Alvarado', 'views/ImagenesA/2210201891650avatar5.png', 2, 1234567, 'Regular'),
(1530302, 'Mariela', 'Reyes', 'views/ImagenesA/2210201891730avatar2.png', 1, 1234567, 'Especial'),
(1830088, 'Marion', 'Martinez ', 'views/ImagenesA/no-imagen.jpg', 1, 98765, 'Regular'),
(1830302, 'Damaris', 'Reyes', 'views/ImagenesA/no-imagen.jpg', 1, 1234567, 'Regular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`) VALUES
(1, 'Ing. TecnologÃ­as de la InformaciÃ³n'),
(2, 'Ing. Mecatronica'),
(3, 'Ing. Sistemas Automotrices '),
(4, 'Lic. Gestion de PequeÃ±as y Medianas Empresas'),
(5, 'Ing. Manufactura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupal_Tutorias`
--

CREATE TABLE `grupal_Tutorias` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_tutoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historal`
--

CREATE TABLE `historal` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `hora` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historal`
--

INSERT INTO `historal` (`id`, `usuario`, `fecha`, `hora`) VALUES
(1, 1234567, '2018-10-22', '05:27:51 AM'),
(2, 98765, '2018-10-22', '05:29:59 AM'),
(3, 345678, '2018-10-22', '05:33:16 AM'),
(4, 1234567, '2018-10-22', '05:48:58 AM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `imagen` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `nombre`, `apellido`, `imagen`, `email`, `password`, `tipo`, `titulo`) VALUES
(98765, 'Alberto', 'Garcia Robledo', 'views/ImagenesT/221020189954user6-128x128.jpg', 'agarciar@upv.edu.mx', 'robledo', 1, 'DR.'),
(345678, 'Jorge Arturo', ' HernÃ¡ndez AlmazÃ¡n', 'views/ImagenesT/2210201810509user1-128x128.jpg', 'jhernandeza@upv.edu.mx', 'almazan', 1, 'M.S.C'),
(1234567, 'Mario Humberto', 'Rodriguez Chavez', 'views/ImagenesT/2210201885735user8-128x128.jpg', 'admin@upv.edu.mx', 'admin', 0, 'M.S.I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutorias`
--

CREATE TABLE `tutorias` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_maestro` int(11) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `tema` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tutorias`
--

INSERT INTO `tutorias` (`id`, `id_alumno`, `id_maestro`, `fecha`, `hora`, `tipo`, `tema`) VALUES
(1, 1430302, 98765, '2018-10-22', '05:32:12 AM', 'Individual', '<p>asuntos</p>');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `tutor` (`tutor`),
  ADD KEY `carrera` (`carrera`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupal_Tutorias`
--
ALTER TABLE `grupal_Tutorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historal`
--
ALTER TABLE `historal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tutorias`
--
ALTER TABLE `tutorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_maestro` (`id_maestro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `grupal_Tutorias`
--
ALTER TABLE `grupal_Tutorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `historal`
--
ALTER TABLE `historal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tutorias`
--
ALTER TABLE `tutorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`tutor`) REFERENCES `profesor` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnos_ibfk_3` FOREIGN KEY (`tutor`) REFERENCES `profesor` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnos_ibfk_4` FOREIGN KEY (`carrera`) REFERENCES `carrera` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `historal`
--
ALTER TABLE `historal`
  ADD CONSTRAINT `historal_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `profesor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tutorias`
--
ALTER TABLE `tutorias`
  ADD CONSTRAINT `tutorias_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`matricula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tutorias_ibfk_2` FOREIGN KEY (`id_maestro`) REFERENCES `profesor` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
