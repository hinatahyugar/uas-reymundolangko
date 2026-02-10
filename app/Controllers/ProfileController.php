<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserDetailModel;
use App\Models\CartModel;

class ProfileController extends BaseController
{
    protected $userModel;
    protected $userDetailModel;
    protected $cartModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userDetailModel = new UserDetailModel();
        $this->cartModel = new CartModel();
        
        // Middleware: cek login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    public function index()
    {
        $userId = session()->get('userId');
        
        // Ambil data user dengan detail
        $user = $this->userModel->withDetails($userId);
        
        // Ambil order history (carts dengan status checkout/paid/dll)
        $orders = $this->cartModel
            ->where('user_id', $userId)
            ->where('status_cart !=', 'cart')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'title' => 'Profil Saya - Beauty Fashion Shop',
            'user' => $user,
            'orders' => $orders
        ];

        return view('frontend/profile/index', $data);
    }

    public function update()
    {
        $userId = session()->get('userId');
        
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email,id,'.$userId.']',
            'phone' => 'permit_empty|min_length[10]|max_length[15]|regex_match[/^[0-9+\-\s()]+$/]',
            'address' => 'permit_empty|min_length[10]|max_length[500]'
        ];

        $messages = [
            'name' => [
                'required' => 'Nama harus diisi',
                'min_length' => 'Nama minimal 3 karakter',
                'max_length' => 'Nama maksimal 100 karakter'
            ],
            'email' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak valid',
                'is_unique' => 'Email sudah digunakan'
            ],
            'phone' => [
                'min_length' => 'Nomor telepon minimal 10 digit',
                'max_length' => 'Nomor telepon maksimal 15 digit',
                'regex_match' => 'Format nomor telepon tidak valid'
            ],
            'address' => [
                'min_length' => 'Alamat minimal 10 karakter',
                'max_length' => 'Alamat maksimal 500 karakter'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('error', 'Validasi gagal. Silakan periksa kembali data Anda.');
        }

        // Update user
        $this->userModel->update($userId, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Update user details
        $this->userDetailModel->upsert($userId, [
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Update session
        session()->set('userName', $this->request->getPost('name'));
        session()->set('userEmail', $this->request->getPost('email'));

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function changePassword()
    {
        $userId = session()->get('userId');
        
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min_length[6]|strong_password',
            'confirm_password' => 'required|matches[new_password]'
        ];

        $messages = [
            'current_password' => [
                'required' => 'Password saat ini harus diisi'
            ],
            'new_password' => [
                'required' => 'Password baru harus diisi',
                'min_length' => 'Password baru minimal 6 karakter',
                'strong_password' => 'Password harus mengandung huruf besar, kecil, dan angka'
            ],
            'confirm_password' => [
                'required' => 'Konfirmasi password harus diisi',
                'matches' => 'Konfirmasi password tidak cocok'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $user = $this->userModel->find($userId);
        
        // Verify current password
        if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()->with('error', 'Password saat ini salah.');
        }

        // Update password
        $this->userModel->update($userId, [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/profile')->with('success', 'Password berhasil diubah!');
    }

    // Upload foto profil (optional)
    public function uploadPhoto()
    {
        $userId = session()->get('userId');
        
        $validationRule = [
            'profile_photo' => [
                'label' => 'Foto Profil',
                'rules' => 'uploaded[profile_photo]'
                    . '|is_image[profile_photo]'
                    . '|mime_in[profile_photo,image/jpg,image/jpeg,image/png]'
                    . '|max_size[profile_photo,2048]', // 2MB
            ]
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->with('error', $this->validator->getError('profile_photo'));
        }

        $file = $this->request->getFile('profile_photo');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/profiles', $newName);
            
            $this->userModel->update($userId, [
                'profile_photo_path' => $newName,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            return redirect()->to('/profile')->with('success', 'Foto profil berhasil diupload!');
        }
        
        return redirect()->back()->with('error', 'Gagal mengupload foto profil.');
    }
}