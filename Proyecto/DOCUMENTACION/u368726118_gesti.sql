-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-06-2017 a las 19:20:42
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u368726118_gesti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE IF NOT EXISTS `acceso` (
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`usuario`, `clave`, `tipo`) VALUES
('admin', '123456', 'administra'),
('root', 'toor', 'profesor'),
('tux', 'linux', 'profesor'),
('usuario', 'usuario', 'alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
  `idActividad` int(11) NOT NULL AUTO_INCREMENT,
  `nomActiv` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idActividad`),
  UNIQUE KEY `actividad` (`idActividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`idActividad`, `nomActiv`) VALUES
(1, 'Zumba'),
(2, 'Judo'),
(3, 'Baile'),
(4, 'Futbol'),
(5, 'Hockey');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `dni` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idColegio` int(30) NOT NULL,
  `edad` date NOT NULL,
  `curso` int(2) NOT NULL,
  `idActividad` int(11) NOT NULL,
  PRIMARY KEY (`dni`),
  UNIQUE KEY `dni` (`dni`),
  KEY `idActividad` (`idActividad`),
  KEY `idColegio` (`idColegio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`dni`, `nombre`, `idColegio`, `edad`, `curso`, `idActividad`) VALUES
('12345678B', 'Pedro', 1, '2008-06-09', 3, 5),
('12345678P', 'Rosa', 2, '2008-06-09', 3, 3),
('12345678Z', 'Olga', 3, '2006-06-06', 4, 1),
('12356892K', 'Alexia', 1, '2006-09-09', 2, 3),
('12745632K', '    Alejandro', 2, '2017-06-30', 2, 5),
('2368995P', 'Ricardo', 3, '2017-01-19', 2, 4),
('252582525', ' Angel', 1, '2010-02-25', 1, 2),
('35869756K', 'Amapola', 2, '2007-01-14', 4, 5),
('35869757K', 'Lucia', 3, '2006-12-07', 4, 5),
('784591263', 'Gabriel', 1, '2007-07-08', 4, 0),
('8459126', 'Raquel', 2, '2010-02-25', 1, 2),
('88888888S', ' Sofía', 3, '2008-03-18', 3, 4),
('98745612K', 'Rocio Caballero Galante', 1, '2006-07-09', 2, 1),
('98745632K', 'Mario', 1, '2006-09-09', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `castillo`
--

CREATE TABLE IF NOT EXISTS `castillo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) COLLATE utf8_bin NOT NULL,
  `imagen` varchar(100) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `castillo`
--

INSERT INTO `castillo` (`id`, `titulo`, `imagen`, `descripcion`) VALUES
(3, 'Castillo Mediano Rosa', 'castillo3.jpg', 'Castillo de tamaño medio con dos pasarelas de entrada y salida.'),
(29, '    ', 'logo2.jpg', '        '),
(32, 'Castillo Pequeño', 'castillo2.jpg', '                Castillo de dimensiones reducidas para hacer la fiesta de los mas peques inolvidable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegio`
--

CREATE TABLE IF NOT EXISTS `colegio` (
  `idColegio` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Localidad` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idColegio`),
  UNIQUE KEY `colegio` (`idColegio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `colegio`
--

INSERT INTO `colegio` (`idColegio`, `Nombre`, `Direccion`, `Localidad`) VALUES
(1, 'CEIP Los Jarales', 'Calle San Fernando', 'Rincon de la Victori'),
(2, 'CEIP La Candelaria', 'Benagalbon', 'Rincon de la Victori'),
(3, 'CEIP La Asuncion ', 'El Palo', 'Malaga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE IF NOT EXISTS `profesor` (
  `dni` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idActividad` int(100) NOT NULL,
  PRIMARY KEY (`dni`),
  KEY `idActividad` (`idActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`dni`, `nombre`, `direccion`, `telefono`, `idActividad`) VALUES
('       345', '       Alejandro Risas Misas', '       Avda. del Manantial, s/n, 29000, Malaga       ', '       600345678    ', 1),
('     12345', '     Jose Antonio Flores Camp', '     C/Rosas Rojas, s/n, 29000, Malaga     ', '     600123476     ', 1),
('  23456789', '  Almudena Vera Fernandez', '  C/Rio Seco, s/n, 29000, Malaga  ', '  600234567  ', 3),
('987456123P', 'Lucas Gil Dorado', 'C/Pantano, s/n, 29000, Malaga', '666666666', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
