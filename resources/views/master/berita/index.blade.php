@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Data Berita</h4>
        <a href="{{ route('master.berita.create') }}" class="btn btn-primary">Tambah Berita</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beritas as $berita)
                    <tr>
                        <td>{{ $berita->judul }}</td>
                        <td>{{ $berita->kategori }}</td>
                        <td>{{ $berita->penulis }}</td>
                        <td>
                            @if($berita->gambar1)
                                <img src="{{ asset('storage/'.$berita->gambar1) }}" alt="Gambar 1" style="max-width:60px;">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('master.berita.edit', $berita->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('master.berita.destroy', $berita->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus berita?')">Hapus</button>
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
