@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Edit Berita</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('master.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" required value="{{ old('judul', $berita->judul) }}">
                @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="form-control" value="{{ old('kategori', $berita->kategori) }}">
                @error('kategori')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="isi" class="form-label">Isi</label>
                <textarea name="isi" id="isi" class="form-control" rows="6" required>{{ old('isi', $berita->isi) }}</textarea>
                @error('isi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="gambar1" class="form-label">Gambar 1</label>
                <input type="file" name="gambar1" id="gambar1" class="form-control">
                @if($berita->gambar1)
                    <img src="{{ asset('storage/'.$berita->gambar1) }}" alt="Gambar 1" class="mt-2" style="max-width:120px;">
                @endif
                @error('gambar1')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="gambar2" class="form-label">Gambar 2</label>
                <input type="file" name="gambar2" id="gambar2" class="form-control">
                @if($berita->gambar2)
                    <img src="{{ asset('storage/'.$berita->gambar2) }}" alt="Gambar 2" class="mt-2" style="max-width:120px;">
                @endif
                @error('gambar2')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="gambar3" class="form-label">Gambar 3</label>
                <input type="file" name="gambar3" id="gambar3" class="form-control">
                @if($berita->gambar3)
                    <img src="{{ asset('storage/'.$berita->gambar3) }}" alt="Gambar 3" class="mt-2" style="max-width:120px;">
                @endif
                @error('gambar3')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('master.berita.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
