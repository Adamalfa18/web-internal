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

    // public function store(request $request, $client_id) {

    //     $input=$request->all();
    //     $images=array();
    //     if($files=$request->file('content')){
    //         foreach($files as $file){
    //             $name=$file->getClientOriginalName();
    //             $file->move('post',$name);
    //             $images[]=$name;
    //         }
    //     }
    //     /*Insert your data*/

    //     $post = SocialMedia::create([
    //         'client_id' => $client_id,
    //         'caption' => $validatedData['caption'],
    //         'content' => implode("|",$images),
    //         'created_at' => $tanggal
    //     ]);

    //     Detail::insert( [
    //         'images'=>  implode("|",$images),
    //         'description' =>$input['description'],
    //         //you can put other insertion here
    //     ]);


    //     return redirect('redirecting page');
    // }

    public function store(Request $request, $client_id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'caption' => 'required|string',
                'created_at' => 'nullable|date',
                'content' => 'required|array',
                'content.*' => 'file|mimes:webp,webm|max:51200',
            ]);

            $tanggal = $validatedData['created_at'] ?? now();
            $uploadedFiles = $request->file('content');
            $paths = [];

            if ($uploadedFiles && is_array($uploadedFiles)) {
                foreach ($uploadedFiles as $file) {
                    if ($file) {
                        $path = $file->store('social_media', 'public');
                        $paths[] = $path; // simpan path ke array

                        // Simpan ke tabel post_media (opsional)
                        // Nanti kita isi setelah social_media dibuat
                    }
                }
            }

            // Buat satu post social_media dengan array path
            $post = SocialMedia::create([
                'client_id' => $client_id,
                'caption' => $validatedData['caption'],
                'content' => $paths, // simpan array ke kolom JSON
                'created_at' => $tanggal
            ]);

            // Simpan media ke tabel post_media
            foreach ($paths as $path) {
                PostMedia::create([
                    'post_id' => $post->id,
                    'post' => $path,
                ]);
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
