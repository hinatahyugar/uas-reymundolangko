<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CartDetailModel;
use App\Models\ProductModel;

class CartController extends BaseController
{
    protected $cartModel;
    protected $cartDetailModel;
    protected $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->cartDetailModel = new CartDetailModel();
        $this->productModel = new ProductModel();
    }

    public function index()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $userId = session()->get('userId');
    
    // Cari cart aktif user
    $cart = $this->cartModel->where('user_id', $userId)
                            ->where('status_cart', 'cart')
                            ->first();

    $cartData = null;
    
    // Jika ada cart, ambil detail dengan produk
    if ($cart) {
        $details = $this->cartDetailModel
            ->select('cart_details.*, products.title, products.image, products.category_id')
            ->join('products', 'products.id = cart_details.product_id')
            ->where('cart_details.cart_id', $cart['id'])
            ->findAll();
        
        if (!empty($details)) {
            $cartData = [
                'id' => $cart['id'],
                'user_id' => $cart['user_id'],
                'no_invoice' => $cart['no_invoice'],
                'status_cart' => $cart['status_cart'],
                'status_pembayaran' => $cart['status_pembayaran'],
                'total' => $cart['total'],
                'created_at' => $cart['created_at'],
                'updated_at' => $cart['updated_at'],
                'details' => $details
            ];
        }
    }

    $data = [
        'title' => 'Shopping Cart - Beauty Fashion Shop',
        'cart' => $cartData  // Bisa null jika kosong
    ];

    return view('frontend/cart/index', $data);
}

    // CartController.php - method add()
