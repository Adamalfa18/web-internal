<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientLayanan;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Storage;

class SaController extends Controller
{
    public function indexList()
    {
        $clients = Client::whereHas('client_layanan', function ($query) {
            $query->where('layanan_id', 2); // Ambil hanya client dengan layanan_id = 2
        })
            ->with(['client_layanan' => function ($query) {
                $query->where('layanan_id', 2); // Ambil hanya layanan_id = 2 di relasi
            }])
            ->get();

        // Inject status_layanan dari layanan_id = 2
        $clients->each(function ($client) {
            $client->status_layanan = optional($client->client_layanan->first())->status;
        });

        return view('marketlab.divisi-sa.list-client-sa', compact('clients'));
    }


    public function index($client_id)
    {
        $clients = Client::all();
        $client = Client::findOrFail($client_id);

        $posts = SocialMedia::with('media')
            ->where('client_id', $client_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $post_medias = collect([]);
        foreach ($posts as $post) {
            $media = PostMedia::with('postingan') // <-- Tambahkan ini supaya relasi 'post' ikut di-load
                ->where('post_id', $post->id)
                ->orderBy('created_at', 'asc')
                ->first();
            if ($media) {
                $post_medias->push($media);
            }
        }

        return view('marketlab.divisi-sa.index', compact('posts', 'post_medias', 'clients', 'client', 'client_id'));
    }

    public function store(Request $request, $client_id)
    {
        $request->validate([
            'caption' => 'required|string',
            'created_at' => 'required|date',
            'content_media' => 'nullable|array',
            'content_media.*' => 'file|mimes:webp,webm|max:20480'
        ]);
        // Simpan data ke social_media
        $social = SocialMedia::create([
            'caption' => $request->caption,
            'status' => '0', // default
            'note' => null,
            'client_id' => $client_id,
            'created_at' => $request->created_at,
            'updated_at' => now(),
        ]);

        // Upload dan simpan file media jika ada
        if ($request->hasFile('content_media')) {
            foreach ($request->file('content_media') as $file) {
                $path = $file->store('media', 'public');
                $filename = basename($path);

                PostMedia::create([
                    'post_id' => $social->id,
                    'post' => $filename,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $client_id, $post_id)
    {
        // Validasi data
        $request->validate([
            'caption' => 'required|string',
            'created_at' => 'required|date',
            'content_media.*' => 'nullable|file|mimes:webp,webm|max:20480', // max 20MB per file
        ]);

        // Temukan post berdasarkan post_id dan client_id
        $post = SocialMedia::where('client_id', $client_id)->where('id', $post_id)->firstOrFail();

        // Update data dasar
        $post->caption = $request->caption;
        $post->created_at = $request->created_at;
        $post->save();

        // Dapatkan semua media yang ada untuk post ini
        $existingMedia = PostMedia::where('post_id', $post->id)->get();

        // Jika ada media yang dihapus
        if ($request->has('media_to_delete')) {
            $mediaToDelete = $request->media_to_delete;

            // Hapus media yang tidak ada dalam existing_media_ids
            foreach ($existingMedia as $media) {
                if (!in_array($media->id, $mediaToDelete)) {
                    // Hapus file dari storage
                    if (Storage::exists('public/media/' . $media->post)) {
                        Storage::delete('public/media/' . $media->post);
                    }
                    // Hapus dari database
                    $media->delete();
                }
            }
        } else {
            // Jika tidak ada media yang dipertahankan, hapus semua media yang ada
            foreach ($existingMedia as $media) {
                if (Storage::exists('public/media/' . $media->post)) {
                    Storage::delete('public/media/' . $media->post);
                }
                $media->delete();
            }
        }

        // Jika ada media baru yang diupload
        if ($request->hasFile('content_media')) {
            foreach ($request->file('content_media') as $file) {
                $path = $file->store('media', 'public');
                $filename = basename($path);

                PostMedia::create([
                    'post_id' => $post->id,
                    'post' => $filename,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Post berhasil diperbarui.');
    }

    public function showProfile()
    {
        $socialMedias = SocialMedia::all(); // atau bisa di-filter sesuai kebutuhan
        return view('profile.show', compact('socialMedias'));
    }
}
