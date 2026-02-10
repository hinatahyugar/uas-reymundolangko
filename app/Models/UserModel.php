<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'role', 'profile_photo_path', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // Hash password sebelum insert/update
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // Cari user berdasarkan email
    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    // Ambil user dengan detail
    public function withDetails($id)
    {
        return $this->db->table($this->table)
            ->select('users.*, user_details.address, user_details.phone')
            ->join('user_details', 'user_details.user_id = users.id', 'left')
            ->where('users.id', $id)
            ->get()
            ->getRowArray();
    }

    // Update profile photo
    public function updateProfilePhoto($id, $photoPath)
    {
        return $this->update($id, ['profile_photo_path' => $photoPath]);
    }

    // Check if user is admin
    public function isAdmin($userId)
    {
        $user = $this->find($userId);
        return $user && $user['role'] === 'admin';
    }
}