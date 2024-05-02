<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
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

    public function validasi(Request $request) {
        $scannedData = $request->input('scanned_data');

        $buku = BukuModel::find($scannedData);

        if (!$buku == null) {
            // You can return a response indicating success or failure
            return response()->json($buku);
        } else {
            // You can return a response indicating success or failure
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}
