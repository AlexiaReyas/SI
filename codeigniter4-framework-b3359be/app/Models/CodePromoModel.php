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
}