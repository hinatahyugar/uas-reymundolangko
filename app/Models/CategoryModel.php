<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Generate slug
    public function generateSlug($name)
    {
        $slug = strtolower(trim($name));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return $slug;
    }

    // Dengan jumlah produk
    public function withProductCount()
    {
        return $this->db->table($this->table)
            ->select('categories.*, COUNT(products.id) as product_count')
            ->join('products', 'products.category_id = categories.id', 'left')
            ->groupBy('categories.id')
            ->get()
            ->getResultArray();
    }
}