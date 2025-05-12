<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Layanan;
use App\Models\ClientLayanan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
// use Symfony\Component\HttpFoundation\Request;
use App\Models\User; // Added import for User model
use Illuminate\Http\Request; // Pastikan ini ada di bagian atas file
use App\Models\Pegawai;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = request('status', 1); // Default status 1 (aktif)

        $clients = Client::with(['pegawai', 'layanan'])
            ->where('status_client', $status)
            ->orderBy('created_at', 'desc')
            ->when(request('brand'), function ($query) {
                $query->where('nama_brand', 'like', '%' . request('brand') . '%');
            })
            ->when(request('date_aktif'), function ($query) {
                $query->whereDate('date_in', request('date_aktif'));
            })
            ->paginate(10)
            ->withQueryString(); // Pertahankan semua parameter

        $pegawai = Pegawai::all();
        $layanans = Layanan::all();

        return view('marketlab.client.index', compact('clients', 'pegawai', 'layanans', 'status'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $layanans = Layanan::all();
        $pegawai = Pegawai::all();
        return view('marketlab.client.create', compact('layanans', 'pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data termasuk gambar
        $validatedData = $request->validate([
            'nama_client' => 'required|string',
            'nama_brand' => 'required|string',
            'informasi_tambahan' => 'nullable|string',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:clients,email|unique:users,email', // email unik di 2 tabel
            'nama_finance' => 'nullable|string',
            'pj' => 'required|string',
            'pegawai_id' => 'required|string',
            'telepon_finance' => 'nullable|string',
            'status_client' => 'required|string',
            'date_in' => 'required|date',
            'gambar_client' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar_client')) {
            $gambarPath = $request->file('gambar_client')->store('client_images', 'public');
        }

        // 1️⃣ Buat data client
        $client = Client::create([
            'nama_client' => $validatedData['nama_client'],
            'nama_brand' => $validatedData['nama_brand'],
            'informasi_tambahan' => $validatedData['informasi_tambahan'] ?? null,
            'alamat' => $validatedData['alamat'],
            'email' => $validatedData['email'],
            'nama_finance' => $validatedData['nama_finance'] ?? null,
            'pj' => $validatedData['pj'],
            'pegawai_id' => $validatedData['pegawai_id'],
            'telepon_finance' => $validatedData['telepon_finance'] ?? null,
            'status_client' => $validatedData['status_client'],
            'date_in' => $validatedData['date_in'],
            'gambar_client' => $gambarPath,
        ]);

        // 2️⃣ Buat akun user otomatis
        $user = User::create([
            'name' => $client->nama_brand,
            'email' => $client->email,
            'password' => bcrypt($client->nama_brand), // default password (bisa diubah nanti)
            'user_role_id' => 6, // Role khusus client
            'logo' => $gambarPath,
        ]);

        // 3️⃣ Simpan user_id ke client
        $client->user_id = $user->id;
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client dan akun berhasil dibuat.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil semua layanan yang tersedia untuk ditampilkan di form
        $clients = Client::find($id);
        $layanans = Layanan::all();
        $pegawai = Pegawai::all();

        // Kembalikan view untuk mengedit client, dengan data client dan layanan yang tersedia
        return view('marketlab.client.update', compact('clients', 'layanans', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Ambil data client berdasarkan ID
        $client = Client::findOrFail($id);

        // Validasi data termasuk gambar
        $validatedData = $request->validate([
            'nama_client' => 'required|string|max:255',
            'nama_brand' => 'nullable|string|max:255',
            'informasi_tambahan' => 'nullable|string',
            'alamat' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'nama_finance' => 'nullable|string|max:255',
            'telepon_finance' => 'nullable|string|max:15',
            'status_client' => 'required|string|max:50',
            'pj' => 'required|string|max:50',
            'pegawai_id' => 'required|string|max:20',
            'date_in' => 'required|date',
            'gambar_client' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Update data client tanpa memperbarui gambar terlebih dahulu
        $client->update($request->only('nama_client', 'nama_brand', 'informasi_tambahan', 'alamat', 'email', 'nama_finance', 'telepon_finance', 'status_client', 'date_in', 'pj', 'pegawai_id'));

        // Cek apakah ada gambar yang diupload
        if ($request->hasFile('gambar_client')) {
            // Hapus gambar lama jika ada
            if ($client->gambar_client && Storage::exists('public/' . $client->gambar_client)) {
                if (!Storage::delete('public/' . $client->gambar_client)) {
                    return redirect()->back()->with('error', 'Gagal menghapus gambar lama.');
                }
            }

            // Simpan gambar baru
            $path = $request->file('gambar_client')->store('client_images', 'public');
            if (!$path) {
                return redirect()->back()->with('error', 'Gagal menyimpan gambar baru.');
            }
            $client->gambar_client = $path;

            // Update logo di tabel user
            $user = User::find($client->user_id); // Ambil user terkait
            if ($user) {
                // Hapus logo lama di user jika ada
                if ($user->logo && Storage::exists('public/' . $user->logo)) {
                    Storage::delete('public/' . $user->logo);
                }
                $user->logo = $path; // Update logo
                $user->save(); // Simpan perubahan
            }
        }

        // Simpan perubahan data client, termasuk gambar
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Data client berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }

    public function layanans()
    {
        return $this->belongsToMany(Layanan::class, 'client_layanan')
            ->withPivot('status', 'created_at')
            ->withTimestamps();
    }
}
