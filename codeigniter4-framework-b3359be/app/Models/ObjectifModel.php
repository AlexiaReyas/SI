<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectifModel extends Model
{
    protected $table = 'objectifs_utilisateur';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id',
        'objectif_type',
        'poids_cible',
        'date_debut',
        'date_fin',
    ];
    protected $useTimestamps = false;

    /**
     * Retourne l'objectif le plus récent pour un utilisateur (ou null).
     *
     * @param int $user_id
     * @return array|null
     */
    public function getObjectifActuel(int $user_id): ?array
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('date_debut', 'DESC')
                    ->first();
    }
}
