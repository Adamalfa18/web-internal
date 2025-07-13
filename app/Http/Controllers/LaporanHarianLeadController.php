<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerformanceBulanan;
use App\Models\Lead;

class LaporanHarianLeadController extends Controller
{
    // public function index(Request $request)
    // {
    //     $performance_bulanan_id = $request->performance_bulanan_id;
    //     $report = PerformanceBulanan::findOrFail($performance_bulanan_id);

    //     // Ambil jenis_leads langsung dari database
    //     $jenis_lead = match ($report->jenis_leads) {
    //         'F to F' => '1',
    //         'Roas Revenue' => '2',
    //         'Total Closing' => '3',
    //         'Site Visits' => '4',
    //         default => '0',
    //     };

    //     $fields = match ($jenis_lead) {
    //         '1' => ['hari', 'spent', 'leads', 'chat', 'greeting', 'pricelist', 'discuss', 'note'],
    //         '2' => ['hari', 'spent', 'revenue', 'roas', 'chat', 'respond', 'closing', 'note'],
    //         '3' => ['hari', 'spent', 'leads', 'chat', 'respond', 'closing'],
    //         '4' => ['hari', 'spent', 'leads', 'respond', 'closing', 'note'],
    //         default => ['hari', 'spent', 'leads', 'chat', 'respond', 'note'],
    //     };

    //     // Ambil semua leads
    //     $leads = Lead::where('performance_bulanan_id', $performance_bulanan_id)->get();

    //     $scale = [60, 50, 40, 30, 20, 10];
    //     // Total untuk chart funnel (khusus jenis_leads F to F)
    //     $totals = [
    //         'Leads'     => $leads->sum('leads'),
    //         'Chat'      => $leads->sum('chat'),
    //         'Greeting'  => $leads->sum('greeting'),
    //         'Pricelist' => $leads->sum('pricelist'),
    //         'Discuss'   => $leads->sum('discuss'),
    //     ];

    //     $totall = [
    //         'Impresi'     => $leads->sum('impresi'),
    //         'Click'  => $leads->sum('click'),
    //         'Chat'      => $leads->sum('chat'),
    //         'Respond' => $leads->sum('respond'),
    //         'Closing'   => $leads->sum('closing'),
    //     ];

    //     $totalImpresi = $totall['Impresi'] ?: 1; // hindari division by zero
    //     $persentase = [
    //         'Impresi' => 100,
    //         'Click'   => round(($totall['Click'] / $totalImpresi) * 100, 2),
    //         'Chat'    => round(($totall['Chat'] / $totall['Click']) * 100, 2),
    //         'Respond' => round(($totall['Respond'] / ($totall['Chat'] ?: 1)) * 100, 2),
    //         'Closing' => round(($totall['Closing'] / ($totall['Respond'] ?: 1)) * 100, 2),
    //     ];

    //     $totals_scaled = [];
    //     $keys = array_keys($totall);
    //     foreach ($keys as $i => $key) {
    //         $totals_scaled[$key] = $scale[$i] ?? 10; // fallback kecil
    //     }
    //     $funnelLabels = [];
    //     foreach ($totall as $key => $value) {
    //         $funnelLabels[] = "{$key}: {$value} (" . ($persentase[$key] ?? 0) . "%)";
    //     }

