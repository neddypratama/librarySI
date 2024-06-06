<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\TabCompletion\Matcher\FunctionsMatcher;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{

    public function index(){
        $breadcrumb = (object)[
            'title'=>'Daftar User',
            'list' => ['Home', 'User']  
        ];

        $page = (object)[
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; //set saat menu aktif
        $level = LevelModel::all();

        return view('user.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables 
    public function list(Request $request) 
    { 
        $users = UserModel::select('user_id', 'nim', 'nama', 'tgl_lahir', 'level_id',) 
                ->with('level'); 

        //filter
        if($request->level_id){
            $users->where('level_id', $request->level_id);
        }
 
        return DataTables::of($users) 
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
        ->addColumn('aksi', function ($user) {  // menambahkan kolom aksi 
            $btn  = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> '; 
            $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '; 
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$user->user_id).'">' 
                    . csrf_field() . method_field('DELETE') .  
                    '<button type="submit" class="btn btn-danger btn-sm" 
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';

            return $btn; 
        }) 
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true); 
    } 

    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all(); //ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; //set menu sedang aktif

        return view('user.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    //UNTUK MENGHANDLE ATAU MENYIMPAN DATA BARU 
    public function store(Request $request){
        $request->validate([
            //username harus diisi, berupa string, minimal 3 karakter dan bernilai unik di table m_user kolom username
            'nim' => 'required|string|min:8|unique:m_user,nim',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer',
            'tgl_lahir' => 'required|date',
        ]);

        UserModel::create([
            'nim'=> $request -> nim,
            'nama'=> $request -> nama,
            'password' => bcrypt($request -> password),
            'tgl_lahir' => $request -> tgl_lahir,
            'level_id' => $request -> level_id,
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    //MENAMPILKAN DETAIL USER 
    public function show(string $id){
        $user = UserModel::with('level')-> find($id);

        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail user'
        ];

        $activeMenu = 'user'; // set menu yang aktif

        return view('user.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu]);
    }

    public function edit(string $id){
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit user'
        ];

        $activeMenu = 'user';

        return view('user.edit',[
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'nim' => 'required|string|min:3|unique:m_user,nim,' .$id. ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'level_id' => 'required|integer',
            'tgl_lahir' => 'required|date',
        ]);

        UserModel::find($id)->update([
            'nim' => $request-> nim,
            'nama' => $request->nama,
            'password' => $request->password? bcrypt($request->password):UserModel::find($id)->password,
            'tgl_lahir' => $request->tgl_lahir,
            'level_id' =>$request -> level_id
        ]);

        return redirect('/user')->with('success', 'Data berhasil diubah');
    }

    public function destroy(string $id){
        $check = UserModel::find($id);
        if(!$check){
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }
        try{
            UserModel::destroy($id);
            
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){

        return redirect('/user')->with('error', 'Data user gagal dihapus karena terdapat tabel lain yang terkait dengan data ini');
    }
}
}
