<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use App\Models\DendaModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ActionController extends Controller
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
        $user = UserModel::all();
        $buku = BukuModel::all();
        $transaksi = TransaksiModel::all();

        return view('action.peminjaman', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'buku' => $buku,
            'transaksi' => $transaksi,
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
        $user = UserModel::all();
        $buku = BukuModel::all();
        $transaksi = TransaksiModel::all();

        return view('action.pengembalian', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'buku' => $buku,
            'transaksi' => $transaksi,
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
        $user = UserModel::all();
        $buku = BukuModel::all();
        $transaksi = TransaksiModel::all();

        return view('action.denda', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'buku' => $buku,
            'transaksi' => $transaksi,
            'activeMenu' => $activeMenu]);
    }
    public function riwayat() {
        $breadcrumb = (object)[
            'title'=>'Cek History Transaksi',
            'list' => ['Home', 'History Transaksi']  
        ];

        $page = (object)[
            'title' => 'Daftar transaksi yang telah dilakukan'
        ];

        $activeMenu = 'history';
        $user = UserModel::all();
        $buku = BukuModel::all();
        $transaksi = TransaksiModel::all();

        return view('action.riwayat', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'buku' => $buku,
            'transaksi' => $transaksi,
            'activeMenu' => $activeMenu]);
    }

    public function listPengembalian(Request $request) 
    { 
        $kembalis = TransaksiModel::where('tgl_pengembalian', null)->where('user_id', auth()->user()->user_id)->with('user')->with('buku'); 
 
        return DataTables::of($kembalis) 
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($kembali) {  // menambahkan kolom aksi 
            $btn = '<a href="'.url('/action/' . $kembali->transaksi_id . '/scan_kembali').'" class="btn btn-primary btn-sm">Scan</a> '; 
            return $btn; 
        }) 
        ->rawColumns(['aksi'])
        ->make(true); 
    } 

    // Ambil data level dalam bentuk json untuk datatables 
    public function listDenda(Request $request) 
    { 
        $dendas = TransaksiModel::select('user_id', 'buku_id', 'denda', 'tgl_peminjaman', 'tgl_pengembalian')->where('user_id', auth()->user()->user_id)->with('user')->with('buku'); 
 
        return DataTables::of($dendas) 
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->make(true); 
    } 

    // Ambil data level dalam bentuk json untuk datatables 
    public function listRiwayat(Request $request) 
    { 
        $riwayats = TransaksiModel::select('user_id', 'buku_id', 'tgl_peminjaman', 'tgl_pengembalian')->where('user_id', auth()->user()->user_id)->with('user')->with('buku'); 
 
        return DataTables::of($riwayats) 
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($riwayat) {  // menambahkan kolom aksi 
            if ($riwayat->tgl_pengembalian == null) {
                $btn = '<span class="font-weight-bold text-warning">Pinjam</span>';
            } else {
                $btn = '<span class="font-weight-bold text-success">Kembali</span>';
            }
            return $btn; 
        }) 
        ->rawColumns(['aksi'])
        ->make(true); 
    }

    public function validasi(string $kode) {
        $barcode = BukuModel::where('buku_kode', $kode)->first();

        if ($barcode) {
            // Barcode found in the database
            return response()->json($barcode);
        } else {
            // Barcode not found in the database
            return response()->json(['error' => 'Barcode not found'], 404);
        }
    }

    public function scan_kembali(string $id){
        $transaksi = TransaksiModel::find($id);
        $user = UserModel::all();
        $buku = BukuModel::all();

        $breadcrumb = (object)[
            'title' => 'Scan Pengembalian',
            'list' => ['Home', 'Pengembalian', 'Scan']
        ];

        $page = (object)[
            'title' => 'Scan Pengembalian'
        ];

        $activeMenu = 'transaksi';

        return view('action.scankembali',[
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'transaksi' => $transaksi,
            'user' => $user,
            'buku' => $buku,
            'activeMenu' => $activeMenu
        ]);
    }
    
    public function kembali(string $id, string $kode) {
        $barcode = BukuModel::where('buku_kode', $kode)->first();
        $transaksi = TransaksiModel::find($id);

        if ($barcode->buku_id == $transaksi->buku_id) {
            // Barcode found in the database
            

            $tgl_kembali = now()->toDateString();
            $date1 = new DateTime($transaksi->tgl_peminjaman);
            $date2 = new DateTime($tgl_kembali);

            $selisih = date_diff($date1, $date2);
            if ($selisih->days > 5) {
                $denda = $selisih->days - 5;
            } else {
                $denda = 0;
            }

            $data = $transaksi->update([
                'tgl_pengembalian'  => $tgl_kembali,
                'denda'             => $denda,
            ]);

            return redirect('/action/pengembalian')->with('success', 'Buku berhasil dikembalikan');
        } else {
            return redirect('/action/pengembalian')->with('error', 'Buku gagal dikembalikan');
        }
    }

    public function store(Request $request){
        if ($request->judul == null) {
            return redirect('/beranda')->with('error', 'Anda belum scan!'); 
        }

        $user = UserModel::where('nama', $request->nama)->first();
        $buku = BukuModel::where('judul', $request->judul)->first();

        $latest = TransaksiModel::latest('transaksi_kode')->first();
        if ($latest == !null) {
            $string = $latest->transaksi_kode;
            // Menemukan angka di dalam string menggunakan regex
            preg_match('/\d+/', $string, $matches);

            // Mengambil angka dari hasil pencocokan regex
            $number = intval($matches[0]);

            // Menambahkan 1 ke angka
            $number++;

            // Format ulang angka ke dalam format tiga digit (misal: 002)
            $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);

            // Mengganti angka lama dengan angka yang baru dalam string
            $kode = preg_replace('/\d+/', $newNumber, $string);
        } else {
            $kode = 'TS001';
        }

        $tgl_pinjam = now()->toDateString();
        $tgl_kembali = null;
        $denda = 0;

        TransaksiModel::create([
            'user_id' => $user->user_id,
            'buku_id' => $buku->buku_id,
            'transaksi_kode'=> $kode,
            'tgl_peminjaman'=> $tgl_pinjam,
            'tgl_pengembalian' => $tgl_kembali,
            'denda' => $denda,
        ]);

        return redirect('/beranda')->with('success', 'Buku berhasil dipinjam');
    }
}
