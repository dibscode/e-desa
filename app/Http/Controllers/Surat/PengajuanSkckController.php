<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\SuratPengajuanSkck;
use App\Models\LogSurat;
use App\Models\User;

class PengajuanSkckController extends Controller
{
    public $title = "SURAT PENGAJUAN SKCK";

    public function cetak($id)
    {
        $data['title'] = $this->title;
        $data['user'] = User::where('level', 'lurah')->first();
        $data['row'] = SuratPengajuanSkck::where('id', $id)->first();

        return view('surat.skck.cetak', $data);
    }

    public function signature($id)
    {
        $data['title'] = $this->title;
        $model = SuratPengajuanSkck::where('id', $id)->first();
        $model->status = 1;
        $model->save();
        // Simpan log setelah konfirmasi
        LogSurat::insert([
            [
                'waktu' => date('Y-m-d H:i:s'),
                'surat_id' => $model->surat_id,
                'author' => Auth::user()->id,
                'keterangan' => Auth::user()->name.' Mengkonfirmasi '.$model->suratOne->name.' Untuk '.$model->userOne->name,
            ],
        ]);

        return redirect('surat_pengajuan_skck')->with('message', 'Surat pengajuan telah dikonfirmasi!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['limit'] = 1000;
        $data['title'] = $this->title;
        $query = SuratPengajuanSkck::where('user_id', 'like', '%' . $data['q'] . '%')          
            ->orderBy('id', 'asc');
        $data['rows'] = $query->paginate($data['limit'])->withQueryString();
        $data['no'] = $data['rows']->firstItem();
        return view('surat.skck.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Tambah Surat';
        return view('surat.skck.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required',
            'keperluan' => 'required',
        ], [
            'no_surat.required' => 'Nomor Surat harus diisi',
            'keperluan.required' => 'Keperluan Surat harus diisi', 
        ]);

        $model = new SuratPengajuanSkck($request->all());
        $model->surat_id = 4;
        $model->date = date('Y-m-d');
        
        if ($model) {
            LogSurat::insert([
                [
                    'waktu' => date('Y-m-d H:i:s'),
                    'surat_id' => $model->surat_id,
                    'author' => Auth::user()->id,
                    'keterangan' => Auth::user()->name.' Membuat '.$model->suratOne->name.' Untuk '.$model->userOne->name,
                ],
            ]);

            $model->save();
        }
        
        return redirect('surat_pengajuan_skck')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['title'] = $this->title;
        $data['previewTitle'] = 'PREVIEW '.$this->title;
        $data['user'] = User::where('level', 'lurah')->first();
        $data['row'] = SuratPengajuanSkck::findOrFail($id);
        $data['nav_id'] = $id;
        return view('surat.skck.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Edit Surat';
        $data['row'] = SuratPengajuanSkck::findOrFail($id);
        return view('surat.skck.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_surat' => 'required',
            'keperluan' => 'required',
        ], [
            'no_surat.required' => 'Nomor Surat harus diisi',
            'keperluan.required' => 'Keperluan Surat harus diisi', 
        ]);

        $model = SuratPengajuanSkck::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        // Simpan log setelah update
        LogSurat::insert([
            [
                'waktu' => date('Y-m-d H:i:s'),
                'surat_id' => $model->surat_id,
                'author' => Auth::user()->id,
                'keterangan' => Auth::user()->name.' Mengubah '.$model->suratOne->name.' Untuk '.$model->userOne->name,
            ],
        ]);

        return redirect('surat_pengajuan_skck')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = SuratPengajuanSkck::findOrFail($id);

        // Simpan log sebelum hapus
        LogSurat::insert([
            [
                'waktu' => date('Y-m-d H:i:s'),
                'surat_id' => $model->surat_id,
                'author' => Auth::user()->id,
                'keterangan' => Auth::user()->name.' Menghapus '.$model->suratOne->name.' Untuk '.$model->userOne->name,
            ],
        ]);

        $model->delete();

        return redirect('surat_pengajuan_skck')->with('message', 'Data berhasil dihapus!');
    }
}
