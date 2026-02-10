<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Configuration
        $configData = [
            'name' => 'Beauty Fashion Shop',
            'logo' => 'logo.jpg',
            'address' => 'Jl. Contoh No. 123, Jakarta',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('configuration')->insert($configData);

        // Admin User
        $userData = [
            'name' => 'Super Admin',
            'email' => 'reylangko@admin.com',
            'password' => password_hash('rey123', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('users')->insert($userData);

        // Sample Category
        $categories = [
            [
                'name' => 'Batik',
                'slug' => 'batik',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('categories')->insertBatch($categories);

        // Sample Menu
        $menus = [
            [
                'name' => 'Home',
                'slug' => '/',
                'parent_id' => 0,
                'category_id' => 1,
                'type' => '0',
                'order' => 1,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Products',
                'slug' => '/products',
                'parent_id' => 0,
                'category_id' => 1,
                'type' => '1',
                'order' => 2,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Batik',
                'slug' => '/categories/batik',
                'parent_id' => 2,
                'category_id' => 1,
                'type' => '0',
                'order' => 1,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('menus')->insertBatch($menus);
    }
}