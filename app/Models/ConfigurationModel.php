<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfigurationModel extends Model
{
    protected $table = 'configuration';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'logo', 'address', 'phone', 'email', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Ambil data konfigurasi
    public function getConfig()
    {
        $config = $this->first();
        if (!$config) {
            // Default config jika belum ada
            return [
                'name' => 'Beauty Fashion Shop',
                'logo' => 'logo.png',
                'address' => 'Jl. Contoh No. 123, Jakarta',
                'phone' => '(021) 123-4567',
                'email' => 'info@beautyfashion.com'
            ];
        }
        return $config;
    }
}