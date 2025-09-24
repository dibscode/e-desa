@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Edit Produk</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('master.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" name="nama" id="nama" class="form-control" required value="{{ old('nama', $produk->nama) }}">
                @error('nama')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" required value="{{ old('harga', $produk->harga) }}">
                @error('harga')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                <input type="text" name="nomor_wa" id="nomor_wa" class="form-control" value="{{ old('nomor_wa', $produk->nomor_wa) }}" placeholder="Contoh: 6281234567890">
                @error('nomor_wa')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Produk</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($produk->image)
                    <img src="{{ asset('storage/'.$produk->image) }}" alt="Gambar Produk" class="mt-2" style="max-width:120px;">
                @endif
                @error('image')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('master.produk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
