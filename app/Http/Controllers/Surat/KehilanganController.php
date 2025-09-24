<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratKehilangan;
use App\Models\LogSurat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KehilanganController extends Controller
{
    public $title = "SURAT KETERANGAN KEHILANGAN";

    public function cetak($id)
    {
        $data['title'] = $this->title;
        $data['user'] = User::where('level', 'lurah')->first();
        $data['row'] = SuratKehilangan::where('id', $id)->first();

        return view('surat.kehilangan.cetak', $data);
    }

    public function signature($id)
    {
        $data['title'] = $this->title;
        $model = SuratKehilangan::where('id', $id)->first();
        $model->status = 1;
        $model->keterangan = 'Disetujui';
        LogSurat::insert([
            [
                'waktu' => date('Y-m-d H:i:s'),
                'surat_id' => $model->surat_id,
                'author' => Auth::user()->id,
                'keterangan' => Auth::user()->name.' Menyetujui '.$model->suratOne->name.' Untuk '.$model->userOne->name,
            ],
        ]);
        $model->save();

        return redirect('surat_kehilangan/'.$id)->with('message', 'Surat pengajuan telah dikonfirmasi!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['limit'] = 1000;
        $data['title'] = $this->title;;
        $query = SuratKehilangan::where('user_id', 'like', '%' . $data['q'] . '%')
            ->orderBy('id', 'desc');
        $data['rows'] = $query->paginate($data['limit'])->withQueryString();
        $data['no'] = $data['rows']->firstItem();
        return view('surat.kehilangan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'TAMBAH '.$this->title;;
        return view('surat.kehilangan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required',
            'barang' => 'required',
            'haritanggal' => 'required',
            'tempat' => 'required',
            'berlaku' => 'required',
        ], [
            'no_surat.required' => 'Nomor Surat harus diisi',
            'barang.required' => 'Barang yang hilang harus diisi',
            'haritanggal.required' => 'Hari dan Tanggal harus diisi',
            'tempat.required' => 'Tempat kejadian harus diisi',
            'berlaku.required' => 'Berlaku sampai harus diisi',
        ]);

        $model = new SuratKehilangan($request->all());
        $model->surat_id = 2;
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

        return redirect('surat_kehilangan')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['title'] = 'DETAIL '.$this->title;
        $data['previewTitle'] = 'PREVIEW '.$this->title;
        $data['user'] = User::where('level', 'lurah')->first();
        $data['row'] = SuratKehilangan::findOrFail($id);
        $data['nav_id'] = $id;

        return view('surat.kehilangan.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'EDIT '.$this->title;
        $data['row'] = SuratKehilangan::findOrFail($id);
        $data['nav_id'] = $id;
        return view('surat.kehilangan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_surat' => 'required',
            'barang' => 'required',
            'haritanggal' => 'required',
            'tempat' => 'required',
            'berlaku' => 'required',
        ], [
            'no_surat.required' => 'Nomor Surat harus diisi',
            'barang.required' => 'Barang yang hilang harus diisi',
            'haritanggal.required' => 'Hari dan Tanggal harus diisi',
            'tempat.required' => 'Tempat kejadian harus diisi',
            'berlaku.required' => 'Berlaku sampai harus diisi',
        ]);

        $model = SuratKehilangan::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        LogSurat::insert([
            [
                'waktu' => date('Y-m-d H:i:s'),
                'surat_id' => $model->surat_id,
                'author' => Auth::user()->id,
                'keterangan' => Auth::user()->name.' Mengubah '.$model->suratOne->name.' Untuk '.$model->userOne->name,
            ],
        ]);

        return redirect('surat_kehilangan')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = SuratKehilangan::findOrFail($id);

        LogSurat::insert([
            [
                'waktu' => date('Y-m-d H:i:s'),
                'surat_id' => $model->surat_id,
                'author' => Auth::user()->id,
                'keterangan' => Auth::user()->name.' Menghapus '.$model->suratOne->name.' Untuk '.$model->userOne->name,
            ],
        ]);

        $model->delete();

        return redirect('surat_kehilangan')->with('message', 'Data berhasil dihapus!');
    }
}
