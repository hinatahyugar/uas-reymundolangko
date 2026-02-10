<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCartsTable extends Migration
{
    public function up()
    {
        // carts
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'no_invoice' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'status_cart' => [
                'type' => 'ENUM',
                'constraint' => ['cart', 'checkout', 'paid', 'shipped', 'completed', 'canceled'],
                'default' => 'cart',
            ],
            'status_pembayaran' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'paid', 'failed'],
                'default' => 'pending',
            ],
            'total' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
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
        $this->forge->createTable('carts');

        // cart_details
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'cart_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1,
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
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
        $this->forge->addForeignKey('cart_id', 'carts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cart_details');
    }

    public function down()
    {
        $this->forge->dropTable('cart_details');
        $this->forge->dropTable('carts');
    }
}