<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SaController extends Controller
{
    public function index()
    {
        return view('marketlab.divisi-sa.index');
    }
}
