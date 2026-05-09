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

    /**
     * Retourne les utilisateurs ayant le plus progressé en termes de variation de poids.
     *
     * @param int $limit
     * @return array
     */
    public function getTopProgressUsers($limit = 5)
    {
        $builder = $this->db->table('mesures_utilisateur');
        $builder->select('utilisateurs.id as user_id, utilisateurs.nom, MAX(mesures_utilisateur.poids) - MIN(mesures_utilisateur.poids) as progression')
                ->join('utilisateurs', 'utilisateurs.id = mesures_utilisateur.user_id')
                ->groupBy('mesures_utilisateur.user_id')
                ->orderBy('progression', 'DESC')
                ->limit($limit);

        $query = $builder->get();
        return $query->getResultArray();
    }
}
