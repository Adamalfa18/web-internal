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
        // dd($request->all());
        // Validasi dasar
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'report_date' => 'required|string',
            'note' => 'required|string',
            'layanan_mb' => 'required|in:Leads,Marketplace',
        ]);

        // Validasi tambahan berdasarkan jenis layanan
        if ($request->layanan_mb === 'Marketplace') {
            $request->validate([
                'target_spent' => 'required|numeric',
                'target_revenue' => 'required|numeric',
                'target_roas' => 'required|string',
            ]);
        }

        if ($request->layanan_mb === 'Leads') {
            $request->validate([
                'jenis_leads' => 'required|in:F to F,Roas Revenue,Total Closing,Site Visits',
            ]);
        }

        // Inisialisasi data dasar
        $data = [
            'client_id'         => $request->client_id,
            'report_date'       => $request->report_date,
            'note'              => $request->note,
            'jenis_layanan_mb'  => $request->layanan_mb,
            'jenis_leads'       => $request->jenis_leads ?? null,
        ];

        // Isi field berdasarkan jenis layanan
        if ($request->layanan_mb === 'Marketplace') {
            $data['target_spent']   = $request->target_spent;
            $data['target_revenue'] = $request->target_revenue;
            $data['target_roas']    = $request->target_roas;
        }

        // Isi field berdasarkan jenis leads
        if ($request->layanan_mb === 'Leads') {
            switch ($request->jenis_leads) {
                case 'F to F':
                    $data['target_spent']   = $request->spent_ff;
                    $data['target_leads']   = $request->leads_ff;
                    $data['chat']           = $request->chat_ff;
                    $data['greeting']       = $request->greeting_ff;
                    $data['pricelist']      = $request->pricelist_ff;
                    $data['discuss']        = $request->discuss_ff;
                    break;

                case 'Roas Revenue':
                    $data['target_spent']   = $request->spent_roas;
                    $data['target_revenue'] = $request->revenue_roas;
                    $data['target_roas']    = $request->roas_roas;
                    $data['chat']           = $request->chat_roas;
                    $data['respond']        = $request->chat_respond_roas;
                    $data['closing']        = $request->closing_roas;
                    break;

                case 'Total Closing':
                    $data['target_spent']   = $request->spent_closing;
                    $data['target_leads']   = $request->leads_closing;
                    $data['chat']           = $request->chat_closing;
                    $data['respond']        = $request->chat_respond_closing;
                    $data['closing']        = $request->closing_closing;
                    break;

                case 'Site Visits':
                    $data['target_spent']   = $request->spent_site_visit;
                    $data['target_leads']   = $request->leads_site_visit_value;
                    $data['chat']           = $request->chat_site_visit;
                    $data['respond']        = $request->respond_site_visit;
                    $data['closing']        = $request->closing_site_visit;
                    break;
            }
        }

        // Simpan data
        $report = PerformanceBulanan::create($data);

        // Redirect
        if ($report) {
            return redirect()->route('laporan-bulanan.index', ['client_id' => $request->client_id])
                ->with('success', 'Laporan bulanan berhasil dibuat!');
        } else {
            return redirect()->back()->with('error', 'Laporan bulanan gagal dibuat!');
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

        $validatedData = $request->validate([
            'report_date' => 'required|date_format:Y-m',
            'note' => 'required|string',
        ]);

        $data = [
            'report_date' => $validatedData['report_date'],
            'note' => $validatedData['note'],
        ];

        if ($reports->jenis_layanan_mb === 'Marketplace') {
            $request->validate([
                'target_spent' => 'required|numeric',
                'target_revenue' => 'required|numeric',
                'target_roas' => 'required|numeric',
            ]);

            $data['target_spent'] = $request->target_spent;
            $data['target_revenue'] = $request->target_revenue;
            $data['target_roas'] = $request->target_roas;
        } elseif ($reports->jenis_layanan_mb === 'Leads') {
            switch ($reports->jenis_leads) {
                case 'F to F':
                    $data['target_spent'] = $request->spent_ff;
                    $data['target_leads'] = $request->leads_ff;
                    $data['chat'] = $request->chat_ff;
                    $data['greeting'] = $request->greeting_ff;
                    $data['pricelist'] = $request->pricelist_ff;
                    $data['discuss'] = $request->discuss_ff;
                    break;

                case 'Roas Revenue':
                    $data['target_spent'] = $request->spent_roas;
                    $data['target_revenue'] = $request->revenue_roas;
                    $data['target_roas'] = $request->roas_roas;
                    $data['chat'] = $request->chat_roas;
                    $data['respond'] = $request->chat_respond_roas;
                    $data['closing'] = $request->closing_roas;
                    break;

                case 'Total Closing':
                    $data['target_spent'] = $request->spent_total;
                    $data['target_leads'] = $request->leads_total;
                    $data['chat'] = $request->chat_total;
                    $data['respond'] = $request->respond_total;
                    $data['closing'] = $request->closing_total;
                    break;

                case 'Site Visits':
                    $data['target_spent'] = $request->spent_site;
                    $data['target_leads'] = $request->leads_site;
                    $data['chat'] = $request->chat_site;
                    $data['respond'] = $request->respond_site;
                    $data['closing'] = $request->closing_site;
                    break;
            }
        }

        $reports->update($data);

        return redirect()->route('laporan-bulanan.index', ['client_id' => $reports->client_id])
            ->with('success', 'Laporan bulanan berhasil diperbarui!');
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
