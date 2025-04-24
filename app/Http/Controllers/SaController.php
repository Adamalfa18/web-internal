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
        $clients = Client::all();
        $client_layanan = ClientLayanan::all();
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

        // dd([
        //     'caption' => $request->caption,
        //     'content (teks)' => $request->content,
        //     'created_at' => $request->created_at,
        //     'file_uploaded?' => $request->hasFile('content_media'),
        //     'files' => $request->file('content_media'),
        //     'all data' => $request->all(),
        // ]);
        
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
            'status' => 'draft', // default
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
       
        // $postingan = $request->file('content');
        // $paths = [];
        // $tanggal = $validatedData['created_at'] ?? now();

        // $validatedData = $request->validate([
        //     'caption' => 'required|string',
        //     'created_at' => 'nullable|date',
        //     'content' => 'required|string',
        //     'content.*' => 'file|mimes:webp,webm|max:51200',
        // ]);

        // foreach ($postingan as $post) {
        //     $fileOriginalName = $post->getClientOriginalExtension();
        //     $fileNewName = time() . '.' . $fileOriginalName;
        //     $post->storeAs('post', $fileNewName, 'public'); //here images is folder, $fileNewName is files new name, public indicated public folder. that means folder this image in public/storage/images folder
        //     SocialMedia::create([
        //         'client_id' => $client_id,
        //         'caption' => $validatedData['caption'],
        //         'content' => $paths, // simpan array ke kolom JSON
        //         'created_at' => $tanggal
        //     ]);
        // }
        // return redirect()->back()->with('message', 'Post Added');
    }



    public function showProfile()
    {
        $socialMedias = SocialMedia::all(); // atau bisa di-filter sesuai kebutuhan
        return view('profile.show', compact('socialMedias'));
    }
}
