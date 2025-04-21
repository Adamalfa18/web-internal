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

class ClientMBController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);
        $status = $request->input('status'); // Hapus default, biarkan status bisa 1, 2, atau 3

        $clients = Client::when($search, function ($query) use ($search) {
            return $query->where('nama_client', 'like', '%' . $search . '%')
                ->orWhere('nama_brand', 'like', '%' . $search . '%')
                ->orWhere('pj', 'like', '%' . $search . '%')
                ->orWhereHas('pegawai', function ($query) use ($search) { // Menggunakan relasi untuk pegawai
                    return $query->where('nama', 'like', '%' . $search . '%');
                });
        })
            ->when(in_array($status, [1, 2, 3]), function ($query) use ($status) { // Tambahkan filter untuk status 2 dan 3
                return $query->where('status_client', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // Mendapatkan halaman saat ini dan total halaman
        $currentPage = $clients->currentPage();
        $totalPages = $clients->lastPage();

        return view('marketlab.client-mb.index', compact('clients', 'search', 'perPage', 'status', 'currentPage', 'totalPages'));
    }
}
