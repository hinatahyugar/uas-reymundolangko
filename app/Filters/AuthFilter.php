<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();

        // Jika belum login
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // 🔴 FIX UTAMA: pastikan arguments array
        $arguments = is_array($arguments) ? $arguments : [];

        // Cek role admin jika diperlukan
        if (in_array('admin', $arguments, true)) {
            if (! $session->get('isAdmin')) {
                return redirect()->to('/')
                    ->with('error', 'Akses ditolak.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan
    }
}
