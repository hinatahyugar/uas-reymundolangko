<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDetailModel extends Model
{
    protected $table = 'user_details';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'address', 'phone', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Update atau insert detail
    public function upsert($userId, $data)
    {
        $existing = $this->where('user_id', $userId)->first();
        
        if ($existing) {
            $data['id'] = $existing['id'];
            return $this->save($data);
        } else {
            $data['user_id'] = $userId;
            return $this->insert($data);
        }
    }

    // Ambil detail berdasarkan user_id
    public function findByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}