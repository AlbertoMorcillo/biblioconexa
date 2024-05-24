-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para biblioconexa
USE `a.morcillo_biblioconexa`;

-- Volcando estructura para tabla biblioconexa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dni` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isAdmin` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_dni_unique` (`dni`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.users: ~4 rows (aproximadamente)
INSERT INTO `users` (`id`, `dni`, `name`, `surname`, `email`, `email_verified_at`, `password`, `phone`, `birthdate`, `remember_token`, `isAdmin`, `created_at`, `updated_at`) VALUES
	(1, '47276750C', 'Alberto', NULL, 'a.morcillo@sapalomera.cat', '2024-05-20 11:16:23', '$2y$12$HbC2hS6xEhUvAx51W/TxSOMrivBiT5r.5a8k2kHYsGRRewvmTtESy', '634797322', NULL, 'ufzEruNWXij2cYpCilPGQ3tfHxuDeYnummjxkSUapsimzPYfvP3Jo0atTKX8', 0, '2024-05-20 11:16:23', '2024-05-23 12:03:52'),
	(2, '32311965R', 'Elinor', 'Caskey', 'elinor@admin.com', '2024-05-20 11:16:23', '$2y$12$16M40CJ8D77MHROfiDabFurBlzKY/0O569SrtVi1TbkTEjPTfqqmW', '123456789', '1990-01-01', 'MTW6sgJmxbL1rdZXSfBIAz2OcbMtafKgxBe5cn0h9kJQBMRbSy2zc3MATDSZ', 1, '2024-05-20 11:16:23', '2024-05-20 11:16:23'),
	(3, '36776804B', 'Mondongo', 'Cangrejo', 'mondongo@admin.com', '2024-05-20 11:16:23', '$2y$12$OsCaprZJfFVcUmq3sHxfc.qz2JGK.uT3/N/S4V2NBB3x3.hBut9O6', '123456789', '1993-01-01', 'xTzJN9b4t8', 1, '2024-05-20 11:16:24', '2024-05-20 11:16:24'),
	(14, '11111111Z', 'Pedro', NULL, 'ejemplo@ejemplo.com', NULL, '$2y$12$iCvHqqCHMmTtEu5N0PJjdepdSPHXWyqz0Yda6MgMYW11jYyZDQB/m', NULL, NULL, NULL, 0, '2024-05-22 12:56:41', '2024-05-23 12:19:40');

-- Volcando estructura para tabla biblioconexa.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.password_reset_tokens: ~1 rows (aproximadamente)
INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
	('a.morcillo@sapalomera.cat', '$2y$12$wmNZcIZYfFHAY1sS1qnqaOI4GL9bNMwGSyiprCxLDuReAGudHlDYe', '2024-05-23 14:47:17');

-- Volcando estructura para tabla biblioconexa.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.personal_access_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categoria_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.categoria: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.autores
CREATE TABLE IF NOT EXISTS `autores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `fecha_de_fallecimiento` date DEFAULT NULL,
  `lugar_de_nacimiento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nacionalidad` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biografia` text COLLATE utf8mb4_unicode_ci,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `autores_nombre_index` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.autores: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.libros
CREATE TABLE IF NOT EXISTS `libros` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `isbn` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sinopsis` text COLLATE utf8mb4_unicode_ci,
  `puntuacion` decimal(2,1) DEFAULT NULL,
  `cantidad` int NOT NULL DEFAULT '0',
  `portada` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoriaID` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `libros_external_id_unique` (`external_id`),
  UNIQUE KEY `libros_isbn_unique` (`isbn`),
  KEY `libros_categoriaid_foreign` (`categoriaID`),
  CONSTRAINT `libros_categoriaid_foreign` FOREIGN KEY (`categoriaID`) REFERENCES `categoria` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.libros: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comentarios_user_id_foreign` (`user_id`),
  CONSTRAINT `comentarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.comentarios: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.estanterias
CREATE TABLE IF NOT EXISTS `estanterias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estanterias_user_id_foreign` (`user_id`),
  CONSTRAINT `estanterias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.estanterias: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.estanterias_libros
