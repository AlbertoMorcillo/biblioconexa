-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------



-- Volcando estructura de base de datos para a.morcillo_biblioconexa

USE `a.morcillo_biblioconexa`;

-- Volcando estructura para tabla a.morcillo_biblioconexa.users
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla a.morcillo_biblioconexa.users: ~2 rows (aproximadamente)
INSERT INTO `users` (`id`, `dni`, `name`, `surname`, `email`, `email_verified_at`, `password`, `phone`, `birthdate`, `remember_token`, `isAdmin`, `created_at`, `updated_at`) VALUES
	(1, '47276750C', 'Alberto', NULL, 'a.morcillo@sapalomera.cat', '2024-05-27 11:37:50', '$2y$12$BCkE3ACCPspQxh/dMWHAFuFeJdL/TTr5LoVfAkX6eQbEFLCF9BJbq', '634797322', NULL, 'lcSwZLLduwJ7UXQ5eVTPvvCw1KAwvjQZL3TKjoBKNNye1dphXFPsLXxhdfat', 0, '2024-05-27 11:37:50', '2024-05-27 11:37:50'),
	(2, '32311965R', 'Elinor', 'Caskey', 'elinor@admin.com', '2024-05-27 11:37:50', '$2y$12$Qmsqi12fL82O3TxxS14NCOpxCMrU4HaHBGom2fqyGThL1yB/orEFO', '123456789', '1990-01-01', 'hpKdEjz41JBfC3uHTW0x4XQtlARajslWJgacnf1a3syiaJU28cnBR1ig27GN', 1, '2024-05-27 11:37:50', '2024-05-27 11:37:50'),
	(3, '36776804B', 'Mondongo', 'Cangrejo', 'mondongo@admin.com', '2024-05-27 11:37:50', '$2y$12$rCdd2u1j2S1Np.Yr0hPUruKgH/UQ1iXp3WKNTvi2pMKutzzl/9Frq', '123456789', '1993-01-01', 'RVIK7HnvroLD78kezRFr0j8C02qxQxVqNrbG104VauT78t4850ZJeubwL7Xl', 1, '2024-05-27 11:37:50', '2024-05-27 11:37:50');

-- Volcando estructura para tabla a.morcillo_biblioconexa.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla a.morcillo_biblioconexa.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla a.morcillo_biblioconexa.failed_jobs
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

-- Volcando datos para la tabla a.morcillo_biblioconexa.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla a.morcillo_biblioconexa.personal_access_tokens
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

-- Volcando datos para la tabla a.morcillo_biblioconexa.personal_access_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla a.morcillo_biblioconexa.categoria
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

-- Volcando datos para la tabla a.morcillo_biblioconexa.categoria: ~0 rows (aproximadamente)

-- Volcando estructura para tabla a.morcillo_biblioconexa.autores
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

-- Volcando datos para la tabla a.morcillo_biblioconexa.autores: ~0 rows (aproximadamente)

-- Volcando estructura para tabla a.morcillo_biblioconexa.libros
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

-- Volcando datos para la tabla a.morcillo_biblioconexa.libros: ~0 rows (aproximadamente)

-- Volcando estructura para tabla a.morcillo_biblioconexa.comentarios
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla a.morcillo_biblioconexa.comentarios: ~1 rows (aproximadamente)
INSERT INTO `comentarios` (`id`, `user_id`, `external_id`, `texto`, `created_at`, `updated_at`) VALUES
	(5, 1, 'OL498556W', 'Me dio penita Gregorio.', '2024-05-29 11:32:16', '2024-05-29 11:32:16');

