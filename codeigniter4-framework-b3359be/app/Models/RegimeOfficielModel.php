<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeOfficielModel extends Model
{
    protected $table = 'regimes_officiels';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nom',
        'description',
        'objectif',
    ];
    protected $useTimestamps = false;

    /**
     * Retourne tous les régimes correspondant à un objectif donné.
     *
     * @param string $objectif
     * @return array
     */
    public function getByObjectif(string $objectif): array
    {
        return $this->where('objectif', $objectif)->findAll();
    }

    /**
     * Retourne un régime avec sa composition (jointure left).
     *
     * @param int $id
     * @return array|null
     */
    public function getWithComposition(int $id): ?array
    {
        $builder = $this->builder();
        $builder->select('regimes_officiels.*, composition_regime_officiel.pourcentage_viande, composition_regime_officiel.pourcentage_poisson, composition_regime_officiel.pourcentage_volaille');
        $builder->join('composition_regime_officiel', 'composition_regime_officiel.regime_id = regimes_officiels.id', 'left');
        $builder->where('regimes_officiels.id', $id);

        $query = $builder->get();
        return $query->getRowArray();
    }
}
