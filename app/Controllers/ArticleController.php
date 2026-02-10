<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\UserModel;

class ArticleController extends BaseController
{
    protected $articleModel;
    protected $categoryModel;
    protected $userModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->categoryModel = new CategoryModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Get paginated articles with user and category data
        $articles = $this->articleModel
            ->select('articles.*, users.name as author_name, categories.name as category_name')
            ->join('users', 'users.id = articles.user_id')
            ->join('categories', 'categories.id = articles.category_id')
            ->orderBy('articles.created_at', 'DESC')
            ->paginate(9); // 9 articles per page for 3x3 grid

        $pager = $this->articleModel->pager;
        $categories = $this->categoryModel->findAll();
        
        // Get popular articles for sidebar
        $popular = $this->articleModel
            ->orderBy('like_count', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'title' => 'Artikel & Tips Fashion - Beauty Fashion Shop',
            'articles' => $articles,
            'pager' => $pager,
            'categories' => $categories,
            'popular' => $popular,
            'meta_description' => 'Temukan artikel terbaru tentang fashion, batik, dan tips gaya hidup dari Beauty Fashion Shop Kupang.'
        ];

        return view('frontend/articles/index', $data);
    }

    public function show($slug)
    {
        $article = $this->articleModel
            ->select('articles.*, users.name as author_name, categories.name as category_name')
            ->join('users', 'users.id = articles.user_id')
            ->join('categories', 'categories.id = articles.category_id')
            ->where('articles.slug', $slug)
            ->first();

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Increment view count (optional - bisa ditambahkan field view_count)
        
        // Related articles (same category)
        $related = $this->articleModel
            ->where('category_id', $article['category_id'])
            ->where('id !=', $article['id'])
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->findAll();

        // Get popular articles for sidebar
        $popular = $this->articleModel
            ->where('id !=', $article['id'])
            ->orderBy('like_count', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'title' => $article['title'] . ' - Beauty Fashion Shop',
            'article' => $article,
            'related' => $related,
            'popular' => $popular,
            'meta_description' => substr(strip_tags($article['content']), 0, 160) . '...'
        ];

        return view('frontend/articles/show', $data);
    }
}