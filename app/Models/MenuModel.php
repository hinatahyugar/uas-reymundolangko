<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'parent_id', 'category_id', 'type', 'order', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Ambil menu berdasarkan kategori (1=frontend, 2=admin)
    public function getByCategory($categoryId = 1, $status = 1)
    {
        return $this->where('category_id', $categoryId)
                    ->where('status', $status)
                    ->orderBy('order', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }

    // Ambil menu parent (untuk dropdown)
    public function getParentMenus()
    {
        return $this->where('parent_id', 0)
                    ->where('status', 1)
                    ->orderBy('order', 'ASC')
                    ->findAll();
    }

    // Ambil submenu berdasarkan parent_id
    public function getSubmenus($parentId)
    {
        return $this->where('parent_id', $parentId)
                    ->where('status', 1)
                    ->orderBy('order', 'ASC')
                    ->findAll();
    }
}