public function add($productId)
{
    // FORCE return JSON untuk semua request
    $this->response->setContentType('application/json');
    
    if (!session()->get('isLoggedIn')) {
        return $this->response->setJSON([
            'success' => false, 
            'message' => 'Silakan login terlebih dahulu.',
            'redirect' => '/login'
        ]);
    }

    $product = $this->productModel->find($productId);
    if (!$product || $product['status'] != 'active') {
        return $this->response->setJSON([
            'success' => false, 
            'message' => 'Produk tidak ditemukan.'
        ]);
    }

    $userId = session()->get('userId');
    
    // Cari cart aktif user
    $cart = $this->cartModel->where('user_id', $userId)
                            ->where('status_cart', 'cart')
                            ->first();

    // Jika belum ada cart, buat baru
    if (!$cart) {
        $cartId = $this->cartModel->insert([
            'user_id' => $userId,
            'no_invoice' => 'INV-' . date('Ymd') . '-' . rand(1000, 9999),
            'status_cart' => 'cart',
            'status_pembayaran' => 'pending',
            'total' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $cart = $this->cartModel->find($cartId);
    }

    // Cek apakah produk sudah ada di cart
    $existing = $this->cartDetailModel
        ->where('cart_id', $cart['id'])
        ->where('product_id', $productId)
        ->first();

    if ($existing) {
        // Update quantity
        $newQty = $existing['qty'] + 1;
        $this->cartDetailModel->update($existing['id'], [
            'qty' => $newQty,
            'subtotal' => $newQty * $existing['harga']
        ]);
    } else {
        // Tambah baru
        $this->cartDetailModel->insert([
            'cart_id' => $cart['id'],
            'product_id' => $productId,
            'qty' => 1,
            'harga' => $product['price'],
            'subtotal' => $product['price'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Update total cart
    $this->updateCartTotal($cart['id']);

    // Hitung total item di cart untuk response
    $totalItems = $this->cartDetailModel
        ->where('cart_id', $cart['id'])
        ->selectSum('qty')
        ->get()
        ->getRow()
        ->qty ?? 0;

    return $this->response->setJSON([
        'success' => true, 
        'message' => 'Produk berhasil ditambahkan ke keranjang!',
        'cart_count' => $totalItems
    ]);
}

// Tambah method count()
// Di CartController.php - method count()
public function count()
{
    // Set content type ke JSON
    $this->response->setContentType('application/json');
    
    if (!session()->get('isLoggedIn')) {
        return $this->response->setJSON(['count' => 0]);
    }

    $userId = session()->get('userId');
    
    $cart = $this->cartModel->where('user_id', $userId)
                            ->where('status_cart', 'cart')
                            ->first();

    $totalItems = 0;
    if ($cart) {
        $result = $this->cartDetailModel
            ->where('cart_id', $cart['id'])
            ->selectSum('qty')
            ->get()
            ->getRow();
        
        $totalItems = $result->qty ?? 0;
    }

    return $this->response->setJSON(['count' => $totalItems]);
}

    public function update()
    {
        $cartDetailId = $this->request->getPost('id');
        $qty = $this->request->getPost('qty');

        $cartDetail = $this->cartDetailModel->find($cartDetailId);
        if (!$cartDetail) {
            return $this->response->setJSON(['success' => false, 'message' => 'Item tidak ditemukan.']);
        }

        if ($qty < 1) {
            // Hapus item
            $this->cartDetailModel->delete($cartDetailId);
        } else {
            // Update quantity
            $this->cartDetailModel->update($cartDetailId, [
                'qty' => $qty,
                'subtotal' => $qty * $cartDetail['harga']
            ]);
        }

        // Update total cart
        $this->updateCartTotal($cartDetail['cart_id']);

        return $this->response->setJSON(['success' => true, 'message' => 'Keranjang diperbarui.']);
    }

/**
 * Halaman checkout/order
 */
public function order()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $userId = session()->get('userId');
    
    // Cari cart aktif user yang masih status cart
    $cart = $this->cartModel->where('user_id', $userId)
                            ->where('status_cart', 'cart')
                            ->first();

    if (!$cart) {
        return redirect()->to('/cart')->with('error', 'Keranjang kosong.');
    }

    // Ambil detail cart dengan produk
    $cart['details'] = $this->cartDetailModel
        ->select('cart_details.*, products.title, products.image')
        ->join('products', 'products.id = cart_details.product_id')
        ->where('cart_details.cart_id', $cart['id'])
        ->findAll();

    if (empty($cart['details'])) {
        return redirect()->to('/cart')->with('error', 'Keranjang kosong.');
    }

    $data = [
        'title' => 'Checkout - Beauty Fashion Shop',
        'cart' => $cart,
        'user' => [
            'name' => session()->get('userName'),
            'email' => session()->get('userEmail')
        ]
    ];

    return view('frontend/checkout/index', $data);
}

/**
 * Proses order
 */
public function processOrder()
{
    if (!session()->get('isLoggedIn')) {
        return $this->response->setJSON(['success' => false, 'message' => 'Silakan login terlebih dahulu.']);
    }

    $userId = session()->get('userId');
    
    // Cari cart aktif user
    $cart = $this->cartModel->where('user_id', $userId)
                            ->where('status_cart', 'cart')
                            ->first();

    if (!$cart) {
        return $this->response->setJSON(['success' => false, 'message' => 'Keranjang belanja kosong.']);
    }

    // Validasi input dengan bahasa Indonesia
    $validation = \Config\Services::validation();
    $validation->setRules([
        'shipping_address' => 'required|min_length[10]',
        'phone' => 'required|min_length[10]|max_length[15]',
        'payment_method' => 'required|in_list[bank_transfer,cod,ewallet]',
        'shipping_method' => 'required|in_list[regular,express]'
    ], [
        'shipping_address' => [
            'required' => 'Alamat pengiriman harus diisi',
            'min_length' => 'Alamat pengiriman minimal 10 karakter'
        ],
        'phone' => [
            'required' => 'Nomor telepon harus diisi',
            'min_length' => 'Nomor telepon minimal 10 digit',
            'max_length' => 'Nomor telepon maksimal 15 digit'
        ]
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validation->getErrors()
        ]);
    }

    // Simpan data order
    $paymentMethod = $this->request->getPost('payment_method');
    $paymentStatus = 'pending';
    
    // Jika COD, langsung pending (bayar saat barang datang)
    // Jika transfer/ewallet, perlu konfirmasi
    if ($paymentMethod == 'cod') {
        $paymentStatus = 'pending'; // Akan dibayar saat barang diterima
    }

    // Update cart menjadi order (checkout)
    $this->cartModel->update($cart['id'], [
        'status_cart' => 'checkout',
        'status_pembayaran' => $paymentStatus,
        'updated_at' => date('Y-m-d H:i:s')
        // NOTE: Jika ingin simpan alamat, payment method, dll, perlu tambah kolom di tabel
    ]);

    // Log order (opsional - bisa tambah di tabel orders_history)
    log_message('info', 'Order created: User ' . $userId . ', Cart ' . $cart['id'] . ', Total: ' . $cart['total']);

    return $this->response->setJSON([
        'success' => true, 
        'message' => 'Pesanan berhasil dibuat!',
        'orderId' => $cart['id'],
        'invoice' => $cart['no_invoice'],
        'redirect' => '/orders/' . $cart['id']
    ]);
}

/**
 * Order history user
 */
public function orders()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $userId = session()->get('userId');
    
    // Ambil semua orders user (status bukan cart)
    $orders = $this->cartModel
        ->where('user_id', $userId)
        ->where('status_cart !=', 'cart')
        ->orderBy('created_at', 'DESC')
        ->findAll();

    $data = [
        'title' => 'My Orders - Beauty Fashion Shop',
        'orders' => $orders
    ];

    return view('frontend/orders/index', $data);
}

/**
 * Detail order
 */
public function orderDetail($id)
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $userId = session()->get('userId');
    
    // Ambil order dengan cek ownership
    $order = $this->cartModel->where('id', $id)
                             ->where('user_id', $userId)
                             ->first();

    if (!$order) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    // Ambil detail order
    $order['details'] = $this->cartDetailModel
        ->select('cart_details.*, products.title, products.image')
        ->join('products', 'products.id = cart_details.product_id')
        ->where('cart_details.cart_id', $id)
        ->findAll();

    $data = [
        'title' => 'Order #' . $order['no_invoice'] . ' - Beauty Fashion Shop',
        'order' => $order
    ];

    return view('frontend/orders/show', $data);
}

    private function updateCartTotal($cartId)
    {
        $total = $this->cartDetailModel
            ->where('cart_id', $cartId)
            ->selectSum('subtotal')
            ->get()
            ->getRow()
            ->subtotal ?? 0;

        $this->cartModel->update($cartId, [
            'total' => $total,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}