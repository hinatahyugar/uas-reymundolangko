<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\CartModel;
use App\Models\CategoryModel;

class DashboardController extends BaseAdminController
{
    protected $productModel;
    protected $userModel;
    protected $cartModel;
    protected $categoryModel;

    public function initController(
        $request,
        $response,
        $logger
    ) {
        parent::initController($request, $response, $logger);

        // Initialize models
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        // Get today's date
        $today = date('Y-m-d');
        
        // Calculate total revenue from completed orders
        $revenueData = $this->cartModel
            ->select('SUM(total) as total_revenue')
            ->where('status_cart', 'completed')
            ->first();
        $totalRevenue = $revenueData ? (float)$revenueData['total_revenue'] : 0;
        
        // Calculate today's revenue
        $revenueToday = $this->cartModel
            ->select('SUM(total) as today_revenue')
            ->where('DATE(created_at)', $today)
            ->where('status_cart', 'completed')
            ->first();
        $todayRevenue = $revenueToday ? (float)$revenueToday['today_revenue'] : 0;
        
        // Orders today
        $ordersToday = $this->cartModel
            ->where('DATE(created_at)', $today)
            ->where('status_cart', 'completed')
            ->countAllResults();
            
        // New users today
        $newUsersToday = $this->userModel
            ->where('DATE(created_at)', $today)
            ->countAllResults();
            
        // Pending orders (checkout or paid status)
        $pendingOrders = $this->cartModel
            ->whereIn('status_cart', ['checkout', 'paid'])
            ->countAllResults();
            
        // Out of stock products
        $outOfStock = $this->productModel
            ->where('stock <=', 0)
            ->countAllResults();
            
        // Active products rate
        $activeProducts = $this->productModel
            ->where('status', 'active')
            ->countAllResults();
        $totalProductsCount = $this->productModel->countAll();
        $activeRate = $totalProductsCount > 0 ? round(($activeProducts / $totalProductsCount) * 100) : 0;
        
        // Recent orders with user info (limit 10)
        $recentOrders = $this->cartModel
            ->select('carts.*, users.name as user_name')
            ->join('users', 'users.id = carts.user_id')
            ->orderBy('carts.created_at', 'DESC')
            ->findAll(10);
            
        // Top products (latest 5)
        $topProductsRaw = $this->productModel
            ->orderBy('created_at', 'DESC')
            ->findAll(5);
            
        // Get categories for top products
        $topProducts = [];
        foreach ($topProductsRaw as $product) {
            $category = $this->categoryModel->find($product['category_id']);
            $product['category_name'] = $category ? $category['name'] : 'Unknown';
            $topProducts[] = $product;
        }
        
        // Order status counts
        $statuses = ['cart', 'checkout', 'paid', 'shipped', 'completed', 'canceled'];
        $statusCounts = [];
        $totalCarts = $this->cartModel->countAll();
        
        foreach ($statuses as $status) {
            $count = $this->cartModel->where('status_cart', $status)->countAllResults();
            $percentage = $totalCarts > 0 ? round(($count / $totalCarts) * 100) : 0;
            $statusCounts[$status] = [
                'count' => $count,
                'percentage' => $percentage
            ];
        }

        // Prepare data for view
        $data = [
            'title' => 'Admin Dashboard',
            'totalProducts' => $totalProductsCount,
            'totalUsers' => $this->userModel->countAll(),
            'totalOrders' => $this->cartModel->where('status_cart', 'completed')->countAllResults(),
            'totalRevenue' => $totalRevenue,
            'todayRevenue' => $todayRevenue,
            'ordersToday' => $ordersToday,
            'newUsersToday' => $newUsersToday,
            'pendingOrders' => $pendingOrders,
            'outOfStock' => $outOfStock,
            'activeRate' => $activeRate,
            'recentOrders' => $recentOrders,
            'topProducts' => $topProducts,
            'statusCounts' => $statusCounts,
            'statuses' => $statuses
        ];

        return view('admin/dashboard/index', $data);
    }
}