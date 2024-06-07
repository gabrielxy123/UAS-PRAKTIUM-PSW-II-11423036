<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Pengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengelola = Pengelola::all();
        $lokasi = Lokasi::all();
        return view('admin.tambah', compact('pengelola', 'lokasi'));
        
    }

    public function createpengelola(Request $request)
    {
        $validatedData = $request->validate([
            'namaPengelola' => 'required|string|max:255',
            'username' => 'required|string|min:5|max:20',
            'password' => 'required|string|min:5|max:10',

        ],[
            'namaLokasi.required' => 'Lokasi harus diisi',
            'username.required' => 'Username harus diisi',
            'username.min' => 'Username minimal 5 huruf',
            'username.max' => 'Username maksimal 20 huruf',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 5 huruf',
            'password.max' => 'Password mininmal 10 huruf'
        ]);

        DB::table('pengelolas')->insert([
            'namaPengelola' => $validatedData['namaPengelola'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'lokasi_id' => $request->lokasi,
        ]);

        Session::flash('success', 'Data Pengelola baru dengan nama "' . $validatedData['namaPengelola'] . '" berhasil ditambahkan!');

        return redirect()->route('indextambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Buat array kosong untuk menampung data update yang akan dikirimkan
    $updateData = [];

    // Cek jika request memiliki nilai untuk namaPengelola, jika ada tambahkan ke array updateData
    if ($request->has('namaPengelola')) {
        $updateData['namaPengelola'] = $request->namaPengelola;
    }

    // Cek jika request memiliki nilai untuk username, jika ada tambahkan ke array updateData
    if ($request->has('username')) {
        $updateData['username'] = $request->username;
    }

    // Cek jika request memiliki nilai untuk password, jika ada tambahkan ke array updateData
    if ($request->has('password')) {
        $updateData['password'] = Hash::make($request->password);
    }

    // Cek jika request memiliki nilai untuk lokasi_id, jika ada tambahkan ke array updateData
    if ($request->has('lokasi')) {
        $updateData['lokasi_id'] = $request->lokasi;
    }

    // Lakukan update hanya dengan data yang tersedia, untuk menghindari kesalahan seperti ini
    DB::table('pengelolas')->where('id', $id)->update($updateData);

    // Menampilkan pesan sukses
    Session::flash('success', 'Data Pengelola dengan nama "' . $request->namaPengelola . '" berhasil diubah!');

    return redirect()->route('indextambah');
}   

    public function destroy($id)
    {
        DB::table('pengelolas')->where('id', $id)->delete();

        Session::flash('success', 'Data Pengelola berhasil dihapus!');

        return Redirect()->route('indextambah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function Logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
