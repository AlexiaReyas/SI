<?php

namespace App\Models;

use CodeIgniter\Model;

class ParametreModel extends Model
{
    protected $table = 'parametres';
    protected $primaryKey = 'id';
    protected $allowedFields = ['cle', 'valeur', 'description'];

    /**
     * Récupère la valeur d'un paramètre.
     *
     * @param string $cle
     * @param mixed $default
     * @return mixed
     */
    public function get($cle, $default = null)
    {
        $param = $this->where('cle', $cle)->first();
        return $param ? $param['valeur'] : $default;
    }

    /**
     * Définit ou met à jour un paramètre.
     *
     * @param string $cle
     * @param mixed $valeur
     * @param string|null $description
     * @return bool
     */
    public function set($cle, $valeur, $description = null)
    {
        $param = $this->where('cle', $cle)->first();

        if ($param) {
            return $this->update($param['id'], ['valeur' => $valeur, 'description' => $description]);
        }

        return $this->insert(['cle' => $cle, 'valeur' => $valeur, 'description' => $description]);
    }
}