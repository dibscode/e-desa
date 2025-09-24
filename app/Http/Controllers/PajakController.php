<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pajak;
use App\Models\User;
use App\Models\LogSurat;
use Illuminate\Support\Facades\Auth;

class PajakController extends Controller
{
    public $title = "PAJAK";

    public function cetak($id)
    {
        $data['title'] = $this->title;
        $data['user'] = User::where('level', 'lurah')->first();
        $data['row'] = Pajak::where('id', $id)->first();

        return view('pajak.cetak', $data);
    }

    public function signature($id)
    {
        $data['title'] = $this->title;
        $model = Pajak::where('id', $id)->first();
        $model->status = 1;
        $model->keterangan = 'Disetujui';
        LogSurat::insert([
            [
                'surat_id' => $model->surat_id,
                'author' => Auth::user()->id,
                'keterangan' => Auth::user()->name.' Menyetujui '.$model->suratOne->name.' Untuk '.$model->userOne->name,
            ],
        ]);
        $model->save();

        return redirect('pajak/'.$id)->with('message', 'Surat pengajuan telah dikonfirmasi!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['limit'] = 1000;
        $data['title'] = $this->title;;
        $query = Pajak::where('user_id', 'like', '%' . $data['q'] . '%')
            ->orderBy('id', 'desc');
        $data['rows'] = $query->paginate($data['limit'])->withQueryString();
        $data['no'] = $data['rows']->firstItem();
        return view('pajak.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'TAMBAH '.$this->title;;
        return view('pajak.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'total' => 'required|numeric',
            'keterangan' => 'required',
            'status' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('file')) {
            $imagePath = $request->file('file')->store('pajak', 'public');
        }
        
        $model = new Pajak($request->all());
        $model->date = now();
        $model->file = $imagePath;
        $model->save();
        
        return redirect('pajak')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['title'] = 'DETAIL '.$this->title;
        $data['previewTitle'] = 'PREVIEW '.$this->title;
        $data['user'] = User::where('level', 'lurah')->first();
        $data['row'] = Pajak::findOrFail($id);
        $data['nav_id'] = $id;

        return view('pajak.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'EDIT '.$this->title;
        $data['row'] = Pajak::findOrFail($id);
        $data['nav_id'] = $id;
        return view('pajak.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'total' => 'required|numeric',
            'keterangan' => 'required',
            'status' => 'required',
        ]);

        $model = Pajak::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        return redirect('pajak')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Pajak::findOrFail($id);
        $model->delete();

        return redirect('pajak')->with('message', 'Data berhasil dihapus!');
    }
}
