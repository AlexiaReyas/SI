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

INSERT INTO `utilisateurs` (`nom`, `email`, `mot_de_passe`, `genre`, `taille`, `poids_initial`, `est_gold`, `date_inscription`) VALUES
('Alice Martin', 'alice@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'femme', 165, 58.00, 1, '2026-01-15'),
('Bernard Dubois', 'bernard@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'homme', 180, 85.00, 0, '2026-02-20'),
('Claire Petit', 'claire@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'femme', 160, 52.00, 1, '2026-03-10'),
('David Leroy', 'david@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'homme', 175, 70.00, 0, '2026-03-25'),
('Emma Richard', 'emma@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'femme', 170, 65.00, 1, '2026-04-01');

INSERT INTO `regimes_officiels` (`nom`, `description`, `objectif`) VALUES
('Prise de poids saine', 'Pour les personnes maigres qui veulent prendre du muscle', 'augmenter'),
('Équilibre parfait', 'Pour maintenir son poids et son IMC idéal', 'ideal'),
('Perte de poids intensive', 'Pour perdre du poids rapidement', 'reduire'),
('Régime méditerranéen', 'Inspiré des pays du sud, bon pour le coeur', 'ideal'),
('Régime protéiné', 'Riche en protéines, pour les sportifs', 'augmenter');

INSERT INTO `composition_regime_officiel` (`regime_id`, `pourcentage_viande`, `pourcentage_poisson`, `pourcentage_volaille`) VALUES
(1, 50, 30, 20),
(2, 40, 40, 20),
(3, 30, 50, 20),
(4, 35, 45, 20),
(5, 60, 20, 20);

INSERT INTO `sports` (`nom`, `calories_par_heure`, `difficulte`, `description`) VALUES
('Marche rapide', 250, 'Facile', 'Idéal pour débuter, accessible à tous'),
('Course à pied', 600, 'Moyen', 'Excellent pour brûler des calories'),
('Natation', 500, 'Moyen', 'Sport complet, doux pour les articulations'),
('Vélo', 400, 'Facile', 'Bon pour l''endurance'),
('Musculation', 350, 'Difficile', 'Pour prendre du muscle');

INSERT INTO `regime_sports` (`regime_id`, `sport_id`, `duree_recommandee_minutes`, `jours_par_semaine`) VALUES
(1, 5, 45, 3),
(1, 4, 30, 2),
(2, 1, 30, 5),
(2, 3, 40, 2),
(3, 2, 45, 4),
(3, 3, 60, 3),
(4, 1, 30, 3),
(5, 5, 60, 4);

INSERT INTO `codes_promo` (code, valeur, type, utilisations_max, date_expiration) VALUES
('BIENVENUE10', 10.00, 'argent', 100, '2026-12-31'),
('GOLD50', 9.99, 'gold', 50, '2026-12-31'),
('SPECIAL5', 5.00, 'argent', 1, '2026-06-30'),
('ETE2025', 8.00, 'argent', 200, '2026-09-30'),
('AMIPARRAIN', 15.00, 'argent', 10, '2026-12-31'),
('SPORTIF20', 20.00, 'argent', 5, '2026-08-31'),
('NOEL2026', 25.00, 'argent', 1000, '2026-12-25'),
('REGIME10', 10.00, 'argent', 30, '2026-11-30'),
('GOLDGRATUIT', 0.00, 'gold', 3, '2026-05-15'),
('PROMO5', 5.00, 'argent', 50, '2026-05-30'),
('JUILLET2026', 7.50, 'argent', 20, '2026-07-31'),
('AOUT2026', 7.50, 'argent', 20, '2026-08-31'),
('SEPT2026', 10.00, 'argent', 20, '2026-09-30'),
('OCT2026', 10.00, 'argent', 20, '2026-10-31'),
('NOV2026', 12.00, 'argent', 20, '2026-11-30');

