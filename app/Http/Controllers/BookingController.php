<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booking = Lapangan::all();
        $lapangan = Lapangan::all();
        $lokasi = Lokasi::all();
        return view('booking', compact('booking', 'lapangan', 'lokasi'));
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
            'namaPemesan' => 'required|string|max:255',
            'noHp' => 'required|string|max:255',
        ],[
            'namaPemesan.required' => 'Nama pemesan harus diisi',
            'noHp.required' => 'Nomor handphone harus diisi',
        ]);

        DB::table('bookings')->insert([
            'namaPemesan' => $validatedData['namaPemesan'],
            'noHp' => $request->noHp,
            'waktuMulai' => $request->waktuMulai,
            'waktuSelesai' => $request->waktuSelesai,
            'hargaTotal' => $request->hargaTotal,
            'lapangan_id' =>$request->lapangan,
            'lokasi_id' =>$request->lokasi,
        ]);

        return redirect()->route('daftarbookindex');
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
    // public function update(Request $request, string $id)
    // {
    //     $updateData = [];

    //     if ($request->has('namaPemesan')) {
    //         $updateData['namaPemesan'] = $request->namaPemesan;
    //     }
    //     if ($request->has('namaLokasi')) {
    //         $updateData['namaLokasi'] = $request->namaLokasi;
    //     }
    //     if ($request->has('namaLapangan')) {
    //         $updateData['namaLapangan'] = $request->namaLapangan;
    //     }        
    //     if ($request->has('waktuMulai')) {
    //         $updateData['waktuMulai'] = $request->waktuMulai;
    //     }        
    //     if ($request->has('waktuSelesai')) {
    //         $updateData['waktuSelesai'] = $request->waktuSelesai;
    //     }
    //     if ($request->has('hargaTotal')) {
    //         $updateData['hargaTotal'] = $request->hargaTotal;
    //     }
    //     DB::table('bookings')->where('id', $id)->update($updateData);

    //     return redirect()->route('daftarbookindex');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
