<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class TestController extends Controller
{
    public function index()
    {
        // Charger le modèle UserModel
        $userModel = new UserModel();

        // Chercher l'utilisateur avec l'email 'alice@email.com'
        $user = $userModel->findByEmail('alice@email.com');

        if ($user) {
            // Afficher le nom de l'utilisateur trouvé
            echo "Nom de l'utilisateur : " . $user['nom'] . "<br>";

            // Vérifier si l'utilisateur est Gold
            if ($userModel->isGold($user['id'])) {
                echo "Gold";
            } else {
                echo "Pas Gold";
            }
        } else {
            echo "Utilisateur non trouvé.";
        }
    }
}