<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('admin.lokasi', compact('lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namaLokasi' => 'required|string|max:255',
        ],[
            'namaLokasi.required' => 'Lokasi harus diisi',
        ]);

        DB::table('lokasis')->insert([
            'namaLokasi' => $validatedData['namaLokasi'],
        ]);

        Session::flash('success', 'Data Lokasi baru dengan nama "' . $validatedData['namaLokasi'] . '" berhasil ditambahkan!');

        return redirect()->route('indexlokasi');
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
        DB::table('lokasis')->where('id', $id)->update([
            'namaLokasi' => $request->namaLokasi,
        ]);
        // Menampilkan pesan sukses
        Session::flash('success', 'Data Lokasi  dengan nama "' . $request->namaLokasi . '" berhasil di ubah!');
        return redirect()->route('indexlokasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('lokasis')->where('id', $id)->delete();

        Session::flash('success', 'Data Lokasi berhasil dihapus!');

        Return Redirect()->route('indexlokasi');
    }
}
