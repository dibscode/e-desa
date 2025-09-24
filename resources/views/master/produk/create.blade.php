@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Tambah Produk</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('master.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" name="nama" id="nama" class="form-control" required value="{{ old('nama') }}">
                @error('nama')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" required value="{{ old('harga', 0) }}">
                @error('harga')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                <input type="text" name="nomor_wa" id="nomor_wa" class="form-control" value="{{ old('nomor_wa') }}" placeholder="Contoh: 6281234567890">
                @error('nomor_wa')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Produk</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('master.produk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
