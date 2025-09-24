<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratBedanama;
use App\Models\User;
use App\Models\LogSurat;
use Illuminate\Support\Facades\Auth;

class BedaNamaController extends Controller
{
    public $title = "SURAT KETERANGAN BEDA NAMA";

    public function cetak($id)
    {
        $data['title'] = $this->title;
        $data['user'] = User::where('level', 'lurah')->first();
        $data['row'] = SuratBedanama::where('id', $id)->first();

        return view('surat.bedanama.cetak', $data);
    }

    public function signature($id)
    {
        $data['title'] = $this->title;
        $model = SuratBedanama::where('id', $id)->first();
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

        return redirect('surat_bedanama/'.$id)->with('message', 'Surat pengajuan telah dikonfirmasi!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['limit'] = 1000;
        $data['title'] = $this->title;;
        $query = SuratBedanama::where('user_id', 'like', '%' . $data['q'] . '%')
            ->orderBy('id', 'desc');
        $data['rows'] = $query->paginate($data['limit'])->withQueryString();
        $data['no'] = $data['rows']->firstItem();
        return view('surat.bedanama.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'TAMBAH '.$this->title;;
        return view('surat.bedanama.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required',
            'title' => 'required',
            'nik' => 'required',
            'ttl' => 'required',
            'alamat' => 'required',
            'nama' => 'required',
        ], [
            'no_surat.required' => 'Nomor Surat harus diisi',
            'title.required' => 'Judul harus diisi',
            'nik.required' => 'NIK harus diisi',
            'ttl.required' => 'Tempat, Tanggal Lahir harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'nama.required' => 'Nama harus diisi',
        ]);

        $model = new SuratBedanama($request->all());
        $model->surat_id = 10; // Assuming 5 is the ID for Surat Keterangan Usaha
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

        return redirect('surat_bedanama')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['title'] = 'DETAIL '.$this->title;
        $data['previewTitle'] = 'PREVIEW '.$this->title;
        $data['user'] = User::where('level', 'lurah')->first();
        $data['row'] = SuratBedanama::findOrFail($id);
        $data['nav_id'] = $id;

        return view('surat.bedanama.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'EDIT '.$this->title;
        $data['row'] = SuratBedanama::findOrFail($id);
        $data['nav_id'] = $id;
        return view('surat.bedanama.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_surat' => 'required',
            'title' => 'required',
            'nik' => 'required',
            'ttl' => 'required',
            'alamat' => 'required',
            'nama' => 'required',
        ], [
            'no_surat.required' => 'Nomor Surat harus diisi',
            'title.required' => 'Judul harus diisi',
            'nik.required' => 'NIK harus diisi',
            'ttl.required' => 'Tempat, Tanggal Lahir harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'nama.required' => 'Nama harus diisi',
        ]);

        $model = SuratBedanama::findOrFail($id);
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

        return redirect('surat_bedanama')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = SuratBedanama::findOrFail($id);

        LogSurat::insert([
            [
                'waktu' => date('Y-m-d H:i:s'),
                'surat_id' => $model->surat_id,
                'author' => Auth::user()->id,
                'keterangan' => Auth::user()->name.' Menghapus '.$model->suratOne->name.' Untuk '.$model->userOne->name,
            ],
        ]);

        $model->delete();

        return redirect('surat_bedanama')->with('message', 'Data berhasil dihapus!');
    }
}
