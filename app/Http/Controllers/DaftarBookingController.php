<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftarBooking = Booking::all();
        $lapangan = Lapangan::all();
        $lokasi = Lokasi::all();
        return view('daftarBooking', compact('daftarBooking', 'lapangan', 'lokasi'));
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
        //
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
        $updateData = [];
        
        if ($request->has('namaPemesan')) {
            $updateData['namaPemesan'] = $request->namaPemesan;
        }
        if ($request->has('lokasi_id')) {
            $updateData['lokasi_id'] = $request->namaLokasi;
        }
        if ($request->has('lapangan_id')) {
            $updateData['lapangan_id'] = $request->namaLapangan;
        }        
        if ($request->has('waktuMulai')) {
            $updateData['waktuMulai'] = $request->waktuMulai;
        }        
        if ($request->has('waktuSelesai')) {
            $updateData['waktuSelesai'] = $request->waktuSelesai;
        }
        if ($request->has('hargaTotal')) {
            $updateData['hargaTotal'] = $request->hargaTotal;
        }
        DB::table('bookings')->where('id', $id)->update($updateData);

        return redirect()->route('daftarbookindex');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
