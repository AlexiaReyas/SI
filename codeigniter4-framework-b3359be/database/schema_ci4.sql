CREATE DATABASE IF NOT EXISTS `regime_alimentaire` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `regime_alimentaire`;

DROP TABLE IF EXISTS `payments`;
DROP TABLE IF EXISTS `codes`;
DROP TABLE IF EXISTS `user_objectives`;
DROP TABLE IF EXISTS `health`;
DROP TABLE IF EXISTS `activities`;
DROP TABLE IF EXISTS `regimes`;
DROP TABLE IF EXISTS `settings`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `gender` VARCHAR(20) NOT NULL DEFAULT 'autre',
  `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
  `gold` TINYINT(1) NOT NULL DEFAULT 0,
  `wallet` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_users_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `health` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `height_cm` INT NOT NULL,
  `weight_kg` DECIMAL(5,2) NOT NULL,
  `imc` DECIMAL(4,2) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_health_user_id` (`user_id`),
  CONSTRAINT `fk_health_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `regimes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `base_price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `duration_days` INT NOT NULL DEFAULT 0,
  `weight_change_kg` DECIMAL(4,2) NOT NULL DEFAULT 0.00,
  `pct_meat` INT NOT NULL DEFAULT 0,
  `pct_fish` INT NOT NULL DEFAULT 0,
  `pct_poultry` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `activities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `duration_minutes` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `codes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(50) NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `is_valid` TINYINT(1) NOT NULL DEFAULT 1,
  `used_by` INT UNSIGNED NULL,
  `used_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_codes_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `payments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `type` VARCHAR(20) NOT NULL,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_payments_user_id` (`user_id`),
  CONSTRAINT `fk_payments_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user_objectives` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `objective` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_objectives_user_id` (`user_id`),
  CONSTRAINT `fk_objectives_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `settings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` VARCHAR(50) NOT NULL,
  `setting_value` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_settings_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('gold_price', '9.99'),
('imc_min_normal', '18.5'),
('imc_max_normal', '24.9');

INSERT INTO `users` (`name`, `email`, `password_hash`, `gender`, `is_admin`, `gold`, `wallet`) VALUES
('Utilisateur Test', 'test@test.com', '$2y$10$ghhiSpk4YB.NDcrE4K1Tteajlnvuku8QAjnr216WX3TwWEmiplM9S', 'homme', 0, 0, 150.50),
('Admin Test', 'admin@test.com', '$2y$10$qUWrwxiHESCpQV3Gc426Euf4mUlk8DjNfO3RXkuytNT7ZfLifdRLG', 'homme', 1, 0, 0.00);

INSERT INTO `health` (`user_id`, `height_cm`, `weight_kg`, `imc`) VALUES
(1, 175, 70.00, 22.86);

INSERT INTO `regimes` (`name`, `description`, `base_price`, `duration_days`, `weight_change_kg`, `pct_meat`, `pct_fish`, `pct_poultry`) VALUES
('Prise de masse (Proteines)', 'Regime riche en proteines pour gagner du muscle.', 50.00, 30, 2.00, 50, 30, 20),
('Perte de poids (Deficit)', 'Regime hypocalorique pour mincir rapidement.', 40.00, 30, -2.00, 30, 50, 20),
('Maintien (Equilibre)', 'Bons nutriments pour rester en pleine forme.', 30.00, 30, 0.00, 40, 40, 20);

INSERT INTO `activities` (`name`, `description`, `duration_minutes`) VALUES
('Musculation 3x/semaine', 'Seances completes corps entier.', 60),
('Cardio leger', 'Footing de 45 minutes.', 45);

INSERT INTO `codes` (`code`, `amount`, `is_valid`) VALUES
('PROMO20', 20.00, 1),
('BIENVENUE10', 10.00, 1),
('GOLD50', 9.99, 1);
