-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-05-2025 a las 08:11:20
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cluster_role`
--
CREATE DATABASE IF NOT EXISTS `cluster_role` DEFAULT CHARACTER SET ucs2 COLLATE ucs2_spanish_ci;
USE `cluster_role`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

DROP TABLE IF EXISTS `amigos`;
CREATE TABLE IF NOT EXISTS `amigos` (
  `id_user` int NOT NULL,
  `id_friend` int NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`,`id_friend`),
  KEY `id_friend` (`id_friend`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id_chat` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `text` varchar(100) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_chat`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id_chat`, `id_user`, `text`, `date`) VALUES
(1, 10, 'hola est es un aprueba', '2025-04-30 09:14:54'),
(2, 9, 'hola', '2025-05-06 09:07:42'),
(3, 9, 'hola', '2025-05-06 09:08:17'),
(4, 9, 'prueba', '2025-05-06 09:09:45'),
(5, 9, 'prueba', '2025-05-06 09:10:17'),
(6, 10, 'hola soy el admin de esta paguina web i esty haciendo pruba para comprobar que todo esto funciona co', '2025-05-06 09:19:11'),
(7, 10, 'hola soy el admin de esta paguina web i esty haciendo pruba para comprobar que todo esto funciona co', '2025-05-06 09:19:33'),
(8, 10, 'hola soy el admin de esta paguina web i esty haciendo pruba para comprobar que todo esto funciona co', '2025-05-06 09:19:45'),
(9, 10, 'sisisi', '2025-05-06 09:21:26'),
(10, 10, 'aaaaaaa', '2025-05-06 09:22:53'),
(11, 9, 'aaaa', '2025-05-06 09:30:39'),
(12, 10, 'hola\r\n\r\n\r\n\r\n', '2025-05-06 09:36:25'),
(13, 10, 'hh', '2025-05-06 09:37:22'),
(14, 10, 'aaaaa', '2025-05-06 09:45:06'),
(15, 10, 'aaaa', '2025-05-06 09:45:42'),
(16, 10, 'aaaaaaaaaaaaaaa', '2025-05-06 09:53:13'),
(17, NULL, 'aaaaaaa', '2025-05-06 09:54:28'),
(18, NULL, 'hola\r\n', '2025-05-06 09:55:11'),
(19, 10, 'aaaa', '2025-05-06 09:55:45'),
(20, 10, 'aaa', '2025-05-06 09:55:50'),
(21, 10, 'hola', '2025-05-06 09:55:58'),
(22, 10, 'aaaaaaaaaaaaaaaaaaaaaaaa', '2025-05-06 09:56:31'),
(23, 10, 'AAAAAAAAAAA', '2025-05-06 09:57:16'),
(24, 10, 'aaa', '2025-05-06 09:58:25'),
(25, 10, 'hola\r\n', '2025-05-06 10:01:19'),
(26, 9, 'hola', '2025-05-06 10:05:04'),
(27, 9, 'prueba', '2025-05-06 10:07:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_usuarios`
--

DROP TABLE IF EXISTS `chat_usuarios`;
CREATE TABLE IF NOT EXISTS `chat_usuarios` (
  `id_chat_usuarios` int NOT NULL AUTO_INCREMENT,
  `id_chat` int NOT NULL,
  `id_usuarios` int NOT NULL,
  PRIMARY KEY (`id_chat_usuarios`),
  KEY `fk_usuarios` (`id_usuarios`),
  KEY `fk_chat` (`id_chat`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

--
-- Volcado de datos para la tabla `chat_usuarios`
--

INSERT INTO `chat_usuarios` (`id_chat_usuarios`, `id_chat`, `id_usuarios`) VALUES
(1, 2, 9),
(2, 3, 9),
(3, 4, 9),
(4, 5, 9),
(5, 1, 10),
(6, 11, 9),
(7, 17, 10),
(8, 18, 10),
(9, 26, 9),
(10, 27, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id_group` int NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `creation_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `users` int DEFAULT NULL,
  `profile_photo` blob,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `id_report` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `id_user_reported` int DEFAULT NULL,
  `motive` varchar(100) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `explanation` varchar(100) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `report_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `resolved` tinyint(1) DEFAULT NULL,
  `resolved_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_report`),
  KEY `id_user` (`id_user`),
  KEY `id_user_reported` (`id_user_reported`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `update_log`
--

DROP TABLE IF EXISTS `update_log`;
CREATE TABLE IF NOT EXISTS `update_log` (
  `id_update` int NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `version` varchar(20) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `short_explanation` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `long_explanation` varchar(500) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_update`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `id_user_group` int NOT NULL AUTO_INCREMENT,
  `id_group` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `id_creator_user` int DEFAULT NULL,
  PRIMARY KEY (`id_user_group`),
  KEY `id_group` (`id_group`),
  KEY `id_user` (`id_user`),
  KEY `id_creator_user` (`id_creator_user`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `contraseña` varchar(100) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `email` varchar(20) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci DEFAULT NULL,
  `creation_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `positivo` int DEFAULT '0',
  `negativo` int DEFAULT '0',
  `profile_photo` blob,
  `premium` tinyint(1) DEFAULT NULL,
  `baneo` tinyint(1) DEFAULT NULL,
  `administrador` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `user_name`, `contraseña`, `email`, `creation_date`, `positivo`, `negativo`, `profile_photo`, `premium`, `baneo`, `administrador`) VALUES
(2, 'prueba', '$2y$10$onE9tSPfYq7h6', 'a@gmail.com', '2025-04-16 13:14:59', 0, 0, NULL, NULL, NULL, NULL),
(3, 'prueba1', '$2y$10$kw6CD71iNA0oR', 'si@gmail.com', '2025-04-16 15:31:49', 0, 0, NULL, NULL, NULL, NULL),
(4, 'prueba2', '$2y$10$FqS/EUPsxoeYpFoS5lrfeO1uq0G3Y3N7TNkNdMjoQvWO0T1bKIQDy', 'aa@gmail.com', '2025-04-16 15:59:42', 0, 0, NULL, NULL, NULL, NULL),
(5, 'admin', '$2y$10$cKeUHkBVe7Q7FIinNP8reuuaa2B88OtQ.tDnxKcyKJloADmgnwEla', 'admin@hotmail.com', '2025-04-16 16:10:18', 0, 0, NULL, NULL, NULL, 1),
(6, 'prueba4', '$2y$10$VUtNQYmJ3LB/pNW9a.3BbejlcftPtUXxaxRM53DNuMFhd1J/6q6nK', 'prueba3@hotmail.com', '2025-04-17 13:34:58', 0, 0, NULL, NULL, NULL, NULL),
(7, 'admin1', '$2y$10$CtshdsY63Q88xxm0bfrbcOCIxDazjqQcDdfHfYfNZKYIiUEiXl1SS', 'admin1@hotmail.com', '2025-04-17 13:45:31', 0, 0, NULL, NULL, NULL, 1),
(8, 'joel', '$2y$10$0rsMNajTWbehRxcuZlJ7FOoXhfKph5WB0jV9BWsYhemeYDlG09qgu', 'joel@hotmail.com', '2025-04-17 13:47:50', 15, 0, NULL, NULL, NULL, NULL),
(9, 'alex', '$2y$10$LCgNAKoUBqRvlu2zkTvTzOFf.nksnaMCX5GHcN6QNzbMj15jUgAFa', 'alex2001torres@hotma', '2025-04-24 12:47:32', 10, 0, NULL, NULL, NULL, NULL),
(10, 'admin1234', '$2y$10$GnDE6jdaolhIfhM3lzNnNeQykhjw8oWkYhUi0rmK/v.D3skY4XE5y', 'admin1234@hotmail.co', '2025-04-29 13:02:01', 0, 0, NULL, NULL, NULL, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chat_usuarios`
--
ALTER TABLE `chat_usuarios`
  ADD CONSTRAINT `fk_chat` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_usuarios` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
