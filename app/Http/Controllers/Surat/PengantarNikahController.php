<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SuratPengantarNikah;

class PengantarNikahController extends Controller
{
    public function cetak($id)
    {
        $data['title'] = 'SURAT PENGANTAR NIKAH';
        $data['row'] = SuratPengantarNikah::where('id', $id)->first();

        return view('surat.nikah.cetak', $data);
    }

    public function status($id)
    {
        $data['title'] = 'SURAT PENGANTAR NIKAH';
        $model = SuratPengantarNikah::where('id', $id)->first();
        $model->status = 1;
        $model->save();

        return redirect('surat_pengantar_nikah')->with('message', 'Surat pengajuan telah dikonfirmasi!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['limit'] = 10;
        $data['title'] = 'Surat Pengantar Nikah';
        $query = SuratPengantarNikah::where('user_id', 'like', '%' . $data['q'] . '%')          
            ->orderBy('id', 'asc');
        $data['rows'] = $query->paginate($data['limit'])->withQueryString();
        $data['no'] = $data['rows']->firstItem();
        return view('surat.nikah.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Tambah Surat';
        return view('surat.nikah.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nik_ayah' => 'required', 
            'nama_ayah' => 'required', 
            'ttl_ayah' => 'required', 
            'alamat_ayah' => 'required', 
            'pekerjaan_ayah' => 'required',
            'nik_ibu' => 'required', 
            'nama_ibu' => 'required', 
            'ttl_ibu' => 'required', 
            'alamat_ibu' => 'required', 
            'pekerjaan_ibu' => 'required',
        ], [
            'user_id.required' => 'Nama User harus diisi',
            'nik_ayah.required' => 'NIK Ayah harus diisi', 
            'nama_ayah.required' => 'Nama Ayah harus diisi', 
            'ttl_ayah.required' => 'TTL Ayah harus diisi', 
            'alamat_ayah.required' => 'Alamat Ayah harus diisi', 
            'pekerjaan_ayah.required' => 'Pekerjaan Ayah harus diisi',
            'nik_ibu.required' => 'NIK Ibu harus diisi', 
            'nama_ibu.required' => 'Nama Ibu harus diisi', 
            'ttl_ibu.required' => 'TTL Ibu harus diisi', 
            'alamat_ibu.required' => 'Alamat Ibu harus diisi', 
            'pekerjaan_ibu.required' => 'Pekerjaan Ibu harus diisi',
        ]);

        $model = new SuratPengantarNikah($request->all());
        $model->surat_id = 5;
        $model->date = date('Y-m-d');
        $model->save();
        return redirect('surat_pengantar_nikah')->with('message', 'Data berhasil ditambah!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
