<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialMedia;

class SaController extends Controller
{
    public function index()
    {
        // $social_media = SocialMedia::all();
        $social_media = SocialMedia::orderBy('created_at', 'desc')->get();

        return view('marketlab.divisi-sa.index', compact(
            'social_media',
        ));
    }

    public function showProfile()
    {
        $socialMedias = SocialMedia::all(); // atau bisa di-filter sesuai kebutuhan
        return view('profile.show', compact('socialMedias'));
    }
}
