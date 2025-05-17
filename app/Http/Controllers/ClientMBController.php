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
        $namaBrand = $request->input('nama_brand');
        $tanggalAktif = $request->input('tanggal_aktif');

        $clients = Client::whereHas('client_layanan', function ($query) {
            $query->where('layanan_id', 1)
                ->where('status', 1);
        })
            ->when($namaBrand, function ($query, $namaBrand) {
                $query->where('nama_brand', 'like', '%' . $namaBrand . '%');
            })
            ->when($tanggalAktif, function ($query, $tanggalAktif) {
                $query->whereDate('date_in', $tanggalAktif);
            })
            ->with(['client_layanan' => function ($query) {
                $query->where('layanan_id', 1)
                    ->where('status', 1);
            }])
            ->paginate(10)
            ->withQueryString();

        $clients->each(function ($client) {
            $client->status_layanan = optional($client->client_layanan->first())->status;
        });

        return view('marketlab.client-mb.index', compact('clients'));
    }
}
