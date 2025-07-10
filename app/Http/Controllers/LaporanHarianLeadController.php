<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerformanceBulanan;
use App\Models\Lead;

class LaporanHarianLeadController extends Controller
{
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

        // Total untuk chart funnel (khusus jenis_leads F to F)
        $totals = [
            'Leads'     => $leads->sum('leads'),
            'Chat'      => $leads->sum('chat'),
            'Greeting'  => $leads->sum('greeting'),
            'Pricelist' => $leads->sum('pricelist'),
            'Discuss'   => $leads->sum('discuss'),
        ];

        return view('marketlab.performa-harian.index-lead', compact('report', 'leads', 'fields', 'totals'));
    }


    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'performance_bulanan_id' => 'required|exists:performance_bulanans,id',
            'report_date' => 'required|date',
            'spent' => 'nullable',
            'leads' => 'nullable',
            'revenue' => 'nullable',
            'chat' => 'nullable',
            'greeting' => 'nullable',
            'pricelist' => 'nullable',
            'discuss' => 'nullable',
            'respond' => 'nullable',
            'closing' => 'nullable',
            'site_visits' => 'nullable',
            'roas' => 'nullable',
            'cpl' => 'nullable',
            'cpc' => 'nullable',
            'cr_leads_chat' => 'nullable',
            'cr_chat_respond' => 'nullable',
            'cr_respond_closing' => 'nullable',
            'cr_respond_site_visit' => 'nullable',
            'note' => 'required|string',
        ]);

        // Mapping data sesuai kolom DB
        $data = [
            'performance_bulanan_id' => $validated['performance_bulanan_id'],
            'hari' => $validated['report_date'],
            'spent' => $validated['spent'] ?? null,
            'leads' => $validated['leads'] ?? null,
            'revenue' => $validated['revenue'] ?? null,
            'chat' => $validated['chat'] ?? null,
            'greeting' => $validated['greeting'] ?? null,
            'pricelist' => $validated['pricelist'] ?? null,
            'discuss' => $validated['discuss'] ?? null,
            'respond' => $validated['respond'] ?? null,
            'closing' => $validated['closing'] ?? null,
            'site_visit' => $validated['site_visits'] ?? null,
            'roas' => $validated['roas'] ?? null,
            'cpl' => $validated['cpl'] ?? null,
            'cpc' => $validated['cpc'] ?? null,
            'cr_leads_to_chat' => $validated['cr_leads_chat'] ?? null,
            'cr_chat_to_respond' => $validated['cr_chat_respond'] ?? null,
            'cr_respond_to_closing' => $validated['cr_respond_closing'] ?? null,
            'cr_respond_to_site_visit' => $validated['cr_respond_site_visit'] ?? null,
            'note' => $validated['note'],
        ];

        // Simpan ke database
        Lead::create($data);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'report_date' => 'required|date',
            'spent' => 'nullable|numeric',
            'revenue' => 'nullable|numeric',
            'roas' => 'nullable|numeric',
            'leads' => 'nullable|numeric',
            'chat' => 'nullable|numeric',
            'respond' => 'nullable|numeric',
            'greeting' => 'nullable|numeric',
            'pricelist' => 'nullable|numeric',
            'discuss' => 'nullable|numeric',
            'closing' => 'nullable|numeric',
            'site_visit' => 'nullable|numeric',
            'cpl' => 'nullable|numeric',
            'cpc' => 'nullable|numeric',
            'cr_leads_to_chat' => 'nullable|numeric',
            'cr_chat_to_respond' => 'nullable|numeric',
            'cr_respond_to_closing' => 'nullable|numeric',
            'cr_respond_to_site_visit' => 'nullable|numeric',
            'note' => 'nullable|string'
        ]);

        $lead = Lead::findOrFail($id);

        $lead->update([
            'hari' => $request->report_date,
            'spent' => $request->spent,
            'revenue' => $request->revenue,
            'roas' => $request->roas,
            'leads' => $request->leads,
            'chat' => $request->chat,
            'respond' => $request->respond,
            'greeting' => $request->greeting,
            'pricelist' => $request->pricelist,
            'discuss' => $request->discuss,
            'closing' => $request->closing,
            'site_visit' => $request->site_visit,
            'cpl' => $request->cpl,
            'cpc' => $request->cpc,
            'cr_leads_to_chat' => $request->cr_leads_chat,
            'cr_chat_to_respond' => $request->cr_chat_respond,
            'cr_respond_to_closing' => $request->cr_respond_closing,
            'cr_respond_to_site_visit' => $request->cr_respond_site_visit,
            'note' => $request->note,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }
}
