<?php

namespace App\Models;

use CodeIgniter\Model;

class CompositionOfficielleModel extends Model
{
    protected $table = 'composition_regime_officiel';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'regime_id',
        'pourcentage_viande',
        'pourcentage_poisson',
        'pourcentage_volaille',
    ];
    protected $useTimestamps = false;

    /**
     * Vérifie que la somme des pourcentages vaut exactement 100.
     *
     * @param int|float|string $viande
     * @param int|float|string $poisson
     * @param int|float|string $volaille
     * @return bool
     */
    public function verifierSomme($viande, $poisson, $volaille): bool
    {
        $total = (int) $viande + (int) $poisson + (int) $volaille;
        return $total === 100;
    }
}
