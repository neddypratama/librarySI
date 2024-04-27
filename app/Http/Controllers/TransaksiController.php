<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function peminjaman(){
        $breadcrumb = (object)[
            'title'=>'Transaksi Peminjaman',
            'list' => ['Home', 'Peminjaman']  
        ];

        $page = (object)[
            'title' => 'Proses scan barcode untuk transaksi peminjaman'
        ];

        $activeMenu = 'peminjaman';

        return view('transaksi.peminjaman', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu]);
    }

    public function pengembalian(){
        $breadcrumb = (object)[
            'title'=>'Transaksi Pengembalian',
            'list' => ['Home', 'Pengembalian']  
        ];

        $page = (object)[
            'title' => 'Proses scan barcode untuk transaksi pengembalian'
        ];

        $activeMenu = 'pengembalian';

        return view('transaksi.pengembalian', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu]);
    }

    public function denda(){
        $breadcrumb = (object)[
            'title'=>'Cek Denda',
            'list' => ['Home', 'Denda']  
        ];

        $page = (object)[
            'title' => 'Daftar denda yang telah diperoleh'
        ];

        $activeMenu = 'denda';

        return view('transaksi.denda', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu]);
    }

    public function riwayat(){
        $breadcrumb = (object)[
            'title'=>'Cek History Transaksi',
            'list' => ['Home', 'History Transaksi']  
        ];

        $page = (object)[
            'title' => 'Daftar transaksi yang telah dilakukan'
        ];

        $activeMenu = 'history';

        return view('transaksi.denda', [
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
