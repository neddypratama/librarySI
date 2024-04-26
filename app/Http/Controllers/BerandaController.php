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

    public function validasi(Request $request) {
        $qr = $request->qr_code;
        $data = 'anjay';

        if ($qr == $data) {
            return response()->json([
                'status' => 200, 
            ]);
        } else {
            return response()->json([
                'status' => 400,
            ]);
        }
    }
}