CREATE TABLE IF NOT EXISTS `estanterias_libros` (
  `estanteria_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('leyendo','leidos','quieroLeer','abandonado','sinEstado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sinEstado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`estanteria_id`,`external_id`,`user_id`),
  KEY `estanterias_libros_user_id_foreign` (`user_id`),
  CONSTRAINT `estanterias_libros_estanteria_id_foreign` FOREIGN KEY (`estanteria_id`) REFERENCES `estanterias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `estanterias_libros_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.estanterias_libros: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.evento
CREATE TABLE IF NOT EXISTS `evento` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `sala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UsuarioDNI` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evento_user_id_foreign` (`user_id`),
  CONSTRAINT `evento_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.evento: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.librosugerido
CREATE TABLE IF NOT EXISTS `librosugerido` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idioma` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recomendacion` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `fechaSugerencia` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `librosugerido_user_id_foreign` (`user_id`),
  KEY `librosugerido_isbn_index` (`isbn`),
  CONSTRAINT `librosugerido_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.librosugerido: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.noticias
CREATE TABLE IF NOT EXISTS `noticias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UsuarioDNI` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `noticias_user_id_foreign` (`user_id`),
  KEY `noticias_fecha_index` (`fecha`),
  CONSTRAINT `noticias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.noticias: ~5 rows (aproximadamente)
INSERT INTO `noticias` (`id`, `user_id`, `titulo`, `descripcion`, `fecha`, `imagen`, `UsuarioDNI`, `created_at`, `updated_at`) VALUES
	(12, 2, 'rutas rutas rutas rutas rutas everywhere rutas everywhere', 'rutas rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhere rutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhere', '2024-05-20 15:17:13', 'noticias/58RIst9BiIF0by28C4w2TnmJ4jaHZ1Lyi2hEZatq.png', '32311965R', '2024-05-20 13:17:13', '2024-05-20 13:17:13'),
	(13, 2, 'pedro pedro pedro p', 'Pedro, Pedro, Pedro, Pedro, Pe\' Praticamente il meglio di Santa Fe Pedro, Pedro, Pedro, Pedro, Pe\' Fidati di me Pedro, Pedro, Pedro, Pedro, Pe\' Praticamente il meglio di Santa Fe Pedro, Pedro, Pedro, Pedro, Pe\' Fidati di mePedro, Pedro, Pedro, Pedro, Pe\' Praticamente il meglio di Santa Fe Pedro, Pedro, Pedro, Pedro, Pe\' Fidati di mePedro, Pedro, Pedro, Pedro, Pe\' Praticamente il meglio di Santa Fe Pedro, Pedro, Pedro, Pedro, Pe\' Fidati di mePedro, Pedro, Pedro, Pedro, Pe\' Praticamente il meglio di Santa Fe Pedro, Pedro, Pedro, Pedro, Pe\' Fidati di mePedro, Pedro, Pedro, Pedro, Pe\' Praticamente il meglio di Santa Fe Pedro, Pedro, Pedro, Pedro, Pe\' Fidati di mePedro, Pedro, Pedro, Pedro, Pe\' Praticamente il meglio di Santa Fe Pedro, Pedro, Pedro, Pedro, Pe\' Fidati di mePedro, Pedro, Pedro, Pedro, Pe\' Praticamente il meglio di Santa Fe Pedro, Pedro, Pedro, Pedro, Pe\' Fidati di meaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2024-05-20 15:47:44', NULL, '32311965R', '2024-05-20 13:47:44', '2024-05-20 13:47:44'),
	(27, 2, 'Nueva Biblioteca Abierta en el Centro de la Ciudad', 'La nueva biblioteca en el centro de la ciudad ha sido inaugurada hoy. Con una gran variedad de libros y recursos disponibles para el público, esta biblioteca promete ser un punto de encuentro para todos los amantes de la lectura.', '2024-05-20 18:05:02', 'noticias/QO3JqbIx2evAqQTX5ID3AY9ImHEUBPz8bb9e9sOF.jpg', '32311965R', '2024-05-20 16:04:43', '2024-05-20 16:05:02'),
	(28, 2, 'Taller de Escritura Creativa', 'La biblioteca ofrecerá un taller de escritura creativa el próximo mes. Este taller está diseñado para ayudar a los escritores a mejorar sus habilidades y encontrar su propia voz en la escritura.', '2024-05-30 18:04:00', 'noticias/fv4w33PPZeKnxpoApj3w6vulK24CZ2x6VMbEH9ul.png', '32311965R', '2024-05-20 16:04:43', '2024-05-20 16:07:00'),
	(29, 2, 'Club de Lectura: Novelas Clásicas', 'Únete a nuestro club de lectura donde discutiremos algunas de las novelas clásicas más influyentes de todos los tiempos. Las reuniones serán mensuales y están abiertas a todos los miembros de la comunidad.', '2024-06-09 18:04:00', 'noticias/X39Dr2XdxnYOuiNPcmvDjzV6xzlpcVf4xLbBvQIP.jpg', '32311965R', '2024-05-20 16:04:43', '2024-05-20 16:07:32');

-- Volcando estructura para tabla biblioconexa.tarjeta_personal
CREATE TABLE IF NOT EXISTS `tarjeta_personal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `genero` enum('Hombre','Mujer','No binario','Privado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primer_apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundo_apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_electronico` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tarjeta_personal_user_id_foreign` (`user_id`),
  CONSTRAINT `tarjeta_personal_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.tarjeta_personal: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.puntuaciones
CREATE TABLE IF NOT EXISTS `puntuaciones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `puntuacion` decimal(2,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `puntuaciones_external_id_user_id_unique` (`external_id`,`user_id`),
  KEY `puntuaciones_user_id_foreign` (`user_id`),
  CONSTRAINT `puntuaciones_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.puntuaciones: ~0 rows (aproximadamente)

-- Volcando estructura para tabla biblioconexa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla biblioconexa.migrations: ~15 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_04_25_150532_create_categoria_table', 1),
	(6, '2024_04_25_150533_create_autores_table', 1),
	(7, '2024_04_25_150534_create_libro_table', 1),
	(8, '2024_04_25_150544_create_comentario_table', 1),
	(9, '2024_04_25_150552_create_estanterias_table', 1),
	(10, '2024_04_25_150650_create_estanteriaslibros_table', 1),
	(11, '2024_04_25_150949_create_evento_table', 1),
	(12, '2024_04_25_151001_create_librosugerido_table', 1),
	(13, '2024_04_25_151007_create_noticia_table', 1),
	(14, '2024_04_26_182723_create_tarjeta_personal_table', 1),
	(15, '2024_05_09_144823_create__puntuaciones_table', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
