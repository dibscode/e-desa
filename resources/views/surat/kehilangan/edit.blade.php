@extends('layouts.master')
@section('content')

    @include('include.style')
    <!-- Breadcrumb Navigation -->
    @include('surat.kehilangan.include.nav')
    <!-- End Breadcrumb Navigation -->
    <form action="{{ route('surat_kehilangan.update', $row->id) }}" method="POST">
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
                            <label>Barang <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="barang" value="{{ old('barang', $row->barang) }}" required placeholder="Contoh : Melamar Pekerjaan"/>
                        </div>
                        <div class="form-group">
                            <label>Hari, Tanggal <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="haritanggal" value="{{ old('haritanggal', $row->haritanggal) }}" required placeholder="Contoh : 01 Januari 2025"/>
                        </div>
                        <div class="form-group">
                            <label>Tempat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="tempat" value="{{ old('tempat', $row->tempat) }}" required placeholder="Contoh : Jakarta"/>
                        </div>
                        <div class="form-group">
                            <label>Berlaku <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="berlaku" value="{{ old('berlaku', $row->berlaku) }}" required placeholder="Contoh : 01 Januari 2025"/>
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
                <a class="btn btn-danger" href="{{ route('surat_kehilangan.index') }}"><i class="bi bi-box-arrow-in-left"></i> Kembali</a>
            </div>
        </div>
    </form>

    @include('include.script')
@endsection