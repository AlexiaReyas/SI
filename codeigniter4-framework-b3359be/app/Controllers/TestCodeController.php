<?php

namespace App\Controllers;

use App\Models\CodePromoModel;
use App\Models\PortemonnaieModel;
use CodeIgniter\Controller;

class TestCodeController extends Controller
{
    public function index()
    {
        // Charger les modèles CodePromoModel et PortemonnaieModel
        $codePromoModel = new CodePromoModel();
        $portemonnaieModel = new PortemonnaieModel();

        // Valider le code promo 'BIENVENUE10'
        $code = $codePromoModel->validerCode('BIENVENUE10');

        if ($code) {
            // Afficher que le code est valide et sa valeur
            echo "Code valide !<br>";
            echo "Valeur du code : " . $code['valeur'] . "<br>";
        } else {
            // Afficher que le code est invalide
            echo "Code invalide ou expiré.";
        }
    }
}