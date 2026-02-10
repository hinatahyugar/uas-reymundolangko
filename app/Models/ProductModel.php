<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'slug', 'category_id', 'price', 'discount', 'stock', 
        'description', 'image', 'type', 'shopee_url', 'tokopedia_url', 
        'lazada_url', 'bukalapak_url', 'status', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Dengan kategori
    public function withCategory()
    {
        return $this->db->table($this->table)
            ->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.category_id')
            ->get()
            ->getResultArray();
    }

    // Produk aktif
    public function getActiveProducts()
    {
        return $this->where('status', 'active')->findAll();
    }

    // Cari berdasarkan kategori
    public function getByCategory($categoryId)
    {
        return $this->where('category_id', $categoryId)
                    ->where('status', 'active')
                    ->findAll();
    }
}