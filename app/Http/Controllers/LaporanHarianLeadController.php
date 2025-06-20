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
            '1' => ['hari', 'spent', 'leads', 'chat', 'greeting', 'pricelist', 'discuss'],
            '2' => ['hari', 'spent', 'revenue', 'roas', 'chat', 'respond', 'closing'],
            '3' => ['hari', 'spent', 'leads', 'chat', 'respond', 'closing'],
            '4' => ['hari', 'spent', 'leads', 'respond', 'closing'],
            default => ['hari', 'spent', 'leads', 'chat', 'respond'],
        };

        $leads = Lead::where('performance_bulanan_id', $performance_bulanan_id)->get();

        return view('marketlab.performa-harian.index-lead', compact('report', 'leads', 'fields'));
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

}
