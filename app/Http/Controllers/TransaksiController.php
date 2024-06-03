<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use App\Models\DendaModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title'=>'Daftar Transaksi',
            'list' => ['Home', 'Transaksi']  
        ];

        $page = (object)[
            'title' => 'Daftar transaksi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'transaksi'; //set saat menu aktif
        $transaksi = TransaksiModel::all();
        $user = UserModel::all();
        $buku = BukuModel::all();

        return view('transaksi.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'transaksi' => $transaksi,
            'user' => $user,
            'buku' => $buku,
            'activeMenu' => $activeMenu]);
    }

    // Ambil data barang dalam bentuk json untuk datatables 
    public function list(Request $request) 
    { 
        $transaksis = TransaksiModel::select('transaksi_id', 'user_id', 'buku_id', 'transaksi_kode', 'tgl_peminjaman', 'tgl_pengembalian', 'denda') 
                ->with('user')->with('buku'); 

                //filter
                if($request->user_id){
                    $transaksis->where('user_id', $request->user_id);
                }

                if($request->buku_id){
                    $transaksis->where('buku_id', $request->buku_id);
                }
 
        return DataTables::of($transaksis) 
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
        ->addColumn('status', function ($transaksi) {  // menambahkan kolom aksi 
            if ($transaksi->tgl_pengembalian == null) {
                $status = '<span class="font-weight-bold text-warning">Pinjam</span>';
            } else {
                $status = '<span class="font-weight-bold text-success">Kembali</span>';
            }
            
            return $status; 
        })
        ->addColumn('aksi', function ($transaksi) {  // menambahkan kolom aksi 
            $btn  = '<a href="'.url('/transaksi/' . $transaksi->transaksi_id).'" class="btn btn-info btn-sm">Detail</a> '; 
            $btn .= '<a href="'.url('/transaksi/' . $transaksi->transaksi_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '; 
            // $btn .= '<form class="d-inline-block" method="POST" action="'. url('/transaksi/'.$transaksi->transaksi_id).'">' 
            //         . csrf_field() . method_field('DELETE') .  
            //         '<button type="submit" class="btn btn-danger btn-sm" 
            //         onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';      
            return $btn; 
        }) 
        ->rawColumns(['status', 'aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true); 
    } 

    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah Transaksi',
            'list' => ['Home', 'Transaksi', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Transaksi baru'
        ];

        $user = UserModel::all();
        $buku = BukuModel::all();
        $activeMenu = 'Transaksi'; //set menu sedang aktif

        return view('Transaksi.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'buku' => $buku,
            'activeMenu' => $activeMenu
        ]);
    }

    //UNTUK MENGHANDLE ATAU MENYIMPAN DATA BARU 
    public function store(Request $request){
        $request->validate([
            //barang_kode harus diisi, berupa string, minimal 3 karakter dan bernilai unik di table m_barang kolom barang_kode
            'transaksi_kode' => 'required|string|min:3|unique:t_transaksi,transaksi_kode',
            'tgl_Peminjaman' => 'required|date',
            'tgl_pengembalian' => 'required|date',
            'denda' => 'required|integer',
        ]);

        TransaksiModel::create([
            'user_id' => $request -> user_id,
            'buku_id' => $request -> buku_id,
            'transaksi_kode'=> $request -> transaksi_kode,
            'tgl_peminjaman'=> $request -> tgl_peminjaman,
            'tgl_pengembalian' => $request -> tgl_pengembalian,
            'denda' => $request -> denda,
        ]);

        return redirect('/transaksi')->with('success', 'Data transaksi berhasil disimpan');
    }

    //MENAMPILKAN DETAIL BARANG 
    public function show(string $id){
        $transaksi = TransaksiModel::with('user')->with('buku')-> find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Transaksi',
            'list' => ['Home', 'Transaksi', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Transaksi'
        ];

        $activeMenu = 'transaksi'; // set menu yang aktif

        return view('transaksi.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'transaksi' => $transaksi,
            'activeMenu' => $activeMenu]);
    }

    public function edit(string $id){
        $transaksi = TransaksiModel::find($id);
        $user = UserModel::all();
        $buku = BukuModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Transaksi',
            'list' => ['Home', 'Transaksi', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Transaksi'
        ];

        $activeMenu = 'transaksi';

        return view('transaksi.edit',[
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'transaksi' => $transaksi,
            'user' => $user,
            'buku' => $buku,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'tgl_peminjaman' => 'required|date',
            'tgl_pengembalian' => 'nullable|date',
            'denda' => 'nullable|integer',
        ]);

        if (!$request->tgl_pengembalian == null) {
            $date1 = new DateTime($request->tgl_peminjaman);
            $date2 = new DateTime($request->tgl_pengembalian);

            $selisih = date_diff($date1, $date2);
            if ($selisih->days > 5) {
                $denda = $selisih->days - 5;
            } else {
                $denda = 0;
            }
        } else {
            $denda = 0;
        }

        TransaksiModel::find($id)->update([
            'transaksi_kode'=> $request -> transaksi_kode,
            'tgl_peminjaman'=> $request -> tgl_peminjaman,
            'tgl_pengembalian' => $request -> tgl_pengembalian,
            'denda' => $denda,
            'user_id' => $request -> user_id,
            'buku_id' => $request -> buku_id,
        ]);

        return redirect('/transaksi')->with('success', 'Data berhasil diubah');
    }

    public function destroy(string $id){
        $check = TransaksiModel::find($id);
        if(!$check){
            return redirect('/transaksi')->with('error', 'Data transaksi tidak ditemukan');
        }
        try{
            TransaksiModel::destroy($id);

            return redirect('/transaksi')->with('success', 'Data transaksi berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){

        return redirect('/transaksi')->with('error', 'Data transaksi gagal dihapus karena terdapat tabel lain yang terkait dengan data ini');
    }
    }
}