-- Volcando estructura para tabla a.morcillo_biblioconexa.estanterias
CREATE TABLE IF NOT EXISTS `estanterias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estanterias_user_id_foreign` (`user_id`),
  CONSTRAINT `estanterias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla a.morcillo_biblioconexa.estanterias: ~0 rows (aproximadamente)
INSERT INTO `estanterias` (`id`, `user_id`, `nombre`, `created_at`, `updated_at`) VALUES
	(1, 1, 'leyendo', '2024-05-27 13:38:26', '2024-05-27 13:38:26'),
	(2, 1, 'leidos', '2024-05-29 11:32:36', '2024-05-29 11:32:36');

-- Volcando estructura para tabla a.morcillo_biblioconexa.estanterias_libros
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

-- Volcando datos para la tabla a.morcillo_biblioconexa.estanterias_libros: ~0 rows (aproximadamente)
INSERT INTO `estanterias_libros` (`estanteria_id`, `user_id`, `external_id`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 1, 'OL5882238W', 'leyendo', '2024-05-27 13:38:26', '2024-05-27 13:38:26'),
	(2, 1, 'OL498556W', 'leidos', '2024-05-29 11:32:36', '2024-05-29 11:32:36');

-- Volcando estructura para tabla a.morcillo_biblioconexa.evento
CREATE TABLE IF NOT EXISTS `evento` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `sala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UsuarioDNI` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evento_user_id_foreign` (`user_id`),
  CONSTRAINT `evento_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla a.morcillo_biblioconexa.evento: ~2 rows (aproximadamente)
INSERT INTO `evento` (`id`, `user_id`, `titulo`, `descripcion`, `fecha`, `hora`, `sala`, `UsuarioDNI`, `imagen`, `created_at`, `updated_at`) VALUES
	(3, 2, 'rutas rutas rutas rutas rutas everywhere rutas everywhere', 'rutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhererutas rutas rutas rutas rutas everywhere rutas everywhere', '2024-05-27', '20:30:00', 'Ep', '32311965R', 'eventos/0hvbjVl68XOe4zyyGONh1ZF8TomtqxzIEEYdbRjh.jpg', '2024-05-27 12:18:51', '2024-05-27 12:18:51'),
	(4, 2, 'que divertido es que lo que funcionaba deje de funcionar el día siguiente', 'que divertido es que lo que funcionaba deje de funcionar el día siguiente', '2024-05-28', '14:00:00', 'yo que se', '32311965R', 'eventos/am452PctDDeMddnueVQS7DDyTmngaRYUJaveSlh1.jpg', '2024-05-27 12:20:22', '2024-05-27 12:20:22');

-- Volcando estructura para tabla a.morcillo_biblioconexa.librosugerido
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

-- Volcando datos para la tabla a.morcillo_biblioconexa.librosugerido: ~0 rows (aproximadamente)

-- Volcando estructura para tabla a.morcillo_biblioconexa.noticias
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla a.morcillo_biblioconexa.noticias: ~3 rows (aproximadamente)
INSERT INTO `noticias` (`id`, `user_id`, `titulo`, `descripcion`, `fecha`, `imagen`, `UsuarioDNI`, `created_at`, `updated_at`) VALUES
	(4, 2, 'Nueva Biblioteca Abierta en el Centro de la Ciudad', 'La nueva biblioteca en el centro de la ciudad ha sido inaugurada hoy. Con una gran variedad de libros y recursos disponibles para el público, esta biblioteca promete ser un punto de encuentro para todos los amantes de la lectura.', '2024-05-27 13:40:37', 'noticias/kN2V6lsDYI9EjzFJIwxK5fTFYeR5WotMqj1R4wpj.jpg', '32311965R', '2024-05-27 11:37:50', '2024-05-27 11:40:37'),
	(5, 2, 'Taller de Escritura Creativa', 'La biblioteca ofrecerá un taller de escritura creativa el próximo mes. Este taller está diseñado para ayudar a los escritores a mejorar sus habilidades y encontrar su propia voz en la escritura.', '2024-06-06 13:37:00', 'noticias/Gc6FL5ZlAApT958qFBtdIg6HIcoPmeaBcBtCoM8c.jpg', '32311965R', '2024-05-27 11:37:50', '2024-05-27 11:40:48');

-- Volcando estructura para tabla a.morcillo_biblioconexa.tarjeta_personal
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla a.morcillo_biblioconexa.tarjeta_personal: ~2 rows (aproximadamente)
INSERT INTO `tarjeta_personal` (`id`, `user_id`, `genero`, `fecha_nacimiento`, `nombre`, `primer_apellido`, `segundo_apellido`, `correo_electronico`, `telefono`, `dni`, `created_at`, `updated_at`) VALUES
	(2, 2, 'Hombre', '2024-05-28', 'asdadad', 'asdadadd', 'adadadad', 'aadsadad@gmail.com', '676546374', '42527132V', '2024-05-28 13:40:34', '2024-05-28 13:40:34'),
	(4, 1, 'Hombre', '1993-12-12', 'Alberto', 'Morcillo', 'Montejo', 'a.morcillo@sapalomera.cat', '634797322', '47276750C', '2024-05-28 14:51:58', '2024-05-28 14:51:58');

-- Volcando estructura para tabla a.morcillo_biblioconexa.puntuaciones
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla a.morcillo_biblioconexa.puntuaciones: ~0 rows (aproximadamente)
INSERT INTO `puntuaciones` (`id`, `user_id`, `external_id`, `puntuacion`, `created_at`, `updated_at`) VALUES
	(1, 1, 'OL5882238W', 3.0, '2024-05-27 13:36:01', '2024-05-27 13:36:01'),
	(2, 1, 'OL498556W', 4.0, '2024-05-29 11:32:23', '2024-05-29 11:32:23');

-- Volcando estructura para tabla a.morcillo_biblioconexa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla a.morcillo_biblioconexa.migrations: ~0 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(16, '2014_10_12_000000_create_users_table', 1),
	(17, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(18, '2019_08_19_000000_create_failed_jobs_table', 1),
	(19, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(20, '2024_04_25_150532_create_categoria_table', 1),
	(21, '2024_04_25_150533_create_autores_table', 1),
	(22, '2024_04_25_150534_create_libro_table', 1),
	(23, '2024_04_25_150544_create_comentario_table', 1),
	(24, '2024_04_25_150552_create_estanterias_table', 1),
	(25, '2024_04_25_150650_create_estanteriaslibros_table', 1),
	(26, '2024_04_25_150949_create_evento_table', 1),
	(27, '2024_04_25_151001_create_librosugerido_table', 1),
	(28, '2024_04_25_151007_create_noticia_table', 1),
	(29, '2024_04_26_182723_create_tarjeta_personal_table', 1),
	(30, '2024_05_09_144823_create__puntuaciones_table', 1);
