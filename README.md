  Régime- Application de recommandation nutritionnelle

c'est une application web permettant aux utilisateurs de calculer leur IMC, choisir des objectifs de santé (perte de poids, gain de poids, atteinte de l'IMC idéal), et recevoir des recommandations personnalisées de régimes alimentaires et d'activités sportives.

L'application intègre un système de porte-monnaie virtuel, des codes promo, ainsi qu'une option **Gold** offrant 15% de réduction sur tous les régimes.

 Équipe projet

| Rôle | Nom | Branche Git |
|------|-----|--------------|
| Frontend | Alexia | `Alex` |
| Backend | Midera |  |
| Base de données | Andhy |  |

 Technologies utilisées

 Backend
| Technologie | Version |
|-------------|---------|
| PHP | 8.x |
| CodeIgniter | 4.x |

 Base de données
| Technologie | Version |
|-------------|---------|
| MySQL | 5.7+ |

 Frontend
| Technologie | Version |
|-------------|---------|
| HTML5 | - |
| CSS3 | - |
| JavaScript | ES6+ |
| AJAX | - |
| Bootstrap | 5.x |

 Bibliothèques additionnelles
| Bibliothèque | Usage |
|--------------|-------|
| Chart.js | Graphiques et statistiques |
| Dompdf | Génération PDF |
| jQuery (optionnel) | Simplification AJAX |

 Fonctionnalités

 Front Office (Utilisateurs)

| Statut | Fonctionnalité | Description |
|--------|----------------|-------------|
| 🔄 | Inscription | 2 pages : infos personnelles + infos santé |
| 🔄 | Connexion / Déconnexion | Authentification sécurisée |
| 🔄 | Calcul IMC | Automatique selon taille/poids |
| 🔄 | Complétion profil | Modification des données utilisateur |
| 🔄 | Choix objectifs | Max 3 objectifs (Augmenter/Réduire/Atteindre IMC) |
| 🔄 | Suggestions | Régime + activité sportive adaptés |
| 🔄 | Export PDF | Téléchargement des recommandations |
| 🔄 | Porte-monnaie | Solde virtuel rechargeable |
| 🔄 | Codes promo | Validation AJAX → ajout argent |
| 🔄 | Option Gold | Achat unique → 15% remise |
| 🔄 | Dashboard | Graphiques + statistiques + tableaux croisés |

 Back Office (Administrateur)

| Statut | Fonctionnalité | Description |
|--------|----------------|-------------|
| 🔄 | CRUD Régimes | Avec % viande/poisson/volaille, prix durée, variation poids |
| 🔄 | CRUD Activités sportives | Gestion des exercices proposés |
| 🔄 | CRUD Codes promo | Génération et validation |
| 🔄 | CRUD Paramètres | Configuration IMC idéal, etc. |

 Base de données

 Structure des tables

| Table | Description |
|-------|-------------|
| `utilisateurs` | id, nom, email, mot_de_passe, genre, gold, date_inscription |
| `informations_sante` | id_user, taille, poids, imc, date_mesure |
| `objectifs` | id, nom (3 valeurs) |
| `utilisateur_objectifs` | id_user, id_objectif |
| `regimes` | id, nom, description, prix, duree_jours, variation_poids, %viande, %poisson, %volaille |
| `activites_sportives` | id, nom, calories_heure, duree_minutes |
| `codes_promos` | id, code, valeur, actif |
| `portemonnaie` | id_user, solde |
| `achats_gold` | id_user, date_achat, prix_paye |

 Données minimales (obligatoires)

-  5 utilisateurs
-  15 codes promo
-  5 régimes
-  5 activités sportives

 Installation

 Prérequis

- PHP 8.0+
- MySQL 5.7+
- Composer
- Git
- XAMPP


Répartition des taches : 

Midera – Backend & Logique métier
Tâche	Priorité
Installer et configurer CodeIgniter 4	
Créer les contrôleurs de base (Auth, User, Regime, Activite)	
Gérer l’authentification (inscription 2 pages, login, session)	
Calculer l’IMC (logique métier)	
CRUD des régimes (avec % viande/poisson/volaille)	
CRUD des activités sportives
CRUD des paramètres (configuration IMC idéal, etc.)	
Logique de suggestion régime + activité selon objectif/IMC	
API endpoints pour AJAX (ex: validation code promo)	
Mise en place des routes et filtres (ex: accès Gold)

Alexia – Frontend & UI/UX
Tâche	Priorité
Maquettage HTML/CSS (responsive, design propre)	
Page d’accueil + authentification (login/register 2 pages)	
Tableau de bord (dashboard)	
Intégration des graphiques (Chart.js) : IMC, statistiques	
Page de profil + choix des 3 objectifs	
Page d’affichage suggestion régime + activité
Export PDF (Dompdf ou TCPDF)
Porte-monnaie : champ code promo + validation AJAX	
Page d’achat Gold	
Gestion des messages d’erreur/succès (toasts, alerts)	

 Andhy :  – Base de données & Intégration
Tâche	Priorité
Création du script SQL complet (tables, contraintes, clés étrangères)
Insertion des données minimales (5 users, 15 codes, 5 régimes, 5 activités)
Création des modèles CodeIgniter (UserModel, RegimeModel, ActiviteModel, CodeModel, PorteMonnaieModel)
Lier les modèles aux contrôleurs (aide à personne A)
Système de validation des codes promo (AJAX → mise à jour porte-monnaie)
Gestion de l’option Gold (vérification, remise 15%, historique)
Requêtes complexes (ex: meilleur régime pour un objectif)
Google Sheet de suivi des tâches (création + mise à jour quotidienne)
Script d’export/import SQL pour livraison
