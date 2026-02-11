<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\CartModel;
use App\Models\ArticleModel;
use App\Models\ConfigurationModel;
use App\Models\CategoryModel;

class PageController extends BaseController
{
    public function about()
    {
        // Ambil data konfigurasi toko
        $configModel = new ConfigurationModel();
        $config = $configModel->find(1);
        
        // Hitung statistik real-time
        $productModel = new ProductModel();
        $totalProducts = $productModel->where('status', 'active')->countAllResults();
        
        $userModel = new UserModel();
        $totalCustomers = $userModel->where('role', 'user')->countAllResults();
        
        $cartModel = new CartModel();
        $totalOrders = $cartModel->where('status_cart', 'completed')->countAllResults();
        
        $articleModel = new ArticleModel();
        $totalArticles = $articleModel->countAllResults();
        
        $data = [
            'title' => 'Tentang Kami - Beauty Fashion Shop',
            'config' => $config,
            'stats' => [
                'products' => $totalProducts,
                'customers' => $totalCustomers,
                'orders' => $totalOrders,
                'articles' => $totalArticles
            ]
        ];

        return view('frontend/pages/about', $data);
    }

    public function contact()
    {
        // Ambil data konfigurasi toko
        $configModel = new ConfigurationModel();
        $config = $configModel->find(1);
        
        // Ambil daftar kategori untuk dropdown (opsional)
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->orderBy('name', 'ASC')->findAll();
        
        $data = [
            'title' => 'Kontak - Beauty Fashion Shop',
            'config' => $config,
            'categories' => $categories
        ];

        return view('frontend/pages/contact', $data);
    }
    
    public function sendContact()
    {
        // Method untuk memproses form kontak (akan diimplementasikan)
        // $this->validate();
        // Kirim email atau simpan ke database
        
        session()->setFlashdata('success', 'Pesan Anda telah terkirim. Tim kami akan segera merespon.');
        return redirect()->to('/contact');
    }
}