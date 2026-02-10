<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\UserDetailModel;

class UserController extends BaseAdminController
{
    protected $userModel;
    protected $userDetailModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
        $this->userDetailModel = new UserDetailModel();
    }

    public function index()
    {
        $users = $this->userModel->findAll();
        
        $data = [
            'title' => 'Manajemen User',
            'users' => $users
        ];
        
        return view('admin/users/index', $data);
    }

    public function show($id)
    {
        $user = $this->userModel->withDetails($id);
        
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan.');
        }
        
        $data = [
            'title' => 'Detail User',
            'user' => $user
        ];
        
        return view('admin/users/show', $data);
    }

    public function updateRole($id)
    {
        $role = $this->request->getPost('role');
        
        $this->userModel->update($id, ['role' => $role]);
        
        return redirect()->back()->with('success', 'Role user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Tidak boleh hapus diri sendiri
        if ($id == session()->get('userId')) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }
        
        $this->userModel->delete($id);
        
        return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus.');
    }
}