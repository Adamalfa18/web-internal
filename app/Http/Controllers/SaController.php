<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use App\Models\SocialMedia;

class SaController extends Controller
{
    public function indexList()
    {
        $clients = Client::all();
        // $social_media = SocialMedia::all();
        return view('marketlab.divisi-sa.list-client-sa', compact('clients'));
    }

    public function index($client_id)
    {
        $clients = Client::all();

        $client = Client::findOrFail($client_id); // <-- ini yang penting

        $social_media = SocialMedia::where('client_id', $client_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('marketlab.divisi-sa.index', compact('social_media', 'clients', 'client', 'client_id'));
    }

    public function store(Request $request, $client_id)
    {
        try {
            // Debug: Periksa apakah file dikirimkan
            \Log::info('Files received: ', ['files' => $request->file('content')]);

            // Validasi input
            $validatedData = $request->validate([
                'caption' => 'required|string',
                'created_at' => 'nullable|date',
                'content' => 'required|array',
                'content.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,mov,webm|max:51200',
            ]);

            $tanggal = $validatedData['created_at'] ?? now();
            $uploadedFiles = $request->file('content');
            if ($uploadedFiles && is_array($uploadedFiles)) {
                foreach ($uploadedFiles as $file) {
                    if ($file) {
                        $path = $file->store('social_media', 'public');

                        // Simpan ke tabel social_media
                        $post = SocialMedia::create([
                            'client_id' => $client_id,
                            'caption' => $validatedData['caption'],
                            'content' => $path,
                            'created_at' => $tanggal,
                        ]);

                        // Simpan ke tabel post_media
                        PostMedia::create([
                            'post_id' => $post->id,
                            'post' => $path,
                        ]);
                    }
                }
            }


            return redirect()->back()->with('success', 'Post berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error("Error saat menyimpan post: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan post.');
        }
    }


    public function showProfile()
    {
        $socialMedias = SocialMedia::all(); // atau bisa di-filter sesuai kebutuhan
        return view('profile.show', compact('socialMedias'));
    }
}
