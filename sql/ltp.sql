-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2025 a las 04:31:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ltp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `id_productos` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detalle` int(11) NOT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `id_productos` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detalle`, `id_factura`, `id_productos`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(1, 1, 35, 1, 50.00, 50.00),
(2, 2, 36, 1, 45.00, 45.00),
(3, 3, 33, 5, 35.00, 175.00),
(4, 3, 39, 2, 5.00, 10.00),
(5, 3, 37, 1, 55.00, 55.00),
(6, 3, 36, 1, 45.00, 45.00),
(7, 4, 35, 1, 50.00, 50.00),
(8, 5, 33, 6, 35.00, 210.00),
(9, 5, 41, 1, 8.00, 8.00),
(10, 5, 37, 8, 55.00, 440.00),
(11, 5, 36, 4, 45.00, 180.00),
(12, 5, 39, 1, 5.00, 5.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `id_usuarios` int(11) DEFAULT NULL,
  `fecha_factura` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'pagada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `id_usuarios`, `fecha_factura`, `total`, `estado`) VALUES
(1, 8, '2025-07-12 23:36:23', 50.00, 'pagada'),
(2, 8, '2025-07-12 23:41:23', 45.00, 'pagada'),
(3, 9, '2025-07-13 00:45:14', 285.00, 'pagada'),
(4, 9, '2025-07-13 01:24:02', 50.00, 'pagada'),
(5, 10, '2025-07-13 01:52:14', 843.00, 'pagada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `precio` int(8) NOT NULL,
  `cantidad` int(8) NOT NULL,
  `descripcion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `nombre_producto`, `imagen`, `precio`, `cantidad`, `descripcion`) VALUES
(33, 'Pintura Regional Seda Color', 'assets/productos/productos_33.png', 35, 30, 'La pintura de seda regional, también conocida como pintura sobre seda, es una técnica tradicional de arte textil que consiste en pintar diseños sobre telas de seda, utilizando pinturas o tintes textiles especiales. Se caracteriza por la suavidad y brillo de la seda, lo que permite crear obras vibrantes y con gran luminosidad. '),
(35, 'Pintura Armonia Exterior ', 'assets/productos/productos_35.png', 50, 32, 'Flamuko Armonía Exterior es una pintura de Clase A, formulada para ofrecer la máxima protección y belleza duradera en superficies exteriores. Su calidad superior garantiza una excelente cubrición y resistencia a las inclemencias del tiempo, como la lluvia, el sol intenso y los cambios de temperatura. Ideal para embellecer y salvaguardar fachadas y muros, proporcionando un acabado uniforme y de gran adherencia que mantiene su viveza con el paso del tiempo. Con Flamuko Armonía Exterior, invierte en un acabado de alto rendimiento que transforma y protege tus espacios al aire libre con la garantía de una pintura Clase A.'),
(36, 'Pintura Armonia Interior', 'assets/productos/productos_36.png', 45, 36, 'Flamuko Armonía Interior es una pintura de Clase A, especialmente diseñada para transformar y proteger los ambientes de tu hogar u oficina. Su fórmula de alta calidad asegura una excelente adherencia y un acabado uniforme en superficies interiores, proporcionando una cobertura superior y una gran facilidad de aplicación. Ideal para renovar tus espacios con colores vibrantes y duraderos, esta pintura Clase A ofrece una resistencia destacada al roce y al paso del tiempo, manteniendo la frescura y elegancia de tus paredes. Con Flamuko Armonía Interior, invierte en un ambiente renovado y sofisticado, respaldado por la calidad garantizada de una pintura de Clase A.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(37, 'Pintura Armonia En Aceite', 'assets/productos/productos_37.png', 55, 52, 'Flamuko Armonía en Aceite es una pintura de alto rendimiento diseñada para superficies que requieren una extraordinaria durabilidad y un acabado resistente. Ideal para áreas de alto tráfico o donde se necesite una limpieza frecuente, su formulación a base de aceite ofrece una cobertura superior y un acabado liso y uniforme. Proporciona una excelente resistencia a la abrasión y al desgaste, lo que la hace perfecta para puertas, ventanas, marcos y otras superficies de madera o metal tanto en interiores como en exteriores. Con Flamuko Armonía en Aceite, obtén una protección robusta y un brillo perdurable que mantiene la belleza de tus espacios por más tiempo.'),
(38, 'Pintura Armonia Caucho Semibrillante', 'assets/productos/productos_38.png', 60, 20, 'Flamuko Armonía Caucho Semibrillante es una pintura versátil, ideal para quienes buscan un acabado con un sutil toque de brillo y alta resistencia. Su formulación tipo caucho le confiere una excelente elasticidad y adherencia, lo que la hace perfecta para paredes de interior y exterior que requieren durabilidad y facilidad de mantenimiento. Ofrece una magnífica cubrición y un secado rápido, proporcionando una superficie lavable que resiste el desgaste diario y la aparición de hongos. Con Armonía Caucho Semibrillante, tus espacios lucirán impecables con un brillo discreto y una protección superior por mucho más tiempo.\r\n'),
(39, 'Brocha 4', 'assets/productos/productos_39.png', 5, 10, 'Brocha epica'),
(41, 'Cinta De Embalaje 3M', 'assets/productos/productos_41.jpg', 8, 50, 'La cinta de embalaje 3M es una solución de sellado de alta calidad, reconocida por su resistencia y durabilidad en el cierre de cajas y paquetes. Fabricada con adhesivos potentes, ofrece una adherencia superior y un agarre instantáneo en diversas superficies, asegurando que tus envíos permanezcan protegidos durante el transporte y almacenamiento. Ideal para uso doméstico, comercial e industrial, la cinta de embalaje 3M garantiza un sellado seguro y confiable, resistiendo desgarros y perforaciones para mantener la integridad de tus productos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `admin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `usuario`, `email`, `contraseña`, `admin`) VALUES
(1, 'santiago', 'santiago@gmail.com', '29655065', 1),
(4, 'sater20', 'saterff03@gmail.com', '$2y$10$9RizTi1a', NULL),
(6, 'enmanuel', 'qlq@gmail.com', '$2y$10$UyIRMX.e', NULL),
(8, 'hector ', 'hector@gmail.com', '$2y$10$E744CB7vNFEw4Gcf9qXR7eD9TQp3.JlAgmLtVui1qonAKpTVadAna', NULL),
(9, 'ana ', 'ana@gmail.com', '$2y$10$AFIBAwXEdsKGtb7egxsVA.Gu2Xi5QesDPjwlARFEVcZ1PPa5vlL06', NULL),
(10, 'cris', 'cris@gmail.com', '$2y$10$A7ssLgrOtdhA6o6j8YG1.uU/t/c34GEtUO9WkrFaYWnQe4SESqu3i', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_usuarios` (`id_usuarios`,`id_productos`),
  ADD KEY `id_productos` (`id_productos`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_factura` (`id_factura`,`id_productos`),
  ADD KEY `id_productos` (`id_productos`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_usuarios` (`id_usuarios`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id_productos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id_productos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
