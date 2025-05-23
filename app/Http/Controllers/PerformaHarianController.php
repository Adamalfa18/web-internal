<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Lead;
use App\Models\MetaAds;
use App\Models\GoogleAds;
use App\Models\ShopeeAds;
use App\Models\TiktokAds;
use App\Models\TokpedAds;
use Illuminate\Http\Request;
use App\Models\PerformaHarian;
use App\Models\PerformanceBulanan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerformaHarianRequest;
use App\Http\Requests\UpdatePerformaHarianRequest;

class PerformaHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
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
            ->select(
                'p.*',
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
                'tk.gmv_max as tiktok_gmv_max'
            )
            ->where('p.performance_bulanan_id', $performanceBulananId)
            ->orderBy('p.hari', 'asc')
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

        // Data compare untuk grafik
        $data1 = PerformaHarian::whereBetween('hari', [$request->fromDate, $request->toDate])->get();
        $data2 = PerformaHarian::whereBetween('hari', [$request->fromDate2, $request->toDate2])->get();

        // Fetch data leads terkait dengan performance_bulanan_id
        $leads = DB::table('leads')
            ->where('performance_bulanan_id', $performanceBulananId)
            ->get();

        // Return view with filtered data, monthly report, and leads
        session(['activeTab' => 'roas', 'activeTabLead' => 'roas']);
        return view('marketlab.performa-harian.index', compact('data', 'data1', 'data2', 'laporanBulanan', 'totalSum', 'totalOmzet', 'totalRoas', 'performanceBulananId', 'leads'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'performance_bulanan_id' => 'required|exists:performance_bulanans,id',
        ]);
        $laporanBulanan = PerformanceBulanan::find($request->performance_bulanan_id);
        return view('marketlab.performa-harian.create', compact('laporanBulanan'));
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
        $lead = new Lead(); // Pastikan Anda sudah mengimpor model Lead
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
        session(['activeTab' => 'lead', 'activeTabLead' => 'lead']);
        return redirect()->route('laporan-harian.index', ['performance_bulanan_id' => $validatedData['performance_bulanan_id']])
            ->with('success', 'Data lead berhasil disimpan.');
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'performance_bulanan_id' => 'required|exists:performance_bulanans,id',
            'hari' => 'required|date',
            'roas' => 'required|numeric',
            'total' => 'required|numeric',
            'omzet' => 'required|numeric',
            'tables' => 'array',
            'tables.*' => 'in:meta_ads,google_ads,shopee_ads,tokped_ads,tiktok_ads',
            'meta_regular' => 'numeric|nullable',
            'meta_cpas' => 'numeric|nullable',
            'google_performance_max' => 'numeric|nullable',
            'google_search' => 'numeric|nullable',
            'google_gtm' => 'numeric|nullable',
            'google_youtube' => 'numeric|nullable',
            'shopee_manual' => 'numeric|nullable',
            'shopee_auto_meta' => 'numeric|nullable',
            'shopee_gmv' => 'numeric|nullable',
            'shopee_toko' => 'numeric|nullable',
            'shopee_live' => 'numeric|nullable',
            'tokped_manual' => 'numeric|nullable',
            'tokped_auto_meta' => 'numeric|nullable',
            'tokped_toko' => 'numeric|nullable',
            'tiktok_live' => 'numeric|nullable',
            'tiktok_gmv_max' => 'numeric|nullable',
            'tiktok_live_shopping' => 'numeric|nullable',
            'tiktok_product_shopping' => 'numeric|nullable',
            'tiktok_video_shopping' => 'numeric|nullable',
        ]);

        // Isi nilai default 0 untuk parameter yang tidak diinput
        $defaultValues = [
            'meta_regular' => 0,
            'meta_cpas' => 0,
            'google_search' => 0,
            'google_youtube' => 0,
            'google_ads' => 0,
            'shopee_manual' => 0,
            'shopee_auto_meta' => 0,
            'shopee_gmv' => 0,
            'shopee_toko' => 0,
            'shopee_live' => 0,
            'tokped_manual' => 0,
            'tokped_auto_meta' => 0,
            'tokped_toko' => 0,
            'tiktok_live' => 0,
            'tiktok_gmv_max' => 0,
            'tiktok_live_shopping' => 0,
            'tiktok_product_shopping' => 0,
            'tiktok_video_shopping' => 0,
        ];

        foreach ($defaultValues as $key => $value) {
            if (!isset($validatedData[$key])) {
                $validatedData[$key] = $value;
            }
        }

        $laporanBulanan = PerformanceBulanan::find($request->performance_bulanan_id);

        // Simpan data performa harian
        $performa = PerformaHarian::create([
            'performance_bulanan_id' => $validatedData['performance_bulanan_id'],
            'hari' => $validatedData['hari'],
            'roas' => $validatedData['roas'],
            'total' => $validatedData['total'],
            'omzet' => $validatedData['omzet'],
        ]);

        // Cek jika $performa berhasil dibuat dan memiliki ID
        if (!$performa || !$performa->id) {
            return redirect()->back()->withErrors('Gagal menyimpan data performa harian.');
        }


        // Simpan data iklan berdasarkan tabel yang dipilih
        if (in_array('meta_ads', $validatedData['tables'])) {
            MetaAds::create([
                'performa_harian_id' => $performa->id,
                'regular' => $validatedData['meta_regular'] ?? 0,
                'cpas' => $validatedData['meta_cpas'] ?? 0,
            ]);
        } else {
            MetaAds::create([
                'performa_harian_id' => $performa->id,
                'regular' => 0,
                'cpas' => 0,
            ]);
        }

        if (in_array('google_ads', $validatedData['tables'])) {
            GoogleAds::create([
                'performa_harian_id' => $performa->id,
                'search' => $validatedData['google_search'] ?? 0,
                'gtm' => $validatedData['google_gtm'] ?? 0,
                'youtube' => $validatedData['google_youtube'] ?? 0,
                'performance_max' => $validatedData['google_performance_max'] ?? 0,
            ]);
        } else {
            GoogleAds::create([
                'performa_harian_id' => $performa->id,
                'search' => 0,
                'gtm' => 0,
                'youtube' => 0,
                'performance_max' => 0,
            ]);
        }

        if (in_array('shopee_ads', $validatedData['tables'])) {
            ShopeeAds::create([
                'performa_harian_id' => $performa->id,
                'manual' => $validatedData['shopee_manual'] ?? 0,
                'auto_meta' => $validatedData['shopee_auto_meta'] ?? 0,
                'gmv' => $validatedData['shopee_gmv'] ?? 0,
                'toko' => $validatedData['shopee_toko'] ?? 0,
                'live' => $validatedData['shopee_live'] ?? 0,
            ]);
        } else {
            ShopeeAds::create([
                'performa_harian_id' => $performa->id,
                'manual' => 0,
                'auto_meta' => 0,
                'gmv' => 0,
                'toko' => 0,
                'live' => 0,
            ]);
        }

        if (in_array('tokped_ads', $validatedData['tables'])) {
            TokpedAds::create([
                'performa_harian_id' => $performa->id,
                'manual' => $validatedData['tokped_manual'] ?? 0,
                'auto_meta' => $validatedData['tokped_auto_meta'] ?? 0,
                'toko' => $validatedData['tokped_toko'] ?? 0,
            ]);
        } else {
            TokpedAds::create([
                'performa_harian_id' => $performa->id,
                'manual' => 0,
                'auto_meta' => 0,
                'toko' => 0,
            ]);
        }

        if (in_array('tiktok_ads', $validatedData['tables'])) {
            TiktokAds::create([
                'performa_harian_id' => $performa->id,
                'gmv_max' => $validatedData['tiktok_gmv_max'] ?? 0,
                'video_shopping' => $validatedData['tiktok_video_shopping'] ?? 0,
                'product_shopping' => $validatedData['tiktok_product_shopping'] ?? 0,
                'live_shopping' => $validatedData['tiktok_live_shopping'] ?? 0,
            ]);
        } else {
            TiktokAds::create([
                'performa_harian_id' => $performa->id,
                'gmv_max' => 0,
                'video_shopping' => 0,
                'product_shopping' => 0,
                'live_shopping' => 0,
            ]);
        }
        session(['activeTab' => 'roas', 'activeTabLead' => 'roas']);
        return redirect()->route('laporan-harian.index', ['performance_bulanan_id' => $laporanBulanan->id])
            ->with('success', 'Data performa harian berhasil disimpan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(PerformaHarian $performaHarian) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        // Mengambil performance_bulanan_id dari performaHarian
        // $performanceBulananId = $performaHarian->performance_bulanan_id;

        // Mengambil data performa harian yang terkait dengan performa_harian_id
        $data = DB::table('performa_harians as p')
            ->leftJoin('meta_ads as m', 'p.id', '=', 'm.performa_harian_id')
            ->leftJoin('google_ads as g', 'p.id', '=', 'g.performa_harian_id')
            ->leftJoin('shopee_ads as s', 'p.id', '=', 's.performa_harian_id')
            ->leftJoin('tokped_ads as t', 'p.id', '=', 't.performa_harian_id')
            ->leftJoin('tiktok_ads as tk', 'p.id', '=', 'tk.performa_harian_id')
            ->select(
                'p.*',
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
                'tk.gmv_max as tiktok_gmv_max'
            ) // Pastikan untuk mengambil kolom 'tables'
            ->where('p.id', $id) // Filter berdasarkan id performa_harian
            ->get();
        // dd($data);


        // Menampilkan data untuk debugging
        // Mengambil data laporan bulanan yang terkait dengan performance_bulanan_id
        // $laporanBulanan = PerformanceBulanan::find($performanceBulananId);


        // Mengembalikan view dengan data yang sudah difilter dan laporan bulanan
        return view('marketlab.performa-harian.update', compact('data'));
    }




    // ... existing code ...

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

        // Redirect kembali dengan format yang diinginkan
        session(['activeTab' => 'lead', 'activeTabLead' => 'lead']);
        return redirect()->route('laporan-harian.index', ['performance_bulanan_id' => $lead->performance_bulanan_id])
            ->with('success', 'Data lead berhasil diperbarui.');
    }


    // ... existing code ...

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'performance_bulanan_id' => 'required|exists:performance_bulanans,id',
            'hari' => 'required|date',
            'roas' => 'required|numeric',
            'total' => 'required|numeric',
            'omzet' => 'required|numeric',
            // Meta Ads
            'meta_regular' => 'numeric|nullable',
            'meta_cpas' => 'numeric|nullable',
            // Google Ads
            'google_search' => 'numeric|nullable',
            'google_gtm' => 'numeric|nullable',
            'google_youtube' => 'numeric|nullable',
            'google_performance_max' => 'numeric|nullable',
            // Shopee Ads
            'shopee_manual' => 'numeric|nullable',
            'shopee_auto_meta' => 'numeric|nullable',
            'shopee_gmv' => 'numeric|nullable',
            'shopee_toko' => 'numeric|nullable',
            'shopee_live' => 'numeric|nullable',
            // Tokped Ads
            'tokped_manual' => 'numeric|nullable',
            'tokped_auto_meta' => 'numeric|nullable',
            'tokped_toko' => 'numeric|nullable',
            // Tiktok Ads
            'tiktok_live_shopping' => 'numeric|nullable',
            'tiktok_product_shopping' => 'numeric|nullable',
            'tiktok_video_shopping' => 'numeric|nullable',
            'tiktok_gmv_max' => 'numeric|nullable',
        ]);

        $performa = PerformaHarian::findOrFail($id);

        // Update data performa harian
        $performa->update([
            'performance_bulanan_id' => $validatedData['performance_bulanan_id'],
            'hari' => $validatedData['hari'],
            'roas' => $validatedData['roas'],
            'total' => $validatedData['total'],
            'omzet' => $validatedData['omzet'],
        ]);

        // Update Meta Ads
        MetaAds::updateOrCreate(
            ['performa_harian_id' => $performa->id],
            [
                'regular' => $validatedData['meta_regular'] ?? 0,
                'cpas' => $validatedData['meta_cpas'] ?? 0,
            ]
        );

        // Update Google Ads
        GoogleAds::updateOrCreate(
            ['performa_harian_id' => $performa->id],
            [
                'search' => $validatedData['google_search'] ?? 0,
                'gtm' => $validatedData['google_gtm'] ?? 0,
                'youtube' => $validatedData['google_youtube'] ?? 0,
                'performance_max' => $validatedData['google_performance_max'] ?? 0,
            ]
        );

        // Update Shopee Ads
        ShopeeAds::updateOrCreate(
            ['performa_harian_id' => $performa->id],
            [
                'manual' => $validatedData['shopee_manual'] ?? 0,
                'auto_meta' => $validatedData['shopee_auto_meta'] ?? 0,
                'gmv' => $validatedData['shopee_gmv'] ?? 0,
                'toko' => $validatedData['shopee_toko'] ?? 0,
                'live' => $validatedData['shopee_live'] ?? 0,
            ]
        );

        // Update Tokped Ads
        TokpedAds::updateOrCreate(
            ['performa_harian_id' => $performa->id],
            [
                'manual' => $validatedData['tokped_manual'] ?? 0,
                'auto_meta' => $validatedData['tokped_auto_meta'] ?? 0,
                'toko' => $validatedData['tokped_toko'] ?? 0,
            ]
        );

        // Update Tiktok Ads
        TiktokAds::updateOrCreate(
            ['performa_harian_id' => $performa->id],
            [
                'live_shopping' => $validatedData['tiktok_live_shopping'] ?? 0,
                'product_shopping' => $validatedData['tiktok_product_shopping'] ?? 0,
                'video_shopping' => $validatedData['tiktok_video_shopping'] ?? 0,
                'gmv_max' => $validatedData['tiktok_gmv_max'] ?? 0,
            ]
        );
        session(['activeTab' => 'roas', 'activeTabLead' => 'roas']);
        return redirect()->route('laporan-harian.index', ['performance_bulanan_id' => $validatedData['performance_bulanan_id']])
            ->with('success', 'Data performa harian berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */

    public function destroy_lead($id)
    {
        // Temukan lead berdasarkan ID
        $lead = Lead::findOrFail($id);

        // Hapus lead
        $lead->delete();

        // Redirect kembali dengan pesan sukses
        session(['activeTab' => 'lead', 'activeTabLead' => 'lead']);
        return redirect()->route('laporan-harian.index')
            ->with('success', 'Lead berhasil dihapus.');
    }

    public function destroy($id)
    {
        // Temukan data performa harian berdasarkan ID

        $performa = PerformaHarian::findOrFail($id);

        // Hapus data terkait iklan (Meta, Google, Shopee, Tokped, Tiktok)
        MetaAds::where('performa_harian_id', $performa->id)->delete();
        GoogleAds::where('performa_harian_id', $performa->id)->delete();
        ShopeeAds::where('performa_harian_id', $performa->id)->delete();
        TokpedAds::where('performa_harian_id', $performa->id)->delete();
        TiktokAds::where('performa_harian_id', $performa->id)->delete();


        $performa->delete();

        // Redirect ke halaman laporan harian dengan pesan sukses

        session(['activeTab' => 'roas', 'activeTabLead' => 'roas']);
        return redirect()->route('laporan-harian.index', ['performance_bulanan_id' => $performa->performance_bulanan_id])
            ->with('success', 'Data performa harian dan data iklan terkait berhasil dihapus.');
    }

    // public function compareData(Request $request)
    // {
    //     // Validate request
    //     $request->validate([
    //         'fromDate' => 'required|date',
    //         'toDate' => 'required|date|after_or_equal:fromDate',
    //         'fromDate2' => 'required|date',
    //         'toDate2' => 'required|date|after_or_equal:fromDate2',
    //         'performance_bulanan_id' => 'required|exists:performance_bulanans,id',
    //     ]);

    //     // Get performance_bulanan_id from the request
    //     $performanceBulananId = $request->performance_bulanan_id;

    //     // Ambil jumlah data per halaman dari request, default 10
    //     $perPage = $request->input('perPage', 10);

    //     // Fetch data with pagination
    //     $data = DB::table('performa_harians as p')
    //         ->leftJoin('meta_ads as m', 'p.id', '=', 'm.performa_harian_id')
    //         ->leftJoin('google_ads as g', 'p.id', '=', 'g.performa_harian_id')
    //         ->leftJoin('shopee_ads as s', 'p.id', '=', 's.performa_harian_id')
    //         ->leftJoin('tokped_ads as t', 'p.id', '=', 't.performa_harian_id')
    //         ->leftJoin('tiktok_ads as tk', 'p.id', '=', 'tk.performa_harian_id')
    //         ->select(
    //             'p.*',
    //             'm.regular as meta_regular',
    //             'm.cpas as meta_cpas',
    //             'g.search as google_search',
    //             'g.gtm as google_gtm',
    //             'g.youtube as google_youtube',
    //             'g.performance_max as google_performance_max',
    //             's.manual as shopee_manual',
    //             's.auto_meta as shopee_auto_meta',
    //             's.gmv as shopee_gmv',
    //             's.toko as shopee_toko',
    //             's.live as shopee_live',
    //             't.manual as tokped_manual',
    //             't.auto_meta as tokped_auto_meta',
    //             't.toko as tokped_toko',
    //             'tk.live_shopping as tiktok_live_shopping',
    //             'tk.product_shopping as tiktok_product_shopping',
    //             'tk.video_shopping as tiktok_video_shopping',
    //             'tk.gmv_max as tiktok_gmv_max'
    //         )
    //         ->where('p.performance_bulanan_id', $performanceBulananId)
    //         ->orderBy('p.id', 'asc')
    //         ->paginate($perPage);

    //     // Fetch monthly report related to performance_bulanan_id
    //     $laporanBulanan = PerformanceBulanan::find($performanceBulananId);
    //     // Calculate totals
    //     $totalSum = DB::table('performa_harians')
    //         ->where('performance_bulanan_id', $performanceBulananId)
    //         ->sum('total');
    //     $totalOmzet = DB::table('performa_harians')
    //         ->where('performance_bulanan_id', $performanceBulananId)
    //         ->sum('omzet');
    //     $totalRoas = round($totalOmzet / ($totalSum ?: 1), 2);

    //     // Data compare untuk grafik
    //     $data1 = PerformaHarian::whereBetween('hari', [$request->fromDate, $request->toDate])->get();
    //     $data2 = PerformaHarian::whereBetween('hari', [$request->fromDate2, $request->toDate2])->get();

    //     // Fetch data leads terkait dengan performance_bulanan_id
    //     $leads = DB::table('leads')
    //         ->where('performance_bulanan_id', $performanceBulananId)
    //         ->get();

    //     session(['activeTab' => 'roas', 'activeTabLead' => 'roas']);

    //     // Return view with filtered data, monthly report, and leads
    //     session(['activeTab' => 'roas', 'activeTabLead' => 'roas']);
    //     return view('marketlab.performa-harian.index', compact('data', 'data1', 'data2', 'laporanBulanan', 'totalSum', 'totalOmzet', 'totalRoas', 'performanceBulananId', 'leads'));
    // }

    public function compareData(Request $request)
    {
        // Validate request
        $request->validate([
            'fromDate' => 'required|date',
            'toDate' => 'required|date|after_or_equal:fromDate',
            'fromDate2' => 'required|date',
            'toDate2' => 'required|date|after_or_equal:fromDate2',
            // 'performance_bulanan_id' => 'required|exists:performance_bulanans,id',
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
            ->select(
                'p.*',
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
                'tk.gmv_max as tiktok_gmv_max'
            )
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

        // Data compare untuk grafik
        $data1 = PerformaHarian::whereBetween('hari', [$request->fromDate, $request->toDate])->get();
        $data2 = PerformaHarian::whereBetween('hari', [$request->fromDate2, $request->toDate2])->get();

        // Fetch data leads terkait dengan performance_bulanan_id
        $leads = DB::table('leads')
            ->where('performance_bulanan_id', $performanceBulananId)
            ->get();

        // Return view with filtered data, monthly report, and leads
        session(['activeTab' => 'roas', 'activeTabLead' => 'roas']);
        return view('marketlab.performa-harian.index', compact('data', 'data1', 'data2', 'laporanBulanan', 'totalSum', 'totalOmzet', 'totalRoas', 'performanceBulananId', 'leads'));
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
