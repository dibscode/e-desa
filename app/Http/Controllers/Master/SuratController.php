<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Surat;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['limit'] = 100;
        $data['title'] = 'Data Surat';
        $query = Surat::where('name', 'like', '%' . $data['q'] . '%')          
            ->orderBy('id', 'ASC');
        $data['rows'] = $query->paginate($data['limit'])->withQueryString();
        $data['no'] = $data['rows']->firstItem();
        return view('master.surat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Tambah Surat';
        return view('master.surat.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama Surat harus diisi',
        ]);

        $model = new Surat($request->all());
        $model->save();
        return redirect('surat')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Surat $surat)
    {
        $data['row'] = $surat;
        $data['title'] = 'Ubah Surat';
        return view('master.surat.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'kode' => 'required',
            'name' => 'required',
        ], [
            // 'kode.required' => 'Kode Surat harus diisi',
            'name.required' => 'Nama Surat harus diisi',
        ]);

        $model = Surat::find($id);
        $model->name = $request->name;
        $model->save();
        return redirect('surat')->with('message', 'Data berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Surat::find($id)->delete();
        return redirect('surat')->with('message', 'Data berhasil dihapus!');
    }
}
