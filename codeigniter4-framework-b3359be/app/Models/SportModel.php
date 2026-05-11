<?php

namespace App\Models;

use CodeIgniter\Model;

class SportModel extends Model
{
    protected $table = 'sports';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'calories_par_heure', 'difficulte', 'description'];

    /**
     * Retourne les sports par difficulté.
     *
     * @param string $difficulte
     * @return array
     */
    public function getByDifficulte($difficulte)
    {
        return $this->where('difficulte', $difficulte)->findAll();
    }

    /**
     * Retourne les sports associés à un régime.
     *
     * @param int $regime_id
     * @return array
     */
    public function getByRegime($regime_id)
    {
        return $this->select('sports.*')
                    ->join('regime_sports', 'regime_sports.sport_id = sports.id')
                    ->where('regime_sports.regime_id', $regime_id)
                    ->findAll();
    }
}