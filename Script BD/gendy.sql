-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 17, 2020 at 12:19 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gendy`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOMBRE_CATEGORIA` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`ID_CATEGORIA`, `NOMBRE_CATEGORIA`) VALUES
(1, 'Restaurante'),
(2, 'Belleza'),
(3, 'Bienestar'),
(4, 'Fitness'),
(5, 'Mecánico ');

-- --------------------------------------------------------

--
-- Table structure for table `cita`
--

CREATE TABLE `cita` (
  `id` int(11) NOT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  `ID_NEGOCIO` int(11) DEFAULT NULL,
  `ID_SERVICIO` int(11) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `DIA_CITA` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cita`
--

INSERT INTO `cita` (`id`, `ID_USUARIO`, `ID_NEGOCIO`, `ID_SERVICIO`, `start`, `end`, `DIA_CITA`) VALUES
(1, 4, 1, 6, '2020-12-15 13:50:00', '2020-12-15 15:50:00', 'Tue'),
(2, 4, 1, 6, '2020-12-06 13:50:00', '2020-12-06 15:50:00', 'Sun'),
(3, 4, 1, 6, '2021-01-01 13:50:00', '2021-01-01 15:50:00', 'Fri'),
(4, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, 1, 6, '2020-12-28 14:50:00', '2020-12-28 15:50:00', 'Mon'),
(6, 4, 1, 6, '2021-01-03 13:50:00', '2021-01-03 15:50:00', 'Sun'),
(7, 4, 1, 6, '2020-12-19 13:50:00', '2020-12-19 15:50:00', 'Sat'),
(8, 4, 3, 4, '2020-12-11 01:05:49', '2020-12-11 02:05:00', 'Fri'),
(9, 4, 3, 4, '2020-12-17 01:05:49', '2020-12-17 02:05:00', 'Thu'),
(10, 4, 5, 8, '2020-12-15 07:00:00', '2020-12-15 08:00:00', 'Tue'),
(11, 4, 5, 8, '2020-12-23 07:00:00', '2020-12-23 08:00:00', 'Wed'),
(12, 2, 1, 6, '2020-12-11 10:23:00', '2020-12-11 12:00:00', 'Fri'),
(13, 2, 1, 6, '2020-12-27 10:23:00', '2020-12-27 12:00:00', 'Sun'),
(14, 2, 1, 6, '2020-12-28 11:23:00', '2020-12-28 12:00:00', 'Mon'),
(15, 2, 1, 6, '2020-12-28 16:23:00', '2020-12-28 18:00:00', 'Wed'),
(16, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 3, 1, 1, '2020-12-18 16:23:00', '2020-12-18 17:00:00', 'Fri'),
(18, 3, 1, 1, '2020-12-20 16:23:00', '2020-12-20 17:00:00', 'Sun'),
(19, 3, 1, 1, '2020-12-30 16:23:00', '2020-12-30 17:00:00', 'Thu'),
(20, 3, 4, 14, '2020-12-28 12:00:00', '2020-12-28 13:00:00', 'Mon'),
(21, 3, 4, 14, '2020-12-31 12:30:00', '2020-12-31 13:00:00', 'Thu'),
(22, 3, 4, 14, '2021-01-02 12:30:00', '2021-01-02 13:00:00', 'Sat'),
(23, 3, 5, 8, '2020-12-23 16:00:00', '2020-12-23 17:00:00', 'Wed'),
(24, 2, 4, 18, '2020-12-24 14:23:00', '2020-12-24 15:00:00', 'Thu'),
(25, 1, 1, 1, '2020-12-24 12:00:00', '2020-12-24 01:00:00', 'Thu'),
(26, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, 4, 13, '2020-12-29 01:05:49', '2020-12-29 05:05:49', 'Tue');

--
-- Triggers `cita`
--
DELIMITER $$
CREATE TRIGGER `llenado` AFTER INSERT ON `cita` FOR EACH ROW INSERT INTO `cita_final` (`id_cita`, `id_usuario`, `id_negocio`, `nombre_usuario`, `telefono_usuario`, `nombre_servicio`, `descripcion_servicio`, `precio_servicio`, `start`, `end`, `nombre_negocio`, `telefono_negocio`, `direccion_negocio`) 
VALUES ((SELECT COUNT(*) FROM `cita`),
	(SELECT `ID_USUARIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`)), 
	(SELECT `ID_NEGOCIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`)),
	(SELECT `NOMBRE_USUARIO` FROM `usuario` WHERE `ID_USUARIO`=(SELECT `ID_USUARIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`))), 
	(SELECT `TELEFONO` FROM `usuario` WHERE `ID_USUARIO`=(SELECT `ID_USUARIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`))), 
	(SELECT `NOMBRE_SERVICIOS` FROM `servicios` WHERE `ID_SERVICIOS`=(SELECT `ID_SERVICIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`)) AND`ID_NEGOCIO`=(SELECT `ID_NEGOCIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`))), 
	(SELECT `DESCRIPCION_SERVICIOS` FROM `servicios` WHERE `ID_SERVICIOS`=(SELECT `ID_SERVICIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`)) AND`ID_NEGOCIO`=(SELECT `ID_NEGOCIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`))), 
	(SELECT `PRECIO_SERVICIO` FROM `servicios` WHERE `ID_SERVICIOS`=(SELECT `ID_SERVICIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`)) AND`ID_NEGOCIO`=(SELECT `ID_NEGOCIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`))), 
	(SELECT `start` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`)), 
	(SELECT `end` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`)), 
	(SELECT `RAZON_SOCIAL` FROM `negocio` WHERE `ID_NEGOCIO`=(SELECT `ID_NEGOCIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`))), 
	(SELECT `TELEFONO_NEGOCIA` FROM `negocio` WHERE `ID_NEGOCIO`=(SELECT `ID_NEGOCIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`))), 
	(SELECT `DIRECCION_NEGOCIO` FROM `negocio` WHERE `ID_NEGOCIO`=(SELECT `ID_NEGOCIO` FROM `cita` WHERE `id`=(SELECT COUNT(*) FROM `cita`))))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cita_final`
--

CREATE TABLE `cita_final` (
  `id_cita` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_negocio` int(11) DEFAULT NULL,
  `nombre_usuario` mediumtext,
  `telefono_usuario` double DEFAULT NULL,
  `nombre_servicio` mediumtext,
  `descripcion_servicio` longtext,
  `precio_servicio` double DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `nombre_negocio` mediumtext,
  `telefono_negocio` double DEFAULT NULL,
  `direccion_negocio` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cita_final`
--

INSERT INTO `cita_final` (`id_cita`, `id_usuario`, `id_negocio`, `nombre_usuario`, `telefono_usuario`, `nombre_servicio`, `descripcion_servicio`, `precio_servicio`, `start`, `end`, `nombre_negocio`, `telefono_negocio`, `direccion_negocio`) VALUES
(1, 4, 1, 'Juan', 964687, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, '2020-12-15 13:50:00', '2020-12-15 15:50:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(2, 4, 1, 'Juan', 964687, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, '2020-12-06 13:50:00', '2020-12-06 15:50:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(3, 4, 1, 'Juan', 964687, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, '2021-01-01 13:50:00', '2021-01-01 15:50:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, 1, 'Juan', 964687, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, '2020-12-28 14:50:00', '2020-12-28 15:50:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(6, 4, 1, 'Juan', 964687, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, '2021-01-03 13:50:00', '2021-01-03 15:50:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(7, 4, 1, 'Juan', 964687, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, '2020-12-19 13:50:00', '2020-12-19 15:50:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(8, 4, 3, 'Juan', 964687, '1 Lb wiskas', '1 Lb de comida para gato marca wiskas', 6550, '2020-12-11 01:05:49', '2020-12-11 02:05:00', 'Pepe Comidas', 12345, 'Calle 2 # 2-2'),
(9, 4, 3, 'Juan', 964687, '1 Lb wiskas', '1 Lb de comida para gato marca wiskas', 6550, '2020-12-17 01:05:49', '2020-12-17 02:05:00', 'Pepe Comidas', 12345, 'Calle 2 # 2-2'),
(10, 4, 5, 'Juan', 964687, 'Guanabana', 'Una guanabana de 2 kg', 65200, '2020-12-15 07:00:00', '2020-12-15 08:00:00', 'Festividades la guanabana', 32685152, 'Calla 58 # 5-39'),
(11, 4, 5, 'Juan', 964687, 'Guanabana', 'Una guanabana de 2 kg', 65200, '2020-12-23 07:00:00', '2020-12-23 08:00:00', 'Festividades la guanabana', 32685152, 'Calla 58 # 5-39'),
(12, 2, 1, 'Nicolas', 98562482, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, '2020-12-11 10:23:00', '2020-12-11 12:00:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(13, 2, 1, 'Nicolas', 98562482, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, '2020-12-27 10:23:00', '2020-12-27 12:00:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(14, 2, 1, 'Nicolas', 98562482, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, '2020-12-28 11:23:00', '2020-12-28 12:00:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(15, 2, 1, 'Nicolas', 98562482, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, '2020-12-28 16:23:00', '2020-12-28 18:00:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 3, 1, 'Thommy', 64135186, 'Pollo frito', 'Un jugoso pollo frito', 15000, '2020-12-18 16:23:00', '2020-12-18 17:00:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(18, 3, 1, 'Thommy', 64135186, 'Pollo frito', 'Un jugoso pollo frito', 15000, '2020-12-20 16:23:00', '2020-12-20 17:00:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(19, 3, 1, 'Thommy', 64135186, 'Pollo frito', 'Un jugoso pollo frito', 15000, '2020-12-30 16:23:00', '2020-12-30 17:00:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(20, 3, 4, 'Thommy', 64135186, 'Lasaña', 'Lasaña de carne', 12300, '2020-12-28 12:00:00', '2020-12-28 13:00:00', 'Pastas Doria', 58455951, 'Calle 1 # 1-1'),
(21, 3, 4, 'Thommy', 64135186, 'Lasaña', 'Lasaña de carne', 12300, '2020-12-31 12:30:00', '2020-12-31 13:00:00', 'Pastas Doria', 58455951, 'Calle 1 # 1-1'),
(22, 3, 4, 'Thommy', 64135186, 'Lasaña', 'Lasaña de carne', 12300, '2021-01-02 12:30:00', '2021-01-02 13:00:00', 'Pastas Doria', 58455951, 'Calle 1 # 1-1'),
(23, 3, 5, 'Thommy', 64135186, 'Guanabana', 'Una guanabana de 2 kg', 65200, '2020-12-23 16:00:00', '2020-12-23 17:00:00', 'Festividades la guanabana', 32685152, 'Calla 58 # 5-39'),
(24, 2, 4, 'Nicolas', 98562482, 'Jugo de Mango', 'Delicioso jugo de mango', 2300, '2020-12-24 14:23:00', '2020-12-24 15:00:00', 'Pastas Doria', 58455951, 'Calle 1 # 1-1'),
(25, 1, 1, 'Sergio ', 64165486, 'Pollo frito', 'Un jugoso pollo frito', 15000, '2020-12-24 12:00:00', '2020-12-24 01:00:00', 'Alas de pollo', 8746852, 'Calla 58 # 5-36'),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, 4, 'Sergio ', 64165486, 'Spaguetti', 'Bolsa de 100g de Spaguetti', 2300, '2020-12-29 01:05:49', '2020-12-29 05:05:49', 'Pastas Doria', 58455951, 'Calle 1 # 1-1');

-- --------------------------------------------------------

--
-- Table structure for table `medios_de_pago`
--

CREATE TABLE `medios_de_pago` (
  `ID_MEDIOS_DE_PAGO` int(11) NOT NULL,
  `TIPO_DE_MEDIO_DE_PAGO` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medios_de_pago_negocio`
--

CREATE TABLE `medios_de_pago_negocio` (
  `ID_NEGOCIO` int(11) NOT NULL,
  `ID_MEDIOS_DE_PAGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `ID_MENU` int(11) NOT NULL,
  `ID_NEGOCIO` int(11) NOT NULL,
  `NOMBRE_PLATO_` mediumtext NOT NULL,
  `PRECIO` int(11) NOT NULL,
  `DESCRIPCION` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `negocio`
--

CREATE TABLE `negocio` (
  `ID_NEGOCIO` int(11) NOT NULL,
  `RAZON_SOCIAL` mediumtext NOT NULL,
  `CONTRASENA_NEGOCIO` mediumtext NOT NULL,
  `CORREO_ELECTRONICO_NEGOCIO` text NOT NULL,
  `TELEFONO_NEGOCIA` double DEFAULT NULL,
  `DIRECCION_NEGOCIO` mediumtext NOT NULL,
  `LOCALIDAD` mediumtext NOT NULL,
  `PUNTAJE_NEGOCIO` smallint(6) NOT NULL,
  `HORA_APERTURA` int(11) NOT NULL,
  `HORA_CIERRE` int(11) NOT NULL,
  `DIA_APERTURA` text NOT NULL,
  `DIA_CIERRE` text NOT NULL,
  `AFORO` int(11) NOT NULL,
  `imagen` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `negocio`
--

INSERT INTO `negocio` (`ID_NEGOCIO`, `RAZON_SOCIAL`, `CONTRASENA_NEGOCIO`, `CORREO_ELECTRONICO_NEGOCIO`, `TELEFONO_NEGOCIA`, `DIRECCION_NEGOCIO`, `LOCALIDAD`, `PUNTAJE_NEGOCIO`, `HORA_APERTURA`, `HORA_CIERRE`, `DIA_APERTURA`, `DIA_CIERRE`, `AFORO`, `imagen`) VALUES
(1, 'Alas de pollo', 'hola', 'alas123@gmail.com', 8746852, 'Calla 58 # 5-36', 'Teusaquillo', 5, 11, 22, 'Lunes', 'Viernes', 10, ''),
(2, 'Comida don Gato', 'hola', 'dgcomida@gmail.com', 3158932298, 'Carrera 61 #87-96', 'Barrios Unidos', 5, 7, 15, 'Jueves', 'Domingo', 45, ''),
(3, 'Pepe Comidas', 'hola', 'tom@gmail.com', 12345, 'Calle 2 # 2-2', 'Suba', 5, 10, 14, 'Lunes', 'Martes', 125, ''),
(4, 'Pastas Doria', 'hola', 'lo@gmail.com', 58455951, 'Calle 1 # 1-1', 'Suba', 5, 8, 16, 'Lunes', 'Viernes', 3, ''),
(5, 'Festividades la guanabana', 'hola', 'flg@gmail.com', 32685152, 'Calla 58 # 5-39', 'Usme', 5, 9, 18, 'Lunes', 'Sabado', 45, ''),
(6, 'Adobe', 'hola', 'adobe@gmail.com', 18264912, 'Calle 2 # 2-2', 'Usaquen', 5, 9, 17, 'Jueves', 'Martes', 85, ''),
(7, 'Motorola', 'hola', 'moto@gmail.com', 562822, 'Calla 58 # 5-36', 'Suba', 5, 9, 15, 'Lunes', 'Viernes', 12500, ''),
(8, 'Apple', 'hola', 'apple@gmail.com', 81625, 'Calle 1 #1-1', 'Santa Fe', 5, 8, 22, 'Lunes', 'Domingo', 300, ''),
(9, 'Sony', 'hola', 'sony@gmail.com', 97641634, 'Calla 58 # 5-90', 'Tunjuelito', 5, 9, 12, 'Martes', 'Jueves', 12, ''),
(10, 'Tortas don Pepe', 'hola', 'tdpepe@gmail.com', 984513, 'Avenida Suba # 96-35', 'Suba', 5, 10, 15, 'Lunes', 'Domingo', 23, ''),
(11, 'Coca-Cola', 'hola', 'coke@gmail.com', 964516, 'Calle 3 #3-3', 'Barrios Unidos', 5, 6, 23, 'Miercoles', 'Domingo', 9, '');

-- --------------------------------------------------------

--
-- Table structure for table `negocios_favoritos`
--

CREATE TABLE `negocios_favoritos` (
  `ID_NEGOCIO` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `negocios_favoritos`
--

INSERT INTO `negocios_favoritos` (`ID_NEGOCIO`, `ID_USUARIO`) VALUES
(2, 1),
(4, 1),
(1, 2),
(5, 3),
(1, 4),
(10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pertenece`
--

CREATE TABLE `pertenece` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `ID_NEGOCIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pertenece`
--

INSERT INTO `pertenece` (`ID_CATEGORIA`, `ID_NEGOCIO`) VALUES
(1, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `servicios`
--

CREATE TABLE `servicios` (
  `ID_SERVICIOS` int(11) NOT NULL,
  `ID_NEGOCIO` int(11) NOT NULL,
  `NOMBRE_SERVICIOS` mediumtext NOT NULL,
  `DESCRIPCION_SERVICIOS` longtext NOT NULL,
  `PRECIO_SERVICIO` double NOT NULL,
  `IMAGEN_SERVICIO` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `servicios`
--

INSERT INTO `servicios` (`ID_SERVICIOS`, `ID_NEGOCIO`, `NOMBRE_SERVICIOS`, `DESCRIPCION_SERVICIOS`, `PRECIO_SERVICIO`, `IMAGEN_SERVICIO`) VALUES
(1, 1, 'Pollo frito', 'Un jugoso pollo frito', 15000, ''),
(2, 1, 'Pollo broaster', 'Delicioso pollo broaster', 20000, ''),
(3, 1, 'Combo pollo frito', 'Un jugoso pollo frito con 3 arepas y gaseosa', 23500, ''),
(4, 3, '1 Lb wiskas', '1 Lb de comida para gato marca wiskas', 6550, ''),
(5, 9, 'Camaras Fotográficas', 'Venta de camaras en oferta', 2650000, ''),
(6, 1, 'Como de alas BBQ', 'Super combo de alitas BBQ con arepa', 15000, ''),
(7, 6, 'ACSS', 'ACS', 2350000, NULL),
(8, 5, 'Guanabana', 'Una guanabana de 2 kg', 65200, NULL),
(9, 7, 'Motorola G9', 'Celular de ultima tecnologia', 2350000, NULL),
(10, 2, 'Cat Chow', 'Un bulto de comida Cat Chow', 65200, NULL),
(11, 2, 'Dog Chow', 'Un bulto de comida Dog Chow', 65200, NULL),
(12, 8, 'iPhone XI', 'Celular de ultima tecnologia iPhone', 2350000, NULL),
(13, 4, 'Spaguetti', 'Bolsa de 100g de Spaguetti', 2300, NULL),
(14, 4, 'Lasaña', 'Lasaña de carne', 12300, NULL),
(15, 4, 'Lasaña pollo', 'Lasaña de pollo', 10500, NULL),
(16, 5, 'Guanabana pequeña', 'Una guanabana de 200g', 5200, NULL),
(17, 10, 'Torta chocolate', 'Deliciosa torta de chocolate', 54200, NULL),
(18, 4, 'Jugo de Mango', 'Delicioso jugo de mango', 2300, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE_USUARIO` mediumtext NOT NULL,
  `APODO_USUARIO` mediumtext NOT NULL,
  `CONTRASENA` mediumtext NOT NULL,
  `CORREO_ELECTRONICO` mediumtext NOT NULL,
  `TELEFONO` double DEFAULT NULL,
  `PUNTAJE_USUARIO` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `NOMBRE_USUARIO`, `APODO_USUARIO`, `CONTRASENA`, `CORREO_ELECTRONICO`, `TELEFONO`, `PUNTAJE_USUARIO`) VALUES
(1, 'Sergio ', 'Niser', 'hola', 'nicolassergio6@gmail.com', 64165486, 5),
(2, 'Nicolas', 'Nic', 'hola', 'nic@gmail.com', 98562482, 5),
(3, 'Thommy', 'Gordo', 'hola', 'tomas@gmail.com', 64135186, 5),
(4, 'Juan', 'Juanito', 'hola', 'j@gmail.com', 964687, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Indexes for table `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CITA_TIENE_USU_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_NEGOCIO` (`ID_NEGOCIO`,`ID_USUARIO`,`id`,`ID_SERVICIO`) USING BTREE;

--
-- Indexes for table `cita_final`
--
ALTER TABLE `cita_final`
  ADD PRIMARY KEY (`id_cita`);

--
-- Indexes for table `medios_de_pago`
--
ALTER TABLE `medios_de_pago`
  ADD PRIMARY KEY (`ID_MEDIOS_DE_PAGO`);

--
-- Indexes for table `medios_de_pago_negocio`
--
ALTER TABLE `medios_de_pago_negocio`
  ADD PRIMARY KEY (`ID_NEGOCIO`,`ID_MEDIOS_DE_PAGO`),
  ADD KEY `FK_MEDIOS_D_GUARDA_ME_MEDIOS_D` (`ID_MEDIOS_DE_PAGO`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID_MENU`),
  ADD KEY `FK_MENU_OFERTA_ME_NEGOCIO` (`ID_NEGOCIO`);

--
-- Indexes for table `negocio`
--
ALTER TABLE `negocio`
  ADD PRIMARY KEY (`ID_NEGOCIO`);

--
-- Indexes for table `negocios_favoritos`
--
ALTER TABLE `negocios_favoritos`
  ADD PRIMARY KEY (`ID_NEGOCIO`,`ID_USUARIO`),
  ADD KEY `FK_NEGOCIOS_ASISTE_US_USUARIO` (`ID_USUARIO`);

--
-- Indexes for table `pertenece`
--
ALTER TABLE `pertenece`
  ADD PRIMARY KEY (`ID_CATEGORIA`,`ID_NEGOCIO`),
  ADD KEY `FK_PERTENEC_PERTENECE_NEGOCIO` (`ID_NEGOCIO`);

--
-- Indexes for table `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`ID_SERVICIOS`),
  ADD KEY `FK_SERVICIO_OFRECE_NEGOCIO` (`ID_NEGOCIO`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `FK_CITA_TIENE_NEG_NEGOCIO` FOREIGN KEY (`ID_NEGOCIO`) REFERENCES `negocio` (`ID_NEGOCIO`),
  ADD CONSTRAINT `FK_CITA_TIENE_USU_USUARIO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Constraints for table `medios_de_pago_negocio`
--
ALTER TABLE `medios_de_pago_negocio`
  ADD CONSTRAINT `FK_MEDIOS_D_GUARDA_ME_MEDIOS_D` FOREIGN KEY (`ID_MEDIOS_DE_PAGO`) REFERENCES `medios_de_pago` (`ID_MEDIOS_DE_PAGO`),
  ADD CONSTRAINT `FK_MEDIOS_D_GUARDA_NE_NEGOCIO` FOREIGN KEY (`ID_NEGOCIO`) REFERENCES `negocio` (`ID_NEGOCIO`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_MENU_OFERTA_ME_NEGOCIO` FOREIGN KEY (`ID_NEGOCIO`) REFERENCES `negocio` (`ID_NEGOCIO`);

--
-- Constraints for table `negocios_favoritos`
--
ALTER TABLE `negocios_favoritos`
  ADD CONSTRAINT `FK_NEGOCIOS_ASISTE_NEGOCIO` FOREIGN KEY (`ID_NEGOCIO`) REFERENCES `negocio` (`ID_NEGOCIO`),
  ADD CONSTRAINT `FK_NEGOCIOS_ASISTE_US_USUARIO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Constraints for table `pertenece`
--
ALTER TABLE `pertenece`
  ADD CONSTRAINT `FK_PERTENEC_PERTENECE_CATEGORI` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categorias` (`ID_CATEGORIA`),
  ADD CONSTRAINT `FK_PERTENEC_PERTENECE_NEGOCIO` FOREIGN KEY (`ID_NEGOCIO`) REFERENCES `negocio` (`ID_NEGOCIO`);

--
-- Constraints for table `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `FK_SERVICIO_OFRECE_NEGOCIO` FOREIGN KEY (`ID_NEGOCIO`) REFERENCES `negocio` (`ID_NEGOCIO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
