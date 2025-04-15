<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\PerformanceBulanan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\Paginator;

class ClientInformationController extends Controller
{
    // public function layanan()
    // {
    //     public function index(Request $request)
    //     {
    //         $userId = $request->user()->id; // Mendapatkan user ID dari session atau auth
    
    //         // Mengambil client berdasarkan user_id dan memuat relasi layanannya
    //         $clients = Client::with('layanans')
    //                         ->where('user_id', $userId)
    //                         ->get();
    
    //         return view('clients.index', compact('clients'));
    //     }
    // }

    public function index(Request $request)
    {
        // Get the authenticated user's ID
        $userId = auth()->id(); 
    
        // Retrieve only the clients related to the logged-in user, with their 'layanan' relationship
        $clients = Client::with('layanans')
                         ->where('user_id', $userId) // Assuming 'user_id' is the field in your clients table that links to the user
                         ->get();
    
        return view('info.data.index', compact('clients'));
    }
    
    public function bulanan($encryptedClientId, $encryptedLayanan)
    {
        // Dekripsi parameter yang diterima
        $client_id = decrypt($encryptedClientId);
        $layanan = decrypt($encryptedLayanan);

        // Logika berdasarkan nama layanan
        switch ($layanan) {
            case 'Market Booster':
                // Proses untuk Layanan A
                return $this->prosesLayananA($client_id);
            case 'sh':
                // Proses untuk Layanan B
                return $this->prosesLayananB($client_id);
            case 'LayananC':
                // Proses untuk Layanan C
                return $this->prosesLayananC($client_id);
            default:
                abort(404); // Jika layanan tidak dikenali
        }
    }

    public function prosesLayananA($client_id)
    {
        // ... existing code ...
        
        // Ambil data laporan bulanan berdasarkan client_id dengan pagination
        $dataCount = request()->get('count', 10); // Mengambil jumlah data dari request, default 10
        $reports = PerformanceBulanan::where('client_id', $client_id)->paginate($dataCount);

        // Tambahkan logika untuk menghitung selisih antara tanggal_aktif dan tanggal_berakhir
        $client = Client::findOrFail($client_id);
        $startDate = Carbon::parse($client->tanggal_aktif);
        $endDate = Carbon::parse($client->tanggal_berakhir);
        $difference = $startDate->diff($endDate);
        $months = $difference->m; // Jumlah bulan
        $days = $difference->d; // Jumlah hari

        // Kembalikan view dengan data laporan bulanan dan data client
        return view('info.data.bulanan', compact('reports', 'client', 'months', 'days', 'dataCount'));
    }

    public function prosesLayananB($client_id)
    {
        // Logika untuk Layanan B
        $client = Client::findOrFail($client_id); // Pastikan client ada
        return view('laporan.layanan-b', compact('client'));
    }

    public function prosesLayananC($client_id)
    {
        // Logika untuk Layanan C
        $client = Client::findOrFail($client_id); // Pastikan client ada
        return view('laporan.layanan-c', compact('client'));
    }


