<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ArticleModel;

class HomeController extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $articleModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->articleModel = new ArticleModel();
    }

    public function index()
    {
        // Produk terbaru (8 produk)
        $products = $this->productModel->where('status', 'active')
                                       ->orderBy('created_at', 'DESC')
                                       ->limit(8)
                                       ->findAll();

        // Kategori dengan product_count
        $categories = $this->categoryModel
            ->select('categories.*, COUNT(products.id) as product_count')
            ->join('products', 'products.category_id = categories.id AND products.status = "active"', 'left')
            ->groupBy('categories.id')
            ->findAll();

        // Artikel terbaru
        $articles = $this->articleModel->orderBy('created_at', 'DESC')
                                       ->limit(3)
                                       ->findAll();

        // Produk diskon
        $discountProducts = $this->productModel->where('discount >', 0)
                                               ->where('status', 'active')
                                               ->orderBy('discount', 'DESC')
                                               ->limit(4)
                                               ->findAll();

        $data = [
            'title' => 'Home - Beauty Fashion Shop',
            'products' => $products,
            'categories' => $categories,
            'articles' => $articles,
            'discountProducts' => $discountProducts
        ];

        return view('frontend/home', $data);
    }
}