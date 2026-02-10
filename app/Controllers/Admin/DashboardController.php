<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\CartModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class DashboardController extends BaseAdminController
{
    protected $productModel;
    protected $userModel;
    protected $cartModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // ✅ INIT MODEL DI SINI (AMAN)
        $this->productModel = new ProductModel();
        $this->userModel    = new UserModel();
        $this->cartModel    = new CartModel();
    }

    public function index()
    {
        $data = [
            'title'         => 'Admin Dashboard',
            'totalProducts' => $this->productModel->countAll(),
            'totalUsers'    => $this->userModel->countAll(),
            'totalOrders'   => $this->cartModel
                                    ->where('status_cart', 'completed')
                                    ->countAllResults(),
            'recentOrders'  => $this->cartModel
                                    ->orderBy('created_at', 'DESC')
                                    ->findAll(10),
            'topProducts'   => $this->productModel
                                    ->orderBy('id', 'DESC')
                                    ->findAll(5),
        ];

        return view('admin/dashboard/index', $data);
    }
}
