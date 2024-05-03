<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Yajra\DataTables\DataTables;

class BukuController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title'=>'Daftar Buku',
            'list' => ['Home', 'Buku']  
        ];

        $page = (object)[
            'title' => 'Daftar buku yang terdaftar dalam sistem'
        ];

        $activeMenu = 'buku'; //set saat menu aktif
        $buku = BukuModel::all();

        return view('buku.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'buku' => $buku,
            'activeMenu' => $activeMenu]);
    }

    // Ambil data level dalam bentuk json untuk datatables 
    public function list(Request $request) 
    { 
        $bukus = BukuModel::select('buku_id', 'buku_kode', 'judul', 'pengarang', 'penerbit'); 
 
        return DataTables::of($bukus) 
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
        ->addColumn('aksi', function ($buku) {  // menambahkan kolom aksi 
            $btn  = '<a href="'.url('/buku/' . $buku->buku_id).'" class="btn btn-info btn-sm">Detail</a> '; 
            $btn .= '<a href="'.url('/buku/' . $buku->buku_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '; 
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/buku/'.$buku->buku_id).'">' 
                    . csrf_field() . method_field('DELETE') .  
                    '<button type="submit" class="btn btn-danger btn-sm" 
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';   
            $btn .= '<a href="'.url('/buku/' . $buku->buku_id . '/barcode').'" class="btn btn-success btn-sm">Barcode</a> ';    
            return $btn; 
        }) 
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true); 
    } 

    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah Buku',
            'list' => ['Home', 'Buku', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah buku baru'
        ];

        $buku = BukuModel::all(); //ambil data buku untuk ditampilkan di form
        $activeMenu = 'buku'; //set menu sedang aktif

        return view('buku.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'buku' => $buku,
            'activeMenu' => $activeMenu
        ]);
    }

    //UNTUK MENGHANDLE ATAU MENYIMPAN DATA BARU 
    public function store(Request $request){
        $request->validate([
            //level_kode harus diisi, berupa string, minimal 3 karakter dan bernilai unik di table m_level kolom level_kode
            
            'buku_kode' => 'required|string|min:3|unique:m_buku,buku_kode',
            'judul'     => 'required|string|max:100',
            'pengarang' => 'required|string|max:100',
            'penerbit'  => 'required|string|max:100',
        ]);

        BukuModel::create([
            'buku_id'   => $request -> buku_id,
            'buku_kode' => $request -> buku_kode,
            'judul'     => $request -> judul,
            'pengarang' => $request -> pengarang,
            'penerbit'  => $request -> penerbit,

        ]);

        return redirect('/buku')->with('success', 'Data buku berhasil disimpan');
    }

    //MENAMPILKAN DETAIL LEVEL 
    public function show(string $id){
        $buku = BukuModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Buku',
            'list' => ['Home', 'Buku', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail buku'
        ];

        $activeMenu = 'buku'; // set menu yang aktif

        return view('buku.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'buku' => $buku,
            'activeMenu' => $activeMenu]);
    }

    public function edit(string $id){
        $buku = BukuModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Buku',
            'list' => ['Home', 'Buku', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit buku'
        ];

        $activeMenu = 'buku';

        return view('buku.edit',[
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'buku' => $buku,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'buku_kode' => 'required|string|min:3|unique:m_buku,buku_kode,'.$id.',buku_id',
            'judul' => 'required|string|max:100',
            'pengarang' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
        ]);

        BukuModel::find($id)->update([
            'buku_id' => $request -> buku_id,
            'buku_kode' => $request-> buku_kode,
            'judul' => $request-> judul,
            'pengarang' => $request-> pengarang,
            'penerbit' => $request-> penerbit,
        ]);

        return redirect('/buku')->with('success', 'Data berhasil diubah');
    }

    public function destroy(string $id){
        $check = BukuModel::find($id);
        if(!$check){
            return redirect('/buku')->with('error', 'Data buku tidak ditemukan');
        }
        try{
            BukuModel::destroy($id);

            return redirect('/buku')->with('success', 'Data buku berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect('/buku')->with('error', 'Data buku gagal dihapus karena terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function barcode(string $id){
        $data = BukuModel::find($id);

        if (!$data) {
            abort(404);
        }

        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($data->buku_kode, $generator::TYPE_CODE_39);

        $barcodePath = public_path('barcodes/' . $data->buku_kode . '.png');
        file_put_contents($barcodePath, $barcode);

        return Response::download($barcodePath);
    }
}
