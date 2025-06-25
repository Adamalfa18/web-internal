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
        $jenis_lead = match($report->jenis_leads) {
            'F to F' => '1',
            'Roas Revenue' => '2',
            'Total Closing' => '3',
            'Site Visits' => '4',
            default => '0',
        };

        $fields = match($jenis_lead) {
            '1' => ['hari', 'spent', 'leads', 'chat', 'greeting', 'pricelist', 'discuss', 'note'],
            '2' => ['hari', 'spent', 'revenue', 'roas', 'chat', 'respond', 'closing', 'note'],
            '3' => ['hari', 'spent', 'leads', 'chat', 'respond', 'closing'],
            '4' => ['hari', 'spent', 'leads', 'respond', 'closing', 'note'],
            default => ['hari', 'spent', 'leads', 'chat', 'respond','note'],
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
       $data = $request->only([
            'performance_bulanan_id', 'hari', 'spent', 'revenue', 'roas', 'leads',
            'chat', 'respond', 'greeting', 'pricelist', 'discuss', 'closing','note'
        ]);

        Lead::create($data);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'performance_bulanan_id', 'hari', 'spent', 'revenue', 'roas', 'leads',
            'chat', 'respond', 'greeting', 'pricelist', 'discuss', 'closing', 'note'
        ]);

        $lead = Lead::findOrFail($id);
        $lead->update($data);

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

}
