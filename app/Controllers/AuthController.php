<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
    use ResponseTrait;

    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }

    /**
     * Halaman Login
     */
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('isLoggedIn')) {
            if ($this->session->get('userRole') === 'admin') {
                return redirect()->to('/admin/dashboard'); // ← KE ADMIN
            }
            return redirect()->to('/'); // ← KE HOME
        }

        $data = [
            'title' => 'Login - Beauty Fashion Shop',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/login', $data);
    }

    /**
     * Proses Login
     */
    public function doLogin()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            $this->session->setFlashdata('error', 'Email tidak ditemukan.');
            return redirect()->to('/login');
        }

        if (!password_verify($password, $user['password'])) {
            $this->session->setFlashdata('error', 'Password salah.');
            return redirect()->to('/login');
        }

        // Set session dengan SEMUA data yang diperlukan
        $sessionData = [
            'userId' => $user['id'],
            'userName' => $user['name'],
            'userEmail' => $user['email'],
            'userRole' => $user['role'] ?? 'user', // Pastikan role ada
            'isLoggedIn' => true
        ];
        $this->session->set($sessionData);

        // Redirect berdasarkan role
        if (($user['role'] ?? 'user') === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->to('/');
    }

    /**
     * Halaman Register
     */
    public function register()
    {
        if ($this->session->get('isLoggedIn')) {
            if ($this->session->get('userRole') === 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Register - Beauty Fashion Shop',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/register', $data);
    }

    /**
     * Proses Register
     */
    public function doRegister()
{
    $validation = \Config\Services::validation();
    $validation->setRules([
        'name' => 'required|min_length[3]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required|matches[password]'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $data = [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'password' => $this->request->getPost('password'), // ← PLAIN PASSWORD, biar Model yang hash
        'role' => 'user', // ← TAMBAHKAN DEFAULT ROLE
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    $this->userModel->insert($data);

    $this->session->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
    return redirect()->to('/login');
}

    /**
     * Halaman Forgot Password
     */
    public function forgotPassword()
    {
        $data = [
            'title' => 'Forgot Password - Beauty Fashion Shop'
        ];

        return view('auth/forgot-password', $data);
    }

    /**
     * Proses Logout
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}