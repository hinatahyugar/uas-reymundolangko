<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categoryId = $this->request->getGet('category');
        $search = $this->request->getGet('search');

        $builder = $this->productModel->where('status', 'active');

        if ($categoryId) {
            $builder->where('category_id', $categoryId);
        }

        if ($search) {
            $builder->like('title', $search)
                    ->orLike('description', $search);
        }

        $products = $builder->orderBy('created_at', 'DESC')->findAll();
        $categories = $this->categoryModel->findAll();

        $data = [
            'title' => 'Products - Beauty Fashion Shop',
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $categoryId,
            'search' => $search
        ];

        return view('frontend/products/index', $data);
    }

    public function show($id)
    {
        $product = $this->productModel->find($id);

        if (!$product || $product['status'] != 'active') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Produk terkait (same category)
        $related = $this->productModel
            ->where('category_id', $product['category_id'])
            ->where('id !=', $id)
            ->where('status', 'active')
            ->limit(4)
            ->findAll();

        $data = [
            'title' => $product['title'] . ' - Beauty Fashion Shop',
            'product' => $product,
            'related' => $related
        ];

        return view('frontend/products/show', $data);
    }

    
}