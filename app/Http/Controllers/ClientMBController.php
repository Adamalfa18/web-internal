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
    public function index()
    {
        $clients = Client::whereHas('client_layanan', function ($query) {
            $query->where('layanan_id', 1);
        })
        ->with(['client_layanan' => function ($query) {
            $query->where('layanan_id', 1);
        }])
        ->get();
    
        // Inject status_layanan
        $clients->each(function ($client) {
            $client->status_layanan = optional($client->client_layanan->first())->status;
        });
    
        return view('marketlab.client-mb.index', compact('clients'));
    }
}
