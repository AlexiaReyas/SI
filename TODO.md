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
