<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nom',
        'email',
        'mot_de_passe',
        'genre',
        'taille',
        'poids_initial',
        'est_gold',
        'date_inscription',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Retourne un utilisateur par email ou null si introuvable.
     *
     * @param string $email
     * @return array|null
     */
    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Indique si l'utilisateur est Gold.
     *
     * @param int $user_id
     * @return bool
     */
    public function isGold(int $user_id): bool
    {
        $user = $this->select('est_gold')->find($user_id);
        if (empty($user)) {
            return false;
        }

        return (bool) intval($user['est_gold']);
    }
}
