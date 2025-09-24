@extends('layouts.master')

@section('content')
    {{ show_msg() }}
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Detail Laporan</h4>
                <a href="{{ route('admin.lapor.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <div class="card-body">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $lapor->nama_lengkap }}</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Status: <strong>{{ ucfirst($lapor->status) }}</strong></div>
                </div>

                @if($lapor->foto)
                    <div class="mb-4">
                        <img src="{{ $lapor->foto_url }}" alt="Foto" style="max-width:120px;">
                    </div>
                @endif

                <div class="prose dark:prose-invert text-gray-700 dark:text-gray-200">{!! nl2br(e($lapor->deskripsi)) !!}</div>

                <div class="mt-4">
                    @if(Auth::check() && Auth::user()->level === 'admin')
                        <a href="{{ route('admin.lapor.edit', $lapor) }}" class="btn btn-primary">Edit</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
