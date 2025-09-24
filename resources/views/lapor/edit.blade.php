@extends('layouts.master')

@section('content')
    {{ show_msg() }}
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Edit Laporan</h4>
                <a href="{{ route('admin.lapor.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.lapor.update', $lapor) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" required value="{{ old('nama_lengkap', $lapor->nama_lengkap) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto (opsional)</label>
                        <input type="file" name="foto" class="form-control">
                        @if($lapor->foto)
                            <img src="{{ $lapor->foto_url }}" alt="Foto" class="mt-2" style="max-width:120px;">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="5">{{ old('deskripsi', $lapor->deskripsi) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="belum" {{ old('status', $lapor->status) == 'belum' ? 'selected' : '' }}>Belum</option>
                            <option value="proses" {{ old('status', $lapor->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ old('status', $lapor->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor WA</label>
                        <input type="text" name="nomor_wa" class="form-control" value="{{ old('nomor_wa', $lapor->nomor_wa) }}">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
