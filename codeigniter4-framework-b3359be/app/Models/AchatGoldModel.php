<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatGoldModel extends Model
{
    protected $table = 'achats_gold';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'date_achat', 'montant_paye', 'mode_paiement'];

    /**
     * Enregistre un nouvel achat Gold.
     *
     * @param int $user_id
     * @param float $montant
     * @param string $mode_paiement
     * @return bool
     */
    public function enregistrerAchat($user_id, $montant, $mode_paiement)
    {
        return $this->insert([
            'user_id' => $user_id,
            'date_achat' => date('Y-m-d H:i:s'),
            'montant_paye' => $montant,
            'mode_paiement' => $mode_paiement
        ]);
    }

    /**
     * Retourne le total des ventes Gold.
     *
     * @return float
     */
    public function getTotalVentes()
    {
        return $this->selectSum('montant_paye')->get()->getRow()->montant_paye;
    }
}