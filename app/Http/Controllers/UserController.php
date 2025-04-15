<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     // Tambahkan middleware untuk memeriksa user role
    //     $this->middleware(function ($request, $next) {
    //         $userRole = auth()->user()->user_role_id; // Ambil user role dari user yang sedang login
            
    //         // Cek akses untuk role 3, 4, dan 5, kecuali role 1
    //         if (in_array($userRole, [3, 4, 5]) && $userRole != 1) {
    //             return redirect()->route('acount.index')->with('error', 'Anda tidak memiliki akses ke halaman ini.'); // Redirect jika role 3, 4, atau 5
    //         }
    //         return $next($request);
    //     });

    //     // Tambahkan middleware khusus untuk fungsi destroy
    //     $this->middleware('can:destroy-user', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $users = User::with('user_role')->get(); // Menggunakan eager loading untuk menghindari N+1
        $rool = UserRole::all();
        return view('marketlab.users.index', compact('users', 'rool'));
        // return view('laravel-examples.users-management', compact('users'));
    }

    public function create()
    {
        $rool = UserRole::all();
        return view('marketlab.users.create', compact('rool'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required', 'min:1', 'max:255', 'unique:users,id'], // Pastikan validasi unik untuk kolom 'id'
            'name' => ['required', 'min:3', 'max:255', 'unique:users,name'],
            'email' => ['required', 'min:3', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:2', 'max:255'],
            'user_role_id' => ['required'],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        
        if ($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('client_images', 'public'); // Simpan path logo
        }

        User::create($validatedData);

        // Tambahkan logika untuk memperbarui tabel logo_client
        if ($request->hasFile('logo')) {
            // Cek apakah user memiliki relasi dengan tabel clients
            $existingClient = DB::table('clients')->where('user_id', $validatedData['id'])->first();
            if ($existingClient) { // Pastikan ada relasi
                // Hapus logo sebelumnya jika ada
                if ($existingClient->gambar_client) {
                    Storage::disk('public')->delete($existingClient->gambar_client); // Hapus file logo sebelumnya
                }
                // Update logo di tabel client
                DB::table('clients')->updateOrInsert(
                    ['user_id' => $validatedData['id']],
                    ['gambar_client' => $validatedData['logo']]
                );
            }
        }

        return redirect()->route('acount.index'); // Perbaiki typo 'acount' menjadi 'account'
    }

    public function edit($id)
    {
        $users = User::find($id);
        $rool = UserRole::all();
        return view('marketlab.users.update-acount', compact('rool','users'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data (hapus validasi 'id' agar bisa diubah)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|exists:user_roles,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahkan validasi untuk logo
        ]);

        // Cari user berdasarkan ID
        $user = User::find($id);

        // Jika ID baru berbeda dengan yang lama, lakukan perubahan manual di database
        if ($user->id != $request->input('id')) {
            // Pastikan id yang baru tidak digunakan oleh user lain
            $request->validate([
                'id' => 'required|unique:users,id',
            ]);

            // Update ID di database secara langsung
            DB::table('users')
                ->where('id', $user->id)
                ->update(['id' => $request->input('id')]);
            
            // Setelah ID diubah, perlu untuk memperbarui instance user dengan ID yang baru
            $user = User::find($request->input('id'));
        }

        // Update data user lainnya
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->user_role_id = $request->input('role');

        // Tambahkan logika untuk mengubah logo
        if ($request->hasFile('logo')) {
            // Hapus logo sebelumnya jika ada
            if ($user->logo) {
                Storage::disk('public')->delete($user->logo); // Hapus file logo sebelumnya
            }
            $user->logo = $request->file('logo')->store('client_images', 'public'); // Simpan path logo
            // Update logo di tabel client jika ada
            DB::table('clients')->where('user_id', $user->id)->update(['gambar_client' => $user->logo]); // Ubah logo di tabel client
        }

        $user->save();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('acount.index')->with('success', 'User updated successfully.');
    }
    public function resetPassword(Request $request, $id)
    {
        // dd($request);
        // Validasi input
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required', // pastikan password dan password_confirmation cocok
        ]);
        // dd($request);

        // Cari user berdasarkan ID
        $user = User::find($id);

        // Update password dengan yang baru (harus di-hash)
        $user->id = $request->input('id');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect atau kirim pesan sukses
        return redirect()->route('acount.index')->with('success', 'Password berhasil direset!');
    

    }
    public function destroy($id)
    {
        // Cek role sebelum menghapus user
        $userRole = auth()->user()->user_role_id;

        // Cek role sebelum menghapus user
        if ($userRole != 1) {
            return redirect()->route('acount.index')->with('error', 'Anda tidak memiliki akses untuk menghapus akun.');
        }

        // Cari user berdasarkan ID
        $user = User::find($id);

        // Hapus data gambar jika user role id adalah 1, 2, 3, 4, atau 5
        if (in_array($user->user_role_id, [1, 2, 3, 4, 5])) {
            // Hapus file logo dari storage
            if ($user->logo) {
                Storage::disk('public')->delete($user->logo);
            }
        }

        // Hapus user
        User::destroy($user->id);

        // Mengatur ulang auto-increment setelah menghapus
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;'); // Atur ulang auto-increment ke 1

        return redirect()->route('acount.index')->with('success', 'Akun berhasil dihapus!');
    }

    
}
