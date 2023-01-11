-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2023 a las 11:30:33
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `web_cocina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(3) NOT NULL,
  `activo` int(1) NOT NULL,
  `dia_semana` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_receta` int(3) NOT NULL,
  `id_user` int(2) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(350) NOT NULL,
  `tiempo` int(3) NOT NULL,
  `num_personas` int(1) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `ingredientes` varchar(350) NOT NULL,
  `alergenos` varchar(50) DEFAULT NULL,
  `pasos` varchar(500) NOT NULL,
  `fecha` date NOT NULL COMMENT 'Fecha de subida de la receta',
  `puntuacion` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_receta`, `id_user`, `nombre`, `imagen`, `tiempo`, `num_personas`, `categoria`, `ingredientes`, `alergenos`, `pasos`, `fecha`, `puntuacion`) VALUES
(1, 3, 'Albondigas con tomate', '../imagenes/recetas/Albondigas con tomate_1.jpg', 50, 4, 'Carnes y aves', '1/4 kg de lomo de vaca, 1/4 kg de magro de cerdo, 50 g de tocino, 2 huevos, 2 cucharadas de pan rallado, ajo, perejil, pimienta, sal, harina de rebozar, 2 cebollas, 1 kg de tomates, 1 taza de aceite', NULL, 'Picar las 2 carnes con el tocino. Colocar en una hondilla los ingredientes, picando el ajo y el perejil. Formar las albóndigas, pasarlas por harina y dorarlas en aceite puesto en una sartén al fuego. En el aceite sobrante, ablandar la otra cebolla picada, añadir el tomate pelado y troceado y dejar hacer en fuego lento 10 min. Ya hecho el tomate, volcar sobre las albóndigas y poner a fuego medio hasta que hierva. Bajar a fuego lento y dejar hacer 25 min, mover con frecuencia para que no se pegue', '2022-11-30', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_reporte` int(3) NOT NULL,
  `fecha` date NOT NULL,
  `motivo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `foto` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `nombre`, `contraseña`, `foto`) VALUES
(1, 'Admin', 'c5e3539121c4944f2bbe097b425ee774', NULL),
(3, 'marcos', 'c5e3539121c4944f2bbe097b425ee774', NULL),
(4, 'carlos', 'dc599a9972fde3045dab59dbd1ae170b', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id_reporte`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_receta` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id_reporte` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
