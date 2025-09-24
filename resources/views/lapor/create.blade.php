@extends('layouts.master')

@section('content')
<div class="section">
    <div class="card max-w-2xl mx-auto bg-white m-6 rounded shadow dark:bg-gray-800">
        <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Buat Laporan</h4>
        @php
            $isAdminRoute = request()->is('admin/*') || (Route::currentRouteName() && Str::startsWith(Route::currentRouteName(), 'admin.'));
        @endphp
        @if($isAdminRoute)
            <form action="{{ route('admin.lapor.store') }}" method="POST" enctype="multipart/form-data">
        @else
            <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required value="{{ old('nama_lengkap') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Nomor WA</label>
                <input type="text" name="nomor_wa" class="form-control" value="{{ old('nomor_wa') }}">
            </div>
            <div class="text-end">
                <a href="{{ route('admin.lapor.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection
