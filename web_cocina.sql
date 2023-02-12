-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2023 a las 17:39:26
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
-- Base de datos: `web_cocina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_user` int(2) NOT NULL,
  `lunes` int(3) NOT NULL,
  `martes` int(3) NOT NULL,
  `miercoles` int(3) NOT NULL,
  `jueves` int(3) NOT NULL,
  `viernes` int(3) NOT NULL,
  `sabado` int(3) NOT NULL,
  `domingo` int(3) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_user`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `domingo`, `fecha`) VALUES
(3, 4, 3, 5, 13, 1, 11, 14, '2023-02-06'),
(8, 2, 16, 4, 5, 14, 13, 1, '2023-02-07');

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
  `categoria` varchar(30) NOT NULL,
  `ingredientes` varchar(350) NOT NULL,
  `alergenos` varchar(50) DEFAULT NULL,
  `pasos` varchar(1000) NOT NULL,
  `fecha` date NOT NULL COMMENT 'Fecha de subida de la receta',
  `puntuacion` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_receta`, `id_user`, `nombre`, `imagen`, `tiempo`, `categoria`, `ingredientes`, `alergenos`, `pasos`, `fecha`, `puntuacion`) VALUES
(1, 3, 'Albondigas con tomate', 'imagenes/recetas/Albondigascontomate_3.jpg', 50, 'Carnes y aves', '1/4 kg de lomo de vaca, 1/4 kg de magro de cerdo, 50 g de tocino, 2 huevos, 2 cucharadas de pan rallado, ajo, perejil, pimienta, sal, harina de rebozar, 2 cebollas, 1 kg de tomates, 1 taza de aceite', NULL, 'Picar las 2 carnes con el tocino. Colocar en una hondilla los ingredientes, picando el ajo y el perejil. Formar las albóndigas, pasarlas por harina y dorarlas en aceite puesto en una sartén al fuego. En el aceite sobrante, ablandar la otra cebolla picada, añadir el tomate pelado y troceado y dejar hacer en fuego lento 10 min. Ya hecho el tomate, volcar sobre las albóndigas y poner a fuego medio hasta que hierva. Bajar a fuego lento y dejar hacer 25 min, mover con frecuencia para que no se pegue', '2023-01-19', 0),
(2, 3, 'Filetes empanados', 'imagenes/recetas/Filetesempanados_3.jpg', 30, 'Carnes y aves', '1kg de carne (pollo o cerdo), 3 huevos, pan rallado, sal, pimienta, perejil, aceite para freir', NULL, 'Cortar la carne en filetes finos. Colocar el pan rallado y los huevos en cuencos distintos, batir los huevos. Sazonar la carne con la sal perejil y pimienta. Pasar los filetes por el cuenco con huevo y después rebozarlo con el pan rallado. Preparar una sartén u olla con el aceite y calentar a fuego alto. Freír los filetes a fuego medio-alto durante 1 min a cada lado, en grupos pequeños para evitar enfriar el aceite. Al sacarlos, colocarlos en una bandeja con papel de cocina para absorber el acei', '2023-01-19', 0),
(3, 3, 'Pasta con tomate', 'imagenes/recetas/Pastacontomate_3.jpg', 40, 'Pastas', 'pasta seca, bote de tomate triturado, sal, aceite, queso rallado', NULL, 'Preparar una sartén con aceite para freír el tomate. Echar todo el tomate de la lata con un culito de agua. Salar la salsa al gusto y poner fuego medio-bajo, freír a fuego medio-bajo durante 40 minutos, moviendo de vez en cuando para que no se pegue. Cocer la pasta en una olla de agua hirviendo hasta que esté al dente. Colar la pasta, echar queso una vez servido', '2023-01-24', 0),
(4, 3, 'Ensalada de judias verdes', 'imagenes/recetas/Ensaladadejudiasverdes_3.jpg', 40, 'Verduras y legumbres', 'Judias verdes, media cebolla, patatas (por número de personas), huevo (por número de personas), sal, perejil, aceite, ajo', '', 'Pelar las patatas y trocear las judías, lavarlas con agua y depositar en una olla con agua. Cocer las judías y patatas hasta que estén blandas. Picar la cebolla o dejarla en aritos (lo que más guste) y picar los ajos. Preparar el aliño en un mortero, empezando con el ajo picado, sal y perejil. Echar a la mezcla el aceite y seguir moviendo hasta que se homogenice. Cocer los huevos hasta que estén duros (10 min). Servir las judías y la patata como base, echar la cebolla picada y mezclar, antes de servir aliñar con la mezcla del mortero', '2023-01-30', 0),
(5, 3, 'Salmón asado', 'imagenes/recetas/Salmónasado_3.jpg', 20, 'Pescado y mariscos', '2 filetes de salmón, aceite, perejil, salsa mostaza con grano, sal', NULL, 'Preparar bandeja de horno con papel vegetal, con un pincel recubrir una capa de aceite donde se ponga el salmón. Poner el salmón en la bandeja y pintar con el pincel sobre ellos la salsa mostaza. Luego esparcir la sal y el perejil al gusto. Hornear 15 minutos a 175 ºC fuego arriba y abajo con ventilación', '2023-01-24', 0),
(11, 8, 'Pollo al vino', 'imagenes/recetas/Polloalvino_11.png', 90, 'Carnes y aves', 'gfsgfsg', NULL, 'gfsfgfsgs', '2023-01-24', 0),
(12, 8, 'Ajoblanco', 'imagenes/recetas/Ajoblanco_12.png', 30, 'Sopas, cremas y cocidos', 'fdafdafda', NULL, 'fdsafdsafaf', '2023-01-24', 0),
(13, 5, 'Sopa de cebolla', 'imagenes/recetas/Sopadecebolla_13.png', 60, 'Sopas, cremas y cocidos', '600d de cebollas, 70g de aceite, 1 cucharada de harina, 100g de queso rallado, 15 rebanadas finas de pan, pimienta blanca molida, sal', NULL, 'Pelar y picar las cebollas; rehogarlas en la satén a fuego lento hasta que estén transparentes y blandas pero sin dorarse. Sazonar con sal y pimienta. Cuando estén casi desechas, agregar la harina y remover hasta obtener una mezcla dorada. Poner esta preparación en una cacerola y verter un cuarto de litro de agua fría. Dejar cocer 40 min a fuego medio-suave. Freír las rebanadas de pan con aceite; escurrirlas y reservarlas. Calentar el horno a temperatura media-alta. Preparar cuencos individuales', '2023-01-30', 0),
(14, 5, 'Crema de mejillones', 'imagenes/recetas/Cremademejillones_14.png', 60, 'Sopas, cremas y cocidos', '1kg de mejillones, 1 bote de leche evaporada, 2 yemas de huevo, 1 cucharada de Ketchup, Unas gotas de salsa Perrins, 40g de mantequilla, 2 cucharadas de harina, sal y pimienta', 'Mejillones', 'Limpiar los mejillones quitando las barbas, raspando con un cuchillo. Ponerlos en una cacerola al fuego con un vaso de agua hasta que se abran. En un cazo de fondo grueso; fundir la mantequilla y rehogar un 1min la harina. Separar del fuego y añadir la leche mezclada con igual cantidad de agua. Revolver y acercar al fuego. Llevar a ebullición sin dejar de remover y cocer 5min. Debe quedar como una bechamel clara. Sacar los mejillones de sus conchas y reservarlos. Colar el agua de cocerlos y añadirla a la crema con el kétchup y la salsa Perrins. Salpimentar y se añade agua si está muy espesa la mezcla. Retirar la cacerola del fuego y añadir las yemas, batiéndolo. Verterla muy caliente en sopera, añadir los mejillones y servir', '2023-01-30', 0),
(16, 5, 'Albóndigas en salsa', 'imagenes/recetas/Albóndigasensalsa_16.png', 100, 'Carnes y aves', '600g de carne de ternera picada, 2 huevos, 1 zanahoria, 1 cebolla pequeña, 30g de piñones, 50g de pasas sin pepitas, 5 cucharadas de pan rallado, 2 cucharadas de harina, aceite, 1/2L de caldo de carne, 1 vaso de vino blanco, mostaza, sal y pimienta', NULL, 'Colocar la carne en una hondilla y añadirle los huevos batidos, la cebolla, perejil, zanahoria muy picada, sal, los piñoes y las pasas previamente remojadas una hora en agua. Añadir 3 cucharadas de pan rallado para hacer una masa bien mezclada. Formar las albóndigas, pasarlas por el pan rallado y freírlas en el aceite puesto en una sartén al fuego. Colocarlas en una cacerola con un vaso de agua y 1/2 de vino blanco. Cocer 20 min y guardar al calor. Colocar aceite en una sartén e incorporar la harina. Remover hasta conseguir un color dorado. Agregar el caldo, el vino y dejar cocer 15 min. Sazonar al gusto y al final añadir una cucharadita de mostaza', '2023-01-30', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_reporte` int(3) NOT NULL,
  `id_user` int(2) NOT NULL,
  `id_receta` int(3) NOT NULL,
  `fecha` date NOT NULL,
  `motivo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `foto` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `nombre`, `contraseña`, `foto`) VALUES
