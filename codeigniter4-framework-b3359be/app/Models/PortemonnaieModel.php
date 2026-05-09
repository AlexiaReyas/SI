<?php

namespace App\Models;

use CodeIgniter\Model;

class PortemonnaieModel extends Model
{
    protected $table = 'portemonnaie';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'solde', 'dernier_ajout'];

    /**
     * Retourne le solde d'un utilisateur (crée un porte-monnaie si inexistant).
     *
     * @param int $user_id
     * @return float
     */
    public function getSolde($user_id)
    {
        $portemonnaie = $this->where('user_id', $user_id)->first();

        if (!$portemonnaie) {
            $this->insert(['user_id' => $user_id, 'solde' => 0, 'dernier_ajout' => null]);
            return 0;
        }

        return $portemonnaie['solde'];
    }

    /**
     * Ajoute de l'argent au solde d'un utilisateur.
     *
     * @param int $user_id
     * @param float $montant
     * @return float
     */
    public function ajouterArgent($user_id, $montant)
    {
        $portemonnaie = $this->where('user_id', $user_id)->first();

        if (!$portemonnaie) {
            $this->insert(['user_id' => $user_id, 'solde' => $montant, 'dernier_ajout' => date('Y-m-d H:i:s')]);
            return $montant;
        }

        $nouveauSolde = $portemonnaie['solde'] + $montant;
        $this->update($portemonnaie['id'], ['solde' => $nouveauSolde, 'dernier_ajout' => date('Y-m-d H:i:s')]);

        return $nouveauSolde;
    }

    /**
     * Déduit de l'argent du solde d'un utilisateur.
     *
     * @param int $user_id
     * @param float $montant
     * @return bool|float
     */
    public function deduireArgent($user_id, $montant)
    {
        $portemonnaie = $this->where('user_id', $user_id)->first();

        if (!$portemonnaie || $portemonnaie['solde'] < $montant) {
            return false;
        }

        $nouveauSolde = $portemonnaie['solde'] - $montant;
        $this->update($portemonnaie['id'], ['solde' => $nouveauSolde]);

        return $nouveauSolde;
    }
}