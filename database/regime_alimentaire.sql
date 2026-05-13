CREATE DATABASE IF NOT EXISTS `regime_alimentaire` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `regime_alimentaire`;

CREATE TABLE `utilisateurs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `mot_de_passe` VARCHAR(255) NOT NULL,
  `genre` ENUM('homme','femme','autre') NOT NULL DEFAULT 'autre',
  `taille` INT NULL COMMENT 'taille en cm',
  `poids_initial` DECIMAL(5,2) NULL COMMENT 'poids à l''inscription',
  `est_gold` TINYINT(1) NOT NULL DEFAULT 0,
  `date_inscription` DATE NOT NULL DEFAULT CURRENT_DATE,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_utilisateurs_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
