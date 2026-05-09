<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nom',
        'email',
        'mot_de_passe',
        'genre',
        'taille',
        'poids_initial',
        'est_gold',
        'date_inscription',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Retourne un utilisateur par email ou null si introuvable.
     *
     * @param string $email
     * @return array|null
     */
    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Indique si l'utilisateur est Gold.
     *
     * @param int $user_id
     * @return bool
     */
    public function isGold(int $user_id): bool
    {
        $user = $this->select('est_gold')->find($user_id);
        if (empty($user)) {
            return false;
        }

        return (bool) intval($user['est_gold']);
    }

    /**
     * Vérifie si un utilisateur est Gold.
     *
     * @param int $user_id
     * @return bool
     */
    public function hasGold($user_id)
    {
        $user = $this->find($user_id);
        return $user && isset($user['is_gold']) && $user['is_gold'] == 1;
    }

    /**
     * Active l'abonnement Gold pour un utilisateur et enregistre l'achat.
     *
     * @param int $user_id
     * @param string $mode_paiement
     * @return bool
     */
    public function activateGold($user_id, $mode_paiement = 'portemonnaie')
    {
        $achatGoldModel = new \App\Models\AchatGoldModel();

        // Enregistrer l'achat Gold
        $achatGoldModel->enregistrerAchat($user_id, 10.0, $mode_paiement);

        // Activer Gold pour l'utilisateur
        return $this->update($user_id, ['is_gold' => 1]);
    }
}
