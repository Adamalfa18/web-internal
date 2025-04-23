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
        $perPage = $request->input('perPage', 10);
        $status = $request->input('status'); // Hapus default, biarkan status bisa 1, 2, atau 3

        $clients = Client::when($search, function ($query) use ($search) {
            return $query->where('nama_client', 'like', '%' . $search . '%')
                ->orWhere('nama_brand', 'like', '%' . $search . '%')
                ->orWhereHas('pegawai', function ($query) use ($search) { // Menggunakan relasi untuk pegawai
                    return $query->where('nama', 'like', '%' . $search . '%');
                });
        })
            ->when(in_array($status, [1, 2, 3]), function ($query) use ($status) { // Tambahkan filter untuk status 2 dan 3
                return $query->where('status_client', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $client_layanans = ClientLayanan::with(['layanan'])
            ->latest()
            ->get(); // atau paginate jika diperlukan

        $layanans = Layanan::all(); // Mengambil semua layanan
        $pegawai = Pegawai::all(); // Mengambil semua pegawai

        // Mendapatkan halaman saat ini dan total halaman
        $currentPage = $clients->currentPage();
        $totalPages = $clients->lastPage();

        return view('marketlab.marketing.index', compact(
            'clients',
            'layanans',
            'pegawai',
            'search',
            'perPage',
            'status',
            'currentPage',
            'totalPages',
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
            'status' => 'required|in:0,1',
        ]);

        // Update status
        $client_layanan->status = $validatedData['status'];
        $client_layanan->save();

        return redirect()->route('marketing.index')->with('success', 'Status layanan berhasil diperbarui.');
    }




    public function getAvailableLayanan($clientId)
    {
        $client = \App\Models\Client::findOrFail($clientId);
        $usedLayananIds = $client->layanans->pluck('id');
        $availableLayanan = \App\Models\Layanan::whereNotIn('id', $usedLayananIds)->get();

        return response()->json($availableLayanan);
    }
}
