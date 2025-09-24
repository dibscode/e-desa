<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaFrontendController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(9);
        return view('berita', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $berita->increment('views');
        $beritaLain = Berita::where('id', '!=', $berita->id)->latest()->limit(5)->get();
        return view('berita_detail', compact('berita', 'beritaLain'));
    }
}
