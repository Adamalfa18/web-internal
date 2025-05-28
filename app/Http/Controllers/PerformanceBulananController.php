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
        // Validasi data yang diterima
        // dd($request);
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'target_spent' => 'required|string',
            'target_revenue' => 'required|string',
            'target_roas' => 'required|string',
            'report_date' => 'required|string', // {{ edit_1 }} Menambahkan format tanggal
            'note' => 'required|string',
        ]);

        // Ambil data client berdasarkan client_id
        $client = Client::find($request->client_id); // {{ edit_1 }}

        // Buat laporan bulanan baru
        $report = PerformanceBulanan::create([
            'client_id' => $request->client_id,
            'target_spent' => $request->target_spent,
            'target_revenue' => $request->target_revenue,
            'target_roas' => $request->target_roas,
            'report_date' => $request->report_date,
            'note' => $request->note,
        ]);

        if ($report) {
            return redirect()->route('laporan-bulanan.index', ['client_id' => $client->id])
                ->with('success', 'Laporan bulanan berhasil dibuat!');
        } else {
            return redirect()->back()->with('error', 'The monthly report failed to be made!');
        }
        // return response()->json([
        //     'message' => 'Laporan bulanan berhasil dibuat!',
        //     // 'data' => $report,
        // ], 201);
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
        // Validate the incoming request data
        // dd($request);
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'target_spent' => 'required|string',
            'target_revenue' => 'required|string',
            'target_roas' => 'required|string',
            'report_date' => 'required|string', // Adding date format
            'note' => 'required|string',
        ]);
        // dd($validatedData);
        // Retrieve the Performa instance by ID
        $client = Client::find($request->client_id);
        $reports = PerformanceBulanan::findOrFail($id);

        // Update the Performa instance with validated data
        $reports->update([
            'client_id' => $validatedData['client_id'],
            'target_spent' => $validatedData['target_spent'],
            'target_revenue' => $validatedData['target_revenue'],
            'target_roas' => $validatedData['target_roas'],
            'report_date' => $validatedData['report_date'], // Adding date format
            'note' => $validatedData['note'],
        ]);

        // Redirect based on whether the update was successful
        if ($reports) {
            return redirect()->route('laporan-bulanan.index', ['client_id' => $client->id])
                ->with('success', 'Laporan bulanan berhasil diperbarui!'); // Optional success message
        } else {
            return redirect()->back()->with('error', 'Monthly report failed to be updated!');
        }
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
