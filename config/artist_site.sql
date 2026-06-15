-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               12.3.2-MariaDB - MariaDB Server
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.17.0.7270
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных artist_site
CREATE DATABASE IF NOT EXISTS `artist_site` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `artist_site`;

-- Дамп структуры для таблица artist_site.artworks
CREATE TABLE IF NOT EXISTS `artworks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы artist_site.artworks: ~15 rows (приблизительно)
INSERT INTO `artworks` (`id`, `category_id`, `title`, `description`, `image`, `sort_order`, `is_published`, `created_at`) VALUES
	(3, 2, 'Ветер', '"Ветер " 49/35', 'uploads/relief/wind.webp', 0, 1, '2026-06-15 07:10:51'),
	(4, 2, 'Разнотравье', '"Разнотравье"30/30', 'uploads/relief/mixed-herbs.webp', 0, 1, '2026-06-15 07:47:10'),
	(5, 2, 'Ромашки', 'Ромашки', 'uploads/relief/chamomile.webp', 0, 1, '2026-06-15 07:49:29'),
	(6, 2, 'Нежность', 'Нежность', 'uploads/relief/tenderness.webp', 0, 1, '2026-06-15 07:51:01'),
	(7, 2, 'Танец цветов', '"Танец цветов"40 см', 'uploads/relief/dance-of-flowers.webp', 0, 1, '2026-06-15 07:53:51'),
	(8, 1, 'Птица', 'Холст, масло', 'uploads/paiting/bird.webp', 0, 1, '2026-06-15 08:18:02'),
	(9, 1, 'Айва', '', 'uploads/paiting/quince.webp', 0, 1, '2026-06-15 08:18:42'),
	(10, 1, 'Лев', '', 'uploads/paiting/lion.webp', 0, 1, '2026-06-15 08:19:04'),
	(11, 1, 'Лимоны', 'Работа выполнена на холсте с использованием масляных красок. Размер по раме 43/43', 'uploads/paiting/lemons.webp', 0, 1, '2026-06-15 08:20:14'),
	(12, 1, 'Поле', 'Картина выполнена на холсте с использованием масляных красок. Размер по раме 225/25', 'uploads/paiting/field.webp', 0, 1, '2026-06-15 08:21:22'),
	(13, 4, 'Золотые стрекозы', 'Картина "Золотые стрекозы " выполнена на холсте масляными краскамис использованием текстурной пасты и потали.', 'uploads/interior/golden-dragonflies.webp', 0, 1, '2026-06-15 08:34:43'),
	(14, 4, 'Бабочки на колючках', 'Картина "Бабочки на колючках"размер по раме 53/73. Выполнена на холсте акриловыми красками с использованием текстурной пасты и потали.', 'uploads/interior/butterflies-on-thorns.webp', 0, 1, '2026-06-15 08:36:02'),
	(15, 3, 'Зеркало. 35/35', 'Зеркало из плиточек. Ручная роспись. Размер по раме 35/35. Размер зеркала 10 см', 'uploads/mirrors/mirror.webp', 0, 1, '2026-06-15 08:52:57'),
	(16, 3, '"Цветочная вязь" 40 см', 'Зеркало в технике ботанический барельеф . Диаметр 40 см. Само зеркало 10 см.', 'uploads/mirrors/floral-ligature.webp', 0, 1, '2026-06-15 08:54:08'),
	(17, 3, 'Зеркало "Нежность"60 см', 'Зеркало в технике ботанический барельеф. Диаметр по раме 60 см по раме. Рама МДФ. Окрашенна акриловой краской покрыта матовым акриловым лаком. Диаметр самого зеркала 29 см.', 'uploads/mirrors/mirror-tenderness.webp', 0, 1, '2026-06-15 08:55:13');

-- Дамп структуры для таблица artist_site.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы artist_site.categories: ~4 rows (приблизительно)
INSERT INTO `categories` (`id`, `title`, `slug`) VALUES
	(1, 'Картины', 'painting'),
	(2, 'Барельефы', 'relief'),
	(3, 'Зеркала', 'mirrors'),
	(4, 'Интерьер', 'interior');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
