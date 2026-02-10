<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class CategoryController extends BaseController
{
    protected $categoryModel;
    protected $productModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }

    // CategoryController.php - ubah method show
public function show($slug)
{
    $category = $this->categoryModel->where('slug', $slug)->first();

    if (!$category) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $products = $this->productModel
        ->where('category_id', $category['id'])
        ->where('status', 'active')
        ->orderBy('created_at', 'DESC')
        ->findAll();

    // Tambah placeholder untuk produk tanpa gambar
    foreach ($products as &$product) {
        if (empty($product['image']) || !file_exists(FCPATH . 'uploads/products/' . $product['image'])) {
            $product['image'] = 'placeholder.jpg'; // atau URL default
        }
    }

    $data = [
        'title' => $category['name'] . ' - Beauty Fashion Shop',
        'category' => $category,
        'products' => $products
    ];

    return view('frontend/categories/show', $data);
}
}