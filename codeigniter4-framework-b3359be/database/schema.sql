-- 1. Créer la base
CREATE DATABASE IF NOT EXISTS regime_alimentaire;
USE regime_alimentaire;

-- 2. Supprimer les tables si elles existent (ordre inverse pour respecter les clés étrangères)
DROP TABLE IF EXISTS mesures_utilisateur;
DROP TABLE IF EXISTS composition_regime_perso;
DROP TABLE IF EXISTS regimes_personnalises;
DROP TABLE IF EXISTS utilisation_codes;
DROP TABLE IF EXISTS regime_sports;
DROP TABLE IF EXISTS achats_gold;
DROP TABLE IF EXISTS portemonnaie;
DROP TABLE IF EXISTS codes_promo;
DROP TABLE IF EXISTS sports;
DROP TABLE IF EXISTS composition_regime_officiel;
DROP TABLE IF EXISTS regimes_officiels;
DROP TABLE IF EXISTS parametres;
DROP TABLE IF EXISTS utilisateurs;

-- 3. CREATE TABLE utilisateurs
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    is_gold TINYINT(1) DEFAULT 0
);

-- 4. CREATE TABLE regimes_officiels
CREATE TABLE regimes_officiels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    objectif VARCHAR(100) NOT NULL
);

-- 5. CREATE TABLE composition_regime_officiel
CREATE TABLE composition_regime_officiel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    regime_id INT NOT NULL,
    aliment VARCHAR(100) NOT NULL,
    quantite VARCHAR(50) NOT NULL,
    FOREIGN KEY (regime_id) REFERENCES regimes_officiels(id)
);

-- 6. CREATE TABLE sports
CREATE TABLE sports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    calories_par_heure INT NOT NULL,
    difficulte VARCHAR(50),
    description TEXT
);

-- 7. CREATE TABLE regime_sports
CREATE TABLE regime_sports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    regime_id INT NOT NULL,
    sport_id INT NOT NULL,
    duree_recommandee_minutes INT NOT NULL,
    jours_par_semaine INT NOT NULL,
    FOREIGN KEY (regime_id) REFERENCES regimes_officiels(id),
    FOREIGN KEY (sport_id) REFERENCES sports(id)
);

-- 8. CREATE TABLE codes_promo
CREATE TABLE codes_promo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    valeur DECIMAL(10, 2) NOT NULL,
    type VARCHAR(50) NOT NULL,
    utilisations_max INT NOT NULL,
    utilisations_actuelles INT DEFAULT 0,
    date_expiration DATE NOT NULL
);

-- 9. CREATE TABLE utilisation_codes
CREATE TABLE utilisation_codes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    code_id INT NOT NULL,
    date_utilisation DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (code_id) REFERENCES codes_promo(id)
);

-- 10. CREATE TABLE portemonnaie
CREATE TABLE portemonnaie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    solde DECIMAL(10, 2) DEFAULT 0,
    dernier_ajout DATETIME,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id)
);

-- 11. CREATE TABLE achats_gold
CREATE TABLE achats_gold (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date_achat DATETIME NOT NULL,
    montant_paye DECIMAL(10, 2) NOT NULL,
    mode_paiement VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id)
);

-- 12. CREATE TABLE parametres
CREATE TABLE parametres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cle VARCHAR(100) NOT NULL UNIQUE,
    valeur TEXT NOT NULL,
    description TEXT
);

-- 13. CREATE TABLE mesures_utilisateur
CREATE TABLE mesures_utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    poids DECIMAL(5, 2) NOT NULL,
    date_mesure DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id)
);

-- 14. INSERT INTO utilisateurs
INSERT INTO utilisateurs (nom, email, mot_de_passe, is_gold) VALUES
('Alice', 'alice@email.com', 'hashed_password1', 1),
('Bob', 'bob@email.com', 'hashed_password2', 0),
('Charlie', 'charlie@email.com', 'hashed_password3', 0),
('Diana', 'diana@email.com', 'hashed_password4', 1),
('Eve', 'eve@email.com', 'hashed_password5', 0);

-- 15. INSERT INTO regimes_officiels
INSERT INTO regimes_officiels (nom, objectif) VALUES
('Régime Minceur', 'Perte de poids'),
('Régime Énergie', 'Augmenter l\'énergie'),
('Régime Protéiné', 'Prise de muscle'),
('Régime Détox', 'Détoxification'),
('Régime Équilibré', 'Maintien du poids');

-- 16. INSERT INTO composition_regime_officiel
INSERT INTO composition_regime_officiel (regime_id, aliment, quantite) VALUES
(1, 'Pomme', '2'),
(1, 'Poulet', '150g'),
(2, 'Banane', '1'),
(3, 'Oeufs', '3'),
(4, 'Thé Vert', '200ml');

-- 17. INSERT INTO sports
INSERT INTO sports (nom, calories_par_heure, difficulte, description) VALUES
('Course', 600, 'Moyen', 'Course à pied'),
('Natation', 700, 'Difficile', 'Natation en piscine'),
('Yoga', 200, 'Facile', 'Exercices de relaxation'),
('Cyclisme', 500, 'Moyen', 'Cyclisme sur route'),
('Musculation', 400, 'Difficile', 'Entraînement en salle');

-- 18. INSERT INTO regime_sports
INSERT INTO regime_sports (regime_id, sport_id, duree_recommandee_minutes, jours_par_semaine) VALUES
(1, 1, 30, 3),
(2, 2, 45, 4),
(3, 5, 60, 5),
(4, 3, 20, 2),
(5, 4, 40, 3);

-- 19. INSERT INTO codes_promo
INSERT INTO codes_promo (code, valeur, type, utilisations_max, date_expiration) VALUES
('BIENVENUE10', 10, 'Réduction', 100, '2026-12-31'),
('FETE20', 20, 'Réduction', 50, '2026-12-31'),
('SPORT5', 5, 'Réduction', 200, '2026-12-31'),
('DETOX15', 15, 'Réduction', 30, '2026-12-31'),
('ENERGIE25', 25, 'Réduction', 10, '2026-12-31');

-- 20. INSERT INTO parametres
INSERT INTO parametres (cle, valeur, description) VALUES
('remise_gold', '15', 'Pourcentage de remise pour les utilisateurs Gold'),
('max_mesures', '100', 'Nombre maximum de mesures par utilisateur');

-- 21. INSERT INTO mesures_utilisateur
INSERT INTO mesures_utilisateur (user_id, poids, date_mesure) VALUES
(1, 70.5, '2026-01-01'),
(1, 68.0, '2026-02-01'),
(2, 85.0, '2026-01-01'),
(2, 83.5, '2026-02-01'),
(3, 90.0, '2026-01-01');