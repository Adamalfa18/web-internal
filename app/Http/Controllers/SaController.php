<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientLayanan;
use App\Models\PostMedia;
use App\Models\ProfileSa;
use App\Models\LinkSa;
use App\Models\Tiktok;
use App\Models\TiktokMedia;
use Illuminate\Http\Request;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        $profile = ProfileSa::with('links')->where('client_id', $client_id)->first();

        $posts = SocialMedia::with('media')
            ->where('client_id', $client_id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $tiktok = Tiktok::with('tiktok_media')
            ->where('client_id', $client_id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $post_medias = collect([]);
        foreach ($posts as $post) {
            $media = PostMedia::with('postingan')
                ->where('post_id', $post->id)
                ->orderBy('created_at', 'asc')
                ->first();
            if ($media) {
                $post_medias->push($media);
            }
        }

        $tiktok_medias = collect([]);
        foreach ($tiktok as $postt) {
            $tmedia = TiktokMedia::with('post_tiktok')
                ->where('post_id', $postt->id)
                ->orderBy('created_at', 'asc')
                ->first();
            if ($tmedia) {
                $tiktok_medias->push($tmedia);
            }
        }

        return view('marketlab.divisi-sa.index', compact('posts', 'tiktok', 'post_medias', 'tiktok_medias', 'clients', 'client', 'client_id', 'profile'));
    }

    public function updateProfile(Request $request, $client_id)
    {
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'followers' => 'required|integer',
            'following' => 'required|integer',
            'bio' => 'required|string',
            'links' => 'nullable|array',
            'links.*.url' => 'required|url',
            'links.*.name' => 'required|string',
        ]);

        try {
            // Find or create profile
            $profile = ProfileSa::firstOrNew(['client_id' => $client_id]);

            // Update profile data
            $profile->fill([
                'username' => $request->username,
                'name' => $request->name,
                'followers' => $request->followers,
                'following' => $request->following,
                'bio' => $request->bio
            ]);

            $profile->save();

            // Handle links
            if ($request->has('links')) {
                // Delete existing links
                if ($profile->links()->exists()) {
                    $profile->links()->delete();
                }

                // Create new links
                foreach ($request->links as $link) {
                    LinkSa::create([
                        'profile_id' => $profile->id,
                        'url' => $link['url'],
                        'name' => $link['name'],
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Profile berhasil ' . ($profile->wasRecentlyCreated ? 'dibuat' : 'diperbarui') . '.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function store(Request $request, $client_id)
    {
        $request->validate([
            'caption' => 'required|string',
            'created_at' => 'required|date',
            'content_media' => 'nullable|array',
            'content_media.*' => 'file|mimes:webp,webm|max:20480',
            'cover' => 'nullable|file|mimes:webp|max:20480', // Cover validation
            'category' => 'required|string'
        ]);

        // Variabel untuk menyimpan nama file cover
        $cover = null;

        // Simpan data ke social_media
        $social = SocialMedia::create([
            'caption' => $request->caption,
            'status' => '0', // default
            'note' => null,
            'client_id' => $client_id,
            'created_at' => $request->created_at,
            'updated_at' => now(),
            'cover' => null, // Kosongkan terlebih dahulu
            'category' => $request->category
        ]);

        // Jika ada file cover yang diupload, simpan cover ke folder cover
        if ($request->hasFile('cover')) {
            $coverFile = $request->file('cover');
            $coverPath = $coverFile->store('cover', 'public');
            $cover = basename($coverPath);

            // Update kolom cover pada tabel social_media dengan nama file cover
            $social->cover = $cover;
            $social->save();
        }

        // Upload dan simpan file media biasa jika ada
        if ($request->hasFile('content_media')) {
            foreach ($request->file('content_media') as $file) {
                $path = $file->store('media', 'public');
                $filename = basename($path);

                // Simpan media ke tabel PostMedia
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

    // Tambahkan method untuk store TikTok
    public function storeTiktok(Request $request, $client_id)
    {
        try {
            $request->validate([
                'caption' => 'required|string',
                'created_at' => 'required|date',
                'tiktok_media' => 'nullable|array',
                'tiktok_media.*' => 'file|mimes:webp,webm|max:20480',
                'cover' => 'nullable|file|mimes:webp|max:20480',
            ]);

            Log::info('TikTok Store Request:', [
                'has_tiktok_media' => $request->hasFile('tiktok_media'),
                'tiktok_media_count' => $request->hasFile('tiktok_media') ? count($request->file('tiktok_media')) : 0
            ]);

            // Simpan data ke tabel tiktok
            $tiktok = Tiktok::create([
                'caption' => $request->caption,
                'client_id' => $client_id,
                'created_at' => $request->created_at,
                'cover' => null,
                'status' => '0', // default status
                'note' => null
            ]);

            Log::info('TikTok Created:', ['tiktok_id' => $tiktok->id]);

            // Jika ada file cover yang diupload, simpan cover ke folder cover_tiktok
            if ($request->hasFile('cover')) {
                $coverFile = $request->file('cover');
                $coverPath = $coverFile->store('cover_tiktok', 'public');
                $cover = basename($coverPath);
                $tiktok->cover = $cover;
                $tiktok->save();
            }

            // Upload dan simpan file media tiktok jika ada
            if ($request->hasFile('tiktok_media')) {
                foreach ($request->file('tiktok_media') as $file) {
                    try {
                        $path = $file->store('tiktok_media', 'public');
                        $filename = basename($path);

                        Log::info('Storing TikTok Media:', [
                            'filename' => $filename,
                            'tiktok_id' => $tiktok->id
                        ]);

                        // Simpan ke tabel tiktok_media
                        $tiktokMedia = TiktokMedia::create([
                            'media' => $filename,
                            'post_id' => $tiktok->id
                        ]);

                        Log::info('TikTok Media Created:', ['media_id' => $tiktokMedia->id]);
                    } catch (\Exception $e) {
                        Log::error('Error storing TikTok media:', [
                            'error' => $e->getMessage(),
                            'tiktok_id' => $tiktok->id
                        ]);
                        throw $e;
                    }
                }
            }

            // Reload tiktok dengan media-nya
            $tiktok->load('tiktok_media');

            Log::info('TikTok Media Count After Save:', [
                'tiktok_id' => $tiktok->id,
                'media_count' => $tiktok->tiktok_media->count()
            ]);

            return redirect()->back()->with('success', 'Post TikTok berhasil disimpan!');
        } catch (\Exception $e) {
            Log::error('TikTok Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateTiktok(Request $request, $client_id, $post_id)
    {
        // Validasi data
        $request->validate([
            'caption' => 'required|string',
            'created_at' => 'required|date',
            'tiktok_media.*' => 'nullable|file|mimes:webp,webm|max:20480', // max 20MB per file
        ]);

        // Temukan post berdasarkan post_id dan client_id
        $post = Tiktok::where('client_id', $client_id)->where('id', $post_id)->firstOrFail();

        // Update data dasar
        $post->caption = $request->caption;
        $post->created_at = $request->created_at;
        $post->save();

        // Dapatkan semua media yang ada untuk post ini
        $existingMedia = TiktokMedia::where('post_id', $post->id)->get();

        // Jika ada media yang dihapus
        if ($request->has('media_to_delete_tiktok')) {
            $mediaToDelete = $request->media_to_delete_tiktok;

            // Hapus media yang tidak ada dalam existing_media_ids
            foreach ($existingMedia as $media) {
                if (!in_array($media->id, $mediaToDelete)) {
                    // Hapus file dari storage
                    if (Storage::exists('public/tiktok_media/' . $media->media)) {
                        Storage::delete('public/tiktok_media/' . $media->post);
                    }
                    // Hapus dari database
                    $media->delete();
                }
            }
        } else {
            // Jika tidak ada media yang dipertahankan, hapus semua media yang ada
            foreach ($existingMedia as $media) {
                if (Storage::exists('public/tiktok_media/' . $media->post)) {
                    Storage::delete('public/tiktok_media/' . $media->post);
                }
                $media->delete();
            }
        }

        // Jika ada media baru yang diupload
        if ($request->hasFile('tiktok_media')) {
            foreach ($request->file('tiktok_media') as $file) {
                $path = $file->store('tiktok_media', 'public');
                $filename = basename($path);

                TiktokMedia::create([
                    'post_id' => $post->id,
                    'media' => $filename,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Post berhasil diperbarui.');
    }

    public function storeProfile(Request $request, $client_id)
    {
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'followers' => 'required|integer',
            'following' => 'required|integer',
            'bio' => 'required|string',
            'links' => 'nullable|array',
            'links.*.url' => 'required|url',
            'links.*.name' => 'required|string',
        ]);

        try {
            // Check if profile already exists
            $existingProfile = ProfileSa::where('client_id', $client_id)->first();

            if ($existingProfile) {
                return redirect()->back()->with('error', 'Profile untuk client ini sudah ada. Gunakan Edit Profile untuk mengubah data.');
            }

            // Create new profile
            $profile = ProfileSa::create([
                'client_id' => $client_id,
                'username' => $request->username,
                'name' => $request->name,
                'followers' => $request->followers,
                'following' => $request->following,
                'bio' => $request->bio
            ]);

            // Handle links if any
            if ($request->has('links')) {
                foreach ($request->links as $link) {
                    LinkSa::create([
                        'profile_id' => $profile->id,
                        'url' => $link['url'],
                        'name' => $link['name'],
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Profile berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
