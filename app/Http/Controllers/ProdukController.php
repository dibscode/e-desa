<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    // Frontend produk (public)
    public function produkFrontend()
    {
        $produks = Produk::all();
        return view('produk', compact('produks'));
    }

    // Index admin (dashboard)
    public function index()
    {
        $produks = Produk::all();
        return view('master.produk.index', compact('produks'));
    }

    public function create()
    {
        return view('master.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'nomor_wa' => 'nullable|string|max:20',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produk', 'public');
        }
        Produk::create([
            'nama' => $request->nama,
            'image' => $imagePath,
            'harga' => $request->harga,
            'nomor_wa' => $request->nomor_wa,
        ]);
        return redirect()->route('master.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('master.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $request->validate([
            'nama' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'nomor_wa' => 'nullable|string|max:20',
        ]);
        $data = $request->only(['nama', 'harga', 'nomor_wa']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produk', 'public');
        }
        $produk->update($data);
        return redirect()->route('master.produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('master.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
