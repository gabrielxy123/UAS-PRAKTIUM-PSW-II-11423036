<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\Lokasi;
use App\Models\Pengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengelolaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            
            $login = $request->all();
            // dd($login);
        
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
        
            // Logika autentikasi
            $this->validate($request, $required, $message);
            if (Auth::guard('pengelola')->attempt(['username' => $login['username'], 'password' => $login['password']])) {
                return redirect('/pengelola/index');
            } else {
                return redirect()->back()->with('error_message', 'invalid username or password');
            }
        }
        return view('pengelola.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $pengelola = Auth::guard('pengelola')->user();
        return view('pengelola.index', ['pengelola'=>$pengelola]);
    }

     
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function Logout(){
        Auth::guard('pengelola')->logout();
        return redirect('/');
    }

    public function booking()
    {
        $pengelolaId = Auth::guard('pengelola')->id(); // Mengambil ID pengelola yang sedang login
        
        // Mendapatkan ID lapangan yang dikelola oleh pengelola yang sedang login
        $lapanganIds = Lapangan::where('pengelola_id', $pengelolaId)->pluck('id')->toArray();

        // Mendapatkan booking yang hanya terkait dengan lapangan yang dikelola oleh pengelola
        $booking = Booking::whereIn('lapangan_id', $lapanganIds)->get();

        $lokasi = Lokasi::all();
        $lapangan = Lapangan::all();

        return view('pengelola.booking', compact('booking', 'lapangan', 'lokasi'));
    }

    public function terimabooking($id){
        $booking = Booking::find($id);
        if ($booking) {
            $booking->status = 'Disetujui';
            $booking->save();
            return redirect()->back()->with('success', 'Pesanan Lapangan berhasil disetujui.');
        }
        return redirect()->back()->with('error', 'Pesanan Lapangan tidak ditemukan.');
    }

    public function tolakbooking($id){
        $booking = Booking::find($id);
        if ($booking) {
            $booking->status = 'Ditolak';
            $booking->save();
            return redirect()->back()->with('success', 'Pesanan Lapangan berhasil ditolak.');
        }
        return redirect()->back()->with('error', 'Pesanan Lapangan tidak ditemukan.');
    }
}
