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

CREATE TABLE `regimes_officiels` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `objectif` VARCHAR(20) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CHECK (`objectif` IN ('augmenter', 'reduire', 'ideal'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `composition_regime_officiel` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `regime_id` INT UNSIGNED NOT NULL,
  `pourcentage_viande` INT NOT NULL,
  `pourcentage_poisson` INT NOT NULL,
  `pourcentage_volaille` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`regime_id`) REFERENCES `regimes_officiels`(`id`) ON DELETE CASCADE,
  CHECK (`pourcentage_viande` BETWEEN 0 AND 100),
  CHECK (`pourcentage_poisson` BETWEEN 0 AND 100),
  CHECK (`pourcentage_volaille` BETWEEN 0 AND 100),
  CHECK ((`pourcentage_viande` + `pourcentage_poisson` + `pourcentage_volaille`) = 100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

