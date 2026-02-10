<?php

namespace App\Controllers\Admin;

use App\Models\ConfigurationModel;

class SettingController extends BaseAdminController
{
    protected $configModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->configModel = new ConfigurationModel();
    }

    public function index()
    {
        $config = $this->configModel->first();
        
        $data = [
            'title' => 'Pengaturan Website',
            'config' => $config
        ];
        
        return view('admin/settings/index', $data);
    }

    public function update()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $config = $this->configModel->first();
        $id = $config ? $config['id'] : null;

        // Handle logo upload
        $logoName = $config ? $config['logo'] : null;
        $logo = $this->request->getFile('logo');
        
        if ($logo && $logo->isValid()) {
            // Delete old logo
            if ($logoName && file_exists('images/' . $logoName)) {
                unlink('images/' . $logoName);
            }
            
            $logoName = $logo->getRandomName();
            $logo->move('images', $logoName);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'logo' => $logoName,
            'address' => $this->request->getPost('address'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email')
        ];

        if ($id) {
            $data['id'] = $id;
        }

        $this->configModel->save($data);

        return redirect()->to('/admin/settings')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}