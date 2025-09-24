@extends('layouts.master')
@section('content')

    @include('include.style')
    <!-- Breadcrumb Navigation -->
    @include('surat.sku.include.nav')
    <!-- End Breadcrumb Navigation -->
    <form action="{{ route('surat_keterangan_usaha.update', $row->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ show_error($errors) }}
                        <div class="form-group">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="{{ $row->userOne->nik ?? '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="{{ $row->userOne->name ?? '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nomor Surat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="no_surat" value="{{ old('no_surat', $row->no_surat) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Usaha <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="jenis_usaha" value="{{ old('jenis_usaha', $row->jenis_usaha) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Lama Usaha <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="lama_usaha" value="{{ old('lama_usaha', $row->lama_usaha) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" placeholder="Isi keterangan disini">{{ old('keterangan', $row->keterangan) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a class="btn btn-danger" href="{{ route('surat_keterangan_usaha.index') }}"><i class="bi bi-box-arrow-in-left"></i> Kembali</a>
            </div>
        </div>
    </form>

    @include('include.script')
@endsection