<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        // tags
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
        $this->forge->createTable('tags');

        // articles
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
            'content' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'tag' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
                'comment' => 'Comma separated tag IDs',
            ],
            'like_count' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'comment_count' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('articles');
    }

    public function down()
    {
        $this->forge->dropTable('articles');
        $this->forge->dropTable('tags');
    }
}