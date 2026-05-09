<?php

namespace App\Models;

use CodeIgniter\Model;

class MesureModel extends Model
{
    protected $table = 'mesures_utilisateur';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id',
        'date_mesure',
        'poids',
        'imc_calcule',
    ];
    protected $useTimestamps = false;

    /**
     * Retourne toutes les mesures d'un utilisateur triées par date (asc).
     *
     * @param int $user_id
     * @return array
     */
    public function getEvolution(int $user_id): array
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('date_mesure', 'ASC')
                    ->findAll();
    }

    /**
     * Retourne la dernière mesure d'un utilisateur (ou null).
     *
     * @param int $user_id
     * @return array|null
     */
    public function getDerniereMesure(int $user_id): ?array
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('date_mesure', 'DESC')
                    ->first();
    }
}
