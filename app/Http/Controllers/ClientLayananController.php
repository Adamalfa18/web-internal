<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Layanan;
use App\Models\ClientLayanan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
// use Symfony\Component\HttpFoundation\Request;
use App\Models\User; // Added import for User model
use Illuminate\Http\Request; // Pastikan ini ada di bagian atas file
use App\Models\Pegawai;

class ClientLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $layanans = Layanan::all();
        $client = Client::all();
        return view('marketlab.marketing.index', compact('layanans', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'client_id'   => 'required|int|exists:clients,id',
            'layanan_id'  => 'required|int|exists:layanans,id',
            'pegawai_id'  => 'required|int|exists:pegawais,id', // perbaikan: pegawais, bukan layanans
            'created_at'  => 'nullable|date'
        ]);

        // Ambil data client dan layanan
        $client  = Client::find($validatedData['client_id']);
        $layanan = Layanan::find($validatedData['layanan_id']);

        // Cek apakah layanan sudah dimiliki oleh client
        if ($client->layanans->contains($layanan)) {
            return redirect()->route('marketing.index')
                            ->with('error', 'The service chosen is already owned by the client.');
        }

        // Simpan ke tabel client_layanan (sertakan pegawai_id)
        ClientLayanan::create([
            'client_id'   => $validatedData['client_id'],
            'layanan_id'  => $validatedData['layanan_id'],
            'pegawai_id'  => $validatedData['pegawai_id'], // tambahkan ini
            'created_at'  => $validatedData['created_at'] ?? now()
        ]);

        return redirect()->route('marketing.index')
                        ->with('success', 'Service successfully added.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
