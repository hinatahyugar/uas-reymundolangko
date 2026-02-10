<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class ProductController extends BaseAdminController
{
    protected $productModel;
    protected $categoryModel;
    protected $validation;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // ✅ INIT SEMUA DEPENDENCY DI SINI
        $this->productModel  = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->validation    = \Config\Services::validation();

        helper(['form', 'text', 'url']);
    }

    /**
     * Menampilkan semua produk
     */
    public function index()
    {
        $products = $this->productModel->withCategory();

        return view('admin/products/index', [
            'title'    => 'Data Produk - Admin',
            'products' => $products
        ]);
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        return view('admin/products/create', [
            'title'      => 'Tambah Produk - Admin',
            'categories' => $this->categoryModel->findAll(),
            'validation' => $this->validation
        ]);
    }

    /**
     * Simpan produk
     */
    public function store()
    {
        $rules = [
            'title'       => 'required|min_length[3]',
            'category_id' => 'required',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'description' => 'required',
            'image'       => 'uploaded[image]|max_size[image,2048]|is_image[image]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = $this->request->getFile('image');
        $imageName = $image->getRandomName();
        $image->move('uploads/products', $imageName);

        $this->productModel->save([
            'title'       => $this->request->getPost('title'),
            'slug'        => url_title($this->request->getPost('title'), '-', true),
            'category_id' => $this->request->getPost('category_id'),
            'price'       => $this->request->getPost('price'),
            'discount'    => $this->request->getPost('discount') ?? 0,
            'stock'       => $this->request->getPost('stock'),
            'description' => $this->request->getPost('description'),
            'image'       => $imageName,
            'status'      => $this->request->getPost('status') ?? 'active'
        ]);

        return redirect()->to('/admin/products')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Edit produk
     */
    public function edit($id)
    {
        $product = $this->productModel->find($id);

        if (! $product) {
            return redirect()->to('/admin/products')->with('error', 'Produk tidak ditemukan');
        }

        return view('admin/products/edit', [
            'title'      => 'Edit Produk - Admin',
            'product'    => $product,
            'categories' => $this->categoryModel->findAll(),
            'validation' => $this->validation
        ]);
    }

    /**
 * Update produk
 */
public function update($id)
{
    $product = $this->productModel->find($id);
    if (!$product) {
        return redirect()->to('/admin/products')->with('error', 'Produk tidak ditemukan');
    }

    // Validasi
    $rules = [
        'title'       => 'required|min_length[3]',
        'category_id' => 'required',
        'price'       => 'required|numeric',
        'stock'       => 'required|numeric',
        'description' => 'required'
    ];

    // Jika ada file gambar baru
    $image = $this->request->getFile('image');
    if ($image && $image->isValid()) {
        $rules['image'] = 'uploaded[image]|max_size[image,2048]|is_image[image]';
    }

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Handle image
    $imageName = $product['image'];
    
    // Jika hapus gambar
    if ($this->request->getPost('remove_image') == '1') {
        if ($imageName && file_exists('uploads/products/' . $imageName)) {
            unlink('uploads/products/' . $imageName);
        }
        $imageName = null;
    }
    
    // Jika upload gambar baru
    if ($image && $image->isValid()) {
        // Hapus gambar lama
        if ($imageName && file_exists('uploads/products/' . $imageName)) {
            unlink('uploads/products/' . $imageName);
        }
        
        $imageName = $image->getRandomName();
        $image->move('uploads/products', $imageName);
    }

    // Update data
    $data = [
        'id'          => $id,
        'title'       => $this->request->getPost('title'),
        'slug'        => url_title($this->request->getPost('title'), '-', true),
        'category_id' => $this->request->getPost('category_id'),
        'price'       => $this->request->getPost('price'),
        'discount'    => $this->request->getPost('discount') ?? 0,
        'stock'       => $this->request->getPost('stock'),
        'description' => $this->request->getPost('description'),
        'image'       => $imageName,
        'type'        => $this->request->getPost('type') ?? 'standard',
        'shopee_url'  => $this->request->getPost('shopee_url'),
        'tokopedia_url' => $this->request->getPost('tokopedia_url'),
        'lazada_url'  => $this->request->getPost('lazada_url'),
        'bukalapak_url' => $this->request->getPost('bukalapak_url'),
        'status'      => $this->request->getPost('status') ?? 'active',
        'updated_at'  => date('Y-m-d H:i:s')
    ];

    $this->productModel->save($data);

    return redirect()->to('/admin/products')->with('success', 'Produk berhasil diperbarui');
}

    // Admin\ProductController.php - tambahkan method ini
    public function show($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()->to('/admin/products')->with('error', 'Produk tidak ditemukan');
        }

        return view('admin/products/show', [
            'title'   => 'Detail Produk - Admin',
            'product' => $product
        ]);
    }

    /**
     * Hapus produk
     */
    public function destroy($id)
    {
        $product = $this->productModel->find($id);

        if (! $product) {
            return redirect()->to('/admin/products')->with('error', 'Produk tidak ditemukan');
        }

        if ($product['image'] && file_exists('uploads/products/' . $product['image'])) {
            unlink('uploads/products/' . $product['image']);
        }

        $this->productModel->delete($id);

        return redirect()->to('/admin/products')->with('success', 'Produk berhasil dihapus');
    }
}
