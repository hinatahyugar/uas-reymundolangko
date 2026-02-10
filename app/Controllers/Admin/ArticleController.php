<?php

namespace App\Controllers\Admin;

use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\TagModel;

class ArticleController extends BaseAdminController
{
    protected $articleModel;
    protected $categoryModel;
    protected $tagModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->articleModel = new ArticleModel();
        $this->categoryModel = new CategoryModel();
        $this->tagModel = new TagModel();
    }

    public function index()
    {
        $articles = $this->articleModel->findAll();
        
        $data = [
            'title' => 'Manajemen Artikel',
            'articles' => $articles
        ];
        
        return view('admin/articles/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Artikel Baru',
            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/articles/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[5]',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload image
        $image = $this->request->getFile('image');
        $imageName = $image->getRandomName();
        $image->move('uploads/articles', $imageName);

        // Convert tags array to string
        $tags = $this->request->getPost('tags');
        $tagsString = is_array($tags) ? implode(',', $tags) : '';

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => url_title($this->request->getPost('title'), '-', true),
            'content' => $this->request->getPost('content'),
            'image' => $imageName,
            'user_id' => session()->get('userId'),
            'category_id' => $this->request->getPost('category_id'),
            'tag' => $tagsString
        ];

        $this->articleModel->save($data);

        return redirect()->to('/admin/articles')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $article = $this->articleModel->find($id);
        
        if (!$article) {
            return redirect()->to('/admin/articles')->with('error', 'Artikel tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Artikel',
            'article' => $article,
            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/articles/edit', $data);
    }

    public function update($id)
    {
        $article = $this->articleModel->find($id);
        
        if (!$article) {
            return redirect()->to('/admin/articles')->with('error', 'Artikel tidak ditemukan.');
        }

        $rules = [
            'title' => 'required|min_length[5]',
            'content' => 'required',
            'category_id' => 'required'
        ];

        if ($this->request->getFile('image')->isValid()) {
            $rules['image'] = 'uploaded[image]|max_size[image,2048]|is_image[image]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle image upload
        $imageName = $article['image'];
        $image = $this->request->getFile('image');
        
        if ($image && $image->isValid()) {
            // Delete old image
            if ($imageName && file_exists('uploads/articles/' . $imageName)) {
                unlink('uploads/articles/' . $imageName);
            }
            
            $imageName = $image->getRandomName();
            $image->move('uploads/articles', $imageName);
        }

        // Convert tags array to string
        $tags = $this->request->getPost('tags');
        $tagsString = is_array($tags) ? implode(',', $tags) : '';

        $data = [
            'id' => $id,
            'title' => $this->request->getPost('title'),
            'slug' => url_title($this->request->getPost('title'), '-', true),
            'content' => $this->request->getPost('content'),
            'image' => $imageName,
            'category_id' => $this->request->getPost('category_id'),
            'tag' => $tagsString,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->articleModel->save($data);

        return redirect()->to('/admin/articles')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = $this->articleModel->find($id);
        
        if (!$article) {
            return redirect()->to('/admin/articles')->with('error', 'Artikel tidak ditemukan.');
        }

        // Delete image
        if ($article['image'] && file_exists('uploads/articles/' . $article['image'])) {
            unlink('uploads/articles/' . $article['image']);
        }

        $this->articleModel->delete($id);

        return redirect()->to('/admin/articles')->with('success', 'Artikel berhasil dihapus.');
    }
}