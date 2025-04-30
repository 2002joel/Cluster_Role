-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-04-2025 a las 06:39:42
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
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_usuarios`
--

DROP TABLE IF EXISTS `chat_usuarios`;
CREATE TABLE IF NOT EXISTS `chat_usuarios` (
  `id_chat_usuarios` int NOT NULL AUTO_INCREMENT,
  `id_chat` int NOT NULL,
  `id_usuarios` int NOT NULL,
  PRIMARY KEY (`id_chat_usuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friend`
--

DROP TABLE IF EXISTS `friend`;
CREATE TABLE IF NOT EXISTS `friend` (
  `id_user` int NOT NULL,
  `id_friend` int NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`,`id_friend`),
  KEY `id_friend` (`id_friend`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
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
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `contraseña`, `email`, `creation_date`, `positivo`, `negativo`, `profile_photo`, `premium`, `baneo`, `administrador`) VALUES
(2, 'prueba', '$2y$10$onE9tSPfYq7h6', 'a@gmail.com', '2025-04-16 13:14:59', 0, 0, NULL, NULL, NULL, NULL),
(3, 'prueba1', '$2y$10$kw6CD71iNA0oR', 'si@gmail.com', '2025-04-16 15:31:49', 0, 0, NULL, NULL, NULL, NULL),
(4, 'prueba2', '$2y$10$FqS/EUPsxoeYpFoS5lrfeO1uq0G3Y3N7TNkNdMjoQvWO0T1bKIQDy', 'aa@gmail.com', '2025-04-16 15:59:42', 0, 0, NULL, NULL, NULL, NULL),
(5, 'admin', '$2y$10$cKeUHkBVe7Q7FIinNP8reuuaa2B88OtQ.tDnxKcyKJloADmgnwEla', 'admin@hotmail.com', '2025-04-16 16:10:18', 0, 0, NULL, NULL, NULL, 1),
(6, 'prueba4', '$2y$10$VUtNQYmJ3LB/pNW9a.3BbejlcftPtUXxaxRM53DNuMFhd1J/6q6nK', 'prueba3@hotmail.com', '2025-04-17 13:34:58', 0, 0, NULL, NULL, NULL, NULL),
(7, 'admin1', '$2y$10$CtshdsY63Q88xxm0bfrbcOCIxDazjqQcDdfHfYfNZKYIiUEiXl1SS', 'admin1@hotmail.com', '2025-04-17 13:45:31', 0, 0, NULL, NULL, NULL, 1),
(8, 'joel', '$2y$10$0rsMNajTWbehRxcuZlJ7FOoXhfKph5WB0jV9BWsYhemeYDlG09qgu', 'joel@hotmail.com', '2025-04-17 13:47:50', 0, 0, NULL, NULL, NULL, NULL),
(9, 'alex', '$2y$10$LCgNAKoUBqRvlu2zkTvTzOFf.nksnaMCX5GHcN6QNzbMj15jUgAFa', 'alex2001torres@hotma', '2025-04-24 12:47:32', 0, 0, NULL, NULL, NULL, NULL),
(10, 'admin1234', '$2y$10$GnDE6jdaolhIfhM3lzNnNeQykhjw8oWkYhUi0rmK/v.D3skY4XE5y', 'admin1234@hotmail.co', '2025-04-29 13:02:01', 0, 0, NULL, NULL, NULL, 1);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