    //     return view('marketlab.performa-harian.index-lead', compact('funnelLabels', 'report', 'leads', 'fields', 'totals', 'totall', 'totals_scaled'));
    // }
    public function index(Request $request)
    {
        $performance_bulanan_id = $request->performance_bulanan_id;
        $report = PerformanceBulanan::findOrFail($performance_bulanan_id);

        // Ambil jenis_leads langsung dari database
        $jenis_lead = match ($report->jenis_leads) {
            'F to F' => '1',
            'Roas Revenue' => '2',
            'Total Closing' => '3',
            'Site Visits' => '4',
            default => '0',
        };

        $fields = match ($jenis_lead) {
            '1' => ['hari', 'spent', 'leads', 'chat', 'greeting', 'pricelist', 'discuss', 'note'],
            '2' => ['hari', 'spent', 'revenue', 'roas', 'chat', 'respond', 'closing', 'note'],
            '3' => ['hari', 'spent', 'leads', 'chat', 'respond', 'closing'],
            '4' => ['hari', 'spent', 'leads', 'respond', 'closing', 'note'],
            default => ['hari', 'spent', 'leads', 'chat', 'respond', 'note'],
        };

        // Ambil semua leads
        $leads = Lead::where('performance_bulanan_id', $performance_bulanan_id)->get();

        // Jika data leads kosong, return view kosong agar aman
        if ($leads->isEmpty()) {
            return view('marketlab.performa-harian.index-lead', [
                'funnelLabels' => [],
                'report' => $report,
                'leads' => $leads,
                'fields' => $fields,
                'totals' => [],
                'totall' => [],
                'totals_scaled' => [],
            ]);
        }

        // Skala untuk chart funnel
        $scale = [60, 50, 40, 30, 20, 10];

        // Total untuk chart F to F
        $totals = [
            'Leads'     => $leads->sum('leads'),
            'Chat'      => $leads->sum('chat'),
            'Greeting'  => $leads->sum('greeting'),
            'Pricelist' => $leads->sum('pricelist'),
            'Discuss'   => $leads->sum('discuss'),
        ];

        // Total untuk chart umum
        $totall = [
            'Impresi'   => $leads->sum('impresi'),
            'Click'     => $leads->sum('click'),
            'Chat'      => $leads->sum('chat'),
            'Respond'   => $leads->sum('respond'),
            'Closing'   => $leads->sum('closing'),
        ];

        // Hitung persentase funnel (hindari division by zero)
        $totalImpresi = $totall['Impresi'] ?: 1;
        $totalClick = $totall['Click'] ?: 1;
        $totalChat = $totall['Chat'] ?: 1;
        $totalRespond = $totall['Respond'] ?: 1;

        $persentase = [
            'Impresi' => 100,
            'Click'   => round(($totall['Click'] / $totalImpresi) * 100, 2),
            'Chat'    => round(($totall['Chat'] / $totalClick) * 100, 2),
            'Respond' => round(($totall['Respond'] / $totalChat) * 100, 2),
            'Closing' => round(($totall['Closing'] / $totalRespond) * 100, 2),
        ];

        // Hitung skala tampilan funnel
        $totals_scaled = [];
        $keys = array_keys($totall);
        foreach ($keys as $i => $key) {
            $totals_scaled[$key] = $scale[$i] ?? 10;
        }

        // Label funnel: Impresi: 1000 (100%), Click: 400 (40%), dst.
        $funnelLabels = [];
        foreach ($totall as $key => $value) {
            $funnelLabels[] = "{$key}: {$value} (" . ($persentase[$key] ?? 0) . "%)";
        }

        return view('marketlab.performa-harian.index-lead', compact(
            'funnelLabels',
            'report',
            'leads',
            'fields',
            'totals',
            'totall',
            'totals_scaled'
        ));
    }


    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'performance_bulanan_id' => 'required|exists:performance_bulanans,id',
            'report_date' => 'required|date',
            'platform' => 'required|string',
            'spent' => 'nullable',
            'impresi' => 'nullable|numeric',
            'click' => 'nullable|numeric',
            'leads' => 'nullable',
            'revenue' => 'nullable',
            'chat' => 'nullable',
            'greeting' => 'nullable',
            'pricelist' => 'nullable',
            'discuss' => 'nullable',
            'respond' => 'nullable',
            'closing' => 'nullable',
            'site_visit' => 'nullable',
            'roas' => 'nullable',
            'cpl' => 'nullable',
            'cpc' => 'nullable',
            'cr_leads_chat' => 'nullable',
            'cr_chat_respond' => 'nullable',
            'cr_respond_closing' => 'nullable',
            'cr_respond_site_visit' => 'nullable',
            'note' => 'required|string',
        ]);

        // Bersihkan semua nilai numerik dari karakter selain angka
        $clean = fn($val) => $val !== null ? (is_numeric($val) ? $val : preg_replace('/[^\d]/', '', $val)) : null;
        // Mapping data sesuai kolom DB
        $data = [
            'performance_bulanan_id' => $validated['performance_bulanan_id'],
            'hari' => $validated['report_date'],
            'platform' => $validated['platform'],
            'spent' => $clean($validated['spent']) ?? null,
            'impresi' => $clean($validated['impresi']) ?? null,
            'click' => $clean($validated['click']) ?? null,
            'leads' => $clean($validated['leads']) ?? null,
            'revenue' => $clean($validated['revenue']) ?? null,
            'chat' => $clean($validated['chat']) ?? null,
            'greeting' => $clean($validated['greeting']) ?? null,
            'pricelist' => $clean($validated['pricelist']) ?? null,
            'discuss' => $clean($validated['discuss']) ?? null,
            'respond' => $clean($validated['respond']) ?? null,
            'closing' => $clean($validated['closing']) ?? null,
            'site_visit' => $clean($validated['site_visit']) ?? null,
            'roas' => $clean($validated['roas']) ?? null,
            'cpl' => $clean($validated['cpl']) ?? null,
            'cpc' => $clean($validated['cpc']) ?? null,
            'cr_leads_to_chat' => $clean($validated['cr_leads_chat']) ?? null,
            'cr_chat_to_respond' => $clean($validated['cr_chat_respond']) ?? null,
            'cr_respond_to_closing' => $clean($validated['cr_respond_closing']) ?? null,
            'cr_respond_to_site_visit' => $clean($validated['cr_respond_site_visit']) ?? null,
            'note' => $validated['note'],
        ];

        // Simpan ke database
        Lead::create($data);

        return redirect()->back()->with('success', 'Data added successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'performance_bulanan_id' => 'required|exists:performance_bulanans,id',
            'report_date' => 'required|date',
            'platform' => 'required|string',
            'spent' => 'nullable',
            'impresi' => 'nullable|numeric',
            'click' => 'nullable|numeric',
            'leads' => 'nullable',
            'revenue' => 'nullable',
            'chat' => 'nullable',
            'greeting' => 'nullable',
            'pricelist' => 'nullable',
            'discuss' => 'nullable',
            'respond' => 'nullable',
            'closing' => 'nullable',
            'site_visit' => 'nullable',
            'roas' => 'nullable',
            'cpl' => 'nullable',
            'cpc' => 'nullable',
            'cr_leads_chat' => 'nullable',
            'cr_chat_respond' => 'nullable',
            'cr_respond_closing' => 'nullable',
            'cr_respond_site_visit' => 'nullable',
            'note' => 'required|string',
        ]);

        $clean = fn($val) => $val !== null ? (is_numeric($val) ? $val : preg_replace('/[^\d]/', '', $val)) : null;
        $lead = Lead::findOrFail($id);

        $lead->update([
            'hari' => $request->report_date,
            'platform' => $request->platform,
            'spent' => $clean($request->spent),
            'impresi' => $clean($request->impresi),
            'click' => $clean($request->click),
            'revenue' => $clean($request->revenue),
            'roas' => $clean($request->roas),
            'leads' => $clean($request->leads),
            'chat' => $clean($request->chat),
            'respond' => $clean($request->respond),
            'greeting' => $clean($request->greeting),
            'pricelist' => $clean($request->pricelist),
            'discuss' => $clean($request->discuss),
            'closing' => $clean($request->closing),
            'site_visit' => $clean($request->site_visit),
            'cpl' => $clean($request->cpl),
            'cpc' => $clean($request->cpc),
            'cr_leads_to_chat' => $clean($request->cr_leads_chat),
            'cr_chat_to_respond' => $clean($request->cr_chat_respond),
            'cr_respond_to_closing' => $clean($request->cr_respond_closing),
            'cr_respond_to_site_visit' => $clean($request->cr_respond_site_visit),
            'note' => $request->note,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }


    public function destroy($id)
    {
        // cari data
        $lead = Lead::findOrFail($id);

        // hapus data
        $lead->delete();

        // redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data has been successfully deleted.');
    }
}