(1, 'Admin', 'c5e3539121c4944f2bbe097b425ee774', NULL),
(3, 'marcos', 'c5e3539121c4944f2bbe097b425ee774', '../imagenes/usuarios/Marcos1199_3.jpg'),
(4, 'carlos', 'dc599a9972fde3045dab59dbd1ae170b', NULL),
(5, 'paloma', 'a20df7f02202e665e6a7b674bbfb1fcc', '../imagenes/usuarios/paloma_5.jpg'),
(6, 'laura', '680e89809965ec41e64dc7e447f175ab', NULL),
(7, 'miguel', '9eb0c9605dc81a68731f61b3e0838937', NULL),
(8, 'juan', 'a94652aa97c7211ba8954dd15a3cf838', NULL),
(9, 'pepe', '926e27eecdbc7a18858b3798ba99bddd', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votacion`
--

CREATE TABLE `votacion` (
  `id_voto` int(3) NOT NULL,
  `id_user` int(2) NOT NULL,
  `id_receta` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `lunes` (`lunes`),
  ADD KEY `martes` (`martes`),
  ADD KEY `miercoles` (`miercoles`),
  ADD KEY `jueves` (`jueves`),
  ADD KEY `viernes` (`viernes`),
  ADD KEY `sabado` (`sabado`),
  ADD KEY `domingo` (`domingo`);

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
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `id_receta` (`id_receta`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `votacion`
--
ALTER TABLE `votacion`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `id_user` (`id_user`,`id_receta`),
  ADD KEY `id_receta` (`id_receta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_receta` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id_reporte` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `votacion`
--
ALTER TABLE `votacion`
  MODIFY `id_voto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`),
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`lunes`) REFERENCES `receta` (`id_receta`),
  ADD CONSTRAINT `menu_ibfk_3` FOREIGN KEY (`martes`) REFERENCES `receta` (`id_receta`),
  ADD CONSTRAINT `menu_ibfk_4` FOREIGN KEY (`miercoles`) REFERENCES `receta` (`id_receta`),
  ADD CONSTRAINT `menu_ibfk_5` FOREIGN KEY (`jueves`) REFERENCES `receta` (`id_receta`),
  ADD CONSTRAINT `menu_ibfk_6` FOREIGN KEY (`viernes`) REFERENCES `receta` (`id_receta`),
  ADD CONSTRAINT `menu_ibfk_7` FOREIGN KEY (`sabado`) REFERENCES `receta` (`id_receta`),
  ADD CONSTRAINT `menu_ibfk_8` FOREIGN KEY (`domingo`) REFERENCES `receta` (`id_receta`);

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`);

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `receta` (`id_receta`),
  ADD CONSTRAINT `reporte_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`);

--
-- Filtros para la tabla `votacion`
--
ALTER TABLE `votacion`
  ADD CONSTRAINT `votacion_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`),
  ADD CONSTRAINT `votacion_ibfk_2` FOREIGN KEY (`id_receta`) REFERENCES `receta` (`id_receta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
