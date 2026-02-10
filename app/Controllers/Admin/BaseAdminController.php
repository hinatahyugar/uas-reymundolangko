<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseAdminController extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

      
        
        // Cek login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek role admin - FIX: pakai userRole bukan email
        if (session()->get('userRole') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses admin ditolak.');
        }
        
        // Helper untuk admin
        helper(['form', 'url', 'number', 'text']);
    }
}