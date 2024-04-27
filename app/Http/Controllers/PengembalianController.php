<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title'=>'Transaksi Pengembalian',
            'list' => ['Home', 'Pengembalian']  
        ];

        $page = (object)[
            'title' => 'Proses scan barcode untuk transaksi pengembalian'
        ];

        $activeMenu = 'pengembalian';

        return view('pengembalian.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu]);
    }

    public function validasi(Request $request) {
        $scannedData = $request->input('scanned_data');

        // Save the scanned data to the database
        $barcode = "Anjay";

        if ($scannedData == $barcode) {
            // You can return a response indicating success or failure
            return response()->json(['status' => 200]);
        } else {
            // You can return a response indicating success or failure
            return response()->json(['status' => 400]);
        }
    }
}
