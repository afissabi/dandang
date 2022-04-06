<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmumController extends Controller
{
    public function beranda()
    {
        $data = [
            'page' => 'beranda',
        ];

        return view('front.page.home', $data);
    }

    public function tentang(){

        $data = [
            'page' => 'tentang',
        ];

        return view('front.page.tentang',$data);
    }
}
