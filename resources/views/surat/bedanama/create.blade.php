@extends('layouts.master')
@section('content')

    @include('include.style')
    
    <!-- Breadcrumb Navigation -->
    @include('surat.bedanama.include.nav')
    <!-- End Breadcrumb Navigation -->
    <form action="{{ route('surat_bedanama.index') }}" method="POST">
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
                            <label>Title <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="title"
                                value="{{ old('title') }}" placeholder="Contoh : Tertulis Dalam Akta Kelahiran"/>
                        </div>
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nama"
                                value="{{ old('nama') }}" placeholder="Contoh : Budi Santoso"/>
                        </div>
                        <div class="form-group">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="nik"
                                value="{{ old('nik') }}" placeholder="Contoh : NIK 16 Digit"/>
                        </div>
                        <div class="form-group">
                            <label>TTL <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="ttl"
                                value="{{ old('ttl') }}" placeholder="Contoh : Jakarta, 1 Januari 1998"/>
                        </div>
                        <div class="form-group">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="alamat"
                                value="{{ old('alamat') }}" placeholder="Contoh : Jakarta"/>
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
                <a class="btn btn-danger" href="{{ route('surat_bedanama.index') }}"><i class="bi bi-box-arrow-in-left"></i> Kembali</a>
            </div>
        </div>
    </form>

    @include('include.script')

    @include('include.autocomplete')
@endsection