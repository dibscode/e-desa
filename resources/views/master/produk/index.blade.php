@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Data Produk</h4>
        <a href="{{ route('master.produk.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Nomor WA</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produks as $produk)
                    <tr>
                        <td>{{ $produk->nama }}</td>
                        <td>
                            @if($produk->image)
                                <img src="{{ asset('storage/'.$produk->image) }}" alt="Gambar Produk" style="max-width:60px;">
                            @endif
                        </td>
                        <td>Rp{{ number_format($produk->harga,0,',','.') }}</td>
                        <td>
                            @if($produk->nomor_wa)
                                <a href="https://wa.me/{{ $produk->nomor_wa }}" target="_blank" class="btn btn-success btn-sm">Pesan WA</a>
                                <div class="small text-muted">{{ $produk->nomor_wa }}</div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('master.produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('master.produk.destroy', $produk->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus produk?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
