<?php

use App\Models\UserModel;
use App\Models\ParametreModel;

if (!function_exists('calculerPrixAvecRemise')) {
    /**
     * Calcule le prix avec la remise Gold si applicable.
     *
     * @param float $prix_normal
     * @param int $user_id
     * @return float
     */
    function calculerPrixAvecRemise($prix_normal, $user_id)
    {
        $userModel = new UserModel();
        $parametreModel = new ParametreModel();

        // Vérifier si l'utilisateur est Gold
        if ($userModel->hasGold($user_id)) {
            // Récupérer le pourcentage de remise Gold
            $remise = $parametreModel->get('remise_gold', 15);
            return $prix_normal * (1 - $remise / 100);
        }

        // Retourner le prix normal si non Gold
        return $prix_normal;
    }
}