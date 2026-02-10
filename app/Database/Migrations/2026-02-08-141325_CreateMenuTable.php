<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuTable extends Migration
{
    public function up()
    {
        // menus table saja, configuration dipisah
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
            ],
            'parent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 0,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 1,
                'comment' => '1=frontend, 2=admin',
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['0', '1'],
                'default' => '0',
                'comment' => '0=single, 1=dropdown',
            ],
            'order' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['0', '1'],
                'default' => '1',
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
        $this->forge->createTable('menus');
    }

    public function down()
    {
        $this->forge->dropTable('menus');
    }
}