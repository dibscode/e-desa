<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeuanganDesa;

class KeuanganDesaController extends Controller
{
    public function index()
    {
        $title = 'Keuangan Desa';
        $rows = KeuanganDesa::orderBy('tanggal', 'desc')->paginate(20);
        return view('keuangan.index', compact('title', 'rows'));
    }

    public function create()
    {
        $title = 'Tambah Keuangan';
        return view('keuangan.create', compact('title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'kode_rekening' => 'required|string|max:20',
            'uraian' => 'required|string|max:255',
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'pemasukan' => 'nullable|numeric',
            'pengeluaran' => 'nullable|numeric',
            'sumber_dana' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        // Normalize nulls to 0 for numeric fields
        $data['pemasukan'] = $data['pemasukan'] ?? 0;
        $data['pengeluaran'] = $data['pengeluaran'] ?? 0;

        KeuanganDesa::create($data);
        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil ditambahkan');
    }

    public function show(KeuanganDesa $keuangan)
    {
        $title = 'Detail Keuangan';
        return view('keuangan.show', compact('title', 'keuangan'));
    }

    public function edit(KeuanganDesa $keuangan)
    {
        $title = 'Edit Keuangan';
        return view('keuangan.edit', ['title' => $title, 'row' => $keuangan]);
    }

    public function update(Request $request, KeuanganDesa $keuangan)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'kode_rekening' => 'required|string|max:20',
            'uraian' => 'required|string|max:255',
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'pemasukan' => 'nullable|numeric',
            'pengeluaran' => 'nullable|numeric',
            'sumber_dana' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $data['pemasukan'] = $data['pemasukan'] ?? 0;
        $data['pengeluaran'] = $data['pengeluaran'] ?? 0;

        $keuangan->update($data);
        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil diperbarui');
    }

    public function destroy(KeuanganDesa $keuangan)
    {
        $keuangan->delete();
        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil dihapus');
    }
}
