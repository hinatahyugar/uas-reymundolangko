<?php

namespace App\Controllers\Admin;

use App\Models\CategoryModel;

class CategoryController extends BaseAdminController
{
    protected $categoryModel;
    protected $validation;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

   

        $this->categoryModel = new CategoryModel();
        $this->validation = \Config\Services::validation();
        helper(['form', 'text', 'url']);
    }

    public function index()
    {
        $categories = $this->categoryModel->withProductCount();

        return view('admin/categories/index', [
            'title' => 'Data Kategori - Admin',
            'categories' => $categories
        ]);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]|is_unique[categories.name]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getPost('name');

        $this->categoryModel->save([
            'name' => $name,
            'slug' => $this->categoryModel->generateSlug($name)
        ]);

        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }

        $rules = [
            'name' => "required|min_length[3]|is_unique[categories.name,id,$id]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getPost('name');

        $this->categoryModel->save([
            'id'   => $id,
            'name' => $name,
            'slug' => $this->categoryModel->generateSlug($name)
        ]);

        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $count = $this->categoryModel->db
            ->table('products')
            ->where('category_id', $id)
            ->countAllResults();

        if ($count > 0) {
            return redirect()->back()->with(
                'error',
                "Kategori masih digunakan oleh $count produk."
            );
        }

        $this->categoryModel->delete($id);

        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil dihapus!');
    }
}