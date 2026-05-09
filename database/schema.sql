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

CREATE TABLE `sports` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NOT NULL,
  `calories_par_heure` INT,
  `difficulte` VARCHAR(20),
  `description` TEXT,
  PRIMARY KEY (`id`),
  CHECK (`difficulte` IN ('Facile', 'Moyen', 'Difficile'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `regime_sports` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `regime_id` INT UNSIGNED NOT NULL,
  `sport_id` INT UNSIGNED NOT NULL,
  `duree_recommandee_minutes` INT,
  `jours_par_semaine` INT,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`regime_id`) REFERENCES `regimes_officiels`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`sport_id`) REFERENCES `sports`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portemonnaie` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `solde` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `dernier_ajout` DATETIME,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_portemonnaie_user` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `achats_gold` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `date_achat` DATE NOT NULL DEFAULT CURRENT_DATE,
  `montant_paye` DECIMAL(10,2),
  `mode_paiement` VARCHAR(50),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `parametres` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cle` VARCHAR(50) NOT NULL,
  `valeur` VARCHAR(255),
  `description` TEXT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_parametres_cle` (`cle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `parametres` (`cle`, `valeur`, `description`) VALUES
('prix_gold', '9.99', 'Prix de l''option Gold'),
('remise_gold', '15', 'Pourcentage de remise pour les membres Gold'),
('imc_min_normal', '18.5', 'IMC minimum pour poids normal'),
('imc_max_normal', '24.9', 'IMC maximum pour poids normal');


CREATE TABLE `codes_promo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(50) NOT NULL,
  `valeur` DECIMAL(10,2) NOT NULL,
  `type` VARCHAR(20) NOT NULL DEFAULT 'argent',
  `utilisations_max` INT NOT NULL DEFAULT 1,
  `utilisations_actuelles` INT NOT NULL DEFAULT 0,
  `date_expiration` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_codes_promo_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `utilisation_codes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `code_id` INT UNSIGNED NOT NULL,
  `date_utilisation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`code_id`) REFERENCES `codes_promo`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
