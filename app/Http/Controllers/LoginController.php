<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
        
            $required = [
                'username' => 'required|min:5',
                'password' => 'required|min:6',
            ];
        
            $message = [
                'username.required' => 'Kolom username harus diisi',
                'username.min' => 'username minimal 5 karakter',
                'password.required' => 'Kolom password harus diisi',
                'password.min' => 'password minimal 6 karakter',
            ];
        
            $this->validate($request, $required, $message);
            if (Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password']])) {
                return redirect('/admin/index');
            } else {
                return redirect()->back()->with('error_message', 'invalid username or password');
            }
        }
        return view('admin.login');
    }

    public function LoginMember(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
        
            $required = [
                'username' => 'required|min:5',
                'password' => 'required|min:6',
            ];
        
            $message = [
                'username.required' => 'Kolom username harus diisi',
                'username.min' => 'username minimal 5 karakter',
                'password.required' => 'Kolom password harus diisi',
                'password.min' => 'password minimal 6 karakter',
            ];
        
            $this->validate($request, $required, $message);
            if (Auth::guard('member')->attempt(['username' => $data['username'], 'password' => $data['password']])) {
                return redirect('/member/index');
            } else {
                return redirect()->back()->with('error_message', 'invalid username or password');
            }
        }
        return view('member.login');
    }

    public function RegisterMember(Request $request)
{
    if ($request->isMethod('POST')) {
        $data = $request->all();
        
        $required = [
            'nama' => 'required|string|max:255',
            'noHp' => 'required|string|min:10|max:15',
            'username' => 'required|string|min:5|unique:penggunas',
            'password' => 'required|string|min:6|',
        ];
        
        $message = [
            'nama.required' => 'Kolom nama harus diisi',
            'nama.string' => 'Nama harus berupa teks',
            'nama.max' => 'Nama maksimal 255 karakter',
            'noHp.required' => 'Kolom nomor HP harus diisi',
            'noHp.string' => 'Nomor HP harus berupa teks',
            'noHp.min' => 'Nomor HP minimal 10 karakter',
            'noHp.max' => 'Nomor HP maksimal 15 karakter',
            'username.required' => 'Kolom username harus diisi',
            'username.string' => 'Username harus berupa teks',
            'username.min' => 'Username minimal 5 karakter',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Kolom password harus diisi',
            'password.string' => 'Password harus berupa teks',
            'password.min' => 'Password minimal 6 karakter',
        ];
        
        $this->validate($request, $required, $message);

        // Hash the password before saving
        $data['password'] = bcrypt($data['password']);

        // Create a new pengguna record
        DB::table('penggunas')->insert([
            'nama' => $data['nama'],
            'noHp' => $data['noHp'],
            'username' => $data['username'],
            'password' => $data['password'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/member/login')->with('success_message', 'Registrasi Sukses. Silahkan login sebagai member');
    }
    return view('member.registrasi');
}



    
}