    // Detail Laporan Bulanan Epertaiser
    public function harian(Request $request)
    {
        // Validate request
        $request->validate([
            'performance_bulanan_id' => 'required|exists:performance_bulanans,id',
        ]);

        // Get performance_bulanan_id from the request
        $performanceBulananId = $request->performance_bulanan_id;

        // Ambil jumlah data per halaman dari request, default 10
        $perPage = $request->input('perPage', 10);

        // Fetch data with pagination
        $data = DB::table('performa_harians as p')
            ->leftJoin('meta_ads as m', 'p.id', '=', 'm.performa_harian_id')
            ->leftJoin('google_ads as g', 'p.id', '=', 'g.performa_harian_id')
            ->leftJoin('shopee_ads as s', 'p.id', '=', 's.performa_harian_id')
            ->leftJoin('tokped_ads as t', 'p.id', '=', 't.performa_harian_id')
            ->leftJoin('tiktok_ads as tk', 'p.id', '=', 'tk.performa_harian_id')
            ->select('p.*', 
                     'm.regular as meta_regular', 
                     'm.cpas as meta_cpas', 
                     'g.search as google_search', 
                     'g.gtm as google_gtm', 
                     'g.youtube as google_youtube', 
                     'g.performance_max as google_performance_max', 
                     's.manual as shopee_manual', 
                     's.auto_meta as shopee_auto_meta', 
                     's.gmv as shopee_gmv', 
                     's.toko as shopee_toko', 
                     's.live as shopee_live', 
                     't.manual as tokped_manual', 
                     't.auto_meta as tokped_auto_meta', 
                     't.toko as tokped_toko', 
                     'tk.live_shopping as tiktok_live_shopping', 
                     'tk.product_shopping as tiktok_product_shopping', 
                     'tk.video_shopping as tiktok_video_shopping', 
                     'tk.gmv_max as tiktok_gmv_max')
            ->where('p.performance_bulanan_id', $performanceBulananId)
            ->orderBy('p.id', 'asc')
            ->paginate($perPage);

        // Fetch monthly report related to performance_bulanan_id
        $laporanBulanan = PerformanceBulanan::find($performanceBulananId);
        
        // Calculate totals
        $totalSum = DB::table('performa_harians')
            ->where('performance_bulanan_id', $performanceBulananId)
            ->sum('total');
        $totalOmzet = DB::table('performa_harians')
            ->where('performance_bulanan_id', $performanceBulananId)
            ->sum('omzet');
        $totalRoas = round($totalOmzet / ($totalSum ?: 1), 2);

        $leads = DB::table('leads')
            ->where('performance_bulanan_id', $performanceBulananId)
            ->get();
        // Return view with filtered data and monthly report
        session(['activeTab' => 'roas']);
        return view('info.data.harian', compact('data', 'laporanBulanan', 'totalSum', 'totalOmzet', 'totalRoas','performanceBulananId', 'leads'));
    }

    public function store_lead(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'performance_bulanan_id' => 'required|string',
            'hari' => 'required|date',
            'leads' => 'required|integer',
            'chat' => 'required|integer',
            'chat_respon' => 'required|integer',
            'chat_no_respon' => 'required|integer',
            'closing' => 'required|integer',
            'revenue' => 'required|integer',
        ]);

        // Simpan data lead ke dalam tabel leads
        $lead = new Lead();
        $lead->performance_bulanan_id = $validatedData['performance_bulanan_id'];
        $lead->hari = $validatedData['hari'];
        $lead->leads = $validatedData['leads'];
        $lead->chat = $validatedData['chat'];
        $lead->chat_respon = $validatedData['chat_respon'];
        $lead->chat_no_respon = $validatedData['chat_no_respon'];
        $lead->closing = $validatedData['closing'];
        $lead->revenue = $validatedData['revenue'];
        $lead->save();

        // Redirect atau kembali dengan pesan sukses
        session(['activeTabLead' => 'lead']);
        return redirect()->route('data-client.laporan-harian', ['activeTabLead' => 'lead'])
                         ->with('success', 'Data lead berhasil disimpan.');
    }

    public function updateLead(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'hari' => 'required|date',
            'leads' => 'required|integer',
            'chat' => 'required|integer',
            'chat_respon' => 'required|integer',
            'chat_no_respon' => 'required|integer',
            'closing' => 'required|integer',
            'revenue' => 'required|numeric',
        ]);

        // Temukan lead berdasarkan ID
        $lead = Lead::findOrFail($id);

        // Perbarui data lead
        $lead->hari = $request->input('hari');
        $lead->leads = $request->input('leads');
        $lead->chat = $request->input('chat');
        $lead->chat_respon = $request->input('chat_respon');
        $lead->chat_no_respon = $request->input('chat_no_respon');
        $lead->closing = $request->input('closing');
        $lead->revenue = $request->input('revenue');
        $lead->save();

        // Debugging: Cek nilai session sebelum redirect
        session(['activeTabLead' => 'lead']);

        // Redirect kembali dengan format yang diinginkan
        return redirect()->route('data-client.laporan-harian', ['activeTabLead' => 'lead'])
                         ->with('success', 'Data lead berhasil disimpan.');
    }
    
}
