<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'slug', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Cari tag berdasarkan array ID
    public function findByIds($ids)
    {
        if (empty($ids)) return [];
        
        if (is_string($ids)) {
            $ids = explode(',', $ids);
        }
        
        return $this->whereIn('id', $ids)->findAll();
    }

    // Tag populer (berdasarkan penggunaan)
    public function getPopular($limit = 10)
    {
        return $this->orderBy('title', 'ASC')
                    ->limit($limit)
                    ->findAll();
    }
}