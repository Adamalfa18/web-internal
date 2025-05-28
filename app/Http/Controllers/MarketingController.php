<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Layanan;
use App\Models\ClientLayanan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $clientFilter = $request->input('clientFilter');
        $dateFilter = $request->input('dateFilter');
        $brand = $request->input('brand');
        $dateAktif = $request->input('date_aktif');

        $client_layanans = ClientLayanan::with(['layanan', 'client'])
            ->when($clientFilter, function ($query) use ($clientFilter) {
                return $query->where('layanan_id', $clientFilter);
            })
            ->when($dateFilter, function ($query) use ($dateFilter) {
                return $query->whereDate('created_at', $dateFilter);
            })
            ->when($brand, function ($query) use ($brand) {
                return $query->whereHas('client', function ($q) use ($brand) {
                    $q->where('nama_brand', 'like', '%' . $brand . '%');
                });
            })
            ->when($dateAktif, function ($query) use ($dateAktif) {
                return $query->whereDate('created_at', $dateAktif);
            })
            ->latest()
            ->paginate(10);

        $layanans = Layanan::all();
        $pegawai = Pegawai::all();
        $clients = Client::all();

        return view('marketlab.marketing.index', compact(
            'clients',
            'layanans',
            'pegawai',
            'search',
            'status',
            'client_layanans'
        ));
    }



    public function edit($id)
    {
        // Cari data client_layanan berdasarkan ID
        $client_layanan = ClientLayanan::with(['client', 'layanan'])->findOrFail($id);
        // Ambil data client dari relasi
        $client = $client_layanan->client;
        // Ambil semua layanan (jika ingin tampilkan pilihan)
        $availableLayanans = Layanan::all();
        return view('marketlab.marketing.update', compact('client', 'availableLayanans', 'client_layanan'));
    }

    public function update(Request $request, $id)
    {
        // Cari data client_layanan berdasarkan ID
        $client_layanan = ClientLayanan::findOrFail($id);
        // Validasi input
        $validatedData = $request->validate([
            'status' => 'required|in:1,2,3',
        ]);
        // Update status
        $client_layanan->status = $validatedData['status'];
        $client_layanan->save();

        return redirect()->route('marketing.index')->with('success', 'The service status is successfully updated.');
    }

    public function getAvailableLayanan($clientId)
    {
        $client = \App\Models\Client::findOrFail($clientId);
        $usedLayananIds = $client->layanans->pluck('id');
        $availableLayanan = \App\Models\Layanan::whereNotIn('id', $usedLayananIds)->get();

        return response()->json($availableLayanan);
    }
}
