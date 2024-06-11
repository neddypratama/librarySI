<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        return view('auth.registrasi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        return view('auth.login');
    }

    public function gantiPassword(){

        $breadcrumb = (object)[
            'title' => 'Ganti Password',
            'list' => ['Home', 'Perubahan']
        ];

        $page = (object)[
            'title' => 'Ganti Password'
        ];

        $activeMenu = 'gantiPassword';

        return view('auth.gantiPassword',[
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function lupaPassword()
    {
        return view('auth.lupaPassword');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function register_proses(Request $request)
    {
        $request->validate([
            //username harus diisi, berupa string, minimal 3 karakter dan bernilai unik di table m_user kolom username
            'nim' => 'required|string|min:8|unique:m_user,nim',
            'nama' => 'required|string|max:100|unique:m_user,nama',
            'tgl_lahir' => 'required|date',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5',
        ]);
        
        $user = UserModel::all();
        
        UserModel::create([
            'nim'=> $request -> nim,
            'nama'=> $request -> nama,
            'password' => bcrypt($request -> password),
            'tgl_lahir' => $request->tgl_lahir,
            'level_id' => 2,
        ]);
            
        return back()->with('success', 'Register Successfully');
    }

    public function proses_lupa(Request $request)
    {
        $user = UserModel::where('nama', $request->nama)->first();

        if ($user->nim === $request->nim && $user->nama === $request->nama && $user->tgl_lahir === $request->tgl_lahir) {
            $user->update(['password' => bcrypt($request->nim)]);
            return redirect('/login')->with('success', 'Password telah diganti dengan nim');
        } else {
            return back()->with('error', 'Data tidak sama');
        }
    }

    public function proses_ganti(Request $request)
    {
        $request->validate([
            //username harus diisi, berupa string, minimal 3 karakter dan bernilai unik di table m_user kolom username
            'password_lama' => 'required|min:5',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5',
        ]);
        
        $user = UserModel::find(auth()->user()->user_id);

        if (Hash::check($request->password_lama, $user->password)) {
            $user->update(['password' => bcrypt($request -> password)]);
            return redirect('/beranda')->with('success', 'Ganti Password Berhasil');
        } else {
            return back()->with('error', 'Password Lama tidak sesuai');
        }
    }

    /**
     * Display the specified resource.
     */
    public function login_proses(Request $request)
    {  
        $auth = [
            'nim' => $request->nim,
            'password' => $request->password,
        ];

        if(Auth::attempt($auth)) {
            return redirect('/beranda')->with('success', 'Login Berhasil');
        }
        return back()->with('error', 'Username or Password is wrong');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }
}
