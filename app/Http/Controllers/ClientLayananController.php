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
    public function store(Request $request) // Pastikan tipe parameter adalah Request
    {
        $validatedData = $request->validate([
            'client_id' => 'required|int',
            'layanan_id' => 'required|int',
            'created_at' => 'nullable|date'
        ]);

        ClientLayanan::create([
            'client_id' => $validatedData['client_id'],
            'layanan_id' => $validatedData['layanan_id'],
            'created_at' => $validatedData['created_at'] ?? now()
        ]);


        return redirect()->route('marketing.index')->with('success', 'Layanan berhasil ditambahkan.');
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
