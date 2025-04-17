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
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);
        $status = $request->input('status'); // Hapus default, biarkan status bisa 1, 2, atau 3

        $clients = Client::when($search, function ($query) use ($search) {
            return $query->where('nama_client', 'like', '%' . $search . '%')
                ->orWhere('nama_brand', 'like', '%' . $search . '%')
                ->orWhere('pj', 'like', '%' . $search . '%')
                ->orWhereHas('pegawai', function ($query) use ($search) { // Menggunakan relasi untuk pegawai
                    return $query->where('nama', 'like', '%' . $search . '%');
                });
        })
            ->when(in_array($status, [1, 2, 3]), function ($query) use ($status) { // Tambahkan filter untuk status 2 dan 3
                return $query->where('status_client', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // Mendapatkan halaman saat ini dan total halaman
        $currentPage = $clients->currentPage();
        $totalPages = $clients->lastPage();

        return view('marketlab.client.index', compact('clients', 'search', 'perPage', 'status', 'currentPage', 'totalPages'));
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
    public function store(Request $request) // Pastikan tipe parameter adalah Request
    {
        // dd($request->all());
        // Validasi data termasuk gambar
        $validatedData = $request->validate([
            'nama_client' => 'required|string',
            'nama_brand' => 'required|string',
            'informasi_tambahan' => 'nullable|string',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:clients,email', // Tambahkan validasi unique untuk email
            'nama_finance' => 'nullable|string',
            'pj' => 'required|string',
            'pegawai_id' => 'required|string',
            'telepon_finance' => 'nullable|string',
            'status_client' => 'required|string',
            'date_in' => 'required|date',
            'layanan' => 'nullable|array',
            'layanan.*' => 'exists:layanans,id',
            'gambar_client' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Buat data client tanpa gambar terlebih dahulu
        $client = Client::create($request->only('nama_client', 'nama_brand', 'informasi_tambahan', 'alamat', 'email', 'nama_finance', 'pj', 'pegawai_id', 'telepon_finance', 'status_client', 'date_in'));

        // Upload gambar jika ada
        if ($request->hasFile('gambar_client')) {
            $path = $request->file('gambar_client')->store('client_images', 'public'); // Simpan gambar di folder public/storage/client_images
            $client->gambar_client = $path; // Simpan path gambar ke dalam kolom gambar_client
            $client->save(); // Simpan perubahan pada client setelah menyimpan gambar
        }

        // Buat data user baru
        $user = User::create([
            'name' => $client->nama_brand, // Menggunakan nama_brand sebagai username
            'password' => bcrypt($client->nama_brand), // Menggunakan nama_brand sebagai password yang di-hash
            'user_role_id' => 6, // Mengatur role user ke 2
            'email' => $client->email, // Menambahkan email dari client
            'logo' => $client->gambar_client // Menambahkan gambar dari client
        ]);

        // Simpan user_id ke client
        $client->user_id = $user->id;
        $client->save(); // Simpan client setelah user_id diset

        // Simpan layanan yang dipilih ke tabel client_layanan
        if ($request->has('layanan')) {
            foreach ($request->layanan as $layananId) {
                ClientLayanan::create([
                    'client_id' => $client->id,
                    'layanan_id' => $layananId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Sinkronisasi layanan
        $client->layanan()->sync($request->layanan);

        return redirect()->route('clients.index')->with('success', 'Client berhasil ditambahkan.');
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
        // dd($request->all());
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
            'layanan' => 'required|array', // Pastikan ini sesuai dengan multiple select checkbox layanan
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
                $user->logo = $path; // Update logo
                $user->save(); // Simpan perubahan
            }
        }

        // Simpan perubahan data client, termasuk gambar
        $client->save();

        // Sinkronisasi layanan yang dipilih
        $client->layanan()->sync($request->layanan);

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
