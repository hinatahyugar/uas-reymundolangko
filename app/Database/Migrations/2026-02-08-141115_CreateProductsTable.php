<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        // categories
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');

        // products
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'discount' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 0,
            ],
            'stock' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['standard', 'headline', 'latest_slider'],
                'default' => 'standard',
            ],
            'shopee_url' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'tokopedia_url' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'lazada_url' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'bukalapak_url' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default' => 'active',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
        $this->forge->dropTable('categories');
    }
}