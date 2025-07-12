<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function formLogin()
    {
        return view('layouts.auth');
    }

    public function loginAction(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:20',
                'password' => 'required|string'
            ]);

            $auth = Auth::attempt($request->only('username', 'password'));

            if ($auth) {
                $user = Auth::user();
                if ($user->peran == 'Admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user-> peran == 'Anggota') {
                    return redirect()-> route('anggota.dashboard');
                }
                 else {
                    return 'role tidak di temukan';
                }
                return 'Login berhasil';
            } else {
                return 'login gagal';
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
