<?php

namespace App\Models;

use CodeIgniter\Model;

class CodePromoModel extends Model
{
    protected $table = 'codes_promo';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'valeur', 'type', 'utilisations_max', 'utilisations_actuelles', 'date_expiration'];

    /**
     * Vérifie si un code promo est valide.
     *
     * @param string $code
     * @return array|null
     */
    public function validerCode($code)
    {
        return $this->where('code', $code)
                    ->where('date_expiration >=', date('Y-m-d'))
                    ->where('utilisations_actuelles < utilisations_max')
                    ->first();
    }

    /**
     * Incrémente le compteur d'utilisations pour un code promo.
     *
     * @param int $code_id
     * @return bool
     */
    public function incrementUtilisation($code_id)
    {
        return $this->where('id', $code_id)
                    ->set('utilisations_actuelles', 'utilisations_actuelles + 1', false)
                    ->update();
    }

    /**
     * Utilise un code promo pour un utilisateur.
     *
     * @param int $user_id
     * @param string $code
     * @return array
     */
    public function utiliserCode($user_id, $code)
    {
        $portemonnaieModel = new \App\Models\PortemonnaieModel();
        $utilisationCodeModel = new \App\Models\UtilisationCodeModel();

        // Valider le code promo
        $codePromo = $this->validerCode($code);

        if (!$codePromo) {
            return ['success' => false, 'message' => 'Code invalide ou expiré.'];
        }

        // Ajouter l'argent au porte-monnaie de l'utilisateur
        $nouveauSolde = $portemonnaieModel->ajouterArgent($user_id, $codePromo['valeur']);

        // Incrémenter l'utilisation du code promo
        $this->incrementUtilisation($codePromo['id']);

        // Enregistrer l'utilisation dans la table utilisation_codes
        $utilisationCodeModel->insert([
            'user_id' => $user_id,
            'code_id' => $codePromo['id'],
            'date_utilisation' => date('Y-m-d H:i:s')
        ]);

        return [
            'success' => true,
            'message' => $codePromo['valeur'] . '€ ajoutés',
            'nouveau_solde' => $nouveauSolde
        ];
    }
}