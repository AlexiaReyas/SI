<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeSportModel extends Model
{
    protected $table = 'regime_sports';
    protected $primaryKey = 'id';
    protected $allowedFields = ['regime_id', 'sport_id', 'duree_recommandee_minutes', 'jours_par_semaine'];

    /**
     * Retourne les sports associés à un régime avec leurs durées recommandées.
     *
     * @param int $regime_id
     * @return array
     */
    public function getSportsByRegime($regime_id)
    {
        return $this->select('sports.nom, regime_sports.duree_recommandee_minutes, regime_sports.jours_par_semaine')
                    ->join('sports', 'sports.id = regime_sports.sport_id')
                    ->where('regime_sports.regime_id', $regime_id)
                    ->findAll();
    }
}