<?php

namespace App\Http\Controllers;

use App\Models\Lapor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Lapor::orderBy('created_at', 'desc')->paginate(15);
        return view('lapor.index', compact('rows'));
    }

    /**
     * Public listing for everyone.
     */
    public function publicIndex()
    {
        $rows = Lapor::orderBy('created_at', 'desc')->paginate(12);
        return view('lapor.lapor', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lapor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|in:belum,proses,selesai',
            'nomor_wa' => 'nullable|string|max:30',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('lapor', 'public');
            $data['foto'] = $path;
        }

    $lapor = Lapor::create($data);

    // If this request originates from the admin area, redirect back to admin listing
    $routeName = $request->route() ? $request->route()->getName() : null;
    if ($routeName && str_starts_with($routeName, 'admin.')) {
        return redirect()->route('admin.lapor.index')->with('success', 'Laporan berhasil dibuat.');
    }

    // Otherwise it's a public submission
    return redirect()->route('lapor.frontend')->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lapor $lapor)
    {
        return view('lapor.show', compact('lapor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lapor $lapor)
    {
        return view('lapor.edit', compact('lapor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lapor $lapor)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|in:belum,proses,selesai',
            'nomor_wa' => 'nullable|string|max:30',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($lapor->foto && Storage::disk('public')->exists($lapor->foto)) {
                Storage::disk('public')->delete($lapor->foto);
            }
            $path = $request->file('foto')->store('lapor', 'public');
            $data['foto'] = $path;
        }

    $lapor->update($data);

    return redirect()->route('admin.lapor.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lapor $lapor)
    {
        if ($lapor->foto && Storage::disk('public')->exists($lapor->foto)) {
            Storage::disk('public')->delete($lapor->foto);
        }

    $lapor->delete();

    return redirect()->route('admin.lapor.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
