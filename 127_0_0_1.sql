-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2016 a las 20:18:38
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_ssped`
--
CREATE DATABASE IF NOT EXISTS `bd_ssped` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_ssped`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idAsistencia` int(4) NOT NULL,
  `idGrupCat` int(4) NOT NULL,
  `idPlanificacion` int(4) NOT NULL,
  `idEtapa` int(11) NOT NULL,
  `idMesociclo` int(11) NOT NULL,
  `idJugador` int(11) NOT NULL,
  `C_1` int(1) DEFAULT NULL,
  `C_2` int(1) DEFAULT NULL,
  `C_3` int(1) DEFAULT NULL,
  `C_4` int(1) DEFAULT NULL,
  `C_5` int(1) DEFAULT NULL,
  `C_6` int(1) DEFAULT NULL,
  `C_7` int(1) DEFAULT NULL,
  `C_8` int(1) DEFAULT NULL,
  `C_9` int(1) DEFAULT NULL,
  `C10` int(1) DEFAULT NULL,
  `C11` int(1) DEFAULT NULL,
  `C12` int(1) DEFAULT NULL,
  `C13` int(1) DEFAULT NULL,
  `C14` int(1) DEFAULT NULL,
  `C15` int(1) DEFAULT NULL,
  `C16` int(1) DEFAULT NULL,
  `C17` int(1) DEFAULT NULL,
  `C18` int(1) DEFAULT NULL,
  `C19` int(1) DEFAULT NULL,
  `C20` int(1) DEFAULT NULL,
  `C21` int(1) DEFAULT NULL,
  `C22` int(1) DEFAULT NULL,
  `C23` int(1) DEFAULT NULL,
  `C24` int(1) DEFAULT NULL,
  `C25` int(1) DEFAULT NULL,
  `C26` int(1) DEFAULT NULL,
  `C27` int(1) DEFAULT NULL,
  `C28` int(1) DEFAULT NULL,
  `C29` int(1) DEFAULT NULL,
  `C30` int(1) DEFAULT NULL,
  `C31` int(1) DEFAULT NULL,
  `C32` int(1) DEFAULT NULL,
  `C33` int(1) DEFAULT NULL,
  `C34` int(1) DEFAULT NULL,
  `C35` int(1) DEFAULT NULL,
  `C36` int(1) DEFAULT NULL,
  `C37` int(1) DEFAULT NULL,
  `C38` int(1) DEFAULT NULL,
  `C39` int(1) DEFAULT NULL,
  `C40` int(1) DEFAULT NULL,
  `C41` int(1) DEFAULT NULL,
  `C42` int(1) DEFAULT NULL,
  `total_clases` int(11) DEFAULT NULL,
  `total_nota` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idAsistencia`, `idGrupCat`, `idPlanificacion`, `idEtapa`, `idMesociclo`, `idJugador`, `C_1`, `C_2`, `C_3`, `C_4`, `C_5`, `C_6`, `C_7`, `C_8`, `C_9`, `C10`, `C11`, `C12`, `C13`, `C14`, `C15`, `C16`, `C17`, `C18`, `C19`, `C20`, `C21`, `C22`, `C23`, `C24`, `C25`, `C26`, `C27`, `C28`, `C29`, `C30`, `C31`, `C32`, `C33`, `C34`, `C35`, `C36`, `C37`, `C38`, `C39`, `C40`, `C41`, `C42`, `total_clases`, `total_nota`) VALUES
(10, 21, 12, 1, 163, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 21, 12, 1, 163, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 21, 12, 1, 163, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 21, 12, 1, 163, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 22, 13, 1, 167, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 21, 12, 1, 163, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 21, 12, 2, 164, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(4) NOT NULL,
  `categoria_sub` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `categoria_sub`) VALUES
(1, 'sub 5'),
(2, 'sub 7'),
(3, 'sub 9'),
(4, 'sub 11'),
(5, 'sub 13'),
(6, 'sub 15'),
(7, 'preprofesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_grupo`
--

CREATE TABLE `categoria_grupo` (
  `idCategoria_grupo` int(4) NOT NULL,
  `idGrupo` int(4) NOT NULL,
  `idCategoria` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_grupo`
--

INSERT INTO `categoria_grupo` (`idCategoria_grupo`, `idGrupo`, `idCategoria`) VALUES
(21, 23, 6),
(22, 24, 4),
(23, 25, 3),
(24, 26, 4),
(25, 27, 3),
(26, 28, 5),
(27, 29, 1),
(28, 30, 4),
(29, 31, 4),
(30, 32, 5),
(31, 33, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `idClase` int(4) NOT NULL,
  `clase` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`idClase`, `clase`) VALUES
(1, 'c1'),
(2, 'c2'),
(3, 'c3'),
(4, 'c4'),
(5, 'c5'),
(6, 'c6'),
(7, 'c7'),
(8, 'c8'),
(9, 'c9'),
(10, 'c10'),
(11, 'c11'),
(12, 'c12'),
(13, 'c13'),
(14, 'c14'),
(15, 'c15'),
(16, 'c16'),
(17, 'c17'),
(18, 'c18'),
(19, 'c19'),
(20, 'c20'),
(21, 'c21'),
(22, 'c22'),
(23, 'c23'),
(24, 'c24'),
(25, 'c25'),
(26, 'c26'),
(27, 'c27'),
(28, 'c28'),
(29, 'c29'),
(30, 'c30'),
(31, 'c31'),
(32, 'c32'),
(33, 'c33'),
(34, 'c34'),
(35, 'c35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

CREATE TABLE `deporte` (
  `idDeporte` int(4) NOT NULL,
  `deporte` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deporte`
--

INSERT INTO `deporte` (`idDeporte`, `deporte`) VALUES
(1, 'Futbol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia`
--

CREATE TABLE `dia` (
  `idDia` int(4) NOT NULL,
  `dia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dia`
--

INSERT INTO `dia` (`idDia`, `dia`) VALUES
(1, 'lunes'),
(2, 'martes'),
(3, 'miercoles'),
(4, 'jueves'),
(5, 'viernes'),
(6, 'sabado'),
(7, 'domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `idDireccion` int(11) NOT NULL,
  `idPlanificacion` int(11) NOT NULL,
  `idMesociclo` int(11) NOT NULL,
  `semana` int(11) NOT NULL,
  `sistema_juego` float NOT NULL,
  `preparation_fisica` float NOT NULL,
  `tecnico_tactico` float NOT NULL,
  `competencia` float NOT NULL,
  `accion_psi` float NOT NULL,
  `total` float NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`idDireccion`, `idPlanificacion`, `idMesociclo`, `semana`, `sistema_juego`, `preparation_fisica`, `tecnico_tactico`, `competencia`, `accion_psi`, `total`, `estado`) VALUES
(486, 12, 163, 1, 22.5, 27, 18, 13.5, 9, 90, 1),
(487, 12, 163, 2, 18, 13.5, 22.5, 27, 9, 90, 1),
(488, 12, 164, 3, 22.5, 27, 13.5, 18, 9, 90, 1),
(489, 12, 164, 4, 18, 22.5, 18, 22.5, 9, 90, 1),
(490, 12, 164, 5, 13.5, 18, 22.5, 27, 9, 90, 0),
(491, 12, 165, 6, 22.5, 27, 13.5, 18, 9, 90, 0),
(492, 12, 165, 7, 18, 22.5, 18, 22.5, 9, 90, 0),
(493, 12, 165, 8, 13.5, 18, 22.5, 27, 9, 90, 0),
(494, 12, 166, 9, 22.5, 27, 13.5, 18, 9, 90, 0),
(495, 12, 166, 10, 18, 22.5, 18, 22.5, 9, 90, 0),
(496, 12, 166, 11, 13.5, 18, 22.5, 27, 9, 90, 0),
(497, 13, 167, 1, 52.5, 63, 42, 31.5, 21, 210, 1),
(498, 13, 167, 2, 42, 31.5, 52.5, 63, 21, 210, 0),
(499, 13, 168, 3, 52.5, 63, 31.5, 42, 21, 210, 0),
(500, 13, 168, 4, 42, 52.5, 42, 52.5, 21, 210, 0),
(501, 13, 168, 5, 31.5, 42, 52.5, 63, 21, 210, 0),
(502, 13, 169, 6, 52.5, 63, 31.5, 42, 21, 210, 0),
(503, 13, 169, 7, 42, 52.5, 42, 52.5, 21, 210, 0),
(504, 13, 169, 8, 31.5, 42, 52.5, 63, 21, 210, 0),
(505, 13, 170, 9, 52.5, 63, 31.5, 42, 21, 210, 0),
(506, 13, 170, 10, 42, 52.5, 42, 52.5, 21, 210, 0),
(507, 13, 170, 11, 31.5, 42, 52.5, 63, 21, 210, 0),
(508, 14, 171, 1, 22.5, 27, 13.5, 18, 9, 90, 0),
(509, 14, 171, 2, 18, 22.5, 18, 22.5, 9, 90, 0),
(510, 14, 171, 3, 13.5, 18, 22.5, 27, 9, 90, 0),
(511, 14, 172, 4, 22.5, 9, 18, 31.5, 9, 90, 0),
(512, 14, 172, 5, 13.5, 9, 31.5, 27, 9, 90, 0),
(513, 14, 172, 6, 9, 9, 22.5, 40.5, 9, 90, 0),
(514, 14, 173, 7, 22.5, 27, 13.5, 18, 9, 90, 0),
(515, 14, 173, 8, 18, 22.5, 18, 22.5, 9, 90, 0),
(516, 14, 173, 9, 13.5, 18, 22.5, 27, 9, 90, 0),
(517, 14, 174, 10, 22.5, 27, 13.5, 18, 9, 90, 0),
(518, 14, 174, 11, 18, 22.5, 18, 22.5, 9, 90, 0),
(519, 14, 174, 12, 13.5, 18, 22.5, 27, 9, 90, 0),
(520, 15, 175, 1, 52.5, 63, 42, 31.5, 21, 210, 1),
(521, 15, 175, 2, 42, 31.5, 52.5, 63, 21, 210, 0),
(522, 15, 176, 3, 52.5, 63, 31.5, 42, 21, 210, 0),
(523, 15, 176, 4, 42, 52.5, 42, 52.5, 21, 210, 0),
(524, 15, 176, 5, 31.5, 42, 52.5, 63, 21, 210, 0),
(525, 15, 177, 6, 52.5, 63, 31.5, 42, 21, 210, 0),
(526, 15, 177, 7, 42, 52.5, 42, 52.5, 21, 210, 0),
(527, 15, 177, 8, 31.5, 42, 52.5, 63, 21, 210, 0),
(528, 15, 178, 9, 52.5, 63, 31.5, 42, 21, 210, 0),
(529, 15, 178, 10, 42, 52.5, 42, 52.5, 21, 210, 0),
(530, 15, 178, 11, 31.5, 42, 52.5, 63, 21, 210, 0),
(531, 16, 179, 1, 52.5, 63, 42, 31.5, 21, 210, 1),
(532, 16, 179, 2, 63, 52.5, 31.5, 42, 21, 210, 1),
(533, 16, 179, 3, 31.5, 42, 63, 52.5, 21, 210, 0),
(534, 16, 179, 4, 42, 31.5, 52.5, 63, 21, 210, 0),
(535, 16, 180, 5, 52.5, 63, 31.5, 42, 21, 210, 0),
(536, 16, 180, 6, 42, 52.5, 42, 52.5, 21, 210, 0),
(537, 16, 180, 7, 31.5, 42, 52.5, 63, 21, 210, 0),
(538, 16, 181, 8, 52.5, 63, 42, 31.5, 21, 210, 0),
(539, 16, 181, 9, 42, 31.5, 52.5, 63, 21, 210, 0),
(540, 16, 182, 10, 52.5, 63, 42, 31.5, 21, 210, 0),
(541, 16, 182, 11, 42, 31.5, 52.5, 63, 21, 210, 0),
(542, 17, 183, 1, 35, 42, 21, 28, 14, 140, 1),
(543, 17, 183, 2, 28, 35, 28, 35, 14, 140, 0),
(544, 17, 183, 3, 21, 28, 35, 42, 14, 140, 0),
(545, 17, 184, 4, 35, 42, 21, 28, 14, 140, 0),
(546, 17, 184, 5, 28, 35, 28, 35, 14, 140, 0),
(547, 17, 184, 6, 21, 28, 35, 42, 14, 140, 0),
(548, 17, 185, 7, 35, 42, 21, 28, 14, 140, 0),
(549, 17, 185, 8, 28, 35, 28, 35, 14, 140, 0),
(550, 17, 185, 9, 21, 28, 35, 42, 14, 140, 0),
(551, 17, 186, 10, 35, 42, 21, 28, 14, 140, 0),
(552, 17, 186, 11, 28, 35, 28, 35, 14, 140, 0),
(553, 17, 186, 12, 21, 28, 35, 42, 14, 140, 0),
(554, 18, 187, 1, 73.5, 84, 52.5, 0, 0, 210, 1),
(555, 18, 187, 2, 52.5, 73.5, 84, 0, 0, 210, 0),
(556, 18, 188, 3, 73.5, 84, 52.5, 0, 0, 210, 0),
(557, 18, 188, 4, 52.5, 73.5, 84, 0, 0, 210, 0),
(558, 18, 189, 5, 52.5, 63, 31.5, 42, 21, 210, 0),
(559, 18, 189, 6, 42, 52.5, 42, 52.5, 21, 210, 0),
(560, 18, 189, 7, 31.5, 42, 52.5, 63, 21, 210, 0),
(561, 18, 190, 8, 52.5, 63, 42, 31.5, 21, 210, 0),
(562, 18, 190, 9, 42, 31.5, 52.5, 63, 21, 210, 0),
(563, 18, 191, 10, 52.5, 63, 42, 31.5, 21, 210, 0),
(564, 18, 191, 11, 42, 31.5, 52.5, 63, 21, 210, 0),
(565, 19, 192, 1, 35, 42, 21, 28, 14, 140, 1),
(566, 19, 192, 2, 28, 35, 28, 35, 14, 140, 1),
(567, 19, 192, 3, 21, 28, 35, 42, 14, 140, 0),
(568, 19, 193, 4, 35, 42, 21, 28, 14, 140, 0),
(569, 19, 193, 5, 28, 35, 28, 35, 14, 140, 0),
(570, 19, 193, 6, 21, 28, 35, 42, 14, 140, 0),
(571, 19, 194, 7, 35, 42, 21, 28, 14, 140, 0),
(572, 19, 194, 8, 28, 35, 28, 35, 14, 140, 0),
(573, 19, 194, 9, 21, 28, 35, 42, 14, 140, 0),
(574, 19, 195, 10, 35, 42, 28, 21, 14, 140, 0),
(575, 19, 195, 11, 42, 35, 21, 28, 14, 140, 0),
(576, 19, 195, 12, 21, 28, 42, 35, 14, 140, 0),
(577, 19, 195, 13, 28, 21, 35, 42, 14, 140, 0),
(578, 19, 196, 14, 35, 42, 28, 21, 14, 140, 0),
(579, 19, 196, 15, 42, 35, 21, 28, 14, 140, 0),
(580, 19, 196, 16, 21, 28, 42, 35, 14, 140, 0),
(581, 19, 196, 17, 28, 21, 35, 42, 14, 140, 0),
(582, 19, 197, 18, 35, 42, 28, 21, 14, 140, 0),
(583, 19, 197, 19, 42, 28, 21, 35, 14, 140, 0),
(584, 19, 197, 20, 28, 21, 35, 42, 14, 140, 0),
(585, 19, 197, 21, 21, 35, 42, 28, 14, 140, 0),
(586, 19, 197, 22, 28, 21, 35, 42, 14, 140, 0),
(587, 20, 198, 1, 52.5, 63, 31.5, 42, 21, 210, 0),
(588, 20, 198, 2, 42, 52.5, 42, 52.5, 21, 210, 0),
(589, 20, 198, 3, 31.5, 42, 52.5, 63, 21, 210, 0),
(590, 20, 199, 4, 52.5, 21, 42, 73.5, 21, 210, 0),
(591, 20, 199, 5, 31.5, 21, 73.5, 63, 21, 210, 0),
(592, 20, 199, 6, 21, 21, 52.5, 94.5, 21, 210, 0),
(593, 20, 200, 7, 52.5, 63, 31.5, 42, 21, 210, 0),
(594, 20, 200, 8, 42, 52.5, 42, 52.5, 21, 210, 0),
(595, 20, 200, 9, 31.5, 42, 52.5, 63, 21, 210, 0),
(596, 20, 201, 10, 52.5, 63, 31.5, 42, 21, 210, 0),
(597, 20, 201, 11, 42, 52.5, 42, 52.5, 21, 210, 0),
(598, 20, 201, 12, 31.5, 42, 52.5, 63, 21, 210, 0),
(599, 21, 202, 1, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(600, 21, 202, 2, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(601, 21, 202, 3, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(602, 21, 202, 4, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(603, 21, 203, 5, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(604, 21, 203, 6, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(605, 21, 203, 7, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(606, 21, 203, 8, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(607, 21, 204, 9, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(608, 21, 204, 10, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(609, 21, 204, 11, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(610, 21, 204, 12, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(611, 21, 205, 13, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(612, 21, 205, 14, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(613, 21, 205, 15, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(614, 21, 205, 16, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(615, 21, 206, 17, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(616, 21, 206, 18, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(617, 21, 206, 19, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(618, 21, 206, 20, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(619, 21, 207, 21, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(620, 21, 207, 22, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(621, 21, 207, 23, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(622, 21, 207, 24, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(623, 21, 208, 25, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(624, 21, 208, 26, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(625, 21, 208, 27, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(626, 21, 208, 28, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(627, 21, 209, 29, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(628, 21, 209, 30, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(629, 21, 209, 31, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(630, 21, 209, 32, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(631, 21, 210, 33, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(632, 21, 210, 34, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(633, 21, 210, 35, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(634, 21, 210, 36, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(635, 21, 211, 37, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(636, 21, 211, 38, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(637, 21, 211, 39, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(638, 21, 211, 40, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(639, 21, 212, 41, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(640, 21, 212, 42, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(641, 21, 212, 43, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(642, 21, 212, 44, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(643, 21, 213, 45, 33.75, 40.5, 27, 20.25, 13.5, 135, 0),
(644, 21, 213, 46, 40.5, 33.75, 20.25, 27, 13.5, 135, 0),
(645, 21, 213, 47, 20.25, 27, 40.5, 33.75, 13.5, 135, 0),
(646, 21, 213, 48, 27, 20.25, 33.75, 40.5, 13.5, 135, 0),
(647, 22, 214, 1, 52.5, 63, 31.5, 42, 21, 210, 0),
(648, 22, 214, 2, 42, 52.5, 42, 52.5, 21, 210, 0),
(649, 22, 214, 3, 31.5, 42, 52.5, 63, 21, 210, 0),
(650, 22, 215, 4, 52.5, 63, 31.5, 42, 21, 210, 0),
(651, 22, 215, 5, 42, 52.5, 42, 52.5, 21, 210, 0),
(652, 22, 215, 6, 31.5, 42, 52.5, 63, 21, 210, 0),
(653, 22, 216, 7, 52.5, 63, 31.5, 42, 21, 210, 0),
(654, 22, 216, 8, 42, 52.5, 42, 52.5, 21, 210, 0),
(655, 22, 216, 9, 31.5, 42, 52.5, 63, 21, 210, 0),
(656, 22, 217, 10, 52.5, 63, 31.5, 42, 21, 210, 0),
(657, 22, 217, 11, 42, 52.5, 42, 52.5, 21, 210, 0),
(658, 22, 217, 12, 31.5, 42, 52.5, 63, 21, 210, 0),
(659, 22, 218, 13, 52.5, 63, 31.5, 42, 21, 210, 0),
(660, 22, 218, 14, 42, 52.5, 42, 52.5, 21, 210, 0),
(661, 22, 218, 15, 31.5, 42, 52.5, 63, 21, 210, 0),
(662, 22, 219, 16, 52.5, 63, 31.5, 42, 21, 210, 0),
(663, 22, 219, 17, 42, 52.5, 42, 52.5, 21, 210, 0),
(664, 22, 219, 18, 31.5, 42, 52.5, 63, 21, 210, 0),
(665, 22, 220, 19, 52.5, 63, 31.5, 42, 21, 210, 0),
(666, 22, 220, 20, 42, 52.5, 42, 52.5, 21, 210, 0),
(667, 22, 220, 21, 31.5, 42, 52.5, 63, 21, 210, 0),
(668, 22, 221, 22, 52.5, 63, 31.5, 42, 21, 210, 0),
(669, 22, 221, 23, 42, 52.5, 42, 52.5, 21, 210, 0),
(670, 22, 221, 24, 31.5, 42, 52.5, 63, 21, 210, 0),
(671, 23, 222, 1, 23, 27, 14, 18, 9, 91, 0),
(672, 23, 222, 2, 18, 23, 18, 23, 9, 91, 0),
(673, 23, 222, 3, 14, 18, 23, 27, 9, 91, 0),
(674, 23, 222, 4, 23, 27, 14, 18, 9, 91, 0),
(675, 23, 222, 5, 18, 23, 18, 23, 9, 91, 0),
(676, 23, 222, 6, 14, 18, 23, 27, 9, 91, 0),
(677, 23, 223, 7, 23, 27, 14, 18, 9, 91, 0),
(678, 23, 223, 8, 18, 23, 18, 23, 9, 91, 0),
(679, 23, 223, 9, 14, 18, 23, 27, 9, 91, 0),
(680, 23, 223, 10, 23, 27, 14, 18, 9, 91, 0),
(681, 23, 223, 11, 18, 23, 18, 23, 9, 91, 0),
(682, 23, 223, 12, 14, 18, 23, 27, 9, 91, 0),
(683, 23, 224, 13, 23, 27, 14, 18, 9, 91, 0),
(684, 23, 224, 14, 18, 23, 18, 23, 9, 91, 0),
(685, 23, 224, 15, 14, 18, 23, 27, 9, 91, 0),
(686, 23, 224, 16, 23, 27, 14, 18, 9, 91, 0),
(687, 23, 224, 17, 18, 23, 18, 23, 9, 91, 0),
(688, 23, 224, 18, 14, 18, 23, 27, 9, 91, 0),
(689, 23, 225, 19, 23, 27, 14, 18, 9, 91, 0),
(690, 23, 225, 20, 18, 23, 18, 23, 9, 91, 0),
(691, 23, 225, 21, 14, 18, 23, 27, 9, 91, 0),
(692, 23, 225, 22, 23, 27, 14, 18, 9, 91, 0),
(693, 23, 225, 23, 18, 23, 18, 23, 9, 91, 0),
(694, 23, 225, 24, 14, 18, 23, 27, 9, 91, 0),
(695, 23, 226, 25, 23, 27, 14, 18, 9, 91, 0),
(696, 23, 226, 26, 18, 23, 18, 23, 9, 91, 0),
(697, 23, 226, 27, 14, 18, 23, 27, 9, 91, 0),
(698, 23, 226, 28, 23, 27, 14, 18, 9, 91, 0),
(699, 23, 226, 29, 18, 23, 18, 23, 9, 91, 0),
(700, 23, 226, 30, 14, 18, 23, 27, 9, 91, 0),
(701, 23, 227, 31, 23, 27, 14, 18, 9, 91, 0),
(702, 23, 227, 32, 18, 23, 18, 23, 9, 91, 0),
(703, 23, 227, 33, 14, 18, 23, 27, 9, 91, 0),
(704, 23, 227, 34, 23, 27, 14, 18, 9, 91, 0),
(705, 23, 227, 35, 18, 23, 18, 23, 9, 91, 0),
(706, 23, 227, 36, 14, 18, 23, 27, 9, 91, 0),
(707, 23, 228, 37, 23, 27, 14, 18, 9, 91, 0),
(708, 23, 228, 38, 18, 23, 18, 23, 9, 91, 0),
(709, 23, 228, 39, 14, 18, 23, 27, 9, 91, 0),
(710, 23, 228, 40, 23, 27, 14, 18, 9, 91, 0),
(711, 23, 228, 41, 18, 23, 18, 23, 9, 91, 0),
(712, 23, 228, 42, 14, 18, 23, 27, 9, 91, 0),
(713, 23, 229, 43, 23, 27, 14, 18, 9, 91, 0),
(714, 23, 229, 44, 18, 23, 18, 23, 9, 91, 0),
(715, 23, 229, 45, 14, 18, 23, 27, 9, 91, 0),
(716, 23, 229, 46, 23, 27, 14, 18, 9, 91, 0),
(717, 23, 229, 47, 18, 23, 18, 23, 9, 91, 0),
(718, 23, 229, 48, 14, 18, 23, 27, 9, 91, 0),
(719, 24, 230, 1, 23, 27, 14, 18, 9, 91, 0),
(720, 24, 230, 2, 18, 23, 18, 23, 9, 91, 0),
(721, 24, 230, 3, 14, 18, 23, 27, 9, 91, 0),
(722, 24, 231, 4, 23, 27, 14, 18, 9, 91, 0),
(723, 24, 231, 5, 18, 23, 18, 23, 9, 91, 0),
(724, 24, 231, 6, 14, 18, 23, 27, 9, 91, 0),
(725, 24, 232, 7, 23, 27, 14, 18, 9, 91, 0),
(726, 24, 232, 8, 18, 23, 18, 23, 9, 91, 0),
(727, 24, 232, 9, 14, 18, 23, 27, 9, 91, 0),
(728, 24, 233, 10, 23, 27, 14, 18, 9, 91, 0),
(729, 24, 233, 11, 18, 23, 18, 23, 9, 91, 0),
(730, 24, 233, 12, 14, 18, 23, 27, 9, 91, 0),
(731, 25, 234, 1, 23, 27, 14, 18, 9, 91, 0),
(732, 25, 234, 2, 18, 23, 18, 23, 9, 91, 0),
(733, 25, 234, 3, 14, 18, 23, 27, 9, 91, 0),
(734, 25, 234, 4, 23, 27, 14, 18, 9, 91, 0),
(735, 25, 234, 5, 18, 23, 18, 23, 9, 91, 0),
(736, 25, 234, 6, 14, 18, 23, 27, 9, 91, 0),
(737, 25, 235, 7, 23, 27, 14, 18, 9, 91, 0),
(738, 25, 235, 8, 18, 23, 18, 23, 9, 91, 0),
(739, 25, 235, 9, 14, 18, 23, 27, 9, 91, 0),
(740, 25, 235, 10, 23, 27, 14, 18, 9, 91, 0),
(741, 25, 235, 11, 18, 23, 18, 23, 9, 91, 0),
(742, 25, 235, 12, 14, 18, 23, 27, 9, 91, 0),
(743, 25, 236, 13, 23, 27, 14, 18, 9, 91, 0),
(744, 25, 236, 14, 18, 23, 18, 23, 9, 91, 0),
(745, 25, 236, 15, 14, 18, 23, 27, 9, 91, 0),
(746, 25, 236, 16, 23, 27, 14, 18, 9, 91, 0),
(747, 25, 236, 17, 18, 23, 18, 23, 9, 91, 0),
(748, 25, 236, 18, 14, 18, 23, 27, 9, 91, 0),
(749, 25, 237, 19, 23, 27, 14, 18, 9, 91, 0),
(750, 25, 237, 20, 18, 23, 18, 23, 9, 91, 0),
(751, 25, 237, 21, 14, 18, 23, 27, 9, 91, 0),
(752, 25, 237, 22, 23, 27, 14, 18, 9, 91, 0),
(753, 25, 237, 23, 18, 23, 18, 23, 9, 91, 0),
(754, 25, 237, 24, 14, 18, 23, 27, 9, 91, 0),
(755, 26, 238, 1, 23, 27, 14, 18, 9, 91, 1),
(756, 26, 238, 2, 18, 23, 18, 23, 9, 91, 0),
(757, 26, 238, 3, 14, 18, 23, 27, 9, 91, 0),
(758, 26, 239, 4, 23, 27, 14, 18, 9, 91, 0),
(759, 26, 239, 5, 18, 23, 18, 23, 9, 91, 0),
(760, 26, 239, 6, 14, 18, 23, 27, 9, 91, 0),
(761, 26, 240, 7, 23, 27, 14, 18, 9, 91, 0),
(762, 26, 240, 8, 18, 23, 18, 23, 9, 91, 0),
(763, 26, 240, 9, 14, 18, 23, 27, 9, 91, 0),
(764, 26, 241, 10, 23, 27, 14, 18, 9, 91, 0),
(765, 26, 241, 11, 18, 23, 18, 23, 9, 91, 0),
(766, 26, 241, 12, 14, 18, 23, 27, 9, 91, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `idEjercicio` int(4) NOT NULL,
  `idTipo_ejercicio` int(4) DEFAULT NULL,
  `idCategoria` int(4) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `idEjer_tecnico` int(4) DEFAULT NULL,
  `metodo` varchar(20) DEFAULT NULL,
  `tarea` varchar(20) DEFAULT NULL,
  `descripcion` text,
  `imagen_ejercicio` varchar(200) DEFAULT NULL,
  `estado_ejer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ejercicio`
--

INSERT INTO `ejercicio` (`idEjercicio`, `idTipo_ejercicio`, `idCategoria`, `nombre`, `idEjer_tecnico`, `metodo`, `tarea`, `descripcion`, `imagen_ejercicio`, `estado_ejer`) VALUES
(57, 1, 1, 'Control con el inter', 1, 'Analitico', 'Juegos de Aplicacion', 'Los jugadores se colocan por parejas, uno delante del otro, a 5 metros de distancia con un balÃ³n por pareja. El jugador A envÃ­a rasa la pelota a su compaÃ±ero B, quien controlarÃ¡ la pelota segÃºn le hayamos propuesto. El jugador realiza la misma acciÃ³n hacia su compaÃ±ero.', 'fotos/ima1.jpg', 1),
(58, 1, 1, 'Control con la plant', 1, 'Analitico', 'Juegos de Aplicacion', 'Siguiendo el mismo esquema de ejercicio anterior, el jugador A envÃ­a la pelota hacia su compaÃ±ero B con las manos, para que Ã©ste controle utilizando la planta del pie justo en el momento que el balÃ³n toque el suelo', 'fotos/ima2.jpg', 1),
(59, 1, 1, 'Control individual', 1, 'Analitico', 'Juegos de Aplicacion', 'Individualmente, cada jugador con un balÃ³n, se lanza el balÃ³n hacia delante para controlar con el pecho, con el muslo, con la cabeza,... despuÃ©s de un bote. DespuÃ©s de conducir unos metros por el espacio se repite la mism', 'fotos/ima3.jpg', 1),
(60, 1, 1, 'Control con un bote', 1, 'Analitico', 'Juegos de Aplicacion', 'El jugador A envÃ­a el balÃ³n a su compaÃ±ero con las manos, haciendo que bote en el suelo y B controla con el pecho, con el muslo, con la cabeza, con el pie elevado, ... y le devuelve el balÃ³n a su compaÃ±ero. DespuÃ©s de 5 intentos cambiamos de ejecutante.', 'fotos/ima4.jpg', 1),
(61, 1, 1, 'Control con giro', 1, 'Analitico', 'Juegos de Aplicacion', 'Los jugadores individualmente con un balÃ³n, lo lanzan hacia atrÃ¡s y rÃ¡pidamente se giran y van a buscarlo para controlarlo y repetir el ejercicio. (Los jugadores se reparten por el terreno de juego)', 'fotos/ima5.jpg', 1),
(62, 1, 1, 'Control en zona', 1, 'Analitico', 'Juegos de Aplicacion', 'Los jugadores colocados por parejas con un balÃ³n, realizan un pase hacia su compaÃ±ero quien en lugar de esperar la llegada de la pelota, sale a su encuentro y controla dentro de una zona delimitada para tal efecto, tal como muestra el grÃ¡fico.', 'fotos/ima6.jpg', 1),
(63, 1, 1, 'Control entre tres', 1, 'Analitico', 'Juegos de Aplicacion', 'Colocamos a los jugadores por grupos de tres y los distribuimos tal como nos indica el grÃ¡fico situado mÃ¡s abajo. El jugador B pasa el balÃ³n a su compaÃ±ero A quien controla la pelota y de vuelve el pase a su compaÃ±ero B, corre a dar la vuelta a un cono situado a su izquierda para encararse hacia C y recibir el pase de Ã©ste, controla y devuelve el pase a C, da la vuelta al otro cono situado siempre a su izquierda y quedarÃ¡ orientado hacia B, con el que repetirÃ¡ el mismo esquema realizado anteriormente. El ejercicio puede realizarse con balones que lleven diferentes trayectorias (rasos o aÃ©reos). El tipo de control lo marca el entrenador en funciÃ³n de lo que pretendamos trabajar.', 'fotos/ima7.jpg', 1),
(64, 1, 1, 'Control entre cinco', 1, 'Analitico', 'Juegos de Aplicacion', 'Formamos grupos de 5 jugadores y los distribuimos segÃºn indica el grÃ¡fico adjunto, formando una estrella. El jugador A situado en el centro, recibe el balÃ³n de B, lo controla y lo devuelve, acto seguido gira hacia C con quien repetirÃ¡ la misma acciÃ³n y asÃ­ sucesivamente con el resto de compaÃ±eros. Igual que el ejercicio anterior la pelota puede ser rasa o aÃ©rea. Y el tipo de control lo marcarÃ¡ el entrenador en funciÃ³n de lo que pretenda trabajar.', 'fotos/ima8.jpg', 1),
(65, 1, 1, 'Control con valla', 1, 'Analitico', 'Juegos de Aplicacion', 'Los jugadores por parejas se sitÃºan al lado de una valla. El jugador A lanza el balÃ³n por medio de un saque de banda por encima de la valla y su compaÃ±ero B debe ir al encuentro de la pelota controlarla y volver al punto de inicio. La valla la utilizaremos para que el jugador que debe ir a controlar el balÃ³n pase por debajo, la rodee, la salte... cuando salga a buscar la pelota y tambiÃ©n se puede utilizar para que una vez controlamos el balÃ³n devolver la pelota al compaÃ±ero que saca de banda por debajo o por encima de la valla.', 'fotos/ima9.jpg', 1),
(66, 1, 1, 'Control por parejas ', 1, 'Analitico', 'Juegos de Aplicacion', 'Los jugadores colocados por parejas, se sitÃºan uno en cada cono azul y el balÃ³n en poder del jugador B. Este jugador envÃ­a el balÃ³n al espacio entre dos conos, para que su compaÃ±ero A salga al encuentro del balÃ³n, lo controle conduzca a dar la vuelta a un cono y pase la pelota de nuevo a su compaÃ±ero B para volver a iniciar el ejercicio.', 'fotos/ima10.jpg', 1),
(67, 1, 1, 'Control individual e', 1, 'Analitico', 'Juegos de Aplicacion', 'Individualmente con un balÃ³n, los jugadores conducen por el espacio que les hayamos delimitado, cuando se encuentren delante de un cono deben controlar la pelota (depende del control a trabajar y delimitando superficie de contacto) y reanudar la conducciÃ³n por el terreno de juego.', 'fotos/ima11.jpg', 1),
(68, 1, 1, 'Control con oposicio', 1, 'Analitico', 'Juegos de Aplicacion', 'Por grupos de tres jugadores, el jugador A pasa el balÃ³n hacia su compaÃ±ero B quien controlarÃ¡ la pelota mientras que el jugador C intenta dificultar ese control o interceptar la trayectoria de la pelota antes de que esta llegue a B.', 'fotos/ima12.jpg', 1),
(69, 1, 1, 'Control seis contra ', 1, 'Analitico', 'Juegos de Aplicacion', 'Los jugadores por grupos de 6 jugadores se colocan tal como muestra el grÃ¡fico adjunto. Los cuatro jugadores exteriores son encargados de realizar pases y los dos jugadores interiores de controlar y devolver el pase o de dificultarlo. El jugador A envÃ­a la pelota hacia B quien ante la oposiciÃ³n de C deberÃ¡ controlar y pasar la pelota al siguiente jugador exterior que serÃ¡ D, el juego continua hasta que el balÃ³n vuelve hacia A y q todos los jugadores pasen por las distintas situaciones.', 'fotos/ima13.jpg', 1),
(70, 1, 1, 'Control orientado co', 1, 'Analitico', 'Juegos de Aplicacion', 'Individualmente, cada jugador con un balÃ³n lo lanza al aire o por el suelo y con un solo toque (segÃºn la superficie de contacto que marcamos) deben controlar el balÃ³n y seguir conduciendo.', 'fotos/ima14.jpg', 1),
(71, 1, 1, 'Control orientado en', 1, 'Analitico', 'Juegos de Aplicacion', 'Por parejas el jugador A tiene el balÃ³n y su compaÃ±ero b se sitÃºa al lado de un cono. A pasa el balÃ³n hacia B quien debe controlar la pelota y orientarla para superar el cono que tiene al lado. Luego envÃ­a el balÃ³n hacia A y repetimos el ejercicio.', 'fotos/ima15.jpg', 1),
(72, 1, 1, 'Control orientado en', 1, 'Analitico', 'Juegos de Aplicacion', 'Similar al ejercicio anterior pero en esta ocasiÃ³n en lugar de superar el cono, B debe orientar la pelota hacia el cono que el jugador tiene a su izquierda para allÃ­ pasar el balÃ³n a su compaÃ±ero A. Cuando se realiza el pase el jugador se desplaza hasta el cono inicial para recibir el pase de vuelta.', 'fotos/ima16.jpg', 1),
(73, 1, 1, 'Control en rondo', 1, 'Global', 'Rondo', 'Rondo El equipo poseedor del balÃ³n (4 jugadores) intenta conservar la pelota frente al equipo de dos defensores, quienes al recuperar la pelota cambiaran su posiciÃ³n con dos de los jugadores del equipo de cuatro. El grupo de atacantes deben realizar un control obligatorio antes de realizar el pase hacia algÃºn otro compaÃ±ero.', 'fotos/ima17.jpg', 1),
(74, 1, 1, 'Control con los 10 p', 1, 'Global', 'Juegos de Aplicacion', 'Los 10 pases. Formaremos dos equipos de igual nÃºmero de jugadores y delimitaremos un espacio donde se desarrollarÃ¡ el juego. El juego comienza mediante un lanzamiento al aire del entrenador. Un jugador controla el balÃ³n, a partir e ese momento el equipo que estÃ¡ en posesiÃ³n del balÃ³n intenta realizar el mayor nÃºmero de pases consecutivos, mientras el equipo contrario intenta interceptar el balÃ³n y hacerse con la funciÃ³n de atacante. El juego se desarrolla con control obligatorio antes de pase, es decir que no se puede jugar al primer toque. Los controles los delimitarÃ¡ el entrenador en cuanto a superficie de contacto y tipo. Adjudicaremos un punto al equipo que consiga realizar 10 pases seguidos sin que la pelota haya sido tocada por algÃºn jugador del otro equipo o haya salido de los lÃ­mites del terreno de juego.', 'fotos/ima18.jpg', 1),
(75, 1, 1, 'Control 5 contra 5', 1, 'Global', 'Juegos de Aplicacion', 'Realizaremos un partido 5 contra 5 (las dimensiones del campo dependen del trabajo a realizar) con control obligatorio antes de realizar el pase hacia un compaÃ±ero (delimitaremos el tipo de control y la superficie de contacto a utilizar).', 'fotos/ima19.jpg', 1),
(76, 1, 1, 'Control en arcos peq', 1, 'Analitico', 'Juegos de Aplicacion', 'El portero sin manos Los jugadores se colocan por parejas cada uno defendiendo una porterÃ­a pequeÃ±a formado con conos y tienen una pelota por pareja. Los jugadores deben intentar batir la porterÃ­a defendida por su oponente y el defensor debe parar la pelota sin utilizar las manos con lo que harÃ¡ uso de los controles para hacerse con la pelota.', 'fotos/ima20.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elemento_tecnico`
--

CREATE TABLE `elemento_tecnico` (
  `idEjer_tecnico` int(4) NOT NULL,
  `elemento_tecnico` varchar(30) NOT NULL,
  `idTipo_ejercicio` int(4) NOT NULL,
  `idSub_ejercicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `elemento_tecnico`
--

INSERT INTO `elemento_tecnico` (`idEjer_tecnico`, `elemento_tecnico`, `idTipo_ejercicio`, `idSub_ejercicio`) VALUES
(1, 'Control', 1, 1),
(2, 'Conduccion', 1, 1),
(3, 'Golpe con el pie', 1, 1),
(4, 'Golpe con la cabeza', 1, 1),
(5, 'Regate', 1, 1),
(6, 'Tiro Porteria', 1, 1),
(7, 'Habilidad y Destreza', 1, 1),
(8, 'Pases', 1, 2),
(9, 'Finta', 1, 2),
(10, 'Relevo', 1, 2),
(11, 'Acciones Combinativas', 1, 2),
(12, 'Despeje', 1, 3),
(13, 'Recuperacion', 1, 3),
(14, 'Psicomotricidad', 2, 4),
(15, 'Resistencia', 2, 4),
(16, 'Fuerza', 2, 4),
(17, 'Velocidad', 2, 4),
(18, 'Flexibilidad', 2, 4),
(19, 'Coordinacion', 2, 4),
(20, 'Otros', 2, 4),
(21, 'Ataque', 3, 4),
(22, 'Transicion Ataque/Defensa', 3, 4),
(23, 'Defensa', 3, 4),
(24, 'Transicion Defensa/Ataque', 3, 4),
(25, 'Valores', 4, 4),
(26, 'Especifico', 4, 4),
(27, 'Interno', 5, 4),
(28, 'Externo', 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenador`
--

CREATE TABLE `entrenador` (
  `idEntrenador` int(4) NOT NULL,
  `nombre_en` varchar(30) NOT NULL,
  `apellidop_en` varchar(20) NOT NULL,
  `apellidom_en` varchar(20) DEFAULT NULL,
  `fechana_en` date DEFAULT NULL,
  `carnet_en` int(10) NOT NULL,
  `fono_en` int(10) DEFAULT NULL,
  `correo_en` varchar(30) NOT NULL,
  `pass_en` varchar(30) NOT NULL,
  `estado_en` tinyint(1) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrenador`
--

INSERT INTO `entrenador` (`idEntrenador`, `nombre_en`, `apellidop_en`, `apellidom_en`, `fechana_en`, `carnet_en`, `fono_en`, `correo_en`, `pass_en`, `estado_en`, `fecha_creacion`) VALUES
(1, 'Javier ', 'Colbert', 'Martinez', '1990-01-10', 6082633, 61179969, 'j.g.colbertm@gmail.com', '1234', 1, '0000-00-00'),
(2, 'Alvaro', 'Perez', 'Antelo', '1960-11-18', 202020, 68912546, 'jhjkh@kjh', '1234', 1, '0000-00-00'),
(3, 'Erick', 'Perez', 'Martinez', '1987-05-22', 202020, 64879520, 'jhjkh@kjh', '1234', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapas`
--

CREATE TABLE `etapas` (
  `idEtapa` int(11) NOT NULL,
  `etapa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `etapas`
--

INSERT INTO `etapas` (`idEtapa`, `etapa`) VALUES
(1, 'Pre Temporada'),
(2, 'Preparacion Fisica'),
(3, 'Pre Competitivo'),
(4, 'Competitivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `idEvaluacion` int(4) NOT NULL,
  `idName_evaluacion` int(11) NOT NULL,
  `idJugador` int(4) NOT NULL,
  `evaa_1` varchar(2) DEFAULT NULL,
  `evaa_2` varchar(2) DEFAULT NULL,
  `evaa_3` varchar(2) DEFAULT NULL,
  `evaa_4` varchar(2) DEFAULT NULL,
  `total_ana` float DEFAULT NULL,
  `evag_1` varchar(2) DEFAULT NULL,
  `evag_2` varchar(2) DEFAULT NULL,
  `total_glob` float DEFAULT NULL,
  `evaf_1` varchar(2) DEFAULT NULL,
  `evaf_2` varchar(2) DEFAULT NULL,
  `total_fis` float DEFAULT NULL,
  `idAsistencia` int(11) NOT NULL,
  `tot_no` float DEFAULT NULL,
  `tot_lit` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`idEvaluacion`, `idName_evaluacion`, `idJugador`, `evaa_1`, `evaa_2`, `evaa_3`, `evaa_4`, `total_ana`, `evag_1`, `evag_2`, `total_glob`, `evaf_1`, `evaf_2`, `total_fis`, `idAsistencia`, `tot_no`, `tot_lit`) VALUES
(1, 1, 1, 'e', 'e', 'e', 'e', 100, 'e', 'e', 100, 'e', 'e', 100, 10, 100, 'e'),
(2, 1, 1, 'e', 'e', 'e', 'e', 100, 'e', 'e', 100, 'e', 'e', 100, 10, 100, 'e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `foto` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `foto`
--

INSERT INTO `foto` (`id`, `foto`) VALUES
(1, 0x89504e470d0a1a0a0000000d49484452000003be000002060806000000739053ad00000c1a694343504943432050726f66696c6500004889955707545349179e575208092d100129a137417a95de0501e96023240142092121a8d8cba2826b170b56740544c1b500b2562c5858042cd83788a828eb62c186ca3f49005df72fe7bfe7cc9befddb9f7ce77ef9b7967060065479640908daa0090c3cf174607fb31139392992409c00011a0c01ad8b0d822816f5454388032d2ff5ddedd0288b4bf6e2d8df5cff1ff2aaa1cae880d001205712a47c4ce81f82800b8365b20cc0780d006f54633f30552fc16627521240800912cc5e972ac23c5a9726c2bb3898df6873800003295c512a603a0248dcf2c60a7c3384a02886df91c1e1fe25d107bb133581c8825108fcbc9c98558990ab179ea7771d2ff16337534268b953e8ae5b9c8841cc01309b259b3ffcf72fc6fc9c9168fcc61081b354318122dcd19d6ad322b374c8a2177e4043f3522126235882ff138327b29be9b210e891bb6ef638bfc61cd0003c04fcd610584410c6b8932c45971bec3d89e2594f9427b3482971f1a3b8c5385b9d1c3f1d1027e7644f8709ce519dcd011bc832b0a8c19b149e30585420c571a7ab430233641ce133d5fc08b8f805809e23651564cd8b0efc3c20cff88111ba1385acad918e2b769c2a068b90da699231ac90bb361b364736942ec939f111b22f7c512b9a2c4f0110e1c6e40a09c03c6e1f2e386b9617075f9450ffb1609b2a386edb11ddcece068799db143a2829811df8e7cb8c0e475c01e65b22646c9f963ef04f951b1726e380ec2813f08004c20862d15e4824cc06bedabef836ff29120c00242900eb87097c935231e09b2113e7cc68042f027445c201af5f3938d724101d47f19d5ca9fd6204d365a20f3c8024f20cec1b5712fdc030f874f1fd8ec7157dc6dc48fa93c322b319018400c2106112d4679b021eb6cd88480f76f7461b0e7c2eca45cf823397c8b47784268273c22dc24480877403c782c8b326c3583b758f8037326980424305ad07076a93066ef880d6e0a593be17eb827e40fb9e30c5c1b58e38e30135fdc1be6e604b5df33148f72fb56cb1fe793b2fe3e9f61bd92a592d3308bd4d12fe33f6af56314ffef6ac4817dd88f96d872ec08d68c9dc52e6327b07ac0c44e630d580b76528a4757c263d94a18992d5ac62d0bc6e18dd8d856dbf6da7efec7ecac610642d9f706f9dc59f9d20de19f2b982de4a567e4337de11f99cb0ce5b36dc631ed6ded9c0190fedfe5bf8f370cd97f1b615cf9a6cb3b03805b3154a67fd3b18c0038fe0400fabb6f3aa3d7707bad01e0641b5b2c2c90eb70e98300284019ee0c2da0078c8039ccc91e38030fe00302c1441009624112980eab9e017220eb99602e58048a400958033682ad6027d8032ac1417018d48313e02cb808ae82367013dc836ba307bc00fde01d1844108484d0103aa285e823268815628fb8225e4820128e442349480a928ef01131321759829420eb90adc86ea40af915398e9c452e23edc81da40be9455e239f500ca5a2eaa82e6a8a8e475d515f340c8d45a7a1e9681e5a882e4557a19bd172f4005a879e45afa2375109fa021dc000a688313003cc1a73c5fcb1482c194bc384d87cac182bc5cab11aac117eebeb9804ebc33ee2449c8e33716bb83e43f0389c8de7e1f3f195f856bc12afc3cfe3d7f12ebc1fff4aa011740856047742282191904e984928229412f6118e112ec0bdd34378472412194433a20bdc9b49c44ce21ce24ae276622df10cb19dd84d1c2091485a242b92272992c422e5938a485b480748a7491da41ed207b222599f6c4f0e222793f9e4c5e452f27ef2297207f92979504145c144c15d215281a3305b61b5c25e8546856b0a3d0a8314558a19c593124bc9a42ca26ca6d4502e50ee53de282a2a1a2aba294e56e4292e54dcac7848f1926297e247aa1ad592ea4f9d4a155357512ba867a877a86f68349a29cd87964ccba7ada255d1ced11ed23e28d1956c944295384a0b94ca94ea943a945e2a2b289b28fb2a4f572e542e553ea27c4db94f4541c554c55f85a5325fa54ce5b84aa7ca802a5dd54e3552354775a5ea7ed5cbaacfd4486aa66a816a1cb5a56a7bd4cea975d331ba11dd9fcea62fa1efa55fa0f7a813d5cdd443d533d54bd40faab7aaf76ba869386ac46bccd228d338a92161600c534628239bb19a7198718bf1698cee18df31dc312bc6d48ce918f35e73aca68f2657b358b356f3a6e6272da656a05696d65aad7aad07dab8b6a5f664ed99da3bb42f68f78d551feb31963db678ece1b17775501d4b9d689d393a7b745a740674f574837505ba5b74cfe9f6e931f47cf432f536e89dd2ebd5a7eb7be9f3f437e89fd67fced460fa32b3999b99e799fd063a0621066283dd06ad068386668671868b0d6b0d1f18518c5c8dd28c36183519f51beb1b4f329e6b5c6d7cd744c1c4d524c3649349b3c97b5333d304d365a6f5a6cfcc34cd42cd0acdaacdee9bd3ccbdcdf3cccbcd6f58102d5c2db22cb65bb459a2964e9619966596d7ac502b672b9ed576abf67184716ee3f8e3cac7755a53ad7dad0bacabadbb6c1836e1368b6dea6d5e8e371e9f3c7eedf8e6f15f6d9d6cb36df7dadeb353b39b68b7d8aed1eeb5bda53ddbbeccfe8603cd21c861814383c32b472b47aee30ec7db4e74a7494ecb9c9a9cbe38bb380b9d6b9c7b5d8c5d525cb6b974baaabb46b9ae74bde44670f3735be076c2eda3bbb37bbefb61f7bf3cac3db23cf67b3c9b6036813b61ef846e4f434f96e76e4f8917d32bc56b9797c4dbc09be55deefdc8c7c887e3b3cfe7a9af856fa6ef01df977eb67e42bf637eeffdddfde7f99f09c00282038a035a03d502e302b7063e0c320c4a0faa0eea0f760a9e137c2684101216b236a4335437941d5a15da3fd165e2bc89e7c3a86131615bc31e855b860bc31b27a193264e5a3fe97e8449043fa23e12448646ae8f7c1065169517f5db64e2e4a8c965939f44db45cf8d6e8ea1c7cc88d91ff32ed62f7675ecbd38f338715c53bc72fcd4f8aaf8f7090109eb122489e313e7255e4dd24ee22535249392e393f7250f4c099cb2714acf54a7a945536f4d339b366bdae5e9dad3b3a79f9ca13c8335e3480a212521657fca675624ab9c35901a9aba2db59fedcfdec47ec1f1e16ce0f4723db9ebb84fd33cd3d6a53d4bf74c5f9fde9be19d519ad1c7f3e76de5bdca0cc9dc99f93e2b32ab226b283b21bb36879c9392739cafc6cfe29fcfd5cb9d95db2eb01214092479ee791bf3fa8561c27d2244344dd490af0e8f3a2d6273f14fe2ae02af82b2820f33e3671e99a53a8b3fab65b6e5ec15b39f160615fe32079fc39ed334d760eea2b95df37ce7ed9e8fcc4f9ddfb4c068c1d2053d0b8317562ea22cca5af4fb62dbc5eb16bf5d92b0a471a9eed2854bbb7f0afea9ba48a94858d4b9cc63d9cee5f872def2d6150e2bb6acf85acc29be52625b525af279257be5959fed7edefcf3d0aab455adab9d57ef58435cc35f736badf7daca75aaeb0ad775af9fb4be6e037343f186b71b676cbc5cea58ba7313659378936473f8e6862dc65bd66cf9bc3563ebcd32bfb2da6d3adb566c7bbf9db3bd6387cf8e9a9dba3b4b767edac5db757b77f0eeba72d3f2d23dc43d057b9eec8ddfdbfc8beb2f55fbb4f795ecfb52c1af905446579eaf72a9aadaafb37f75355a2daeee3d30f540dbc180830d35d635bb6b19b52587c021f1a1e7bfa6fc7aeb70d8e1a623ae476a8e9a1cdd768c7eacb80ea99b5dd75f9f512f69486a683f3ef17853a347e3b1df6c7eab386170a2eca4c6c9d5a728a7969e1a3a5d787ae08ce04cdfd9f4b3dd4d339aee9d4b3c77e3fce4f3ad17c22e5cba1874f15cb36ff3e94b9e974e5c76bf7cfc8aeb95faabce57eb5a9c5a8efdeef4fbb156e7d6ba6b2ed71adadcda1adb27b49feaf0ee387b3de0fac51ba137aede8cb8d97e2beed6edcea99d92db9cdbcfee64df7975b7e0eee0bd85f709f78b1fa83c287da8f3b0fc0f8b3f6a25ce92935d015d2d8f621eddeb6677bf782c7afcb967e913da93d2a7fa4fab9ed93f3bd11bd4dbf67ccaf39e178217837d457faafeb9eda5f9cba37ff9fcd5d29fd8dff34af86ae8f5ca375a6f2ade3abe6d1a881a78f82ee7dde0fbe20f5a1f2a3fba7e6cfe94f0e9e9e0cccfa4cf9bbf587c69fc1af6f5fe50ced090802564c98e02186c685a1a00af2b00a025c1b303bcc75194e4f72f9920f23ba30c81ff84e5773499c0934b850f00710b01088767941db099404c85bdf4f81deb03500787d1362ca234077b792c2abcc5103e0c0dbdd10580d408c017e1d0d0e0f6a1a12f7b21d93b009cc993dffba4428467fc5d9a52d4d2499e0a7e907f01e6d06cc6780b20d20000000970485973000016250000162501495224f00000019d69545874584d4c3a636f6d2e61646f62652e786d7000000000003c783a786d706d65746120786d6c6e733a783d2261646f62653a6e733a6d6574612f2220783a786d70746b3d22584d5020436f726520352e342e30223e0a2020203c7264663a52444620786d6c6e733a7264663d22687474703a2f2f7777772e77332e6f72672f313939392f30322f32322d7264662d73796e7461782d6e7323223e0a2020202020203c7264663a4465736372697074696f6e207264663a61626f75743d22220a202020202020202020202020786d6c6e733a657869663d22687474703a2f2f6e732e61646f62652e636f6d2f657869662f312e302f223e0a2020202020202020203c657869663a506978656c5844696d656e73696f6e3e3935383c2f657869663a506978656c5844696d656e73696f6e3e0a2020202020202020203c657869663a506978656c5944696d656e73696f6e3e3531383c2f657869663a506978656c5944696d656e73696f6e3e0a2020202020203c2f7264663a4465736372697074696f6e3e0a2020203c2f7264663a5244463e0a3c2f783a786d706d6574613e0a74b09f1a0000001c69444f540000000200000000000001030000002800000103000001030000a2d0c794a84100004000494441547801ec9d0ba04d55fec77f743daec8eb1635ae9247af2b4a4f6a9229d35b63321e85f2c8c8ab3c12359750121a851a85428554337a4d7f537acb0c15752921854a24eae25e5cf7fed76feffddb7bed7df63ee7ec7bcf7d39dffd9f73d75abff55bafcf5efa9fef596baf5d213b3bbb804af82a28309be4b04205a28202f5475d6ce658410527dfb46b69e550c1f677ec155449ff72caee6acf9de606cd7cb7dde88751ceb2db7ea67f05d571bd5eeeb92bedf13746a6f5837df9b3f6b34f78881157a74e9d226c47bb41f8e9e3149b1e725c3eec9b9f9f6fa7392e69897378e4c811c3cef1bcbc3c52f39e366cd840575e79a5de1ce22000022050ee09ecdcb9d31843b366cd0a3516feefeba14387e8cb2fbfa4962d5b16aa8e5885d6ac5943679c710655ae5c597d0fe0ff8f5bc42b2f9b367ff539ad5ab992fef3d6cbf4d19add4e85373c46590fb7a71465c9ce9a4de7df34c5c81bb4f0631a704e6dc7cf8a65efda4c9f7fb68a56bef51f7af9958f48ab89a62ccba2eb1a724deacaf98c7a9fd3953e52516f5d7b3e9b4917779d6eb88d5eb88caeae9742878d94f5274f8556354495a8f649c753aa91954df3bb9c4f0fae216a3968212d1a708e5e2a66ffb366f7a69ba6a81e35194eab5eeb4335b8f40fcba84dbbc1f638da741e4e9ddb9f4dc7d7ac46d552eb508dbc95d4a9c36823df3b0e57e381893c7a67cc65d47fb145aa6e1b1a3eac339ddde878aa56ad1a1d57a7067d3ea3130de77cad5fd98ad1f906a3ba3465f97b74dd493690c09624c3779c92490e43bd3dc9d6e7c0e8a559d48d9ea78c0e0f1ad9c35f5c457d320c6a2abd876677b998a6a87b51b7f313f4d1fd974b15ae306b7617c55c39514b9abf6a115d20c5c52bceb929ee51c36c35e7ce37e71cd115f4e2673328c39c3811c5f471eaf7d56d5fa5fe0d783bacaa5273bb8b9adb3caa266a1ebee69987118dc1907404befbee3b63cc279f7c72b91a7b0508df5212bef996f05df389ef8481f035b1e882972d227825649b085db689d8d5e310be4c0917088040b2104894f05dbf7e3d9d738e5b78258ae1679f7d46679e796611852fff889943ac216bd7707f79cfdefa118defda9b5ed9ad329b0ca28f5f1b402c71dd5ffa1de19b97934dd9b9799452b536d57009896cfa68fe78eafde02bc6d07501e116be6e01a1b7d3f9890fe8fecb8f37cabbfe2841b4275bf53ea5aaeabf34ea88b64409dfeccf94d8ef6a8afd9e4f2ca751979fe4ea468efa31e09c183f06b80a4424b295403cdf108854b7272dff6814795a5062fe1c43cceb425467d466f48b34a7474644cdbb3e7b8de62fdf40556b9e467fe9731d09455bf8b654027f9125f0edd20e43bd3d3b9bb6d298d3dbd3626568397c0e0da2e9d4db10aeaaef5fe97dd7c6a544e6d2ac19745a843677fb384234fcdc74fa171453e3eaad7e14e15f5ad4357ae92aea719a7bde9b39e65f9daf3e6f757b93bef3e9b56117e8c58cf8ae7726d2a5fde719f11ba62ca387af6b18e10343721380f00d71ff5994f0c561d2aef842f846cc1899177a86d8f490e3f2615f085f9d18e2200002c94e205984afb36248d477fec734ec02f7eaed6b77ab954756be6a95f163b5fa192c7c9578b94e09b74d6ae6d45522f9235324dbf3e887d7e8f476c38da42e2074e1db77fe2ad5be264272b268e03937d15b46a91be8c5550f93bd9068d8f6d0cceb2ea6e9dca61255af2b51d5d810558e684b98f075ad72bb053ad12e9addfb52e24562be5ce3334d71fcd5c49ffa916195fa91412341bbfe379b2eed610a6f9710cddb4003333a588c5ad263cb9ea5f6b29a6eb4fa034d6cd38ee6a95bc88c74e1690b5f9ff6d4cf1bf6aab9ab3d6d247679cdd672f88bb4a88f5b7c6f5e3490ae1d6bdec59683e6a815f8365a09a2adcb2652fbc1a640acdbf931b52adcdec82fccdc342b5682794f0ea5d6aee16c08b05acc9aaf56f32dd57bc5d8a534a3cb69aebe7813bac0d5efab6e57139ec6bef82675d127a75a551ea85695cd5137a1273e788dfc7eb7f1b68774721180f00d71bf751193b4c2d7126fd8eaec4c1c99178e4556e3dda1885ef187f0d589210e022090ec049245f8d22eb585f752d9c2db92463f3192ae6ed984527276d2aab7e6d3e007794d4f5d2d47ab55c11e8618d3bff4eb62e09d316decadba2d3b8fa691bdafa626b55368e7a655347fd2605acc7b3ed5e5da0aab04421725108cac263d69fed4bf50833a27d149c79babb76e71d584864fc9a4f6e7d6a7dfb67f4e4b1e196ed7e9de46eb88b64409df9c0df3e91c6b2b2fa96dc863270ca4f31b1e4739bbd7d23fc68da6b70cf16d8e4f67625ae2f9ebf499bddbf41c4b033b9e43c7a9cddd5fbef50f1a3edd9450464dda56674e6f5062ae832c612a11d6f7c187e9c6f314a36d6b69e1c4d1f48ad537efcae46733bb50d7e9e64de9f9e07cbaf9bc06747cc39322b68b0709df3cf563c665eac70c43531b1d0bd86eedfa0143c9c42b06d1c37fbd8cd22a1da675afcda0d14f59bf18a83a5cdbe00b313759b02f522bba63b9ca267d69f96bc3ec95f3ecacf96a8bbeb91d9b7f0458b87c0cd5cb33773b18dd37fea4a82df327510d6b553a68aeeb7629db73ec13747dc6f174e0874fe991c10f9a739a33b5c704c4172108300108df10f340040b8710be9ff892c35667138b3e57d8c269fdc3b6a208dfd6ad2fe52a7c2ed50e5b2b4896b94bc14cd946ddc172e43cddd732db41509e9f5dd5a599b5a8d62fbbe28888decb88cc380dae361d18514a9b2542b5ed6e244add9eac508d78ca7a9385ed83b71ea4412001048a3a1d73f6671bbd28ea33be657fab3351965a91bbc95a91f347af56ac96ff8b2eb79e1fd5bff4bb449e6b952ba0a69e4fd0bf465daeadc4395b66ed12ae15e36c7af9eeab68b4b1dfdaf6704794607efd5fa3acd55ece72564f8b2a7c6595db10540395a0d2f4a7bb134ecac5c431c78cb9855914776df5ddf4caa1d7c6f0f3bf9afaf6166f3988962f1a608b40cefe61d9186a37d8fa61c3f2efab9ed91e663cb3ed30d457fbddd53acfef1a76df2dd366899ccdaf51a76b8753941e52dfc796d1b0f6eeedc061e72665ff8fae3bbf87d54e139ab3ea356a632d9deb42df3d0e77ca61a0eeba6ba5dfd9d6afdbd56f0da4a97f77656adbfaeb6fa9b969fe8ee3ce432ae90940f8869802ba984926e1ab8f9b150da7d77e0ae12b5347f8489a43b1e921c7e5c33e8917be96e8e5caf9b2059669e783d49c4b8f3bd6e058d0575aafddaa57336b51b3fa284d47c90aee9a4f4e449b3e3e7ea650ed9748237ebdf4d80adb0f4f35488240510824621a2693f065d65bfff732cd78642ebdb246972675e986bec3a8dfed1da9b1251ed83767c322b5fa3996a3345a1d64d443dfe299b3955e7e7c06cd7dea1597c8a9dbf2061a34a81f7569d3d828a7ffc9debc8c460d19ecac9a7a5634493d819cf5da2c9a30713ae9e76d51dd96d477d850babde305ae6dc1faaa5f9be10b694e1ff733d6aefefb3ce3696f876da356b9e798abdc667ff7d0b299d3e8b1e98bb5b1294683c6d0886e27d3e48b3b103fc5ec5ad1d6071a477ccf8665346dcc636a25dbb90fcc6ed4fd23e88c7593e9dad1aa85887e71c516a37f3c4f6b36ed765a528c0629463d2218b14b36bd337314f5d75693072d946ddc39f4f2c02b68f45baaae366315872e1ec666135b95786e6f89e7ce4ab8deef11ae4e47546c4f16cd9ef8777ada73d859932bfa52e6dd77d0050dfdd56198b9e9fa81c2b3e26bdf5757a7221363d59ce8729a39e15d73459beb8ef06da3b6e04fa35fe78fa2de1a47defeccf362d480f6c6e30191adc0020258f10d3507741103e1fb892f3bacf89a58f4b9c21611bc12b2add8852f37a2949cfe85d411764e8cdda25ddc67dbdb8ee825a4052b5392ca458b3a057ceb30b3fdb3c4ea5b9b53af158bcf2ba298619096fc73356b511ae16ae26e486b13d1b24da0a873a214475756ba9e6cc2576e799edafa999393a7922994aa0e8b8a3887481c638679aa9ec3c61b00525252293535764d39ea4d01949242952aa97603dcb97f8755fff294438d547fa114b36b4576e0b1f139d2ea8c69d507dfaee6eca20d9b7f524e9562b676586d2e6e7c5a436b8bb1e99e6734a05a309af06d21b85ef5d6851c553e6e468a69b66a47918feb3e05371c6f8eba7f3cc50eabb9a6465d238eb9c135276e6ec6dbcf603f47f86aa7503347e3df8e62995a83e21c567023c839ea0960c537c42dd6c54c3209df7c257cf8320510567cbd5346e6856e179b1e725c3eec5b34e17b89de9c110ffaf26abd45cbf63735579cca8bfb6c95b44bd811bb4a2722ce96c59374fc7cea709bb49454629bc4e054c7317fabdb2756ca6e229663893616ab33c82f330412312f4a683065b1ab8912beebd6ada373cf3db758487efae9a774d6596715f154e762e95ad2579afdd954750af4537172a8abb6e47e646fc98db310dc4a91802e7c17aad72ff9bdcda814bb87a6cb090108df10374a1731492b7c2df186c3ad9c8923f3c2b1983f12705af244f04ac87925217ced2fb79aa233a39a813be37769a297b35d255c09adb0dda069339341ce5ca953c0bd15dbaad3c9360d76554e8613b3ca8409f4c2aa6ebbfa5875e8e562f946cb8fbbc1689520af4c1148d4dc28c64195d52e264af89687677c8bf1f6266dd5395b97d19887d5b664f50ede58d7016a46773dd8477b46395609e497360108dfd2be034747fb10be21eea32e629249f8eae3564ace107310becec4113e8ec52d78d92e825742b62552f8067d9175d93591e52b32b953f6a54a9affb32d1cd1aa30edbac1d59851dcaf8459cef397ff3dc5bd646bb4e9ac447baa8a3fa9f5571f46e4207daad4cafae4c6650a5585ab834ef50166c701b1d22110eae6967c17cb6af712217c0fab7daa1b366ca0e6cd9b170bd82fbef8824e3bed34b59bb6923ae412ff028b05322a05011f02ceab969ad07c758096fe162e1f779840c0970084af2f167fa3081c0e217cf18cafcc12991792e6506c7ac871f9b04f5184efc5177bb63afb7cff0afc726b7d59f329c2dd52972a69fecf4c6a7f7dcb88d1d3a0f664b056833b2a45ddd6d8a9026da538b6b78f87d657df3e28a3e66254e0f2f366fa3411642a42519f5f1ecc565c7d0b6a18f692231071934bfb0e391d7262258723de9612217cf3d4838c3ffdf4136ddbb68db2d5f3ab9c4ec495c2cfb7d6a841e9e9e954af5e3df53c6c0a846f22c0a20e108897807a9e77d7ce3d74583d8f7ec2f1b5fd9ff38eb72ef8252d0108df10b75e1731c9247c955a33288968e3102bbecec49179e1584a41f872e39eefd6c15f7095a3f93fbdcb565c9532ffe793679a3ccd04f85588108e5ec7f8eaf196b204a95138788491a5348b56ccec8318dc292f4fa9c1ddb45946f2a2870958a50ed35cf4ce2037c1045cb746a654d0244a70dbf1556776caee5a7c854ad4aba8c2973bcb3f281e3a74c838688843f9ff5b451908afecf2a772e5caea20a25423ac58b16251aa4459100001100081522000e11b02ba081c0e217cb1e22b5347e685a439149b1e725c3eec93d0155fae902febdbb7ff975bd757731ff1ab4a99ff33eb8af2d75393cbd36c3b9a87cb5dbaec3606a49c7159b1f89b316b742ab05ad0d7a53d623da8ee88a6831cf5419885229ad75de28dc7d35cbc75c12fa104ec5b63dc683b95d0360a5f59027e78297ce371954c84f08dab213881000880000824250108df10b75d1731c9247cf571f3ea2fa7b1e2eb4c1ce1e3584a4ff87a4f7076fae4f325dc329981faa66ea9b2848833bb619f76edbcc24662f430a8c918c57c7be3adcb538737dbb70ecbe8291acd35bebc308dc75723bc1241c0bad1b19fa32f4a63e16753f81245e95fe1ca42f8168e1b4a810008800008c44700c2373e4e8697081c0e217cb1e22b5347e685a439149b1e725c3eec539415df8bbccff872857cf98a215fa37236bf0aebb945f9727ce0c0017aebadb7e8cb2fbfa483070f1add89ef8fde835825fc7b58a54a153ae38c33e88a2bae50077ac63ed133562bae7ce99e7fd3fec8550501eeaeaa8b9c90be15b922549010021137ddbc4189b94d1195c7dde5682583f212d3e7b8bb683842f886e3056f1000011000817004207c43f0d2450c842f84af4c1d991792e6506c7ac871f9b04f890a5ffe16ebfa86eb4a18e2cd6de11ec67fb1e89d33670eedd9b327fe42513dfdbe76c7ee61eddab5a957efde81e2d7afd6a8dd28a1cc58238bdaefa89925340034e3f9f7a50349c40d8a3543f4f6c2c5cd9af96f22fa19ae6daf77eefe6cc3d4ac59336f16d22000022000022050640210be2110ea2206c217c257a68ecc0b497328363de4b87cd8a768c2b70d57a15dd69756edbbabfd559927abbaec2cd58f445fafbcf20aad59b3861a376e4c1d3a74a0ead5ab27ba8928f515d0be7dfbe85f4b97d2e6cd9ba965cb9674c30d37287f7bc411658373225c8bdd10efdd284b7d2e762868a0440898734f9f81a53bcb207c4be4b6a31110000110485a0210be216ebd2e629249f82ab5665032445bbef58cef1a085f993a322f24cda1d8f4d0e067895ff6298af0bdf062aff0e51ad597d688efad6e9b99adeea7fe5d978b16f19a346992b1bd79e8d0a1b6e8f56b22a27b856cd7a9db89b1f87de4914788b73d8f1c39d2a76677ebee948f7b09989cdec7d75859e8737c3d8557592760ce3def0c2cdd1906e15bd6670dfa0702200002e59b00846f88fba78b18085f085f993a322f24cda1d8f490e3f2619ff2237ce5cb71f097e271e3c6195a9a5ff511ef15549bb4165f3d6eef9c9c1ca358666666407177abee5440915866e942212a93a2b19ad0f3fd9af9fee3c5f4f4dbdf1155ae4f3defbc85d22be3552b3a33c4998033db9c98978cdfecf2fa145f1ac2b7f8d8a2661000011000012208df10b3401731492b7c2df186539d9d8923f3c2b19421e16b6d73d6fb66bcb427f89bafeeaae25e47f71763c965e11b79496e644ea4c55d6f64be9f25b8fe78852fd7eab4bc8f968e1f420bd7111d7bac4f7b4ad4d7ae5a8beaa59f4617fda11d5d9af1bb287882fb262d46f3f069dd3639fdb54df4c9ec8134eed56dca904699f39fa456358f7132113bca09849b49d1bdfd6657c9e183f02d39d6680904400004929100846f88bb2e028743085facf8cad4917921690ec5a6871c970ffb247ec55755ea2374dd36f5b557fd2ffeafb7deafc94e493d4784ef35d75cc34353979e6b5a62ff75ea8eedeb5fff1b6fbc6114d585af789ab5476b631fcd1b7833bdacf463342fbb6f0ddad3c4f1fde9ccda9ed5d50ad2a2ede98a98b95a0bd1dd9db25a1136eac9cfe70fa7bfbdb45159d369dcfc47a945dcc23797de7b7c022d59bf97aa36bc9626dc7d3555755a44accc138877f2980389cf5b9f59aa5c7c8512422af7000eb74a084854020220000220e04b00c2d7178bbf51173110be10be324b645e489a43b1e921c7e5c33ec5227c590e79beb7725b41570857bb0abfefc16ee1ebe761178f1289d21baed295eddf8657f87abda2bf5b751f3daf84ef625e38a5546adee65caaa9fea1171c543f7455a940077ffd89d67db1918ccdd476c5e934fcb187e8d293b5c3bc8c7eda0ec678dd2936698389cc34ca44fcd18a489e980a2f7c95d8efadc4fecfaac6b48e346f760faae5f7e3893488306e02f1ded6b82bf4752cce56d4ec2aceea7dc603e1eb030526100001100081841180f00d8152173110be10be3275645e489a43b1e921c7e5c33ec5237cb966f585d5f39d550412e7fa5db1f2b94cb4efc031852f178eda48944cdf8635a3565484efdf029ef1355db5022e189af04def4c8b67748b58fd2c38bc9756bf328f26cc5b6e94346bcaa0890bc7d399d59c95df022343eba3ab1d4ffb416eae322ae129a667175ef8e62ab1afc6ca623fbd233d37a32769125e6f02f1324720de8953c88ebbaa8f32f90a59bd5f31085f3f2ab0810008800008248a00846f0892ba8881f085f095a923f342d21c8a4d0f392e1ff6298af0bdc0f75467aed5ba0256ed22bfbebabeddaac2911e5265b4d011be57bbddbcd54baeab1957423ccc30a8bc8f0c675743f8aaeaf4adceee0a3915b4eeab09dfa0d54fab3ffbbe5b4ef70c7e948cc56155637ac74c9ad1b395bb296bcbf3e1ec1db476cd7afae9b71caa54a912a5a41e478d4e6f418d8eaf66fa078cf1c0ae6db4feab8d76b9e3eafe8e9aa8f79ba6d5a86496d3b0c512be05397b69fb0eb58d3445154da94ee927d6a03d3ffe483905bfd082a199b48297b153dbd2c4bf77a11a7979964f6db31ded6f018f256b3d7dff8b2aa0c6929a5a83ea37684267363a5ef3d2a3b9f4e3b65da46aa41af51b50ad4a15e8c0ae2df4dfffada7823a75a8726e36a5d469422d5b9c1af123835e0be23a818009a3bbc419f7ad4919b5a915674d8571f3b65240b907f61915e13dbe85e18932200002200002b10840f8c622a4e5eb2206c217c257a686cc0b497328363de4b87cd8a758852f3710207e8d2c5d387abffd4629c765fd2e5fe1ebad572b6867696db9be06db0e5a2157d474f0bac98aaf4bf8ba2ae64a4c438499dcc2f7b9399ed54f4f633faf78827a4f7ad3ead579346dc9bdd4c8759a722ead5afc184d58f8a1d673a7d5e6370ca57b7a5f46d53df5e61fd8468ba64fa2c52b44566bc55594cbdda7cae9cfe24613bef90736d2e4aec369855493d18f968cfe1df5ef9649bcc3d9fff21e92a5c6b268ba672c5ac974259ad5c160dee79d8ffcfa09ddde639cd14ea707e6d2253f3d4b431e3357cbb5d22a9aa1b68c8f726f19773b20a5ff9b2d220dcf942b626de18a3bff0222cb41f8463281050440000440207104207c43b0d4450c842f84af4c1d991792e6506c7ac871f9b04f9184ef459ef7f8067d9b34ec92a97dddd5a2dc17f1e0b837e5c9345dacbf528d297c0bc839dc4a3948a6ab849e70b72a39fe56c99550b194a816fa0a5f2ddf89ba5b315396f0ddaebcd48aaf4bf8fa345650f033cde9d39b5eb5d46387b1cf50af736495944f88ee43733fe1a554bdb0bb5dcae84ecf4db8c9de5e5c50b043d5d9cfaed3e82fbf22ca7a4d93f43faded9d34e7aeb692a420e16b88de5e4af41a0f26ab45ddf37ad1ecbf75a06a07d6d3e0aea3ec156bbb223ba20ec97a5e1d9275ec31cab28f5ebcb70f2dc8b22ab17dbc91741af5d454bae8842a76c691fd6be96e25b037294b6a7a1ae56c0b96dafc5cf580e973a87d43bf23b5ed2acb5d44bffbe5aef325dce18358f12d61e2680e04400004928b00846f88fbad8b18085f085f993a322f24cda1d8f490e3f2619f840a5faed0a3a9d8645f9c17e21b78c466604fdddeaac68dbbdf68ca16be5e07bb2312f15428662b8c9ecb43f16f207ee1cb0d795b89bee2ebf5e61ad6ce1b48997c0cb4ba3a3d308f6ec9a865c4b7bf3d99063c66adf45648a50e83efa5bfb43983aaa6e4d2a6152fd0d8a94bed43b22e19369346fcbe81516ecf6773e9d6b14b8d38a5b7a5ccbb7b52ab8675543a97be5bbd94c68d7fce5aa5552bb24fabd716d561614abec23748f4ca33bc79fbf6d1a18a7be8e941036919ebd1b4f63463fa6d543b3f5f6d75ae4ad5abf2be6822d75854fa929ef751dfab5b52add40af47dd6fbf4f88447c9d6c49e2de2baf0352a537f9adf308806fee532aa5fa302fdb06e394d1d3dd310c6467edaf5ea80adde47c5015bfe33542820b40968a00ee660abb3cd0511100001100081841380f00d81541731492b7cf34df1b6760d84af4c1d991792e6506c7ac871f9b04fd1846f6baec27d69db86dd1985493932cf885949ed3baa566901395b9dadd719f93b6a659cfa35a32b1ae46156eddf4038e1eb6a4e25f63ba73a7b577c3daed2b71d6abb733f6bbb73f31e0fd1843f9fa1eef1cff478d7deb44c2d90722fbb2941dcd912c452cdde35cf52cf314bcca4127b7394d84b53f7efdb3727d390274cc17cfed0d974df65ceb3b3fcfee54d6fcfa5673efe41e9e0ead469e8206ae1277cd54a6df30adfd0649f955e11bdd20f5ecdb54fb2f639dc8a57a01fefdacf180b97b96ae42ceadfbabe535cc558603fa0b652afb6acfa78bdc2f7fcde0fd17d379ce12a7fe4d7b594d92393b27ccabb1ccb49c27f669693ce9774373db0207c4bfa06a03d10000110482e0210be21eeb72e62207c217c65eac8bc90348762d3438ecb877dca8bf0e5be1a97a83d49dba147f87abeccda6eae486065b6579047d06a2f172c9af0d5446084f0f5efcdaf594ac0de6b0ad8b4eb3369769f5694f7fd72bae58e478d15ddd4b677d1226d4bb23d3875dcd38bc3fe4c0b780fb07af76ea67af76e2bf5eeddedef3f4a03a69acfc0a6b5ed4793065e4d69ea4028f332c14aca321a81b3d53983c63dd593960f1e41ef7ab637478a5e2e1a6dcc4a5fabb1dc6a8d25daa9cfdb95601f600976e6304771e0cb257cd5e159b316de49f57d7ea0d9f2ca04ba73ce2aa38c5ede3094a33f714dfd72349e62edaa0f2c08df62258eca4100044020e90940f8869802ba88495ae16b89b7b59f41f8cad4917921690ec5a6871c970ffb2456f82a39e4a788b8a1425d312a73656bc2f76a6bc537ae365d95f896707b4493bc66f19216be3fabadc9bdadadc9b2e2ebdaae4ce7d1ad7dcf223aec199e3a9839ebd96768b5214e95f07d5a095fb57a9bbbf99fd479e8339a33bf4ff8f7d4eabc73a8e519a7abd3986b1b0733b383cec611be5a518eaa677a17ab677af583b0dc1ed185afbe329dae04ed0c4bd0baeb5002571d6235441d62c59bbe753f5df8eaf688f2bfaca4db6f9b686ce34eef384e9d90ddc2eb522ed23e5aae5cf4bb543ae9030bc2b754ee041a0501100081a42100e11be256eb2206c217c257a68ecc0b497328363de4b87cd8a748c237d6eb8cb881225dbaac8a5291e166095ff545d67ec6374a91c82c6f5b3edf88230bf95a8a47f87afb274d1768cfd63acff8eed55681c5335678d57d73a8fff96986db576f3e4a239ff03bf95865a7a653bb1bff423d3b5f6a3f07cbbd0b14be194af83e5004e1ab8da583ea632fab8fdef1e802970f069b37bb87d13fdd1e4dd0ea7ed4a4333d37b59b7de097b7adb29a2efcac2dab232ac67e05c082f02d46e6a81a044000044080207c434c025dc42493f0d5c7cd4f2d727aeda710be3275848fa439149b1e725c3eec53b6852ff73048f0719e5ce637d888677c25bb84c3e217befa3776b55a3aec665a6c6c5726ea305609c373d2c8257c53d3a8799313a352c8d95b40d78e1845ed4e7636231fd8b591de7ffb03fae0c38f28cbef24e4f4eb69d6f4def6b6e140e1ab5a4ebf7eb45aa9bd30a00f31567c35e17bc9607508d71fcc43b8bc95b9856b775a3cf526639559b7fbbeebd8aa285f9d323d429d32cd2853cfeb47cffeed1a7b65dbdb16d2e59c80fe4fc83314085f0f1024410004400004124a00c237044e5dc440f842f8cad4917921690ec5a6871c970ffb947fe1eb7c834d0ee1eb8c97efdf3e250a6fb69eef256a4213174ea633ab5524d7f6e08e13d5b6dd33d9bdd0d7e19cbdf4e3b6ef68d51b0b68fe3b1bed7af4d727e9c2b7dde0a9d4a5aeda3a2c8767a912edd4c9d143ac93a3ed0a8c88267c7d0eb7d2c792d67e34cd19e02fa0f37efa80fadd3e2562abb22e7cd3da8e50af60bac4ddbc953ab87519f51c34d3782e3a9a40f62d9ce446f7ac8c0e239e9fb2a2d750c4dc189d85f02d225f14070110000110884a00c2372a1e77a62e629249f8e62bc1c6178f9f4f96e5102bbecedc9079e158ca96f0e5bb57f42fbc5c43f0b7d65215bed22dd5c544aef8ca765d879e34a49e69fd459d447c9b7312719a5a559d63adaa1ed19e57e55704cd997d877162b33e3f8c78ee3eda97a762daab83282f8f72d5875252d4ab8fccd709e9e5f4539f9b76194f53ba9e6d643bc2d711e09f2fbc8ffeb6e80bab38bf23779e7a47aef38e5d334313bea9edd5e15377d8abc89cef1a0bb5a619ff1c41e9152b5a753a81fe5a277d4bb32e7c893268e292f17466e5c8f29fcc1e48e35e355f0ba597775a40cc8f803323fd72a3db5cff4d284a45d19b09950be11b0a179c410004400004421280f00d014c048e2100d5b7868202f3ab03eb428e155430bf3de87e5cbd91560e156c7fc78fdf97ea5f4ed975c1a994b69ee606cdb4db6ef4c32867d96d3fd3bf82b71e6e5f6bc7a9d7a9df257c952ffbe3702b67e2083fc722ecdc21fbc9877d8bb2e27b7e219ff1e5f9511c5734e1ab7fa74e68fb7ac5d6a06ce13b26b310c3d444607a675a3ca39b752894f49a1bcca30d1f2ca287a72cb1dea7cbcd38a7329b8dee532736df6c9dd8acde5bdb790c4de87aae9965fdb55fe163549d41d394206c54f980f36a214aa5218f3f4bed7ee716bfdfaaf7030fb1de0f7cc9e047d5d6e3538c1a1de19b4ee3d409d12dd409d1fceedfa5e36fa5b9e6095a2a7d1e4d59782f3555abd2ceb58fe60dbc99cc57117bc7c15eeeb1a45f3f82a6f5b9c4b50df9d7af5fa77e239e34df4bacfa3dfcc967e9d27a66bfddc297b731f7a2d9eab02d675337d1eeac7fd2807b9fb1cb0f51e5db59e59d7e22e625e033fdbd2e71a5adffb715976f713b41f8163761d40f02200002c94d00c237c4fd1781c36132adf8eae356ca0dc2d73367848f6e169b1e725c3eec5b1ac257fa28524ed2bea1f79b75944241c257aad8b97327fdfaebaf763351aab27d8222356bd6a4138e3fc137db16be9996f00dd590267c298dda756843358c56542595d431ccbffc489f7efc216d334e62769aef76ff5ceadcb2ae635031e339dfd1e66b8e98415ac6f57447cf767442a523b425eb037a61f652e304642ed4509d963cdd3a2df97f337bd383cb7e66b3bad2a9db903ef4fbb34fa1949c5db47ad962fac7abe62b7f38f7d6479ea33f353625a4bff05573ecd0369adc6320ad903eab83a3e64de96a1f8cc542fe3fe36fa119228ed35bd3805b2ea3baa927518b160d0d81eb7a6659b59bdaa43d0de8da86eaa456a0ad9fbc4aff78c9e9536a6bf5faa6916db97bc6e515be8631ad350de9ff47aae7539ed4f3bd2fe1f95e8b5ef440fe6d45f78a919b904a62b41122fb50ce3ec3bb59b366214ac11504400004400004e22300e11b1f27c34b173110be78c657a68ecc0b497328363de4b87cd8a734852fb71f71a92fc171e9441fa758c277e346f3d9d4ae5dbbdacd72350b172e34d2ba9d0d62ef62f94b930b9f37fd9b366d6a94f3fe8910be96037fbf37ea908abc058db4befaa93b48218f4a50022e73fc9dd4ea24eff6615556b97ef9ea641a39fb43bda2c8786a5b9a367f885aed355761f37f5b4f0f741f45ab233d0d8bf4a479d7f16a15d9dce6cc19baf09577024b15faf3b76ce355db196ad556ae1d2b9ea07e93de94a415a6a9770b3f69bc5b980d9bd47b7a873d11632c4dd4815b0fa903b7ecf70e7bdee3eb692122c92ce62a16ae15e9082f181401cf4c2c1c93845452b8a6834a41f80691811d0440000440201104207c4350d4454c32095fa5d60c4a22da38c4566767e2c8bc702ce550f846f9122c624b1f9f11d732fc84af51a555af217c957f90c08dcbaeea5a6409e578856fd0b0b4ae3bc3aaa0567cb5539a2583eb70fc53293de342baa163076ad7ea54d7965ff6b7fea94851dab9f6757a74e29394252bae92a35e4b74d55fba51d73f5dacadbe9a99f907b6d16bcfcca3e7ff6f95b5fd570af1db8c5a53afbedda97d8b938c5d2792f3e54bf7d13df3f979de2634eef987a9c5b1bcd5d9b976af7e967a8d5f621b6e9ffe025d6b3fef9b475fbc3d9f663da556a1ed7eaa7ae6ab7a8c2dd366b15fd62da3a98fcca42c5990b66b4ba3abfa0ca4dbae3f27e27dc1fa8a2f3f933ca2f9661aadb6357bab68fec7bfd29dfdaff27f16da6e0791a0f91c8a4c422a09d562dcce10be71a38223088000088040210840f8868026028743085facf8cad4917921690ec5a6871c970ffb1469c5f7a2d65c45e465283447a6453a6896905f80036b551993264da283b907e98a2baea0ca952b1b8de8d5fbadf8b29a9495dd40e1dbc55921e64ac5bf99cf8aefc18307e9edb7dfa62a55aad0dd23476a034d5034108055bf3e604f93d97bf7d2c1bc5c3ebb4a9d5b752cd54aab11219a3d45543297f6febccf3cec4aa5aa1e5b936ad5488d748bd5afc8128196dc7d6aaba93a542b451db8e573b696512e277b2fed3fa8dc54ffb20f1f43c79f787c84e0950674e19baeb674cf30b674e751f6de7d6abee452cee102aa919646b552d556725cc544c09a98d61913c5d44842aa85f04d084654020220000220104000c237008c9f591731c9247cf571f39216a7b1e2ebcc10e1e3584a51f8da9df0a8214e46116676b118114fadb6f72bafbc426bd6aca1e38f3f9ece3efb6caaacc4a77ef90a5fe520423650f81a5b9db9e366cbe2afaff8724eae12519f7ff105eddab58b5ab66c4937dc7083de7cf1c613c4b6783b593ab5fb0bdfd2e94b72b51acf3ff6a07fcda5470ac2b7f4d8a3651000011048060210be21eeb2081c0e217cb1e22b5347e685a439149b1e725c3eec539415dff37c567cdd5f63dd296e2f51975fcd070e1ca03973e6d09e3d7b8c66e2f9daedf4278cb75feb4e4db56bd7a6debd7b53b56ad51c2362a54600c2b734d087f9f7549cfd8bfe6fd5af65085f3f2ab0810008800008248a00846f0892ba8881f085f095a923f342d21c8a4d0f392e1ff649b4f0e53a9daf9a4e8cedc571795b60f1bb68d122fa71c70eb5a5975f501b7415f58bb9b765de9d9b42f5ebd7a72e5dba40f406612f053bbfb6e9f61e99c633bda9ed47d3a2011796422f92a9c9a2fedb4a1cabc2f4e470ce7ea30338d53971f701358100088000083804207c1d163163ba8881f085f0950923f342d21c8a4d0f392e1ff6290ee1cbf59ab230521c729ef7f27e398daf94538bd7df5b9fe329b1d81ee2193bf4b61ebb44497b2472b4dcf7b23f6237e182c33be89d97dfa35dca7c52cb2be8d2d3dcaf7d727b231596807b7eb953deba02e74ef462de6a62a65dd50536ea5f0d84af3f1758410004400004124300c23704475dc42493f0556acda06488b67ceb19df3510be3275645e489a43b1e9a1c1cf12bfec5334e17b3157e1b99c6f9966cc497b1c8da4eb0baae610514a1c2332cc42621637bb2a97414b4801dbb12891845656948ed865b591da364440a0f809c437f35cff62e22b1277d78b5adde15cacf8c60d1b8e200002200002a10940f88640a68b18085f085f993a322f24cda1d8f490e3f2619f2209df0b7d842f4f4aeb32634e5aec12c6f305d52ead3bdb46a92920d4cb182e1186042e5fc6dba980bec661e6dec7d38acf28adda8373e2681e2e20907802d6948c675ec76a3c51b31bc2371669e4830008800008148500846f087aba88495ae16b89379ceaec4c1c99178ea50484ef453ec2d723cd2a78d2d2bf305f522bf839c7f34d39a25c8481fcdeae124fd5328ee861e26af2f63ca866af5f64ff627b44968105048a8140199d8a10bec570af51250880000880804d00c2d746113b22028743085facf8ca8c917921690ec5a6871c970ffb1469c5370ee1cb6d78c56fe8efbb5a0197e07325b825edd2ca9851cda0b905e872dd23c2c5b726317afae4496af506e7684e7654aab70d2ae257839f9f5e46cd0a77122910282d0265742a42f896d68440bb20000220901c04207c43dc675dc440f842f8cad4917921690ec5a6871c970ffb1445f8b6f2085f5388f9c93147fc16eabbae4f21572b7ac2f28d2c1269e1f1fbaa472323c49f80aa83ead6bbebdf8ae31154b55e4ebce3f185f0d5c9215e6a04e29baca5d23d08df52c18e464100044020690840f886b8d5ba8881f085f095a923f342d21c8a4d0f392e1ff649a4f075e42dd7ecb9f88b2e4fd8d0972a18f12539b21eb144b8daed05e44841db2f4424a0ca881a0add865530563bca8d3d6d373b12d113ddcb2f33bcadd0630bdf144a1c2504a2cecfd21f23846fe9df03f400044000048e660210be21eeae2e62207c217c65eac8bc90348762d3438ecb877d8a267c5b731511974b0bf97dc9351c5c5e1175d832ceafbced1dab0e718c5249bc5548551c46a94e770b8cc76a33a2fe5805025bf2c988a8dcc707a6a3914089dd799fe96a984aac0345bb7b10be45e387d2200002200002d10940f846e7e3cad5450c842f84af4c0e991792e6506c7ac871f9b04f71085fae37e6175dfbcbb11de162d6a57d43d6a2921b19fad5215e66057a3511de110629ab857a059a396151ee43cc36e2e968ac1ec56c245605c82f6704cae31d4fc44cd76f53180679789d918e0e71100001100081041380f00d0154173110be10be3275645e489a43b1e921c7e5c33ec5257c59c4c5fcf26a3bd811ee3577cbb93c4927c31bd3ebe03c354eaf8b4fda28e5fc31cad96ef154603b9776c43bfea0fe94ab41050d02f63809e06ec7094a7383f0d560200a022000022090700210be2190ea2206c2b768c2376bf3f610e4cbb6abcc0bbd97b64d895dbe580a725417be05f9f9665ae5192238df14c61ccf2f50792a3c72847d54da881fa1fdfbf6d1b75b3653af5bbae8cd210e02200002e59ec0ce9d3b8d31346bd6acdc8f0503000110000110287b04207c43dc1311331c26adf0b5c4d9da3510be3275645e489a43db06e1ab63411c04400004020940f806a24106088000088040020840f88680286206c2b780207c9d8923f3c2b140f8ea2c100701100081780840f8c643093e200002200002852500e11b829c089ca416be6a0593c7bff633acf8cad4917921690e6d1b567c752c888300088040200108df4034c800011000011048000108df101045cc7098b45b9d217c23668ccc0b3dc3b641f8ea58100701100081400210be81689001022000022090000210be21208a984936e1ab8f5bad659a2bbe9f62c557a68ef0913487b60dc257c7823808800008041280f00d44830c100001100081041080f00d0151c40c87c9b4e2ab8f1bc23772c2081f3dc7b641f8ea58100701100081400210be81689001022000022090000210be21208a98e13099846fbe88371e37567c23668ccc0b3dc3b6093bbcce48c7833808800008441080f08d400203088000088040020940f88680296226a985af12723c7e1c6ee54c1c99178e055b9d75168883000880403c04207ce3a1041f100001100081c21280f00d414e044eb2095f7ddc4af542f87ae68cf0d1cdb60d2bbe3a16c441000440209000846f201a64800008800008248000846f08882266384ca6adcefab8217c23278cf0d1736c1b84af8e057110000110082400e11b880619200002200002092000e11b02a288190e9349f8b2d8e58bc72d1f6c7576268ecc0bc782adce3a0bbff8b871e3fccc11b69494146ad0a001b569d3861a376e1c910f030880c0d14300c2f7e8b99718090880000894450210be21ee8a081c0e217cf13a23993a322f24cda16d931f0d70b8958e87e215be528879b66bd78e2ebdf452312104011038ca0840f81e653714c30101100081324600c237c40d1131c36132095f7ddcbcfacb69acf83a1347f83816085f9d855f5c84ef35d75c13917de0c0015abf7e3dc997e0ca952bd3a143870cbfcb2ebb8cf8830b0440e0e82320ffe69b356b76f40d0e2302011000011028750210be216e81081c0e217cb1e22b5347e685a439b46d6aae1869acf81a1ce44f34e12b3e5f7df5157df3cd3746f2da6bafa5d75e7b4dfdbbab60085f885fa18410048e1e0210be47cfbdc44840000440a02c1280f00d715744cc40f862c5579f36322f7c6d10be3a163b1e8ff03d7cf830fde73fff31ca8c1c399256ae5c49efbdf79e91c6caaf8d121110386a0840f81e35b712030101100081324900c237c46d118103e10be1ab4f1b9917be36085f1d8b1d8f47f8b2f31b6fbc619461e1cbd7bbefbe4bfffdef7f8d38c4af81017f40e0a82100e17bd4dc4a0c0404400004ca240108df10b745044eb2095f7eae972f1e7741bef58cef1a6c7596a923f342d2c2ca480bbb24d9ea2c825667112d7efae9a7d3a9a79e1ae8e215beccfacd37dfa4cf3fffdc2803f11b880e192050ee0840f896bb5b860e8300088040b92200e11be27689c0e130999ef185f08d3e49645ee85eb60dc257c7e21b4f4b4ba30b2eb8c037cf2b7cd989d9bef3ce3bb46ad52aa30cc4af2f3a1841a0dc1180f02d77b70c1d0601100081724500c237c4ed1231c361d20a5f35761e3f4e7576268ecc0bc792bc875bc98aef1d77dca1e330e2070f1ea4356bd6d0279f98bb052a55aa44fc1c2f5f75ead4a18b2ebac888eb7ffc84afe47ffcf1c7c633bf7ce0d5e5975f9e80571deda3a5e387d0c27544c71e2bad68616a2ad5ae5a8beaa59f4617fd41bd5a29e3775a26a2200002452500e15b5482280f0220000220108d00846f343a9e3c113810be10befad49079e16b533f12f0a57e2e3016ced957fc0bf2f38d38e7e573dcda46cef1fc024ee7d39123eca3d246fc08eddfb78fbeddb2997addd2456faeccc4a3095fe9e4dab56be9a38f3e227e4d518b162dec955b3ff11b4df8727d595959f4faebaf1b1cbb77ef1e75dbb4b41f1ceea379036fa697b7057bb872d2dbd3c4f1fde9ccda155d6624ca0a815c7aeff109b464fd5eaadaf05a9a70f7d554b5ac740dfdf02500e1eb8b0546100001100081041180f00d01d2162c4abc60c517cff8cad4917921690e6d1b84af8ec588f3caef9c39738c381f5ac5e2f68b2fbe30d25ef12bc237a212cd20eff93de59453a8478f1e5a4ed8e83e7a5e09dfc586f04da5e66dcea59aea1f7ac141f5efbd4a053af8eb4f94f5c546ca71559b4ec31f7b882e3db9bacb8a445920a07ec8e8ad7ec8f859f525ad23cd9bdd836af17fb87195590210be65f6d6a0632000022070541080f00d711b45cc7008e10be12b5347e685a439b46d10be3a163bfef8e38f1b7139ad79e9d2a5c4efede54b17bff1085fa390fa73cc31c7d0bdf7de2bc942849af04def4c8b67748b58212c38bc9756bf3a8f26cc5baed59f4113178ea733ab61e557835206a2b9ea870c751ff9878cf48ef4dc8c9e849f27cac06d89d20508df28709005022000022050640210be21108a9881f0c556677ddac8bcf0b541f8ea58ecb857f832c3254b96d0962d5b0c1f5dfcda853c117e3e78d3a64d7619cececcccf47885496ac237c60ae1beef96d33d831f25d9159dde319366f46ce5db5841f60e5a9bb59ebeff45ad15abe79a53536b50fd064de8cc46c7fbfaebc682ec9f55d9cfcdb2a4ca1e57871a3569468d4e3c4e7733e379fbe8c71ff7509e4ad53e319daaa744ba50a04f2efdb86d97abec0f5fafa50ddf6ea703872bd171f54ea6735a9ee6aa73d7b6f5b461d376fa553da69d9a924ae967b4a0a67efdd2ba719859ac594f3ffd96a35054a214c5a2d1e92da8d1f1d5342f279ab37707fd9cad1a48a949e9aaee829c9f69ddba2fe9879f7e3358a6a49e40679fd782d252f595dc3cdaf3e38f9453f00b2d189a492b78893eb52d4dfc7b17aa91a7e8a4545775d5761a3162b9b475dd3adafcfd6e355e5575b5e3a8c1298da999ba477e183d85914c100108df04814435200002200002be04207c7db1f81b45e040f842f8ea3344e685af0dc257c762c7bdc297339823affc6ed8b0c1f08b47fcb2e3ead5ab49be302752f83e3727fa0ae1cf2b9ea0de93de34fa4a741e4d5b722f35aaacaffae6d2aa45d369c2c20f2d1f4f90aec4983a4ccbff19e13c5af5f2dfd5cab27fd9d426ed29f33ef7f3c57b3e9b4bb78e5d6a3472d57d73a8fff9699e0689827c8efcfa09ddde631cf1aee00ec3eea363964ea09737798ba7d380bf4fa52b1afc404f0cbd939689ead7dc9afff96e1adba38d8f588ccea2f90d43e99ede9745acc87e32bb378d7b55f54afd10f140ffaa3461fcf39eade6dc782a75ba6712dd72f1c9464f8eec5f4bb777cb34c6a2754d8ba651e6fc27a955cd630cdbf71f2fa6890f3d6fff88a139aaaa3368f8a451d8caee82527c09f977dcac59b3e26b0435830008800008242d0108df10b75e040e842f84af3e6d645ef8da207c752c76dc4ff84ae6bffffd6ffb3dbdd15e7524fefbd4815fefbfffbe912c49e15b50f033cde9d39b5897f1d561ec33d4eb1c5949dc472fdedb871664b99f08363df5bfe934eaa9a974d1095534239f2edd87e6ae8e55b609653efd30b5aa630ab8bd59cf52cf7b9718f574183b47f52552f806f9b058bc5b89c508adabf5ca8ca6517adacfb4cd1a7344b6325c326c268df87d032d2bcef16474a7e71eb8c9257e3f9f3f9cfef6d246adaee068b787e751e7d36a51fe81f534b8eb287f216b144fa771cf3f4a2d8e3d8676ac984bfd26993f1648cdeaf06eca71a14fa3e14fcea44bebe1682c61545c21846f719145bd2000022000024c00c237c43c108103e10be1ab4f1b9917be36085f1d8b1d8f267cd969f9f2e5f669cfa79f7e7accd39ae559e09214bedccfb5f30652a6750c74a707e6d12d19b5d84cdbdf9e4c031e73566b2fe9791ff5bdba25d5525b72bfcf7a9f1e9ff028d99ad8b3adda5bf6fc2e77d35f6fbc80d22a1d51db71dfa75913673a65cf1b482ffded4a63853548d41a1db2fe04f944085f5ee9bc7f305d7c5a5ddabde17d7aec6ed55fbd226a42b78f1b427f6cd1900eedda484ba6fd8d5e9601a9e7a39f53cf4757b7fcdde349a50e83efa5bfb43983aaa6e4d2a6152fd0d8a94bed555caf68f60adff4b6dd69d8add750a3da9569e737ab69d6031369b588f08c7ef4d203d7182cf2d48f21872aeea1a7070da4659c9fd69e664cbf8d6aabd3d129a52a55af9aa27618ec553f5cf4b47fb868d7e73eea79d57954ab52053ab0670bbd3163022db02a4f6b3f9ae60cb8d0450089c41380f04d3c53d4080220000220e01080f07558c48c89c0496ae16bbd7267ed1a1c6e251346e685a439b46d10be3a163b2ec2d73678227c523333e4e778535252a87dfbf61e0f77b2b484ef0eb5ddb99fb5ddb9798f8768c29fcf50fdde418f77ed47cbac55c3ab46cea2feadebbb3a9c7f60233dd07538adb6acdd9468eeac4433af223fdeb5b75db69d7a8e78c81f4e7195758b5467f53248d4ea85837cbc75663efda8bd92cce50f6e7d9d7a0e7ad212a8a93460fa3c6adfd059a5ce3fa4c6d3c91a8f26e4bde39171bafab446ad548f3157aa29ed7a9aa3b637a759a72febc237aded5d34e7aeb67a513af2cb4a1a72db44737557959da7ca3a27376bcf6cfb1c6e957f680b4dee7427ad306a6c4df3fe75b7569688f39f7ef839fa9172a9c6999d6948c7e6aeb691483c0108dfc433458d2000022000020e01085f8745cc9888190e93f6546708df887922f342cfb06d10be3a163b1e4bf8da8e56e49a6baef19a5ce9d212beba904cbb3e53ad20b6a2dcef97d3ad773c6a8a441fc1251ddffea65a157ec25c15f62d1b21e4a424d1f76b3ea0353bf980a8ba7441db730dc1a6f7a5285b9dfd563779fbf008b57dd8d80aed3b264d642ae12bcf47e72916b7582c5295705de411aee688f2e8c5617fa60566e5eaf95b25baade76f1de1abb61bcf9d4597d64d71201831fdddcbe9aeb244fe7d920af8078a69ea078a778d1f28d2e9f60733e9dab34e906c84a54000c2b714a0a3491000011048220210be216eb68899a416be4ac8f1f8d77e86155f993a322f24cda16d83f0d5b1c4153f74e810ad5fbf9e56ac30d7e2b8505915be3fab03a57a5b074ac98aef5e6d05335d89e1194a0cfb5d7ca0d41075a0149f11257ef196f5ab2f51c257faa2b7e15a11d684ade3e32f32f5c3b4f800b05bfb6610a953935d5725a2ac679f21f39166255eb5d56647f8aa956d25885b5882d8299f47ff197f0bcd300a7b7dfcfbe494cda5a5c33ad35cedc1e6d4f40cbaecc25674ceb92de9f453d3d5d674d5395c254600c2b7c450a32110000110484a0210be216ebb88190e9376c517c23762c6c8bcd0336c1b84af8e25547ce5ca95f4e9a79f1a65caaaf0758419913ce3eb12a0ea74e55e3ea72bf3a0bc6272deec1e44eb9e730ea88a52d60fa4abdd221c6e9548e1abf7c9afcf7e36fd446a87af57d43a253f5fa80ec05ac40760797d62095fb59df9b7f5f4e85da3e85d794ed8a9d688a567b4a5ce3d7ad0a5ea59675cc54f00c2b7f819a3051000011048660210be21eebe88996413befab8d55aa6b9e2fb29567c65ea081f497368db207c752ca1e2fbf7efa779f3e61965caa6f055c26ad8cdb4d85a3194edc5bad8bb64b03ae1f80f0d7cc7ed12be4dbad3e2a93751ae7632f3f97f9d46f75dddc8b7ac9f516f57fae2f50bf2d1fb526cc237358d9a3739d1db25573a676f015d3b6214b53bb9ba618f4bf8da273f8717be66e3b9b461f50afa501da8b6e2a32f7c5f83d461e44cead5daff3eba068044910840f816091f0a830008800008c42000e11b03909e2d6286c3645af1d5c70de1abcf08332e7cf41cdb06e1ab63091d976781cba2f0dda744eacdd6eb83489d723c71e1643ab35a45d2b72bfb3d2f2b10f27efa80fadd3ec5105ae91dc7d18c9e2d3c6547a893842f11f798a12e6a65f5d95b685fd662d5e7e70db32e8e8b4df8eadbbe3b4e54633cd3dba5a8e984095fdfe792fd9acea3df76fd48df7cb59a96cc7cc6393ddb777bb75f79d88a4200c2b728f45016044000044020160108df5884b47c11331c2693f0cd17f1c6e3c68aaf3623cca8cc0b3dc3b6093b839bb9122c7905ead52a1ce7ffcbe7b8757018c7f30b389d4f478eb08f4a1bf123b45fbda6e5db2d9ba9d72d5df4e6ca4c7cdcb871465feeb8e38e84f4a934852f6f3d764e08760fe7c82f6b29f3b64cfb153f69d7abd7ddf4315f77c3270ddfae4e1a3677cfb6a619ff1c41e9152bba2b5029fd5548227c8ffca29efbbdcd7cee972883a62c194f4d2b4796fdece527e8f54dd954a54a43ead2ff2f94ae7c74c1ddbcc71475c274d388361d21c9ef1d76c9ef58470000400049444154def55b5cc2d7c542bd5268ceec3bec139b5d9dcbdd47fbf294c57ad590e439fdf5aee68a0751b08fb6d539b53dcd5a7807d5e7ff706b575e6e2e99cd56355e83a465a97f73db6872b781b4c238fccaf96143f7413cb104207c13cb13b5810008800008b80940f8ba79444dd9828505a0fafe5450607e89626dc3b1820a2ac2a1881d3d540e156c7fc7af024b49df72caae95afa01ad4d3dca09976db8d7e18e52cbbed67fa47d4c3ed6bed38f53af5bb84aff2657f1c6e65dc6ad7fd762cc2ce980ca60f84af8e27ee78a9095ff52edac5ea5db455237a9a471b3e58440f4f59a26d898d3c4df845b505da3ca5980fae1a41d3fa5ce21256bf7efd3af51be1bc1e68f893cfd2a5f5f8c46275e0d2bdeac025eba5b969adfbd1cc91d7b8fa7170eb32f56aa199d6ab851c41b6ff9bd7a9db5d4f9a3d4e6d4b339e1fe212dcb9df2da7e1eaf5487c98165f25217cf964659d45f32e636842d773cd0e587f8ffcaa7e44e8213f2264d03425f61b59623f58d43a5504fb443bf199485f214f6d3d90168dbcd2a954c55cc2d787a7cb1989841080f04d084654020220000220104000c237008c9f591788c9247cf5712bd50be1eb991cc24737db36f95101c257c71377bcd4842fa551bb0e6da886f4b4923addf7971df4e9c71fd236ebfdbc92d5edfeb9d4b9a5fbf0235d54b15f6a93f634a06b1baa935a81b67ef22afde3a555529c525babd7fc8c6c6ba7f76df827dd7cf733769ad25bd3903e37d229d572e9ebff2ea3675efcd012bd44fa566a43a8fd49ad504ac9b4f36840df8ed4b45e05daf0e1ebf4842aa75f25237cdd0293db4fcbb89eeee8d98e4ea87484b6647d402fcc5e6a8b71eff3c5c1a2d61949b08f7ee2b3f2571c07dc7219d54d3d895ab46848155c2bf39cdd99fa766a4b27d7a94c3b377f4a8b1f9f49abe5d0ab8c5eb4f8810eae1f209c1e2096280210be8922897a400004400004fc0840f8fa5109b08998e110c217875bc934917921690e6d1b84af8e2574bca485efbc8137d3cbb2241aabb769ad2973fc9dd4eaa42abe9e9bd47b7a8759efe9f575606393eb69d643bda97e25deabe15cdfbefd040d79ec4dc7e0174b5765a7abb2fc1f23ebfaf6edc9aa9c5be04a9e37f40adf21dd325daf56d2fd795576885a9535d0a8e75d23b7816babab3ecfc37ef5ea641a393b46bfd4aaeab4f943ecd55e6e5f17b5fafb7df5be45f3d9b1e209ea37c9cb314dbdeff749e35dc15fbe3481ee99effc08a1d7ebc433d4ab94c6f9bc4ac9f1402c3104207c13c311b5800008800008f81380f0f5e7e26b1531936cc2975779f9e271cb075b9d9d2922f3c2b140f826fa195f9d6db478666666b4ec1879ee539afd9d53293de342baa163076ad7ea54d7f6653fff5fd62da3a98fcca42c5939b49dd2e8aa3e03e9b6ebcf095c45dcbd61393dfef0936ad5d1b3c4ac56a3afeaf957eadef17c32cf3eb62b3522df7dbc98263ff4bcbd8a2ab9e7df30947a5c7a90ee1f31d3d8a6ad1f80a53fe32bef2396721ce61fd8480f741d4eab39e1bbfac95bb46f555bb4555fd536f1e7d436716fdf76ae7d9d1e9df8a4736014d7c5576a3a5df5976ed4f54f17473c53edbcaa28431d1e36de383ccc2ce4fc8dee93475fbc3d9f663da556956d8c4d94907dd816b25b3f799de63dbd80563b0e56e5a974fe0d3da94fb7aba8be5aa9c755fc04207c8b9f315a0001100081642600e11be2ee8bc0e13099567c217ca34f129917ba976d931f0db0d559c713775c567ce32d5034e11b6f2be1fd72b2f7d2fe83eaec26f50c6ff6e163e8f8138f0f14bcdedacdb2b97438e7305548ad416969b5620a6e7e5678d78fbbd4df14aa54a112d54a4ba3aafc087119b8b2f7eea58379ea502975aa544acab1aa6f35e2184fd13b9eab0e86530daaffa983ac7c58189cf79b875df1215bb514e7c867bc8bde0fd4104c00c237980d724000044000048a4e00c23704431133c9267cf571b308e634567c9d89237c1c0b567c13bde25b5605ad7ecf11070110281a0108dfa2f14369100001100081e804207ca3f371e58ac0e13099567cf57143f8baa68491103e7a8e6dc38aaf8e25745c567c217c43a3430110287704207ccbdd2d438741000440a05c1180f00d71bb44cc7008e18bc3ad64eac8bc903487b60dc257c7123a0ee11b1a190a8040b92500e15b6e6f1d3a0e02200002e58200846f88db246206c2175b9df56923f3c2d706e1ab63091d87f00d8d0c0540a0dc1280f02db7b70e1d0701100081724100c237c46d1281936cc297b737f3c5e32ec8b79ef15d83155f993a322f242dac8cb4b04bb2c3ad7416898863ab732228a20e1028db04207ccbf6fd41ef40000440a0bc1380f00d710745e040f8aa155f085f7be6c8bcb00d2a62db207c752c858e43f8161a1d0a8240b92100e15b6e6e153a0a02200002e59200846f88db266226a9852faffaaa0f4e7576268ecc0bc792bcc25767803808800008842100e11b86167c410004400004c21280f00d414c040e842f84af3e6d645ef8da926cc55767803808800008842100e11b86167c410004400004c21280f00d414c040e842f84af3e6d645ef8da207c752c888300088040200108df4034c800011000011048000108df101045e040f842f8ead346e685af0dc257c7823808800008041280f00d44830c100001100081041080f00d0151040e842f84af3e6d645ef8da207c752c888300088040200108df4034c800011000011048000108df101045e040f842f8ead346e685af0dc257c7823808800008041280f00d44830c100001100081041080f00d0151040e842f84af3e6d645ef8da207c752c888300088040200108df4034c800011000011048000108df101045e040f842f8ead346e685af0dc257c7823808800008041280f00d44830c100001100081041080f00d0151044e520bdf7ceb3dbe6b3ef125d7a953275fbbd798b579bbd7546ed3322ff401d836085f1d0be220000220104800c237100d32400004400004124000c2370444113310be6ac517c2d79e39322f6c838ad836085f1d0be220000220104800c237100d32400004400004124000c23704441133492d7c9590e3f1affd0c2bbe3275645e489a43db06e1ab63411c04400004020940f806a24106088000088040020840f88680286286c30a1558dca83fea626dc3b1820a2a62a47d42e550c1f677f22ba892fee5945d4493d19e3bcd0d9af96ebbd10fa39c65b7fd4cff0aaae37abddc7357dae36f8c4ceb07fbf207c2d7b8d5aefbed58e4de1893c1f421e666da6ddef9f9064b9543f91cb7b691733cbf80d3f974e408fba8b4113f42fbf7eda36fb76ca65eb774d19b431c04400004ca3d0108df727f0b31001000011028d304207c43dc1e5bb02805934cc2571fb7926ea6f0fd142bbe3275848fa439b46dac76390de16b70c01f10000110082200e11b440676100001100081441080f00d4151c40c8710be10be3275645e489a43db06e1ab63411c04400004020940f806a24106088000088040020840f88680286226d9846fbe883716fc58f18d9831322ff40cdb26ecb0e2abe3411c04400004220840f8462081010440000440208104207c43c0143193d4c25709391e3f9ef175268ecc0bc782155f9d05e220000220100f0108df7828c1070440000440a0b004207c43901381936cc2571fb752bd10be9e39237c74b36dc38aaf8e057110000110082400e11b880619200002200002092000e11b02a288190e93f6195f08df881923f342cfb06d10be3a163bfedb6fbfd1a64d9b68ebd6adb46bd72edabb772f1d3c78d0f851a54a952a54b3664d4a4b4ba3860d1b52a3468d8cb85d1811100081a3920084ef51795b312810000110283304207c43dc0a1133c9267c7995972f1eb77cb0d5d99938322f1c0bb63aeb2cf4f8575f7d452b57ae24fe0f0fbf5a2bdeab7efdfa74e18517524646061d73cc31f116831f088040392200e15b8e6e16ba0a02200002e59000846f889b260287c3645af185f08d3e49645ee85eb64d7e3448f2c3adb66fdf4e6fbcf106edd8b1c3c6c402563e2c824508333bfec8bb8b8f1c3962a4b960eddab5e9aaabaea2a64d9bdaf52002022070741080f03d3aee23460102200002659500846f883b236286c36412befab85904731a2bbecec4113e8e052bbec28245ebbbefbe4b1f7df4916162715ba95225e3233ef184870f1fa6bcbc3c430cb37f8b162de8eaabafa6ca952bc7531c3e200002e58000846f39b849e8220880000894630210be216e9e081c0e217cf11e5f993a322f24cda16d5373c54827e18a2f3fb3bb64c912fae69b6f0c06292929c4cfef16e53a74e810f1870574bd7af5a85bb76e54a3468da25489b2200002658400846f19b911e806088000081ca504207c43dc58113310be58f1d5a78dcc0b5f5b920a5f16a70b162ca0efbfffdec052b56ad5843d9bcb5ba07373738d1f17ead4a943bd7af5a26ad5aae9f811070110288704207ccbe14d439741000440a01c1180f00d71b344e040f842f8ead346e685af2d09852ff358bc78317dfdf5d7c6ca6c6a6aaa11ea7c58bcf28a3087d1ae8a152b1aabc41cea17b7c1e297cbf3c157b7de7a2bb63deb80100781724800c2b71cde34741904400004ca110108df10374b040e87c9b4d5999febe58bc75d906f3de3bb065b9d65eac8bc90b4b032d2c22e89b63af333bdefbfffbe317c5e899543ab743e3939393145aff8b3e865f1ecbd983bd7c3213ff3dba14307af0bd2200002e58800846f39ba59e82a0880000894430210be216e9a081c0e217c217c65eac8bc903487b62dc9842f7f719d356b9631fe68db9bf7efdf6fe0caccccd4b145c4c78d1b67d88e3df6d8883c36f08aef8103070c71cdcffb3669d2c4d70fc6f0040e646fa77933e6d24f070fd1efceb98efa76b8287c25a550e27faf3e43af7cf22d55ae528f7a0dec490d6a601b7c29dc86423509e15b286c2804022000022010270108df3841b19b8899a416be4ac8f1f871aab33371645e381667ae285886595133a2ec2bfe054ab4196995c7024e56d3399e5fc0e97c3a72847d54da881fa1fdfbf6d1b75b3653af5bbae8cd9599383fd7bb65cb168a759055a2842f0f9c9f27e6539ff979dffefdfb17fa59e2c3877fa3a7460fa477bfcba7aa55dd5bab0dc0ea60ae5aa9c751da898de8e27697d395179e5566b8174747766f5f4d23068ca7ddaaf29a1775a7f9a36e2a8e66125ee7cb93fad1bc15fcdaacea74cff4697471c3e313de062a2c1e0210bec5c315b58200088000089804207c43cc045bb028f192b42bbe967083f075268ecc0bc7929cc277dbb66df4f4d34f1babafb10e9b4aa4f065eeb275fac61b6fa4b3cf3e5bbf1571c759f84eedd79d3e66a517cf55b725dd3f7608b56c58271eef72e7b3fbc7d534faafe3892564fdd63d69d6c88ee5620caffe7d30cd7ef73bd5d7baf4b79993e9bc0675cb45bfd14922085fcc02100001100081e22400e11b82ae081c0e217cb1d559a68ecc0b497368dbd45c31d249b0e2fbd24b2fd1ba75eb8c77f4c67abf6ea2852faff8f2ca6f83060d8c539e0de821ffb0f09da684ef8786f0ad4c4d5b9c41c7a95730e51fcaa78a952b52ceaf3fd3a64ddfd12157bd7569e0f83174e5d927bbac474302c2f768b88be56b0c10bee5eb7ea1b72000022050de0840f886b8632266207cb1d5599f36322f7c6d49227cf984e6a953a7525e5e9ef16a21bf03ad743e8916be5c37d7c9f762d0a041c6b667bdbd78e22ee15bf7125af4d4504a3de61857d1830776d37f16cda6a796aed0ece974ffac71d4b2fed1b5f20be1abdd62444b8400846f896046232000022090b404207c43dc7a113810be10befab49179e16b4b12e1bb71e3465ab87021059dc0acb3e17871085f7ebdd1912347e89a6baea1f3ce3bcfdb64ccb44bf856bf98e6cebd8beaaae77afdae2d6bdea0f1636619cfbf727efddfabadc0c3fcb7021fd8bd9d3e5df339edd87380d4c3cf542db5069d94de985a9e798aabeac3b9bfd18f3fee56cf2be753ad131b50dd1aeeb60f66efa6ed3feea58a952ad2b1754fa0138e731ff8c5e5b7abf27c1d97769251fec8911cfa7eeb0e3ac2b67aca56ad0a6dddb086bedcb095b2d54a36afcc9fd4f80c3aefac464639fd4fbcc237def1e9754b7cff9e9d9495b5967efce957ca23c5a6460d3af9d4d3e8aca60dc4c537e47bb576e57fe95b55ae72e56a54b36e1d6ad8b81935523f3ec4b3d5f9971fb6d0175f7c49bbb20f180c6ad63d91ce38f34c3aa1b69ba96fe330161b0108df62438b8a410004400004140108df10d340040e842f84af3e6d645ef8da9244f82e5fbe9c3efcf0c3b8b63933a7e210bebcdacc2bcf191919d4b1a3bf08d5ef9137ee15be0b9e1946c755aae475b3d39fbef277ba7fcebb56ba314d7e662c35ab7d9c9dcfa2f3f52727d39c37fd1f0ba0ba19ea19e161f633c25f2c7f9cee7bf4ff8cf2f52fef4bb3eebcceae8b231f2e1c47931799755539a70bbd30b6ab2bffd337547f66bd6bd89ade3898a6dcf607dab5f563ba73d043b44f59ffd877201df8bfa7e883ad075de53851a5616b9a34610035aa59ddce8b257cc38ecfae5845727377d2fc4726d0ebffe567717d2e66335eb1f95de42afa971fbd48931f5e60ffe8a0976edb731835ddf90a3df5ef8dca1cf98cefbe5fb6d0eca90fd13b59fce472e4d5f4d2ce34feaece112bfd919eb014070108dfe2a08a3a410004400004840084af908823148103e10be1ab4f179917beb62411be8b172fa60d1b365015b542ca273ac7ba8a43f8f2c9d77cc855bd7af5a85fbf7eb1ba10911f56f8b2789bd2bb2fad6255a9ae3f0e9c40775cd9dc88735d8f0fed43cb7d44a6e160ffa94b43a74ca0cb9a9e44bfec5843a3fa8d310e93a2fa97d3a2c707d902aca0208f660def46ffde6489d6eae7d3537386d30955abda352d51a7193f6b9c665c997adf3f956e68d99074f16a3b06453c6dea65bd875b15667cd2ecc183bbe9b1c1bde8437fed296e2a3c8da63d97498daa3b62fcd3371fa7fb9f307f1cd01c03a26ee17be0c0767aa4ef00fb7e1985d48ab77a38dc55be668b8e347f5c4f970d89922100e15b329cd10a08800008242b0108df10775e040e842f84af3e6d645ef8da9244f83ef9e493b463c70e4a4d4d35b63beb2c7825960f9f6261eabde27d8faf5e8eb75357522bb15e81cdf781dfe9cbef0fbefbeebbf52271c5c30a5fae74e9d47e34f77d53c15d77e703d4f7f20ca32d7d75960dadaeef4d033a5f4175aa57a6ac95cb68d623b3689be82d6b5b75ad947c9a7e47177ac7a82e9d1e9c3b81ceaa5bcba8efb73d5fd3d85b47d06623c57faad3c087a7d095a79d6858584c4eeed5cb1475953368e6bc7ba941b56a3ec2b72e7519dc8f6ebcf43ccacfdd4dff5ef0182d58f6855d6bf7fb1ea19bce6f6ca4a309dfc28c4fb68d67bdf314dd3bed35abcdbad4fdcefed4fee2e6746ca5025affbf7768d6438a8d95dbaacb50caec7a99916206a31503c9a3eaa7d1d0bbfbd205cd1ad0fe3ddb68e1f409f4d6fa5fad921cb885ef17ff512bea332cd1ac5694ef19de872e3eb391da1e9f439f2c5f4c8fcef8a7b1326ebc06699a7a0d5223bc06498359225108df12c18c464000044020690940f886b8f52270925af8e65beff15de3bf7db353a74e7111cddabc3d2ebff2e024f342efab6d4b12e13b63c60cfae5975f2284af6c3fd6d9e8f1c2085f29efb7bacc2bc92c8cefbbef3e718b3b2c8cf05dadb63b8fb7b63b37bdfaaf34e5af572bf1bd9d26f51c406b2c61dbb6f7dfe8ae1bdccf1cefddb98ec6f51d6d0bd93f0d9d48b75e7626bd35e73e9afe8a2944bb8c9e425d2f6c6af47fe38a85347cd222d7585a7519a144e125868db7348f545b9a77ab54cd167f512b96371b765dbcb2a0eb37e161baa6f9ef5cf52c99a0568a5799e2fd8ffdefa73bae6a1951565ff12dcaf8b8e22d9fbc41f3feb9423dd34b74d6155da96b5bf7fb90bf5df5220d99b0c0e883fefee0ffbd38891e58601d2a56bd254d9b35c2b51acc0516aab12cb2c6e215beef2d18478fbc68fe77ab79d75134a1cb45461bf2e7c3971ea77f7da2febb742895ba0cba83ce3b19af411236251542f8961469b40302200002c94900c237c47d173103e1ab567c217ced9923f3c236a8886d4b72e1cbcfdcb2f82dec81533a5389af5ebd9ade78e30d63c597c5af7e95b4f0d5572f45a46dfde20d1a76df2cf3b547752fa605b3fc9f15fe5009b1c99610b3cbae7985868d9963941521cde37bf531f56edab7d5f3b0d5d3a9498d9db4e947b5e5b9f155f4d2d4bf528a7ab79abe9ad9566d97beeb9a730d2cbaf0d505b1ce4c1f832e70f5b2babd28e3d3db0d8aefddbb8e46f61ced7a7f306ff59ea3b67abf6a6df5d605ba5e8fde67aff05da184f3244b38d76c712d4d19d9834e38b6aa5e1cf1522600e15bca3700cd83000880c0514e00c237c40d163193d4c25709391effdacfb0e22b5347e685a439b46d49227c83b63aeb2bbeb7dc720b9d7aeaa93aa6d0f16fbef9869e7bee3983af77c5979997f456e7356afbec186bfbac08d5acb7d456dee9e6565e5d307a07abafd28a1fafa63ea0568bb378b538fd0a5af4e81d54316f2ffdbd7f2ffa582de7f2e9d1dd4ecaa2478c43ae9c03b55e56cff7ce339eef756fefd58560d0c9d35b35b12dfde0bebacab656a7568f340f0c2bcaf87406bcc5f8bb8ddfd0f73ffe40d9d939b427fb17daffeb01dabde31bfa74ed4643fc4b7f78357eaa7ac73233f00a5a6f9dce7671378b6ffebb90ee7a505f35e777359f4badce539fb39bd3a9279f68fc88a0d78778c91280f02d59de680d04400004928d00846f883b2e628643b5c8a2be7cab3fea626dc3b1820a2a62a47d42e550c1f677f22ba892fee5949d2bb6eae3f7a2ea696ed04cbbed463f8c7296ddf633fd23eae1f6b5769c7a9dfa9583dd0ff6e50f84af81c4e6e2a4cc9830b5d9117333994a5e817ae6d5e0a9f2f8f9d7026b1b39c7f30b389daf9e3f641f9536e24768ffbe7df4ed96cdd4eb962ede264b351ded702b59f5e557e7f4eddb97ead62ddc16d2ddbb77d3ecd9b38d939bf9f95eef6a2f332ac9c3ad18b8f3ea1c2279c6575f410d5a99e4b2bab024edf549cf65f6a017d6f2b3aa8dd573be9974c2fe2fed6dccd7ddf9105d537f0bdd798fb9a2fca7110fd3cd179ee88842f5fee105b3eeb44fa3d6db1011c96deb977ea896ee1354b6a8e3e3b657befe144d7ff235eb995abd37eeb8f4c7bd0dfd7cf5aaa91181af9a72ee895bf872cd6f3f37891e7b417f07b3d65ee5bad4fa8a6ba8cfadd707d6ad79235a0c04207c8b012aaa040110000110b00940f8da2862476cc1a2144c32095f7ddc4aba19626deda758f19519237c24cda16d63b5cbe9a35cf8befdf6dbf4d1471f05bece48deb15bbb766dbafdf6db2344ab0129ca1f16cfbcaabc67cf1e3ae698638c03acbceeb2ba7cd65967d19ffffc676f76ccb45b5ca92dca315e6764f80fec6e9f4efcc781eaf9d82b5b922e0cf5e770bd1dd085a57e8ab3fe5aa2eee36650d3ef5fa4cc59efaae2e9ea7545e3a8d97107ec55e193ffd08fc6763d8986f719633cdf2babced296de868848c99330c827c85ed4f1e95b8ea50f55d4fb7b6bd7aa45358eab4395f67f4bebbf350fa9923ebbee8d3abc6bdad3a3229eef95ba8256bf257fe7d675f4ce7fdea3152b57d2b73bf5c3b02c8fbae7d3cc19438dc3c1a40cc2922100e15b329cd10a08800008242b0108df10775ec40c8710be10be3275645e489a43db9624c277e3c68db470e142e360293ed9d9efe2d5585e953de59453a87bf7eeeadf10ef4f887d31cb050b16d0b7df7e1bb57e11d7857d9ed825aed40a6c2ce1fba53a9df81efb74e2fa4a944ea496f5eb90be15b866ab6e343fb3b3ef207fdcf01f1a7ef70c63d5b3feef7bd1ac611d0c3f7d0b74ab2e03e9b48d0be8f94f9440b3b63ea72ae16f1f48a55e41746fb75af4c023ff34caeaa732b32148bc1aced69f209f207b51c6c78ca7deaab62c5baf806adebe3bddd543adb0d6709ed5f67bc6974fadfebb3ab5da2c579d863ef2085dd6b89e3e0c236ed41fc796682978207b376dddb285def9d77c7af393efc4ec7a35956d44a4d80940f8163b62340002200002494d00c237c4ed1731c3613209df7c116f3c6eacf846cc1899177a866d137647f98a2fafc84e9d3ad538c8aa9a7a8d8e9fa865262c7e396cd5aa155d7bedb53ab2c0381f64c5075a719d2caafdeae6c27cb015d73d68d020aa53a74e607d41195ee13b77ee5d815b5e777fb79ac60c1e6fbf5aa7e6454ae08e3205ee4f9bdfa3a1431fb1b6f146be8b56dad75f85a40b5fbd1f554e6c4227646fa26d4a2836ef78274de879b951dc119f7529e3f44a94f5159fca1cd9569078953e7018e413642fcaf8766f5f4d23068c3756a7797bb7df8f0b1b3e7c86ee9e6c0a7959f1e57e3e374e6d01e71f00d4a5b3300cd69fefbf7cc3de06ee7d16b8401db296ab5eaba5b60c502abfbfd773e9a73e9ffc873eea5dc3d77b3c902c6e0210bec54d18f58300088040721380f00d71ff45cc7098b4c2578d9dc78f677c9d8923f3c2b124df8a2f8ffda5975ea275ebd6056e77661f790e97e3f1acccca09ceeceff78e60b6f3c5ef093e74e8103568d0807aa995c1c25cbae024f5aceca2a78612afaeea179f2efcc12b4fd3acb9faf3a975e99ee993e8e286e67b5fb99e996a0bb4f93e5e752055eb2e34f3ee2eae8393be5ef922dd3b718179f2335556efe47dcc7e272fb7f7ef7f0ca77ffc7ba3d67465f52aa269f6ab88f4e772c5a9cae937d20b936e93a411068957dd29c827c85e94f1f1bb7827a877f16e303a603ec32cef2a6613e74f1a3882b2ac15615df8ea5bac59d40e7c701c5d7956037b287c30d8230307d02ae3002c363bcff8baeeade2adb3940ade5ba85e77641c1aa6debbacbd3f58f211163f0108dfe2678c164000044020990940f886b8fb2270924df8eae356aa17c2d73367848f6eb66d8a175f47fb33be3cc66ddbb6d1d34f3f6dacc8f2aa6fd025cfe2727eb4939ea39de0ecad5bb651df78e38d74f6d9677bb3e34abbc551756afd870ba9863a44cbb8547868f70efa5c3ddbbedb7a3faf54faa72113e8d676cd2569846e914654e5c473a8efcded29ad7a65fafc837fd1cb6f9befea65673fc1aabfcbd6a8b0724b7a6ac1283aa1aaf9fa1d3e11f9f1215de8ad6d46aef1a775f77b69e44d173806150b12afba53904f909dcb16767cdcef47fa76a10f459c566f4cbd6fef488dd36ad3b7eb56d04bcfbd66ae065b1dd4856f6eee4e9ad2bb2fadb244312901dbba4367baeed20cdaf5f567b4f09945b4c3756f1ce1cbd52d562bc6c69671a3eebaf4a7db6ea12b2ecaa0fcec5df4ceab0be9e5f79c7ba2bf43d9ea0a82122000e15b0290d1040880000824310108df10375fc40c87c9b4e2ab8f1bc23772c2081f3dc7b62591f0e5f1cf9f3fdf7816d7efd4659d4fac939e639de0acd7c52bbdbce2cbdb9bfbf7ef6f1c7ea5e7c71b67e1ebbc32278e52d54fa37b3287d2c5a7d5f7755eaeded3fba8f59e5e5f0736d65707294d510729d570ff50f0db6f5fd3d8ee2368b355b07eeb5bd4eb843ab9aa7967de7d34ed65116b75d573af13239e7b65f13ae2afe6d6625d44ea1505f9e8db92fdca16767c1b572ca4e193f4d70ae9bd71c7bdedfeb4f13dca1cfe88f18e5fb7a7a42a5375b58e6e6a63f74afc2fdfafa109778cb1994a096fd8f48abe3465d0755e33d2254000c2b70420a3091000011048620210be216ebe88190e9349f8b2d8e58bc72d1f6c7576268ecc0bc7929c5b9d79fc3ffdf49371fa3233a9aa5627f904e6a04b0ea3f29ef41ccf09ce5227b7c3cff6f273bf5dbb76a5a64d9b4a56e8d058f1d54e69f6afa032d53ff52cbaf6c6ebe99adf9febdabeece7bfe1e35768fa8c39c633baeefcead4f6a61ef4d76e57446ca716bf79eab5462f1baf35725e9524791cea876351dd8b69ee1391cf24ebabb6de139fa5ae201fde4e9dd96f8cf11cf3c96dd533af77453ef35ad8f16df8df1bf4e4ac6768d3cf07a51b46583fe37a1a73d7ef695a7fb51d5aaddefab5fbdb4f5fd3ac0727d087d6c9cf524195b4d369c0f0817478c52c9afe0aff20609e82cd078ec9b5ef972db4f8a939f4e68a2fac6de692a356de55f95bd42af00d97b857ef1d0fc48a9b00846f711346fd2000022090dc04207c43dc7f11381c42f87ee24bae5327f7aa94af9332666dde1e9455eeec322ff48edb363557f84a86adce32fe77df7d97de7fff7d231974d095f8ca16e5534e314f7a667b3c2738b31f3366f1cccf0d376fde9cfef4a73fb1b94c5ed97b7753ce213517f27369ffa18a54ff77f502056f991c408c4e15767cbffdbc9372a922e5656753feb1b5a9c109b562b4e464ffb66727fda6747355b51b3dff98aa7442ede39ccc1831de72bd677736e5aadd027ca556af49756bd588510ad9c54d00c2b7b809a37e10000110486e0210be21eebf88190e9349f8eae3e6d55f4e63c5d79938c2c7b124ef8a2f33601e8b162d227ec551ac9398d9573fe999fde339c199cb89e83de184138c03ad2afb9cd4abdf13c4410004ca360108dfb27d7fd03b1000011028ef04207c43dc4111381c42f862c557a68ecc0b497368dbd45c31d247f9eb8c8c416a7ff8b95b5eb9fdfefbef0df15ba54a95c06dcffa49cf5245b4139cd99f452f33e66dd2bd7bf7a6688769499d08410004ca360108dfb27d7fd03b1000011028ef04207c43dc4111331c42f842f8cad4917921690e6d5b920a5f66c0cfeabef0c20bb465cb164e52b403af58cc1e3972c4f0e3e7822b56ac68c4bd7f5850f3875786ebd5ab47ddba75a31a35b045d5cb096910288f04207ccbe35d439f41000440a0fc1080f00d71af44cc40f8167dab7308ec65de55e685de51b1e921c7e5c3be2cf624cd71494b9c43168392e6d70065ab6721376cd840575e79a5de5c998d73ffdf79e71d5ab16285d14716ac952a55323e613acda736f3f899055f2d5ab4a0abafbe9ab0bd390c45f88240d92600e15bb6ef0f7a0702200002e59d00846f883ba88b98645af155eacca06488b47ceb19df35455bf10d81bdccbbcabcd03b2a363d34f859e2977d59c4894dc42da725ce617917bec284b73cbffefaebb463c70e31195b9f79159857775910f3872f9d098f9f3f6ce38bb736fff18f7fa466cd9a1969fc010110387a0840f81e3df712230101100081b24800c237c45d912fdf1c42f842f8cad4917921690ec5a6871c970ffb2493f0e5f1f2f5d5575fd1ca952b89ffc32342d7cc89feb77efdfa74d14517d159679d15f8ac70f41a900b022050d60940f896f53b84fe8100088040f92600e11be2fee922266985af25de8a7aaa7308ec65de55e685de51b1e921c7e5c3bec9287c85d1debd7b69f3e6cdb46ddb36e22fbbbffefaabf14c30f3e183b08e3bee384a4b4ba3f4f4746adcb8b11197b2084100048e4e0210be47e77dc5a840000440a0ac1080f00d7127741103e18b155f993a322f24cda1d8f490e3f2619f6416be3c7e5c20000220a01380f0d569200e022000022090680210be2188ea2206c217c257a68ecc0b497328363de4b87cd807c29729e002011000019300842f6602088000088040711280f00d4157173110be10be3275645e489a43b1e921c7e5c33e10be4c0117088000089804207c31134000044000048a9300846f08baba8881f085f095a923f342d21c8a4d0f392e1ff681f0650ab840000440c02400e18b99000220000220509c04207c43d0d5450c842f84af4c1d991792e6506c7ac871f9b00f842f53c005022000022601085fcc04100001100081e22400e11b82ae2e62207c217c65eac8bc90348762d3438ecb877d207c99022e10000110300940f8fe3f7be7026663b5fff1af61308331a3512e0d11527184a874211542379292529192a2cba89474d2c529fa9f5c224a2ea124518ec839742195bb72cd251129721bc630b7fffabd7bfff65e7b66cf654fcd98bdf7f77d9e77aff5ae77bd97f559cbf3f8cc5aef5a6c09244002244002854980e21b005d5b6228be145f6d3ada2ef458424db34389eb2e7928be42811b09900009b808507cd9124880044880040a9300c53700bab6c484adf866b8e46ddd5a8aaf361d6d177a2ca1a6d9a1c475973c145fa1c08d044880045c0428be6c09244002244002854980e21b005d5b6228be145f6d3ada2ef458424db34389eb2e7928be42811b09900009b808507cd9124880044880040a9300c53700bab6c484adf8bae56ddd1a8aaf361d6d177a2ca1a6d9a1c475973c145fa1c08d044880045c0428be6c09244002244002854980e21b005d5b6228be145f6d3ada2ef458424db34389eb2e7928be42811b09900009b808507cd9124880044880040a9300c53700bab6c48493f8dae5364ae7c8dbbad5145f6d3aca478f25d4343b94b8ee9287e22b14b891000990808b00c5972d810448800448a03009507c03a06b4b0cc597e2ab4d47db851e4ba869762871dd250fc5572870230112200117018a2f5b020990000990406112a0f80640d796987012df0c236cb249f94bb0c7375b8bd176619fd0343b94b8ee9297e26b13639c044820dc09507cc3bd05b0fc2440022450b80428be01f0b525266cc5d72d6f9cdccadb70b45d7853d8e36bb3609c04488004f24380e29b1f4acc43022440022450500214df00c8a9e048184ee26b97db74593abd96145f6fc3513ede148aafcd827112200112c80f018a6f7e28310f0990000990404109507c0320a78243f1cd04c5d7db70b45d785328be368bfcc4535353b160c102e78f2ad75f7f3d222323f37319f39000098410018a6f0855268b4202244002c59000c537804a51c10937f1955e5ed9a4dcba537cbd0d47db853785e26bb3c82b7ee8d021cc9c3913fbf6ed73b256a952055dba74415c5c5c5e97f23c0990400811a0f8865065b22824400224500c09507c03a814151c09c369a833c537f746a2edc2cea569762871dd252f27b702b66edd8ad9b367232525c5c687b265cbe2965b6e41ddba757dd27940022410ba0428bea15bb72c190990000914070214df006ac1969870125fbbdc22c172cc1e5f6fc3513ede14f6f8da2cfcc545fa972c5982afbefacadf694f5acb962d71e59557222222c2491b326488e79c46060f1eac5186244002414c80e21bc495c7572701122081202040f10da092547024a4f8721d5f6d3ada2ef458424db34389eb2e79c2b5c73739391973e6ccc1b66ddb04439e5b9d3a7570f3cd37233a3a1a14df3c71310309042d018a6fd0561d5f9c04488004828200c537806ab22586e24bf1d5a6a3ed428f25d4343b94b8ee92271cc577efdebdcef7bc478e1c11043e5bc992259de3f4f4749f7439a858b1a2f3ddef3befbc93ed1c7b7cb3216102090425018a6f50561b5f9a04488004828600c53780aab22586e24bf1d5a6a3ed428f25d4343b94b8ee9227dcc477f5ead5983f7f3efc896d4c4c8cf34daf70916f7e8f1e3d2a519f4dc4d8dfb5145f1f4c3c2081a02540f10ddaaae38b93000990405010a0f806504db6c48493f81a5b732839d296e1fec6772dc5579b8eb60b3d9650d3ecd0e1e7965fc9132ee2ab4b15ad59b3468a9d6dab55ab166ebcf14667422b3979e2c409cc9d3b173ffffc73b6bcfe1228befea8308d04828f00c537f8ea8c6f4c02244002c14480e21b406dd91243f1a5f86ad3d176a1c7126a9a1d4a5c77c9130ee29b75a92229b7bd5d7ef9e5b8e28a2bec244f7ce9d2a5f8e69b6f3cc7394528be3991617a5e04f67c3b031317fd0294ae821e8f76474269d7246a795dc7f3854380e25b385c795712200112200117018a6f002dc19698b0155fb7bc7156676fc3d176e14da1f80a8b9c962a927365ca9441c78e1d211357e5b6c90458fff9cf7f70f2e4c91cb3517c7344c313791058f5cec3183277b7c9158fc153c6a36945d777e6795cc6d3854480e25b4860795b1220011220018700c5378086a0822321c5973dbeda74b45de8b1849a668712d75df2846a8faf942bb7a58ace3cf34ce77bded8d858c190e776f8f061e7bb5ffd4f71d60bb22e7994f53c8f492027023f4c49c473b3b69ad309183265041a517c73425524e9fa6fbc5ebd7a45f23c3e84044880044820bc08507c03a86f5b6228be145f6d3ada2ef458424db34389eb2e7942517cf35aaae8c20b2f44dbb66d1119192908f2bdc977c29f7ffe39366cd8e0f79a73cf3dd7916959f2881b09e49700c537bfa48a261fc5b76838f3292440022410ae0428be01d4bc2d31145f8aaf361d6d177a2ca1a6d9a1c475973ca126beb92d55141111816baeb9064d9a3491a2fb6cafbefaaacfb11e3cf5d4531af5843233f4a2458b1c769e447744973caa56ad5ad6533c2601bf0428be7eb19cb6448aef6943cf0793000990405810a0f80650cdb6c4507c29beda74b45de8b1849a668712d75df28492f8e6b65451f9f2e59dded89c8454c437eb77ba43860c813ff1156e7bf6ecc19c397370ecd83139f4d964c9a3f6eddba371e3c63ee9811fa461ef4f1bb065e7af484e05224d4f724ccc99a873c105888f2a91ebed92f7efc6c6cd5bf1fbd1134ecf76cc19d551c70cdd8caf907b2f7766d201ac5bff03f61c3c61ee1f89a8984aa855a71e6a558dc9f579a9e6ba2d5b3661efef4791ea5c570109e7d447dd84383fd7a5e0b7ddfb9166cec4554d40f95252ce75a69c7f9a72a6e28c739ae1d20bcfb4ae4bc12ed3cbbe7d8f9c170e3138fb9c7351af566594b272658fbaefbb751f92cd3b490f7fcc59357151a3da289b3db34fcaa1dd1bb176d3cfeee755743fafaa795e1af6effe0d292677546c951c789a3c3fffe4d4db11f3c29191a6deceaa8efaf5ea22d64fbde54f7c0b5a9682b2f3c111560714dfb0aa6e1696044880048a9c00c53700e4b6c4507c29beda74b45de8b1849a668712d75df28492f8ce9b370fab56656f13356ad4c04d37dd84dc8620072abec24e86547ff2c927d8b56b971cfa6c4d9b3645870e1d7cd2023938be7715463f3704cb0ef8bfaa75af97d0ff8686d94e6624efc607a35ec58c65325952f6ade18d8f6350cf967ec42f0d2b3efe375e9abc34fb452625aa4e1b0c1ed40717c4f9ce389c99790073c7fe0b133e976f54fd6c09ad30f495feb820c67b5dfa9155e87df71048d1daf5e987949923f1a555cea836cfe083be97383793198f87fe6b3afc9626aa01125f1d882b6b96cff6e09386df1b39f133d7f57f79005a9f9bfdfb6e29cfacd7fe89f7fcf18b6f85579ebf0aef3e3204dbcc13a3da0c36efd9d4e7d97fac9b8757878ec736f9bb819fcd5fbde525be052d4b41d9f979edb04aa2f8865575b3b02440022450e40428be0120b72586e29b5d720465972e5d02201a1a59b55dd8a5d1343b94b8ee923794c457ca3575ead46c6bef0e18300032cc39b7ad20e2abfc860d1be6736b5913b87bf7ee66f2b9dc7b657d2eb20e0eaf9f8d1ecf4eb252fc47136e1880377a5de1e9f5ccccdc8709bd1ec05c4b221115258b12fbdc20bed56398f0582b2bed183e79b117de5de99bcfcae08ed6c1e089afa16925d7acc3999987f17e620fcc100bcc756b81d1b30720c15d07e9c7d7e1c96e831d79f47759fc0d834d399a62dfb277f1c0ab9ff864c95e9c78248e7f13579ee5edc33dfed33cf41c301e7995e69ed726e396f3bcf22bfcc6187e0b6d7e3e4ff73d4830ef39dabca76e87d7cf30f5365d0f730cafe8370203ae39c7733e37f12d68590acacef352611ca1f88671e5b3e82440022450040428be0140b62586e24bf1d5a6a3ed428f25d4343b94b8ee922794c457ca234b0ebdf3ce3b484a4ac2a953a72429c7e1cace49f74f41c5572e976b652b5dba342a54a8805ebd7a394b25398901fe6464ecc6b05b1ec632bd2ebe05063e7b3f2eae5d099949fbf0d587a331ead31ff52c6efae704dcd738de393eb4e65ddcf34fb7289a9ed6c14ff640d31a95ccb914fcb2f2130c7971bad3cbea2c9b33d12c9be316d85f170d43df91de9ede66b73f89076f6e8ef8c87433c4f86b8c1bfa26d6ab455efc30663d779d23db87d74f35a237d3fd2e09e83df871b46c54c319babc67fd328c797604d6bbcfdab2975d7ca3d0ae573f74bcb42e4aa5a4202afe6c542c7bc4c86f0f8fc4b7ee35083dda5d8cd8c812483ef4333e1bfd12de5be932d478d3433cc1dd432cf2fadacd0f78f84535b801831fbd0df5e2a29deb66bff11c3ef614a615c6cd791455dc7fa0d8f47e229efec0db73ed3cf3da8bcc33d3b17ded7cfcfbc5493e3dcfbee27b0c937bde898fddd29cd0ea3e3cd1fd6a24548e41aaa9b76f7ceacdf70f0139896f41cb227f9028083b7755857d40f10dfb2640002440022450a80428be01e0b525266cc537c3256febd6527cb5e968bbd0630935cd0e25aebbe40935f19532fdf9e79f12e0cd37df74c29cbed3754eba7f545eed348907726ddfbe7d9dcbcf38e38cacb7c9f7f1beaf47e081d717bbf2c7df8071eff4f48899de64d3a72fe1e9092b5c8775eec2b4d76f457973b473c130f41feb12d8668fbf83412d2beb254eb86dd1bb98f4ed5ee3c1e5d1e5f147d0c888af0ced1d73474f2c748b6d6bd31bd9dfea8d940b7d45d52cb933dd2cb953ae248e6d5f8c31ef2f83fc79e1c28e7d70cb45bee53eb9631e6e7b6cbcf36cedc5cd7ebf78f41d35126d6a9473f2e94fc6a99f31accba36e816d81c9739e44acd5832ee727be360df2b56d850bbaa27fa786cea5fb968d35bdc40b5cb7b1d8e87d816398fec49d9e5eea7683c6a14fb32ae6df81ef1f1c6e32e9f799747b4b3ff81dfadf3bd423bfbee29b8245ef8ec2b707cc5acfa5ff8187fbdfe0f3be30df067ff26c77bceb48778259af778467bdde9cc4b7c06529203bbbace11ca7f88673edb3ec2440022450f80428be0130b62586e24bf1d5a6a3ed428f25d4343b94b8ee922714c557ca259b4c4e255b7ee4d5c958c01f95e6ac9363057ebb34fcf7d5ee18bdcc65a15d5e988cee177987e2eafd7c25cd2b51bf1a69eeeb96e6f8560fe0d587af37bdb6b90fb74ed9b318f73c34c2352cd888f66423dab660ea33f7ac5d82b57fc8445967a079ab267ef3685e0d3332b662c02d89ce90665b126d91b67b6bf53a09a5b7f38d3b1ec0970e0ad39bfcca6074f099f0caceadf1347cf9ea03f8b7f361b40c811e678640679ffe2a6dfb6c747e7c9273910af97123e9dddc928e3a5dcd1f13ba397f4cd03b6bb869d6203c3dc5d5e36e9749cfe7166e353dca894e8fb2ef7abdfec5b7e0652918bbdcde3cbcce517cc3abbe595a12200112286a0214df0088db1213b6e2eb96b7756b28beda74b45de8b1849a668712d75df2507c85c25fdbfe3ef135c3651f36c3659d999c7ce528eb1bae7ae7610c992b19bde29b6284aeab5be85cf9a3d0f0f2abd0f4e2c6b8e8fcfa48a81ae7f91e58ef7778ad19aefcbc6bb872a022a7f790a1d4bffdbc1b7bf6ed3343cc4fe0f0f1433876e838920eecc0d7dffce848b57d6f5b7ced74effd2496824f9ee88a77adef87a3121aa0e5254dd1b8c945a85f3bc1cc90ec3b43b50cf19d628647eb70e38637de8d4b2b459859a6ed2d1219a6e7768a7bb878c20dcf98ef742f810f874e4330ba4723fb224ffce4ae79e8f188ebfbe19cdefdc4e17dd8fdcb1efcfee7113301da11c3e3388e1f4fc2f66fbec2fa0362f2be75eb4f7cff4a590ac2ce53404640f16523200112200112284c0214df00e8da1243f1a5f86ad3d176a1c7126a9a1d4a5c77c943f1150a7f6dfb3bc577ba11df19e2b3b9f4becadb7a65093edff96e5e30024f8d750f95ce5aaca804b4bef936f4e87aa5a7c7d6fe4ef7a641e67be166aeef85b35e9ad3f12fdf4ec5907fcd747f3b9c532ea37ad64450f9135fd3368f6ec488c706faccf86c3f21a1412b74bdfb6e5c799e0eb136c398959f9d31b7b89b33364cf37cafdce565d3d3de207b4fbbdc26fdc877b8f3eea1d9645ece39336abffe4fcc707f7b2c69feb7bcc5d719925dc0b2488f7de0ecfcbf6938a6527cc3b1d6596612200112283a0214df0058db12134ee26b97db289d236feb56537cb5e9281f3d9650d3ec50e2ba4b1e8aaf50f86b5ba1886f949978e97defc44b59dfd016dfacb31327efdf8aaf172dc192a5df60fd6e3f531427986f8747b9be1db6c5b7d9836f60d0f5b5b23e2ac7637b68b5668a8a8f477c6c2c62e3ce4285135bb06cbdebf905115fd73d53b065e5322c5dbc18cb4cefb19fd2e0a6a7dec47d2dce36d97dc537be4e0354f5b36eaebe6be689c328714117fcd32cef74cc9aa8ab61cfe178e9c6ba9acd274cfb7d091ee83ddc790fbb4c32bc788c199aaddf4a3b179929a8e30d8f38c3e3acca15b179f152f7fb072ebe8194c53bb83b10763ec50ceb038a6f58573f0b4f02244002854e80e21b00625b6228be145f6d3ada2ef458424db34389eb2e7928bede59998587bf2daf6f84ff4ef1f50e758e3713209999972bba960ecafa5e5ffebb27fefda568601d33d9d46bce645359f3c871aa91bbdf76ff82159fbd87295f78672cbee99f93cc6cd0713e437ce3db0c30b3235fe1ef367ed27c67319699a01fbeb985197eecfda6383fdff8daf2e8e7215992d27074ff6fd8b1792566be39c93bd3747c274c9bd003e564a8f32366a8b33354bc0e86ce1c860b4ae7be8c953ec0fe0340548b87f1c153d7e9299fd09e7ccc7e779f19b5a32ec6c057fae2523313b7bd6d9d65bef19d227590b7f83a439d0b5816fb99de78eeecca7b33867d8ce21bf64d800048800448a05009507c03c06b4b4c38896f861136d9a4fc25d8e39badc568bbb04f689a1d4a5c77c94bf12d4ee20b7cff664fbce25e48f68a7e6f9af55ea527d37793a1c2fdcd3ab88edf89f84e31e22b829c968614b3a3542994357bd6cd9ef5b9eeed2f62f81dff40fac15566a6e221ee7b35c0f0992fa2ae1f595cf3f158ccdb96649669aa81dbfbdc866a277e44ffbbddefe016cfacf2746ccb0cdcf9a46b5d5b5b12f33bd439cd2c6d644a835265cb66fb36d999e0ab9b59f6c999fcca48eefb4672a323b0d4f01be6e6d7faa971e8dfc27766666572ecd831275aaa7c79c80ac019c91b31e08e81eeb585133070e208f37db0ef1f1d6406ec09bd7a7a9658b2cbb46ab2f9e6da65dc66e8b9eb8f0afa2c5798828fcc37cbef6d93a3bcc5577215b42c726d41d8c975dcc06f7cd9084880044880040a9500c53700bcb6c484adf8bae58d935b791b8eb60b6f0a7b7cf33babb3f6d8daecec78d1f5f89ac1ba962c4a6feec0b1afe0d26a65acd739864f5eec8577573ac687a8568fe183c75a99f3f630df28f41f3315adabfbcaef4eb35e6f7ff77abdde7575cd2452cf9a49a4dc0beec6b778006f3ed5de91417de8c95d0bcd844e6fba667e36ef249259bfd42fd67243171b617ed6479865b9a1117d1ef57c9f6b4b627ec437af1e581ff135c3c2474fef8f8488882cfc1a60c8c421ceb24d5a16097f787f109efbc03533b37758b3ef8cda30bdb683473e8ea667ba9659ca3cb10fef0f7fd47cbfebe22ef7b1cb64ff51a199192a3d28cb50e99d8bcc325123f5dbebfc89af6f5bc87f590aca4ecac48de2cb3640022440022450b80428be01f055c191309cc4d72eb7e9b2747a2d29bede86a37cbc2914df60145f5f8195da8c42eb1e0fa1954ce094b2079f8e7913deb99344702719c1953e4bdfde62e955ecd6bf175afee31c943cb11f2b17cec05b9fae70f2c9cf3dff370db79cebeaa33db665b6e9999de439878416e8dfeb669c139d829fbe5f88491f2d754baf9973abcd336638f425266f8a9948aaab6b222eb932fe62f47de846d48a89c6811ddf63da98999ef56ee5b42d89f9115f5933b7b75933570673cb96d0a22beeefd20a352b95c61fdb576386cda1c17d98f1f24d6e59b7ff002057c6e3a63e0fe2ea0babe0d49f3bb164ee0ccc5de9ea2b1746f67abaf6f7bb72a56c0917b7409d3249f8ce3d3bb52bd5f56b97c9575281669d1f44a78beba054e69ff8f6e3a9f8d8f34ce7aea697deac85ec1ec6eefd5edb5788b3b785fc95a5e0ececd2856f9c439dc3b7ee597212200112280a0214df0028abe0507c3341f1f5361c6d17de148aef5f15df7befbd1713274ecc731d60ed31feebebf8ba6a2f23792b46dc97e85ec3d6ae51dfb8775227f7756616e497ef1a8895bed9b21d3534c39c5f32c39ced6de7a2b1a64772819d943d6e4d8a2527b30973f62b3c29b624da43b5ed744f667764d3ac97cc9ab95e59cf7ade756c7a42a7985e5deb5be88ca35b31ac77a27b18b4ffab24f58a3e2330a0dd393e198e6d5f8ca71f1fe123edde0cf1e896781b7e183e06d241eefbeea627fed93b3d3de7de6bfcc57c85db165f5bc4e5ca8296a5a0ecfcbd6db8a5517cc3adc6595e12200112285a0214df0078abe0849bf84a2faf6c526edd29bede86a3ed4253d2ccb79e274e9c30a3024a203232d2d9959b869297dff8e6fc8defe9125fa917f99e74c1bb6ff9f4d24aba6cf10ddaa05fdf7bd0a89a6b18ae2bd5f52b4beafc67d2644cff7c85a79756cf47999edcfbeebf0b6d1a55d3249ff0cf2d8b31e6b5f1a647d93b9cd795211eed7a3c88bb3a3543d6ef789d6b46996b76fb5e9360864cbff8c8f9187fdfa38e80d6ed6cbe29bedb25db768f6fc3bbff85973a9feff31ef6c1ae55f33079e27bd9ee2f3de1cd6eec815edddaa18a35a1965e9b997a0073df7e03133e770d69d67409130cbfee3defc836f994e69161cd4b3ef90c5fafdf61fab5534c722c6a37b80c57b7bf1a35cb6ec6802eae6f817dc557eaec3016bd3b1aef989ef52c34d07bd8105cb87b827ba8b9ef84649b660d32822fefe99bee799f0296a5a0ecf4b9e11a527cc3b5e6596e12200112281a0214df0038abe048184e439dcdff2a1d4a2a6d12527cbd0d47db85a64c9d3a1593274f760e457ca74f9f8e0a152a78fe6815d769450000228449444154a0f929be398bafb22cca6f7cf5999e302d05870f9b8998cc645527929210196b960baa10e5399d73c45c77e0986bb22b93a96cb98a88cdd77530cf398ce32753cc8cd0a9281155c12cc9139b6d72a9accf3d71f8008e9b5c99e61dd32bc4a34a6c7ede31eb5d723e76dee9b86bb22b33db1562cd3bb90678e77c8d7326ed98e167f45526fd32ef57de2c2d54beacefb7cfde3b98c9c152245f5998f9b4fc6eb2ecd19dcfce74ce65155fcf05a6ce0e18f6e6359194948aca0955f3f7ae9e1be41009a82cde7b14989df7166115a3f8865575b3b02440022450e40428be0120576191309cc4d72eb748b01c537cbd0d47f968ca871f7e88b7df7edb398c3093fe880857aa5489e2ab80ac50872a5b493ed1d32abe3e6fc283c2239082cfcc245fe3dc937c75797932ba3788f5799cf4e8be9ff820666c73f5e7b61b34017d9ac5fbe4e141f013a0f8067f1db20424400224509c09507c03a81d151c0929be5cc7579b8eb60b3dce2abed3a64d435c5c1cc557015921c5d78211c6d1ad9f0e42e2041d1a6d2615bbe37e5c77493d54363db77ffcf203a6bf3d1eeb75b62d1996accb488531b3502c3ac537146b95652201122081e24380e21b405da8e0507cd9e36b371b6d179a46f105feeae456ca923dbe4a22b4c3cccc7d98f2c803702fc79b6b61bbbdf02eba5e7446ae7978323809507c83b3def8d624400224102c0428be01d4940a0ec5f7f489efdea39998b72513cb7665628be9013a7a122811401dda59e5cbe518b34ceb7966c4648b1a25d0e1bc12a81613f8ddb45de8bd29be5ef15526851dfe5db33a17f67bf2feb9113886651fbf87e91f2e4096f9ba9c8bea5e7e3b1eb8b733ea562e9ddb4d782e8809507c83b8f2f8ea2440022410040428be0154920a4eb889af7cd72b9b943b33c3fd8defdaa21feabc6a4f26c6afc8c0f23d40999240847154d9ffca668a03d94fa603cdab03bd9b45a069f5c06eaaed42df83e24bf1d5b6c0b060049264c22e33a973d95269483a9189b8aa55513ea779b10af6085e550c09507c8b61a5f09548800448208408507c03a84c151c8aafe9f12d62f1959ede17166760f55ea0b4f90f70606a9a77258bda9f3293ca3631abcd3cdf3a22a09e5f6d17fa9440c477e3c68dce7ab512ea7de2e3e3d1b66d5bb46fdf1e478f1ec5c2850b9da591ca942983e6cd9b63ebd6adb8eebaebf4710c49800448202408507c43a21a59081220011228b60428be01548d8a49588baff4fa9abda867757edbf4f48e599e89e8c8bf5f7ab50988fc26a7020f352f81fb4dcf6f7e376d179a3f3fe22bd78c1d3b1673e7ced5cb3ce2abf72b57ae1c3a77ee8c49932639e76449a4575e7985e2eb21c6080990402811a0f886526db22c2440022450fc08507c03a813151209c3695667635d0e2529b7ee452dbef7ce4ac7a6fd6635d0fcfba8df9ad53ab44f9690ca746f6919c0f99581899dcd58ea7c6e59ef9997f8cafabd2fbffc32962d5be6915d7994dec70eedb8f4043ffffcf314df7cd60bb39100090417018a6f70d517df9604488004828d00c537801ab32584e25bb4dff8b618673ec235db5ff9a657ea4fa45376d944784b967409aecaaf7cef2bdbb2070a4f7cbff8e20bbcf6da6bce73e49d64addfdebd7be3924b2e41d9b265b16ddb360c1f3e1c070f1ef491618aaf838c3f244002214a80e21ba215cb629100099040312140f10da02228bea7afc7b7c1c874c49a353d0bba49ddc95e32331503ae2a8956e74662c2f293f8704349473c557ce5fe87cda43aebfb158ef8a6a7a7a37bf7ee3874e890531479ee5b6fbd85b3ce3acb1172794711f3b4b434bcf8e28b58b76e9d934fd229be0e0afe9000098428018a6f88562c8b4502244002c58400c537808a10f9904d42f6f8166d8f6f4323be150b28be525fb28b4c76b9300303ae2ee7d4e3e113196833e1242223239dde5f27d1fc1c31e2fb632189ef0f3ffc80279f7c521f85bbeeba0b5dba74f1f444cb7b6aafb4c8f1830f3e88d4d454e7fd29be1e6c8c9000098420018a6f08562a8b4402244002c58800c53780ca1029914d428a6f7088afd699f4b4562f9f8a89b74523a6aceb43e1f7571dc3ebdf9480cc966cf7f816a6f84e9b360defbdf79ed38e6488f3c48913111717e7915d5b7c4580478d1a85afbefa8ae2eb10e30f0990402813a0f88672edb26c2440022470fa09507c03a80395288a6fd1cfea5cd01e5fa92bd9d3d35231b44d045ad773751beffcf314ba4d3e8053a52a16a9f8ce9c391313264c705a9d0c6f1e376e9c33d45a7b79e55d352ee1ecd9b321b22ce9ecf10de01f2bb3920009041d018a6fd055195f9804488004828a00c53780ea12f9904d42f6f816ff1e5fa927d96588f3f575d2f142bbf29edaee3d752f96ec2e055922a8a8863a8bc83ef5d45390e1ceb225242460f4e8d14e6fb3caaebcafc6255cbe7cb9331196a4537c3dd5c7080990400812a0f88660a5b24824400224508c08507c03a80c910fd9240c5bf135d31e4bf9d7ad0d0ef19521ce71a55331b96b14ceace09ab06af69a2348fc3409152b567466519621c7f65658439d4564131313b161c306e771f2fcc99327e7dae3bb69d3263cf7dc730e738aaf5d4b8c930009841a018a6fa8d528cb4302244002c58b00c53780faa0f81ae92d46e2abf5915315caf98cf4540c6a15818e17ba8638ef3d9c8a2e13f6e1684639942b570ea54a95ca7679618aefe0c183b162c50ae799f9e9f1e550e76cd5c304122081102540f10dd18a65b148800448a09810a0f80650112a5a12866d8faf29bb947fdd9ad3dbe32bef20bbf4a2962b958113e9256056c475860dcb4455724e7a7baf4848c5ab1dcaa354c9124e4d3f3ef337ccfba9046262629c21ce597b7b25536189afbc9388ac7cd72b5b7ebef11d366c18befffe7bf6f83ac4f843022410ca0428bea15cbb2c1b099000099c7e0214df00ea40c445360929bea75f7c456c1f6a9e892e8dcae087bd6918fcdf541c3955d2915fa9a372254f39439ccf8e75f5ea2e587f147d671d758638cb4cce254bfa5fabb730c5d79ed559045d666dae51a386e7bb5e796ffdc6579633eadbb72f52525228be01fc3b6556122081e02440f10dce7ae35b9300099040b010a0f8065053e12abe76b98df63b12b66ef5e9175f59df76699fb228edeecd5dbcf524067e9ee6f4fcca3b3f7139707b9368a786ff484ac31defeec3ef27a350bebce901f633c4599b42618aef962d5bd0bf7f7f7d142ebbec323cfdf4d30e53115e5b7c478c18e12c652499259ddff87ab03142022410820428be2158a92c120990000914230214df002ac316c070eaf1b5cb5d9cc4f7e4c993e8d32c033d2fabe0a9c5f1df26e3adefd371c9d9c0a84e4670235c439c9f9df33b3eda9099eb1067bd49618aafc86dbf7efdb06ddb36e771c2f6eaabafc6238f3ce2e9a93e71e28433e9d5fcf9f33d7928be5a3b0c498004429500c537546b96e52201122081e24180e21b403dd802184ee29b61e44c3629bf7c492b6171e8f115f13d957c14af752c87760d629c774c4dcfc42bff4d42a77f9445c36aa59db4255b8fe1bef70fa17c05d72cce390d7176329b9fc2145f61b771e3463cf1c413cee3b44dc9b067e9fdfdf3cf3f213339cb16151585e3c78f7bf2b1c7d741c11f122081102540f10dd18a65b148800448a09810a0f80650112a291286adf89ab24bf98bc3e456f28d6f5252124aa51dc394bbcf42a384a86cb59994928e4ee3f7e0b79472ce1067915e91ccdcb6c2165fe1b776ed5a0c1a34c899804bdfc56e5f9a26ef2b43bae55cd5aa55f1cc33cf60ebd6adb8eebaeb340b431220011208090214df90a8461682044880048a2d018a6f0055638b493889af5d6e6360c5427ca5da64d8f0a953a79c5ed1aa512998d2a30ace8e73f5f26ab5befcd91f98bc3add19e25cba746967cd5c3d9753f857c577eedcb9183972a4737bf996f8bdf7de435c5c9cc34d582acfc3870f3be73efbec3327afa64bd8b87163f4ecd9136bd6acc1db6fbfed5cc31edf9c6a8ce9244002a14080e21b0ab5c8329000099040f12540f10da06e6c31a1f89edec9adb4daa4d757e4577a7e2f3a2b0d937a544774e908e7f48a9dc9b87bea41942d1783b265cbe6388bb3de4bc3bf2abe721fbbade8b1a4e92e693a99555a5a1a640667298b6cb2beb0f4f4ca7959fae8bffffdaf739df4f2de7cf3cd9009b2d8e3eba0e20f0990400811a0f8865065b22824400224500c09507c03a8145b66c2497c8d75399454da242ceaa1ce0d46a623b6acffca126194257f8e1d3b86b6754be09f1d2be38fa369786cd601fc9a5cd6338b735e439cf5ee875380f5fdfc2f75a479ec50db85bf343da7ec446657ae5c0999c04a8630376cd8d0e90d967415618d4bb96406e8bd7bf73ae2dba14307b46fdf9ee26b83669c0448206408507c43a62a59101220011228960428be01548b2d3114dfa2edf16d31ced51bea9ea4395bad49afa9c8af4c06253dc022b93239942c5d14191999af21ce72d30c97e363d9038523be070e1c40f7eedd3def2ff1db6ebbcd91deace2bb7af56abcf4d24b4e5e697b4f3ef9246ad6ac49f1f5d063840448209408507c43a936591612200112287e0428be01d449b88aaf5d6ee9fd95e3a2eef1bd77563a36ed87599e28e70a931e5499e9594211df3265ca40beebcd6b1667fb8e6919c0f99581899d0b477c45cabb75ebe6f44ecb73e53d65c2aa66cd9af9f4f84aaff0d0a1433dc39f45dec78e1debc83d873adb35c638099040a810a0f8864a4db21c24400224503c09507c03a8175b00c3a9c7d72ef7e912dfb7576460ccf24c44471a59cca1cee43d7598b00865444444be7b7ae596d2d99b9c0a3cd4bc04ee6f968b616779bef2b19335cd0e252efbecd9b3317efc7827bb9eaf54a9121a356ae408b1f4f4ea4cce7a7ec0800168d0a081f32d33c5d726cd38099040a810a0f8864a4db21c24400224503c09507c03a81795100929be453bd479efd14cbcb03803abf702a54be52cbf0154a74f5691de536940936ac0f3ad23502d2627bdf6b9cc39d076619fd1343b94b8ec22e7c3860dc3975f7ee91ceb75765e49d3fc77de79a7f36daf0ce79649bc28be4a8c210990402811a0f886526db22c2440022450fc08507c03a8135b4c28be452bbe524dabf66462bce9f95dbe0728634622cbf7be397df39bdf6a956f7a653f693e216e5e1de86d7a7a9b56cfbff4ca73b45dd8cfd4343b94b8ee9277c3860d983c79327efcf147e7523baff4585f79e595e8d8b123aa57afeec832c5d726cc38099040a811a0f8865a8db23c2440022450bc0884b4f826272743d64a95b5546593898ea2a3a30b5c03be6222c2e31224e333cef0dbcc12d26fe815213bbf6428e1c9efcd57c29cf07f9d49971bbbef2722641fcbfd5cc7bee9f2463ee99e7caef46cf791e75bcff1ded77b1f93c1f31e99c61225ffbab5452fbef212d2f33b6f4b2696edcac49603c0d19305effd9552c59401ce8b075ad428810ee79508a8a7d781627e949f1e4ba869762871dd258f4e662593721d3c78d0f93e59cecbd24b152b5674f2caccce3a7c9be22bd4b8910009842a018a6fa8d62ccb4502244002c58340488aeff6eddb9da1a4d3a64dcb46b953a74e484c4c749691c976328f045b62c2a9c7d7189843c691b6d32cbe7954d16939adedc27eb8a6d9a1c3cf2dbf9257c557d2556eedb8a4517c6daa8c9300098432018a6f28d72ecb4602244002a79f40c889af0c1d7df8e187f324fbd8638fe1d9679f7566fecd33b33b832d31612bbe6e712bea599df35b47a7239fb60bfbd99a668712d75df2527c6d628c930009843b018a6fb8b700969f044880040a9740d08aaf19c29c9975999ae1c387e385175ef021d6b2654bd4aa550bf3e6cdc3fefd663d1c6b6bdbb62d3ef8e003cf5068eb94dfa82d3114dfd333d4d96fc59ce6446d17f66b689a1d4a5c77c94bf1b589314e022410ee0428bee1de02587e12200112285c02412bbe1f7ffc71e675d75de7a1f3fdf7dfe3da6baff51c57ae5c193367ce44d3a64d3d69dbb66d43af5ebdb06a9557dade7aeb2dc8acb9f9d96c89a1f87a19daecba74e9621f86455cdb855d584db34389eb2e7929be3631c6498004c29d00c537dc5b00cb4f02244002854b2068c5b7458b1699d28b2b1357894cdc71c71d4eafaee012e9fddffffe87dab56b67a327cbc1b46edd1a9b376f76cec98cb9df7df71d626363b3e5cd9a604b0cc597e2abed43db851e4ba869762871dd250fc5572870230112200117018a2f5b020990000990406112085af135503257ac5881faf5eb63e3c68db8e4924b3c9cc68f1fef88b027214b64e9d2a5b8fefaeb3da98b172f46b366cd3cc739456c89a1f8527cb59d68bbd0630935cd0e25aebbe4a1f80a056e24400224e02240f1654b200112200112284c02412dbe5f7df5159a3469820f3ffc103d7bf67438496fefb7df7e8bb3ce3a2b476ed2eb6b7a8cb173e74e27cfebafbf8edebd7be7985f4fd81243f1a5f8666d177a2ca1dd56f458a557cf517c6d628c930009843b018a6fb8b700969f044880040a9740508befa2458bd0bc79736782aafbefbfdf21253db9efbfff3eb24e7c656314f1e8d3a70f74b9238aaf77b9a23cd7f175f75a7256676f8b5291f5a6507c6d168c93000990407e08507cf34389794880044880040a4a20a8c55785f5f1c71fc7db6fbfed3090757a274e9c888888885c990c18300032b1956c7a9f5c2f3027557024648f2f7b7cb5bd68bbd0630935cd0e25aebbe4618faf50e046022440022e02145fb604122001122081c22410d4e23b7af468f4e8d103b6c40e1d3a345febf8dad7507c03e8f1cd70c9dbbab5145ffd87a972abc7126a9a1daaf46a1ac5d726c638099040b813a0f8867b0b60f949800448a0700904b5f8ea37be768faf0c7596b57973ebf14d4b4b7326b792d99c65a3f8527cffca3f331559fb1e9a668712d75df2527c6d628c930009843b018a6fb8b700969f044880040a97404888af88ae7ee32b9356e9324739a1fbf3cf3f9d599cf7efdfef6419376e1cba75eb9653764fba2d311ceacc1e5f6d18da2ef458424db34389eb2e7928be42811b09900009b808507cd9124880044880040a9340d08aaf99bd3973f9f2e5888f8ff799d55960ad59b30675ead4c991dbc2850bd1b97367cff965cb96a161c3869ee39c22b6c4507c29beda4eb45de8b1849a668712d75df2507c8542feb793c793901e198de8d225f37f1173920009040d018a6fd054155f9404488004829240d08aefa5975e9a397ffe7c942a550abb76edc285175ee8a9807efdfae1e5975ff61cdb11918d8e1d3b62c992254eb208b208746464a49dcd6fdc969870125fbbdc46e91c795bb79ae2ab8d44f9e8b1849a668712d75df21427f14d3f750ae9f2525936991d3db719d2b3642fb4c34d9f8dc5cc95ae111acdbbf643bbf3620bed59bc310990c0e92140f13d3ddcf95412200112081702412bbe66e6e6cc5b6fbdd5a9279189871f7e1853a64cf1d49b4c72d5b76f5f33fb72094f9a44468d1a85679e79c693367efc78dc71c71d9ee3dc22b6c4507c29beda56b45de8b1849a668712d75df21417f14ddef63f0c9fbe4c5e29872d12956bd6c315d75c8b866757cc214fe125676626e1d3d7ff8d75c9ae67445f700b126fcd7b8446e1bd11ef4c022450180428be854195f72401122001125002412bbe070f1eccb47b6977ecd881468d1a69b99cf0da6baf45fffefd11171787eddbb7436478f3e6cd9e3ce79c738ed3db1b1515e549cb2d624b4c38896f861136d9a4fc25d8e39bad8968bbb04f689a1d4a5c77c95b5cc4f7e8b6057863fa72fbf5738c57bbb813ee6ddf00453dd878cd47c33177a3cb7ccfefd01b5d9a56c9f11d79820448203809507c83b3def8d624400224102c0482567c9392925c3666915eb97225aebefa6a2b25e7a8f946d819ee5cbd7af59c336539634b4cd88aaf5bded6ad618faf360f6d177a2ca1a6d9a1c475973cc5537ce3717e032395e9e96688337074df2fd875c0ddd52a2f6db6d846b7a0df4d45dde39a8ee349c9c888288d0ae5cab85e84bf244002214580e21b52d5c9c29000099040b1231052e22b74f7ecd98381030762f6ecd939c27ef0c1079de1ced2131cc8664b4c3889af5d6e636e8ebc517cbd2d47f9785382577c639b7645bf0ee7d94541d21f9bf0c99499d861f96f9bfb9fc6a5554bfbe4938323bffe84adbfeec7c974f36d709932a854a506ea9d7d86952f1d07f7edc309f9a0b86414aa57a9649d73454f261dc081a3272503e2aa5441b411f0b4e38770e0b04933361e63fe68256959b7a3fb76e0a79dbf799e7d66d5b351b37ae51c7ba7334f2661fb96cdf83de994f31d73e9e838d43aaf1ee2caf87e1e613fe7e09e1df865f71f1014a54b46e38c6af28c4a393ec3be9671122081dc09507c73e7c3b32440022440027f8d40c889afe2d8b66d1ba4075826bfaa54a912f699ff6cd7ae5d1bf5ebd7476c6cc126c651c19190e2cb1e5f6d6bda2ef458424db34389eb2e798a638f6f6ca35b4d6fee05f27a3e5b66e601cc7a7d0cdca38d117ddef548ecdacc932723651fe6bf3711ab7e4bf5a46924b26a53dc7bcff5a81219818cd43d983074027e734e46e396fe8fa16145db6293316ff870ac724bf655f726a2554234b67c321c33dc1ff936beed11dc50dffb47ab8c943de6d953fc3e1b9135d0a567379c7fa6afa4effd610126cf590e3f6f8be637f740bb7f54d3d777c2f4233fe1a3c91f60cb619f64d741746d74efdd0db56322fc9c64120990407e09507cf34b8af94880044880040a422064c5b72030f2bac6969870125fe9e5954da54d42f6f87a5b8bb60b6f4ae889af94ede816f32df00cf7b7c0d14d9198d801d1263d23631f66be3a1e5bb25ba4174974233cf2c48d8833ff707efc6824666f7419649d76bdd1adb9f77bddb4c3abf1c6c8ff383daab0aef9c9cceafc817b56675b7c45a4a71b91dee17d929f582cbaf4ef8bf3dd82bd67f94c4c58b0c94f3e6f52839bfaa053a3ca4e4266e621ccfad7286cb4cb2793c0fb1c5f80479eeeec94cf7b17c6488004022140f10d8416f3920009900009044a80e21b0031151c0929beecf1d5a6a3ed428f25d4343b94b8ee9227987a7c9df74ddd657a6b27b97b6baba2fb933d51bb6c047ef9fa1d4cfe72af6481f4b076ecde110daac5e0e8ee75f870ca7c1c709d411d332955373329d5c9dd5fe2d5895fbb52abb6c4b3f7b7f40c15deb36c3a26fc6f9b73aeda15ddd1ab756d279e93f8ee58381653bf732d73641e8ee61defc0550dce44d2aecd983fe73fd8e5ee39ae7c6977f46953dbf438db65006a5edc1e37b66c68043e196b177d80cfd7eabdcec343cfdd8678f30f3d79a799f57a8a7bd6ebd846b8e79eb6a8115316290777e0a37153b1c32dc06d1e34c3bfb3f42cbb8bce800448201f0428bef980c42c244002244002052640f10d009d2d31e124be76b9a5f7578ed9e3eb6d38cac79b129ae20b23879f8f1c8eef9dce5ad38bfa585fd42f7fd42c3534cabdd4503c6e1ff000ea4579872ea7fff11d5e7b6ba1ab7334f61224f66b8b289f1e54fb9a535834e65ff8c631e568747ce85134892fe560f527be597b629b777dd4acef1be3a906e93d1e667a8f1d2f8dbf1c4f3f740d8e6ff818a366ad77f254bef876f4695fcf935f22df4d1a8a85bb5c26dbbc9bb95f9d189cf8f51b0c7b77912b5f8d3678f69e4b3da29e7a740f7ede77dc9c2b83aab56ba042a99cbf0f76dd80bf2440023911a0f8e64486e92440022440027f07018a6f0014557024a4f8b2c7579b8eb60b3d9650d3ec50e2ba4b9e60ebf1f527bef5b01d6ffefb03e8a7afcdafbb1eb12564e62ad71691ba1f8bbe58e3924f333cfab127daa382f9c7b363e13ba6a7d6d54bdca0b319567c6165a427fde4bd975b926528b56cfec4d7277fa4ffa1c6e9a79271320d285526da4c46056cfc64243e5ae77e5bf3ed71fbc66720cd9c7736331fc0ef6bfe8b75eeef94754875da8115183666be776473a4cc7c5d17e79e5b0bb56a9e83b8722e3977df85010990400109507c0b088e97910009900009e48b00c5375f985c996c89a1f8527cb5e968bbd0630935cd0e25aebbe40936f1cd48d981b75e9bea1eba5c1bbd077643e5b46d1837ec03cf706629578e9b25beb64c46d66e8381dd2fc5fe751f63ec27aeded8acdffefa15df133f799f6d7a74134d8fae8a724eef60df27a73c9aaee20b9cc27733dec242bf335b9901d6b1b5d1f6d64e68522dafa7eb9d19920009f82340f1f54785692440022440027f17018a6f00246d89a1f8527cb5e968bbd0630935cd0e25aebbe40936f13db461ae1926bc465e1d704f6e55c6964f935cb95a35f3a5adbfcd0c1f8ef907badd76b95b4eed61d335d07bd0ddd839e555f7306333fcf9313364ba8277c8b42dac2aa4e9f6b3b3f410fb7b0349b3ef83e878d48c2dededc9b52e3a959c894637dd8ecb6b56f0a4febae93b2c5bbe06db7fd9efe71a199afd88199acd35863dc01821810009507c0304c6ec2440022440020111a0f80680cb969870125f636b0e2547da32dcdff8aea5f86ad3d176a1c7126a9a1d3afcdcf22b7982497c9dd993879bd993dd1339455f7003126f6dec3b3cd9ccc29c9878539ebdae5276d9f62d9f8ef10b5c1359b5b8f966ec9b33c7353b738dd6e63bda2b3cdfd14a5e5b586df17dd3f436bb062ed740cf8177a3ba5932c9bba563dfae5f902c439da3cf448d2ae5b165de48cc58e5baa2f16dfdcdb24815bdd9f31d3b85a3fbf7e3e7adabf1d5ffd67886799f6f6682eee29e093adfb762461220010f018aaf070523244002244002854080e21b00545b6228be145f6d3ada2ef458424db34389eb2e798aa5f836ed8a7e1dce93d7f36c0776aec0ecf7e7c3bb44afe9ddec67269e8a956f5bed9e5bc05e06486e20ebdfce9af9354e987864cdcbd0f5ba0b3d429b9eb4c97cd33bd3238e925fb6c69dcd3abd177ad7e995347fe2eb3c7b8c996ccb3d6d74b54bbba0579bf325bbb325effcd2ccc6ec9e3ddaf4083f6d26d64ad96696649abedc95c15a2ec97d09367f31134bb7cb54d0a570f92d5d70fe19a5f1fbc62fb1c83ddb73fd56379a21cdde5edd43ab6662d43cd7d248952f359365b5f19d2c4befcb900448206f0214dfbc193107099000099040c109507c0360674b4cd88aaf5bde38abb3b7e168bbf0a604aff89a31cca85633d659a336d28c593eb27f2f0ebb9704d2f26515bcfd46fec6bae54ff2d4bcf81a5cdde45c64fcb1199fcef9da23b6b1d9a43a1d4b27bd86c5ee59945df7f7d7739b93f8c2e7bb60b93eba4653b46e9e80e3bfacc7d215db3c4392abb5ea815e57d5347f7838800fff35c6bbe670740db4e97035ce8d2b818d5fcdc1579eef78bdc3ad7f596c966b5aea9a880b88c735b7b4c5796757c4e19fd763e1e75fe380bb17bcf11da607b96e417a905d25e72f09843b018a6fb8b700969f044880040a9700c53700be2a3812527cd9e3ab4d47db851e4ba869762871dd254f71ecf195f7ca6d3bffdabbd0a545ad2c594e61e9d4d7b158c7416739eb3aac6d862277cb32141938642d2f24f9a2cf3343a8bb36ce7607df21caa647b8bef608cbc45323cdc45359ecdcbe43969e5d599ee80db33c91db57ed9c9e78cd6b7aa0c7e5359d6399d46b8a99d46b97e7ac9f48fc2578ac4f1b67c66a3f6799440224900f0214df7c4062161220011220810213a0f80680ce96188a2fc5579b8eb60b3d9650d3ec50e2ba4b9ee222be3e4382e5c5b26e91b1a8d3a0315ab6bc14d563fc4f5d65063563c3171fe3d3259bb20865246a5e7415dab6b90c55cadadfdfba1e22df0e4f193ac1239557dd9d8856e7649f1d7987e9759deaee756d71f7a3b8f61cef7abdf2ecad4b3ec1475faccffeec8b5ba3d3f5cdb309e9a93f3661f60773b0e5b0affe46c6d6c055eddae2f27a557d28641cdb8505b3e661a599d8ca778bc6f9975d8d76d736c9f60cdf7c3c220112c88b00c5372f423c4f0224400224f05708507c03a0674b0cc597e2ab4d47db851e4ba869762871dd254f71115f7997bf6d4b3f85a4a3c77132ddace55bb20c62622a38ebe7fe6df7cff546e6d949c7917632dda87049c4c4c5e5f9ec93c793907cea24e475cb4455408572deef77fd3e2a6bf9e24cf9fc666422099040a00428be8112637e1220011220814008507c03a0654b0cc597e2ab4d47db851e4ba869762871dd254f488aaf148c1b09900009148000c5b700d07809099000099040be09507cf38dca576628be145f6d3a2ab77a2ca1a6d9a14aafa6517c6d628c930009843b018a6fb8b700969f044880040a9740b08aefff0b000000ffff900ec0ac0000400049444154ec9d0b9cce55fec7bfb321933b53514d4a742525ba5895b4a4362aada82c1691882e684bd95628a58d22695da28894dd6a6babffd6b65d7471c9c825a10b2985dc1963ccfccfe7fc9eeff39ce736333f33c6f33cf339fb7a9e73f99d737ee7bccfd1cee7f99e4bdace9d3bf3a5945d7ebef74af8696922f9f9e6cb382423949f167aeea53b7193212d983f949e664ac62e67d2c3de171ec70bbde7e1e9b61db65c203d98cfcb9f661aeed68b9687c523f2db9e39ed405e7cb2be58842e46b98e1d3b46a5a57a82f273fba969ae8fb07e90372f2f2f184758e31a867fe0c0019b8e706e6eae98792fab56ad92d6ad5bbbaf639804488004929ec02fbffc62fb70eaa9a7267d5fd801122001122081c423f0fdf7dfdb46d5ad5b37f11a57408bd2287c297c0b981fa5fa48c5adfb524d737d15bd9aa642177115bb6e98c2d725ca30099040aa13a0f04df51166ff48800448e0f012a0f0f5c15f050bfc326bf1cd0b587c97d0e2ab5347e785c6e16b9aeb23ac1fe4a1f005053a12200112f00850f872269000099000091c4a0214be3ee8ba2286c297c257a78ece0b8dc3d734d747583fc843e10b0a7424400224e011a0f0e54c200112200112389404287c7dd075454c9915be01f1c63dbea189a3f3229442e1ebb26098044880048a4280c2b7289498870448800448e0600950f8fa20a702073e852f2dbe3a75745e681cbea6b93ec2fa411e5a7c41818e044880043c0214be9c0924400224400287920085af0fbaae88294bc2d7edb7917456bc652da6f0d5a9a37c340e5fd35c1f61fd200f852f28d091000990804780c29733810448800448e05012a0f0f541d7153114be14be3a75745e681cbea6b93ec2fa411e0a5f50a023011220018f00852f67020990000990c0a12440e1eb83ae2b62ca92f0cd33820d0efd37b7fe5a9f16dfd0c4d179114aa1f07559304c02244002452140e15b144acc43022440022470b004287c7d9053816305601ac48df9320eba10a1fcb49040f4d29db8c99016cc1f4a4f83948c59cea4bb82d3286d378e177af1f074db0e5b2e901ecce7e54f8bac07ef77de13aa37547f98f03579919f875b61843da7fc340e5fd35c1f61fd200f2dbea04047022440021e010a5fce04122001122081434980c2d7075d57c494258bafdb6fa3dc287c23e68cf2719335cdf511d60ff252f8bac41826011228eb04287ccbfa0c60ff49800448e0d012a0f0f5c1d7153114bedce3ab5347e785c6e16b9aeb23ac1fe4a1f005053a12200112f00850f872269000099000091c4a0214be3ee8ba22a62c095fa3d62c25156df0b9d4393471745e8452287c5d160c9300099040510850f8168512f39000099000091c2c010a5f1fe454e0c0a7f02d9ec5d763e8ed2fd67dc7c9ea630a45f607d65cf4c7f5910f7138e4c747e3070e1c08c691aef1dcdc5c9b8e383e3b76ec90afbffe5a5ab76e6debe11709900009a40a010adf541949f6830448800412930085af8f71812081835f9684afdb6fd379dbffe25a7cb54e1ff813366bacbe689aeb23ac1f7406a257e3086b5cc3f02176350e11bc73e74e59b56a95b469d3266179b06124400224703004287c0f861acb900009900009149500856f5149997cae88a1f02d9ec517822e592dbc91edc614c2dc70d321560f85c517c217165f0a5f1fff709995044820290850f826c530b1912440022490b404287c7d0c1d85afb1789790c517c237559cce0bb73f9ae6fa08eb0779218e35ae565dc4350c3fd2e2bb6bd72e6bf1bde28a2bdcd7314c02244002494f80c237e987901d2001122081842640e1eb6378204ae0e0d3e25b3c8b2f96eda68ad379e1f647d35c1f61fd20af5fe10b11ac4b9ddbb66debbe8e6112200112487a0214be493f84ec00099000092434010a5f1fc3e38a98b2247c8d5ab394ac68cb0becf15d523ce1bb7fff7e1fe4133babce0bb7959ae6fa965f40fc226f51852fca21afeef1c552670a5f9736c3244002a94080c2371546917d2001122081c42540e1eb636c5c1143e15b3ce19b9393e3837c6267d579e1b652d35c1f61fd206f61c2177923973aeb1edf2bafbcd27d1dc32440022490f404287c937e08d9011220011248680214be3e86c715316556f806c45b714f7586f0054ff740a8648d43c046f603d3ca9d2f88239ffac8affb9c5500bb71a4e907e9a80b5672dde37bd55557d9baf84502244002a94280c237554692fd2001122081c42440e1eb635c5c2143e15b3c8b6f7676b60ff2899d55e785db4a4d737d84f583bc2a7891a62257d3351ecbe2bb7af56aa1f07569334c0224900a04287c536114d90712200112485c0214be3ec6c6153114bec517bee01969294dc638446a64bb31addcf98238f2a91fcbe2abcfd5c2aba257e36af1c51edfdffffef7b6ae44fbc23ee4fffce73fb274e95229ad1f378e3cf24869dcb8b1fcee77bf9372e5ca251a12b6870448a08804287c8b088ad94880044880040e8a0085af0f6cae90a1f02d9ef0ddb3674f94588c148fc912c7148a14f12a865d1ff954dc223f3e1a87af71f82a762124358e34ecf185c5375185ef5b6fbd259f7ffe39ba5aeaae79f3e656fc96fa8bf942122081122140e15b221859090990000990401c0214be71c0c44a860081834fe15b7ce1eb714c0bf04c5e5fc5addb1f9d27aeef8adc488b2ff241d8aa8fba10471915c1b0f8eedebd5b60f1bdfaeaab6dde44fb7af4d147ada5b767cf9ef29bdffca6549a074653a64c918a152bca9021434ae59d65e525db96cd915b87fe43247dafd4eff8908cb8feec43d0f55df2ea4303e5c5e5a6eabdbbe5d27bc64adfe6b58bfc9e8f9f1e248f7eb055d265f3216c63519b13ea4ba54af1caa4cbc98dce95e62d7f27adcea91b2f53994ca7f02d93c3ce4e9300099040a911a0f0f5811a6204ce1338f0d302711184f2d342cf355fd03719d282f943f9d24cc9d8e53c21a8e5d5faa971bcd06b4f443e93212c3d98cf4b8faa07ef77fa15aa37548fc980d7da7cc88b4f710fb7c2214dda9664f7958ddb0f15c3ae8f7c886b7e70d4387c8dc357b11bcbe2bb66cd9a8415bec3870fb7fdbbe5965bac5f5a5f7ffffbdfedab860d1b565aaf2c13ef5934b9bf0c7f7dbded6b8b011364f0e5271c827eef92e9fd6f9679de6b44323ac8cc29dda47211de7460fb2219d875b868d1cc76c3647caff38a50f2506589e84b21af496fde4726df735591fa5a485529f198c2372586919d2001122081842540e1eb63682048e0e0d3e25b3c8b2f846faa389d176e7f34cdf511d60ff2aad8d5b0c6e1eb47adbe8823ac4b9ddbb56be7be2e61c214be093314c56e487efe3699d2ab9bbcbe195565caf019e3a471b5238a5d6f7405bb649611be7354bd9a0cddff3653ae3ba570e9bbfab5fb65d0942f83552682f00df5255d9a5d76a154c1ff5904dcbe9deb65f182d5b257138c9fd9c188f56e8753ac3b8d39cc410adfc33c007c3d09900009a438010a5f1f03ec8a180adfe209df1d3b76d0e21b10c298826ae155f1ab71b5f8460adff6eddbfb98b9a59795c2b7f4581fea371df8d55853ff14b0a636ec2173465e23150fc94ba3856f7acb3b65f69d2d0b7c5b7efe46197b631f79df519109257c333bc99cf1374531cbdfbf595efbdb3d3275befd45c19785bb402029f090c2370506915d2001122081042640e1eb6370287c8dc5322fb0d47949f185af0ff431b362c9ef975f7e299b366d92f2e5cb5b215da54a1539f1c413e594534e919a356bc62c57d2893a2f50efd6ad5b6df59a8653862b57ae1cb4f4225d9f41ccc2218eb08a5e0dc3578b2ff24004c3528ec3ad287c2dbae057c92f75ce951fbf5e2eabbefb41f6ec17297fd45152b5ea3152ffcc3325233d64c10b36c009ecd9b45e567cb55a7edeb1d7cecbaab58e97faa79e2a1955ca3bb9a283f93b374bd6b2a5b2e15728b9f2925eb5a69c5cff5439b94ed5e8cc4eca7e536ed5aa95f2e3cf3b64bf2d5745324f3a5d1a64d6707269305b7e5abf49724db4469d4ca95c0efdcc32fddc62fab95f6a9dd44c2e3ceb189b79f382a9d273c4ab36dce26eb3ccf992c865ced9b26ef97259bb0165c1a8aa9c70d22972eac9478bbfb3b5a385af487d63617eb4400bf3b6252f48b7bfccd58e593fbef0cd954ddf7e6dc773bb696cf9f2663c8f3d5e4e3fb581542f643c51f12fdf64c9f23581b960cad63abeae9c765a3dc32fecf526e2f4c52cd99e3eb9ab54772cbe9a3b2f6fbd3c765d7f996f134c5f6799be568a654d3ff879a8ef4a269fc23799468b6d2501122081e42340e1eb63cc54b0c02fb316df1212bedbb76ff7413e3ceb071f7c2003060c90efbefb2efc4144ecf2cb2fb7f92eb9e4122b8a231e975854e7050e9e6ad1a24558bb8e3efa68f9f4d34fa55ab56a61e2172f4739fda8d8455cc32a7c35cd15bed75c734d89b5bf242b4a058befee1f17c9f807868b1ae422f9b4ea354206b66b14992c797bd6cbeca746cb9cf9ce9a5d2757a3f677c9fd3d2f8db2008a91a10be63d2123a67fe4e40e05d3ebb79161f7f795336b841f16969fbf595e9ff8884c797b7528b31bca6c290f8f1a2867560d95c39ed8de664f2c6c8d6dfb0e90ecb94fcafb01c3238aa6b7b94f66f7bbc0d6f2d984fe32ea1df42553869965cee739cb9c377c32471e7e6456706fad2da05fe90d65d0e87be5e2ba852f55f68a04c422dae1586f1bf51c2323da37d05a23fc6c7975682799ba2c3d5808a18c187b7c7fc97a43463ffcacac71ea762b8b379ec8b3cfcc85b1a3cc5c8839a4e986e150e9dbd69d0be1c237fe5ee56c79f9ee4ef2fc1abca5a18c79f121697054689c907ab0f3106593d551f826ebc8b1dd24400224901c04287c7d8c1304081cfc322b7c0362adb8875b6ddbb6cd07792f2bf6b70e1a34485e7ae9255f65afbdf65a193f7ebc548a7fccaaaffa2233ebbcc0bdb5575c7185b5426b1e08df4f3ef9e4a085af2b825de18b3e25a24b76e1bb6dd93fa4dbd0e70a459bd96eb08cedd52268d9c4b2db29bdfa04f6c3068aa71b29b6375c6d659825bc53c296f0e214e05e32756178bee806d49761d31e95f36a7a5641ecbf7d7150379963855374ee504a7319ff8fc192193861fbc0ee2c1972d33089570cc2718a391c0aa2fae96b7bca3ba8a8fe1f65cee37f080af68df3a74a9fd19e2558df13ddd50c19f4ec04b9f8d8a22c8e76c4627a8639407ab3a77fd3dbc894176f938c1816d3dc9f3f942ebdc7d87ce919995269f37a2be6232dbe3895badbd059daccb87e8b01e3ccc15d27853ddffdf51bd273f0b3ae160f7bae9106d70f95315dcf0f449dbe649a43bac6c73ea40bedef63da6f7f73304ba2679a25d1eecf04073b0fb54dc9ea53f826ebc8b1dd24400224901c04287c7d8c930a1c0adfe29feaac4b828b8a7fe3c68d72d555578559538b5a16f92eb8e00299376f9ea4e32ff412763a2f205261655eba7469f00dc71c738c2c58b0c0be17f9f4830c1a86af02d70d6b9afa2a7cb1c49bc23788d8064a62a973f8f253536d4673b977e82dd2b45e4dc9dfb951fef7d27879eab5d0414ad73c38457a9c9b61dfbff58ba9d2fdc180183496d66143bac9792762a97db67cbff05519fed02c4fe4488611b0cf0605ec0fef3e26fd9e0c597a9b751e22b75e7bbe64943f6096117f20931e9e20cb541337ed2faf3cd0da8aed6dcbcc32dfa1bacc37537a0fbb4b2e6d7ca25dbabc61d97c797ae83859665b26e28aba68e16bac96bd06c8d517369072e6879bf48c13024b7fb325ebbfefca0f7b44aad6bf502e3ead96ad2dfcc02b9156bdee976e6d9b4af5f269b267ebb7f2e6f811f2fc422be724c3588fa704acc781a6c4f11cb1d8b093dc7eda0a79ea158f73c791d3a54bc3ea51e5b2a6f797618163a03b0e1a28df8e19270b4dae70e16b4e58ee694e8bf69a23992d7bc8dd5d2e93cca3abca7e339e1f878d67f80f04517321bda90c1ad95b2e3aa596e46cfd49e6cf9b143617fa4d7c49da1c77a46981d3978c7666a973cfb0a5cefb776e93554bfe2bd3c63c17fcf1e19afb27498f66a1eb9ba2deed631e46814ab2040adf241b30369704488004928c0085af8f01832881835f962cbe6ebf4def6dffb316176f8f2f84afc7d1bb4ec9bd0a28321d9654dc5bbb78f1621fa3159db557af5e327af468fba0a0f745bebfb0388429ea83306dddba7594f0fdfcf3cfe528b34714f9e0501f9cc6e1230dfb79e1f4602ba4e3a371bdc7177b7cafbbee3a9b37d1be92d9e2bbf18371d2e7f1f73ca446b44c32a2a57684b571e56b23e4cf531678798c2574a6b184c252f7dd5b8fc9c0899e806d76d764b9ffd2a3c38666cdbb53e5b94f7e343ab8b274bceb76696c2cb7d6aa7aa3b1aa06846d2b63751c1861750c17aae664e559e66465b31774d7daf7e4e917e74b8e79cb5957f795ebcef184a9be74df376fc80d773e6ba36ac54524bcbe0ce9f7d493d2e6c4b817ce6a75413f2fe75b79ace31d81bda9cd65fa3f8784093b3c9ff6e84cf9c908fe2a677692811ddc65c0c16a22028e58ccfca34c1b7e820cfed3c3de0f050dfbc82b23af0a5ad65110ef1869da00a12be9ed64f2d4e6f2c88df75a21192e7cb3e5dda94fc9279bf78954385bfa0f6c17d6562c317f756817b35c1a0310be9c7be3fc89c6aafd16de60ded152c6cf1a18b49a7b89224b670c92075ef196996774182e53ba35368f9cbe68c602fc8e0f3c2b5d9a1e1b96a338f330aca2248c50f826e1a0b1c924400224904404287c7d0c960a164f0841c07887dc40c72014fb3ede80d0311992f51e5fb7dfa63756a41557f86ed9b2a5c8e4e7ce9d2b7dfbf68d99bf63c78e02b195999969db056be8a851a3046562b9fffce73f72ce39e7c47a74d069ca0702b54d9b3631856fc58a156dfb342f5ea68217692a7223c3a8539fb916df0e1d3a1c747b0f65c1e415beb9f27fa3bbc8f8f99e0aedf85763693c27dad2186e8d0b89a51f8c68ee1710cd192dfbc8e8fe571aab6dc18760656f784fbadf36ce5b4a1bc33aa8e3b461c987b2e4171c94554bce6fd92442bc69ae703f2f6fb50cbe6e50941874856fd12db2a1bac34f523696e651c3e4f781c3b042b9fc861cb1680e849a63eef07d7be8354690a21e2c999e64964c874e91da38dffc4031dafb81a251cfb132fceabd32e0ba7bed7ee370e15b783b56bf384806cd867875af6b0a9f0bd7dc6f2cfbcd3ccbbe5b63fede8df2fe7b4bcd816222b5ceb840ceab57cd849cbeb899e3841b5dd659ba75eb240d82fbb7c3dfed771ec6794dd22453f826cd50b1a124400224909404287c7d0c9b8a16f865c9e29b07656f9ced77090a5f8f63c116df3d7bf6d87db35f7df555d448fded6f7f933beeb8c35a5b231f3efdf4d3d2af5fbfc864e9d2a58ba0dc6fcc9ec758efc7a9c9df9943b3d6af5f2f7ae512acb53829ba6eddba52bd7af5a87210a6b0f8c613be9f7df6995dea8c7c70fa5ee487433ad2340e1f7115bc1aa7f0b5b8627e157fa9b359166bee92f556cfba2228fa758b26f797e1af871ffa94bdf61fd2e9aee79ccce9d2e8b797c8794dcf9573ce385d32ebd408b35a22a37b2ab15fc1167a9139a5f9dbf5b2c16c05d8b973af6cdbbd55766ddd2d3b377f231f7cfca515d56eddaef075d343f5151632874a994399a63a9b84d3331bcaa5179c27e73639474eaf9769964a177c7a75f41b1cb168842f0e84daef2c1d6f70fd43660fedd981624ede80586d586e5970df72bc3eedddb651d67fbf417edeb25df6ecd96e38ed96ddbb77cada8fff27cb367b16dfd03dc5459f0b05f6c5b4afe32d6da5ba392d1be2d8fc7221e5f7ef364bd817c8dbe62edf906b2a0f3f3f34700859d1df1d6b1e86ea4cce10856f728e1b5b4d02244002c94280c2d7c748418cc079c2057ed9b0f886095fc300fd2feee156b882a828cb8ddf7fff7d815537d20d193224b86c194ba17372726c7d152a5490238f3cd2b611e55e79e595b0a2d873fbf1c71fdbc3a6dcf7a33d10c493274f0ecb1f19c172e9810307cab1c71e1b6c3ff280093eb12cbe10be6813dc5e73d8d195575e295f7ffdb58de3ab4e9d3af2e69b6f9aeb72aa0645b08ae1071f7c50e6cc9913cc8bc0030f3c2077dd7557585aa24492d7e2eb08aa02acafe0ec2e7175f7f97ef5d638b9676260a974e480a4674aab6b6f906e9d2e0e5a6cdd7dbaf1ac8a91d5b8f1ef3f7941863f3237b077d87d121e76c560f185aff9a166c70a1977e7bd61a741bb6fcc6cd8523a75ed1adc17ec3e8b1d76d97b570055939f9d3b7a43fb6ff7ad334bb86ff79670eb5dbf05f5c99eb4fdb8f93714d8771cfbfd48757fec70db13bd4f377e1d78e2948d738f2f72a15dcf3fd05fe6057e40486f39d8dc5bdc22bcfc41ce43d49fac8ec23759478eed2601122081e42040e1eb639c206ce0e097258bafdb6fd379dbff9210be1ec7822dbe0f3ffcb08c1d3b366c947057efaa55ab042216a743c322ea8a5864c61dbe1f7df491b46cd932ac2c2210a2279f7c72601cd364c58a1531f345157412b064ba51a346f6bd10a96af16ddbb66dd452675c6784a5cec8b76fdf3ebb5f79e5ca95c1da6ad5aa25a80ff7fdc2a9e845bf468e1c29b366859f4a3b74e8507bba75b082040aa484f0357b3a27bd7847d4fe5ec5ec0adfee8f4e97eb4e0b2d89deb369b57cf0ee87f2e1471fcbb2f5815395b420fc4cb377f8296fefb02b7c9bdd3a56eebff264376781617769b5664ccfc8900cb322a17a8d63a5cade55327f99f7fe9216bedefbb265d5c2f9f2d17befc97c63598ed153b9e69e09d2a3f909dabc027c472c062cbef897b0fa95fb65d00cef90abb6f74c92becd6bcb474ff494c7def7ded6fb8959f2fb7a95c2f62dbb7dc5b2eca76fec13dc436d1b600eb7cb309c6a184ec71e5d4dbe7aefa340dbe3085f692e63e70e96932b845f3514bf33b1fb122bff815f3f95deba9739287277cb2cb3f2600e161414631ec67a5f32a451f826c328b18d2440022490bc04287c7d8c9d2b00297c8b77b8d5cf3fff1c265663896088c4ebafbf5e162e5c18364a9d3b7796e79f7f5e7040968acec8f210a2356ad410bca75cb9d0fe402c172e6f961c6afe0d1b364893264dc2ea2f4a0422f53df3473f9640c3a13e7ce2095f58a2e1d0dedffffef751571ec1b28d3c780e07d10b3766cc18993a75aa0debd7430f3d24fdfbf7d76842f9c92c7c434b9dcdc9cb33ccc9cbcebdb52ee4f78df87ac28aaffae6b0a947ed6153ee730defdfbb4d7e5affbd2c78f37999f1dfd0d2d66b1e7cce9c065d236ca973469bc1e6046458fc8ae2cc7258e7b4629c04ddffdae681d398bdf245d9e3eb8ac4a2bc357e9e5cd9b1e927f9e6ab853277c273a153a81d111bbf2c9ec4168bb87378a0b973d85ea15bbf87bcf8f099f240476fdfb2385705c5b3f8869db46d4e65be77543fb9d09cd0edbad5af983dbe333036e1c2d79d0bf79a53b82f0c5c23e5968d1d8edd975879c30ee90af6c75dea5c32f330d6bb13358dc237514786ed2201122081d42040e1eb631c216ce03cd104bf6c2c75361d0df65b055e712dbe10a48539ecefc569ceb0c8ba6efaf4e982c39d769b7d7a0539085f159c6e3ed48b3b81d197010306c43d08eb861b6eb07b8167cf9eed160f86b1ac79dab469360f12515f2ce18b7b7c75f935f2c412befffbdfffac4057be6af57dfcf1c7297c83c4e3078abfc7d7ac0498d05346bde359135b0c9860ee758db65642640dbc699827c6c408df1946f842209b1f54b2cdc70ca254747e68d116bba73e37e86cf6acde78b61cf8d508bb3f05849d349431731f9206312c8b5fcc9b286facd969e6d089d2b9ef0d72dcde2f8d200cb4218eb8dcb56a8edc3cc45b29e00adc782251db59143fd76c2d303d9572661543e82725afa43dfceba6fee29d11565f1e7ef13139f3a8c2aca5f1c5e2fba33bcb13b6b20c69d6ac86b91accfb01a1d5dd1364e025def8c4ebd32273e5d1f0c09547fa634378ffb2e565b35ff9f935487585af990b661ff728bb8f5ba451d73132e2fa06e1454decc0af5932e9e9b76557851ca97bf19fa4d345c79bd4f87d89acc0bd8b58cc384e9fdcd52e832fd63c8c7c4992c5297c936cc0d85c1220011248320214be3e060ca2040e7e59b2f81e0ae1fbd34f3f156af18535b659b3665123040b304e715671e82e73f6c6c65b3e0dcbae9ea6ac95202fae05c2be602c97beecb2cbf451d087308595154ba9e1d0d69e3d7bcabffffdef601e0dbcfdf6db76c9b3ce0decdf8dbcc717c2176d81439bdbb56b17d3e20bcb34eac1472dbed8774c8bafd28eef9784f075c5a218517befc45172a1bd9b55dfbb4b5e7da8974c5d88c390b012f54eb32fb3a509396247d265e0d32f48abe3c325e177e6bede8181fb7a43f7ea9a83a2869a83a20217ee6634ef2313eeb94a2aa2f280dbb7ee1de976fb04efe467d32608c9d3cb7def5c29d4d408e6a161821996c4717def08eec12d49e1eb2ecf4e6fde5f66dfd35a9b6afd30e16b96eac6ba0628ac808d38fc2284fc2e7368d8cd773d1751a4a9597e3c34b8fc389ef0757f6c68d6738cdcdf3e5cbc7ef7aeb93eea49dd931d2e7cc3df6bae7d7ac25cfb649655875cf8e9cb0d3a3f627ecc38c33c76fa52c01edf9cadabe5ef0f0c9277ac39db14335763cd31576361ec0f7e1e7aadcbdfbf59de7e7e9a7cf4cd76a977c1f5d2b5ddb9c11f28b6adfd509e9bf6b66cae789c5cddb59b5c18b8caaaa0325eada5f34de15b3a9cf9161220011228ab04287c7d8cbc8a1bf86549f8bafd860846bcb8165f88c9c25c3ce18b3db3bac4b8b03a0a7a8e6b8fc68f1f1f96a55ebd7ab26cd9327b0ab3f61b6219d6e5e6cd9b87895a14bcf9e69bed215b2abeafbaeaaab03c10cf2a7c511f3ef184ef114718cba17110c72aea9f78e2090a5f4ba5e0af9210be61a2c5be2e5d5a75bb4d5a9e66eec8cdde20af3d3d4142672441e03e6704ae27535d2b1dac87370dec25979e7d921cb177932c7c678e3cf3da826007baff6da65c774a651bdfb5ca08bb21cf059f49667319d8eb5a39e9a86cf9fab377e4b9973f0a885e73b14f9bfbcc72e80b4cde6cb30fb493b70f1425339a4abfdbdacbc9558f92cddf7c26339f9e1bb0487bd596a4f00ddb976aaacf6cde496ee9d852ead6ac20bfac5d2c735c460d7bc89c91d7840979af4591df8e588c10bef9f9db64c6eddd02a76d07fad361988cef765eb09278c2375c408a34bbfe56e9d0b4be94cbdf229fcc7b41e62d54d589aac2852f18bf6c7e94783ef0a30472b4b871805c7b413dd9f3f36a79eb85a9327fbdf70308cade3b6d5c6039b4d317731553db3fb4962a69b08f7b0e3f7ffdf8eda7f27ed8bb45ba9bbb8faf3bcd9b13c5998778cbb7ff1e21773ca3f32d344f23ef8d76c576bc325eab4bef9bc2b7f458f34d2440022450160950f8fa18751542f0297c8bb7c7f7c71f7f2c943c4e5a8e75e72e0eadc2e154c571b0f86229f3a245e1fd78f9e597edbe625c6584ab8de07098163e781679c2f445175d640f9fd27dc3b016c7b2f8ea3e6308daf6eddbc7b4f842f8626e450a5f2ca7765d22eef1d5bdbd6e3b0f6778d8b06107f5fabc3dab655c8f41f2be6a9a38b5441edc84938e47fef15e591827bf263732cb9c479865ceaefbeedd89c6f2f8969b141d760ec5c2c328c11c5d229812297c75a9b69b1ecc5c84c0ca5746c89f67a8b08a57a0a159063edc5b061e2f4b30ddd9d7ea2cf9d5c7e10779a59b7b7d5f08bbd7f7c076b3fc3cb0f43bbc4fc6423ff4e6a0455deb8bed87ee64d6e77939eb6562dffe1258fdaec9517e5b738857dfe0215e4e5fa272c64e68d5f77119d8b67ed8c3839d87a8c43d7c0df18e23cd9dd40dab4bd89e623c081ea89516b70cb295a6a3f02d4dda7c1709900009943d0214be3ec69cc2d72cf50e582d8b6bf185f0f57e40887faaf3467337e979e7852c3b3a54b0f862a97361e50b7a0ee10b01eaee1f8675362b2bcb2e4bc6c15a6e79dce5bb79f36639f5d453b519d647191c4c85ab88903f96f09d3f7f7ef0402de489277c71b7301c9639231f04304eb4a6f0b5587c7d1dacf0c54b60197b6bea3361565a7d7946c33632a05f77697c9cbbecd57b8a2b6afef5dc7499f5f682a09556cba51b4b6e8f5bfe286d1a1fa74961fe9655efc9d38f3e6b2cca918adb580dbbdd2a7fecd04cd41ea8056d99a74c99a0e5d17b9269964c3f74fb19f26c8f3bec5e5bf71e5cd73adaa8eb2366ef2a96e7fa77eb16bd21d3a73d1ff56eb3005c9ab5ef26bd6e6a2bb5d3bd33100aafdd5849ef36271963af6d43b3e477a4b7e457cb794bb7ef15185fd34fed2963cdf26a77213944e203370eb2cfddbea23c2cc6ef4e1d2f938dc53d9c6ca6f47e6cb89cb57e4a60097aec83cab4fc538ec55edb85b9705b9f2e72de89d534c9f84e5f9cd4c8607a46a65cd4f26a697f752b39b94685c8c7367eb0f3307bc38732e8b6319ed53fe20793c53306c95f5ff1f649b730827b70407017542666e30e512285ef2102cb6a4980044880042c010a5f1f130162040e3e2dbee19652c5186911d5f448ff871f7e884c8a8a4308b66edd3a4c9c22d38b2fbe282d5ab488caef3721964885b5167b8063395875b1dcf99b6fbe093e86f0fde0830f04c2180e8771455a7c716fb05a7c3177aeb9e69a288b2f4e888e65f11d376e5c52085f887f70480477c92597f8be9e2a66bb73b3cd7559c6ea6ff65eef3587a195af6eae0baa921e336b78a229b7799777d8957950b15235a95ea472e69ee79ddb64f7be6cd9bf77bfa4a5573157ef540f1379e1eff1627bb76d96dd2657be69e3812a1952bb7a51da18ab26ff69b6bdbbbdc3aecc695752ddb4d7dda3ecbfc64354c28ce5663326a689e660bbfd7274661d7fedc45c302b40b2b37365bff9375cc5cc85eae9debefd43d4e250b5073d0f4355244b88c23759468aed2401122081e42440e1eb63dccaaaf0354adf5242fff3f3027b7c97145ff87a3f20c4b7f8e260aacb2fbf3c4c48a2217dfbf695fbeebb2ff00344fcf25bb66c9137de78c30a4add830b310de159a9522589b51ff7f3cf3fb7a7346b7ed747d98b2fbe384af8ba7b78b17f379ef0d5f9134ff8c6b2f83ef9e49351c217cb8a6fbffd761f33b774b22682f82d31d15b3ac8f816122001870085af038341122001122081122740e1eb03a90a174fb0c1f25b06af332a21e1bb6eddba424f75c65db90f3ef8a03cf5d45361a3042b2b4e53ae55ab5681e2f7d5575fb5d715b985333232ecfdbbd8b30b8b6fe452678837bc379628c71f6591a74ca32d10beb0d64224c713be10b52aa2afbdf6da288b2ffa832b8ff4502b2c77c6e7cf7ffeb3fce73fff71bb20892a7cc31ac90809900009f82440e1eb1318b3930009900009f82240e1eb031785af67ed0587e2eef185f08d252e551cc287c517fb7961218d741084b7de7a6b504cbae5502ff6e8e2aedfe5cb978715c58156b0a2e6e4e4d843ac162c083fa467c68c1902ab61647d88e3aeddae5dbb86d5873dbf58a69c8b3b5c8dc3fedd488b2f0ee3729731a33f2b57ae0cabe7b5d75e0b1ed8a57b7cf7eedd2bddbb7797afbffe3a2c2f856f180e46488004528400856f8a0c24bb4102244002094a80c2d7c7c050f8969cf0fdeebbef628a4b570cc34a0acb6cd3a64dc39617eb90410076e9d2c52e4d76cb4138fee52f7f919933676ad6a03f7bf66cbb6f1879703a72a435b97efdfaf2e69b6fdac3a85cf18bc3b0707551e429d09d3b77b675ec34fb2bd1de78c257973157a850c15a7167cd9a156c130273e7ce95d34f3f3d68f185e517f715f7eedd3b2c1f2214be514898400224900204287c536010d9051220011248600214be3e0687c2b764856f51d0d7a953479e79e619b9e38e3b62666fd9b2a5dc79e79d72d24927d9e7b0a43ef0c003b27ab57772a95b0877f47ef1c51782ab8a7050154e966ed2a4899bc586b1f777c4881152a3460d1bdfbe7dbbdc75d75dd6b21b991916e9ba75eb0aacb310cab0e6465a7c3ffcf0c3a0c5373d3ddd0aee49932685558525d813274eb4a746e3702d885e58b463b9bffef5af514bb863e5631a099000092413010adf641a2db69504488004928f0085af8f31a3f02d39e18b93915d8baa6bb175d3b1df1627269f7ffef961fb717d0c5b30ebbbefbe6b4f83deb061834d3bf1c413ed7267ec058ee5b02c1a965a588963391c74853a21a0b1d41979b17f3752f8e2b463b5f8a26ffffdef7f635a72f18e0b2fbcd02eef8ef53e4da3f05512f4498004528900856f2a8d26fb4202244002894780c2d7c79850f896acf02d2a7a08d4f5ebd75b51a87f1815b5ace61b33668cdc7df7dd82f2bbccb5247038986ad3a64d024bf0c138ec1f86b517f70dc315267c75fe6019f31967147e7f2af60f47eeefc57b287c41818e044820d508e87fdf23ef4b4fb57eb23f24400224400287870085af0fee2a5c3ceb64193dd519571a95c0e1566bd7ae2d3279587d8f3df658f9e9a79fa46ddbb66116d5a254f2fcf3cfdbbdc0588e0cebac3a1c3805e18ae5cfe79d779e2617c9c712e70b2eb840701f31f6ffc241f85e77dd7561ed83b8c6a15878066ef81c7ffcf1f62ee23e7dfa14f8ae73ce39475a9aa5dc63c78e0dcb47e11b868311122081142140e19b2203c96e90000990408212a0f0f53130102d70f0cd8a55e397c1eb8c02e2adb8a73aaf59b3c6077911ec81ad5ebdba5d528c83a0b0e757ff488a5711eeba1d346890c0628ca5c838502bd269bdb0da8e1a352aeab0abc8fc3d7af49061c38659c18cbdc26883ce0b885b9c24ed2e758635195715e949cdc85bb3664ddb977ffce31f76af2eacce916ec08001b6ed58268d03bcd4e1fe6108df9e3d7b6a127d12200112480902fadf745a7c536238d9091220011248380214be3e8644050e856ff1af338a75f854614301c188bb7bd561f9f3aa55abaca055ab2bf6d0e264665870216ae17075915e9fa4655dbf76eddaf6f468a441cca2ce6fbffd3668c985c5f984134eb0074f417cc361b9342cd0703a2f204a8f3beeb8b0343c83b0ddb66d9bcd87383e10e3e5ca95b361f463ebd6ad8243ad708513da8343b0b0241a6d479f108678c7e9d1595959f6be60fb227e91000990408a10a0f04d918164374880044820410950f8fa18181538f0cbacc5372fb0d479c9a298e43a76ec18333d3211c2d7e398e6cb8730c4b2e7238f3c32b2caa838c4224e6486f0740fcc8af55e086a9ce20cab6d414eebdcbc7973b0dd4843fd38840bcb98e1dcb9026b32042bf2c1c1c77b706235fa81bc48c347c310c12857b56a55c1154878a6c277f1e2c5f6102d5b19bf4880044820450850f8a6c840b21b2440022490a004287c7d0c8c2b66287c8b277c61552d8e83708458851086e514c2531d44232cb2b0a2fa75d5aa5513586e71dd91d6897187e8dcbd7bb7b5dc46d6a9f3c24dd734f5f10c61fd200e318b77c0928dfe208e25d17bf6ecb1821d71f783676803acd1ddba7543157424400224903204287c536628d9111220011248480214be3e8645450cfc322b7c03e2adb87b7c217c3d8efe2cbe108a89564e05acdb2e4c2bc4d547bb910f4ef343c86a3af222aecf35eefa10df10c5b80aaa7bf7ee362fbf4880044820550850f8a6ca48b21f24400224909804287c7d8c4bb89081b0e1e15691f88abad479e5ca9556f48169228a593fed0283c8fc2a6ed5d7b9a3e21771fda03c44afc6e16b5c7d94431896ecefcc215d14bea046470224904a04287c536934d91712200112483c0214be3ec60482040e7e59b2f8bafd36bdb7fdcf5a5cbca5ce10be1ec7c4b3e0fa6d972b6e55c4eb3cb11326f0a5a257f343c8465a7c1177c5ae0a5e548125dcb0f862a9f39ffef427b76a864980044820e90950f826fd10b2032440022490d004287c7d0c8f2b00297c8b277c972f5f9ef496de4891ab7115b391714c3515bf984bfa41ba8a5d4d431c0ecb9b91a602187b7c61f1a5f0b578f8450224904204287c536830d9151220011248400214be3e060502040e7e5912be796ebf4bc8e20be19b2a4ee785db9fc834c4dd0ff2ba71085b8d23ac7115c4aef085c517f709d391000990402a11a0f04da5d1645f4880044820f10850f8fa1813081338f86556f806045c710fb7faf2cb2fcbbcc517730982164e2dbc2a78d587c5579f230d7b7cf18f96c2d762e1170990400a11a0f04da1c164574880044820010950f8fa1894b22a7cdd7e1bd56f857f49085f1fe8133aabf2711b199986b8fb415e37ae4217691a861fcbe28ba5ce3d7bf6745fc73009900009243d010adfa41f42768004488004129a0085af8fe1812881835f962cbe6ebf4de76dff8b2b7c972e5dea837c6267553e6e2b23d310773fc8ebc655ec224dc3f0dd0f44b0eef1edd5ab97fb3a864980044820e90950f826fd10b2032440022490d004287c7d0c0f44091cfcb2247c4d8783fd56b1565ce19b959565eb4c852f9d176e5f22d3949bfac8ab61f82a76ddb02b7a1156e18b7fb414be2e6d86498004528100856f2a8c22fb4002244002894b80c2d7c7d84094c0c1a7f02ddea9ce4b962cf1413eb1b3eabc705b199986b8fb415e375e54e18beb8cb0d4f9965b6e715fc73009900009243d010adfa41f42768004488004129a0085af8fe1513103bf2c095fb7df46ad59c1565c8b2f84afc731b5eff1d52b8d30cd206ed5d72b8f340e16fa5c0fbad2fdbdeae3a0abbd7bf7da7b7c7bf7ee6debe21709900009a40a010adf541949f6830448800412930085af8f71710520856ff12cbe8b172ff6413eb1b3eabc705b199986b8fb415e378e70a4d51771fde039842f2cbef8479becc277ebd6adb266cd1a59bf7ebd6cdebc59b66ddb263939391661850a15a47af5ea9291912199999952bf7e7da951a3868b9761122081142440e19b8283ca2e91000990400211a0f0f53118101f70f0297c8b2f7c3d8eb4f8465a7a5500aba5572dc02a7cb1d4b94f9f3e3e666e6264c578e3fee6cf3fffdc0a5e58bd8be2500e02f8fcf3cf97b3ce3acbfcdb2b5ab9a2d4cd3c244002894380c23771c6822d2101122081542440e1eb6354f107389c27d8e07b7f802319a1fcb4d073cd17f44d86b460fe50be34533276394f106a7977c9ac6d87a9cf6b4f443eb4c3b633901ecce7a547d583f73bfd4247c2e291cf4d5e3c2fee5267f42b559cf272fba369ae8fb07e9057052ed25ccbae86e143f46a1cc277e7ce9db26ad52a69ddbab5fbba840faf5dbb56de7aeb2dd9b2654bb0ad679c7186d4ae5d5b2a57ae2c471e796450d082c7be7dfbec9dc51b376e94952b5706cbd4aa554bdab66d2ba79c724a308d01122081d42040e19b1ae3c85e9000099040a212a0f0f53132f8831c0e7e59b2f89a0e07fb9d9f1710be4b8a67f1b515a6c897ce0bb73b9ae6fa08eb0779216835aee216710dc34f76e1bb7fff7e79fbedb74597b6c3725baf5e3d2b5c713553511c7eacf9e1871fec126f2c8d866bd2a4895c71c51552be7cf9a254c13c244002494080c2370906894d2401122081242640e1eb63f0204ae0e053f852f8ead4d179a1719d23913ef2e907cf525df8623ff2cc9933e5a79f7e4277e5a28b2e9233cf3c3368d985f00583a23a0860ec0b5eb870a12d52a74e1db9f9e69be5a8a38e2a6a15cc47022490c004287c137870d8341220011248010214be3e0651050efc322b7c03e28d4b9d431347e745282572b9b81757d1abf95359f842f44e9d3a557efdf5578140bde69a6bec015538c84afb0f6b707676b68bad486194f9ecb3cf04cba06bd6ac293d7af4a0f82d1239662281c42640e19bd8e3c3d69100099040b213a0f0f53182fa073b7c0a5f5a7c75eae8bcd0387c4d737d84f5833ca92a7c713af38c1933e4c71f7f94934e3a493a74e860f7f1a2cfbb76ed921d3b762068fb5fd4e5ceb680f385fdce0b162c9075ebd6c971c71d275dbb76159c064d47022490bc04287c9377ecd8721220011248060214be3e46c9153114be14be3a75745e681cbea6b93ec2fa419e5415beafbffeba7cf1c517f6e0aa9b6eba29287ad16738fc710be10a07eb2d2cbf07e320b0e7cf9f2f3ffffcb39c7beeb9d2ae5dbb83a98665ca0801ccb572152b4ab932d2df64ec26856f328e1adb4c02244002c94380c2d7c758b92286c297c257a78ece0b8dc3d734d747583fc8938ac217a737635f2ff6e3de7aebad72f4d147a3ab610e8275d3a64d360f04f0debd7bc39efb89e0f4e7575f7dd572c57e5f9ef6ec875e59c99b2d6f8eee2793e66f361dce9441cf8e918b8fad58563a9f54fda4f04daae162634980044820e90850f8fa183257c450f852f8ead4d179a171f89ae6fa08eb0779524df8a23f13274eb457165d78e185f6deddaa55abca6f7ef31b7437cc6ddfbe5db0cc197fe862b9f2d6ad5bed1546c884ab8daa57af6e4533ae2f2acc416ce3c02be4bdedb6dbaca02eac4cece7bbe4d58706ca8bcb452a558a9d43d2abcbc9f51bcbef5aff4e2e3cebb83899985c120476adfa87f41a32472a65c41e8c743347aad738564e3feb22b9f4f2df4a66d5e87986761cd8be487a771d2e90bd700d3a3f22636e3cc38bf03ba10850f826d470b03124400224907204287c7d0ca92b62287c297c75eae8bcd0387c4d737d84f5833ca9267c972d5b26f3e6cd135c59d4a64d1b2b408f38e2087ba855e4fe5b1c7af5fefbefdb3cd8a38b03b0aa55ab062c0251bc61c306c1d5456074da69a715787815accb1f7ffcb1cd8ffdc40d1b36b4f5f8ffda25d3fbdf2cf3bc1b930a2d9ed1b28f4cb8f32a496ddb61b6fcefe9113277c536a978e2ef65c4902b4badbfdb96bd20dd86ce2d741c3443dbbea3a56fdbd3351af4f3f2d6cb63d7f597f98194b6f74f91becd3282cf19481c0214be8933166c0909900009a422010a5f1fa3ea8a180a5f0a5f9d3a3a2f340e5fd35c1f61fd204faa095f9ce28cfb762fbdf45269d0a001ba681dfa5cb972e5a0b0c5f54610bda79f7e7aa14b9321a657ac58218d1a35b25660ad33d28750fee8a38fe484134eb0a73c473e2f5a7c97cc32c2778e15bee9d2e8b74da41afea15b57c18cdd2659fcf197e22eccceec304cc6773baf68d527652ef363404ff36300cca5191d64fae4ae523dc8e4d076c815bee9990de5bcbad5832fcccfdf273faf5a266b36bba3611632b7b953c6f66b19b58f77fbba2c59f4fd0e295fee186976d169a526de830d66a04804287c8b8489994880044880040e920085af0f70ae88a1f0a5f0d5a9a3f342e3f035cdf511d60ff2a492f0c552e5279f7cd25a703b77ee2cb0f4962b574eca972f8fae5a8738acb3efbefbae346edc588e3ffe787d54a0ffcd37dfc8a2458ba4499326712dbfa877f6ecd996efedb7df6eaf392ab0d2980f1de19bd949e68cbf294a20e5e76f9377a78e90a75e5b1da8215386cd1827e7553b22668dc99f986d7e0c302cf0634066079939be9b542ea54eb9c2b7e3c899d2a561f49b7ffde65399feb787e57dc74adfa0f3436629f3d9a5d44abea6240950f896244dd6450224400224104980c2379248017157c49459e19be789b7ac2514be3a55745e681cbea6b93ec2fa419e5412bed863fbe69b6fca19679c21679f1d121d10a410bcf860afefa79f7e2a27992b8e4e3df5542028b2fbf2cb2f05ffb182f8459db1dcd2a54b65e5ca9572d5555749d3a64d63652924cd11be055a374dbebb8d65788d57dd350f4e911ee7462e9dcd951fbfce9255ab37ca1e296f7f00a87a6c5d39a771bd2831edd5922d3faddf2438ebba469d4ca96c8e1eb6e5bffb41f6ec2f2f287bee39a7d974edc4a6f52b64d59a1f64bb39143bbd5cba649ed1581ad4a9aa8f63faf93b374ad6b215b2e1576329353f4aa4a75791da27d497334f8e3c842c57b61acbfcdefc5fe5f9bb86c97c1856d35bcac34f74962a3891bb5c65c9ac5323ea1dfb51ff9215f2f38ebdb6cfe54cfd279fde584e3efaa8a8bc8525b8c2373663ad215bfe6fc22019ff8eaadffa327cc6a3d2d8f93162ffcecdb2711b3a5151ea641e1d651136e78bcbbae5cb65ed862d86b74173545539e1a453e454c3a5b053a07ff9264b969b71b0e5ca1f25b58eaf6b96e7d70b1b2b6d29fd820950f816cc874f4980044880048a4780c2d7073f57c4e06feffc7cef0f70a36704a1fc3413808f8448df64480be60f3d4f3325639733e94e3df863df8de3855e3c3cddb6c3960ba407f379f9a3eac1fb9df784ea0dd56f3204fb934fe16b59b85fca2f569a3e83ef7e903795842ff6f6625972cb962de5d8638f755104c3d8d78bbb7d5bb76e1d4c4360cf9e3db26ad52a7bd233e238093ad6bedeb7df7edb5a89e31d78856b8db0841a7b7cb1d7d7bf0b17be33a7c4b76e2e9ad05386bf83f5bf2291a26cdf8f8b64ec03c3c51e221cd988f4863270e46069754a68d92eb2b807305d73f7fd72c4ab23645e405887aac8947e4f3c2ebf3be1479978d71d12d479a10cd2e8fa21f260d7dfc6106bd9b260f65332e2c58f9cdc4e30d3885a73b0d79935bc03a20eecce92de370d0b1e08e5e40c04338ca5fb59c7d25d70fd8ddadf257fee79a92f6b71d1852ffe5bb5599eeed553024322cd7a8e91fbdb8796db2f9a6cc6eb75bb5e3ba2dd221b3e99230f3f324b543687f5d58cd7a0d1f7cac575a3adcd769c4799718e5d50daf61d6af61c370aab8e91820950f816cc874f4980044880048a4780c2d7073f57c49459e11b1070595fd0e2ab5347e785c6e16b9aeb23ac1fe44925e13b69d2247b9f6efbf6ed8d15311ddd8b725f7df5951c73cc3172d65967059f41f4626f2ec46abd7af56c3a96364344b768d1226c69f3726391c31fc6d81b1ccbe194e87ffdeb5f5678f7e9d327569642d27c08dfc9fd8d90f2148f2b7c777ffd86f41cfc6cd83ee0582fedfee874b9eeb490f885d01c62846694d68d2a9c2199199b65bda7b9a39e22a1c5dd1364f0252738cf76c9cb437bc9f3cb60f12cc865cabd7f7f5c2e3ce648c9dbb34206dc786f6c3168abc894e1b3c649e34a4798184ec3ee25531716527fc33fcacc917f28b2f8f5237cd1a4cd0b264acf116fd9d6613fb2fbc3c5d21983e48157b03cddb4db2c4d576bf0c6f953a5cfe857bd32816f4cdff01bb632cc154813c2ae402aea3837b87ea88ce97a7e58fd8cc42740e11b9f0d9f900009900009149f0085af0f86ae88a1f0a5f0d5a9a3f342e3f035cdf511d60ff2a492f07df4d147253b3b5bfef0873fd8fdbde85fa4c332e7cb2fbf5c70c591ba2fbef8c20ad548310b910c0beeb9e79eab5965c78e1d767f30ae4a8ae50e1c38202fbffcb254ac5851860c19122b4b2169e1c237de414ed8e73ba55737b1064453e34d23a74ba786d5cdd86e9447afed237a7a707ac37632ec8e1be4d41a47c99eaddfca3fc63e20f382e2b3a54cfae71d521bff21312e4af8c2d2f8d70172d169b564cbaa0fe4c921e36499cda95ff5a5f7f0817245e3132567d36a99ebd66df627cf34fb93d546f9c3bb8f49bf274396de16ddee975bae3c47aaa7a7c986651fc8d3234cddaa599d25deb9bb7649ce6fb6cab4dbfb7b96d48c3632fea93f490d73d2b694ab28952b7a8b80c3eb4f976b060c951b7e7b86542c972d6be6bf240f3efe6af087806851aefd89f6fd0a5f301c687e3cb03f4744ec478e257c23c7b155affba55bdba652bd7c9a1daf37c78f90e7177abf3064b4b94fa6f4bbc03632f29468496f2a8346f6968b4ea925395b7f92f9f326993de05f063bd46fe24bd2e6b823837106e213a0f08dcf864f4880044880048a4f80c2d7074357c49425e1ebf6db483a2bdeb21653f8ead4513e1a87af0217564a5ccb032b28041f4e2756974ac277c4881156c877ecd831e6bdbde8f3fffef73fe9d4a953d81edd77de794760258ebcee68fffefdf2cf7ffe53aeb8e20ac56599ce9933c79e1a1d4c7402e03977ee5cfbfefbefbfdf7952d460b8f09d63963a475e5594b363bdbc36f141793eb88eb9a98c9d3b544eaef01bd9387fa2b11e062c8ef58d75f3f148eba6a9dfd91bdcf6fe49e65a9ddab671e1c2d71c9835cd1c985513d654cfed5bf78674bb5d2dc9e9d2efa9e9d2e6c49098cacb592d233b0e9285c8ee885788f1a76fec23ef04846ddb7bcc3b9b7bef0c546dacbba6ec8d81b2265185bcf7dc61122126f1dc2e31bed12c310ed41f5ed6ab61db12732dd15f02d71265b4932966d9714640f07b39627ffb15be68cb14b3dcd9fb41a2a18c79f121697094b7743b96f0cdcbf9561eeb7847e0878ae632fd9f43c24eacc6f3698fce949fccfedf2a677692811dbc7fbb61e36cf63d8f9f355032cdfe75d785de87e1182e53ba35761f331c8700856f1c304c26011220011228110214be3e30aac0814fe14be1ab5347e785c6e1e31fd63df7dc235bb66c0926e39eda175e7821280ccb9af0fde0830fecde5bf7a4673fc217165d085b5c9714cb95a8f0352fc830f711872dda36eb5fd76f0e5f63dcca2c2b1e689715e7cafba3fbc81356106369ec24b33436fa58a4dcb5ff90ebef7ace363fa3dd3023d4bcab905ce1eb5a17b59f587a3cd82c3db64ba16308502c370e5ec5e42cf3cddef09e74bf6d9c67718d59ce7bc30f6f19abf044cf2aecb62b5ebddaae5c537f9740fde92def94d977b6d4478e9f2b2fdf7dbd3cef35bec8a760fb15be616d354b9addd3b6434234b4d4193f0a8c353f0abc6f457ba6f41e354c7e7fd6314ebb630573e5ff467791f1f6b42fb3bfdbdc09dc23c69dc0f97b37cafbef2d15734e96d43ae30239af9e774775ac1a99162240e11b62c110099000099040c913a0f0f5c154054e5913be7946e8c3d97ed3e21b3563745ee8032cf985e513beeb5259f81665a9f3679f7d66456b8d1aa1d380b1d4b976eddaf6302b97150ebbdab871e3e15beaec36264eb86ddfd1e6f0226fbf3196cdce30cb9fed7db7267fa3f65de5c29abfb1c22754bcbce4fdfaa9cc082c83cd6c779f8cef75817dec0adf4c2388c70704b196759f47ee5ff5f2c416beaeb53556bdc1fab72f9281c2ea088500003dab494441545d87db65c2e1f962d7abe5b67e3155ba3fa87b649b4af75b1a4a44a7cd11c922cb5e784ebc2dc0d1d66cad2bd2f72b7cc3c7a0708b2f4e727ef5ee4e32d50a72efedb82ff8d20bce93739b9c23a7d7cb34cbc143d7717939ccbdc6e6aee779de7aeab0fdc291ed67dc3f010a5fffcc58820448800448a0e804287c8bceca0a3f642fd3c237b04f95875b85264ea4f08568ebdfbf7f30034ed2c612675cb1833db09a3f952cbe4539dc6ac58a1572dc71c7d92b8f140e0ea4faf8e38fede156f5ebd7b7c96bd6acb1875bfdf6b7bf954a952a69567b55114e853ef3cc3383696e60afb1c8bef6da6b2573b895b1f5366ad630b8d41916bc85cbacdab1afecfeb73972dd29ee42684720ba8d2a286c96fd4e37cb7eab9bf9e10adb70e1e955e03ef7257c979965c643bd65c6f1ac93784364fda1fdcd4ebf1c4bb276cb15a79a5698dfd65849fbc6b092469673eb760f108bcca771f4c1cf1e5f94cbdbb142c6dd79afbc1f6ec8d72a25b3614be9d4b5ab5c6cf65a7bcee5111abf6001068a4580c2b758f858980448800448a0100214be8500721fab60296bc2d7edb7516d56b851f8866686f2d11457f8e2eedaa79e7a4a4e39e514cb0d79357f2a095fbdcee8b2cb2eb327372b0bd7df6c960943b8bafb76f15caf33d23f7a71f273aceb8cfeeffffecf0ae79a356bbad506c3257a9d9139206a8e3920ca95b66f3ed45926054e2e4e6fde5f5eb8a7b5736d9023884c8b32ea37943ae6f0a8782e7fef36493bb3a33c68aef8c1826857781e2ae1db628039edf9f2136236c97dbf98fdc973ccfe64afef4ebf0a13bee919d2a87e9d98f56be2de6df9f2fbc1f74aab18d703691ef5fd0adf6dcbe618913fcb2b1ed1d6584b9df53db0fcae5a385f3e7aef3d99fff19731af70bae69e09d2a339d8393ca4b9d9df3dd8eeef0ed5c5507108e87f03fcdef35d9c77b22c099000099040d92140e1eb63ac55b0c02fb37b7c297ca3668cce0b7d10297c67ce9c2958de8b7cfa41de5412be0b172e9437df7cd35a73cf3efb6c4511e6a3ef8b172f96ba75eb861df21596294e0456605c7384139dc12d3737d77e5cf64b972eb556e1abaebaca5ad7e3545540b2236a8c700a593dbd22b93f9bfdacbd03fb654d52f7bfcd3456dfcaf6a15d667bbb59ea6c8dc2f5e5e1b98fc999e6c0aba23a577896a8f0750e968ab57758db97fbf387d2a7f7182bfa32cd614ce3838731394c62ec110e5b4adde161532eb6355edfe3c7f7277c9d769a9734e8fc908cb931340f0b16be6eab7265c7a69fe49baf16cadc09cf859d76ed5d8fe42e75ce907ba73d6b96b4870e21736b62d83f010a5fffcc58820448800448a0e804287c8bce2a68a9c31fdb6549f89a8e5b4a2adae0d3e21b9a38aef8422a049ade235bae5c3979e9a597ec7db42e3fe48b14beb08862e92fcae019f604c3628cb08abd9d3b770a8475ebd6ad5145c2b85f7ffdd55ab6b1acbb73e7cec17f2b910d847517e217cbbe4f3ef9e4c8c731e31b366c90acac2c7b15121842f4aac3e9cf88e3e0abd9b367dbf7de7efbed12cf2aace562fb8e788ab0186afe8f26f494c7de09ac8b8db836c87dd6ca9c9e3c30e2f464ad6397b92608ae5ce5ca418bf2a112be07cc9ee2de7f7a3860c56c2ee3ff3138ea0462b4256b7a7f19e6a976892b7cd3dbc8a4176f0b5ec1847261f59beb8ea64cbe2df689cdd9bb641786cdb90609e50b727e84efe217ef97bfcefe32505df43ee278c237d7ecc3f79a55d1b1de7bd5d86b8b6eea2fde3956e6c78c17cd8f19e694e8cfcc1dcea302773837ea3a46465cdf20aa1b077ecd92494fbf2dbb2ae448dd8bff249d2e3a3e2a0f13a20950f84633610a099000099040c911a0f0f5c152050e7c0a5f9eeaac5347052d96fb42a4410462dfaa3aec496dd0a081ddaf7ad34d3799b9e32d8155e18bd38e9f79e619d9be7dbb2de2ceb3264d9a48972e5decf26108bc4415be68f8d4a953e5871f7e90162d5ac8f1c7c7ff437fdbb66df2e5975f5aebb07bbd93f272fdb56bd70aeef46dd9b2a5d4a9e32da305278847e588fcab57afb6d7259d70c209d2a3470fb70a1fe1c285ef01e7102854ecee57ddb56a8edc3c24b0d4561acaf069c3a571843570a911680f04045aa39e4634b5f744d3a112be589afbb2b942c93b515924b3dd6019dbab4598c8dbfef51bd26770e8aaa441cfbee09c48ed5a38c34f4af6c086d7dfa8f35f64c48d4dc2981fd89e25c3ba0e0bdc43dcd02c0f7ea848cb835de1db71e44ce9d2d0b3aebb95e76c5d2d2f8e7f44e605eedbc5b35816f358c2d7ad1f4bd7679ba5ebae0b13beceb545bbccc9dc37074ee6368bdaa5df134f4a9b7aa1bde862a4b47bf27383ce8f18ebf3196ed50cc72140e11b070c934980044880044a840085af0f8cae20294bc2d7ed37acbf88d3e21b9a38e081cf800103ac35164f94592897d84397264f9e1cbcce08d6cffbeebb2faa8c96d57a5147870e1dec7db7107c8968f1451b972d5b2610ff99e61a201c4ca5fdc0b34887beaf5cb95270b511c42aca54a952c55a6f21ee376dda6445342cb9ad5ab58ab2e0e6e4e4c8d6ad5bada517efc1b548b82f199c1a366c18f9ba22c60b17bea868e98b838c785dedd56904d1a417ef0858419df2f669865cd3f756b9ecacda92b3e53bf9f0f539f2fa423d202b5c441e3ae12be20a3c342bbd7e1be977e36fa5a6d983bc6ed1ebf2cc2b0bbcbee059737325d13d2d83712be21e32d7f704f6364b6673e9d7e552a9957e9c346e7ca215d091f567346c27b7756b25c7943f20df2efb505e9afcaa3d2d1a95c612a5cecbc2826ebd19e690a996a7540b1e186da68dfcf8d56299ef1c38660b37ec24d347dc18761f2fd26309df306bb5c993d9bc93dcd2b1a5d4ad59417e59bb58e63c3d41827aba610f9933f29a80853e5b5e1eda499e5f66df68bf5adc3840aebda09eecf979b5bcf5c25499bfdede91845acd72e8715c0e1d42556088c2b7403c7c480224400224504c0214be3e00ea1ff2f0297c69f1d5a983f980cf2db7dc22ebd6adb3c93a57340f7cf73a235c75d4bd7bf7a09517cf5106a71e63a933fe616abdfaec924b2e911b6eb841befefaeb845beaac6d7cfae9a7edddc558ca8c03bd0a72e81face310b9b002efdbb7cf5a718f3cf248a95ebdba15c3471f7db415c46017e96031dfb163877cfef9e7f2e9a79f4aad5ab5e4b6db6e0bb30447962938ee583763ecf1d5b27939abe5818e8302164c9166c6727b7fc0729bb763b53cd67b506079ac9688f65bf41d2783db9e147c00e1ab2712c71287b09a0e3456532b9b63b62dbcedde7ed460f5b2c6dcd37b77e09ede506a44a87e3b99f4484fa95d3efc50ae8df3274a9fd16f4564ce30f7e43e2be7553bc2a67ff5fa6372cf64ef1ee0888ca1a8f99160ec8c8145b2f6a2902b7c4395c40fb5e876bfdcd9a15998355b73bbc2d7bddf77e52b23e4cf3342c25ff387fbc67a3fc358ef037dc5b3bc9cf532b16f7fd155efe1f943b1b6e650acbef650ac501a43f10950f8c667c327244002244002c52740e1eb83a18a19f814be14be3a75745e40bcc12d58b04070af2ddcb1c71e2b4f3cf184dda38b38f69e22ff934f3e296fbdf5960d23bdb2d9eff9c8238f58e10b41078b26c4dcd8b1636d5994c107fb57b1ef37d1f6f8a20f70589a8cc3bc8e38e2086ba1ae50a182f7e020bed3d3d3ed8f00e8370470acbab02f1acbc4c1ece69b6f2e546c17dc0c63b135cb82e7ac31b922f6ef4696fbce08c9812a24cdb54453ccb544198125ecf9fb37cbeb7f1f2b53ded63da7a1d2990ddb48979e37ca85f5c24fa6762dbe8dba3e62f68d862f8dcddbb35a46de384816a2aa30eba3d66deea41dda5da62e3396c6386dff75f93bf2f8df26c8b2c016652d89e5ba6d7bf5973fb53b37b8e738f40ca15cf9f2dd1932e9efc672ab864ca96fc4e0a36162f097ac3764dcc3cf860e84d24ad233a5ed0d37c98dd75d146589d52cb1fcb0539a63653069e919f5e5a296ada5fdd5ade4e41af1e75ac84adfd0ecd57dc8eed5d52ad72d7a43a64f7b5e16863a1778942ecdda77935e37b595da314ee8c68166ef4e1d2f4fbd162d9c33cc38dfd6a78b9c7762f40f36fa5efad104287ca39930850448800448a0e40850f8fa60893fc0e1e053f852f8ead4d179a1715864fbf5eb67a3279e78a2e08e5bec47453e7cb66cd9225dcddda0bac7b76ad5aaf2ecb3cf0a2c9d788e74fd60f9f0830f3e182c0b0188c3a322af04d2772782ffeaabafdac3a820fa9b376f1e53b016a59d58065db1a277a90eace0b8e6c87558f63d6bd62cd9b871a39c73ce395668bbcf0f7b387797b164674bb63d8cab9c543656ecca157179d1e1757b776e93ddfbcc3953e61a9f9dfb8f90a3eb1c1d47f046b7331b077399b128670ea9325e4cb713d6fb5c7368943935aa5cb94a523da34a4c2b6cccc28731d172d9ed1d768543b8aa67542f1a17d3d76d864b7676aeec37ff7eab54cf90eae9662d369d6f0214bebe91b1000990000990800f0214be3e60a9c0815f9684af515d9612fa9d9fe789b7ac2514be3a75745e68dcbdcea876edda326ddab430e10b8be80b2fbc10640a4bef19679c1114c22a7ae1638febf8f1e3050760e13d48c3e14d7ff8c31ff47509e7c35a3d63c60c7b672f843f963d43c41e8cab54a952704f347e2080651c0ea217fb89bffbee3b6b25c70f09b12cc207f34e96210112383c04287c0f0f77be9504488004ca0a010a5f1f23ad02073e852f85af4e1d9d171a2f48f842b8de71c71d769f2ef263ef2a84b15e5ba4e256c52f84ef92254b64d4a85156f822deae9d393cc8ec654d6487c3ab70ca33f6f0e234e6f3cf3f3f68bdf5d36e587c5534c36a9e9191610fb57aedb5d7acb0c6d271fc1070d45147f9a99679498004129000856f020e0a9b4402244002294480c2d7c760aac029d3c217565ff3e1a9cea189a3f342530a13be38fd79cd1a6c2415b9faeaaba577efdec1a5cda84b452f7c085dec1dc6de5e1c88952cc2177d73972223deac5933bb073792179ec573f84100565f3894c349d0f3e7cfb77158d3713d945a816d22bf488004929600856fd20e1d1b4e02244002494180c2d7c730e91fecf0cbacc5d7f41dfda7f00d4d1c9d179a5290f0c5553d7ffce31fad8845fea2085f584f6fbdf556d9bb776f52095ff40f770fe310afc58b17236a4f6aae5bb7aebdc228929bcd10e30bd6dc6fbef9c67e7065111cee37c63e67b506c728c624122081242340e19b6403c6e692000990409211a0f0f53160fa873a7c0a5f2e75d6a9a3f342e305095f88589c3e0c110b3764c81069d1a245d0ca8bba222dbec8dba74f9fa414beca04a73dfffbdfffb64b9f35edf4d34fb7cba061b1c5c15eb0eec2a1ffb8da0816e39f7efac97eb66fdf6e9f6169f395575e59ccd39b6d55fc22011248300214be0936206c0e09900009a418010a5f1f03aa0287c297165f77dae8bcd0b48284efc1587c7ffcf147bb2f18ef49a6a5ceca437db47ff9f2e5f2d9679fc90f3ffc600ffcd26785f9c71f7fbc5d2adda851235fe50aab97cf498004128700856fe28c055b4202244002a94880c2d7c7a8aac0814f8b2f2dbe3a75745e68bc20e10b6ba6bbc7f7b2cb2e933befbc3368e5455d9116df4f3ef9c4de058c6710bed75d779ddd17acef4b467febd6adb27af56ac1d265dcc50b8b2eacbc70b0fee2d02f1c64959999290d1a34901a356a246337d9661220011f04287c7dc06256122001122001df04287c7d205381039fc297c257a78ece0b8d17267cdd539d713f2dae3782d883e0455daef0c51ed9c71f7f5c3efffc73fb0cefc06158eddbb7d7d7d12701122081942040e19b12c3c84e9000099040c212a0f0f531342a70287cb9d4d99d363a2f34ad20e18bbcfffad7bf64c28409363be23d7bf6b4423696f0d565ceb0f422ef69a79d660f756ad3a68dbe8e3e09900009a404010adf94184676820448800412960085af8fa15181039f165f5a7c75eae8bcd07861c217fb7cbb76ed6a4f76d6b2b0025f7ae9a561165f1cee74f7dd77cba64d9b6c3af2221ffcd6ad5bebebe893000990404a10a0f04d896164274880044820610950f8fa181a1529f0cbacf0cd0b5c67b484c257a78ece0b8d17267c91ff9ffffca73cfbecb356c46ab9b3ce3a4bdab56b67d3b2b2b2ec29c8b0f4c2a14cc3860dede9ced81b4be1abd4e8930009a40a010adf541949f6830448800412930085af8f715181039fc297c257a78ece0b8d470adfa953a7daab7a90cffd4c9b364de6ce9dabc5822258ebd3bcc880839e468f1e6daf3442fd14be416c0c900009a408010adf14194876830448800412940085af8f817105499915be01f196f50585af4e1d9d171affe69b6fac6516f1ba75ebca33cf3c637e28490b13bd78863dbd38b1198276fffefd7185efe5975f2eddba75b3cfb14c9ac217f4e8488004528d00856faa8d28fb4302244002894580c2d7c778a8c0814fe14be1ab5347e785c6e16b9aeb23ac1fe4d1c3ac207a172f5e2c4b972e953a75ea08f6f6c24134d7ab574f2a54a860f3e284670a5f8b865f244002294880c2370507955d2201122081042240e1eb63305c11539684afdb6f23e9ac78cb5a4ce1ab5347f9681cbea6b93ec2fa411e15be484358e31a868f3dbe1aa7f005353a122081542540e19baa23cb7e91000990406210a0f0f5310eae88a1f0a5f0d5a9a3f342e3f035cdf511d60ff2a8d0459a8a5b374ce10b4a74244002658500856f591969f693044880040e0f010a5f1fdc214ae0e09725e19be7f69b16dfa819a3f3c27da069ae8fb07e9097c2d725c630099040592740e15bd66700fb4f0224400287960085af0fbeae8829b3c23720de78b85568e2e8bc08a5d0e2ebb26098044880048a4280c2b7289498870448800448e0600950f8fa20a702077e5912be6ebf8dc9d25a2d297c431347f98452287c5d160c9300099040510850f8168512f39000099000091c2c010a5f1fe454e050f8e60b856f68e2e8bc08a550f8ba2c182601122081a210a0f02d0a25e621011220011238580214be3ec8a9c0296bc217565e38f45b3f14bea189a3f3229442e1ebb26098044880048a4280c2b7289498870448800448e0600950f8fa20a702077e595aea4ce15bf024d179e1e6d234d747583fc8cbc3ad5c620c93000994750214be657d06b0ff2440022470680950f8fae0eb8a98b2247cdd7e4304234e8b6f68e2289f500a2dbe2e0b8649800448a02804287c8b4289794880044880040e960085af0f722a70e053f8f21e5f9d3a3a2f340e5fd35c1f61fd200f2dbea04047022440021e010a5fce04122001122081434980c2d7075d57c450f852f8ead4d179a171f89ae6fa08eb0779287c41818e044880043c0214be9c0924400224400287920085af0fbaae88a1f0a5f0d5a9a3f342e3f035cdf511d60ff250f882021d099000097804287c39134880044880040e25010a5f1f745d11539684af516b9692156d79813dbe4b287c75eae8bcd0387c4d737dcb2f207e9187c21714e848800448c02340e1cb9940022440022470280950f8faa0eb8a180a5f0a5f9d3a3a2f340e5fd35c1f61fd200f852f28d091000990804780c29733810448800448e05012a0f0f541d715316556f806c41b4f750e4d1c9d17a1140a5f9705c32440022450140214be45a1c43c244002244002074b80c2d707391538f0297c69f1d5a9a3f342e3f035cdf511d60ff2d0e20b0a74244002244002244002244002244002f108a4eddcb9d3db781a2fc7214877450c852f85af4e319d171a87af69ae8fb07e9087c21714e8488004488004488004488004488004e211a0f04d5371951626b24c72201e480fe6f3d2d38c6277c59848443c223f9e9b02761c54b4c1e752e7d0d4549ea1141d8370dfe587bc25217c73f6e5b8af6598044880044880044880044880044820850850f806056ab87035c914bea53cd1297c4b19385f4702244002244002244002244002658400852f856fc24c750adf84190a368404488004488004488004488004528a00852f856fc24c680adf84190a368404488004488004488004488004528a00852f856fc24c680adf84190a368404488004488004488004488004528a0085efe112be79dec9c4594b78aab3fe8ba2f05512f44980044880044880044880044880044a9200852f856f49cea762d545e15b2c7c2c4c022440022440022440022440022410870085efe112be81bb68799d51686652f8865830440224400224400224400224400224507204287c297c4b6e3615b3260adf620264711220011220011220011220011220819804287c4b51f8aab0f3fcc01edfc5dce3ab3353f9681cbea6b93ec2fa419ebcbcbc601c618d6b18fe8103076c3ac2b9b9b9b273e74e59b56a95b46edd1a5548cebe1cebf38b044880044880044880044880044820f50850f852f826ccac5671eb3648d35c5f45afa6a9d0455cc5ae1ba6f07589324c02244002244002244002244002658f00856f290adf3c23cce020cad28416dfc87f6e2a64dd744d737d84f583bc14be2e3186498004488004488004488004488004220950f81e2ee11b106f3cdc2a342555dc8652b8d4d965c1300990000990000990000990000990c0c111a0f02d45e1abc2cefa14be513356f9b80f34cdf511d60ff2d2e2eb1263980448800448800448800448800448209200852f856fe49c386c7115b76e0334cdf555f46a1a85af4b8c61122001122001122001122001122081480214bea5287c8d99d2f277851b973a87a6a40ad9500a973abb2c1826011220011220011220011220011238380214be14be0737730e41290adf4300955592000990000990000990000990000908856f290a5f1576d6e71edfa87f7ecac77da069ae8fb07e90974b9d5d620c9300099000099000099000099000094412a0f0a5f08d9c13872daee2d66d80a6b9be8a5e4da3f07589314c0224400224400224400224400224104980c297c237724e1cb6b80a59b7019ae6fa08eb0779297c5d620c9300099000099000099000099000094412a0f0a5f08d9c13872daee2d66d80a6b9be8a5e4da3f07589314c0224400224400224400224400224104980c2b714856fd8a9ce799ed5326bc9a2c831b1f18e1d3bc64c4fe54415b26e1f35cdf511d60ff252f8bac418260112200112200112200112200112882440e14be11b39270e5b5cc5addb004d737d15bd9a46e1eb126398044880044880044880044880044820920085efe112be3cd539722e5a2b6e64a28a5bd7a7f08da4c4380990000990000990000990000990404104287c297c0b9a1fa5fa4cc5adfb524d737d0a5f9710c32440022440022440022440022440028511a0f0a5f02d6c8e94da7315b7ee0b35cdf5297c5d420c930009900009900009900009900009144680c297c2b7b039526acf55dcba2fd434d7a7f07509314c02244002244002244002244002245018010a5f0adfc2e648a93d5771ebbe50d35c9fc2d725c4300990000990000990000990000990406104287c297c0b9b23a5f65cc5adfb424d737d0a5f9710c32440022440022440022440022440028511a0f0a5f02d6c8e94da7315b7ee0b35cdf5297c5d420c930009900009900009900009900009144680c297c2b7b039526acf55dcba2fd434d7a7f07509314c02244002244002244002244002245018010adfc3257cf3f2edbdb5594b16c51ca38e1d3bc64c4fe54415b76e1f35cdf5297c5d420c930009900009900009900009900009144680c297c2b7b039526acf55dcba2fd434d7a7f07509314c02244002244002244002244002245018010adfc3257cf30316df2f68f1d549aae256e3f035cdf5297c5d420c930009900009900009900009900009144680c297c2b7b039526acf55dcba2fd434d7a7f07509314c02244002244002244002244002245018010adf5214beae7833b64c6f8fef625a7c75922a1f8dc3d734d747583fc8939797178c23ac710dc33f70e0804d473837375776eedc29ab56ad92d6ad5ba30ac9d997637d7e910009900009900009900009900009a41e010a5f0adf8499d52a6edd06699aebabe8d53415ba88abd875c314be2e518649800448800448800448800448a0ec11a0f02d45e19b6784191c44591a2dbe51ffda54c8ba0f34cdf511d60ff252f8bac418260112200112200112200112200112882440e17bb8846f40bc65f170abe09c54711b4c30014d737d15bd9a46e1eb1263980448800448800448800448800448209200856f290a5f156ad6a7f08d9c8b4191eb3e0863661e20ee7e9097c2d725c63009900009900009900009900009904024010a5f0adfc83971d8e22a72dd06689aeb53f8ba8418260112200112200112200112200112288c00856f290a5f63aab4e3e10a372e750e4d5115b7a1142e757659304c0224400224400224400224400224707004287c935cf82e5bfbc3c18d7c02962a48f8067f34b0878285963ca31bf97a9d917966973de779cba111cecb37571dd9eb8c70e59177d511ae36dabd6b977cf7ed5ae9d1a5b325c1eb8c127042b04924400224400224400224400224504204287c4b51f8aab0b37e09edf1a5f0a5f02da1ff16b01a1220011220011220011220011248590214be14be0933b9f58701b741c1345d264e8baf8b87611220011220011220011220011220812210a0f0a5f02dc234299d2c4191ebbc2e9846e1eb5061900448800448800448800448800448c00f010a5f0a5f3ff3e590e60d8a5ce72dc1340a5f870a832440022440022440022440022440027e0850f896a2f00d1ed084fdbd810398b2962c8a395e1d3b768c991e99c83dbedce31b392718270112200112200112200112200112082740e14be11b3e230e632c68dd75da104ca3c5d7a1c2200990000990000990000990000990801f0214be874bf8c2ea6b3ec5bdc797165f5a7cfdfc83675e12200112200112200112200112288b04287c297c1366de07adbb4e8b8269b4f83a5418240112200112200112200112200112f04380c297c2d7cf7c39a4798322d7794b308dc2d7a1c2200990000990000990402210c8cbcb9303070ed8557c89d01eb6810448203e010a5f0adff8b3a3949f0445aef3de601a85af438541122001122001122081c34960dfbe7db267cf1ed99bbd5772f6e578e257f20f6793f86e122081420850f852f81632454aef7150e43aaf0ca651f83a5418240112200112200112381c04f077c9ce9d3beda7627a45a951a386d4ac59532a54a870389ac377920009f82040e14be1eb63ba1cdaac4191ebbc269846e1eb5061900448800448800448e07010d8b16387ecdebd5b8e39f618a953a7cee16802df490224709004287c297c0f72ea947cb1a0c875aa0ea651f83a5418240112200112200112286d0258debc79f366a95da736456f69c3e7fb48a0040850f852f896c0342a992a8222d7a92e9846e1eb5061900448800448800448a0b4096cddba55720fe4ca59679d55daafe6fb4880044a800085efe112be79817b7c972c8a398c1d3b768c991e99c87b7c798f6fe49c609c0448800448800448a06409e0f4e68d3f6f94dac7d6b616df92ad9db59100099406010a5f0adfd29867457a47d0baebe40ea6d1e2eb5061900448800448800448a03409ecdfbf5fd6ad5b274dce6b22471e796469be9aef22011228210214be874bf81a21075197f5052dbe3a97832257138c1f4ca3f075a830480224400224400224509a04727272e4db6fbf958b2fb9b8345fcb779100099420010a5f0adf129c4ec5ab2a28729d6a826914be0e15064980044880044880044a930084ef9a356ba4e5652d4bf3b57c170990400912a0f02d45e1ab22cef30316dfc5b4f8ea7c563e1a871f4ca3f075b1304c0224400224906204b2d7cc93362dc6cad12d8e2eb4679b3eaa24433f7956ae38b962a17999a1640840f8ae5ebd5a2e6b7559c954986ab5e4ee937d078e30cbc0cba55acfd89f142240e14be19b30d33928729d1605d3287c1d2a0c920009900009a41a815d2ba6cb29ad8614b95b0ffc6b95f46f5abdc8f9533163ee0fefc99f873e27bfecae2c1d1f7954dad5af7cc8ba9970c237f7179937e905f96e5fb61cd7bcbb74bef0b860df7f59384f26bff39d48c5e3a4fb80ce72dc21d6a2fbd6bd27b7b4ee2b9f9916fc6ef04c99d0aba9d79602da186c2c0324508a04287c4b51f8e6a978337e9ad0e21b39cf8322d779104c5376969b6709d667f9e6a44584f13f9cba981f38311be1bc7cc4f3e4c001e431711b3e20bb77ed92efbe5d2b3dba74b66fcbd997e3bc954112200112200112285d02aef03db54d17b9f2b45a711ab057f6fe5a4daebbf74e699271449c3c652379d752f363411befc78291efac925e671fba1f020ebdf0dd27ef8dba45fa7e2a72da2a91deff9e2857d7ab147f20772f977e4d3ac87f4c8e0b86ce93195d43572c2d9fd14f3a8cb44fe4a5c533a47101d5845eb05bde1ed5572698f7572f0ce3b66d52a5e51df2b7bb5a098ef90abd0fb57592d7970e9753f1a0803622271d099436010adfc3257c21d4cc87875b85a6bc0ad9500a973abb2c18260112200112485d02aef07df4bdefa5db995cc65cd86867af982d755b0db4d91e7d6fad6196c416df1d0ba56bb39badd5141d3aadcf7479edae0be323d8b75c069fdd415e33397e6784ef0447f87e3d7bb0b4fb8b7d22f3164f90b38a287c67f76b227f815e2e8a3b6da82c78adab5435797ffc70945cd66bba57ca499702da589457300f099434010adf5214be2aecac4fe11b3597958ffb20986678c159bbae09225d9fd1e2eb1263980448800448201909b8c2f760ad97696907e4a7d5cb65c5daef65f77e910a4755926ad56a4b83866749ad23bdff1f0d6393962d1bd76f1293556ad4ce942ae50fc8c6d559b27ced26533e478eae77915c7866864844beca66e9ecc6354b03efa920d5ebd493731b3710a4abdbfcc30a59f9f57ad9662aaf54fe28c93ceb5c69706c7c618ab66ffa6695acfcd694d9932315ca9bb6d7c994334e3d55aa550c6ffb817d5be4c7adfb65e7c2a946708db3af1c38fdbfd2bb7115d99b2b5235e3c4a832daae83f50fb5c577dddbc3a4f580394ef31ccba9931a0c16202a0f56f8ce33c2f75e2b7c4f934e7d5a4a3cc36f76f636a976faf5d2a74363f1867cb72cfff44bd969c6fa1833cef56a06ae7b2aa08dc17e304002a54880c297c2b714a75bc1af5221ebe60aa651f8ba5818260112200112483102c515befb362e96c7fb5f29e33e8a0d66d0e4f764f0d5a1e5b0c895b66bb174a87fa5a0c803cfbd28d9936f94c79cf2a70e7d433ebcbd6958be9173df94f2b3af9221af44bee70a99f1c954699bb9419eea79be3cf476e473913f8e7e554677bf488e08fc7fbae6d8bcf47519767b2f79c52cf18de522dbbe62f2f572d9fd4e43230ab518f17ff24aafb36dea816ddfcbff3e5a2afb8f3a4e2ebca4a9542b172ea2238ac68d1e5ae1fbab59aa7c918cc42659c70d98fe89f4bbb0a693e2040b1095c516bebf7b58964ee86097313b6ff41f2ca08dfe2b630912283e010adf5214bec64469474cad95f0b9d43934898322379414b4ea06d9718faf4387411220011220815421501ce1bb6bc53c733056df42515c31e25599768b233cb397ca6d27b596280d1ba82928200bc9177a710bb9a2c547f2767c4d2a03e766c97d17d70e16d965962b9f1258ae1c4c8c1118386ba1dcd72ad33e5931a3ab5c362486b20e94bbe2d1ff1a2179a6a4a56d91a72e39531e0a08ea607f62d45f58d2a114beb9ebde96b35a0fb04db8a05337a93267baddbb2bed1f97a58f5d1d5b8016202a8b2d7c2ff8ab2c98d1d92e632e8c8bf73c577efdf117c936918ad58e919a95ca79c905b4d1ad3777f72fb2fccb55b271fb1e295fbebc943faaaad43db5919ca8966337b313def7eb8ff2d5d76b83e5aad63a41ead5af177abf9397411200010a5f0adf84f99740e19b3043c18690000990000994320157f8fe7f7be7035c5575e7f16f4618511c295a188a8054aae9941d5016043bc1d10c36b503d91930801612eba00c52832b608b115db4688700a3d4c8a8e98cc1dae2bf7405772d8bc5aed06a17a18411bba241f9b38888222129892461cfbdf7ddf7cefb1b02c97b372f9fe7987befb97fceef7ece79c027e75ffbc6f8eed7230346cbebf06b82ce9ba757cbefd498cbfaea54fda77aebb7cb75f3e2e7c26f13d58d3a4e6873b5f89965fa976bbea39e8d27749edf6538f6badc997af9d73fd7f72fefaba31ffeb77e9977b3223938594d31b30a2fd28f460ed1c923bbb5f691dbf4b3e7777b31143caedaaae9f23a3dd7abeaa661ba3724ca050b2bf57049be06f5bb40274dec7f898a7d9ede3d749f5cf5355dafeb4f4847ffa752a3a73eec3e77c14b5bf5af632e5253638e7af5bdc06d55765ab4679a16edb022e72dd3ee976f551ff34bf4f67e3a537c6bcc645453ddc9a8a4556f6e559fb53354f29463eb6355f5f61a256cf44d21951d21bedb8df89ed6d0600764438d8a474d75c727e72eacd6ba59a19e052962f4f837a9a6ba4253173de51dc6fc9c5656a59f158f8b8fa3e9a0aa2b966ad1538907243bf79599fb421dae639eca61772680f8a6517c7db173b7a6b5d7d9d2e21bf9faf97c22294c6e65b3601f0210800004b297802dbe05772d53d1c88b74f26b67f46dccc72c4230706cbec67ddb1b81f9f9e672fd53d172efa2bca5aa79659606c478dd87af2d56deaca7bd6ba6ac56ade9c6ea8a6794d0e669cdbbcfab60508249b5a2ae2bd0ebfffb9c467d239249f381f5ca1f3d4b5ec36aae79ce26f39c50ab9f936bcb875a7c499edc086cf93402bbe999957af33363b1bdaed682f9855152ea8cfb7df59eeb74bb2bcd26df8f4cbe1744f26d344b405d1a5a026ae97fd59a599d63c710d76b6dc930cd0b99efe4c73669f5f4e8eede1e94b67f769ef8eed323b937a8ca0921b7546faf9bab1eef566acc8fcbdda0a6ad785d0f4dbc2c3ec014529976f14d164bb274f76d9c59a46f566995576be25f3094326d85b63f34d192dfc3a6357f7c74b7f0dc5ce983e8e78c2dadd29ab92926074b9a2127b29900e28bf806a67e23be81290a028100042000813413b0c5b7adacc3636f8d18bef1f075bae509af35759991bf9238f9739e66b70a5b0269096ddefdffa9577efacf89b36eebbac6f74d97e9ebbd2ed305cb4c8b6e49a845d77f9c25a0467c6b5f8e3def5f17bffd78ed1c8dbbbbda9c28d0c68fd6c87e3d9b59544bb6f5989ce663fa64ff5726a597065d36206e7cb17569caddce12dfba5d6b3466f25237ef094bd6ab62fa1552d36e3d306292dca9ae72171a199ea5b891be29a4f2acc5b7bd637c93c5922cddbcede1cd2b357ed65321e6b92aab5cae29575fa673cf69d2be775fd1dd254b43bf489166576dd63de3fabbd736185ea342bc34a1542f96cdd4c881cedcd24d3a58f31ffaf9d445a199b1c7eac5ad662927e7141f08840820be886f60be0c886f608a8240200001084020cd046c896b2beb48cba5e92a6c5a34bde1aef162683f676765b16eb8df69fa4c2cbe056642a835a109a1ecfbdc7d4b7c135e679d5742b16d5b7c1b8f1dd281bd07f5e991aff48f7f7ca5a3f5c7557ffcb8fefe8717f49b3f3b621fff7e36b364e21bf72e6798d039e2db6cd6ee9dac396eab67ae56bf59adfc815e4bf93b2b0b43dd9da5151b776ae290988ebb29a4f2acc55713b46455a1fa9e3ce9cef81d87ace7005d5b303a320638592cc9d2f5a52a0baf5179a891f6d1f56692b52ba23b5637ec5a6b04f7412febb1657adb8ceb76e4ffe0a695ba7e8e27cc25555b75dfb868b3ddb7798d2a371f901afb68da82b91a1e7d3aee5548e85e04105fc43730351ef10d4c5110080420000108a499802d718b7fbf4b777dbfaf9acdd23cb19f53cda7d4e35cbf1bb12d944bcdf8d5dba3ba0adbf7ee5a3347f9f756bb496149b48435a1d0fa0f68eb3aeb7cbbc5b771bf19037cb7e63dbdc5cf2dc9360bc5b76197e68e9aec4d6465e46eab913bdfd36cf11bbbf045f34b8991d15c924aa574f6e21b9d55fc91694ddd6e5a537d574d164bb2f4c39b5538deeb1a9f6bba24af4bd825b959af2d1caef9ce72c446c45f34eb113bf91d7ea742e34b56b9218d2d5dadc766e7eb22ffeb101f282910882280f8a6517cc333133be37b5b43637c776c8b2a10ffa0a8a8c8df4db97dafd6fc562b4b3e886f961424af010108400002ed26608b6fe2f1aa891e6989afe9125bf3d682b8f1bdfe5db6f8aede526b963132e3612d61cd88f8e61cd213d78e0ccfbaecc66ac66be60d1daafefdfa69f0b72ed6b6f2c7dde596b2b1c5d7eeee5bb2fa4d336bf540bfb8ccf6b02a0ac76b95db2a5aa28dbbeed3105bf09249a5b9b3f3c5b750eb7796eb0abf113a592c49d2a3ba2bab442b568d505cd3724f992595e6cb1b026cc477ab115ff35b81e67daf9919b0e75b9c9c35870b75f5982b3522f70a0dec7f61686d61eb127621102280f822be81f93220be81290a0281000420008134138816df0fcc444ddee455a9c3b0bb3ae799c99faaa3267fb2efddbc628a6e7217e99da28d9f3ca911ce1c561916dffa9d951af683322fccdc3bf4eab3f3c39376f9b17f5c6dc6f8dee9b454a76ef14d3ebed97fd2d96d3bbeab7383d6ce1da507fd8989730b357b5c5f7749202fd2a3aaaa729b3bddc3b217b7aad81eb09a442a9d8bcf5a7c435d8b2f4cd4e5402d268773d5e374243c498c0dbb4d37e649a16ecceedbb5fd63a179ff59a1f7dfb3a94237cef15a7de3eecc9da0d25b676ae6e471e1d6f3b86b48e8b60410df4c892fb33ac77de910df38242440000210804037217066e22b6d7b628a7ef48b2d2ea579bf356be4e647d6c80da333825b6cd6eb7546f83a4b0d6dfcc888af33017286c577a7e9da7b43683dde84addc66d6e7ea3b2fd51c77a1e1d4e2bbe0a51d5a38fe5bee1b76c68f0e175fabbbef69c55bb25abbeecb8fb46626914ae759672dbe1396687b453b96334a164b92f428f1cd1dab69570e4d89e0c41752615999c60ff49b98cd54565feed19fffb4457ffae31b7ae18dbfc6df3fa14c9b2b8ae54d89157f9a94ee4900f1457c0353f311dfc01405814000021080409a099ca9f8367eb456979ab57bbdcf14bdba6395c60db09be3eab56ef18dbafd196fe6e72b16bca4cd0baef52ecfb0f8eedff0884697782b10df51f9573d3c7168e83dbccdbe4de51a73cbf2505a02f1dd59655a8cef75cfe7ddbfd1cc4a6dbaccc67c8ebcbf414fff7aa34e5cf45d15cdbe5523be69b389b938c561478befeeea859ab4c86bd1cd9d304de32e49b08c9469ff7da7ea85d0ecc69171ae6e9849a4d23977d6e23bd6886f7bd6f14d164b92747bfcf28425af9b99ac132cd794a22c624f3537d5e9f0ffedd7f6d79fd5fc55562b79f576150ff70722c7dec571772480f822be81a9f7886f608a8240200001084020cd04ce547c256b9caf1b73ae163cf90b157cf79bd289fd7ae9d16245e68dcad5ef766c52be2fc61916df686997ee58b646378fbe4c3df585feb2f649ddfbb4d746ed1545bcf8361fd860d60f2e0eaf1f3cefb132fdf0f27eba78d8485dfa8d7394d3bc57f70fbada5b3fd879c85dbfd36765f9dee3daf9b363c5d71ebf1b3351544c5cbbd7ced5a4507fe8a871c049a4d2b93de8e2abba77553ce6c7deb24363cd724d6b122cd7e4bc4853831a9c09de7a9cabdefe846ea6fb75538be96e7dce393a37aabfb57343f4accf858fae57f964b33c141f08840820be886f60be0c886f608a8240200001084020cd04ce5c7c4da04d1f6af90ff2c2cbc3240b7de9bfd768d638ab2bb4115fbf0b745b935ba5bcaede3ce73ba1aed46639a3dd2fdf1a33bbb43516396ab9a37aad5f304cb37e932c623bdd5a8629949c93f3857e75edf7a227c732e7fc758eedaedcee2d058f9b3586a7c7ac316ce7917cbf23c5b7694fb546dcb8c8cbac708576964f34a366137f9a0f6ed0f0eb4bbd937617e4ae2cbe6a3033368f0acdd82c4d7bb45a0f4d1e1e0dc0cc78fd8099f1da5dcb58d3cce45e0f99c9bd1a546dc6452f72c745e79a658bd6697c4c5fe683667de0eb43eb03cfae7c53f78cb7270c8bce82a3ee4700f1457c0353eb11dfc01405814000021080409a09d4bfbf56c3f2bd2ecbcb36d5aae47bce20dcd3ff3812f887671e53f1fd4fc7dd943763b11e5c304b2306c474a7b55a7c67566cd1f22997c7ddeb26b4759d11efc597e6792dab332ab577c524f53a653dca8cd55d77cf0dbafd79d3dd3a463e73744c7fac5cae7f33717f60dde24c6655b96595aedcf7a446dfe27487b626e5b2ae6bfeea7d3dbbf2972ab35a870b969935898b472827a7456ffdea27bae9175ecbf1e2dfd7e8a7d758e26f3da7addd8e14df77ccd8d39255deb8d4d2aacd9a3b2ec6dea282316bde169b356fddcbcd5abf9bcd5abffd4d77ed2e2dbe52d4385ff3be63a79569feadd7a95f8f66edfbfb163d57bad45be6c99c9b5056ad8a624f8c6bcc7ad4533d18ce193d5a79a7f2860f568fc623daf1c65acd595a15a69770fde3f05976ba2301c417f10d4cbd477c035314040201084000025d95404ba38e7dd560ba82f6d089fa3af5ecdb5f17f74ed69e18a09734711f3952af9ebd725477fca4fa0d1e102dcf6d856aeeaf3f617ac5f6eca15e7eb7d8b6ee69c7f90e13dfa6dd5a386292bc91a885aade5eaeb686a1ee79ed01dd38df6bfb9cb0c448e0742381d61ac0b6183aaf647775f6d7bf6dfb55ad59a6cd18dfad668caf593de8f43e46c2e78ef0d6238e8a25458cce83f76c58a91b4b9f4a9d476ea93656cf8d2ce5d4b05b8f8c9aa488de26be7d9ae9e6fc10dd9c13c3e9c6a9882fe21b98ea8ff806a628080402108000042000018b4047896fd39ed74c37676f1ddadcd995aabe677c64a6662bbfa8dd2fdf51f13525de98d8c247b5bd7cb27a1b817ec008b4a3c3854bcc58d6e991b1ac115136626dd6db1d7e5abff730dd884df76377bead09268f0a93475410290e2c998f1a579b2246ff695feedaa0c71695ea85e8e67ec92c4bb4f08e9f68eac4d1f102de74501b9e7b5615e55531bd049cdb66ebee3b67287f78aa56743f77b6dd8d00e28bf806a6ce23be81290a028100042000010840c022d051e26b3d925d8b40435d9d9a9a1be52c1ddca3476f5d7851efb67f21a026d57dd9a0c6d07ac3bd7af7d1855da17783f5deeca69700e29b29f16d3d2547f46a766c4b58e245454509d36313dfab3d109bd4658f11df2e5b74040e010840000210c86a02886f56172f2fd74d0820be886f60aa3ae21b98a2201008400002108000042c0288af05835d08745102886fa6c4d7b4f6ba2dbe7fa3c5d7ffee20be3e09b610800004200001080489c0c99327b567cf1e8d1e335ae79d775e904223160840e0340920be88ef695695cebf0cf1ed7cc6e4000108400002108040fb09b4b6b66aefdebd1a3478902eb9e492f63f803b2000818c13407cd328bebed879db508bef765a7cfd6f81cfc73f76b6e134d342ee1ecbe1e6a5fbe74e99bf8c9c7de73fe72fa653a1f1d3ce7eeb29e7b8552d2dce35e6d8dd6f51437dbd3ef9b856b7cd98ee3ef7eba6afdd2d3f200001084000021080402202870e1d524b6b8baebaeaaa44a749830004024e00f1457c0353457d91b5030aa721be3616f62100010840000210483381e3c78febe0a7073578d0600dfdf6d034e74e761080c0d912407cd328beadbebc996d8edb72696675a6c5375c87c3921b4ea1c5d742c12e04200001084000021924d0d2d2a2cf0e7fa6ba63751a326408f29bc1b2206b089c0901c43753e2eb74cd35ffd730b955b8de22be6114ec40000210800004201040028d8d8dfafcf3cf75f4e851f5e9d347fdfaf753fffefd75fef9e707305a428200046c02886f1ac5d7173b778bf8daf5d0ddf7f9d827c2698697f37147f232c6d746c43e04200001084000026922e0cc15d2d4d4a4baba3a1d3b764cf566ce90c6a646b5ba738978ff5649532864030108b49300e28bf8b6b3ca74dee561c9b5b208a721be1615762100010840000210c81401477e9de58d9cb57dfdff9d7faf84ffcd92a9c0c8170210484900f14da3f89a3f11ddc2f0ff7074b674758ed4cf447f6184d37c76eed86866758e50630f02108000042000814c1070c6fcba2b481811f6ffbde26f33110f79420002a90920be886fea1a92c6b389feb208a721be692c09b2820004200001084000021080407611407cd328bebec4b95b2372ce9616dfc817cae713496156679b05fb10800004200001084000021080c09911407c11df33ab399d7017e2db095079240420000108400002108000042020c417f10dccd700f10d4c511008042000010840000210800004b28a00e28bf806a64223be81290a02810004200001084000021080405611407cd328be51b33ab786c6f8eed896b042151515254c8f4d7caff6406c52973d467cbb6cd11138042000010840000210800004024d00f1457c03534111dfc014058140000210800004200001084020ab0820be99125f66758efb2221be71484880000420000108400002108000043a8000e28bf8764035ea984720be1dc391a74000021080000420000108400002d104105fc437ba4664f008f1cd207cb2860004200001084000021080401613407c11dfc0546fc43730454120108000042000010840000210c82a02882fe21b980a8df806a6280804021080000420000108400002594500f1457c0353a111dfc014058140000210800004200001084020ab0820be886f602a34e21b98a22010084000021080000420000108641501c417f10d4c85467c0353140402010840000210800004200081ac2280f8664a7c5b4fc911bd9a1ddb1256a8a2a2a284e9b189efd51e884deab2c7886f972d3a0287000420000108400002108040a00920be886f602a28e21b98a22010084000021080000420000108641501c43753e26b5a7bdd16dfbfd1e2eb7fa3105f9f045b08400002108000042000010840a0230920be886f47d6a7b37a16e27b56f8b81902108000042000010840000210484200f14da3f8fa62e76d432dbedb69f1f5eba6cfc73f76b6e134d342ee1ecbe1e6a5fbe74eb5b6bad799336a75f643e3a79dfdd653ce71ab5a5a9c6bccb1bbdfa286fa7a7df271ad6e9b31dd7deed74d5fbb5b7e4000021080000420000108400002d94700f1457c0353ab7d91b5030aa721be3616f621000108400002108000042000817610407cd328beadbebc996d8edb72696675a6c5375c5dc3921b4ea1c5d742c12e0420000108400002108000042070860410df4c89af915f47f46a98dc2a5c7511df300a7620000108400002108000042000810e2480f8a6517c7db173b7886f5c35f6f9d827c2698697f371c6f13abb4eba7f8e31be3631f621000108400002108000042000815802882fe21b5b273276ec8bac1d40380df1b5b1b00f01084000021080000420000108b48300e29b46f1759b2a4de1f8ad95ce96aece91da1a96dc4852b85537cc8e165f8b0ebb10800004200001084000021080c0e910407c11dfd3a92769b906f14d0b663281000420000108400002108040b72380f8a6517c7db173b7a131aab4f846be733e9f480ab33adb2cd88700042000010840000210800004ce8c00e28bf89e59cde984bb10df4e80ca23210001084000021080000420000121be886f60be06886f608a8240200001084000021080000420905504105fc43730151af10d4c511008042000010840000210800004b28a00e29b46f10dcf4cec8cef6df5d6a1add9b12d61852a2a2a4a981e9bf85eed81d8a42e7b8cf876d9a22370084000021080000420000108049a00e28bf806a68222be81290a02810004200001084000021080405611407c3325beccea1cf745427ce390900001084000021080000420000108740001c417f1ed806ad4318f407c3b86234f8100042000010840000210800004a20920be886f748dc8e011e29b41f8640d0108400002108000042000812c2680f822be81a9de886f608a8240200001084000021080000420905504105fc43730151af10d4c511008042000010840000210800004b28ac0ff039d7c09d2961502ef0000000049454e44ae426082);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(4) NOT NULL,
  `nombre_gru` varchar(30) NOT NULL,
  `idDeporte` int(4) NOT NULL,
  `fecha_cre` date NOT NULL,
  `fecha_mod` date DEFAULT NULL,
  `estado_gru` tinyint(1) DEFAULT NULL,
  `idEntrenador` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `nombre_gru`, `idDeporte`, `fecha_cre`, `fecha_mod`, `estado_gru`, `idEntrenador`) VALUES
(23, 'Bolivar', 1, '2016-05-12', '0000-00-00', 1, 1),
(24, 'CTLP', 1, '2016-05-12', '2016-05-22', 0, 1),
(25, 'Equipo1', 1, '2016-05-17', '0000-00-00', 1, 1),
(26, 'Cebollitas', 1, '2016-05-19', '0000-00-00', 1, 1),
(27, 'Marcianos', 1, '2016-05-20', '0000-00-00', 1, 1),
(28, 'San Jose', 1, '2016-05-22', '0000-00-00', 1, 1),
(29, 'Nacional', 1, '2016-05-23', '0000-00-00', 1, 2),
(30, 'Madrid', 1, '2016-05-24', '0000-00-00', 1, 1),
(31, 'Menonitas', 1, '2016-05-24', '0000-00-00', 1, 1),
(32, 'Mongolos', 1, '2016-05-25', '0000-00-00', 1, 1),
(33, 'Enanitos Verdes', 1, '2016-05-26', '0000-00-00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

CREATE TABLE `informacion` (
  `idInformacion` int(4) NOT NULL,
  `idDeporte` int(4) NOT NULL,
  `idTipo_info` int(4) DEFAULT NULL,
  `nombre_informacion` varchar(200) NOT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `link` varchar(200) NOT NULL,
  `fechacreacion_info` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `idJugador` int(4) NOT NULL,
  `nombre_ju` varchar(30) NOT NULL,
  `apellidop_ju` varchar(20) NOT NULL,
  `apellidom_ju` varchar(20) DEFAULT NULL,
  `fechana_ju` date DEFAULT NULL,
  `imagen_ju` varchar(50) NOT NULL,
  `estado_ju` tinyint(1) NOT NULL,
  `idGrupCat` int(4) NOT NULL,
  `idEntrenador` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`idJugador`, `nombre_ju`, `apellidop_ju`, `apellidom_ju`, `fechana_ju`, `imagen_ju`, `estado_ju`, `idGrupCat`, `idEntrenador`) VALUES
(1, 'Javier', 'Colbert', 'Martinez', '2000-03-04', 'fotos/EjercicioFutbol.png', 1, 26, 1),
(2, 'Diego', 'Morales', 'Perez', '1993-01-01', 'fotos/EjercicioFutbol.png', 1, 21, 1),
(3, 'Marco', 'Gonzales', 'Perez', '1996-01-01', 'fotos/EjercicioFutbol.png', 1, 28, 1),
(4, 'Marco', 'Mendez', 'Perez', '1995-01-31', 'fotos/EjercicioFutbol.png', 1, 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesociclo`
--

CREATE TABLE `mesociclo` (
  `idMesociclo` int(11) NOT NULL,
  `idPlanificacion` int(11) NOT NULL,
  `idPlanificacion_etapa` int(11) NOT NULL,
  `ciclo` int(11) NOT NULL,
  `semanas` int(11) NOT NULL,
  `asistencia` int(2) NOT NULL,
  `evaluacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mesociclo`
--

INSERT INTO `mesociclo` (`idMesociclo`, `idPlanificacion`, `idPlanificacion_etapa`, `ciclo`, `semanas`, `asistencia`, `evaluacion`) VALUES
(163, 12, 1, 1, 2, 1, 1),
(164, 12, 2, 2, 3, 1, 0),
(165, 12, 3, 3, 3, 0, 0),
(166, 12, 4, 4, 3, 0, 0),
(167, 13, 1, 1, 2, 0, 0),
(168, 13, 2, 2, 3, 0, 0),
(169, 13, 3, 3, 3, 0, 0),
(170, 13, 4, 4, 3, 0, 0),
(171, 14, 1, 1, 3, 0, 0),
(172, 14, 2, 2, 3, 0, 0),
(173, 14, 3, 3, 3, 0, 0),
(174, 14, 4, 4, 3, 0, 0),
(175, 15, 1, 1, 2, 0, 0),
(176, 15, 2, 2, 3, 0, 0),
(177, 15, 3, 3, 3, 0, 0),
(178, 15, 4, 4, 3, 0, 0),
(179, 16, 1, 1, 4, 0, 0),
(180, 16, 2, 2, 3, 0, 0),
(181, 16, 3, 3, 2, 0, 0),
(182, 16, 4, 4, 2, 0, 0),
(183, 17, 1, 1, 3, 0, 0),
(184, 17, 2, 2, 3, 0, 0),
(185, 17, 3, 3, 3, 0, 0),
(186, 17, 4, 4, 3, 0, 0),
(187, 18, 1, 1, 2, 0, 0),
(188, 18, 1, 2, 2, 0, 0),
(189, 18, 2, 3, 3, 0, 0),
(190, 18, 3, 4, 2, 0, 0),
(191, 18, 4, 5, 2, 0, 0),
(192, 19, 1, 1, 3, 0, 0),
(193, 19, 1, 2, 3, 0, 0),
(194, 19, 2, 3, 3, 0, 0),
(195, 19, 2, 4, 4, 0, 0),
(196, 19, 3, 5, 4, 0, 0),
(197, 19, 4, 6, 5, 0, 0),
(198, 20, 1, 1, 3, 0, 0),
(199, 20, 2, 2, 3, 0, 0),
(200, 20, 3, 3, 3, 0, 0),
(201, 20, 4, 4, 3, 0, 0),
(202, 21, 1, 1, 4, 0, 0),
(203, 21, 1, 2, 4, 0, 0),
(204, 21, 1, 3, 4, 0, 0),
(205, 21, 2, 4, 4, 0, 0),
(206, 21, 2, 5, 4, 0, 0),
(207, 21, 2, 6, 4, 0, 0),
(208, 21, 3, 7, 4, 0, 0),
(209, 21, 3, 8, 4, 0, 0),
(210, 21, 3, 9, 4, 0, 0),
(211, 21, 4, 10, 4, 0, 0),
(212, 21, 4, 11, 4, 0, 0),
(213, 21, 4, 12, 4, 0, 0),
(214, 22, 1, 1, 3, 0, 0),
(215, 22, 1, 2, 3, 0, 0),
(216, 22, 2, 3, 3, 0, 0),
(217, 22, 2, 4, 3, 0, 0),
(218, 22, 3, 5, 3, 0, 0),
(219, 22, 3, 6, 3, 0, 0),
(220, 22, 4, 7, 3, 0, 0),
(221, 22, 4, 8, 3, 0, 0),
(222, 23, 1, 1, 6, 0, 0),
(223, 23, 1, 2, 6, 0, 0),
(224, 23, 2, 3, 6, 0, 0),
(225, 23, 2, 4, 6, 0, 0),
(226, 23, 3, 5, 6, 0, 0),
(227, 23, 3, 6, 6, 0, 0),
(228, 23, 4, 7, 6, 0, 0),
(229, 23, 4, 8, 6, 0, 0),
(230, 24, 1, 1, 3, 0, 0),
(231, 24, 2, 2, 3, 0, 0),
(232, 24, 3, 3, 3, 0, 0),
(233, 24, 4, 4, 3, 0, 0),
(234, 25, 1, 1, 6, 0, 0),
(235, 25, 2, 2, 6, 0, 0),
(236, 25, 3, 3, 6, 0, 0),
(237, 25, 4, 4, 6, 0, 0),
(238, 26, 1, 1, 3, 0, 0),
(239, 26, 2, 2, 3, 0, 0),
(240, 26, 3, 3, 3, 0, 0),
(241, 26, 4, 4, 3, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `name_evaluacion`
--

CREATE TABLE `name_evaluacion` (
  `idName_evaluacion` int(11) NOT NULL,
  `idCategoria_grupo` int(11) NOT NULL,
  `idPlanificacion` int(11) NOT NULL,
  `idEtapa` int(11) NOT NULL,
  `idMesociclo` int(11) NOT NULL,
  `Evaa_1` varchar(50) NOT NULL,
  `Evaa_2` varchar(50) NOT NULL,
  `Evaa_3` varchar(50) NOT NULL,
  `Evaa_4` varchar(50) NOT NULL,
  `Evag_1` varchar(50) NOT NULL,
  `Evag_2` varchar(50) NOT NULL,
  `Evaf_1` varchar(50) NOT NULL,
  `Evaf_2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `name_evaluacion`
--

INSERT INTO `name_evaluacion` (`idName_evaluacion`, `idCategoria_grupo`, `idPlanificacion`, `idEtapa`, `idMesociclo`, `Evaa_1`, `Evaa_2`, `Evaa_3`, `Evaa_4`, `Evag_1`, `Evag_2`, `Evaf_1`, `Evaf_2`) VALUES
(1, 21, 12, 1, 163, 'name 1', 'name 2', 'name 3', 'name 4', 'name 5', 'name 6', 'name 7', 'name 8'),
(2, 21, 12, 1, 163, 'name 1', 'name 2', 'name 3', 'name 4', 'name 5', 'name 6', 'name 7', 'name 8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `idPeriodo` int(11) NOT NULL,
  `periodo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`idPeriodo`, `periodo`) VALUES
(1, 'Preparatorio'),
(2, 'Competitivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion`
--

CREATE TABLE `planificacion` (
  `idPlanificacion` int(4) NOT NULL,
  `idGrupo` int(4) NOT NULL,
  `idTipo_plan` int(4) NOT NULL,
  `fecha_inicio_pre` date NOT NULL,
  `fecha_inicio_comp` int(11) NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `frecuencia` int(4) DEFAULT NULL,
  `tiempo_clase` int(4) DEFAULT NULL,
  `transito` int(11) NOT NULL,
  `cant_semanas` int(4) DEFAULT NULL,
  `cant_dias` int(4) DEFAULT NULL,
  `tiempo_total` int(4) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `tiempoSemana` int(4) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planificacion`
--

INSERT INTO `planificacion` (`idPlanificacion`, `idGrupo`, `idTipo_plan`, `fecha_inicio_pre`, `fecha_inicio_comp`, `fecha_fin`, `frecuencia`, `tiempo_clase`, `transito`, `cant_semanas`, `cant_dias`, `tiempo_total`, `estado`, `tiempoSemana`, `nombre`) VALUES
(12, 23, 2, '2016-05-12', 0, '0000-00-00', 2, 60, 1, 11, 22, 17, 1, 90, 'Bolivar_Trimestral'),
(13, 24, 2, '2016-05-12', 0, '0000-00-00', 3, 90, 1, 11, 33, 39, 1, 210, 'trimestral_ctlp'),
(14, 24, 2, '2016-05-14', 0, '0000-00-00', 2, 60, 0, 12, 24, 18, 1, 90, 'plan_tri'),
(15, 25, 2, '0000-00-00', 0, '0000-00-00', 3, 90, 1, 11, 33, 39, 1, 210, 'plan del equipo'),
(16, 26, 2, '2016-05-19', 0, '0000-00-00', 3, 90, 1, 11, 33, 39, 1, 210, 'copa_maltin'),
(17, 27, 2, '2016-05-20', 0, '0000-00-00', 2, 90, 0, 12, 24, 28, 1, 140, 'plan_marciano-trimestral'),
(18, 28, 2, '2016-05-23', 0, '0000-00-00', 3, 90, 1, 11, 33, 39, 1, 210, 'San Jose Tri_1'),
(19, 29, 3, '2016-05-23', 0, '0000-00-00', 2, 90, 2, 22, 44, 51, 1, 140, 'nacional_semestral'),
(20, 30, 2, '2016-05-24', 0, '0000-00-00', 3, 90, 0, 12, 36, 42, 1, 210, 'madrid_plan'),
(21, 30, 1, '2016-05-24', 0, '0000-00-00', 3, 60, 0, 48, 144, 108, 1, 135, 'madrid_anual'),
(22, 31, 3, '2016-05-24', 0, '0000-00-00', 3, 90, 0, 24, 72, 84, 1, 210, 'menonitas_1'),
(23, 32, 1, '2016-05-25', 0, '0000-00-00', 2, 60, 0, 48, 96, 72, 1, 90, 'mongodb'),
(24, 32, 2, '2016-05-25', 0, '0000-00-00', 2, 60, 0, 12, 24, 18, 1, 90, 'tri_mongodb'),
(25, 33, 3, '2016-05-26', 0, '0000-00-00', 2, 60, 0, 24, 48, 36, 1, 90, 'enanos_semestral'),
(26, 32, 2, '2016-05-27', 0, '0000-00-00', 2, 60, 0, 12, 24, 18, 1, 90, 'tru');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion_etapa`
--

CREATE TABLE `planificacion_etapa` (
  `idPlanificacion_etapa` int(11) NOT NULL,
  `idPlanificacion` int(11) NOT NULL,
  `idEtapa` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `semanas` int(11) NOT NULL,
  `mesociclo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planificacion_etapa`
--

INSERT INTO `planificacion_etapa` (`idPlanificacion_etapa`, `idPlanificacion`, `idEtapa`, `porcentaje`, `semanas`, `mesociclo`) VALUES
(125, 12, 1, 50, 2, 1),
(126, 12, 2, 50, 3, 1),
(127, 12, 3, 50, 3, 1),
(128, 12, 4, 50, 3, 1),
(129, 13, 1, 50, 2, 1),
(130, 13, 2, 50, 3, 1),
(131, 13, 3, 50, 3, 1),
(132, 13, 4, 50, 3, 1),
(133, 14, 1, 50, 3, 1),
(134, 14, 2, 50, 3, 1),
(135, 14, 3, 50, 3, 1),
(136, 14, 4, 50, 3, 1),
(137, 15, 1, 50, 2, 1),
(138, 15, 2, 50, 3, 1),
(139, 15, 3, 50, 3, 1),
(140, 15, 4, 50, 3, 1),
(141, 16, 1, 60, 4, 1),
(142, 16, 2, 40, 3, 1),
(143, 16, 3, 50, 2, 1),
(144, 16, 4, 50, 2, 1),
(145, 17, 1, 50, 3, 1),
(146, 17, 2, 50, 3, 1),
(147, 17, 3, 50, 3, 1),
(148, 17, 4, 50, 3, 1),
(149, 18, 1, 60, 4, 2),
(150, 18, 2, 40, 3, 1),
(151, 18, 3, 40, 2, 1),
(152, 18, 4, 60, 2, 1),
(153, 19, 1, 50, 6, 2),
(154, 19, 2, 50, 7, 2),
(155, 19, 3, 50, 4, 1),
(156, 19, 4, 50, 5, 1),
(157, 20, 1, 50, 3, 1),
(158, 20, 2, 50, 3, 1),
(159, 20, 3, 50, 3, 1),
(160, 20, 4, 50, 3, 1),
(161, 21, 1, 50, 12, 3),
(162, 21, 2, 50, 12, 3),
(163, 21, 3, 50, 12, 3),
(164, 21, 4, 50, 12, 3),
(165, 22, 1, 50, 6, 2),
(166, 22, 2, 50, 6, 2),
(167, 22, 3, 50, 6, 2),
(168, 22, 4, 50, 6, 2),
(169, 23, 1, 50, 12, 2),
(170, 23, 2, 50, 12, 2),
(171, 23, 3, 50, 12, 2),
(172, 23, 4, 50, 12, 2),
(173, 24, 1, 50, 3, 1),
(174, 24, 2, 50, 3, 1),
(175, 24, 3, 50, 3, 1),
(176, 24, 4, 50, 3, 1),
(177, 25, 1, 50, 6, 1),
(178, 25, 2, 50, 6, 1),
(179, 25, 3, 50, 6, 1),
(180, 25, 4, 50, 6, 1),
(181, 26, 1, 50, 3, 1),
(182, 26, 2, 50, 3, 1),
(183, 26, 3, 50, 3, 1),
(184, 26, 4, 50, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion_periodo`
--

CREATE TABLE `planificacion_periodo` (
  `idPlanificacion_periodo` int(11) NOT NULL,
  `idPlanificacion` int(11) NOT NULL,
  `idPeriodo` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `semanas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planificacion_periodo`
--

INSERT INTO `planificacion_periodo` (`idPlanificacion_periodo`, `idPlanificacion`, `idPeriodo`, `porcentaje`, `semanas`) VALUES
(63, 12, 1, 50, 5),
(64, 12, 2, 50, 6),
(65, 13, 1, 50, 5),
(66, 13, 2, 50, 6),
(67, 14, 1, 50, 6),
(68, 14, 2, 50, 6),
(69, 15, 1, 50, 5),
(70, 15, 2, 50, 6),
(71, 16, 1, 60, 7),
(72, 16, 2, 40, 4),
(73, 17, 1, 50, 6),
(74, 17, 2, 50, 6),
(75, 18, 1, 60, 7),
(76, 18, 2, 40, 4),
(77, 19, 1, 60, 13),
(78, 19, 2, 40, 9),
(79, 20, 1, 50, 6),
(80, 20, 2, 50, 6),
(81, 21, 1, 50, 24),
(82, 21, 2, 50, 24),
(83, 22, 1, 50, 12),
(84, 22, 2, 50, 12),
(85, 23, 1, 50, 24),
(86, 23, 2, 50, 24),
(87, 24, 1, 50, 6),
(88, 24, 2, 50, 6),
(89, 25, 1, 50, 12),
(90, 25, 2, 50, 12),
(91, 26, 1, 50, 6),
(92, 26, 2, 50, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion`
--

CREATE TABLE `programacion` (
  `idProgramacion` int(11) NOT NULL,
  `idDireccion` int(11) NOT NULL,
  `idDia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tiempo` int(11) DEFAULT NULL,
  `tec` int(11) DEFAULT NULL,
  `fis` int(11) DEFAULT NULL,
  `tac` int(11) DEFAULT NULL,
  `psi` int(11) DEFAULT NULL,
  `comp` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `ejer1` int(11) DEFAULT NULL,
  `ejer11` int(11) DEFAULT NULL,
  `ejer2` int(11) DEFAULT NULL,
  `ejer22` int(11) DEFAULT NULL,
  `ejer3` int(11) DEFAULT NULL,
  `ejer33` int(11) DEFAULT NULL,
  `ejer4` int(11) DEFAULT NULL,
  `ejer44` int(11) DEFAULT NULL,
  `ejer5` int(11) DEFAULT NULL,
  `ejer55` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programacion`
--

INSERT INTO `programacion` (`idProgramacion`, `idDireccion`, `idDia`, `fecha`, `tiempo`, `tec`, `fis`, `tac`, `psi`, `comp`, `total`, `ejer1`, `ejer11`, `ejer2`, `ejer22`, `ejer3`, `ejer33`, `ejer4`, `ejer44`, `ejer5`, `ejer55`) VALUES
(93, 486, 2, '0000-00-00', 60, 12, 13, 9, 3, 8, 60, 69, 76, 0, 0, 0, 0, 0, 0, 0, 0),
(94, 497, 1, '2016-05-16', 90, 20, 20, 20, 10, 0, 90, 68, 75, 0, 0, 0, 0, 0, 0, 0, 0),
(95, 520, 2, '0000-00-00', 90, 20, 20, 10, 15, 5, 90, 59, 60, 0, 0, 0, 0, 0, 0, 0, 0),
(96, 531, 1, '2016-05-23', 90, 20, 20, 10, 9, 11, 90, 57, 63, 0, 0, 0, 0, 0, 0, 0, 0),
(97, 532, 1, '2016-05-23', 90, 23, 15, 15, 0, 17, 90, 60, 64, 0, 0, 0, 0, 0, 0, 0, 0),
(98, 486, 6, '0000-00-00', 60, 10, 15, 9, 3, 8, 60, 59, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(99, 542, 2, '0000-00-00', 90, 10, 20, 15, 7, 18, 90, 73, 74, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 542, 4, '0000-00-00', 90, 25, 22, 6, 7, 10, 90, 74, 74, 0, 0, 0, 0, 0, 0, 0, 0),
(101, 554, 1, '2016-05-23', 90, 20, 30, 20, 0, 0, 90, 68, 74, 0, 0, 0, 0, 0, 0, 0, 0),
(102, 565, 1, '2016-05-25', 90, 10, 20, 17, 7, 16, 90, 57, 59, 0, 0, 0, 0, 0, 0, 0, 0),
(103, 566, 1, '2016-05-18', 90, 14, 17, 14, 7, 18, 90, 58, 61, 0, 0, 0, 0, 0, 0, 0, 0),
(104, 566, 5, '2016-05-27', 90, 14, 18, 14, 7, 17, 90, 60, 74, 0, 0, 0, 0, 0, 0, 0, 0),
(105, 487, 2, '2016-05-24', 60, 9, 13, 11, 6, 6, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(106, 487, 4, '0000-00-00', 60, 9, 1, 12, 3, 21, 60, 60, 63, 0, 0, 0, 0, 0, 0, 0, 0),
(107, 488, 1, '2016-05-12', 60, 12, 13, 5, 6, 10, 60, 57, 59, 0, 0, 0, 0, 0, 0, 0, 0),
(108, 489, 1, '2016-05-23', 60, 9, 11, 9, 9, 7, 60, 57, 62, 0, 0, 0, 0, 0, 0, 0, 0),
(109, 755, 1, '0000-00-00', 1, 23, 0, 7, 6, 10, 1, 59, 68, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_ejercicio`
--

CREATE TABLE `sub_ejercicio` (
  `idSub_ejercicio` int(11) NOT NULL,
  `sub_ejercicio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sub_ejercicio`
--

INSERT INTO `sub_ejercicio` (`idSub_ejercicio`, `sub_ejercicio`) VALUES
(1, 'Individual'),
(2, 'Colectiva'),
(3, 'Defensiva'),
(4, '----');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ejercicio`
--

CREATE TABLE `tipo_ejercicio` (
  `idTipo_ejercicio` int(4) NOT NULL,
  `ejercicio` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_ejercicio`
--

INSERT INTO `tipo_ejercicio` (`idTipo_ejercicio`, `ejercicio`) VALUES
(1, 'Ejercicio Tecnico'),
(2, 'Preparacion Fisica'),
(3, 'Sistema de Juego'),
(4, 'Acciones Psicologicas'),
(5, 'Competencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_info`
--

CREATE TABLE `tipo_info` (
  `idTipo_info` int(4) NOT NULL,
  `informacion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_info`
--

INSERT INTO `tipo_info` (`idTipo_info`, `informacion`) VALUES
(1, 'Libros'),
(2, 'Link'),
(3, 'Videos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_plan`
--

CREATE TABLE `tipo_plan` (
  `idTipo_plan` int(11) NOT NULL,
  `plan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_plan`
--

INSERT INTO `tipo_plan` (`idTipo_plan`, `plan`) VALUES
(1, 'Anual'),
(2, 'Trimestral'),
(3, 'Semestral'),
(4, 'Competencia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idAsistencia`),
  ADD KEY `idClase` (`idGrupCat`),
  ADD KEY `idJugador` (`idPlanificacion`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `categoria_grupo`
--
ALTER TABLE `categoria_grupo`
  ADD PRIMARY KEY (`idCategoria_grupo`),
  ADD KEY `idGrupo` (`idGrupo`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`idClase`);

--
-- Indices de la tabla `deporte`
--
ALTER TABLE `deporte`
  ADD PRIMARY KEY (`idDeporte`);

--
-- Indices de la tabla `dia`
--
ALTER TABLE `dia`
  ADD PRIMARY KEY (`idDia`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`idDireccion`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`idEjercicio`),
  ADD KEY `idTipo_ejercicio` (`idTipo_ejercicio`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `idEjer_tecnico` (`idEjer_tecnico`);

--
-- Indices de la tabla `elemento_tecnico`
--
ALTER TABLE `elemento_tecnico`
  ADD PRIMARY KEY (`idEjer_tecnico`),
  ADD KEY `idTipo_ejercicio` (`idTipo_ejercicio`);

--
-- Indices de la tabla `entrenador`
--
ALTER TABLE `entrenador`
  ADD PRIMARY KEY (`idEntrenador`);

--
-- Indices de la tabla `etapas`
--
ALTER TABLE `etapas`
  ADD PRIMARY KEY (`idEtapa`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`idEvaluacion`),
  ADD KEY `idAsistencia` (`idJugador`);

--
-- Indices de la tabla `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`),
  ADD KEY `idDeporte` (`idDeporte`),
  ADD KEY `idEntrenador` (`idEntrenador`);

--
-- Indices de la tabla `informacion`
--
ALTER TABLE `informacion`
  ADD PRIMARY KEY (`idInformacion`),
  ADD KEY `idDeporte` (`idDeporte`),
  ADD KEY `idTipo_info` (`idTipo_info`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`idJugador`),
  ADD KEY `idGrupo` (`idGrupCat`);

--
-- Indices de la tabla `mesociclo`
--
ALTER TABLE `mesociclo`
  ADD PRIMARY KEY (`idMesociclo`);

--
-- Indices de la tabla `name_evaluacion`
--
ALTER TABLE `name_evaluacion`
  ADD PRIMARY KEY (`idName_evaluacion`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`idPeriodo`);

--
-- Indices de la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD PRIMARY KEY (`idPlanificacion`),
  ADD KEY `idGrupo` (`idGrupo`);

--
-- Indices de la tabla `planificacion_etapa`
--
ALTER TABLE `planificacion_etapa`
  ADD PRIMARY KEY (`idPlanificacion_etapa`);

--
-- Indices de la tabla `planificacion_periodo`
--
ALTER TABLE `planificacion_periodo`
  ADD PRIMARY KEY (`idPlanificacion_periodo`);

--
-- Indices de la tabla `programacion`
--
ALTER TABLE `programacion`
  ADD PRIMARY KEY (`idProgramacion`);

--
-- Indices de la tabla `sub_ejercicio`
--
ALTER TABLE `sub_ejercicio`
  ADD PRIMARY KEY (`idSub_ejercicio`);

--
-- Indices de la tabla `tipo_ejercicio`
--
ALTER TABLE `tipo_ejercicio`
  ADD PRIMARY KEY (`idTipo_ejercicio`);

--
-- Indices de la tabla `tipo_info`
--
ALTER TABLE `tipo_info`
  ADD PRIMARY KEY (`idTipo_info`);

--
-- Indices de la tabla `tipo_plan`
--
ALTER TABLE `tipo_plan`
  ADD PRIMARY KEY (`idTipo_plan`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idAsistencia` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `categoria_grupo`
--
ALTER TABLE `categoria_grupo`
  MODIFY `idCategoria_grupo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `idClase` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `deporte`
--
ALTER TABLE `deporte`
  MODIFY `idDeporte` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dia`
--
ALTER TABLE `dia`
  MODIFY `idDia` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `idDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=767;
--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `idEjercicio` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT de la tabla `elemento_tecnico`
--
ALTER TABLE `elemento_tecnico`
  MODIFY `idEjer_tecnico` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `entrenador`
--
ALTER TABLE `entrenador`
  MODIFY `idEntrenador` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `idEvaluacion` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `informacion`
--
ALTER TABLE `informacion`
  MODIFY `idInformacion` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `idJugador` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mesociclo`
--
ALTER TABLE `mesociclo`
  MODIFY `idMesociclo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT de la tabla `name_evaluacion`
--
ALTER TABLE `name_evaluacion`
  MODIFY `idName_evaluacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `idPeriodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `planificacion`
--
ALTER TABLE `planificacion`
  MODIFY `idPlanificacion` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `planificacion_etapa`
--
ALTER TABLE `planificacion_etapa`
  MODIFY `idPlanificacion_etapa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;
--
-- AUTO_INCREMENT de la tabla `planificacion_periodo`
--
ALTER TABLE `planificacion_periodo`
  MODIFY `idPlanificacion_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT de la tabla `programacion`
--
ALTER TABLE `programacion`
  MODIFY `idProgramacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT de la tabla `sub_ejercicio`
--
ALTER TABLE `sub_ejercicio`
  MODIFY `idSub_ejercicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo_ejercicio`
--
ALTER TABLE `tipo_ejercicio`
  MODIFY `idTipo_ejercicio` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tipo_info`
--
ALTER TABLE `tipo_info`
  MODIFY `idTipo_info` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`idGrupCat`) REFERENCES `clases` (`idClase`);

--
-- Filtros para la tabla `categoria_grupo`
--
ALTER TABLE `categoria_grupo`
  ADD CONSTRAINT `categoria_grupo_ibfk_1` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`),
  ADD CONSTRAINT `categoria_grupo_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Filtros para la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD CONSTRAINT `ejercicio_ibfk_1` FOREIGN KEY (`idTipo_ejercicio`) REFERENCES `tipo_ejercicio` (`idTipo_ejercicio`),
  ADD CONSTRAINT `ejercicio_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`),
  ADD CONSTRAINT `ejercicio_ibfk_3` FOREIGN KEY (`idEjer_tecnico`) REFERENCES `elemento_tecnico` (`idEjer_tecnico`);

--
-- Filtros para la tabla `elemento_tecnico`
--
ALTER TABLE `elemento_tecnico`
  ADD CONSTRAINT `elemento_tecnico_ibfk_1` FOREIGN KEY (`idTipo_ejercicio`) REFERENCES `tipo_ejercicio` (`idTipo_ejercicio`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`idDeporte`) REFERENCES `deporte` (`idDeporte`),
  ADD CONSTRAINT `grupo_ibfk_3` FOREIGN KEY (`idEntrenador`) REFERENCES `entrenador` (`idEntrenador`);

--
-- Filtros para la tabla `informacion`
--
ALTER TABLE `informacion`
  ADD CONSTRAINT `informacion_ibfk_1` FOREIGN KEY (`idDeporte`) REFERENCES `deporte` (`idDeporte`),
  ADD CONSTRAINT `informacion_ibfk_2` FOREIGN KEY (`idTipo_info`) REFERENCES `tipo_info` (`idTipo_info`);

--
-- Filtros para la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD CONSTRAINT `planificacion_ibfk_1` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
