<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'no_invoice', 'status_cart', 'status_pembayaran', 'total', 'created_at', 'updated_at'];
    protected $useTimestamps = false;

    // Ambil dengan relasi user dan detail
    public function getWithDetails()
    {
        return $this->db->table($this->table)
            ->select('carts.*, users.name as user_name, users.email as user_email, user_details.address, user_details.phone')
            ->join('users', 'users.id = carts.user_id')
            ->join('user_details', 'user_details.user_id = users.id', 'left')
            ->orderBy('carts.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    // Ambil satu order dengan detail lengkap
    public function getOrderWithDetails($id)
    {
        $cart = $this->db->table($this->table)
            ->select('carts.*, users.name as user_name, users.email as user_email, user_details.address, user_details.phone')
            ->join('users', 'users.id = carts.user_id')
            ->join('user_details', 'user_details.user_id = users.id', 'left')
            ->where('carts.id', $id)
            ->get()
            ->getRowArray();

        if ($cart) {
            $cart['details'] = $this->db->table('cart_details')
                ->select('cart_details.*, products.title, products.image')
                ->join('products', 'products.id = cart_details.product_id')
                ->where('cart_details.cart_id', $id)
                ->get()
                ->getResultArray();
        }

        return $cart;
    }

    // Generate nomor invoice
    public function generateInvoiceNumber()
    {
        $date = date('Ymd');
        $last = $this->db->table($this->table)
            ->like('no_invoice', 'INV-' . $date)
            ->orderBy('id', 'DESC')
            ->get()
            ->getRow();

        if ($last) {
            $lastNumber = (int) substr($last->no_invoice, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'INV-' . $date . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    // Update status order
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status_cart' => $status]);
    }

    /**
     * Get sales report dengan filter
     */
    public function getSalesReport($startDate = null, $endDate = null, $productId = null, $categoryId = null)
    {
        $builder = $this->db->table('cart_details')
            ->select('
                products.id as product_id,
                products.title as product_name,
                categories.name as category_name,
                SUM(cart_details.qty) as total_qty,
                SUM(cart_details.subtotal) as total_sales
            ')
            ->join('carts', 'carts.id = cart_details.cart_id')
            ->join('products', 'products.id = cart_details.product_id')
            ->join('categories', 'categories.id = products.category_id')
            ->where('carts.status_cart', 'completed')
            ->groupBy('products.id, products.title, categories.name');

        // Filter tanggal
        if ($startDate) {
            $builder->where('DATE(carts.created_at) >=', $startDate);
        }

        if ($endDate) {
            $builder->where('DATE(carts.created_at) <=', $endDate);
        }

        // Filter produk
        if ($productId) {
            $builder->where('products.id', $productId);
        }

        // Filter kategori
        if ($categoryId) {
            $builder->where('categories.id', $categoryId);
        }

        return $builder->get()->getResultArray();
    }

    /**
     * Get daily sales summary
     */
    public function getDailySales($date = null)
    {
        $date = $date ?? date('Y-m-d');
        
        return $this->db->table('carts')
            ->select("
                DATE(created_at) as sale_date,
                COUNT(*) as total_orders,
                SUM(total) as total_sales,
                AVG(total) as avg_order_value
            ")
            ->where('status_cart', 'completed')
            ->where('DATE(created_at)', $date)
            ->groupBy('DATE(created_at)')
            ->get()
            ->getRowArray();
    }

    /**
     * Get monthly sales summary
     */
    public function getMonthlySales($yearMonth = null)
    {
        $yearMonth = $yearMonth ?? date('Y-m');
        
        return $this->db->table('carts')
            ->select("
                DATE_FORMAT(created_at, '%Y-%m') as sale_month,
                COUNT(*) as total_orders,
                SUM(total) as total_sales,
                AVG(total) as avg_order_value
            ")
            ->where('status_cart', 'completed')
            ->where("DATE_FORMAT(created_at, '%Y-%m')", $yearMonth)
            ->groupBy('sale_month')
            ->get()
            ->getRowArray();
    }

    /**
     * Get top selling products
     */
    public function getTopProducts($limit = 10)
    {
        return $this->db->table('cart_details')
            ->select('
                products.id,
                products.title,
                products.image,
                categories.name as category_name,
                SUM(cart_details.qty) as total_sold,
                SUM(cart_details.subtotal) as total_revenue
            ')
            ->join('carts', 'carts.id = cart_details.cart_id')
            ->join('products', 'products.id = cart_details.product_id')
            ->join('categories', 'categories.id = products.category_id')
            ->where('carts.status_cart', 'completed')
            ->groupBy('products.id, products.title, products.image, categories.name')
            ->orderBy('total_sold', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /**
     * Get sales by category
     */
    public function getSalesByCategory()
    {
        return $this->db->table('cart_details')
            ->select('
                categories.id,
                categories.name,
                SUM(cart_details.qty) as total_qty,
                SUM(cart_details.subtotal) as total_sales
            ')
            ->join('carts', 'carts.id = cart_details.cart_id')
            ->join('products', 'products.id = cart_details.product_id')
            ->join('categories', 'categories.id = products.category_id')
            ->where('carts.status_cart', 'completed')
            ->groupBy('categories.id, categories.name')
            ->orderBy('total_sales', 'DESC')
            ->get()
            ->getResultArray();
    }

    // Tambahkan method ini di class CartModel

/**
 * Get filtered orders for export
 */
public function getFilteredOrders($status = null, $date = null)
{
    $builder = $this->db->table('carts c')
        ->select('c.*, u.name as user_name, u.email as user_email, ud.address, ud.phone')
        ->join('users u', 'u.id = c.user_id', 'left')
        ->join('user_details ud', 'ud.user_id = u.id', 'left')
        ->orderBy('c.created_at', 'DESC');

    // Filter status
    if ($status && !empty($status)) {
        $builder->where('c.status_cart', $status);
    }

    // Filter date
    if ($date && !empty($date)) {
        $builder->where('DATE(c.created_at)', $date);
    }

    return $builder->get()->getResultArray();
}

/**
 * Get all orders (for export without filter)
 */
public function getAllOrders()
{
    return $this->db->table('carts c')
        ->select('c.*, u.name as user_name, u.email as user_email, ud.address, ud.phone')
        ->join('users u', 'u.id = c.user_id', 'left')
        ->join('user_details ud', 'ud.user_id = u.id', 'left')
        ->orderBy('c.created_at', 'DESC')
        ->get()
        ->getResultArray();
}
}