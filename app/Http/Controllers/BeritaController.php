<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('master.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('master.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'kategori' => 'nullable|max:100',
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $request->only(['judul','isi','kategori']);
        $data['slug'] = Str::slug($request->judul);
        $data['penulis'] = Auth::user()->name ?? 'admin';
        foreach([1,2,3] as $i) {
            $img = 'gambar'.$i;
            if ($request->hasFile($img)) {
                $data[$img] = $request->file($img)->store('berita','public');
            }
        }
        Berita::create($data);
        return redirect()->route('master.berita.index')->with('success','Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('master.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'kategori' => 'nullable|max:100',
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $request->only(['judul','isi','kategori']);
        $data['slug'] = Str::slug($request->judul);
        foreach([1,2,3] as $i) {
            $img = 'gambar'.$i;
            if ($request->hasFile($img)) {
                $data[$img] = $request->file($img)->store('berita','public');
            }
        }
        $berita->update($data);
        return redirect()->route('master.berita.index')->with('success','Berita berhasil diupdate.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return redirect()->route('master.berita.index')->with('success','Berita berhasil dihapus.');
    }
}
