@extends('layouts.master')
@section('content')

    @include('include.style')
    
    <!-- Breadcrumb Navigation -->
    @include('surat.ahliwaris.include.nav')
    <!-- End Breadcrumb Navigation -->
    <form action="{{ route('surat_ahliwaris.index') }}" method="POST">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ show_error($errors) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="user_name" name="name" autocomplete="off" placeholder="Cari Berdasarkan NIK">
                            <input type="hidden" id="user_id" name="user_id" value="{{ old('user_id') }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Surat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="no_surat"
                                value="{{ old('no_surat') }}" placeholder="Contoh : 474.1 / 40 / 430. 11. 16. 3 / 2025"/>
                        </div>
                        <div class="form-group">
                            <label>Nomor Alm/Almh <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nama_alm_almh"
                                value="{{ old('nama_alm_almh') }}" placeholder="Contoh : Alm/Almh"/>
                        </div>
                        <div class="form-group">
                            <label>Hari/Tanggal Kematian <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="haritanggal"
                                value="{{ old('haritanggal') }}" placeholder="Contoh : Senin, 01 Januari 2025"/>
                        </div>
                        <div class="form-group">
                            <label>Tempat Kematian <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="tempat"
                                value="{{ old('tempat') }}" placeholder="Contoh : Di Rumah"/>
                        </div>
                        <div class="form-group">
                            <label>No. Surat Kematian <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="no_kematian"
                                value="{{ old('no_kematian') }}" placeholder="Contoh : 474.1 / 40 / 430. 11. 16. 3 / 2025"/>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat Kematian <span class="text-danger">*</span></label>
                            <input class="form-control datepicker" type="date" name="tgl_kematian"
                                value="{{ old('tgl_kematian') }}" placeholder="Contoh : 01 Januari 2025"/>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" value="{{ old('keterangan') }}" placeholder="Isi keterangan disini"></textarea>
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

    @include('include.autocomplete')
@endsection