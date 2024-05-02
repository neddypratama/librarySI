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

    /**
     * Store a newly created resource in storage.
     */
    public function register_proses(Request $request)
    {
        $request->validate([
            //username harus diisi, berupa string, minimal 3 karakter dan bernilai unik di table m_user kolom username
            'nim' => 'required|string|min:8|unique:m_user,nim',
            'nama' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|min:5|confirmed',
        ]);

        if(!$request->confirm_password === $request->password) {
            return back()->with('sama', 'Confirm password tidak sama');
        } else {
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
            if (auth()->user()->activate == 0) {
                return back()->with('activate', 'Akun belum di aktivasi');
            }
            return redirect('beranda')->with('success', 'Login Berhasil');
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
