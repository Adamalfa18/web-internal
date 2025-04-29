<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientLayanan;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use App\Models\SocialMedia;

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
            'content' => 'required|string',
            'created_at' => 'required|date',
            'content_media' => 'nullable|array',
            'content_media.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,mov,webm|max:20480'
        ]);
        // Simpan data ke social_media
        $social = SocialMedia::create([
            'caption' => $request->caption,
            'content' => $request->content,
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



    public function showProfile()
    {
        $socialMedias = SocialMedia::all(); // atau bisa di-filter sesuai kebutuhan
        return view('profile.show', compact('socialMedias'));
    }
}
