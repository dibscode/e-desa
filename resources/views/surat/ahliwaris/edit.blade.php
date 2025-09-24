@extends('layouts.master')
@section('content')

    @include('include.style')
    <!-- Breadcrumb Navigation -->
    @include('surat.ahliwaris.include.nav')
    <!-- End Breadcrumb Navigation -->
    <form action="{{ route('surat_ahliwaris.update', $row->id) }}" method="POST">
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
                            <label>Nomor Alm/Almh <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nama_alm_almh" value="{{ old('nama_alm_almh', $row->nama_alm_almh) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Hari/Tanggal Kematian <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="haritanggal" value="{{ old('haritanggal', $row->haritanggal) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Tempat Kematian <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="tempat" value="{{ old('tempat', $row->tempat) }}" required>
                        </div>
                        <div class="form-group">
                            <label>No. Surat Kematian <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="no_kematian" value="{{ old('no_kematian', $row->no_kematian) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat Kematian <span class="text-danger">*</span></label>
                            <input class="form-control datepicker" type="text" name="tgl_kematian" value="{{ old('tgl_kematian', $row->tgl_kematian) }}" required>
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
                <a class="btn btn-danger" href="{{ route('surat_ahliwaris.index') }}"><i class="bi bi-box-arrow-in-left"></i> Kembali</a>
            </div>
        </div>
    </form>

    @include('include.script')
@endsection