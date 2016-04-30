CREATE TABLE blog (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `text` text,
  `created_at` integer DEFAULT NULL,
  `modify_at` integer DEFAULT NULL,
  PRIMARY KEY (`id`)
);