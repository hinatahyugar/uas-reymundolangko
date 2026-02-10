<?php

namespace App\Controllers;

class PageController extends BaseController
{
    public function about()
    {
        $data = [
            'title' => 'Tentang Kami - Beauty Fashion Shop'
        ];

        return view('frontend/pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Kontak - Beauty Fashion Shop'
        ];

        return view('frontend/pages/contact', $data);
    }
}