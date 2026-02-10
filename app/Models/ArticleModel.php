<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'slug', 'content', 'image', 'user_id', 'category_id', 
        'tag', 'like_count', 'comment_count', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'slug' => 'required|is_unique[articles.slug,id,{id}]',
        'content' => 'required'
    ];
    protected $validationMessages = [];

    // Get articles with user and category (paginated)
    public function getArticlesPaginated($perPage = 9)
    {
        return $this->select('articles.*, users.name as author_name, categories.name as category_name')
            ->join('users', 'users.id = articles.user_id')
            ->join('categories', 'categories.id = articles.category_id')
            ->orderBy('articles.created_at', 'DESC')
            ->paginate($perPage);
    }

    // Get single article with joins
    public function getArticleWithAuthor($slug)
    {
        return $this->select('articles.*, users.name as author_name, categories.name as category_name')
            ->join('users', 'users.id = articles.user_id')
            ->join('categories', 'categories.id = articles.category_id')
            ->where('articles.slug', $slug)
            ->first();
    }

    // Get popular articles
    public function getPopularArticles($limit = 5)
    {
        return $this->select('id, title, slug, image, like_count, created_at')
            ->orderBy('like_count', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    // Get related articles
    public function getRelatedArticles($categoryId, $excludeId, $limit = 3)
    {
        return $this->select('id, title, slug, image, created_at')
            ->where('category_id', $categoryId)
            ->where('id !=', $excludeId)
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    // Count articles by category
    public function countByCategory($categoryId)
    {
        return $this->where('category_id', $categoryId)->countAllResults();
    }

    // Generate unique slug
    public function generateUniqueSlug($title)
    {
        $slug = url_title($title, '-', true);
        $originalSlug = $slug;
        $counter = 1;

        while ($this->where('slug', $slug)->first()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}