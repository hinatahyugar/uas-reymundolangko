<?php

namespace App\Models;

use CodeIgniter\Model;

class CartDetailModel extends Model
{
    protected $table = 'cart_details';
    protected $primaryKey = 'id';
    protected $allowedFields = ['cart_id', 'product_id', 'qty', 'harga', 'subtotal', 'created_at', 'updated_at'];
    protected $useTimestamps = false;
}