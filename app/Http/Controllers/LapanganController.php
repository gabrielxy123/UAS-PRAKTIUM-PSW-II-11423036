<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Lokasi;
use App\Models\Pengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = Lokasi::all();
        $lapangan = Lapangan::all();
        $pengelola = Pengelola::all();
        return view('admin.lapangan', compact('lokasi', 'lapangan', 'pengelola'));
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
            'namaLapangan' => 'required|string|max:255',
        ],[
            'namaLapangan.required' => 'Lapangan harus diisi',
        ]);

        DB::table('lapangans')->insert([
            'namaLapangan' => $validatedData['namaLapangan'],
            'pengelola_id' => $request->pengelola,
            'lokasii_id' => $request->lokasi,
            'hargaLapangan' => $request->hargaLapangan,
        ]);

        Session::flash('success', 'Data Lapangan baru dengan nama "' . $validatedData['namaLapangan'] . '" berhasil ditambahkan!');

        return redirect()->route('indexlapangan');
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
    if ($request->has('namaLapangan')) {
        $updateData['namaLapangan'] = $request->namaLapangan;
    }

    // Cek jika request memiliki nilai untuk username, jika ada tambahkan ke array updateData
    if ($request->has('hargaLapangan')) {
        $updateData['hargaLapangan'] = $request->hargaLapangan;
    }

    // Cek jika request memiliki nilai untuk password, jika ada tambahkan ke array updateData
    if ($request->has('lokasii_id')) {
        $updateData['lokasii_id'] = $request->lokasi;
    }

    // Cek jika request memiliki nilai untuk lokasi_id, jika ada tambahkan ke array updateData
    if ($request->has('pengelola_id')) {
        $updateData['pengelola_id'] = $request->pengelola;
    }

    // Lakukan update hanya dengan data yang tersedia, untuk menghindari kesalahan seperti ini
    DB::table('lapangans')->where('id', $id)->update($updateData);

    // Menampilkan pesan sukses
    Session::flash('success', 'Data Lapangan dengan nama "' . $request->namaLapangan . '" berhasil diubah!');

    return redirect()->route('indexlapangan');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('lapangans')->where('id', $id)->delete();

        Session::flash('success', 'Data Lapangan berhasil dihapus!');

        Return Redirect()->route('indexlapangan');
    }
}
