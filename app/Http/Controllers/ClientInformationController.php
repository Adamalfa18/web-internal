<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Client;
use App\Models\Tiktok;
use App\Models\PostMedia;
use App\Models\SocialMedia;
use App\Models\ProfileTiktok;
use App\Models\PerformaHarian;
use Illuminate\Http\Request;
use App\Models\PerformanceBulanan;
use Illuminate\Support\Facades\DB;
use App\Models\TiktokMedia;
use App\Http\Controllers\Controller;
use App\Models\ProfileSa;
use Illuminate\Contracts\Pagination\Paginator;

class ClientInformationController extends Controller
{
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
            case 'Social Media Management':
                // dd('Ini adalah layanan Social Media Management');
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
        // Ambil data laporan bulanan berdasarkan client_id dengan pagination
        $dataCount = request()->get('count', 10); // Mengambil jumlah data dari request, default 10
        $reports = PerformanceBulanan::where('client_id', $client_id)
            ->orderBy('report_date', 'asc')
            ->paginate($dataCount);

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
        $clients = Client::all();
        $client = Client::findOrFail($client_id);
        // Temukan profile TikTok berdasarkan client_id
        // $profileTiktok = ProfileTiktok::where('client_id', $client_id)->firstOrFail();
        $profileIG = ProfileSa::with('links')->where('client_id', $client_id)->first();
        $profileTiktok = ProfileTiktok::with('links')->where('client_id', $client_id)->first();


        // Ambil data profile dari model ProfileSa
        $profile = ProfileSa::with('links')
            ->where('client_id', $client_id)
            ->first();

