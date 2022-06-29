<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table                = 'users';
    protected $protectFields        = true;
    protected $allowedFields        = ['username','image'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    
    public function getUser($username)
    {
        if($username == false) {
            return $this->findAll();
        }
        return $this->where(['username' => $username])->first();
    }
    public function userActive()
    {
        return $this->where(['active' => 1])->findAll();
    }
}
