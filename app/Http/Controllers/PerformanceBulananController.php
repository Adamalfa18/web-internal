<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerformanceBulanan;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Pegawai;
use App\Models\PerformaHarian;
use Carbon\Carbon;

class PerformanceBulananController extends Controller
{
    public function index(Request $request)
    {
        // Validate the client_id received
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'perPage' => 'nullable|integer|min:1', // Validate perPage input
        ]);

        // Get the selected client
        $client = Client::find($request->client_id);

        // Set the number of items per page, defaulting to 10
        $perPage = $request->input('perPage', 10);

        // Check if the client exists
        if (!$client) {
            return redirect()->back()->withErrors(['Client not found.']);
        }

        // Calculate the difference between tanggal_berakhir and tanggal_aktif
        $startDate = Carbon::parse($client->tanggal_aktif);
        $endDate = Carbon::parse($client->tanggal_berakhir);

        // Get the difference in months and days
        $difference = $startDate->diff($endDate);
        $months = $difference->m; // Number of months
        $days = $difference->d; // Number of days

        // Get monthly reports based on client_id
        $reports = PerformanceBulanan::where('client_id', $request->client_id)
            ->orderBy('report_date', 'asc')
            ->paginate($perPage); // Pagination

        // Get current page and total pages for the pagination
        $currentPage = $reports->currentPage(); // Current page
        $totalPages = $reports->lastPage(); // Total pages

        // Return view with monthly reports, client data, and months and days count
        return view('marketlab.laporan-bulanan.index', compact('reports', 'client', 'months', 'days', 'perPage', 'currentPage', 'totalPages'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
        ]);
        $client = Client::find($request->client_id);
        // Mengganti 'layanans' dengan 'pegawai' dan 'client' yang sudah didefinisikan
        return view('marketlab.laporan-bulanan.create', compact('client'));
    }

    public function store(Request $request)
    {
        // Bersihkan input format Rupiah → angka sebelum validasi
        $request->merge([
            'target_spent'   => preg_replace('/[^0-9]/', '', $request->target_spent),
            'target_revenue' => preg_replace('/[^0-9]/', '', $request->target_revenue),
            'spent'          => preg_replace('/[^0-9]/', '', $request->spent),
            'revenue'        => preg_replace('/[^0-9]/', '', $request->revenue),
        ]);

        // Validasi umum
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'report_date' => 'required|string',
            'note' => 'required|string',
            'layanan_mb' => 'required|in:Leads,Marketplace',
            'nama_campaign' => 'required|string',
        ]);

        // Validasi Marketplace
        if ($request->layanan_mb === 'Marketplace') {
            $request->validate([
                'target_spent' => 'required|numeric',
                'target_revenue' => 'required|numeric',
                'target_roas' => 'required|string',
            ]);
        }

        // Validasi Leads
        if ($request->layanan_mb === 'Leads') {
            $request->validate([
                'jenis_leads' => 'required|in:Roas Revenue,Total Closing,Site Visits',
                'spent' => 'nullable|numeric',
                'leads' => 'nullable|numeric',
                'revenue' => 'nullable|numeric',
                'roas' => 'nullable|string',
                'chat' => 'nullable|numeric',
                'respond' => 'nullable|numeric',
                'greeting' => 'nullable|numeric',
                'pricelist' => 'nullable|numeric',
                'discuss' => 'nullable|numeric',
                'closing' => 'nullable|numeric',
                'site_visits' => 'nullable|numeric',
                'cpl' => 'nullable|numeric',
                'cpc' => 'nullable|numeric',
                'cr_leads_chat' => 'nullable|numeric',
                'cr_chat_respond' => 'nullable|numeric',
                'cr_respond_closing' => 'nullable|numeric',
                'cr_respond_site_visit' => 'nullable|numeric',
            ]);
        }

        // Data umum
        $data = [
            'client_id'         => $request->client_id,
            'report_date'       => $request->report_date,
            'note'              => $request->note,
            'jenis_layanan_mb'  => $request->layanan_mb,
            'jenis_leads'       => $request->jenis_leads ?? null,
            'nama_campaign'     => $request->nama_campaign,
        ];

        // Data Marketplace
        if ($request->layanan_mb === 'Marketplace') {
            $data['target_spent']   = $request->target_spent;
            $data['target_revenue'] = $request->target_revenue;
            $data['target_roas']    = $request->target_roas;
        }

        // Data Leads
        if ($request->layanan_mb === 'Leads') {
            $data += [
                'target_spent' => $request->spent,
                'target_leads' => $request->leads,
                'target_revenue' => $request->revenue,
                'target_roas' => $request->roas,
                'chat' => $request->chat,
                'respond' => $request->respond,
                'greeting' => $request->greeting,
                'pricelist' => $request->pricelist,
                'discuss' => $request->discuss,
                'closing' => $request->closing,
                'site_visit' => $request->site_visits,
                'cpl' => $request->cpl,
                'cpc' => $request->cpc,
                'cr_leads_to_chat' => $request->cr_leads_chat,
                'cr_chat_to_respond' => $request->cr_chat_respond,
                'cr_respond_to_closing' => $request->cr_respond_closing,
                'cr_respond_to_site_visit' => $request->cr_respond_site_visit,
            ];
        }

        $report = PerformanceBulanan::create($data);

        if ($report) {
            return redirect()->route('laporan-bulanan.index', ['client_id' => $request->client_id])
                ->with('success', 'Laporan bulanan berhasil dibuat!');
        } else {
            return redirect()->back()->with('error', 'Failed to store monthly report!');
        }
    }


    public function show($id)
    {
        // Ambil data laporan bulanan berdasarkan ID
        $report = PerformanceBulanan::findOrFail($id);

        // Ambil data semua pegawai
        $pegawai = Pegawai::all();

        // Kembalikan view dengan data laporan bulanan dan data pegawai
        return view('laporan-bulanan.show', compact('report', 'pegawai'));
    }

    public function edit($id)
    {
        // dd($id);

        // Ambil data laporan bulanan berdasarkan client_id
        $reports = PerformanceBulanan::find($id);
        $pegawai = Pegawai::all();

        // Kembalikan view dengan data laporan bulanan dan data client
        return view('marketlab.laporan-bulanan.update', compact('reports', 'pegawai'));
    }


    public function update(Request $request, $id)
    {
        $reports = PerformanceBulanan::findOrFail($id);

        // Validasi semua input
        $validatedData = $request->validate([
            'report_date' => 'required|date_format:Y-m',
            'nama_campaign' => 'required|string',
            'layanan_mb' => 'required|string|in:Leads,Marketplace',
            'jenis_leads' => 'nullable|string|in:Roas Revenue,Total Closing,Site Visits',
            'target_spent' => 'nullable|numeric',
            'target_revenue' => 'nullable|numeric',
            'target_roas' => 'nullable|numeric',
            'target_leads' => 'nullable|numeric',
            'spent' => 'nullable|numeric',
            'leads' => 'nullable|numeric',
            'revenue' => 'nullable|numeric',
            'chat' => 'nullable|numeric',
            'greeting' => 'nullable|numeric',
            'pricelist' => 'nullable|numeric',
            'discuss' => 'nullable|numeric',
            'respond' => 'nullable|numeric',
            'closing' => 'nullable|numeric',
            'site_visits' => 'nullable|numeric',
            'roas' => 'nullable|numeric',
            'cpl' => 'nullable|numeric',
            'cpc' => 'nullable|numeric',
            'cr_leads_chat' => 'nullable|numeric',
            'cr_chat_respond' => 'nullable|numeric',
            'cr_respond_closing' => 'nullable|numeric',
            'cr_respond_site_visit' => 'nullable|numeric',
            'note' => 'required|string',
        ]);

        // Masukkan semua ke array update
        $data = [
            'report_date' => $validatedData['report_date'],
            'nama_campaign' => $validatedData['nama_campaign'],
            'jenis_layanan_mb' => $validatedData['layanan_mb'],
            'jenis_leads' => $validatedData['jenis_leads'] ?? null,
            'target_spent' => $validatedData['target_spent'] ?? $validatedData['spent'] ?? null,
            'target_revenue' => $validatedData['target_revenue'] ?? $validatedData['revenue'] ?? null,
            'target_roas' => $validatedData['target_roas'] ?? $validatedData['roas'] ?? null,
            'target_leads' => $validatedData['target_leads'] ?? $validatedData['leads'] ?? null,
            'chat' => $validatedData['chat'] ?? null,
            'greeting' => $validatedData['greeting'] ?? null,
            'pricelist' => $validatedData['pricelist'] ?? null,
            'discuss' => $validatedData['discuss'] ?? null,
            'respond' => $validatedData['respond'] ?? null,
            'closing' => $validatedData['closing'] ?? null,
            'site_visit' => $validatedData['site_visits'] ?? null,
            'cpl' => $validatedData['cpl'] ?? null,
            'cpc' => $validatedData['cpc'] ?? null,
            'cr_leads_to_chat' => $validatedData['cr_leads_chat'] ?? null,
            'cr_chat_to_respond' => $validatedData['cr_chat_respond'] ?? null,
            'cr_respond_to_closing' => $validatedData['cr_respond_closing'] ?? null,
            'cr_respond_to_site_visit' => $validatedData['cr_respond_site_visit'] ?? null,
            'note' => $validatedData['note'],
        ];

        $reports->update($data);

        return redirect()->route('laporan-bulanan.index', ['client_id' => $reports->client_id])
            ->with('success', 'Data updated successfully!');
    }


    public function compareView(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'bulan1' => 'required|date_format:Y-m',
            'bulan2' => 'required|date_format:Y-m',
        ]);

        $fromDate1 = \Carbon\Carbon::createFromFormat('Y-m', $request->bulan1)->startOfMonth()->toDateString();
        $toDate1 = \Carbon\Carbon::createFromFormat('Y-m', $request->bulan1)->endOfMonth()->toDateString();

        $fromDate2 = \Carbon\Carbon::createFromFormat('Y-m', $request->bulan2)->startOfMonth()->toDateString();
        $toDate2 = \Carbon\Carbon::createFromFormat('Y-m', $request->bulan2)->endOfMonth()->toDateString();

        $reports1 = PerformaHarian::where('client_id', $request->client_id)
            ->whereBetween('report_date', [$fromDate1, $toDate1])
            ->orderBy('report_date')
            ->get();

        $reports2 = PerformaHarian::where('client_id', $request->client_id)
            ->whereBetween('report_date', [$fromDate2, $toDate2])
            ->orderBy('report_date')
            ->get();

        if ($request->ajax()) {
            return response()->json([
                // Data pertama (base)
                'baseLabels' => $reports1->pluck('report_date')->map(fn($date) => \Carbon\Carbon::parse($date)->format('D M')),
                'baseSpent' => $reports1->pluck('target_spent'),
                'baseRevenue' => $reports1->pluck('target_revenue'),
                'baseRoas' => $reports1->pluck('target_roas'),

                // Data kedua (compare)
                'compareLabels' => $reports2->pluck('report_date')->map(fn($date) => \Carbon\Carbon::parse($date)->format('D M')),
                'compareSpent' => $reports2->pluck('target_spent'),
                'compareRevenue' => $reports2->pluck('target_revenue'),
                'compareRoas' => $reports2->pluck('target_roas'),
            ]);
        }

        return view(...);
    }
}
