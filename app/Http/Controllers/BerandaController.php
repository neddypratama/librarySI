<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome'],
        ];
    
        $activeMenu = 'dashboard';
    
        return view('dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function scan() {
        return view('scan');
    }
}
