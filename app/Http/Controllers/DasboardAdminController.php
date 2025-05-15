<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientLayanan;
use Illuminate\Support\Facades\Auth;

class DasboardAdminController extends Controller
{
    public function dasboar_marketing()
    {
        $aktip = Client::where('status_client', 1)->count();
        $pending = Client::where('status_client', 2)->count();
        $nonaktip = Client::where('status_client', 3)->count();


        $monthNames = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $clientsPerMonth = Client::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, 
            SUM(CASE WHEN status_client = 1 THEN 1 ELSE 0 END) as active,
            SUM(CASE WHEN status_client = 2 THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status_client = 3 THEN 1 ELSE 0 END) as inactive')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc') // Mengurutkan berdasarkan tahun secara ascending
            ->orderBy('month', 'asc') // Mengurutkan berdasarkan bulan secara ascending
            ->get();
        // Mengubah angka bulan menjadi nama bulan dan menambahkan tahun
        $clientsPerMonth->transform(function ($item) use ($monthNames) {
            $item->month = $monthNames[$item->month - 1] . ' ' . $item->year; // Mengubah angka bulan menjadi nama bulan dan menambahkan tahun
            return $item;
        });

        if (Auth::user()->user_role_id == 5) { // Memeriksa apakah role_id user adalah 5
            return redirect()->route('clients.index'); // Redirect jika tidak memiliki akses
        }

        return view('marketlab.marketing.dashboard-market', compact(
            'aktip',
            'pending',
            'nonaktip',
            'clientsPerMonth',
        ));
    }
    public function dasboar_mb()
    {

        $mb_aktip = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 1)
                    ->where('status', 1);
            })
            ->count();
        $mb_pending = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 1)
                    ->where('status', 2);
            })
            ->count();
        $mb_nonaktip = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 1)
                    ->where('status', 3);
            })
            ->count();


        // Menghitung jumlah klien per bulan berdasarkan status
        $monthNames = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $mbClientsPerMonth = ClientLayanan::where('layanan_id', 1) // <-- tambahkan filter layanan MB
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, 
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as active,
                SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as inactive')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        $mbClientsPerMonth->transform(function ($item) use ($monthNames) {
            $item->month = $monthNames[$item->month - 1] . ' ' . $item->year;
            return $item;
        });

        return view('marketlab.client-mb.dashboard-mb', compact(
            'mb_aktip',
            'mb_pending',
            'mb_nonaktip',
            'mbClientsPerMonth'
        ));
    }
    public function dasboar_sa()
    {
        $sa_aktip = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 2)
                    ->where('status', 1);
            })
            ->count();
        $sa_pending = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 2)
                    ->where('status', 2);
            })
            ->count();
        $sa_nonaktip = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 2)
                    ->where('status', 3);
            })
            ->count();

        $monthNames = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $saClientsPerMonth = ClientLayanan::where('layanan_id', 2)
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, 
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as active,
                SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as inactive')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        $saClientsPerMonth->transform(function ($item) use ($monthNames) {
            $item->month = $monthNames[$item->month - 1] . ' ' . $item->year;
            return $item;
        });


        return view('marketlab.divisi-sa.dashboard-sa', compact(
            'sa_aktip',
            'sa_pending',
            'sa_nonaktip',
            'saClientsPerMonth'
        ));
    }

    public function index()
    {
        $aktip = Client::where('status_client', 1)->count();
        $pending = Client::where('status_client', 2)->count();
        $nonaktip = Client::where('status_client', 3)->count();

        $mb_aktip = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 1)
                    ->where('status', 1);
            })
            ->count();
        $mb_pending = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 1)
                    ->where('status', 2);
            })
            ->count();
        $mb_nonaktip = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 1)
                    ->where('status', 3);
            })
            ->count();

        $sa_aktip = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 2)
                    ->where('status', 1);
            })
            ->count();
        $sa_pending = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 2)
                    ->where('status', 2);
            })
            ->count();
        $sa_nonaktip = Client::where('status_client', 1)
            ->whereHas('client_layanan', function ($query) {
                $query->where('layanan_id', 2)
                    ->where('status', 3);
            })
            ->count();


        // Menghitung jumlah klien per bulan berdasarkan status
        $monthNames = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $clientsPerMonth = Client::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, 
            SUM(CASE WHEN status_client = 1 THEN 1 ELSE 0 END) as active,
            SUM(CASE WHEN status_client = 2 THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status_client = 3 THEN 1 ELSE 0 END) as inactive')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc') // Mengurutkan berdasarkan tahun secara ascending
            ->orderBy('month', 'asc') // Mengurutkan berdasarkan bulan secara ascending
            ->get();
        // Mengubah angka bulan menjadi nama bulan dan menambahkan tahun
        $clientsPerMonth->transform(function ($item) use ($monthNames) {
            $item->month = $monthNames[$item->month - 1] . ' ' . $item->year; // Mengubah angka bulan menjadi nama bulan dan menambahkan tahun
            return $item;
        });

        $mbClientsPerMonth = ClientLayanan::where('layanan_id', 1) // <-- tambahkan filter layanan MB
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, 
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as active,
                SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as inactive')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        $mbClientsPerMonth->transform(function ($item) use ($monthNames) {
            $item->month = $monthNames[$item->month - 1] . ' ' . $item->year;
            return $item;
        });

        $saClientsPerMonth = ClientLayanan::where('layanan_id', 2)
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, 
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as active,
                SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as inactive')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        $saClientsPerMonth->transform(function ($item) use ($monthNames) {
            $item->month = $monthNames[$item->month - 1] . ' ' . $item->year;
            return $item;
        });


        // Pengondisian untuk memeriksa role user
        if (Auth::user()->user_role_id == 5) { // Memeriksa apakah role_id user adalah 5
            return redirect()->route('clients.index'); // Redirect jika tidak memiliki akses
        }

        return view('dashboard', compact(
            'aktip',
            'pending',
            'nonaktip',
            'mb_aktip',
            'mb_pending',
            'mb_nonaktip',
            'clientsPerMonth',
            'mbClientsPerMonth',
            'sa_aktip',
            'sa_pending',
            'sa_nonaktip',
            'saClientsPerMonth'
        ));
    }
}