        $posts = SocialMedia::with('media')
            ->where('client_id', $client_id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $tiktok = Tiktok::with('tiktok_media')
            ->where('client_id', $client_id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $post_medias = collect([]);
        foreach ($posts as $post) {
            $media = PostMedia::with('postingan')
                ->where('post_id', $post->id)
                ->orderBy('created_at', 'asc')
                ->first();
            if ($media) {
                $post_medias->push($media);
            }
        }

        $tiktok_medias = collect([]);
        foreach ($tiktok as $postt) {
            $tmedia = TiktokMedia::with('post_tiktok')
                ->where('post_id', $postt->id)
                ->orderBy('created_at', 'asc')
                ->first();
            if ($tmedia) {
                $tiktok_medias->push($tmedia);
            }
        }
        return view('info.data.client-sa', compact('posts', 'tiktok', 'post_medias', 'tiktok_medias', 'clients', 'client', 'client_id', 'profile', 'profileTiktok'));
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
            ->leftJoin('tiktok_ads as tk', 'p.id', '=', 'tk.performa_harian_id')
            ->select(
                'p.*',

                // Meta Ads
                'm.regular as meta_regular',
                'm.regular_revenue as meta_regular_revenue',
                'm.cpas as meta_cpas',
                'm.cpas_revenue as meta_cpas_revenue',

                // Google Ads
                'g.search as google_search',
                'g.search_revenue as google_search_revenue',
                'g.performance_max as google_performance_max',
                'g.performance_max_revenue as google_performance_max_revenue',

                // Shopee Ads
                's.produk as shopee_produk',
                's.produk_revenue as shopee_produk_revenue',
                's.toko as shopee_toko',
                's.toko_revenue as shopee_toko_revenue',
                's.live as shopee_live',
                's.live_revenue as shopee_live_revenue',

                // TikTok Ads
                'tk.gmv_max as tiktok_gmv_max',
                'tk.gmv_max_revenue as tiktok_gmv_max_revenue',
                'tk.live_shopping as tiktok_live_shopping',
                'tk.live_shopping_revenue as tiktok_live_shopping_revenue',
                'tk.product_shopping as tiktok_product_shopping',
                'tk.product_shopping_revenue as tiktok_product_shopping_revenue',
                'tk.video_shopping as tiktok_video_shopping',
                'tk.video_shopping_revenue as tiktok_video_shopping_revenue'
            )
            ->where('p.performance_bulanan_id', $performanceBulananId)
            ->orderBy('p.hari', 'asc')
            ->paginate($perPage);

        // Fetch monthly report related to performance_bulanan_id
        $laporanBulanan = PerformanceBulanan::find($performanceBulananId);
        $spent_harian = $laporanBulanan->target_spent / 30;
        $revenue_harian = $laporanBulanan->target_revenue / 30;

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
        return view('info.data.harian', compact('spent_harian', 'revenue_harian', 'data', 'laporanBulanan', 'totalSum', 'totalOmzet', 'totalRoas', 'performanceBulananId', 'leads'));
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
            ->with('success', 'Data Lead was successfully saved.');
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
            ->with('success', 'Data Lead was successfully saved.');
    }

    public function update(Request $request, $client_id, $post_id)
    {
        try {
            \Log::info('Update request received', [
                'client_id' => $client_id,
                'post_id' => $post_id,
                'request_data' => $request->all()
            ]);

            // Validate the request
            $request->validate([
                'note' => 'nullable|string',
                'status' => 'required|in:1,2', // 1 for Acc, 2 for Revisi
            ]);

            // Find the post
            $post = SocialMedia::where('client_id', $client_id)
                ->where('id', $post_id)
                ->firstOrFail();

            \Log::info('Post found', ['post' => $post->toArray()]);

            // Update post note
            $post->note = $request->note;
            $post->save();

            \Log::info('Post note updated', ['note' => $request->note]);

            // Find the post media and update status
            $postMedia = PostMedia::where('post_id', $post_id)->first();

            if ($postMedia) {
                \Log::info('Post media found', ['post_media' => $postMedia->toArray()]);

                // If postingan relationship exists, update it
                if ($postMedia->postingan) {
                    $postMedia->postingan->update([
                        'status' => $request->status
                    ]);
                    \Log::info('Postingan status updated', ['status' => $request->status]);
                } else {
                    // If no postingan exists, create one
                    $postMedia->postingan()->create([
                        'status' => $request->status
                    ]);
                    \Log::info('New postingan created', ['status' => $request->status]);
                }
            } else {
                \Log::warning('No post media found for post_id: ' . $post_id);
            }

            return response()->json([
                'success' => true,
                'message' => 'The post was successfully updated'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating post', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'There is an error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateTiktok(Request $request, $client_id, $post_id)
    {
        $request->validate([
            'caption' => 'required|string',
            'created_at' => 'required|date',
            'note' => 'nullable|string',
            'status' => 'required|in:1,2',
        ]);

        $tiktok = \App\Models\Tiktok::where('client_id', $client_id)
            ->where('id', $post_id)
            ->firstOrFail();

        $tiktok->caption = $request->caption;
        $tiktok->created_at = $request->created_at;
        $tiktok->note = $request->note;
        $tiktok->status = $request->status;
        $tiktok->save();

        // Deteksi jika request adalah AJAX (fetch)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Tiktok post was successfully updated.'
            ]);
        }

        return redirect()->back()->with('success', 'Tiktok post was successfully updated.');
    }

    public function compare(Request $request)
    {
        $request->validate([
            'bulan' => 'required|date_format:Y-m',
        ]);

        $carbon = \Carbon\Carbon::parse($request->bulan);
        $startDate = $carbon->startOfMonth()->toDateString();
        $endDate = $carbon->endOfMonth()->toDateString();

        $data = PerformaHarian::whereBetween('hari', [$startDate, $endDate])
            ->orderBy('hari')
            ->get();

        return response()->json([
            'labels' => $data->map(fn($d) => \Carbon\Carbon::parse($d->hari)->format('j M')),
            'spent' => $data->pluck('total'),
            'revenue' => $data->pluck('omzet'),
            'roas' => $data->pluck('roas'),
        ]);
    }
}
